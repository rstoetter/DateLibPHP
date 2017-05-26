<?php

// error_reporting( E_STRICT );

echo "\n test app";

/*
    try {
	require_once ('../src/cDate.class.php' );
	require_once ('../src/cDateISO.class.php' );
	require_once ('../src/cPeriod.class.php' );
	require_once ('../src/cDateStrategy.class.php' );
	require_once ('../src/cDateStrategyDaily.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }


*/

function myfunc( $dt ) {
  echo "\n" . $dt->AsSQL( );
}



echo "Testing the library libdatephp";

use rstoetter\libdatephp;

class cDateTest extends PHPUnit_Framework_TestCase {

    function tst_func( ) {

	$dt_01 = new \rstoetter\libdatephp\cDate( );
	$dt_02 = new \rstoetter\libdatephp\cDate( 11, 25, 2016 );

	echo "\n dt_01 = "; var_dump( $dt_01 );
	echo "\n dt_02 = "; var_dump( $dt_02 );

	echo "\n dt_01: DOY = " . $dt_01->DOY( );
	echo "\n dt_02: DOY = " . $dt_02->DOY( );


	$period_01 = new \rstoetter\libdatephp\cPeriod( $dt_01, $dt_02 );

	echo "\n period_01 = "; var_dump( $period_01 );
	echo "\n period_01 has " . $period_01->GetLen( )  . ' days';

	$p = new \rstoetter\libdatephp\cPeriod( new \rstoetter\libdatephp\cDate( 11, 23, 2016 ), new \rstoetter\libdatephp\cDate( 11, 25, 2016 ) );

	echo $p->GetLast( )->AsSQL( );

	$p1 = new \rstoetter\libdatephp\cPeriod( new \rstoetter\libdatephp\cDate( 11, 23, 2016 ), new \rstoetter\libdatephp\cDate( 11, 25, 2016 ) );
	$func = 'myfunc';
	$p1->ForEachDate( $func );

	testDates( );

    }	// function tst_func( )

  public function testDates()
  {
      try {
	  $dt_01 = new \rstoetter\libdatephp\cDate( );
	  $dt_02 = new \rstoetter\libdatephp\cDate( 11, 25, 2016 );

	  echo "\n dt_01 = "; var_dump( $dt_01 );
	  echo "\n dt_02 = "; var_dump( $dt_02 );

	  echo "\n dt_01: DOY = " . $dt_01->DOY( );
	  echo "\n dt_02: DOY = " . $dt_02->DOY( );


	  $period_01 = new \rstoetter\libdatephp\cPeriod( $dt_01, $dt_02 );

	  echo "\n period_01 = "; var_dump( $period_01 );
	  echo "\n period_01 has " . $period_01->GetLen( )  . ' days';

	  $p = new \rstoetter\libdatephp\cPeriod( new \rstoetter\libdatephp\cDate( 11, 23, 2016 ), new \rstoetter\libdatephp\cDate( 11, 25, 2016 ) );

	  echo $p->GetLast( )->AsSQL( );

	  $p1 = new \rstoetter\libdatephp\cPeriod( new \rstoetter\libdatephp\cDate( 11, 23, 2016 ), new \rstoetter\libdatephp\cDate( 11, 25, 2016 ) );
	  $func = 'myfunc';
	  $p1->ForEachDate( $func );

	  testDates( );

      } catch( Exception $e ) {
	  echo "\n Catched an exception: " .  $e->getMessage( ) . ' in ' . $e->getFile( ) . ' Line ' . $e->getLine( ) ;
	  // $this->assertTrue( false );
      }

      echo "\n";

  }

} 	// class cDateTest


?>