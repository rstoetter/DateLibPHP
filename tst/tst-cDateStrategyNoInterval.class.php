<?php

    try {
	require_once ('../classes/cDate.class.php' );
	require_once ('../classes/cDateISO.class.php' );
// 	require_once ('../classes/cPeriod.class.php' );
 	require_once ('../classes/cDateStrategy.class.php' );
	require_once ('../classes/cDateStrategyNoInterval.class.php' );
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




function periodTypeAsString( $type ) {

    if ( $type == \libdatephp\cDateStrategyDailyFixed::FIX_DAY_MONTH ) return 'FIX_DAY_MONTH';
    if ( $type == \libdatephp\cDateStrategyDailyFixed::FIX_DAY_YEAR ) return 'FIX_DAY_YEAR';
    if ( $type == \libdatephp\cDateStrategyDailyFixed::FIX_DAY_QUARTER ) return 'FIX_DAY_QUARTER';

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






function testDateStrategyNoInterval( ) {

/////////////////////////

    echo "\n testing cDateStrategyNoInterval";

    $dt_next = new \libdatephp\cDate( );

    // create new object
    $strategy = new \libdatephp\cDateStrategyNoInterval( );

    // set start and ending date
    $strategy->SetStartDate( null );
    $strategy->SetEndDate( null );


    assert( $strategy->AddDate( new \libdatephp\cDate( 4, 8, 2016 ) ) );
    assert( $strategy->AddDate( new \libdatephp\cDate( 7, 8, 2016 ) ) );
    assert( $strategy->AddDate( new \libdatephp\cDate( 5, 8, 2016 ) ) );

    assert( $strategy->IsDate( new \libdatephp\cDate( 5, 8, 2016 ) ) );
    assert( ! $strategy->IsDate( new \libdatephp\cDate( 5, 11, 2016 ) ) );

    $strategy->m_is_debug = true;

    echo "\n ================================= a =====================================================";

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_FORWARD );

    $dt_first = new \libdatephp\cDate( 4, 8, 2016 );

    $strategy->GetFollower( $dt_first, $dt_next );
    echo "\n " . $dt_first->AsSQL( );
    if ( $dt_first->AsSQL( ) != '2016-05-08') die( "\n Test nicht bestanden" );

    echo "\n ================================= b =====================================================";

    $strategy->Dump( null, null, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );

    $dt_first = new \libdatephp\cDate( 7, 8, 2016 );

    $strategy->GetFollower( $dt_first, $dt_next, \libdatephp\cDateStrategy::DIRECTION_BACKWARD );
    echo "\n " . $dt_first->AsSQL( );
    if ( $dt_first->AsSQL( ) != '2016-05-08') die( "\n Test nicht bestanden" );


}


echo "\n Testing the class cDateStrategyNoInterval";



     try {
	testDateStrategyNoInterval( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\nFinished\n";



?>