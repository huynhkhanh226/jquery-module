<?php
namespace ZXX\PH;

use Auth;
use Config;
use Debugbar;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Helpers;
use ZXX\ZXXController;

class W09F4290Controller extends ZXXController
{

    public function index($pForm, $g)
    {
        $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $division = Session::get("W91P0000")['HRDivisionID'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $lang = Session::get('Lang');
        if (Request::isMethod('post')) {
            $input = Input::all();
            $emp = $input['slEmployeeID'];
            $tyfrom = isset($input['slMonth']) ? substr($input['slMonth'], 0, 4) : -1;
            $tmfrom = isset($input['slMonth']) ? substr($input['slMonth'], 4) : -1;
            $loadcol = $input['change'];

            $sql = "--Do nguon luoi" . PHP_EOL;
            $sql .= "EXEC W09P4290 '" . Session::get("W91P0000")['HRDivisionID'] . "','$user',2, '" . Session::get('Lang') . "', $tmfrom, $tyfrom, '$emp'";
            $rsData = $this->connectionHR->select($sql);
            if ($loadcol == 1) {
                $sql = "--Do cot dong" . PHP_EOL;
                $sql .= "EXEC W09P4290 '" . Session::get("W91P0000")['HRDivisionID'] . "','$user',1, '" . Session::get('Lang') . "', $tmfrom, $tyfrom";
                $rsCol = $this->connectionHR->select($sql);
                return View::make("ZXX.PH.W09F4290_Ajax", compact('pForm', 'g', 'rsData', 'rsCol'));
            }
            return json_encode($rsData);
        } else {
            $sql = "--Do nguon nhan vien" . PHP_EOL;
            $sql .= "EXEC W09P4290 '" . Session::get("W91P0000")['HRDivisionID'] . "','$user', 0, '" . Session::get('Lang') . "'";
            $emp = $this->connectionHR->select($sql);
            $mon = $this->LoadPeriodData("D90", Session::get("W91P0000")['DivisionID']);

            $sql = "-- Load ty gia".PHP_EOL;
            $sql .= "Exec W09P4290 '$division', '$user', 3, '$lang', $tranMonth, $tranYear".PHP_EOL;
            $rs = $this->connectionHR->select($sql);
            \Debugbar::info($rs);
            $exchangeRate = '';
            if (count($rs) > 0){
                $exchangeRate = number_format($rs[0]["ExchangeRate"],Session::get("W91P0000")['ExchangeRateDecimals']);
            }
            return View::make("ZXX.PH.W09F4290", compact('pForm', 'g', 'emp', 'mon','exchangeRate'));
        }
    }

}
