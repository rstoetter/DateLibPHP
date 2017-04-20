<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategySimpleDate.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategySimpleDate' erweitert 'cDateStrategy' um eine einfache einmalige Terminvorgabe
//  Project       : libdatephp
//  Project Site  : https://github.com/rstoetter/libdatephp
//  Project wiki  : https://github.com/rstoetter/libdatephp/wiki
//  Created by    : Rainer Stötter ( rstoetter@users.sourceforge.net )
//  Copyright (c) : 2007-2017, Rainer Stötter, All rights reserved
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
//		_POST['s1_date']
//		_POST['strategy']
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
//	class cDateStrategySimpleDate
//		public method AsString()
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetDate()
//		public method GetFirstDate()
//		public method GetFollower($dt)
//		public method GetNextTerminDate($datestart,$dateisfirst=true)
//		public method GetPrevTerminDate($datestart,$dateisfirst=true)
//		public method IsTerminDate($dateObj)
//		public method IsValid()
//		public method Reset()
//		public method SetDate($dateObj)
//		public method cDateStrategySimpleDate($str="")
//		protected var $dateObj
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?><?php

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategySimpleDate
////////////////////////////////////////////////////////////////////////////////////

namespace libdatephp;

class cDateStrategySimpleDate extends cDateStrategy {

    // kein Verrutschen bei Samstag / Sonntag / Feiertag , da es sich ja um einen fixen Termin handelt

    protected $dateObj;

    public function cDateStrategySimpleDate( $str = "" ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if (strlen( $str )==0) {
                $this->Reset();
            } else {
                $this->FromString( $str ) ;
            }
    }   // constructor

    public function Reset() {
        parent::Reset();
        $this->dateObj = new cDate();
    }

    public function IsValid( ){    // TODO
        return true;
    }
    public function GetFollower( $dt) { // TODO
        return new cDate($this->dateObj);
    }

    public function FromString( $str ) {

        sscanf( $str, "s1-%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-(%d.%d.%d)",
            $this->directionOnSaturday, $this->directionOnSunday, $this->directionOnCelebrity,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $day, $month, $year
            );

        $this->dateObj->SetDate($month, $day, $year );

        $this->startDate->SetDate($startmonth, $startday, $startyear );

        if ($endday==0) {
            $this->endDate = undef;
        } else {
            $this->endDate = new cDate($endmonth, $endday, $endyear );
        }


        # echo "\nDay=$day Month=$month Year=$year";
    }   // function FromString

    public function SetDate( $dateObj ) {
        $this->dateObj->SetDate( $dateObj->Month(), $dateObj->Day(), $dateObj->Year() );
    }       // function SetDate()

    public function GetDate( ) {
        return new cDate($this->dateObj);
    }

    public function AsString( ) {

        if ( $this->endDate == undef ){
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->endDate->Day();
            $endmonth = $this->endDate->Month();
            $endyear = $this->endDate->Year();
        }

        return sprintf(
            "s1-%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-(%d.%d.%d)",
            $this->directionOnSaturday, $this->directionOnSunday, $this->directionOnCelebrity,
            $this->startDate->Day(), $this->startDate->Month(), $this->startDate->Year(),
            $endday, $endmonth, $endyear,
            $this->dateObj->Day(), $this->dateObj->Month(), $this->dateObj->Year()
            );

    }   // function AsString

    public function FromForm(  ) {

        $radiostrategy = $_POST['strategy'];
        $dt = new cDate();

        //         assert ($radiostrategy == 's1_singledate');

        parent::FromForm();

        if ($radiostrategy == 's1_singledate') {
            $dt -> FromDMY( $_POST['s1_date'] );
            $this->SetStartDate( $dt );
            $this->SetEndDate( $dt );
            $this->SetDate( $dt );
        }
    }   // function FromForm

    public function FillForm( $checked = false ) {

        $msgSimpleDate = $this->id2msg( 1009 );

        $check = ( $checked ) ? " checked " : "";

        $dt = ( ( $this->dateObj == undef )   ? '' : $this->dateObj->AsDMY() );
        if (cDateStrategy::$language == "en_en") { $dt = $this->dateObj->AsMDY();}

        echo "<tr><td><input type=radio name = 'strategy' value='s1_singledate' $check>$msgSimpleDate</td>";
        echo "<td><input name=s1_date value='$dt'></td></tr>";

    }   // function FillForm

    public function GetNextTerminDate( $datestart, $dateisfirst = true  ) {

        if ( $dateisfirst ) {
            if ( $datestart->eq( $this->dateObj ) ) {
                return $datestart;
            } else {
                if ($datestart->lt( $this->dateObj)) {
                    return $this->dateObj;
                } else {
                    return undef;
                }
            }
        } else {
            $datestart->Inc( );
            if ( $datestart->eq( $this->dateObj ) ) {
                return $datestart;
            }
        }

        return undef;

    }   // function GetNextTerminDate

    public function GetPrevTerminDate( $datestart, $dateisfirst = true  ) {

        if ( $dateisfirst ) {
            if ( $datestart->eq( $this->dateObj ) ) {
                return $datestart;
            } else {
                if ($datestart->gt( $this->dateObj)) {
                    return $this->dateObj;
                } else {
                    return undef;
                }
            }
        } else {
            $datestart->Dec( );
            if ($datestart->eq( $this->dateObj )) {
                return $datestart;
            }
        }

        return undef;

    }   // function GetPrevTerminDate

    public function GetFirstDate( ) {
        return $this->dateObj;
    }   // function GetFirstDate()

    public function IsTerminDate( $dateObj ) {

        return $this->dateObj->eq( $dateObj );

    }   // function IsTerminDate

}       // of class cDateStrategySimpleDate

?>