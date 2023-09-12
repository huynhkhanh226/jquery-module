<?php

namespace W0X\W09;

use Auth;
use Carbon\Carbon;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W0X\W0XController;
use Debugbar;

class W09F2152Controller extends W0XController
{
    public function detail($vou,$g,$isApproval) {

        $pForm = 'D09F2152';
        $titleW09F2151 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $session = Session::getId();
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $perD09F2150 = $this->getPermission("D09F2150");
        $perD09F5650 = $this->getPermission("D09F5650");
        $creatorHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $moduleID = 'D09';
        $Mode = 0;

        $sql = "-- Nguon xay dung cot dong luong" . PHP_EOL;
        $sql .= " SELECT 	Code, ShortU AS CaptionName, Decimals, Disabled ";
        $sql .= " FROM 	D13T9000 ";
        $sql .= " WHERE 	[Type] = 'SALBA'";
        $rsColumns = $this->connectionHR->select($sql);

        $sql = "--Do nguon chi tiet".PHP_EOL;
        $sql .=  "EXEC W84P4001 '$divisionHR', '$moduleID', '$pForm', '$vou', '$lang',$Mode,'$userID',".$isApproval;
        $rsMaster=$this->connectionHR->select($sql);


        $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, "%", 0, true, "");
        $teams = $this->LoadTeamByG4($pForm, $divisionHR, $rsMaster[0]["NewDepartmentID"], 0);
        $directManagers = $this->LoadDirectManagerbyG4($divisionHR, $userID, $session, $lang, $pForm);
        $works = $this->LoadWorkbyG4();



        return View::make("W0X.W09.W09F2152_DTAjax",compact("departments","teams", "directManagers", "works", "rsColumns", "rsMaster",'vou','g','isApproval'));
    }

    public function action($task = "")
    {
        $pForm = 'D09F2152';
        $titleW09F2151 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $session = Session::getId();
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $perD09F2150 = $this->getPermission("D09F2150");
        $perD09F5650 = $this->getPermission("D09F5650");
        $creatorHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $moduleID = 'D09';
        //\Debugbar::info($task);
        switch ($task) {
            case 'loadteams':
                $departmentID = Input::get("departmentID", "");
                $rsData = $this->LoadTeamByG4($pForm, $divisionHR, $departmentID, 0);
                $str = '<option value=""></option>';
                foreach ($rsData as $row) {
                    $str .= '<option value="' . $row["TeamID"] . '">' . $row["TeamName"] . '</option>';
                }
                return $str;
                break;
            case 'save':
                $ProTransID = Input::get("VoucherID", "");
                $ApprovalLevel  = Input::get("ApprovalLevel", 0);
                $EmployeeID  = Input::get("EmployeeID","");
                $ValidDate   = Helpers::convertDate(Input::get("txtValidDateW09F2052",""));
                $NewDepartmentID  = Input::get("cboNewDepartmentIDW09F2052","");
                $NewTeamID  = Input::get("cboNewTeamIDW09F2052","");
                $NewWorkID  = Input::get("cboNewWorkIDW09F2052","");
                $NewDirectManagerID  = Input::get("cboNewDirectManagerIDW09F2052","");
                $IsSalaryAdjustment  = Input::get("chkIsSalaryAdjustmentW09F2052", 0);

                $NewBaseSalary01  = Helpers::sqlNumber(Input::get("txtNewBaseSalary01W09F2052", 0));
                $NewBaseSalary02  = Helpers::sqlNumber(Input::get("txtNewBaseSalary02W09F2052", 0));
                $NewBaseSalary03  = Helpers::sqlNumber(Input::get("txtNewBaseSalary03W09F2052",0));
                $NewBaseSalary04  = Helpers::sqlNumber(Input::get("txtNewBaseSalary04W09F2052",0));
                $CreateUserID  = $userID;
                $CreateDate  = Carbon::now();
                $LastModifyUserID  = $userID;
                $LastModifyDate  = Carbon::now();

                $sql = "-- Luu du lieu tai tung cap duyet".PHP_EOL;
                $sql .= " DELETE D09T2152 WHERE ProTransID = '$ProTransID' AND ApprovalLevel = $ApprovalLevel".PHP_EOL;
                $sql .= " INSERT INTO D09T2152 (ProTransID, ApprovalLevel , EmployeeID, ValidDate , NewDepartmentID, NewTeamID, NewWorkID, NewDirectManagerID, IsSalaryAdjustment,  NewBaseSalary01, NewBaseSalary02, NewBaseSalary03, NewBaseSalary04, CreateUserID, CreateDate , LastModifyUserID, LastModifyDate)".PHP_EOL;
                $sql .= " VALUES  ('$ProTransID', $ApprovalLevel , '$EmployeeID', $ValidDate , '$NewDepartmentID', '$NewTeamID', '$NewWorkID', '$NewDirectManagerID', $IsSalaryAdjustment,  $NewBaseSalary01, $NewBaseSalary02, $NewBaseSalary03, $NewBaseSalary04, '$CreateUserID', '$CreateDate' , '$LastModifyUserID', '$LastModifyDate')".PHP_EOL;
                \Debugbar::info($sql);
                if ($sql != "") {
                    try {
                        $this->connectionHR->statement($sql);
                        return json_encode(['status' => 'SUCC']);
                    } catch (Exception $ex) {
                        return json_encode(['status' => 'ERROR', "message"=> Helpers::getRS(4,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }
                break;
        }


    }

}
