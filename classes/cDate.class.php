<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDate.class.php
//  Language      : php
//  Description   : Die Klasse 'cDate' dient der Verwaltung eines Datumwertes
//  Project       : libdatephp
//  Project Site  : https://github.com/rstoetter/libdatephp
//  Project wiki  : https://github.com/rstoetter/libdatephp/wiki
//  Created by    : Rainer Stötter ( rstoetter@users.sourceforge.net )
//  Copyright (c) : 2007 - 2017, Rainer Stötter, All rights reserved
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  License: MIT
//
//  This file has been released under the MIT license
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Requests]]
//
//
//	no requests were found
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
//	class cDate
//		public method AddDays($diff)
//		public method AddMonths($diff)
//		public method AddWeeks($diff)
//		public method AddYears($diff=1)
//		public method AsAMPM()
//		public method AsDMY()
//		public method AsDMY0()
//		public method AsISO8601()
//		public method AsMDY()
//		public method AsMDY0()
//		public method AsRFC2822()
//		public method AsSQL()
//		public method AsSwatch()
//		public method AsTimeStamp()
//		public method AsUTC()
//		public method As_ampm()
//		public method BOM()
//		public method BOQ()
//		public method BOW()
//		public method BOY()
//		public method C_Month_Ger_Long()
//		public method C_Month_Ger_Short()
//		public method C_Weekday_Ger_Long()
//		public method C_Weekday_Ger_Short()
//		public method DOQ()
//		public method DOW()
//		public method DOY()
//		public method Day()
//		public method Day0()
//		public method Dec()
//		public method EOM()
//		public method EOQ()
//		public method EOW()
//		public method EOY()
//		public method FromDMY($str)
//		public method FromDate($obj)
//		public method FromMDY($str)
//		public method FromSQL($str)
//		public method FromTimestamp($ts)
//		public method GoBOM()
//		public method GoBOQ()
//		public method GoBOW()
//		public method GoBOY()
//		public method GoEOM()
//		public method GoEOQ()
//		public method GoEOW()
//		public method GoEOY()
//		public method InApril()
//		public method InAugust()
//		public method InDecember()
//		public method InFebruary()
//		public method InJanuary()
//		public method InJuly()
//		public method InJune()
//		public method InMarch()
//		public method InMay()
//		public method InNovember()
//		public method InOctober()
//		public method InSeptember()
//		public method Inc()
//		public method IsDST()
//		public method IsFriday()
//		public method IsLeapyear()
//		public method IsMonday()
//		public method IsSaturday()
//		public method IsSommerzeit()
//		public method IsSunday()
//		public method IsThursday()
//		public method IsTuesday()
//		public method IsWednesday()
//		public method IsWeekday()
//		public method IsWeekend()
//		public method LOM()
//		public method LOQ()
//		public method LOW()
//		public method LOY()
//		public method Month()
//		public method Month0()
//		public method NOQ()
//		public method NOW()
//		public method PrintOn($fptr)
//		public method Quarter()
//		public method ScanFrom($fptr)
//		public method SeekWeekday($weekday,$direction=0)
//		public method SetDate($m,$d,$y)
//		public method SetDay($d)
//		public method SetMonth($m)
//		public method SetTimeStamp($j)
//		public method SetToday()
//		public method SetYear($y)
//		public method Skip($count=1)
//		public method TimeStamp()
//		public method WOM()
//		public method WOY()
//		public method Weekday()
//		public method Year()
//		public method __construct($m=-1,$d=-1,$y=-1)
//		public method eq($cmp)
//		public method ge($cmp)
//		public method gt($cmp)
//		public method le($cmp)
//		public method lt($cmp)
//		protected var $m_day
//		protected var $m_dow
//		protected var $m_month
//		protected var $m_timestamp
//		protected var $m_year
//		private method CalculateWeekday()
//		private method mdy2ts()
//		private method ts2mdy()
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?><?php

namespace libdatephp;

// cDate.class.php

// class support

// allgemeine Strecken von Ostern aus gerechnet
#define		DIST_FASTNACHT		(-48)
#define		DIST_KARFREITAG		(-2)
#define		DIST_PFINGSTEN		(+49)
#define		DIST_FRONLEICHNAM	(+60)

// TODO:

//extern const cDate _dInvalid;	// a global invalid date
//extern const cDate cDate_MAX;	// highest date
//extern const cDate cDate_MIN;	// lowest date
//
//int between(const cDate& dCmp, const cDate& d1, const cDate& d2);
//int between ( const cDate & dCmp, const cDate & d1, const cDate & d2 );
//int compare ( const cDate &, const cDate & );
// void swap ( cDate &, cDate & );
//
// int IsFuture ( const cDate & );	// Datum>Systemdatum ?
// int IsPast ( const cDate & );	// Datum<Systemdatum ?
// int IsToday ( const cDate & );	// Datum==Systemdatum ?
//
// class cDate _max ( const cDate &, const cDate & );
// class cDate _min ( const cDate &, const cDate & );
//
// extern "C" int AddWeekdays ( cDate * , int );  // (n-1) Werktage weitergehen
//

// int setGerman ( int yesno );
// int setGerman ( void );
//	int DOW ( int day, int month, int year );

//	int MonthsBetween ( const cDate & d1, const cDate & d2 );
	 //
	 // full months between d1 and d2
	 //
//	int MonthChanges ( const cDate & d1, const cDate & d2 );
	 //
	 // month changes between d1 and d2
	 //

// cDate Easter ( int year );	// C linkage function cannot return C++ class 'cDate'

/*

                    class cDate
                    ============


    public function cDate( int $m, int $d, int $y) {
    public function cDate( int $timestamp) {
    public function cDate( cDate ) {
    public function cDate( ) {
    // ===============================================================
    private function mdy2ts ( )
    private function ts2mdy( ) {
    private function CalculateWeekday ( )
    // ===============================================================
    public function FromDate( $obj )
    public function FromTimestamp( $ts ) {
    public function SetDate($y, $m, $d ) {
    public function SetToday( ) {
    public function FromSQL( $str )
    public function FromMDY( $str ) {
    public function FromDMY( $str ) {
    public function SeekWeekday( $weekday, $direction = 0 ) {
    // ===============================================================
    public function SetDate($m, $d, $y ) {
    public function Month0( ){
    // Monat als Zahl, mit f&uuml;hrenden Nullen  01 bis 12
    public function Day0( ){
    // Tag als Zahl, mit f&uuml;hrenden Nullen  01 bis 31
    public function Year ( )
    public function SetYear ( int $y )
    public function Month ( )
    public function SetMonth ( int $m )
    public function Day ( )
    public function SetDay ( int $d )
    public function TimeStamp ( )
    public function SetTimeStamp ( int $j )
    public function Weekday ( )
    // zwischen 0 (f&uuml;r Sonntag) und 6 (f&uuml;r Samstag)
    public function DOW ( )
    // zwischen 0 (f&uuml;r Sonntag) und 6 (f&uuml;r Samstag)
    public function DOY ( )
    function Quarter( )
    public function NOQ() {
    public function DOQ() {
    public function NOW() {
    //  NOTE : ISO-8601 Wochennummer des Jahres, die Woche beginnt am Montag

    public function WOY() {
    //
    // Number of Week of year
    //
    //  NOTE : ISO-8601 Wochennummer des Jahres, die Woche beginnt am Montag
    //
    public function WOM() {
    //
    // Number of Week of month
    //

    public function IsDST( ) {
    public function IsSommerzeit() {
    public function IsLeapyear() {
    // ===============================================================
    public function AsSQL ( )
    public function AsMDY ( )
    public function AsDMY ( )
    public function AsDMY0 ( )
        // mit f&uuml;hrenden Nullen : 31.01.2008
    public function AsMDY0 ( )
        // mit f&uuml;hrenden Nullen : 01/31/2008
    public function AsTimeStamp ( )
        //
    public function AsUTC () {
        // -43200 bis 43200
    public function AsAMPM() {
    public function Asampm() {
    // Kleingeschrieben: Ante meridiem und Post meridiem  am oder pm
    public function AsSwatch() {
        // Swatch-Internet-Zeit  000 bis 999
    public function AsISO8601() {
        // 2004-02-12T15:19:21+00:00
    public function AsRFC2822() {
        // Beispiel: Thu, 21 Dec 2000 16:01:07 +0200

    // ===============================================================
    public function GoBOY ( )
    public function GoBOM ( )
    public function GoBOQ ( )
    public function GoBOW ( )
    public function GoEOY ( )
    public function GoEOM ( )
    public function GoEOQ ( )
    public function GoEOW ( )
    // ===============================================================
    public function Inc ( )
    public function Dec ( )
    public function Skip ( $count = 1 )
    // ===============================================================
    public function IsLeapYear ( )
    public function IsWeekday ( ) {
    public function IsWeekend ( ) {
    // ===============================================================
    public function eq( $cmp ) {
    public function lt( $cmp ) {
    public function gt( $cmp ) {
    public function ge( $cmp ) {
    public function le( $cmp ) {
    // ===============================================================
    public function BOW( ) {
    public function EOW( ) {
    public function BOM( ) {
    public function EOM( ) {
    public function BOQ( ) {
    public function EOQ( ) {
    public function BOY( ) {
    public function EOY( ) {
    // ===============================================================
    public function AddDays( $diff ) {
    public function AddWeeks( $diff ) {
    public function AddYears( $diff ) {
    public function AddMonths( $diff )

    // ===============================================================
    public function LOW();
    public function LOM();
    public function LOQ();
    public function LOY();


    // ===============================================================
    public function PrintOn( $fptr ) {
    public function ScanFrom( $fptr ) {

// ===============================================================


    public function IsSunday() {
    public function IsMonday() {
    public function IsTuesday() {
    public function IsWednesday() {
    public function IsThursday( ) {
    public function IsFriday( ) {
    public function IsSaturday() {

    public function InJanuary() {
    public function InFebruary() {
    public function InMarch() {
    public function InApril() {
    public function InMay() {
    public function InJune() {
    public function InJuly() {
    public function InAugust() {
    public function InSeptember() {
    public function InOctober() {
    public function InNovember() {
    public function InDecember() {


*/

$_ARY_WD_GER_SHORT = array(
    0 => "So",
    1 => "Mo",
    2 => "Di",
    3 => "Mi",
    4 => "Do",
    5 => "Fr",
    6 => "Sa"
);  // $_ARY_WD_GER_SHORT

$_ARY_WD_GER_LONG = array(
    0 => "Sonntag",
    1 => "Montag",
    2 => "Dienstag",
    3 => "Mittwoch",
    4 => "Donnerstag",
    5 => "Freitag",
    6 => "Saamstag"
);  // $_ARY_WD_GER_LONG

$_ARY_MONTH_GER_SHORT = array(
    1 => "Jan",
    2 => "Feb",
    3 => "Mrz",
    4 => "Apr",
    5 => "Mai",
    6 => "Jun",
    7 => "Jul",
    8 => "Aug",
    9 => "Sep",
   10 => "Okt",
   11 => "Nov",
   12 => "Dez"
);  // $_ARY_MONTH_GER_SHORT


$_ARY_MONTH_GER_LONG = array(
    1 => "Januar",
    2 => "Februar",
    3 => "M&auml;rz",
    4 => "April",
    5 => "Mai",
    6 => "Juni",
    7 => "Juli",
    8 => "August",
    9 => "September",
   10 => "Oktober",
   11 => "November",
   12 => "Dezember"
);  // $_ARY_MONTH_GER_LONG


class cDate {

    protected $m_year = -1;
    protected $m_month = -1;
    protected $m_day = -1;
    protected $m_timestamp = -1;
    protected $m_dow = -1;      // zwischen 0 (f&uuml;r Sonntag) und 6 (f&uuml;r Samstag)

    public function InJanuary() {
        return ( $this->Month() == 1);
    }

    public function InFebruary() {
        return ( $this->Month() == 2);
    }

    public function InMarch() {
        return ( $this->Month() == 3);
    }

    public function InApril() {
        return ( $this->Month() == 4);
    }

    public function InMay() {
        return ( $this->Month() == 5);
    }

    public function InJune() {
        return ( $this->Month() == 6);
    }

    public function InJuly() {
        return ( $this->Month() == 7);
    }

    public function InAugust() {
        return ( $this->Month() == 8);
    }

    public function InSeptember() {
        return ( $this->Month() == 9);
    }

    public function InOctober() {
        return ( $this->Month() == 10);
    }

    public function InNovember() {
        return ( $this->Month() == 11);
    }

    public function InDecember() {
        return ( $this->Month() == 12);
    }


    public function SeekWeekday( $weekday, $direction = 0 ) {

    // suche beginnend mit dem aktuellen Datum den übergebenen Wochentag
        while ($this->DOW() != $weekday) {
            if ( $direction== 0 ) {
                $this->inc();
            } else {
                $this->dec();
            }
        }
    }

    public function IsSunday() {
        return ( $this->DOW() == 0);
    }
    public function IsMonday() {
        return ( $this->DOW() == 1);
    }
    public function IsTuesday() {
        return ( $this->DOW() == 2);
    }
    public function IsWednesday() {
        return ( $this->DOW() == 3);
    }
    public function IsThursday( ) {
        return ( $this->DOW() == 4);
    }
    public function IsFriday( ) {
        return ( $this->DOW() == 5);
    }
    public function IsSaturday() {
        return ( $this->DOW() == 6);
    }

    public function DOQ() { // nth day of actual quarter
        $quarterstart = new cDate($this);
        $quarterstart->GoBOQ();
        # echo "<br>quarterstart = " . $quarterstart->AsDMY();
        $ret = (int) (( $this->AsTimeStamp() - $quarterstart->AsTimeStamp() )  /60 /60/24) +1;
        //$ret --;
        return $ret;
    }

// ---------------------------------------
    public function C_Weekday_Ger_Short( ) {
        return $_ARY_WD_GER_SHORT[ $this->Weekday() ];
    }

    public function C_Weekday_Ger_Long( ) {
        return $_ARY_WD_GER_LONG[ $this->Weekday() ];
    }

    public function C_Month_Ger_Short( ) {
        return $_ARY_MONTH_GER_SHORT[ $this->Month() ];
    }

    public function C_Month_Ger_Long( ) {
        return $_ARY_MONTH_GER_LONG[ $this->Month() ];
    }

// ---------------------------------------

    public function __construct( $m = -1, $d = -1, $y = -1) {

        if ( is_string( $m ) ) sscanf( $m, "%d", $m);
        if ( is_string( $d ) ) sscanf( $d, "%d", $d);
        if ( is_string( $y ) ) sscanf( $y, "%d", $y);

        # if (!is_a($m, 'libdatephp\cDate')) { echo "<br>cDate::cDate( $m, $d, $y)";}

        if ( is_a( $m, 'libdatephp\cDate' ) ) {
            $this->FromDate( $m );
        }  elseif ( is_int( $y ) && is_int( $m ) && is_int( $d ) ) {

            if ( ($y==-1) && ($m==-1) && ($d==-1) ) { // cDate()

                $this->SetToday();

            } elseif (($d == -1) && ($y == -1)) { // cDate( $timestamp)

                $this->FromTimestamp( $m );


            } else {            // cDate($y, $m, $sd)
                $this->SetDate($m, $d, $y);
            }
        }  else {
            # echo "<br>->$d.$m.$y ";
            // echo ">>".( is_int($y) . "-".is_int($m)."-" . is_int($d) ) ." --- ". $y . $m .$d. "d=".$d."y=".$y."m=".$m;
            // var_dump( debug_backtrace( ) );
            assert( true == false );
            die("\n cDate : Fehlerhafte Parameter '$m-$d-$y'");
        }

    }   // function cDate( $y, $m, $d)

    private function mdy2ts ( )
    {

        $this->m_timestamp =mktime(0, 0, 0, $this->m_month, $this->m_day, $this->m_year);
        $this->CalculateWeekday (  );

    }   //  function mdy2ts ( void )

    private function ts2mdy( ) {

        $datum = getdate( $this->m_timestamp );

        $this->m_day = $datum["mday"];
        $this->m_year = $datum["year"];
        $this->m_month = $datum["mon"];
        // echo "<br>" . $this->AsDMY();
        assert( checkdate($this->m_month, $this->m_day, $this->m_year ));

        // $this->mdy2ts ( );
        $this->CalculateWeekday( );

    }   // private function ts2mdy


    private function CalculateWeekday ( )
    {
        assert( checkdate($this->m_month, $this->m_day, $this->m_year ));

        $ary = getdate ( $this->m_timestamp );
        $this-> m_dow = $ary["wday"];
    }   // function CalculateWeekday ( )

// ===============================================================

    public function FromSQL( $str ) {
        // 2008-02-13

        // NOTE : F&uuml;hrende Leerzeichen k&ouml;nnen wegbleiben

        $s= '';
        $y = -1;
        $m = -1;
        $d = -1;

        for ($i = 0; $i <strlen($str); $i ++ ) {

            $chr = substr($str, $i, 1);
            // echo "Zeichen : $chr <br>";
            if ( $chr  == '-' ) {
                if ($y == -1) $y = (int) $s;
                elseif ($m == -1) $m = (int) $s;
                elseif ($d == -1) $d = (int) $s;

                $s = "";
            } else
                $s .= $chr;
        }

        $d = (int) $s;

        if ($y < 100) {
            if ($y>70) $y += 1900;
            else $y += 2000;
        }

        $this->SetDate( (int) $m, (int) $d, (int) $y );

    }

    public function FromMDY( $str ) {
        // 02/31/2008

        // NOTE : F&uuml;hrende Leerzeichen k&ouml;nnen wegbleiben

        $s= "";
        $y = -1;
        $m = -1;
        $d = -1;

        for ($i = 0; $i <strlen($str); $i ++ ) {

            $chr = substr($str, $i, 1);
            // echo "Zeichen : $chr <br>";
            if ( $chr  == '/' ) {
                if ($m == -1) $m = (int) $s;
                elseif ($d == -1) $d = (int) $s;
                elseif ($y == -1) $y = (int) $s;

                $s = '';
            } else
                $s .= $chr;
        }

        $y = (int) $s;

        if ($y < 100) {
            if ($y>70) $y += 1900;
            else $y += 2000;
        }

        $this->SetDate( (int) $m, (int) $d, (int) $y );

    }

    public function FromDMY( $str ) {
        // 31.1.2008

        // NOTE : F&uuml;hrende Leerzeichen k&ouml;nnen wegbleiben

        $s= "";
        $y = -1;
        $m = -1;
        $d = -1;

        for ($i = 0; $i <strlen($str); $i ++ ) {

            $chr = substr($str, $i, 1);
            // echo "Zeichen : $chr <br>";
            if ( $chr  == '.' ) {
                if ($d == -1) $d = (int) $s;
                elseif ($m == -1) $m = (int) $s;
                elseif ($y == -1) $y = (int) $s;

                $s = '';
            } else
                $s .= $chr;
        }

        $y = (int) $s;

        if ($y < 100) {
            if ($y>70) $y += 1900;
            else $y += 2000;
        }

        # echo "<br>$d.$m.$y<------";

        $this->SetDate(  $m,  $d,  $y );

    }



    public function FromDate( $obj ) {
        $this->m_timestamp = $obj->AsTimeStamp( );

        $this->ts2mdy( );
        $this->CalculateWeekday( );
    }   // public function FromDate

    public function FromTimestamp( $ts ) {
                $datum = getdate( $ts );

                $this->m_day = $datum["mday"];
                $this->m_year = $datum["year"];
                $this->m_month = $datum["mon"];

                // printf( "<br>FromTimestamp mit %s.%s.%s", $this->m_day, $this->m_month, $this->m_year);

                assert( checkdate($this->m_month, $this->m_day, $this->m_year ) );

                $this->mdy2ts ( );
                $this->CalculateWeekday( );

                // echo "<br>FromTimeStamp() nach mdy2ts() liefert " . $this->AsDMY();

                // assert( $this->AsTimeStamp() == $ts);  muß nicht übereinstimmen wegen der Sekunden, Minuten, Stunden

    }

// ===============================================================

    public function Month0( ){
    //
    // Monat als Zahl, mit f&uuml;hrenden Nullen  01 bis 12
    //
        return ( date("m", $this->AsTimeStamp() ) );
    }

    public function Day0( ){
    //
    // Tag als Zahl, mit f&uuml;hrenden Nullen  01 bis 31
    //
        return ( date("d", $this->AsTimeStamp() ) );
    }

    public function Year ( )
    {
        return $this->m_year;
    }  //  function Year ( )

    public function SetYear ( $y )
    {

        assert( checkdate($this->m_month, $this->m_day, $y ));

        $this-> m_year = $y;

        $this->mdy2ts ( );
        $this->CalculateWeekday( );
    }  //  function SetYear ( )

    public function Month ( )
    {
        return $this->m_month;
    }  //  function Month ( )

    public function SetMonth ( $m )
    {
        assert( checkdate($m, $this->m_day, $this->m_year ));

        $this-> m_month = $m;

        $this->mdy2ts ( );
        $this->CalculateWeekday( );
    }  //  function SetMonth ( )


    public function Day ( )
    {
        return $this->m_day;
    }  //  function Month ( )

    public function SetDay ( $d )
    {

        assert( checkdate($this->m_month, $d, $this->m_year ));

        $this-> m_day = $d;

        $this->mdy2ts ( );
        $this->CalculateWeekday( );
    }  //  function SetMonth ( )

    public function TimeStamp ( )
    {
        return $this->m_timestamp;
    }  //  function TimeStamp ( )


    public function AsTimeStamp ( )
    {
        return $this->TimeStamp( );
    }  //  function TimeStamp ( )

    public function SetTimeStamp ( $j )
    {

        // assert( checkdate($this->m_month, $d, $this->m_year );

        $this-> m_timestamp = $j;
        $this->ts2mdy( );

        $this->CalculateWeekday( );

        assert( $this->AsTimeStamp() == $j);

    }  //  function SetTimeStamp ( )


    public function Weekday ( )
    // zwischen 0 (f&uuml;r Sonntag) und 6 (f&uuml;r Samstag)
    {
        return $this->m_dow;
    }  //  function TimeStamp ( )

    public function DOW ( )
    // zwischen 0 (f&uuml;r Sonntag) und 6 (f&uuml;r Samstag)
    {
        return $this->Weekday( );
    }  //  function TimeStamp ( )




    public function DOY ( )

    {
        $start = new cDate( $this );
        $start->GoBOY();
        $diff = $this->m_timestamp - $start->m_timestamp;
        $diff = floor( $diff / 60/60/24 );
        $diff++;
        # echo "<br>diff = $diff";
/* alt und wohl fehlerhaft ?
        $datum = getdate( $this->m_timestamp );

        return $datum["yday"];
*/

        return $diff;
    }  //  function TimeStamp ( )

    public function Quarter( )
	{
		switch($this->Month())
		{
		case 1: case 2: case 3: return 1;break;
		case 4: case 5: case 6: return 2; break;
		case 7: case 8: case 9: return 3; break;
		case 10: case 11: case 12: return 4;break;
		}
	} //function Quarter()


    public function NOQ() {
        //
        // Number of Quarter
        //
        return $this->Quarter();
    }

    public function NOW() {
    //
    // Number of Week
    //
    //  NOTE : ISO-8601 Wochennummer des Jahres, die Woche beginnt am Montag
    //
        return ( date("W", $this->AsTimeStamp() ) );
    }   // public function NOW()

    public function WOY() {
    //
    // Number of Week of year
    //
    //  NOTE : ISO-8601 Wochennummer des Jahres, die Woche beginnt am Montag
    //
        return ( $this->NOW() );
    }   // public function WOY()

    public function WOM() {
    //
    // Number of Week of month
    //

        $week0 = $this->BOM()->NOW();
        $week1 = $this->NOW();

        return ( $week1 - $week0 ) + 1;
    }   // public function WOM()




    public function IsSommerzeit( ) {
        return ( date("I", $this->AsTimeStamp( ) ) );
    }

    public function IsDST( ) {
        return $this->IsSommerzeit( );
    }

    public function IsLeapyear( ) {
        return ( date("L", $this->AsTimeStamp( ) ) );
    }




// ===============================================================

    public function AsSQL ( )
    {

        //return "$this->m_year-$this->m_month-$this->m_day";
        return sprintf( '%4d-%02d-%02d', $this->m_year, $this->m_month, $this->m_day );

    }   // public function AsSQL ( )

    public function AsMDY ( )
    {

        return "$this->m_month/$this->m_day/$this->m_year";

    }   // public function AsMDY ( )

    public function AsDMY ( )
        // 1.1.2008
    {

        // return "$this->m_day.$this->m_month.$this->m_year";
        return sprintf( '%02d.%02d.%4d', $this->m_day, $this->m_month, $this->m_year );

    }   // public function AsDMY ( )


    public function AsDMY0 ( )
        // mit f&uuml;hrenden Nullen : 31.01.2008
    {
        $m = $this->Month0();;
        $d = $this->Day0();
        return "$d.$m.$this->m_year";

    }

    public function AsMDY0 ( )
        // mit f&uuml;hrenden Nullen : 01/31/2008
    {
        $m = $this->Month0();;
        $d = $this->Day0();

        return "$m/$d/$this->m_year";

    }   // public function AsMDY0 ( )


    public function AsUTC () {

    // Offset der Zeitzone in Sekunden.
    // Der Offset f&uuml;r Zeitzone West nach UTC ist immer negativ und
    // f&uuml;r Zeitzone Ost nach UTC immer positiv.
    // -43200 bis 43200

        return date ( "Z", $this->AsTimeStamp() );
    }   // public function AsUTC()

    public function AsAMPM() {
        // Gro&szlig;geschrieben: Ante meridiem und Post meridiem  AM oder PM
        return ( date("A", $this->AsTimeStamp() ) );
    }

    public function As_ampm() {
    // Kleingeschrieben: Ante meridiem und Post meridiem  am oder pm
        return ( date("a", $this->AsTimeStamp() ) );
    }

    public function AsSwatch() {
        // Swatch-Internet-Zeit  000 bis 999

        return ( date("B", $this->AsTimeStamp() ) );
    }

    public function AsISO8601() {
        // 2004-02-12T15:19:21+00:00

        return ( date("A", $this->AsTimeStamp() ) );
    }

    public function AsRFC2822() {
        // Beispiel: Thu, 21 Dec 2000 16:01:07 +0200

        return ( date("A", $this->AsTimeStamp() ) );
    }

// ===============================================================

    public function GoBOY ( )
    {

        $this->SetDay(1);
        $this->SetMonth(1);

    }   // public function GoBOY ( )

    public function GoBOM ( )
    {

        $this->SetDay(1);

    }   // public function GoBOM ( )

    public function GoBOQ ( )
    {

        switch ($this->m_month) {
            case 1:
            case 2:
            case 3:
                $this->SetDate( 1, 1, $this->m_year );
                break;
            case 4:
            case 5:
            case 6:
                $this->SetDate( 4, 1, $this->m_year );
                break;
            case 7:
            case 8:
            case 9:
                $this->SetDate( 7, 1, $this->m_year );
                break;
            case 10:
            case 11:
            case 12:
                $this->SetDate( 10, 1, $this->m_year );
                break;
        }

    }   // public function GoBOQ ( )


    public function GoBOW ( )
    {
        $this->m_timestamp -= ($this->DOW( ) * (60*60*24));
        $this->ts2mdy( );

    }   // public function GoBOW ( )

// ===============================================================

    public function GoEOY ( )
    {

        $this->SetDate(12,31,$this->m_year);

    }   // public function GoEOY ( )

    public function GoEOM ( )
    {

    $year = $this->m_year;
    $month = $this->m_month;

    $month++;
    if ($month>12)
    {
        $year++;
        $month = 1;
    }
    $this->SetDate( $month, 1, $year );  // n&auml;chster Monatserster

    $this->Dec( );                                  // 1 Tag zur&uuml;ck
    }   // public function GoEOM ( )

    public function GoEOQ ( )
    {

        switch ($this->m_month) {
            case 1:
            case 2:
            case 3:
                $this->SetDate( 3, 31, $this->m_year );
                break;
            case 4:
            case 5:
            case 6:
                $this->SetDate(  6, 30, $this->m_year );
                break;
            case 7:
            case 8:
            case 9:
                $this->SetDate(  9, 30, $this->m_year );
                break;
            case 10:
            case 11:
            case 12:
                $this->SetDate(  12, 31, $this->m_year );
                break;
        }

    }   // public function GoEOQ ( )


    public function GoEOW ( )
    {
        $this->m_timestamp += ( 6 - $this->DOW( ) ) * 60*60*24;
        $this->ts2mdy( );

    }   // public function GoEOW ( )

// ===============================================================

    public function Inc ( )
    {
        $this->m_timestamp += 60*60*24;
        $this->ts2mdy( );

    }   // public function Inc ( )

    public function Dec ( )
    {
        $this->m_timestamp -= 60*60*24;
        $this->ts2mdy( );

    }   // public function Dec ( )

    public function Skip ( $count = 1 )
    {
        if ($count !=0) {
            // echo "<br>addiere $count";
            $this->m_timestamp += ( (60*60*24) * $count );
            $this->ts2mdy( );
        }

    }   // public function Skip ( )


// ===============================================================
/*
    public function IsLeapYear ( )
    {
    return ( ( $this->m_year >= 1582 ) ? ( $this->m_year % 4 == 0 && $this->m_year % 100 != 0 || $this->m_year % 400 ==
                                    0 ) : ( $this->m_year % 4 == 0 ) );
    }   // public function IsLeapYear ( )
*/

    public function IsWeekday ( ) {
        return ($this->m_dow >0) && ($this->m_dow <6);
    }   // public function IsWeekday ( )

    public function IsWeekend ( ) {
        return ( ! $this->IsWeekday( ) );
    }   // public function IsWeekend ( )


// ===============================================================

    public function SetToday( ) {
        $datum = getdate( );

        $this->m_day = $datum["mday"];
        $this->m_year = $datum["year"];
        $this->m_month = $datum["mon"];

        assert( checkdate($this->m_month, $this->m_day, $this->m_year ));

        $this->mdy2ts ( );
        $this->CalculateWeekday( );


    }   // public function SetToday()

    public function SetDate($m, $d, $y ) {

        # echo "cDate : SetDate( $m, $d, $y)";

        assert( checkdate( $m, $d, $y ) );

        if (!checkdate($m, $d, $y)) {
            // var_dump( debug_backtrace( ) );
            print_r( debug_backtrace( ) );
            print "<br>Monat=$m Tag = $d Jahr = $y";
        }

        $this->m_year = $y;
        $this->m_month = $m;
        $this->m_day = $d;

        $this->mdy2ts ( );
        $this->CalculateWeekday( );
    }

// ===============================================================

    public function eq( $cmp ) {

        if (is_int( $cmp ) ) {
            return $cmp == $this->m_timestamp;
        } elseif ( is_a( $cmp, "libdatephp/cDate" ) ) {
            # print "<br>" . $cmp->AsTimeStamp() . "<->" . $this->AsTimeStamp();
            return ($cmp->Month()==$this->Month()) && ($cmp->Year()==$this->Year()) && ($cmp->Day()==$this->Day());
            # funktioniert nicht immer !   return $cmp->AsTimeStamp() == $this->AsTimeStamp();
        }

        // NOTE : TODO : Tagesgenaue Berechnung => Minuten sind wurscht

    }   // public function eq()

    public function lt( $cmp ) {

        if (is_int( $cmp ) ) {
            return $cmp < $this->m_timestamp;
        } elseif ( is_a( $cmp, "libdatephp/cDate" ) ) {
            return $this->AsTimeStamp() < $cmp->AsTimeStamp();
        } else  {
            die;
        }

        // NOTE : TODO : Tagesgenaue Berechnung => Minuten sind wurscht

    }   // public function le()

    public function gt( $cmp ) {

        if (is_int( $cmp ) ) {
            return $cmp > $this->m_timestamp;
        } elseif ( is_a( $cmp, 'libdatephp\cDate' ) ) {
            return  $this->AsTimeStamp() > $cmp->AsTimeStamp();
        }

        // NOTE : TODO : Tagesgenaue Berechnung => Minuten sind wurscht

    }   // public function gt()

    public function ge( $cmp ) {
        return $this->eq( $cmp ) || $this->gt( $cmp );
    }

    public function le( $cmp ) {
        return $this->eq( $cmp ) || $this->lt( $cmp );
    }

// ===============================================================

    public function BOW( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoBOW( );
        return $obj;
    }   // public function BOW( )

    public function EOW( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoEOW( );
        return $obj;
    }   // public function EOW( )

    public function BOM( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoBOM( );
        return $obj;
    }   // public function BOM( )

    public function EOM( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoEOM( );
        return $obj;
    }   // public function EOM( )

    public function BOQ( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoBOQ( );
        return $obj;
    }   // public function BOQ( )

    public function EOQ( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoEOQ( );
        return $obj;
    }   // public function EOQ( )

    public function BOY( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoBOY( );
        return $obj;
    }   // public function BOY( )

    public function EOY( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoEOY( );
        return $obj;
    }   // public function EOY( )

// ===============================================================

    public function AddDays( $diff ) {
        $this->Skip( $diff );
    }   // public function AddDays

    public function AddWeeks( $diff ) {
        $this->Skip( $diff*7 );
    }   // public function AddWeeks

    public function AddMonths( $diff ) {

    // NOTE : Das Datum wird &uuml;ber mktime berechnet
    // NOTE : (&uuml;bersch&uuml;ssige Tage fallen in den Folgemonat)

        $months = $this->m_month + $diff;
        $year = $this->m_year;

        while ( $months < 1 ) {
            $months += 12;
            $year--;
        }
        while ( $months > 12 ) {
            $months -= 12;
            $year++;
        }

        $this->m_timestamp = mktime(0, 0, 0, $months, $this->m_day, $year);

        $this->ts2mdy( );

    }   // public function AddMonths


    public function AddYears( $diff = 1) {
        $this->m_year += $diff;

        $this->mdy2ts ( );
        $this->CalculateWeekday( );

    }   // public function AddYears
// ===============================================================
    public function LOW( ) {
        // L&auml;nge einer Woche
        return 7;
    }   // public function LOW

// return ( EOM (  ).AsJulian (  ) - BOM (  ).AsJulian (  ) ) + 1;

    public function LOM( ) {
        // L&auml;nge des Monats

        $start = new cDate($this->BOM());
        $end = new cDate($this->EOM());
        // echo "<br>".$start->AsDMY()."-".$end->AsDMY();
        $diff = $end->AsTimeStamp() - $start->AsTimeStamp();

        return ceil( $diff / (60*60*24) )+1;
    }   // public function LOM

    public function LOQ( ) {
        // L&auml;nge des Monats

        $start = new cDate($this->BOQ());
        $end = new cDate($this->EOQ());
        // echo "<br>".$start->AsDMY()."-".$end->AsDMY();
        $diff = $end->AsTimeStamp() - $start->AsTimeStamp();

        return ceil( $diff / (60*60*24) )+1;
    }   // public function LOQ

    public function LOY( ) {
        // L&auml;nge des Monats
        $start = new cDate($this->BOY());
        $end = new cDate($this->EOY());
        // echo "<br>".$start->AsDMY()."-".$end->AsDMY();
        $diff = $end->AsTimeStamp() - $start->AsTimeStamp();

        return ceil( $diff / (60*60*24) )+1;
    }   // public function LOY

// ===============================================================

    public function PrintOn( $fptr ) {

        // NOTE : 4 Bytes (32 Bit)

        fwrite( $fptr, $this->m_timestamp, 4  );
    }

    public function ScanFrom( $fptr ) {

        // NOTE : 4 Bytes (32 Bit)

        $this->m_timestamp = (int) fread( $fptr, 4);
        $this->ts2mdy();

        assert( checkdate($this->m_month, $this->m_day, $this->m_year ));
    }


// ===============================================================

/*

	int FDOM ( void ) const;// Erster Monatstag am <n>  (1..7)

	const char *CDOW ( void ) const;	// Wochentag als String

	const char *CMonth ( void ) const;	// Monatsname als String
	//
	int CentYear ( void ) const;	// Jahr mit Jahrhundert
*/


}   // class cDate

?>