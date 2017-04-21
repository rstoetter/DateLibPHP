<?php

// error_reporting( E_STRICT );

echo "\n test app";

    try {
	require_once ('../classes/cDate.class.php' );
	require_once ('../classes/cPeriod.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
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

}	// function tst_func( )


echo "Testing the library libdatephp";



     try {
	tst_func( );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\n";

?>