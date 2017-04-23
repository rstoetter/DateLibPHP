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
//		public method SetApr($set=undef)
//		public method SetAug($set=undef)
//		public method SetDay01($set=undef)
//		public method SetDay02($set=undef)
//		public method SetDay03($set=undef)
//		public method SetDay04($set=undef)
//		public method SetDay05($set=undef)
//		public method SetDay06($set=undef)
//		public method SetDay07($set=undef)
//		public method SetDay08($set=undef)
//		public method SetDay09($set=undef)
//		public method SetDay10($set=undef)
//		public method SetDay11($set=undef)
//		public method SetDay12($set=undef)
//		public method SetDay13($set=undef)
//		public method SetDay14($set=undef)
//		public method SetDay15($set=undef)
//		public method SetDay16($set=undef)
//		public method SetDay17($set=undef)
//		public method SetDay18($set=undef)
//		public method SetDay19($set=undef)
//		public method SetDay20($set=undef)
//		public method SetDay21($set=undef)
//		public method SetDay22($set=undef)
//		public method SetDay23($set=undef)
//		public method SetDay24($set=undef)
//		public method SetDay25($set=undef)
//		public method SetDay26($set=undef)
//		public method SetDay27($set=undef)
//		public method SetDay28($set=undef)
//		public method SetDay29($set=undef)
//		public method SetDay30($set=undef)
//		public method SetDay31($set=undef)
//		public method SetDec($set=undef)
//		public method SetFeb($set=undef)
//		public method SetJan($set=undef)
//		public method SetJul($set=undef)
//		public method SetJun($set=undef)
//		public method SetMar($set=undef)
//		public method SetMay($set=undef)
//		public method SetNov($set=undef)
//		public method SetOct($set=undef)
//		public method SetSep($set=undef)
//		public method cDateStrategyMonthly($str=undef)
//		protected var $apr
//		protected var $aug
//		protected var $d01
//		protected var $d02
//		protected var $d03
//		protected var $d04
//		protected var $d05
//		protected var $d06
//		protected var $d07
//		protected var $d08
//		protected var $d09
//		protected var $d10
//		protected var $d11
//		protected var $d12
//		protected var $d13
//		protected var $d14
//		protected var $d15
//		protected var $d16
//		protected var $d17
//		protected var $d18
//		protected var $d19
//		protected var $d20
//		protected var $d21
//		protected var $d22
//		protected var $d23
//		protected var $d24
//		protected var $d25
//		protected var $d26
//		protected var $d27
//		protected var $d28
//		protected var $d29
//		protected var $d30
//		protected var $d31
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

/////////////////////////////////////////////////////////////////////////////////////
// cDateStrategyMonthly
////////////////////////////////////////////////////////////////////////////////////

class cDateStrategyMonthly extends cDateStrategy {

    // an bestimmten Tagen in bestimmten Monaten

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

    public function cDateStrategyMonthly( $str = undef ) {

           $this->cDateStrategy();      // Konstruktor von abstrakter Klasse aufrufen !

           if ( $str == undef ) {
                $this->Reset( );
            } else {
                $this->FromString( $str ) ;
            }

            $this->IsValid();

    }   // constructor

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

    public function FromString( $str ) {


/*
        sscanf( $str, "s3-%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-%d-p%d",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $this->dayNumber, $this->typePeriod );

*/

        sscanf( $str, "s4-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d}-{%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $startday, $startmonth, $startyear,
            $endday, $endmonth, $endyear,
            $this->d01, $this->d02,$this->d03,$this->d04,$this->d05,$this->d06,$this->d07,$this->d08,$this->d09,$this->d10,$this->d11,
            $this->d12,$this->d13,$this->d14,$this->d15,$this->d16,$this->d17,$this->d18,$this->d19,$this->d20,$this->d21,
            $this->d22,$this->d23,$this->d24,$this->d25,$this->d26,$this->d27,$this->d28,$this->d29,$this->d30, $this->d31,
            $this->jan, $this->feb, $this->mar, $this->apr, $this->may, $this->jun, $this->jul, $this->aug, $this->sep, $this->oct, $this->nov, $this->dec);

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

        return sprintf( "s4-%d:%d:%d:%d-(%d.%d.%d)-(%d.%d.%d)-{%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d}-{%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d:%d}",
            $this->m_directionOnSaturday, $this->m_directionOnSunday, $this->m_directionOnCelebrity,$this->m_directionOnHoliday,
            $this->m_start_date->Day(), $this->m_start_date->Month(), $this->m_start_date->Year(),
            $endday, $endmonth, $endyear,

        $this->d01, $this->d02,$this->d03,$this->d04,$this->d05,$this->d06,$this->d07,$this->d08,$this->d09,$this->d10,$this->d11,
         $this->d12,$this->d13,$this->d14,$this->d15,$this->d16,$this->d17,$this->d18,$this->d19,$this->d20,$this->d21,
         $this->d22,$this->d23,$this->d24,$this->d25,$this->d26,$this->d27,$this->d28,$this->d29,$this->d30, $this->d31,
        $this->jan, $this->feb, $this->mar, $this->apr, $this->may, $this->jun, $this->jul, $this->aug, $this->sep, $this->oct, $this->nov, $this->dec);
    }   // function AsString

    public function FromForm(  ) {
        # $_POST[strategy] = s4_nthday
        # $_POST[s4_03] = on
        # $_POST[s4_30] = on
        # $_POST[s4_jan] = on
        # $_POST[s4_nov] = on

        $radiostrategy = $_POST['strategy'];

        // assert ($radiostrategy == 's4_nthday');

        if ($radiostrategy == 's4_nthday') {

            $this->d01=( isset( $_POST['s4_01'] ) );
            $this->d02=( isset( $_POST['s4_02'] ) );
            $this->d03=( isset( $_POST['s4_03'] ) );
            $this->d04=( isset( $_POST['s4_04'] ) );
            $this->d05=( isset( $_POST['s4_05'] ) );
            $this->d06=( isset( $_POST['s4_06'] ) );
            $this->d07=( isset( $_POST['s4_07'] ) );
            $this->d08=( isset( $_POST['s4_08'] ) );
            $this->d09=( isset( $_POST['s4_09'] ) );
            $this->d10=( isset( $_POST['s4_10'] ) );
            $this->d11=( isset( $_POST['s4_11'] ) );
            $this->d12=( isset( $_POST['s4_12'] ) );
            $this->d13=( isset( $_POST['s4_13'] ) );
            $this->d14=( isset( $_POST['s4_14'] ) );
            $this->d15=( isset( $_POST['s4_15'] ) );
            $this->d16=( isset( $_POST['s4_16'] ) );
            $this->d17=( isset( $_POST['s4_17'] ) );
            $this->d18=( isset( $_POST['s4_18'] ) );
            $this->d19=( isset( $_POST['s4_19'] ) );
            $this->d20=( isset( $_POST['s4_20'] ) );
            $this->d21=( isset( $_POST['s4_21'] ) );
            $this->d22=( isset( $_POST['s4_22'] ) );
            $this->d23=( isset( $_POST['s4_23'] ) );
            $this->d24=( isset( $_POST['s4_24'] ) );
            $this->d25=( isset( $_POST['s4_25'] ) );
            $this->d26=( isset( $_POST['s4_26'] ) );
            $this->d27=( isset( $_POST['s4_27'] ) );
            $this->d28=( isset( $_POST['s4_28'] ) );
            $this->d29=( isset( $_POST['s4_29'] ) );
            $this->d30=( isset( $_POST['s4_30'] ) );
            $this->d31=( isset( $_POST['s4_31'] ) );

            $this->jan=( isset( $_POST['s4_jan'] ) );
            $this->feb=( isset( $_POST['s4_feb'] ) );
            $this->mar=( isset( $_POST['s4_mar'] ) );
            $this->apr=( isset( $_POST['s4_apr'] ) );
            $this->may=( isset( $_POST['s4_may'] ) );
            $this->jun=( isset( $_POST['s4_jun'] ) );
            $this->jul=( isset( $_POST['s4_jul'] ) );
            $this->aug=( isset( $_POST['s4_aug'] ) );
            $this->sep=( isset( $_POST['s4_sep'] ) );
            $this->oct=( isset( $_POST['s4_oct'] ) );
            $this->nov=( isset( $_POST['s4_nov'] ) );
            $this->dec=( isset( $_POST['s4_dec'] ) );

            $this->SetStartEndDatesFromForm();      # Start- und Endedatum setzen
            $this->SetSpecialDaysFromForm( );       # setze die Werte von onSaturday, onSunday und onCelebrity
            $this->IsValid();                  # sind die übergebenen Daten auch valide ?
        }


    }   // function FromForm

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

            $chk = ( $this->d01 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_01 $chk>01";
            $chk = ( $this->d02 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_02 $chk>02";
            $chk = ( $this->d03 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_03 $chk>03";
            $chk = ( $this->d04 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_04 $chk>04";
            $chk = ( $this->d05 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_05 $chk>05";
            $chk = ( $this->d06 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_06 $chk>06";
            $chk = ( $this->d07 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_07 $chk>07";
            $chk = ( $this->d08 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_08 $chk>08";
            $chk = ( $this->d09 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_09 $chk>09";
            $chk = ( $this->d10 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_10 $chk>10";
            $chk = ( $this->d11 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_11 $chk>11";
            $chk = ( $this->d12 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_12 $chk>12";
            $chk = ( $this->d13 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_13 $chk>13";
            $chk = ( $this->d14 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_14 $chk>14";
            $chk = ( $this->d15 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_15 $chk>15<br>";
            $chk = ( $this->d16 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_16 $chk>16";
            $chk = ( $this->d17 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_17 $chk>17";
            $chk = ( $this->d18 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_18 $chk>18";
            $chk = ( $this->d19 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_19 $chk>19";
            $chk = ( $this->d20 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_20 $chk>20";
            $chk = ( $this->d21 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_21 $chk>21";
            $chk = ( $this->d22 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_22 $chk>22";
            $chk = ( $this->d23 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_23 $chk>23";
            $chk = ( $this->d24 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_24 $chk>24";
            $chk = ( $this->d25 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_25 $chk>25";
            $chk = ( $this->d26 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_26 $chk>26";
            $chk = ( $this->d27 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_27 $chk>27";
            $chk = ( $this->d28 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_28 $chk>28";
            $chk = ( $this->d29 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_29 $chk>29";
            $chk = ( $this->d30 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_30 $chk>30";
            $chk = ( $this->d31 ? 'checked' : '' );
            echo "<input type=checkbox name=s4_31 $chk>31<br>";
            echo "$msgImMonat<br>";
            $chk = ( $this->jan ? 'checked' : '' );
            echo "<input type=checkbox name=s4_jan $chk>$msgJanuar";
            $chk = ( $this->feb ? 'checked' : '' );
            echo "<input type=checkbox name=s4_feb $chk>$msgFebruar";
            $chk = ( $this->mar ? 'checked' : '' );
            echo "<input type=checkbox name=s4_mar $chk>$msgMaerz";
            $chk = ( $this->apr ? 'checked' : '' );
            echo "<input type=checkbox name=s4_apr $chk>$msgApril";
            $chk = ( $this->may ? 'checked' : '' );
            echo "<input type=checkbox name=s4_may $chk>$msgMai";
            $chk = ( $this->jun ? 'checked' : '' );
            echo "<input type=checkbox name=s4_jun $chk>$msgJuni";
            $chk = ( $this->jul ? 'checked' : '' );
            echo "<input type=checkbox name=s4_jul $chk>$msgJuli<br>";
            $chk = ( $this->aug ? 'checked' : '' );
            echo "<input type=checkbox name=s4_aug $chk>$msgAugust";
            $chk = ( $this->sep ? 'checked' : '' );
            echo "<input type=checkbox name=s4_sep $chk>$msgSeptember";
            $chk = ( $this->oct ? 'checked' : '' );
            echo "<input type=checkbox name=s4_oct $chk>$msgOktober";
            $chk = ( $this->nov ? 'checked' : '' );
            echo "<input type=checkbox name=s4_nov $chk>$msgNovember";
            $chk = ( $this->dec ? 'checked' : '' );
            echo "<input type=checkbox name=s4_dec $chk>$msgDezember";
        echo "</td></tr>";

    }   // function FillForm

    public function SetDay01( $set = undef){
        if ($set != undef) $this->d01 = $set;
        return $this->d01;
     }      // public function SetDay01()

    public function SetDay02( $set = undef){
        if ($set != undef) $this->d02 = $set;
        return $this->d02;
     }      // public function SetDay02()

    public function SetDay03( $set = undef){
        if ($set != undef) $this->d03 = $set;
        return $this->d03;
     }      // public function SetDay03()

    public function SetDay04( $set = undef){
        if ($set != undef) $this->d04 = $set;
        return $this->d04;
     }      // public function SetDay04()

    public function SetDay05( $set = undef){
        if ($set != undef) $this->d05 = $set;
        return $this->d05;
     }      // public function SetDay05()

    public function SetDay06( $set = undef){
        if ($set != undef) $this->d06 = $set;
        return $this->d06;
     }      // public function SetDay06()

    public function SetDay07( $set = undef){
        if ($set != undef) $this->d07 = $set;
        return $this->d07;
     }      // public function SetDay07()

    public function SetDay08( $set = undef){
        if ($set != undef) $this->d08 = $set;
        return $this->d08;
     }      // public function SetDay08()

    public function SetDay09( $set = undef){
        if ($set != undef) $this->d09 = $set;
        return $this->d09;
     }      // public function SetDay09()

    public function SetDay10( $set = undef){
        if ($set != undef) $this->d10 = $set;
        return $this->d10;
     }      // public function SetDay10()

    public function SetDay11( $set = undef){
        if ($set != undef) $this->d11 = $set;
        return $this->d11;
     }      // public function SetDay11()

    public function SetDay12( $set = undef){
        if ($set != undef) $this->d12 = $set;
        return $this->d12;
     }      // public function SetDay12()

    public function SetDay13( $set = undef){
        if ($set != undef) $this->d13 = $set;
        return $this->d13;
     }      // public function SetDay13()

    public function SetDay14( $set = undef){
        if ($set != undef) $this->d14 = $set;
        return $this->d14;
     }      // public function SetDay14()

    public function SetDay15( $set = undef){
        if ($set != undef) $this->d15 = $set;
        return $this->d15;
     }      // public function SetDay15()

    public function SetDay16( $set = undef){
        if ($set != undef) $this->d16 = $set;
        return $this->d16;
     }      // public function SetDay16()

    public function SetDay17( $set = undef){
        if ($set != undef) $this->d17 = $set;
        return $this->d17;
     }      // public function SetDay17()

    public function SetDay18( $set = undef){
        if ($set != undef) $this->d18 = $set;
        return $this->d18;
     }      // public function SetDay18()

    public function SetDay19( $set = undef){
        if ($set != undef) $this->d19 = $set;
        return $this->d19;
     }      // public function SetDay19()

    public function SetDay20( $set = undef){
        if ($set != undef) $this->d20 = $set;
        return $this->d20;
     }      // public function SetDay20()

    public function SetDay21( $set = undef){
        if ($set != undef) $this->d21 = $set;
        return $this->d21;
     }      // public function SetDay21()

    public function SetDay22( $set = undef){
        if ($set != undef) $this->d22 = $set;
        return $this->d22;
     }      // public function SetDay22()

    public function SetDay23( $set = undef){
        if ($set != undef) $this->d23 = $set;
        return $this->d23;
     }      // public function SetDay23()

    public function SetDay24( $set = undef){
        if ($set != undef) $this->d24 = $set;
        return $this->d24;
     }      // public function SetDay24()

    public function SetDay25( $set = undef){
        if ($set != undef) $this->d25 = $set;
        return $this->d25;
     }      // public function SetDay25()

    public function SetDay26( $set = undef){
        if ($set != undef) $this->d26 = $set;
        return $this->d26;
     }      // public function SetDay26()

    public function SetDay27( $set = undef){
        if ($set != undef) $this->d27 = $set;
        return $this->d27;
     }      // public function SetDay27()

    public function SetDay28( $set = undef){
        if ($set != undef) $this->d28 = $set;
        return $this->d28;
     }      // public function SetDay28()

    public function SetDay29( $set = undef){
        if ($set != undef) $this->d29 = $set;
        return $this->d29;
     }      // public function SetDay29()

    public function SetDay30( $set = undef){
        if ($set != undef) $this->d30 = $set;
        return $this->d30;
     }      // public function SetDay30()

    public function SetDay31( $set = undef){
        if ($set != undef) $this->d31 = $set;
        return $this->d31;
     }      // public function SetDay31()

    public function SetJan( $set = undef){
        if ($set != undef) $this->jan = $set;
        return $this->jan;
     }      // public function SetJan()

    public function SetFeb( $set = undef){
        if ($set != undef) $this->feb = $set;
        return $this->feb;
     }      // public function SetFeb()

    public function SetMar( $set = undef){
        if ($set != undef) $this->mar = $set;
        return $this->mar;
     }      // public function SetMar()

    public function SetApr( $set = undef){
        if ($set != undef) $this->apr = $set;
        return $this->apr;
     }      // public function SetApr()

    public function SetMay( $set = undef){
        if ($set != undef) $this->may = $set;
        return $this->may;
     }      // public function SetMai()

    public function SetJun( $set = undef){
        if ($set != undef) $this->jun = $set;
        return $this->jun;
     }      // public function SetJun()

    public function SetJul( $set = undef){
        if ($set != undef) $this->jul = $set;
        return $this->jul;
     }      // public function SetJul()

    public function SetAug( $set = undef){
        if ($set != undef) $this->aug = $set;
        return $this->aug;
     }      // public function SetAug()

    public function SetSep( $set = undef){
        if ($set != undef) $this->sep = $set;
        return $this->sep;
     }      // public function SetSep()

    public function SetOct( $set = undef){
        if ($set != undef) $this->oct = $set;
        return $this->oct;
     }      // public function SetOct()

    public function SetNov( $set = undef){
        if ($set != undef) $this->nov = $set;
        return $this->nov;
     }      // public function SetNov()

    public function SetDec( $set = undef){
        if ($set != undef) $this->dec = $set;
        return $this->dec;
     }      // public function SetDec()


    function GetFollower( $date ) {
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



        return undef;

    }       // function GetFollower()

    public function GetNextEventDate( $datestart, $dateisfirst = true  ) {

        if ( $this->IsUnderflow( $datestart ) ) { return undef; }
        if ( $this->IsOverflow( $datestart ) ) return undef;

        $dt = $this->GetFirstDate( );

        # echo "<br> GetNextEventDate() : erster Termin ist am " . $dt->AsDMY();

        if ( ($dateisfirst == true ) && ($datestart->eq($dt)) ) { return $dt; }

        $fertig = false;

        do {
            $dt = $this->GetFollower( $dt );
            # echo "<br> GetNextEventDate() : untersuche " . $dt->AsDMY();
            if ( $datestart->eq( $dt ) && ( $dateisfirst ) ) return $dt;
            if ( $this->IsOverflow( $dt ) ) {  return undef; }
            if ( $datestart->lt( $dt ) ) return $dt;
        } while ( !$fertig);

        return undef;

    }   // function GetNextEventDate

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

            if (  ($this->m_end_date != undef ) && ( $this->m_end_date->lt( $dateObj ) ) ) return undef;
        }

        return undef;

    }   // function GetFirstDate

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