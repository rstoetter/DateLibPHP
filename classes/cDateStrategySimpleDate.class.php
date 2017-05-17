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
//		public method GetNextEventDate($datestart,$dateisfirst=true)
//		public method GetPrevTerminDate($datestart,$dateisfirst=true)
//		public method IsEventDate($m_date)
//		public method IsValid()
//		public method Reset()
//		public method SetDate($m_date)
//		public method cDateStrategySimpleDate($str="")
//		protected var $m_date
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

    protected $m_date;

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
        $this->m_date = new cDate();
    }

    public function IsValid( ){    // TODO
        return true;
    }
    public function GetFollower( $dt) { // TODO
        return new cDate($this->m_date);
    }

    public function FromString( $str ) {

        sscanf( $str, "s1-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-(%d.%d.%d)",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $day, $month, $year
            );

        $this->m_date->SetDate($month, $day, $year );

        $this->m_start_date->SetDate($startmonth, $startday, $startyear );

        if ($endday==0) {
            $this->m_end_date = undef;
        } else {
            $this->m_end_date = new cDate($endmonth, $endday, $endyear );
        }


        # echo "\nDay=$day Month=$month Year=$year";
    }   // function FromString

    public function SetDate( $m_date ) {
        $this->m_date->SetDate( $m_date->Month(), $m_date->Day(), $m_date->Year() );
    }       // function SetDate()

    public function GetDate( ) {
        return new cDate($this->m_date);
    }

    public function AsString( ) {

        if ( $this->m_end_date == undef ){
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->m_end_date->Day();
            $endmonth = $this->m_end_date->Month();
            $endyear = $this->m_end_date->Year();
        }

        return sprintf(
            "s1-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-(%d.%d.%d)",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $this->m_start_date->Day(), $this->m_start_date->Month(), $this->m_start_date->Year(),
            $endday, $endmonth, $endyear,
            $this->m_date->Day(), $this->m_date->Month(), $this->m_date->Year()
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

        $dt = ( ( $this->m_date == undef )   ? '' : $this->m_date->AsDMY() );
        if (cDateStrategy::$language == "en_en") { $dt = $this->m_date->AsMDY();}

        echo "<tr><td><input type=radio name = 'strategy' value='s1_singledate' $check>$msgSimpleDate</td>";
        echo "<td><input name=s1_date value='$dt'></td></tr>";

    }   // function FillForm

    public function GetNextEventDate( $datestart, $dateisfirst = true  ) {

        if ( $dateisfirst ) {
            if ( $datestart->eq( $this->m_date ) ) {
                return $datestart;
            } else {
                if ($datestart->lt( $this->m_date)) {
                    return $this->m_date;
                } else {
                    return undef;
                }
            }
        } else {
            $datestart->Inc( );
            if ( $datestart->eq( $this->m_date ) ) {
                return $datestart;
            }
        }

        return undef;

    }   // function GetNextEventDate

    public function GetPrevTerminDate( $datestart, $dateisfirst = true  ) {

        if ( $dateisfirst ) {
            if ( $datestart->eq( $this->m_date ) ) {
                return $datestart;
            } else {
                if ($datestart->gt( $this->m_date)) {
                    return $this->m_date;
                } else {
                    return undef;
                }
            }
        } else {
            $datestart->Dec( );
            if ($datestart->eq( $this->m_date )) {
                return $datestart;
            }
        }

        return undef;

    }   // function GetPrevTerminDate

    public function GetFirstDate( ) {
        return $this->m_date;
    }   // function GetFirstDate()

    public function IsEventDate( $m_date ) {

        return $this->m_date->eq( $m_date );

    }   // function IsEventDate

}       // of class cDateStrategySimpleDate

?>