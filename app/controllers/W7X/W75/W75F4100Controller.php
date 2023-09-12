<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 10/16/2017
 * Time: 9:18 AM
 */

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

class W75F4100Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        $gridtab2 = json_encode(array());
        $lang = Session::get("Lang");
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $UserID = Auth::user()->user()->UserID;
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        //$valueGrid = json_encode(array());
        $modalTitle = $this->getModalTitleG4($pForm);
        $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        $block = $this->LoadBlockByG4(Session::get("W91P0000")['HRDivisionID'], $UserID, $pForm, 1);
        $employee = $this->LoadEmployeeByG4($pForm, $HRDivisionID, '', '', 1, '', '%');
        $days=cal_days_in_month(CAL_GREGORIAN,$tranMonth,$tranYear);
        $modalTitle= $this->getModalTitleG4($pForm);
        $sql1 = "--Lay dinh dang so le" . PHP_EOL;
        $sql1 .= "SELECT LeaveQtyDecimals FROM D15T0000";
        $rsTemp = $this->connectionHR->select($sql1);
        $decimals = 2;
        if (count($rsTemp) > 0){
            $decimals =  $rsTemp[0]["LeaveQtyDecimals"];
        }
        //$employee = [];
        // \Debugbar::info($employee);
        switch ($task) {
            case "":
                $sql1 = "--Do nguon ca" . PHP_EOL;
                $sql1 .= "SELECT '%' As ShiftID ,N'<--Tất cả-->' As ShiftName, 0 as DisplayOrder" . PHP_EOL;
                $sql1 .= "UNION" . PHP_EOL;
                $sql1 .= "SELECT ShiftID, ShiftNameU As ShiftName, 1 as DisplayOrder" . PHP_EOL;
                $sql1 .= "FROM D29T1010 WITH (NOLOCK) Where Disabled = 0 " . PHP_EOL;
                $sql1 .= "ORDER BY 	DisplayOrder, ShiftID";
                $shiftList = $this->connectionHR->select($sql1);

                $sql2 = "--Do nguon loai phep" . PHP_EOL;
                $sql2 .= "SELECT ID AS LeaveTypeID, Name84U AS LeaveTypeName, Number AS LeaveDisplayOrder" . PHP_EOL;
                $sql2 .= "FROM D15N5555 ('D75F1065',  ' ', ' ', ' ', ' ')" . PHP_EOL;
                $sql2 .= "ORDER BY LeaveDisplayOrder, LeaveTypeName";
                $leaveType = $this->connectionHR->select($sql2);

                $sql4 = "--Do nguon caption luoi tong hop" . PHP_EOL;
                $sql4 .= "EXEC W15P3032 '$UserID','D75F4100','$lang'";
                $captionTH = $this->connectionHR->select($sql4);
                \Debugbar::info($captionTH);

                $sql5 = "--danh dau an hien tab 4" . PHP_EOL;
                $sql5 .= "SELECT TOP 1 NumValue FROM D09T0009 WITH(NOLOCK) WHERE FieldName = 'IsNoteShowTabAtt'";
                $flag = $this->connectionHR->select($sql5);

                for ($i = 0; $i < count($flag); $i++) {
                    $flag[$i]["NumValue"] =  number_format( $flag[$i]["NumValue"],0);
                }
                \Debugbar::info($flag);
                return View::make("W7X.W75.W75F4100", compact('decimals',"pForm","flag", "g", "modalTitle", "department", "block","gridtab2", "shiftList", "employee", "leaveType", "captionTH","tranMonth","tranYear", "days"));
                break;

            case "change":
                $departmentID = Input::get('departmentID');
                $blockID = Input::get('blockID');
                //\Debugbar::info($blockID, $departmentID);
                $employee = $this->LoadEmployeeByG4($pForm, $HRDivisionID, $departmentID, '', 1, '', $blockID);
                \Debugbar::info($employee);
                $str = "";
                foreach ($employee as $row) {
                    $str .= "<option value='" . $row["EmployeeID"] . "'>" . $row["EmployeeName"] . "</option>";
                }
                return $str;
                return $employee;
                break;

            case "filter":
                $fromDate = Helpers::convertDate(Input::get('datefrom'));
                $toDate = Helpers::convertDate(Input::get('dateto'));
                $employeeID = Input::get('EmployeeID');
                $blockID = Input::get('BlockID');
                $departmentID = Input::get('slDepartmentID');
                $shiftID = Input::get('ShiftID');
                \Debugbar::info($fromDate, $toDate, $employeeID, $blockID, $departmentID, $shiftID);

                $sql1 = "--Do nguon tab1 luoi chi tiet" . PHP_EOL;
                $sql1 .= "EXEC W75P4101 '$HRDivisionID','$UserID','','$pForm',$fromDate,$toDate, '$employeeID','$blockID','$departmentID', $tranMonth, $tranYear, 'D01', '$lang'";
                $gridtab1_CT = $this->connectionHR->select($sql1);
                for ($i = 0; $i < count($gridtab1_CT); $i++) {
                    $gridtab1_CT[$i]["Quantity"] =  number_format( $gridtab1_CT[$i]["Quantity"],1);
                }
                \Debugbar::info($gridtab1_CT);

                $sql2 = "--Do nguon tab1 luoi tong hop" . PHP_EOL;
                $sql2 .= "EXEC W15P3030 '$HRDivisionID','$UserID','$departmentID','','$employeeID', $tranMonth, $tranYear, '$lang', '$pForm','$blockID', 1";
                $gridtab1_TH = $this->connectionHR->select($sql2);
                \Debugbar::info($sql2);

                $sql = "--Do nguon tab tang ca" . PHP_EOL;
                $sql .= "EXEC W75P4102 '$HRDivisionID','$UserID','$pForm',$fromDate,$toDate, '$employeeID','$blockID','$departmentID','$shiftID'";
                $gridtab2 = $this->connectionHR->select($sql);
                \Debugbar::info($gridtab2);

                $sql3 = "--Do nguon tab di tre ve som" . PHP_EOL;
                $sql3 .= "EXEC W75P4103 '$HRDivisionID','$UserID','$pForm',$fromDate,$toDate, '$employeeID','$blockID','$departmentID','$shiftID'";
                $gridtab3 = $this->connectionHR->select($sql3);
                \Debugbar::info($gridtab3);

                $sql4 = "--Do nguon tab nhan vien" . PHP_EOL;
                $sql4 .= "EXEC W75P4104 '$HRDivisionID','$UserID','$pForm', '$blockID','$departmentID','$shiftID', '$employeeID'";
                $gridtab4_1 = $this->connectionHR->select($sql4);
                Debugbar::info($gridtab4_1);

                $valueGrids = array(
                    "gridTab1_CT" => $gridtab1_CT,
                    "gridTab2" => $gridtab2,
                    "gridTab1_TH" => $gridtab1_TH,
                    "gridTab3" => $gridtab3,
                    "gridTab4_1" => $gridtab4_1
                );
                return $valueGrids;
                break;
            case "righgrid":
                Debugbar::info(Input::all());
                $fromDate = Helpers::convertDate(Input::get('datefrom'));
                $toDate = Helpers::convertDate(Input::get('dateto'));
                $employeeID = Input::get('employeeID');
                $blockID = Input::get('BlockID');
                $departmentID = Input::get('slDepartmentID');
                $shiftID = Input::get('ShiftID');
                $sql = "--Do nguon cong tab4" . PHP_EOL;
                $sql .= "EXEC W75P4090 '$HRDivisionID', '$tranMonth', '$tranYear','$UserID' , '$lang' , 1, '$employeeID','$pForm', $fromDate, $toDate, '$blockID','$departmentID','$shiftID'";
                $gridtab4_2 = $this->connectionHR->select($sql);
                \Debugbar::info($gridtab4_2);
                return $gridtab4_2;
                break;
        }
    }
}