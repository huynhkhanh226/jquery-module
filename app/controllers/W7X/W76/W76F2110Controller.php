<?php

namespace W7X\W76;

use Debugbar;
use Helpers;
use Request;
use Session;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F2110Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {

        $userID = Auth::user()->user()->UserID;
        $session = Session::getId();
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $perD76F2110 = $this->getPermission($pForm);
        \Debugbar::info($perD76F2110);
        $lang = Session::get('Lang');
        $session = Session::getId();
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        switch ($task) {
            case "":
                $caption = $this->getModalTitle("D76F2110");
                $mode = 3;
                $sql = "-- Combo Nhan vien" . PHP_EOL;
                $sql .= " Exec W76P2311 '$userID', '$session', $mode" . PHP_EOL;
                $assigneeList = $this->connectionHR->select($sql);
                $employeeID = Auth::user()->user()->HREmployeeID;
                \Debugbar::info($employeeID);
                return View::make("W7X.W76.W76F2110", compact('perD76F2110', 'g', 'pForm', 'caption', 'assigneeList', 'userID'));
                break;
            case 'reloadgrid':
                $assignee = Input::get("assignee", "");
                $weekNum = Input::get("weekNum", 1);
                $dateFrom = Helpers::convertDate(Input::get("dateFrom", ""));
                $dateTo = Helpers::convertDate(Input::get("dateTo", ""));
                $mode = 1;
                $sql = "--Do nguon cho grid" . PHP_EOL;
                $sql .= "Exec W76P2110 '$userID', '$session', $mode, '$assignee', $weekNum, $dateFrom, $dateTo" . PHP_EOL;
                \Debugbar::info($sql);
                $data = $this->connectionHR->select($sql);

                return $data;
                break;


            case 'delete':
                $TaskID = Input::get('TaskID', '');
                $formID = "W76F2110";


                $sql = "-- Kiem tra truoc khi Xoa" . PHP_EOL;
                $sql .= "Exec W76P5555" . PHP_EOL;
                $sql .= "'$divisionHR',";
                $sql .= "$tranMonth,";
                $sql .= "$tranYear,";
                $sql .= "$lang,";
                $sql .= "1,";
                $sql .= "'$userID',";
                $sql .= "'$session',";
                $sql .= "'D',";
                $sql .= "'$formID',";
                $sql .= "'',";
                $sql .= "'$TaskID',";
                $sql .= "'',";
                $sql .= "'',";
                $sql .= "'',";
                $sql .= "'',";
                $sql .= "0,";
                $sql .= "0,";
                $sql .= "0,";
                $sql .= "0,";
                $sql .= "0,";
                $sql .= "NULL,";
                $sql .= "NULL,";
                $sql .= "NULL,";
                $sql .= "NULL,";
                $sql .= "NULL";

                try{
                    $row = $this->connectionHR->selectOne($sql);
                    if ($row == null){
                        return json_encode(["status"=>"CHECKSTORE", "message"=>$row["Message"]]);
                    }
                    if ($row["Status"] == 0){
                        //Thuc hien xoa
                        $mode = 3;
                        $assignee = Input::get("assignee", "");
                        $weekNum = Input::get("weekNum", 1);
                        $dateFrom = Helpers::convertDate(Input::get("dateFrom", ""));
                        $dateTo = Helpers::convertDate(Input::get("dateTo", ""));
                        $sql = "-- Xoa  ke hoach lam viec".PHP_EOL;
                        $sql .= "Exec W76P2110 '$userID', '$session', $mode, '$assignee', $weekNum, $dateFrom, $dateTo, '$TaskID'".PHP_EOL;
                        $this->connectionHR->statement($sql);
                        return json_encode(["status"=>"OKAY"]);
                    }else{
                        return json_encode(["status"=>"CHECKSTORE", "message"=>$row["Message"]]);
                    }
                }catch (\Exception $ex){
                    return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

        }
    }
}
