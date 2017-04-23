<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategyMonthlyFixed.class.php
//  Language      : php
//  Description   : Die Klasse 'cDateStrategyMonthlyFixed' erweitert 'cDateStrategy' um fixe Wochentagen alle n Wochen
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
//		_POST['s5_counter']
//		_POST['s5_weekday']
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
//	class cDateStrategyMonthlyFixed
//		public method AsString()
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($date)
//		public method GetFriday()
//		public method GetLatestDayNumber()
//		public method GetMonday()
//		public method GetOnFifth()
//		public method GetOnFirst()
//		public method GetOnFourth()
//		public method GetOnLast()
//		public method GetOnSecond()
//		public method GetOnThird()
//		public method GetSaturday()
//		public method GetSunday()
//		public method GetThursday()
//		public method GetTuesday()
//		public method GetWednesday()
//		public method IsValid()
//		public method Reset()
//		public method ResetWeekNumbers()
//		public method ResetWeekdays()
//		public method SetFriday($set)
//		public method SetMonday($set)
//		public method SetOnFifth($set)
//		public method SetOnFirst($set)
//		public method SetOnFourth($set)
//		public method SetOnLast($set)
//		public method SetOnSecond($set)
//		public method SetOnThird($set)
//		public method SetSaturday($set)
//		public method SetSunday($set)
//		public method SetThursday($set)
//		public method SetTuesday($set)
//		public method SetWednesday($set)
//		public method cDateStrategyMonthlyFixed($str=undef)
//		protected var $onFifth
//		protected var $onFirst
//		protected var $onFourth
//		protected var $onFriday
//		protected var $onLast
//		protected var $onMonday
//		protected var $onSaturday
//		protected var $onSecond
//		protected var $onSunday
//		protected var $onThird
//		protected var $onThursday
//		protected var $onTuesday
//		protected var $onWednesday
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?><?php

namespace libdatephp;

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategyMonthlyFixed
////////////////////////////////////////////////////////////////////////////////////

class cDateStrategyMonthlyFixed extends cDateStrategy {

    // bestimmte Wochentage alle x Wochen

    protected $onMonday = 0;
    protected $onTuesday = 0;
    protected $onWednesday = 0;
    protected $onThursday = 0;
    protected $onFriday = 0;
    protected $onSaturday = 0;
    protected $onSunday = 0;

    protected $onFirst = 0;
    protected $onSecond = 0;
    protected $onThird = 0;
    protected $onFourth = 0;
    protected $onFifth = 0;
    protected $onLast = 0;

    public function cDateStrategyMonthlyFixed( $str = undef ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str ==undef ) {
                $this->Reset( );
            } else {
                $this->FromString( $str ) ;
            }

            $this->IsValid();

    }   // constructor


    public function ResetWeekdays( ) {

        $this->onSunday = 0;
        $this->onMonday = 0;
        $this->onTuesday = 0;
        $this->onWednesday = 0;
        $this->onThursday = 0;
        $this->onFriday = 0;
        $this->onSaturday = 0;

    }

    public function ResetWeekNumbers( ) {

        $this->onFirst = 0;
        $this->onSecond = 0;
        $this->onThird = 0;
        $this->onFourth = 0;
        $this->onLast = 0;

    }


    public function Reset( ) {
        parent::Reset();

        $this->ResetWeekdays( );
        $this->ResetWeekNumbers();

    }

    public function IsValid( ) {

        $ret =  ($this->onMonday+$this->onTuesday+$this->onWednesday+$this->onThursday+$this->onFriday+$this->onSaturday+$this->onSunday);

        if ( $ret ) {
            $ret =  ($this->onFirst+$this->onSecond+$this->onThird+$this->onFourth+$this->onFifth+$this->onLast) ;
        }

        return $ret;

    }       // function IsValid()

    public function FromString( $str ) {

        sscanf( $str, "s5-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{%d:%d:%d:%d:%d:%d:%d}-{%d:%d:%d:%d:%d:%d}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $this->onSunday, $this->onMonday, $this->onTuesday, $this->onWednesday, $this->onThursday, $this->onFriday, $this->onSaturday,
            $this->onFirst, $this->onSecond, $this->onThird, $this->onFourth, $this->onFifth, $this->onLast);

        $this->m_start_date->SetDate($startmonth, $startday, $startyear );

        if ($endday==0) {
            $this->m_end_date = undef;
        } else {
            $this->m_end_date = new cDate($endmonth, $endday, $endyear );
        }

            $this->IsValid();

    }   // function FromString

    public function AsString( ) {

        if ( $this->m_end_date == undef ){
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->m_end_date->Day();
            $endmonth = $this->m_end_date->Month();
            $endyear = $this->m_end_date->Year();
        }

        return sprintf( "s5-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{%d:%d:%d:%d:%d:%d:%d}-{%d:%d:%d:%d:%d:%d}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $this->m_start_date->Day(), $this->m_start_date->Month(), $this->m_start_date->Year(),
            $endday, $endmonth, $endyear,
            $this->onSunday, $this->onMonday, $this->onTuesday, $this->onWednesday, $this->onThursday, $this->onFriday, $this->onSaturday,
            $this->onFirst, $this->onSecond, $this->onThird, $this->onFourth, $this->onFifth, $this->onLast );
    }   // function AsString




    public function FromForm(  ) {

        # $_POST[strategy] = s5_weekday
        # $_POST[s5_counter] = first
        # $_POST[s5_weekday] = mon

        $radiostrategy = $_POST['strategy'];

        // assert ($radiostrategy == 's5_weekday');

        if ($radiostrategy == 's5_weekday') {
            $this->SetOnFirst ( $_POST['s5_counter'] == 'first' );
            $this->SetOnSecond ( $_POST['s5_counter'] == 'second' );
            $this->SetOnThird ( $_POST['s5_counter'] == 'third' );
            $this->SetOnFourth ( ( $_POST['s5_counter'] == 'fourth' ) );
            $this->SetOnLast ( $_POST['s5_counter'] == 'last' );
            $this->SetMonday ( $_POST['s5_weekday'] == 'mon' );
            $this->SetTuesday ( $_POST['s5_weekday'] == 'tue' );
            $this->SetWednesday ( $_POST['s5_weekday'] == 'wed' );
            $this->SetThursday ( $_POST['s5_weekday'] == 'thu' );
            $this->SetFriday ( $_POST['s5_weekday'] == 'fri' );
            $this->SetSaturday ( $_POST['s5_weekday'] == 'sat' );
            $this->SetSunday ( $_POST['s5_weekday'] == 'sun' );
            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
        }

    }   // function FromForm

    public function FillForm( $checked = false ) {

        $msgNachWochentagen = $this->id2msg( 1041 );
        $msgAm = $this->id2msg( 1042 );
        $msgErsten = $this->id2msg( 1043 );
        $msgZweiten = $this->id2msg( 1044 );
        $msgDritten = $this->id2msg( 1045 );
        $msgVierten = $this->id2msg( 1046 );
        $msgFuenften = $this->id2msg( 1047 );
        $msgLetzten = $this->id2msg( 1048 );
        $msgImMonat = $this->id2msg( 1049 );

        $msgMontag = $this->id2msg( 1011 );
        $msgDienstag = $this->id2msg( 1012 );
        $msgMittwoch = $this->id2msg( 1013 );
        $msgDonnerstag = $this->id2msg( 1014 );
        $msgFreitag = $this->id2msg( 1015 );
        $msgSamstag = $this->id2msg( 1016 );
        $msgSonntag = $this->id2msg( 1017 );

        $check = ( $checked ) ? " checked " : "";

        echo "<tr><td valign=top><input type=radio name = 'strategy' value='s5_weekday' $check>$msgNachWochentagen</td>";
        echo "<td>";
            echo "$msgAm ";
            echo "<select name=s5_counter>";
                $sel = ( ( $this->onFirst ) ? 'selected=1' : '' );
                echo "<option value=first $sel>$msgErsten";
                $sel = ( ( $this->onSecond ) ? 'selected=1' : '' );
                echo "<option value=second $sel>$msgZweiten";
                $sel = ( ( $this->onThird ) ? 'selected=1' : '' );
                echo "<option value=third $sel>$msgDritten";
                $sel = ( ( $this->onFourth ) ? 'selected=1' : '' );
                echo "<option value=fourth $sel>$msgVierten";
                $sel = ( ( $this->onFifth ) ? 'selected=1' : '' );
                echo "<option value=fifth $sel>$msgFuenften";
                $sel = ( ( $this->onLast ) ? 'selected=1' : '' );
                echo "<option value=last $sel>$msgLetzten";
            echo "</select>";

            echo "<select name=s5_weekday>";
                $sel = ( ( $this->onMonday ) ? 'selected=1' : '' );
                echo "<option value=mon $sel>$msgMontag";
                $sel = ( ( $this->onTuesday ) ? 'selected=1' : '' );
                echo "<option value=tue $sel>$msgDienstag";
                $sel = ( ( $this->onWednesday ) ? 'selected=1' : '' );
                echo "<option value=wed $sel>$msgMittwoch";
                $sel = ( ( $this->onThursday ) ? 'selected=1' : '' );
                echo "<option value=thu $sel>$msgDonnerstag";
                $sel = ( ( $this->onFriday ) ? 'selected=1' : '' );
                echo "<option value=fri $sel>$msgFreitag";
                $sel = ( ( $this->onSaturday ) ? 'selected=1' : '' );
                echo "<option value=sat $sel>$msgSamstag";
                $sel = ( ( $this->onSunday ) ? 'selected=1' : '' );
                echo "<option value=sun $sel>$msgSonntag";
            echo "</select>";
            echo " $msgImMonat";
        echo "</td></tr>";


    }   // function FillForm


    public function GetMonday(  ) {

        return  $this->onMonday;

    }

    public function GetTuesday(  ) {

        return  $this->onTuesday;

    }

    public function GetWednesday(  ) {

        return  $this->onWednesday;

    }

    public function GetThursday(  ) {

        return  $this->onThursday;

    }

    public function GetFriday(  ) {

        return  $this->onFriday;

    }

    public function GetSaturday(  ) {

        return  $this->onSaturday;

    }

    public function GetSunday(  ) {

        return  $this->onSunday;

    }

    public function GetOnFirst(  ) {

        return  $this->onFirst;

    }

    public function GetOnSecond(  ) {

        return  $this->onSecond;

    }

    public function GetOnThird(  ) {

        return  $this->onThird;

    }

    public function GetOnFourth(  ) {

        return  $this->onFourth;

    }

    public function GetOnFifth(  ) {

        return  $this->onFifth;

    }

    public function GetOnLast(  ) {

        return  $this->onLast;

    }




    public function SetMonday( $set ) {

        { if ($set) $this->ResetWeekdays( ); $this->onMonday = $set; }

    }

    public function SetTuesday( $set  ) {

        { if ($set) $this->ResetWeekdays( ); $this->onTuesday = $set; }

    }

    public function SetWednesday( $set ) {

        { if ($set) $this->ResetWeekdays( ); $this->onWednesday = $set; }

    }

    public function SetThursday( $set  ) {

        if ($set) $this->ResetWeekdays( );
        $this->onThursday = $set;

    }

    public function SetFriday( $set  ) {

        { if ($set) $this->ResetWeekdays( ); $this->onFriday = $set; }

    }

    public function SetSaturday( $set ) {

        { if ($set) $this->ResetWeekdays( ); $this->onSaturday = $set; }


    }

    public function SetSunday( $set  ) {

        { if ($set) $this->ResetWeekdays( ); $this->onSunday = $set; }


    }

    public function SetOnFirst( $set  ) {
        { if ($set) $this->ResetWeekNumbers( ); $this->onFirst = $set; }
    }

    public function SetOnSecond( $set ) {
       { if ($set) $this->ResetWeekNumbers( ); $this->onSecond = $set; }
    }

    public function SetOnThird( $set  ) {
        { if ($set) $this->ResetWeekNumbers( ); $this->onThird = $set; }
    }

    public function SetOnFourth( $set  ) {
         {  if ($set) $this->ResetWeekNumbers( );$this->onFourth = $set;}
    }

    public function SetOnFifth( $set  ) {
        { if ($set) $this->ResetWeekNumbers( ); $this->onFifth = $set; }
    }

    public function SetOnLast( $set  ) {

         { if ($set) {$this->ResetWeekNumbers( );}$this->onLast = $set;}
    }


    function GetLatestDayNumber( ) {
        // liefere die am höchsten geschaltete Tagesnummer

        if ($this->onSaturday) return 6;
        if ($this->onFriday) return 5;
        if ($this->onThursday) return 4;
        if ($this->onWednesday) return 3;
        if ($this->onTuesday) return 2;
        if ($this->onMonday) return 1;
        if ($this->onSunday) return 0;
    }


    function GetFollower( $date ) {
        // $dateObj muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen

        # echo "<br>GetFollower(".$date->AsDMY(). ") : GetLatestDayNumber() ergibt " . $this->GetLatestDayNumber();

        $dateObj = new cDate( $date);

        $orgMonth = $dateObj->Month();

        $dateObj->GoEOM( );     // NOTE : steht auf dem letzten des Vormonats !
        $fertig = false;

        if ( ($this->onFirst) || ($this->onSecond) || ($this->onThird) || ($this->onFourth) || ($this->onFifth) ) {

            if ( $this->onFirst )  { $anzahl = 1; }
            if ( $this->onSecond ) { $anzahl = 2; }
            if ( $this->onThird )  { $anzahl = 3; }
            if ( $this->onFourth ) { $anzahl = 4; }
            if ( $this->onFifth )  { $anzahl = 5; }

            for ( $i=0; $i<$anzahl;$i++) {
                $dateObj->inc();
                if ( $this->onSunday )    { $dateObj->SeekWeekday(0); }
                if ( $this->onMonday )    { $dateObj->SeekWeekday(1); }
                if ( $this->onTuesday )   { $dateObj->SeekWeekday(2); }
                if ( $this->onWednesday ) { $dateObj->SeekWeekday(3); }
                if ( $this->onThursday )  { $dateObj->SeekWeekday(4); }
                if ( $this->onFriday )    { $dateObj->SeekWeekday(5); }
                if ( $this->onSaturday )  { $dateObj->SeekWeekday(6); }
            }

            if ( $this->IsOverflow( $dateObj ) ) { return undef; }
            if ( $this->IsUnderflow( $dateObj ) ) { return undef; }

            return $dateObj;

        } elseif ($this->onLast) {

            $anzahl = 1;
            $dateObj->GoEOM();
            $dateObj->inc();
            $dateObj->GoEOM();

            for ( $i=0; $i<$anzahl;$i++) {
                $dateObj->dec();
                if ( $this->onSunday )    { $dateObj->SeekWeekday(0, 1); }
                if ( $this->onMonday )    { $dateObj->SeekWeekday(1, 1); }
                if ( $this->onTuesday )   { $dateObj->SeekWeekday(2, 1); }
                if ( $this->onWednesday ) { $dateObj->SeekWeekday(3, 1); }
                if ( $this->onThursday )  { $dateObj->SeekWeekday(4, 1); }
                if ( $this->onFriday )    { $dateObj->SeekWeekday(5, 1); }
                if ( $this->onSaturday )  { $dateObj->SeekWeekday(6, 1); }
            }

            if ( $this->IsOverflow( $dateObj ) ) { return undef; }
            if ( $this->IsUnderflow( $dateObj ) ) { return undef; }

            return $dateObj;

        }

        return undef;

    }





    public function GetFirstDate( ) {

        $dateObj =new cDate($this->m_start_date);

        if ( ($this->onFirst) || ($this->onSecond) || ($this->onThird) || ($this->onFourth) || ($this->onFifth) ) {

            if ( $this->onFirst )  { $anzahl = 1; }
            if ( $this->onSecond ) { $anzahl = 2; }
            if ( $this->onThird )  { $anzahl = 3; }
            if ( $this->onFourth ) { $anzahl = 4; }
            if ( $this->onFifth )  { $anzahl = 5; }

                if ( $this->onSunday )    { $dateObj->SeekWeekday(0); }
                if ( $this->onMonday )    { $dateObj->SeekWeekday(1); }
                if ( $this->onTuesday )   { $dateObj->SeekWeekday(2); }
                if ( $this->onWednesday ) { $dateObj->SeekWeekday(3); }
                if ( $this->onThursday )  { $dateObj->SeekWeekday(4); }
                if ( $this->onFriday )    { $dateObj->SeekWeekday(5); }
                if ( $this->onSaturday )  { $dateObj->SeekWeekday(6); }

            for ( $i=0; $i<$anzahl;$i++) {
                $dateObj->inc();
                # echo "<br> untersuche " . $dateObj->AsDMY() . "i=$i anzahl=$anzahl";
                if ( $this->onSunday )    { $dateObj->SeekWeekday(0); }
                if ( $this->onMonday )    { $dateObj->SeekWeekday(1); }
                if ( $this->onTuesday )   { $dateObj->SeekWeekday(2); }
                if ( $this->onWednesday ) { $dateObj->SeekWeekday(3); }
                if ( $this->onThursday )  { $dateObj->SeekWeekday(4); }
                if ( $this->onFriday )    { $dateObj->SeekWeekday(5); }
                if ( $this->onSaturday )  { $dateObj->SeekWeekday(6); }
            }

            if ( $this->IsOverflow( $dateObj ) ) { return undef; }
            if ( $this->IsUnderflow( $dateObj ) ) { return undef; }

            return $dateObj;

        } elseif ($this->onLast) {

            $anzahl = 1;
            $dateObj->GoEOM();

            for ( $i=0; $i<$anzahl;$i++) {
                if ($i!=0) $dateObj->dec();
                if ( $this->onSunday )    { $dateObj->SeekWeekday(0, 1); }
                if ( $this->onMonday )    { $dateObj->SeekWeekday(1, 1); }
                if ( $this->onTuesday )   { $dateObj->SeekWeekday(2, 1); }
                if ( $this->onWednesday ) { $dateObj->SeekWeekday(3, 1); }
                if ( $this->onThursday )  { $dateObj->SeekWeekday(4, 1); }
                if ( $this->onFriday )    { $dateObj->SeekWeekday(5, 1); }
                if ( $this->onSaturday )  { $dateObj->SeekWeekday(6, 1); }
            }
            # echo "<br>dateobj=".$dateObj->AsDMY();

            if ( $this->IsOverflow( $dateObj ) ) { return undef; }
            if ( $this->IsUnderflow( $dateObj ) ) { return undef; }

            return $dateObj;

        }

        return undef;


    }   // function GetFirstDate



}       // of class cDateStrategyMonthlyFixed

?>