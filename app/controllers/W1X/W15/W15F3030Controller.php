<?php
namespace W1X\W15;

use Auth;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Mail;
use Request;
use Session;
use View;
use W1X\W1XController;
use Debugbar;

class W15F3030Controller extends W1XController
{
    public function Index($pForm, $g)
    {
        $department = $this->LoadDepartmentByG4($pForm,Session::get("W91P0000")['HRDivisionID'],'%',1);
        $teams = $this->LoadTeamByG4($pForm, Session::get("W91P0000")['HRDivisionID'],"%", 1);
        $employees = $this->LoadEmployeeByG4($pForm, Session::get("W91P0000")['HRDivisionID'],"%","%", 1);
        return View::make("W1X.W15.W15F3030", compact('g', 'pForm',"department", "employees","teams"));
    }

    public function LoadTdbc($pForm, $g, $name){
        if ($name == "team"){
            $value = Input::get('cboDepartmentID');
            $rs = $this->LoadTeamByG4($pForm, Session::get("W91P0000")['HRDivisionID'],$value, 1);
            $str = "";
            foreach ($rs as $row) {
                $str .= "<option value='" . $row["TeamID"] . "'>" . $row["TeamName"] . "</option>";
            }
        }
        if ($name == "employee"){
            $departmentid = Input::get('cboDepartmentID');
            $teamid = Input::get('cboTeamID');
            $rs = $this->LoadEmployeeByG4($pForm, Session::get("W91P0000")['HRDivisionID'],$departmentid,$teamid, 1);
            $str = "";
            foreach ($rs as $row) {
                $str .= "<option value='" . $row["EmployeeID"] . "'>" . $row["EmployeeName"] . "</option>";
            }
        }
        return $str ;
    }

    public function Filter($pForm, $g)
    {
        $language = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $input=Input::all();
        $departmentid = isset($input['cboDepartmentIDW15F3030']) ? $input['cboDepartmentIDW15F3030'] : "";
        $teamid = isset($input['cboTeamIDW15F3030']) ? $input['cboTeamIDW15F3030']:"";
        $employeeid = isset($input['cboEmployeeIDW15F3030']) ? $input['cboEmployeeIDW15F3030']: "" ;
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];

        $sSQL = "";
        $sSQL ="--Lay cot dong".PHP_EOL;
        $sSQL .="EXEC W15P3032 '$userid', '$pForm', '$language' ".PHP_EOL;
        $dsCaption = $this->connectionHR->select($sSQL);

        $sSQL ="-- lay format".PHP_EOL;
        $sSQL .=" SELECT   LeaveQtyDecimals";
        $sSQL .=" FROM 	D15T0000 WITH(NOLOCK)";
        $dsFormat = $this->connectionHR->select($sSQL);

        $sSQL ="--Do nguon cho luoi".PHP_EOL;
        $sSQL .="EXEC W15P3030 '$divisionhr', '$userid', '$departmentid', '$teamid','$employeeid',$tranmonth,$tranyear,'$language', '$pForm', '%'  ".PHP_EOL;
        Debugbar::info($sSQL);
        $dsData = $this->connectionHR->select($sSQL);
        return View::make("W1X.W15.W15F3030_Ajax", compact('pForm', 'g', 'dsCaption','dsData','dsFormat'));
    }
}
