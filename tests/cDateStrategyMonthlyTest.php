<?php
/*
    try {
	require_once ('../src/cDate.class.php' );
	require_once ('../src/cDateISO.class.php' );
	require_once ('../src/cPeriod.class.php' );
	require_once ('../src/cDateStrategy.class.php' );
	require_once ('../src/cDateStrategyMonthly.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }
*/
echo "\n starting";


echo "Testing the library libdatephp";
echo "\n Testing the class cDateStrategyMonthly";

use rstoetter\libdatephp;

class cDateStrategyMonthlyTest extends PHPUnit_Framework_TestCase {

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

    }	// function SameContents( )

    function printDateArray( $ary ) {

	foreach( $ary as $dt ) {

	    echo "\n" . $dt->AsSQL( );

	}

    }

    function testDateStrategyMonthly( ) {

	echo "\n testing cDateStrategyMonthly";

	$dt_next = new \rstoetter\libdatephp\cDate( );

	// create new object
	$strategy = new \rstoetter\libdatephp\cDateStrategyMonthly( );

	// several dates
	$obj_date_today = new \rstoetter\libdatephp\cDate( );				// today's date
	$obj_date_start = new \rstoetter\libdatephp\cDate( 4, 8, 2016 ) ;	// the date, where the calculations should start
	$obj_date_start->AddMonths( -12 );

	// set start and ending date
	$strategy->SetStartDate( new \rstoetter\libdatephp\cDate( 4, 8, 2016 ) );
	$strategy->SetEndDate( new \rstoetter\libdatephp\cDate( 4, 14, 2017 ) );

	// adding numbers for month days
	$strategy->AddMonthDay( 31 );
	$strategy->AddMonthDay( 15 );

	// adding numbers for months
	$strategy->AddMonth( 2 );
	$strategy->AddMonth( 6 );

	// adding celebrities and holidays
	$strategy->AddCelebrity( new \rstoetter\libdatephp\cDate( 12, 31, 2016 ) );
	$strategy->AddHoliday( new \rstoetter\libdatephp\cDate( 10, 31, 2016 ) );
	$strategy->AddHoliday( new \rstoetter\libdatephp\cDate( 2, 22, 2017 ) );

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

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$strategy->GetMonthArray( $ary );
	$a_good = array( 2, 6 );

	if ( count( $ary ) != count( $a_good )  ) die( "\n error: different array sizes" );
	if ( ! in_array( 2, $ary ) ||  ! in_array( 6, $ary ) ) die( "\n error: different values in arrays" );

	echo "\n ================================= b =====================================================";

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$strategy->GetMonthDayArray( $ary );
	$a_good = array( 31, 15 );

	if ( count( $ary ) != count( $a_good )  ) die( "\n error: different array sizes" );
	if ( ! in_array( 31, $ary ) ||  ! in_array( 15, $ary ) ) die( "\n error: different values in arrays" );

	echo "\n ================================= c =====================================================";

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	if ($dt->AsSQL( ) != '2017-02-15') die( "\n Test nicht bestanden" );;

	echo "\n ================================= d =====================================================";

	$strategy->AddMonthDay( 7 );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	if ($dt->AsSQL( ) != '2016-06-29') die( "\n Test nicht bestanden" );;

	echo "\n ================================= e =====================================================";

	$strategy->AddMonthDay( 22 );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$obj_date = $strategy->GetFollower( $dt_first, $dt_tmp );

	if ( is_null( $dt_first ) ) die( "\n Test e nicht bestanden" );;
	echo "\n " . $obj_date->AsSQL( );
	if ($obj_date->AsSQL( ) != '2017-02-07') die( "\n Test e nicht bestanden" );;


	echo "\n ================================= f =====================================================";

	$strategy->AddMonthDay( 22 );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$obj_date = $strategy->GetPredecessor( $strategy->GetEndDate( ), $dt_next );
	echo "\n " . $obj_date->AsSQL( );
	if ($obj_date->AsSQL( ) != '2017-02-27') die( "\n Test nicht bestanden" );

	echo "\n ================================= g =====================================================";

	$strategy->AddMonthDay( 22 );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$obj_date = $strategy->GetFollower( $strategy->GetStartDate( ), $dt_tmp );
	echo "\n " . $obj_date->AsSQL( );
	if ($obj_date->AsSQL( ) != '2016-06-07') die( "\n Test nicht bestanden" );


	echo "\n ================================= h =====================================================";

	$strategy->AddMonthDay( 22 );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$obj_date = $strategy->GetFollower( new \rstoetter\libdatephp\cDate( 06, 22, 2016 ), $dt_tmp );
	echo "\n " . $obj_date->AsSQL( );
	if ($obj_date->AsSQL( ) != '2016-07-01') die( "\n Test nicht bestanden" );

	echo "\n ================================= i =====================================================";

	$strategy->AddMonthDay( 22 );

	$strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$strategy->GetArray( $ary, $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD, true );

	echo "\n resulting array is: "; printDateArray( $ary );

	$strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2016-06-07' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-15' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-22' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-07-01' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-07' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-15' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-23' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-03-01' )
	    );

	if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

	echo "\n ================================= j =====================================================";

	$strategy->AddMonthDay( 22 );

	$strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$strategy->GetArray( $ary, $obj_date_calc_from, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD, true );

	echo "\n resulting array is: "; printDateArray( $ary );

	$strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2016-06-07' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-15' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-22' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-07-01' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-07' )
	    );

	if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }


	echo "\n ================================= k =====================================================";

	$strategy->AddMonthDay( 22 );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$strategy->Dump( $dt_first, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$strategy->GetArray( $ary, $dt_first, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; printDateArray( $ary );

	$strategy->Dump(  $dt_first, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2016-06-29' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-22' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-15' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-07' )
	    );

	if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }


	echo "\n ================================= l =====================================================";

	// define, how special situations should be treated
	$strategy->SetStrategyCelebrity( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategyHoliday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategyImpossible( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategySaturday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategySunday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );

	$strategy->AddMonthDay( 22 );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$strategy->Dump( $dt_first, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$obj_date = new \rstoetter\libdatephp\cDate( 12, 12, 2019 );

	$strategy->GetArray( $ary, $dt_first, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; printDateArray( $ary );

	$strategy->Dump(  $dt_first, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2016-06-29' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-22' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-15' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-07' )
	    );

	if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }


	echo "\n ================================= m =====================================================";

	// define, how special situations should be treated
	$strategy->SetStrategyCelebrity( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
	$strategy->SetStrategyHoliday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
	$strategy->SetStrategyImpossible( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
	$strategy->SetStrategySaturday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
	$strategy->SetStrategySunday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );

	$strategy->AddMonthDay( 22 );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2017 );

	$strategy->Dump( $dt_first, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$obj_date = new \rstoetter\libdatephp\cDate( 12, 12, 2019 );

	$strategy->GetArray( $ary, $dt_first, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; printDateArray( $ary );

	$strategy->Dump(  $dt_first, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2016-06-29' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-07' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-15' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-21' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-24' )
	    );

	if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }


    echo "\n ======================================= 3 =============================================== ";

	// define, how special situations should be treated
	$strategy->SetStrategyCelebrity( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategyHoliday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategyImpossible( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategySaturday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
	$strategy->SetStrategySunday( \rstoetter\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );

	$strategy->Dump( $obj_date, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	echo "\n the direction is backward";

	$obj_date = new \rstoetter\libdatephp\cDate( 12, 12, 2019 );

	$strategy->GetArray( $ary, $obj_date, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; printDateArray( $ary );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2017-02-27' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-23' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-15' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-02-07' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-06-29' )
	    );

	  $strategy->Dump( $obj_date, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }




	/////////////////////////////////////////////////////////////

    echo "\nFinished\n";

    }



  public function testcDateStrategyMonthly( )
  {
     try {
	testDateStrategyMonthly( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( ) . ' in ' . $e->getFile( ) . ' Line ' . $e->getLine( ) ;
 	$this->assertEquals( false, true );
     }

     echo "\n";
   }

} 	// class cDateStrategyMonthlyTest




?>