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

class W09F4291Controller extends ZXXController
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
            $project = $input['slProjectID'];
            $monMode = intval($input['optMonthWeekMode']);
            $empMode = intval($input['optEmpWorkMode']);
            $loadcol = $input['change'];
            $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;

            $sql = "--Do nguon luoi" . PHP_EOL;
            $sql .= "EXEC W09P4291 '" . Session::get("W91P0000")['HRDivisionID'] . "','$user',1, '$project',$monMode,$empMode,'" . Session::get('Lang') . "'";
            $rsData = $this->connectionHR->select($sql);
            if ($loadcol==1){
                $sql = "--Do nguon cot dong" . PHP_EOL;
                $sql .= "EXEC W09P4291 '" . Session::get("W91P0000")['HRDivisionID'] . "','$user',0, '$project',$monMode,$empMode,'" . Session::get('Lang') . "'";
                $rsCol = $this->connectionHR->select($sql);
                return View::make("ZXX.PH.W09F4291_Ajax", compact('pForm', 'g', 'rsData', 'rsCol'));
            }
            return json_encode($rsData);
        } else {
            $sql = "--Do nguon Du an" . PHP_EOL;
            $sql .= "SELECT T1.ProjectID, T1.DescriptionU As ProjectName, T1.CompanyID, T2.ObjectNameU AS CompanyName" . PHP_EOL;
            $sql .= "FROM D54T2010 T1 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "LEFT JOIN	Object T2 WITH(NOLOCK) ON T1.ObjectTypeID = T2.ObjectTypeID " . PHP_EOL;
            $sql .= "AND T1.CompanyID = T2.ObjectID" . PHP_EOL;
            $sql .= "WHERE T1.ProStatusID <> '0004' " . PHP_EOL;
            $sql .= "AND DivisionID = '" . Session::get("W91P0000")['HRDivisionID'] . "' ORDER BY	T1.ProjectID";
            $pro = $this->connectionHR->select($sql);

            $sql = "-- Load ty gia".PHP_EOL;
            $sql .= "Exec W09P4290 '$division', '$user', 3, '$lang', $tranMonth, $tranYear".PHP_EOL;
            $rs = $this->connectionHR->select($sql);
            \Debugbar::info($rs);
            $exchangeRate = '';
            if (count($rs) > 0){
                $exchangeRate = number_format($rs[0]["ExchangeRate"],Session::get("W91P0000")['ExchangeRateDecimals']);
            }

            return View::make("ZXX.PH.W09F4291", compact('pForm', 'g', 'pro', 'exchangeRate'));
        }
    }
}
