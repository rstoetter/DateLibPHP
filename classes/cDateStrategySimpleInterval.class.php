<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategySimpleInterval.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategySimpleInterval' erweitert 'cDateStrategy' um alle n Tage einen bestimmten Termin
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
//		_POST['s6_days']
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
//	class cDateStrategySimpleInterval
//		public method AsString()
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($date)
//		public method GetPeriodLen($days)
//		public method IsValid()
//		public method Reset()
//		public method SetPeriodLen($days)
//		public method cDateStrategySimpleInterval($str=null)
//		protected var $m_days_period
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?><?php

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategySimpleInterval
////////////////////////////////////////////////////////////////////////////////////

namespace libdatephp;

/**
  *
  * The class cDateStrategySimpleInterval is a container for dates, which occour after each n days.
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

class cDateStrategySimpleInterval extends cDateStrategy {

    // alle n Tage ein Termin


    /**
      * The property $m_days_period are the days between two dates. An event after $m_days_period days
      *
      * @var int m_days_period the days between two events
      *
      * @see m_days_period
      * @see m_date_start
      *
      */

    protected $m_days_period = 0;

    /**
      * The property $m_date_start is the starting date for the calculation.
      *
      * @var cDate $m_date_start a valid event date
      *
      * @see m_days_period
      * @see m_date_start
      *
      */

    protected $m_date_start = null;


    /**
      * The constructor of cDateStrategyMonthlyFixed
      *
      *  Example:
      *
      *      $strategy = new \libdatephp\cDateStrategyMonthlyFixed(
      *				new \libdatephp\cDate( ),,
      *				null,
      *				'en_en',
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD
      *				);
      *
      *	    $strategy2 = new \libdatephp\cDateStrategyMonthlyFixed( $strategy->AsString( ) );
      *
      *	    $strategy3 = new \libdatephp\cDateStrategyMonthlyFixed( );
      *
      *	    $strategy4 = new \libdatephp\cDateStrategyMonthlyFixed( '' ); // TODO - stimmt hier nicht
      *
      *
      * @example "./tst/tst-cDateStrategyMonthlyFixed.php" Full Example:
      *
      *
      *
      * @param mixed $start_date mixed If it is a string, then the template for the algorithm got by AsString( ). If it is a cDate: the date, from which the calcultions should start. If it is null, then the actual date will be used. $start_date defaults to null
      * @param string $end_date string with language or null when $start_date is a template. Else cDate the date, where the calcultions should stop. If it is null, then there is no ending date for the calculations. $end_date defaults to null
      * @param string $language string the language for messages. ('de_de', 'en_en' or 'fr_fr'). It defaults to 'en_en'.
      * @param int $directionOnSaturday int controls how to proceed, when the algorithm encounters a saturday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param int $directionOnSunday int controls how to proceed, when the algorithm encounters a sunday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param int $directionOnCelebrity int controls how to proceed, when the algorithm encounters a celebrity. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param int $m_directionOnHoliday int controls how to proceed, when the algorithm encounters a holiday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param int $directionOnImpossible int controls how to proceed, when the algorithm encounters an impossible situation. It defaults to self::STRATEGY_DIRECTION_FORWARD.
      *
      * @return cDateStrategyMonthlyFixed
      *
      */

    function __construct(
			$start_date = null,
			$end_date = null,
			$language = 'en_en',
			$directionOnSaturday = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnSunday = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnCelebrity = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnHoliday = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnImpossible = self::STRATEGY_DIRECTION_FORWARD
			)  {

	   $this->Reset( );

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

    public function cDateStrategySimpleInterval( $str = null ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str == null ) {
                $this->Reset();
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

        $this->m_days_period=1;
    }

    /**
      * The method FromString( ) reads the specifications of the strategy from the string $str
      * The template starts with 's6' and is normally made by AsString( ). The
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
        // "s1-05.04.2009"

        sscanf( $str, "s6-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{%d}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $days );

        $this->m_days_period = $days;

        $this->m_start_date->SetDate($startmonth, $startday, $startyear );

        if ($endday==0) {
            $this->m_end_date = null;
        } else {
            $this->m_end_date = new cDate($endmonth, $endday, $endyear );
        }

        # $this->IsValid();

        # echo "\n Intervall alle $days Tage";
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

        return sprintf( "s6-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{%d}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $this->m_start_date->Day(), $this->m_start_date->Month(), $this->m_start_date->Year(),
            $endday, $endmonth, $endyear,

            $this->m_days_period );
    }   // function AsString

    /**
      * The method SetPeriodLen( ) sets the number of days between two events
      *
      * @param int $days the number of dates between two events
      *
      *
      * @see SetPeriodLen
      * @see GetPeriodLen
      *
      */

    public function SetPeriodLen( $days ) {
        $this->m_days_period = $days;
    }       // function SetPeriodLen()


    /**
      * The method GetPeriodLen( ) returns the number of days between two events
      *
      * @return int $days the number of dates between two events
      *
      *
      * @see SetPeriodLen
      * @see GetPeriodLen
      *
      */


    public function GetPeriodLen( ) {

        return $this->m_days_period;

    }       // function GetPeriodLen()



    /**
      * The method SetValidDate( ) sets a valid event date
      *
      * @param cDate $dt a valid event date
      *
      *
      * @see SetValidDate
      * @see GetValidDate
      *
      */

    public function SetValidDate( $dt ) {

        $this->m_date_start = $dt;

    }       // function SetValidDate( )


    /**
      * The method GetValidDate( ) returns the valid date, which is starting point of the calculations
      *
      * @return cDate the valid date
      *
      *
      * @see SetValidDate
      * @see GetValidDate
      *
      */


    public function GetValidDate( ) {

        return $this->m_date_start;

    }       // function GetValidDate()


    /**
      *
      * @depracated
      *
      */


    public function FromForm(  ) {
        # $_POST[strategy] = s6_interval
        # $_POST[s6_days] = 34

        $radiostrategy = $_POST['strategy'];

        // assert ($radiostrategy == 's6_interval');

        if ($radiostrategy == 's6_interval') {

            $this->SetPeriodLen( $_POST['s6_days'] );

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
        }


    }   // function FromForm

    /**
      *
      * @depracated
      *
      */


    public function FillForm( $checked = false ) {

        $msgImMonat = $this->id2msg( 1049 );
        $msgEinfachesIntervall = $this->id2msg( 1050 );
        $msgTage = $this->id2msg( 1051 );
        $msgAlle = $this->id2msg( 1052 );

        $check = ( $checked ) ? " checked " : "";

        echo "<tr><td><input type=radio name = 'strategy' value='s6_interval' $check>$msgEinfachesIntervall</td>";
        $days = $this->m_days_period;
        echo "<td>$msgAlle <input name=s6_days size=4 value = '$days'> $msgTage";

        echo "</td></tr>";


    }   // function FillForm

    /**
      * The method IsValid( ) returns true, if the calculations can start.
      * In order to run, at least one month number and one day number have to be set before
      *
      * @see AddMonth
      * @see AddMonthDay
      *
      */

    public function IsValid() {
        return $this->m_days_period > 0;
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
      */


    public function GetNextEventSlot( $obj_date, $direction = self::DIRECTION_FORWARD ) {

        assert( is_int( $direction ) );

        $date_org = new cDate( $obj_date );

//         if ( is_a( $obj_date, '\\libdatephp\\cDate' ) ) {
// 	    $obj_date = new cDateISO( $obj_date );
//         }

        assert( is_a( $obj_date, '\\libdatephp\\cDate' ) || is_a( $obj_date, '\\libdatephp\\cDateISO' ) );

	if ( $this->m_debug ) echo "\n GetNextEventSlot( ) starts with " . $obj_date->AsSQL( ) . ' direction is ' . ( $direction == self::DIRECTION_FORWARD ? ' forward' : 'backward');
	if ( $this->m_debug ) echo ' from ' .  debug_backtrace()[1]['function'] . '/' . debug_backtrace()[0]['line'];

	if ( $direction == self::DIRECTION_FORWARD) {
	    $obj_date->Inc( );	// we are looking for the next slot
	} else {
	    $obj_date->Dec( );	// we are looking for the previous slot
	}

	if ( $this->m_debug ) echo "\n skipped to " . $obj_date->AsSQL( );

	// if ( $this->m_debug ) echo "\n checking now date " . $obj_date->AsSQL( );

	$date = new cDate( $obj_date );

	//

	$seconds_per_day = 24 * 60 * 60;
	$julian_days = $this->m_days_period * $seconds_per_day;
	$julian_start = $this->m_date_start->AsTimeStamp( );
	$julian_act = $obj_date->AsTimeStamp( );

	if ( $this->m_debug ) echo "\n julian_days = $julian_days julian_act = $julian_act julian_start = $julian_start";

	//



	if ( $direction == self::DIRECTION_FORWARD ) {

	    assert( $this->m_date_start->le( $date ) );

	    if ( $this->m_debug ) echo "\n direction = forward";

	    if ( $this->m_days_period == 1 ) {
		if ( $this->m_debug ) echo "\n GetNextEventSlot( ) fw returns ( 1 ) " . $obj_date->AsSQL( );
		return new cDate( $obj_date );
	    }

	    $diff = $julian_act - $julian_start;
	    if ( $this->m_debug ) echo "\n diff = $diff";

	    if ( $diff % $julian_days == 0 ) {
		if ( $this->m_debug ) echo "\n GetNextEventSlot( ) fw returns ( 2 ) " . ( new cDate( $julian_act  ) )->AsSQL( );
		return new cDate( $julian_act );

	    }

	    $diff = floor( ( $julian_act - $julian_start ) / $julian_days );
	    $rest_julian = ( ( $julian_act - $julian_start ) / $julian_days ) - $diff;
	    $rest_days = ( 1 - $rest_julian ) * $julian_days;
	    // $next = $julian_act + $rest_days + $diff / $seconds_per_day ;
	    $next = ( int ) ( $julian_act + $rest_days + $diff );

// 	    echo "\n ==> julian_act = $julian_act diff = $diff rest_days = $rest_days rest_julian = $rest_julian next = $next -> "  ;
// 	    echo "" . ( new cDate( $next ) )->AsSQL( );

	    // $date = new cDate( $this->m_date_start );
	    $date = new cDate( $next );

	    if ( $this->m_debug ) echo "\n GetNextEventSlot( ) fw returns ( 3 ) " . $date->AsSQL( );

	    return $date;

	} elseif ( $direction == self::DIRECTION_BACKWARD ) {

	    assert( $this->m_date_start->ge( $date ) );

	    if ( $this->m_debug ) echo "\n direction = backwards";

	    if ( $this->m_days_period == 1 ) {
		if ( $this->m_debug ) echo "\n GetNextEventSlot( ) bw returns ( 1 ) " . $obj_date->AsSQL( );
		return new cDate( $obj_date );
	    }

	    $diff = $julian_act - $julian_start;
	    if ( $this->m_debug ) echo "\n diff = $diff";

	    if ( $diff % $julian_days == 0 ) {
		if ( $this->m_debug ) echo "\n GetNextEventSlot( ) bw returns ( 2 ) " . ( new cDate( $julian_act  ) )->AsSQL( );
		return new cDate( $julian_act );

	    }

	    $diff = floor( ( $julian_start - $julian_act ) / $julian_days );
	    $diff2 = ( ( ( $julian_start - $julian_act ) % $julian_days ) / $julian_days );
	    $rest_days = ( 1 - $diff2 ) * $julian_days;
	    $next = ( int ) ( $julian_act - $rest_days + $diff );

 	    // echo "\n ==> julian_act = $julian_act diff = $diff rest_days = $rest_days diff2 = $diff2 next = $next -> "  ;
 	    // echo "" . ( new cDate( $next ) )->AsSQL( );

	    // $date = new cDate( $this->m_date_start );
	    $date = new cDate( $next );

	    if ( $this->m_debug ) echo "\n GetNextEventSlot( ) bw returns ( 3 ) " . $date->AsSQL( );

	    return $date;


	}

	if ( ( $this->m_debug ) && ( ! is_null( $obj_date_ret ) ) ) echo "\n GetNextEventSlot( ) returns " . $obj_date_ret->AsSQL( );

	return $obj_date_ret;

    }	// functiom GetNextEventSlot( )




    public function GetNextEventDate( $datestart, $dateisfirst = true  ) {

        if ( $this->IsUnderflow( $datestart ) ) { return null; }
        if ( $this->IsOverflow( $datestart ) ) return null;

        $dt = $this->GetFirstDate( );

        # echo "<br> GetNextEventDate() : erster Termin ist am " . $dt->AsDMY();

        if ( ($dateisfirst == true ) && ($datestart->eq($dt)) ) { return $dt; }

        $fertig = false;

        do {
            $dt = $this->GetFollower( $dt );
            # echo "<br> GetNextEventDate() : untersuche " . $dt->AsDMY();
            if ( $datestart->eq( $dt ) && ( $dateisfirst ) ) return $dt;
            if ( $this->IsOverflow( $dt ) ) {  return null; }
            if ( $datestart->lt( $dt ) ) return $dt;
        } while ( !$fertig);

        return null;

    }   // function GetNextEventDate



/*
    function GetFollower( $date ) {

        // $dateObj muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen

        # echo "<br>GetFollower(".$date->AsDMY(). ") : GetLatestDayNumber() ergibt " . $this->GetLatestDayNumber();

        $dateObj = new cDate( $date);
        $dateObj->Skip( $this->m_days_period);
        return $dateObj;




	return GetNextEventSlot( $date, self::DIRECTION_FORWARD );


    }       // function GetFollower()

*/

    /**
      * The method GetFirstDate( ) returns the first valid date of the series to be calculated according to the specifications
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

    public function GetFirstDate( ) {

        return $this->GetValidDate( );

    }   // function GetFirstDate()

}       // of class cDateStrategySimpleInterval


?>