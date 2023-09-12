<?php
namespace W1X\W15;

use Auth;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Mail;
use Request;
use Session;
use View;
use W1X\W1XController;
use Debugbar;

class W15F3031Controller extends W1XController
{
    public function Index($pForm, $g, $employeeid)
    {
        $language = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];

        $sSQL ="-- Do nguon Master".PHP_EOL;
        $sSQL .="EXEC W15P2174  '$divisionhr', '$userid', '$employeeid', $tranmonth, $tranyear, $language";
        $dsMaster = $this->connectionHR->select($sSQL);

        $sSQL ="-- Lay format".PHP_EOL;
        $sSQL .=" SELECT   LeaveQtyDecimals";
        $sSQL .=" FROM 	D15T0000 WITH(NOLOCK)";
        $dsFormat = $this->connectionHR->select($sSQL);

        return View::make("W1X.W15.W15F3031", compact('g', 'pForm',"id", 'dsMaster','employeeid','dsFormat'));
    }

    public function Loadtdbg($pForm, $g, $employeeid)
    {
        $language = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];

        $sSQL ="-- Do nguon luoi chi tiet".PHP_EOL;
        $sSQL .="EXEC W15P2173  '$divisionhr', '$userid', '$employeeid', $tranmonth, $tranyear, $language, 3";
        $dsDetail = $this->connectionHR->select($sSQL);
        Debugbar::info(Session::get("W91P0000"));
        return View::make("W1X.W15.W15F3031_Ajax", compact('pForm', 'g', 'dsDetail'));
    }
}
