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

class W39F2030Controller extends W3XController
{
    public function index($pForm, $g, $task = '')
    {
        //\Debugbar::info(Session::get("W91P0000"));
        //\Debugbar::info("da chay W39F2030 1");
        //\Debugbar::info($pForm, $task, $g);
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeIDHR = Auth::user()->user()->HREmployeeID;
        $companyID = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        $cbEmployee = $this->LoadEmployeeByG4($pForm, $divisionHR, "%", "%", 1, "", "%");
        \Debugbar::info($cbEmployee);
        $cbStatus = $this->LoadFixData("AppStatusW39F2030");
        \Debugbar::info($cbStatus);
        $startDate = Helpers::beginDateOfPeriod();
        $endDate = Helpers::endDateOfPeriod();
        //\Debugbar::info($endDate);
        $session = Session::getId();
       switch ($task){
           case '':
               $sql = "--Do nguon Bo chi tieu chung" .PHP_EOL;
               $sql .= "EXEC W39P1050 '$divisionHR', '$userID', '$session', 'W39F2030','D39'";
               \Debugbar::info($sql);
               $cbAppCriterionSet = $this->connectionHR->select($sql);
               \Debugbar::info($cbAppCriterionSet);

               $sql1 = "--Do nguon Bo chi tieu danh gia" .PHP_EOL;
               $sql1 .= "EXEC W39P1052 '$divisionHR', '$userID', '$session', 'W39F2030','D39', ''";
               \Debugbar::info($sql1);
               $cbEmpCriterion = $this->connectionHR->select($sql1);
               \Debugbar::info($cbEmpCriterion);

               return View::make("W3X.W39.W39F2030", compact("pForm","department", "g", "task", "cbStatus", "cbAppCriterionSet","cbEmpCriterion", "cbEmployee","startDate", "endDate"));
               break;

           case 'filter':
               \Debugbar::info(Input::all());
               $AppCriterionSetID = Input::get('cbAppCriterionSetIDW39F2030');
               $EmpCriterionID = Input::get('cbEmpCriterionIDW39F2030');
               $DateFrom = Helpers::convertDate(Input::get('txtDateFromW39F2030'));
               $DateTo = Helpers::convertDate(Input::get('txtDateToW39F2030'));
               $StatusID = Input::get('cbStatusIDW39F2030');
               $DepartmentID = Input::get('cbDepartmentIDW39F2030');
               $EmployeeID = Input::get('cbEmployeeIDW39F2030');
               $sql = "-- Do nguon cho luoi" .PHP_EOL;
               $sql .= "EXEC W39P2030 '$divisionHR', '$userID', '$session', 'W39F2030', '$lang', '1', '$AppCriterionSetID', '$EmpCriterionID', $DateFrom, $DateTo, '$StatusID', '$DepartmentID', '$EmployeeID'";
               \Debugbar::info($sql);
               $valueGrid = $this->connectionHR->select($sql);
               \Debugbar::info($valueGrid);
               if(count($valueGrid) > 0){
                   for ($i = 0; $i < count($valueGrid); $i++) {
                       //$valueGrid[$i]["IsUpdate"] = 0;
                       $valueGrid[$i]['Resutl'] = number_format($valueGrid[$i]['Resutl'], 2);
                   }
               }
               return $valueGrid;
               break;

           case "reloadEmpCriterion":
               $EmpCriterionSetID = Input::get('cbAppCriterionSetIDW39F2030');
               \Debugbar::info($EmpCriterionSetID);
               $sql1 = "--Do nguon Bo chi tieu danh gia" .PHP_EOL;
               $sql1 .= "EXEC W39P1052 '$divisionHR', '$userID', '$session', 'W39F2030','D39', '$EmpCriterionSetID'";
               \Debugbar::info($sql1);
               $cbEmpCriterion = $this->connectionHR->select($sql1);
               \Debugbar::info($cbEmpCriterion);
               $str = " <option value='%'><--Tất cả--></option>";
               foreach ($cbEmpCriterion as $row) {
                   $str .= "<option value='" . $row["EmpCriterionID"] . "'>" . $row["EmpCriterionName"] . "</option>";
               }
               return $str;
               break;

           case "reloadEmployee":
               $DepartmentID = Input::get('cbDepartmentIDW39F2030');
               $cbEmployee = $this->LoadEmployeeByG4($pForm, $divisionHR, $DepartmentID, "%", 1, "", "%");
                \Debugbar::info($cbEmployee);
               $str = "";
               foreach ($cbEmployee as $row) {
                   $str .= "<option value='" . $row["EmployeeID"] . "'>" . $row["EmployeeName"] . "</option>";
               }
               return $str;
               break;
       }

    }
}