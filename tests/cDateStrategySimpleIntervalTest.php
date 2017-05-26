<?php
/*
    try {
	require_once ('../src/cDate.class.php' );
	require_once ('../src/cDateISO.class.php' );
// 	require_once ('../src/cPeriod.class.php' );
 	require_once ('../src/cDateStrategy.class.php' );
	require_once ('../src/cDateStrategySimpleInterval.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }
*/
echo "\n starting";

echo "Testing the library libdatephp";
echo "\n Testing the class cDateStrategySimpleInterval";

use rstoetter\libdatephp;

class cDateStrategySimpleIntervalTest extends PHPUnit_Framework_TestCase {


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

    }	// function printDateArray( )


    function outStrategyData( $strategy ) {

	echo "\n m_days_period = " . $strategy->GetPeriodLen( ) . " from " . $strategy->GetValidDate( )->AsSQL( );


    }	// function OutStrategyData( )

    function testDateStrategyMonthly( ) {

    /////////////////////////

	echo "\n testing cDateStrategySimpleInterval";

	$dt_next = new \rstoetter\libdatephp\cDate( );

	// create new object
	$strategy = new \rstoetter\libdatephp\cDateStrategySimpleInterval( );


	// several dates
	$obj_date_today = new \rstoetter\libdatephp\cDate( );			// today's date
	$obj_date_start = new \rstoetter\libdatephp\cDate( 4, 8, 2016 ) ;	// the date, where the calculations should start
	$obj_date_start->AddMonths( -12 );

	// set start and ending date
	$strategy->SetStartDate( new \rstoetter\libdatephp\cDate( 4, 8, 2016 ) );
	$strategy->SetEndDate( new \rstoetter\libdatephp\cDate( 8, 14, 2017 ) );


	// set the calculation basics

	$strategy->SetValidDate( new \rstoetter\libdatephp\cDate( '2017-05-12' ) );
	$strategy->SetPeriodLen( 5 );

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
	$obj_date_calc_to = new \rstoetter\libdatephp\cDate( 7, 19, 2017 );

	$strategy->m_debug = true;

    // goto actual_subprogram;

	echo "\n ================================= a =====================================================";

	// set the calculation basics

	$strategy->SetValidDate( new \rstoetter\libdatephp\cDate( '2017-05-12' ) );
	$strategy->SetPeriodLen( 5 );

	//

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );
	outStrategyData( $strategy );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 17, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	//

	if ($dt->AsSQL( ) != '2017-05-22') die( "\n Test nicht bestanden" );


	echo "\n ================================= b =====================================================";

	// set the calculation basics

	$strategy->SetValidDate( new \rstoetter\libdatephp\cDate( '2017-05-12' ) );
	$strategy->SetPeriodLen( 5 );

	//

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );
	outStrategyData( $strategy );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 14, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	//

	if ($dt->AsSQL( ) != '2017-05-17') die( "\n Test nicht bestanden" );

	echo "\n ================================= c1 =====================================================";

	// set the calculation basics

	$strategy->SetValidDate( new \rstoetter\libdatephp\cDate( '2017-05-12' ) );
	$strategy->SetPeriodLen( 5 );

	//

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );
	outStrategyData( $strategy );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 16, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	//

	if ($dt->AsSQL( ) != '2017-05-17') die( "\n Test nicht bestanden" );

	echo "\n ================================= c2 =====================================================";

	// set the calculation basics

	$strategy->SetValidDate( new \rstoetter\libdatephp\cDate( '2017-05-12' ) );
	$strategy->SetPeriodLen( 5 );

	//

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );
	outStrategyData( $strategy );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 23, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	//

	if ($dt->AsSQL( ) != '2017-05-27') die( "\n Test nicht bestanden" );


	echo "\n ================================= d =====================================================";

	// set the calculation basics

	$strategy->SetValidDate( new \rstoetter\libdatephp\cDate( '2017-05-22' ) );
	$strategy->SetPeriodLen( 5 );

	//

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );
	outStrategyData( $strategy );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 17, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	//

	if ($dt->AsSQL( ) != '2017-05-12') die( "\n Test nicht bestanden" );


	echo "\n ================================= e =====================================================";

	// set the calculation basics

	$strategy->SetValidDate( new \rstoetter\libdatephp\cDate( '2017-05-22' ) );
	$strategy->SetPeriodLen( 5 );

	//

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );
	outStrategyData( $strategy );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 14, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	//

	if ($dt->AsSQL( ) != '2017-05-12') die( "\n Test nicht bestanden" );

	echo "\n ================================= f =====================================================";

	// set the calculation basics

	$strategy->SetValidDate( new \rstoetter\libdatephp\cDate( '2017-05-22' ) );
	$strategy->SetPeriodLen( 5 );

	//

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );
	outStrategyData( $strategy );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 19, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	//

	if ($dt->AsSQL( ) != '2017-05-17') die( "\n Test nicht bestanden" );


    //




	/////////////////////////////////////////////////////////////


    echo "\nFinished\n";

    }


  public function testcDateStrategySimpleInterval( )
  {
     try {
	testDateStrategyMonthly( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( ) . ' in ' . $e->getFile( ) . ' Line ' . $e->getLine( ) ;
 	$this->assertEquals( false, true );
     }

     echo "\n";
   }

} 	// class cDateStrategySimpleIntervalTest





?>