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
//		public method cDateStrategyMonthlyFixed($str=null)
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

namespace rstoetter\libdatephp;

class cDateStrategyMonthlyFixedParams {

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

    public function IsValid( ) {

        $ret =  ($this->onMonday+$this->onTuesday+$this->onWednesday+$this->onThursday+$this->onFriday+$this->onSaturday+$this->onSunday);

        if ( $ret ) {
            $ret =  ($this->onFirst+$this->onSecond+$this->onThird+$this->onFourth+$this->onFifth+$this->onLast) ;
        }

        return $ret;

    }       // function IsValid()

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



}	// class cDateStrategyMonthlyFixedParams

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategyMonthlyFixed
////////////////////////////////////////////////////////////////////////////////////

/**
  *
  * The class cDateStrategyMonthlyFixed calculates recurring monthly events based on weeknumber(s) or day(s) of week base. It is specialized to find one or some events
  * in the weeks, which are part of a certain week number or when the date falls onto a special day number . Certain events in certain weeks. For example it can solve
  * the problem to find matching events for the second thursday and friday in a month.
  *
  * @author Rainer Stötter
  * @copyright 2010-2017 Rainer Stötter
  * @license MIT
  *
  * @see cDateStrategyDaily
  * @see cDateStrategyDailyFixed
  * @see cDateStrategyMonthly
  * @see cDateStrategyMonthlyFixed
  * @see cDateStrategyNoInterval
  * @see cDateStrategySimpleDate
  * @see cDateStrategySimpleInterval
  * @see cDateStrategyMonthlyFixed
  *
  */

class cDateStrategyMonthlyFixed extends cDateStrategy {

    // bestimmte Wochentage alle x Wochen

    /**
      * The property m_on_last_week is true, if the 'last week' of the month is allowed
      *
      * @var boolean $m_on_last_week is true, if the last week of the month is allowed for scheduling. It defaults to false
      *
      */


    protected $m_on_last_week = false;

    /**
      * The property m_on_any_week is true, if all weeks are allowed
      *
      * @var boolean $m_on_any_week is true, if all week numbers are allowed for scheduling. It defaults to false
      *
      */


    protected $m_on_any_week = false;

    /**
      * The ordered arrays $m_a_selected_weeks and $m_a_selected_week_days contain the selected weeks and days of week, on which events are
      * possible.
      *
      * The week numbers are one-based. The value 1 means the first week of a month and 5 the fith week. the value of self::CONST_ANY_WEEK means the  'last week'
      * The week day numbers are zero-based integers ( first day of week = 0 ) which stand for the days of week to reserve for events
      *
      * $m_a_selected_weeks the one-based week numbers
      * $m_a_selected_week_days the zero-based week day numbers
      *
      * @var array $m_a_selected_weeks ordered array with one-based week numbers
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      *
      */

      protected $m_a_selected_weeks = array( );

    /**
      * The ordered arrays $m_a_selected_weeks and $m_a_selected_week_days contain the selected weeks and days of week, on which events are
      * possible.
      *
      * The week numbers are one-based. The value 1 means the first week of a month and 5 the fith week. the value of self::CONST_ANY_WEEK means the  'last week'
      * The week day numbers are zero-based integers ( first day of week = 0 ) which stand for the days of week to reserve for events
      *
      * $m_a_selected_weeks the one-based week numbers
      * $m_a_selected_week_days the zero-based week day numbers
      *
      * @var array $m_a_selected_weeks ordered array with one-based week numbers
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      * @see GetLatestDayNumber
      *
      */

      protected $m_a_selected_week_days = array( );


/////////////////////



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

            if ( $this->IsOverflow( $dateObj ) ) { return null; }
            if ( $this->IsUnderflow( $dateObj ) ) { return null; }

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

            if ( $this->IsOverflow( $dateObj ) ) { return null; }
            if ( $this->IsUnderflow( $dateObj ) ) { return null; }

            return $dateObj;

        }

        return null;


    }   // function GetFirstDate

    /**
      * The method GetWeekDayArray( $ary ) returns in $ary the set week numbers
      *
      *  The array is zero-based
      *
      *
      * @param array $ary the zero-based array with the set week days
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      * @see GetLatestDayNumber
      */

      public function GetWeekDayArray( & $ary ) {

	  $ary = array( );

	  for ( $i = 0; $i < count( $this->m_a_selected_week_days ); $i++ ) {

	      $ary[ ] = $this->m_a_selected_week_days[ $i ];

	  }


      }  // function GetWeekDayArray( )

    /**
      * The method GetWeekArray( $ary ) returns in $ary the set week numbers
      *
      *  The array is zero-based
      *
      *
      * @param array $ary the zero-based array with the set week numbers
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      */

      public function GetWeekArray( & $ary ) {

	  $ary = array( );

	  for ( $i = 0; $i < count( $this->m_a_selected_weeks ); $i++ ) {

	      $ary[ ] = $this->m_a_selected_weeks[ $i ];

	  }


      }  // function GetWeekArray( )

    /**
      * The method GetFullWeekDayArray( $ary ) returns in $ary 6 int entries. The entries are 1, when the specific
      * week day is set and 0, when not
      *
      *  The array is zero-based - The array element with the index 0 stands for the first week day 6 for the last one
      *
      *
      * @param array $ary the zero-based array with the week days
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      * @see GetLatestDayNumber
      */

      public function GetFullWeekDayArray( & $ary ) {

	  $ary = array( );

	  for ( $i = 0; $i < 6; $i++ ) {
	      $ary[] = 0;
	  }

	  for ( $i = 0; $i < count( $this->m_a_selected_week_days ); $i++ ) {

	      $ary[ $this->m_a_selected_week_days[ $i ] - 1  ] = 1;

	  }


      }  // function GetFullWeekDayArray( )


    /**
      * The method GetFullWeekArray( $ary ) returns in $ary 7 int entries. The entries are 1, when the specific
      * month is set and 0, when not
      *
      *  The array is zero-based - The array element with the index 0 stands for the first week and 4 for 5-th. The sixth element stands for the "last week"
      *
      *
      * @param array $ary the zero-based array with the weeks
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      */

      public function GetFullWeekArray( & $ary ) {

	  $ary = array( );

	  for ( $i = 0; $i < 7; $i++ ) {
	      $ary[] = 0;
	  }

	  for ( $i = 0; $i < count( $this->m_a_selected_weeks ); $i++ ) {

	      $ary[ $this->m_a_selected_weeks[ $i ] - 1  ] = 1;

	  }


      }  // function GetFullWeekArray( )


    /**
      * The method AddWeekDay( $n ) adds the $n-th day of a week to the list of possible event days
      *
      *  The week day numbers are zero-based. The value 0 means the first day (sunday) in the week and 6 the last day (saturday).
      *
      *
      * @param int $n the week day number to add to the list of possible event days
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      * @see GetLatestDayNumber
      */


      public function AddWeekDay( $n ) {

	  if ( ! in_array( $n, $this->m_a_selected_week_days ) ) {

	      $this->m_a_selected_week_days[] = $n;

	      sort( $this->m_a_selected_week_days );

	  }


      }  // function AddWeekDay( )

    /**
      * The method ResetWeekDays( ) removes all week days from the list of possible event days
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ResetWeeknumbers
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      * @see GetLatestDayNumber
      */


      public function ResetWeekDays( ) {

	   $this->m_a_selected_week_days = array( );

      }  // function ResetWeekDays( )

    /**
      * The method ResetWeekNumbers( ) removes all week numbers from the list of possible event weeks
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ResetWeeknumbers
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      * @see GetLatestDayNumber
      */


      public function ResetWeekNumbers( ) {

	   $this->m_a_selected_weeks = array( );

      }  // function ResetWeekNumbers( )

    /**
      * The method RemoveWeekDay( $n ) removes the $n-th day of a week from the list of possible event days
      *
      *  The week day numbers are zero-based. The value 0 means the first day (sunday) in the week and self::CONST_ANY_WEEK the last day (saturday).
      *
      *
      * @param int $n the week day number to remove from the list of possible event days
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      * @see GetLatestDayNumber
      *
      */


      public function RemoveWeekDay( $n ) {

	  if ( in_array( $n, $this->m_a_selected_week_days ) ) {

	      for ( $i = 0; $i < count( $this->m_a_selected_week_days ); $i++ ) {

		  if ( $this->m_a_selected_week_days[ $i ] == $n ) {

		      unset( $this->m_a_selected_week_days[ $i ] );

		      break;

		  }

	      }

	      $this->m_a_selected_week_days = array_values( $this->m_a_selected_week_days );

	  }


      }  // function RemoveWeekDay( )


    /**
      * The method ExistsWeekDay( $n ) returns true, if the week day number $n is in the list of possible event days
      *
      *  The week day numbers are zero-based. The value 0 means the first day in the week ( sunday ) and self::CONST_ANY_WEEK the last day ( saturday).
      *
      *
      * @param int $n the week day number to search in the list of possible event days
      * @returns boolean true, if $n is in the  list of possible event days
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      * @see GetLatestDayNumber
      *
      */


      public function ExistsWeekDay( $n ) {

	  return in_array( $n, $this->m_a_selected_week_days ) ;

      }  // function ExistsWeekDay( )

/////////

    /**
      * The method AddWeek( $n ) adds the $n-th week of the month to the list of possible event weeks
      *
      *  The week numbers are one-based. The value 1 means the first week of a month and 5 the fith week. self::CONST_ANY_WEEK means the 'last week'
      *
      *
      * @param int $n the one-based week number to add to the list of possible weeks for events
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      *
      */


      public function AddWeek( $n ) {

	  if ( ! in_array( $n, $this->m_a_selected_weeks ) ) {

	      $this->m_a_selected_weeks[] = $n;

	      sort( $this->m_a_selected_weeks );

	  }


      }  // function AddWeek( )

    /**
      * The method ResetWeeks( ) removes all weeks from the list of possible weeks for events
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      *
      */


      public function ResetWeeks( ) {

	   $this->m_a_selected_weeks = array( );

      }  // function ResetWeeks( )


    /**
      * The method RemoveWeek( $n ) removes the $n-th week from the list of possible weeks for events
      *
      *  The week numbers are one-based. The value 1 means the first week of a month and 5 the fith week. the value of self::CONST_ANY_WEEK means the  'last week'
      *
      * @param int $n the number of the month to remove from the list of possible weeks for events
      *
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      *
      */


      public function RemoveWeek( $n ) {

	  if ( in_array( $n, $this->m_a_selected_weeks ) ) {

	      for ( $i = 0; $i < count( $this->m_a_selected_weeks ); $i++ ) {

		  if ( $this->m_a_selected_weeks[ $i ] == $n ) {

		      unset( $this->m_a_selected_weeks[ $i ] );

		      break;

		  }

	      }

	      $this->m_a_selected_weeks = array_values( $this->m_a_selected_weeks );

	  }


      }  // function RemoveWeek( )


    /**
      * The method ExistsWeek( $n ) returns true, if the week with the number $n is in the list of possible weeks for events
      *
      *  The week numbers are one-based. The value 1 means the first week of a month and 5 the fith week. the value of self::CONST_ANY_WEEK means the  'last week'
      *
      * @param int $n the number of the week to search in the list of possible weeks for events
      * @returns boolean true, if $n is in the  list of possible weeks for events
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      *
      */


      public function ExistsWeek( $n ) {

	  return in_array( $n, $this->m_a_selected_weeks ) ;

      }  // function ExistsWeek( )


    /**
      * The constructor of cDateStrategyMonthlyFixed
      *
      *  Example:
      *
      *      $strategy = new \libdatephp\cDateStrategyMonthlyFixed(
      *				new \libdatephp\cDate( ),,
      *				null,
      *				'en_en',
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_LEAVE,
      *				\libdatephp\cDateStrategy::STRATEGY_DIRECTION_FORWARD
      *				);
      *
      *	    $strategy2 = new \libdatephp\cDateStrategyMonthlyFixed( $strategy->AsString( ) );
      *
      *	    $strategy3 = new \libdatephp\cDateStrategyMonthlyFixed( );
      *
      *	    $strategy4 = new \libdatephp\cDateStrategyMonthlyFixed( '' ); // TODO - stimmt hier nicht
      *
      *
      * @example "./tst/tst-cDateStrategyMonthlyFixed.php" Full Example:
      *
      *
      *
      * @param mixed $start_date mixed If it is a string, then the template for the algorithm got by AsString( ). If it is a cDate: the date, from which the calcultions should start. If it is null, then the actual date will be used. $start_date defaults to null
      * @param string $end_date string with language or null when $start_date is a template. Else cDate the date, where the calcultions should stop. If it is null, then there is no ending date for the calculations. $end_date defaults to null
      * @param string $language string the language for messages. ('de_de', 'en_en' or 'fr_fr'). It defaults to 'en_en'.
      * @param int $directionOnSaturday int controls how to proceed, when the algorithm encounters a saturday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param int $directionOnSunday int controls how to proceed, when the algorithm encounters a sunday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param int $directionOnCelebrity int controls how to proceed, when the algorithm encounters a celebrity. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param int $m_directionOnHoliday int controls how to proceed, when the algorithm encounters a holiday. It defaults to self::STRATEGY_DIRECTION_LEAVE.
      * @param int $directionOnImpossible int controls how to proceed, when the algorithm encounters an impossible situation. It defaults to self::STRATEGY_DIRECTION_FORWARD.
      *
      * @return cDateStrategyMonthlyFixed
      *
      */

    function __construct(
			$start_date = null,
			$end_date = null,
			$language = 'en_en',
			$directionOnSaturday = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnSunday = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnCelebrity = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnHoliday = self::STRATEGY_DIRECTION_LEAVE,
			$directionOnImpossible = self::STRATEGY_DIRECTION_FORWARD
			)  {

	   $this->Reset( );

	  if ( is_string( $start_date ) ) {

	      // read the template

	      $this->FromString( $start_date ) ;

	      $this->m_language = ( is_null( $end_date ) ? 'en_en' : $end_date  );

	      // initialize by parent

	      parent::__construct(
			    $this->m_start_date,
			    $this->m_end_date,
			    $this->m_language,
			    $this->m_directionOnSaturday,
			    $this->m_directionOnSunday,
			    $this->m_directionOnCelebrity,
			    $this->m_directionOnHoliday,
			    $this->m_directionOnImpossible
			    );

	  } else {

	      // parental initialization

	      parent::__construct(
			    $start_date,
			    $end_date,
			    $language,
			    $directionOnSaturday,
			    $directionOnSunday,
			    $directionOnCelebrity,
			    $directionOnHoliday,
			    $directionOnImpossible
			    );

	  }

    }   // constructor



/*
    public function cDateStrategyMonthlyFixed( $str = null ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str ==null ) {
                $this->Reset( );
            } else {
                $this->FromString( $str ) ;
            }

            $this->IsValid();

    }   // constructor
*/

    /**
      * The method Reset( $n ) resets the internal values for week numbers and week day numbers
      *
      * @see Reset
      * @see ResetMonthDays
      * @see ResetMonths
      *
      */


    public function Reset( ) {

        parent::Reset();

        $this->ResetWeekdays( );
        $this->ResetWeekNumbers();

    }

    /**
      * The method IsValid( ) returns true, if the calculations can start.
      * In order to run, at least one week number and one week day number have to be set before.
      *
      * @see AddMonth
      * @see AddMonthDay
      *
      */


    public function IsValid( ) {


        $ret = ( count( $this->m_a_selected_weeks ) && ( count( $this->m_a_selected_week_days ) ) );

        return $ret;

    }       // function IsValid()



/*
    public function IsValid( ) {

        $ret =  ($this->onMonday+$this->onTuesday+$this->onWednesday+$this->onThursday+$this->onFriday+$this->onSaturday+$this->onSunday);

        if ( $ret ) {
            $ret =  ($this->onFirst+$this->onSecond+$this->onThird+$this->onFourth+$this->onFifth+$this->onLast) ;
        }

        return $ret;

    }       // function IsValid()
*/

    /**
      * The method FromString( ) reads the specifications of the strategy from the string $str
      * The template starts with 's5' and is normally made by AsString( ). The
      * string template can be used for serialization.
      *
      * The calendars for celebrities and holidays remain untouched.
      *
      * @param string $str the specifications as string as we get it via AsString( )
      *
      * @see FromString
      * @see AsString
      */

    public function FromString( $str ) {

        sscanf( $str, "s5-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{%d:%d:%d:%d:%d:%d:%d}-{%d:%d:%d:%d:%d:%d:%d}",
            $directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $onSunday, $onMonday, $onTuesday, $onWednesday, $onThursday, $onFriday, $onSaturday,
            $onFirst, $onSecond, $onThird, $onFourth, $onFifth, $onLast, $onAny);

//         $this->m_start_date->SetDate($startmonth, $startday, $startyear );

        $this->ResetMonths( );
        $this->ResetMonthDays( );

        $this->m_on_any_week = ( $onAny == 1 );
        $this->m_on_last_week = ( $onLast == 1 );

        if ( $onSunday ) $this->m_a_selected_week_days[] = 0;
        if ( $onMonday ) $this->m_a_selected_week_days[] = 1;
        if ( $onTuesday ) $this->m_a_selected_week_days[] = 2;
        if ( $onWednesday ) $this->m_a_selected_week_days[] = 3;
        if ( $onThursday ) $this->m_a_selected_week_days[] = 4;
        if ( $onFriday ) $this->m_a_selected_week_days[] = 5;
        if ( $onSaturday ) $this->m_a_selected_week_days[] = 6;

	if ( $onFirst ) $this->m_a_selected_weeks[] = 1;
	if ( $onSecond ) $this->m_a_selected_weeks[] = 2;
	if ( $onThird ) $this->m_a_selected_weeks[] = 3;
	if ( $onFourth ) $this->m_a_selected_weeks[] = 4;
	if ( $onFifth ) $this->m_a_selected_weeks[] = 5;
	if ( $onLast ) $this->m_a_selected_weeks[] = 6;


        if ($endday==0) {
            $this->m_end_date = null;
        } else {
            $this->m_end_date = new cDate($endmonth, $endday, $endyear );
        }

        if ($startday==0) {
            $this->m_start_date = null;
        } else {
            $this->m_start_date = new cDate($startmonth, $startday, $startyear );
        }

            $this->IsValid();

    }   // function FromString

    /**
      * The method AsString( ) returns the specifications of the strategy as a string template. It normally is used
      * by the constructor or by FromString for serialization.
      *
      * @return string the specifications as string template
      *
      *
      * @see FromString
      * @see AsString
      *
      */


    public function AsString( ) {

        if ( $this->m_end_date == null ){
            $endday = $endmonth = $endyear = 0;
        } else {
            $endday = $this->m_end_date->Day();
            $endmonth = $this->m_end_date->Month();
            $endyear = $this->m_end_date->Year();
        }

        if ( $this->m_start_date == null ){
            $startday = $startmonth = $startyear = 0;
        } else {
            $startday = $this->m_start_date->Day();
            $startmonth = $this->m_start_date->Month();
            $startyear = $this->m_start_date->Year();
        }


        $on_last = $this->m_on_last_week ? 1 : 0;
        $on_any = $this->m_on_any_week ? 1 : 0;

	$this->GetFullWeekArray( $a_weeks );
	$str_weeks = implode( ':', $a_weeks );

	$this->GetFullWeekdayArray( $a_week_days );
	$str_week_days = implode( ':', $a_week_days );

        return sprintf( "s5-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{{$str_week_days}}-{{$str_weeks}:%d:%d}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear, $on_last, $on_any
             );
    }   // function AsString



    /**
      * The method GetLatestDayNumber( ) returns highest week day number used
      *
      * @return int the highest week day number or -1, if there are no week day numbers
      *
      * @see $m_a_selected_weeks
      * @see $m_a_selected_week_days
      * @see AddWeekday
      * @see ResetWeekdays
      * @see ExistsWeekday
      * @see GetFullWeekdayArray
      * @see AddWeek
      * @see ResetWeeks
      * @see ExistsWeek
      * @see GetFullWeekArray
      * @see GetWeekArray
      * @see GetWeekdayArray
      * @see GetLatestDayNumber
      *
      *
      */


    function GetLatestDayNumber( ) {
	//
        // liefere die am höchsten geschaltete Tagesnummer
	//

	$ret = -1;

	foreach ( $this->m_a_selected_week_days as $weekday ) {
	    $ret = max( $ret, $max );
	}

	return $ret;

    }

    /**
      * The method PrintWeeksAndWeekDays( ) prints the day and month numbers
      *
      * @see Dump
      *
      */

    protected function PrintDaysAndWeeks(  ) {

	$this->GetWeekArray( $months );

	$str_months = implode( ',', $months );

	$this->GetWeekDayArray( $days );

	$str_days = implode( ',', $days );

	echo "\n The week days set for events are {$str_days} for the weeks {$str_months}";


    }	// functiom PrintDaysAndWeeks( )

    /**
      * The method Dump( ) prints the internal state of the strategy
      *
      *
      * @param cDate $obj_date_calc_from  date, where the calculations should start
      * @param cDate $obj_date_calc_to  date, where the calculations should end
      * @param int $direction the direction on the time line
      */

    public function Dump( $obj_date_calc_from, $obj_date_calc_to, $direction ) {

	parent::Dump( $obj_date_calc_from, $obj_date_calc_to, $direction );

	$this->PrintDaysAndWeeks( );

	echo "\n all weeks allowed = " . ( $this->OnAnyWeek( ) ? ' true' : ' false' );
	echo "\n last weeks        = " . ( $this->OnLastWeek( ) ? ' true' : ' false' );

    }   // function Dump( )

    /**
      * The method OnAnyWeek( ) returns true, if all weeks are allowed
      *
      * @return boolean returns true, if all week numbers are allowed for scheduling
      *
      * @see OnAnyWeek
      * @see SetOnAnyWeek
      *
      */



    public function OnLastWeek( ) {

	return $this->m_on_last_week;

    }  // functiom OnLastWeek( )

    /**
      * The method SetOnLastWeek( ) allows / disallows all weeks of a month for scheduling
      *
      * @param boolean $allow if true, then all week numbers are allowed for scheduling and false, if not. Defaults to true
      *
      * @see OnLastWeek
      * @see SetOnLastWeek
      */


    public function SetOnLastWeek( $allow = true ) {

	$this->m_on_last_week = $allow;

    }  // functiom SetOnLastWeek( )

    /**
      * The method OnAnyWeek( ) returns true, if all weeks are allowed
      *
      * @return boolean returns true, if all week numbers are allowed for scheduling
      *
      * @see OnAnyWeek
      * @see SetOnAnyWeek
      *
      */



    public function OnAnyWeek( ) {

	return $this->m_on_any_week;

    }  // functiom OnAnyWeek( )

    /**
      * The method SetOnAnyWeek( ) allows / disallows all weeks of a month for scheduling
      *
      * @param boolean $allow if true, then all week numbers are allowed for scheduling and false, if not. Defaults to true
      *
      * @see OnAnyWeek
      * @see SetOnAnyWeek
      */


    public function SetOnAnyWeek( $allow = true ) {

	$this->m_on_any_week = $allow;

    }  // functiom SetOnAnyWeek( )


    /**
      * The method WOY2WOM(  ) returns the week of month specified by the week of year $woy and the year $year
      *
      * @param int $woy the week of year
      * @param int $year the year
      *
      * @return int the week of month
      *
      */


    private function WOY2WOM( $woy, $year ) {

	$dt = new cDate( );
	$dt->SetYear( $year );
	$dt->SetWOY( $woy );
	return $dt->WOM( );

    }	// functiom WOY2WOM( )

    /**
      * The method WOM2WOY(  ) returns the week of year specified by the week of month $wom and the month $month and the year $year
      *
      * @param int $wom the week of month
      * @param int $month the month
      * @param int $year the year
      *
      * @return int the week of year
      *
      */

    private function WOM2WOY( $wom, $month, $year ) {

	$dt = new cDateISO( );
	$dt->SetYear( $year );
	$dt->SetMonth( $month );
	$dt->GoWOM( $wom );


	return $dt->WOY( false );

    }	// functiom WOM2WOY( )

/*
    private function AssignNextWOY( & $woy, & $year, & $month ) {

	  $wom = $this->WOY2WOM( $woy, $year );

	  $tmp = new cDate( );
	  $tmp->SetYear( $year );

	  $month = $tmp->Month( );

	  do {

	      $weeks = $tmp->WeeksOfMonth( );

	      if ( $weeks == $wom ) {

		  $tmp->AddMonths( 1 );
		  $wom = $this->m_a_selected_weeks[ 0 ];
		  $tmp->GoWOM( $wom );

		  $woy = $tmp->WOY( false );
		  $year = $tmp->Year( );
		  $month = $tmp->Month( );

		  return;

	      } else {

		$wom++;

	      }

	  } while( ! in_array( $tmp->WOM( ), $this->m_a_selected_weeks ) );

	  return $this->WOM2WOY( $wom, $month, $year );

    }	// functiom AssignNextWOY( )

*/


/*
    private function AssignNextWeekDay( & $weekday, & $woy, & $year ) {

	assert( ! is_null( $woy ) );
	assert( $weekday != -1 );

	if ( $this->m_debug ) echo "\n assigning weekday from weekday $weekday in woy = $woy in year $year";

	    for ( $i = 0; $i < count( $this->m_a_selected_week_days ); $i++ ) {

		if ( $this->m_a_selected_week_days[ $i ] == $weekday ) {

		    if ( $i < count( $this->m_a_selected_week_days ) - 1  ) {
			$weekday = $this->m_a_selected_week_days[ $i + 1 ];
			if ( $this->m_debug ) echo "\n next possible week day slot (1) = $weekday in woy = $woy";
			break;
		    } else {
			$weekday = $this->m_a_selected_week_days[ 0 ];
			// $woy++;

			$this->AssignNextWOY( $woy, $year, $month );

			// $wom++;
			if ( $this->m_debug ) echo "\n next possible week day slot (2) = $weekday in woy = $woy";
			break;
		    }

		} elseif ( $this->m_a_selected_week_days[ $i ] > $weekday ) {
		    $weekday = $this->m_a_selected_week_days[ $i ];
		    if ( $this->m_debug ) echo "\n next possible week day slot (3) = $weekday in woy = $woy";
		    break;
		}

	    }

	    $tmp = new cDate( );
	    $tmp->GoBOY( );
	    $tmp->SetYear( $year );
	    $tmp->SetWOY( $woy, $weekday );

	    echo "\n ";

	if ( $this->m_debug ) echo "\n assigned weekday $weekday in woy = $woy in year $year date would be " . $tmp->AsSQL( );

    }

*/

    /**
      * The method CheckWeek(  ) corrects the week $w if it is greater than the months' week count or 0
      *
      * @param int $w the week of month, which can be changed
      * @param int $month the month
      * @param int $year the year
      * @param int $wd the day of week
      * @param int $direction is the direction DIRECTION_FORWARD or DIRECTION_BACKWARD
      *
      */


    private function CheckWeek( & $w, & $month, & $year, & $wd, $direction ) {

	if ( $this->m_debug ) echo "\n CheckWeek with w = $w month = $month year = $year";

	$dt = new cDateISO( $month, 15, $year );
	$dt->BelongsToMonth( $month, $year );
	$dt = $dt->FirstWeekOfMonth( $month , $year );
	$weeks = $dt->WeeksOfMonth( );

	if ( $this->m_on_last_week ) {
	    if ( $w == $weeks ) {
		return;
	    }
	}


	if ( $this->m_on_any_week ) {
	    if ( $w > $weeks ) {
		$w = $weeks;
		if ( $this->m_debug ) echo "\n CheckWeek: 1 adjusted w to $w";
		return;
	    }

	}
	//
	if ( in_array( $w, $this->m_a_selected_weeks ) && ( $weeks > $w ) ) {
	    return;
	}


	if ( $w > $weeks ) {
	   if ( $this->m_on_any_week ) {
	      $w = $weeks;
	      if ( $this->m_debug ) echo "\n CheckWeek: 2 adjusted w to $w";
	      return;
	   }


	   if ( $direction == self::DIRECTION_FORWARD ) {

	      echo "\n checking week forward";

	      $w = end( $this->m_a_selected_weeks );

	      $wd = $this->m_a_selected_week_days[ 0 ];

	     if ( $w > $weeks ) {
		 for( $i = count( $this->m_a_selected_weeks ) - 1 ; $i >= 0; $i-- ) {
		      if ( $this->m_a_selected_weeks[ $i ] <= $weeks ) {
			  $w = $this->m_a_selected_weeks[ $i ];
			  if ( $this->m_debug ) echo "\n CheckWeek: 3 adjusted w to $w";
			  break;
		      }
		  }

		  $month++;
		  if ( $month > 12 ) {
		      $year++;
		      $month = 1;
		  }

	      }
	   } elseif ( $direction == self::DIRECTION_BACKWARD ) {

	      echo "\n checking week backward";

	      $w = $this->m_a_selected_weeks[ 0 ];

	      $wd = end( $this->m_a_selected_week_days );

	      if ( $w > $weeks ) {
		  for( $i = 0 ; $i < count( $this->m_a_selected_weeks ) - 1; $i++ ) {
		      if ( $this->m_a_selected_weeks[ $i ] > $weeks ) {
			  $w = $this->m_a_selected_weeks[ $i ];
			  if ( $this->m_debug ) echo "\n CheckWeek: 3 adjusted w to $w";
			  break;
		      }
		  }

		  $month--;
		  if ( $month < 1 ) {
		      $year--;
		      $month = 12;
		  }
	      }
	   }

	}

	if ( $w < 1 ) {

	    if ( $direction == self::DIRECTION_FORWARD ) {
		die( "\n impossible situation week = $w and forward" );
	    } elseif ( $direction == self::DIRECTION_BACKWARD ) {
		echo "\n BW: week = $w";
		$w = end( $this->m_a_selected_weeks );
		$month--;
		if ( $month < 1 ) {
		    $month = 12;
		    $year--;
		}
		echo " adjusted to week = $w in $year/$month ";


	    }

	}

    } 	// functiom CheckWeek( )


    /**
      * The method AdjustWeekDay(  ) corrects the day of week $wd by choosing a fitting one, if necessary. This change can bring changes of the other parameters, too
      *
      * @param int $w the week of month, which can be changed
      * @param int $month the month, which can be changed
      * @param int $year the year, which can be changed
      * @param int $wd the day of week, which can be changed
      * @param int $direction the direction - DIRECTION_FORWARD or DIRECTION_BACKWARD
      *
      */

    private function AdjustWeekDay( & $w, & $month, & $year, & $wd, $direction ) {

	if ( ! in_array( $wd, $this->m_a_selected_week_days ) ){

 	if ( $direction == self::DIRECTION_FORWARD) {

		// suche ersten Eintrag, der größer ist als $wd
		$found = false;
		for ( $i = 0; $i < count( $this->m_a_selected_week_days ); $i++ ) {

		    if ( $wd < $this->m_a_selected_week_days[ $i ] ) {
			$found = true;
			echo "\n $wd is less than " . $this->m_a_selected_week_days[ $i ];
			break;
		    }

		}

		if ( $found ) echo "\n found wd = $wd is smaller than " . $this->m_a_selected_week_days[ $i ];

		if ( ! $found ) {

		    echo "\n could not find wd = $wd";

		    $wd = $this->m_a_selected_week_days[ 0 ];
		    $w++;

 		    $dt = new cDateISO( $month, 15, $year );
 		    $dt->BelongsToMonth( $month, $year );
 		    $dt = $dt->FirstWeekOfMonth( $month, $year );

		    if ( $w > $dt->WeeksOfMonth( ) ) {

			$w = 1;
			$month++;
			if ( $month > 12 ) {
			    $month = 1;
			    $year++;
			}

		    }

		} else {
		    // in $this->m_a_selected_week_days[ $i ] befindet sich der nächsthöhere Wochentagseintrag

		    if ( $i > 0  ) {
			echo "\n wd (0) -> " . $this->m_a_selected_week_days[ $i  ];
			$wd = $this->m_a_selected_week_days[ $i ];
		    } else {
    // 		    echo "\n greife letzten weekday ab";
    // 		    $wd = end( $this->m_a_selected_week_days );
			echo "\n wd (1) -> " . $this->m_a_selected_week_days[ 0 ];
			$wd = $this->m_a_selected_week_days[ 0 ];

			$w++;
			$dt = new cDateISO( $month, 15, $year );
			$dt->BelongsToMonth( $month, $year );
			$dt = $dt->FirstWeekOfMonth( $month, $year );
			if ( $w > $dt->WeeksOfMonth( ) ) {

			    $month++;
			    if ( $month > 12 ) {
				$month = 1;
				$year++;
			    }

			}


		    }

		}

		echo "\n Adjusted WeekDay w = $w, m =$month, y = $year, wd = $wd ";

	    } elseif ( $direction == self::DIRECTION_BACKWARD) {

		$found = false;
		for ( $i = count( $this->m_a_selected_week_days ) - 1; $i >= 0; $i-- ) {

		    if ( $wd > $this->m_a_selected_week_days[ $i ] ) {
			$found = true;
			break;
		    }

		}

		if ( ! $found ) {
		    // keinen Eintrag gefunden, der kleiner oder gleich $wd ist

		    echo "\n BW not found $wd in m_a_selected_week_days";


// 		    $wd = end( $this->m_a_selected_week_days );
 		    if ( $wd != cDate::DOW_SUNDAY ) {
			$wd = end( $this->m_a_selected_week_days );
			$w = end( $this->m_a_selected_weeks );
			$month--;
			if ( $month < 1 ) {
			    $month = 12;
			    $year--;
			}
		    } else {
			$wd = end( $this->m_a_selected_week_days );
		    }

		    echo "\n w = $w und wd = $wd und month = $month";

// 		    $dt = new cDateISO( );
// 		    $dt = $dt->FirstWeekOfMonth( $month, $year );

		    // $this->CheckWeek( $w, $month, $year, $wd, $direction );
		    $this->AdjustWeek(  $w,  $month,  $year,  $wd, $direction );


		} else {

		    echo "\n BW found $wd in m_a_selected_week_days";

		    if ( $i <= 0  ) {
			echo "\n BW wd (0) -> " . $this->m_a_selected_week_days[ $i  ];
			$wd = $this->m_a_selected_week_days[ 0 ] ;
			echo "\n BW wd wird $wd";
// 			$this->CheckWeek( $w, $month, $year, $wd, $direction );
			$this->AdjustWeek(  $w,  $month,  $year,  $wd, $direction );

		    } else {
    // 		    echo "\n greife letzten weekday ab";
    // 		    $wd = end( $this->m_a_selected_week_days );
			echo "\n BW wd (1) -> " . end( $this->m_a_selected_week_days );
			// $wd = end( $this->m_a_selected_week_days );
			$wd = $this->m_a_selected_week_days[ $i ] ;

			$w--;
			$dt = new cDateISO( $month, 15, $year );
			$dt->BelongsToMonth( $month, $year );
			$dt = $dt->FirstWeekOfMonth( $month, $year );
			if ( $w < 1 ) {
			    $w = end( $this->m_a_selected_weeks );
			    $month--;
			    if ( $month < 1 ) {
				$month = 12;
				$year--;
			    }

			}


		    }

		}

		echo "\n BW Adjusted WeekDay w = $w, m =$month, y = $year, wd = $wd ";
	    }


	}




    }	// functiom AdjustWeekDay( )

    /**
      * The method IsGoodDate(  ) returns true, if the parameters are valid
      *
      * @param int $w the week of month
      * @param int $month the month
      * @param int $year the year
      * @param int $wd the day of week
      *
      */

    protected function IsGoodDate( $w, $month, $year, $wd ) {

	$dt = new cDateISO( $month, 15, $year );
	$dt->BelongsToMonth( $month, $year );
	$dt = $dt->FirstWeekOfMonth( $month , $year );
	$weeks = $dt->WeeksOfMonth( );

	if ( $w > $weeks ) return false;

	if ( $wd < cDate::DOW_SUNDAY || $wd > cDate::DOW_SATURDAY ) return false;
	if ( ! in_array( $wd, $this->m_a_selected_week_days ) ) return false;

	if ( $month < 1 || $month > 12 ) return false;


	$dt = new cDateISO( $month, 15, $year );
	$dt->BelongsToMonth( $month, $year );
	$dt = $dt->FirstWeekOfMonth( $month , $year );
	$dt->GoWOM( $w, $wd );
	$dt = $dt->FirstWeekOfMonth( $month , $year );
	$weeks = $dt->WeeksOfMonth( );

	if ( $w > $weeks ) return false;
	if ( ! in_array( $w, $this->m_a_selected_weeks ) ) {

	    if ( ! $this->m_on_any_week ) {
		if ( ! ( $this->m_on_last_week && $w == $weeks ) ) {
		    return false;
		}
	    }
	}


	return true;


    }	// functiom IsGoodDate( )


/*
      private function NextWeekday( & $w, & $month, & $year, & $wd, $direction ) {


      }	// functiom NextWeekday( );
  */

    /**
      * The method FirstWeekday(  ) tries to find the first day of week, which comes after / before ( depending on $direction ) $dt_start.
      *
      * @param int $w the week of month, which can be changed
      * @param int $month the month, which can be changed
      * @param int $year the year, which can be changed
      * @param int $wd the day of week, which can be changed
      * @param int $direction the direction - DIRECTION_FORWARD or DIRECTION_BACKWARD
      * @param cDateISO dt_start is the date, where to start
      *
      */


    private function FirstWeekday( & $w, & $month, & $year, & $wd, $direction, $dt_start ) {

	if ( $this->m_debug )  echo "\n FirstWeekday startet mit w = $w und month = $month und year = $year und wd = $wd";

	if( $wd < cDate::DOW_SUNDAY || $wd > cDate::DOW_SATURDAY ) {
	    die( "\n FirstWeekday: error: wrong weekday = $weekday" );
	}

	$i = 0;

	if ( $direction == self::DIRECTION_FORWARD )	{
/*
	      $first = new cDateISO( $month, 1, $year );
	      $first = $first->FirstWeekOfMonth( $month , $year );
	      $first->SeekWeekday( $wd );
*/
/*
	      $wd++;
	      if ( $wd > cDate::DOW_SATURDAY ) {

		  $dt = new cDateISO( $dt_start );
		  $dt = $dt->FirstWeekOfMonth( $month , $year );

		  $w++;
		  $wd = cDate::DOW_SUNDAY;
		  if ( $w > $dt->WeeksOfMonth( ) ) {
		      $w = 1;
		      $month++;
		      if ( $month > 12 ) {
			  $month = 1;
			  $years++;
		      }
		  }
	      }
*/
	      if ( $this->m_debug ) echo "\n - initial week day: month = $month year = $year and wd = $wd and w = $w";

	      $this->AdjustWeekDay( $w, $month, $year, $wd, $direction );
	      if ( $this->m_debug ) echo "\n - adjusted week day month = $month year = $year and wd = $wd and w = $w";

	      //
	      $dt = new cDateISO( $month, 15, $year );
	      $dt->BelongsToMonth( $month, $year );
	      $dt = $dt->FirstWeekOfMonth( $month , $year );
	      $weeks = $dt->WeeksOfMonth( );

	      if ( $this->m_debug ) echo "\n new dt is " . $dt->AsSQL( );

	      if ( $w > $weeks ) {
		  assert( false == true );
		  die( "\n FirstWeekday: Monat hat keine $w, sondern nur $weeks Wochen für " . $dt->AsSQL( ));
	      }
	      $dt->GoWOM( $w, $wd );

	      if ( $this->m_debug ) echo "\n first possible position is " . $dt->AsSQL( );

	      if ( ! $this->IsGoodDate( $w, $month, $year, $wd ) ) {
		  $this->AdjustWeek( $w, $month, $year, $wd, $direction );
	      }

	      if ( $this->m_debug ) echo " \n - adjusted week: month = $month year = $year w = $w and wd = $wd";


	      if ( ! $this->IsGoodDate( $w, $month, $year, $wd ) ) {
		  $this-> AdjustYearMonth( $year, $month, $w, $wd, $direction  );
	      }

	      if ( $this->m_debug ) echo " \n - adjusted to month = $month year = $year w = $w and wd = $wd";

	      $dt2 = new cDateISO( $month, 15, $year );
	      $dt2->BelongsToMonth( $month, $year );
	      $dt2 = $dt2->FirstWeekOfMonth( $month , $year );
	      if ( $this->m_debug ) echo "\n dt2 nach FirstWeekOfMonth ->" . $dt2->AsSQL( );
	      $dt2->GoWOM( $w, $wd );
	      if ( $this->m_debug ) echo "\n dt2 nach GoWOM( $w, $wd ) ->" . $dt2->AsSQL( );

	      if ( $this->m_debug ) echo "\n nach Adjustments sind wir bei";;
	      if ( $this->m_debug ) echo "\n .. dt2 = " . $dt2->AsSQL( );
	      if ( $this->m_debug ) echo "\n .. dt = " . $dt->AsSQL( );
	      if ( $this->m_debug ) echo "\n .. start = " . $dt_start->AsSQL( );

	      if ( $dt2->lt( $dt_start ) ) {
		      die( "\n error: dt2 < start" );
	      }

	} elseif ( $direction == self::DIRECTION_BACKWARD )	{

	      $first = new cDateISO(  $dt_start );
	      $first->BelongsToMonth( $month, $year );
	      $first = $first->FromMonthYear( $month, $year ) ;
	      // $first->BelongsToMonth( $month, $year );
	      // $first = $first->FirstWeekOfMonth( $month , $year );
	      $first->SeekWeekday( $wd, self::DIRECTION_BACKWARD );


	      $this->AdjustWeekDay( $w, $month, $year, $wd, $direction );
	      if ( $this->m_debug ) echo "\n - adjusted week day month = $month year = $year and wd = $wd and w = $w";
	      $this->AdjustWeek( $w, $month, $year, $wd, $direction );
	      if ( $this->m_debug ) echo "\n - adjusted week month = $month year = $year and wd = $wd and w = $w";

	      //
 	      $dt = new cDateISO( $month, 15, $year );
// 	      $dt = $dt->FirstWeekOfMonth( $month , $year );
// 	      $weeks = $dt->WeeksOfMonth( );

	      if ( $w < 1 ) {
		  assert( false == true );
		  die( "\n FirstWeekday: Monat hat keine $w, sondern nur $weeks Wochen für " . $dt->AsSQL( ));
	      }

	      if ( $this->m_debug ) echo "\n before GoWOM( $w, $wd ) mit " . $dt->AsSQL( );
	      $dt->GoWOM( $w, $wd );

	      if ( $this->m_debug ) echo "\n first possible position is " . $dt->AsSQL( );

	      $this->AdjustWeek( $w, $month, $year, $wd, $direction );

	      if ( $this->m_debug ) echo " \n - adjusted week: month = $month year = $year w = $w and wd = $wd";


	      $this-> AdjustYearMonth( $year, $month, $w, $wd , $direction );

	      if ( $this->m_debug ) echo " \n - adjusted to month = $month year = $year w = $w and wd = $wd";

 	      $dt2 = new cDateISO( $month, 15, $year );
 	      $dt2->BelongsToMonth( $month, $year );
 	      $dt2 = $dt2->FirstWeekOfMonth( $month , $year );
 	      if ( $this->m_debug ) echo "\n dt2 nach FirstWeekOfMonth ->" . $dt2->AsSQL( );
 	      $dt2->GoWOM( $w, $wd );
 	      if ( $this->m_debug ) echo "\n dt2 nach GoWOM( $w, $wd ) ->" . $dt2->AsSQL( );

	      if ( $this->m_debug ) echo "\n nach Adjustments sind wir bei";;
 	      if ( $this->m_debug ) echo "\n .. dt2 = " . $dt2->AsSQL( );
	      if ( $this->m_debug ) echo "\n .. dt = " . $dt->AsSQL( );
	      if ( $this->m_debug ) echo "\n .. start = " . $dt_start->AsSQL( );



// 	      if ( $dt2->gt( $dt_start ) ) {
// 		      die( "\n error: dt2 > start" );
// 	      }
	}

	if ( $direction == self::DIRECTION_FORWARD ) {
	    if ( $dt2->gt( $dt_start ) ) {
		return;
	    }
	} else {
	    if ( $dt2->lt( $dt_start ) ) {
		return;
	    }
	}


// 	return;

////////////////////////////////////////////////////////////////////////

/*

echo "\n mache weiter";
die( "\n macht weiter" );

	if ( $this->m_on_any_week ) return;

	//
	if ( in_array( $wd, $this->m_a_selected_week_days ) ) {

	    for ( $i = 0; $i < count( $this->m_a_selected_week_days ); $i++ ) {
		if ( $wd == $this->m_a_selected_week_days[ $i ] ) {
		    break;
		}
	    }
	}

	$found = false;
	for ( $i = $i; $i < count( $this->m_a_selected_week_days ); $i++ ) {
	    if ( $wd == $this->m_a_selected_week_days[ $i ] ) {

		if ( $i < count( $this->m_a_selected_week_days ) - 1 - 1 ) {
		    $wd = $this->m_a_selected_week_days[ $i + 1 ];
		} else {
		    $wd = $this->m_a_selected_week_days[ 0 ];
		    $w++;

		    // if ( ! $this->m_on_any_week )
		    if ( $w > $this->m_a_selected_weeks[ count( $this->m_a_selected_weeks ) - 1 ] ) {

			$month++;

			if ( $this->m_on_any_week ) {
			    $w = 1;
			} else {
			    $w = $this->m_a_selected_weeks[ 0 ];
			}


		    }
		    $this->AdjustYearMonth( $year, $month, $w, $wd );
		    //
		    $dt = new cDateISO( $month, 1, $year );
		    $dt->GoWOM( $w, $wd );
		    $weeks = $dt->WeeksOfMonth( );


		}

		$found = true;

	    } elseif ( $wd < $this->m_a_selected_week_days[ $i ] ) {

		$wd = $this->m_a_selected_week_days[ $i ];

		$found = true;

	    }

	    if ( ! $found ) {

		$wd = $this->m_a_selected_week_days[ 0 ];
		if ( $w < $weeks ) {
		    $w++;
		    if ( $w > $weeks ) {
			if ( $this->m_on_any_week ) {
			    $w = 1;
			} else {
			    $w = $this->m_a_selected_weeks[ 0 ];
			}
			$month++;
			if ( $month > 12 ) {
			    $year++;
			    $month = 1;
			}
		    }
		    $this->CheckWeek( $w, $month, $year );
		} else {

		    $month++;
		    $w = $this->m_a_selected_weeks[ 0 ];
		    $this->AdjustYearMonth( $year, $month, $w, $wd );

		    $dt = new cDateISO( $month, 1, $year );
		    $dt->GoWOM( $w, $wd );
		    $weeks = $dt->WeeksOfMonth( );


		}


	    }


	}
*/

	if ( $this->m_debug )  echo "\n FirstWeekday endet mit w = $w und month = $month und year = $year und wd = $wd";

    }	// functiom FirstWeekday( )


    /**
      * The method AdjustYearMonth(  ) corrects the year and month by choosing a fitting one, if necessary. This change can bring changes of the other parameters, too
      *
      * @param int $year the year, which can be changed
      * @param int $month the month, which can be changed
      * @param int $wom the week of the month, which can be changed
      * @param int $wd the day of week, which can be changed
      * @param int $direction the direction - DIRECTION_FORWARD or DIRECTION_BACKWARD
      *
      */


    private function AdjustYearMonth( & $year, & $month, & $wom, & $wd, $direction  ) {

	if ( $month == 13 ) {
	    $month = 1;
	    $year++;
	}

	$dt = new cDateISO( $month, 15, $year );
	$dt->BelongsToMonth( $month, $year );
	$dt = $dt->FirstWeekOfMonth( $month, $year );

	if ( $this->m_on_last_week && ( $wom == $dt->WeeksOfMonth( ) ) ) return;

	if ( $this->m_debug ) echo "\n adjusting year / month mit year = $year, month = $month, wom = $wom, wd = $wd";

	// while( $wom > $this->m_a_selected_weeks[ count( $this->m_a_selected_weeks ) - 1  ] ) {

	if ( $direction == self::DIRECTION_FORWARD ) {

	    $dt_vgl = new cDateISO( );
	    $dt_vgl = $dt_vgl->FirstWeekOfMonth( $month, $year );
	    $dt_vgl->GoWOM( $wom );
	    $weeks = $dt_vgl->WeeksOfMonth( );

	    $vgl = end( $this->m_a_selected_weeks );
	    if ( $this->m_on_last_week ) $vgl = $weeks;

	    while( $wom > $vgl ) {

		if ( $this->m_on_any_week ) return;


		$wd = $this->m_a_selected_week_days[ 0 ];
		if ( $this->m_on_last_week && ( $wom == $dt->WeeksOfMonth( ) ) ) return;
		$month++;
		if ( $month > 12 ) {
		    $year++;
		    $month = 1;
		}

		$dt->SetYear( $year );
		$dt->SetMonth( $month );

// 		$wom = $dt->WeeksOfMonth( );
		$wom = $this->m_a_selected_weeks[ 0 ];
	    }

	} elseif ( $direction == self::DIRECTION_BACKWARD ) {

	    while( $wom < $this->m_a_selected_weeks[ 0 ] )  {

		if ( $this->m_on_any_week ) return;

		$wd = end( $this->m_a_selected_week_days );

		// if ( $this->m_on_last_week && ( $wom == $dt->WeeksOfMonth( ) ) ) return;
		$month--;
		if ( $month < 1 ) {
		    $year--;
		    $month = 12;
		}

		$dt->SetYear( $year );
		$dt->SetMonth( $month );

		$wom = end ( $this->m_a_selected_weeks );
		if ( $this->m_on_any_week ) $wom = $dt->WeeksOfMonth( );
	    }

	}

    }	// functiom AdjustYearMonth( )


    /**
      * The method AdjustYearMonth(  ) corrects the week $w by choosing a fitting one, if necessary. This change can bring changes of the other parameters, too
      *
      * @param int $w the week of the month, which can be changed
      * @param int $month the month, which can be changed
      * @param int $year the year, which can be changed
      * @param int $wd the day of week, which can be changed
      * @param int $direction the direction - DIRECTION_FORWARD or DIRECTION_BACKWARD
      *
      */


    private function AdjustWeek( & $w, & $month, & $year, & $wd, $direction ) {

	if ( $this->m_debug ) echo "\n AdjustWeek mit w = $w und month = $month und year = $year und wd = $wd";

	//
	$this->CheckWeek(  $w, $month, $year, $wd, $direction );
	if ( $this->m_debug ) echo "\n CheckWeek liefert year =$year, month = $month, w = $w und wd = $wd";

	//
	$dt = new cDateISO( $month, 15, $year );
	$dt->BelongsToMonth( $month, $year );
	$dt = $dt->FirstWeekOfMonth( $month, $year );
	$dt->GoWOM( $w, $wd );
	if ( $this->m_debug ) echo "\n dt wird " . $dt->AsSQL( );

	$weeks = $dt->WeeksOfMonth( );

	//
	if ( $w > $weeks ) {
	    die( "\n error: AdjustWeek: week $w is not allowed " );
	}

	if ( $direction == self::DIRECTION_FORWARD ) {

	    //
	    $this-> AdjustYearMonth( $year, $month, $w, $wd, $direction  );

	    if ( $this->m_debug ) echo "\n AdjustYearMonth liefert year =$year, month = $month, w = $w, wd = $wd";

	    //
	    if ( $this->m_on_any_week && $w <= $weeks ) {
		if ( $this->m_debug ) echo "\n any week";
		return;
	    }

	    //
	    if ( $this->m_on_last_week && $w == $weeks ) {
		if ( $this->m_debug ) echo "\n last week";
		return;
	    }

	    //
	    if ( in_array( $w, $this->m_a_selected_weeks ) ) {
		if ( $this->m_debug ) echo "\n Woche bekannt";
		return;
	    }

	    //
	    $found = false;
	    for ( $i = 0; $i < count( $this->m_a_selected_weeks ) ; $i++ ) {

		if ( $w < $this->m_a_selected_weeks[ $i ] ) {

		    $w = $this->m_a_selected_weeks[ $i ];
		    $wd = $this->m_a_selected_week_days[ 0 ];

		    if ( $w > $weeks ) {

			$month++;
			$this-> AdjustYearMonth( $year, $month, $weeks, $wd, $direction  );

			$w = $this->m_a_selected_weeks[ 0 ];

// 			$dt = new cDateISO( );
// 			$dt = $dt->FirstWeekOfMonth( $month, $year );
// 			assert( $weeks == $dt->WeeksOfMonth( ) );

		    }

		    if ( $this->m_debug ) echo "\n .. adjusted week 1 mit w = $w und month = $month und year = $year und wd = $wd";

		} elseif ( $w == $this->m_a_selected_weeks[ $i ] ) {

		    if ( $i < count( $this->m_a_selected_weeks ) - 1 ) {

			$w = $this->m_a_selected_weeks[ $i + 1 ];
			$wd = $this->m_a_selected_week_days[ 0 ];

			if ( $this->m_debug ) echo "\n .. adjusted week 2 mit w = $w und month = $month und year = $year und wd = $wd";

		    } else {

			$w = $this->m_a_selected_weeks[ 0 ];
			$wd = $this->m_a_selected_week_days[ 0 ];
			$month++;
			$this-> AdjustYearMonth( $year, $month, $weeks, $direction  );

			if ( $this->m_debug ) echo "\n .. adjusted week 3 mit w = $w und month = $month und year = $year und wd = $wd";

		    }

		} else {

		    if ( $this->m_debug ) echo "\n .. adjusted week 4 else ";

		  $dt = new cDateISO( $month, 15, $year );
		  $dt->BelongsToMonth( $month, $year );
		  $dt = $dt->FirstWeekOfMonth( $month, $year );

		  if ( $w <= $dt->WeeksOfMonth( ) ) {

			if ( $this->m_on_any_week ) {
			    return;
			}

			if ( $this->m_on_last_week && ( $w == $weeks ) ) {
			    return;
			}
		    }
		}

	    }

	} elseif ( $direction == self::DIRECTION_BACKWARD ) {

	    //
	    $this-> AdjustYearMonth( $year, $month, $w, $wd, $direction  );

	    if ( $this->m_debug ) echo "\n AdjustWeek: AdjustYearMonth liefert year =$year, month = $month, w = $w, wd = $wd";

	    //
	    if ( $this->m_on_any_week && $w <= $weeks ) {
		if ( $this->m_debug ) echo "\n any week";
		return;
	    }

	    //
	    if ( $this->m_on_last_week && $w == $weeks ) {
		if ( $this->m_debug ) echo "\n last week";
		return;
	    }

	    //
	    if ( in_array( $w, $this->m_a_selected_weeks ) ) {
		if ( $this->m_debug ) echo "\n Woche bekannt";
		return;
	    }

	    //
	    if ( $this->m_debug ) echo "\n AdjustWeek: skipping";

	    $found = false;
	    for ( $i = count( $this->m_a_selected_weeks ) - 1; $i >= 0; $i-- ) {

		if ( $this->m_debug ) echo "\n w = $w vgl mit " . $this->m_a_selected_weeks[ $i ];

		if ( $w > $this->m_a_selected_weeks[ $i ] ) {

		    if ( $this->m_debug ) echo "\n w = $w > " . $this->m_a_selected_weeks[ $i ];

		    $w = $this->m_a_selected_weeks[ $i ];
		    $wd = end( $this->m_a_selected_week_days );

		    if ( $w < 1 ) {

			$month--;
			$this-> AdjustYearMonth( $year, $month, $weeks, $direction  );

			$dt = new cDateISO( $month, 15, $year );
			$dt->BelongsToMonth( $month, $year );
			$dt = $dt->FirstWeekOfMonth( $month, $year );
			// assert( $weeks == 1 );
			$w = end( $this->m_a_selected_weeks );
			$this->AdjustWeek( $w, $month, $year, $wd, $direction) ;
			// AdjustWeek( & $w, & $month, & $year, & $wd, $direction ) {
			if ( $this->m_on_any_week || $this->m_on_last_week ) $w = $dt->WeeksOfMonth( );

		    }

		    if ( $this->m_debug ) echo "\n .. adjusted week 1 mit w = $w und month = $month und year = $year und wd = $wd";

		} elseif ( $w == $this->m_a_selected_weeks[ $i ] ) {

		    if ( $this->m_debug ) echo "\n w = $w == " . $this->m_a_selected_weeks[ $i ];

		    if ( $i > 1 ) {

			$w = $this->m_a_selected_weeks[ $i - 1 ];
			$wd = end( $this->m_a_selected_week_days );

			if ( $this->m_debug ) echo "\n .. adjusted week 2 mit w = $w und month = $month und year = $year und wd = $wd";

		    } else {

			$dt = new cDateISO( $month, 15, $year );
			$dt->BelongsToMonth( $month, $year );
			$dt = $dt->FirstWeekOfMonth( $month, $year );

			$w = end( $this->m_a_selected_weeks );
			if ( $this->m_on_any_week || $this->m_on_last_week ) $w = $dt->WeeksOfMonth( );

			$wd = end( $this->m_a_selected_week_days );
			$month--;
			$this-> AdjustYearMonth( $year, $month, $weeks, $direction  );

			if ( $this->m_debug ) echo "\n .. adjusted week 3 mit w = $w und month = $month und year = $year und wd = $wd";

		    }

		} else {

		    // $w ist kleiner als $this->m_a_selected_weeks[ $i ]

		    if ( $this->m_debug ) echo "\n .. adjusted week 4 else ";

		    $dt = new cDateISO( $month, 15, $year );
		    $dt->BelongsToMonth( $month, $year );
		    $dt = $dt->FirstWeekOfMonth( $month, $year );


		    if ( $this->m_on_any_week && $w < $dt->WeeksOfMonth( ) ) {
			if ( $this->m_debug ) echo "\n .. adjusted week 5 in else mit w = $w und month = $month und year = $year und wd = $wd ";
			return;
		    }

// 		    if ( $this->m_on_last_week && ( $w == $weeks ) ) {
// 			return;
// 		    }

		}

	    }

	}

	if ( $this->m_debug ) echo "\n .. after AdjustWeek mit w = $w und month = $month und year = $year und wd = $wd";

    }	// functiom AdjustWeek( )

    /**
      * The method GetNextEventSlot(  ) returns the next date AFTER $obj_date, WITHOUT checking for special situations or
      * whether the date fits into the strategies' boundaries.
      *
      * @param cDate $obj_date a cDate object, which is the starting point for the next calculation
      * @param int $direction the constant, which indicates the search direction. It defaults to DIRECTION_FORWARD
      *
      * @return cDate cDate object with the next fitting date
      *
      * @see GetFollower
      * @see GetFirstDate
      * @see DIRECTION_BACKWARD
      * @see DIRECTION_FORWARD
      *
      */


    public function GetNextEventSlot( $obj_date, $direction = self::DIRECTION_FORWARD ) {

        assert( is_int( $direction ) );

        if ( is_a( $obj_date, '\rstoetter\libdatephp\\cDate' ) ) {
	    $obj_date = new cDateISO( $obj_date );
        }

        assert( is_a( $obj_date, '\rstoetter\libdatephp\\cDateISO' ) );

	if ( $this->m_debug ) echo "\n GetNextEventSlot( ) starts with " . $obj_date->AsSQL( ) . ' direction is ' . ( $direction == self::DIRECTION_FORWARD ? ' forward' : 'backward');

	if ( $direction == self::DIRECTION_FORWARD) {
	    $obj_date->Inc( );	// we are looking for the next slot
	} else {
	    $obj_date->Dec( );	// we are looking for the previous slot
	}

	if ( $this->m_debug ) echo "\n skipped to " . $obj_date->AsSQL( );

	$obj_date->BelongsToMonth( $month, $year );

	$day = $obj_date->DOM( );
// 	$month = $obj_date->Month( );
	$week_year = $obj_date->WOY( );		// one-based week in year
	$week_month = $obj_date->WOM( );	// one-based week in month
	$weekday = $obj_date->Weekday( false );	// zero-based day of week
// 	$year = $obj_date->Year( );
	$woy_org = $week_year;
	$wom = $wom_org = $week_month;



	echo "\n " . $obj_date->AsSQL( ) . " wom = $wom week_year = $week_year";

	$date = new cDateISO( $obj_date );

	$weekday_next = $weekday;
	$month_next = -1;
	$year_next = -1;
	$week_next = -1;

	$obj_date_ret = null;


	if ( $this->m_debug ) echo ' from ' .  debug_backtrace()[1]['function'] . '/' . debug_backtrace()[0]['line'];
	if ( $this->m_debug ) echo "\n $year-$month-$day -> woy = $week_year wom = $week_month weekday = $weekday";
	if ( $this->m_debug ) $this->PrintDaysAndWeeks( );


// $this->AdjustWeekDay(  $wom, $month, $year, $weekday_next, $direction );
// $this->AdjustWeek( $wom, $month, $year, $weekday_next, $direction );

	if ( $this->IsGoodDate( $wom, $month, $year, $weekday ) ) {

	    $tmp = new cDateISO( );
	    $tmp->SetYear( $year );
	    $tmp->SetMonth( $month );
	    $tmp->GoWOM( $wom, $weekday );

	    $obj_date_ret = new cDateISO( $tmp );

	} elseif ( $direction == self::DIRECTION_FORWARD ) {

	    if ( $this->m_debug ) echo "\n direction = forward";




if ( $this->m_debug ) echo "\n wd next = $weekday_next";
    if ( $this->m_debug ) echo "\n 1 .. mit w = $wom und month = $month und year = $year und wd = $weekday_next";
$this->FirstWeekday( $wom, $month, $year, $weekday_next, $direction, $obj_date );
	if ( $this->m_debug ) echo "\n 2 nach FirstWeekday.. mit w = $wom und month = $month und year = $year und wd = $weekday_next";
$this->AdjustWeek( $wom, $month, $year, $weekday_next, $direction );
	if ( $this->m_debug ) echo "\n 3 nach AdjustWeek.. mit w = $wom und month = $month und year = $year und wd = $weekday_next";
/*
	    $tmp = new cDateISO( $date );
	    $tmp->SetYear( $year );
	    $tmp->SetMonth( $month );



	    echo "\n tmp = " . $tmp->AsSQL( ) . ' mit wom = ' . $tmp->WOM( ) . ' und woy = ' . $tmp->WOY( false );
	    echo "\n tmp->GoWOM( $wom, $weekday_next )";
	    $tmp->GoWOM( $wom, $weekday_next );
	    $woy = $this->WOM2WOY( $wom, $month, $year );
	    echo "\n tmp = " . $tmp->AsSQL( ) . ' mit wom = ' . $tmp->WOM( ) . ' und woy = ' . $tmp->WOY( false );

	    if( $woy != $tmp->WOY( false ) ) {
		assert( false == true  );
		die( "\n woy = $woy != tmp->woy() = " . $tmp->WOY( false ));
	    }
	    if ( $woy != $tmp->WOY( false ) ) {

		echo "\n woy = $woy entspricht nicht woy() von tmp = " . $tmp->WOY( false );

	    }
	    echo "\n adjusted date after weekday to " . $tmp->AsSQL( );
*/

	    if ( $this->m_debug ) echo "\n woy = $week_year -> new wom = $wom in month $month";

	    if ( $this->m_debug ) echo "\n trying now date slot {$year}- week {$wom}-{ week day $weekday_next} of month $month with ";

	    $tmp = new cDateISO( );
	    $tmp->SetYear( $year );
	    $tmp->SetMonth( $month );

	    $tmp->GoWOM( $wom, $weekday_next );
	    if ( $this->m_debug ) echo "\n tmp = " . $tmp->AsSQL( ) . " from wom = $wom and weekday = $weekday_next and date = " . $date->AsSQL( );


	    $wom = $tmp->WOM( );


	    $obj_date_ret = new cDateISO( $tmp );

	    if ( $this->m_debug ) echo "\n starting with " . $obj_date_ret->AsSQL( ) . " WOM = " . $obj_date_ret->WOM( );

	    if ( $this->m_debug ) echo "\n found date slot " . $obj_date_ret->AsSQL( );

// 	    assert( checkdate( $week_next, $weekday_next, $year ) );

// 	    $obj_date_ret = new cDate( $week_next, $weekday_next, $year );

	} else {

	    // $direction ist nun self::DIRECTION_BACKWARD
	    if ( $this->m_debug ) echo "\n direction = backwards";

if ( $this->m_debug ) echo "\n wd next = $weekday_next";
    if ( $this->m_debug ) echo "\n 1 .. mit w = $wom und month = $month und year = $year und wd = $weekday_next";
$this->FirstWeekday( $wom, $month, $year, $weekday_next, $direction, $obj_date );
	if ( $this->m_debug ) echo "\n 2 nach FirstWeekday .. mit w = $wom und month = $month und year = $year und wd = $weekday_next";
$this->AdjustWeek( $wom, $month, $year, $weekday_next, $direction );
	if ( $this->m_debug ) echo "\n 3 nach AdjustWeek.. mit w = $wom und month = $month und year = $year und wd = $weekday_next";

	    $tmp = new cDateISO( $month, 15, $year );	// ??????????????????
// 	    $tmp->SetYear( $year );
// 	    $tmp->SetMonth( $month );

	    $tmp->GoWOM( $wom, $weekday_next );
	    $woy = $this->WOM2WOY( $wom, $month, $year );
	    echo "\n tmp = " . $tmp->AsSQL( );;

	    assert( $woy == $tmp->WOY( false ) );
	    if ( $woy != $tmp->WOY( false ) ) {

		die( "\n woy = $woy entspricht nicht woy() von tmp = " . $tmp->WOY( false ) );

	    }
	    echo "\n adjusted date after weekday to " . $tmp->AsSQL( );

	    if ( $this->m_debug ) echo "\n woy = $week_year -> new wom = $wom in month $month";

	    if ( $this->m_debug ) echo "\n trying now date slot {$year}- week {$wom}-{ week day $weekday_next} of month $month with ";

	    $tmp = new cDateISO( );
	    $tmp->SetYear( $year );
	    $tmp->SetMonth( $month );

	    $tmp->GoWOM( $wom, $weekday_next );
	    if ( $this->m_debug ) echo "\n tmp = " . $tmp->AsSQL( ) . " from wom = $wom and weekday = $weekday_next and date = " . $date->AsSQL( );


	    $wom = $tmp->WOM( );


	    $obj_date_ret = new cDateISO( $tmp );

	    if ( $this->m_debug ) echo "\n starting with " . $obj_date_ret->AsSQL( ) . " WOM = " . $obj_date_ret->WOM( );

	    if ( $this->m_debug ) echo "\n found date slot " . $obj_date_ret->AsSQL( );



  /*

	    // nächstmögliche Tageszahl berechnen

	    for ( $i = count( $this->m_a_selected_week_days ) - 1; $i >= 0; $i-- ) {

		if ( $this->m_a_selected_week_days[ $i ] == $weekday ) {

		    if ( $i > 0 ) {
			$weekday_next = $this->m_a_selected_week_days[ $i  ];
			if ( $this->m_debug ) echo "\n next possible week day slot (1) = $weekday_next in woy = $week_year";
			break;
		    } else {
			$weekday_next = $this->m_a_selected_week_days[ count( $this->m_a_selected_week_days - 1 ) ];
			$week_year--;
			if ( $this->m_debug ) echo "\n next possible week day slot (2) = $weekday_next in woy = $week_year";
			break;
		    }

		} elseif ( $this->m_a_selected_week_days[ $i ] < $weekday ) {
		    $weekday_next = $this->m_a_selected_week_days[ $i ];
		    if ( $this->m_debug ) echo "\n next possible week day slot (3) = $weekday_next in woy = $week_year";
		    break;
		}

	    }

	    // nächstmögliche Wochenzahl berechnen

	    $tmp = new cDate( $date );
	    $tmp->SetWOY( $week_year );
	    $wom = $tmp->WOM( );

	    // $week_month_2 =

	    if ( ( ! in_array( $wom, $this->m_a_selected_weeks ) ) && ( ! $this->OnAnyWeek( ) ) ) {
		// anderer Monat, also den ersten Tageseintrag verwenden
		$weekday_next = $this->m_a_selected_week_days[ count( $this->m_a_selected_week_days ) - 1 ];
	    }

	    if ( $this->OnAnyWeek( ) ) {

		// noop !

	    } elseif ( ( $wom != $wom_org ) || ( ( ! in_array( $wom, $this->m_a_selected_weeks ) ) ) ) {

		for ( $i = count( $this->m_a_selected_weeks ) - 1 ; $i >= 0; $i ) {

		    if ( $this->m_a_selected_weeks[ $i ] >= $wom ) {

			if ( $i > 0 ) {
			    $wom = $this->m_a_selected_weeks[ $i - 1 ];
			    if ( $this->m_debug ) echo "\n next possible week slot (1) = $wom in $year";
			    break;
			} else {
			    $wom = $this->m_a_selected_weeks[ count( $this->m_a_selected_weeks ) - 1 ];
			    $month--;
			    if ( $this->m_debug ) echo "\n next possible week slot (2) = $wom in $year";
			    break;
			}

		    } elseif ( $this->m_a_selected_weeks[ $i ] < $wom ) {

			$wom = $this->m_a_selected_weeks[ $i ];
			if ( $this->m_debug ) echo "\n next possible week slot (3) = $wom in $year";
			break;
		    }

		}



		if ( $wom == -1 ) {
		    // erstmöglicher Termin im nächsten Monat
		    $wom = $this->m_a_selected_weeks[ count( $this->m_a_selected_weeks ) - 1 ];
		    $month --;
		} else {
		    // checke Overflow
		    $tmp = new cDateISO( $month, 1, $year );

		    if ( $this->m_debug ) echo "\n weeks of month $month = " . $tmp->WeeksOfMonth( ) ;

		    if ( 0 > $wom ) {
			$wom = $this->m_a_selected_weeks[ count( $this->m_a_selected_weeks ) - 1 ];
			$month --;
			if ( $this->m_debug ) echo "\n new try: wom = $wom month = $month year = $year because last months' weeks were " . $tmp->WeeksOfMonth( );
		    }

		}


	    } else {
		echo "\n setze wom $wom wieder auf org = $wom_org";
		$wom = $wom_org;
	    }





	    $tmp = new cDateISO( $date );
	    $date->BelongsToMonth( $m, $y );
	    $tmp = $tmp->FirstWeekOfMonth( $m, $y );

	    if ( $this->OnAnyWeek( ) ){
		if ( $this->m_debug ) echo "\n trying now date slot {$year}- week {$week_year}-{ week day $weekday_next} of month $month with ";
		$tmp->SetWOY( $week_year, $weekday_next );
	    } else {
		if ( $this->m_debug ) echo "\n trying now date slot {$year}- week {$wom}-{ week day $weekday_next} of month $month with ";
		$tmp->GoWOM( $wom, $weekday_next );
		if ( $this->m_debug ) echo "\n tmp = " . $tmp->AsSQL( ) . " from wom = $wom and weekday = $weekday_next and date = " . $date->AsSQL( );
	    }
	    $wom = $tmp->WOM( );


	    $obj_date_ret = new cDate( $tmp );

	    if ( $this->m_debug ) echo "\n starting with " . $obj_date_ret->AsSQL( ) . " WOM = " . $obj_date_ret->WOM( );

	    if ( $this->m_debug ) echo "\n found date slot " . $obj_date_ret->AsSQL( );
*/
	}


	assert( ! is_null( $obj_date_ret ) );

	if ( $this->m_debug ) echo "\n GetNextEventSlot( ) returns " . $obj_date_ret->AsSQL( );

	return $obj_date_ret;

    }	// functiom GetNextEventSlot( )




}       // of class cDateStrategyMonthlyFixed

?>