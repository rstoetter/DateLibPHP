<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategyDaily.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategyDaily' erweitert 'cDateStrategy' um einen täglichen Rhythmus
//  Project       : libdatephp
//  Project Site  : https://github.com/rstoetter/libdatephp
//  Project wiki  : https://github.com/rstoetter/libdatephp/wiki
//  Created by    : Rainer Stötter ( rstoetter@users.sourceforge.net )
//  Copyright (c) : 2007-2017, Rainer Stötter, All rights reserved
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  License:
//
//  This file has been released under the MIT license
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Requests]]
//
//
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
//	class cDateStrategyDaily
//		public method AsString()
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($date)
//		public method IsValid()
//		public method Reset()
//		public method __construct($str=undef)
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
?><?php

namespace libdatephp;

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategyDaily
////////////////////////////////////////////////////////////////////////////////////

class cDateStrategyDaily extends cDateStrategy {

    // täglich ein Termin

    # protected $onSaturday = false;
    # protected $onSunday = false;
    # protected $onCelebrity = false;

    public function __construct( $str = undef ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str == undef ) {
                $this->Reset();
            } else {
                $this->FromString( $str ) ;
            }
    }   // constructor

    public function Reset( ) {

        parent::Reset();

        // nop
    }

    public function FromString( $str ) {
        // "s1-05.04.2009"

        sscanf( $str, "s8-%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)",
            $this->directionOnSaturday, $this->directionOnSunday, $this->directionOnCelebrity,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear
            );

        $this->startDate->SetDate($startmonth, $startday, $startyear );

        if ($endday==0) {
            $this->endDate = undef;
        } else {
            $this->endDate = new cDate($endmonth, $endday, $endyear );
        }


        # echo "\n Intervall jeden Tag";
    }   // function FromString
/*
    public function SetOnSaturday( $set ) {

        $this->onSaturday = $set;

    }       // function SetOnSaturday()

    public function SetOnSunday( $set ) {

        $this->onSunday = $set;

    }       // function SetOnSunday()

    public function SetOnCelebrity( $set ) {

        $this->onCelebrity = $set;

    }       // function SetOnCelebrity()
*/
    public function AsString( ) {

        if ( $this->endDate == undef ){
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->endDate->Day();
            $endmonth = $this->endDate->Month();
            $endyear = $this->endDate->Year();
        }

        return sprintf( "s8-%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)",
            $this->directionOnSaturday, $this->directionOnSunday, $this->directionOnCelebrity,
            $this->startDate->Day(), $this->startDate->Month(), $this->startDate->Year(),
            $endday, $endmonth, $endyear
                 );

    }   // function AsString

    public function FromForm(  ) {

        # $_POST[strategy] = s8_dayly

        $radiostrategy = $_POST['strategy'];

        // assert ($radiostrategy == 's8_dayly');

        if ($radiostrategy == 's8_dayly') {

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
        }

    }   // function FromForm

    public function IsValid() {
        return true;
    }

    public function FillForm( $checked = false ) {

        $msgTaeglich = $this->id2msg( 1053 );
        $msgJedenTag = $this->id2msg( 1054 );

        $check = ( $checked ) ? " checked " : "";

        // -------------- s8 => täglich
        echo "<tr><td><input type=radio name = 'strategy' value='s8_dayly' $check >$msgTaeglich</td>";
        echo "<td>$msgJedenTag";

        echo "</td></tr>";


    }   // function FillForm


// NOTE : TODO : bei GetFollower Overflow berücksichtigen !

    function GetFollower( $date ) {
        // $dateObj muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen

        # echo "<br>GetFollower(".$date->AsDMY(). ") : GetLatestDayNumber() ergibt " . $this->GetLatestDayNumber();

        $dateObj = new cDate( $date);
        $fertig = false;

        do {
            $dateObj->inc( );

            if ( ( $dateObj->IsSaturday() ) && ( !$this->directionOnSaturday == STRATEGY_DIRECTION_LEAVE ) ) { $fertig = false; }
            elseif ( ( $dateObj->IsSunday() ) && ( !$this->directionOnSunday == STRATEGY_DIRECTION_LEAVE) ) { $fertig = false; }
            elseif ( ( $this->IsCelebrity($dateObj) ) && ( !$this->directionOnCelebrity == STRATEGY_DIRECTION_LEAVE ) ) { $fertig = false; }
            else ($fertig = true);

        } while (!$fertig);

        if ($this->Overflow($dateObj)) return undef;

        return $dateObj;

    }       // function GetFollower()

    public function GetFirstDate( ) {
        return $this->startDate;
    }   // function GetFirstDate()

}       // of class cDateStrategyDaily

?>