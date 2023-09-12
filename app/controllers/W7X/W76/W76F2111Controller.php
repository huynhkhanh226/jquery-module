<?php

namespace W7X\W76;

use Carbon\Carbon;
use Debugbar;
use Helpers;
use Request;
use Session;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F2111Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {

        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $lang = Session::get('Lang');
        $session = Session::getId();
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $perD76F2110 = $this->getPermission($pForm);
        //\Debugbar::info(Auth::user()->user());

        switch ($task) {
            case "add":
                $dateFrom = Input::get('dateFrom', '');
                $dateTo = Input::get("dateTo", '');
                $numWeek = Input::get("numWeek", 0);
                $caption = Helpers::getRS($g, "Cap_nhat_ke_hoach_lam_viec");

                $mode = 1;
                $sql = "-- Combo Cong viec" . PHP_EOL;
                $sql .= "Exec W76P2311 '$userID', '$session', $mode";
                $workList = $this->connectionHR->select($sql);

                $taskID = 0;
                $sql = "--Do nguon trang thai" . PHP_EOL;
                $sql .= "EXEC W76P2021 '" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "', 'CompleteStatus', 0, $taskID";
                $statusList = $this->connectionHR->select($sql);

                $rsData = [];

                return View::make("W7X.W76.W76F2111", compact('statusList', 'perD76F2110', 'rsData', 'workList', 'g', 'caption', 'pForm', 'task', 'dateFrom', 'dateTo'));
                break;
            case 'checkstore':
                $taskID = Input::get('taskID', '');
                $formID = "W76F2110";

                $sql = "-- Kiem tra truoc khi Xoa" . PHP_EOL;
                $sql .= "Exec W76P5555" . PHP_EOL;
                $sql .= "'$divisionHR',";
                $sql .= "$tranMonth,";
                $sql .= "$tranYear,";
                $sql .= "$lang,";
                $sql .= "1,";
                $sql .= "'$userID',";
                $sql .= "'$session'";
                $sql .= "'E',";
                $sql .= "'$formID',";
                $sql .= "'',";
                $sql .= "'$taskID',";
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

                try {
                    $row = $this->connectionHR->selectOne($sql);
                    if ($row == null) {
                        return json_encode(["status" => "CHECKSTORE", "message" => $row["Message"]]);
                    }
                    if ($row["Status"] == 0) {
                        return json_encode(["status" => "OKAY"]);
                    } else {
                        return json_encode(["status" => "CHECKSTORE", "message" => $row["Message"]]);
                    }
                } catch (\Exception $ex) {
                    return json_encode(['status' => 'ERROR', "message" => Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }
                break;
            case 'view':
            case "edit":
                $numWeek = Input::get("weekNum", 0);
                $data = json_decode(Input::get("data", "{}"));
                $taskID = $data->TaskID;
                $dateFrom = Helpers::convertDate(Input::get('dateFrom', ''));
                $dateTo = Helpers::convertDate(Input::get("dateTo", ''));
                $caption = Helpers::getRS($g, "Cap_nhat_ke_hoach_lam_viec");
                $mode = 1;
                $sql = "-- Combo Cong viec" . PHP_EOL;
                $sql .= "Exec W76P2311 '$userID', '$session', $mode";
                $workList = $this->connectionHR->select($sql);

                $sql = "--Do nguon trang thai" . PHP_EOL;
                $sql .= "EXEC W76P2021 '" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "', 'CompleteStatus', 0, $taskID";
                $statusList = $this->connectionHR->select($sql);

                $mode = 2;
                $sql = "-- Do nguon cho master" . PHP_EOL;
                $sql .= "Exec W76P2110 '$userID', '$session', $mode, '$userID', $numWeek, $dateFrom, $dateTo, $taskID";

                $rsData = $this->connectionHR->selectOne($sql);
                return View::make("W7X.W76.W76F2111", compact('statusList', 'perD76F2110', 'rsData', 'workList', 'g', 'caption', 'pForm', 'task', 'dateFrom', 'dateTo'));
                break;
            case 'loadwork':
                $mode = 1;
                $sql = "-- Combo Cong viec";
                $sql .= "Exec W76P2311 '$userID', '$session', $mode";
                $workList = $this->connectionHR->select($sql);
                return $workList;

            case 'company':
                $selectedCompanys = Input::get("txtD76CompanyIDW76F2111", "");
                if ($selectedCompanys != "") {
                    $selectedCompanys = explode(';', $selectedCompanys);
                    //\Debugbar::info($selectedCompanys);
                } else {
                    $selectedCompanys = [];
                }
                $mode = 2;
                $sql = "-- Combo congty" . PHP_EOL;
                $caption = \Helpers::getRS($g, "Danh_sach_cong_ty");
                $sql .= "Exec W76P2311 '$userID', '$session', $mode";
                if ($g == 4) {
                    $rsTemp = $this->connectionHR->select($sql);
                } else {
                    $rsTemp = $this->connection->select($sql);
                }
                $rsData = [];
                foreach ($rsTemp as $row) {
                    $row["IsSelected"] = false;
                    if (count($selectedCompanys) > 0) {
                        foreach ($selectedCompanys as $company) {
                            if ($company == $row["D17CompanyID"]) {
                                $row["IsSelected"] = true;
                                \Debugbar::info($row);
                            }
                        }

                    }

                    array_push($rsData, $row);

                }
                \Debugbar::info($rsData);
                return View::make("layout.component.companySearch", compact('selectedCompanys', 'g', 'caption', 'pForm', 'task', 'rsData'));
                break;
            case 'reloadgrid':
                $selectedCompanys = Input::get("txtD76CompanyIDW76F2111", "");


                \Debugbar::info($selectedCompanys);
                if ($selectedCompanys != "") {
                    $selectedCompanys = explode(';', $selectedCompanys);
                    //\Debugbar::info($selectedCompanys);
                } else {
                    $selectedCompanys = [];
                }
                $mode = 2;
                $sql = "-- Combo congty" . PHP_EOL;
                $caption = \Helpers::getRS($g, "Tim_kiem_cong_ty");
                $sql .= "Exec W76P2311 '$userID', '$session', $mode";
                if ($g == 4) {
                    $rsTemp = $this->connectionHR->select($sql);
                } else {
                    $rsTemp = $this->connection->select($sql);
                }
                $rsData = [];

                foreach ($rsTemp as $row) {
                    $row["IsSelected"] = false;
                    if (count($selectedCompanys) > 0) {
                        foreach ($selectedCompanys as $company) {
                            if ($company == $row["D17CompanyID"]) {
                                $row["IsSelected"] = true;
                                \Debugbar::info($row);
                            }
                        }

                    }

                    array_push($rsData, $row);

                }
                \Debugbar::info($rsData);
                return json_encode($rsData);
                break;
            case 'save':
            case 'update':
                $dtpExecuteFromW76F2111 = Helpers::convertDate(Input::get("dtpExecuteFromW76F2111", ""));
                $dtpExecuteToW76F2111 = Helpers::convertDate(Input::get("dtpExecuteToW76F2111", ""));
                $txtExecuteBeginTimeW76F2111 = Input::get("txtExecuteBeginTimeW76F2111", "");
                if ($txtExecuteBeginTimeW76F2111 != "") {
                    $arr = explode(":", $txtExecuteBeginTimeW76F2111);
                    $now = Carbon::now();
                    $txtExecuteBeginTimeW76F2111 = "'" . $now->setTime($arr[0], $arr[1]) . "'";
                } else {
                    $txtExecuteBeginTimeW76F2111 = Helpers::convertDate("");
                }


                $txtExecuteEndTimeW76F2111 = Input::get("txtExecuteEndTimeW76F2111", "");
                if ($txtExecuteEndTimeW76F2111 != "") {
                    $arr = explode(":", $txtExecuteEndTimeW76F2111);
                    $now = Carbon::now();
                    $txtExecuteEndTimeW76F2111 = "'" . $now->setTime($arr[0], $arr[1]) . "'";
                } else {
                    $txtExecuteEndTimeW76F2111 = Helpers::convertDate("");
                }
                $now = Carbon::now();
                $txtLocationW76F2111 = $this->sqlstring(Input::get("txtLocationW76F2111", ""));
                $cboTaskTypeW76F2111 = $this->sqlstring(Input::get("cboTaskTypeW76F2111", ""));
                $txtTaskNotesW76F2111 = $this->sqlstring(Input::get("txtTaskNotesW76F2111", ""));
                $txtResultsW76F2111 = $this->sqlstring(Input::get("txtResultsW76F2111", ""));
                $txtActEvaluationW76F2111 = $this->sqlstring(Input::get("txtActEvaluationW76F2111", ""));
                $txtNotesW76F2111 = $this->sqlstring(Input::get("txtNotesW76F2111", ""));
                $txtD76CompanyIDW76F2111 = str_replace(",", ";", Input::get("txtD76CompanyIDW76F2111", ""));
                $cboStatusW76F2111 = Input::get("cboStatusW76F2111", "");

                $arrCompany = explode(';', $txtD76CompanyIDW76F2111, 3);
                $sql = "--Xoa bang tam" . PHP_EOL;
                $sql .= "set nocount on" . PHP_EOL;
                $sql .= "DELETE D91T9009 WHERE UserID = '$userID' AND Key01ID = '$session' AND FormID = 'W76F2111' AND Key02ID = 'Schedule'" . PHP_EOL;

                $taskID = Input::get("taskID", 0);
                if ($taskID == "")
                    $taskID = 0;
                $sql .= "INSERT INTO D91T9009 (UserID, Key01ID, FormID, Key02ID," . PHP_EOL;
                $sql .= "Key03ID, Dat01, Dat02," . PHP_EOL;
                $sql .= "Key04ID, Key05ID, Key06ID," . PHP_EOL;
                $sql .= "Key07ID, Key08ID, Key09ID," . PHP_EOL;
                $sql .= "Key10ID, Key11ID, Key12ID, Num01, Num02" . PHP_EOL;
                $sql .= " )" . PHP_EOL;
                $sql .= "VALUES ( '$userID', '$session', 'W76F2111',  'Schedule'," . PHP_EOL;
                $sql .= "'$userID', $dtpExecuteFromW76F2111, $dtpExecuteToW76F2111," . PHP_EOL;
                $sql .= "$txtExecuteBeginTimeW76F2111, $txtExecuteEndTimeW76F2111, N'$txtLocationW76F2111'," . PHP_EOL;
                $sql .= "'$cboTaskTypeW76F2111', N'$txtTaskNotesW76F2111', N'$txtResultsW76F2111'," . PHP_EOL;
                $sql .= "N'$txtActEvaluationW76F2111', N'$txtNotesW76F2111', '$txtD76CompanyIDW76F2111',  $taskID, $cboStatusW76F2111)" . PHP_EOL;
//                foreach ($arrCompany as $x) {
//                    $sql .= "INSERT INTO D91T9009 (UserID, Key01ID, FormID, Key02ID," . PHP_EOL;
//                    $sql .= "Key03ID, Dat01, Dat02," . PHP_EOL;
//                    $sql .= "Key04ID, Key05ID, Key06ID," . PHP_EOL;
//                    $sql .= "Key07ID, Key08ID, Key09ID," . PHP_EOL;
//                    $sql .= "Key10ID, Key11ID, Key12ID, Num01" . PHP_EOL;
//                    $sql .= " )" . PHP_EOL;
//                    $sql .= "VALUES ( '$userID', '$session', 'W76F2111',  'Schedule'," . PHP_EOL;
//                    $sql .= "'$userID', $dtpExecuteFromW76F2111, $dtpExecuteToW76F2111," . PHP_EOL;
//                    $sql .= "$txtExecuteBeginTimeW76F2111, $txtExecuteEndTimeW76F2111, N'$txtLocationW76F2111'," . PHP_EOL;
//                    $sql .= "'$cboTaskTypeW76F2111', N'$txtTaskNotesW76F2111', N'$txtResultsW76F2111'," . PHP_EOL;
//                    $sql .= "N'$txtActEvaluationW76F2111', N'$txtNotesW76F2111', '$x',  $taskID)" . PHP_EOL;
//                }
                if ($taskID == "") {
                    $mode = "A";
                } else {
                    $mode = "E";
                }

                $sql .= "-- Luu du lieu Ke hoach lam viec" . PHP_EOL;
                $sql .= "EXEC W76P2111 '$userID', '$session', 'W76F2111', '$mode', 'Schedule', $taskID" . PHP_EOL;


                /* $sql .= "INSERT INTO D76T2050 ( ExecuteFrom, ExecuteTo, ExecuteBeginTime, ExecuteEndTime, Assignee, Location, TaskType,  TaskNotes, Results, ActEvaluation, Notes, D17CompanyID, CreateDate, CreateUserID, LastModifyDate, LastModifyUserID, Type)" . PHP_EOL;
                 //$sql .="OUTPUT Inserted.* VALUES ((select (max(TaskID)+1) from D76T2050),$dtpExecuteFromW76F2111, $dtpExecuteToW76F2111, $txtExecuteBeginTimeW76F2111, $txtExecuteEndTimeW76F2111, '$userID', '$txtLocationW76F2111',".PHP_EOL;
                 $sql .= "OUTPUT Inserted.TaskID VALUES ($dtpExecuteFromW76F2111, $dtpExecuteToW76F2111, $txtExecuteBeginTimeW76F2111, $txtExecuteEndTimeW76F2111, '$userID', N'$txtLocationW76F2111'," . PHP_EOL;
                 $sql .= "'$cboTaskTypeW76F2111', N'$txtTaskNotesW76F2111', N'$txtResultsW76F2111', N'$txtActEvaluationW76F2111', N'$txtNotesW76F2111', '$x', '$now', '$userID', '$now', '$userID', 'Schedule')" . PHP_EOL;
                 */

                \Debugbar::info($sql);

                try {
                    $rsData = $this->connectionHR->selectOne($sql);
                    if ($rsData["Status"] == 0) {
                        return ["status" => "OKAY", "data" => $rsData];
                    } else {
                        return ["status" => "CHECKSTORE", "message" => $rsData["Message"]];
                    }

                    return json_encode($rsData);
                } catch (\Exception $ex) {
                    return ["status" => "FAILED", "message" => Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")];
                }


                break;
            /*case 'update':
                $dtpExecuteFromW76F2111 = Helpers::convertDate(Input::get("dtpExecuteFromW76F2111", ""));
                $dtpExecuteToW76F2111 = Helpers::convertDate(Input::get("dtpExecuteToW76F2111", ""));
                $txtExecuteBeginTimeW76F2111 = Input::get("txtExecuteBeginTimeW76F2111", "");
                if ($txtExecuteBeginTimeW76F2111 != "") {
                    $arr = explode(":", $txtExecuteBeginTimeW76F2111);
                    $now = Carbon::now();
                    $txtExecuteBeginTimeW76F2111 = "'" . $now->setTime($arr[0], $arr[1]) . "'";
                } else {
                    $txtExecuteBeginTimeW76F2111 = Helpers::convertDate("");
                }


                $txtExecuteEndTimeW76F2111 = Input::get("txtExecuteEndTimeW76F2111", "");
                if ($txtExecuteEndTimeW76F2111 != "") {
                    $arr = explode(":", $txtExecuteEndTimeW76F2111);
                    $now = Carbon::now();
                    $txtExecuteEndTimeW76F2111 = "'" . $now->setTime($arr[0], $arr[1]) . "'";
                } else {
                    $txtExecuteEndTimeW76F2111 = Helpers::convertDate("");
                }
                $now = Carbon::now();
                $txtLocationW76F2111 = $this->sqlstring(Input::get("txtLocationW76F2111", ""));
                $cboTaskTypeW76F2111 = $this->sqlstring(Input::get("cboTaskTypeW76F2111", ""));
                //$txtTaskTypeNameW76F2111 = $this->sqlstring(Input::get("txtTaskTypeNameW76F2111", ""));
                $txtTaskNotesW76F2111 = $this->sqlstring(Input::get("txtTaskNotesW76F2111", ""));
                $txtResultsW76F2111 = $this->sqlstring(Input::get("txtResultsW76F2111", ""));
                $txtActEvaluationW76F2111 = $this->sqlstring(Input::get("txtActEvaluationW76F2111", ""));
                $txtNotesW76F2111 = $this->sqlstring(Input::get("txtNotesW76F2111", ""));
                $txtD76CompanyIDW76F2111 = $this->sqlstring(Input::get("txtD76CompanyIDW76F2111", ""));
                $taskID = Input::get("taskID", 0);

                $sql = "--Cap nhat du lieu" . PHP_EOL;
                $sql .= "UPDATE D76T2050" . PHP_EOL;
                $sql .= "SET " . PHP_EOL;
                $sql .= "ExecuteFrom 	= $dtpExecuteFromW76F2111, " . PHP_EOL;
                $sql .= "ExecuteTo		= $dtpExecuteToW76F2111, " . PHP_EOL;
                $sql .= "ExecuteBeginTime = $txtExecuteBeginTimeW76F2111, " . PHP_EOL;
                $sql .= "ExecuteEndTime	= $txtExecuteEndTimeW76F2111, " . PHP_EOL;
                $sql .= "Assignee		= '$userID', " . PHP_EOL;
                $sql .= "Location		= N'$txtLocationW76F2111', " . PHP_EOL;
                $sql .= "TaskType		= '$cboTaskTypeW76F2111',  " . PHP_EOL;
                $sql .= "TaskNotes		= N'$txtTaskNotesW76F2111', " . PHP_EOL;
                $sql .= "Results		= N'$txtResultsW76F2111', " . PHP_EOL;
                $sql .= "ActEvaluation	= N'$txtActEvaluationW76F2111', " . PHP_EOL;
                $sql .= "Notes			= N'$txtNotesW76F2111', " . PHP_EOL;
                $sql .= "D17CompanyID= '$txtD76CompanyIDW76F2111', " . PHP_EOL;
                $sql .= "LastModifyDate 	= GETDATE(), " . PHP_EOL;
                $sql .= "LastModifyUserID= '$userID'" . PHP_EOL;
                $sql .= "WHERE TaskID = 	$taskID" . PHP_EOL;
                try {
                    $this->connectionHR->statement($sql);
                    return ["status" => "OKAY"];
                } catch (\Exception $ex) {
                    return ["status" => "FAILED", "message" => Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")];
                }*/

        }
    }
}
