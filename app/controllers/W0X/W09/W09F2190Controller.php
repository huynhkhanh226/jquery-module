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

class W09F2190Controller extends W0XController
{
    public function detail($vou, $g, $isApproval)
    {
        ob_end_clean();
        ob_start();
        $ApprovalLevel = Input::get("ApprovalLevel", 0);

        $pForm = 'D09F2190';
        $titleW09F2151 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $session = Session::getId();
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $perD09F2190 = $this->getPermission("D09F2190");
        $creatorHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $moduleID = 'D09';
        $Mode = 0;
        $locale = Session::get("locate");

        $sql = "-- Nguon xay dung cot dong luong" . PHP_EOL;
        $sql .= " SELECT 	Code, ShortU AS CaptionName, Decimals, Disabled ";
        $sql .= " FROM 	D13T9000 ";
        $sql .= " WHERE 	[Type] = 'SALBA'";
        $rsColumns = $this->connectionHR->select($sql);

        $sql = "--Do nguon chi tiet" . PHP_EOL;
        $sql .= "EXEC W84P4001 '$divisionHR', '$moduleID', '$pForm', '$vou', '$lang',$Mode,'$userID', $isApproval, $ApprovalLevel" ;
        \Debugbar::info($sql);
        $rsMaster = $this->connectionHR->select($sql);


        //$departments = $this->LoadDepartmentByG4($pForm, $divisionHR, "%", 0, true, "");
        //$teams = $this->LoadTeamByG4($pForm, $divisionHR, $rsMaster[0]["DepartmentID"], 0);
        //$directManagers = $this->LoadDirectManagerbyG4($divisionHR, $userID, $session, $lang, $pForm);
        //$works = $this->LoadWorkbyG4();

        $sql = "--Do nguon Loai HDLD" . PHP_EOL;
        $sql .= " SELECT WorkFormID as NewWorkFormID, WorkFormNameU as NewWorkFormName, MonthDuration" . PHP_EOL;
        $sql .= " FROM D09T0226 WITH(NOLOCK) " . PHP_EOL;
        $sql .= " WHERE Disabled = 0 Order by WorkFormID" . PHP_EOL;
        \Debugbar::info($sql);

        $rsWorkForm = $this->connectionHR->select($sql);

        return View::make("W0X.W09.W09F2190_DTAjax", compact("locale","perD09F2190","rsWorkForm", "rsColumns", "rsMaster", 'vou', 'g', 'isApproval'));
    }

    public function action($task = "")
    {
        ob_end_clean();
        ob_start();
        $pForm = 'D09F2190';
        $titleW09F2151 = $this->getModalTitle($pForm);
        //\Debugbar::info($titleW09F2151);
        $lang = Session::get('Lang');
        $session = Session::getId();
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $perD09F2190 = $this->getPermission("D09F2190");
        $creatorHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $moduleID = 'D09';
        \Debugbar::info($task);
        switch ($task) {
            case 'save':
                $ProContractID = Input::get("VoucherID", "");
                $EmployeeID = Input::get("EmployeeID", "");
                $WorkFormID = Input::get("WorkFormID", "");
                $NewWorkFormID = Input::get("cboNewWorkFormIDW09F2190", "");
                $MonthDuration = Helpers::sqlNumber(Input::get("MonthDuration", 0));
                $NewMonthDuration = Input::get("txtNewMonthDurationW09F2190", 0);
                $ContractDateBegin = Helpers::convertDate(Input::get("ContractDateBegin", ""));
                $ContractDateEnd = Helpers::convertDate(Input::get("ContractDateEnd", ""));
                $NewContractDateBegin = Helpers::convertDate(Input::get("dtpNewContractDateBeginW09F2190", ""));
                $NewContractDateEnd = Helpers::convertDate(Input::get("dtpNewContractDateEndW09F2190", ""));
                $BaseSalary01 = Input::get("BaseSalary01", 0);
                $NewBaseSalary01 = Helpers::sqlNumber(Input::get("txtNewBaseSalary01W09F2190", 0));
                $BaseSalary02 = Input::get("BaseSalary02", 0);
                $NewBaseSalary02 = Helpers::sqlNumber(Input::get("txtNewBaseSalary02W09F2190", 0));
                $BaseSalary03 = Input::get("BaseSalary03", "");
                $NewBaseSalary03 = Helpers::sqlNumber(Input::get("txtNewBaseSalary03W09F2190", ""));
                $BaseSalary04 = Input::get("BaseSalary04", "");
                $NewBaseSalary04 = Helpers::sqlNumber(Input::get("txtNewBaseSalary04W09F2190", ""));
                $NotesU = $this->sqlstring(Input::get("txtNotesW09F2190", ""));
                $ApprovalLevel = Input::get("ApprovalLevel", 0);
                $Notes = $this->sqlstring(Input::get("txtNotesW09F2190", ''));



                $CreateUserID = $userID;
                $CreateDate = Carbon::now();
                $LastModifyUserID = $userID;
                $LastModifyDate = Carbon::now();

                $sql = "-- Luu du lieu tai tung cap duyet" . PHP_EOL;
                $sql .= " DELETE D09T2191 WHERE ProContractID = '$ProContractID' AND ApprovalLevel = $ApprovalLevel" . PHP_EOL;



                $sql .= " INSERT INTO D09T2191(" . PHP_EOL;
                $sql .= " ProContractID, ApprovalLevel, EmployeeID,NewWorkFormID, NewMonthDuration, " . PHP_EOL;
                $sql .= " NewContractDateBegin, NewContractDateEnd, NewBaseSalary01, NewBaseSalary02, NewBaseSalary03, NewBaseSalary04, CreateUserID, CreateDate, LastModifyUserID ,LastModifyDate" . PHP_EOL;
                $sql .= " ,Note)values(" . PHP_EOL;
                $sql .= " '$ProContractID', $ApprovalLevel, '$EmployeeID','$NewWorkFormID', $NewMonthDuration," . PHP_EOL;
                $sql .= " $NewContractDateBegin, $NewContractDateEnd, $NewBaseSalary01, $NewBaseSalary02, $NewBaseSalary03, $NewBaseSalary04, '$CreateUserID', '$CreateDate', '$LastModifyUserID' ,'$LastModifyDate', N'$Notes'" . PHP_EOL;
                $sql .= " )" . PHP_EOL;

                \Debugbar::info($sql);
                if ($sql != "") {
                    try {
                        $this->connectionHR->statement($sql);
                        return json_encode(['status' => 'SUCC']);
                    } catch (Exception $ex) {
                        return json_encode(['status' => 'ERROR', "message" => Helpers::getRS(4, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }
                break;
        }

    }

}
