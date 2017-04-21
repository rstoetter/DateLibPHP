<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateTime.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateTime' implementiert ein Objekt zur Verwaltung von Datum und Zeit
//  Project       : libdatephp
//  Project Site  : https://github.com/rstoetter/libdatephp
//  Project wiki  : https://github.com/rstoetter/libdatephp/wiki
//  Created by    : Rainer Stötter ( rstoetter@users.sourceforge.net )
//  Copyright (c) : 2007 - 2017, Rainer Stötter, All rights reserved
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  License
//
//  This file has been released under MIT LICENSE
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Requests]]
//
//
//	no requests were found
//
//	[[End of requests]]
//
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Functions]]
//
//
//	no functions were found
//
//	[[End of functions]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Classes]]
//
//
//	class cDateTime
//		public method AsDMY($withouttime=false)
//		public method AsMDY($withouttime=false)
//		public method AsSQL()
//		public method Day()
//		public method FromAnyString($str)
//		public method FromDMY($str)
//		public method FromDate($dt)
//		public method FromDateTime($dt)
//		public method FromMDY($str)
//		public method FromSQL($str)
//		public method FromTimestamp($tm)
//		public method Month()
//		public method SetNow()
//		public method SkipDays($days)
//		public method SkipSeconds($secs)
//		public method Year()
//		public method cDateTime($p1=0,$p2=0,$p3=0,$p4=0,$p5=0,$p6=0)
//		protected var $m_time
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


?><?php

// class cDateTime

namespace libdatephp;

// require_once( './classes/cDate.class.php' );


/**
  *
  * represents a timestamp (a datetime obect)
  *
  * @author Rainer Stötter
  * @copyright 2010-2017 Rainer Stötter
  * @license MIT
  *
  */

class cDateTime {
    /**
      * The internal representation of the timestamp
      *
      * @var int
      */
    protected $m_time = 0;

    /**
      *
      *  constructor for the cDateTime class
      *
      *  $dtm = new cDateTime( 11, 22, 2016, 5, 0, 0 );
      *  from month, day, year, hours, minutes, seconds
      *
      *  $dtm = new cDateTime( '11-22-2016 5:0:0' );
      *  from string
      *
      *  $dtm = new cDateTime( new cDate( 11, 22, 2016 ) );
      *  from cDate
      *
      *
      *  $dtm = new cDateTime( 20516 );
      *  from a timestamp.
      *
      *
      * @param mixed $p1 can be an int as year or a timestamp, a cDateTime or a cDate or a string
      * @param int $p2 the day or 0
      * @param int $p3 the year or 0
      * @param int $p4 the hour or 0
      * @param int $p5 the minute or 0
      * @param int $p6 the second or 0
      * @return cDateTime
      */

    function __construct( $p1 = 0, $p2 = 0, $p3 = 0, $p4 = 0, $p5 = 0, $p6 = 0 ) {

        $month = $p1;
        $day = $p2;
        $year = $p3;
        $hour = $p4;
        $minute = $p5;
        $second = $p6;


        if ( ( $p1 == 0 ) && ( $p2 == 0 ) && ( $p3 == 0 ) ) {
            $this->SetNow( );
        } elseif ( is_a( $p1, "libdatephp\cDateTime" ) ) {

            $this->FromDateTime( $p1 );

        } elseif ( is_a( $p1, "libdatephp\cDate" ) ) {

            $this->FromDate( $p1 );

        } elseif ( ( $p2 == 0 ) && ( $p3 == 0 ) ) {
            if ( is_int( $p1 ) ) {
                $this->FromTimestamp( $p1 );
            } elseif ( is_string( $p1 )  ) {
                $this->FromAnyString( $p1 );
            }
        } else {            // cDate($y, $m, $sd)

            $this->SetDateTime( $p1, $p2, $p3, $p4, $p5, $p6 );

        }
            // var_dump( debug_backtrace( ) );
            // die("cDateTime : Fehlerhafte Parameter");


    }   // function cDateTime( )

    /**
      *
      * FromDate() sets the timestamp to the value represented by the date value
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dt = new cDate( );
      *
      * $dtm = new cDateTime( $dt );
      *
      * @param cDate $dt a cDate value
      *
      */


    public function FromDate( $dt ) {

        $this->FromSQL( $dt->AsSQL( ) );

    }   // function FromDateTime( )


    /**
      *
      * FromDateTime() sets the timestamp to the value represented by the datetime value
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm1 = new cDateTime( );
      *
      * $dtm2 = new cDateTime( $dtm1 );
      *
      * @param cDateTime $dt a cDateTime value
      *
      */


    public function FromDateTime( $dt ) {

        $this->m_time = $dt->m_time;

    }   // function FromDateTime( )

    /**
      *
      * FromTimestamp()  sets the timestamp to the value represented by the timestamp
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( 20178 );
      *
      * @param int $tm a cDate value
      *
      */

    public function FromTimestamp( $tm ) {

        $this->m_time = $tm;

    }   // function FromTimestamp( )

    /**
      *
      * FromAnyString( ) sets the timestamp to the value represented by a string. The method decides automatically, which format the user has chosen
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm1 = new cDateTime( '22.12.2016 05:00:00' );
      *
      * $dtm2 = new cDateTime( '12/22/2016 05:00:00' );
      *
      * $dtm3 = new cDateTime( '2016-12-22 05:00:00' );
      *
      * @param string $tm as a string representation of a timestamp
      *
      */

    public function FromAnyString( $str ) {

        if ( $pos = strpos( $str, '.' ) ) {
            if ( $pos > 0 ) {
                $this->FromDMY( $str );
            } else {
                echo "<br>cDateTime( ) : could not detect the formatting !";
            }
        } elseif ( $pos = strpos( $str, '/' ) ) {
            if ( $pos > 0 ) {
                $this->FromMDY( $str );
            } else {
                echo "<br>cDateTime( ) : could not detect the formatting !";
            }
        }  elseif ( $pos = strpos( $str, '-' ) ) {
            if ( $pos > 0 ) {
                $this->FromSQL( $str );
            } else {
                echo "<br>cDateTime( ) : could not detect the formatting !";
            }
        } else {
            echo "<br>cDateTime( ) : could not detect the formatting !";
        }

    }   // function FromAnyString( )

    /**
      *
      * sets the timestamp to the actual point of time.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '22.12.2016 05:00:00' );
      *
      * $dtm->SetNow( )
      *
      */

    public function SetNow( ) {

        $this->m_time = time( );

    }   // function SetToday( )

    /**
      *
      * FromDMY( ) sets the timestamp to the value represented by a string in Day/Month/Year notation.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm1 = new cDateTime( '22.12.2016 05:00:00' );
      *
      * @param string $str as a string representation of a timestamp
      *
      */


    public function FromDMY( $str ) {

        $day = $month = $year = $hour = $min = $sec = 0;

        sscanf( trim( $str ), '%d.%d.%d %d:%d:%d', &$day, &$month, &$year, &$hour, &$min, &$sec  );
        $this->m_time = mktime ( $hour, $min, $sec, $month, $day, $year);

    }   // function FromDMY( )

    /**
      *
      * FromMDY( ) sets the timestamp to the value represented by a string in Month/Day/Year notation.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm2 = new cDateTime( '12/22/2016 05:00:00' );
      *
      * @param string $str as a string representation of a timestamp
      *
      */


    public function FromMDY( $str ) {

        $day = $month = $year = $hour = $min = $sec = 0;

        sscanf( trim( $str ), '%d/%d/%d %d:%d:%d', &$month, &$day, &$year, &$hour, &$min, &$sec  );
        $this->m_time = mktime ( $hour, $min, $sec, $month, $day, $year);

    }   // function FromDMY( )

    /**
      *
      * FromSQL( ) sets the timestamp to the value represented by a string in SQL notation (year-month-day)
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm3 = new cDateTime( '2016-12-22 05:00:00' );
      *
      * @param string $str as a string representation of a timestamp
      *
      */


    public function FromSQL( $str ) {

        $day = $month = $year = $hour = $min = $sec = 0;

        sscanf( trim( $str ), '%d-%d-%d %d:%d:%d', &$year, &$month, &$day, &$hour, &$min, &$sec  );
        $this->m_time = mktime ( $hour, $min, $sec, $month, $day, $year);

    }   // function FromSQL( )


    /**
      *
      * AsDMY( ) returns the timestamp as a string in day.month.year notation
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * echo $dtm->AsDMY( );
      *
      * @param boolean $withouttime defaults to false. when true, then merely the date part of the timestamp will be returned
      * @return string the string representation of the timestamp
      *
      */

    public function AsDMY( $withouttime = false ) {

        $time = ( $withouttime ? '' : ' H:i:s');
        return date( "d.m.Y$time", $this->m_time );

    }   // function AsDMY( )

    /**
      *
      * AsMDY( ) returns the timestamp as a string in month/day/year notation
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * echo $dtm->AsMDY( );
      *
      * @param boolean $withouttime defaults to false. when true, then merely the date part of the timestamp will be returned
      * @return string the string representation of the timestamp
      *
      */


    public function AsMDY( $withouttime = false ) {

        $time = ( $withouttime ? '' : ' H:i:s');
        return date( "m/d/Y$time", $this->m_time );

    }   // function AsDMY( )


    /**
      *
      * AsSQL( ) returns the timestamp as a string in year-month-day notation
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * echo $dtm->AsSQL( );
      *
      * @param boolean $withouttime defaults to false. when true, then merely the date part of the timestamp will be returned
      * @return string the string representation of the timestamp
      *
      */


    public function AsSQL( ) {

        return date( 'Y-m-d H:i:s', $this->m_time );

    }   // function AsSQL( )

    /**
      *
      * SkipDays( ) adds $days days to the timestamp
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * $dtm->SkipDays( 14 );
      *
      * @param int $days the number of days to add / subtract from the timestamp
      *
      */


    public function SkipDays( $days ) {

        $this->m_time += ( $days * 60 * 60 * 24 );

    }   // function SkipDays(( )

    /**
      *
      * SkipSeconds( ) adds $secs seconds to the timestamp
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * $dtm->SkipSeconds( 11 * 60 * 60  );
      *
      * @param int $secs the number of seconds to add / subtract from the timestamp
      *
      */



    public function SkipSeconds( $secs ) {

        $this->m_time += ( $secs );

    }   // function SkipDays(( )

    /**
      *
      * Year( ) returns the four-digit year part of the timestamp
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * echo $dtm->Year( );
      *
      * @return integer the year part of the timestamp
      *
      */

    public function Year( ) {
        return (int) date( 'Y', $this->m_time );
    }   // function Year( );

    /**
      *
      * Month( ) returns the month part of the timestam
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * echo $dtm->Month( );
      *
      * @return integer the month part of the timestamp
      *
      */


    public function Month( ) {
        return (int) date( 'n', $this->m_time );
    }   // function Month( );

    /**
      *
      * Day( ) returns the day part of the timestamp
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * echo $dtm->Day( );
      *
      * @return integer the day part of the timestamp
      *
      */

    public function Day( ) {
        return (int) date( 'j', $this->m_time );
    }   // function Day( );

    /**
      *
      * Hour( ) returns the hour part of the timestamp
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * echo $dtm->Hour( );
      *
      * @return integer the hour part of the timestamp
      *
      */

    public function Hour( ) {
        return (int) date( 'G', $this->m_time );
    }   // function Day( );


    /**
      *
      * Minute( ) returns the minutes part of the timestamp
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * echo $dtm->Minute( );
      *
      * @return integer the minutes part of the timestamp
      *
      */

    public function Minute( ) {
        return (int) date( 'i', $this->m_time );
    }   // function Day( );

    /**
      *
      * Second( ) returns the seconds part of the timestamp
      *
      * Example:
      *
      * use libdatephp;
      *
      * $dtm = new cDateTime( '2016-12-22 05:00:00' );
      *
      * echo $dtm->Second( );
      *
      * @return integer the seconds part of the timestamp
      *
      */

    public function Second( ) {
        return (int) date( 's', $this->m_time );
    }   // function Day( );

}   // class cDateTime


?>