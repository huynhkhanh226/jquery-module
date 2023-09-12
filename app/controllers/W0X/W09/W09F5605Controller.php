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
use W0X\W0XController;
use Debugbar;

class W09F5605Controller extends W0XController
{
    public function Index($pForm, $g)
    {
       /* $Department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        $ListStatus = $this->LoadFixData('SearchKeyW09F5888', $g);
        $WorkingStatusID = $this->LoadtdbcWorkingStatusID(true);*/
        Debugbar::info(Input::all());
        $tEmArr = Input::get('tEmArr');
        Debugbar::info($tEmArr);
        $department = $this->LoadDepartmentByG4($pForm,Session::get("W91P0000")['HRDivisionID'],'%',1);
        //$team = $this->LoadTeamByG4($pForm, Session::get("W91P0000")['HRDivisionID'],"%", 1);
        return View::make("W0X.W09.W09F5605", compact('g', 'pForm',"department", "tEmArr"));
    }

    public function ReloadCombo($pForm, $g, $name){
        if ($name == "team"){
            $value = Input::get('cboDepartmentID');
            $rs = $this->LoadTeamByG4($pForm, Session::get("W91P0000")['HRDivisionID'],$value, 1);
            $str = "<option value = ''></option>";
            foreach ($rs as $row) {
                $str .= "<option value='" . $row["TeamID"] . "'>" . $row["TeamName"] . "</option>";
            }
        }
        return $str ;
    }

    public function Filter($pForm, $g)
    {
        $all = Input::all();
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $departmentid = $all['cboDepartmentIDW09F5605'];
        $teamid = $all['cboTeamIDW09F5605'];
        $employeeid = $all['txtEmployeeIDW09F5605'];
        $employeename = $all['txtEmployeeNameW09F5605'];
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $proposalid = $all['hdProposalIDW09F5605'];
        $trainingcourse = $all['hdTrainingCourseIDW09F5605'];
        $sql = "--Do nguon cho luoi nhan vien" . PHP_EOL;
        $sql .= " EXEC W09P5605	'$divisionhr',";
        $sql .= " '$departmentid',";
        $sql .= " '$teamid',";
        $sql .= " '$employeeid',";
        $sql .= " N'$employeename',";
        $sql .= " '$userid',";
        $sql .= " 'D38F3000',";
        $sql .= " 'D38',";
        $sql .= " '$proposalid',";
        $sql .= " '$trainingcourse'";

        $dataW09F5605 = json_encode($this->connectionHR->select($sql));
        //Debugbar::info(json_encode($this->connectionHR->select($sql)));
        return View::make("W0X.W09.W09F5605_Ajax", compact('pForm', 'g', 'dataW09F5605'));
    }
    public function Save($pForm, $g)
    {
        //ini_set('memory_limit', 1024*1024*1024*1024);
        $employeeids = Input::get('employeeids');
        $tEmployee = (array) Input::get('tEmArr');//mảng tạm chứa các phần tử đã chọn trước đó
        Debugbar::info(Input::all());
        $arrayRS = array_unique (array_merge ($tEmployee, $employeeids));//ghép 2 mảng loại bỏ những phần tử trùng nhau
        Debugbar::info($arrayRS);
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $formid = "D38F3000";
        $sql = "--Xoa bang tam" . PHP_EOL;
        //$sql .= " BEGIN TRAN " . PHP_EOL;
        $sql .= " DELETE FROM D09T6666 WHERE UserID = '$userid' AND FormID =  '$formid'". PHP_EOL;
        $sql .= "--Them du lieu vao bang tam" . PHP_EOL;
        foreach ($arrayRS as $id) {
            $sql .= "INSERT INTO D09T6666(UserID, FormID, Key01ID) VALUES ('$userid', '$formid', '$id')". PHP_EOL;
        }
        //$sql .= " ROLLBACK " . PHP_EOL;
        Debugbar::info($sql);
        $bSaved = $this->connectionHR->statement($sql);
        //Debugbar::info($bSaved);
        return json_encode(['bSaved' => $bSaved, 'tArr' => $arrayRS]);
    }
}
