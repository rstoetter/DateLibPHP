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

class cPeriod {

    protected $oStart;
    protected $oEnd;

    public function GetFirst() {
        $obj = new cDate( $this->oStart );
        return $obj;
    }
    public function GetLast() {
        $obj = new cDate( $this->oEnd );
        return $obj;
    }

    public function SetToday( ) {
        $this->oStart = new cDate( );
        $this->oEnd = new cDate( );
    }   // public function SetToday()

    public function AsString( ) {

        assert( is_a($this->oStart,'libdatephp\cDate') );
        assert( is_a($this->oEnd,'libdatephp\cDate') );

        $s1 = $this->oStart->AsDMY();
        $s2 = $this->oEnd->AsDMY();

        $len = $this->GetLen( );

        return "[ $s1 - $s2 ] ($len)";

    }

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


    public function Set( $oFirst, $oLast ) {
            assert( (is_a( $oFirst, 'libdatephp\cDate') ) );
            assert( (is_a( $oLast, 'libdatephp\cDate') ) );

            // NOTE : TODO : Fehler : assert( $oFirst->le( $oLast ) );

            $this->oStart = $oFirst;
            $this->oEnd = $oLast;


    } // 	public function SetFirst


    public function SetFirst( $oFirst ) {
            assert( (is_a( $oFirst, 'libdatephp\cDate') ) );
            $this->Set( $oFirst, $this->oEnd );
    } // 	public function SetFirst


    public function SetLast( $oLast ) {
            assert( (is_a( $oLast, 'libdatephp\cDate') ) );
            $this->Set( $this->oStart, $oLast );
    } // public function SetLast

    public function SetLen( $len ) {

            $oLast = new cDate( $this->oStart);
            $oLast->Skip( $len -1 );    // NOTE : 1 Tag weniger

            $this->Set( $this->oStart, $oLast );
    } // public function SetLen


    public function IsValid( ) {
            assert( (is_a( $oStart, 'libdatephp\cDate') ) );
            assert( (is_a( $oEnd, 'libdatephp\cDate') ) );

            assert( $this->oStart->le( $this->oEnd ) );

    }	// public function IsValid( )


    public function GetDiff( ) {

        // liefert 0 wenn oStart == oEnd

        $diff = $this->oEnd->AsTimestamp() - $this->oStart->AsTimestamp();

        return ceil($diff / (60*60*24));


    }   // public function GetDiff()

    public function GetLen( ) {

        // liefert 1 wenn oStart == oEnd !

        return $this->GetDiff() +1;

    }   // public function GetLen( )



    public function GetWeekdayCount( ) {

        $o = new cDate($this->oStart);
        $count = 0;

        while ( $o->le($this->oEnd) ) {
            if ($o->IsWeekday()) $count++;
            $o->Inc( );
        }

        return $count;
    }   // public function GetWeekdayCount( )

    public function SameStart( $obj ) {
        if (is_a($obj,"cPeriod")) {
            return ($this->oStart->eq( $obj->GetFirst() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oStart->eq( $obj ) );
        }
    }

    public function SameEnd( $obj ) {
        if (is_a($obj,"cPeriod")) {
            return ($this->oEnd->eq( $obj->GetLast() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oEnd->eq( $obj ) );
        }
    }

    public function StartsBefore( $obj ) {
        if (is_a($obj,"cPeriod")) {
            return ($this->oStart->lt( $obj->GetFirst() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oStart->lt( $obj ) );
        }
    }

    public function StartsAfter( $obj ) {
        if (is_a($obj,"cPeriod")) {
            return ($this->oStart->gt( $obj->GetFirst() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oStart->gt( $obj ) );
        }
    }

    public function EndsBefore( $obj ) {
        if (is_a($obj,"cPeriod")) {
            return ($this->oEnd->lt( $obj->GetFirst() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oEnd->lt( $obj ) );
        }
    }

    public function EndsAfter( $obj ) {
        if (is_a($obj,"cPeriod")) {
            return ($this->oEnd->gt( $obj->GetFirst() ) );
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oEnd->gt( $obj ) );
        }
    }

    public function Contains( $obj ) {
        if (is_a($obj,"cPeriod")) {

            return ( ( $this->oStart->le( $obj->GetFirst() ) ) &&
                   ( $this->oEnd->ge( $obj->GetLast() )) );
        } elseif (is_a($obj,'libdatephp\cDate')) {

            return ($this->oStart->le( $obj ) ) &&
                    ( $this->oEnd->ge( $obj ) );
        }
    }

    public function Overlaps( $obj ) {

        if (is_a($obj,"cPeriod")) {
            return $obj->Contains($this->oStart) ||
                    $obj->Contains($this->oEnd);
        } elseif (is_a($obj,'libdatephp\cDate')) {
            return ($this->oStart->Contains( $obj ));
        }
    }

    public function GetN( $n ) {
        //
        // liefert den n-ten Tag der Periode
        // der erste Tag hat den Index 0
        //
        $obj = new cDate($this->oStart);
        $obj->Skip( $n );     // ??????????
        return $obj;
    }


    public function Adjust( $p ) {
        // &uuml;bernehme den Zeitraum von p
        if (is_a($p,"cPeriod")) {
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

    public function Skip( $i = 1 ) {
        $this->oStart->Skip( $i );
        $this->oEnd->Skip( $i );
    }   // public function Skip( )

    public function Inc(  ) {
        $this->Skip( 1 );
    }   // public function Inc( )

    public function Dec(  ) {
        $this->Skip( -1 );
    }   // public function Dec( )

    public function AddWeeks( $i = 1 ) {
        $this->oStart->AddWeeks( $i );
        $this->oEnd->AddWeeks( $i );

    }   // public function AddWeeks( )

    public function AddMonths( $i = 1 ) {
        $this->oStart->AddMonths( $i );
        $this->oEnd->AddMonths( $i );

    }   // public function AddMonths( )

    public function AddYears( $i = 1 ) {
        $this->oStart->AddYears( $i );
        $this->oEnd->AddYears( $i );

    }   // public function AddYears( )

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

    public function GoBOW( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoBOW();
        $this->SetLen( $len );

    }

    public function GoEOW( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoEOW();
        $this->SetLen( $len );

    }

    public function GoBOM( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoBOM();
        $this->SetLen( $len );

    }

    public function GoEOM( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoEOM();
        $this->SetLen( $len );

    }

    public function GoBOQ( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoBOQ();
        $this->SetLen( $len );

    }

    public function GoEOQ( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoEOQ();
        $this->SetLen( $len );

    }

    public function GoBOY( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoBOY();
        $this->SetLen( $len );

    }

    public function GoEOY( ) {
        //
        $len = $this->GetLen();
        $this->oStart->GoEOY();
        $this->SetLen( $len );

    }

    public function PrintOn( $fptr ) {

        $this->oStart->PrintOn( $fptr );
        $this->oEnd->PrintOn( $fptr );
    }

    public function ScanFrom( $fptr ) {

        $this->oStart->ScanFrom( $fptr ) ;
        $this->oEnd->ScanFrom( $fptr ) ;
    }

    // ===========================================================

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

    public function NthDay( ) {

        // Endtermin f&auml;llt auf den n-ten Tag

        return $this->GetLen();
    }

    public function JustOneDay() {
        // Zeitraum umfa&szlig;t nur einen Tag
        return $this->oStart.eq($this->oEnd);
    }

}	// class cPeriod


?>