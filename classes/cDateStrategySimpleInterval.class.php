<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategySimpleInterval.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategySimpleInterval' erweitert 'cDateStrategy' um alle n Tage einen bestimmten Termin
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
//		_POST['s6_days']
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
//	class cDateStrategySimpleInterval
//		public method AsString()
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($date)
//		public method GetPeriodLen($days)
//		public method IsValid()
//		public method Reset()
//		public method SetPeriodLen($days)
//		public method cDateStrategySimpleInterval($str=undef)
//		protected var $daysPeriod
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?><?php

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategySimpleInterval
////////////////////////////////////////////////////////////////////////////////////

namespace libdatephp;

class cDateStrategySimpleInterval extends cDateStrategy {

    // alle n Tage ein Termin

    protected $daysPeriod;

    public function cDateStrategySimpleInterval( $str = undef ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str == undef ) {
                $this->Reset();
            } else {
                $this->FromString( $str ) ;
            }
    }   // constructor

    public function Reset( ) {

        parent::Reset();

        $this->daysPeriod=1;
    }



    public function FromString( $str ) {
        // "s1-05.04.2009"

        sscanf( $str, "s6-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{%d}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $days );

        $this->daysPeriod = $days;

        $this->m_start_date->SetDate($startmonth, $startday, $startyear );

        if ($endday==0) {
            $this->m_end_date = undef;
        } else {
            $this->m_end_date = new cDate($endmonth, $endday, $endyear );
        }

        # $this->IsValid();

        # echo "\n Intervall alle $days Tage";
    }   // function FromString

    public function SetPeriodLen( $days ) {
        $this->daysPeriod = $days;
    }       // function SetPeriodLen()

    public function GetPeriodLen( $days ) {
        return $this->daysPeriod;
    }       // function SetPeriodLen()

    public function AsString( ) {

        if ( $this->m_end_date == undef ){
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->m_end_date->Day();
            $endmonth = $this->m_end_date->Month();
            $endyear = $this->m_end_date->Year();
        }

        return sprintf( "s6-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{%d}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $this->m_start_date->Day(), $this->m_start_date->Month(), $this->m_start_date->Year(),
            $endday, $endmonth, $endyear,

            $this->daysPeriod );
    }   // function AsString

    public function FromForm(  ) {
        # $_POST[strategy] = s6_interval
        # $_POST[s6_days] = 34

        $radiostrategy = $_POST['strategy'];

        // assert ($radiostrategy == 's6_interval');

        if ($radiostrategy == 's6_interval') {

            $this->SetPeriodLen( $_POST['s6_days'] );

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
        }


    }   // function FromForm

    public function FillForm( $checked = false ) {

        $msgImMonat = $this->id2msg( 1049 );
        $msgEinfachesIntervall = $this->id2msg( 1050 );
        $msgTage = $this->id2msg( 1051 );
        $msgAlle = $this->id2msg( 1052 );

        $check = ( $checked ) ? " checked " : "";

        echo "<tr><td><input type=radio name = 'strategy' value='s6_interval' $check>$msgEinfachesIntervall</td>";
        $days = $this->daysPeriod;
        echo "<td>$msgAlle <input name=s6_days size=4 value = '$days'> $msgTage";

        echo "</td></tr>";


    }   // function FillForm

    public function IsValid() {
        return $this->daysPeriod > 0;
    }

    function GetFollower( $date ) {
        // $dateObj muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen

        # echo "<br>GetFollower(".$date->AsDMY(). ") : GetLatestDayNumber() ergibt " . $this->GetLatestDayNumber();

        $dateObj = new cDate( $date);
        $dateObj->Skip( $this->daysPeriod);
        return $dateObj;

    }       // function GetFollower()

    public function GetFirstDate( ) {
        return $this->m_start_date;
    }   // function GetFirstDate()

}       // of class cDateStrategySimpleInterval


?>