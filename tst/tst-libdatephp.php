<?php

// error_reporting( E_STRICT );

echo "\n test app";

    try {
	require_once ('../classes/cDate.class.php' );
	require_once ('../classes/cPeriod.class.php' );
	require_once ('../classes/cDateStrategy.class.php' );
	require_once ('../classes/cDateStrategyDaily.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }


function testDateStrategyDaily( ) {

    echo "\n teste nun cDateStrategyDaily";

    $dt = new \libdatephp\cDate( 4, 12, 2017 );
    $dt ->AddWeeks( -2 );
    echo "\n dt = " . $dt->AsSQL( );

    $strategy = new \libdatephp\cDateStrategyDaily(
			$dt,
			null,
			'en_en',
			\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
			\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
			\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
			\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
			\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD
			);

    echo "\n daily strategy 1 = " . $strategy->AsString( ) . "\n";

    $strategy2 = new \libdatephp\cDateStrategyDaily( $strategy->AsString( ) );

    echo "\n daily strategy 2 = " . $strategy2->AsString( ) . "\n";

    assert( $strategy->AsString( ) == $strategy2->AsString( ) );

    // create new object
    $strategy = new \libdatephp\cDateStrategyDaily( );

    // several dates
    $obj_date_today = new \libdatephp\cDate( );				// today's date
    $obj_date_start = new \libdatephp\cDate( ) ;	// the date, where the calculations should start
    $obj_date_start->AddMonths( -12 );

    // set the language
//    \libdatephp\cDateStrategy::SetLanguage( 'fr_fr' );

    // set start and ending date
    $strategy->SetStartDate( $obj_date_start );

    $obj_date_start->SetToday( );
    $obj_date_start->AddWeeks( 2 );
    $strategy->SetEndDate( $obj_date_start );
    // var_dump( $obj_date_start );
    // var_dump( $strategy );



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
    echo "\n calculation bses are  " . $strategy->GetStartDate( ) ->AsSQL( ) . ' and ' . $strategy->GetEndDate( ) ->AsSQL( ) ;

    //
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

function myfunc( $dt ) {
  echo "\n" . $dt->AsSQL( );
}





function tst_func( ) {

    $dt_01 = new libdatephp\cDate( );
    $dt_02 = new libdatephp\cDate( 11, 25, 2016 );

    echo "\n dt_01 = "; var_dump( $dt_01 );
    echo "\n dt_02 = "; var_dump( $dt_02 );

    echo "\n dt_01: DOY = " . $dt_01->DOY( );
    echo "\n dt_02: DOY = " . $dt_02->DOY( );


    $period_01 = new libdatephp\cPeriod( $dt_01, $dt_02 );

    echo "\n period_01 = "; var_dump( $period_01 );
    echo "\n period_01 has " . $period_01->GetLen( )  . ' days';

    $p = new libdatephp\cPeriod( new libdatephp\cDate( 11, 23, 2016 ), new libdatephp\cDate( 11, 25, 2016 ) );

    echo $p->GetLast( )->AsSQL( );

    $p1 = new libdatephp\cPeriod( new libdatephp\cDate( 11, 23, 2016 ), new libdatephp\cDate( 11, 25, 2016 ) );
    $func = 'myfunc';
    $p1->ForEachDate( $func );

    testDateStrategyDaily( );

}	// function tst_func( )


echo "Testing the library libdatephp";



     try {
	tst_func( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\n";

/*
__construct()
Reset()
SetLanguage()
SetStartDate()
GetStartDate()
SetEndDate()
GetEndDate()
HasEndDate()
SetStrategySunday()
GetStrategySunday()
SetStrategySaturday()
GetStrategySaturday()
SetStrategyCelebrity()
GetStrategyCelebrity()
SetStrategyImpossible()
GetStrategyImpossible()
FromForm()
FillForm()
IsValid()
GetFollower()
GetFirstDate()
FromString()
AsString()
AddCelebrity()
MoveDateIfNecessary()
IsCelebrity()
IsTerminDate()
GetNextTerminDate()
$m_a_celebrities
*/


?>