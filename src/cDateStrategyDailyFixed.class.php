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
//		public method ScheduleLazyDate($datestart,$dateisfirst=true)
//		public method GetPeriodType()
//		public method IsValid()
//		public method Reset()
//		public method SetDayNumber($set)
//		public method SetPeriodType($set)
//		public method cDateStrategyDailyFixed($str=undef)
//		protected var $m_day_number
//		protected var $m_type_period
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?><?php

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategyDailyFixed
////////////////////////////////////////////////////////////////////////////////////

namespace rstoetter\libdatephp;




/**
  *
  * The class cDateStrategyDaily calculates recurring daily events. It is specialized to find simgle events in a specific period of time (month, quarter, year).
  *
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

class cDateStrategyDailyFixed extends cDateStrategy {

    // bestimmter fixer Tag in einem bestimmten Zeitraum (Monat, Quartal, Jahr)

    /**
      * The FIX_XXX constants define the type of the period of time in which events should be searched
      *
      * FIX_DAY_MONTH defines the month as period of time between the events
      * FIX_DAY_QUARTER defines the quarter as period of time between the events
      * FIX_DAY_YEAR defines the year as period of time between the events
      *
      * @var int FIX_DAY_MONTH
      *
      * @see FIX_DAY_MONTH
      * @see FIX_DAY_QUARTER
      * @see FIX_DAY_YEAR
      * @see $m_type_period
      *
      */

    const FIX_DAY_MONTH = 0;

    /**
      * The FIX_XXX constants define the type of the period of time in which events should be searched
      *
      * FIX_DAY_MONTH defines the month as period of time between the events
      * FIX_DAY_QUARTER defines the quarter as period of time between the events
      * FIX_DAY_YEAR defines the year as period of time between the events
      *
      * @var int FIX_DAY_QUARTER
      *
      * @see FIX_DAY_MONTH
      * @see FIX_DAY_QUARTER
      * @see FIX_DAY_YEAR
      * @see $m_type_period
      *
      */

    const FIX_DAY_QUARTER = 1;

    /**
      * The FIX_XXX constants define the type of the period of time in which events should be searched
      *
      * FIX_DAY_MONTH defines the month as period of time between the events
      * FIX_DAY_QUARTER defines the quarter as period of time between the events
      * FIX_DAY_YEAR defines the year as period of time between the events
      *
      * @var int FIX_DAY_YEAR
      *
      * @see FIX_DAY_MONTH
      * @see FIX_DAY_QUARTER
      * @see FIX_DAY_YEAR
      * @see $m_type_period
      *
      */

    const FIX_DAY_YEAR = 2;

    /**
      * The property $m_type_period defines the type of the period of time in which events should be searched
      *
      * @var int m_type_period
      *
      * @see FIX_DAY_MONTH
      * @see FIX_DAY_QUARTER
      * @see FIX_DAY_YEAR
      * @see $m_type_period
      *
      */

    protected $m_type_period = self::FIX_DAY_MONTH;

    /**
      * The property $m_day_number sets the one-based fix day in the chosen period of time. It defaults to 1.
      *
      *
      * @var int $m_day_number
      *
      */


    protected $m_day_number = 1;

    /**
      * The constructor of cDateStrategyDailyFixed
      *
      *  Example:
      *
      *      $strategy = new \libdatephp\cDateStrategyDailyFixed(
      *				new \libdatephp\cDate( ),
      *				null,
      *				'en_en',
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD
      *				);
      *
      *	    $strategy2 = new \libdatephp\cDateStrategyDailyFixed( $strategy->AsString( ) );
      *
      *	    $strategy3 = new \libdatephp\cDateStrategyDailyFixed( );
      *
      *	    $strategy4 = new \libdatephp\cDateStrategyDailyFixed( 's3-0:0:0:0:1-(24.4.2017)-(0.0.0)-1-p0' );
      *
      *
      * @example "./tst/tst-cDateStrategyDailyFixed.php" Full Example:
      *
      *
      *
      * @param $start_date mixed If it is a string, then the template for the algorithm got by AsString( ). If it is a cDate: the date, from which the calcultions should start. If it is null, then the actual date will be used. $start_date defaults to null
      * @param $end_date string with language or null when $start_date is a template. Else cDate the date, where the calcultions should stop. If it is null, then there is no ending date for the calculations. $end_date defaults to null
      * @param $language string the language for messages. ('de_de', 'en_en' or 'fr_fr'). It defaults to 'en_en'.
      * @param $directionOnSaturday int controls how to proceed, when the algorithm encounters a saturday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param $directionOnSunday int controls how to proceed, when the algorithm encounters a sunday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param $directionOnCelebrity int controls how to proceed, when the algorithm encounters a celebrity. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param $m_directionOnHoliday int controls how to proceed, when the algorithm encounters a holiday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param $directionOnImpossible int controls how to proceed, when the algorithm encounters an impossible situation. It defaults to self::STRATEGY_DIRECTION_FORWARD.
      *
      * @return cDateStrategyDailyFixed
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
			)  {

	  if ( is_string( $start_date ) ) {

	      // read the template

	      // echo "\n reading from string '$start_date'";

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

	      // echo "\n start date is " . $start_date->AsSQL( );

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

	  echo "\n" . $this->AsString();

    }   // constructor

/*

    public function __construct( $str = undef ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str==undef ) {
                $this->Reset();;
            } else {
                $this->FromString( $str ) ;
            }

            $this->IsValid();

    }   // constructor
*/


    /**
      * The method Reset( ) resets the day number and the period type and calls the parental Reset( ) method
      *
      */

    public function Reset() {

        parent::Reset();

        $this->m_day_number = 1;
        $this->m_type_period = self::FIX_DAY_MONTH;

    }

    /**
      * The method IsValid( ) returns always true.
      *
      * @return bool true, if we are ready to go and can start to calculate dates and events
      *
      *
      */

    public function IsValid( ) {

        # if ( ! ($this->onMonday+$this->onTuesday+$this->onWednesday+$this->onThursday+$this->onFriday+$this->onSaturday+$this->onSunday)) {
          #  die("wenigstens ein Wochentag mu&szlig; gesetzt sein !");
        # }

        return true;

    }       // function IsValid( )


    /**
      * The method FromString( ) reads its specifications from the string $str
      * The template starts with 's3' and is normally made by AsString( )
      *
      * The calendars for celebrities and holidays remain untouched.
      *
      * @param string $str the specifications as string as we get it via AsString( )
      *
      * @see FromString
      * @see AsString
      */


    public function FromString( $str ) {
/*
        sscanf( $str, "s1-%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-(%d.%d.%d)",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $day, $month, $year
            );
*/

        sscanf( $str, "s3-%d:%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d-p%d",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,$this->m_directionOnImpossible,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $this->m_day_number, $this->m_type_period );

        # echo "\n FromString : s3-$this->m_day_number-p$this->m_type_period";

        // $this->m_start_date->SetDate($startmonth, $startday, $startyear );

        if ($endday==0) {
            $this->m_end_date = undef;
        } else {
            $this->m_end_date = new cDate($endmonth, $endday, $endyear );
        }

        if ($startday==0) {
            $this->m_start_date = null;
        } else {
            $this->m_start_date = new cDate($startmonth, $startday, $startyear );
        }

        $this->IsValid();

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

        if ( is_null( $this->m_end_date ) ) {
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->m_end_date->Day();
            $endmonth = $this->m_end_date->Month();
            $endyear = $this->m_end_date->Year();
        }

        if ( $this->m_start_date == null ){
            $startday = $startmonth = $startyear = 0;
        } else {
            $startday = $this->m_start_date->Day();
            $startmonth = $this->m_start_date->Month();
            $startyear = $this->m_start_date->Year();
        }

        return sprintf( "s3-%d:%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d-p%d",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,$this->m_directionOnImpossible,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $this->m_day_number, $this->m_type_period );

    }   // function AsString

    /**
      *
      * @deprecated
      *
      *
      */


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

            if ( $period == "quarter" ) { $this->SetPeriodType( self::FIX_DAY_QUARTER ); }
            elseif ( $period == "month" ) { $this->SetPeriodType( self::FIX_DAY_MONTH ); }
            elseif ( $period == "year" ) { $this->SetPeriodType( self::FIX_DAY_YEAR ); }
            else die("\ncDateStrategyDailyFixed::FromForm : unbekannter Zeitraum");

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
        }

    }   // function FromForm

    /**
      *
      * @deprecated
      *
      *
      */


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
            $nth = $this->m_day_number;
            echo " $msgAm <input name = s3_day size=3 value = '$nth'>$msgtenTag ";

            $pt = $this->m_type_period;
            echo "<select name=s3_select>";
                $sel = ( ($pt == self::FIX_DAY_MONTH ) ? "selected=1" : '' );
                echo "<option value=month $sel >$msgMonat";
                $sel = ( ($pt == self::FIX_DAY_QUARTER ) ? "selected=1" : '' );
                echo "<option value=quarter $sel>$msgQuartal";
                # echo "<option value=halfyear>Halbjahr";
                $sel = ( ($pt == self::FIX_DAY_YEAR ) ? "selected=1" : '' );
                echo "<option value=year $sel>$msgJahr";
            echo "</select>";
        echo "</td></tr>";

    }   // function FillForm

    /**
      * The method SetDayNumber( ) sets the specific day in the chosen period of time
      *
      * @param int $set the number of the day in the chosen period of time
      *
      * @see GetDayNumber
      * @see SetDayNumber
      * @see $m_day_number
      *
      */

    public function SetDayNumber( $set ) {
        $this->m_day_number = $set;
    }


    /**
      * The method GetDayNumber( ) returns the specific day in the chosen period of time
      *
      * @return int the number of the day in the chosen period of time
      *
      * @see GetDayNumber
      * @see SetDayNumber
      * @see $m_day_number
      *
      */


    public function GetDayNumber( ) {
        return $this->m_day_number;
    }


    /**
      * The method SetPeriodType( ) sets the period of time, in which the specific day number should be set.
      *
      * @param int $set the constant, which defines the type of the period of time
      *
      * @see SetPeriodType
      * @see GetPeriodType
      * @see $m_type_period
      * @see FIX_DAY_MONTH
      * @see FIX_DAY_QUARTER
      * @see FIX_DAY_YEAR
      *
      */


    public function SetPeriodType( $set ) {
        $this->m_type_period = $set;
    }

    /**
      * The method GetPeriodType( ) returns the period of time, in which the specific day number should be set.
      *
      * @return int the constant, which defines the actually chosen type of the period of time
      *
      * @see SetPeriodType
      * @see GetPeriodType
      * @see $m_type_period
      * @see FIX_DAY_MONTH
      * @see FIX_DAY_QUARTER
      * @see FIX_DAY_YEAR
      *
      */

    public function GetPeriodType( ) {
        return $this->m_type_period;
    }


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
      *
      */

    function GetNextEventSlot( $date, $direction = self::DIRECTION_FORWARD ) {

	$this->ScheduleLazy( $date, $date, $direction  );

	return $date;

    }    // function GetNextEventSlot( )

    /**
      * The private method ScheduleLazy( ) returns an event without caring for special situations
      *
      * @param cDate $date_test returns the calculated event date, the calculation did not mention special situations.
      * @param cDate $date_start the date to start with
      * @param int $direction returns the calculated event date, the calculation did not mention special situations.
      *
      * @return void
      *
      */

    private function ScheduleLazy( & $date_test, $date_start, $direction  ) {

	assert( is_int( $direction ) );
	assert( is_a( $date_test, '\rstoetter\libdatephp\\cDate' ) );
	assert( is_a( $date_start, '\rstoetter\libdatephp\\cDate' ) );

	$date_test = new \rstoetter\libdatephp\cDate( $date_start );

	if ( $this->m_debug) echo "\n ScheduleLazy( ) direction = " . ( $direction == self::DIRECTION_FORWARD ? ' forward' : ' backward') ;

	if ( $this->m_type_period == self::FIX_DAY_MONTH ) {

	    $month = $date_test->Month();
	    $year = $date_test->Year();
	    $day = $date_test->Day();

	    if ( ( $day < $this->m_day_number ) && ( $direction == self::DIRECTION_FORWARD ) ) {

		$day = $this->m_day_number;

	    } elseif ( ( $day >= $this->m_day_number ) && ( $direction == self::DIRECTION_FORWARD ) ) {

		if ( $month == 12 ) { $month = 1; $year++; } else { $month++; }

		$day = $this->m_day_number;

	    } elseif ( ( $day <= $this->m_day_number ) && ( $direction == self::DIRECTION_BACKWARD ) ) {

		if ( $month == 1 ) { $month = 12; $year--; } else { $month--; }

		$day = $this->m_day_number;


	    } elseif ( ( $day > $this->m_day_number ) && ( $direction == self::DIRECTION_BACKWARD ) ) {

		$day = $this->m_day_number;


	    } else {

		throw new \Exception( "\n uncalculated version detected" );

	    }

	    if ( $this->m_debug ) echo "\n new daynumber = $day" ;

	    if ( ! ( checkdate( $month, $this->m_day_number, $year ) ) ) {

		$max_number = $date_test->LOM( );

		if ( $direction == self::DIRECTION_FORWARD ) {

		    $date_test = new \rstoetter\libdatephp\cDate( $month, 1, $year );

		    $date_test->GoEOM( );

		    $date_test->Inc( );
		    if ( $this->m_debug ) echo "\n date adapted to " . $date_test->AsSQL( ) ;
		} else {

		    $no = $this->m_day_number;
		    do {
			$no--;
		    } while ( ! checkdate( $month, $no, $year ) );

		    $date_test = new \rstoetter\libdatephp\cDate( $month, $no, $year );

		}

		if ( $this->m_debug ) echo "\n corrected daynumber => " . $date_test->AsSQL( ) ;

	    } else {

		$date_test = new \rstoetter\libdatephp\cDate( $month, $this->m_day_number, $year );
		if ( $this->m_debug ) echo "\n date is now " . $date_test->AsSQL( ) ;

	    }

	} elseif ( $this->m_type_period == self::FIX_DAY_QUARTER ) {

	    $quarter = $date_test->NOQ();
	    $year = $date_test->Year();

	    # echo "\nQuartal = $quarter Jahr = $year ->" . $date_test->AsDMY() . "daynumber = ".$this->m_day_number;

	    if ( ( $quarter == 4 ) && ( $direction == self::DIRECTION_FORWARD ) ) {
		$quarter = 1;
		$year ++;
		$quarterstart = new cDate( 1, 1, $year);
		$quarterstart ->Skip( $this->m_day_number );
		$quarterstart->dec();
		$date_test = new cDate( $quarterstart );
	    } elseif ( ( $quarter == 1 ) && ( $direction == self::DIRECTION_BACKWARD ) ) {
		$quarter = 1;
		$year --;
		$quarterstart = new cDate( 12, 31, $year);
		$quarterstart->GoBOQ( );
		$quarterstart ->Skip( $this->m_day_number );
		$quarterstart->Dec();
		$date_test = new cDate( $quarterstart );
	    } else {

		if ( $direction == self::DIRECTION_FORWARD ) {
		    $date_test->GoEOQ( );
		    $date_test->Inc( );
		    $date_test->Skip( $this-> m_day_number );
		    $date_test->Dec( );
		    // $ret = new cDate( $date_test );
		} else {

		    $date_test->GoBOQ( );
		    $date_test->Dec( );
		    $date_test->GoBOQ( );
		    $date_test->Skip( $this-> m_day_number );
		    $date_test->Dec( );


		}

	    }

	    if ( $this->m_debug ) echo "\n set date in quarter to " . $date_test->AsSQL( );

	}  elseif ( $this->m_type_period == self::FIX_DAY_YEAR ) {

	    $month = $date_test->Month();
	    $year = $date_test->Year();
	    $day = $date_test->Day();

	    if ( $this->m_debug ) echo "\n start date in year with " . $date_test->AsSQL( );


	    if ( $direction == self::DIRECTION_FORWARD ) {

		$tst_date = new cDate( 1, 1, $year );
		$tst_date->Skip( $this->m_day_number );
		$tst_date->Dec( );

		if ( $tst_date->gt( $date_start ) ) {

		    // passt der Termin im aktuellen Jahr noch?

		    echo "\n passt noch in diesem Jahr!";

		    $date_test = $tst_date;

		} else {

		    echo "\n passt nicht mehr in diesem Jahr!";

		    $date_test = new cDate( 1, 1, ++$year );
		    $date_test->Skip( $this->m_day_number );
		    $date_test->Dec( );
		}

	    } else {

		$tst_date = new cDate( 1, 1, $year );
		$tst_date->Skip( $this->m_day_number );
		$tst_date->Dec( );

		if ( $tst_date->lt( $date_start ) ) {

		    // passt der Termin im aktuellen Jahr noch?

		    $date_test = $tst_date;

		} else {

		    $date_test = new cDate( 1, 1, --$year );
		    $date_test->Skip( $this->m_day_number );
		    $date_test->Dec( );

		}

	    }

	    // $ret = new cDate( $date_test );

	    if ( $this->m_debug ) echo "\n set date in year to " . $date_test->AsSQL( );

	}


    }	// function ScheduleLazy( )




    /**
      * The method GetFirstDate( ) returns the first valid date of the series to be calculated according to the specifications
      *
      * @return cDate a cDate object with the first fitting date or null, if no fitting date could be found ( overflow, IsUnderflow)
      *
      * @see GetFollower
      * @see GetFirstDate
      *
      *
      */


    public function GetFirstDate( ) {

	if ( ! $this->IsValid( ) ) die( "\n cDateStrategyDailyFixed::GetFirstDate() : no valid data to calculate anything" );

	$dt = null;

	if ( is_null( $this->m_start_date ) ) die( "\n cannot calculate a first date, when there is no starting date!" );

        if ( $this->m_type_period == self::FIX_DAY_YEAR ) {
            $date_obj =new cDate($this->m_start_date);
            $date_obj->GoBOY();
            $date_obj->dec();
            $date_obj->Skip( $this->m_day_number);

            $date_obj = $this->MoveDateIfNecessary( $date_obj );

            return $date_obj;
        } elseif  ( $this->m_type_period == self::FIX_DAY_QUARTER ) {
            $date_obj =new cDate($this->m_start_date);
            $date_obj->GoBOQ();
            $date_obj->Skip( $this->m_day_number);
            $date_obj->dec();

            $date_obj = $this->MoveDateIfNecessary( $date_obj );

            return $date_obj;
        } elseif  ( $this->m_type_period == self::FIX_DAY_MONTH ) {
            $date_obj =new cDate($this->m_start_date);
            # echo "\ndate_obj = " . $date_obj->AsDMY();
            # echo "\nstartdate = " . $this->m_start_date->AsDMY();
            $date_obj->GoBOM();
            # echo "\nGoBOM() liefert " . $date_obj->AsDMY();
            $date_obj->Skip( $this->m_day_number);
            $date_obj->dec();

            $date_obj = $this->MoveDateIfNecessary( $date_obj );

            return $date_obj;
        }

        return undef;

    }   // function GetFirstDate



}       // of class cDateStrategyDailyFixed
?>