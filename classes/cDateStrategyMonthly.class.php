<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  File          : classes/cDateStrategyMonthly.class.php ( 10/17/2009 )
//  Language      : php
//  Description   : Die Klasse 'cDateStrategyMonthly' erweitert 'cDateStrategy' um monatlich wiederkehrende Termine
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
//		_POST['s4_01']
//		_POST['s4_02']
//		_POST['s4_03']
//		_POST['s4_04']
//		_POST['s4_05']
//		_POST['s4_06']
//		_POST['s4_07']
//		_POST['s4_08']
//		_POST['s4_09']
//		_POST['s4_10']
//		_POST['s4_11']
//		_POST['s4_12']
//		_POST['s4_13']
//		_POST['s4_14']
//		_POST['s4_15']
//		_POST['s4_16']
//		_POST['s4_17']
//		_POST['s4_18']
//		_POST['s4_19']
//		_POST['s4_20']
//		_POST['s4_21']
//		_POST['s4_22']
//		_POST['s4_23']
//		_POST['s4_24']
//		_POST['s4_25']
//		_POST['s4_26']
//		_POST['s4_27']
//		_POST['s4_28']
//		_POST['s4_29']
//		_POST['s4_30']
//		_POST['s4_31']
//		_POST['s4_apr']
//		_POST['s4_aug']
//		_POST['s4_dec']
//		_POST['s4_feb']
//		_POST['s4_jan']
//		_POST['s4_jul']
//		_POST['s4_jun']
//		_POST['s4_mar']
//		_POST['s4_may']
//		_POST['s4_nov']
//		_POST['s4_oct']
//		_POST['s4_sep']
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
//	class cDateStrategyMonthly
//		public method AsString()
//		public method CalculateExceptions($year)
//		public method FillForm($checked=false)
//		public method FromForm()
//		public method FromString($str)
//		public method GetFirstDate()
//		public method GetFollower($date)
//		public method GetNextEventDate($datestart,$dateisfirst=true)
//		public method IsValid()
//		public method Reset()
//		public method SetApr($set=null)
//		public method SetAug($set=null)
//		public method SetDay01($set=null)
//		public method SetDay02($set=null)
//		public method SetDay03($set=null)
//		public method SetDay04($set=null)
//		public method SetDay05($set=null)
//		public method SetDay06($set=null)
//		public method SetDay07($set=null)
//		public method SetDay08($set=null)
//		public method SetDay09($set=null)
//		public method SetDay10($set=null)
//		public method SetDay11($set=null)
//		public method SetDay12($set=null)
//		public method SetDay13($set=null)
//		public method SetDay14($set=null)
//		public method SetDay15($set=null)
//		public method SetDay16($set=null)
//		public method SetDay17($set=null)
//		public method SetDay18($set=null)
//		public method SetDay19($set=null)
//		public method SetDay20($set=null)
//		public method SetDay21($set=null)
//		public method SetDay22($set=null)
//		public method SetDay23($set=null)
//		public method SetDay24($set=null)
//		public method SetDay25($set=null)
//		public method SetDay26($set=null)
//		public method SetDay27($set=null)
//		public method SetDay28($set=null)
//		public method SetDay29($set=null)
//		public method SetDay30($set=null)
//		public method SetDay31($set=null)
//		public method SetDec($set=null)
//		public method SetFeb($set=null)
//		public method SetJan($set=null)
//		public method SetJul($set=null)
//		public method SetJun($set=null)
//		public method SetMar($set=null)
//		public method SetMay($set=null)
//		public method SetNov($set=null)
//		public method SetOct($set=null)
//		public method SetSep($set=null)
//		public method cDateStrategyMonthly($str=null)
//		protected var $apr
//		protected var $aug
//		protected var $m_day_01
//		protected var $m_day_02
//		protected var $m_day_03
//		protected var $m_day_04
//		protected var $m_day_05
//		protected var $m_day_06
//		protected var $m_day_07
//		protected var $m_day_08
//		protected var $m_day_09
//		protected var $m_day_10
//		protected var $m_day_11
//		protected var $m_day_12
//		protected var $m_day_13
//		protected var $m_day_14
//		protected var $m_day_15
//		protected var $m_day_16
//		protected var $m_day_17
//		protected var $m_day_18
//		protected var $m_day_19
//		protected var $m_day_20
//		protected var $m_day_21
//		protected var $m_day_22
//		protected var $m_day_23
//		protected var $m_day_24
//		protected var $m_day_25
//		protected var $m_day_26
//		protected var $m_day_27
//		protected var $m_day_28
//		protected var $m_day_29
//		protected var $m_day_30
//		protected var $m_day_31
//		protected var $dec
//		protected var $feb
//		protected var $jan
//		protected var $jul
//		protected var $jun
//		protected var $mar
//		protected var $may
//		protected var $nov
//		protected var $oct
//		protected var $sep
//	[[End of classes]]
//
//
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?><?php

namespace libdatephp;

class cDateStrategyMonthlyParams {

    protected $d01 = 0;
    protected $d02 = 0;
    protected $d03 = 0;
    protected $d04 = 0;
    protected $d05 = 0;
    protected $d06 = 0;
    protected $d07 = 0;
    protected $d08 = 0;
    protected $d09 = 0;
    protected $d10 = 0;
    protected $d11 = 0;
    protected $d12 = 0;
    protected $d13 = 0;
    protected $d14 = 0;
    protected $d15 = 0;
    protected $d16 = 0;
    protected $d17 = 0;
    protected $d18 = 0;
    protected $d19 = 0;
    protected $d20 = 0;
    protected $d21 = 0;
    protected $d22 = 0;
    protected $d23 = 0;
    protected $d24 = 0;
    protected $d25 = 0;
    protected $d26 = 0;
    protected $d27 = 0;
    protected $d28 = 0;
    protected $d29 = 0;
    protected $d30 = 0;
    protected $d31 = 0;

    protected $jan = 0;
    protected $feb = 0;
    protected $mar = 0;
    protected $apr = 0;
    protected $may = 0;
    protected $jun = 0;
    protected $jul = 0;
    protected $aug = 0;
    protected $sep = 0;
    protected $oct = 0;
    protected $nov = 0;
    protected $dec = 0;


    public function Reset( ) {

        parent::Reset( );

        $this->d01 = 0;
        $this->d02 = 0;
        $this->d03 = 0;
        $this->d04 = 0;
        $this->d05 = 0;
        $this->d06 = 0;
        $this->d07 = 0;
        $this->d08 = 0;
        $this->d09 = 0;
        $this->d10 = 0;
        $this->d11 = 0;
        $this->d12 = 0;
        $this->d13 = 0;
        $this->d14 = 0;
        $this->d15 = 0;
        $this->d16 = 0;
        $this->d17 = 0;
        $this->d18 = 0;
        $this->d19 = 0;
        $this->d20 = 0;
        $this->d21 = 0;
        $this->d22 = 0;
        $this->d23 = 0;
        $this->d24 = 0;
        $this->d25 = 0;
        $this->d26 = 0;
        $this->d27 = 0;
        $this->d28 = 0;
        $this->d29 = 0;
        $this->d30 = 0;
        $this->d31 = 0;

        $this->jan = 0;
        $this->feb = 0;
        $this->mar = 0;
        $this->apr = 0;
        $this->mai = 0;
        $this->jun = 0;
        $this->jul = 0;
        $this->aug = 0;
        $this->sep = 0;
        $this->okt = 0;
        $this->nov = 0;
        $this->dec = 0;

    }


    public function IsValid( ) {

        $ret = (  (           $this->d01+$this->d02+$this->d03+$this->d04+$this->d05+$this->d06+$this->d07+$this->d08+$this->d09+
                $this->d10+$this->d11+$this->d12+$this->d13+$this->d14+$this->d15+$this->d16+$this->d17+$this->d18+$this->d19+
                $this->d20+$this->d21+$this->d22+$this->d23+$this->d24+$this->d25+$this->d26+$this->d27+$this->d28+$this->d29+
                $this->d30+$this->d31 ));

        if ( $ret ) { $ret =  ($this->jan+$this->feb+$this->mar+$this->apr+$this->mai+$this->jun+$this->jul+$this->aug+$this->sep+$this->okt+$this->nov+$this->dec );
        }

        return $ret;

    }       // function IsValid()


    public function SetDay01( $set = null){
        if ($set != null) $this->d01 = $set;
        return $this->d01;
     }      // public function SetDay01()

    public function SetDay02( $set = null){
        if ($set != null) $this->d02 = $set;
        return $this->d02;
     }      // public function SetDay02()

    public function SetDay03( $set = null){
        if ($set != null) $this->d03 = $set;
        return $this->d03;
     }      // public function SetDay03()

    public function SetDay04( $set = null){
        if ($set != null) $this->d04 = $set;
        return $this->d04;
     }      // public function SetDay04()

    public function SetDay05( $set = null){
        if ($set != null) $this->d05 = $set;
        return $this->d05;
     }      // public function SetDay05()

    public function SetDay06( $set = null){
        if ($set != null) $this->d06 = $set;
        return $this->d06;
     }      // public function SetDay06()

    public function SetDay07( $set = null){
        if ($set != null) $this->d07 = $set;
        return $this->d07;
     }      // public function SetDay07()

    public function SetDay08( $set = null){
        if ($set != null) $this->d08 = $set;
        return $this->d08;
     }      // public function SetDay08()

    public function SetDay09( $set = null){
        if ($set != null) $this->d09 = $set;
        return $this->d09;
     }      // public function SetDay09()

    public function SetDay10( $set = null){
        if ($set != null) $this->d10 = $set;
        return $this->d10;
     }      // public function SetDay10()

    public function SetDay11( $set = null){
        if ($set != null) $this->d11 = $set;
        return $this->d11;
     }      // public function SetDay11()

    public function SetDay12( $set = null){
        if ($set != null) $this->d12 = $set;
        return $this->d12;
     }      // public function SetDay12()

    public function SetDay13( $set = null){
        if ($set != null) $this->d13 = $set;
        return $this->d13;
     }      // public function SetDay13()

    public function SetDay14( $set = null){
        if ($set != null) $this->d14 = $set;
        return $this->d14;
     }      // public function SetDay14()

    public function SetDay15( $set = null){
        if ($set != null) $this->d15 = $set;
        return $this->d15;
     }      // public function SetDay15()

    public function SetDay16( $set = null){
        if ($set != null) $this->d16 = $set;
        return $this->d16;
     }      // public function SetDay16()

    public function SetDay17( $set = null){
        if ($set != null) $this->d17 = $set;
        return $this->d17;
     }      // public function SetDay17()

    public function SetDay18( $set = null){
        if ($set != null) $this->d18 = $set;
        return $this->d18;
     }      // public function SetDay18()

    public function SetDay19( $set = null){
        if ($set != null) $this->d19 = $set;
        return $this->d19;
     }      // public function SetDay19()

    public function SetDay20( $set = null){
        if ($set != null) $this->d20 = $set;
        return $this->d20;
     }      // public function SetDay20()

    public function SetDay21( $set = null){
        if ($set != null) $this->d21 = $set;
        return $this->d21;
     }      // public function SetDay21()

    public function SetDay22( $set = null){
        if ($set != null) $this->d22 = $set;
        return $this->d22;
     }      // public function SetDay22()

    public function SetDay23( $set = null){
        if ($set != null) $this->d23 = $set;
        return $this->d23;
     }      // public function SetDay23()

    public function SetDay24( $set = null){
        if ($set != null) $this->d24 = $set;
        return $this->d24;
     }      // public function SetDay24()

    public function SetDay25( $set = null){
        if ($set != null) $this->d25 = $set;
        return $this->d25;
     }      // public function SetDay25()

    public function SetDay26( $set = null){
        if ($set != null) $this->d26 = $set;
        return $this->d26;
     }      // public function SetDay26()

    public function SetDay27( $set = null){
        if ($set != null) $this->d27 = $set;
        return $this->d27;
     }      // public function SetDay27()

    public function SetDay28( $set = null){
        if ($set != null) $this->d28 = $set;
        return $this->d28;
     }      // public function SetDay28()

    public function SetDay29( $set = null){
        if ($set != null) $this->d29 = $set;
        return $this->d29;
     }      // public function SetDay29()

    public function SetDay30( $set = null){
        if ($set != null) $this->d30 = $set;
        return $this->d30;
     }      // public function SetDay30()

    public function SetDay31( $set = null){
        if ($set != null) $this->d31 = $set;
        return $this->d31;
     }      // public function SetDay31()

    public function SetJan( $set = null){
        if ($set != null) $this->jan = $set;
        return $this->jan;
     }      // public function SetJan()

    public function SetFeb( $set = null){
        if ($set != null) $this->feb = $set;
        return $this->feb;
     }      // public function SetFeb()

    public function SetMar( $set = null){
        if ($set != null) $this->mar = $set;
        return $this->mar;
     }      // public function SetMar()

    public function SetApr( $set = null){
        if ($set != null) $this->apr = $set;
        return $this->apr;
     }      // public function SetApr()

    public function SetMay( $set = null){
        if ($set != null) $this->may = $set;
        return $this->may;
     }      // public function SetMai()

    public function SetJun( $set = null){
        if ($set != null) $this->jun = $set;
        return $this->jun;
     }      // public function SetJun()

    public function SetJul( $set = null){
        if ($set != null) $this->jul = $set;
        return $this->jul;
     }      // public function SetJul()

    public function SetAug( $set = null){
        if ($set != null) $this->aug = $set;
        return $this->aug;
     }      // public function SetAug()

    public function SetSep( $set = null){
        if ($set != null) $this->sep = $set;
        return $this->sep;
     }      // public function SetSep()

    public function SetOct( $set = null){
        if ($set != null) $this->oct = $set;
        return $this->oct;
     }      // public function SetOct()

    public function SetNov( $set = null){
        if ($set != null) $this->nov = $set;
        return $this->nov;
     }      // public function SetNov()

    public function SetDec( $set = null){
        if ($set != null) $this->dec = $set;
        return $this->dec;
     }      // public function SetDec()





}	// class cDateStrategyMonthlyParams

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategyMonthly
///////////////////


/**
  *
  * The class cDateStrategyMonthly calculates recurring monthly events based on daynumber(s) or monthnumber(s). It is specialized to find one or some events
  * in the months, which are examined. Certain events in certain months. For example it can solve the problem to find
  * matching events for the fith and seventh day of a month in the months april and december.
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
  * @see cDateStrategyWeekly
  *
  */


class cDateStrategyMonthly extends cDateStrategy {

    // an bestimmten Tagen in bestimmten Monaten



    /**
      * The ordered arrays $m_a_selected_months and $m_a_selected_days contain the selected months and days, on which events are
      * possible.
      *
      * $m_a_selected_months conatains one-based integers ( january = 1 ) which stand for the months to reserve for events
      * $m_a_selected_days conatains one-based integers ( first day in month = 1 ) which stand for the days to reserve for events
      *
      * @var array $m_a_selected_months ordered array with one-based month numbers
      *
      * @see $m_a_selected_days
      * @see $m_a_selected_months
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see ExistsMonthDay
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      *
      */

      protected $m_a_selected_months = array( );

    /**
      * The ordered arrays $m_a_selected_months and $m_a_selected_days contain the selected months and days, on which events are
      * possible.
      *
      * $m_a_selected_months conatains one-based integers ( january = 1 ) which stand for the months to reserve for events
      * $m_a_selected_days conatains one-based integers ( first day in month = 1 ) which stand for the days to reserve for events
      *
      * @var array $m_a_selected_days ordered array with one-based day numbers
      *
      * @see $m_a_selected_days
      * @see $m_a_selected_months
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see ExistsMonthDay
      * @see RemoveMonthDay
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      *
      */

      protected $m_a_selected_days = array( );

    /**
      * The method GetMonthDayArray( $ary ) returns in $ary the set day numbers
      *
      *  The array is zero-based
      *
      *
      * @param array $ary the zero-based array with the set days of a month
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      */

      public function GetMonthDayArray( & $ary ) {

	  $ary = array( );

	  for ( $i = 0; $i < count( $this->m_a_selected_days ); $i++ ) {

	      $ary[ ] = $this->m_a_selected_days[ $i ];

	  }


      }  // function GetMonthDayArray( )

    /**
      * The method GetMonthArray( $ary ) returns in $ary the set month numbers
      *
      *  The array is zero-based
      *
      *
      * @param array $ary the zero-based array with the set month numbers
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray      *
      * @see GetMonthArray
      * @see GetMonthDayArray
      */

      public function GetMonthArray( & $ary ) {

	  $ary = array( );

	  for ( $i = 0; $i < count( $this->m_a_selected_months ); $i++ ) {

	      $ary[ ] = $this->m_a_selected_months[ $i ];

	  }


      }  // function GetMonthArray( )

    /**
      * The method GetFullMonthDayArray( $ary ) returns in $ary 31 int entries. The entries are 1, when the specific
      * day is set and 0, when not
      *
      *  The array is zero-based - The array element with the index 0 stands for the first day in the month and 30
      *  for the 31-th day
      *
      *
      * @param array $ary the zero-based array with the days of a month
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      */

      public function GetFullMonthDayArray( & $ary ) {

	  $ary = array( );

	  for ( $i = 0; $i < 31; $i++ ) {
	      $ary[] = 0;
	  }

	  for ( $i = 0; $i < count( $this->m_a_selected_days ); $i++ ) {

	      $ary[ $this->m_a_selected_days[ $i ] - 1  ] = 1;

	  }


      }  // function GetFullMonthDayArray( )


    /**
      * The method GetFullMonthArray( $ary ) returns in $ary 12 int entries. The entries are 1, when the specific
      * month is set and 0, when not
      *
      *  The array is zero-based - The array element with the index 0 stands for the january and 11 for december
      *
      *
      * @param array $ary the zero-based array with the months
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      */

      public function GetFullMonthArray( & $ary ) {

	  $ary = array( );

	  for ( $i = 0; $i < 12; $i++ ) {
	      $ary[] = 0;
	  }

	  for ( $i = 0; $i < count( $this->m_a_selected_months ); $i++ ) {

	      $ary[ $this->m_a_selected_months[ $i ] - 1  ] = 1;

	  }


      }  // function GetFullMonthArray( )


    /**
      * The method AddMonthDay( $n ) adds the $n-th day of a month to the list of possible event days
      *
      *  The day numbers are one-based. The value 1 means the first day in the month and 31 the 31-th day
      *
      *
      * @param int $n the day number to add to the list of possible event days
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      */


      public function AddMonthDay( $n ) {

	  if ( ! in_array( $n, $this->m_a_selected_days ) ) {

	      $this->m_a_selected_days[] = $n;

	      sort( $this->m_a_selected_days );

	  }


      }  // function AddMonthDay( )

    /**
      * The method ResetMonthDays( ) removes all days of a month from the list of possible event days
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      */


      public function ResetMonthDays( ) {

	   $this->m_a_selected_days = array( );

      }  // function ResetMonthDays( )


    /**
      * The method RemoveMonthDay( $n ) removes the $n-th day of a month from the list of possible event days
      *
      *  The day numbers are one-based. The value 1 means the first day in the month and 31 the 31-th day
      *
      *
      * @param int $n the day number to remove from the list of possible event days
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      * @see GetFullMonthDayArray
      *
      */


      public function RemoveMonthDay( $n ) {

	  if ( in_array( $n, $this->m_a_selected_days ) ) {

	      for ( $i = 0; $i < count( $this->m_a_selected_days ); $i++ ) {

		  if ( $this->m_a_selected_days[ $i ] == $n ) {

		      unset( $this->m_a_selected_days[ $i ] );

		      break;

		  }

	      }

	      $this->m_a_selected_days = array_values( $this->m_a_selected_days );

	  }


      }  // function RemoveMonthDay( )


    /**
      * The method ExistsMonthDay( $n ) returns true, if the day number $n is in the list of possible event days
      *
      *  The day numbers are one-based. The value 1 means the first day in the month and 31 the 31-th day
      *
      *
      * @param int $n the day number to search in the list of possible event days
      * @returns boolean true, if $n is in the  list of possible event days
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      *
      */


      public function ExistsMonthDay( $n ) {

	  return in_array( $n, $this->m_a_selected_days ) ;

      }  // function ExistsMonthDay( )

/////////

    /**
      * The method AddMonth( $n ) adds the $n-th month to the list of possible event months
      *
      *  The month numbers are one-based. The value 1 means the january and 12 the december
      *
      *
      * @param int $n the one-based month number to add to the list of possible months for events
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      *
      */


      public function AddMonth( $n ) {

	  if ( ! in_array( $n, $this->m_a_selected_months ) ) {

	      $this->m_a_selected_months[] = $n;

	      sort( $this->m_a_selected_months );

	  }


      }  // function AddMonth( )

    /**
      * The method ResetMonths( ) removes all months from the list of possible months for events
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      *
      */


      public function ResetMonths( ) {

	   $this->m_a_selected_months = array( );

      }  // function ResetMonths( )


    /**
      * The method RemoveMonth( $n ) removes the $n-th month from the list of possible months for events
      *
      * @param int $n the number of the month to remove from the list of possible months for events
      *
      *  The month numbers are one-based. The value 1 means the january and 12 the december
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      *
      */


      public function RemoveMonth( $n ) {

	  if ( in_array( $n, $this->m_a_selected_months ) ) {

	      for ( $i = 0; $i < count( $this->m_a_selected_months ); $i++ ) {

		  if ( $this->m_a_selected_months[ $i ] == $n ) {

		      unset( $this->m_a_selected_months[ $i ] );

		      break;

		  }

	      }

	      $this->m_a_selected_months = array_values( $this->m_a_selected_months );

	  }


      }  // function RemoveMonth( )


    /**
      * The method ExistsMonth( $n ) returns true, if month with the number $n is in the list of possible months for events
      *
      *  The month numbers are one-based. The value 1 means the january and 12 the december
      *
      * @param int $n the number of the month to search in the list of possible months for events
      * @returns boolean true, if $n is in the  list of possible months for events
      *
      * @see AddMonthDay
      * @see ResetMonthDays
      * @see RemoveMonthDay
      * @see ExistsMonthDay
      * @see AddMonth
      * @see ResetMonths
      * @see RemoveMonth
      * @see ExistsMonth
      * @see GetFullMonthArray
      * @see GetFullMonthDayArray
      * @see GetMonthArray
      * @see GetMonthDayArray
      *
      */


      public function ExistsMonth( $n ) {

	  return in_array( $n, $this->m_a_selected_months ) ;

      }  // function ExistsMonth( )


    /**
      * The constructor of cDateStrategyMonthly
      *
      *  Example:
      *
      *      $strategy = new \libdatephp\cDateStrategyMonthly(
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
      *	    $strategy2 = new \libdatephp\cDateStrategyMonthly( $strategy->AsString( ) );
      *
      *	    $strategy3 = new \libdatephp\cDateStrategyMonthly( );
      *
      *	    $strategy4 = new \libdatephp\cDateStrategyMonthly( '' ); // TODO - stimmt hier nicht
      *
      *
      * @example "./tst/tst-cDateStrategyMonthly.php" Full Example:
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
      * @return cDateStrategyMonthly
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
    public function __construct( $str = null ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str == null ) {
                $this->Reset( );
            } else {
                $this->FromString( $str ) ;
            }

            $this->IsValid();

    }   // constructor
*/

    /**
      * The method Reset( $n ) resets the internal values for month numbers and month day numbers
      *
      * @see Reset
      * @see ResetMonthDays
      * @see ResetMonths
      *
      */


    public function Reset( ) {

        parent::Reset( );

        $this->ResetMonthDays( );
        $this->ResetMonths( );
/*
        $this->m_day_01 = 0;
        $this->m_day_02 = 0;
        $this->m_day_03 = 0;
        $this->m_day_04 = 0;
        $this->m_day_05 = 0;
        $this->m_day_06 = 0;
        $this->m_day_07 = 0;
        $this->m_day_08 = 0;
        $this->m_day_09 = 0;
        $this->m_day_10 = 0;
        $this->m_day_11 = 0;
        $this->m_day_12 = 0;
        $this->m_day_13 = 0;
        $this->m_day_14 = 0;
        $this->m_day_15 = 0;
        $this->m_day_16 = 0;
        $this->m_day_17 = 0;
        $this->m_day_18 = 0;
        $this->m_day_19 = 0;
        $this->m_day_20 = 0;
        $this->m_day_21 = 0;
        $this->m_day_22 = 0;
        $this->m_day_23 = 0;
        $this->m_day_24 = 0;
        $this->m_day_25 = 0;
        $this->m_day_26 = 0;
        $this->m_day_27 = 0;
        $this->m_day_28 = 0;
        $this->m_day_29 = 0;
        $this->m_day_30 = 0;
        $this->m_day_31 = 0;

        $this->m_january = 0;
        $this->m_february = 0;
        $this->m_march = 0;
        $this->m_april = 0;
        $this->mai = 0;
        $this->m_june = 0;
        $this->m_july = 0;
        $this->august = 0;
        $this->m_september = 0;
        $this->october = 0;
        $this->m_november = 0;
        $this->m_december = 0;
*/
    }


    /**
      * The method IsValid( ) returns true, if the calculations can start.
      * In order to run, at least one month number and one day number have to be set before
      *
      * @see AddMonth
      * @see AddMonthDay
      *
      */


    public function IsValid( ) {


        $ret = ( count( $this->m_a_selected_days ) && ( count( $this->m_a_selected_months ) ) );

        return $ret;

    }       // function IsValid()



    /**
      * The method FromString( ) reads the specifications of the strategy from the string $str
      * The template starts with 's4' and is normally made by AsString( ). The
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


        sscanf( $str, "s4-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d}-{%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $this->m_day_01, $this->m_day_02,$this->m_day_03,$this->m_day_04,$this->m_day_05,$this->m_day_06,$this->m_day_07,$this->m_day_08,$this->m_day_09,$this->m_day_10,$this->m_day_11,
            $this->m_day_12,$this->m_day_13,$this->m_day_14,$this->m_day_15,$this->m_day_16,$this->m_day_17,$this->m_day_18,$this->m_day_19,$this->m_day_20,$this->m_day_21,
            $this->m_day_22,$this->m_day_23,$this->m_day_24,$this->m_day_25,$this->m_day_26,$this->m_day_27,$this->m_day_28,$this->m_day_29,$this->m_day_30, $this->m_day_31,
            $this->m_january, $this->m_february, $this->m_march, $this->m_april, $this->m_may, $this->m_june, $this->m_july, $this->august, $this->m_september, $this->m_october, $this->m_november, $this->m_december);

	$this->ResetMonthDays( );

        if ( $this->m_day_01 ) $this->AddMonthDay( 1 );
        if ( $this->m_day_02 ) $this->AddMonthDay( 2 );
        if ( $this->m_day_03 ) $this->AddMonthDay( 3 );
        if ( $this->m_day_04 ) $this->AddMonthDay( 4 );
        if ( $this->m_day_05 ) $this->AddMonthDay( 5 );
        if ( $this->m_day_06 ) $this->AddMonthDay( 6 );
        if ( $this->m_day_07 ) $this->AddMonthDay( 7 );
        if ( $this->m_day_08 ) $this->AddMonthDay( 8 );
        if ( $this->m_day_09 ) $this->AddMonthDay( 9 );
        if ( $this->m_day_10 ) $this->AddMonthDay( 10 );
        if ( $this->m_day_11 ) $this->AddMonthDay( 11 );
        if ( $this->m_day_12 ) $this->AddMonthDay( 12 );
        if ( $this->m_day_13 ) $this->AddMonthDay( 13 );
        if ( $this->m_day_14 ) $this->AddMonthDay( 14 );
        if ( $this->m_day_15 ) $this->AddMonthDay( 15 );
        if ( $this->m_day_16 ) $this->AddMonthDay( 16 );
        if ( $this->m_day_17 ) $this->AddMonthDay( 17 );
        if ( $this->m_day_18 ) $this->AddMonthDay( 18 );
        if ( $this->m_day_19 ) $this->AddMonthDay( 19 );
        if ( $this->m_day_20 ) $this->AddMonthDay( 20 );
        if ( $this->m_day_21 ) $this->AddMonthDay( 21 );
        if ( $this->m_day_22 ) $this->AddMonthDay( 22 );
        if ( $this->m_day_23 ) $this->AddMonthDay( 23 );
        if ( $this->m_day_24 ) $this->AddMonthDay( 24 );
        if ( $this->m_day_25 ) $this->AddMonthDay( 25 );
        if ( $this->m_day_26 ) $this->AddMonthDay( 26 );
        if ( $this->m_day_27 ) $this->AddMonthDay( 27 );
        if ( $this->m_day_28 ) $this->AddMonthDay( 28 );
        if ( $this->m_day_29 ) $this->AddMonthDay( 29 );
        if ( $this->m_day_30 ) $this->AddMonthDay( 30 );
        if ( $this->m_day_31 ) $this->AddMonthDay( 31 );

	$this->ResetMonths( );


        if ( $this->m_january ) $this->AddMonth( 1 );
        if ( $this->m_february ) $this->AddMonth( 2 );
        if ( $this->m_march ) $this->AddMonth( 3 );
        if ( $this->m_april ) $this->AddMonth( 4 );
        if ( $this->m_may ) $this->AddMonth( 5 );
        if ( $this->m_june ) $this->AddMonth( 6 );
        if ( $this->m_july ) $this->AddMonth( 7 );
        if ( $this->m_august ) $this->AddMonth( 8 );
        if ( $this->m_september ) $this->AddMonth( 9 );
        if ( $this->m_october ) $this->AddMonth( 10 );
        if ( $this->m_november ) $this->AddMonth( 11 );
        if ( $this->m_december ) $this->AddMonth( 12 );


        // $this->m_start_date->SetDate($startmonth, $startday, $startyear );

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

        $this->IsValid( );

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

	$this->GetFullMonthArray( $a_months );
	$str_months = implode( ':', $a_months );

	$this->GetFullMonthDayArray( $a_month_days );
	$str_month_days = implode( ':', $a_month_days );

        return sprintf( "s4-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{{$str_month_days}}-{{$str_months}}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear );



    }   // function AsString( )

    /**
      * @deprecated
      *
      */

    public function FromForm(  ) {
        # $_POST[strategy] = s4_nthday
        # $_POST[s4_03] = on
        # $_POST[s4_30] = on
        # $_POST[s4_jan] = on
        # $_POST[s4_nov] = on

        $radiostrategy = $_POST['strategy'];

        // assert ($radiostrategy == 's4_nthday');

        if ($radiostrategy == 's4_nthday') {

            $this->m_day_01=( isset( $_POST['s4_01'] ) );
            $this->m_day_02=( isset( $_POST['s4_02'] ) );
            $this->m_day_03=( isset( $_POST['s4_03'] ) );
            $this->m_day_04=( isset( $_POST['s4_04'] ) );
            $this->m_day_05=( isset( $_POST['s4_05'] ) );
            $this->m_day_06=( isset( $_POST['s4_06'] ) );
            $this->m_day_07=( isset( $_POST['s4_07'] ) );
            $this->m_day_08=( isset( $_POST['s4_08'] ) );
            $this->m_day_09=( isset( $_POST['s4_09'] ) );
            $this->m_day_10=( isset( $_POST['s4_10'] ) );
            $this->m_day_11=( isset( $_POST['s4_11'] ) );
            $this->m_day_12=( isset( $_POST['s4_12'] ) );
            $this->m_day_13=( isset( $_POST['s4_13'] ) );
            $this->m_day_14=( isset( $_POST['s4_14'] ) );
            $this->m_day_15=( isset( $_POST['s4_15'] ) );
            $this->m_day_16=( isset( $_POST['s4_16'] ) );
            $this->m_day_17=( isset( $_POST['s4_17'] ) );
            $this->m_day_18=( isset( $_POST['s4_18'] ) );
            $this->m_day_19=( isset( $_POST['s4_19'] ) );
            $this->m_day_20=( isset( $_POST['s4_20'] ) );
            $this->m_day_21=( isset( $_POST['s4_21'] ) );
            $this->m_day_22=( isset( $_POST['s4_22'] ) );
            $this->m_day_23=( isset( $_POST['s4_23'] ) );
            $this->m_day_24=( isset( $_POST['s4_24'] ) );
            $this->m_day_25=( isset( $_POST['s4_25'] ) );
            $this->m_day_26=( isset( $_POST['s4_26'] ) );
            $this->m_day_27=( isset( $_POST['s4_27'] ) );
            $this->m_day_28=( isset( $_POST['s4_28'] ) );
            $this->m_day_29=( isset( $_POST['s4_29'] ) );
            $this->m_day_30=( isset( $_POST['s4_30'] ) );
            $this->m_day_31=( isset( $_POST['s4_31'] ) );

            $this->m_january=( isset( $_POST['s4_jan'] ) );
            $this->m_february=( isset( $_POST['s4_feb'] ) );
            $this->m_march=( isset( $_POST['s4_mar'] ) );
            $this->m_april=( isset( $_POST['s4_apr'] ) );
            $this->m_may=( isset( $_POST['s4_may'] ) );
            $this->m_june=( isset( $_POST['s4_jun'] ) );
            $this->m_july=( isset( $_POST['s4_jul'] ) );
            $this->august=( isset( $_POST['s4_aug'] ) );
            $this->m_september=( isset( $_POST['s4_sep'] ) );
            $this->m_october=( isset( $_POST['s4_oct'] ) );
            $this->m_november=( isset( $_POST['s4_nov'] ) );
            $this->m_december=( isset( $_POST['s4_dec'] ) );

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
        }


    }   // function FromForm

    /**
      * @deprecated
      *
      */

    public function FillForm( $checked = false ) {

        $msgNachTagen = $this->id2msg( 1026 );
        $msgMonatlichAm = $this->id2msg( 1027 );
        $msgJanuar = $this->id2msg( 1028 );
        $msgFebruar = $this->id2msg( 1029 );
        $msgMaerz = $this->id2msg( 1030 );
        $msgApril = $this->id2msg( 1031 );
        $msgMai = $this->id2msg( 1032 );
        $msgJuni = $this->id2msg( 1033 );
        $msgJuli = $this->id2msg( 1034 );
        $msgAugust = $this->id2msg( 1035 );
        $msgSeptember = $this->id2msg( 1036 );
        $msgOktober = $this->id2msg( 1037 );
        $msgNovember = $this->id2msg( 1038 );
        $msgDezember = $this->id2msg( 1039 );
        $msgImMonat = $this->id2msg( 1040 );

        $check = ( $checked ) ? " checked " : "";

        echo "<tr><td valign=top><input type=radio name = 'strategy' value='s4_nthday' $check>$msgNachTagen</td>";
        echo "<td>";
            echo "$msgMonatlichAm <br>";

            $chk = ( $this->m_day_01 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_01 $chk>01";
            $chk = ( $this->m_day_02 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_02 $chk>02";
            $chk = ( $this->m_day_03 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_03 $chk>03";
            $chk = ( $this->m_day_04 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_04 $chk>04";
            $chk = ( $this->m_day_05 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_05 $chk>05";
            $chk = ( $this->m_day_06 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_06 $chk>06";
            $chk = ( $this->m_day_07 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_07 $chk>07";
            $chk = ( $this->m_day_08 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_08 $chk>08";
            $chk = ( $this->m_day_09 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_09 $chk>09";
            $chk = ( $this->m_day_10 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_10 $chk>10";
            $chk = ( $this->m_day_11 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_11 $chk>11";
            $chk = ( $this->m_day_12 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_12 $chk>12";
            $chk = ( $this->m_day_13 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_13 $chk>13";
            $chk = ( $this->m_day_14 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_14 $chk>14";
            $chk = ( $this->m_day_15 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_15 $chk>15<br>";
            $chk = ( $this->m_day_16 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_16 $chk>16";
            $chk = ( $this->m_day_17 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_17 $chk>17";
            $chk = ( $this->m_day_18 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_18 $chk>18";
            $chk = ( $this->m_day_19 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_19 $chk>19";
            $chk = ( $this->m_day_20 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_20 $chk>20";
            $chk = ( $this->m_day_21 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_21 $chk>21";
            $chk = ( $this->m_day_22 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_22 $chk>22";
            $chk = ( $this->m_day_23 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_23 $chk>23";
            $chk = ( $this->m_day_24 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_24 $chk>24";
            $chk = ( $this->m_day_25 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_25 $chk>25";
            $chk = ( $this->m_day_26 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_26 $chk>26";
            $chk = ( $this->m_day_27 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_27 $chk>27";
            $chk = ( $this->m_day_28 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_28 $chk>28";
            $chk = ( $this->m_day_29 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_29 $chk>29";
            $chk = ( $this->m_day_30 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_30 $chk>30";
            $chk = ( $this->m_day_31 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_31 $chk>31<br>";
            echo "$msgImMonat<br>";
            $chk = ( $this->m_january ? 'checked' : '' );
            echo "<input type=checkbox name=s4_jan $chk>$msgJanuar";
            $chk = ( $this->m_february ? 'checked' : '' );
            echo "<input type=checkbox name=s4_feb $chk>$msgFebruar";
            $chk = ( $this->m_march ? 'checked' : '' );
            echo "<input type=checkbox name=s4_mar $chk>$msgMaerz";
            $chk = ( $this->m_april ? 'checked' : '' );
            echo "<input type=checkbox name=s4_apr $chk>$msgApril";
            $chk = ( $this->m_may ? 'checked' : '' );
            echo "<input type=checkbox name=s4_may $chk>$msgMai";
            $chk = ( $this->m_june ? 'checked' : '' );
            echo "<input type=checkbox name=s4_jun $chk>$msgJuni";
            $chk = ( $this->m_july ? 'checked' : '' );
            echo "<input type=checkbox name=s4_jul $chk>$msgJuli<br>";
            $chk = ( $this->august ? 'checked' : '' );
            echo "<input type=checkbox name=s4_aug $chk>$msgAugust";
            $chk = ( $this->m_september ? 'checked' : '' );
            echo "<input type=checkbox name=s4_sep $chk>$msgSeptember";
            $chk = ( $this->m_october ? 'checked' : '' );
            echo "<input type=checkbox name=s4_oct $chk>$msgOktober";
            $chk = ( $this->m_november ? 'checked' : '' );
            echo "<input type=checkbox name=s4_nov $chk>$msgNovember";
            $chk = ( $this->m_december ? 'checked' : '' );
            echo "<input type=checkbox name=s4_dec $chk>$msgDezember";
        echo "</td></tr>";

    }   // function FillForm

/*

    public function SetDay01( $set = null){
        if ($set != null) $this->m_day_01 = $set;
        return $this->m_day_01;
     }      // public function SetDay01()

    public function SetDay02( $set = null){
        if ($set != null) $this->m_day_02 = $set;
        return $this->m_day_02;
     }      // public function SetDay02()

    public function SetDay03( $set = null){
        if ($set != null) $this->m_day_03 = $set;
        return $this->m_day_03;
     }      // public function SetDay03()

    public function SetDay04( $set = null){
        if ($set != null) $this->m_day_04 = $set;
        return $this->m_day_04;
     }      // public function SetDay04()

    public function SetDay05( $set = null){
        if ($set != null) $this->m_day_05 = $set;
        return $this->m_day_05;
     }      // public function SetDay05()

    public function SetDay06( $set = null){
        if ($set != null) $this->m_day_06 = $set;
        return $this->m_day_06;
     }      // public function SetDay06()

    public function SetDay07( $set = null){
        if ($set != null) $this->m_day_07 = $set;
        return $this->m_day_07;
     }      // public function SetDay07()

    public function SetDay08( $set = null){
        if ($set != null) $this->m_day_08 = $set;
        return $this->m_day_08;
     }      // public function SetDay08()

    public function SetDay09( $set = null){
        if ($set != null) $this->m_day_09 = $set;
        return $this->m_day_09;
     }      // public function SetDay09()

    public function SetDay10( $set = null){
        if ($set != null) $this->m_day_10 = $set;
        return $this->m_day_10;
     }      // public function SetDay10()

    public function SetDay11( $set = null){
        if ($set != null) $this->m_day_11 = $set;
        return $this->m_day_11;
     }      // public function SetDay11()

    public function SetDay12( $set = null){
        if ($set != null) $this->m_day_12 = $set;
        return $this->m_day_12;
     }      // public function SetDay12()

    public function SetDay13( $set = null){
        if ($set != null) $this->m_day_13 = $set;
        return $this->m_day_13;
     }      // public function SetDay13()

    public function SetDay14( $set = null){
        if ($set != null) $this->m_day_14 = $set;
        return $this->m_day_14;
     }      // public function SetDay14()

    public function SetDay15( $set = null){
        if ($set != null) $this->m_day_15 = $set;
        return $this->m_day_15;
     }      // public function SetDay15()

    public function SetDay16( $set = null){
        if ($set != null) $this->m_day_16 = $set;
        return $this->m_day_16;
     }      // public function SetDay16()

    public function SetDay17( $set = null){
        if ($set != null) $this->m_day_17 = $set;
        return $this->m_day_17;
     }      // public function SetDay17()

    public function SetDay18( $set = null){
        if ($set != null) $this->m_day_18 = $set;
        return $this->m_day_18;
     }      // public function SetDay18()

    public function SetDay19( $set = null){
        if ($set != null) $this->m_day_19 = $set;
        return $this->m_day_19;
     }      // public function SetDay19()

    public function SetDay20( $set = null){
        if ($set != null) $this->m_day_20 = $set;
        return $this->m_day_20;
     }      // public function SetDay20()

    public function SetDay21( $set = null){
        if ($set != null) $this->m_day_21 = $set;
        return $this->m_day_21;
     }      // public function SetDay21()

    public function SetDay22( $set = null){
        if ($set != null) $this->m_day_22 = $set;
        return $this->m_day_22;
     }      // public function SetDay22()

    public function SetDay23( $set = null){
        if ($set != null) $this->m_day_23 = $set;
        return $this->m_day_23;
     }      // public function SetDay23()

    public function SetDay24( $set = null){
        if ($set != null) $this->m_day_24 = $set;
        return $this->m_day_24;
     }      // public function SetDay24()

    public function SetDay25( $set = null){
        if ($set != null) $this->m_day_25 = $set;
        return $this->m_day_25;
     }      // public function SetDay25()

    public function SetDay26( $set = null){
        if ($set != null) $this->m_day_26 = $set;
        return $this->m_day_26;
     }      // public function SetDay26()

    public function SetDay27( $set = null){
        if ($set != null) $this->m_day_27 = $set;
        return $this->m_day_27;
     }      // public function SetDay27()

    public function SetDay28( $set = null){
        if ($set != null) $this->m_day_28 = $set;
        return $this->m_day_28;
     }      // public function SetDay28()

    public function SetDay29( $set = null){
        if ($set != null) $this->m_day_29 = $set;
        return $this->m_day_29;
     }      // public function SetDay29()

    public function SetDay30( $set = null){
        if ($set != null) $this->m_day_30 = $set;
        return $this->m_day_30;
     }      // public function SetDay30()

    public function SetDay31( $set = null){
        if ($set != null) $this->m_day_31 = $set;
        return $this->m_day_31;
     }      // public function SetDay31()

    public function SetJan( $set = null){
        if ($set != null) $this->m_january = $set;
        return $this->m_january;
     }      // public function SetJan()

    public function SetFeb( $set = null){
        if ($set != null) $this->m_february = $set;
        return $this->m_february;
     }      // public function SetFeb()

    public function SetMar( $set = null){
        if ($set != null) $this->m_march = $set;
        return $this->m_march;
     }      // public function SetMar()

    public function SetApr( $set = null){
        if ($set != null) $this->m_april = $set;
        return $this->m_april;
     }      // public function SetApr()

    public function SetMay( $set = null){
        if ($set != null) $this->m_may = $set;
        return $this->m_may;
     }      // public function SetMai()

    public function SetJun( $set = null){
        if ($set != null) $this->m_june = $set;
        return $this->m_june;
     }      // public function SetJun()

    public function SetJul( $set = null){
        if ($set != null) $this->m_july = $set;
        return $this->m_july;
     }      // public function SetJul()

    public function SetAug( $set = null){
        if ($set != null) $this->august = $set;
        return $this->august;
     }      // public function SetAug()

    public function SetSep( $set = null){
        if ($set != null) $this->m_september = $set;
        return $this->m_september;
     }      // public function SetSep()

    public function SetOct( $set = null){
        if ($set != null) $this->m_october = $set;
        return $this->m_october;
     }      // public function SetOct()

    public function SetNov( $set = null){
        if ($set != null) $this->m_november = $set;
        return $this->m_november;
     }      // public function SetNov()

    public function SetDec( $set = null){
        if ($set != null) $this->m_december = $set;
        return $this->m_december;
     }      // public function SetDec()
*/

    /**
      * The method PrintDaysAndMonths( ) prints the day and month numbers
      *
      * @see Dump
      *
      */

    protected function PrintDaysAndMonths(  ) {

	$this->GetMonthArray( $months );

	$str_months = implode( ',', $months );

	$this->GetMonthDayArray( $days );

	$str_days = implode( ',', $days );

	echo "\n The days set for events are {$str_days} for the months {$str_months}";


    }	// functiom PrintDaysAndMonths( )

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

	$this->PrintDaysAndMonths( );

    }   // function Dump( )

    /**
      * The method GetNextEventSlot(  ) returns the next date after $obj_date, WITHOUT checking for special situations or
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

	$day = $obj_date->DOM( );
	$month = $obj_date->Month( );
	$year = $obj_date->Year( );
	$month_org = $month;

	$day_next = -1;
	$month_next = -1;
	$year_next = -1;

	$obj_date_ret = null;

	if ( $this->m_debug ) echo "\n GetNextEventSlot( ) starts with " . $obj_date->AsSQL( ) . ' direction is ' . ( $direction == self::DIRECTION_FORWARD ? ' forward' : 'backward');
	if ( $this->m_debug ) echo ' from ' .  debug_backtrace()[1]['function'] . '/' . debug_backtrace()[0]['line'];


	if ( $direction == self::DIRECTION_FORWARD ) {

	    if ( $this->m_debug ) echo "\n direction = forward";

	    // nächstmögliche Tageszahl berechnen

	    for ( $i = 0; $i < count( $this->m_a_selected_days ); $i++ ) {

		if ( $this->m_a_selected_days[ $i ] == $day ) {

		    if ( $i < count( $this->m_a_selected_days ) - 1  ) {
			$day_next = $this->m_a_selected_days[ $i + 1 ];
			if ( $this->m_debug ) echo "\n next possible day slot = $day_next";
			break;
		    } else {
			$day_next = $this->m_a_selected_days[ 0 ];
			$month++;
			if ( $month > 12 ) { $month = 1; $year++; }
			if ( $this->m_debug ) echo "\n next possible day slot = $day_next";
			break;
		    }

		} elseif ( $this->m_a_selected_days[ $i ] > $day ) {
		    $day_next = $this->m_a_selected_days[ $i ];
		    if ( $this->m_debug ) echo "\n next possible day slot = $day_next";
		    break;
		}

	    }

	    // if ( ! checkdate( $month, $day_next, $year ) ) $day_next = $this->m_a_selected_days[ 0 ];

	    if ( $day_next == -1 ) {
		// erstmöglicher Termin im nächsten Monat
		$day_next = $this->m_a_selected_days[ 0 ];
		$month ++;
		if ( $month > 12 ) { $month = 1; $year++; }
	    }



	    // nächstmögliche Monatszahl berechnen

	    if ( ! in_array( $month, $this->m_a_selected_months ) ) {
		// anderer Monat, also den ersten Tageseintrag verwenden
		$day_next = $this->m_a_selected_days[ 0 ];
	    }

	    if ( ( $month != $month_org ) || ! in_array( $month, $this->m_a_selected_months ) ) {
		for ( $i = 0; $i < count( $this->m_a_selected_months ); $i++ ) {

		    if ( $this->m_a_selected_months[ $i ] == $month ) {

			if ( $i < count( $this->m_a_selected_months ) - 1  ) {
			    $month_next = $this->m_a_selected_months[ $i + 1 ];
			    if ( $this->m_debug ) echo "\n next possible month slot = $month_next in $year";
			    break;
			} else {
			    $month_next = $this->m_a_selected_months[ 0 ];
			    $year++;
			    if ( $this->m_debug ) echo "\n next possible month slot = $month_next in $year";
			    break;
			}

		    } elseif ( $this->m_a_selected_months[ $i ] > $month ) {
			if ( $this->m_debug ) echo "\n next possible month slot = $month_next in $year";
			$month_next = $this->m_a_selected_months[ $i ];
			break;
		    }

		}

		if ( $month_next == -1 ) {
		    // erstmöglicher Termin im nächsten Monat
		    $month_next = $this->m_a_selected_months[ 0 ];
		    $year ++;
		}

	    } else {
		$month_next = $month_org;
	    }



	    if ( $this->m_debug ) echo "\n trying now date slot {$year}-{$month_next}-{$day_next} ";

	    $obj_date_ret = new cDate( $month_next, 1, $year );

	    if ( $this->m_debug ) echo "\n starting with " . $obj_date_ret->AsSQL( ) . " LOM = " . $obj_date_ret->LOM( );

	    if ( $obj_date_ret->LOM( ) < $day_next ) {
//		if ( $direction == self::DIRECTION_FORWARD ) {
		    $obj_date_ret->AddMonths( );
		    if ( $this->m_debug ) echo "\n AddMonths( ) returns " . $obj_date_ret->AsSQL( );
		    $obj_date_ret->SetDay( 1 );
// 		} else {
// 		    $obj_date_ret->SetDay( $obj_date_ret->LOM( ) );
// 		}
	    } else {
		$obj_date_ret = new cDate( $month_next, $day_next, $year );
	    }

	    if ( $this->m_debug ) echo "\n found date slot " . $obj_date_ret->AsSQL( );

// 	    assert( checkdate( $month_next, $day_next, $year ) );

// 	    $obj_date_ret = new cDate( $month_next, $day_next, $year );

	} else {

	    // $direction ist nun self::DIRECTION_BACKWARD

	    if ( $this->m_debug ) echo "\n direction = backward";

	    // nächstmögliche Tageszahl berechnen

	    for ( $i = count( $this->m_a_selected_days ) - 1; $i >= 0 ; $i-- ) {

// 		if ( $this->m_debug ) echo "\n checking day " . $this->m_a_selected_days[ $i ];

		if ( $this->m_a_selected_days[ $i ] == $day ) {

		    if ( $i > 0 ) {
			$day_next = $this->m_a_selected_days[ $i - 1 ];
			if ( $this->m_debug ) echo "\n next day will be $day_next in $month (1)";
			break;
		    } else {
			$day_next = $this->m_a_selected_days[ count( $this->m_a_selected_days ) - 1  ];
			$month--;
			if ( $month < 1 ) { $month = $this->m_a_selected_months[ count( $this->m_a_selected_months ) - 1  ]; $year--; }
			if ( $this->m_debug ) echo "\n next day will be $day_next in $month (2)";
			break;
		    }

		} elseif ( $this->m_a_selected_days[ $i ] < $day ) {
		    $day_next = $this->m_a_selected_days[ $i ];
		    if ( $this->m_debug ) echo "\n next day will be $day_next in $month in $year (3)";
		    break;
		}

	    }

	    if ( $day_next == -1 ) {
		// letztmöglicher Termin im vorherigen Monat
		$day_next = $this->m_a_selected_days[ count( $this->m_a_selected_days ) - 1  ];
		$month --;
		if ( $month < 1 ) { $month = 12; $year--; }
		if ( $this->m_debug ) echo "\n set day to $day_next in $month in $year";
	    }

	    if ( $this->m_debug ) echo "\n selected next day $day_next in $month";

	    // nächstmögliche Monatszahl berechnen

	    if ( in_array( $month, $this->m_a_selected_months ) ) {
		echo "\n $month is a valid month ";
		$month_next = $month;
	    } else {

		$day_next = $this->m_a_selected_days[ count( $this->m_a_selected_days ) - 1  ];

		for ( $i = count( $this->m_a_selected_months ) - 1; $i >= 0 ; $i-- ) {

// 		    if ( $this->m_debug ) echo "\n checking month " . $this->m_a_selected_months[ $i ];

		    if ( $this->m_a_selected_months[ $i ] == $month ) {

			if ( $i > 1 ) {
			    $month_next = $this->m_a_selected_months[ $i - 1 ];
			    if ( $this->m_debug ) echo "\n next month will be $mondth_next in $year (1)";
			    break;
			} else {
			    $month_next = $this->m_a_selected_months[ count( $this->m_a_selected_months ) - 1  ];
			    $year--;
			    if ( $this->m_debug ) echo "\n next month will be $month_next in $year (2)";
			    break;
			}

		    } elseif ( $this->m_a_selected_months[ $i ] < $month ) {

			$month_next = $this->m_a_selected_months[ $i ];
			if ( $this->m_debug ) echo "\n next month will be $month_next in $year (3)";
			break;
		    }

		}
	    }

	    if ( $month_next == -1 ) {
		// letztmöglicher Termin im letzten Monat

		$month_next = $this->m_a_selected_months[ count( $this->m_a_selected_months ) - 1  ];
		$year --;

		if ( $this->m_debug ) echo "\n month was -1 ->  $month_next in $year (3)";
	    }

	    if ( $this->m_debug ) echo "\n selected next day $day_next in $month_next in $year";

//
	    if ( $this->m_debug ) echo "\n trying now date slot {$year}-{$month_next}-{$day_next} ";


	    if ( ! checkdate( $month_next, $day_next, $year) ) {

		$obj_date_ret = new cDate( $month_next, 1, $year );
		$obj_date_ret->GoEOM( );

		echo "\n wrong $day_next -> LOM = " . $obj_date_ret->LOM( );

		// $obj_date_ret->Skip( - ( $day_next - $obj_date_ret->LOM( ) ) );
		$obj_date_ret->Skip(  ( $obj_date_ret->LOM( ) - $day_next ) );


		if ( $this->m_debug ) echo "\n adjusted date to " . $obj_date_ret->AsSQL( ) ;
	    } else {
		$obj_date_ret = new cDate( $month_next, $day_next, $year );
	    }
/*
	    ///////////////////////////////////////////////////////////

	    $obj_date_ret = new cDate( $month_next, 1, $year );
	    $obj_date_ret->GoEOM( );

	    if ( $this->m_debug ) echo "\n starting with " . $obj_date_ret->AsSQL( ) . " LOM = " . $obj_date_ret->LOM( );

	    if ( $obj_date_ret->LOM( ) < $day_next ) {
// 		if ( $direction == self::DIRECTION_BACKWARD ) {
// 		    $obj_date_ret->AddMonths( );
// 		    if ( $this->m_debug ) echo "\n AddMonths( ) returns " . $obj_date_ret->AsSQL( );
// 		    $obj_date_ret->SetDay( 1 );
// 		} else {
		    $obj_date_ret->SetDay( $obj_date_ret->LOM( ) );
// 		}
	    } else {
		$obj_date_ret = new cDate( $month_next, $day_next, $year );
	    }

	    if ( $this->m_debug ) echo "\n found date slot " . $obj_date_ret->AsSQL( );
//


	    assert( checkdate( $month_next, $day_next, $year ) );

	    $obj_date_ret = new cDate( $month_next, $day_next, $year );
*/

	}


	assert( ! is_null( $obj_date_ret ) );

	if ( $this->m_debug ) echo "\n GetNextEventSlot( ) returns " . $obj_date_ret->AsSQL( );

	return $obj_date_ret;

    }	// functiom GetNextEventSlot( )


    /*  *
      * The method GetFollower( ) returns the next date AFTER $date, which fits to the specifications. $date itself will not be taken into consideration.
      *
      * @param cDate $date a cDate object, which is the starting point for the next calculation
      * @param cDate $dt_next GetFollower returns a cDate object, which is the starting point for the next calculation. ie If we are moving backwards and scheduling forward, then a correction is necessary
      * @param int $direction the constant, which indicates the search direction. It defaults to DIRECTION_FORWARD
      *
      * @return cDate cDate object with the next fitting date or null, if no fitting date could be found ( overflow, IsUnderflow)
      *
      * @see GetFollower
      * @see GetFirstDate
      * @see DIRECTION_BACKWARD
      * @see DIRECTION_FORWARD
      *
      */

/*
    function GetFollower( $date, & $dt_next, $direction = self::DIRECTION_FORWARD ) {

        // $date_test muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen

        # echo "\nGetFollower(".$date->AsDMY(). ") : GetLatestDayNumber() ergibt " . $this->GetLatestDayNumber();

        assert( is_int( $direction ) );
        assert( is_a( $date, '\\libdatephp\\cDate' ) );

        if ( ! $this->IsValid( ) ) die( "\n cDateStrategyMonthly::GetFollower() : no valid data to calculate anything" );

        assert( is_a( $date, '\\libdatephp\\cDate' ) );

//         $month_skipped = false;		// we did not change the month yet
//         $quarter_skipped = false;	// we did not change the quarter yet
//         $year_skipped = false;		// we did not change the year yet

        //

        if ( $this->m_debug ) echo "\n GetFollower( ) starts with " . $date->AsSQL( ) . ' called  by ' . debug_backtrace()[1]['function'] . '/' . debug_backtrace()[0]['line'] ;
	if ( $this->m_debug) echo " direction = " . ( $direction == self::DIRECTION_FORWARD ? ' forward' : ' backward') ;
        //

        $date_test = new cDate( $date);

        //

        if ( $this->AdjustedUnderOverflow( $date_test, $direction ) ) {

	    if ( is_null( $date_test ) ) {
		// not adjustable

		return null;
	    }

        }

        //

        $date_test = $this->GetNextEventSlot( $date_test, $direction );

        // $this->ScheduleLazy( $date_test, $date_test,  $direction  );

        if ( $this->m_debug ) echo "\n normally we would use " . $date_test->AsSQL( );

        //

        if ( is_null( $date ) ) return null;


        $fertig = false;
        $dt_next = null;

        // $direction = self::DIRECTION_FORWARD;
//         $weiter = true;
	  $weiter = false;

        do {

// 	    $weiter = false;

	    if ( $this->AdjustedUnderOverflow( $date_test, $direction ) ) {

		if ( is_null( $date_test ) ) {
		    // not adjustable

		    return null;
		}

	    }

	    if ( $weiter ) {
		if ( $direction == self::DIRECTION_FORWARD ) {
		    $date_test->Inc( );
		} elseif ( $direction == self::DIRECTION_BACKWARD) {
		    $date_test->Dec( );
		}
	    }

	    $weiter = false;

	    if ( $this->m_debug ) echo "\n skipped to " . $date_test->AsSQL( );
	    echo ' direction is ' . ( $direction == self::DIRECTION_FORWARD ? ' forward ' : ' backward ' ) ;


            if ( $date_test->IsSaturday( ) ) {
		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is a saturday';
		if ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $date_test );
		    // if ( is_null( $dt_next ) ) $dt_next = $date_test;
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    // if ( $this->m_debug ) echo "\n moved to " . $date_test->AsSQL( ) . ' from ' . $gemerkt->AsSQL( );
		    if ( is_null( $date_test ) ) return null;

		} elseif ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    // if ( is_null( $dt_next ) ) $dt_next = $date_test;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    // if ( $this->m_debug ) echo "\n moved to " . $date_test->AsSQL( ) . ' from ' . $gemerkt->AsSQL( );
		    if ( is_null( $date_test ) ) return null;

		} elseif ( $this->m_directionOnSaturday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }

            if ( $date_test->IsSunday( ) ) {

		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is a sunday';

		if ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		   //  if ( is_null( $dt_next ) ) $dt_next = $date_test;
		   if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $date_test ) ) return null;
		} elseif ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    // if ( ( $direction == self::DIRECTION_BACKWARD ) && ( is_null( $dt_next ) ) ) $dt_next = $date_test;
		    // if ( ( is_null( $dt_next ) ) ) $dt_next = $date_test;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $date_test ) ) return null;
		} elseif ( $this->m_directionOnSunday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }


            if ( ! ( is_null( $date_test ) ) && ( $this->IsCelebrity( $date_test ) ) ) {

		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is a celebrity';

		if ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    // if ( is_null( $dt_next ) ) $dt_next = $date_test;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $date_test );
		    $dt_next = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $date_test ) ) return null;
		} elseif ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    // if ( is_null( $dt_next ) ) $dt_next = $date_test;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $date_test ) ) return null;
		} elseif ( $this->m_directionOnCelebrity == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }

            if ( ! ( is_null( $date_test ) ) && ( $this->IsHoliday( $date_test ) ) ) {

		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is a holiday';

		if ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_FORWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_FORWARD;
		    if ( $direction == self::DIRECTION_BACKWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $dt_next ) ) $dt_next = $date_test;

		    if ( is_null( $date_test ) ) return null;
		} elseif ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_BACKWARD ) {
// 		    $weiter = true;
// 		    $direction = self::DIRECTION_BACKWARD;
		    if ( $direction == self::DIRECTION_FORWARD ) $dt_next = new cDate( $date_test );
		    $date_test = $this->MoveDateIfNecessary( $date_test );
		    if ( is_null( $dt_next ) ) $dt_next = $date_test;
		    if ( is_null( $date_test ) ) return null;
		} elseif ( $this->m_directionOnHoliday == cDateStrategy::STRATEGY_DIRECTION_ABOLISH ) {
		    return null;
		}
            }

	    if ($this->IsUnderflow($date_test) && ( $direction == self::DIRECTION_FORWARD )) {

		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is an underflow';

		$date_test = new \libdatephp\cDate( $this->m_start_date );
		$date_test->Dec( );
	    }
	    if ($this->IsOverflow($date_test) && ( $direction == self::DIRECTION_FORWARD)) return null;
	    if ($this->IsUnderflow($date_test) && ( $direction == self::DIRECTION_BACKWARD)) return null;
	    if ($this->IsOverflow($date_test) && ( $direction == self::DIRECTION_BACKWARD )) {
		if ( $this->m_debug ) echo "\n" . $date_test->AsSQL( ) . ' is an overflow';
		$date_test = new \libdatephp\cDate( $this->m_end_date );
		$date_test->Inc( );
	    }

        } while ( $weiter );

	if ( $this->m_debug ) echo "\n GetFollower returns " . $date_test->AsSQL( ) . ' to ' .  debug_backtrace()[1]['function'];;

	if ( is_null( $dt_next ) ) $dt_next = $date_test;

	echo "\n next try should be " . $dt_next->AsSQL( );

        return $date_test;

    }       // function GetFollower()

*/


/*

    function GetFollower_uralt( $date ) {
        // $dateObj muß ein gültiges Datum sein, an dem ein Termin stattfindet ! -> protected um dies zu gewährleisten
        // es wird keine Korrektur vorgenommen
        // falls 29,30,31 für Februar und März angegeben und es ist der 28.februar, dann folgt auf diesen Termin der 28. März !

        $dateObj = new cDate( $date);
        $fertig = false;

        do {

            $day = $dateObj->Day();
            $month = $dateObj->Month();
            $year = $dateObj->Year();

            $dateObj->inc();

            // echo "<br>GetFollower() : Untersuche " . $dateObj->AsDMY();

            $day = $dateObj->Day();
            $month = $dateObj->Month();
            $year = $dateObj->Year();

            switch( $month ) {
                case 1:
                    if ($this->SetJan()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetJan()
                break;
                case 2: // Februar
                    if ($this->SetFeb()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            # case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            # case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            # case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetFeb()
                break;
                case 3: // März
                    if ($this->SetMar()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetMar()
                break;
                case 4: // April
                    if ($this->SetApr()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetApr()
                break;
                case 5: // Mai
                    if ($this->SetMay()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetMai()
                break;
                case 6: // Juni
                    if ($this->SetJun()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetJun()
                break;
                case 7: // Juli
                    if ($this->SetJul()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetJul()
                break;
                case 8: // August
                    if ($this->SetAug()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetAug()
                break;
                case 9: // September
                    if ($this->SetSep()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetSep()
                break;
                case 10: // Oktober
                    if ($this->SetOct()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetOct()
                break;
                case 11: // November
                    if ($this->SetNov()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetNov()
                break;
                case 12:  // Dezember
                    if ($this->SetDec()) {
                        switch($day) {
                            case  1: if ($this->SetDay01()) { return $dateObj; } break;
                            case  2: if ($this->SetDay02()) { return $dateObj; } break;
                            case  3: if ($this->SetDay03()) { return $dateObj; } break;
                            case  4: if ($this->SetDay04()) { return $dateObj; } break;
                            case  5: if ($this->SetDay05()) { return $dateObj; } break;
                            case  6: if ($this->SetDay06()) { return $dateObj; } break;
                            case  7: if ($this->SetDay07()) { return $dateObj; } break;
                            case  8: if ($this->SetDay08()) { return $dateObj; } break;
                            case  9: if ($this->SetDay09()) { return $dateObj; } break;
                            case 10: if ($this->SetDay10()) { return $dateObj; } break;
                            case 11: if ($this->SetDay11()) { return $dateObj; } break;
                            case 12: if ($this->SetDay12()) { return $dateObj; } break;
                            case 13: if ($this->SetDay13()) { return $dateObj; } break;
                            case 14: if ($this->SetDay14()) { return $dateObj; } break;
                            case 15: if ($this->SetDay15()) { return $dateObj; } break;
                            case 16: if ($this->SetDay16()) { return $dateObj; } break;
                            case 17: if ($this->SetDay17()) { return $dateObj; } break;
                            case 18: if ($this->SetDay18()) { return $dateObj; } break;
                            case 19: if ($this->SetDay19()) { return $dateObj; } break;
                            case 20: if ($this->SetDay20()) { return $dateObj; } break;
                            case 21: if ($this->SetDay21()) { return $dateObj; } break;
                            case 22: if ($this->SetDay22()) { return $dateObj; } break;
                            case 23: if ($this->SetDay23()) { return $dateObj; } break;
                            case 24: if ($this->SetDay24()) { return $dateObj; } break;
                            case 25: if ($this->SetDay25()) { return $dateObj; } break;
                            case 26: if ($this->SetDay26()) { return $dateObj; } break;
                            case 27: if ($this->SetDay27()) { return $dateObj; } break;
                            case 28: if ($this->SetDay28()) { return $dateObj; } break;
                            case 29: if ($this->SetDay29()) { return $dateObj; } break;
                            case 30: if ($this->SetDay30()) { return $dateObj; } break;
                            case 31: if ($this->SetDay31()) { return $dateObj; } break;
                        }
                    }   // SetDec()
                break;
            }   // switch ($month)

        } while ( !$fertig );



        return null;

    }       // function GetFollower()

*/


    public function GetNextEventDate( $datestart, $dateisfirst = true  ) {

        if ( $this->IsUnderflow( $datestart ) ) { return null; }
        if ( $this->IsOverflow( $datestart ) ) return null;

        $dt = $this->GetFirstDate( );

        # echo "<br> GetNextEventDate() : erster Termin ist am " . $dt->AsDMY();

        if ( ($dateisfirst == true ) && ($datestart->eq($dt)) ) { return $dt; }

        $fertig = false;

        do {
            $dt = $this->GetFollower( $dt );
            # echo "<br> GetNextEventDate() : untersuche " . $dt->AsDMY();
            if ( $datestart->eq( $dt ) && ( $dateisfirst ) ) return $dt;
            if ( $this->IsOverflow( $dt ) ) {  return null; }
            if ( $datestart->lt( $dt ) ) return $dt;
        } while ( !$fertig);

        return null;

    }   // function GetNextEventDate

    /**
      * The method GetFirstDate( ) returns the first valid date of the series to be calculated according to the specifications
      *
      * @return cDate a cDate object with the first fitting date or null, if no fitting date could be found ( overflow, IsUnderflow)
      *
      * @see GetFollower
      * @see GetFirstDate
      *
      *
      */


    public function GetFirstDate( ) {

	if ( ! $this->IsValid( ) ) die( "\n cDateStrategyMonthly::GetFirstDate() : no valid data to calculate anything" );

	$dt = new \libdatephp\cDate( $this->m_start_date );

	if ( is_null( $this->m_start_date ) ) die( "\n cannot calculate a first date, when there is no starting date!" );

	$dt = $this->GetNextEventSlot( $dt, self::DIRECTION_FORWARD );

	$dt = $this->MoveDateIfNecessary( $dt );

	if ( $this->m_debug ) echo "\n GetFirstDate( ) returns " . $dt->AsSQL( );


        return $dt;

    }   // function GetFirstDate


/*
    public function GetFirstDate( ) {

        $dateObj =new cDate($this->m_start_date);
        $len = $dateObj->LOY();

        for ( $i = 0; $i<$len; $i++ ) {
            if ( $i >0 ) $dateObj->inc();
            # echo "<br>GetFirstDate() untersucht " . $dateObj->AsDMY();

            if ( ( $dateObj->InJanuary() ) && ($this->SetJan()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InFebruary() ) && ($this->SetFeb()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InMarch() ) && ($this->SetMar()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InApril() ) && ($this->SetApr()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InMay() ) && ($this->SetMay()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InJune() ) && ($this->SetJun()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InJuly() ) && ($this->SetJul()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InAugust() ) && ($this->SetAug()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InSeptember() ) && ($this->SetSep()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InOctober() ) && ($this->SetOct()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InNovember() ) && ($this->SetNov()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            } elseif ( ( $dateObj->InDecember() ) && ($this->SetDec()) ) {
                if (( $dateObj->Day() ==  1 ) && ($this->SetDay01()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  2 ) && ($this->SetDay02()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  3 ) && ($this->SetDay03()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  4 ) && ($this->SetDay04()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  5 ) && ($this->SetDay05()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  6 ) && ($this->SetDay06()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  7 ) && ($this->SetDay07()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  8 ) && ($this->SetDay08()) ) { return $dateObj; }
                if (( $dateObj->Day() ==  9 ) && ($this->SetDay09()) ) { return $dateObj; }
                if (( $dateObj->Day() == 10 ) && ($this->SetDay10()) ) { return $dateObj; }
                if (( $dateObj->Day() == 11 ) && ($this->SetDay11()) ) { return $dateObj; }
                if (( $dateObj->Day() == 12 ) && ($this->SetDay12()) ) { return $dateObj; }
                if (( $dateObj->Day() == 13 ) && ($this->SetDay13()) ) { return $dateObj; }
                if (( $dateObj->Day() == 14 ) && ($this->SetDay14()) ) { return $dateObj; }
                if (( $dateObj->Day() == 15 ) && ($this->SetDay15()) ) { return $dateObj; }
                if (( $dateObj->Day() == 16 ) && ($this->SetDay16()) ) { return $dateObj; }
                if (( $dateObj->Day() == 17 ) && ($this->SetDay17()) ) { return $dateObj; }
                if (( $dateObj->Day() == 18 ) && ($this->SetDay18()) ) { return $dateObj; }
                if (( $dateObj->Day() == 19 ) && ($this->SetDay19()) ) { return $dateObj; }
                if (( $dateObj->Day() == 20 ) && ($this->SetDay20()) ) { return $dateObj; }
                if (( $dateObj->Day() == 21 ) && ($this->SetDay21()) ) { return $dateObj; }
                if (( $dateObj->Day() == 22 ) && ($this->SetDay22()) ) { return $dateObj; }
                if (( $dateObj->Day() == 23 ) && ($this->SetDay23()) ) { return $dateObj; }
                if (( $dateObj->Day() == 24 ) && ($this->SetDay24()) ) { return $dateObj; }
                if (( $dateObj->Day() == 25 ) && ($this->SetDay25()) ) { return $dateObj; }
                if (( $dateObj->Day() == 26 ) && ($this->SetDay26()) ) { return $dateObj; }
                if (( $dateObj->Day() == 27 ) && ($this->SetDay27()) ) { return $dateObj; }
                if (( $dateObj->Day() == 28 ) && ($this->SetDay28()) ) { return $dateObj; }
                if (( $dateObj->Day() == 29 ) && ($this->SetDay29()) ) { return $dateObj; }
                if (( $dateObj->Day() == 30 ) && ($this->SetDay30()) ) { return $dateObj; }
                if (( $dateObj->Day() == 31 ) && ($this->SetDay31()) ) { return $dateObj; }
            }

            if (  ($this->m_end_date != null ) && ( $this->m_end_date->lt( $dateObj ) ) ) return null;
        }

        return null;

    }   // function GetFirstDate
*/


    public function CalculateExceptions( $year )  {

        // errechnet alle nicht mit GetFollower() ermittelten Daten eines Jahres

        $ary = array();

        $date = new cDate(1,1,$year);
        $isLeap = $date->IsLeapyear( );

        if ($isLeap) {
            if (( $this->SetFeb() ) && ( $this->SetDay30())) { $dt = new cDate(3,1,$year ); if (!$this->IsOverflow( $dt )) {$ary[] = $dt;}  }
            if (( $this->SetFeb() ) && ( $this->SetDay31())) { $dt = new cDate(3,2,$year ); if (!$this->IsOverflow( $dt )) {$ary[] = $dt;}  }
        } else {
            if (( $this->SetFeb() ) && ( $this->SetDay29())) { $dt = new cDate(3,1,$year ); if (!$this->IsOverflow( $dt )) {$ary[] = $dt;}  }
            if (( $this->SetFeb() ) && ( $this->SetDay30())) { $dt = new cDate(3,2,$year ); if (!$this->IsOverflow( $dt )) {$ary[] = $dt;}  }
            if (( $this->SetFeb() ) && ( $this->SetDay31())) { $dt = new cDate(3,3,$year ); if (!$this->IsOverflow( $dt )) {$ary[] = $dt;}  }
        }

        if (( $this->SetApr() ) && ( $this->SetDay31())) { $dt = new cDate( 5,1,$year ); if (!$this->IsOverflow( $dt ))  {$ary[] = $dt;}  }
        if (( $this->SetJun() ) && ( $this->SetDay31())) { $dt = new cDate( 7,1,$year ); if (!$this->IsOverflow( $dt ))  {$ary[] = $dt;}  }
        if (( $this->SetSep() ) && ( $this->SetDay31())) { $dt = new cDate(10,1,$year ); if (!$this->IsOverflow( $dt ))  {$ary[] = $dt;}  }
        if (( $this->SetNov() ) && ( $this->SetDay31())) { $dt = new cDate(12,1,$year ); if (!$this->IsOverflow( $dt ))  {$ary[] = $dt;}  }

        return $ary;

    }

}       // of class cDateStrategyMonthly

?>