<?php

namespace W3X\W39;

use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W3X\W3XController;

class W39F2000Controller extends W3XController
{
    public function index($pForm, $g, $task = '')
    {
        \Debugbar::info(Session::get("W91P0000"));
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeIDHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $session = Session::getId();
        $isApproval = "%";
        $modalTitle = $this->getModalTitleG4($pForm);

        $perW39F2021 = $this->getPermission($pForm);
        \Debugbar::info(Session::all());//Tai lieu yeu cau phan quyen theo form 2021
        switch ($task) {
            case '':
                $time = $this->LoadFixData("TimeD09");
                $rsStatus = $this->LoadFixData("AppStatusW39F2000");
                $rsFilter = $this->LoadSearchFieldName("D39F2021", "W39", $g);

                return View::make("W3X.W39.W39F2000", compact('isApproval','perW39F2021', 'modalTitle', 'rsFilter', 'rsStatus', 'time', "pForm", "g", "task"));
                break;
            case 'filter':
                $key = Input::get("key", "");
                $slTimeID = Input::get("slTimeID", "0");
                $slAppStatusID = Input::get("slAppStatusID", "%");
                $slSearchFieldID = Input::get("slSearchFieldID", "%");
                $txtSearchValue = Input::get("txtSearchValue", "");
                $chkIsUpdateRate = Input::get("chkIsUpdateRate", 0);
                $Mode = 0;
                $sql = '--Do nguon cho luoi'.PHP_EOL;
                $sql .= "EXEC W39P2000 '$divisionHR', $tranMonth , $tranYear, $Mode ,'$slSearchFieldID', N'$txtSearchValue','$slTimeID',	'$slAppStatusID','$userID', '$session','$pForm', '$key'".PHP_EOL;
                \Debugbar::info($sql);
                $rsData = $this->connectionHR->select($sql);
               
                return $rsData;
                break;

            case 'delete':
                $empCriterionID = Input::get("empCriterionID", "");
                $mode  = 2;
                $sql = '--Kiem tra truoc khi xoa'.PHP_EOL;
                $sql .= "EXEC D39P5555 	'$divisionHR',  $tranMonth,  $tranYear, '$lang','$userID', '$session', $mode,'W39F2000', '$empCriterionID', '', '' , '', ''".PHP_EOL;
                \Debugbar::info($sql);
                try{
                    $rsData = $this->connectionHR->selectOne($sql);
                    if (intval($rsData["Status"]) == 0){
                        $sql = '--Thuc hien xoa du lieu'.PHP_EOL;
                        $mode = 2;
                        $sql .= "EXEC W39P2012	'$divisionHR',  $tranMonth,  $tranYear, '$userID', '$session', $mode ,'W39F2000' ,'$empCriterionID'".PHP_EOL;
                        $this->connectionHR->statement($sql);
                        return json_encode(array('status'=>'OKAY'));
                    }else{
                        return json_encode(array('status'=>'CHECKSTORE', 'message'=>$rsData["Message"]));
                    }
                    \Debugbar::info($rsData["Status"]);
                }catch (\Exception $ex){
                    return json_encode(array('status'=>'ERROR', 'message'=>\Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")));
                }

                return $rsData;
                break;

        }

    }


    public function viewFromMail($pForm,$g,$isApproval=0,$id='',$iddt='') {
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeIDHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $session = Session::getId();

        $modalTitle = $this->getModalTitleG4($pForm);
        $perW39F2021 = Session::get($pForm); //Tai lieu yeu cau phan quyen theo form 2021
        $time = $this->LoadFixData("TimeD09");
        $rsStatus = $this->LoadFixData("AppStatusW39F2000");
        $rsFilter = $this->LoadSearchFieldName("D39F2021", "W39", $g);
        return View::make("W3X.W39.W39F2000", compact('isApproval', 'perW39F2021', 'modalTitle', 'rsFilter', 'rsStatus', 'time', "pForm", "g", "task"));
    }

}
