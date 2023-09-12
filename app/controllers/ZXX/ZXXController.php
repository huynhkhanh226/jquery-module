<?php
namespace ZXX;
use Auth;
use Session;

class ZXXController extends \BaseController {

    public function checkW09P5555($mode, $formid, $key01 = '', $key02 = '', $key03 = '', $key04 = '', $key05 = '', $num01 = 0, $num02 = 0, $num03 = 0, $num04 = 0, $num05 = 0, $dat01 = "null", $dat02 = "null", $dat03 = "null", $dat04 = "null", $dat05 = "null"){
        $div = Session::get("W91P0000")['HRDivisionID'];
        $tmonth = intval(Session::get("W91P0000")['HRTranMonth']);
        $tyear = intval(Session::get("W91P0000")['HRTranYear']);
        $lang = Session::get('Lang');
        $us = Auth::user()->User()->UserID;
        $sql ="--Kiem tra truoc khi sua/xoa/tao phieu".PHP_EOL;
        $sql .= "EXEC W09P5555 '$div', $tmonth, $tyear,'".Session::get('Lang')."', '$us', '$mode', '$formid', N'$key01', N'$key02', N'$key03', N'$key04', N'$key05',$num01,$num02,$num03,$num04,$num05,$dat01,$dat02,$dat03,$dat04,$dat05";
        return $this->connectionHR->selectOne($sql);
    }

}
