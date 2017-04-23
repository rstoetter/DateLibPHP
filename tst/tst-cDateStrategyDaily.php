<?php

    try {
	require_once ('../classes/cDate.class.php' );
	require_once ('../classes/cPeriod.class.php' );
	require_once ('../classes/cDateStrategy.class.php' );
	require_once ('../classes/cDateStrategyDaily.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }


function testDateStrategyDaily( ) {

    echo "\n testing cDateStrategyDaily";

    // create new object
    $strategy = new \libdatephp\cDateStrategyDaily( );

    // several dates
    $obj_date_today = new \libdatephp\cDate( );				// today's date
    $obj_date_start = new \libdatephp\cDate( ) ;	// the date, where the calculations should start
    $obj_date_start->AddMonths( -12 );

    // set start and ending date
    $strategy->SetStartDate( $obj_date_start );

    $obj_date_start->SetToday( );
    $obj_date_start->AddWeeks( 2 );
    $strategy->SetEndDate( $obj_date_start );

    // define, how special situations should be treated
    $strategy->SetStrategyCelebrity( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );
    $strategy->SetStrategyImpossible( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD );
    $strategy->SetStrategySaturday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );
    $strategy->SetStrategySunday( \libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE );

    //
    $obj_date_calc_from = $obj_date_start;
    $obj_date_calc_from->Skip( -5 );
    $obj_date_calc_to = new \libdatephp\cDate(  $obj_date_start );
    $obj_date_calc_to->AddWeeks( 2 );

    echo "\n calculating the events between " . $obj_date_calc_from->AsSQL( ) . ' and ' . $obj_date_calc_to->AsSQL( );
    echo "\n calculation bases are  " . $strategy->GetStartDate( ) ->AsSQL( ) . ' and ' . $strategy->GetEndDate( ) ->AsSQL( ) ;

    //

    echo "\n Test 1:";

    $obj_date = $obj_date_calc_from;

    do {

	echo "\n event = " . $obj_date->AsSQL( );
	$obj_date = $strategy->GetFollower( $obj_date );

    } while ( ( ! is_null( $obj_date ) ) && ( $obj_date->le( $obj_date_calc_to ) )  ) ;


    echo "\n Test 2:";

    $obj_date = $strategy->GetFirstDate( );

    for ( $i = 0; $i < 10; $i++ ) {

	if ( ! is_null( $obj_date ) ) echo "\n event = " . $obj_date->AsSQL( );
	$obj_date = $strategy->GetFollower( $obj_date );

    }

    echo "\n Test 3:";

    $obj_date->SetToday( );

    for ( $i = 0; $i < 10; $i++ ) {

	if ( ! is_null( $obj_date ) ) echo "\n event = " . $obj_date->AsSQL( );
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