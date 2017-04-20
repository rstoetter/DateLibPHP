<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategy.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategy' berechnet für einen vorgegebenen Zeitraum Zeitwerte, welche einem bestimmten Rhythmus folgen
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
//  This file has been released under the MIT license
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
//	[[Requests]]
//
//
//		_POST['enddate']
//		_POST['selectoncelebrities']
//		_POST['selectonsaturday']
//		_POST['selectonsunday']
//		_POST['startdate']
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
//	class cDateStrategy
//		public var static
//		public method AddCelebrity($dateObj)
//		public method AsString()
//		public method FillForm()
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($date)
//		public method GetNextTerminDate($datestart,$dateisfirst=true)
//		public method HasEndDate()
//		public method IsCelebrity($dateObj)
//		public method IsTerminDate($dateObj)
//		public method IsValid()
//		public method MoveDateIfNecessary($date)
//		public method Reset()
//		public method SetEndDate($dateObj)
//		public method SetLanguage($language)
//		public method SetStartDate($dateObj)
//		public method StrategyCelebrity($direction=STRATEGY_DIRECTION_LEAVE)
//		public method StrategyImpossible($direction=STRATEGY_DIRECTION_FORWARD)
//		public method StrategySaturday($direction=STRATEGY_DIRECTION_LEAVE)
//		public method StrategySunday($direction=STRATEGY_DIRECTION_LEAVE)
//		public method cDateStrategy()
//		protected var $directionOnCelebrity
//		protected var $directionOnImpossible
//		protected var $directionOnSaturday
//		protected var $directionOnSunday
//		protected var $endDate
//		protected var $startDate
//		protected var static
//		protected method Overflow($dt)
//		protected method SetSpecialDaysFromForm()
//		protected method SetStartEndDatesFromForm()
//		protected method Underflow($dt)
//		protected method id2msg($id)
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
?><?php

namespace libdatephp;

# NOTE : TODO : s7 fehlt noch (nach Dimensionen)
# NOTE : TODO : alle IsValid () überprüfen
# NOTE : TODO : JavaScript : Validierungen

require_once("./classes/cDate.class.php");  //  Datumsklasse

define ("STRATEGY_DIRECTION_LEAVE", 0);          # belassen
define ("STRATEGY_DIRECTION_FORWARD", 1);       # verschieben in die Zukunft
define ("STRATEGY_DIRECTION_BACKWARD", 2);      # verschieben in die Vergangenheit
define ("STRATEGY_DIRECTION_ABOLISH", 3);       # verwerfen


$_msg_de_de = array(
     1000 => "verwerfen",
     1001 => "belassen",
     1002 => "n&auml;chstm&ouml;glicher Termin",
     1003 => "letztm&ouml;glicher Termin",
     1004 => "Samstage",
     1005 => "Sonntage",
     1006 => "Feiertage",
     1007 => "Startdatum",
     1008 => "Enddatum",
     1009 => "Einfaches Datum",
     1010 => "Nach Wochentagen",
     1011 => "Montag",
     1012 => "Dienstag",
     1013 => "Mittwoch",
     1014 => "Donnerstag",
     1015 => "Freitag",
     1016 => "Samstag",
     1017 => "Sonntag",
     1018 => "alle ",
     1019 => "Wochen am ",
     1020 => "Nach fixen Tagen",
     1021 => "Am",
     1022 => "ten Tag im ",
     1023 => "Monat",
     1024 => "Quartal",
     1025 => "Jahr",
     1026 => "Nach Tagen",
     1027 => "Monatlich am",
     1028 => "Januar",
     1029 => "Februar",
     1030 => "M&auml;rz",
     1031 => "April",
     1032 => "Mai",
     1033 => "Juni",
     1034 => "Juli",
     1035 => "August",
     1036 => "September",
     1037 => "Oktober",
     1038 => "November",
     1039 => "Dezember",
     1040 => "im Monat",
     1041 => "Nach Wochentagen",
     1042 => "Am",
     1043 => "ersten",
     1044 => "zweiten",
     1045 => "dritten",
     1046 => "vierten",
     1047 => "f&uuml;ften",
     1048 => "letzten",
     1049 => "im Monat",
     1050 => "einfaches Intervall",
     1051 => "Tage",
     1052 => "Alle",
     1053 => "T&auml;glich",
     1054 => "Jeden Tag",
     1055 => "Ohne erkennbarem Intervall",
     1056 => "Neuer Eintrag",
);

$_msg_en_en = array(
     1000 => "abolish",
     1001 => "do not reschedule",
     1002 => "next date",
     1003 => "previous date",
     1004 => "Saturdays",
     1005 => "Sundays",
     1006 => "Celebrities",
     1007 => "Starting date",
     1008 => "Ending date",
     1009 => "Simple date",
     1010 => "Weekdays",
     1011 => "Monday",
     1012 => "Tuesday",
     1013 => "Wednesday",
     1014 => "Thursday",
     1015 => "Friday",
     1016 => "Saturday",
     1017 => "Sunday",
     1018 => "each ",
     1019 => "week on ",
     1020 => "Fixed dates",
     1021 => "On the ",
     1022 => "th day of the ",
     1023 => "month",
     1024 => "quarter",
     1025 => "year",
     1026 => "day by day",
     1027 => "Each month on day",
     1028 => "January",
     1029 => "February",
     1030 => "March",
     1031 => "April",
     1032 => "May",
     1033 => "June",
     1034 => "July",
     1035 => "August",
     1036 => "September",
     1037 => "October",
     1038 => "November",
     1039 => "December",
     1040 => "in the month",
     1041 => "On special weekdays",
     1042 => "On the",
     1043 => "first",
     1044 => "second",
     1045 => "third",
     1046 => "fourth",
     1047 => "fifth",
     1048 => "last",
     1049 => "of the month",
     1050 => "Simple Interval",
     1051 => "days",
     1052 => "all",
     1053 => "Daily",
     1054 => "Each day",
     1055 => "Without interval",
     1056 => "New Entry",

);

$_msg_fr_fr = array(
     1000 => "Jeter",
     1001 => "Sortir",
     1002 => "Prochaine date",
     1003 => "Date precedente",
     1004 => " Samedis",
     1005 => "Dimanches",
     1006 => "Fameux",
     1007 => "Date de commencement",
     1008 => "Date de terminaison",
     1009 => "Date simple",
     1010 => "Jours de la semaine",
     1011 => "Lundi",
     1012 => "Mardi",
     1013 => "Mercredi",
     1014 => "Jeudi",
     1015 => "Vendredi",
     1016 => "Samedi",
     1017 => "Dimanche",
     1018 => "Chaque ",
     1019 => "Semaine le ",
     1020 => "Dates fixes",
     1021 => "Le ",
     1022 => "Le jour de ",
     1023 => "Mois",
     1024 => "Trimestre",
     1025 => "Ann&eacute;e",    // é
     1026 => "Jour a jour",
     1027 => "Ne pas recalendrier",
     1028 => "Janvier",
     1029 => "Fevrier",
     1030 => "Mars",
     1031 => "Avril",
     1032 => "Mai",
     1033 => "Juin",
     1034 => "Juillet",
     1035 => "Aout",
     1036 => "Septembre",
     1037 => "Octobre",
     1038 => "Novembre",
     1039 => "Decembre",
     1040 => "Le mois de",
     1041 => "Des jours de semaine speciales",
     1042 => "Le",
     1043 => "Promier",
     1044 => "Deuxieme",
     1045 => "Troisieme",
     1046 => "Quatreieme",
     1047 => "Cinqui&eacute;me",    // é
     1048 => "Dernier",
     1049 => "Du mois",
     1050 => "Interval simple",
     1051 => "Jours",
     1052 => "Tous",
     1053 => "Quotidiennement",
     1054 => "Chaque jour",
     1055 => "Sans interval",
     1056 => "Nouvelle entr&eacute;e", // é

 );

class cDateStrategy {

    protected $directionOnSunday = STRATEGY_DIRECTION_LEAVE;
    protected $directionOnSaturday = STRATEGY_DIRECTION_LEAVE;
    protected $directionOnCelebrity = STRATEGY_DIRECTION_LEAVE;
    protected $directionOnImpossible = STRATEGY_DIRECTION_FORWARD;
    protected $startDate;
    protected $endDate = undef;
    public static $celebrities = array();
    protected static $language = "en_en";

    public function cDateStrategy( ) {
        $this->startDate = new cDate();
        $this->endDate = undef;     // falls noch kein Endedatum definiert wurde, verwenden wir undef
    }

    public function Reset() {
        $this->dateObj = new cDate();
        $this->startDate = new cDate();
        $this->endDate = undef;
    }

    static function SetLanguage( $language ) {
        $this->language = $language;
    }

    protected function id2msg( $id ) {

        global $_msg_de_de;
        global $_msg_en_en;
        global $_msg_fr_fr;

        if (cDateStrategy::$language == 'de_de') {
            $ary = $_msg_de_de;
        } elseif (cDateStrategy::$language == 'en_en') {
            $ary = $_msg_en_en;
        } elseif (cDateStrategy::$language == 'fr_fr') {
            $ary = $_msg_en_en;
        } else {
            die ("cDateStrategy : unbekannte Sprache '" . cDateStrategy::$language . "'");
        }

        $msg = $ary[$id];

        return $msg;

    }

    public function FromForm(  ) {
    /*
        $_POST[selectonsaturday] = abolish
        $_POST[selectonsunday] = abolish
        $_POST[selectoncelebrities] = abolish
        $_POST[startdate] = 11.10.2009
        $_POST[enddate] =
    */

        $onsaturday = $_POST['selectonsaturday'];
        $onsunday = $_POST['selectonsunday'];
        $oncelebrity = $_POST['selectoncelebrities'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];

        if ($onsunday == 'abolish' ) { $this->directionOnSunday = STRATEGY_DIRECTION_ABOLISH; }
        if ($onsunday == 'leave' ) { $this->directionOnSunday = STRATEGY_DIRECTION_LEAVE; }
        if ($onsunday == 'forward' ) { $this->directionOnSunday = STRATEGY_DIRECTION_FORWARD; }
        if ($onsunday == 'backward' ) { $this->directionOnSunday = STRATEGY_DIRECTION_BACKWARD; }

        if ($onsaturday == 'abolish' ) { $this->directionOnSaturday = STRATEGY_DIRECTION_ABOLISH; }
        if ($onsaturday == 'leave' ) { $this->directionOnSaturday = STRATEGY_DIRECTION_LEAVE; }
        if ($onsaturday == 'forward' ) { $this->directionOnSaturday = STRATEGY_DIRECTION_FORWARD; }
        if ($onsaturday == 'backward' ) { $this->directionOnSaturday = STRATEGY_DIRECTION_BACKWARD; }

        if ($oncelebrity == 'abolish' ) { $this->directionOnCelebrity = STRATEGY_DIRECTION_ABOLISH; }
        if ($oncelebrity == 'leave' ) { $this->directionOnCelebrity = STRATEGY_DIRECTION_LEAVE; }
        if ($oncelebrity == 'forward' ) { $this->directionOnCelebrity = STRATEGY_DIRECTION_FORWARD; }
        if ($oncelebrity == 'backward' ) { $this->directionOnCelebrity = STRATEGY_DIRECTION_BACKWARD; }

        $startdate = trim( $startdate );

        if (strstr( $startdate, '.' ) ) {
            if ( $this->startDate == undef ) { $this->startDate = new cDate(); }
            $this->startDate->FromDMY( $startdate );
        } else {
            if ( $this->startDate == undef ) { $this->startDate = new cDate(); }
            $this->startDate->FromMDY( $startdate );
        }

        # echo "<br>--------->startdate =" . $startdate . "und this->startDate=" . $this->startDate->AsDMY() ;

        $enddate = trim( $enddate );

        if ( strlen( $enddate )== 0 ) {
            $this->endDate = undef;
        } elseif (strstr( $enddate, '.' ) ) {
            if ( $this->endDate == undef ) { $this->endDate = new cDate(); }
            $this->endDate->FromDMY( $enddate );
        } else {
            if ( $this->endDate == undef ) { $this->endDate = new cDate(); }
            $this->endDate->FromMDY( $enddate );
        }

        /*if ($this->endDate != undef ) {
            echo "<br>--------->enddate =" . $enddate . "und this->endDate=" . $this->endDate->AsDMY() ;
        } else {
            echo "<br>enddate ist undef !";
        }*/

    }


    public function FillForm(  ) {

        echo "<table>";

        $msgVerwerfen = $this->id2msg( 1000 );
        $msgBelassen = $this->id2msg( 1001 );
        $msgNextTermin = $this->id2msg( 1002 );
        $msgPrevTermin = $this->id2msg( 1003 );
        $msgSamstage = $this->id2msg( 1004 );
        $msgSonntage = $this->id2msg( 1005 );
        $msgFeiertage = $this->id2msg( 1006 );
        $msgStartdatum = $this->id2msg( 1007 );
        $msgEnddatum = $this->id2msg( 1008 );

        echo "<tr><td>$msgSamstage</td>";
        echo "<td>";
            echo "<select name=selectonsaturday>";
                $sel = ($this->directionOnSaturday == STRATEGY_DIRECTION_ABOLISH ) ? ' selected=1' : '';
                echo "<option value=abolish $sel>$msgVerwerfen</option>";
                $sel = ($this->directionOnSaturday == STRATEGY_DIRECTION_LEAVE ) ? ' selected=1' : '';
                echo "<option value=leave $sel>$msgBelassen</option>";
                $sel = ($this->directionOnSaturday == STRATEGY_DIRECTION_FORWARD ) ? ' selected=1' : '';
                echo "<option value=forward $sel>$msgNextTermin</option>";
                $sel = ($this->directionOnSaturday == STRATEGY_DIRECTION_BACKWARD ) ? ' selected=1' : '';
                echo "<option value=backward $sel>$msgPrevTermin</option>";
            echo "</select>";
        echo "</td></tr>";

        echo "<tr><td>$msgSonntage</td>";
        echo "<td>";
            echo "<select name=selectonsunday>";
                $sel = ($this->directionOnSunday == STRATEGY_DIRECTION_ABOLISH ) ? ' selected=1' : '';
                echo "<option value=abolish $sel>$msgVerwerfen</option>";
                $sel = ($this->directionOnSunday == STRATEGY_DIRECTION_LEAVE ) ? ' selected=1' : '';
                echo "<option value=leave $sel>$msgBelassen</option>";
                $sel = ($this->directionOnSunday == STRATEGY_DIRECTION_FORWARD ) ? ' selected=1' : '';
                echo "<option value=forward $sel>$msgNextTermin</option>";
                $sel = ($this->directionOnSunday == STRATEGY_DIRECTION_BACKWARD ) ? ' selected=1' : '';
                echo "<option value=backward $sel>$msgPrevTermin</option>";
            echo "</select>";
        echo "</td></tr>";

        echo "<tr><td>$msgFeiertage</td>";
        echo "<td>";
            echo "<select name=selectoncelebrities>";
                $sel = ($this->directionOnCelebrity == STRATEGY_DIRECTION_ABOLISH ) ? ' selected=1' : '';
                echo "<option value=abolish $sel>$msgVerwerfen</option>";
                $sel = ($this->directionOnCelebrity == STRATEGY_DIRECTION_LEAVE ) ? ' selected=1' : '';
                echo "<option value=leave $sel>$msgBelassen</option>";
                $sel = ($this->directionOnCelebrity == STRATEGY_DIRECTION_FORWARD ) ? ' selected=1' : '';
                echo "<option value=forward $sel>$msgNextTermin</option>";
                $sel = ($this->directionOnCelebrity == STRATEGY_DIRECTION_BACKWARD ) ? ' selected=1' : '';
                echo "<option value=backward $sel>$msgPrevTermin</option>";
            echo "</select>";
        echo "</td></tr>";

/*        echo "<tr><td>Unm&ouml;glichkeiten</td>";
        echo "<td>";
            echo "<select name=selectonimpossible>";
                echo "<option value=abolish>verwerfen";
                echo "<option value=forward>n&auml;chstm&ouml;glicher Termin";
                echo "<option value=backward>letztm&ouml;glicher Termin";

            echo "</select>";
*/
//        echo "</td></tr>";

        $d = $this->startDate->AsDMY();
        if ( cDateStrategy::$language == "en_en" ) { $d = $this->startDate->AsMDY(); }
        echo "<tr><td>$msgStartdatum</td>";
        echo "<td><input name='startdate' value='$d'>";
        echo "</td></tr>";

        $d = ($this->endDate == undef ) ? ' ' : $this->endDate->AsDMY();
        echo "<tr><td>$msgEnddatum</td>";
        echo "<td><input name=enddate value='$d'>";
        echo "</td></tr>";

        echo "</table>";


    }

    public function IsValid( ){ return true; }
    public function GetFollower( $date ) { return undef; }
    public function GetFirstDate( ) {}
    public function FromString( $str ){}
    public function AsString( ){}


    static public function AddCelebrity( $dateObj ) {
        self::$celebrities[] = new cDate($dateObj);
        # echo "<br>Added " . $dateObj->AsDMY() . " to the list which has now the length " . count( self::$celebrities );
    }

    public function SetStartDate( $dateObj ) {
        $this->startDate->SetDate( $dateObj->Month(), $dateObj->Day(), $dateObj->Year() ) ;
    }   // function StrategySunday

    public function SetEndDate( $dateObj ) {
        if ($this->endDate == undef) {
            $this->endDate = new cDate();
        }
        $this->endDate->SetDate( $dateObj->Month(), $dateObj->Day(), $dateObj->Year() ) ;
    }   // function StrategySunday

    public function HasEndDate( ) {
        return ( $this->endDate == undef ) ;
    }   // function StrategySunday

    protected function SetSpecialDaysFromForm( ) {
        $this->StrategySunday( STRATEGY_DIRECTION_ABOLISH );
        $this->StrategySaturday( STRATEGY_DIRECTION_ABOLISH );
        $this->StrategyCelebrity( STRATEGY_DIRECTION_ABOLISH );

        $selectonsunday = $_POST['selectonsunday'];
        if ( $selectonsunday =="abolish" ) { $this->StrategySunday( STRATEGY_DIRECTION_ABOLISH ); }
        elseif ( $selectonsunday =="leave" ) { $this->StrategySunday( STRATEGY_DIRECTION_LEAVE ); }
        elseif ( $selectonsunday =="forward" ) { $this->StrategySunday( STRATEGY_DIRECTION_FORWARD ); }
        elseif ( $selectonsunday =="backward" ) { $this->StrategySunday( STRATEGY_DIRECTION_BACKWARD ); }
        else die( "unbekannte Auswahl '$selectonsunday'");

        $selectonsaturday = $_POST['selectonsaturday'];
        if ( $selectonsaturday =="abolish" ) { $this->StrategySaturday( STRATEGY_DIRECTION_ABOLISH ); }
        elseif ( $selectonsaturday =="leave" ) { $this->StrategySaturday( STRATEGY_DIRECTION_LEAVE ); }
        elseif ( $selectonsaturday =="forward" ) { $this->StrategySaturday( STRATEGY_DIRECTION_FORWARD ); }
        elseif ( $selectonsaturday =="backward" ) { $this->StrategySaturday( STRATEGY_DIRECTION_BACKWARD ); }
        else die( "unbekannte Auswahl '$selectonsaturday'");

        $selectoncelebrities = $_POST['selectoncelebrities'];
        if ( $selectoncelebrities =="abolish" ) { $this->StrategyCelebrity( STRATEGY_DIRECTION_ABOLISH ); }
        elseif ( $selectoncelebrities =="leave" ) { $this->StrategyCelebrity( STRATEGY_DIRECTION_LEAVE ); }
        elseif ( $selectoncelebrities =="forward" ) { $this->StrategyCelebrity( STRATEGY_DIRECTION_FORWARD ); }
        elseif ( $selectoncelebrities =="backward" ) { $this->StrategyCelebrity( STRATEGY_DIRECTION_BACKWARD ); }
        else die( "unbekannte Auswahl '$selectoncelebrities'");

    }   // SetSpecialDaysFromForm()

    protected function SetStartEndDatesFromForm() {

        $dt = new cDate();

        $strstartdate = trim($_POST['startdate']);
        $strenddate = trim($_POST['enddate']);

            if (strstr( $strstartdate, "/" )) {
                $dt -> FromMDY( $strstartdate );
            } else {
                $dt -> FromDMY( $strstartdate );
            }
            $this->SetStartDate( $dt );

            $this->EndDate = undef;
            if ( $strenddate != "" ) {
                if (strstr( $strenddate, "/" )) {
                    $dt -> FromMDY( $strenddate );
                } else {
                    $dt -> FromDMY( $strenddate );
                }
                $this->SetEndDate( $dt );
            }

    }       // SetStartEndDatesFromForm

    public function StrategySunday( $direction = STRATEGY_DIRECTION_LEAVE ) {
        $this->directionOnSunday = $direction;
    }   // function StrategySunday

    public function StrategySaturday( $direction = STRATEGY_DIRECTION_LEAVE ) {
        $this->directionOnSaturday = $direction;
    }   // function StrategySaturday

    public function StrategyCelebrity( $direction = STRATEGY_DIRECTION_LEAVE ) {
        $this->directionOnCelebrity = $direction;
    }   // function StrategyHoliday

    public function StrategyImpossible( $direction = STRATEGY_DIRECTION_FORWARD ) {
        $this->directionOnImpossible = $direction;
    }   // function StrategyImpossible

    # abstract public function GetNextTerminDate( $date, $dateisfirst = true  );
    # abstract public function GetPrevTerminDate( $date, $dateisfirst = true  );

    protected function Overflow( $dt ) {
        if ( ( $this->endDate != undef ) && ( $dt->gt( $this->endDate) ) ) { return true; }
        return false;
    }

    protected function Underflow( $dt ) {
        if ($dt->lt($this->startDate)) return true;
        return false;
    }

    public function MoveDateIfNecessary( $date ) {

        # NOTE : MoveDateIfNecessary() in Endlosschleife wenn sunday=back und saturday=forward -> verlegt von Sonntag auf Freitag

        $dateObj = new cDate( $date );

        if (( $dateObj->IsSunday() ) && ( $this->directionOnSunday != STRATEGY_DIRECTION_ABOLISH) ) { return undef; }
        if (( $dateObj->IsSaturday() ) && ( $this->directionOnSunday != STRATEGY_DIRECTION_ABOLISH) ) { return undef; }
            if (( $this->IsCelebrity( $dateObj ) ) && ( $this->directionOnCelebrity != STRATEGY_DIRECTION_ABOLISH) ) { return undef; }

        do {
            $moved = false;
            if (( $dateObj->IsSunday() ) && ( $this->directionOnSunday != STRATEGY_DIRECTION_LEAVE) ) {
                if ($this->directionOnSunday == STRATEGY_DIRECTION_BACKWARD) {
                    $dateObj->dec();
                    // jetzt verhindern wir eine Endlosschleife :
                    if ( $this->directionOnSaturday == STRATEGY_DIRECTION_FORWARD ) {
                        $dateObj->dec();
                    }
                    $moved = true;
                } elseif ($this->directionOnSunday == STRATEGY_DIRECTION_FORWARD) {
                    $dateObj->inc();
                    $moved = true;
                }
            }

            if (( $dateObj->IsSaturday() ) && ( $this->directionOnSaturday != STRATEGY_DIRECTION_LEAVE) ) {
                if ($this->directionOnSaturday == STRATEGY_DIRECTION_BACKWARD) {
                    $dateObj->dec();
                    $moved = true;
                } elseif ($this->directionOnSaturday == STRATEGY_DIRECTION_FORWARD) {
                    $dateObj->inc();
                    $moved = true;
                }
            }

            if (( $this->IsCelebrity( $dateObj ) ) && ( $this->directionOnCelebrity != STRATEGY_DIRECTION_LEAVE) ) {
                if ($this->directionOnCelebrity == STRATEGY_DIRECTION_BACKWARD) {
                    $dateObj->dec();
                    // nun verhindern wie eine Endlosschleife :
                    if ( ( $dateObj->IsSunday() ) && ( $this->directionOnSunday == STRATEGY_DIRECTION_FORWARD ) ) {
                        $dateObj->dec();
                        if ( $this->directionOnSaturday == STRATEGY_DIRECTION_FORWARD ) {
                            $dateObj->dec();
                        }
                    }
                    $moved = true;
                } elseif ($this->directionOnCelebrity == STRATEGY_DIRECTION_FORWARD) {
                    $dateObj->inc();
                    $moved = true;
                }
            }

        } while ( $moved );

        if ( $dateObj.lt( $this->startDate) ) { $dateObj = undef; }
        if ( $this->endDate != undef ) {
            if ( $dateObj.gt( $this->endDate) ) { $dateObj = undef; }
        }

        return $dateObj;

    }       // function MoveDateIfNecessary

    static public function IsCelebrity( $dateObj ) {
#        foreach ($__cDateStrategy_Celebrities as $day) {
#            if ($dateObj->eq( $day ) ) return true;
#        }
        for ($i=0; $i<count(self::$celebrities); $i++){
            # echo "\n vgl von " . self::$celebrities[$i]->AsDMY() . " mit " . $dateObj->AsDMY();

            if ($dateObj->eq( self::$celebrities[$i] ) ) { return true;}
        }

        return false;
    }       // function IsCelebrity


    public function IsTerminDate( $dateObj ) {

        $d = new cDate($this->GetFirstDate( ));

        $fertig = false;

        do {
          if ( $d->eq( $dateObj ) ) { return true; }
          if ( $d->gt( $dateObj ) ) { return false; }
          if  ( $this->Overflow( $d ) ) { return false; }
          $d = $this->GetFollower( $d );

        } while ( ! $fertig );

        return false;

    }   // function IsTerminDate


    public function GetNextTerminDate( $datestart, $dateisfirst = true  ) {     // TODO : bei allen gleichen in den abgeleiteten Klassen diese rauswerfen

        if ( $this->Underflow( $datestart ) ) return undef;
        if ( $this->Overflow( $datestart ) ) return undef;

        $dt = $this->GetFirstDate( );
        $fertig = false;

        # echo "<br> GetNextTerminDate() : erster Termin ist am " . $dt->AsDMY();

        if ( ($dateisfirst == true ) && ($datestart->eq($dt)) ) { return $dt; }

        do {
            $dt = $this->GetFollower( $dt );
            # echo "<br> GetNextTerminDate() : untersuche " . $dt->AsDMY();
            if ( $datestart->eq( $dt ) && ( $dateisfirst ) ) return $dt;
            if ( $this->Overflow( $dt ) ) { return undef; }
            if ( $datestart->lt( $dt ) ) return $dt;
        } while ( !$fertig);

        return undef;

    }   // function GetNextTerminDate



}       // of class cDateStrategy

?>