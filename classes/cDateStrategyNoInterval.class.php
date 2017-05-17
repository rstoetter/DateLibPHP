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
//		public method AddDate($date_obj)
//		public method AsString()
//		public method ContainsDate($dt)
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($dt)
//		public method GetNextDate($date_start,$date_is_first=true)
//		public method IsDate($date_obj)
//		public method IsValid()
//		public method Reset()
//		public method cDateStrategyNoInterval($str=null)
//		protected var $m_count
//		protected var $m_dates
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

/*
function __cmp_Dates( $d1, $d2 ) {
    return ( $d1->lt($d2) );

}
*/

/**
  *
  * The class cDateStrategyNoInterval is a container for date objects, which follow no special pattern. The dates cannot move forward or backward.
  *
  * @author Rainer Stötter
  * @copyright 2010-2017 Rainer Stötter
  * @license MIT
  *
  * @see cDateStrategyDaily
  * @see cDateStrategyDailyFixed
  * @see cDateStrategyMonthly
  * @see cDateStrategyMonthlyFixed
  * @see cDateStrategyNoInterval
  * @see cDateStrategySimpleDate
  * @see cDateStrategySimpleInterval
  * @see cDateStrategyMonthlyFixed
  *
  */

class cDateStrategyNoInterval extends cDateStrategy {

    // kein Verrutschen bei Samstag / Sonntag / Feiertag , da es sich ja um einen fixen Termin handelt

    /**
      * The property $m_dates holds the several dates.
      *
      * @var array $m_dates the managed dates
      *
      * @see m_count
      * @see m_dates
      *
      */

    protected $m_dates = array( );


    /**
      * The property $m_count is the counter for $m_dates
      *
      * @var array $m_dates the managed dates
      *
      * @see m_count
      * @see m_dates
      *
      */


    protected $m_count = 0;


    /**
      * The constructor of cDateStrategyNoInterval
      *
      *  Example:
      *
      *      $strategy = new \libdatephp\cDateStrategyNoInterval(
      *				new \libdatephp\cDate( ),,
      *				null,
      *				'en_en'
      *				);
      *
      *	    $strategy2 = new \libdatephp\cDateStrategyNoInterval( $strategy->AsString( ) );
      *
      *	    $strategy3 = new \libdatephp\cDateStrategyNoInterval( );
      *
      *	    $strategy4 = new \libdatephp\cDateStrategyNoInterval( '' ); // TODO - stimmt hier nicht
      *
      *
      * @example "./tst/tst-cDateStrategyNoInterval.php" Full Example:
      *
      *
      *
      * @param mixed $start_date mixed If it is a string, then the template for the algorithm got by AsString( ). If it is a cDate: the date, from which the calcultions should start. If it is null, then the actual date will be used. $start_date defaults to null
      * @param string $end_date string with language or null when $start_date is a template. Else cDate the date, where the calcultions should stop. If it is null, then there is no ending date for the calculations. $end_date defaults to null
      * @param string $language string the language for messages. ('de_de', 'en_en' or 'fr_fr'). It defaults to 'en_en'.
      *
      * @return cDateStrategyNoInterval
      *
      */

    function __construct(
			$start_date = null,
			$end_date = null,
			$language = 'en_en'
			)  {

	   $this->Reset( );

	  $directionOnSaturday = self::STRATEGY_DIRECTION_LEAVE;
	  $directionOnSunday = self::STRATEGY_DIRECTION_LEAVE;
	  $directionOnCelebrity = self::STRATEGY_DIRECTION_LEAVE;
	  $directionOnHoliday = self::STRATEGY_DIRECTION_LEAVE;
	  $directionOnImpossible = self::STRATEGY_DIRECTION_FORWARD;

	  if ( is_string( $start_date ) ) {

	      // read the template

	      $this->FromString( $start_date ) ;

	      $this->m_language = ( is_null( $end_date ) ? 'en_en' : $end_date  );

	      // initialize by parent

	      parent::__construct(
			    $this->m_start_date,
			    $this->m_end_date,
			    $this->m_language,
			    $this->m_directionOnSaturday,
			    $this->m_directionOnSunday,
			    $this->m_directionOnCelebrity,
			    $this->m_directionOnHoliday,
			    $this->m_directionOnImpossible
			    );

	  } else {

	      // parental initialization

	      parent::__construct(
			    $start_date,
			    $end_date,
			    $language,
			    $directionOnSaturday,
			    $directionOnSunday,
			    $directionOnCelebrity,
			    $directionOnHoliday,
			    $directionOnImpossible
			    );

	  }

    }   // constructor


/*
    public function cDateStrategyNoInterval( $str = null ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str == null) {
                $this->Reset( );
            } else {
                $this->FromString( $str ) ;
            }
    }   // constructor
*/

    /**
      * The method Reset( $n ) resets the internal values for week numbers and week day numbers
      *
      * @see Reset
      * @see ResetMonthDays
      * @see ResetMonths
      *
      */

    public function Reset( ) {

        parent::Reset();

        $this->m_dates = array();
        $this->m_count = 0;

    }

    /**
      * The method AddDate( ) adds a date $date_obj to the managed dates
      *
      * If the starting date is not null and $date_obj is less than the starting date, than $date_obj will not be added.
      * If the ending date is not null and $date_obj is gretaer than the ending date, than $date_obj will not be added.
      *
      * @param cDate $date_obj is the date to add
      *
      * @return bool true, if $date_obj was added
      *
      * @see AddDate
      * @see ContainsDate
      *
      */

    public function AddDate( $date_obj ) {

	if ( ! is_null( $this->m_start_date ) && ( $date_obj->lt( $this->m_start_date ) )  ) return false;
	if ( ! is_null( $this->m_end_date ) && ( $date_obj->gt( $this->m_end_date ) )  ) return false;

	$this->m_dates[] = new cDate($date_obj);
	$this->m_count++;
	$this->SortArray( );

	return true;

    }

    /**
      * The method ContainsDate( ) returns true, if the date $dt is among the managed dates
      *
      * @param cDate $dt is the date to test for existence
      *
      * @return bool true, if $dt is among the managed dates
      *
      * @see AddDate
      * @see ContainsDate
      *
      */

    public function ContainsDate( $dt ) {

        for ($i=0; $i< sizeof($this->m_dates); $i++) {
            if ($this->m_dates[$i]->eq( $dt )) { return true; }
        }

        return false;

    }


    /**
      * The method GetFollower( ) returns the follower of $dt or null.
      *
      * The follower is the date, which comes chronically after $dt
      *
      * @param cDate $dt is the date, for which the follower should be searched
      *
      * @return cDate|null the date, which follows after $dt
      *
      * @see AddDate
      * @see ContainsDate
      * @see GetNextDate
      * @see GetFirstDate
      * @see IsDate
      *
      */

    public function GetFollower( & $dt, & $dt_next, $direction = self::DIRECTION_FORWARD ) {

	$dt_next = null;


	if ( $direction == self::DIRECTION_FORWARD ) {

	    for ( $i = 0; $i < sizeof( $this->m_dates ); $i++) {

    echo "\n vgl fw " . $this->m_dates[ $i ]->AsSQL() . ' mit ' . $dt->AsSQL();
		if ( $this->m_dates[ $i ]->ge( $dt )) {
		    if ( $i == count( $this->m_dates ) - 1 ) {
			$dt = null;
			if ( $this->m_debug ) echo "\n forward search results in null (1)";
			break;
		    }
		    $dt = new cDate( $this->m_dates[ $i + 1 ] );
		    $dt_next = new cDate( $this->m_dates[ $i + 1 ] );
		    break;
		}

		if ( $i == count( $this->m_dates ) ) {
		    if ( $this->m_debug ) echo "\n forward search results in null (2)";
		    $dt = null;
		}

	    }


	} else	if ( $direction == self::DIRECTION_BACKWARD ) {

	    for ( $i = sizeof( $this->m_dates ) - 1; $i >= 0; $i-- ) {

    echo "\n vgl bw " . $this->m_dates[ $i ]->AsSQL() . ' mit ' . $dt->AsSQL();

		if ( $this->m_dates[ $i ]->le( $dt )) {
		    if ( $i == 0 ) {
			if ( $this->m_debug ) echo "\n backwards search results in null (2)";
			$dt = null;
			break;
		    }
		    $dt = new cDate( $this->m_dates[ $i - 1 ] );
		    $dt_next = new cDate( $this->m_dates[ $i - 1 ] );
		    break;
		}

		if ( $i == 0 ) {
		    if ( $this->m_debug ) echo "\n backwards search results in null (2)";
		    $dt = null;
		}


	    }


	}

    }	// functiom GetFollower( )

    /**
      * The method FromString( ) reads the specifications of the strategy from the string $str
      * The template starts with 's9' and is normally made by AsString( ). The
      * string template can be used for serialization.
      *
      * The calendars for celebrities and holidays remain untouched.
      *
      * @param string $str the specifications as string as we get it via AsString( )
      *
      * @see FromString
      * @see AsString
      */

    public function FromString( $str ) {

        # echo "<br>" . $str;

        sscanf( $str, "s9-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d-",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $this->m_count
            );

        $this->m_start_date->SetDate($startmonth, $startday, $startyear );

        if ($endday==0) {
            $this->m_end_date = null;
        } else {
            $this->m_end_date = new cDate($endmonth, $endday, $endyear );
        }

        $str2 = $str;
        $pos = 0;
        $pos2 = 0;
        $day = 0; $month = 0; $year=0;
        $this->m_dates = array();

        for ( $i = 0; $i<5; $i++) {
            $pos = strpos  ( $str2  , "-"  , 0 );
            $str2 = substr( $str2, $pos+1);
            # print "<br>" . $str2;
        }

        # echo "<br>" . $this->m_count . " occurences ";

        for ( $i = 0; $i<$this->m_count; $i++) {
            sscanf( $str2, "(%d.%d.%d)", $day, $month, $year);
            $dt = new cDate( $month, $day, $year );
            $this->m_dates[] = $dt;
            # echo "<br>am $day.$month.$year ->".$dt->AsDMY();
            $pos = strpos  ( $str2  , "-"  , 0 );
            $str2 = substr( $str2, $pos+1);
            # print "<br>" . $str2;
        }

        $this->SortArray( );
        # $this->OutAry();


    }   // function FromString


    /**
      * The method AsString( ) returns the specifications of the strategy as a string template. It normally is used
      * by the constructor or by FromString for serialization.
      *
      * @return string the specifications as string template
      *
      *
      * @see FromString
      * @see AsString
      *
      */

    public function AsString( ) {

        if ( $this->m_end_date == null ){
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->m_end_date->Day();
            $endmonth = $this->m_end_date->Month();
            $endyear = $this->m_end_date->Year();
        }

        $str = sprintf(
            "s9-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $this->m_start_date->Day(), $this->m_start_date->Month(), $this->m_start_date->Year(),
            $endday, $endmonth, $endyear,
            $this->m_count
            );

        for ( $i = 0; $i<$this->m_count; $i++) {
            $day = $this->m_dates[$i]->Day();
            $month = $this->m_dates[$i]->Month();
            $year = $this->m_dates[$i]->Year();
            $str .= "-($day.$month.$year)";
        }

        return $str;

    }   // function AsString


    /**
      * The method IsValid( ) returns true, if the calculations can start.
      * In order to run, at least one week number and one week day number have to be set before.
      *
      * @see AddMonth
      * @see AddMonthDay
      *
      */


    public function IsValid() {    // NOTE : TODO !
        return true;
    }

/*


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
*/

    /**
      * The sorter function for the dates array
      *
      * @see __cmp_dates
      * @see SortArray
      *
      */


    static function __cmp_dates( $d1, $d2 ) {

	return ( $d1->gt( $d2 ) );

    }

    /**
      * The method SortArray sorts the the array of dates
      *
      * @see __cmp_dates
      * @see SortArray
      *
      */


    protected function SortArray( ) {


	usort( $this->m_dates, array("\libdatephp\cDateStrategyNoInterval", "__cmp_dates") );


    }	// function SortArray( )


    /**
      * The method GetNextDate( ) returns the follower of $date_start or null.
      *
      * The follower is the date, which comes chronically after $dt
      *
      * @param cDate $date_start is the date, for which the follower should be searched
      * @param bool $date_is_first is true, when this is the first run
      *
      * the list is traversed item by item. If the date $date_start is less than the internal date compared to it, then the compared date is returned.
      *
      * @return cDate|null the date, which follows after $date_start
      *
      * @see AddDate
      * @see ContainsDate
      * @see GetNextDate
      * @see GetFirstDate
      * @see IsDate
      *
      */

    public function GetNextDate( $date_start, $date_is_first = true  ) {

        for ( $i=0; $i<$this->m_count; $i++ ) {
            if ( ( $date_start->eq( $this->m_dates[$i] ) ) && ( $date_is_first ) ) { return new cDate( $this->m_dates[$i] ); }
            if ( $date_start->lt( $this->m_dates[$i] ) ) { return new cDate( $this->m_dates[$i] ); }
        }

        return null;

    }   // function GetNextDate

    /**
      * The method GetFirstDate( ) returns the oldest date in the list.
      *
      * @return cDate|null the date, which follows after $date_start
      *
      * @see AddDate
      * @see ContainsDate
      * @see GetNextDate
      * @see GetFirstDate
      * @see IsDate
      *
      */


    public function GetFirstDate( ) {

        $dt = new cDate( $this->m_dates[0]);

        for ($i=0;$i<$this->m_count; $i++){
            if ($this->m_dates[$i]->lt($dt)) { $dt = new cDate($this->m_dates·[$i]); }
        }

        return $dt;

    }   // function GetFirstDate()

    /**
      * The method IsDate( ) returns true, if $date_obj is an element of the managed dates.
      *
      * @param cDate $date_obj the date, which should be searched
      *
      * @return bool returns true, if $date_obj is part of the array of dates mananged by the class.
      *
      * @see AddDate
      * @see ContainsDate
      * @see GetNextDate
      * @see GetFirstDate
      * @see IsDate
      *
      */

    public function IsDate( $date_obj ) {


        for ($i=0;$i<$this->m_count; $i++){
            if ($this->m_dates[$i]->eq($date_obj)) { return true; }
        }

        return false;

    }   // function IsDate

    /**
      * @deprecated
      *
      */


    public function FromForm(  ) {

        $ary = $_POST['dates_30'];
        $dt = new cDate;

        $radiostrategy = $_POST['strategy'];
        $dt = new cDate();

        // assert ($radiostrategy == 's9_no_interval');

        if ($radiostrategy == 's9_no_interval') {

            $this->m_count = 0;

            for ($i=0;$i<sizeof($ary); $i++) {
                // echo "<br>" . $ary[$i];
                if (trim($ary[$i]) != '') {
                    $dt = new cDate();
                    $dt->FromDMY( $ary[$i]);
                    $this->m_dates[] = $dt;
                    $this->m_count++;
                    // echo "<br>" . $dt->AsDMY();
                }
            }

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
            $this->SortArray( );
            # $this->OutAry();
            if ($this->m_dates[0]->lt($this->m_start_date)) {
                $this->m_start_date = new cDate( $this->m_dates[0] );
            }
        }
    }   // function FromForm

    /**
      * @deprecated
      *
      */


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
    $ary = $this->m_dates;
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


    /**
      * The method GetNextEventSlot(  ) returns the next date AFTER $obj_date, WITHOUT checking for special situations or
      * whether the date fits into the strategies' boundaries.
      *
      * @param cDate $obj_date a cDate object, which is the starting point for the next calculation
      * @param int $direction the constant, which indicates the search direction. It defaults to DIRECTION_FORWARD
      *
      * @return cDate cDate object with the next fitting date
      *
      * @see GetFollower
      * @see GetFirstDate
      * @see DIRECTION_BACKWARD
      * @see DIRECTION_FORWARD
      *
      */


    public function GetNextEventSlot( $obj_date, $direction = self::DIRECTION_FORWARD ) {

        assert( is_int( $direction ) );

        assert( is_a( $obj_date, '\\libdatephp\\cDateISO' ) || is_a( $obj_date, '\\libdatephp\\cDate' ) );

        $obj_date_ret = null;

	if ( $this->m_debug ) echo "\n GetNextEventSlot( ) starts with " . $obj_date->AsSQL( ) . ' direction is ' . ( $direction == self::DIRECTION_FORWARD ? ' forward' : 'backward');

	if ( $direction == self::DIRECTION_FORWARD) {

	    for ( $i = 0; $i < count( $this->m_dates ); $i++ ){
	    echo "\n vgl mit " . $this->m_dates[ $i ]->AsSQL( ) ;
		if ( $obj_date->gt( $this->m_dates[ $i ] ) ) {
		    $obj_date_ret = $this->m_dates[ $i ];
		    if ( $this->m_debug ) echo "\n found " . $obj_date_ret->AsSQL( );
		}
	    }

	} else {

	    for ( $i = count( $this->m_dates ) - 1; $i >= 0; $i-- ){
		if ( $obj_date->lt( $this->m_dates[ $i ] ) ) {
		    $obj_date_ret = $this->m_dates[ $i ];
		    if ( $this->m_debug ) echo "\n found " . $obj_date_ret->AsSQL( );
		}
	    }

	}

	if ( $this->m_debug ) echo "\n skipped to " . $obj_date->AsSQL( );


	assert( ! is_null( $obj_date_ret ) );

	if ( $this->m_debug ) echo "\n GetNextEventSlot( ) returns " . $obj_date_ret->AsSQL( );

	return $obj_date_ret;

    }	// functiom GetNextEventSlot( )



}       // of class cDateStrategyNoInterval

?>