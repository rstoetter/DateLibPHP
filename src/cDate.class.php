<?php

namespace rstoetter\libdatephp;

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
    public function IsLeapYear() {
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

$_ARY_WD_EN_SHORT = array(
    0 => "Su",
    1 => "Mo",
    2 => "Tu",
    3 => "We",
    4 => "Th",
    5 => "Fr",
    6 => "Sa"
);  // $_ARY_WD_GER_SHORT


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

$_ARY_WD_EN_LONG = array(
    0 => "Sunday",
    1 => "Monday",
    2 => "Tuesday",
    3 => "Thursday",
    4 => "Saturday",
    5 => "Friday",
    6 => "Saturday"
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

$_ARY_MONTH_EN_SHORT = array(
    1 => "Jan",
    2 => "Feb",
    3 => "Mar",
    4 => "Apr",
    5 => "May",
    6 => "Jun",
    7 => "Jul",
    8 => "Aug",
    9 => "Sep",
   10 => "Oct",
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

$_ARY_MONTH_EN_LONG = array(
    1 => "January",
    2 => "February",
    3 => "March",
    4 => "April",
    5 => "May",
    6 => "June",
    7 => "July",
    8 => "August",
    9 => "September",
   10 => "October",
   11 => "November",
   12 => "December"
);  // $_ARY_MONTH_GER_LONG



/**
  *
  * Objects of the class cDate represent single dates in Gregoria calendar style
  *
  * @author Rainer Stötter
  * @copyright 2010-2017 Rainer Stötter
  * @license MIT
  * @version =1.0.1
  *
  */


class cDate {

/*

TODO Werktage und Arbeitstage je Zeiteinheit

TODO: Feiertage: http://www.kalender-uhrzeit.de/kalenderwochen-2017

TODO: Verschriftlichen:

Der Kalender mit seinen Wochen und Tagen

Schon die Menschen in der Steinzeit beobachteten die wiederkehrenden Ereignisse in der Natur. Sie bemerkten den Wechsel zwischen Tag und Nacht, die sich wiederholenden Mondphasen und die jahreszeitbedingten Klimaveränderungen. Im Laufe der Zeit entwickelten sich die Orientierungen immer weiter. Es wurden religiöse Beobachtungsstätte wie der Turm von Jericho und Stonehenge gebaut, um die Jahreszeiten und Tage besser bestimmen zu können. Die frühen Hochkulturen Ägyptens und Mesopotamiens entwickelten verschiedene Kalendertypen, die eine Grundlage für die noch heute geltenden Kalender bilden. 1582 änderte Papst Gregor XIII. den Julianischen Kalender, der dem Jahreslauf der Sonne elf Tage nachhinkte. Um dies auszugleichen folgte auf den 4. Oktober 1582 direkt der 15. Oktober. Die Schaltjahresregel blieb erhalten. So entstand der Gregorianische Kalender, der noch immer in den meisten Ländern der Welt benutzt wird.



Das Schaltjahr

Ein normales Jahr beinhaltet 52 Wochen, wenn es kein Schaltjahr ist. Wenn ein normales Jahr mit einem Donnerstag beginnt und auch endet, ist es 53 Wochen lang. Ein Schaltjahr besteht ebenfalls aus 53 Kalenderwochen, fängt entweder mit einem Mittwoch an und endet mit einem Donnerstag oder fängt mit einem Donnerstag an und wird mit einem Freitag beendet. Warum hat ein Schaltjahr einen Tag mehr, als ein normales Jahr? Die Erde dreht sich in 365 Tage und 6 Stunden um die Sonne, also mehr als der Kalender mit ganzen Tagen aufweist. Dies würde mit der Zeit nicht unbemerkt bleiben. Weihnachten würde irgendwann im Sommer stattfinden. Um diese Ungenauigkeit auszugleichen, wurde alle vier Jahre ein zusätzlicher Tag, der 29. Februar eingeführt. Zusätzlich entfällt das Schaltjahr bei Jahren die durch 100 teilbar sind, aber nicht durch 400 teilbar sind, wie in den Jahren 1700, 1800 und 1900.
*/

    /**
      * The version of the class
      *
      * @var string $version
      *
      *
      */

      public $version = '1.0.1';


    /**
      * The number of the day of week of sunday in Gregorian notation.
      *
      * Gregorian days are zero-based ( start with 0 ) and start with the sunday
      *
      * @var int
      *
      * @see DOW_SUNDAY
      * @see DOW_MONDAY
      * @see DOW_TUESDAY
      * @see DOW_FRIDAY
      * @see DOW_SATURDAY
      *
      */

    const DOW_SUNDAY = 0;

    /**
      * The number of the day of week of monday in Gregorian notation.
      *
      * Gregorian days are zero-based ( start with 0 ) and start with the sunday
      *
      * @var int
      *
      * @see DOW_SUNDAY
      * @see DOW_MONDAY
      * @see DOW_TUESDAY
      * @see DOW_FRIDAY
      * @see DOW_SATURDAY
      *
      */

    const DOW_MONDAY = 1;

    /**
      * The number of the day of week of tuesday in Gregorian notation.
      *
      * Gregorian days are zero-based ( start with 0 ) and start with the sunday
      *
      * @var int
      *
      * @see DOW_SUNDAY
      * @see DOW_MONDAY
      * @see DOW_TUESDAY
      * @see DOW_FRIDAY
      * @see DOW_SATURDAY
      *
      */

    const DOW_TUESDAY = 2;

    /**
      * The number of the day of week of wednesday in Gregorian notation.
      *
      * Gregorian days are zero-based ( start with 0 ) and start with the sunday
      *
      * @var int
      *
      * @see DOW_SUNDAY
      * @see DOW_MONDAY
      * @see DOW_TUESDAY
      * @see DOW_FRIDAY
      * @see DOW_SATURDAY
      *
      */

    const DOW_WEDNESDAY = 3;

    /**
      * The number of the day of week of thursday in Gregorian notation.
      *
      * Gregorian days are zero-based ( start with 0 ) and start with the sunday
      *
      * @var int
      *
      * @see DOW_SUNDAY
      * @see DOW_MONDAY
      * @see DOW_TUESDAY
      * @see DOW_FRIDAY
      * @see DOW_SATURDAY
      *
      */

    const DOW_THURSDAY = 4;

    /**
      * The number of the day of week of friday in Gregorian notation.
      *
      * Gregorian days are zero-based ( start with 0 ) and start with the sunday
      *
      * @var int
      *
      * @see DOW_SUNDAY
      * @see DOW_MONDAY
      * @see DOW_TUESDAY
      * @see DOW_FRIDAY
      * @see DOW_SATURDAY
      *
      */

    const DOW_FRIDAY = 5;

    /**
      * The number of the day of week of saturday in Gregorian notation.
      *
      * Gregorian days are zero-based ( start with 0 ) and start with the sunday
      *
      * @var int
      *
      * @see DOW_SUNDAY
      * @see DOW_MONDAY
      * @see DOW_TUESDAY
      * @see DOW_FRIDAY
      * @see DOW_SATURDAY
      *
      */

    const DOW_SATURDAY = 6;


    /**
      * The one-based year part of the date
      *
      * @var int $m_year the year part of the date
      *
      * @see $m_year
      * @see Year
      * @see $m_month
      * @see Month
      * @see $m_day
      * @see Day
      * @see $m_timestamp
      * @see TimeStamp
      * @see $m_dow
      * @see DOW
      *
      */

    protected $m_year = -1;

    /**
      * The one-based month part of the date
      *
      * @var int $m_month the month part of the date
      *
      * @see $m_year
      * @see Year
      * @see $m_month
      * @see Month
      * @see $m_day
      * @see Day
      * @see $m_timestamp
      * @see TimeStamp
      * @see $m_dow
      * @see DOW
      *
      */

    protected $m_month = -1;

    /**
      * The one-based day part of the date
      *
      * @var int $m_day the day part of the date
      *
      * @see $m_year
      * @see Year
      * @see $m_month
      * @see Month
      * @see $m_day
      * @see Day
      * @see $m_timestamp
      * @see TimeStamp
      * @see $m_dow
      * @see DOW
      *
      */

    protected $m_day = -1;

    /**
      * The timestamp of the date
      *
      * @var int $m_timestamp the timestamp of the date
      *
      * @see $m_year
      * @see Year
      * @see $m_month
      * @see Month
      * @see $m_day
      * @see Day
      * @see $m_timestamp
      * @see TimeStamp
      * @see $m_dow
      * @see DOW
      * @see mdy2ts
      *
      */

    protected $m_timestamp = -1;

    /**
      * The day of week of the date
      *
      * @var int $m_dow the day of week of the date
      *
      * @see $m_year
      * @see Year
      * @see $m_month
      * @see Month
      * @see $m_day
      * @see Day
      * @see $m_timestamp
      * @see TimeStamp
      * @see $m_dow
      * @see DOW
      *
      */

    protected $m_dow = -1;      // zwischen 0 (f&uuml;r Sonntag) und 6 (f&uuml;r Samstag)

    /**
      *
      * InJanuary() returns true, if the date lies in a January
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InJanuary( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in January
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */


    public function InJanuary() {
        return ( $this->Month() == 1);
    }

    /**
      *
      * InFebruary() returns true, if the date lies in a February
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InFebruary( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in February
      *
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InFebruary() {
        return ( $this->Month() == 2);
    }

    /**
      *
      * InMarch() returns true, if the date lies in a March
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InJanuary( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in March
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InMarch() {
        return ( $this->Month() == 3);
    }

    /**
      *
      * InApril() returns true, if the date lies in a April
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InApril( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in April
      *
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InApril() {
        return ( $this->Month() == 4);
    }

    /**
      *
      * InMay() returns true, if the date lies in May
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InMay( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in May
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InMay() {
        return ( $this->Month() == 5);
    }

    /**
      *
      * InJune() returns true, if the date lies in a June
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InJune( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in June
      *
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InJune() {
        return ( $this->Month() == 6);
    }

    /**
      *
      * InJuly() returns true, if the date lies in a July
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InJuly( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in July

      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InJuly() {
        return ( $this->Month() == 7);
    }

    /**
      *
      * InAugust() returns true, if the date lies in an August
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InAugust( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in August
      *
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InAugust() {
        return ( $this->Month() == 8);
    }

    /**
      *
      * InSeptember() returns true, if the date lies in a September
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InSeptember( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in September
      *
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InSeptember() {
        return ( $this->Month() == 9);
    }

    /**
      *
      * InOctober() returns true, if the date lies in an October
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InOctober( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in October
      *
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InOctober() {
        return ( $this->Month() == 10);
    }

    /**
      *
      * InNovember() returns true, if the date lies in a November
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InNovember( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in November
      *
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InNovember() {
        return ( $this->Month() == 11);
    }

    /**
      *
      * InDecember() returns true, if the date lies in a December
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->InDecember( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a day in December
      *
      * @see InJanuary
      * @see InFebruary
      * @see InMarch
      * @see InApril
      * @see InMay
      * @see InJune
      * @see InJuly
      * @see InAugust
      * @see InSeptember
      * @see InOctober
      * @see InNovember
      * @see InDecember
      */

    public function InDecember() {
        return ( $this->Month() == 12);
    }

    const SEEK_FORWARD = 0;
    const SEEK_BACKWARDS = 1;

    /**
      *
      * SeekWeekday() seeks for the next searched weekday bidirectionally. If the date is the weekday $weekday, then no the date will not move
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->SeekWeekday( cDate::DOW_WEDNESDAY, cDate::SEEK_BACKWARDS ) ;
      *
      * @param int $weekday the weekday we are searching for const DOW_SUNDAY .. DOW_SATURDAY
      * @param int $direction constant SEEK_FORWARD or SEEK_BACKWARDS. It defualts to SEEK_FORWARD
      * @param bool $skipper if true, then the date will move 7 days in the wanted direction on the time line, when the weekday is the weekday on the first position. Defaults to false.
      *
      * @see DOW
      * @see Weekday
      *
      */

    public function SeekWeekday( $weekday, $direction = self::SEEK_FORWARD, $skipper = false ) {

    assert( $weekday >= self::DOW_SUNDAY && $weekday <= self::DOW_SATURDAY );
    if( $weekday < self::DOW_SUNDAY || $weekday > self::DOW_SATURDAY ) {
	die( "\n SeekWeekday: error: wrong weekday = $weekday" );
    }

    // suche beginnend mit dem aktuellen Datum den übergebenen Wochentag

	if ( $weekday < self::DOW_SUNDAY || $weekday > self::DOW_SATURDAY ) {
	    assert( false == true );
	    die( "\n SeekWeekday() : error:  wrong weekday $weekday" );
	}

	if ( ( $this->m_dow == $weekday ) && ( $skipper ) ) {
	    $this->Skip( $direction == self::SEEK_FORWARD ? 7 : - 7 );

	} else {

	    $count = 0;
	    while ( $this->m_dow != $weekday ) {

		if ( $direction == self::SEEK_FORWARD ) {
		    $this->Inc( );
		} else {
		    $this->Dec( );
		}

		$count++;

		if ( $count > 7 ) {
		    die( "\n SeekWeekday : error: wrong week day $weekday" );
		}

	    }


	}

    }  // function SeekWeekday( )



    /**
      *
      * IsSunday() returns true, if the date is a sunday
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->IsSunday( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a sunday
      *
      * @see IsSunday
      * @see IsMonday
      * @see IsTuesday
      * @see IsWednesday
      * @see IsThursday
      * @see IsFriday
      * @see IsSaturday
      * @see DOW
      *
      * @since = 1.0
      *
      */

    public function IsSunday() {
        return ( $this->DOW() == 0);
    }

    /**
      *
      * IsMonday() returns true, if the date is a monday
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->IsMonday( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a monday
      *
      * @see IsSunday
      * @see IsMonday
      * @see IsTuesday
      * @see IsWednesday
      * @see IsThursday
      * @see IsFriday
      * @see IsSaturday
      * @see DOW
      *
      * @since = 1.0
      *
      */
    public function IsMonday() {
        return ( $this->DOW() == 1);
    }


    /**
      *
      * IsTuesday() returns true, if the date is a tuesday
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->IsTuesday( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a tuesday
      *
      * @see IsSunday
      * @see IsMonday
      * @see IsTuesday
      * @see IsWednesday
      * @see IsThursday
      * @see IsFriday
      * @see IsSaturday
      * @see DOW
      *
      * @since = 1.0
      *
      */

    public function IsTuesday() {
        return ( $this->DOW() == 2);
    }

    /**
      *
      * IsWednesday() returns true, if the date is a wednesday
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->IsWednesday( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a wednesday
      *
      * @see IsSunday
      * @see IsMonday
      * @see IsTuesday
      * @see IsWednesday
      * @see IsThursday
      * @see IsFriday
      * @see IsSaturday
      * @see DOW
      *
      * @since = 1.0
      *
      */


    public function IsWednesday() {
        return ( $this->DOW() == 3);
    }

    /**
      *
      * IsThursday() returns true, if the date is a thursday
      *
      *
      * Example:
      *
      * ```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * assert( $dt->WOM( ) == 1 );
      * echo "\n wom = " . $dt->WOM();
      * $dt->GoWOM( 5 );
      * assert( $dt->WOM( ) == 5 );
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * $dt->GoWOM( 5, \libdatephp\cDate::DOW_THURSDAY );
      * assert( $dt->IsThursday( ) );
      * assert( $dt->eq( new \libdatephp\cDate( 2,2,2017) ) );
      * ```
      *
      *
      * @return bool true, if the date is a thursday
      *
      * @see IsSunday
      * @see IsMonday
      * @see IsTuesday
      * @see IsWednesday
      * @see IsThursday
      * @see IsFriday
      * @see IsSaturday
      * @see DOW
      *
      * @since = 1.0
      *
      */

    public function IsThursday( ) {
        return ( $this->DOW() == 4);
    }

    /**
      *
      * IsFriday() returns true, if the date is a friday
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->IsFriday( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a friday
      *
      * @see IsSunday
      * @see IsMonday
      * @see IsTuesday
      * @see IsWednesday
      * @see IsThursday
      * @see IsFriday
      * @see IsSaturday
      * @see DOW
      *
      * @since = 1.0
      *
      */


    public function IsFriday( ) {
        return ( $this->DOW() == 5);
    }

    /**
      *
      * IsSaturday() returns true, if the date is a saturday
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->IsSaturday( ) ) do_someting( ) ;
      *
      * @return bool true, if the date is a saturday
      *
      * @see IsSunday
      * @see IsMonday
      * @see IsTuesday
      * @see IsWednesday
      * @see IsThursday
      * @see IsFriday
      * @see IsSaturday
      * @see DOW
      *
      * @since = 1.0
      *
      */


    public function IsSaturday() {
        return ( $this->DOW() == 6);
    }

    /**
      *
      * DOQ() aka "Day Of Quarter" returns the day number of the date in the quarter
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->DOQ( );
      *
      * @return int the number of he day in the quarter
      *
      * @see DOQ
      * @see DOW
      * @see DOM
      * @see DOY
      *
      * @since = 1.0
      *
      */


    public function DOQ() { // nth day of actual quarter
        $quarterstart = new cDate($this);
        $quarterstart->GoBOQ();
        # echo "<br>quarterstart = " . $quarterstart->AsDMY();
        $ret = (int) (( $this->AsTimeStamp() - $quarterstart->AsTimeStamp() )  /60 /60/24) +1;
        //$ret --;
        return $ret;
    }

// ---------------------------------------

    /**
      *
      * C_Weekday_Short_DE() returns the German short string representation of the date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->C_Weekday_Short_DE( );
      *
      * @return string the German short representation of the weekday of the date
      *
      * @see C_Weekday_Short_DE
      * @see C_Weekday_Long_DE
      * @see C_Month_Long_DE
      * @see C_Month_Short_DE
      * @see C_Weekday_Short_EN
      * @see C_Weekday_Long_EN
      * @see C_Month_Long_EN
      * @see C_Month_Short_EN

      *
      * @since = 1.0
      *
      */


    public function C_Weekday_Short_DE( ) {

	global $_ARY_WD_GER_SHORT;

        return $_ARY_WD_GER_SHORT[ $this->Weekday() ];
    }

    /**
      *
      * C_Weekday_Long_DE() returns the German long string representation of the date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->C_Weekday_Long_DE( );
      *
      * @return string the German long representation of the weekday of the date
      *
      * @see C_Weekday_Short_DE
      * @see C_Weekday_Long_DE
      * @see C_Month_Long_DE
      * @see C_Month_Short_DE
      * @see C_Weekday_Short_EN
      * @see C_Weekday_Long_EN
      * @see C_Month_Long_EN
      * @see C_Month_Short_EN
      *
      * @since = 1.0
      *
      */


    public function C_Weekday_Long_DE( ) {
        return $_ARY_WD_GER_LONG[ $this->Weekday() ];
    }

    /**
      *
      * C_Month_Short_DE() returns the German short string representation of the name of the month
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->C_Month_Short_DE( );
      *
      * @return string the German short representation of the month of the date
      *
      * @see C_Weekday_Short_DE
      * @see C_Weekday_Long_DE
      * @see C_Month_Long_DE
      * @see C_Month_Short_DE
      * @see C_Weekday_Short_EN
      * @see C_Weekday_Long_EN
      * @see C_Month_Long_EN
      * @see C_Month_Short_EN
      *
      * @since = 1.0
      *
      */


    public function C_Month_Short_DE( ) {

	global $_ARY_MONTH_GER_SHORT;

        return $_ARY_MONTH_GER_SHORT[ $this->Month() ];
    }

    /**
      *
      * C_Month_Long_DE() returns the German long string representation of the name of the month
      *
      * Example:
      *```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * for ( $i = 0; $i < 12; $i++ ) {
      *      echo "\n the month " . $dt->C_Month_Short_DE( ) . ' of the year ' . $dt->Year( ) . ' has ' . $dt->WeeksOfMonth( ) . ' weeks';
      *      $dt->AddMonths( );
      * }
      *```
      * @return string the German long representation of the month of the date
      *
      * @see C_Weekday_Short_DE
      * @see C_Weekday_Long_DE
      * @see C_Month_Long_DE
      * @see C_Month_Short_DE
      * @see C_Weekday_Short_EN
      * @see C_Weekday_Long_EN
      * @see C_Month_Long_EN
      * @see C_Month_Short_EN
      *
      * @since = 1.0
      *
      */

    public function C_Month_Long_DE( ) {

	global $_ARY_MONTH_GER_LONG;

        return $_ARY_MONTH_GER_LONG[ $this->Month() ];
    }




    /**
      *
      * C_Weekday_Short_EN() returns the English short string representation of the date
      *
      * Example:
      *
      *```
      *```
      *
      * @return string the English short representation of the weekday of the date
      *
      * @see C_Weekday_Short_DE
      * @see C_Weekday_Long_DE
      * @see C_Month_Long_DE
      * @see C_Month_Short_DE
      * @see C_Weekday_Short_EN
      * @see C_Weekday_Long_EN
      * @see C_Month_Long_EN
      * @see C_Month_Short_EN
      *
      * @since = 1.0
      *
      */


    public function C_Weekday_Short_EN( ) {

	global $_ARY_WD_EN_SHORT;

        return $_ARY_WD_EN_SHORT[ $this->Weekday() ];
    }

    /**
      *
      * C_Weekday_Long_EN() returns the English long string representation of the date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->C_Weekday_Long_EN( );
      *
      * @return string the English long representation of the weekday of the date
      *
      * @see C_Weekday_Short_DE
      * @see C_Weekday_Long_DE
      * @see C_Month_Long_DE
      * @see C_Month_Short_DE
      * @see C_Weekday_Short_EN
      * @see C_Weekday_Long_EN
      * @see C_Month_Long_EN
      * @see C_Month_Short_EN        *
      * @since = 1.0
      *
      */


    public function C_Weekday_Long_EN( ) {

	global $_ARY_WD_EN_LONG;

        return $_ARY_WD_EN_LONG[ $this->Weekday() ];

    }

    /**
      *
      * C_Month_Short_EN() returns the English short string representation of the name of the month
      *
      * Example:
      *
      *```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * for ( $i = 0; $i < 12; $i++ ) {
      *      echo "\n the month " . $dt->C_Month_Short_EN( ) . ' of the year ' . $dt->Year( ) . ' has ' . $dt->WeeksOfMonth( ) . ' weeks';
      *      $dt->AddMonths( );
      * }
      *```      *
      * @return string the English short representation of the month of the date
      *
      * @see C_Weekday_Short_DE
      * @see C_Weekday_Long_DE
      * @see C_Month_Long_DE
      * @see C_Month_Short_DE
      * @see C_Weekday_Short_EN
      * @see C_Weekday_Long_EN
      * @see C_Month_Long_EN
      * @see C_Month_Short_EN
      *
      * @since = 1.0
      *
      */


    public function C_Month_Short_EN( ) {

	global $_ARY_MONTH_EN_SHORT;

        return $_ARY_MONTH_EN_SHORT[ $this->Month() ];
    }

    /**
      *
      * C_Month_Long_EN() returns the English long string representation of the name of the month
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->C_Month_Long_EN( );
      *
      * @return string the English long representation of the month of the date
      *
      * @see C_Weekday_Short_DE
      * @see C_Weekday_Long_DE
      * @see C_Month_Long_DE
      * @see C_Month_Short_DE
      * @see C_Weekday_Short_EN
      * @see C_Weekday_Long_EN
      * @see C_Month_Long_EN
      * @see C_Month_Short_EN
      *
      * @since = 1.0
      *
      */

    public function C_Month_Long_EN( ) {

	global $_ARY_MONTH_EN_LONG;

        return $_ARY_MONTH_EN_LONG[ $this->Month() ];
    }


    /**
      *
      * The method FromAnyString( ) sets the internal date according to the string $str. It recognizes the input format
      * ( MDY, SQL, DMY ) automatically.
      *
      * Example:
      *
      *```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * for ( $i = 0; $i < 12; $i++ ) {
      *      echo "\n the month " . $dt->C_Month_Long_EN( ) . ' of the year ' . $dt->Year( ) . ' has ' . $dt->WeeksOfMonth( ) . ' weeks';
      *      $dt->AddMonths( );
      * }
      *```
      *
      * @param string $str the string with the date
      *
      * @see FromSQL
      * @see FromMDY
      * @see FromDMY
      *
      * @since = 1.0
      *
      */


    public function FromAnyString( $str ) {

	if ( substr( $str, 2, 1 ) == '.'  ) {

	    $this->FromDMY( $str );

	} elseif ( substr( $str, 4, 1 ) == '-'  ) {

	    $this->FromSQL( $str );

	} elseif ( substr( $str, 2, 1 ) == '/'  ) {

	    $this->FromMDY( $str );

	} else {

	    die( "\n bad formatted template: {$str}" );

	}

    }

// ---------------------------------------

    /**
      *
      *  The constructor for the cDate class
      *
      *  Example:
      *
      *  $p = new cDate( 11, 22, 2016 );
      *  from month, day, year
      *
      *  $p = new cDate( '2017-02-28' );
      *  from SQL string
      *
      *  $p = new cDate( '28.02.2017' );
      *  from DMY string
      *
      *  $p = new cDate( '02-28-2017' );
      *  from MDY string
      *
      *  $p = new cDate(  );
      *  a date with today's date
      *
      *  $dtm = new cDate( new cDate( 11, 22, 2016 ) );
      *  a copy constructor
      *
      *
      *  $dtm = new cDate( 200516 );
      *  from a timestamp
      *
      *
      * @param mixed $m can be an int as month or a timestamp or a cDate
      * @param mixed $d can be a date or an int as day or a cDate
      * @param int $y the year of the first date
      *
      * @return cDate
      */


    public function __construct( $m = null, $d = null, $y = null) {

// 	if ( is_null( $m ) ) {
	    // debug_print_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
	    // throw new \Exception( "\n cDate::__construct() mit NULL " );
// 	}

        if ( is_string( $m ) ) {

	    $this->FromAnyString( $m );

	} else {

        # if (!is_a($m, '\rstoetter\libdatephp\cDate')) { echo "<br>cDate::cDate( $m, $d, $y)";}

	    if ( is_a( $m, '\rstoetter\libdatephp\cDate' ) ) {
		$this->FromDate( $m );
	    }  elseif ( ( is_null( $y ) ) && ( is_null( $m ) ) && ( is_null( $d ) ) ) {

		$this->SetToday( );

	    } elseif ( is_int( $m ) && ( is_null( $d ) ) && ( is_null( $y ) ) ) {

		$this->FromTimestamp( $m );

	    } elseif ( is_int( $m ) && ( is_int( $d ) ) && ( is_int( $y ) ) ) {

		$this->SetDate($m, $d, $y);

	    } else {
		# echo "<br>->$d.$m.$y ";
		// echo ">>".( is_int($y) . "-".is_int($m)."-" . is_int($d) ) ." --- ". $y . $m .$d. "d=".$d."y=".$y."m=".$m;
		// var_dump( debug_backtrace( ) );
		throw new \Exception( "\n cDate : Fehlerhafte Parameter '$m-$d-$y'" );
// 		assert( true == false );
// 		die("\n cDate : Fehlerhafte Parameter '$m-$d-$y'");
	    }
        }



    }   // function cDate( $y, $m, $d)

    /**
      *
      * mdy2ts() calculates the timestamp out of the mdy notation
      *
      *
      * @see mdy2ts
      * @see ts2mdy
      *
      * @since = 1.0
      *
      */


    protected function mdy2ts ( )
    {

        $this->m_timestamp = mktime(0, 0, 0, $this->m_month, $this->m_day, $this->m_year);
        $this->CalculateWeekday (  );

    }   //  function mdy2ts ( void )

    /**
      *
      * ts2mdy() calculates out of the timestamp out the mdy notation
      *
      *
      * @see mdy2ts
      * @see ts2mdy
      *
      * @since = 1.0
      *
      */


    protected function ts2mdy( ) {

        $datum = getdate( $this->m_timestamp );

        $this->m_day = $datum[ 'mday' ];
        $this->m_year = $datum[ 'year' ];
        $this->m_month = $datum[ 'mon' ];
        // echo "<br>" . $this->AsDMY();
        assert( checkdate($this->m_month, $this->m_day, $this->m_year ));

        // $this->mdy2ts ( );
        $this->CalculateWeekday( );

    }   // private function ts2mdy


    /**
      *
      * The method CheckDate( ) returns true, if the parameters are valid for a new cDate object
      *
      *
      * @param int $month the month part of the date to be checked
      * @param int $day the day part of the date to be checked
      * @param int $year the year part of the date to be checked
      *
      * @since = 1.0
      *
      */

      public function CheckDate( $month, $day, $year ) {

	  return checkdate( $month, $day, $year );

      }	// function CheckDate( )


    /**
      *
      * _weekday( ) calculates the actual weekday for a given month, day and year
      *
      *
      * @param int $m the month
      * @param int $d the day
      * @param int $m the year
      *
      * @return int the weekday - 0 = sunday, 1 = monday .. 6 = saturday
      *
      * @see mdy2ts
      * @see ts2mdy
      *
      * @since = 1.0
      *
      */

    protected function _weekday ( $month, $day, $year )    {

	// TODO: Tag = (((Unix / 86400UL + 4) % 7UL) + 1);	//Wochentag Berechnung 1 ist Sonntag

	// berechnet die numerische Repräsentation des Wochentags und liegt zwischen 0 (für Sonntag) und 6 (für Sonnabend)

	// https://en.wikipedia.org/wiki/Determination_of_the_day_of_the_week

        assert( checkdate($this->m_month, $this->m_day, $this->m_year ));
        if ( ! checkdate($this->m_month, $this->m_day, $this->m_year )) {
	    assert( false == true );
	    throw new \Exception(  "\n CalculateWeekday: month = $this->m_month day = $this->m_day year = $this->m_year");
        }

	// m is month (1 = March, ..., 10 = December, 11 = Jan, 12 = Feb) Treat Jan & Feb as months of the preceding year

        static $shifted_months = array( 11, 12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );

        /*

    Y is the year minus 1 for January or February, and the year for any other month
    y is the last 2 digits of Y
    c is the first 2 digits of Y - century
    d is the day of the month (1 to 31)
    m is the shifted month (March=1,...,February=12)
    w is the day of week (0=Sunday,...,6=Saturday)

        */

        // $year = $year;

        if ( ( $month== 1 ) || ( $month== 2 ) ) $year--;
        $y = ( $year % 100 );	// letzte zwei Ziffern vom Jahr

	// $c = ( ( $year - $year % 1000 ) / 100  );  // erste zwei Ziffern vom Jahr
	$c = floor( $year / 100 );
	$d = $day;
	$m = $shifted_months[ $month- 1 ];

	$w = ( $d + floor( 2.6 * $m - 0.2 )  + $y + floor( $y / 4 ) + floor( $c / 4 ) -  2 * $c  ) % 7;

	if ( $w < 0 ) $w += 7;

	return $w;

    }   // function _weekday ( )



    /**
      *
      * CalculateWeekday() calculates out of the timestamp the actual weekday
      *
      *
      * @see mdy2ts
      * @see ts2mdy
      *
      * @since = 1.0
      *
      */


    protected function CalculateWeekday ( )    {

	// TODO: Tag = (((Unix / 86400UL + 4) % 7UL) + 1);	//Wochentag Berechnung 1 ist Sonntag

	// berechnet die numerische Repräsentation des Wochentags und liegt zwischen 0 (für Sonntag) und 6 (für Sonnabend)

	// https://en.wikipedia.org/wiki/Determination_of_the_day_of_the_week

        assert( checkdate($this->m_month, $this->m_day, $this->m_year ));
        if ( ! checkdate($this->m_month, $this->m_day, $this->m_year )) {
	    assert( false == true );
	    throw new \Exception(  "\n CalculateWeekday: month = $this->m_month day = $this->m_day year = $this->m_year");
        }



        $ary = getdate ( $this->m_timestamp );
        $this-> m_dow = $ary[ 'wday' ];		// TODO: checks rausnehmen

assert( $ary['mday'] == $this->m_day );
assert( $ary['mon'] == $this->m_month );
assert( $ary['year'] == $this->m_year );

	$w = $this->_weekday( $this->m_month, $this->m_day, $this->m_year );

        assert( $w == $this->m_dow );		// TODO ganz auf eigene Berechnung umstellen

        if ( $w != $this->m_dow ) throw new \Exception(  "\n CalculateWeekday: dow = $w errechnet, ist aber " . $this->m_dow . " für month = $this->m_month day = $this->m_day year = $this->m_year");


    }   // function CalculateWeekday ( )


/*

    protected function CalculateWeekday ( )    {

	// TODO: Tag = (((Unix / 86400UL + 4) % 7UL) + 1);	//Wochentag Berechnung 1 ist Sonntag

	// berechnet die numerische Repräsentation des Wochentags und liegt zwischen 0 (für Sonntag) und 6 (für Sonnabend)

	// https://en.wikipedia.org/wiki/Determination_of_the_day_of_the_week

        assert( checkdate($this->m_month, $this->m_day, $this->m_year ));
        if ( ! checkdate($this->m_month, $this->m_day, $this->m_year )) {
	    assert( false == true );
	    die(  "\n CalculateWeekday: month = $this->m_month day = $this->m_day year = $this->m_year");
        }



        $ary = getdate ( $this->m_timestamp );
        $this-> m_dow = $ary[ 'wday' ];

assert( $ary['mday'] == $this->m_day );
assert( $ary['mon'] == $this->m_month );
assert( $ary['year'] == $this->m_year );

	// m is month (1 = March, ..., 10 = December, 11 = Jan, 12 = Feb) Treat Jan & Feb as months of the preceding year

        static $shifted_months = array( 11, 12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 );



//     Y is the year minus 1 for January or February, and the year for any other month
//     y is the last 2 digits of Y
//     c is the first 2 digits of Y - century
//     d is the day of the month (1 to 31)
//     m is the shifted month (March=1,...,February=12)
//     w is the day of week (0=Sunday,...,6=Saturday)



        $year = $this->m_year;
        if ( ( $this->m_month == 1 ) || ( $this->m_month == 2 ) ) $year--;
        $y = ( $year % 100 );	// letzte zwei Ziffern vom Jahr

	// $c = ( ( $year - $year % 1000 ) / 100  );  // erste zwei Ziffern vom Jahr
	$c = floor( $year / 100 );
	$d = $this->m_day;
	$m = $shifted_months[ $this->m_month - 1 ];


  // w = (d + [2,6 m – 0,2] + y + [y/4] + [c/4] – 2c) mod 7
	$w = ( $d + floor( 2.6 * $m - 0.2 )  + $y + floor( $y / 4 ) + floor( $c / 4 ) -  2 * $c  ) % 7;

	if ( $w < 0 ) $w += 7;

	// $w = ( $d + abs(floor( 2.6 * $m - 0.2 ))  + $y + abs(floor( $y / 4 )) + abs(floor( $c / 4 )) - abs(floor( 2 * $c)) ) % 7;

	// echo "\n y = $y c = $c d = $d m= $m w = $w  year = $year for " . $this->AsSQL( );

        assert( $w == $this->m_dow );		// TODO ganz auf eigene Berechnung umstellen

        if ( $w != $this->m_dow ) die(  "\n CalculateWeekday: dow = $w errechnet, ist aber " . $this->m_dow . " für month = $this->m_month day = $this->m_day year = $this->m_year");


    }   // function CalculateWeekday ( )


*/


// ===============================================================

    /**
      *
      * FromSQL() sets the internal day according to a SQL date string
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->FromSQL( '2017-12-22' );
      *
      * @param $str string the SQL string
      *
      * @see FromSQL
      * @see FromDate
      * @see FromDMY
      * @see FromMDY
      * @see FromTimeStamp
      *
      * @since = 1.0
      *
      */


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

    /**
      *
      * FromMDY() sets the internal day according to a MDY (month, day, year) date string
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->FromMDY( '12-22-2016' );
      *
      * @param $str string the MDY string
      *
      * @see FromSQL
      * @see FromDate
      * @see FromDMY
      * @see FromMDY
      * @see FromTimeStamp
      *
      * @since = 1.0
      *
      */

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

    /**
      *
      * FromDMY() sets the internal day according to a DMY (day,month,year) date string
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->FromDMY( '22.12.2016' );
      *
      * @see FromSQL
      * @see FromDate
      * @see FromDMY
      * @see FromMDY
      * @see FromTimeStamp
      *
      * @param $str string the DMY string
      *
      * @since = 1.0
      *
      */

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

    /**
      *
      * FromDate() sets the internal day according to another cDate
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->FromDate( new cDate( 1, 11, 2014 ) );
      *
      * @param $obj cDate the cDate to copy from
      *
      * @see FromSQL
      * @see FromDate
      * @see FromDMY
      * @see FromMDY
      * @see FromTimeStamp
      *
      * @since = 1.0
      *
      */

    public function FromDate( $obj ) {
        $this->m_timestamp = $obj->AsTimeStamp( );

        $this->ts2mdy( );
        $this->CalculateWeekday( );
    }   // public function FromDate

    /**
      *
      * FromTimestamp() sets the internal day according to a timestamp
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->FromDate( 20187 );
      *
      *
      * @param $ts int the timestamp to copy from
      *
      * @see FromSQL
      * @see FromDate
      * @see FromDMY
      * @see FromMDY
      * @see FromTimeStamp
      *
      * @since = 1.0
      *
      */


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


    /**
      *
      * Month0() returns the month part of the date with leading zeroes
      *
      * Example:
      *
      * ```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      *
      * ```
      *
      * @return string the month part with leading zeroes
      *
      * @see Month0
      * @see Month
      * @see Day0
      * @see Day
      * @see Year
      * @see TimeStamp
      *
      * @since = 1.0
      *
      */


    public function Month0( ){
    //
    // Monat als Zahl, mit f&uuml;hrenden Nullen  01 bis 12
    //

        return ( date("m", $this->AsTimeStamp() ) );
    }


    /**
      *
      * Day0() returns the day part of the date with leading zeroes
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->Day0(  );
      *
      * @return string the day part with leading zeroes
      *
      * @see Month0
      * @see Month
      * @see Day0
      * @see Day
      * @see Year
      * @see TimeStamp
      *
      * @since = 1.0
      *
      */


    public function Day0( ){
    //
    // Tag als Zahl, mit f&uuml;hrenden Nullen  01 bis 31
    //
        return ( date("d", $this->AsTimeStamp() ) );
    }

    /**
      *
      * Year() returns the year part of the date
      *
      * Example:
      *
      * ```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      *
      *      for ( $i = 0; $i < 12; $i++ ) {
      * 	$dt->GoFirstWeekOfMonthISO( );
      * 	echo "\n The first week of the month " . $dt->Month( ) . ' in ' . $dt->Year( ) . ' starts on the ' . $dt->AsSQL( );
      * 	echo '. The month has ' . $dt->WeeksOfMonth( ) . ' calendar weeks ';
      * 	$dt->AddMonths( );
      *      }
      * ```
      *
      * @return int the year part
      *
      * @see Month0
      * @see Month
      * @see Day0
      * @see Day
      * @see Year
      * @see TimeStamp
      *
      * @since = 1.0
      *
      */


    public function Year ( )
    {
        return $this->m_year;
    }  //  function Year ( )


    /**
      *
      * SetYear() sets the year part of the date
      *
      * Example:
      *
      * ```
      *      $dt = new \libdatephp\cDate( 1, 1, 2014 );
      *      for ( $i = 2013; $i < 2021; $i++ ) {
      * 	$dt->SetYear( $i );
      * 	$woy = $dt->WeeksOfYear( );
      * 	$dt = $dt->FirstWeekOfYearISO( );
      * 	echo "\n The first week of the ISO year " . $i . ' starts on the ' . $dt->AsSQL( );
      * 	echo '. The year has ' . $woy . ' calendar weeks ';
      * }
      * ```
      *
      * @param int $y the year part
      *
      * @see SetYear
      * @see SetMonth
      * @see SetDay
      * @see SetTimeStamp
      *
      * @since = 1.0
      *
      */

    public function SetYear ( $y )
    {

        assert( checkdate($this->m_month, $this->m_day, $y ));

        $this-> m_year = $y;

        $this->mdy2ts ( );
        $this->CalculateWeekday( );
    }  //  function SetYear ( )


    /**
      *
      * SetWOY() sets the date to the monday of the $w-th week in the year and searches then the first day of week $wd
      *
      * week numbers are one-based and start with 1. The first week in the year has the number 1
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->SetWOY( 24 );
      *
      * Example:
      * ```
      * $dt = new \libdatephp\cDate( 4, 28, 2017 );
      * $dt->SetWOY( 1 );
      * assert( $dt->WOY( ) == 1 );
      * assert( $dt -> eq( new \libdatephp\cDate( 1,2,2017) ) );
      * $dt->SetWOY( 18 );
      * assert( $dt->WOY( ) == 18 );
      * assert( $dt -> eq( new \libdatephp\cDate( 5,1,2017) ) );
      * $dt->SetWOY( 19, \libdatephp\cDate::DOW_THURSDAY );
      * assert( $dt->IsThursday( ) );
      * assert( $dt->eq( new \libdatephp\cDate( 5,11,2017) ) );
      * ```
      *
      * @param int $w the week number to set
      * @param int $wd the day of week to search. Defaults to DOW_MONDAY
      *
      * @see SetYear
      * @see SetMonth
      * @see SetDay
      * @see SetTimeStamp
      * @see SetWOY
      * @see GoWOM
      * @see SetWOQ
      *
      * @since = 1.0.1
      *
      * @Deprecated
      *
      */


    public function SetWOY ( $w, $wd = self::DOW_MONDAY )
    {

	$this->GoBOY( );

	$d = ( 7 * ( $w - 1 ) ) + 1;

	$secs = $d * 60 * 60 * 24;

	$this->m_timestamp += $secs;

	// echo "\n w = $w -> d = $d";

        // assert( checkdate($this->m_month, $d, $this->m_year ));

        $this->ts2mdy ( );
        $this->CalculateWeekday( );

        $this->SeekWeekday( $wd, self::SEEK_FORWARD );


    }  //  function SetWOY ( )


    /**
      *
      * MaxWeekday() returns the last possible weekday ( monday .. sunday ) for the actual week
      *
      * weekday numbers range from sunday (0) to saturday (6)
      *
      * Normally a week ranges from monday to sunday. But the first and last week of months and years do differ.
      *
      * Example:
      *
      * ```
      * ```
      *
      * @return int the last possible weekday of this week. 0 if the full week is available. 1 if up to monday, 2 upto tuesday ...
      *
      * @see GoWOM
      * @see SetWOY
      * @see MaxWeekday
      *
      * @since = 1.0.1
      *
      */


    public function MaxWeekday( ) {

	$dt = new cDate( $this );

	$month = $this->Month( );

	$dt->GoBOW( );

	// am Monatsende stehen oft nict alle Wohentage zur Verfügung
	for( $i = 0; $i < 7; $i++ ) {

	    if ( $this->Month( ) != $month ) {
		// echo "\n MaxWeekday liefert " . $i . " nach " . $dt->AsSQL( ) ;
		return $i;
	    }

	}

	return 0;

    }	// function MaxWeekday( )











    /**
      *
      * SetWOQ() sets the date to the monday of the $w-th week in the actual quarter and searches then the first day of week $wd
      *
      * week numbers are one-based and start with 1. The first week in the year has the number 1
      *
      * Example:
      *
      * ```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * assert( $dt->WOM( ) == 1 );
      * echo "\n wom = " . $dt->WOM();
      * $dt->GoWOM( 5 );
      * assert( $dt->WOM( ) == 5 );
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * $dt->GoWOM( 5, \libdatephp\cDate::DOW_THURSDAY );
      * assert( $dt->IsThursday( ) );
      * assert( $dt->eq( new \libdatephp\cDate( 2,2,2017) ) );
      * ```
      *
      * @param int $w the week number to set in the actual quarter
      * @param int $wd the day of week to search. Defaults to DOW_MONDAY
      *
      * @see SetYear
      * @see SetMonth
      * @see SetDay
      * @see SetTimeStamp
      * @see GoWOM
      * @see SetWOY
      * @see SetWOQ
      *
      * @since = 1.0.1
      *
      */


    public function SetWOQ ( $w, $wd = self::DOW_MONDAY )
    {


	assert( $w <= $this->WeeksInQuarter( ) );

	$this->GoBOQ( );

	$d = ( 7 * ( $w - 1 ) ) + 1;

	$secs = $d * 60 * 60 * 24;

	$this->m_timestamp += $secs;

	// echo "\n w = $w -> d = $d";

        // assert( checkdate($this->m_month, $d, $this->m_year ));

        $this->ts2mdy ( );
        $this->CalculateWeekday( );

        $this->SeekWeekday( $wd, self::SEEK_FORWARD );


    }  //  function SetWOQ ( )



    /**
      *
      * Month() returns the month part of the date without leading zeroes
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->Month(  );
      *
      * @return int the month without leading zeroes
      *
      * @see Month0
      * @see Month
      * @see Day0
      * @see Day
      * @see Year
      * @see TimeStamp
      *
      * @since = 1.0
      *
      */


    public function Month ( )
    {
        return $this->m_month;
    }  //  function Month ( )

    /**
      *
      * SetMonth() sets the month part of the date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->SetMonth( 11 );
      *
      * @param int $m the month part
      *
      * @see SetYear
      * @see SetMonth
      * @see SetDay
      * @see SetTimeStamp
      *
      * @since = 1.0
      *
      */


    public function SetMonth ( $m )
    {

	if ( $m < 1 || $m > 12 ) {
	    assert( true == false );
	    die( "\n SetMonth( $m )" );
	}

        assert( checkdate($m, $this->m_day, $this->m_year ));

        $this-> m_month = $m;

        $this->mdy2ts ( );
        $this->CalculateWeekday( );
    }  //  function SetMonth ( )

    /**
      *
      * Day() returns the day part of the date without leading zeroes
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->Day(  );
      *
      * @return int the day part without leading zeroes
      *
      * @see Month0
      * @see Month
      * @see Day0
      * @see Day
      * @see Year
      * @see TimeStamp
      *
      * @since = 1.0
      *
      */


    public function Day ( )
    {
        return $this->m_day;
    }  //  function Month ( )


    /**
      *
      * SetDay() sets the day part of the date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->SetDay( 24 );
      *
      * @param int $d the day part
      *
      * @see SetYear
      * @see SetMonth
      * @see SetDay
      * @see SetTimeStamp
      *
      * @since = 1.0
      *
      */


    public function SetDay ( $d )
    {

	if ( $d < 1 || $d > 31 ) {
	    assert( true == false );
	    die( "\n SetDay( $d )" );
	}

        assert( checkdate($this->m_month, $d, $this->m_year ));

        $this-> m_day = $d;

        $this->mdy2ts ( );
        $this->CalculateWeekday( );
    }  //  function SetMonth ( )

    /**
      *
      * TimeStamp() returns the timestamp of the date - same as AsTimeStamp( )
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->TimeStamp(  );
      *
      * @return int the timestamp
      *
      * @see Month0
      * @see Month
      * @see Day0
      * @see Day
      * @see Year
      * @see TimeStamp
      *
      * @since = 1.0
      *
      */


    public function TimeStamp ( )
    {
        return $this->m_timestamp;
    }  //  function TimeStamp ( )


    /**
      *
      * AsTimeStamp() returns the timestamp of the date - same as TimeStamp( )
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->TimeStamp(  );
      *
      * @return int the timestamp
      *
      * @see Month0
      * @see Month
      * @see Day0
      * @see Day
      * @see Year
      * @see TimeStamp
      *
      * @since = 1.0
      *
      */


    public function AsTimeStamp ( )
    {
        return $this->TimeStamp( );
    }  //  function TimeStamp ( )

    /**
      *
      * SetTimeStamp() sets the date according to a timestamp
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->SetTimeStamp( 116666 );
      *
      * @param int $j the timestamp
      *
      * @see SetYear
      * @see SetMonth
      * @see SetDay
      * @see SetTimeStamp
      *
      * @since = 1.0
      *
      */


    public function SetTimeStamp ( $j )
    {

        // assert( checkdate($this->m_month, $d, $this->m_year );

        $this-> m_timestamp = $j;
        $this->ts2mdy( );

        $this->CalculateWeekday( );

        assert( $this->AsTimeStamp() == $j);

    }  //  function SetTimeStamp ( )

    /**
      *
      * Weekday() returns the weekday of the date Is the same eas DOW( )
      *
      * The zero-based representation of the weekday will be returned (DOW_SUNDAY = 0 .. DOW_SATURDAY = 6).
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->Weekday( );
      *
      * @return int the weekday
      *
      * @see Weekday
      * @see DOW
      *
      * @since = 1.0
      *
      */


    public function Weekday ( )
    // zwischen 0 (f&uuml;r Sonntag) und 6 (f&uuml;r Samstag)
    {

	// static $ary_iso_weekday = array( 7, 1, 2, 3, 4, 5, 6 );

        return $this->m_dow;

    }  //  function Weekday ( )

    /**
      *
      * DOW() aka "Day Of Week" returns the day number of the date in the week. Same as Weekday( )
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->DOW( );
      *
      *
      * @return int the number of he day in the week
      *
      * @see DOQ
      * @see DOW
      * @see DOM
      * @see DOY
      *
      * @since = 1.0
      *
      */




    public function DOW (  )
    // zwischen 0 (f&uuml;r Sonntag) und 6 (f&uuml;r Samstag)
    {

        return $this->Weekday( );
    }  //  function DOW ( )

    /**
      *
      * DOM() aka "Day Of Month" returns the one-based day number of the date in the month
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->DOM( );
      *
      * @return int the number of he day in the month
      *
      * @see DOQ
      * @see DOW
      * @see DOM
      * @see DOY
      *
      * @since = 1.0
      *
      */

    public function DOM ( )
    // zwischen 1 und 31
    {
        return $this->m_day;
    }  //  function TimeStamp ( )

    /**
      *
      * DOY() aka "Day Of Year" returns the one-based day number of the date in the year
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->DOY( );
      *
      * @return int the number of he day in the year
      *
      * @see DOQ
      * @see DOW
      * @see DOM
      * @see DOY
      *
      * @since = 1.0
      *
      */


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

    }  //  function DOY ( )


    /**
      *
      * Quarter() returns the quarter of the year the date belongs to. Same as NOQ( )
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->Quarter( );
      *
      * @return int the number of he quarter
      *
      * @see Quarter
      * @see NOQ
      * @see NOW
      *
      * @since = 1.0
      *
      */


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

    /**
      *
      * NOQ() returns the quarter of the year the date belongs to. Same as Quarter( )
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->NOQ( );
      *
      * @return int the number of he quarter
      *
      * @see Quarter
      * @see NOQ
      * @see NOW
      *
      * @since = 1.0
      *
      */


    public function NOQ( ) {
        //
        // Number of Quarter
        //
        return $this->Quarter();

    }  // function NOQ( )


    /**
      *
      * WeeksOfMonth2() returns the number of weeks in the actual year the date belongs to. Split weeks are calculated as full weeks.
      *
      * Example:
      * ```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * echo "\n weeks of month = " . $dt->WeeksOfMonth( );
      * assert( $dt->WeeksOfMonth( ) == 5 );
      * ```
      *
      * @return int the week count of the actual month
      *
      * @see WeeksOfYear
      * @see WeeksOfMonth
      * @see WeeksInQuarter
      * @see NOW
      * @see WOY
      * @see WOM
      *
      * @since = 1.0
      *
      */

/*
    public function WeeksOfMonth2( ) {
    //
    // Number of Weeks in the actual month - one-based and starting NOT on first monday in the month
    //
    //  NOTE : ISO-8601 Wochennummer des Jahres, die Woche beginnt am Montag
    // TODO: WeeksInQuarter( )

	$dt = new cDate( $this );

	$dt->GoBOM();
	$week0 = $dt->NOW( true );

	$dt->GoEOM();
	$week1 = $dt->NOW( true );

	return ( $week1 - $week0 + 1 );

    }   // public function WeeksOfMonth2()

*/

    /**
      *
      * WeeksOfMonth() returns the number of calendar weeks in the actual year the date belongs to. The first week starts on the first monday
      *
      * Example:
      * ```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      *
      *      for ( $i = 0; $i < 12; $i++ ) {
      * 	$dt->GoFirstWeekOfMonthISO( );
      * 	echo "\n The first week of the month " . $dt->Month( ) . ' in ' . $dt->Year( ) . ' starts on the ' . $dt->AsSQL( );
      * 	echo '. The month has ' . $dt->WeeksOfMonth( ) . ' calendar weeks ';
      * 	$dt->AddMonths( );
      *      }
      * ```
      *
      * @return int the week count of the actual month
      *
      * @see WeeksOfYear
      * @see WeeksOfMonth
      * @see WeeksInQuarter
      * @see NOW
      * @see WOY
      * @see WOM
      *
      * @since = 1.0
      *
      */




    /**
      *
      * WOY() returns the ISO number of the week in the year the date belongs to. Same as NOW()
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->WOY( );
      *
      * @return int the number of he week
      *
      * @see Quarter
      * @see NOQ
      * @see NOW
      * @see WOY
      * @see WOM
      *
      * @since = 1.0
      *
      */


    public function WOY( ) {
    //
    // Number of Week of year
    //
    //  NOTE : ISO-8601 Wochennummer des Jahres, die Woche beginnt am Montag
    //
        return ( $this->NOW( ) );

    }   // public function WOY()

    /**
      *
      * WOM() returns the one-based number of the week in the month the date belongs to.
      *
      * Example:
      *
      * ```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * assert( $dt->WOM( ) == 1 );
      * echo "\n wom = " . $dt->WOM();
      * $dt->GoWOM( 5 );
      * assert( $dt->WOM( ) == 5 );
      * ```
      *
      * @return int the number of he week in the month
      *
      * @see Quarter
      * @see NOQ
      * @see NOW
      * @see WOY
      * @see WOM
      * @see WOQ
      *
      * @since = 1.0
      *
      */


    public function WOM() {
    //
    // Number of Week of month
    //

        $week0 = $this->BOM()->NOW();
        $week1 = $this->NOW();

        return ( $week1 - $week0 ) + 1;
    }   // public function WOM()





    /**
      *
      * WOQ( ) returns the one-based number of the week in the quarter the date belongs to.
      *
      * Example:
      *
      * ```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * assert( $dt->WOQ( ) == 1 );
      * echo "\n woq = " . $dt->WOQ();
      * $dt->GoWOM( 5 );
      * assert( $dt->WOQ( ) == 5 );
      * $dt->SetDate( 4, 28, 2017 );
      * echo "\n woq = " . $dt->WOQ();
      * assert( $dt->WOQ( ) == 5 );
      * ```
      *
      * @return int the number of he week in the month
      *
      * @see Quarter
      * @see NOQ
      * @see NOW
      * @see WOY
      * @see WOM
      * @see WOQ
      *
      * @since = 1.0
      *
      */


    public function WOQ( ) {
    //
    // Number of Week of month
    //

        $week0 = $this->BOQ( )->NOW( true );
        $week1 = $this->NOW( true );

        if ( $week0 > $week1 ) $week0 = 1;	// erste Woche des Jahres kann die Wochennummer vom letzten Jahr liefern


        // echo "\n WOM: $week1 - $week0 + 1 = " . ( ( $week1 - $week0 ) + 1 );

        return ( $week1 - $week0 ) + 1;

    }   // public function WOQ( )


    /**
      *
      * IsSommerzeit() returns true, if the date is in DST  Same as IsDST( ).
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->IsSommerzeit( ) ) do_someting( );
      *
      * @return bool true if the date is in DST
      *
      * @see IsSommerzeit
      * @see IsDST
      *
      * @since = 1.0
      *
      */


    public function IsSommerzeit( ) {
        return ( date("I", $this->AsTimeStamp( ) ) );
    }


    /**
      *
      * IsDST() returns true, if the date is in DST  Same as IsSommerzeit( ).
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->IsDST( ) ) do_someting( );
      *
      * @return bool true if the date is in DST
      *
      * @see IsSommerzeit
      * @see IsDST
      *
      * @since = 1.0
      *
      */


    public function IsDST( ) {
        return $this->IsSommerzeit( );
    }

    /**
      *
      * _leapyear() returns true, if the year $year is a leap year.
      *
      * Example:
      * ```
      * ```
      *
      * @param int $year the year to check
      *
      * @return bool true if $year is a leap year
      *
      * @since = 1.0
      *
      */


    protected function _leapyear( $year ) {

	/*
	Ein normales Jahr beinhaltet 52 Wochen, wenn es kein Schaltjahr ist. Wenn ein normales Jahr mit einem Donnerstag beginnt und auch endet, ist es 53 Wochen lang. Ein Schaltjahr besteht ebenfalls aus 53 Kalenderwochen, fängt entweder mit einem Mittwoch an und endet mit einem Donnerstag oder fängt mit einem Donnerstag an und wird mit einem Freitag beendet. Warum hat ein Schaltjahr einen Tag mehr, als ein normales Jahr? Die Erde dreht sich in 365 Tage und 6 Stunden um die Sonne, also mehr als der Kalender mit ganzen Tagen aufweist. Dies würde mit der Zeit nicht unbemerkt bleiben. Weihnachten würde irgendwann im Sommer stattfinden. Um diese Ungenauigkeit auszugleichen, wurde alle vier Jahre ein zusätzlicher Tag, der 29. Februar eingeführt. Zusätzlich entfällt das Schaltjahr bei Jahren die durch 100 teilbar sind, aber nicht durch 400 teilbar sind, wie in den Jahren 1700, 1800 und 1900.
	*/

        // return ( date("L", $this->AsTimeStamp( ) ) );

        $isleap = false;

	if( !( $year % 4 ) )
	{
	    if( $year % 100 ) $isleap = true;
	    else if( !( $year % 400 ) ) $isleap = true;
	}

	return $isleap;

    }    // function _leapyear( )


    /**
      *
      * IsLeapYear() returns true, if the date is a leap year.
      *
      * Example:
      * ```
      * $dt = new \libdatephp\cDate( 1, 1, 2014 );
      *      for ( $i = 0; $i < 50; $i++ ) {
      * 	if ( $dt->IsLeapYear( ) ) {
      * 	    echo "\n " . $dt->Year( ) . ' is a leapyear';
      * 	}
      * 	$dt->AddYears( );
      *
      *      }
      * ```
      *
      * @return bool true if the date is a leap year
      *
      * @since = 1.0
      *
      */


    public function IsLeapYear( ) {

	/*
	Ein normales Jahr beinhaltet 52 Wochen, wenn es kein Schaltjahr ist. Wenn ein normales Jahr mit einem Donnerstag beginnt und auch endet, ist es 53 Wochen lang. Ein Schaltjahr besteht ebenfalls aus 53 Kalenderwochen, fängt entweder mit einem Mittwoch an und endet mit einem Donnerstag oder fängt mit einem Donnerstag an und wird mit einem Freitag beendet. Warum hat ein Schaltjahr einen Tag mehr, als ein normales Jahr? Die Erde dreht sich in 365 Tage und 6 Stunden um die Sonne, also mehr als der Kalender mit ganzen Tagen aufweist. Dies würde mit der Zeit nicht unbemerkt bleiben. Weihnachten würde irgendwann im Sommer stattfinden. Um diese Ungenauigkeit auszugleichen, wurde alle vier Jahre ein zusätzlicher Tag, der 29. Februar eingeführt. Zusätzlich entfällt das Schaltjahr bei Jahren die durch 100 teilbar sind, aber nicht durch 400 teilbar sind, wie in den Jahren 1700, 1800 und 1900.
	*/

	$is_leap = $this->_leapyear( $this->m_year );

	assert( ( date("L", $this->AsTimeStamp( ) ) ) == $is_leap );	// TODO Überprüfung rausnehmen

	return $is_leap;

    }

// ===============================================================

    /**
      *
      * AsSQL() returns the SQL representation of the date
      *
      * Example:
      *
      * ```
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      *
      *      for ( $i = 0; $i < 12; $i++ ) {
      * 	$dt->GoFirstWeekOfMonthISO( );
      * 	echo "\n The first week of the month " . $dt->Month( ) . ' in ' . $dt->Year( ) . ' starts on the ' . $dt->AsSQL( );
      * 	echo '. The month has ' . $dt->WeeksOfMonth( ) . ' calendar weeks ';
      * 	$dt->AddMonths( );
      *      }
      * ```
      *
      * @return string the SQL string
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */

    public function AsSQL ( )
    {

        //return "$this->m_year-$this->m_month-$this->m_day";
        if ( is_null( $this ) ) throw new \Exception( "\n cDate::AsSQL() mit NULL" );
        return sprintf( '%4d-%02d-%02d', $this->m_year, $this->m_month, $this->m_day );

    }   // public function AsSQL ( )

    /**
      *
      * AsMDY() returns the MDY (month, day, year) representation of the date without leading zeroes
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->AsMDY( );
      *
      * @return string the MDY string
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */


    public function AsMDY ( )
    {

        return "$this->m_month/$this->m_day/$this->m_year";

    }   // public function AsMDY ( )

    /**
      *
      * AsDMY() returns the DMY (day, month, year) representation of the date without leading zeroes
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->AsDMY( );
      *
      * @return string the DMY string
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */


    public function AsDMY ( )
        // 1.1.2008
    {

        // return "$this->m_day.$this->m_month.$this->m_year";
        return sprintf( '%02d.%02d.%4d', $this->m_day, $this->m_month, $this->m_year );

    }   // public function AsDMY ( )

    /**
      *
      * AsDMY0() returns the DMY (day, month, year) representation of the date with leading zeroes
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->AsDMY( );
      *
      * @return string the DMY string
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */


    public function AsDMY0 ( )
        // mit f&uuml;hrenden Nullen : 31.01.2008
    {
        $m = $this->Month0();;
        $d = $this->Day0();
        return "$d.$m.$this->m_year";

    }


    /**
      *
      * AsMDY0() returns the MDY (month, day, year) representation of the date with leading zeroes
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->AsMDY0( );
      *
      * @return string the MDY string
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */

    public function AsMDY0 ( )
        // mit f&uuml;hrenden Nullen : 01/31/2008
    {
        $m = $this->Month0();;
        $d = $this->Day0();

        return "$m/$d/$this->m_year";

    }   // public function AsMDY0 ( )

    /**
      *
      * AsUTC() returns the UTC representation of the date - with an offset of the timezone in seconds
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->AsUTC( );
      *
      * @return string the date string with the UTC
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */


    public function AsUTC () {

    // Offset der Zeitzone in Sekunden.
    // Der Offset f&uuml;r Zeitzone West nach UTC ist immer negativ und
    // f&uuml;r Zeitzone Ost nach UTC immer positiv.
    // -43200 bis 43200

        return date ( "Z", $this->AsTimeStamp() );
    }   // public function AsUTC()

    /**
      *
      * AsAMPM() returns the representation of the date - with AM (ante meridiem) / PM (post meridiem) in uppercase
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->AsAMPM( );
      *
      * @return string the date string with AM/PM
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */


    public function AsAMPM() {
        // Gro&szlig;geschrieben: Ante meridiem und Post meridiem  AM oder PM
        return ( date("A", $this->AsTimeStamp() ) );
    }

    /**
      *
      * As_AMPM() returns the representation of the date - with AM (ante meridiem) / PM (post meridiem) in lowercase
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->As_ampm( );
      *
      * @return string the date string with am/pm
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */


    public function As_ampm() {
    // Kleingeschrieben: Ante meridiem und Post meridiem  am oder pm
        return ( date("a", $this->AsTimeStamp() ) );
    }


    /**
      *
      * AsSwatch() returns the representation of the date as Swatch Internet time
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->AsSwatch( );
      *
      * @return string the date as swatch
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */


    public function AsSwatch() {
        // Swatch-Internet-Zeit  000 bis 999

        return ( date("B", $this->AsTimeStamp() ) );
    }

    /**
      *
      * AsISO8601() returns the ISO representation of the date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->AsISO8601( );
      *
      * @return string the date string in ISO format
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */


    public function AsISO8601() {
        // 2004-02-12T15:19:21+00:00

        return ( date("A", $this->AsTimeStamp() ) );
    }

    /**
      *
      * AsRFC2822() returns the RFC representation of the date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->AsRFC2822( );
      *
      * @return string the date string with am/pm
      *
      * @see AsSQL
      * @see AsMDY
      * @see AsDMY
      * @see AsMDY0
      * @see AsDMY0
      * @see AsUTC
      * @see AsAMPM
      * @see As_ampm
      * @see AsSwatch
      * @see AsISO8601
      * @see AsRFC2822
      *
      * @since = 1.0
      *
      */


    public function AsRFC2822() {
        // Beispiel: Thu, 21 Dec 2000 16:01:07 +0200

        return ( date("A", $this->AsTimeStamp() ) );
    }

// ===============================================================


    /**
      *
      * GoBOY() aka "Go to bottom of year" sets the date to the start ( january 1st) of the year of the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->GoBOY( );
      *
      * @see GoBOM
      * @see GoBOQ
      * @see GoBOW
      * @see GoBOY
      * @see GoEOM
      * @see GoEOQ
      * @see GoEOW
      * @see GoEOY
      *
      * @since = 1.0
      *
      */


    public function GoBOY ( )
    {

        $this->SetDay(1);
        $this->SetMonth(1);

    }   // public function GoBOY ( )


    /**
      *
      * GoBOM() aka "Go to bottom of month" sets the date to the start ( 1st) of the month of the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->GoBOM( );
      *
      * @see GoBOM
      * @see GoBOQ
      * @see GoBOW
      * @see GoBOY
      * @see GoEOM
      * @see GoEOQ
      * @see GoEOW
      * @see GoEOY
      *
      * @since = 1.0
      *
      */


    public function GoBOM ( )
    {

        $this->SetDay(1);

    }   // public function GoBOM ( )

    /**
      *
      * GoBOQ() aka "Go to bottom of quarter" sets the date to the start ( 1st day ) of the quarter of the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->GoBOQ( );
      *
      * @see GoBOM
      * @see GoBOQ
      * @see GoBOW
      * @see GoBOY
      * @see GoEOM
      * @see GoEOQ
      * @see GoEOW
      * @see GoEOY
      *
      * @since = 1.0
      *
      */


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

    /**
      *
      * GoBOW() aka "Go to bottom of week" sets the date to the start ( sunday ) of the week of the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->GoBOW( );
      *
      * @see GoBOM
      * @see GoBOQ
      * @see GoBOW
      * @see GoBOY
      * @see GoEOM
      * @see GoEOQ
      * @see GoEOW
      * @see GoEOY
      *
      * @since = 1.0
      *
      */


    public function GoBOW ( )
    {
        $this->m_timestamp -= ($this->DOW( ) * (60*60*24));
        $this->ts2mdy( );

    }   // public function GoBOW ( )

// ===============================================================

    /**
      *
      * GoEOY()  aka "Go to end of year" sets the date to the end ( December 31nd ) of the year of the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->GoEOY( );
      *
      * @see GoBOM
      * @see GoBOQ
      * @see GoBOW
      * @see GoBOY
      * @see GoEOM
      * @see GoEOQ
      * @see GoEOW
      * @see GoEOY
      *
      * @since = 1.0
      *
      */


    public function GoEOY ( )
    {

        $this->SetDate(12,31,$this->m_year);

    }   // public function GoEOY ( )

    /**
      *
      * GoEOM() aka "Go to bottom of month" sets the date to the end ( last day) of the month of the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->GoEOM( );
      *
      * @see GoBOM
      * @see GoBOQ
      * @see GoBOW
      * @see GoBOY
      * @see GoEOM
      * @see GoEOQ
      * @see GoEOW
      * @see GoEOY
      *
      * @since = 1.0
      *
      */


    public function GoEOM ( )
    {

    $year = $this->m_year;
    $month = $this->m_month;

    $month++;
    if ( $month > 12 ) {
        $year++;
        $month = 1;
    }

    $this->SetDate( $month, 1, $year );  // n&auml;chster Monatserster

     $this->Dec( );                                  // 1 Tag zur&uuml;ck

    }   // public function GoEOM ( )


    /**
      *
      * GoEOQ() aka "Go to end of quarter" sets the date to the end ( last day ) of the quarter of the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->GoEOQ( );
      *
      * @see GoBOM
      * @see GoBOQ
      * @see GoBOW
      * @see GoBOY
      * @see GoEOM
      * @see GoEOQ
      * @see GoEOW
      * @see GoEOY
      *
      * @since = 1.0
      *
      */


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


    /**
      *
      * GoEOW() aka "Go to end of week" sets the date to the start ( saturday ) of the week of the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->GoEOW( );
      *
      * @see GoBOM
      * @see GoBOQ
      * @see GoBOW
      * @see GoBOY
      * @see GoEOM
      * @see GoEOQ
      * @see GoEOW
      * @see GoEOY
      *
      * @since = 1.0
      *
      */


    public function GoEOW ( )
    {
        $this->m_timestamp += ( 6 - $this->DOW( ) ) * 60*60*24;
        $this->ts2mdy( );

    }   // public function GoEOW ( )

// ===============================================================

    /**
      *
      * Inc() increments the managed date ( sets the date to the next day)
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->Inc( );
      *
      * @see Inc
      * @see Dec
      * @see Skip
      *
      * @since = 1.0
      *
      */


    public function Inc ( )
    {
        $this->m_timestamp += 60*60*24;
        $this->ts2mdy( );

    }   // public function Inc ( )

    /**
      *
      * Dec() decrements the managed date ( sets the date to the previous day)
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->Dec( );
      *
      * @see Inc
      * @see Dec
      * @see Skip
      *
      * @since = 1.0
      *
      */


    public function Dec ( )
    {
        $this->m_timestamp -= 60*60*24;
        $this->ts2mdy( );

    }   // public function Dec ( )


    /**
      *
      * Skip() adds / subtracts $count days to / from  the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->Skip( -14 );
      *
      * @param int $count the number  of days to add / subtract from the date
      *
      * @see Inc
      * @see Dec
      * @see Skip
      *
      * @since = 1.0
      *
      */


    public function Skip ( $count = 1 )
    {
        if ($count != 0 ) {


            $diff = ( ( 60 * 60 * 24 ) * $count );

            $this->m_timestamp += $diff;

            // echo "\n neuer timestamp = {$this->m_timestamp}";

            $this->ts2mdy( );

            // echo "\n timestamp nach t2mdy( ) = {$this->m_timestamp} ->" . $this->AsSQL( );

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

    /**
      *
      * IsWeekday() returns true, if the date is a weekday
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->IsWeekday( ) ) do_someting( );
      *
      * @return bool true, if the date is a weekday
      *
      * @see IsWeekday
      * @see IsWeekend
      *
      * @since = 1.0
      *
      */


    public function IsWeekday ( ) {
        return ($this->m_dow >0) && ($this->m_dow <6);
    }   // public function IsWeekday ( )

    /**
      *
      * IsWeekend() returns true, if the date is a weekend
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->IsWeekend( ) ) do_someting( );
      *
      * @return bool true, if the date is weekend
      *
      * @see IsWeekday
      * @see IsWeekend
      *
      * @since = 1.0
      *
      */


    public function IsWeekend ( ) {
        return ( ! $this->IsWeekday( ) );
    }   // public function IsWeekend ( )


// ===============================================================

    /**
      *
      * SetToday() sets the date on today
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->SetToday( );
      *
      * @see SetToday
      * @see SetDate
      *
      * @since = 1.0
      *
      */


    public function SetToday( ) {

        $datum = getdate( );

        $this->m_day = $datum["mday"];
        $this->m_year = $datum["year"];
        $this->m_month = $datum["mon"];

        assert( checkdate($this->m_month, $this->m_day, $this->m_year ));

        $this->mdy2ts ( );
        $this->CalculateWeekday( );


    }   // public function SetToday()


    /**
      *
      * SetDate() sets the date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->SetDate( 4, 21, 2012 );
      *
      * @param mixed $m the month [1..12] or a cDate variable
      * @param int $d the day [1..31]
      * @param int $y the year
      *
      * @see SetToday
      * @see SetDate
      *
      * @since = 1.0
      *
      */

    public function SetDate( $m, $d = null, $y = null ) {

        # echo "cDate : SetDate( $m, $d, $y)";

        if ( is_a( $m, '\rstoetter\libdatephp\cDate' ) ) {
	    $this->m_year = $m->Year( );
	    $this->m_month = $m->Month( );
	    $this->m_day = $m->Day( );

        } else {

	    if( ! checkdate( $m, $d, $y ) ) {
		debug_print_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
		throw new \Exception( "\n cDate::SetDate( $m, $d, $y  )  ist ungültig" );
	    }

	    if ( is_a( $m, '\rstoetter\libdatephp\cDate' ) ) {

		$y = $m->Year( );
		$m = $m->Month( );
		$d = $m->Day( );


	    }

	    if ( ! checkdate($m, $d, $y)) {
		// var_dump( debug_backtrace( ) );
		// print_r( debug_backtrace( ) );
		assert( false == true );
		print "<br>Monat=$m Tag = $d Jahr = $y";
	    }


	    $this->m_year = $y;
	    $this->m_month = $m;
	    $this->m_day = $d;
	}

        $this->mdy2ts ( );
        $this->CalculateWeekday( );

        if ( is_a( $m, '\rstoetter\libdatephp\cDate' ) ) assert( $this->AsSQL( )  == $m->AsSQL( ));

    }  // function SetDate( )

// ===============================================================




    /**
      *
      * IsPast() returns true, if the managed date is in the future
      *
      * Example:
      *
      *
      * @return boolean returns true, if the managed date is in the future
      *
      * @see IsYesterday
      * @see IsToday
      * @see IsTomorrow
      * @see IsFuture
      * @see IsPast
      * @see IsCurrentMonth
      * @see IsCurrentYear
      *
      * @since = 1.0
      *
      */



    public function IsPast( ) {

            $dt = new cDate( ) ;

            return $dt->gt( $this ) ;

    }   // public function IsPast( )


    /**
      *
      * IsFuture() returns true, if the managed date is in the future
      *
      * Example:
      *
      *
      * @return boolean returns true, if the managed date is in the future
      *
      * @see IsYesterday
      * @see IsToday
      * @see IsTomorrow
      * @see IsFuture
      * @see IsPast
      * @see IsCurrentMonth
      * @see IsCurrentYear
      *
      * @since = 1.0
      *
      */



    public function IsFuture( ) {

            $dt = new cDate( ) ;

            return $dt->le( $this ) ;

    }   // public function IsFuture( )


    /**
      *
      * IsToday( ) returns true, if the managed date is tomorrow
      *
      * Example:
      *
      *
      * @return boolean returns true, if $cmp is today
      *
      * @see IsYesterday
      * @see IsToday
      * @see IsTomorrow
      * @see IsFuture
      * @see IsPast
      * @see IsCurrentMonth
      * @see IsCurrentYear
      *
      * @since = 1.0
      *
      */



    public function IsToday( ) {

            $dt = new cDate( ) ;

            return $dt->eq( $this ) ;

    }   // public function IsToday( )


    /**
      *
      * IsTomorrow( ) returns true, if the managed date is tomorrow
      *
      * Example:
      *
      *
      * @return boolean returns true, if the managed date is tomorrow
      *
      * @see IsYesterday
      * @see IsToday
      * @see IsTomorrow
      * @see IsFuture
      * @see IsPast
      * @see IsCurrentMonth
      * @see IsCurrentYear
      *
      * @since = 1.0
      *
      */



    public function IsTomorrow( ) {

            $dt = new cDate( ) ;
            $dt->Inc( );

            return $dt->eq( $this ) ;

    }   // public function IsTomorrow( )

    /**
      *
      * IsYesterday() returns true, if the managed date is yesterday
      *
      * Example:
      *
      *
      * @return boolean returns true, if the managed date is yesterday
      *
      * @see IsYesterday
      * @see IsToday
      * @see IsTomorrow
      * @see IsFuture
      * @see IsPast
      * @see IsCurrentMonth
      * @see IsCurrentYear
      *
      * @since = 1.0
      *
      */



    public function IsYesterday( ) {

            $dt = new cDate( ) ;
            $dt->Dec( );

            return $dt->eq( $this ) ;

    }   // public function IsYesterday( )

    /**
      *
      * IsCurrentYear() returns true, if the managed date is in the current year
      *
      * Example:
      *
      *
      * @return boolean returns true, if the managed date is in the current year
      *
      * @see IsYesterday
      * @see IsToday
      * @see IsTomorrow
      * @see IsFuture
      * @see IsPast
      * @see IsCurrentMonth
      * @see IsCurrentYear
      *
      * @since = 1.0
      *
      */



    public function IsCurrentYear( ) {

            $dt = new cDate( ) ;

            return $dt->Year( ) == $this->Year( ) ;

    }   // public function IsCurrentYear( )


    /**
      *
      * IsCurrentYear() returns true, if the managed date is in the current year
      *
      * Example:
      *
      *
      * @return boolean returns true, if the managed date is in the current year
      *
      * @see IsYesterday
      * @see IsToday
      * @see IsTomorrow
      * @see IsFuture
      * @see IsPast
      * @see IsCurrentMonth
      * @see IsCurrentYear
      *
      * @since = 1.0
      *
      */



    public function IsCurrentMonth( ) {

            $dt = new cDate( ) ;

            return ( $dt->Year( ) == $this->Year( ) ) && ( $dt->Month( ) == $this->Month( ) );

    }   // public function IsCurrentMonth( )


    /**
      *
      * Min() returns the minimum value between $cmp and the the managed date
      *
      * Example:
      *
      *
      * @param mixed $cmp timestamp or cDate
      *
      * @return cDate returns the minimum value
      *
      * @see min
      * @see max
      *
      * @since = 1.0
      *
      */



    public function Min( $cmp ) {

        if ( is_int( $cmp ) ) {


            return new cDate( min( $cmp, $this->m_timestamp ) );

        } elseif ( is_a( $cmp, "rstoetter\libdatephp\cdate" ) ) {
            # print "<br>" . $cmp->AsTimeStamp() . "<->" . $this->AsTimeStamp();

            if ( $cmp->lt( $this ) ) return new cDate( $cmp );

            return new cDate( $this );

        }

        var_dump( $cmp );
        die( "\n error in cDate::Min( ) " );

        // NOTE : TODO : Tagesgenaue Berechnung => Minuten sind wurscht

    }   // public function Min()

    /**
      *
      * Max() returns the maximum value between $cmp and the the managed date
      *
      * Example:
      *
      *
      * @param mixed $cmp timestamp or cDate
      *
      * @return cDate returns the maximum value
      *
      * @see min
      * @see max
      *
      * @since = 1.0
      *
      */



    public function Max( $cmp ) {

        if ( is_int( $cmp ) ) {


            return new cDate( max( $cmp, $this->m_timestamp ) );

        } elseif ( is_a( $cmp, "rstoetter\libdatephp\cdate" ) ) {
            # print "<br>" . $cmp->AsTimeStamp() . "<->" . $this->AsTimeStamp();

            if ( $cmp->gt( $this ) ) return new cDate( $cmp );

            return new cDate( $this );

        }

        var_dump( $cmp );
        die( "\n error in cDate::Max( ) " );
        var_dump( $cmp );

        // NOTE : TODO : Tagesgenaue Berechnung => Minuten sind wurscht

    }   // public function Max()

    /**
      *
      * eq() aka "equals" returns true, if the date is the same as the date in the parameter
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->eq( cDate( ) ) ) do_someting( );
      *
      * @param mixed $cmp timestamp or cDate
      *
      * @return bool returns true, if both dates are equal
      *
      * @see eq
      * @see le
      * @see ge
      * @see lt
      * @see gt
      *
      * @since = 1.0
      *
      */



    public function eq( $cmp ) {

        if (is_int( $cmp ) ) {
            return $cmp == $this->m_timestamp;
        } elseif ( is_a( $cmp, "rstoetter\libdatephp\cdate" ) ) {
            # print "<br>" . $cmp->AsTimeStamp() . "<->" . $this->AsTimeStamp();
            return ($cmp->Month()==$this->Month()) && ($cmp->Year()==$this->Year()) && ($cmp->Day()==$this->Day());
            # funktioniert nicht immer !   return $cmp->AsTimeStamp() == $this->AsTimeStamp();
        }

        throw new \Exception("\n error in cDate::eq()");

        // NOTE : TODO : Tagesgenaue Berechnung => Minuten sind wurscht

    }   // public function eq()

    /**
      *
      * lt() aka "less than" returns true, if the date is before the date $cmp
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->lt( cDate( ) ) ) do_someting( );
      *
      * @param mixed $cmp timestamp or cDate
      *
      * @return bool returns true, if the managed date comes before $cmp
      *
      * @see eq
      * @see le
      * @see ge
      * @see lt
      * @see gt
      *
      * @since = 1.0
      *
      */


    public function lt( $cmp ) {

        if (is_int( $cmp ) ) {
            return $cmp < $this->m_timestamp;
        } elseif ( is_a( $cmp, "rstoetter\libdatephp\cDate" ) ) {

            return $this->AsTimeStamp( ) < $cmp->AsTimeStamp( );
        } else  {
            throw new \Exception("\n error in cDate::lt()");
        }

        // NOTE : TODO : Tagesgenaue Berechnung => Minuten sind wurscht

    }   // public function lt()

    /**
      *
      * gt() aka "greater than" returns true, if the date is after $cmp
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->gt( cDate( ) ) ) do_someting( );
      *
      * @param mixed $cmp timestamp or cDate
      *
      * @return bool returns true, if the managed date comes after $cmp
      *
      * @see eq
      * @see le
      * @see ge
      * @see lt
      * @see gt
      *
      * @since = 1.0
      *
      */


    public function gt( $cmp ) {

        if (is_int( $cmp ) ) {
            return $cmp > $this->m_timestamp;
        } elseif ( is_a( $cmp, '\rstoetter\libdatephp\cDate' ) ) {


            return  $this->AsTimeStamp() > $cmp->AsTimeStamp();
        }


        throw new \Exception("\n error in cDate::gt()");

        // NOTE : TODO : Tagesgenaue Berechnung => Minuten sind wurscht

    }   // public function gt()

    /**
      *
      * ge() aka "greater equal" returns true, if the date is the same as $cmp or comes after $cmp
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->ge( cDate( ) ) ) do_someting( );
      *
      * @param mixed $cmp timestamp or cDate
      *
      * @return bool returns true, if the managed date is the same as $cmp or comes after $cmp
      *
      * @see eq
      * @see le
      * @see ge
      * @see lt
      * @see gt
      *
      * @since = 1.0
      *
      */

    public function ge( $cmp ) {
        return $this->eq( $cmp ) || $this->gt( $cmp );
    }

    /**
      *
      * le() aka "lesser equal" returns true, if the date is the same as $cmp or comes before $cmp
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * if ( $dt->le( cDate( ) ) ) do_someting( );
      *
      * @param mixed $cmp timestamp or cDate
      *
      * @return bool returns true, if the managed date is the same as $cmp or comes before $cmp
      *
      * @see eq
      * @see le
      * @see ge
      * @see lt
      * @see gt
      *
      * @since = 1.0
      *
      */


    public function le( $cmp ) {
        return $this->eq( $cmp ) || $this->lt( $cmp );
    }

// ===============================================================

    /**
      *
      * BOW() aka "bottom of week" returns the cDate value of the day which is the first day ( sunday ) of the week the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->BOW( )->AsSQL( );
      *
      * @return cDate the first day of the week of the managed date
      *
      * @see BOW
      * @see EOW
      * @see BOM
      * @see EOM
      * @see BOQ
      * @see EOQ
      * @see BOY
      * @see EOY
      *
      * @since = 1.0
      *
      */

    public function BOW( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoBOW( );
        return $obj;
    }   // public function BOW( )


    /**
      *
      * EOW() aka "end of week" returns the cDate value of the day which is the last day ( saturday ) of the week the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->EOW( )->AsSQL( );
      *
      * @return cDate the last day of the week of the managed date
      *
      * @see BOW
      * @see EOW
      * @see BOM
      * @see EOM
      * @see BOQ
      * @see EOQ
      * @see BOY
      * @see EOY
      *
      * @since = 1.0
      *
      */


    public function EOW( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoEOW( );
        return $obj;
    }   // public function EOW( )

    /**
      *
      * BOM() aka "bottom of month" returns the cDate value of the day which is the first day ( 1 st ) of the month the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->BOM( )->AsSQL( );
      *
      * @return cDate the first day of the month of the managed date
      *
      * @see BOW
      * @see EOW
      * @see BOM
      * @see EOM
      * @see BOQ
      * @see EOQ
      * @see BOY
      * @see EOY
      *
      * @since = 1.0
      *
      */


    public function BOM( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoBOM( );
        return $obj;
    }   // public function BOM( )

    /**
      *
      * EOM() aka "end of month" returns the cDate value of the day which is the last day of the month the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->EOM( )->AsSQL( );
      *
      * @return cDate the last day of the month of the managed date
      *
      * @see BOW
      * @see EOW
      * @see BOM
      * @see EOM
      * @see BOQ
      * @see EOQ
      * @see BOY
      * @see EOY
      *
      * @since = 1.0
      *
      */


    public function EOM( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoEOM( );
        return $obj;
    }   // public function EOM( )

    /**
      *
      * BOQ() aka "bottom of quarter" returns the cDate value of the day which is the first day of the quarter the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->BOQ( )->AsSQL( );
      *
      * @return cDate the first day of the quarter of the managed date
      *
      * @see BOW
      * @see EOW
      * @see BOM
      * @see EOM
      * @see BOQ
      * @see EOQ
      * @see BOY
      * @see EOY
      *
      * @since = 1.0
      *
      */


    public function BOQ( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoBOQ( );
        return $obj;
    }   // public function BOQ( )

    /**
      *
      * EOQ() aka "bottom of quarter" returns the cDate value of the day which is the last day of the quarter the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->EOQ( )->AsSQL( );
      *
      * @return cDate the first day of the quarter of the managed date
      *
      * @see BOW
      * @see EOW
      * @see BOM
      * @see EOM
      * @see BOQ
      * @see EOQ
      * @see BOY
      * @see EOY
      *
      * @since = 1.0
      *
      */


    public function EOQ( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoEOQ( );
        return $obj;
    }   // public function EOQ( )

    /**
      *
      * BOY() aka "bottom of year" returns the cDate value of the day which is the first day ( January 1st ) of the year the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->BOY( )->AsSQL( );
      *
      * @return cDate the first day of the year of the managed date
      *
      * @see BOW
      * @see EOW
      * @see BOM
      * @see EOM
      * @see BOQ
      * @see EOQ
      * @see BOY
      * @see EOY
      *
      * @since = 1.0
      *
      */


    public function BOY( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoBOY( );
        return $obj;
    }   // public function BOY( )

    /**
      *
      * EOY() aka "end of year" returns the cDate value of the day which is the last day ( December 31th ) of the year the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->EOY( )->AsSQL( );
      *
      * @return cDate the last day of the year of the managed date
      *
      * @see BOW
      * @see EOW
      * @see BOM
      * @see EOM
      * @see BOQ
      * @see EOQ
      * @see BOY
      * @see EOY
      *
      * @since = 1.0
      *
      */

    public function EOY( ) {
        $obj = new cDate( $this->AsTimeStamp( ) );
        $obj->GoEOY( );
        return $obj;
    }   // public function EOY( )

// ===============================================================

    /**
      *
      * AddDays() adds / subtracts $diff days to / from the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->AddDays( 12 )->AsSQL( );
      *
      * @param int $diff the number of days to add / subtract. It defaults to 1
      *
      * @see AddDays
      * @see AddMonths
      * @see AddWeekdays
      * @see AddWeeks
      * @see AddYears
      *
      * @since = 1.0
      *
      */


    public function AddDays( $diff = 1) {
        $this->Skip( $diff );
    }   // public function AddDays

    /**
      *
      * AddWeeks() adds / subtracts $diff weeks to / from the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->AddWeeks( 7 )->AsSQL( );
      *
      * @param int $diff the number of weeks to add / subtract. It defaults to 1
      *
      * @see AddDays
      * @see AddMonths
      * @see AddWeekdays(  )
      * @see AddWeeks
      * @see AddYears
      *
      * @since = 1.0
      *
      */


    public function AddWeeks( $diff = 1 ) {

        $this->Skip( $diff * 7 );

    }   // public function AddWeeks( )





    /**
      *
      * AddMonths() adds / subtracts $diff months to / from the managed date. If the target month has too less days
      * then the target date will be set on the next fitting date in the next month: If the start date has the 31th and
      * is in January, then the target day will be the 3rd March, if the february has 28 days.
      *
      * Example:
      * ```
      * ```
      *
      * @param int $diff the number of months to add / subtract. It defaults to 1
      *
      * @see AddDays
      * @see AddMonths
      * @see AddWeekdays(  )
      * @see AddWeeks
      * @see AddYears
      *
      * @since = 1.0
      *
      */


    public function AddMonths( $diff = 1 ) {

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


    /**
      *
      * AddYears() adds / subtracts $diff years to / from the managed date
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $dt->AddYears( - 2 )->AsSQL( );
      *
      * @param int $diff the number of years to add / subtract
      *
      * @see AddDays
      * @see AddMonths
      * @see AddWeekdays(  )
      * @see AddWeeks
      * @see AddYears
      *
      * @since = 1.0
      *
      */

    public function AddYears( $diff = 1) {
        $this->m_year += $diff;

        $this->mdy2ts ( );
        $this->CalculateWeekday( );

    }   // public function AddYears

// ===============================================================


    /**
      *
      * LOW( ) aka "Length of week" returns the number of adys in a week ( seven days )
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->LOW( );
      *
      * @return int the number of days in a week
      *
      * @see LOW
      * @see LOM
      * @see LOQ(  )
      * @see LOY
      *
      * @since = 1.0
      *
      */



    public function LOW( ) {
        // L&auml;nge einer Woche
        return 7;
    }   // public function LOW

// return ( EOM (  ).AsJulian (  ) - BOM (  ).AsJulian (  ) ) + 1;


static $m_month_days_leap = array( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );
static $m_month_days = array( 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );



    /**
      *
      * LOW( ) aka "Length of month" returns the number of days in the month the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->LOM( );
      *
      * @return int the number of days in the month of the managed date
      *
      * @see LOW
      * @see LOM
      * @see LOQ(  )
      * @see LOY
      *
      * @since = 1.0
      *
      */


    public function LOM( ) {
        // L&auml;nge des Monats


        if ( $this->IsLeapYear( ) ) {

	    return self::$m_month_days_leap[ $this->m_month - 1 ];

        } else {

	    return self::$m_month_days[ $this->m_month - 1 ];

        }
/*
        $start = new cDate($this->BOM());
        $end = new cDate($this->EOM());
        // echo "<br>".$start->AsDMY()."-".$end->AsDMY();
        $diff = $end->AsTimeStamp() - $start->AsTimeStamp();

        return ceil( $diff / (60*60*24) )+1;

*/

    }   // public function LOM

    /**
      *
      * LOQ( ) aka "Length of quarter" returns the number of days in the quarter the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->LOQ( );
      *
      * @return int the number of days in the quarter of the managed date
      *
      * @see LOW
      * @see LOM
      * @see LOQ(  )
      * @see LOY
      *
      * @since = 1.0
      *
      */


    public function LOQ( ) {
        // L&auml;nge des Monats

        $start = new cDate($this->BOQ());
        $end = new cDate($this->EOQ());
        // echo "<br>".$start->AsDMY()."-".$end->AsDMY();
        $diff = $end->AsTimeStamp() - $start->AsTimeStamp();

        return ceil( $diff / (60*60*24) )+1;
    }   // public function LOQ

    /**
      *
      * LOY( ) aka "Length of year" returns the number of days in the year the managed date is in
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->LOY( );
      *
      * @return int the number of days in the year of the managed date
      *
      * @see LOW
      * @see LOM
      * @see LOQ(  )
      * @see LOY
      *
      * @since = 1.0
      *
      */


    public function LOY( ) {
        // L&auml;nge des Monats
        $start = new cDate($this->BOY());
        $end = new cDate($this->EOY());
        // echo "<br>".$start->AsDMY()."-".$end->AsDMY();
        $diff = $end->AsTimeStamp() - $start->AsTimeStamp();

        return ceil( $diff / (60*60*24) )+1;
    }   // public function LOY

// ===============================================================

    /**
      *
      * PrintOn( ) prints the managed date to a file handle - serializing
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $fh = fopen( 'tst.txt', 'w+' );
      *
      * $dt->PrintOn( $fh );
      *
      * @param resource $fptr the file handle of the file to write to
      *
      * @see PrintOn
      * @see ScanFrom
      *
      * @since = 1.0
      *
      */


    public function PrintOn( $fptr ) {

        // NOTE : 4 Bytes (32 Bit)

        assert( is_resource( $fptr ) );

        fwrite( $fptr, $this->m_timestamp, 4  );
    }

    /**
      *
      * ScanFrom( ) reads the managed date from a file handle - serializing
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * $fh = fopen( 'tst.txt', 'r' );
      *
      * $dt->ScanFrom( $fh );
      *
      * @param resource $fptr the file handle of the file to read from
      *
      * @see PrintOn
      * @see ScanFrom
      *
      * @since = 1.0
      *
      */


    public function ScanFrom( $fptr ) {

        // NOTE : 4 Bytes (32 Bit)

        assert( is_resource( $fptr ) );

        $this->m_timestamp = (int) fread( $fptr, 4);
        $this->ts2mdy();

        assert( checkdate($this->m_month, $this->m_day, $this->m_year ));

    }	// function ScanFrom( )





// ===============================================================

/*

	int FDOM ( void ) const;// Erster Monatstag am <n>  (1..7)

	const char *CDOW ( void ) const;	// Wochentag als String

	const char *CMonth ( void ) const;	// Monatsname als String
	//
	int CentYear ( void ) const;	// Jahr mit Jahrhundert
*/




    /**
      *
      * NOW() returns the ISO number of the week in the year the date belongs to. Same as WOY()
      *
      * Example:
      *
      * use rstoetter\libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->NOW( );
      *
      * @param bool $year_overlaps if true, then in the first week of the year the function can retunr the last week of the last year if necessary. In order to get always the first week of the year set this parameter false. No default value
      * @return int the number of he week in the year
      *
      * @see Quarter
      * @see NOQ
      * @see NOW
      * @see WOY
      * @see WOM
      *
      * @since = 1.0
      *
      */



    public function NOW( ) {
    //
    // Number of Week in the year - one-based and starting on monday
    //
    //  NOTE : ISO-8601 Wochennummer des Jahres, die Woche beginnt am Montag
    // TODO: non-iso-Berechnung


	return (int) date("W", $this->AsTimeStamp( ) );

    }   // public function NOW( )


}   // class cDate



?>