<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cPeriod.class.php
//  Language      : php
//  Description   : Die Klasse 'cPeriod' implementiert einen bestimmten Zeitraum
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
//	class cPeriod
//		public method AddMonths($i=1)
//		public method AddWeeks($i=1)
//		public method AddYears($i=1)
//		public method Adjust($p)
//		public method AsString()
//		public method Contains($obj)
//		public method Dec()
//		public method EndsAfter($obj)
//		public method EndsBefore($obj)
//		public method ForEachDate($func)
//		public method ForEachWeekday($func)
//		public method GetDiff()
//		public method GetFirst()
//		public method GetLast()
//		public method GetLen()
//		public method GetN($n)
//		public method GetWeekdayCount()
//		public method GoBOM()
//		public method GoBOQ()
//		public method GoBOW()
//		public method GoBOY()
//		public method GoEOM()
//		public method GoEOQ()
//		public method GoEOW()
//		public method GoEOY()
//		public method Inc()
//		public method IsValid()
//		public method JustOneDay()
//		public method NthDay()
//		public method NthMonth()
//		public method NthQuarter()
//		public method NthWeek()
//		public method NthYear()
//		public method Overlaps($obj)
//		public method PassedMonths()
//		public method PassedQuarters()
//		public method PassedWeeks()
//		public method PassedYears()
//		public method PrintOn($fptr)
//		public method SameEnd($obj)
//		public method SameStart($obj)
//		public method ScanFrom($fptr)
//		public method Set($oFirst,$oLast)
//		public method SetFirst($oFirst)
//		public method SetLast($oLast)
//		public method SetLen($len)
//		public method SetToday()
//		public method Skip($i=1)
//		public method StartsAfter($obj)
//		public method StartsBefore($obj)
//		public method cPeriod($a=-1,$b=-1,$c=-1,$d=-1,$e=-1,$f=-1)
//		protected var $oEnd
//		protected var $oStart
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?><?php

/*
TODO: alle Funktionen mit @see ausstatten
*/

/*

		class cPeriod
		=============

    // ============[ Konstruktoren
    public function cPeriod()
    public function cPeriod( cDate )
    public function cPeriod( int timestamp )
    public function cPeriod( int timestamp, int timestamp )
    public function cPeriod( cDate start, cDate end )
    public function cPeriod( cDate start, int days )
    public function cPeriod( int month, int day, int year)
    public function cPeriod( int month, int day, int year, int days)
    public function cPeriod( int month, int day, int year, int month, int day, int year)

    // ============[ Initialisieren

    public function Set( $oFirst, $oLast ) {
    public function SetFirst( $oFirst ) {
    public function SetLast( $oLast ) {
    public function SetLen( $len ) {
    public function SetToday()

    public function Adjust( cPeriod $p) {
        // &uuml;bernehme den Zeitraum von $p
    public function Adjust( cDate ) {

    // ============[ Auslesen

    public function GetN( $n ) {
    // liefert den n-ten Tag der Periode
    // der erste Tag hat den Index 0

    // ============[ Konvertierung

    public function AsString( )

    // ============[ Diagnose

    public function GetLen( ) {
        // liefert 1 wenn oStart == oEnd
    public function GetDiff( ) {
        // liefert 0 wenn oStart == oEnd
    public function GetWeekdayCount( )
        // liefert die Wochentage (Mo-Fr) in der Zeitspanne

    public function IsValid( ) {

    public function JustOneDay() {
        // Zeitraum umfa&szlig;t nur einen Tag

    public function PassedMonths( ) {
    public function PassedQuarters( ) {
        // Anzahl der vergangenen/abgelaufenen *vollen* Quartale
    public function PassedWeeks( ) {
        // Anzahl der vergangenen/abgelaufenen *vollen* Wochen
    public function PassedYears( ) {
        // Anzahl der vergangenen/abgelaufenen *vollen* Jahre

    public function NthMonth( ) {
        // Endtermin liegt im n-ten Monat
    public function NthQuarter( ) {
        // Endtermin liegt im n-ten Quartal
    public function NthWeek( ) {
        // Endtermin liegt in der n-ten Woche
    public function NthYear( ) {
        // Endtermin liegt im n-ten Jahr
    public function NthDay( ) {
        // Endtermin f&auml;llt auf den n-ten Tag

    // ============[ Vergleich

    public function SameStart( cPeriod ) {
    public function SameStart( cDate ) {
    public function SameEnd( cPeriod ) {
    public function SameEnd( cDate ) {
    public function StartsBefore( cPeriod ) {
    public function StartsBefore( cDate ) {
    public function StartsAfter( cPeriod ) {
    public function StartsAfter( cDate ) {
    public function EndsBefore( cPeriod ) {
    public function EndsBefore( cDate ) {
    public function EndsAfter( cPeriod ) {
    public function EndsAfter( cDate ) {
    public function Contains( cPeriod ) {
    public function Contains( cDate ) {
    public function Overlaps( cPeriod ) {
    public function Overlaps( cDate ) {

    // ============[ Spr&uuml;nge

    public function Skip( $i = 1 ) {
    public function Inc(  ) {
    public function Dec(  ) {
    public function AddWeeks( $i = 1 ) {
    public function AddMonths( $i = 1 ) {
    public function AddYears( $i = 1 ) {

    public function GoBOW( ) {
    public function GoEOW( ) {
    public function GoBOM( ) {
    public function GoEOM( ) {
    public function GoBOQ( ) {
    public function GoEOQ( ) {
    public function GoBOY( ) {
    public function GoEOY( ) {

    // ============[ Massenoperationen

    public function ForEachDate( $func ) {
    public function ForEachWeekday( $func ) {

    // ============[ Serialisierung

    public function PrintOn( $fptr ) {
    public function ScanFrom( $fptr ) {



*/

// require_once("cDate.class.php");

namespace libdatephp;


/**
  *
  * The class cPeriod represents a period of time with a starting and an ending date
  *
  * @author Rainer Stötter
  * @copyright 2010-2017 Rainer Stötter
  * @license MIT
  *
  */

class cPeriod {

    /**
      * The starting date of the period of time
      *
      * @var $oStart cDate
      */

    protected $oStart;


    /**
      * The ending date of the period of time
      *
      * @var $oStart cDate
      */

    protected $oEnd;


    /**
      *
      * GetFirst() returns the starting date of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p->GetFirst( )->AsSQL( );
      *
      * @return cDate a cDate value
      *
      */

    public function GetFirst() {
        $obj = new cDate( $this->oStart );
        return $obj;
    }



    /**
      *
      * GetLast() returns the ending date of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p->GetLast( )->AsSQL( );
      *
      * @return cDate a cDate value
      *
      */

    public function GetLast() {
        $obj = new cDate( $this->oEnd );
        return $obj;
    }


    /**
      *
      * SetToday() sets the starting and the ending date of the period of time to the actual dae
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p->SetToday( );
      *
      *
      *
      */

    public function SetToday( ) {
        $this->oStart = new cDate( );
        $this->oEnd = new cDate( );
    }   // public function SetToday()



    const Representation_DMY = 0;
    const Representation_MDY = 1;
    const Representation_SQL = 2;

    /**
      *
      * AsString() returns a string of the period of time in day.month.year notation.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p->AsString( );
      *
      * @param int $representation how the output string should be formatted - defaults to self::Representation_DMY ( DMY
      * notation). Can be set to Representation_MDY or Representation_SQL, too
      *
      * @return string a string with the dates of the period of time
      */

    public function AsString( $representation = self::Representation_DMY ) {

        assert( is_a($this->oStart,'libdatephp\cDate') );
        assert( is_a($this->oEnd,'libdatephp\cDate') );

        if ( $representation === self::Representation_DMY ) {
	    $s1 = $this->oStart->AsDMY();
	    $s2 = $this->oEnd->AsDMY();
	} elseif ( $representation === self::Representation_MDY ) {
	    $s1 = $this->oStart->AsMDY();
	    $s2 = $this->oEnd->AsMDY();
	} elseif ( $representation === self::Representation_SQL ) {
	    $s1 = $this->oStart->AsSQL();
	    $s2 = $this->oEnd->AsSQL();
	}

        $len = $this->GetLen( );

        return "[ $s1 - $s2 ] ($len)";

    }

    /**
      *
      *  The constructor for the cPeriod class
      *
      *  $p = new cPeriod( 11, 22, 2016, 11, 23, 2016 );
      *  from month, day, year, month, day, year
      *
      *  $p = new cPeriod(  );
      *  a period with today as start and length one day
      *
      *  $dtm = new cPeriod( new cDate( 11, 22, 2016 ) );
      *  one day long period with the date as starting date
      *
      *
      *  $dtm = new cPeriod( new cDate( 11, 22, 2016 ), 20 );
      *  20 days from the date as starting date
      *
      *  $dtm = new cPeriod( 20516, 30517 );
      *  from two timestamps
      *
      *  $dtm = new cPeriod( new cDate( 11, 22, 2016 ), new cDate( 11, 25, 2016 ) );
      *  from two dates
      *
      *  $dtm = new cPeriod( 11, 23, 2016 );
      *  from a date
      *
      *  $dtm = new cPeriod( 11, 23, 2016, 20 );
      *  20 days from a date
      *
      * @param mixed $a can be an int as month or a timestamp or a cDate
      * @param mixed $b can be a date or an int as day or a cDate
      * @param int $c the year of the first date
      * @param int $d the month of the ending date
      * @param int $e the day of the ending date
      * @param int $f the year of the ending date
      * @return cPeriod
      */

    public function __construct( $a = -1, $b = -1, $c = -1, $d = -1, $e = -1 , $f = -1) {

            if  ( is_int( $a ) && is_int( $b ) && is_int( $c ) && is_int( $d ) && is_int( $e ) && is_int( $f ) &&

		( $a == -1 && $b == -1 && $c == -1 && $d == -1 && $e == -1 && $f == -1) ) {
                    $this->SetToday( );
            } elseif
		( is_int( $b ) && is_int( $c ) && is_int( $d ) && is_int( $e ) && is_int( $f ) &&
		( $b == -1 && $c == -1 && $d == -1 && $e == -1 && $f == -1 ) ) {

                    if ( is_int( $a ) ) {
                            $o = new cDate( $a );
                            $this->SetFirst( $o );
                            $this->SetLast( $o );
                    } elseif ( is_a( $a, "libdatephp\cDate") ) {
                            $this->SetFirst( $a );
                            $this->SetLast( $a );
                    }

            } elseif
		    ( is_int( $c ) && is_int( $d ) && is_int( $e ) && is_int( $f ) &&
		    ( $c == -1 && $d == -1 && $e == -1 && $f == -1 ) ) {

                    if ( is_int( $a ) && is_int( $b ) ) {

                            $o1 = new cDate( $a );
                            $o2 = new cDate( $b );
                            $this->Set( $o1, $o2 );

                    } elseif ( is_a( $a, "libdatephp\cDate") ) {
                            if ( is_a( $b, 'libdatephp\cDate') ) {
                                    $this->Set( $a, $b );
                            } elseif ( is_int( $b ) ) {
                                    $this->Set( $a, $a );
                                    $this->SetLen( $b );
                            }
                    }

            } elseif
		  ( is_int( $d ) && is_int( $e ) && is_int( $f ) &&
		    ( $d == -1 && $e == -1 && $f == -1 ) ) {
                    $o = new cDate( $a, $b, $c );
                    $this->Set( $o, $o );
            } elseif
		    ( is_int( $e ) && is_int( $f ) &&
		    ( $e == -1 && $f == -1 ) ) {
                    $o = new cDate( $a, $b, $c );
                    $this->SetFirst( $o );
                    $this->SetLen( $d );
            } else {
                    $o1 = new cDate( $a, $b, $c );
                    $o2 = new cDate( $d, $e, $f );
                    $this->Set( $o1, $o2 );
            }

    } // public function cPeriod


    /**
      *
      * Set() changes the values of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p->Set( new cDate( 11, 23, 2017 ), new cDate( 11, 27, 2017 ) );
      *
      * @param cDate $oFirst the starting point of the period of time
      * @param cDate $oLast the ending date of the period of time
      *
      */


    public function Set( $oFirst, $oLast ) {
            assert( (is_a( $oFirst, 'libdatephp\cDate') ) );
            assert( (is_a( $oLast, 'libdatephp\cDate') ) );

            // NOTE : TODO : Fehler : assert( $oFirst->le( $oLast ) );

            $this->oStart = $oFirst;
            $this->oEnd = $oLast;


    } // 	public function SetFirst


    /**
      *
      * SetFirst() sets the starting date of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p->SetFirst( new cDate( 11, 23, 2017 ) );
      *
      * @param cDate $oFirst the new starting date of the period of time
      *
      */

    public function SetFirst( $oFirst ) {
            assert( (is_a( $oFirst, 'libdatephp\cDate') ) );
            $this->Set( $oFirst, $this->oEnd );
    } // 	public function SetFirst( )

    /**
      *
      * SetFirst() sets the ending date of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p->SetLast( new cDate( 12, 23, 2017 ) );
      *
      * @param cDate $oLaFirst the new ending date of the period of time
      *
      */


    public function SetLast( $oLast ) {
            assert( (is_a( $oLast, 'libdatephp\cDate') ) );
            $this->Set( $this->oStart, $oLast );
    } // public function SetLast( )

    /**
      *
      * SetLen() sets the ending date of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p->SetLen( 14 );
      *
      * @param int $len the new ending date of the period of time
      *
      */


    public function SetLen( $len ) {

            $oLast = new cDate( $this->oStart);
            $oLast->Skip( $len -1 );    // NOTE : 1 Tag weniger

            $this->Set( $this->oStart, $oLast );

    } // public function SetLen

    /**
      *
      * IsValid() checks, whether the internal settings are valid
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * if ( $p->IsValid( ) ) do_something( );
      *
      * @return Boolean true, if the internal settings of cPeriod are okay.
      *
      */

    public function IsValid( ) {

            assert( (is_a( $oStart, 'libdatephp\cDate') ) );
            assert( (is_a( $oEnd, 'libdatephp\cDate') ) );

            assert( $this->oStart->le( $this->oEnd ) );

    }	// public function IsValid( )


    /**
      *
      * GetDiff() returns the difference between the starting and the ending date
      * The function returns 0, if both dates have the same date
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p->GetDiff( );
      *
      * @return int the difference of the period of time in days
      * @see GetLen
      *
      */


    public function GetDiff( ) {

        // liefert 0 wenn oStart == oEnd

        $diff = $this->oEnd->AsTimestamp() - $this->oStart->AsTimestamp();

        return ceil($diff / (60*60*24));


    }   // public function GetDiff()

    /**
      *
      * GetLen() returns the days between the starting and the ending date
      * The function returns 1, if both dates have the same date
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p->GetLen( );
      *
      * @return int the length of the period of time in days
      * @see GetDiff
      *
      */


    public function GetLen( ) {

        // liefert 1 wenn oStart == oEnd !

        return $this->GetDiff() +1;

    }   // public function GetLen( )

    /**
      *
      * GetWeekdayCount() returns the number of weekdays between the starting and the ending date
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p->GetWeekdayCount( );
      *
      * @return int the number of weekdays in the period of time in days
      *
      */


    public function GetWeekdayCount( ) {

        $o = new cDate($this->oStart);
        $count = 0;

        while ( $o->le($this->oEnd) ) {
            if ($o->IsWeekday()) $count++;
            $o->Inc( );
        }

        return $count;
    }   // public function GetWeekdayCount( )

    /**
      *
      * SameStart() returns true, if $obj has the same starting date
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $p2 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 23, 2016 ) );
      *
      * if ( $p1->SameStart( $p2 ) ) do_something( );
      *
      * @param mixed $obj the other period of time or a cDate
      * @return boolean true if both starting dates are equal
      *
      */

    public function SameStart( $obj ) {
        if (is_a($obj,"\libdatephp\cPeriod")) {
            return ($this->oStart->eq( $obj->GetFirst() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oStart->eq( $obj ) );
        }
    }


    /**
      *
      * SameEnd() returns true, if $obj has the same ending date
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $p2 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 23, 2016 ) );
      *
      * if ( $p1->SameEnd( $p2 ) ) do_something( );
      *
      * @param mixed $obj the other period of time or a cDate
      * @return boolean true if both ending dates are equal
      *
      */

    public function SameEnd( $obj ) {
        if (is_a($obj,"\libdatephp\cPeriod")) {
            return ($this->oEnd->eq( $obj->GetLast() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oEnd->eq( $obj ) );
        }
    }

    /**
      *
      * StartsBefore() returns true, if $obj starts after the starting date of the internal representation
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $p2 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 23, 2016 ) );
      *
      * if ( $p1->StartsBefore( $p2 ) ) do_something( );
      *
      * @param mixed $obj the other period of time or a cDate
      * @return boolean true if $obj starts after the starting date
      *
      */

    public function StartsBefore( $obj ) {
        if (is_a($obj,"\libdatephp\cPeriod")) {
            return ($this->oStart->lt( $obj->GetFirst() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oStart->lt( $obj ) );
        }
    }

    /**
      *
      * StartsAfter() returns true, if $obj starts before the starting date of the internal representation
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $p2 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 23, 2016 ) );
      *
      * if ( $p1->StartsAfter( $p2 ) ) do_something( );
      *
      * @param mixed $obj the other period of time or a cDate
      * @return boolean true if $obj starts before the starting date
      *
      */


    public function StartsAfter( $obj ) {
        if (is_a($obj,"libdatephp\cPeriod")) {
            return ($this->oStart->gt( $obj->GetFirst() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oStart->gt( $obj ) );
        }
    }

    /**
      *
      * EndsBefore() returns true, if $obj ends after the ending date of the internal representation
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $p2 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 23, 2016 ) );
      *
      * if ( $p1->EndsBefore( $p2 ) ) do_something( );
      *
      * @param mixed $obj the other period of time or a cDate
      * @return boolean true if $obj ends after the starting date
      *
      */


    public function EndsBefore( $obj ) {
        if (is_a($obj,"libdatephp\cPeriod")) {
            return ($this->oEnd->lt( $obj->GetFirst() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oEnd->lt( $obj ) );
        }
    }

    /**
      *
      * EndsAfter() returns true, if $obj ends before the starting date of the internal representation
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $p2 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 23, 2016 ) );
      *
      * if ( $p1->EndsAfter( $p2 ) ) do_something( );
      *
      * @param mixed $obj the other period of time or a cDate
      * @return boolean true if $obj ends before the starting date
      *
      */



    public function EndsAfter( $obj ) {
        if (is_a($obj,"libdatephp\cPeriod")) {
            return ($this->oEnd->gt( $obj->GetFirst() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oEnd->gt( $obj ) );
        }
    }


    /**
      *
      * Contains() returns true, if $obj is part of the managed period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $p2 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 23, 2016 ) );
      *
      * if ( $p1->Contains( $p2 ) ) do_something( );
      *
      * @param mixed $obj the other period of time or a cDate
      * @return boolean true if the managed period of time contains $obj
      *
      */


    public function Contains( $obj ) {
        if (is_a($obj,"libdatephp\cPeriod")) {

            return ( ( $this->oStart->le( $obj->GetFirst() ) ) &&
                   ( $this->oEnd->ge( $obj->GetLast() )) );
        } elseif (is_a($obj,'libdatephp\cDate')) {

            return ($this->oStart->le( $obj ) ) &&
                    ( $this->oEnd->ge( $obj ) );
        }
    }

    /**
      *
      * Overlaps() returns true, if $obj overlaps of the managed period of time. Overlapping means, that a part of $obj
      * lies within the boundaries of the managed period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $p2 = new cPeriod( new cDate( 11, 24, 2016 ), new cDate( 11, 27, 2016 ) );
      *
      * if ( $p1->Overlaps( $p2 ) ) do_something( );
      *
      * @param mixed $obj the other period of time or a cDate
      * @return boolean true if the managed period overlaps $obj
      *
      */


    public function Overlaps( $obj ) {

        if (is_a($obj,"\libdatephp\cPeriod")) {
            return $obj->Contains($this->oStart) ||
                    $obj->Contains($this->oEnd);
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oStart->Contains( $obj ));
        }
    }

    /**
      *
      * GetN() returns the n-th day of the managed period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $p2 = new cPeriod( new cDate( 11, 24, 2016 ), new cDate( 11, 27, 2016 ) );
      *
      * echo $p1->GetN( 3 );
      *
      * @param int $n the zero based index of the wanted day
      * @return cDate the nth day of the managed period of time
      *
      */


    public function GetN( $n ) {
        //
        // liefert den n-ten Tag der Periode
        // der erste Tag hat den Index 0
        //
        $obj = new cDate($this->oStart);
        $obj->Skip( $n );     // ??????????
        return $obj;
    }

    /**
      *
      * Adjust() sets the boundaries of $p
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $p2 = new cPeriod( new cDate( 11, 24, 2016 ), new cDate( 11, 27, 2016 ) );
      *
      * echo $p1->Adjust( $p2 );
      *
      * @param mixed $p the cDate or cPeriod where the new setting should be taken from
      *
      */


    public function Adjust( $p ) {
        // &uuml;bernehme den Zeitraum von p
        if (is_a($p,"\libdatephp\cPeriod")) {
            $d1 = new cDate($p->GetFirst());
            $d2 = new cDate($p->GetLast());
        } elseif (is_a($p,'libdatephp\cDate')) {
            $d1 = new cDate($p);
            $d2 = new cDate($p);
        } else {
            die;
        }

        $this->Set( $d1, $d2 );
    }


    // ===========================================================

    /**
      *
      * Skip() moves the boundaries for $i days. Starting date and ending date are moved
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->Skip( -14 );
      *
      * @param int $i how much days the managed period of time should be moved, can be negative. $i defaults to 1 day
      *
      */

    public function Skip( $i = 1 ) {
        $this->oStart->Skip( $i );
        $this->oEnd->Skip( $i );
    }   // public function Skip( )

    /**
      *
      * Inc() increases the boundaries for 1 day. Starting date and ending date are moved
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->Inc( );
      *
      */



    public function Inc(  ) {
        $this->Skip( 1 );
    }   // public function Inc( )

    /**
      *
      * Dec() decreases the boundaries for 1 day. Starting date and ending date are moved
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->Dec( );
      *
      */



    public function Dec(  ) {
        $this->Skip( -1 );
    }   // public function Dec( )

    /**
      *
      * AddWeeks() adds $i weeks to the boundaries. Starting date and ending date are moved
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->AddWeeks( 4 );
      *
      * @param int $i how much weeks the managed period of time should be moved, can be negative. $i defaults to 1
      */


    public function AddWeeks( $i = 1 ) {
        $this->oStart->AddWeeks( $i );
        $this->oEnd->AddWeeks( $i );

    }   // public function AddWeeks( )

    /**
      *
      * AddMonths() adds $i months to the boundaries. Starting date and ending date are moved
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->AddMonths( 3 );
      *
      * @param int $i how much months the managed period of time should be moved, can be negative. $i defaults to 1
      */


    public function AddMonths( $i = 1 ) {
        $this->oStart->AddMonths( $i );
        $this->oEnd->AddMonths( $i );

    }   // public function AddMonths( )

    /**
      *
      * AddYears() adds $i years to the boundaries. Starting date and ending date are moved
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->AddYears( 3 );
      *
      * @param int $i how much years the managed period of time should be moved, can be negative. $i defaults to 1
      */


    public function AddYears( $i = 1 ) {
        $this->oStart->AddYears( $i );
        $this->oEnd->AddYears( $i );

    }   // public function AddYears( )

    /**
      *
      * ForEachDate() execute the function $func on each date in the managed period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * function myfunc( $dt ) {
      *   echo "\n" . $dt->AsSQL( );
      * }
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $func = "myfunc";
      * $p1->ForEachDate( $func );
      *
      * @param string $func the function pointer
      * @see ForEachWeekday
      *
      */


    public function ForEachDate( $func ) {
        //
        // f&uuml;hrt die Funktion $func aus und &uuml;bergibt ein Datum vom
        // Typ cDate als Parameter
        //

        // function ForEachDateFunc( $date) { echo $date->AsDMY() . "<br>"; }
        // $oPeriod->ForEachDate( ForEachDateFunc );

        for ($i=0; $i <$this->GetLen() ; $i++) {
            $obj = new cDate($this->GetN( $i ));
            $func( $obj );
        }
    }

    /**
      *
      * ForEachDate() execute the function $func on each weekday in the managed period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * function myfunc( $dt ) {
      *   echo "\n" . $dt->AsSQL( );
      * }
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      * $func = "myfunc";
      * $p1->ForEachDate( $func );
      *
      * @param string $func the function pointer
      * @see ForEachDate
      */


    public function ForEachWeekday( $func ) {
        //
        // f&uuml;hrt die Funktion $func aus und &uuml;bergibt ein Datum vom
        // Typ cDate als Parameter
        //
        for ($i=0; $i <$this->GetLen() ; $i++) {
            $obj = new cDate($this->GetN( $i ));
            if ($obj->IsWeekday()) {
                $func( $obj );
            }
        }
    }

    /**
      *
      * GoBOW() moves the whole managed period of time to the beginning of the week of the starting date
      * starting and ending date are changed  and the length of the period of time will be kept.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p1->GoBOW( );
      *
      */


    public function GoBOW( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoBOW();
        $this->SetLen( $len );

    }

    /**
      *
      * GoEOW() moves the whole managed period of time to the end of the week of the starting date
      * starting and ending date are changed  and the length of the period of time will be kept.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p1->GoEOW( );
      *
      */


    public function GoEOW( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoEOW();
        $this->SetLen( $len );

    }

    /**
      *
      * GoBOM() moves the whole managed period of time to the beginning of the month (the first of the month ) of the
      * starting date. Starting and ending date are changed  and the length of the period of time will be kept.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p1->GoBOM( );
      *
      */


    public function GoBOM( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoBOM();
        $this->SetLen( $len );

    }

    /**
      *
      * GoEOM() moves the whole managed period of time to the end of the month (the last day of the month ) of the
      * starting date. Starting and ending date are changed  and the length of the period of time will be kept.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p1->GoEOM( );
      *
      */


    public function GoEOM( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoEOM();
        $this->SetLen( $len );

    }

    /**
      *
      * GoBOQ() moves the whole managed period of time to the beginning of the quarter (the first of the month ) of the
      * starting date. Starting and ending date are changed  and the length of the period of time will be kept.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p1->GoBOQ( );
      *
      */


    public function GoBOQ( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoBOQ();
        $this->SetLen( $len );

    }

    /**
      *
      * GoEOQ() moves the whole managed period of time to the end of the quarter (the last day of the month ) of the
      * starting date. Starting and ending date are changed  and the length of the period of time will be kept.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p1->GoEOQ( );
      *
      */



    public function GoEOQ( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoEOQ();
        $this->SetLen( $len );

    }

    /**
      *
      * GoBOY() moves the whole managed period of time to the beginning of the year (the first January ) of the
      * starting date. Starting and ending date are changed and the length of the period of time will be kept.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p1->GoBOY( );
      *
      */



    public function GoBOY( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoBOY();
        $this->SetLen( $len );

    }

    /**
      *
      * GoEOY() moves the whole managed period of time to the end of the year (the 31th December ) of the
      * starting date. Starting and ending date are changed and the length of the period of time will be kept.
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $p1->GoEOY( );
      *
      */


    public function GoEOY( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoEOY();
        $this->SetLen( $len );

    }

    /**
      *
      * PrintOn() writes the starting and the ending date to the file pointer $fptr
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $fptr = fopen( 'test.txt', 'w+' );
      *
      * $p1->printOn( $fptr );
      *
      * @param resource $fptr the file handle of the output file
      * @see ScanFrom
      */


    public function PrintOn( $fptr ) {

	assert( is_resource( $fptr ) );

        $this->oStart->PrintOn( $fptr );
        $this->oEnd->PrintOn( $fptr );
    }

    /**
      *
      * SanPrintOn() reads the starting and the ending date from the file pointer $fptr
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * $fptr = fopen( 'test.txt', 'r' );
      *
      * $p1->ScanFrom( $fptr );
      *
      * @param resource $fptr the file handle of the input file
      * @see printOn
      */


    public function ScanFrom( $fptr ) {

	assert( is_resource( $fptr ) );

        $this->oStart->ScanFrom( $fptr ) ;
        $this->oEnd->ScanFrom( $fptr ) ;
    }

    // ===========================================================

    /**
      *
      * PassedMonths() returns the full (!) months between starting date and ending date
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->PassedMonths( );
      *
      * @return int the number of full months
      * @see PassedQuarters
      * @see PassedWeeks
      * @see PassedYears
      */


    public function PassedMonths( ) {

        // Anzahl der vergangenen/abgelaufenen *vollen* Monate

        $start = new cDate($this->oStart);
        $end = new cDate($this->oEnd);

        $count = 0;

        do {
            $start->GoEOM();
            $start->Skip();
            $count ++;
        } while ($start->lt($end) );

        return $count -1;
    }

    /**
      *
      * PassedQuarters() returns the full (!) quarters between starting date and ending date
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->PassedQuarters( );
      *
      * @return int the number of full quarters
      * @see PassedMonths
      * @see PassedWeeks
      * @see PassedYears
      */


    public function PassedQuarters( ) {

        // Anzahl der vergangenen/abgelaufenen *vollen* Quartale

        $start = new cDate($this->oStart);
        $end = new cDate($this->oEnd);

        $count = 0;

        do {
            $start->GoEOQ();
            $start->Skip();
            $count ++;
        } while ($start->lt($end) );

        return $count -1;
    }

    /**
      *
      * PassedWeeks() returns the full (!) weeks between starting date and ending date
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->PassedWeeks( );
      *
      * @return int the number of full weeks
      * @see PassedQuarters
      * @see PassedMonths
      * @see PassedYears
      */


    public function PassedWeeks( ) {

        // Anzahl der vergangenen/abgelaufenen *vollen* Wochen

        $start = new cDate($this->oStart);
        $end = new cDate($this->oEnd);

        $count = 0;

        do {
            $start->GoEOW();
            $start->Skip();
            $count ++;
        } while ($start->lt($end) );

        return $count -1;
    }

    /**
      *
      * PassedYears() returns the full (!) years between starting date and ending date
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->PassedYears( );
      *
      * @return int the number of full years
      * @see PassedQuarters
      * @see PassedWeeks
      * @see PassedMonths
      */


    public function PassedYears( ) {

        // Anzahl der vergangenen/abgelaufenen *vollen* Jahre

        $start = new cDate($this->oStart);
        $end = new cDate($this->oEnd);

        $count = 0;

        do {
            $start->AddYears();
            // $start->Skip();
            $count ++;
        } while ($start->lt($end) );

        return $count -1;
    }

    // ===========================================================


    /**
      *
      * NthMonth() returns the number of the month the ending date is calculated from the beginning of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->NthMonth( );
      *
      * @return int the number of full months
      * @see NthQuarter
      * @see NthWeek
      * @see NthYear
      * @see NthDay
      */


   public function NthMonth( ) {

        // Endtermin liegt im n-ten Monate

        $start = new cDate($this->oStart);
        $end = new cDate($this->oEnd);

        $count = 0;

        do {
            $start->GoEOM();
            $start->Skip();
            $count ++;
        } while ($start->lt($end) );

        return $count;
    }

    /**
      *
      * NthQuarter() returns the number of the quarter the ending date is calculated from the beginning of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->NthQuarter( );
      *
      * @return int the number of full quarters
      * @see NthMonth
      * @see NthWeek
      * @see NthYear
      * @see NthDay
      */

    public function NthQuarter( ) {

        // Endtermin liegt im n-ten Quartal

        $start = new cDate($this->oStart);
        $end = new cDate($this->oEnd);

        $count = 0;

        do {
            $start->GoEOQ();
            $start->Skip();
            $count ++;
        } while ($start->lt($end) );

        return $count;
    }

    /**
      *
      * NthWeek() returns the number of the week the ending date is calculated from the beginning of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->NthWeek( );
      *
      * @return int the number of full weeks
      * @see NthQuarter
      * @see NthMonth
      * @see NthYear
      * @see NthDay
      */

    public function NthWeek( ) {

        // Endtermin liegt in der n-ten Woche

        $start = new cDate($this->oStart);
        $end = new cDate($this->oEnd);

        $count = 0;

        do {
            $start->GoEOW();
            $start->Skip();
            $count ++;
        } while ($start->lt($end) );

        return $count;
    }

    /**
      *
      * NthYear() returns the number of the year the ending date is calculated from the beginning of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->NthYear( );
      *
      * @return int $the number of full years
      * @see NthQuarter
      * @see NthWeek
      * @see NthMonth
      * @see NthDay
      */

    public function NthYear( ) {

        // Endtermin liegt im n-ten Jahr

        $start = new cDate($this->oStart);
        $end = new cDate($this->oEnd);

        $count = 0;

        do {
            $start->AddYears();
            // $start->Skip();
            $count ++;
        } while ($start->lt($end) );

        return $count;
    }

    /**
      *
      * NthDay() returns the number of the day the ending date is calculated from the beginning of the period of time
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * echo $p1->NthDay( );
      *
      * @return int the number of full days
      * @see NthQuarter
      * @see NthWeek
      * @see NthYear
      *
      */

    public function NthDay( ) {

        // Endtermin f&auml;llt auf den n-ten Tag

        return $this->GetLen();
    }

    /**
      *
      * JustOneDay() returns true, if the starting and the ending date are the same
      *
      * Example:
      *
      * use libdatephp;
      *
      * $p1 = new cPeriod( new cDate( 11, 23, 2016 ), new cDate( 11, 25, 2016 ) );
      *
      * if ( $p1->JustOneDay( ) ) do_something( );
      *
      * @return boolean true, if the period of time is one day long
      *
      */

    public function JustOneDay() {
        // Zeitraum umfa&szlig;t nur einen Tag
        return $this->oStart.eq($this->oEnd);
    }

}	// class cPeriod


?>