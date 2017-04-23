<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategyWeekly.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategyWeekly' erweitert 'cDateStrategy' um wöchentlich wiederkehrende Termine
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
//		_POST['enddate']
//		_POST['s2_eachweek']
//		_POST['s2_friday']
//		_POST['s2_monday']
//		_POST['s2_saturday']
//		_POST['s2_sunday']
//		_POST['s2_thursday']
//		_POST['s2_tuesday']
//		_POST['s2_wednesday']
//		_POST['startdate']
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
//	no functions were found
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
//	class cDateStrategyWeekly
//		public method AsString()
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($date)
//		public method GetFriday($set)
//		public method GetMonday($set)
//		public method GetSaturday($set)
//		public method GetSunday($set)
//		public method GetThursday($set)
//		public method GetTuesday($set)
//		public method GetWednesday($set)
//		public method GetWeeks()
//		public method IsValid()
//		public method Reset()
//		public method SetFriday($set)
//		public method SetMonday($set)
//		public method SetSaturday($set)
//		public method SetSunday($set)
//		public method SetThursday($set)
//		public method SetTuesday($set)
//		public method SetWednesday($set)
//		public method SetWeeks($set)
//		public method cDateStrategyWeekly($str=undef)
//		protected var $nWeeks
//		protected var $onFriday
//		protected var $onMonday
//		protected var $onSaturday
//		protected var $onSunday
//		protected var $onThursday
//		protected var $onTuesday
//		protected var $onWednesday
//		protected method GetLatestDayNumber()
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?><?php

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategyWeekly
////////////////////////////////////////////////////////////////////////////////////

namespace libdatephp;

class cDateStrategyWeekly extends cDateStrategy {

    // bestimmte Wochentage alle x Wochen

    protected $onMonday = 0;
    protected $onTuesday = 0;
    protected $onWednesday = 0;
    protected $onThursday = 0;
    protected $onFriday = 0;
    protected $onSaturday = 0;
    protected $onSunday = 0;

    protected $nWeeks = 1;

    public function cDateStrategyWeekly( $str = undef ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str == undef ) {
                $this->Reset();
            } else {
                $this->FromString( $str ) ;
            }

            $this->IsValid();

    }   // constructor

    public function Reset() {

        parent::Reset();

        $this->onSunday = 0;
        $this->onMonday = 0;
        $this->onTuesday = 0;
        $this->onWednesday = 0;
        $this->onThursday = 0;
        $this->onFriday = 0;
        $this->onSaturday = 0;

        $this->nWeeks = 1;

    }

    public function GetWeeks() {
        return $this->nWeeks;
    }

    public function IsValid( ) {

        return ( ! ($this->onMonday+$this->onTuesday+$this->onWednesday+$this->onThursday+$this->onFriday+$this->onSaturday+$this->onSunday));

    }       // function IsValid()

    public function FromString( $str ) {

        sscanf( $str, "s2-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d:%d:%d:%d:%d:%d:%d-w%d",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $this->onMonday, $this->onTuesday, $this->onWednesday, $this->onThursday, $this->onFriday, $this->onSaturday, $this->onSunday,
            $this->nWeeks );

        $this->m_start_date->SetDate($startmonth, $startday, $startyear );

        if ($endday==0) {
            $this->m_end_date = undef;
        } else {
            $this->m_end_date = new cDate($endmonth, $endday, $endyear );
        }

        $this->IsValid();

    }   // function FromString

    public function AsString( ) {

        if ( $this->m_end_date == undef ){
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->m_end_date->Day();
            $endmonth = $this->m_end_date->Month();
            $endyear = $this->m_end_date->Year();
        }

        return sprintf( "s2-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d:%d:%d:%d:%d:%d:%d-w%d",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $this->m_start_date->Day(), $this->m_start_date->Month(), $this->m_start_date->Year(),
            $endday, $endmonth, $endyear,
            $this->onMonday, $this->onTuesday, $this->onWednesday, $this->onThursday, $this->onFriday, $this->onSaturday, $this->onSunday, $this->nWeeks );
    }   // function AsString

    public function FromForm(  ) {

    // $_POST[s2_eachweek] = 1
    // $_POST[s2_tuesday] = on

        parent::FromForm();

        $radiostrategy = $_POST['strategy'];
        $dt = new cDate();

        $strstartdate = $_POST['startdate'];
        $strenddate = $_POST['enddate'];

        //         assert ($radiostrategy == 's2_weekly');

        if ($radiostrategy == 's2_weekly') {

            $this->SetMonday    (isset($_POST['s2_monday']));
            $this->SetTuesday   (isset($_POST['s2_tuesday']));
            $this->SetWednesday (isset($_POST['s2_wednesday']));
            $this->SetThursday  (isset($_POST['s2_thursday']));
            $this->SetFriday    (isset($_POST['s2_friday']));
            $this->SetSaturday  (isset($_POST['s2_saturday']));
            $this->SetSunday    (isset($_POST['s2_sunday']));

            $this->SetWeeks( $_POST['s2_eachweek'] );

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
        }

    }   // function FromForm



    public function FillForm( $checked = false ) {

        $msgNachWochentagen = $this->id2msg( 1010 );
        $msgMontag = $this->id2msg( 1011 );
        $msgDienstag = $this->id2msg( 1012 );
        $msgMittwoch = $this->id2msg( 1013 );
        $msgDonnerstag = $this->id2msg( 1014 );
        $msgFreitag = $this->id2msg( 1015 );
        $msgSamstag = $this->id2msg( 1016 );
        $msgSonntag = $this->id2msg( 1017 );
        $msgAlle = $this->id2msg( 1018 );
        $msgWochenAm = $this->id2msg( 1019 );

        $check = ( $checked ) ? " checked " : "";

        echo "<tr><td><input type=radio name = 'strategy' value='s2_weekly' $check>$msgNachWochentagen</td>";
        echo "<td>";

            $rep = $this-> nWeeks;
            echo " $msgAlle <input name = s2_eachweek value = '$rep' size=3> $msgWochenAm ";

            $chk = ( $this->onMonday ? 'checked' : '' );
            echo "<input type=checkbox name=s2_monday $chk>$msgMontag";
            $chk = ( $this->onTuesday ? 'checked' : '' );
            echo "<input type=checkbox name=s2_tuesday $chk>$msgDienstag";
            $chk = ( $this->onWednesday ? 'checked' : '' );
            echo "<input type=checkbox name=s2_wednesday $chk>$msgMittwoch";
            $chk = ( $this->onThursday ? 'checked' : '' );
            echo "<input type=checkbox name=s2_thursday $chk>$msgDonnerstag";
            $chk = ( $this->onFriday ? 'checked' : '' );
            echo "<input type=checkbox name=s2_friday $chk>$msgFreitag";
            $chk = ( $this->onSaturday ? 'checked' : '' );
            echo "<input type=checkbox name=s2_saturday $chk>$msgSamstag";
            $chk = ( $this->onSunday ? 'checked' : '' );
            echo "<input type=checkbox name=s2_sunday $chk>$msgSonntag";
        echo "</td></tr>";

    }   // function FillForm

    public function SetMonday( $set ) {
        $this->onMonday = $set;
    }

    public function SetTuesday( $set ) {
        $this->onTuesday = $set;
    }

    public function SetWednesday( $set ) {
        $this->onWednesday = $set;
    }

    public function SetThursday( $set ) {
        $this->onThursday = $set;
    }

    public function SetFriday( $set ) {
        $this->onFriday = $set;
    }

    public function SetSaturday( $set ) {
        $this->onSaturday = $set;
    }

    public function SetSunday( $set ) {
        $this->onSunday = $set;
    }

    public function GetMonday( $set ) {
        return $this->onMonday;
    }

    public function GetTuesday( $set ) {
        return $this->onTuesday;
    }

    public function GetWednesday( $set ) {
        return $this->onWednesday;
    }

    public function GetThursday( $set ) {
        return $this->onThursday;
    }

    public function GetFriday( $set ) {
        return $this->onFriday;
    }

    public function GetSaturday( $set ) {
        return $this->onSaturday;
    }

    public function GetSunday( $set ) {
        return $this->onSunday;
    }

    public function SetWeeks( $set ) {
        $this->nWeeks = $set;
    }

    protected function GetLatestDayNumber( ) {
        // liefere die am höchsten geschaltete Tagesnummer

        if ($this->onSaturday) return 6;
        if ($this->onFriday) return 5;
        if ($this->onThursday) return 4;
        if ($this->onWednesday) return 3;
        if ($this->onTuesday) return 2;
        if ($this->onMonday) return 1;
        if ($this->onSunday) return 0;
    }

// TODO : Fehler, wenn kein Wochentag gesetzt wurde !

    public function GetFollower( $date ) {
        // $dateObj muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen

        # echo "<br>GetFollower(".$date->AsDMY(). ") : GetLatestDayNumber() ergibt " . $this->GetLatestDayNumber();

        $dateObj = new cDate( $date);
        $fertig = false;

        do {
            if ( $dateObj->DOW() == $this->GetLatestDayNumber( ) ) {
                $dateObj->Skip( $this->nWeeks * 7 );
                $dateObj->GoBOW();
            } else {
                $dateObj->Skip(1);
            }

            # echo "<br>GetFollower(".$date->AsDMY().") : neues Testdatum = " . $dateObj->AsDMY();

            if ( ( $dateObj->IsSunday() ) && ( $this->onSunday ) ) { return $dateObj; }
            if ( ( $dateObj->IsMonday() ) && ( $this->onMonday ) ) { return $dateObj; }
            if ( ( $dateObj->IsTuesday() ) && ( $this->onTuesday ) ) { return $dateObj; }
            if ( ( $dateObj->IsWednesday() ) && ( $this->onWednesday ) ) { return $dateObj; }
            if ( ( $dateObj->IsThursday() ) && ( $this->onThursday ) ) { return $dateObj; }
            if ( ( $dateObj->IsFriday() ) && ( $this->onFriday ) ) { return $dateObj; }
            if ( ( $dateObj->IsSaturday() ) && ( $this->onSaturday ) ) { return $dateObj; }

            $fertig = $this->IsOverflow( $dateObj );

        } while ( !$fertig );

        return undef;
    }       // function GetFollower()


    public function GetFirstDate( ) {

        $dateObj =new cDate($this->m_start_date);

        for ( $i = 0; $i<7; $i++ ) {
            if ( $i >0 ) $dateObj->inc();
            # echo "<br>GetFirstDate() untersucht " . $dateObj->AsDMY();
            if ( $dateObj->IsSunday( ) && ( $this->onSunday) ) {  return $dateObj; }
            if ( $dateObj->IsMonday( ) && ( $this->onMonday) ) { return $dateObj; }
            if ( $dateObj->IsTuesday( ) && ( $this->onTuesday ) ) { return $dateObj; }
            if ( $dateObj->IsWednesday( ) && ( $this->onWednesday ) ) { return $dateObj; }
            if ( $dateObj->IsThursday( ) && ( $this->onThursday ) ) { return $dateObj; }
            if ( $dateObj->IsFriday( ) && ( $this->onFriday) ) { return $dateObj; }
            if ( $dateObj->IsSaturday( ) && ( $this->onSaturday) ) { return $dateObj; }
            if (  ($this->m_end_date != undef ) && ( $this->m_end_date->lt( $dateObj ) ) ) return undef;
        }

        return undef;

    }   // function GetFirstDate



}       // of class cDateStrategyWeekly

?>