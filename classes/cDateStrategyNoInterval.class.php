<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategyNoInterval.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategyNoInterval' erweitert 'cDateStrategy' um unregelmäßig wiederkehrende Termine
//  Project       : libdatephp
//  Project Site  : https://github.com/rstoetter/libdatephp
//  Project wiki  : https://github.com/rstoetter/libdatephp/wiki
//  Created by    : Rainer Stötter ( rstoetter@users.sourceforge.net )
//  Copyright (c) : 2007-2017, Rainer Stötter, All rights reserved
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  License
//
//  This file has been released under MIT LICENSE
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Requests]]
//
//
//		_POST['dates_30']
//		_POST['strategy']
//
//	[[End of requests]]
//
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Functions]]
//
//
//		function __cmp_Dates($d1,$d2)
//
//	[[End of functions]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Classes]]
//
//
//	class cDateStrategyNoInterval
//		public method AddDate($dateObj)
//		public method AsString()
//		public method ContainsDate($dt)
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($dt)
//		public method GetNextDate($datestart,$dateisfirst=true)
//		public method IsDate($dateObj)
//		public method IsValid()
//		public method Reset()
//		public method cDateStrategyNoInterval($str=undef)
//		protected var $count
//		protected var $dates
//		protected method qsort($a,$f)
//		private method OutAry()
//		private method qsort_do($a,$l,$r,$f)
//		private method qsort_partition($a,$l,$r,$lp,$rp,$f)
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
?><?php

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategyNoInterval
////////////////////////////////////////////////////////////////////////////////////

namespace libdatephp;

function __cmp_Dates( $d1, $d2 ) {
    return ( $d1->lt($d2) );

}

class cDateStrategyNoInterval extends cDateStrategy {

    // kein Verrutschen bei Samstag / Sonntag / Feiertag , da es sich ja um einen fixen Termin handelt

    protected $dates = array();
    protected $count = 0;

    public function cDateStrategyNoInterval( $str = undef ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str == undef) {
                $this->Reset( );
            } else {
                $this->FromString( $str ) ;
            }
    }   // constructor


    public function Reset( ) {

        parent::Reset();

        $this->dates = array();
        $this->count = 0;

    }

    public function AddDate( $dateObj ) {
        $this->dates[] = new cDate($dateObj);
        $this->count++;
        $this->qsort( &$this->dates, __cmp_Dates );
        if ($dateObj->lt($this->startDate)) {
            $this->startDate = new cDate( $dateObj );
        }
        # $this->OutAry();

    }

    public function ContainsDate( $dt ) {

        for ($i=0; $i< sizeof($this->dates); $i++) {
            if ($this->dates[$i]->eq( $dt )) { return true; }
        }

        return false;

    }


    public function GetFollower( $dt ) {

        for ($i=0; $i< sizeof($this->dates); $i++) {
            if ($this->dates[$i]->eq( $dt )) { return new cDate($this->dates[$i]); }
        }

        return undef;
    }

    public function FromString( $str ) {

        # echo "<br>" . $str;

        sscanf( $str, "s9-%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d-",
            $this->directionOnSaturday, $this->directionOnSunday, $this->directionOnCelebrity,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $this->count
            );

        $this->startDate->SetDate($startmonth, $startday, $startyear );

        if ($endday==0) {
            $this->endDate = undef;
        } else {
            $this->endDate = new cDate($endmonth, $endday, $endyear );
        }

        $str2 = $str;
        $pos = 0;
        $pos2 = 0;
        $day = 0; $month = 0; $year=0;
        $this->dates = array();

        for ( $i = 0; $i<5; $i++) {
            $pos = strpos  ( $str2  , "-"  , 0 );
            $str2 = substr( $str2, $pos+1);
            # print "<br>" . $str2;
        }

        # echo "<br>" . $this->count . " occurences ";

        for ( $i = 0; $i<$this->count; $i++) {
            sscanf( $str2, "(%d.%d.%d)", $day, $month, $year);
            $dt = new cDate( $month, $day, $year );
            $this->dates[] = $dt;
            # echo "<br>am $day.$month.$year ->".$dt->AsDMY();
            $pos = strpos  ( $str2  , "-"  , 0 );
            $str2 = substr( $str2, $pos+1);
            # print "<br>" . $str2;
        }

        $this->qsort( &$this->dates, __cmp_Dates );
        # $this->OutAry();


    }   // function FromString

    public function AsString( ) {

        if ( $this->endDate == undef ){
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->endDate->Day();
            $endmonth = $this->endDate->Month();
            $endyear = $this->endDate->Year();
        }

        $str = sprintf(
            "s9-%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d",
            $this->directionOnSaturday, $this->directionOnSunday, $this->directionOnCelebrity,
            $this->startDate->Day(), $this->startDate->Month(), $this->startDate->Year(),
            $endday, $endmonth, $endyear,
            $this->count
            );

        for ( $i = 0; $i<$this->count; $i++) {
            $day = $this->dates[$i]->Day();
            $month = $this->dates[$i]->Month();
            $year = $this->dates[$i]->Year();
            $str .= "-($day.$month.$year)";
        }

        return $str;

    }   // function AsString




    public function IsValid() {    // NOTE : TODO !
        return true;
    }


    private function OutAry() {
            for ($i=0;$i<sizeof($this->dates); $i++) {
                echo "<br> $i:" . $this->dates[$i]->AsDMY();
            }

    }

    protected function qsort($a,$f) {
        $this->qsort_do(&$a,0,Count($a)-1,$f);
    }

    private function qsort_do($a,$l,$r,$f) {
    if ($l < $r) {
        $this->qsort_partition(&$a,$l,$r,&$lp,&$rp,$f);
        $this->qsort_do(&$a,$l,$lp,$f);
        $this->qsort_do(&$a,$rp,$r,$f);
    }
    }

    private function qsort_partition($a,$l,$r,$lp,$rp,$f) {
    $i = $l+1;
    $j = $l+1;

    while ($j <= $r) {
    if ($f($a[$j],$a[$l])) {
        # echo "<br>tausche " . $a[$j]->AsDMY() . " mit " . $a[$l]->AsDMY();

        $tmp = $a[$j];
        $a[$j] = $a[$i];
        $a[$i] = $tmp;
        $i++;
        # $this->OutAry();
    }
    $j++;
    }

    $x = $a[$l];
    $a[$l] = $a[$i-1];
    $a[$i-1] = $x;

    $lp = $i - 2;
    $rp = $i;
    }

    public function FromForm(  ) {

        $ary = $_POST['dates_30'];
        $dt = new cDate;

        $radiostrategy = $_POST['strategy'];
        $dt = new cDate();

        // assert ($radiostrategy == 's9_no_interval');

        if ($radiostrategy == 's9_no_interval') {

            $this->count = 0;

            for ($i=0;$i<sizeof($ary); $i++) {
                // echo "<br>" . $ary[$i];
                if (trim($ary[$i]) != '') {
                    $dt = new cDate();
                    $dt->FromDMY( $ary[$i]);
                    $this->dates[] = $dt;
                    $this->count++;
                    // echo "<br>" . $dt->AsDMY();
                }
            }

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
            $this->qsort( &$this->dates, __cmp_Dates );
            # $this->OutAry();
            if ($this->dates[0]->lt($this->startDate)) {
                $this->startDate = new cDate( $this->dates[0] );
            }
        }
    }   // function FromForm

    public function FillForm( $checked = false ) {

        $msgOhneIntervall = $this->id2msg( 1055 );
        $msgNeuerEintrag = $this->id2msg( 1056 );

        $check = ( $checked ) ? " checked " : "";

        // -------------- s8 => täglich
    echo "<tr><td valign=top><input type=radio name = 'strategy' value='s9_no_interval' $check>$msgOhneIntervall</td>";
    echo "<td>";

    echo '<table>';
    echo '<tr><td>';
    echo '<div class="multiValue"><ul class="multiValue" id="dates_30_multi_value_list">';
// org    echo "<li><input type='input' name='dates_30[]' size='10'  value=''></li></td><td valign=bottom><a href='#' onclick='addInputField(\"dates_30_multi_value_list\", \"dates_30\", \"10\"); return false;'>Neuer Eintrag</a>";
    $ary = $this->dates;
    for ( $i =0; $i<sizeof($ary); $i++) {
        $val = $ary[$i]->AsDMY();
        echo "<li><input type='input' name='dates_30[]' size='10' value='$val'></li>";
    }
    echo "</td><td valign=bottom>";
    echo "<a href='#' onclick='addInputField(\"dates_30_multi_value_list\", \"dates_30\", \"10\"); return false;'>$msgNeuerEintrag</a>";

    echo '</div></td></tr>';
    echo '</table>';

/*
?>
    <table>
    <tr><td>
    <div class="multiValue"><ul class="multiValue" id="dates_30_multi_value_list">
    <li><input type='input' name='dates_30[]' size='10'  value=''></li></td><td valign=bottom><a href='#' onclick='addInputField("dates_30_multi_value_list", "dates_30", "10"); return false;'>Neuer Eintrag</a></div>
    </td></tr>
    </table>
<?php
*/
    echo "</td></tr>";



    }   // function FillForm

    public function GetNextDate( $datestart, $dateisfirst = true  ) {

        for ($i=0; $i<$this->count;$i++) {
            if (($datestart->eq($this->dates[$i]) ) && ($dateisfirst)) { return new cDate($this->dates[$i]); }
            if ($datestart->lt($this->dates[$i]) ) { return new cDate($this->dates[$i]); }
        }

        return undef;

    }   // function GetNextDate


    public function GetFirstDate( ) {

        $dt = new cDate( $this->dates[0]);

        for ($i=0;$i<$this->count; $i++){
            if ($this->dates[$i]->lt($dt)) { $dt = new cDate($this->dates·[$i]); }
        }

        return $dt;

    }   // function GetFirstDate()

    public function IsDate( $dateObj ) {


        for ($i=0;$i<$this->count; $i++){
            if ($this->dates[$i]->eq($dateObj)) { return true; }
        }

        return false;

    }   // function IsDate

}       // of class cDateStrategyNoInterval

?>