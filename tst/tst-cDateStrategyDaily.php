<?php

    try {
	require_once ('../classes/cDate.class.php' );
	require_once ('../classes/cPeriod.class.php' );
	require_once ('../classes/cDateStrategy.class.php' );
	require_once ('../classes/cDateStrategyDaily.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\n starting";


function directionAsString( $direction ) {

    if ( $direction == \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE ) $str = 'leave';
    if ( $direction == \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD ) $str = 'forward';
    if ( $direction == \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) $str = 'backward';
    if ( $direction == \libdatephp\cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) $str = 'abolish';

    return $str;

}

function doPrint( $strategy, $dt, $follower ) {

    echo "\n";
    echo ( is_null( $dt ) ? ' NULL ' : $dt->AsSQL( ) );
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

    echo "\n onSaturday = " . directionAsString( $strategy->GetStrategySaturday( ) );
    echo " onSunday = " . directionAsString( $strategy->GetStrategySunday( ) );
    echo "\n onCelebrity = " . directionAsString( $strategy->GetStrategyCelebrity( ) );
    echo " onHoliday = " . directionAsString( $strategy->GetStrategyHoliday( ) );
    echo " onImpossible = " . directionAsString( $strategy->GetStrategyImpossible( ) );

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


    foreach ( $a1 as $obj_dt ) {

	$found = false;
	for( $j = 0; $j < count( $a2 ); $j++ ) {

	    if ( in_array( $j, $a3 ) ) {
		break;
	    }

	    // echo "\n comparing " . $obj_dt->AsSQL( ) . ' with ' . $a2[ $j ]->AsSQL( );

// 	    echo "\n"; var_dump( $obj_dt );
// 	    echo "\n"; var_dump( $a2[ $j ] );


	    if ( $obj_dt->eq( $a2[ $j ] ) ) {

		$a3[] = $j;

		$found = true;

		break;
	    }

	    if ( ! $found ) {
		die( "\n error: could not find " . $obj_dt->AsSQL( ) . ' in second array ' );
	    }


	}


    }	// foreach

    echo "\n test was successful";

    return true;

}	// function SameContents( )

function printDateArray( $ary ) {

    echo "\n Array = ";

    foreach( $ary as $dt ) {

	echo "\n" . $dt->AsSQL( );

    }

}



function testDateStrategyDaily( ) {

    echo "\n testing cDateStrategyDaily";

    // create new object
    $strategy = new \libdatephp\cDateStrategyDaily( );

    $strategy->m_debug = true;

    // several dates
    $obj_date_today = new \libdatephp\cDate( );				// today's date
    $obj_date_start = new \libdatephp\cDate( 4, 8, 2016 ) ;	// the date, where the calculations should start
    $obj_date_start->AddMonths( -12 );

    // set start and ending date
    $strategy->SetStartDate( new \libdatephp\cDate( 4, 8, 2016 ) );
    $strategy->SetEndDate( new \libdatephp\cDate( 4, 14, 2016 ) );

    $strategy->AddCelebrity( new \libdatephp\cDate( 4, 11, 2016 ) );
    $strategy->AddHoliday( new \libdatephp\cDate( 4, 12, 2016 ) );

    ///////////////////////////////////////////////////////////////

    echo "\n ===================================   Test 1:";

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );

    //
    $obj_date_calc_from = new \libdatephp\cDate( 4, 5, 2016 );
    $obj_date_calc_to = new \libdatephp\cDate( 4, 19, 2016 );

    $strategy->Dump( $obj_date_calc_from, $obj_date_calc_to, \libdatephp\cDateStrategy::DIRECTION_FORWARD );




    $dt_next = new \libdatephp\cDate( $obj_date_calc_from );
    $obj_date = $dt_next;

    do {

	// echo "\n event = " . $obj_date->AsSQL( );
// 	$strategy->m_debug = false ;
	doPrint( $strategy, $obj_date, $strategy->GetFollower( $dt_next, $dt_tmp ) );
// 	$strategy->m_debug = true ;

	$obj_date = $strategy->GetFollower( $dt_next, $dt_next );
	if ( ! is_null( $obj_date ) ) $ary[] = $obj_date;
	if ( is_null( $dt_next ) ) echo "\n test function received dt_next = null"; else echo "\n dt_next = " . $dt_next->AsSQL( );

    } while ( ( ! is_null( $obj_date ) ) && ( $obj_date->le( $obj_date_calc_to ) )  ) ;

    echo "\n";
    printDateArray( $ary );

    $a_good = array(
	new \libdatephp\cDate( '2016-04-08' ) ,
	new \libdatephp\cDate( '2016-04-09' ) ,
	new \libdatephp\cDate( '2016-04-10' ) ,
	new \libdatephp\cDate( '2016-04-13' ) ,
	new \libdatephp\cDate( '2016-04-14' )
	);

     if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }




     echo "\n ===================================   Test 2:";
    /////////////////////////////////////////////////////////////

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );

    //
    $obj_date_calc_from = new \libdatephp\cDate( 4, 5, 2016 );
    $obj_date_calc_to = new \libdatephp\cDate( 4, 19, 2016 );

    printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );
    //



    $obj_date = new \libdatephp\cDate( $obj_date_calc_from );
    $dt_next = new \libdatephp\cDate( $obj_date_calc_from );
    $ary = array( );

    do {

	// echo "\n event = " . $obj_date->AsSQL( );
	doPrint( $strategy, $obj_date, $strategy->GetFollower( $dt_next, $dt_tmp ) );
	$obj_date = $strategy->GetFollower( $dt_next, $dt_next );
	if ( ! is_null( $obj_date ) ) $ary[] = $obj_date;

    } while ( ( ! is_null( $obj_date ) ) && ( $obj_date->le( $obj_date_calc_to ) )  ) ;

    echo "\n";
    printDateArray( $ary );

    $a_good = array(
	new \libdatephp\cDate( '2016-04-08' ) ,
	new \libdatephp\cDate( '2016-04-13' ) ,
	new \libdatephp\cDate( '2016-04-14' )
	);

     if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }



    echo "\n ===================================   Test 3:";
    /////////////////////////////////////////////////////////////

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );

    printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );



    $obj_date = $strategy->GetFirstDate( );
    $dt_next = $strategy->GetFirstDate( );
    $ary = array( );

    for ( $i = 0; $i < 14; $i++ ) {

	// if ( ! is_null( $obj_date ) ) echo "\n event = " . $obj_date->AsSQL( ); else echo "\n NULL";
	if ( ! is_null( $obj_date ) ) doPrint( $strategy, $obj_date, $strategy->GetFollower( $dt_next, $dt_tmp ) );
	$obj_date = $strategy->GetFollower( $dt_next, $dt_next );
	if ( ! is_null( $obj_date ) ) $ary[] = $obj_date;
	if ( is_null( $obj_date ) ) break;

    }


    echo "\n";
    printDateArray( $ary );

    $a_good = array(
	new \libdatephp\cDate( '2016-04-09' ) ,
	new \libdatephp\cDate( '2016-04-10' ) ,
	new \libdatephp\cDate( '2016-04-13' ) ,
	new \libdatephp\cDate( '2016-04-14' )
	);

     if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }



    /////////////////////////////////////////////////////////////


    echo "\n ===================================   Test 4a:";

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );

    $dt_start = new \libdatephp\cDate( $strategy->GetEndDate( ) );
    $dt_end = new \libdatephp\cDate( $strategy->GetEndDate( ) );
    $dt_end->Skip( 14 );

    printParameters( $dt_start, $dt_end, $strategy );



    $ary = array( );

    $obj_date = new \libdatephp\cDate( $strategy->GetEndDate( ) );
    $obj_date->Skip( 7 );

    $strategy->GetArray( $ary, $dt_start, $dt_end, \libdatephp\cDateStrategy::DIRECTION_FORWARD, true );

/*
    for ( $i = 14; $i > 0; $i-- ) {

	// if ( ! is_null( $obj_date ) ) echo "\n event = " . $obj_date->AsSQL( ); else echo "\n NULL";
	if ( ! is_null( $obj_date ) ) doPrint( $strategy, $obj_date, $strategy->GetFollower( $obj_date, \libdatephp\cDateStrategyDaily::DIRECTION_BACKWARD ) );
	$obj_date = $strategy->GetFollower( $obj_date, \libdatephp\cDateStrategyDaily::DIRECTION_BACKWARD );
	if ( ! is_null( $obj_date ) ) $ary[] = $obj_date;

    }
*/

    echo "\n";
    printDateArray( $ary );

    $a_good = array(
	new \libdatephp\cDate( '2016-04-14' )
	);

     if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }


     /////////////////////////////////////////////////////////////

    echo "\n ===================================   Test 4b:";

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );

    $dt_start = new \libdatephp\cDate( $strategy->GetEndDate( ) );
    $dt_end = new \libdatephp\cDate( $strategy->GetEndDate( ) );
    $dt_end->Skip( - 14 );

    printParameters( $dt_start, $dt_end, $strategy );



    $ary = array( );

    $obj_date = new \libdatephp\cDate( $strategy->GetEndDate( ) );
    $obj_date->Skip( 7 );

    $strategy->GetArray( $ary, $dt_start, $dt_end, \libdatephp\cDateStrategy::DIRECTION_BACKWARD, true );

/*
    for ( $i = 14; $i > 0; $i-- ) {

	// if ( ! is_null( $obj_date ) ) echo "\n event = " . $obj_date->AsSQL( ); else echo "\n NULL";
	if ( ! is_null( $obj_date ) ) doPrint( $strategy, $obj_date, $strategy->GetFollower( $obj_date, \libdatephp\cDateStrategyDaily::DIRECTION_BACKWARD ) );
	$obj_date = $strategy->GetFollower( $obj_date, \libdatephp\cDateStrategyDaily::DIRECTION_BACKWARD );
	if ( ! is_null( $obj_date ) ) $ary[] = $obj_date;

    }
*/

    echo "\n";
    printDateArray( $ary );

    $a_good = array(
	new \libdatephp\cDate( '2016-04-14' ),
	new \libdatephp\cDate( '2016-04-13' ),
	new \libdatephp\cDate( '2016-04-08' )
	);

     if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }





    echo "\n ===================================   Test 5:";

    /////////////////////////////////////////////////////////////

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );

    printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );

    $ary = array( );

    $obj_date = new \libdatephp\cDate( );

    for ( $i = 0; $i < 10; $i++ ) {

	if ( ! is_null( $obj_date ) ) doPrint( $strategy, $obj_date, $strategy->GetFollower( $dt_next, $dt_tmp ) );
	$obj_date2 = $strategy->GetFollower( $dt_next, $dt_next );
	if ( ! is_null( $obj_date2 ) ) $ary[] = $obj_date;
	if ( is_null( $obj_date2 ) ) break;
	$obj_date->Inc( );

    }

    echo "\n";
    printDateArray( $ary );

    $a_good = array(
	);

     if ( ! SameContents( $a_good, $ary ) ) { die("\n error comparing results"); }

}


echo "\n Testing the class cDateStrategyDaily";



     try {
	testDateStrategyDaily( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\n";



?>