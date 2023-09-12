<?php

namespace W7X\W75;

use Auth;
use DB;
use Exception;
use Input;
use Request;
use Session;
use View;
use W7X\W7XController;
use Debugbar;
use Helpers;
use Config;
use Mail;

class W75F3040Controller extends W7XController
{
    //Khi open tab s? g?i controller này

    public function index($pForm, $g, $task = '')
    {
        $all = Input::all();
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $employeeIDHR = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID : Auth::ess()->user()->HREmployeeID;
        $lang = Session::get('Lang');
        $userid = Auth::user()->user()->UserID;
        $tranmonthHR = Session::get("W91P0000")['HRTranMonth'];
        $tranyearHR = Session::get("W91P0000")['HRTranYear'];
        $modalTitle = $this->getModalTitleG4($pForm);
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        switch ($task) {
            case '':
                $months = $this->LoadPeriodData("D09", $divisionHR);
                $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, "%", 1, true, "");
                $sql = "--Do nguon mau bao cao" . PHP_EOL;
                $sql .= "SELECT    ReportCode, ReportNameU  AS ReportName" . PHP_EOL;
                $sql .= " FROM       D13T4000 WITH (NOLOCK)" . PHP_EOL;
                $sql .= " WHERE    Disabled = 0 AND IsLemonweb = 1" . PHP_EOL;
                $sql .= " ORDER BY   ReportCode" . PHP_EOL;
                $reportIDs = $this->connectionHR->select($sql);
                $sql = "-- Do nguon combo phieu luong" . PHP_EOL;
                $mode = 0;
                $sql .= " EXEC W75P3041 '$divisionHR','$userid', $tranmonthHR, $tranyearHR, '$lang', $mode, '$companyID'" . PHP_EOL;
                $vouchers = $this->connectionHR->select($sql);

                /*$mode = 0;
                $sql = "-- Do nguon cot dong(0) va du lieu(1)" . PHP_EOL;
                $sql .= " EXEC  W75P3040 '$divisionHR', $tranmonthHR, $tranyearHR, '$userid', '$pForm', '', '', $mode , ''";*/
                $columns = [];
                $rsData = [];
                return View::make("W7X.W75.W75F3040", compact("rsData",'columns', "vouchers","reportIDs", "departments", "months", 'pForm', 'g', 'modalTitle', 'task'));
                break;

            case 'loadgrid':

                $cboPeriodW75F3040 = Input::get("cboPeriodW75F3040", $tranmonthHR.'.'.$tranyearHR);
                $arr = explode("/", $cboPeriodW75F3040);
                $cboDepartmentIDW75F3040 = Input::get("cboDepartmentIDW75F3040", "");
                $cboReportIDW75F3040 = Input::get("cboReportIDW75F3040", "");
                $cboSalaryVoucherIDW75F3040 = Input::get("cboSalaryVoucherIDW75F3040", "");
                $mode = 0;
                $sql = "-- Do nguon cot dong(0) va du lieu(1)" . PHP_EOL;
                $sql .= " EXEC  W75P3040 '$divisionHR', $tranmonthHR, $tranyearHR, '$userid', '$pForm', '$cboDepartmentIDW75F3040', '$cboReportIDW75F3040', $mode , '$cboSalaryVoucherIDW75F3040'";
                $columns = $this->connectionHR->select($sql);

                $mode = 1;
                $sql = "-- Do nguon cot dong(0) va du lieu(1)" . PHP_EOL;
                $sql .= " EXEC  W75P3040 '$divisionHR', $arr[0], $arr[1], '$userid', '$pForm', '$cboDepartmentIDW75F3040', '$cboReportIDW75F3040', $mode , '$cboSalaryVoucherIDW75F3040'";
                $rsData = $this->connectionHR->select($sql);



                return View::make("W7X.W75.W75F3040_Ajax", compact('columns', 'rsData','pForm', 'g','modalTitle', 'task'));
                break;
            case "loadsalary":
                $cboTranMonth = Input::get("tranMonth", $tranmonthHR);
                $cboTranYear = Input::get("tranYear", $tranyearHR);
                $sql = "-- Do nguon combo phieu luong" . PHP_EOL;
                $mode = 0;
                $sql .= " EXEC W75P3041 '$divisionHR','$userid', $cboTranMonth, $cboTranYear, '$lang', $mode, '$companyID'" . PHP_EOL;
                $vouchers = $this->connectionHR->select($sql);
                $str = "";
                foreach($vouchers as $rs){
                    $id = $rs["SalaryVoucherID"];
                    $name = $rs["SalaryVoucherName"];
                    $str .= '<option value="'.$id.'" >'.$name.'</option>';
                }
                \Debugbar::info($str);
                return $str;
                break;

        }

    }
}
