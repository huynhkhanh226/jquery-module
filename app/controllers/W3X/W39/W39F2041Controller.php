<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 25/12/2017
 * Time: 11:01 AM
 */

namespace W3X\W39;

use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use Helpers;
use W3X\W3XController;

class W39F2041Controller extends W3XController
{
    public function index($pForm, $g, $task = '')
    {
        \Debugbar::info(Session::get("W91P0000"));
        $moduleID = 'D39';
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeIDHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $session = Session::getId();
        $modalTitle = Helpers::getRS($g, "Ke_thua_chi_tieu");
        $rowIndx = Input::get("rowIndx", 0);
        switch ($task) {
            case '':
                //Load combo
                $sql = " --Do nguon Bo chi tieu chung" . PHP_EOL;
                $sql .= " EXEC W39P1050	'$divisionHR', '$userID', '$session', 'W39F2041', '$moduleID'" . PHP_EOL;
                $appCriterionSetList = $this->connectionHR->select($sql);

                $appCriterionSetID = count($appCriterionSetList) > 0 ? $appCriterionSetList[0]["AppCriterionSetID"] : '';
                $sql = " --Do nguon Bo chi tieu danh gia" . PHP_EOL;
                $sql .= " EXEC W39P1052	'$divisionHR','$userID', '$session','W39F2041', '$moduleID','$appCriterionSetID'" . PHP_EOL;
                $empCriterionList = $this->connectionHR->select($sql);
                $departmentList = $this->LoadDepartmentByG4($pForm, $divisionHR, "%", 1, true, '');

                $departmentID = count($departmentList) > 0 ? $departmentList[0]["DepartmentID"] : '';
                $employeeList = $this->LoadEmployeeByG4($pForm, $divisionHR, $departmentID, "%", 1, '', '%');
                return View::make("W3X.W39.W39F2041", compact('rowIndx','employeeList', 'departmentList', 'empCriterionList', 'appCriterionSetList', 'modalTitle', "pForm", "g", "task"));
                break;
            case 'reloadEmpCriterion':
                $appCriterionSetID = Input::get('appCriterionSetID', '');
                $sql = " --Do nguon Bo chi tieu danh gia" . PHP_EOL;
                $sql .= " EXEC W39P1052	'$divisionHR','$userID', '$session','W39F2041', '$moduleID','$appCriterionSetID'" . PHP_EOL;
                $empCriterionList = $this->connectionHR->select($sql);
                $str = '';
                foreach ($empCriterionList as $row) {
                    $str .= ' <option value="' . $row["EmpCriterionID"] . '">' . $row["EmpCriterionName"] . '</option>';
                }
                return $str;
                break;
            case 'reloadEmployee':
                $departmentID = Input::get('departmentID', '');
                $employeeList = $this->LoadEmployeeByG4($pForm, $divisionHR, $departmentID, "%", 1, '', '%');
                $str = '';
                foreach ($employeeList as $row) {
                    $str .= ' <option value="' . $row["EmployeeID"] . '">' . $row["EmployeeName"] . '</option>';
                }
                return $str;
                break;
            case 'filter':
                $cboAppCriterionSetIDW39F2041 = Input::get("cboAppCriterionSetIDW39F2041", '');

                if (Input::get("txtDateFromW39F2041", "") == ''){
                    $txtDateFromW39F2041 = Helpers::convertDate(Helpers::beginDateOfPeriod());
                }else{
                    $txtDateFromW39F2041 = Helpers::convertDate(Input::get("txtDateFromW39F2041", ""));
                }


                if (Input::get("txtDateToW39F2041", "") == ''){
                    $txtDateToW39F2041 = Helpers::convertDate(Helpers::endDateOfPeriod());
                }else{
                    $txtDateToW39F2041 = Helpers::convertDate(Input::get("txtDateToW39F2041", ""));
                }
                $chkIsRegisterW39F2041 = Input::get("chkIsRegisterW39F2041", 0);
                $cboEmpCriterionIDW39F2041 = Input::get("cboEmpCriterionIDW39F2041", 0);
                $chkIsDistributeW39F2041 = Input::get("chkIsDistributeW39F2041", 0);
                $cboDepartmentIDW39F2041 = Input::get("cboDepartmentIDW39F2041", '');
                $cboEmployeeIDW39F2041 = Input::get("cboEmployeeIDW39F2041", '');

                $mode = 1;
                $sql = " -- Do nguon luoi" . PHP_EOL;
                $sql .= " EXEC W39P2041 '$divisionHR',$userID,'$session', 'W39F2022'	,'$lang',$mode	,'$cboAppCriterionSetIDW39F2041','$cboEmpCriterionIDW39F2041',$txtDateFromW39F2041,	$txtDateToW39F2041	,$chkIsRegisterW39F2041, $chkIsDistributeW39F2041, '$cboDepartmentIDW39F2041', '$cboEmployeeIDW39F2041'" . PHP_EOL;
                $rsData = $this->connectionHR->select($sql);
                return $rsData;
                break;
        }

    }
}