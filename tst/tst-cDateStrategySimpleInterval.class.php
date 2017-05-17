<?php

    try {
	require_once ('../classes/cDate.class.php' );
	require_once ('../classes/cDateISO.class.php' );
// 	require_once ('../classes/cPeriod.class.php' );
 	require_once ('../classes/cDateStrategy.class.php' );
	require_once ('../classes/cDateStrategySimpleInterval.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\n starting";




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

    $dt_next = new \libdatephp\cDate( );

    // create new object
    $strategy = new \libdatephp\cDateStrategySimpleInterval( );


    // several dates
    $obj_date_today = new \libdatephp\cDate( );			// today's date
    $obj_date_start = new \libdatephp\cDate( 4, 8, 2016 ) ;	// the date, where the calculations should start
    $obj_date_start->AddMonths( -12 );

    // set start and ending date
    $strategy->SetStartDate( new \libdatephp\cDate( 4, 8, 2016 ) );
    $strategy->SetEndDate( new \libdatephp\cDate( 8, 14, 2017 ) );


    // set the calculation basics

    $strategy->SetValidDate( new \libdatephp\cDate( '2017-05-12' ) );
    $strategy->SetPeriodLen( 5 );

    // adding celebrities and holidays
    $strategy->AddCelebrity( new \libdatephp\cDate( 12, 31, 2016 ) );
    $strategy->AddHoliday( new \libdatephp\cDate( 10, 31, 2016 ) );
    $strategy->AddHoliday( new \libdatephp\cDate( 2, 22, 2017 ) );

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );

    //
    $obj_date_calc_from = new \libdatephp\cDate( 4, 5, 2015 );
    $obj_date_calc_to = new \libdatephp\cDate( 7, 19, 2017 );

    $strategy->m_debug = true;

// goto actual_subprogram;

    echo "\n ================================= a =====================================================";

    // set the calculation basics

    $strategy->SetValidDate( new \libdatephp\cDate( '2017-05-12' ) );
    $strategy->SetPeriodLen( 5 );

    //

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_FORWARD );
    outStrategyData( $strategy );

    $dt_first = new \libdatephp\cDate( 5, 17, 2017 );

    $dt = $strategy->GetNextEventSlot( $dt_first, $direction = \libdatephp\cDateStrategy::DIRECTION_FORWARD );

    //

    if ($dt->AsSQL( ) != '2017-05-22') die( "\n Test nicht bestanden" );


    echo "\n ================================= b =====================================================";

    // set the calculation basics

    $strategy->SetValidDate( new \libdatephp\cDate( '2017-05-12' ) );
    $strategy->SetPeriodLen( 5 );

    //

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_FORWARD );
    outStrategyData( $strategy );

    $dt_first = new \libdatephp\cDate( 5, 14, 2017 );

    $dt = $strategy->GetNextEventSlot( $dt_first, $direction = \libdatephp\cDateStrategy::DIRECTION_FORWARD );

    //

    if ($dt->AsSQL( ) != '2017-05-17') die( "\n Test nicht bestanden" );

    echo "\n ================================= c1 =====================================================";

    // set the calculation basics

    $strategy->SetValidDate( new \libdatephp\cDate( '2017-05-12' ) );
    $strategy->SetPeriodLen( 5 );

    //

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_FORWARD );
    outStrategyData( $strategy );

    $dt_first = new \libdatephp\cDate( 5, 16, 2017 );

    $dt = $strategy->GetNextEventSlot( $dt_first, $direction = \libdatephp\cDateStrategy::DIRECTION_FORWARD );

    //

    if ($dt->AsSQL( ) != '2017-05-17') die( "\n Test nicht bestanden" );

    echo "\n ================================= c2 =====================================================";

    // set the calculation basics

    $strategy->SetValidDate( new \libdatephp\cDate( '2017-05-12' ) );
    $strategy->SetPeriodLen( 5 );

    //

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_FORWARD );
    outStrategyData( $strategy );

    $dt_first = new \libdatephp\cDate( 5, 23, 2017 );

    $dt = $strategy->GetNextEventSlot( $dt_first, $direction = \libdatephp\cDateStrategy::DIRECTION_FORWARD );

    //

    if ($dt->AsSQL( ) != '2017-05-27') die( "\n Test nicht bestanden" );


    echo "\n ================================= d =====================================================";

    // set the calculation basics

    $strategy->SetValidDate( new \libdatephp\cDate( '2017-05-22' ) );
    $strategy->SetPeriodLen( 5 );

    //

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );
    outStrategyData( $strategy );

    $dt_first = new \libdatephp\cDate( 5, 17, 2017 );

    $dt = $strategy->GetNextEventSlot( $dt_first, $direction = \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    //

    if ($dt->AsSQL( ) != '2017-05-12') die( "\n Test nicht bestanden" );


    echo "\n ================================= e =====================================================";

    // set the calculation basics

    $strategy->SetValidDate( new \libdatephp\cDate( '2017-05-22' ) );
    $strategy->SetPeriodLen( 5 );

    //

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );
    outStrategyData( $strategy );

    $dt_first = new \libdatephp\cDate( 5, 14, 2017 );

    $dt = $strategy->GetNextEventSlot( $dt_first, $direction = \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    //

    if ($dt->AsSQL( ) != '2017-05-12') die( "\n Test nicht bestanden" );

    echo "\n ================================= f =====================================================";

    // set the calculation basics

    $strategy->SetValidDate( new \libdatephp\cDate( '2017-05-22' ) );
    $strategy->SetPeriodLen( 5 );

    //

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );
    outStrategyData( $strategy );

    $dt_first = new \libdatephp\cDate( 5, 19, 2017 );

    $dt = $strategy->GetNextEventSlot( $dt_first, $direction = \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    //

    if ($dt->AsSQL( ) != '2017-05-17') die( "\n Test nicht bestanden" );


//

    echo "\n ================================= f =====================================================";

    // set the calculation basics

    $strategy->SetValidDate( new \libdatephp\cDate( '2017-05-22' ) );
    $strategy->SetPeriodLen( 5 );

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    $dt_first = new \libdatephp\cDate( );

    $obj_date = $strategy->GetPredecessor( new \libdatephp\cDate( '2017-04-15' ), $dt_next );
    echo "\n " . $obj_date->AsSQL( );
    if ($obj_date->AsSQL( ) != '2018-02-08') die( "\n Test nicht bestanden" );

    echo "\n ================================= g =====================================================";

    $strategy->AddWeekDay( 3 );

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_FORWARD );

    $dt_first = new \libdatephp\cDate( 11, 19, 2016 );

    $obj_date = $strategy->GetFollower( $strategy->GetStartDate( ), $dt_next );
    echo "\n " . $obj_date->AsSQL( );
    if ($obj_date->AsSQL( ) != '2016-05-02') die( "\n Test nicht bestanden" );


    echo "\n ================================= h =====================================================";

    $strategy->AddWeekDay( 3 );

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_FORWARD );

    $dt_first = new \libdatephp\cDate( 11, 19, 2016 );

    $obj_date = $strategy->GetFollower( new \libdatephp\cDate( 06, 22, 2016 ), $dt_next );

    echo "\n checking: h";
    echo "\n " . $obj_date->AsSQL( );
    if ($obj_date->AsSQL( ) != '2016-07-04') die( "\n Test nicht bestanden" );


    echo "\n ================================= i =====================================================";

    $strategy->AddWeekDay( 3 );

    $strategy->m_debug = true;

    $obj_date_calc_from = new \libdatephp\cDate( 4, 5, 2015 );
    $obj_date_calc_to = new \libdatephp\cDate( 4, 19, 2017 );

    $strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \libdatephp\cDateStrategy::DIRECTION_FORWARD );

    $dt_first = new \libdatephp\cDate( 11, 19, 2016 );

    $strategy->GetArray( $ary, $obj_date_calc_from, $obj_date_calc_to, \libdatephp\cDateStrategy::DIRECTION_FORWARD, true );

    echo "\n resulting array is: "; printDateArray( $ary );

    $strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \libdatephp\cDateStrategy::DIRECTION_FORWARD );
// TODO: anyweek alleine ausprobieren
// TODO: Jahreswechsel testen
    $a_good = array(
new \libdatephp\cDate( '2016-05-02'),
new \libdatephp\cDate( '2016-05-04'),
new \libdatephp\cDate( '2016-05-05'),
new \libdatephp\cDate( '2016-05-30'),
new \libdatephp\cDate( '2016-06-01'),
new \libdatephp\cDate( '2016-06-02'),
new \libdatephp\cDate( '2016-06-06'),
new \libdatephp\cDate( '2016-06-08'),
new \libdatephp\cDate( '2016-06-09'),
new \libdatephp\cDate( '2016-07-04'),
new \libdatephp\cDate( '2016-07-06'),
new \libdatephp\cDate( '2016-07-07'),
new \libdatephp\cDate( '2016-08-01'),
new \libdatephp\cDate( '2016-08-03'),
new \libdatephp\cDate( '2016-08-04'),
new \libdatephp\cDate( '2016-08-29'),
new \libdatephp\cDate( '2016-08-31'),
new \libdatephp\cDate( '2016-09-01'),
new \libdatephp\cDate( '2016-09-05'),
new \libdatephp\cDate( '2016-09-07'),
new \libdatephp\cDate( '2016-09-08'),
new \libdatephp\cDate( '2016-10-03'),
new \libdatephp\cDate( '2016-10-05'),
new \libdatephp\cDate( '2016-10-06'),
new \libdatephp\cDate( '2016-11-01'),
new \libdatephp\cDate( '2016-11-02'),
new \libdatephp\cDate( '2016-11-03'),
new \libdatephp\cDate( '2016-11-07'),
new \libdatephp\cDate( '2016-11-09'),
new \libdatephp\cDate( '2016-11-10'),
new \libdatephp\cDate( '2016-12-05'),
new \libdatephp\cDate( '2016-12-07'),
new \libdatephp\cDate( '2016-12-08'),
new \libdatephp\cDate( '2017-01-02'),
new \libdatephp\cDate( '2017-01-04'),
new \libdatephp\cDate( '2017-01-05'),
new \libdatephp\cDate( '2017-01-30'),
new \libdatephp\cDate( '2017-02-01'),
new \libdatephp\cDate( '2017-02-02'),
new \libdatephp\cDate( '2017-02-06'),
new \libdatephp\cDate( '2017-02-08'),
new \libdatephp\cDate( '2017-02-09'),
new \libdatephp\cDate( '2017-03-06'),
new \libdatephp\cDate( '2017-03-08'),
new \libdatephp\cDate( '2017-03-09'),
new \libdatephp\cDate( '2017-04-03'),
new \libdatephp\cDate( '2017-04-05'),
new \libdatephp\cDate( '2017-04-06'),
new \libdatephp\cDate( '2017-05-01')
	);

     echo "\n checking: i";
     if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

    echo "\n ================================= j =====================================================";

    $strategy->AddWeekDay( 3 );

    $strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    $dt_first = new \libdatephp\cDate( 11, 19, 2016 );

    $strategy->GetArray( $ary, $obj_date_calc_to, 5, \libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

    echo "\n resulting array is: "; printDateArray( $ary );

    $strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    $a_good = array(
	new \libdatephp\cDate( '2017-04-06' ) ,
	new \libdatephp\cDate( '2017-04-04' ) ,
	new \libdatephp\cDate( '2017-04-03' ) ,
	new \libdatephp\cDate( '2017-03-09' ) ,
	new \libdatephp\cDate( '2017-07-09' )
	);


     echo "\n checking: j";
     if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }


    echo "\n ================================= k1 =====================================================";
actual_subprogram:

    $strategy->SetOnLastWeek( false );
    $strategy->SetOnAnyWeek( true );

    $strategy->AddWeekDay( 3 );

    $dt_first = new \libdatephp\cDate( 11, 19, 2016 );

    $strategy->Dump( $dt_first, null, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    $strategy->GetArray( $ary, $dt_first, 11, \libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

    echo "\n resulting array is: "; printDateArray( $ary );

    $strategy->Dump(  $dt_first, null, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    $a_good = array(
	new \libdatephp\cDate( '2016-11-10' ) ,
	new \libdatephp\cDate( '2016-11-09' ) ,
	new \libdatephp\cDate( '2016-11-07' ) ,
	new \libdatephp\cDate( '2016-11-03' ) ,
	new \libdatephp\cDate( '2016-11-02' ) ,
	new \libdatephp\cDate( '2016-11-01' ) ,	// wg holiday
	new \libdatephp\cDate( '2016-10-06' ) ,
	new \libdatephp\cDate( '2016-10-05' ) ,
	new \libdatephp\cDate( '2016-10-03' ) ,
	new \libdatephp\cDate( '2016-09-29' ) ,
	new \libdatephp\cDate( '2016-09-28' )
	);

     echo "\n checking: k1";
     if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

    $strategy->SetOnLastWeek( false );
    $strategy->SetOnAnyWeek( false );

    echo "\n ================================= k2 =====================================================";

    $strategy->SetOnLastWeek( true );
    $strategy->SetOnAnyWeek( false );

    $strategy->AddWeekDay( 3 );

    $dt_first = new \libdatephp\cDate( 11, 19, 2016 );

    $strategy->Dump( $dt_first, null, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    $strategy->GetArray( $ary, $dt_first, 11, \libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

    echo "\n resulting array is: "; printDateArray( $ary );

    $strategy->Dump(  $dt_first, null, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    $a_good = array(
	new \libdatephp\cDate( '2016-11-10' ) ,
	new \libdatephp\cDate( '2016-11-09' ) ,
	new \libdatephp\cDate( '2016-11-07' ) ,
	new \libdatephp\cDate( '2016-11-03' ) ,
	new \libdatephp\cDate( '2016-11-02' ) ,
	new \libdatephp\cDate( '2016-11-01' ) ,	// wg holiday
	new \libdatephp\cDate( '2016-10-06' ) ,
	new \libdatephp\cDate( '2016-10-05' ) ,
	new \libdatephp\cDate( '2016-10-03' ) ,
	new \libdatephp\cDate( '2016-09-29' ) ,
	new \libdatephp\cDate( '2016-09-28' )
	);

     echo "\n checking: k2";
     if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

    $strategy->SetOnLastWeek( false );
    $strategy->SetOnAnyWeek( false );

    echo "\n ================================= l =====================================================";



    /////////////////////////////////////////////////////////////



}


echo "\n Testing the class cDateStrategySimpleInterval";



     try {
	testDateStrategyMonthly( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\nFinished\n";



?>