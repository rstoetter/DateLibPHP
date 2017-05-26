<?php
/*
    try {
	require_once ('../src/cDate.class.php' );
	require_once ('../src/cDateISO.class.php' );
// 	require_once ('../src/cPeriod.class.php' );
 	require_once ('../src/cDateStrategy.class.php' );
	require_once ('../src/cDateStrategyMonthlyFixed.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }
*/
echo "\n starting";





echo "Testing the library libdatephp";
echo "\n Testing the class cDateStrategyMonthlyFixed";

use rstoetter\libdatephp;

class cDateStrategyMonthlyFixedTest extends PHPUnit_Framework_TestCase {

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

    /////////////////////////



	echo "\n testing cDateStrategyMonthlyFixed";

	$dt_next = new \rstoetter\libdatephp\cDate( );

	// create new object
	$strategy = new \rstoetter\libdatephp\cDateStrategyMonthlyFixed( );

	// several dates
	$obj_date_today = new \rstoetter\libdatephp\cDate( );				// today's date
	$obj_date_start = new \rstoetter\libdatephp\cDate( 4, 8, 2016 ) ;	// the date, where the calculations should start
	$obj_date_start->AddMonths( -12 );

	// set start and ending date
	$strategy->SetStartDate( new \rstoetter\libdatephp\cDate( 4, 8, 2016 ) );
	$strategy->SetEndDate( new \rstoetter\libdatephp\cDate( 4, 14, 2017 ) );

	// adding week numbers

	$strategy->AddWeek( 1 );
	$strategy->AddWeek( 5 );

	// adding week day numbers

	$strategy->AddWeekDay( \rstoetter\libdatephp\cDate::DOW_MONDAY );
	$strategy->AddWeekDay( \rstoetter\libdatephp\cDate::DOW_THURSDAY );


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

    // goto actual_subprogram;

	echo "\n ================================= a =====================================================";

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$strategy->GetWeekArray( $ary );
	$a_good = array( 1, 5 );

	if ( count( $ary ) != count( $a_good )  ) die( "\n error: different array sizes" );
	if ( ! in_array( 1, $ary ) ||  ! in_array( 5, $ary ) ) die( "\n error: different values in arrays" );

	echo "\n ================================= b =====================================================";

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$strategy->GetWeekDayArray( $ary );
	$a_good = array( 31, 15 );

	if ( count( $ary ) != count( $a_good )  ) die( "\n error: different array sizes" );
	if ( ! in_array( \rstoetter\libdatephp\cDate::DOW_MONDAY, $ary ) ||  ! in_array( \rstoetter\libdatephp\cDate::DOW_THURSDAY, $ary ) ) die( "\n error: different values in arrays" );

	echo "\n ================================= c1 =====================================================";

    /*
    KW 19 	8. 5. 	9. 5. 	10. 5. 	11. 5. 	12. 5. 	13. 5. 	14. 5.
    KW 	Mo 	Di 	Mi 	Do 	Fr 	Sa 	So
    KW 20 	15. 5. 	16. 5. 	17. 5. 	18. 5. 	19. 5. 	20. 5. 	21. 5.
    */

	$strategy->SetOnAnyWeek( true );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 11, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	if ($dt->AsSQL( ) != '2017-05-15') die( "\n Test nicht bestanden" );;

	echo "\n ================================= c2 =====================================================";

	$strategy->SetOnAnyWeek( false );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 11, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	if ($dt->AsSQL( ) != '2017-05-29') die( "\n Test nicht bestanden" );;

    //

	echo "\n ================================= c3 =====================================================";

	$strategy->SetOnAnyWeek( false );
	$strategy->SetOnLastWeek( true );
	$strategy->RemoveWeek( 5 );


	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 7, 29, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	if ($dt->AsSQL( ) != '2017-07-31') die( "\n Test nicht bestanden" );;

	$strategy->SetOnLastWeek( false );
	$strategy->SetOnAnyWeek( false );
	$strategy->AddWeek( 5 );

	echo "\n ================================= d1 =====================================================";

	$strategy->SetOnAnyWeek( true );

	$strategy->AddWeekDay( 3 );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 11, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	if ($dt->AsSQL( ) != '2017-05-10') die( "\n Test nicht bestanden" );;

	echo "\n ================================= d2 =====================================================";

	$strategy->SetOnAnyWeek( false );

	$strategy->AddWeekDay( 3 );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 5, 11, 2017 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	if ($dt->AsSQL( ) != '2017-05-04') die( "\n Test nicht bestanden" );;



	echo "\n ================================= e =====================================================";

	// adding week day numbers

	$strategy->ResetWeekdays( );
	$strategy->ResetCelebrities( );
	$strategy->ResetWeeknumbers( );



	// set start and ending date
	$strategy->SetStartDate( new \rstoetter\libdatephp\cDate( 4, 8, 2016 ) );
	$strategy->SetEndDate( new \rstoetter\libdatephp\cDate( 3,3,2018 ) );

	// adding week days
	$strategy->AddWeekDay( \rstoetter\libdatephp\cDate::DOW_MONDAY );
	$strategy->AddWeekDay( \rstoetter\libdatephp\cDate::DOW_THURSDAY );

	// adding week numbers
	$strategy->AddWeek( 1 );
	$strategy->AddWeek( 5 );

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


	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 1, 1, 2018 );

	$dt = $strategy->GetNextEventSlot( $dt_first, $direction = \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	if ($dt->AsSQL( ) != '2017-12-07') die( "\n Test nicht bestanden" );;



	echo "\n ================================= f =====================================================";

	$strategy->AddWeekDay( 3 );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( );

	$obj_date = $strategy->GetPredecessor( $strategy->GetEndDate( ), $dt_next );
	echo "\n " . $obj_date->AsSQL( );
	if ($obj_date->AsSQL( ) != '2018-02-08') die( "\n Test nicht bestanden" );

	echo "\n ================================= g =====================================================";

	$strategy->AddWeekDay( 3 );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$obj_date = $strategy->GetFollower( $strategy->GetStartDate( ), $dt_next );
	echo "\n " . $obj_date->AsSQL( );
	if ($obj_date->AsSQL( ) != '2016-05-02') die( "\n Test nicht bestanden" );


	echo "\n ================================= h =====================================================";

	$strategy->AddWeekDay( 3 );

	$strategy->Dump( null, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$obj_date = $strategy->GetFollower( new \rstoetter\libdatephp\cDate( 06, 22, 2016 ), $dt_next );

	echo "\n checking: h";
	echo "\n " . $obj_date->AsSQL( );
	if ($obj_date->AsSQL( ) != '2016-07-04') die( "\n Test nicht bestanden" );


	echo "\n ================================= i =====================================================";

	$strategy->AddWeekDay( 3 );

	$strategy->m_debug = true;

	$obj_date_calc_from = new \rstoetter\libdatephp\cDate( 4, 5, 2015 );
	$obj_date_calc_to = new \rstoetter\libdatephp\cDate( 4, 19, 2017 );

	$strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$strategy->GetArray( $ary, $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD, true );

	echo "\n resulting array is: "; printDateArray( $ary );

	$strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_FORWARD );
    // TODO: anyweek alleine ausprobieren
    // TODO: Jahreswechsel testen
	$a_good = array(
    new \rstoetter\libdatephp\cDate( '2016-05-02'),
    new \rstoetter\libdatephp\cDate( '2016-05-04'),
    new \rstoetter\libdatephp\cDate( '2016-05-05'),
    new \rstoetter\libdatephp\cDate( '2016-05-30'),
    new \rstoetter\libdatephp\cDate( '2016-06-01'),
    new \rstoetter\libdatephp\cDate( '2016-06-02'),
    new \rstoetter\libdatephp\cDate( '2016-06-06'),
    new \rstoetter\libdatephp\cDate( '2016-06-08'),
    new \rstoetter\libdatephp\cDate( '2016-06-09'),
    new \rstoetter\libdatephp\cDate( '2016-07-04'),
    new \rstoetter\libdatephp\cDate( '2016-07-06'),
    new \rstoetter\libdatephp\cDate( '2016-07-07'),
    new \rstoetter\libdatephp\cDate( '2016-08-01'),
    new \rstoetter\libdatephp\cDate( '2016-08-03'),
    new \rstoetter\libdatephp\cDate( '2016-08-04'),
    new \rstoetter\libdatephp\cDate( '2016-08-29'),
    new \rstoetter\libdatephp\cDate( '2016-08-31'),
    new \rstoetter\libdatephp\cDate( '2016-09-01'),
    new \rstoetter\libdatephp\cDate( '2016-09-05'),
    new \rstoetter\libdatephp\cDate( '2016-09-07'),
    new \rstoetter\libdatephp\cDate( '2016-09-08'),
    new \rstoetter\libdatephp\cDate( '2016-10-03'),
    new \rstoetter\libdatephp\cDate( '2016-10-05'),
    new \rstoetter\libdatephp\cDate( '2016-10-06'),
    new \rstoetter\libdatephp\cDate( '2016-11-01'),
    new \rstoetter\libdatephp\cDate( '2016-11-02'),
    new \rstoetter\libdatephp\cDate( '2016-11-03'),
    new \rstoetter\libdatephp\cDate( '2016-11-07'),
    new \rstoetter\libdatephp\cDate( '2016-11-09'),
    new \rstoetter\libdatephp\cDate( '2016-11-10'),
    new \rstoetter\libdatephp\cDate( '2016-12-05'),
    new \rstoetter\libdatephp\cDate( '2016-12-07'),
    new \rstoetter\libdatephp\cDate( '2016-12-08'),
    new \rstoetter\libdatephp\cDate( '2017-01-02'),
    new \rstoetter\libdatephp\cDate( '2017-01-04'),
    new \rstoetter\libdatephp\cDate( '2017-01-05'),
    new \rstoetter\libdatephp\cDate( '2017-01-30'),
    new \rstoetter\libdatephp\cDate( '2017-02-01'),
    new \rstoetter\libdatephp\cDate( '2017-02-02'),
    new \rstoetter\libdatephp\cDate( '2017-02-06'),
    new \rstoetter\libdatephp\cDate( '2017-02-08'),
    new \rstoetter\libdatephp\cDate( '2017-02-09'),
    new \rstoetter\libdatephp\cDate( '2017-03-06'),
    new \rstoetter\libdatephp\cDate( '2017-03-08'),
    new \rstoetter\libdatephp\cDate( '2017-03-09'),
    new \rstoetter\libdatephp\cDate( '2017-04-03'),
    new \rstoetter\libdatephp\cDate( '2017-04-05'),
    new \rstoetter\libdatephp\cDate( '2017-04-06'),
    new \rstoetter\libdatephp\cDate( '2017-05-01')
	    );

	echo "\n checking: i";
	if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

	echo "\n ================================= j =====================================================";

	$strategy->AddWeekDay( 3 );

	$strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$strategy->GetArray( $ary, $obj_date_calc_to, 5, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; printDateArray( $ary );

	$strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2017-04-06' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-04-04' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-04-03' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-03-09' ) ,
	    new \rstoetter\libdatephp\cDate( '2017-07-09' )
	    );


	echo "\n checking: j";
	if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }


	echo "\n ================================= k1 =====================================================";
    actual_subprogram:

	$strategy->SetOnLastWeek( false );
	$strategy->SetOnAnyWeek( true );

	$strategy->AddWeekDay( 3 );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$strategy->Dump( $dt_first, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$strategy->GetArray( $ary, $dt_first, 11, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; printDateArray( $ary );

	$strategy->Dump(  $dt_first, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2016-11-10' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-09' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-07' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-03' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-02' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-01' ) ,	// wg holiday
	    new \rstoetter\libdatephp\cDate( '2016-10-06' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-10-05' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-10-03' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-09-29' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-09-28' )
	    );

	echo "\n checking: k1";
	if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

	$strategy->SetOnLastWeek( false );
	$strategy->SetOnAnyWeek( false );

	echo "\n ================================= k2 =====================================================";

	$strategy->SetOnLastWeek( true );
	$strategy->SetOnAnyWeek( false );

	$strategy->AddWeekDay( 3 );

	$dt_first = new \rstoetter\libdatephp\cDate( 11, 19, 2016 );

	$strategy->Dump( $dt_first, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$strategy->GetArray( $ary, $dt_first, 11, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

	echo "\n resulting array is: "; printDateArray( $ary );

	$strategy->Dump(  $dt_first, null, \rstoetter\libdatephp\cDateStrategy::DIRECTION_BACKWARD );

	$a_good = array(
	    new \rstoetter\libdatephp\cDate( '2016-11-10' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-09' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-07' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-03' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-02' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-11-01' ) ,	// wg holiday
	    new \rstoetter\libdatephp\cDate( '2016-10-06' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-10-05' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-10-03' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-09-29' ) ,
	    new \rstoetter\libdatephp\cDate( '2016-09-28' )
	    );

	echo "\n checking: k2";
	if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

	$strategy->SetOnLastWeek( false );
	$strategy->SetOnAnyWeek( false );

	echo "\n ================================= l =====================================================";



	/////////////////////////////////////////////////////////////

    echo "\nFinished\n";

    }


  public function testcDateStrategyMonthlyFixed( )
  {
     try {
	testDateStrategyMonthly( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( ) . ' in ' . $e->getFile( ) . ' Line ' . $e->getLine( ) ;
 	$this->assertEquals( false, true );
     }

     echo "\n";
   }

} 	// class cDateStrategyMonthlyFixedTest









?>