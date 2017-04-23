<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategyDailyFixed.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategyDailyFixed' erweitert 'cDateStrategy' um eine Terminwiederholung einem fixen Tag in einem bestimmten Zeitraum
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
//		_POST['s3_day']
//		_POST['s3_select']
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
//	class cDateStrategyDailyFixed
//		public method AsString()
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetDayNumber()
//		public method GetFirstDate()
//		public method GetFollower($date)
//		public method GetNextEventDate($datestart,$dateisfirst=true)
//		public method GetPeriodType()
//		public method IsValid()
//		public method Reset()
//		public method SetDayNumber($set)
//		public method SetPeriodType($set)
//		public method cDateStrategyDailyFixed($str=undef)
//		protected var $dayNumber
//		protected var $typePeriod
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?><?php

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategyDailyFixed
////////////////////////////////////////////////////////////////////////////////////

namespace libdatephp;


define ("FIX_DAY_MONTH", 0);
define ("FIX_DAY_QUARTER", 1);
define ("FIX_DAY_YEAR", 2);

class cDateStrategyDailyFixed extends cDateStrategy {

    // bestimmter fixer Tag in einem bestimmten Zeitraum

    protected $dayNumber = 1;
    protected $typePeriod = FIX_DAY_MONTH;

    public function cDateStrategyDailyFixed( $str = undef ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str==undef ) {
                $this->Reset();;
            } else {
                $this->FromString( $str ) ;
            }

            $this->IsValid();

    }   // constructor

    public function Reset() {

        parent::Reset();

        $this->dayNumber = 1;
        $this->typePeriod = FIX_DAY_MONTH;

    }


    public function IsValid( ) {

        # if ( ! ($this->onMonday+$this->onTuesday+$this->onWednesday+$this->onThursday+$this->onFriday+$this->onSaturday+$this->onSunday)) {
          #  die("wenigstens ein Wochentag mu&szlig; gesetzt sein !");
        # }

        return true;

    }       // function IsValid()

    public function FromString( $str ) {
/*
        sscanf( $str, "s1-%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-(%d.%d.%d)",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $day, $month, $year
            );
*/
        sscanf( $str, "s3-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d-p%d",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $this->dayNumber, $this->typePeriod );

        # echo "<br> FromString : s3-$this->dayNumber-p$this->typePeriod";

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

        return sprintf( "s3-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d-p%d",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $this->m_start_date->Day(), $this->m_start_date->Month(), $this->m_start_date->Year(),
            $endday, $endmonth, $endyear,
            $this->dayNumber, $this->typePeriod );

    }   // function AsString

    public function FromForm(  ) {

    # $_POST[strategy] = s3_fixeddates
    # $_POST[s3_day] = 5
    # $_POST[s3_select] = quarter

        $radiostrategy = $_POST['strategy'];

        $days = $_POST['s3_day'];
        $period = $_POST['s3_select'];

        // assert ($radiostrategy == 's3_fixeddates');

        if ($radiostrategy == 's3_fixeddates') {

            $this->SetDayNumber( $days );

            if ( $period == "quarter" ) { $this->SetPeriodType( FIX_DAY_QUARTER ); }
            elseif ( $period == "month" ) { $this->SetPeriodType( FIX_DAY_MONTH ); }
            elseif ( $period == "year" ) { $this->SetPeriodType( FIX_DAY_YEAR ); }
            else die("<br>cDateStrategyDailyFixed::FromForm : unbekannter Zeitraum");

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
        }

    }   // function FromForm

    public function FillForm( $checked = false ) {

        $msgNachFixenTagen = $this->id2msg( 1020 );
        $msgAm = $this->id2msg( 1021 );
        $msgtenTag = $this->id2msg( 1022 );
        $msgMonat = $this->id2msg( 1023 );
        $msgQuartal = $this->id2msg( 1024 );
        $msgJahr = $this->id2msg( 1025 );

        $check = ( $checked ) ? " checked " : "";

        echo "<tr><td><input type=radio name = 'strategy' value='s3_fixeddates' $check>$msgNachFixenTagen</td>";
        echo "<td>";
            $nth = $this->dayNumber;
            echo " $msgAm <input name = s3_day size=3 value = '$nth'>$msgtenTag ";

            $pt = $this->typePeriod;
            echo "<select name=s3_select>";
                $sel = ( ($pt == FIX_DAY_MONTH ) ? "selected=1" : '' );
                echo "<option value=month $sel >$msgMonat";
                $sel = ( ($pt == FIX_DAY_QUARTER ) ? "selected=1" : '' );
                echo "<option value=quarter $sel>$msgQuartal";
                # echo "<option value=halfyear>Halbjahr";
                $sel = ( ($pt == FIX_DAY_YEAR ) ? "selected=1" : '' );
                echo "<option value=year $sel>$msgJahr";
            echo "</select>";
        echo "</td></tr>";

    }   // function FillForm

    public function SetDayNumber( $set ) {
        $this->dayNumber = $set;
    }

    public function GetDayNumber( ) {
        return $this->dayNumber;
    }


    public function SetPeriodType( $set ) {
        $this->typePeriod = $set;
    }

    public function GetPeriodType( ) {
        return $this->typePeriod;
    }


    function GetFollower( $date ) {
        // $dateObj muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen

        $dateObj = new cDate( $date);
        $fertig = false;
        $ret = undef;

        if ( $this->typePeriod == FIX_DAY_MONTH ) {
            $month = $dateObj->Month();
            $year = $dateObj->Year();
            $day = $dateObj->Day();
            # echo "<br>Tag = $day Monat = $month Jahr = $year ->" . $dateObj->AsDMY();

            if ( $month == 12 ) {
                $month = 1;
                $year ++;
                $ret = new cDate( $month, $this->dayNumber, $year );
            } else {
                # echo "<br>Normales Datum : " . $dateObj->AsDMY();
                $month ++;
                $ret = new cDate( $month, 1, $year);
                if ( $day > $ret->LOM() ) {
                    $diff = (int)($day - $ret->LOM());
                    # echo "<br>Monatstage =" . $ret->LOM() . " diff = ".$diff;
                    $month++;
                    # echo "<br>neues Datum sollwerden $diff.$month.$year";
                    assert( is_int( $year ) );
                    assert( is_int( $month ) );
                    assert( is_int( $diff ) );
                    $ret = new cDate( $month, $diff, $year );
                } else {
                    $ret = new cDate( $month, $this->dayNumber, $year );
                }
            }
        } elseif ( $this->typePeriod == FIX_DAY_QUARTER ) {
            $quarter = $dateObj->NOQ();
            $year = $dateObj->Year();

            # echo "<br>Quartal = $quarter Jahr = $year ->" . $dateObj->AsDMY() . "daynumber = ".$this->dayNumber;

            if ( $quarter == 4 ) {
                $quarter = 1;
                $year ++;
                $quarterstart = new cDate( 1, 1, $year);
                $quarterstart ->Skip( $this->dayNumber );
                $quarterstart->dec();
                $ret = new cDate( $quarterstart );
            } else {
                $dateObj->GoEOQ();
                $dateObj->inc();
                $dateObj->Skip( $this-> dayNumber);
                $dateObj->dec();
                $ret = new cDate( $dateObj );

            }

        }  elseif ( $this->typePeriod == FIX_DAY_YEAR ) {
            $year = $dateObj->Year();

            # echo "<br>Jahr = $year ->" . $dateObj->AsDMY() . "daynumber = ".$this->dayNumber;

            $dateObj->GoEOY();
            $dateObj->Skip( $this->dayNumber );
            $ret = new cDate( $dateObj );
        }

        # echo "<br>GetFollower liefert : " . $ret->AsDMY();
        return $ret;

    }       // function GetFollower()

    public function GetNextEventDate( $datestart, $dateisfirst = true  ) {

        if ( $this->IsUnderflow( $datestart ) ) {echo "IsUnderflow"; return undef; }
        if ( $this->IsOverflow( $datestart ) ) return undef;

        $dt = $this->GetFirstDate( );

        # echo "<br> GetNextEventDate() : erster Termin ist am " . $dt->AsDMY();

        if ( ($dateisfirst == true ) && ($datestart->eq($dt)) ) { return $dt; }

        $fertig = false;

        do {
            $dt = $this->GetFollower( $dt );
            # echo "<br> GetNextEventDate() : untersuche " . $dt->AsDMY();
            if ( $datestart->eq( $dt ) && ( $dateisfirst ) ) return $dt;
            if ( $this->IsOverflow( $dt ) ) {  return undef; }
            if ( $datestart->lt( $dt ) ) return $dt;
        } while ( !$fertig);

        return undef;

    }   // function GetNextEventDate

    public function GetFirstDate( ) {

        if ( $this->typePeriod == FIX_DAY_YEAR ) {
            $dateObj =new cDate($this->m_start_date);
            $dateObj->GoBOY();
            $dateObj->dec();
            $dateObj->Skip( $this->dayNumber);
            return $dateObj;
        } elseif  ( $this->typePeriod == FIX_DAY_QUARTER ) {
            $dateObj =new cDate($this->m_start_date);
            $dateObj->GoBOQ();
            $dateObj->Skip( $this->dayNumber);
            $dateObj->dec();
            return $dateObj;
        } elseif  ( $this->typePeriod == FIX_DAY_MONTH ) {
            $dateObj =new cDate($this->m_start_date);
            # echo "<br>dateObj = " . $dateObj->AsDMY();
            # echo "<br>startdate = " . $this->m_start_date->AsDMY();
            $dateObj->GoBOM();
            # echo "<br>GoBOM() liefert " . $dateObj->AsDMY();
            $dateObj->Skip( $this->dayNumber);
            $dateObj->dec();
            return $dateObj;
        }

        return undef;

    }   // function GetFirstDate



}       // of class cDateStrategyDailyFixed
?>