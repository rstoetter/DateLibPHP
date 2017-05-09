<?php

namespace libdatephp;

/**
  *
  * Objects of the class cDateISO represent single dates represnted by ISO 8601 week numbers.
  *
  * The ISO week date system is effectively a leap week calendar system that is part of the ISO 8601 date and time
  * standard issued by the International Organization for Standardization (ISO) since 1988 (last revised in 2004)
  * and, before that, it was defined in ISO (R) 2015 since 1971. It is used (mainly) in government and business for
  * fiscal years, as well as in timekeeping. This was previously known as "Industrial date coding". The system
  * specifies a week year atop the Gregorian calendar by defining a notation for ordinal weeks of the year.
  *
  * ISO 8601

  * Der Kalender ordnet Zeiträume, indem er Tage zu Wochen, Wochen zu Monaten und Monaten zu Jahren zusammenfasst.
  * Für die Darstellung von Datum und Uhrzeit ist die internationale Norm ISO 8601 zuständig. Diese Regeln hält die
  * deutschsprachige Kalender Industrie ohne Ausnahme ein. So beginnt seit 1976 jede Woche mit Montag und endet mit
  * dem Sonntag. In anderen Ländern, wie zum Beispiel den USA, Mexiko, Australien und Kanada, fangen die Wochen mit
  * dem Sonntag als ersten Wochentag an und endet mit dem Samstag. Weitere wichtige Regeln der ISO 8601 in Bezug
  * auf die Kalenderwoche:
  *
  *  Eine neue Kalenderwoche (kurz KW) beginnt immer am Montag.
  *  Unvollständige Kalenderwochen gibt es nicht, jede Woche hat exakt sieben Tage.
  *  Mit den ersten vier Tagen des neuen Jahres, beginnt die erste Kalenderwoche.
  *  Der vierte Januar liegt immer in der ersten Kalenderwoche.

  * @author Rainer Stötter
  * @copyright 2010-2017 Rainer Stötter
  * @license MIT
  * @version =1.0.1
  *
  */

class cDateISO extends cDate {

    /**
      * The version of the class
      *
      * @var string $version
      *
      *
      */

      public $version = '1.0.1';


    /**
      * The number of the day of week of sunday in ISO 8601 notation.
      *
      * ISO days are one-based ( start with 1 ) and start with the monday
      *
      * @var int
      *
      * @see ISO_SUNDAY
      * @see ISO_MONDAY
      * @see ISO_TUESDAY
      * @see ISO_FRIDAY
      * @see ISO_SATURDAY
      *
      */

    const ISO_SUNDAY = 7;

    /**
      * The number of the day of week of monday in ISO 8601 notation.
      *
      * ISO days are one-based ( start with 1 ) and start with the monday
      *
      * @var int
      *
      * @see ISO_SUNDAY
      * @see ISO_MONDAY
      * @see ISO_TUESDAY
      * @see ISO_FRIDAY
      * @see ISO_SATURDAY
      *
      */

    const ISO_MONDAY = 1;

    /**
      * The number of the day of week of tuesday in ISO 8601 notation.
      *
      * ISO days are one-based ( start with 1 ) and start with the monday
      *
      * @var int
      *
      * @see ISO_SUNDAY
      * @see ISO_MONDAY
      * @see ISO_TUESDAY
      * @see ISO_FRIDAY
      * @see ISO_SATURDAY
      *
      */

    const ISO_TUESDAY = 2;

    /**
      * The number of the day of week of wednesday in ISO 8601 notation.
      *
      * ISO days are one-based ( start with 1 ) and start with the monday
      *
      * @var int
      *
      * @see ISO_SUNDAY
      * @see ISO_MONDAY
      * @see ISO_TUESDAY
      * @see ISO_FRIDAY
      * @see ISO_SATURDAY
      *
      */

    const ISO_WEDNESDAY = 3;

    /**
      * The number of the day of week of thursday in ISO 8601 notation.
      *
      * ISO days are one-based ( start with 1 ) and start with the monday
      *
      * @var int
      *
      * @see ISO_SUNDAY
      * @see ISO_MONDAY
      * @see ISO_TUESDAY
      * @see ISO_FRIDAY
      * @see ISO_SATURDAY
      *
      */

    const ISO_THURSDAY = 4;

    /**
      * The number of the day of week of friday in ISO 8601 notation.
      *
      * ISO days are one-based ( start with 1 ) and start with the monday
      *
      * @var int
      *
      * @see ISO_SUNDAY
      * @see ISO_MONDAY
      * @see ISO_TUESDAY
      * @see ISO_FRIDAY
      * @see ISO_SATURDAY
      *
      */

    const ISO_FRIDAY = 5;

    /**
      * The number of the day of week of saturday in ISO 8601 notation.
      *
      * ISO days are one-based ( start with 1 ) and start with the monday
      *
      * @var int
      *
      * @see ISO_SUNDAY
      * @see ISO_MONDAY
      * @see ISO_TUESDAY
      * @see ISO_FRIDAY
      * @see ISO_SATURDAY
      *
      */


    const ISO_SATURDAY = 6;

    /**
      *
      * $m_iso_weeks and $m_iso_weeks_leap consist of 12 numbers representing the weeks of the months
      *
      * * The January is the first element of the array with index 0
      *
      * ```
      * ```
      *
      * @var array $m_iso_weeks 12 numbers representing the weeks of the months of a year which is no leap year, which starts on thursday
      *
      * @see $m_iso_weeks
      * @see $m_iso_weeks_leap
      *
      * @since = 1.0.1
      *
      */

    static protected $m_iso_weeks = array( 4,4,5,4,5,4,4,5,4,4,5,4 );

    /**
      *
      * $m_iso_weeks and $m_iso_weeks_leap consist of 12 numbers representing the weeks of the months
      *
      * The January is the first element of the array with index 0
      *
      * ```
      * ```
      *
      * @var array $m_iso_weeks_leap 12 numbers representing the weeks of the months of a year which is a leap year, which starts on thursday
      *
      * @see $m_iso_weeks
      * @see $m_iso_weeks_leap
      *
      * @since = 1.0.1
      *
      */

    static protected $m_iso_weeks_leap = array( 4,5,5,4,5,4,4,5,4,4,5,4 );

    /**
      *
      * tabular data for iso renumbering to calculate ordinal dates for non leap years
      *
      * https://en.wikipedia.org/wiki/Ordinal_date
      * https://en.wikipedia.org/wiki/ISO_week_date
      *
      * @var array $m_a_iso_numbers_norm
      *
      * @see $m_a_iso_numbers_leap
      * @see $m_a_iso_numbers_norm
      *
      * @since = 1.0.1
      *
      */

	static $m_a_iso_numbers_norm = array( 0 ,31 ,59 ,90 ,120 ,151 ,181 ,212 ,243 ,273 ,304 ,334 );

    /**
      *
      * tabular data for iso renumbering to calculate ordinal dates for leap years
      *
      * https://en.wikipedia.org/wiki/Ordinal_date
      * https://en.wikipedia.org/wiki/ISO_week_date
      *
      * @var array $m_a_iso_numbers_leap
      *
      * @see $m_a_iso_numbers_leap
      * @see $m_a_iso_numbers_norm
      *
      * @since = 1.0.1
      *
      */


	static $m_a_iso_numbers_leap = array( 0 ,31 ,60 ,91 ,121 ,152 ,182 ,213 ,244 ,274 ,305 ,335 );



    ///////////////////////////////////////////////////////////////////////////

    /**
      *
      *  The constructor for the cDateISO class
      *
      *  Example:
      *
      *  $p = new cDateISO( 11, 22, 2016, 11, 23, 2016 );
      *  from month, day, year
      *
      *  $p = new cDateISO( '2017-02-28' );
      *  from SQL string
      *
      *  $p = new cDateISO( '28.02.2017' );
      *  from DMY string
      *
      *  $p = new cDateISO( '02-28-2017' );
      *  from MDY string
      *
      *  $p = new cDateISO(  );
      *  a date with today's date
      *
      *  $dtm = new cDateISO( new cDateISO( 11, 22, 2016 ) );
      *  a copy constructor
      *
     *
      *  $dtm = new cPeriod( 20516 );
      *  from a timestamp
      *
      *
      * @param mixed $m can be an int as month or a timestamp or a cDateISO
      * @param mixed $d can be a date or an int as day or a cDateISO
      * @param int $y the year of the first date
      *
      * @return cDateISO
      */

    public function __construct( $m = -1, $d = -1, $y = -1) {

	if ( is_a( $m, 'libdatephp\cDateISO' ) ) {

	    $this->FromDate( $m );

	}  else {

	    parent::__construct( $m , $d , $y );

	}


    }  // __construct( )



    /**
      *
      * FirstWeekOfYear( ) returns the date to the first monday of the actual year.
      *
      * The first week does not start on the 1-st January of the year but on the first monday.
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
      * @return cDateISO the date of the first week of the actual year
      *
      * @see FirstWeekOfMonthISO
      * @see LastWeekOfMonthISO

      *
      * @since = 1.0.1
      *
      */
/*
    public function FirstWeekOfYear( ) {

	// beginnt nicht am Ersten, sondern am ersten Montag!

//     Gemäß Normen der ISO, DIN, ÖNORM und SN: jene Woche, die den ersten Donnerstag des Jahres enthält (ISO 8601, früher DIN 1355-1). Äquivalent sind folgende Definitionen (da ISO 8601 den Montag als ersten Tag der Woche definiert):
//
//     jene Woche, die den 4. Januar enthält
//     jene Woche, die den 1. Januar enthält, falls dieser ein Montag, Dienstag, Mittwoch oder Donnerstag ist, sonst die darauf folgende Woche
//     die erste Woche, von der mehr Tage (mindestens vier) auf das neue Jahr fallen als auf das alte Jahr



	$dt = new cDate( $this );

	$dt = $dt->FirstWeekOfMonthISO( );

	echo "\n FirstWeekOfYearISO: " . $dt->AsSQL( );

	$dt = $dt->FirstMondayOfJanuaryISO( $dt->Year( ) );

	echo "\n FirstWeekOfYearISO: ->" . $dt->AsSQL( );

	return $dt;

/*
	$dt = $this->FirstMondayOfJanuaryISO( );
// 	$dt->AddWeeks( 1 );	// weil die erste Woche schon zum Vormonat gehören kann


	return $dt->FirstWeekOfMonthISO( );
* /
    }  // function FirstWeekOfYearISO( )
*/


    /**
      *
      * FirstMondayOfJanuary( ) returns the date to the first monday of the year $year
      *
      * The first week of the year does not start on the 1-st January but on the first monday.
      *
      * ```
      * ```
      *
      * @param int $year the year $year
      *
      * @return cDateISO the date of the first monday of the Year $year
      *
      * @see FirstWeekOfMonthISO
      * @see FirstMondayOfJanuaryISO
      * @see LastWeekOfMonthISO
      * @see LastSundayOfMonthISO
      *
      * @since = 1.0.1
      *
      */


    public function FirstMondayOfJanuary( $year ) {


	$dt = new cDateISO( 1, 1, $year );

	$year = $dt->Year( );

 	$dow = $dt->DOW( false );

	if        ( ( $dow == self::DOW_MONDAY ) ||
		    ( $dow == self::DOW_TUESDAY ) ||
		    ( $dow == self::DOW_WEDNESDAY ) ||
		    ( $dow == self::DOW_THURSDAY )
		    )  {

	      $dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_BACKWARDS );


	}  else  {

	    $dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_FORWARD );
	}

	return $dt;

    }	// function FirstMondayOfJanuaryISO( )


    /**
      *
      * LastSundayOfYearISO( ) returns the date to the last sunday of the year $year
      *
      * The last week of the year year does not end on the 31-th December but on the last sunday.
      *
      * ```
      * ```
      *
      * @param int $year the year $year
      *
      * @return cDateISO the date of the last sunday of the Year $year
      *
      * @see FirstWeekOfMonthISO
      * @see FirstMondayOfJanuaryISO
      * @see LastWeekOfMonthISO
      * @see LastSundayOfMonthISO
      *
      * @since = 1.0.1
      *
      */

    public function LastSundayOfYear( $year ) {

	$last_day = new cDateISO( 5, 15, $year + 1  );

	$last_day = $last_day->FirstMondayOfJanuary( $last_day->Year( ) );

	$last_day->Dec( );

	assert( $last_day->IsSunday( ) );

	return $last_day;

    }	// function LastSundayOfYearISO( )





    /**
      *
      * IsLeapThursday( ) returns true, if the actual year is a leap year and the year starts on a thursday
      *
      * ```
      * ```
      *
      * @return boolean true, if the actual year is a leap year and the year starts on a thursday
      *
      * @since = 1.0.1
      *
      */

private function IsLeapThursday( ) {


    if ( $this->IsLeapYear( ) ) {

	return $this->BOY( )->Weekday( ) == self::DOW_THURSDAY;

    }

    return false;

}


    /**
      *
      * FirstWeekOfMonthISO2( ) returns the date of the first monday of the month $month in the year $year
      *
      * The first week does not start on the 1-st of the month but on the first monday.
      *
      * ```
      *
      * @param int $month the month
      * @param int $year the year
      *
      * @return cDateISO the date of the first week of the given month
      *
      * @see FirstWeekOfMonthISO
      * @see LastWeekOfMonthISO

      *
      * @since = 1.0.1
      *
      */



    protected function FirstWeekOfMonthISO2( $month, $year ) {

	// beginnt nicht am Ersten, sondern am ersten Montag!

 	$dt = new cDateISO( $month, 1, $year );

/*
    Gemäß Normen der ISO, DIN, ÖNORM und SN: jene Woche, die den ersten Donnerstag des Jahres enthält (ISO 8601,
    früher DIN 1355-1). Äquivalent sind folgende Definitionen (da ISO 8601 den Montag als ersten Tag der Woche
    definiert):

    jene Woche, die den 4. Januar enthält
    jene Woche, die den 1. Januar enthält, falls dieser ein Montag, Dienstag, Mittwoch oder Donnerstag ist, sonst die
    darauf folgende Woche
    die erste Woche, von der mehr Tage (mindestens vier) auf das neue Jahr fallen als auf das alte Jahr

*/
/*
 	if ( $dt->InJanuary( )  ) {

	    $tmp = $this->FirstMondayOfJanuaryISO( );
	    echo "\n first monday on " . $tmp->AsSQL( );

	    if ( $tmp->gt( $this )  ) {
		// Falls der Monat erst nach unserem Referenzdatum beginnt, dann
		// gehört das Referenzdatum noch zum Vorjahr
		$tmp->Dec( );		// setze auf Vorjahr
		$tmp->SeekWeekday( self::DOW_MONDAY, self::SEEK_BACKWARDS ); // und suche den Wochenstart auf
		echo "\n corrected";
		$tmp = $tmp->FirstWeekOfMonthISO2( $tmp->m_month, $tmp->m_year );

	    }

	    return $tmp;


	}
*/

	if ( $dt->DOW( false ) == self::DOW_MONDAY ) return $dt;

	$dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_FORWARD ); // und suche den nächsten Wochenstart auf

	return $dt;

    }	// function FirstWeekOfMonthISO2( )


    /**
      *
      * FirstWeekOfMonth( ) returns the date to the first monday of a month.
      *
      * If $month and $year are null, then the actual month will be taken
      *
      * The first week does not start on the 1-st of the month but on the first monday.
      *
      * without $month and $year:
      * The month the date belongs to according to ISO will be taken as month.
      * ie: If the third January is the date and the month begins according to ISO with the firth January, Then
      * if $strict is false, then the January will be taken as month and the first monday of January will be
      * returned. But if $strict is true, then the first monday of December will be returned.
      *
      * ```
      * $dt = new \libdatephp\cDate( 4, 1, 2017 );
      * for ( $i = 0; $i < 5; $i++ ) {
      *   $dt = new \libdatephp\cDate( 5, 18, 2017 );
      *   $dt->GoWOM( $i + 1 );
      *   echo "\n The week " . ( $i + 1 ) . " starts with " . $dt->AsSQL( ) . '. The month has ' . $dt->WeeksOfMonth( ) . ' weeks';
      * }
      * ```
      *
      * @param int $month the month to use. Defaults to null. If $month and $year are null, then the actual month and year will be taken
      * @param int $year the year to use. Defaults to null. If $month and $year are null, then the actual month and year will be taken
      *
      * @return cDateISO the date of the first week of the month
      *
      * @see FirstWeekOfMonth
      * @see LastWeekOfMonth

      *
      * @since = 1.0.1
      *
      */


    public function FirstWeekOfMonth( $month = null, $year = null ) {

      if ( is_int( $month ) ) {
	  if ( $month > 12 || $month < 1 ) {
	      assert( false == true );
	      die( "\n WeeksOfMonth : month == $month year = $year" );
	  }
      }

      if ( ! is_null( $month ) ) return $this->FirstWeekOfMonthISO2( $month, $year );


      $strict = true;

	// beginnt nicht am Ersten, sondern am ersten Montag!

	$dt = new cDateISO( $this );
	// echo "\n FirstWeekOfMonthISO( ) mit " . $this->AsSQL( ) . ' und month = ' . $dt->month();


/*
    Gemäß Normen der ISO, DIN, ÖNORM und SN: jene Woche, die den ersten Donnerstag des Jahres enthält (ISO 8601,
    früher DIN 1355-1). Äquivalent sind folgende Definitionen (da ISO 8601 den Montag als ersten Tag der Woche
    definiert):

    jene Woche, die den 4. Januar enthält
    jene Woche, die den 1. Januar enthält, falls dieser ein Montag, Dienstag, Mittwoch oder Donnerstag ist, sonst die
    darauf folgende Woche
    die erste Woche, von der mehr Tage (mindestens vier) auf das neue Jahr fallen als auf das alte Jahr

*/

    $tmp = $this->FirstWeekOfMonthISO2( $this->Month( ), $this->Year( ) );
    if ( $tmp->gt( $this ) ) {
	$tmp->Dec( );

	$tmp->SeekWeekday( self::DOW_MONDAY, self::SEEK_BACKWARDS ); // und suche den Wochenstart auf

	return( $tmp->FirstWeekOfMonthISO2( $tmp->Month( ), $tmp->Year( ) ) );
    }

    return $tmp;



/*
	$first_monday = $this->FirstMondayOfJanuaryISO( );

	$first_sunday = new cDate( $first_monday ) ;
	$first_sunday->SeekWeekday( self::DOW_SUNDAY, self::SEEK_FORWARD );

	$last_sunday = $first_monday->LastSundayOfYearISO( );

	echo "\n first monday = "  . $first_monday->AsSQL( ) ;
	echo "\n first sunday = "  . $first_sunday->AsSQL( ) ;
	echo "\n last sunday = "  . $last_sunday->AsSQL( ) ;
*/
 	if ( $dt->InJanuary( )  ) {

	    $tmp = $this->FirstMondayOfJanuary( $tmp->Year( ) );


	    if ( $tmp->gt( $dt )  ) {
		// Falls der Monat erst nach unserem Referenzdatum beginnt, dann
		// gehört das Referenzdatum noch zum Vorjahr
		$tmp->Dec( );		// setze auf Vorjahr
		$tmp->SeekWeekday( self::DOW_MONDAY, self::SEEK_BACKWARDS ); // und suche den Wochenstart auf
	    }

	    return $tmp;


	}

	// liegt nicht im Januar

	$dt->SetDate( $dt->Month( ), 1, $dt->Year( ) );

	$dow = $dt->DOW( false );

	if ( ( $dow == self::DOW_MONDAY ) ) {
	    return $dt;
	}

	$dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_FORWARD ); // und suche den Wochenstart auf

	return $dt;

/*

	$wom = $dt->WOM( );
	$dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_BACKWARDS ); // und suche den Wochenstart auf
echo "\n wom = $wom ";
	$dt->Skip( ( - 7 * ( $wom - 1  ) ) + 1  )  ;

	return $dt;

*/





	    $year = $dt->Year( );

	    $dt->SetDate( $dt->Month( ), 1, $dt->Year( ) );


	    if ( $strict ) {

/*
Gemäß Normen der ISO, DIN, ÖNORM und SN: jene Woche, die den ersten Donnerstag des Jahres enthält (ISO 8601, früher DIN 1355-1). Äquivalent sind folgende Definitionen (da ISO 8601 den Montag als ersten Tag der Woche definiert):
    jene Woche, die den 4. Januar enthält
    jene Woche, die den 1. Januar enthält, falls dieser ein Montag, Dienstag, Mittwoch oder Donnerstag ist, sonst die
    darauf folgende Woche
    die erste Woche, von der mehr Tage (mindestens vier) auf das neue Jahr fallen als auf das alte Jahr

*/

	      // echo "\n normal month";


		$year = $dt->Year( );

		$dt->SetDate( $dt->Month( ), 1, $dt->Year( ) );

		if        ( ( $dt->DOW( false ) == self::DOW_MONDAY ) ||
			    ( $dt->DOW( false ) == self::DOW_TUESDAY ) ||
			    ( $dt->DOW( false ) == self::DOW_WEDNESDAY ) )  {

		     $dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_BACKWARDS );


		}  else  {

		    $dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_FORWARD );

		}

		return $dt;

	      }



	return $dt;

    }  // function FirstWeekOfMonthISO( )


    /**
      *
      * The method BelongsToMonth( ) sets $year and $month according to the year and month the date belongs
      *
      *
      *
      * ```
      * ```
      *
      * @param int $month the month the date belongs to
      * @param int $year the year the date belongs to
      *
      * @since = 1.0.1
      *
      */


      public function BelongsToMonth( & $month, & $year ) {

	  $year = $this->m_year;
	  $month = $this->m_month;

	  $dt = new cDateISO( );

	  $dt = $this->FirstWeekOfMonth( $this->Month( ), $this->Year( ) );

	  // echo "\n BelongsToMonth is on " . $this->AsSQL( ) . " and starts with " . $dt->AsSQL( );

	  if ( $dt->gt( $this ) ) {

	      $month--;

	      if ( $month < 1 ) {
		  $month = 12;
		  $year--;
	      }

	  }

      }	// function BelongsToMonth( )


    /**
      *
      * LastWeekOfMonth( ) returns the date to the last monday of the actual month.
      *
      * The last week does not end on th 31-th etc. but on the last Sunday .
      *
      * ```
      * ```
      *
      * @return cDateISO the date of the first week of the actual month
      *
      * @see FirstWeekOfMonthISO
      * @see LastWeekOfMonthISO      *
      * @since = 1.0.1
      *
      */


    public function LastWeekOfMonth( ) {

	// TODO: rechnerisch lösen!

	$dt = new cDateISO( $this );

	$dt = $this->FirstWeekOfMonth( );

	$dt->Skip( $dt->LOM( ) );

	$dt->SetDate( $dt->Month( ), 1, $dt->Year( ) );

	if ( ( $dt->DOW( false ) == self::DOW_THURSDAY )  )
	    {
	    $dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_BACKWARDS );
	} elseif ( $dt->DOW( false )  == self::DOW_MONDAY ) {
	    $dt->Dec();
	    $dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_BACKWARDS );

	} elseif (
	      ( $dt->DOW( false ) == self::DOW_WEDNESDAY ) ||
	      ( $dt->DOW( false ) == self::DOW_FRIDAY ) ||
	      ( $dt->DOW( false ) == self::DOW_SATURDAY ) ||
	      ( $dt->DOW( false ) == self::DOW_SUNDAY ) ||
	      ( $dt->DOW( false ) == self::DOW_TUESDAY ) ) {
	    $dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_BACKWARDS );
	} else {
	    // $dt->SeekWeekday( self::DOW_MONDAY, self::SEEK_BACKWARDS );
	    assert( true == false );
	    die( "\n weekday " . $dt->DOW( false ) . ' not supported for ' . $dt->AsSQL( ) );
	}

	if( $dt->DOW( false ) != self::DOW_MONDAY ) {
	    die( "\n error 2 in LastWeekOfMonthISO " );
	}

	 // echo "\n LastWeekOfMonth liefert " . $dt->AsSQL( );

	return $dt;

    }  // function LastWeekOfMonth( )

    /**
      *
      * GoWOY( ) sets the internal date to the date, which is defined by the ISO week $woy, the year $year and
      * the ISO weekday $dow.
      *
      * Example:
      *
      * ```
      * ```
      *
      * @param int $woy the ISO week number for the week in the year
      * @param int $year the year to use. If it is null, then the year part of the internal date will be used. Defaults to null.
      * @param int $dow the ISO day of week number for the weekday to position the date on. If it is null, then the ISO_MONDAY will be used. Defaults to null.
      *
      * @see WOY
      *
      * @since = 1.0.1
      *
      */


    public function GoWOY( $woy, $year = null, $dow = null ) {

	if ( is_null( $year ) ) $year = $this->Year( );
	if ( is_null( $dow ) ) $dow = self::ISO_MONDAY;

	assert( $woy > 0 );
	assert( $woy < 54 );

	$dt = new cDateISO( 1, 4, $year );

	if ( $dt->IsLeapYear( ) ) {
	    $ptr =  & self::$m_a_iso_numbers_leap;
	} else {

	    $ptr = & self::$m_a_iso_numbers_norm;
	}


	/* the log way
	$correction = $dt->DOW( true ) + 3;
	$sum = ( $woy * 7 ) + $dow;
	$ordinal_date = $sum - $correction;
	*/

	// calculate the ordinal date

	$ordinal_date = $woy * 7 + $dow - ( $dt->DOW( true )  + 3 ) ;

	if ( $ordinal_date < 1 ) {

	    // belongs to previous year
	    $tmp = new cDateISO( $dt );
	    $tmp->GoBOY( );
	    $tmp->AddYears( -1 );
	    $ordinal_date = $ordinal_date + $tmp->LOY( );
	    $year--;
	} elseif ( $ordinal_date > $dt->LOY( ) ) {

	    // belongs to the following year
	    $year++;
	    $ordinal_date = $ordinal_date - $dt->LOY( );
	}

	// look up the day and the month

	/*

	$found = false;
	for ( $i = 0; $i < count( $ptr ) - 1; $i++ ) {

	    echo "\n $i ordinal_date = $ordinal_date und ptr = " . $ptr[ $i ] ;
	    if ( $ptr[ $i ] > $ordinal_date )  {
		$i--;
		$found = true;
		break;
	    }

	}
	*/

	$i = 11;
	do {
	    // echo "\n $i ordinal_date = $ordinal_date und ptr = " . $ptr[ $i ] ;
	    if ( $ptr[ $i ] >= $ordinal_date ) {
		$i--;
	    } else {
		break;
	    }
	} while( true );

	$ordinal_diff = $ptr[ $i ];

	$day = $ordinal_date - $ordinal_diff ;

	$month = $i + 1;


	// echo "\n i = $i ordinal_diff = $ordinal_diff ordinal_date = $ordinal_date day = $day month = $month";

	$this->SetDate( $month, $day, $year );

	assert( $this->WOY( true ) == $woy );	// TODO Prüfung entfernen
	assert( $this->DOW( ) == $dow );



// TODO	nixcht vergessen: Overflow und Underflow berücksichtigen!

    }	// function GoWOY( )

    /**
      *
      * GoWOM() sets the date to the monday of the $w-th week in the actual month and searches then the first day of week $wd
      *
      * week numbers are one-based and start with 1. The first week in the year has the number 1
      *
      * If it is the first or last week of a month or year, then you often will encounter split weeks, where some weekdays are missing.
      * In this case GoWOM( ) positions on the monday of this week and will not move into the next month or year. It will output a warning message, too.
      * You can check for split weeks before with MaxWeekday( ).
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
      * @param int $w the week number to set
      * @param int $wd the day of week to search. Defaults to DOW_MONDAY
      *
      * @see MaxWeekday
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


    public function GoWOM ( $w, $wd = self::DOW_MONDAY )
    {


	// echo "\n GoWOM: wom mit Woche = $w und weekday = $wd für " . $this->AsSQL( );

	// echo "\n GoWOM( ) in Woche $w mit wd gesucht = $wd Ausgangsdatum = " . $this->AsSQL( );

	if ( $w < 1 || $w > 5 ) {
	    assert( false == true );
	    die( "\n week number not allowed : GoWOM( $w, $wd )" );
	}

	if ( $wd < self::DOW_SUNDAY || $wd > self::DOW_SATURDAY ) {
	    assert( false == true );
	    die( "\n week day number not allowed : GoWOM( $w, $wd )" );
	}


	$tmp = new cDate( $this );

	$this ->SetDate( $this->FirstWeekOfMonth( ) );

	// echo "\n .. positioned on first week = " . $this->AsSQL( );

//	$this->SeekWeekday( $wd, self::SEEK_FORWARD );


	assert( $w <= $this->WeeksOfMonth( ) );
	if ( $w > $this->WeeksOfMonth( ) ) {
	    assert( false == true );
	    die( "\n Error: GoWOM: The Month starting on " . $this->AsSQL( ) . " has not $w weeks but in reality " . $this->WeeksOfMonth( ) );
	}

	// echo "\n GoWOM( ) first monday = " . $this->AsSQL( );

	$d = ( 7 * ( $w - 1 ) )  ;

	$secs = $d * 60 * 60 * 24;

	$this->m_timestamp += $secs;

	// echo "\n w = $w -> d = $d";

        $this->ts2mdy ( );
        $this->CalculateWeekday( );

//         echo "\n .. positioned on date " . $this->AsSQL( );

	$this->SeekWeekday( $wd, self::SEEK_FORWARD );

	// echo "\n .. positioned on wd $wd = " . $this->AsSQL( );

        if ( $this->m_dow != $wd )
	if ( ( $this->MaxWeekday( ) != 0 ) && ( $this->MaxWeekday( ) < $wd ) ) {
	    die( "\n Error in GoWOM( ) : cannot reach weekday target: $wd max weekday is " . $this->MaxWeekday( ) );
	} else {

	    $this->SeekWeekday( $wd, self::SEEK_FORWARD );
	}

        if ( $this->WOM( ) != $w ) {
	    assert( false == true );
	    die( "\n Fehler: GoWOM:  " . $tmp->AsSQL() . "->GoWOM( " . $w . ", " . $wd . ") lieferte " . $this->AsSQL( ) . ' != ' . $this->WOM( ));
	}



    }  //  function GoWOM ( )

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


    public function WOM( ) {
    //
    // Number of Week of month
    //


	$this->BelongsToMonth( $month, $year );

	// echo "\n " . $this->AsSQL( ) . " belongs to month $year/$month";

        $week0 = $this->FirstWeekOfMonth( )->NOW( );
        $week1 = $this->NOW( );

	$tmp = $this->FirstWeekOfMonth( );

        if ( $week0 > $week1 ) {

	    $week0 = 1;	// erste Woche des Jahres kann die Wochennummer vom letzten Jahr liefern
	}

	$wom = $week1 - $week0 + 1;

// 	echo "\n wom = $week1 - $week0 + 1 = " . ( $week1 - $week0 + 1 );

	if ( $wom < 1 || $wom > 5 ) {
	    assert( true == false );
	    die( "\n wom( ) liefert falsches $wom" );
	}

	return ( $wom ) ;
        // return ( $week1 - $week0 ) + 1;


    }   // public function WOM( )


    /**
      *
      * FromMonthYear( ) constructs and returns a new cDateISO obejct which is on the first day ( monday ) of the month $month in year $year
      *
      * Example:
      *
      * ```
      * ```
      *
      * @param int $month the month to use
      * @param int $year the year to use
      *
      * @return cDateISO the constructed date object
      *
      *
      * @since = 1.0
      *
      */


    public function FromMonthYear( $month, $year ) {

	// TODO: FirstWeekOfMonth() einarbeiten, um die Funktion static zu machen

	$first = new cDateISO( $month, 15, $year );
	// $first->BelongsToMonth( $month, $year );
	$first = $first->FirstWeekOfMonth( $month , $year );

	return $first;

    }	// function FromMonthYear( )

    /**
      *
      * WeeksOfMonth( ) returns the number of full ISO weeks in the month the date belongs to
      *
      * The date must not belong to the Gregorian month!
      *
      * Example:
      *
      * ```
      * ```
      *
      * @return int the week count
      *
      * @since = 1.0
      *
      */

    public function WeeksOfMonth( ) {
    //
    // Number of Weeks in the actual month - one-based and starting on first monday of the month
    //
    //  NOTE : ISO-8601 Wochennummer des Jahres, die erste Woche beginnt am ersten Montag
    // TODO: WeeksInQuarter( )

    // http://www.kalender-uhrzeit.de/kalenderwochen-2017

    $d1 = $this->FirstWeekOfMonth( );
    $d2 = $this->LastSundayOfMonth( );

    $diff = $d2->AsTimeStamp( ) - $d1->AsTimeStamp( );

    $weeks2 = ( $diff / ( 24 * 60 * 60 ) ) / 7;

     // echo "\n Monat geht von " . $d1->AsSQL( ) . ' bis ' . $d2->AsSQL( ) . " und hat $weeks2 Wochen";

    return ceil( $weeks2 );

/*

	$dt = $this->FirstWeekOfMonthISO( );

	echo "\n WeeksOfMonth : first week starts on " . $dt->AsSQL( ) . ' for date ' . $this->AsSQL( );

	$week0 = $dt->NOW( true );
	$years0 = $dt->WeeksOfYear( $dt->Year( ) );

	$dt = $this->LastSundayOfMonthISO( );
	echo "\n WeeksOfMonth : last sunday = " . $dt->Assql();

	$week1 = $dt->NOW( true );
	$years1 = $dt->WeeksOfYear( $dt->Year( ) );

	if ( $week1 < $week0 ) {
	    // im Dezember beginnt unter Umständen schon das nächste Jahr vor Silvester,
	    // also ist week0 zum Beispiel 49

	    echo("\n ?? Berechnungsfehler in WeeksOfMonth( ) week1 = $week1 < week0 = $week0 bei " . $this->AsSQL( ));
	    echo "\n years0 = $years0 und years1 = $years1 ";

	    $tmp = new cDate( 12, 31, $dt->Year( ) - 1 );


	    // $week0 = ( $tmp->WeeksOfYear( $tmp->Year( ) ) - $week0 ) * - 1 + 1;
	    // $week0 = ( $tmp->WeeksOfYear( $tmp->Year( ) ) - $week0 ) * - 1 ;
	    // $week0 = ( $tmp->WeeksOfYear( $tmp->Year( ) ) - $week0 ) - 1  ;
	    $week0 = ( $tmp->WeeksOfYear( $tmp->Year( ) ) - $week0 )   ;


	}


	 // echo "\n week1 = $week1 - week0 = $week0 + 1 for " . $dt->AsSQL( );
	$weeks = ( $week1 - $week0 + 1 );

	echo "\n weeks = $weeks und weeks2 = $weeks2 und week0 = $week0 und week1 = $week1";

	// assert( $weeks < 7 && $weeks > 0 );

	if ( ! ( $weeks < 7 && $weeks > 0 ) ) {
	    assert( false == true );
	    die( "\n WeeksOfMonth: weeks = $weeks and this cannot be - betweend " . $d1->AsSQL( ) . ' and ' . $d2->AsSQL( )  );
	}

	return $weeks;
*/
    }   // public function WeeksOfMonth()

    /**
      *
      * LastSundayOfMonth() returns the last sunday of the month according to ISO. This sunday can be part of the following month.
      *
      * Example:
      * ```
      * ```
      *
      * @return cDateISO the last sunday of the actual month
      *
      * @see LastSundayOfMonth
      * @see LastWeekOfMonth
      *
      * @since = 1.0.1
      *
      */


    public function LastSundayOfMonth( ) {

	$dt = $this->LastWeekOfMonth( );

	$dt->SeekWeekday( self::DOW_SUNDAY, self::SEEK_FORWARD );

	// echo "\n LastSundayOfMonthISO returns " . $dt->AsSQL( );

	return $dt;

    }	// function LastSundayOfMonthISO( )

    /**
      *
      * Weekday() returns the weekday of the date Is the same eas DOW( )
      *
      * ISO representation of the weekday will be returned (ISO_MONDAY = 1 .. ISO_SUNDAY = 7).
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dt = new cDateISO( 11, 23, 2016 );
      *
      * echo $dt->Weekday( );
      *
      * @param bool $iso if true, then ISO-WEEKDAYS are returned, else Gregorian ones. Defaults to true
      *
      * @return int the weekday
      *
      * @see Weekday
      * @see DOW
      *
      * @since = 1.0
      *
      */


    public function Weekday ( $iso = true )
    // zwischen 0 (f&uuml;r Sonntag) und 6 (f&uuml;r Samstag)
    {

	// static $ary_iso_weekday = array( 7, 1, 2, 3, 4, 5, 6 );

	if ( $iso ) {

	  if ( $this->m_dow == self::DOW_SUNDAY ) return self::ISO_SUNDAY;

	}


        return $this->m_dow;

    }  //  function Weekday ( )


    /**
      *
      * DOW() aka "Day Of Week" returns the day number of the date in the week. Same as Weekday( )
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dt = new cDate( 11, 23, 2016 );
      *
      * echo $dt->DOW( );
      *
      * @param bool $iso if true, then ISO-WEEKDAYS are returned, else Gregorian ones. Defaults to true
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




    public function DOW ( $iso = true )
    // zwischen 0 (f&uuml;r Sonntag) und 6 (f&uuml;r Samstag)
    {

        return $this->Weekday( $iso );
    }  //  function DOW ( )


    /**
      *
      * WeeksOfYear() returns the number of weeks in the year $year
      *
      *
      * Kalenderwochen nach ISO-8601 (so wie wir in Deutschland Wochen zählen)
      * Ein Jahr kann in Deutschland 52 oder 53 Wochen enthalten.
      * Die erste Woche im Jahr ist die Woche, die mindestens 4 Tage enthält. Und jede Woche fängt mit einem Montag
      * an und endet am Sonntag. So kann es sein, dass der 31. Dezember in der Woche 1 des Folgejahres liegt oder
      * der 1. Januar in der letzten Kalenderwoche des Vorjahres.
      * Kalenderwochen in den USA
      * Ein Jahr hat in den USA 53 Wochen - Schaltjahre können 54 Wochen haben. Die erste Woche im Jahr beginnt in
      * den USA immer mit dem 1 Januar; Samstag ist der letzte Tag der Woche. Kalenderwochen können in den USA somit
      * weniger als 7 Tage enthalten. Dafür ragen Kalenderwochen nicht in andere Jahre hinein.
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
      * @param int $year the year
      * @return int the week count of the actual year
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


    public function WeeksOfYear( $year ) {

    // TODO: US-Zählung ( siehe oben ) via Parameter aktivierbar machen - siehe https://de.wikipedia.org/wiki/Woche
    //
    // Number of Weeks in the actual year - one-based and starting on monday
    //
    //  NOTE : ISO-8601 Wochennummer des Jahres, die Woche beginnt am Montag
    //
    // Wenn ein normales Jahr mit einem Donnerstag beginnt und auch endet, ist es 53 Wochen lang. Ein Schaltjahr besteht
    // ebenfalls aus 53 Kalenderwochen, fängt entweder mit einem Mittwoch an und endet mit einem Donnerstag oder
    // fängt mit einem Donnerstag an und wird mit einem Freitag beendet
    //
    /*
1976 wurde der Wochenbeginn auf Montag festgelegt. (Vorher gab es die Kalenderwoche in dem Sinne also nicht.) Die
erste Woche des Jahres ist definiert als die Woche, in die mindestens 4 Tage fallen = DIN 1355. Entspricht der
internationalen Norm ISO 8601 (1988); übernommen von der EU als EN 28601 (1992) und in Deutschland als DIN EN 28601
(1993) umgesetzt (vereinfacht: die Woche, die den 04. Januar enthält).

(Amerikanisch: immer die Woche, die den 01. Januar enthält.)

Die Kalenderwoche ist nach ISO 8601 so definiert:

    Kalenderwochen haben 7 Tage, beginnen an einem Montag und werden über das Jahr fortlaufend nummeriert.
    Die Kalenderwoche 1 eines Jahres ist diejenige, die den ersten Donnerstag enthält.

Weitere Eigenschaften dieser ISO-Zählweise sind:

    Jedes Jahr hat entweder 52 oder 53 Kalenderwochen.
    Ein Jahr hat genau dann 53 Kalenderwochen, wenn es mit einem Donnerstag beginnt oder endet:
        Ein Gemeinjahr mit 53 Wochen beginnt an einem Donnerstag und endet an einem Donnerstag.
        Ein Schaltjahr mit 53 Wochen beginnt entweder an einem Mittwoch und endet an einem Donnerstag oder es beginnt
        an einem Donnerstag und endet an einem Freitag.
    Der 29., 30. und 31. Dezember können schon zur Kalenderwoche 1 des Folgejahres gehören.
    Der 1., 2. und 3. Januar können noch zu der letzten Kalenderwoche des Vorjahres gehören.


    */

	$dt = new cDate( 1,1,$year );
	// $dt->GoBOY( );

	// echo "\n WeeksOfYear() with " . $dt->AsSQL( ) . ' and dow = ' . $dt->WeekDay( );
assert( $dt->Weekday( ) == $dt->DOW());
	if ( $dt->IsLeapYear( ) ) {

	    if ( $dt->Weekday( false ) == self::DOW_WEDNESDAY ) {
		$dt->GoEOY( );

		if ( $dt->Weekday( false ) == self::DOW_THURSDAY ) return 53;

	    } elseif ( $dt->Weekday( false ) == self::DOW_THURSDAY ) {
		$dt->GoEOY( );

		if ( $dt->Weekday( false ) == self::DOW_FRIDAY ) return 53;
	    }


	} else {


	    // $dt = new cDate( $this );
	    // $dt->GoBOY( );
	    // $wd = $dt->Weekday( );
	    if ( $dt->Weekday( false ) == self::DOW_THURSDAY ) {
		$dt->GoEOY( );

		if ( $dt->Weekday( false ) == self::DOW_THURSDAY ) return 53;
	    }
	}
	return 52;

    }   // public function WeeksOfYear()

    /**
      *
      * _weeknumber() returns the ISO week number of a date
      *
      * Example:
      *
      *
      * @param int $month the month of the date
      * @param int $day the day of the date
      * @param int $year the year of the date
      *
      * @return int the ISO number of he week in the year
      *
      *
      * @since = 1.0
      *
      */

/*
      protected function _weeknumber( $month, $day, $year ) {

      // http://www.proesite.com/timex/wkcalc.htm

	  $m = $month;
	  $d = $day;
	  $y = $year;

	  //
echo "\n _weeknumber mit m= $m d = $d y = $y";

	    $dow     = $this->_weekday( $m, $d, $y );
	    $dow0101 = $this->_weekday( 1, 1, $y );
	    echo "\n dow = $dow und dow0101 = $dow0101";


echo "\n 30 - ($d-1)  -> " . ( 30 - ($d-1) );
echo "\n _weekday( 1, 1, $y+1 ) -> " .  $this->_weekday( 1, 1, $y+1 ) ;

if ( $m == 12 ) {

    echo "\n ( 30 - ($d-1) ) = " . ( 30 - ($d-1) );
    echo "\n this->_weekday( 1, 1, $y+1 ) = " . ( $this->_weekday( 1, 1, $y+1 ));
}

// (  &&   ( 30 - ($d-1) ) <  ( $this->_weekday( 1, 1, $y+1 )   < 4 ) )


	    // if      ( $m == 1  &&  3 < $dow0101 && $dow0101 < 7 - ( $d-1) )
	    // if      ( $m == 1  &&  ( 3 < $dow0101 ) < 7 - ( $d-1) )
	    // if      ( $m == 1  &&   3 < ( $dow0101  < 7 - ( $d-1) ) )
	    // if      ( ( $m == 1  ) &&   3 <  ( $dow0101  < ( 7 - ( $d-1) ) ) )
	    // if      ( ( $m == 1  ) &&   ( 3 <   $dow0101  < ( 7 - ( $d-1) ) )  )
	    if ( $m == 1  &&  ( 3 < $dow0101 && $dow0101 < 7 - ($d-1) ) )
	    {
echo "\n brechne mit Jahresletztem";
		// days before week 1 of the current year have the same week number as
		// the last day of the last week of the previous year

		$dow     = $dow0101 - 1;
		$dow0101 = $this->_weekday( 1, 1, $y-1 );
		$m       = 12;
		$d       = 31;
	    }

	    // else if ( $m == 12  &&  30 - ($d-1) < $this->_weekday( 1, 1, $y+1 ) && $this->_weekday( 1, 1, $y+1 ) < 4 )
	    // else if ( $m == 12  &&   30 - ($d-1) < $this->_weekday( 1, 1, $y+1 )  && $this->_weekday( 1, 1, $y+1 ) < 4 )
	    // else if ( $m == 12  &&  ( 30 - ($d-1) < $this->_weekday( 1, 1, $y+1 ) )  < 4 )
	    // else if ( $m == 12  &&   30 - ($d-1) < ( $this->_weekday( 1, 1, $y+1 )   < 4 ) )
	     // else if ( ( $m == 12 ) &&   ( ( ( ( 30 - ($d-1) ) ) <   $this->_weekday( 1, 1, $y+1 ) )  < 4  ) )
	     // else if $m == 12 && 2 < 4 < 4
	     // else if ( $m == 12  &&  ( 30 - ($d-1) ) < $this->_weekday( 1, 1, $y+1 ) && $this->_weekday( 1, 1, $y+1 ) < 4 )
	     // else if ( ( $m == 12  ) &&  ( 30 - ($d-1) < $this->_weekday( 1, 1, $y+1 ))  && ( $this->_weekday( 1, 1, $y+1 ) < 4 ) )
	     else if ( $m == 12  &&  ( 30 - ($d-1) < $this->_weekday( 1, 1, $y+1 ) && $this->_weekday( 1, 1, $y + 1  ) < 4 ) )
	    {
echo "\n brechne mit Jahreserstem";
		// days after the last week of the current year have the same week number as
		// the first day of the next year, (i.e. 1)

		return 1;
	    }
echo "\n brechne normal";
	    $wn = ( $this->_weekday( 1, 1, $y ) < 4 ) + 4 * ($m-1) + ( 2 * ($m-1) + ($d-1) + $dow0101 - $dow + 6 ) * 36 / 256;

	    return floor( $wn );

      }	// function _weeknumber( )
*/

    /**
      *
      * NOW() returns the number of the week in the year the date belongs to. Same as WOY()
      *
      * Example:
      *
      * use libdatephp;
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

      /*
	see https://en.wikipedia.org/wiki/ISO_week_date#Weeks_per_month
    */

//	$wn = $this->_weeknumber( $this->m_month, $this->m_day, $this->m_year );

	// TODO checks ab hier rausnehmen

	if ( $this->IsLeapYear( ) ) {
	    $ptr =  & self::$m_a_iso_numbers_leap;
	} else {
	    $ptr = & self::$m_a_iso_numbers_norm;
	}

	// echo "\n calc = " . $ptr[ $this->Month( ) - 1  ] + $this->Day( ) - $this->DOW( true ) + 10 ) / 7;

	$now = floor( ( $ptr[ $this->m_month  - 1  ] + $this->m_day - $this->DOW( true ) + 10 ) / 7 );

	// echo "\n now = $now and php date = " . ( (int) date("W", $this->AsTimeStamp( ) ) ) . ' leap = ' . ( $this->IsLeapYear( ) ? ' true ' : ' false ');

	if ( $now > $this->WeeksOfYear( $this->m_year ) ) $now = 1;


	if ( $now == 0 ) {
	    $dt = new cDateISO( 12, 31, $this->m_year - 1 );
	    $now = $dt->WeeksOfYear( $this->m_year - 1 ) ;
	}


	$php = date("W", $this->AsTimeStamp( ) );	// TODO: Tests rausnehmen

	if( $php != $now ) {

	    assert( false == true );

	    die( "\n NOW( ) liefert '$now' statt php = $php for " . $this->AsSQL( ) );

	}


/*
	if( $wn != $now ) {

	    assert( false == true );

	    die( "\n _weeknumber liefert '$wn' statt '$now' php = $php" );

	}
*/

	return $now;


	// return (int) date("W", $this->AsTimeStamp( ) );

    }   // public function NOW( )


    /**
      *
      * IsLongYear() returns true, if the managed date is a long year with 53 weeks
      *
      * Example:
      *
      *
      * @param int $year the year
      * @return boolean returns true, if the managed date is a long year
      * @see WeeksOfYear
      *
      * @since = 1.0
      *
      */



    public function IsLongYear( $year ) {

            return $this->WeeksOfYear( $year ) == 53 ;


        // NOTE : TODO : Tagesgenaue Berechnung => Minuten sind wurscht

    }   // public function IsLongYear( )

    /**
      *
      * WeeksInQuarter() returns the number of weeks in the actual quarter the date belongs to.
      *
      * Example:
      * ```
      * $dt = new \libdatephp\cDate( 2, 22, 2017 );
      * echo "\n weeks of quarter = " . $dt->WeeksInQuarter( );
      * assert( $dt->WeeksInQuarter( ) == 13 );
      * $dt = new \libdatephp\cDate( 12, 22, 2017 );
      * echo "\n weeks of quarter = " . $dt->WeeksInQuarter( );
      * assert( $dt->WeeksInQuarter( ) == 14 );
      * ```
      *
      * @return int the week count of the actual quarter
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


    public function WeeksInQuarter( ) {
    //
    // Number of Weeks in the actual quarter - one-based and starting on monday
    //

	$dt = new cDateISO( $this );

	$do_add = 0;

	$dt->GoBOQ();

	$week0 = $dt->NOW( false );

	if ( $week0 > 50 ) {
	    $week0 = 1;
	    $do_add ++;

	}



	$dt->GoEOQ();


	$week1 = $dt->NOW( true );
	if ( $week1 < 3 ) {
	    $week1 = $dt->WeeksInYear( );
	    $do_add++;

	}


	if ( $do_add )
	    return ( $week1 - $week0 + $do_add   );
	else
	    return ( $week1 - $week0   );


    }   // public function WeeksInQuarter( )


    /**
      *
      * WeeksInYear() returns the number of weeks in the actual year
      *
      * week numbers start with 1. The first week in the year has the number 1
      *
      * Example:
      *
      * $dt = new \libdatephp\cDate( 1, 1, 2017 );
      * assert( $dt->WeeksInYear( ) == 52 );
      *
      * @see SetYear
      * @see SetMonth
      * @see SetDay
      * @see SetTimeStamp
      * @see SetWOY
      * @see WeeksInYear
      *
      * @since = 1.0
      *
      */


    public function WeeksInYear ( )
    {

        $dt = new cDateISO( $this );
        $dt->GoEOY( );

        return $dt->NOW( true );

    }  //  function WeeksInYear ( )





}	// class cDateISO

?>