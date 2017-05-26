<?php

require_once __DIR__ . '/../vendor/autoload.php';


    try {
	require_once ( __DIR__ . '/../src/cDate.class.php' );
	require_once ( __DIR__ . '/../src/cDateISO.class.php' );
	require_once ( __DIR__ . '/../src/cPeriod.class.php' );
	require_once ( __DIR__ . '/../src/cDateStrategy.class.php' );
	require_once ( __DIR__ . '/../src/cDateStrategyDailyFixed.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\n starting";




echo "Testing the library libdatephp";
echo "\n Testing the class cDateStrategyDailyFixed";

use rstoetter\libdatephp;

class cDateStrategyDailyFixedTest extends PHPUnit_Framework_TestCase {

    function directionAsString( $direction ) {

	if ( $direction == \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE ) $str = 'leave';
	if ( $direction == \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD ) $str = 'forward';
	if ( $direction == \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) $str = 'backward';
	if ( $direction == \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) $str = 'abolish';

	return $str;

    }

    function doPrint( $strategy, $dt, $follower ) {

	echo "\n";
	echo $dt->AsSQL( ) ;
	if ( ! is_null( $follower ) ) {
	    echo ( $dt->IsWeekend( ) ? ' weekend ' :  '         ' );
	    echo ( $strategy->IsCelebrity( $dt ) ? ' celebrity ' :  '           ' );
	    echo ( $strategy->IsHoliday( $dt ) ? ' holiday ' :  '         ' );
	    echo ( $dt->IsSaturday( ) ? ' sa ' :  '    ' );
	    echo ( $dt->IsSunday( ) ? ' su ' :  '    ' );
	    echo ( $dt->lt( $strategy->GetStartDate( ) ) ? ' Underflow ' :  '           ' );
	    echo ( $dt->gt( $strategy->GetEndDate( ) ) ? ' Overflow ' :  '           ' );

	    echo '->';
	    echo $follower->AsSQL( );
	} else {
	    echo "                                                           ->NULL";
	}

    }	// function doPrint( )

    function printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy ) {

	echo "\n calculating the events between " . $obj_date_calc_from->AsSQL( ) . ' and ' . $obj_date_calc_to->AsSQL( );
	echo "\n calculation bases are  " . $strategy->GetStartDate( ) ->AsSQL( ) . ' and ' . $strategy->GetEndDate( ) ->AsSQL( ) ;
	echo "\n celebrities = ";
	foreach ( $strategy::$m_a_celebrities as $cel ) {
	    echo "\n" . $cel->AsSQL( );
	}

	echo "\n holidays = ";
	foreach ( $strategy->m_a_holidays as $cel ) {
	    echo "\n" . $cel->AsSQL( );
	}

	echo "\n onSaturday = " . $this->directionAsString( $strategy->GetStrategySaturday( ) );
	echo " onSunday = " . $this->directionAsString( $strategy->GetStrategySunday( ) );
	echo "\n onCelebrity = " . $this->directionAsString( $strategy->GetStrategyCelebrity( ) );
	echo " onHoliday = " . $this->directionAsString( $strategy->GetStrategyHoliday( ) );
	echo " onImpossible = " . $this->directionAsString( $strategy->GetStrategyImpossible( ) );

    }


    function periodTypeAsString( $type ) {

	if ( $type == \rstoetter\libdatephp\cDateStrategyDailyFixed::FIX_DAY_MONTH ) return 'FIX_DAY_MONTH';
	if ( $type == \rstoetter\libdatephp\cDateStrategyDailyFixed::FIX_DAY_YEAR ) return 'FIX_DAY_YEAR';
	if ( $type == \rstoetter\libdatephp\cDateStrategyDailyFixed::FIX_DAY_QUARTER ) return 'FIX_DAY_QUARTER';

	return 'n/a';

    }

    function SameContents( $a1, $a2, $msg = '' ) {

	if ( strlen( $msg ) ) echo "\n {$msg}";

	$a3 = array( );

	echo "\n testing the resulting array";

	if ( ! is_array( $a1 ) ) {
	    die( "\n error: the first array is no array" );
	    return false;
	}

	if ( ! is_array( $a2 ) ) {
	    die( "\n error: the second array is no array" );
	    return false;
	}

	if ( count( $a1 ) != count( $a2 ) ) {
	    die( "\n error: the arrays have not the same size " );
	}

	$found = false;
	foreach ( $a1 as $obj_dt ) {

	    // $found = false;
	    for( $j = 0; $j < count( $a2 ); $j++ ) {

		// echo "\n $j " . $a2[ $j ]->AsSQL( );

		if ( in_array( $j, $a3 ) ) {
		    break;
		}

		// echo "\n comparing " . $obj_dt->AsSQL( ) . ' with ' . $a2[ $j ]->AsSQL( );

    // 	    echo "\n"; var_dump( $obj_dt );
    // 	    echo "\n"; var_dump( $a2[ $j ] );


		//for ( $k = 0; $k < count( $a2 ); $k++ ) {
		if ( $obj_dt->eq( $a2[ $j ] ) ) {

		    // echo "\n removing " . $obj_dt->AsSQL( );

		    $a3[] = $j;

		    $found = true;

		    break;
		}
		//}




	    }

	    if ( ! $found ) {
		die( "\n error: could not find " . $obj_dt->AsSQL( ) . ' in second array ' );
	    }

	}	// foreach

	echo "\n test was successful";

	return true;

    }	// function $this->SameContents( )

    function printDateArray( $ary ) {

	foreach( $ary as $dt ) {

	    echo "\n" . $dt->AsSQL( );

	}

    }

    function testDateStrategyDailyFixed( ) {

	echo "\n testing cDateStrategyDailyFixed";

	$dt_next = new \rstoetter\libdatephp\cDate( );

	// create new object
	$strategy = new \rstoetter\libdatephp\cDateStrategyDailyFixed( );

	// several dates
	$obj_date_today = new \rstoetter\libdatephp\cDate( );				// today's date
	$obj_date_start = new \rstoetter\libdatephp\cDate( 4, 8, 2016 ) ;	// the date, where the calculations should start
	$obj_date_start->AddMonths( -12 );

	// set start and ending date
	$strategy->SetStartDate( new \rstoetter\libdatephp\cDate( 4, 8, 2016 ) );
	$strategy->SetEndDate( new \rstoetter\libdatephp\cDate( 4, 14, 2017 ) );

	$strategy->SetPeriodType( \rstoetter\libdatephp\cDateStrategyDailyFixed::FIX_DAY_MONTH );
	$strategy->SetDayNumber( 31 );

	$strategy->AddCelebrity( new \rstoetter\libdatephp\cDate( 12, 31, 2016 ) );
	$strategy->AddHoliday( new \rstoetter\libdatephp\cDate( 10, 31, 2016 ) );

	// define, how special situations should be treated
	$strategy->SetStrategyCelebrity( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategyHoliday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategyImpossible( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategySaturday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategySunday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );

	//
	$obj_date_calc_from = new \rstoetter\libdatephp\cDate( 4, 5, 2015 );
	$obj_date_calc_to = new \rstoetter\libdatephp\cDate( 4, 19, 2017 );

	$strategy->m_debug = true;

	echo "\n ================================= a =====================================================";

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is forward";

	$obj_date = $strategy->GetPredecessor( $strategy->GetEndDate( ), $dt_next );
	echo "\n " . $obj_date->AsSQL( );
	if ($obj_date->AsSQL( ) != '2017-03-31') throw new \Exception( "\n Test a nicht bestanden" );;

	echo "\n ================================= b =====================================================";

	echo "\n Test b";

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is forward";

	$obj_date = $strategy->GetFollower( $strategy->GetStartDate( ), $dt_tmp );
	echo "\n " . $obj_date->AsSQL( );
	if ($obj_date->AsSQL( ) != '2016-05-02') die( "\n Test nicht bestanden" );;

	echo "\n ================================= c =====================================================";

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is forward";

	$obj_date = $strategy->GetFirstDate( );
	echo "\n " . $obj_date->AsSQL( );
	if ($obj_date->AsSQL( ) != '2016-05-02') die( "\n Test nicht bestanden" );;


	echo "\n ================================= 0 =====================================================";

	echo "\n Test 1:";

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is forward";



	$strategy->GetArray( $ary, $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD, true );

	echo "\n resulting array is: "; $this->printDateArray( $ary );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2016-05-02' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-05-31' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-07-01' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-08-01' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-08-31' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-10-03' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-01' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-12-01' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-01-02' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-01-31' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-03-01' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-03-31' )
	    );

	if ( ! $this->SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }


	echo "\n ================================= 1 =====================================================";

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is forward";

	$strategy->GetArray( $ary, $obj_date_calc_from, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD, true );

	echo "\n resulting array is: "; $this->printDateArray( $ary );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2016-05-02' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-05-31' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-07-01' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-08-01' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-08-31' )
	    );


	if ( ! $this->SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }



    echo "\n ======================================= 2 =============================================== ";

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );


	$strategy->GetArray( $ary, $obj_date_calc_from, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; var_dump( $ary );

	$a_good = array( );

	if ( ! $this->SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

    echo "\n ======================================= 3 =============================================== ";

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is backward";

	$obj_date = new \rstoetter\libdatephp\cDate( 12, 12, 2019 );

	$strategy->GetArray( $ary, $obj_date, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; $this->printDateArray( $ary );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2017-03-31' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-28' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-01-31' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-01-02' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-30' )
	    );

	if ( ! $this->SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

    echo "\n ======================================= 4 =============================================== ";

	$strategy->SetDayNumber( 20 );
	$strategy->SetPeriodType( \rstoetter\libdatephp\cDateStrategyDailyFixed::FIX_DAY_QUARTER );

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is backward";

	$obj_date = new \rstoetter\libdatephp\cDate( 8, 2, 2016 );

	$strategy->GetArray( $ary, $obj_date, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD, true );

	echo "\n resulting array is: "; $this->printDateArray( $ary );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2016-10-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-01-20' )
	    );

	if ( ! $this->SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

    echo "\n ======================================= 5 =============================================== ";

	$strategy->SetDayNumber( 20 );
	$strategy->SetPeriodType( \rstoetter\libdatephp\cDateStrategyDailyFixed::FIX_DAY_QUARTER );

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is backward";

	$obj_date = new \rstoetter\libdatephp\cDate( 8, 2, 2017 );

	$strategy->GetArray( $ary, $obj_date, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; $this->printDateArray( $ary );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2017-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-10-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-07-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-04-20' )
	    );

	if ( ! $this->SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

    echo "\n ======================================= 6 =============================================== ";

	$strategy->SetDayNumber( 20 );
	$strategy->SetPeriodType( \rstoetter\libdatephp\cDateStrategyDailyFixed::FIX_DAY_YEAR );
	$strategy->SetStartDate( new \rstoetter\libdatephp\cDate( '2012-04-30' ) );

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is backward";

	$obj_date = new \rstoetter\libdatephp\cDate( 8, 2, 2016 );

	$strategy->GetArray( $ary, $obj_date, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD, true );

	echo "\n resulting array is: "; $this->printDateArray( $ary );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2017-01-20' )
	    );

	if ( ! $this->SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }


    echo "\n ======================================= 7 =============================================== ";

	$strategy->SetDayNumber( 20 );
	$strategy->SetPeriodType( \rstoetter\libdatephp\cDateStrategyDailyFixed::FIX_DAY_YEAR );

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is backward";

	$obj_date = new \rstoetter\libdatephp\cDate( 8, 2, 2017 );

	$strategy->GetArray( $ary, $obj_date, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; $this->printDateArray( $ary );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2017-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2015-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2014-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2013-01-20' )
	    );

	if ( ! $this->SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

    echo "\n ======================================= 8 =============================================== ";

	// define, how special situations should be treated
	$strategy->SetStrategyCelebrity( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategyHoliday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategyImpossible( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategySaturday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategySunday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );

	$strategy->SetDayNumber( 20 );
	$strategy->SetPeriodType( \rstoetter\libdatephp\cDateStrategyDailyFixed::FIX_DAY_YEAR );

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is backward";

	$obj_date = new \rstoetter\libdatephp\cDate( 8, 2, 2017 );

	$strategy->GetArray( $ary, $obj_date, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; $this->printDateArray( $ary );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2017-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2015-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2014-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2013-01-20' )
	    );

	if ( ! $this->SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

    echo "\n ======================================= 9 =============================================== ";

	// define, how special situations should be treated
	$strategy->SetStrategyCelebrity( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
	$strategy->SetStrategyHoliday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
	$strategy->SetStrategyImpossible( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
	$strategy->SetStrategySaturday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
	$strategy->SetStrategySunday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );

	$dt_start = $strategy->GetStartDate( );
	$dt_start->Skip( - 1024 );

	// $strategy->SetStartDate( $dt_start );

	$strategy->SetDayNumber( 20 );
	$strategy->SetPeriodType( \rstoetter\libdatephp\cDateStrategyDailyFixed::FIX_DAY_YEAR );

	$this->printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
	echo "\n day number is " . $strategy->GetDayNumber( ) . ' and the period type is ' . $this->periodTypeAsString( $strategy->GetPeriodType( ) );
	echo "\n the direction is forward";

	$obj_date = $dt_start;

	$strategy->GetArray( $ary, $obj_date, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD, true );

	echo "\n resulting array is: "; $this->printDateArray( $ary );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2014-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2013-01-18' ) ,
	    new \rstoetter\libdatephp\cDate( '2012-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2011-01-20' ) ,
	    new \rstoetter\libdatephp\cDate( '2010-01-20' )
	    );

	echo "\n my array is: "; $this->printDateArray( $a_good );

	if ( ! $this->SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }


	/////////////////////////////////////////////////////////////

	echo "\n passed all tests ";

    }

  public function testcDateStrategyDailyFixed()
  {
     try {
	$this->testDateStrategyDailyFixed( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( ) . ' in ' . $e->getFile( ) . ' Line ' . $e->getLine( ) ;
 	$this->assertEquals( false, true );
     }

     echo "\n";
   }

} 	// class cDateStrategyDailyFixedTest

?>