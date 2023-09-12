<?php
namespace W0X\W09;

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
use W0X\W0XController;

class W09F2510Controller extends W0XController
{

    public function index($pForm, $g)
    {
        $isApproval = 0;
        $AppStatus = $this->LoadFixData('AppStatusD09');
        $Time = $this->LoadFixData('TimeD09');
        try {

            $modalTitle = "";
            $detail = [];
            $modalTitle = $this->getModalTitle($pForm);
            if (Request::isMethod("post")) {
                $AppStatusID = intval(Input::get('isApproval'));
                $TimeID = intval(Input::get('FromTo'));
                $SQLData = "EXEC W09P2512 '$AppStatusID', '$TimeID'";
                $detail = $this->connectionHR->select($SQLData);
            }

        } catch (Exception $e) {
            Debugbar::info($e);
        }
        if (Request::isMethod("post")) {

            return View::make("W0X.W09.W09F2510_LeftAjax", compact('detail', 'isApproval', 'g', 'AppStatus', 'AppStatusID', 'Time', 'TimeID'));
        } else
            return View::make("W0X.W09.W09F2510", compact('modalTitle', 'detail', 'isApproval', 'g', 'AppStatus', "Time"));
    }

    // thông tin nhân viên
    public function employInfo($tranid)
    {
        $g=4;
        $sql = "--Do nguon chi tiet thong tin can duyet cua nhan vien da chon" . PHP_EOL;
        $sql .= "EXEC W09P2510 '$tranid', 1";
        $rs = DB::connection('sqlsrvHR')->selectOne($sql);
        return View::make('W0X.W09.W09F2510_AppDetail', compact('rs','g'));
    }

    //Load history
    public function showHistory($tranid)
    {
        $g=4;
        $sql = "--Do nguon luoi lich su" . PHP_EOL;
        $sql .= "EXEC W09P2510 '$tranid', 2";
        $data = DB::connection('sqlsrvHR')->select($sql);
        return View::make('W0X.W09.W09F2510_History', compact('data','g'));
    }

    public function checkstore($tranid)
    {
        $DivisionID = Session::get("W91P0000")['HRDivisionID'];
        $TranMonth = Session::get("W91P0000")['HRTranMonth'];
        $TranYear = Session::get("W91P0000")['HRTranYear'];
        $Language = Session::get('Lang');
        $UserID = Auth::user()->user()->UserID;

        $Mode	= 0;
        $FormID = "D75F1010";
        $Num01 = 0;
        $Num02 = 0;
        $Num03 = 0;
        $Num04 = 0;
        $Num05 = 0;
        $Key01ID  = "NumIDCard";
        $Key02ID	= Input::get("propertyValue", "");
        $Key03ID	= Auth::user()->user()->HREmployeeID;
        $Key04ID	= "";
        $Key05ID = "";
        $Date01 = \Helpers::convertDate("" );
        $Date02 = \Helpers::convertDate("" );;
        $Date03 = \Helpers::convertDate("" );;
        $Date04 = \Helpers::convertDate("" );;
        $CodeTable = 1;
        $Date05 = \Helpers::convertDate("" );;
        $IsDesktop = 0;
        $session = Session::getId();

        $sql = " ---- Thuc thi kiem tra trung so CMND".PHP_EOL;
        $sql .= " Exec D09P5555 '$DivisionID' , $TranMonth, $TranYear, '$Language', '$UserID', '$session' , $Mode, '$FormID',".PHP_EOL;
        $sql .= " $Num01, $Num02, $Num03, $Num04, $Num05, '$Key01ID', '$Key02ID', '$Key03ID', '$Key04ID',".PHP_EOL;
        $sql .= " '$Key05ID', $Date01, $Date02, $Date03, $Date04, $CodeTable, $Date05, $IsDesktop ".PHP_EOL;

        \Debugbar::info($sql);
        $rs = $this->connectionHR->select($sql);
        \Debugbar::info($rs);
        return $rs;
    }

    //Duyệt
    public function approval($tranid)
    {
        $sql = "--Do nguon luoi lich su" . PHP_EOL;
        $sql .= "EXEC W09P2511 '". Session::get("W91P0000")['HRDivisionID'] ."', '" . Auth::user()->user()->UserID."', '$tranid'";
        return intval($this->connectionHR->statement($sql));
    }
}
