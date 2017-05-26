<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategy.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategy' berechnet für einen vorgegebenen Zeitraum Zeitwerte, welche einem bestimmten Rhythmus folgen
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
//  This file has been released under the MIT license
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Requests]]
//
//
//		_POST['enddate']
//		_POST['selectoncelebrities']
//		_POST['selectonsaturday']
//		_POST['selectonsunday']
//		_POST['startdate']
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
//	class cDateStrategy
//		public var static
//		public method AddCelebrity($obj_date)
//		public method AsString()
//		public method FillForm()
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($date)
//		public method GetNextEventDate($obj_date_start,$is_first_date=true)
//		public method HasEndDate()
//		public method IsCelebrity($obj_date)
//		public method IsEventDate($obj_date)
//		public method IsValid()
//		public method MoveDateIfNecessary($date)
//		public method Reset()
//		public method SetEndDate($obj_date)
//		public method SetLanguage($language)
//		public method SetStartDate($obj_date)
//		public method SetStrategyCelebrity($direction=self::STRATEGY_DIRECTION_LEAVE)
//		public method SetStrategyImpossible($direction=self::STRATEGY_DIRECTION_FORWARD)
//		public method SetStrategySaturday($direction=self::STRATEGY_DIRECTION_LEAVE)
//		public method SetStrategySunday($direction=self::STRATEGY_DIRECTION_LEAVE)
//		public method cDateStrategy()
//		protected var $m_directionOnCelebrity
//		protected var $m_directionOnImpossible
//		protected var $m_directionOnSaturday
//		protected var $m_directionOnSunday
//		protected var $endDate
//		protected var $startDate
//		protected var static
//		protected method IsOverflow($dt)
//		protected method SetSpecialDaysFromForm()
//		protected method SetStartEndDatesFromForm()
//		protected method IsUnderflow($dt)
//		protected method id2msg($id)
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
?><?php

namespace rstoetter\libdatephp;

# NOTE : TODO : s7 fehlt noch (nach Dimensionen)
# NOTE : TODO : alle IsValid () überprüfen
# NOTE : TODO : JavaScript : Validierungen

// require_once("./classes/cDate.class.php");  //  Datumsklasse

/*
define ("STRATEGY_DIRECTION_LEAVE", 0);          # belassen
define ("STRATEGY_DIRECTION_FORWARD", 1);       # verschieben in die Zukunft
define ("STRATEGY_DIRECTION_BACKWARD", 2);      # verschieben in die Vergangenheit
define ("STRATEGY_DIRECTION_ABOLISH", 3);       # verwerfen
*/

$_msg_de_de = array(
     1000 => "verwerfen",
     1001 => "belassen",
     1002 => "n&auml;chstm&ouml;glicher Termin",
     1003 => "letztm&ouml;glicher Termin",
     1004 => "Samstage",
     1005 => "Sonntage",
     1006 => "Feiertage",
     1007 => "Startdatum",
     1008 => "Enddatum",
     1009 => "Einfaches Datum",
     1010 => "Nach Wochentagen",
     1011 => "Montag",
     1012 => "Dienstag",
     1013 => "Mittwoch",
     1014 => "Donnerstag",
     1015 => "Freitag",
     1016 => "Samstag",
     1017 => "Sonntag",
     1018 => "alle ",
     1019 => "Wochen am ",
     1020 => "Nach fixen Tagen",
     1021 => "Am",
     1022 => "ten Tag im ",
     1023 => "Monat",
     1024 => "Quartal",
     1025 => "Jahr",
     1026 => "Nach Tagen",
     1027 => "Monatlich am",
     1028 => "Januar",
     1029 => "Februar",
     1030 => "M&auml;rz",
     1031 => "April",
     1032 => "Mai",
     1033 => "Juni",
     1034 => "Juli",
     1035 => "August",
     1036 => "September",
     1037 => "Oktober",
     1038 => "November",
     1039 => "Dezember",
     1040 => "im Monat",
     1041 => "Nach Wochentagen",
     1042 => "Am",
     1043 => "ersten",
     1044 => "zweiten",
     1045 => "dritten",
     1046 => "vierten",
     1047 => "f&uuml;ften",
     1048 => "letzten",
     1049 => "im Monat",
     1050 => "einfaches Intervall",
     1051 => "Tage",
     1052 => "Alle",
     1053 => "T&auml;glich",
     1054 => "Jeden Tag",
     1055 => "Ohne erkennbarem Intervall",
     1056 => "Neuer Eintrag",
);

$_msg_en_en = array(
     1000 => "abolish",
     1001 => "do not reschedule",
     1002 => "next date",
     1003 => "previous date",
     1004 => "Saturdays",
     1005 => "Sundays",
     1006 => "Celebrities",
     1007 => "Starting date",
     1008 => "Ending date",
     1009 => "Simple date",
     1010 => "Weekdays",
     1011 => "Monday",
     1012 => "Tuesday",
     1013 => "Wednesday",
     1014 => "Thursday",
     1015 => "Friday",
     1016 => "Saturday",
     1017 => "Sunday",
     1018 => "each ",
     1019 => "week on ",
     1020 => "Fixed dates",
     1021 => "On the ",
     1022 => "th day of the ",
     1023 => "month",
     1024 => "quarter",
     1025 => "year",
     1026 => "day by day",
     1027 => "Each month on day",
     1028 => "January",
     1029 => "February",
     1030 => "March",
     1031 => "April",
     1032 => "May",
     1033 => "June",
     1034 => "July",
     1035 => "August",
     1036 => "September",
     1037 => "October",
     1038 => "November",
     1039 => "December",
     1040 => "in the month",
     1041 => "On special weekdays",
     1042 => "On the",
     1043 => "first",
     1044 => "second",
     1045 => "third",
     1046 => "fourth",
     1047 => "fifth",
     1048 => "last",
     1049 => "of the month",
     1050 => "Simple Interval",
     1051 => "days",
     1052 => "all",
     1053 => "Daily",
     1054 => "Each day",
     1055 => "Without interval",
     1056 => "New Entry",

);

$_msg_fr_fr = array(
     1000 => "Jeter",
     1001 => "Sortir",
     1002 => "Prochaine date",
     1003 => "Date precedente",
     1004 => " Samedis",
     1005 => "Dimanches",
     1006 => "Fameux",
     1007 => "Date de commencement",
     1008 => "Date de terminaison",
     1009 => "Date simple",
     1010 => "Jours de la semaine",
     1011 => "Lundi",
     1012 => "Mardi",
     1013 => "Mercredi",
     1014 => "Jeudi",
     1015 => "Vendredi",
     1016 => "Samedi",
     1017 => "Dimanche",
     1018 => "Chaque ",
     1019 => "Semaine le ",
     1020 => "Dates fixes",
     1021 => "Le ",
     1022 => "Le jour de ",
     1023 => "Mois",
     1024 => "Trimestre",
     1025 => "Ann&eacute;e",    // é
     1026 => "Jour a jour",
     1027 => "Ne pas recalendrier",
     1028 => "Janvier",
     1029 => "Fevrier",
     1030 => "Mars",
     1031 => "Avril",
     1032 => "Mai",
     1033 => "Juin",
     1034 => "Juillet",
     1035 => "Aout",
     1036 => "Septembre",
     1037 => "Octobre",
     1038 => "Novembre",
     1039 => "Decembre",
     1040 => "Le mois de",
     1041 => "Des jours de semaine speciales",
     1042 => "Le",
     1043 => "Promier",
     1044 => "Deuxieme",
     1045 => "Troisieme",
     1046 => "Quatreieme",
     1047 => "Cinqui&eacute;me",    // é
     1048 => "Dernier",
     1049 => "Du mois",
     1050 => "Interval simple",
     1051 => "Jours",
     1052 => "Tous",
     1053 => "Quotidiennement",
     1054 => "Chaque jour",
     1055 => "Sans interval",
     1056 => "Nouvelle entr&eacute;e", // é

 );

/**
  *
  * cDateStrategy is an ABSTRACT base class and a framework for derived classes which calculate recurring events.
  *
  * There are several child classes for specialized tasks:
  *
  * - cDateStrategyDaily
  * - cDateStrategyDailyFixed
  * - cDateStrategyMonthly
  * - cDateStrategyMonthlyFixed
  * - cDateStrategyNoInterval
  * - cDateStrategySimpleDate
  * - cDateStrategySimpleInterval
  * - cDateStrategyWeekly
  *
  * abstract methods are:
  *
  * - IsValid( )
  * - GetFirstDate( )
  * - FromString( )
  * - GetNextEventSlot( )
  *
  * all objects have one calendar with celebrities in common and each object has its own calendar with holidays
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
  * @see cDateStrategyWeekly
  *
  */

abstract class cDateStrategy {

    /**
      * The DIRECTION_XXX constants control the behaviour of the algorithm in the method GetFollower( )
      *
      * DIRECTION_FORWARD moves forward on the timeline.
      * DIRECTION_BACKWARD moves backward on the timeline.
      *
      * @var int DIRECTION_FORWARD
      *
      * @see DIRECTION_BACKWARD
      * @see DIRECTION_FORWARD
      *
      */


    const DIRECTION_FORWARD = 0;

    /**
      * The DIRECTION_XXX constants control the behaviour of the algorithm in the method GetFollower( )
      *
      * DIRECTION_FORWARD moves forward on the timeline.
      * DIRECTION_BACKWARD moves backward on the timeline.
      *
      * @var int DIRECTION_BACKWARD
      *
      * @see DIRECTION_BACKWARD
      * @see DIRECTION_FORWARD
      *
      */


    const DIRECTION_BACKWARD = 1;

    /**
      * The STRATEGY_DIRECTION_XXX constants control the behaviour of the algorithm, when certain situations take place.
      *
      * These circumstances are:
      *
      *		the algorithm encounters a saturday (defined by $m_directionOnSaturday)
      *		the algorithm encounters a sunday (defined by $m_directionOnSunday)
      *		the algorithm encounters a celebrity (defined by $m_directionOnCelebrity)
      *		the algorithm encounters a holiday (defined by $m_directionOnHoliday)
      *		the algorithm encounters an impossible situation (defined by $m_directionOnImpossible)
      *
      * STRATEGY_DIRECTION_LEAVE defines, that the calculated date should stay on it's place in the time line
      * STRATEGY_DIRECTION_BACKWARD defines, that the calculated date should be placed on the next possible place in the past:Search a fitting place before the calculated date
      * STRATEGY_DIRECTION_FORWARD defines, that the calculated date should be placed on the next possible place in the future:Search a fitting place after the calculated date
      * STRATEGY_DIRECTION_ABOLISH defines, that the calculated date should be abolished.
      *
      * @var int STRATEGY_DIRECTION_LEAVE
      *
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      */

    const STRATEGY_DIRECTION_LEAVE = 0;         # belassen

    /**
      * The STRATEGY_DIRECTION_XXX constants control the behaviour of the algorithm, when certain situations take place.
      *
      * These circumstances are:
      *
      *		the algorithm encounters a saturday (defined by $m_directionOnSaturday)
      *		the algorithm encounters a sunday (defined by $m_directionOnSunday)
      *		the algorithm encounters a celebrity (defined by $m_directionOnCelebrity)
      *		the algorithm encounters a holiday (defined by $m_directionOnHoliday)
      *		the algorithm encounters an impossible situation (defined by $m_directionOnImpossible)
      *
      * STRATEGY_DIRECTION_LEAVE defines, that the calculated date should stay on it's place in the time line
      * STRATEGY_DIRECTION_BACKWARD defines, that the calculated date should be placed on the next possible place in the past:Search a fitting place before the calculated date
      * STRATEGY_DIRECTION_FORWARD defines, that the calculated date should be placed on the next possible place in the future:Search a fitting place after the calculated date
      * STRATEGY_DIRECTION_ABOLISH defines, that the calculated date should be abolished.
      *
      * @var int STRATEGY_DIRECTION_FORWARD
      *
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      */


    const STRATEGY_DIRECTION_FORWARD = 1;       # verschieben in die Zukunft

    /**
      * The STRATEGY_DIRECTION_XXX constants control the behaviour of the algorithm, when certain situations take place.
      *
      * These circumstances are:
      *
      *		the algorithm encounters a saturday (defined by $m_directionOnSaturday)
      *		the algorithm encounters a sunday (defined by $m_directionOnSunday)
      *		the algorithm encounters a celebrity (defined by $m_directionOnCelebrity)
      *		the algorithm encounters a holiday (defined by $m_directionOnHoliday)
      *		the algorithm encounters an impossible situation (defined by $m_directionOnImpossible)
      *
      * STRATEGY_DIRECTION_LEAVE defines, that the calculated date should stay on it's place in the time line
      * STRATEGY_DIRECTION_BACKWARD defines, that the calculated date should be placed on the next possible place in the past:Search a fitting place before the calculated date
      * STRATEGY_DIRECTION_FORWARD defines, that the calculated date should be placed on the next possible place in the future:Search a fitting place after the calculated date
      * STRATEGY_DIRECTION_ABOLISH defines, that the calculated date should be abolished.
      *
      * @var int STRATEGY_DIRECTION_BACKWARD
      *
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      */


    const STRATEGY_DIRECTION_BACKWARD = 2;      # verschieben in die Vergangenheit

    /**
      * The STRATEGY_DIRECTION_XXX constants control the behaviour of the algorithm, when certain situations take place.
      *
      * These circumstances are:
      *
      *		the algorithm encounters a saturday (defined by $m_directionOnSaturday)
      *		the algorithm encounters a sunday (defined by $m_directionOnSunday)
      *		the algorithm encounters a celebrity (defined by $m_directionOnCelebrity)
      *		the algorithm encounters a holiday (defined by $m_directionOnHoliday)
      *		the algorithm encounters an impossible situation (defined by $m_directionOnImpossible)
      *
      * STRATEGY_DIRECTION_LEAVE defines, that the calculated date should stay on it's place in the time line
      * STRATEGY_DIRECTION_BACKWARD defines, that the calculated date should be placed on the next possible place in the past:Search a fitting place before the calculated date
      * STRATEGY_DIRECTION_FORWARD defines, that the calculated date should be placed on the next possible place in the future:Search a fitting place after the calculated date
      * STRATEGY_DIRECTION_ABOLISH defines, that the calculated date should be abolished.
      *
      * @var int STRATEGY_DIRECTION_ABOLISH
      *
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      */


    const STRATEGY_DIRECTION_ABOLISH = 3;       # verwerfen


    /**
      * The member variable m_directionOnSunday controls the behaviour of the algorithm, when it encounters a sunday
      *
      * @var int $m_directionOnSunday
      *
      * @see $m_directionOnCelebrity
      * @see $m_directionOnHoliday
      * @see $m_directionOnImpossible
      * @see $m_directionOnSaturday
      * @see $m_directionOnSunday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      */


    protected $m_directionOnSunday = self::STRATEGY_DIRECTION_LEAVE;

    /**
      * The member variable m_directionOnSaunday controls the behaviour of the algorithm, when it encounters a saturday
      *
      * @var int $m_directionOnSaturday
      *
      * @see $m_directionOnCelebrity
      * @see $m_directionOnHoliday
      * @see $m_directionOnImpossible
      * @see $m_directionOnSaturday
      * @see $m_directionOnSunday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      */


    protected $m_directionOnSaturday = self::STRATEGY_DIRECTION_LEAVE;

    /**
      * The member variable m_directionOnCelebrity controls the behaviour of the algorithm, when it encounters a celebrity
      *
      * @var int $m_directionOnCelebrity
      *
      * @see $m_directionOnCelebrity
      * @see $m_directionOnHoliday
      * @see $m_directionOnImpossible
      * @see $m_directionOnSaturday
      * @see $m_directionOnSunday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      */


    protected $m_directionOnCelebrity = self::STRATEGY_DIRECTION_LEAVE;


    /**
      * The member variable m_directionOnHoliday controls the behaviour of the algorithm, when it encounters a holiday
      *
      * @var int $m_directionOnHoliday
      *
      * @see $m_directionOnCelebrity
      * @see $m_directionOnHoliday
      * @see $m_directionOnImpossible
      * @see $m_directionOnSaturday
      * @see $m_directionOnSunday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      */


    protected $m_directionOnHoliday = self::STRATEGY_DIRECTION_LEAVE;

    /**
      * The member variable m_directionOnImpossible controls the behaviour of the algorithm, when it encounters an impossible situation
      *
      * @var int $m_directionOnImpossible
      *
      * @see $m_directionOnCelebrity
      * @see $m_directionOnHoliday
      * @see $m_directionOnImpossible
      * @see $m_directionOnSaturday
      * @see $m_directionOnSunday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      */


    protected $m_directionOnImpossible = self::STRATEGY_DIRECTION_FORWARD;


    /**
      * The member variable m_start_date defines the date, where the algorithm should start to calculate
      *
      * @var cDate $m_start_date
      *
      * @see $m_start_date
      * @see $m_end_date
      *
      */


    protected $m_start_date;



    /**
      * The member variable m_end_date defines the date, where the algorithm should end the calculations
      *
      * @var cDate $m_end_date
      *
      * @see $m_start_date
      * @see $m_end_date
      *
      */


    protected $m_end_date = null;

    /**
      * The STATIC member variable m_a_celebrities is an array consisting of cDate variables, which are used to identify celebrities
      *
      * @var array $m_a_celebrities
      *
      * @see $m_a_celebrities
      * @see IsCelebrity
      * @see ResetCelebrities
      *
      */

    /**
      * If the STATIC public member variable m_debug is true, then debugging information will be displayed. It defaults to false.
      *
      * @var bool $m_debug
      *
      */


    /*static*/ public $m_debug = false;

    public static $m_a_celebrities = array( );

    /**
      * The member variable m_a_holidays is an array consisting of cDate variables, which are used to identify holidays
      *
      * @var array $m_a_holidays
      *
      * @see $m_a_holidays
      * @see IsHoliday
      * @see ResetHolidays
      *
      */

    public $m_a_holidays = array();

    /**
      * The STATIC member variable $m_language defines the language of the interaction with the user
      *
      * possible values are:
      * - 'de_de'
      * - 'en_en'
      * - 'fr_fr'
      *
      *  $m_language it defaults to 'en_en'
      *
      * @var string $m_language
      *
      *
      */

    protected static $m_language = "en_en";

    /**
      * The constructor of cDateStrategy
      *
      *  Example:
      *
      *
      *
      *
      * @param $start_date cDate the date, from which the calcultions should start. If it is null, then the actual date will be used. $start_date defaults to null
      * @param $end_date cDate the date, where the calcultions should stop. If it is null, then there is no ending date for the calculations. $end_date defaults to null
      * @param $language string the language for messages. ('de_de', 'en_en' or 'fr_fr'). It defaults to 'en_en'.
      * @param $directionOnSaturday int controls how to proceed, when the algorithm encounters a saturday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param $directionOnSunday int controls how to proceed, when the algorithm encounters a sunday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param $directionOnCelebrity int controls how to proceed, when the algorithm encounters a celebrity. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param $m_directionOnHoliday int controls how to proceed, when the algorithm encounters a holiday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param $directionOnImpossible int controls how to proceed, when the algorithm encounters an impossible situation. It defaults to self::STRATEGY_DIRECTION_FORWARD.
      *
      * @return cDateStrategy
      *
      */

    public function __construct(
			$start_date = null,
			$end_date = null,
			$language = 'en_en',
			$directionOnSaturday = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnSunday = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnCelebrity = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnHoliday = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnImpossible = self::STRATEGY_DIRECTION_FORWARD
			) {

        if ( is_null( $start_date ) ) {
	    $this->m_start_date = new cDate( );

	    // echo "\n cDateStrategy: Starting date was null! ";

	} else {

	    $this->m_start_date = $start_date;

	}

        assert( is_a( $this->m_start_date, '\rstoetter\libdatephp\cDate' ) );
        // var_dump( $start_date );

        if ( $end_date != null ) assert( is_a( $end_date, '\rstoetter\libdatephp\cDate' ) );

        $this->m_end_date = $end_date;     // falls noch kein Endedatum definiert wurde, verwenden wir null
        $this->m_directionOnCelebrity = $directionOnCelebrity;
        $this->m_directionOnHoliday = $directionOnHoliday;
        $this->m_directionOnSaturday = $directionOnSaturday;
        $this->m_directionOnSunday = $directionOnSunday;
        $this->m_directionOnImpossible = $directionOnImpossible;
        $this->m_language = $language;
    }

//    protected static $m_language = "en_en";



    /**
      * The method Reset( ) resets the start date to today and sets the and date to null
      *
      */


    public function Reset() {
        // $this->obj_date = new cDate();
        $this->m_start_date = new cDate();
        $this->m_end_date = null;
        $this->ResetCelebrities( );
        $this->ResetHolidays( );
    }

    /**
      * The static method SetLanguage( ) sets the language, in which the algorithm should interact
      *
      * @param string $language string the language for messages. ('de_de', 'en_en' or 'fr_fr').
      *
      */


    public function SetLanguage( $language ) {

        $this->m_language = $language;

    }



    /**
      * The method id2msg( ) returns the correct language string for $id
      *
      * @param $id int the id of a message
      * @return string the message string in a certain language
      *
      */


    protected function id2msg( $id ) {

        global $_msg_de_de;
        global $_msg_en_en;
        global $_msg_fr_fr;

        if (self::$language == 'de_de') {
            $ary = $_msg_de_de;
        } elseif (self::$language == 'en_en') {
            $ary = $_msg_en_en;
        } elseif (self::$language == 'fr_fr') {
            $ary = $_msg_en_en;
        } else {
            throw new \Exception ("cDateStrategy : unbekannte Sprache '" . self::$language . "'");
        }

        $msg = $ary[$id];

        return $msg;

    }

    /**
      * The method SetStartDate( ) sets the date, where the calculations should start
      *
      * @param cDate $obj_date cDate the start date
      *
      */


    public function SetStartDate( $obj_date ) {

      if ( ! is_null( $obj_date ) )  {

        $this->m_start_date->SetDate( $obj_date->Month(), $obj_date->Day(), $obj_date->Year() ) ;

      } else {

	$this->m_start_date = null;

      }

    }   // function SetStartDate


    /**
      * The method GetStartDate( ) returns the date, where the calculations are starting.
      *
      * @return cDate the start date
      *
      */


    public function GetStartDate( ) {

        return $this->m_start_date;

    }   // function GetStartDate



    /**
      * The method SetEndDate( ) sets the date, where the calculations should stop. It is null, then there is no stop date.
      *
      * @param cDate $obj_date cDate the end date for the calculations
      *
      */


    public function SetEndDate( $obj_date ) {

        if ( is_null( $obj_date ) ) {
            $this->m_end_date = null;
        } else {
	    $this->m_end_date = new \rstoetter\libdatephp\cDate( $obj_date );
	}

    }   // function SetEndDate

    /**
      * The method GetEndDate( ) returns the date, where the calculations are stopping or null
      *
      * @return cDate the end date or null
      *
      */


    public function GetEndDate( ) {

        return $this->m_end_date;

    }   // function GetEndDate


    /**
      * The method HasEndDate( ) returns true, if the ending date is not null
      *
      * @return boolean returns true, if the ending date is not null
      *
      */


    public function HasEndDate( ) {
        return ( $this->m_end_date !== null ) ;
    }   // function HasEndDate


    /**
      * The method SetStrategySunday( ) controls, what to do if the algorithm encounters a sunday
      *
      * @param int $direction the way, how to calculate. Defaults to STRATEGY_DIRECTION_LEAVE
      *
      * @see SetStrategyCelebrity
      * @see SetStrategyImpossible
      * @see SetStrategySaturday
      * @see SetStrategySunday
      * @see GetStrategyCelebrity
      * @see GetStrategyImpossible
      * @see GetStrategySaturday
      * @see GetStrategySunday
      * @see GetStrategyHoliday
      * @see SetStrategyHoliday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      *
      */


    public function SetStrategySunday( $direction = self::STRATEGY_DIRECTION_LEAVE ) {
        $this->m_directionOnSunday = $direction;
    }   // function SetStrategySunday


    /**
      * The method SetStrategyHoliday( ) controls, what to do if the algorithm encounters a holiday
      *
      * @param int $direction the way, how to calculate. Defaults to STRATEGY_DIRECTION_LEAVE
      *
      * @see SetStrategyCelebrity
      * @see SetStrategyImpossible
      * @see SetStrategySaturday
      * @see SetStrategySunday
      * @see GetStrategyCelebrity
      * @see GetStrategyImpossible
      * @see GetStrategySaturday
      * @see GetStrategySunday
      * @see GetStrategyHoliday
      * @see SetStrategyHoliday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      *
      */


    public function SetStrategyHoliday( $direction = self::STRATEGY_DIRECTION_LEAVE ) {
        $this->m_directionOnHoliday = $direction;
    }   // function SetStrategyHoliday( )


    /**
      * The method GetStrategySunday( ) returns, what to do, if the algorithm encounters a sunday
      *
      * @return int $direction the way, how to calculate.
      *
      * @see SetStrategyCelebrity
      * @see SetStrategyImpossible
      * @see SetStrategySaturday
      * @see SetStrategySunday
      * @see GetStrategyCelebrity
      * @see GetStrategyImpossible
      * @see GetStrategySaturday
      * @see GetStrategySunday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      *
      */


    public function GetStrategySunday(  ) {
        return $this->m_directionOnSunday ;
    }   // function GetStrategySunday


    /**
      * The method SetStrategySaturday( ) controls, what to do if the algorithm encounters a saturday
      *
      * @param int $direction the way, how to calculate. Defaults to STRATEGY_DIRECTION_LEAVE
      *
      * @see SetStrategyCelebrity
      * @see SetStrategyImpossible
      * @see SetStrategySaturday
      * @see SetStrategySunday
      * @see GetStrategyCelebrity
      * @see GetStrategyImpossible
      * @see GetStrategySaturday
      * @see GetStrategySunday
      * @see GetStrategyHoliday
      * @see SetStrategyHoliday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      *
      */


    public function SetStrategySaturday( $direction = self::STRATEGY_DIRECTION_LEAVE ) {
        $this->m_directionOnSaturday = $direction;
    }   // function SetStrategySaturday


    /**
      * The method GetStrategySaturday( ) returns, what to do, if the algorithm encounters a saturday
      *
      * @return int $direction the way, how the algorithm is calculating.
      *
      * @see SetStrategyCelebrity
      * @see SetStrategyImpossible
      * @see SetStrategySaturday
      * @see SetStrategySunday
      * @see GetStrategyCelebrity
      * @see GetStrategyImpossible
      * @see GetStrategySaturday
      * @see GetStrategySunday
      * @see GetStrategyHoliday
      * @see SetStrategyHoliday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      *
      */


    public function GetStrategySaturday(  ) {
        return $this->m_directionOnSaturday ;
    }   // function GetStrategySaunday


    /**
      * The method GetStrategyHoliday( ) returns, what to do, if the algorithm encounters a holiday
      *
      * @return int $direction the way, how the algorithm is calculating.
      *
      * @see SetStrategyCelebrity
      * @see SetStrategyImpossible
      * @see SetStrategySaturday
      * @see SetStrategySunday
      * @see GetStrategyCelebrity
      * @see GetStrategyImpossible
      * @see GetStrategySaturday
      * @see GetStrategySunday
      * @see GetStrategyHoliday
      * @see SetStrategyHoliday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      *
      */


    public function GetStrategyHoliday(  ) {
        return $this->m_directionOnHoliday ;
    }   // function GetStrategyHoliday

    /**
      *
      * The method SetStrategyCelebrity( ) controls, what to do if the algorithm encounters a celebrity / holiday
      *
      * @param int $direction the way, how to calculate. Defaults to STRATEGY_DIRECTION_LEAVE
      *
      * @see SetStrategyCelebrity
      * @see SetStrategyImpossible
      * @see SetStrategySaturday
      * @see SetStrategySunday
      * @see GetStrategyCelebrity
      * @see GetStrategyImpossible
      * @see GetStrategySaturday
      * @see GetStrategySunday
      * @see GetStrategyHoliday
      * @see SetStrategyHoliday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      *
      */



    public function SetStrategyCelebrity( $direction = self::STRATEGY_DIRECTION_LEAVE ) {
        $this->m_directionOnCelebrity = $direction;
    }   // function SetStrategyCelebrity

    /**
      * The method GetStrategyCelebrity( ) returns, what to do, if the algorithm encounters a celebrity / holiday.
      *
      * @return int $direction the way, how the algorithm is calculating.
      *
      * @see SetStrategyCelebrity
      * @see SetStrategyImpossible
      * @see SetStrategySaturday
      * @see SetStrategySunday
      * @see GetStrategyCelebrity
      * @see GetStrategyImpossible
      * @see GetStrategySaturday
      * @see GetStrategySunday
      * @see GetStrategyHoliday
      * @see SetStrategyHoliday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      *
      */


    public function GetStrategyCelebrity(  ) {
        return $this->m_directionOnCelebrity ;
    }   // function GetStrategyCelebrity



    /**
      *
      * The method SetStrategyImpossible( ) controls, what to do if the algorithm encounters an impossible situation
      *
      * @param int $direction the way, how to calculate. Defaults to STRATEGY_DIRECTION_FORWARD
      *
      * @see SetStrategyCelebrity
      * @see SetStrategyImpossible
      * @see SetStrategySaturday
      * @see SetStrategySunday
      * @see GetStrategyCelebrity
      * @see GetStrategyImpossible
      * @see GetStrategySaturday
      * @see GetStrategySunday
      * @see GetStrategyHoliday
      * @see SetStrategyHoliday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      *
      */


    public function SetStrategyImpossible( $direction = self::STRATEGY_DIRECTION_FORWARD ) {
        $this->m_directionOnImpossible = $direction;
    }   // function SetStrategyImpossible

    /**
      * The method GetStrategyImpossible( ) returns, what to do, if the algorithm encounters an impossible situation.
      *
      * @return int $direction the way, how the algorithm is calculating.
      *
      * @see SetStrategyCelebrity
      * @see SetStrategyImpossible
      * @see SetStrategySaturday
      * @see SetStrategySunday
      * @see GetStrategyCelebrity
      * @see GetStrategyImpossible
      * @see GetStrategySaturday
      * @see GetStrategySunday
      * @see GetStrategyHoliday
      * @see SetStrategyHoliday
      * @see STRATEGY_DIRECTION_ABOLISH
      * @see STRATEGY_DIRECTION_BACKWARD
      * @see STRATEGY_DIRECTION_FORWARD
      * @see STRATEGY_DIRECTION_LEAVE
      *
      *
      */


    public function GetStrategyImpossible(  ) {
        return $this->m_directionOnImpossible ;
    }   // function GetStrategyImpossible


    /**
      * The method GetPredecessor( ) returns the previous date before $obj_date, which fits to the specifications
      *
      * @param cDate $obj_date a cDate object, where the calculation shoudl start
      * @param cDate $dt_prev a cDate object, which should be the starting point for the next calculation
      *
      * @return cDate cDate object with the next fitting date or null, if no fitting date could be found ( overflow, underflow)
      *
      * @see GetFirstDate
      * @see GetPredecessor
      * @see GetFollower
      * @see GetArray
      *
      *
      */


    public function GetPredecessor( $obj_date, & $dt_prev ) {

	if ( is_a( $obj_date, '\rstoetter\libdatephp\cDate') ) {
	    $obj_date = new cDateISO( $obj_date );
	}

	return $this->GetFollower( $obj_date, $dt_prev, self::DIRECTION_BACKWARD );

    }

    /**
      * The method GetFollower( ) returns the next date AFTER $date, which fits to the specifications. $date itself will not be taken into consideration.
      *
      * @param cDate $date a cDate object, which is the starting point for the next calculation
      * @param cDate $dt_next GetFollower returns a cDate object, which is the starting point for the next calculation. ie If we are moving backwards and scheduling forward, then a correction is necessary
      * @param int $direction the constant, which indicates the search direction. It defaults to DIRECTION_FORWARD
      *
      * @return cDate cDate object with the next fitting date or null, if no fitting date could be found ( overflow, IsUnderflow)
      *
      * @see GetFollower
      * @see GetFirstDate
      * @see DIRECTION_BACKWARD
      * @see DIRECTION_FORWARD
      *
      */

    public function GetFollower( $date, & $dt_next, $direction = self::DIRECTION_FORWARD ) {

        // $date_test muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen

        # echo "\nGetFollower(".$date->AsDMY(). ") : GetLatestDayNumber() ergibt " . $this->GetLatestDayNumber();



        if ( is_null( $date ) ) {
	    // assert( true == false );
	    echo "\n from " .  debug_backtrace()[1]['function'] . '/' . debug_backtrace()[0]['line'];
	    throw new \Exception( "\n Error: GetFollower erhielt NULL -> Abbruch" );

        }

	if ( is_a( $date, '\rstoetter\libdatephp\cDate') ) {
	    $date = new cDateISO( $date );
	}


        assert( is_int( $direction ) );
        assert( is_a( $date, '\rstoetter\libdatephp\\cDateISO' ) );

        if ( ! $this->IsValid( ) ) throw new \Exception( "\n cDateStrategyMonthly::GetFollower() : no valid data to calculate anything" );


//         $month_skipped = false;		// we did not change the month yet
//         $quarter_skipped = false;	// we did not change the quarter yet
//         $year_skipped = false;		// we did not change the year yet

        //

        if ( $this->m_debug ) echo "\n GetFollower( ) starts with " . $date->AsSQL( ) . ' called  by ' . debug_backtrace()[1]['function'] . '/' . debug_backtrace()[0]['line'] ;
	if ( $this->m_debug) echo " direction = " . ( $direction == self::DIRECTION_FORWARD ? ' forward' : ' backward') ;
        //

        $date_test = new cDateISO( $date );

        //

        if ( $this->AdjustedUnderOverflow( $date_test, $direction ) ) {

	    if ( $this->m_debug ) {
		if ( ! is_null( $date_test ) ) {

		    echo "\n adjusted underflow/ overflow. Set to " . $date_test->AsSQL( );
		}
	    }

	    if ( is_null( $date_test ) ) {
		// not adjustable

		return null;
	    }

		// bei Check auf Underflow/Overflow wurde auf das Startdatum bzw Enddatum gesetzt.
		// diese müssen dann aber auch betrachtet werden. Also Dec bzw Inc

		if ( $direction == self::DIRECTION_FORWARD) {
		    $date_test->Dec( );
		    // $dt_next = new cDate( $obj_lauf );
		} elseif ( $direction == self::DIRECTION_BACKWARD) {
		    $date_test->Inc( );
		    // $dt_next = new cDate( $obj_lauf );
		} else {
		    throw new \Exception( "\n unknown direction" );
		}

		if ( $this->m_debug ) echo "\n adjusted because of adjustement underflow/ overflow. Set to " . $date_test->AsSQL( );

        }

        //

        $date_test = $this->GetNextEventSlot( $date_test, $direction );

        if ( $this->m_debug ) echo "\n normally we would use " . $date_test->AsSQL( );

        //

        if ( is_null( $date ) ) return null;


        $fertig = false;
        $dt_next = null;

	  $weiter = false;

        do {

// 	    $weiter = false;

	    if ( $this->AdjustedUnderOverflow( $date_test, $direction ) ) {

		if ( is_null( $date_test ) ) {
		    // not adjustable

		    return null;
		}

	    }

	    if ( $weiter ) {
		if ( $direction == self::DIRECTION_FORWARD ) {
		    $date_test->Inc( );
		} elseif ( $direction == self::DIRECTION_BACKWARD) {
		    $date_test->Dec( );
		}
	    }

	    $weiter = false;

	    if ( $this->m_debug ) echo "\n skipped to " . $date_test->AsSQL( );
	    echo ' direction is ' . ( $direction == self::DIRECTION_FORWARD ? ' forward ' : ' backward ' ) ;


            if ( $date_test->IsSaturday( ) ) {
		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is a saturday';
		if ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $date_test );
		    // if ( is_null( $dt_next ) ) $dt_next = $date_test;
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    // if ( $this->m_debug ) echo "\n moved to " . $date_test->AsSQL( ) . ' from ' . $gemerkt->AsSQL( );
		    if ( is_null( $date_test ) ) {
			if ( $this->m_debug ) echo "\n moving saturday forward results in null";
			return null;
		    }

		} elseif ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    // if ( is_null( $dt_next ) ) $dt_next = $date_test;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    // if ( $this->m_debug ) echo "\n moved to " . $date_test->AsSQL( ) . ' from ' . $gemerkt->AsSQL( );
		    if ( is_null( $date_test ) )  {
			if ( $this->m_debug ) echo "\n moving saturday backward results in null";
			return null;
		    }

		} elseif ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }

            if ( $date_test->IsSunday( ) ) {

		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is a sunday';

		if ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		   //  if ( is_null( $dt_next ) ) $dt_next = $date_test;
		   if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $date_test ) ) {
			if ( $this->m_debug ) echo "\n moving sunday forward results in null";
			return null;
		    }
		} elseif ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    // if ( ( $direction == self::DIRECTION_BACKWARD ) && ( is_null( $dt_next ) ) ) $dt_next = $date_test;
		    // if ( ( is_null( $dt_next ) ) ) $dt_next = $date_test;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $date_test ) ) {
			if ( $this->m_debug ) echo "\n moving sunday backward results in null";
			return null;
		    }
		} elseif ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    if ( $this->m_debug ) echo "\n abolishing sunday results in null";
		    return null;
		}
            }


            if ( ! ( is_null( $date_test ) ) && ( $this->IsCelebrity( $date_test ) ) ) {

		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is a celebrity';

		if ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    // if ( is_null( $dt_next ) ) $dt_next = $date_test;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $date_test );
		    $dt_next = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $date_test ) ) {
			if ( $this->m_debug ) echo "\n moving celebrity forward results in null";
			return null;
		    }
		} elseif ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    // if ( is_null( $dt_next ) ) $dt_next = $date_test;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $date_test ) ) {
			if ( $this->m_debug ) echo "\n moving celebrity forward results in null";
			return null;
		    }
		} elseif ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    if ( $this->m_debug ) echo "\n abolishing celebrity results in null";
		    return null;
		}
            }

            if ( ! ( is_null( $date_test ) ) && ( $this->IsHoliday( $date_test ) ) ) {

		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is a holiday';

		if ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $dt_next ) ) $dt_next = $date_test;

		    if ( is_null( $date_test ) ) {
			if ( $this->m_debug ) echo "\n moving holiday forward results in null";
			return null;
		    }
		} elseif ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $dt_next ) ) $dt_next = $date_test;
		    if ( is_null( $date_test ) ) {
			if ( $this->m_debug ) echo "\n moving holiday backward results in null";
			return null;
		    }
		} elseif ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    if ( $this->m_debug ) echo "\n abolishing holiday results in null";
		    return null;
		}
            }

	    if ($this->IsUnderflow($date_test) && ( $direction == self::DIRECTION_FORWARD )) {

		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is an underflow';

		$date_test = new rstoetter\libdatephp\cDate( $this->m_start_date );
		$date_test->Dec( );
	    }
	    if ($this->IsOverflow($date_test) && ( $direction == self::DIRECTION_FORWARD)) return null;
	    if ($this->IsUnderflow($date_test) && ( $direction == self::DIRECTION_BACKWARD)) return null;
	    if ($this->IsOverflow($date_test) && ( $direction == self::DIRECTION_BACKWARD )) {
		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is an overflow';
		$date_test = new rstoetter\libdatephp\cDate( $this->m_end_date );
		$date_test->Inc( );
	    }

        } while ( $weiter );

/*
	    if ($this->IsUnderflow($date_test) && ( $direction == self::DIRECTION_FORWARD )) {

		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is an underflow';

		$date_test = new rstoetter \libdatephp\cDate( $this->m_start_date );
		$date_test->Dec( );
	    }
	    if ($this->IsOverflow($date_test) && ( $direction == self::DIRECTION_FORWARD)) return null;
	    if ($this->IsUnderflow($date_test) && ( $direction == self::DIRECTION_BACKWARD)) return null;
	    if ($this->IsOverflow($date_test) && ( $direction == self::DIRECTION_BACKWARD )) {
		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is an overflow';
		$date_test = new rstoetter \libdatephp\cDate( $this->m_end_date );
		$date_test->Inc( );
	    }
*/

	if ( $this->m_debug ) echo "\n GetFollower returns " . $date_test->AsSQL( ) . ' to ' .  debug_backtrace()[1]['function'];;

	if ( is_null( $dt_next ) ) {
	    $dt_next = $date_test;
	}

	if ( $this->m_debug ) echo "\n next try should be " . $dt_next->AsSQL( );

        return $date_test;

    }       // function GetFollower()


    /**
      * The method GetNextEventSlot(  ) returns the next date AFTER $obj_date, WITHOUT checking for special situations or
      * whether the date fits into the strategies' boundaries.
      *
      * @param cDate $obj_date a cDate object, which is the starting point for the next calculation
      * @param int $direction the constant, which indicates the search direction. It defaults to DIRECTION_FORWARD
      *
      * @return cDate cDate object with the next fitting date
      *
      * @see GetFirstDate
      * @see GetNextEventSlot
      * @see DIRECTION_BACKWARD
      * @see DIRECTION_FORWARD
      *
      */


    abstract function GetNextEventSlot( $obj_date, $direction = self::DIRECTION_FORWARD ) ;


    /**
      * The ABSTRACT method IsValid( ) returns true, if the properties are okay and the algorithm is ready to start.
      * Subclasses have to code this method before the class can be used
      *
      * @return bool true, if we can start to calculate dates and events
      *
      * @see GetFirstDate
      * @see GetNextEventSlot
      * @see DIRECTION_BACKWARD
      * @see DIRECTION_FORWARD
      *
      *
      */


    abstract public function IsValid( );

    /*   *
      * The ABSTRACT method GetFollower( ) returns the next date from $obj_date on, which fits to the specifications
      * Subclasses have to code this method before the class can be used
      *
      * @param cDate $obj_date a cDate object, which is the starting point for this calculation
      * @param cDate $dt_next GetFollower returns a cDate object, which is the starting point for the next calculation. ie If we are moving backwards and scheduling forward, then a correction is necessary
      * @param int $direction the constant, which indicates the search direction. It defaults to DIRECTION_FORWARD
      *
      * @return cDate cDate object with the next fitting date or null, if no fitting date could be found ( overflow, IsUnderflow)
      *
      * @see IsValid
      * @see GetFollower
      * @see GetFirstDate
      * @see FromString
      *
      *
      */

/*
    abstract public function GetFollower( $obj_date, & $dt_next, $direction = self::DIRECTION_FORWARD );
*/
    /**
      * The ABSTRACT method GetFirstDate( ) returns the first valid date of the series to be calculated according to the specifications
      * Subclasses have to code this method before the class can be used
      *
      * @return cDate a cDate object with the first fitting date or null, if no fitting date could be found ( overflow, underflow)
      *
      * @see IsValid
      * @see GetFirstDate
      * @see FromString
      * @see GetPredecessor
      * @see GetArray
      *
      */


    abstract public function GetFirstDate( );

    /**
      * The ABSTRACT method FromString( ) reads its specifications from the string $str
      * Subclasses have to code this method before the class can be used.
      *
      * The string template can be used for serialization.
      *
      * The calendars for celebrities and holidays remain untouched.
      *
      * @param string $str the specifications as string
      *
      * @see IsValid
      * @see GetFirstDate
      * @see FromString
      *
      *
      */


    abstract public function FromString( $str );

    /**
      * The ABSTRACT method AsString( ) returns its specifications as a string
      * Subclasses have to code this method before the class can be used. The szting
      * template normally is made by AsString( ) and the template can be used for
      * serialization
      *
      * @return string the specifications as string
      *
      * @see IsValid
      * @see GetFirstDate
      * @see FromString
      *
      *
      */


    abstract public function AsString( );



    /**
      * The method DirectionAsString( ) returns the string representation of $direction. $direction is a constant STRATEGY_DIRECTION_XXX.
      *
      * @param int $direction the $direction constant , which should be converted to a string
      *
      * @returns string the string representation of $direction
      *
      * @see Dump
      *
      */

    protected function DirectionAsString( $direction ) {

	if ( $direction == \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE ) $str = 'leave';
	if ( $direction == \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD ) $str = 'forward';
	if ( $direction == \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) $str = 'backward';
	if ( $direction == \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) $str = 'abolish';

	return $str;

    }

    /**
      * The method PrintParameters( ) prints the internal state of the strategy
      *
      * @param int $direction the $direction constant , which should be converted to a string
      *
      * @returns string the string representation of $direction
      *
      * @see Dump
      *
      */

    protected function PrintParameters( $obj_date_calc_from, $obj_date_calc_to ) {

	echo "\n calculating the events between " . (is_null( $obj_date_calc_from ) ? 'n/a' : $obj_date_calc_from->AsSQL( ) ) . ' and ' . (is_null( $obj_date_calc_to ) ? 'n/a' : $obj_date_calc_to->AsSQL( ) );
	echo "\n calculation bases are  " . ( is_null( $this->m_start_date) ? ' n/a' : $this->m_start_date ->AsSQL( ) ). ' and ' . ( is_null( $this->m_end_date ) ? ' n/a ' : $this->m_end_date ->AsSQL( ) );
	echo "\n celebrities = ";
	foreach ( self::$m_a_celebrities as $cel ) {
	    echo "\n" . $cel->AsSQL( );
	}

	echo "\n holidays = ";
	foreach ( $this->m_a_holidays as $cel ) {
	    echo "\n" . $cel->AsSQL( );
	}

	echo "\n onSaturday = " . $this->DirectionAsString( $this->GetStrategySaturday( ) );
	echo " onSunday = " . $this->DirectionAsString( $this->GetStrategySunday( ) );
	echo "\n onCelebrity = " . $this->DirectionAsString( $this->GetStrategyCelebrity( ) );
	echo " onHoliday = " . $this->DirectionAsString( $this->GetStrategyHoliday( ) );
	echo " onImpossible = " . $this->DirectionAsString( $this->GetStrategyImpossible( ) );

    }

    /**
      * The method Dump( ) prints the internal state of the strategy
      *
      *
      * @param cDate $obj_date_calc_from  date, where the calculations should start
      * @param cDate $obj_date_calc_to  date, where the calculations should end
      * @param int $direction the direction on the time line
      */

    public function Dump( $obj_date_calc_from, $obj_date_calc_to, $direction ) {

    	$this->PrintParameters( $obj_date_calc_from, $obj_date_calc_to );

    	echo "\n the direction is " . ( $direction == self::DIRECTION_FORWARD ? ' forward' : 'backward' );

    }   // function Dump( )

    /**
      * The method AdjustedUnderOverflow( ) adjusts the cDate $date_test, when it is not inside the boundaries of
      * the specifications of the actual strategy.
      *
      * If no adjustment is possible ( overflow and DIRECTION_FORWARD or underflow and DIRECTION_BACKWARD ), then $date_test is set to null
      *
      * @param cDate $date_test the date, which should be adjusted
      * @param int $direction the actual direction; defaults to DIRECTION_FORWARD
      *
      * @returns bool returns true, if $date_test needed to be adjusted
      *
      * @see IsValid
      * @see GetFollower
      * @see GetFirstDate
      * @see FromString
      *
      *
      */

    public function AdjustedUnderOverflow( & $date_test, $direction = self::DIRECTION_FORWARD ) {

	$ret = false;

	if ( $this->IsUnderflow( $date_test ) ) {

	    if ( $direction == self::DIRECTION_FORWARD ) {

		$date_test = new cDate( $this->m_start_date );

		if ( $this->m_debug ) echo "\n underflow adjusted to " . $date_test->AsSQL( );

	    } else {

		if ( $this->m_debug ) echo "\n uncorrectable underflow!";

		$date_test = null;

		return true;

	    }

	    $ret = true;

	}

	if ( $this->IsOverflow( $date_test ) ) {

	    if ( $direction == self::DIRECTION_BACKWARD ) {

		$date_test = new cDate( $this->m_end_date );

		if ( $this->m_debug ) echo "\n overflow adjusted to " . $date_test->AsSQL( );

	    } else {

		if ( $this->m_debug ) {
		    echo "\n from " .  debug_backtrace()[1]['function'] . '/' . debug_backtrace()[0]['line'];
		    echo "\n uncorrectable overflow!";
		}

		$date_test = null;

		return true;

	    }

	    $ret = true;

	}

	return $ret;


    }	// function AdjustedUnderOverflow( )


//     abstract public function IsValid( );

    private function doPrint( $dt, $follower ) {

	echo "\n";
	echo $dt->AsSQL( ) ;
	if ( ! is_null( $follower ) ) {
	    echo ( $dt->IsWeekend( ) ? ' weekend ' :  '         ' );
	    echo ( $this->IsCelebrity( $dt ) ? ' celebrity ' :  '           ' );
	    echo ( $this->IsHoliday( $dt ) ? ' holiday ' :  '         ' );
	    echo ( $dt->IsSaturday( ) ? ' sa ' :  '    ' );
	    echo ( $dt->IsSunday( ) ? ' su ' :  '    ' );
	    echo ( $dt->lt( $this->GetStartDate( ) ) ? ' Underflow ' :  '           ' );
	    echo ( $dt->gt( $this->GetEndDate( ) ) ? ' Overflow ' :  '           ' );

	    echo '->';
	    echo $follower->AsSQL( );
	} else {
	    echo "                                                           ->NULL";
	    echo "\n -------------------- from " .  debug_backtrace()[1]['function'] . '/' . debug_backtrace()[0]['line'];
	}

    }	// function doPrint( )


    /**
      * The method GetArray( ) returns a series of fitting dates between $obj_date_start and $obj_date_end or
      * a bunch of first occurences in the given direction $direction. The resulting dates are added to the array $ary
      *
      * @param array $ary is the resulting array.
      * @param cDate $obj_date_start is the date, where we start from.
      * @param mixed $obj_date_end is the date, where we stop to calculate new events. If it is an int then it
      * defines the number of occurences to calculate from $obj_date_start on in direction $direction.
      * @param int $direction is the direction on the time line, in which the events are calculated. It defaults to
      * DIRECTION_FORWARD.
      * @param bool $debug toggles the debugging mode on, if it is true. By default it is false.
      *
      * @return void
      *
      * @see GetFirstDate
      * @see GetPredecessor
      * @see GetFollower
      * @see GetArray
      *
      *
      */


    public function GetArray( & $ary, $obj_date_start, $obj_date_end, $direction = self::DIRECTION_FORWARD, $debug = false ) {

	$ary = array( );

	$occurences = 0;

	assert( ( $direction == self::DIRECTION_FORWARD ) || $direction == self::DIRECTION_BACKWARD );

;
	if ( $this->m_debug ) echo "\n GetArray( ) starts with " . $obj_date_start->AsSQL( ) . ' and direction = ' . ( $direction == self::DIRECTION_FORWARD ? ' forward ' : ' backward');
	if ( $this->m_debug ) echo ' from ' .  debug_backtrace()[1]['function'] . '/' . debug_backtrace()[0]['line'];

	if ( ( is_a( $obj_date_start, '\rstoetter\libdatephp\cDate' ) ) && ( is_a( $obj_date_end, '\rstoetter\libdatephp\cDate' ) ) ) {

	    if ( $this->m_debug ) echo "\n GetArray( ) starts with end date = " . $obj_date_end->AsSQL( ) ;


	    $obj_date = new cDate( $obj_date_start );



	    if ( $this->m_debug ) echo "\n GetArray: starting with date " . $obj_date->AsSQL( );

	    // GetFollower() neglects the start date
	    if ( $direction == self::DIRECTION_FORWARD ) {
		$obj_date->Dec( );
	    } else {

		$obj_date->Inc( );
	    }

	    if ( $this->m_debug ) echo "\n adjusted start date to " . $obj_date->AsSQL( );

	    $dt_next = new cDate( $obj_date );
	    $dt_tmp = null;

	    if ( $direction == self::DIRECTION_FORWARD ) {

		if ( $this->m_debug) echo "\n ----- looping forward in GetArray( )";

		do {

		    if ( $debug ) {
			$this->doPrint( $obj_date, $this->GetFollower( $dt_next, $dt_tmp, $direction ) );
		    }

		    $debug = $this->m_debug;	// without debugging, because we debuuged it above
		    $this->m_debug = false;
		    $dt_next = new cDate( $obj_date );

		    $obj_date = $this->GetFollower( $dt_next, $dt_next, $direction );

		    $this->m_debug = $debug;

		    if ( is_null( $obj_date ) ) {
			if ( $this->m_debug ) echo "\n GetArray( ) received null ";

			break;

		    }

		    if ( $this->m_debug ) {

			    echo "\n GetArray( ) got " . $obj_date->AsSQL( );
		    }

		    if ( $debug ) echo "\n GetArray( ) received " . $obj_date->AsSQL( );

		    $ary[ ] = new cDate( $obj_date );

		    // $obj_date->Inc( );

		} while( $obj_date->lt( $obj_date_end ) );

	    } else {

		if ( $this->m_debug) echo "\n ----- looping backward in GetArray( )";

		do {

		    if ( $debug ) $this->doPrint( $obj_date, $this->GetFollower( $dt_next, $dt_tmp, $direction ) );


		    $debug = $this->m_debug;	// without debugging, because we debuuged it above
		    $this->m_debug = false;
		    $obj_date = $this->GetFollower( $dt_next, $dt_next, $direction );
		    $this->m_debug = $debug;

		    if ( is_null( $obj_date ) ) {

			break;

		    }

		    if ( $debug ) echo "\n GetArray( ) received " . $obj_date->AsSQL( );

		    $ary[ ] = new cDate( $obj_date );

		    // $obj_date->Inc( );

		} while( $obj_date->gt( $obj_date_end ) );

	    }

	} elseif ( ( is_a( $obj_date_start, '\rstoetter\libdatephp\cDate' ) ) && ( is_int( $obj_date_end ) ) ) {


	    $obj_date = new cDate( $obj_date_start );

	    $occurences = $obj_date_end;

	    if ( $this->m_debug ) echo "\n calculating $occurences occurences from  " . $obj_date_start->AsSQL( ) . ' on.';

	    if ( $this->m_debug) echo "\n ----- looping forward in GetArray( )";

	    $obj_date = $obj_date_start;
	    $dt_next = $obj_date;

	    for( $i = 0; $i < $occurences; $i++ ) {


		if ( $debug ) $this->doPrint( $obj_date, $this->GetFollower( $dt_next, $dt_tmp, $direction ) );

		$debug = $this->m_debug;	// without debugging, because we debuuged it above
		$this->m_debug = false;
		$obj_date = $this->GetFollower( $dt_next, $dt_next, $direction );
		$this->m_debug = $debug;

		if ( is_null( $obj_date ) ) {

		    if ( $this->m_debug) echo "\n GetArray( ) - received null value - aborting";

		    break;

		}

		if ( $this->m_debug) echo "\n GetArray( ) - received " . $obj_date->AsSQL( );

		$ary[ ] = $obj_date ;

	    }

	} else {

	    throw new \Exception( "\n GetArray: wrong parameters" );

	}



    }	// function GetArray( )



    /**
      * The method IsOverflow( ) returns true, if the cDate $dt is greater than the ending date
      *
      * @param cDate $dt cDate the date, which should be checked, whether it is in the calculated period of time.
      *
      * @return bool true, if an overflow happemed
      *
      * @see IsUnderflow
      * @see IsOverflow
      * @see IsBetweenLimits
      * @see SetStartDate
      * @see GetStartDate
      * @see SetEndDate
      * @see GetEndDate
      *
      *
      *
      */


    protected function IsOverflow( $dt ) {

        if ( ( $this->m_end_date != null ) && ( $dt->gt( $this->m_end_date) ) ) { return true; }

        return false;
    }

    /**
      * The method IsUnderflow( ) returns true, when the cDate $dt is lesser than the starting date
      *
      * @param $dt cDate the date, which should be checked, whether it is in the calculated period of time.
      *
      * @return bool true, if an underflow happemed
      *
      *
      * @see IsUnderflow
      * @see IsOverflow
      * @see IsBetweenLimits
      * @see SetStartDate
      * @see GetStartDate
      * @see SetEndDate
      * @see GetEndDate
      *
      *
      */

    protected function IsUnderflow( $dt ) {

	if ( is_null( $dt ) ) {
	    // assert( false == true);
	    throw new \Exception( "\n error in IsUnderflow( )" );
	}

	if ( is_null( $this->m_start_date ) ) {
	    return false;
	}

        if ( $dt->lt( $this->m_start_date ) ) {
	    return true;
	}

        return false;

    }


    /**
      * The method IsBetweenLimits( ) returns true, when the cDate $dt is greater or equal the starting date and $dt is less or equal the ending date
      *
      * @param $dt cDate the date, which should be checked, whether it is in the calculated period of time.
      *
      * @return bool true, if an underflow or an overflow happemed
      *
      *
      * @see IsUnderflow
      * @see IsOverflow
      * @see IsBetweenLimits
      * @see SetStartDate
      * @see GetStartDate
      * @see SetEndDate
      * @see GetEndDate
      *
      */

    protected function IsBetweenLimits( $dt ) {

        return ( ! IsUnderflow( $dt ) ) && ( ! IsOverflow( $dt ) );

    }

    /**
      * The method MoveDateIfNecessary( ) moves the cDate $date, when a special situation happens.
      *
      * The STRATEGY_DIRECTION_XXX constants control the behaviour of the algorithm, when certain situations take place.
      *
      * These circumstances are:
      *
      *		the algorithm encounters a saturday (defined by $m_directionOnSaturday)
      *		the algorithm encounters a sunday (defined by $m_directionOnSunday)
      *		the algorithm encounters a celebrity (defined by $m_directionOnCelebrity)
      *		the algorithm encounters an impossible situation (defined by $m_directionOnImpossible)
      *
      * STRATEGY_DIRECTION_LEAVE defines, that the calculated date should stay on it's place in the time line
      * STRATEGY_DIRECTION_BACKWARD defines, that the calculated date should be placed on the next possible place in the past:Search a fitting place before the calculated date
      * STRATEGY_DIRECTION_FORWARD defines, that the calculated date should be placed on the next possible place in the future:Search a fitting place after the calculated date
      * STRATEGY_DIRECTION_ABOLISH defines, that the calculated date should be abolished.
      *
      * @param $date cDate The date, which possibly has to be moved
      *
      * @return cDate the new cDate, which has been moved or null, if the new date could not be moved
      *
      * @see IsUnderflow
      * @see IsOverflow
      * @see SetEndDate
      * @see GetEndDate
      *
      *
      */


    public function MoveDateIfNecessary( $date ) {

        # NOTE : MoveDateIfNecessary() in Endlosschleife wenn sunday=back und saturday=forward -> verlegt von Sonntag auf Freitag

        $obj_date = new cDate( $date );

        if ( $this->m_debug ) echo "\n trying to move date " . $obj_date->AsSQL( );

        if (( $obj_date->IsSunday() ) && ( $this->m_directionOnSunday == self::STRATEGY_DIRECTION_ABOLISH) ) { return null; }
        if (( $obj_date->IsSaturday() ) && ( $this->m_directionOnSunday == self::STRATEGY_DIRECTION_ABOLISH) ) { return null; }
        if (( $this->IsCelebrity( $obj_date ) ) && ( $this->m_directionOnCelebrity == self::STRATEGY_DIRECTION_ABOLISH) ) { return null; }
        if (( $this->IsHoliday( $obj_date ) ) && ( $this->m_directionOnHoliday == self::STRATEGY_DIRECTION_ABOLISH) ) { return null; }

        do {

            $moved = false;

            if (( $obj_date->IsSunday() ) && ( $this->m_directionOnSunday != self::STRATEGY_DIRECTION_LEAVE) ) {

		if ( $this->m_debug ) echo "\n " . $obj_date->AsSQL( ) . " is a sunday";

                if ($this->m_directionOnSunday == self::STRATEGY_DIRECTION_BACKWARD) {
                    $obj_date->Dec( );
                    // jetzt verhindern wir eine Endlosschleife :
                    if ( $this->m_directionOnSaturday == self::STRATEGY_DIRECTION_FORWARD ) {
                        $obj_date->Dec( );
                    }
                    $moved = true;

                } elseif ($this->m_directionOnSunday == self::STRATEGY_DIRECTION_FORWARD) {
                    $obj_date->Inc( );
                    $moved = true;
                }
            }

            if (( $obj_date->IsSaturday() ) && ( $this->m_directionOnSaturday != self::STRATEGY_DIRECTION_LEAVE) ) {

		if ( $this->m_debug ) echo "\n " . $obj_date->AsSQL( ) . " is a saturday";

                if ($this->m_directionOnSaturday == self::STRATEGY_DIRECTION_BACKWARD) {
                    $obj_date->Dec( );
                    $moved = true;
                } elseif ($this->m_directionOnSaturday == self::STRATEGY_DIRECTION_FORWARD) {
                    $obj_date->Inc( );
                    $moved = true;
                }
            }

            if (( $this->IsCelebrity( $obj_date ) ) && ( $this->m_directionOnCelebrity != self::STRATEGY_DIRECTION_LEAVE) ) {

		if ( $this->m_debug ) echo "\n " . $obj_date->AsSQL( ) . " is a celebrity";

                if ($this->m_directionOnCelebrity == self::STRATEGY_DIRECTION_BACKWARD) {
                    $obj_date->Dec( );
                    // nun verhindern wie eine Endlosschleife :
                    if ( ( $obj_date->IsSunday() ) && ( $this->m_directionOnSunday == self::STRATEGY_DIRECTION_FORWARD ) ) {
                        $obj_date->Dec( );
                        if ( $this->m_directionOnSaturday == self::STRATEGY_DIRECTION_FORWARD ) {
                            $obj_date->Dec( );
                        }
                    }
                    $moved = true;
                } elseif ($this->m_directionOnCelebrity == self::STRATEGY_DIRECTION_FORWARD) {
                    $obj_date->Inc( );
                    $moved = true;
                }
            }

            if (( $this->IsHoliday( $obj_date ) ) && ( $this->m_directionOnHoliday != self::STRATEGY_DIRECTION_LEAVE) ) {

		if ( $this->m_debug ) echo "\n " . $obj_date->AsSQL( ) . " is a holiday";

                if ($this->m_directionOnHoliday == self::STRATEGY_DIRECTION_BACKWARD) {
                    $obj_date->Dec( );
                    // nun verhindern wie eine Endlosschleife :
                    if ( ( $obj_date->IsSunday() ) && ( $this->m_directionOnSunday == self::STRATEGY_DIRECTION_FORWARD ) ) {
                        $obj_date->Dec( );
                        if ( $this->m_directionOnSaturday == self::STRATEGY_DIRECTION_FORWARD ) {
                            $obj_date->Dec( );
                        }
                    }
                    $moved = true;
                } elseif ($this->m_directionOnHoliday == self::STRATEGY_DIRECTION_FORWARD) {
                    $obj_date->Inc( );
                    $moved = true;
                }
            }

            if ( ( $this->m_debug) && ( $moved ) ) echo "\n trying " . $obj_date->AsSQL( );


        } while ( $moved );

        if ( ! is_null( $this->m_start_date ) ) if ( ! is_null( $obj_date ) ) if ( $obj_date->lt( $this->m_start_date) ) {
	    if ( $this->m_debug ) echo "\n Underflow";
	    $obj_date = null;
	}
        if ( ! is_null( $this->m_end_date ) ) if ( ! is_null( $obj_date ) ) if ( $obj_date->gt( $this->m_end_date) ) {
	    if ( $this->m_debug ) echo "\n Overflow";
	    $obj_date = null;
	}

        if ( $this->m_debug ) {

	    if ( is_null( $obj_date ) ) {

		echo "\n could not move the event - returning null ";

	    } else {

		echo "\n moved the event on the " . $obj_date->AsSQL( );

	    }

	 }



        return $obj_date;

    }       // function MoveDateIfNecessary

    /**
      * The method IsCelebrity( ) returns true, if the date $obj_date is a celebrity.
      *
      *
      * @param $obj_date cDate The date, which is tested, whether it is a celebrity
      *
      * @return bool true, if $obj_date is a celebrity
      *
      * @see $m_a_celebrities
      * @see IsCelebrity
      * @see ResetCelebrities
      * @see AddCelebrity
      * @see IsHolidayOrCelebrity
      *
      */

    static public function IsCelebrity( $obj_date ) {

        for ( $i = 0; $i < count( cDateStrategy::$m_a_celebrities ); $i++){

            if ( $obj_date->eq( cDateStrategy::$m_a_celebrities[ $i ] ) ) {
		return true;
	    }
        }

        return false;
    }       // function IsCelebrity

    /**
      * The method AddCelebrity( ) adds $obj_date to the celebrities
      *
      *
      * @param $obj_date cDate The date, which should be added to the celebrities
      *
      * @see $m_a_celebrities
      * @see IsCelebrity
      * @see ResetCelebrities
      * @see AddCelebrity
      * @see IsHolidayOrCelebrity
      *
      */

     static public function AddCelebrity( $obj_date ) {

        cDateStrategy::$m_a_celebrities[] = ( new cDate($obj_date) );
	// array_push( cDateStrategy::m_a_celebrities, new cDate($obj_date) );

    }


    /**
      * The method AddHoliday( ) adds $obj_date to the holidays
      *
      *
      * @param $obj_date cDate The date, which should be added to the holidays
      *
      * @see $m_a_holidays
      * @see IsHoliday
      * @see ResetHolidays
      * @see AddHoliday
      * @see IsHolidayOrCelebrity
      *
      */

    public function AddHoliday( $obj_date ) {

        $this->m_a_holidays[] = new cDate($obj_date);

    }


    /**
      * The method IsHoliday( ) returns true, if the date $obj_date is a holiday.
      *
      *
      * @param $obj_date cDate The date, which is tested, whether it is a holiday
      *
      * @return bool true, if $obj_date is a holiday
      *
      * @see $m_a_holidays
      * @see IsHoliday
      * @see ResetHolidays
      * @see AddHoliday
      * @see IsHolidayOrCelebrity
      *
      */

    public function IsHoliday( $obj_date ) {

        for ($i=0; $i<count( $this->m_a_holidays ); $i++){

            if ($obj_date->eq( $this->m_a_holidays[$i] ) ) { return true;}
        }

        return false;

    }       // function IsHoliday


  /**
      * The method IsHolidayOrCelebrity( ) returns true, if the date $obj_date is a holiday or a celebrity.
      *
      *
      * @param $obj_date cDate The date, which is tested, whether it is a holiday or a celebrity
      *
      * @return bool true, if $obj_date is a holiday or a celebrity
      *
      * @see $m_a_holidays
      * @see IsHoliday
      * @see ResetHolidays
      * @see AddHoliday
      * @see IsHolidayOrCelebrity
      *
      */

    public function IsHolidayOrCelebrity( $obj_date ) {

        for ($i=0; $i<count( $this->m_a_holidays ); $i++){

            if ($obj_date->eq( $this->m_a_holidays[$i] ) ) { return true;}

        }

        for ($i=0; $i<count( $this->m_a_celebrities ); $i++){

            if ($obj_date->eq( $this->m_a_celebrities[$i] ) ) { return true;}

        }


        return false;

    }       // function IsHolidayOrCelebrity( )



    /**
      * The method ResetCelebrities( ) resets the celebrities in $m_a_celebrities
      *
      *
      * @see $m_a_celebrities
      * @see IsCelebrity
      * @see ResetCelebrities
      * @see AddCelebrity
      * @see IsHolidayOrCelebrity
      *
      */

    static public function ResetCelebrities( ) {

	cDateStrategy::$m_a_celebrities = array( );

     }       // function ResetCelebrities( )

    /**
      * The method ResetHolidays( ) resets the holidays stored in $m_a_holidays
      *
      *
      * @see $m_a_holidays
      * @see IsHoliday
      * @see ResetHolidays
      * @see AddHoliday
      * @see IsHolidayOrCelebrity
      *
      */

    public function ResetHolidays( ) {

	$this->m_a_holidays = array( );

     }       // function ResetHolidays( )


    /**
      * The method IsEventDate( ) returns true, if the date $obj_date is a date which corresponds to the specifications
      *
      * @param $obj_date cDate The date, which is tested
      *
      * @return bool true, if $obj_date is a date, which corresponds to the specifications
      *
      * @see GetNextEventDate
      * @see IsEventDate
      *
      */


    public function IsEventDate( $obj_date ) {

	if ( $this->m_debug ) echo "\n IsEventDate( ) starts with " . $obj_date->AsSQL( );

        if ( $this->IsUnderflow( $obj_date ) ) return false;
        if ( $this->IsOverflow( $obj_date ) ) return false;

/*
        if ( is_null( $this->GetFirstDate( ) ) ) {
	    $d = new cDate( $obj_date );
	    $d->Skip( - 400 );
	    if ( $this->m_debug ) echo "\n no first date -> starting with " . $d->AsSQL( );
	} else {
	      $d = new cDate( $this->GetFirstDate( ) );
	      if ( $this->m_debug ) echo "\n starting with " . $d->AsSQL( );
	 }
*/


	$follower = $this->GetFollower( $obj_date );
	if ( is_null( $follower ) ) {
	    $predecessor = $this->GetPredecessor( $obj_date );
	    if ( is_null( $predecessor ) ) {
		return null;
	    } else {
		$follower = $this->GetFollower( $predecessor );
		if ( is_null( $follower ) ) {
		    return false;
		} else {
		    return $follower->eq( $obj_date );
		}
	    }

	} else {
	    $predecessor = $this->GetPredecessor( $follower );
	    if ( is_null( $predecessor ) ) {
		return false;
	    } else {
		return $predecessor->eq( $obj_date );
	    }

	}


        return false;

    }   // function IsEventDate


    /**
      * The method GetNextEventDate( ) returns a cDate, if
      *
      * @param $obj_date_start cDate The date, from which the calculation should start
      * @param $is_first_date bool true, if $obj_date_start is the first one out of a series. If it is true, and the starting date of the managed period of time is the same as $obj_date_start, the the starting date will be returned by the method. $is_first_date defaults to true
      *
      * @return cDate|null returns a cDate, if a matching follower could be found or null, if not
      *
      * @see GetNextEventDate
      * @see IsEventDate
      *
      */

    public function GetNextEventDate( $obj_date_start, $is_first_date = true  ) {     // TODO : bei allen gleichen in den abgeleiteten Klassen diese rauswerfen

        if ( $this->IsUnderflow( $obj_date_start ) ) {
	    if ( $this->m_debug ) echo "\n Underflow!";
	    return null;
	}
        if ( $this->IsOverflow( $obj_date_start ) ) {
	    if ( $this->m_debug ) echo "\n Overflow!";
	    return null;
	}

        $dt = $this->GetFirstDate( );
        $fertig = false;

        # echo "<br> GetNextEventDate() : erster Termin ist am " . $dt->AsDMY();

        if ( ($is_first_date == true ) && ($obj_date_start->eq($dt)) ) { return $dt; }

        $dt_next = $dt;

        do {
            $dt = $this->GetFollower( $dt_next );
            # echo "<br> GetNextEventDate() : untersuche " . $dt->AsDMY();
            if ( $obj_date_start->eq( $dt ) && ( $is_first_date ) ) return $dt;
            if ( $this->IsOverflow( $dt ) ) { return null; }
            if ( $obj_date_start->lt( $dt ) ) return $dt;

        } while ( !$fertig);

        return null;

    }   // function GetNextEventDate

    /**
      * deprecated
      *
      */

    public function FromForm(  ) {
    /*
        $_POST[selectonsaturday] = abolish
        $_POST[selectonsunday] = abolish
        $_POST[selectoncelebrities] = abolish
        $_POST[startdate] = 11.10.2009
        $_POST[enddate] =
    */

        $onsaturday = $_POST['selectonsaturday'];
        $onsunday = $_POST['selectonsunday'];
        $oncelebrity = $_POST['selectoncelebrities'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];

        if ($onsunday == 'abolish' ) { $this->m_directionOnSunday = self::STRATEGY_DIRECTION_ABOLISH; }
        if ($onsunday == 'leave' ) { $this->m_directionOnSunday = self::STRATEGY_DIRECTION_LEAVE; }
        if ($onsunday == 'forward' ) { $this->m_directionOnSunday = self::STRATEGY_DIRECTION_FORWARD; }
        if ($onsunday == 'backward' ) { $this->m_directionOnSunday = self::STRATEGY_DIRECTION_BACKWARD; }

        if ($onsaturday == 'abolish' ) { $this->m_directionOnSaturday = self::STRATEGY_DIRECTION_ABOLISH; }
        if ($onsaturday == 'leave' ) { $this->m_directionOnSaturday = self::STRATEGY_DIRECTION_LEAVE; }
        if ($onsaturday == 'forward' ) { $this->m_directionOnSaturday = self::STRATEGY_DIRECTION_FORWARD; }
        if ($onsaturday == 'backward' ) { $this->m_directionOnSaturday = self::STRATEGY_DIRECTION_BACKWARD; }

        if ($oncelebrity == 'abolish' ) { $this->m_directionOnCelebrity = self::STRATEGY_DIRECTION_ABOLISH; }
        if ($oncelebrity == 'leave' ) { $this->m_directionOnCelebrity = self::STRATEGY_DIRECTION_LEAVE; }
        if ($oncelebrity == 'forward' ) { $this->m_directionOnCelebrity = self::STRATEGY_DIRECTION_FORWARD; }
        if ($oncelebrity == 'backward' ) { $this->m_directionOnCelebrity = self::STRATEGY_DIRECTION_BACKWARD; }

        $startdate = trim( $startdate );

        if (strstr( $startdate, '.' ) ) {
            if ( $this->m_start_date == null ) { $this->m_start_date = new cDate(); }
            $this->m_start_date->FromDMY( $startdate );
        } else {
            if ( $this->m_start_date == null ) { $this->m_start_date = new cDate(); }
            $this->m_start_date->FromMDY( $startdate );
        }

        # echo "<br>--------->startdate =" . $startdate . "und this->startDate=" . $this->m_start_date->AsDMY() ;

        $enddate = trim( $enddate );

        if ( strlen( $enddate )== 0 ) {
            $this->m_end_date = null;
        } elseif (strstr( $enddate, '.' ) ) {
            if ( $this->m_end_date == null ) { $this->m_end_date = new cDate(); }
            $this->m_end_date->FromDMY( $enddate );
        } else {
            if ( $this->m_end_date == null ) { $this->m_end_date = new cDate(); }
            $this->m_end_date->FromMDY( $enddate );
        }

        /*if ($this->m_end_date != null ) {
            echo "<br>--------->enddate =" . $enddate . "und this->endDate=" . $this->m_end_date->AsDMY() ;
        } else {
            echo "<br>enddate ist null !";
        }*/

    }


    /**
      * deprecated
      *
      */


    public function FillForm(  ) {

        echo "<table>";

        $msgVerwerfen = $this->id2msg( 1000 );
        $msgBelassen = $this->id2msg( 1001 );
        $msgNextTermin = $this->id2msg( 1002 );
        $msgPrevTermin = $this->id2msg( 1003 );
        $msgSamstage = $this->id2msg( 1004 );
        $msgSonntage = $this->id2msg( 1005 );
        $msgFeiertage = $this->id2msg( 1006 );
        $msgStartdatum = $this->id2msg( 1007 );
        $msgEnddatum = $this->id2msg( 1008 );

        echo "<tr><td>$msgSamstage</td>";
        echo "<td>";
            echo "<select name=selectonsaturday>";
                $sel = ($this->m_directionOnSaturday == self::STRATEGY_DIRECTION_ABOLISH ) ? ' selected=1' : '';
                echo "<option value=abolish $sel>$msgVerwerfen</option>";
                $sel = ($this->m_directionOnSaturday == self::STRATEGY_DIRECTION_LEAVE ) ? ' selected=1' : '';
                echo "<option value=leave $sel>$msgBelassen</option>";
                $sel = ($this->m_directionOnSaturday == self::STRATEGY_DIRECTION_FORWARD ) ? ' selected=1' : '';
                echo "<option value=forward $sel>$msgNextTermin</option>";
                $sel = ($this->m_directionOnSaturday == self::STRATEGY_DIRECTION_BACKWARD ) ? ' selected=1' : '';
                echo "<option value=backward $sel>$msgPrevTermin</option>";
            echo "</select>";
        echo "</td></tr>";

        echo "<tr><td>$msgSonntage</td>";
        echo "<td>";
            echo "<select name=selectonsunday>";
                $sel = ($this->m_directionOnSunday == self::STRATEGY_DIRECTION_ABOLISH ) ? ' selected=1' : '';
                echo "<option value=abolish $sel>$msgVerwerfen</option>";
                $sel = ($this->m_directionOnSunday == self::STRATEGY_DIRECTION_LEAVE ) ? ' selected=1' : '';
                echo "<option value=leave $sel>$msgBelassen</option>";
                $sel = ($this->m_directionOnSunday == self::STRATEGY_DIRECTION_FORWARD ) ? ' selected=1' : '';
                echo "<option value=forward $sel>$msgNextTermin</option>";
                $sel = ($this->m_directionOnSunday == self::STRATEGY_DIRECTION_BACKWARD ) ? ' selected=1' : '';
                echo "<option value=backward $sel>$msgPrevTermin</option>";
            echo "</select>";
        echo "</td></tr>";

        echo "<tr><td>$msgFeiertage</td>";
        echo "<td>";
            echo "<select name=selectoncelebrities>";
                $sel = ($this->m_directionOnCelebrity == self::STRATEGY_DIRECTION_ABOLISH ) ? ' selected=1' : '';
                echo "<option value=abolish $sel>$msgVerwerfen</option>";
                $sel = ($this->m_directionOnCelebrity == self::STRATEGY_DIRECTION_LEAVE ) ? ' selected=1' : '';
                echo "<option value=leave $sel>$msgBelassen</option>";
                $sel = ($this->m_directionOnCelebrity == self::STRATEGY_DIRECTION_FORWARD ) ? ' selected=1' : '';
                echo "<option value=forward $sel>$msgNextTermin</option>";
                $sel = ($this->m_directionOnCelebrity == self::STRATEGY_DIRECTION_BACKWARD ) ? ' selected=1' : '';
                echo "<option value=backward $sel>$msgPrevTermin</option>";
            echo "</select>";
        echo "</td></tr>";

/*        echo "<tr><td>Unm&ouml;glichkeiten</td>";
        echo "<td>";
            echo "<select name=selectonimpossible>";
                echo "<option value=abolish>verwerfen";
                echo "<option value=forward>n&auml;chstm&ouml;glicher Termin";
                echo "<option value=backward>letztm&ouml;glicher Termin";

            echo "</select>";
*/
//        echo "</td></tr>";

        $d = $this->m_start_date->AsDMY();
        if ( self::$language == "en_en" ) { $d = $this->m_start_date->AsMDY(); }
        echo "<tr><td>$msgStartdatum</td>";
        echo "<td><input name='startdate' value='$d'>";
        echo "</td></tr>";

        $d = ($this->m_end_date == null ) ? ' ' : $this->m_end_date->AsDMY();
        echo "<tr><td>$msgEnddatum</td>";
        echo "<td><input name=enddate value='$d'>";
        echo "</td></tr>";

        echo "</table>";


    }

    /**
      * deprecated
      *
      */



    protected function SetSpecialDaysFromForm( ) {

        $this->SetStrategySunday( self::STRATEGY_DIRECTION_ABOLISH );
        $this->SetStrategySaturday( self::STRATEGY_DIRECTION_ABOLISH );
        $this->SetStrategyCelebrity( self::STRATEGY_DIRECTION_ABOLISH );

        $selectonsunday = $_POST['selectonsunday'];
        if ( $selectonsunday =="abolish" ) { $this->SetStrategySunday( self::STRATEGY_DIRECTION_ABOLISH ); }
        elseif ( $selectonsunday =="leave" ) { $this->SetStrategySunday( self::STRATEGY_DIRECTION_LEAVE ); }
        elseif ( $selectonsunday =="forward" ) { $this->SetStrategySunday( self::STRATEGY_DIRECTION_FORWARD ); }
        elseif ( $selectonsunday =="backward" ) { $this->SetStrategySunday( self::STRATEGY_DIRECTION_BACKWARD ); }
        else throw new \Exception( "unbekannte Auswahl '$selectonsunday'");

        $selectonsaturday = $_POST['selectonsaturday'];
        if ( $selectonsaturday =="abolish" ) { $this->SetStrategySaturday( self::STRATEGY_DIRECTION_ABOLISH ); }
        elseif ( $selectonsaturday =="leave" ) { $this->SetStrategySaturday( self::STRATEGY_DIRECTION_LEAVE ); }
        elseif ( $selectonsaturday =="forward" ) { $this->SetStrategySaturday( self::STRATEGY_DIRECTION_FORWARD ); }
        elseif ( $selectonsaturday =="backward" ) { $this->SetStrategySaturday( self::STRATEGY_DIRECTION_BACKWARD ); }
        else throw new \Exception( "unbekannte Auswahl '$selectonsaturday'");

        $selectoncelebrities = $_POST['selectoncelebrities'];
        if ( $selectoncelebrities =="abolish" ) { $this->SetStrategyCelebrity( self::STRATEGY_DIRECTION_ABOLISH ); }
        elseif ( $selectoncelebrities =="leave" ) { $this->SetStrategyCelebrity( self::STRATEGY_DIRECTION_LEAVE ); }
        elseif ( $selectoncelebrities =="forward" ) { $this->SetStrategyCelebrity( self::STRATEGY_DIRECTION_FORWARD ); }
        elseif ( $selectoncelebrities =="backward" ) { $this->SetStrategyCelebrity( self::STRATEGY_DIRECTION_BACKWARD ); }
        else throw new \Exception( "unbekannte Auswahl '$selectoncelebrities'");

    }   // SetSpecialDaysFromForm()

      /**
      * deprecated
      *
      */



    protected function SetStartEndDatesFromForm() {

        $dt = new cDate();

        $strstartdate = trim($_POST['startdate']);
        $strenddate = trim($_POST['enddate']);

            if (strstr( $strstartdate, "/" )) {
                $dt -> FromMDY( $strstartdate );
            } else {
                $dt -> FromDMY( $strstartdate );
            }
            $this->SetStartDate( $dt );

            $this->EndDate = null;
            if ( $strenddate != "" ) {
                if (strstr( $strenddate, "/" )) {
                    $dt -> FromMDY( $strenddate );
                } else {
                    $dt -> FromDMY( $strenddate );
                }
                $this->SetEndDate( $dt );
            }

    }       // SetStartEndDatesFromForm


    # abstract public function GetNextEventDate( $date, $is_first_date = true  );
    # abstract public function GetPrevTerminDate( $date, $is_first_date = true  );




}       // of class cDateStrategy

?>