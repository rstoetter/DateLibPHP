<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategyDaily.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategyDaily' erweitert 'cDateStrategy' um einen täglichen Rhythmus
//  Project       : libdatephp
//  Project Site  : https://github.com/rstoetter/libdatephp
//  Project wiki  : https://github.com/rstoetter/libdatephp/wiki
//  Created by    : Rainer Stötter ( rstoetter@users.sourceforge.net )
//  Copyright (c) : 2007-2017, Rainer Stötter, All rights reserved
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  License:
//
//  This file has been released under the MIT license
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Requests]]
//
//
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
//	class cDateStrategyDaily
//		public method AsString()
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($date)
//		public method IsValid()
//		public method Reset()
//		public method __construct($str=undef)
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
?><?php

namespace libdatephp;

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategyDaily
////////////////////////////////////////////////////////////////////////////////////


/**
  *
  * The class cDateStrategyDaily calculates recurring daily events. It is specialized to find events from a specific day on, which occur daily in a certain period of time.
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

class cDateStrategyDaily extends cDateStrategy {

    // täglich ein Termin in einem bestimmten Zeitraum

    # protected $onSaturday = false;
    # protected $onSunday = false;
    # protected $onCelebrity = false;

    /**
      * The constructor of cDateStrategyDaily
      *
      *  Example:
      *
      *      $strategy = new \libdatephp\cDateStrategyDaily(
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
      *	    $strategy2 = new \libdatephp\cDateStrategyDaily( $strategy->AsString( ) );
      *
      *	    $strategy3 = new \libdatephp\cDateStrategyDaily( );
      *
      *	    $strategy4 = new \libdatephp\cDateStrategyDaily( 's8-0:0:0:0:1-(29.3.2017)-(0.0.0)' );
      *
      *
      * @example "./tst/tst-cDateStrategyDaily.php" Full Example:
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
      * @return cDateStrategyDaily
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


    /**
      * The method FromString( ) reads its specifications from the string $str
      * The template starts with 's8' and is normally made by AsString( ). The
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

        sscanf( $str, "s8-%d:%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,$this->m_directionOnImpossible,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear
            );

//        $this->m_start_date->SetDate($startmonth, $startday, $startyear );

        if ( $startday == 0 ) {
            $this->m_start_date = null;
        } else {
            $this->m_start_date = new cDate($startmonth, $startday, $startyear );
        }


        if ( $endday == 0 ) {
            $this->m_end_date = null;
        } else {
            $this->m_end_date = new cDate($endmonth, $endday, $endyear );
        }


        # echo "\n Intervall jeden Tag";
    }   // function FromString
/*
    public function SetOnSaturday( $set ) {

        $this->onSaturday = $set;

    }       // function SetOnSaturday()

    public function SetOnSunday( $set ) {

        $this->onSunday = $set;

    }       // function SetOnSunday()

    public function SetOnCelebrity( $set ) {

        $this->onCelebrity = $set;

    }       // function SetOnCelebrity()
*/

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

        if ( is_null( $this->m_end_date ) ){
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->m_end_date->Day( );
            $endmonth = $this->m_end_date->Month( );
            $endyear = $this->m_end_date->Year( );
        }

        if ( is_null( $this->m_start_date ) ){
            $startday = $startmonth = $startyear = 0;
        } else {
            $startday = $this->m_start_date->Day( );
            $startmonth = $this->m_start_date->Month( );
            $startyear = $this->m_start_date->Year( );
        }


        return sprintf( "s8-%d:%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity, $this->m_directionOnHoliday,$this->m_directionOnImpossible,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear
                 );

    }   // function AsString

    /**
      *
      * @deprecated
      *
      *
      */


    public function FromForm(  ) {

        # $_POST[strategy] = s8_dayly

        $radiostrategy = $_POST['strategy'];

        // assert ($radiostrategy == 's8_dayly');

        if ($radiostrategy == 's8_dayly') {

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
        }

    }   // function FromForm

    /**
      * The method IsValid( ) returns true, if the properties are okay and the algorithm is ready to start.
      *
      * @return bool true, if we can start to calculate dates and events
      *
      *
      */

    public function IsValid() {

	if ( ( ! is_null( $this->m_end_date ) ) && ( $this->m_end_date->lt( $this->m_start_date ) ) ) return false;

        return true;
    }

    /**
      *
      * @deprecated
      *
      *
      */


    public function FillForm( $checked = false ) {

        $msgTaeglich = $this->id2msg( 1053 );
        $msgJedenTag = $this->id2msg( 1054 );

        $check = ( $checked ) ? " checked " : "";

        // -------------- s8 => täglich
        echo "<tr><td><input type=radio name = 'strategy' value='s8_dayly' $check >$msgTaeglich</td>";
        echo "<td>$msgJedenTag";

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
      */

    // function GetFollower( $date, & $dt_next, $direction = self::DIRECTION_FORWARD ) {
    function GetNextEventSlot( $date, $direction = self::DIRECTION_FORWARD ) {

        // $obj_lauf muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen

        # echo "<br>GetFollower(".$date->AsDMY(). ") : GetLatestDayNumber() ergibt " . $this->GetLatestDayNumber();

        if ( $this->m_debug ) echo "\n GetNextEventSlot( ) starts with " . ( is_null( $date ) ? ' null ' : $date->AsSQL( ) );

        if ( is_null( $date ) ) return null;

        $date2 = new \libdatephp\cDate( $date );
        $dt_next = null;




if ( $direction == self::DIRECTION_FORWARD) {
    $date2->Inc( );
} else {
    $date2->Dec( );
}


/*
        if ( $this->AdjustedUnderOverflow( $date2, $direction ) ) {

	    if ( is_null( $date2 ) ) {
		// not adjustable

		return null;
	    }

        }
*/

	if ( ! is_int( $direction ) ) { assert( true == false ); var_dump( $direction ); die( "\n direction has the wrong type " );}

/*

	if ( $direction == self::DIRECTION_FORWARD) {

	    if ( $date2->gt( $this->m_end_date ) ) {
		if ( $this->m_debug ) echo "\n not correctable overflow";
		return null;
	    }

	    if ( $date2->lt( $this->m_start_date ) ) {
		$date2 = new cDate( $this->m_start_date );
		$date2->Dec( );
		if ( $this->m_debug ) echo "\n underflow corrected to " . $date2->AsSQL( );
	    } else {
		$date2->Inc( );
	    }


	} elseif ( $direction == self::DIRECTION_BACKWARD) {

	    if ( $date2->lt( $this->m_start_date ) ) {
		if ( $this->m_debug ) echo "\n not correctable underflow";
		return null;
	    }


	    if ( $date2->gt( $this->m_end_date ) ) {
		$date2 = new cDate( $this->m_end_date );
		$date2->Inc( );
		if ( $this->m_debug ) echo "\n overflow corrected to " . $date2->AsSQL( );
	    } else {
		$date2->Dec( );
	    }

	}
*/

        $obj_lauf = new cDate( $date2);

        $fertig = false;


        // $direction = self::DIRECTION_FORWARD;
        $weiter = false;

        if ( $this->m_debug ) echo "\n looping ..";

        do {

	    if ( $weiter ) {
		if ( $direction == self::DIRECTION_FORWARD) {
		    $obj_lauf->Inc( );
		    // $dt_next = new cDate( $obj_lauf );
		} elseif ( $direction == self::DIRECTION_BACKWARD) {
		    $obj_lauf->Dec( );
		    // $dt_next = new cDate( $obj_lauf );
		} else {
		    die( "\n unknown direction" );
		}
	    }

	    $weiter = false;

/*
            if ( $obj_lauf->IsSaturday( ) ) {
		if ( $this->m_debug ) echo "\n is a saturday : " . $obj_lauf->AsSQL( );
		if ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    // $dt_next = new cDate( $obj_lauf );
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }

            if ( $obj_lauf->IsSunday( ) ) {
		if ( $this->m_debug ) echo "\n is a sunday : " . $obj_lauf->AsSQL( );
		if ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }


            if ( $this->IsCelebrity($obj_lauf) ) {
		if ( $this->m_debug ) echo "\n is a celebrity : " . $obj_lauf->AsSQL( );
		if ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }

            if ( $this->IsHoliday($obj_lauf) ) {
		if ( $this->m_debug ) echo "\n is a holiday : " . $obj_lauf->AsSQL( );
		if ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }
*/
/*
	    if ( $direction == self::DIRECTION_FORWARD) {
		$obj_lauf->Inc( );
	    } elseif ( $direction == self::DIRECTION_BACKWARD) {
		$obj_lauf->Dec( );
	    } else {
		die( "\n unknown direction" );
	    }
*/


        } while ( $weiter );

/*
        if ($this->IsUnderflow($obj_lauf) && ( $direction == self::DIRECTION_FORWARD )) {

	    //return new \libdatephp\cDate( $this->m_start_date );
	    $obj_lauf = new \libdatephp\cDate( $this->m_start_date );
	}
        if ($this->IsOverflow($obj_lauf) && ( $direction == self::DIRECTION_FORWARD)) return null;
        if ($this->IsUnderflow($obj_lauf) && ( $direction == self::DIRECTION_BACKWARD)) return null;
        if ($this->IsOverflow($obj_lauf) && ( $direction == self::DIRECTION_BACKWARD )) {
	    // return new \libdatephp\cDate( $this->m_end_date );
	    $obj_lauf = new \libdatephp\cDate( $this->m_end_date );
	}
*/
        if ( $this->m_debug ) echo "\n GetNextEventSlot( ) returns " . $obj_lauf->AsSQL( );
// die( "\n jjj" );

	if ( is_null( $dt_next ) ) $dt_next = new cDate( $obj_lauf );

	if ( $this->m_debug ) echo "\n GetNextEventSlot( ) returns " . ( is_null( $obj_lauf ) ? 'null' : $obj_lauf->AsSQL( ) );

        return $obj_lauf;

    }       // function GetNextEventSlot( )


// NOTE : TODO : bei GetFollower IsOverflow berücksichtigen !




    /*  *
      * The method GetFollower( ) returns the next date after $date, which fits to the specifications. $date will not be taken into consideration
      *
      * @param cDate $date a cDate object, which is the starting point for the next calculation
      * @param cDate $dt_next GetFollower returns a cDate object, which is the starting point for the next calculation. ie If we are moving backwards and scheduling forward, then a correction is necessary
      * @param int $direction the constant, which indicates the search direction. It defaults to DIRECTION_FORWARD
      *
      * @return cDate cDate object with the next fitting date or null, if no fitting date could be found ( overflow, IsUnderflow)
      *
      * @see DIRECTION_BACKWARD
      * @see DIRECTION_FORWARD
      * @see GetFollower
      * @see GetFirstDate

      *
      */
/*
    function GetFollower( $date, & $dt_next, $direction = self::DIRECTION_FORWARD ) {

        // $obj_lauf muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen

        # echo "<br>GetFollower(".$date->AsDMY(). ") : GetLatestDayNumber() ergibt " . $this->GetLatestDayNumber();

        if ( $this->m_debug ) echo "\n GetFollower( ) starts with " . ( is_null( $date ) ? ' null ' : $date->AsSQL( ) );

        if ( is_null( $date ) ) return null;

        $date2 = new \libdatephp\cDate( $date );
        $dt_next = null;


	if ( ! is_int( $direction ) ) { assert( true == false ); var_dump( $direction ); die( "\n direction has the wrong type " );}

	if ( $direction == self::DIRECTION_FORWARD) {

	    if ( $date2->gt( $this->m_end_date ) ) {
		if ( $this->m_debug ) echo "\n not correctable overflow";
		return null;
	    }

	    if ( $date2->lt( $this->m_start_date ) ) {
		$date2 = new cDate( $this->m_start_date );
		$date2->Dec( );
		if ( $this->m_debug ) echo "\n underflow corrected to " . $date2->AsSQL( );
	    } else {
		$date2->Inc( );
	    }


	} elseif ( $direction == self::DIRECTION_BACKWARD) {

	    if ( $date2->lt( $this->m_start_date ) ) {
		if ( $this->m_debug ) echo "\n not correctable underflow";
		return null;
	    }


	    if ( $date2->gt( $this->m_end_date ) ) {
		$date2 = new cDate( $this->m_end_date );
		$date2->Inc( );
		if ( $this->m_debug ) echo "\n overflow corrected to " . $date2->AsSQL( );
	    } else {
		$date2->Dec( );
	    }

	}


        $obj_lauf = new cDate( $date2);
        $fertig = false;

        // $direction = self::DIRECTION_FORWARD;
        $weiter = false;

        if ( $this->m_debug ) echo "\n looping ..";

        do {

	    if ( $weiter ) {
		if ( $direction == self::DIRECTION_FORWARD) {
		    $obj_lauf->Inc( );
		    // $dt_next = new cDate( $obj_lauf );
		} elseif ( $direction == self::DIRECTION_BACKWARD) {
		    $obj_lauf->Dec( );
		    // $dt_next = new cDate( $obj_lauf );
		} else {
		    die( "\n unknown direction" );
		}
	    }

	    $weiter = false;


            if ( $obj_lauf->IsSaturday( ) ) {
		if ( $this->m_debug ) echo "\n is a saturday : " . $obj_lauf->AsSQL( );
		if ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    // $dt_next = new cDate( $obj_lauf );
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }

            if ( $obj_lauf->IsSunday( ) ) {
		if ( $this->m_debug ) echo "\n is a sunday : " . $obj_lauf->AsSQL( );
		if ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }


            if ( $this->IsCelebrity($obj_lauf) ) {
		if ( $this->m_debug ) echo "\n is a celebrity : " . $obj_lauf->AsSQL( );
		if ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }

            if ( $this->IsHoliday($obj_lauf) ) {
		if ( $this->m_debug ) echo "\n is a holiday : " . $obj_lauf->AsSQL( );
		if ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $obj_lauf );
		    $obj_lauf = $this->MoveDateIfNecessary( $obj_lauf );
		    if ( is_null( $obj_lauf ) ) return null;
		} elseif ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }


        } while ( $weiter );

        if ($this->IsUnderflow($obj_lauf) && ( $direction == self::DIRECTION_FORWARD )) {

	    //return new \libdatephp\cDate( $this->m_start_date );
	    $obj_lauf = new \libdatephp\cDate( $this->m_start_date );
	}
        if ($this->IsOverflow($obj_lauf) && ( $direction == self::DIRECTION_FORWARD)) return null;
        if ($this->IsUnderflow($obj_lauf) && ( $direction == self::DIRECTION_BACKWARD)) return null;
        if ($this->IsOverflow($obj_lauf) && ( $direction == self::DIRECTION_BACKWARD )) {
	    // return new \libdatephp\cDate( $this->m_end_date );
	    $obj_lauf = new \libdatephp\cDate( $this->m_end_date );
	}

        if ( $this->m_debug ) echo "\n GetFollower( ) returns " . $obj_lauf->AsSQL( );
// die( "\n jjj" );

	if ( is_null( $dt_next ) ) $dt_next = new cDate( $obj_lauf );

	if ( $this->m_debug ) echo "\n GetFollower( ) returns " . ( is_null( $obj_lauf ) ? 'null' : $obj_lauf->AsSQL( ) );

        return $obj_lauf;

    }       // function GetFollower()

*/



    /**
      * The method GetFirstDate( ) returns the first valid date of the series to be calculated according to the specifications
      *
      * It returns now the start date for the period of time which is examined.
      *
      * @return cDate a cDate object with the first fitting date or null, if no fitting date could be found ( overflow, IsUnderflow)
      *
      * @see GetFollower
      * @see GetFirstDate
      *
      *
      */


    public function GetFirstDate( ) {
        return $this->m_start_date;
    }   // function GetFirstDate()

}       // of class cDateStrategyDaily

?>