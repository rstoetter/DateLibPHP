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

    echo "\n onSaturday = " . directionAsString( $strategy->GetStrategySaturday( ) );
    echo " onSunday = " . directionAsString( $strategy->GetStrategySunday( ) );
    echo "\n onCelebrity = " . directionAsString( $strategy->GetStrategyCelebrity( ) );
    echo " onHoliday = " . directionAsString( $strategy->GetStrategyHoliday( ) );
    echo " onImpossible = " . directionAsString( $strategy->GetStrategyImpossible( ) );

}


function testDateStrategyDaily( ) {

    echo "\n testing cDateStrategyDaily";

    // create new object
    $strategy = new \libdatephp\cDateStrategyDaily( );

    // several dates
    $obj_date_today = new \libdatephp\cDate( );				// today's date
    $obj_date_start = new \libdatephp\cDate( 4, 8, 2016 ) ;	// the date, where the calculations should start
    $obj_date_start->AddMonths( -12 );

    // set start and ending date
    $strategy->SetStartDate( new \libdatephp\cDate( 4, 8, 2016 ) );
    $strategy->SetEndDate( new \libdatephp\cDate( 4, 14, 2016 ) );

    $strategy->AddCelebrity( new \libdatephp\cDate( 4, 11, 2016 ) );
    $strategy->AddHoliday( new \libdatephp\cDate( 4, 12, 2016 ) );

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );

    //
    $obj_date_calc_from = new \libdatephp\cDate( 4, 5, 2016 );
    $obj_date_calc_to = new \libdatephp\cDate( 4, 19, 2016 );

    printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );

    ///////////////////////////////////////////////////////////////

    echo "\n Test 1:";

    $obj_date = new \libdatephp\cDate( $obj_date_calc_from );

    do {

	// echo "\n event = " . $obj_date->AsSQL( );
	doPrint( $strategy, $obj_date, $strategy->GetFollower( $obj_date ) );
	$obj_date = $strategy->GetFollower( $obj_date );

    } while ( ( ! is_null( $obj_date ) ) && ( $obj_date->le( $obj_date_calc_to ) )  ) ;


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

    echo "\n Test 2:";

    $obj_date = new \libdatephp\cDate( $obj_date_calc_from );

    do {

	// echo "\n event = " . $obj_date->AsSQL( );
	doPrint( $strategy, $obj_date, $strategy->GetFollower( $obj_date ) );
	$obj_date = $strategy->GetFollower( $obj_date );

    } while ( ( ! is_null( $obj_date ) ) && ( $obj_date->le( $obj_date_calc_to ) )  ) ;

    /////////////////////////////////////////////////////////////

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );

    printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );

    echo "\n Test 3:";

    $obj_date = $strategy->GetFirstDate( );

    for ( $i = 0; $i < 14; $i++ ) {

	// if ( ! is_null( $obj_date ) ) echo "\n event = " . $obj_date->AsSQL( ); else echo "\n NULL";
	if ( ! is_null( $obj_date ) ) doPrint( $strategy, $obj_date, $strategy->GetFollower( $obj_date ) );
	$obj_date = $strategy->GetFollower( $obj_date );

    }


    /////////////////////////////////////////////////////////////

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_BACKWARD );

    printParameters( $obj_date_calc_to, $obj_date_calc_from, $strategy );

    echo "\n Test 4:";

    $obj_date = $strategy->GetEndDate( );
    $obj_date->Skip( 7 );

    for ( $i = 14; $i > 0; $i-- ) {

	// if ( ! is_null( $obj_date ) ) echo "\n event = " . $obj_date->AsSQL( ); else echo "\n NULL";
	if ( ! is_null( $obj_date ) ) doPrint( $strategy, $obj_date, $strategy->GetFollower( $obj_date, \libdatephp\cDateStrategyDaily::DIRECTION_BACKWARD ) );
	$obj_date = $strategy->GetFollower( $obj_date, \libdatephp\cDateStrategyDaily::DIRECTION_BACKWARD );

    }


    echo "\n Test 5:";

    /////////////////////////////////////////////////////////////

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyHoliday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );

    printParameters( $obj_date_calc_from, $obj_date_calc_to, $strategy );


    $obj_date = new \libdatephp\cDate( );

    for ( $i = 0; $i < 10; $i++ ) {

	if ( ! is_null( $obj_date ) ) doPrint( $strategy, $obj_date, $strategy->GetFollower( $obj_date ) );
	$obj_date->Inc( );

    }

}


echo "\n Testing the class cDateStrategyDaily";



     try {
	testDateStrategyDaily( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\n";



?>