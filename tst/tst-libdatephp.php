<?php

// error_reporting( E_STRICT );

echo "\n test app";

    try {
	require_once ('../classes/cDate.class.php' );
	require_once ('../classes/cPeriod.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
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

}	// function tst_func( )


echo "Testing the library libdatephp";



     try {
	tst_func( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\n";

?>