<?php

    try {
	require_once ('../classes/cDate.class.php' );
	require_once ('../classes/cDateISO.class.php' );
	require_once ('../classes/cPeriod.class.php' );
	require_once ('../classes/cDateStrategy.class.php' );
	require_once ('../classes/cDateStrategyMonthlyFixed.class.php' );
     } catch( Exception $e ) {
 	echo "\n Catched an exception: " .  $e->getMessage( )  ;
     }

echo "\n starting";

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
	    if ( $obj_dt ==  $a2[ $j ] ) {

		// echo "\n removing " . $obj_dt->AsSQL( );

		$a3[] = $j;

		$found = true;

		break;
	    }
	    //}




	}

	if ( ! $found ) {
	    assert( true == false);
	    die( "\n error: could not find " . $obj_dt . ' in second array ' );
	}

    }	// foreach

    echo "\n test was successful";

    return true;

}	// function SameContents( )


function SameDateContents( $a1, $a2, $msg = '' ) {

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

}	// function SameDateContents( )


function testDates( ) {


      $a_result = array( );


/*
      $dt = new \libdatephp\cDateISO( '2000-01-01' );
      $sum = 0;
      echo "\n";
      for ( $i = 0; $i < count( \libdatephp\cDateISO::$m_iso_weeks); $i++ )  {

	  $sum += \libdatephp\cDateISO::$m_iso_weeks[ $i ];
	  echo ", " . ( $sum );

      }

      echo "\n";
      assert( $sum == 52 );
*/

    $dt = new \libdatephp\cDateISO( '2017-01-01' );
    if ( $dt->WeeksOfMonth( )  != 4 )  die( "\n Der Monat mit " . $dt->AsSQL( ) . ' hat 4 Wochen und nicht ' . $dt->WeeksOfMonth( )) ;

    $dt = new \libdatephp\cDateISO( '2016-10-15' );
    if ( $dt->WeeksOfMonth( )  != 5 )  die( "\n Der Monat mit " . $dt->AsSQL( ) . ' hat 5 Wochen und nicht ' . $dt->WeeksOfMonth( ) );

    $dt = new \libdatephp\cDateISO( '2016-03-15' );
    if ( $dt->WeeksOfMonth( )  != 4 )  die( "\n Der Monat mit " . $dt->AsSQL( ) . ' hat 4 Wochen und nicht ' . $dt->WeeksOfMonth( ) );

    $dt = new \libdatephp\cDateISO( '2016-05-01' );
    if ( $dt->WeeksOfMonth( )  != 4 )  die( "\n Der Monat mit " . $dt->AsSQL( ) . ' hat 4 Wochen und nicht ' . $dt->WeeksOfMonth( ) );

    $dt = new \libdatephp\cDateISO( '2017-05-01' );
    if ( $dt->WeeksOfMonth( )  != 5 )  die( "\n Der Monat mit " . $dt->AsSQL( ) . ' hat 5 Wochen und nicht ' . $dt->WeeksOfMonth( ) );

      echo "\n 2000 % 100 = " . ( 2000 % 100);
      echo "\n 2000 % 10 = " . ( 2000 % 10);
      echo "\n 2017 % 100 = " . ( 2017 % 100);
      echo "\n 2017 % 10 = " . ( 2017 % 10);

      $dt = new \libdatephp\cDateISO( '2000-01-01' );
//      for ( $i = 0; $i < 15000; $i++ ) { $dt-> Inc( ); $tmp = new \libdatephp\cDateISO( $dt ); }

      $dt = new \libdatephp\cDateISO( '2000-01-01' );
      $dt = new \libdatephp\cDateISO( '2000-01-02' );
      $dt = new \libdatephp\cDateISO( '2000-01-03' );

      $dt = new \libdatephp\cDateISO( '2008-05-01' );
      $dt->GoWOY( 39, 2008, \libdatephp\cDateISO::ISO_SATURDAY );
      echo "\n dt = " . $dt->AsSQL( );

      $dt = new \libdatephp\cDateISO( '2017-05-01' );
      $dt->GoWOY( 39, 2017, \libdatephp\cDateISO::ISO_SATURDAY );
      echo "\n dt = " . $dt->AsSQL( );


      $dt = new \libdatephp\cDateISO( '2017-01-01' );
      $dt->GoWOY( 50, 2017 );
      echo "\n dt = " . $dt->AsSQL( );

      echo "\n letzte 2 Ziffern zwei  2017 % 1000 = " . ( 2017 % 1000 );


      $dt = new \libdatephp\cDateISO( 9, 26, 2008 );
      if ( $dt->NOW( ) != 39 ) die( "\n error: " . $dt->AsSQL( ) . ' is not in week ' . $dt->NOW( ) . ' but in week 39' );

      // $dt = new \libdatephp\cDateISO( '2024-02-01' );
      if ( $dt->FirstMondayOfJanuary( 2024 ) != new \libdatephp\cDateISO( '2024-01-01' )  ) die( "\n error: " . $dt->AsSQL( ) . '  first monday is not on ' . $dt->FirstMondayOfJanuary( )->AsSQL( ) . ' but on 2024-01-01' );

      // $dt = new \libdatephp\cDateISO( '2023-02-01' );
      if ( $dt->FirstMondayOfJanuary( 2023 ) != new \libdatephp\cDateISO( '2023-01-02' )  ) die( "\n error: " . $dt->AsSQL( ) . '  first monday is not on ' . $dt->FirstMondayOfJanuary( )->AsSQL( ) . ' but on 2023-01-02' );

      // $dt = new \libdatephp\cDateISO( '2017-02-01' );
      if ( $dt->FirstMondayOfJanuary( 2017 ) != new \libdatephp\cDateISO( '2017-01-02' )  ) die( "\n error: " . $dt->AsSQL( ) . '  first monday is not on ' . $dt->FirstMondayOfJanuary( )->AsSQL( ) . ' but on 2017-01-02' );

      // $dt = new \libdatephp\cDateISO( '2017-05-01' );
      if ( $dt->FirstMondayOfJanuary( 2017 ) != new \libdatephp\cDateISO( '2017-01-02' )  ) die( "\n error: " . $dt->AsSQL( ) . '  first monday is not on ' . $dt->FirstMondayOfJanuary( )->AsSQL( ) . ' but on 2017-01-02' );

      if ( $dt->FirstMondayOfJanuary( 2017 ) != new \libdatephp\cDateISO( '2017-01-02' )  ) die( "\n error: " . $dt->AsSQL( ) . '  first monday is not on ' . $dt->FirstMondayOfJanuary( )->AsSQL( ) . ' but on 2017-01-02' );

      $dt = new \libdatephp\cDateISO( '2017-01-01' );
      if ( $dt->FirstWeekOfMonth( ) != new \libdatephp\cDateISO( '2016-12-05' )  ) die( "\n error: " . $dt->AsSQL( ) . '  first week of month starts not on ' . $dt->FirstWeekOfMonth( )->AsSQL( ) . ' but on 2016-12-05' );

      $dt = new \libdatephp\cDateISO( '2017-01-02' );
      if ( $dt->FirstWeekOfMonth( ) != new \libdatephp\cDateISO( '2017-01-02' )  ) die( "\n error: " . $dt->AsSQL( ) . '  first week of month starts not on ' . $dt->FirstWeekOfMonth( )->AsSQL( ) . ' but on 2017-01-02' );


      $dt = new \libdatephp\cDateISO( '2017-03-02' );
      if ( $dt->FirstWeekOfMonth( ) != new \libdatephp\cDateISO( '2017-02-06' )  ) die( "\n error: " . $dt->AsSQL( ) . '  first week of month starts not on ' . $dt->FirstWeekOfMonth( )->AsSQL( ) . ' but on 2017-02-06' );


      $dt = new \libdatephp\cDateISO( '2017-08-03' );
      if ( $dt->FirstWeekOfMonth( ) != new \libdatephp\cDateISO( '2017-07-03' )  ) die( "\n error: " . $dt->AsSQL( ) . '  first week of month starts not on ' . $dt->FirstWeekOfMonth( )->AsSQL( ) . ' but on 2017-07-03' );
// die( "\n hhhhhhhhhhhhhhhhhhh" );
      $dt = new \libdatephp\cDateISO( 12, 29, 2014 );
      if ( $dt->NOW( ) != 1 ) die( "\n error: " . $dt->AsSQL( ) . ' is not in week ' . $dt->NOW( ) . ' but in week 1' );


      $dt = new \libdatephp\cDateISO( 1, 22, 2017 );
      if ( $dt->NOW( ) != 3 ) die( "\n error: " . $dt->AsSQL( ) . ' is not in week ' . $dt->NOW( ) . ' but in week 3' );

      $dt = new \libdatephp\cDateISO( 4, 18, 2017 );
      if ( $dt->NOW( ) != 16 ) die( "\n error: " . $dt->AsSQL( ) . ' is not in week ' . $dt->NOW( ) . ' but in week 16' );

      $dt = new \libdatephp\cDateISO( 4, 30, 2017 );
      if ( $dt->NOW( ) != 17 ) die( "\n error: " . $dt->AsSQL( ) . ' is not in week ' . $dt->NOW( ) . ' but in week 17' );

      $dt = new \libdatephp\cDateISO( 5, 1, 2017 );
      if ( $dt->NOW( ) != 18 ) die( "\n error: " . $dt->AsSQL( ) . ' is not in week ' . $dt->NOW( ) . ' but in week 18' );

      $dt = new \libdatephp\cDateISO( 8, 3, 2017 );
      if ( $dt->WOM( ) != 5 ) die( "\n error: " . $dt->AsSQL( ) . ' is not in week of month ' . $dt->WOM( ) . ' but in week 5' );

      $dt = new \libdatephp\cDateISO( 12, 31, 2017 );
      if ( $dt->WOM( ) != 4 ) die( "\n error: " . $dt->AsSQL( ) . ' is not in week of month ' . $dt->WOM( ) . ' but in week 4' );

      $dt = new \libdatephp\cDateISO( 1, 1, 2018 );
      if ( $dt->WOM( ) != 1 ) die( "\n error: " . $dt->AsSQL( ) . ' is not in week of month ' . $dt->WOM( ) . ' but in week 1' );


      $dt = new \libdatephp\cDateISO( 12, 31, 2017 );
      echo "\n weeks of quarter = " . $dt->WeeksInQuarter( );
      if ( $dt->WeeksInQuarter( ) != 13 ) die( "\n error calculating quarters a) expected 13 and not "  . $dt->WeeksInQuarter( ) );

      $dt = new \libdatephp\cDateISO(  1, 1, 2017 );
      echo "\n weeks of quarter = " . $dt->WeeksInQuarter( );
      if ( $dt->WeeksInQuarter( ) != 13 ) die( "\n error calculating quarters b) expected 13 and not "  . $dt->WeeksInQuarter( ) );

      $dt = new \libdatephp\cDateISO( 2, 22, 2017 );
      echo "\n weeks of quarter = " . $dt->WeeksInQuarter( );
      if ( $dt->WeeksInQuarter( ) != 13 ) die( "\n error calculating quarters c) expected 13  and not "  . $dt->WeeksInQuarter( ) );

      $dt = new \libdatephp\cDateISO( 12, 22, 2017 );
      echo "\n weeks of quarter = " . $dt->WeeksInQuarter( );
      assert( $dt->WeeksInQuarter( ) == 13 );

      if ( $dt->WeeksInQuarter( ) != 13 ) die( "\n error calculating quarters d) expected 13 and not "  . $dt->WeeksInQuarter( )  );

      // http://kwkalender.de/kalender-mit-kalenderwochen-2017.html

      $dt = new \libdatephp\cDateISO( 4, 18, 2017 );
      if ( $dt->WOM( ) != 3 ) die( "\n falsche KW berecnet - statt 3 -> " . $dt->WOM( )  . ' bei ' . $dt->AsSQL( ) );

      $dt = new \libdatephp\cDateISO( 3, 27, 2017 );
      if ( $dt->WOM( ) != 4 ) die( "\n falsche KW berecnet - statt 4 -> " . $dt->WOM( )  . ' bei ' . $dt->AsSQL( ) );

      $dt = new \libdatephp\cDateISO( 7, 3, 2017 );
      if ( $dt->WOM( ) != 1 ) die( "\n falsche KW berecnet - statt 1 -> " . $dt->WOM( )  . ' bei ' . $dt->AsSQL( ) );

      $dt = new \libdatephp\cDateISO( 6, 26, 2017 );
      if ( $dt->WOM( ) != 4 ) die( "\n falsche KW berecnet - statt 4 -> " . $dt->WOM( )  . ' bei ' . $dt->AsSQL( ) );

      $dt = new \libdatephp\cDateISO( 5, 31, 2017 );
      if ( $dt->WOM( ) != 5 ) die( "\n falsche KW berecnet - statt 5 -> " . $dt->WOM( )  . ' bei ' . $dt->AsSQL( ) );


      $dt = new \libdatephp\cDateISO( '2023-01-01' );
      if ( $dt->WeeksOfMonth( ) != 4 )   die( "\n error: " . $dt->AsSQL( ) . ' weeks of month = 4 and not ' . $dt->WeeksOfMonth( )  );

      $dt = new \libdatephp\cDateISO( '2018-01-01' );
      $month = 1;
      $year = 2018;
      $dt->BelongsToMonth( $month, $year );
      if ( $month != 1 || $year != 2018 )   die( "\n error: " . $dt->AsSQL( ) . " gehört zu 2018/01 und nicht zu $month/$year" );

      $dt = new \libdatephp\cDateISO( '2017-01-01' );
      $month = 0;
      $year = 0;
      $dt->BelongsToMonth( $month, $year );
      if ( $month != 12 || $year != 2016 )   die( "\n error: " . $dt->AsSQL( ) . " gehört zu 2016/12 und nicht zu $month/$year" );


/*
       $dt = new \libdatephp\cDateISO( 1, 1, 2017 );
       assert( $dt->WOM( ) == 1 );
       echo "\n wom = " . $dt->WOM();
       $dt->SetWOM( 5 );
       assert( $dt->WOM( ) == 5 );
       $dt = new \libdatephp\cDateISO( 1, 1, 2017 );
       $dt->SetWOM( 5, \libdatephp\cDateISO::DOW_TUESDAY );
       assert( $dt->IsThursday( ) );
       assert( $dt->eq( new \libdatephp\cDateISO( 2,2,2017) ) );


       $dt = new \libdatephp\cDateISO( 11, 1, 2017 );
       $dt->SetWOM( 5, \libdatephp\cDateISO::DOW_THURSDAY );
       // assert( $dt->IsThursday( ) );
       assert( $dt->eq( new \libdatephp\cDateISO( 11,27,2017) ) );
*/

    echo "\n ------------------------------- 1 ----------------------------------------------";

    $ary = array( );
    $ary2 = array( );

     $dt = new \libdatephp\cDateISO( 1, 1, 2017 );
     for ( $i = 0; $i < 12; $i++ ) {


	// $dt->GoFirstWeekOfMonth( );

	echo "\nThe first week of " . $dt->AsSQL( ) . ' starts on the ' . $dt->FirstWeekOfMonth( )->AsSQL( );
	echo '. The month has ' . $dt->WeeksOfMonth( ) . ' calendar weeks ';

	$ary[] = $dt->FirstWeekOfMonth( );
	$ary2[] = $dt->WeeksOfMonth( );

	$dt->AddMonths( );

     }

     // http://www.kalender-uhrzeit.de/kalenderwochen-2017

     $a_good = array(
		new \libdatephp\cDateISO( '2016-12-05' ),
		new \libdatephp\cDateISO( '2017-01-30' ),
		new \libdatephp\cDateISO( '2017-02-27' ),
		new \libdatephp\cDateISO( '2017-03-27' ),
		new \libdatephp\cDateISO( '2017-05-01' ),
		new \libdatephp\cDateISO( '2017-05-29' ),
		new \libdatephp\cDateISO( '2017-06-26' ),
		new \libdatephp\cDateISO( '2017-07-31' ),
		new \libdatephp\cDateISO( '2017-08-28' ),
		new \libdatephp\cDateISO( '2017-09-25' ),
		new \libdatephp\cDateISO( '2017-10-30' ),
		new \libdatephp\cDateISO( '2017-11-27' )
		    );

     $a_good2 = array(
		  5,
		  4,
		  4,
		  4,
		  5,	//Mai
		  4,
		  5,
		  4,
		  4,	// Sept
		  5,
		  4,
		  4
		    );


//     echo "\n ary = "; var_dump( $ary );
//     echo "\n a_good = "; var_dump( $a_good );


    if ( ! SameDateContents( $a_good, $ary ) ) { die("\n error comparing results (a)"); }
    if ( ! SameContents( $a_good2, $ary2 ) ) { die("\n error comparing results (b)"); }

    echo "\n ---------------------------------- 2 -------------------------------------------";

    $dt = new \libdatephp\cDateISO( 1, 25, 2016 );
    if( $dt->FirstWeekOfMonth( ) != new \libdatephp\cDateISO( '2016-01-04' ) )
	die("\n falsches Ergebnis FirstWeekOfMonth( ) für 2016 " . $dt->FirstWeekOfMonth( )->AsSQL( ) );


    $dt = new \libdatephp\cDateISO( 1, 25, 2015 );
    if( $dt->FirstWeekOfMonth( ) != new \libdatephp\cDateISO( '2015-01-05' ) )
	die("\n falsches Ergebnis FirstWeekOfMonth( ) für 2015 " . $dt->FirstWeekOfMonth( )->AsSQL( ) );

    $dt = new \libdatephp\cDateISO( 1, 25, 2007 );
    if( $dt->FirstWeekOfMonth( ) != new \libdatephp\cDateISO( '2007-01-01' ) )
	die("\n falsches Ergebnis FirstWeekOfMonth( ) für  " . $dt->FirstWeekOfMonth( )->AsSQL( ) );

    $dt = new \libdatephp\cDateISO( 1, 4, 2008 );
    if( $dt->FirstWeekOfMonth( ) != new \libdatephp\cDateISO( '2007-12-03' ) )
	die("\n falsches Ergebnis FirstWeekOfMonth( ) für  " . $dt->FirstWeekOfMonth( )->AsSQL( ) );


    echo "\n ------------------------------------ 3 -----------------------------------------";

    $ary = array( );
    $ary2 = array( );

     $dt = new \libdatephp\cDateISO( 1, 1, 2014 );
     for ( $i = 2014; $i < 2018; $i++ ) {

	$dt->SetYear( $i );
	$woy = $dt->WeeksOfYear( $i );
	$dt = $dt->FirstMondayOfJanuary( $i );

	$ary[] = $dt->FirstMondayOfJanuary( $i );
	$ary2[] = $dt->WeeksOfYear( $i );

	echo "\n The first monday of the year " . $i . ' is on the ' . $dt->AsSQL( );
	echo '. The year has ' . $woy . ' calendar weeks ';
     }

     http://kalenderwoche.net/alle-kalenderwochen-2014.php

     $a_good = array(
		new \libdatephp\cDateISO( '2013-12-30' ),
		new \libdatephp\cDateISO( '2015-01-05' ),
		new \libdatephp\cDateISO( '2016-01-04' ),
		new \libdatephp\cDateISO( '2017-01-02' )
		    );

     $a_good2 = array(
		  52,
		  53,
		  52,
		  52
		    );


    if ( ! SameDateContents( $a_good, $ary ) ) { die("\n error comparing results (a)"); }
    if ( ! SameContents( $a_good2, $ary2 ) ) { die("\n error comparing results (b)"); }



    echo "\n ----------------------------------- 4 ------------------------------------------";

    $ary = array( );
    $ary2 = array( );


     $dt = new \libdatephp\cDateISO( 1, 1, 2014 );
     for ( $i = 0; $i < 16; $i++ ) {

	if ( $dt->IsLeapYear( ) ) {
	    echo "\n " . $dt->Year( ) . ' is a leapyear';
	    $ary2[] = $dt->Year( );
	}

	$dt->AddYears( );

     }

     $a_good2 = array(
		  2016,
		  2020,
		  2024,
		  2028
		    );


     if ( ! SameContents( $a_good2, $ary2 ) ) { die("\n error comparing results (b)"); }

    echo "\n ------------------------------------- 5 ----------------------------------------";

    // http://www.kalender-uhrzeit.de/kalenderwochen-2017

    $ary = array( );
    $ary2 = array( );


     $dt = new \libdatephp\cDateISO( 4, 1, 2017 );

     $dt->SetDate( $dt->FirstWeekOfMonth(  ) );

     if( $dt->AsSQL( ) != '2017-03-06' ) die( "\n falscher FirstWeekOfMonth( ) = " . $dt->AsSQL( ) . ' anstatt ' . '2017-04-03' );

     for ( $i = 0; $i < 5; $i++ ) {

	$dt = new \libdatephp\cDateISO( 5, 18, 2017 );

	// $dt->SeekWeekday( \libdatephp\cDateISO::DOW_MONDAY, \libdatephp\cDateISO::SEEK_BACKWARDS );

	$dt->GoWOM( $i + 1 );

	echo "\n The week " . ( $i + 1 ) . " starts with " . $dt->AsSQL( ) . '. The month has ' . $dt->WeeksOfMonth( ) . ' weeks';
	$ary[ ] =  $dt;
	// $dt->AddWeeks( 1 );

     }

     $a_good = array(
		new \libdatephp\cDateISO( '2017-05-01' ),
		new \libdatephp\cDateISO( '2017-05-08' ),
		new \libdatephp\cDateISO( '2017-05-15' ),
		new \libdatephp\cDateISO( '2017-05-22' ),
		new \libdatephp\cDateISO( '2017-05-29' )
		    );


     if ( ! SameDateContents( $a_good, $ary ) ) { die("\n error comparing results (b)"); }




    echo "\n -------------------------------------- 6 ---------------------------------------";


die( "\n Abbruch" );

//

;

}

testDates( );

die( "\n Finished successfully" );

?>