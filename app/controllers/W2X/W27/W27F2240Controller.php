<?php
namespace W2X\W27;
use Auth;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use Debugbar;
use W2X\W2XController;

class W27F2240Controller extends W2XController {

    public function Index($pForm, $g){
        //Common parameters
        $division = Session::get('W91P0000')["DivisionID"];
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $tranmonth = Session::get("W91P0000")['TranMonth'];
        $tranyear = Session::get("W91P0000")['TranYear'];

        if (Request::isMethod('post')) {
            $input = Input::all();
            $isTime = Input::get("isTime","");
            if ($isTime == 1 || $isTime == 3){
                $fromMonth = Input::get("fromMonth",0);
                $fromYear = Input::get("fromYear",0);
                $toMonth = Input::get("toMonth",0);
                $toYear = Input::get("toYear",0);
            }else{
                $fromMonth = 0;
                $fromYear = 0;
                $toMonth = 0;
                $toYear = 0;
            }

            $dateFrom = Helpers::convertDate(Input::get("txtDateFrom",""),true);
            $dateTo = Helpers::convertDate(Input::get("txtDateTo",""),true);

            $txStrSearch = Input::get("txtStrSearch","");
            $chkIsShowCancelled = Input::get("optIsShowCancelled",0);
            $lang = Session::get('Lang');
            $isTime = Input::get("isTime",""); //La khong chon ky va ngay

            $sSQL = "--Do nguon cho luoi".PHP_EOL;
            $sSQL .= "Exec W27P2240  '$division', '$userid',$tranmonth,$tranyear,$isTime, $fromMonth, $fromYear,$toMonth, $toYear, $dateFrom, $dateTo, N'$txStrSearch', $chkIsShowCancelled, '', '$lang'".PHP_EOL;
            Debugbar::info($sSQL);
            $data = $this->connection->select($sSQL);
            Debugbar::info(Session::get('W91P0000')["ExchangeRateDecimals"]);
            return View::make("W2X.W27.W27F2240_Ajax", compact('pForm', 'g', 'data'));
        } else {
            $period = $this->LoadPeriodData("D90", Session::get("W91P0000")['DivisionID']);
            return View::make("W2X.W27.W27F2240", compact('pForm', 'g', 'period'));
        }


    }

}
