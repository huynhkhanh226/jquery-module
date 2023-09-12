<?php

namespace W7X\W76;

use Carbon\Carbon;
use Debugbar;
use Exception;
use Helpers;
use Request;
use Session;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F4071Controller extends W7XController
{
    public function index($g, $id = 0)
    {
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
	    $mode = Input::get('mode', 0);
	    //mode = '' la add new
	    //mode = 0 la edit
	    //mode = 1 la danh gia

        if (Request::isMethod('post')) {
            $action = Input::get('do', '');
            if ($action == 'getListAssignee') {
                $str = Input::get('StrSearch', '');
                $sql = "--Do nguon Assignee" . PHP_EOL;
                $sql .= "EXEC W76P2022 '$userid', N'$str'";
                return json_encode($this->connectionHR->select($sql));
            }
            $taskname = $this->sqlstring(Input::get('txtTaskName', ''));
            $datef = Input::get('datef', 'null');
            $datet = Input::get('datet', 'null');
            $executetime = Input::get('txtExecuteEndTime', '00:00') . ':00';
            $status = intval(Input::get('slTaskStatus', 0));
            $priority = intval(Input::get('slTaskPriority', ''));
            $Assignee_val = Input::get('Assignee_val', '');
            $chkIsMyTask = Input::get('chkIsMyTask', 0);
            /*            $cboAssignee = $this->sqlstring(Input::get("cboAssignee", ""));*/

            $Assigneevl = Input::get('txtAssignee');
            $Assigneecb = str_replace(",", ";", Input::get("cboAssignee", ""));
            \Debugbar::info($Assigneecb);
            $arrAssign = explode(';', $Assigneecb, 200);
            \Debugbar::info($arrAssign);


            $note = $this->sqlstring(Input::get('txtTaskNotes', ''));



            try {
                if ($id == '') {
                    if ($chkIsMyTask == 'true') {
                        \Debugbar::info('true');

                        $sql = "--Luu them moi" . PHP_EOL;
                        $sql .= "Insert Into D76T2050(";
                        $sql .= "TaskName, ExecuteFrom, ExecuteTo, ExecuteEndTime, TaskStatus, ";
                        $sql .= "CompleteStatus, TaskPriority, Assigner, Assignee, TaskNotes, CreateDate";
                        $sql .= ") OUTPUT Inserted.TaskID Values(";
                        $sql .= " N'$taskname', '$datef', '$datet', '$executetime', $status, ";
                        $sql .= "$status, $priority,  '$userid',  '$Assigneevl',  N'$note', getdate()";
                        $sql .= ")";
                        $result = $this->connectionHR->selectOne($sql);
                        $id = $result['TaskID'];
                    } else if ($chkIsMyTask == 'false') {
                        \Debugbar::info('false');

                        foreach($arrAssign as $x ) {
                            $sql = "--Luu them moi" . PHP_EOL;
                            $sql .= "Insert Into D76T2050(";
                            $sql .= "TaskName, ExecuteFrom, ExecuteTo, ExecuteEndTime, TaskStatus, ";
                            $sql .= "CompleteStatus, TaskPriority, Assigner, Assignee, TaskNotes, CreateDate";
                            $sql .= ") OUTPUT Inserted.TaskID Values(";
                            $sql .= " N'$taskname', '$datef', '$datet', '$executetime', $status, ";
                            $sql .= "$status, $priority,  '$userid',  '$x',  N'$note', getdate()";
                            $sql .= ")";
                            $result = $this->connectionHR->selectOne($sql);
                            $id = $result['TaskID'];
                        }

                    }
                } else {
                    $rsCheck = $this->checkW76P5555('E', 'W76F4070', '', $id);
                    if ($rsCheck['Status'] == 1) {
                        return json_encode(['code' => 0, 'mess' => $rsCheck['Message']]);
                    }
                    $assigner = Input::get('hdAssigner', '');
                    $sql = "--Luu edit" . PHP_EOL;
                    $sql .= "Update D76T2050 Set ";
                    $sql .= "TaskName = N'$taskname',";
                    if ($mode == 0) {//Lưu edit
                        if ($datef != 'null' && $datef != '') {
                            $sql .= "ExecuteFrom = '$datef',";
                            $sql .= "ExecuteTo = '$datet',";
                        }
                        $sql .= "ExecuteEndTime = '$executetime',";
                        if ($assigner == $userid)
                            $sql .= "TaskStatus = $status,";
                        /*if ($assignee == $userid)
                            $sql .= "CompleteStatus = $status,";*/
                        if($chkIsMyTask=='true'){
                            if ($Assigneevl == $userid)
                           $sql .= "CompleteStatus = $status,";
                        }
                        else if($chkIsMyTask=='false'){
                            if ($Assigneecb == $userid)
                                $sql .= "CompleteStatus = $status,";

                            }
                        if ($priority != 0)
                            $sql .= "TaskPriority = $priority,";
                        $sql .= "TaskNotes =  N'$note'";
                        if ($status == 1)//Nếu hoàn tất,  Incident 108243 yeu cau lam
                            $sql .= ",CompleteDate =  getdate()";
                        elseif ($status == 0)
                            $sql .= ",CompleteDate = null";
                    } else {//Lưu đánh giá mode == 1
                        $assessNotes = $this->sqlstring(Input::get('txtAssessNotes', ''));
                        $rate = intval(Input::get('optAssessRate', 2));
                        $sql .= "AssessRate = $rate,";
                        $sql .= "AssessNotes =  N'$assessNotes'";
                    }
                    $sql .= " Where ";
                    $sql .= "TaskID = $id";
                    $this->connectionHR->statement($sql);
                }
                return json_encode(['code' => 1, 'id' => $id]);
            } catch (Exception $ex) {
                return json_encode(['code' => 0, 'mess' => $ex->getMessage()]);
            }
        }
        $sql = "--Do nguon trang thai" . PHP_EOL;
        $sql .= "EXEC W76P2021 '" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "', 'CompleteStatus', 0, $id";
        $status = $this->connectionHR->select($sql);

        $sql = "--Do nguon uu tien" . PHP_EOL;
        $sql .= "EXEC W76P2021 '" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "', 'TaskPriority', 0";
        $priority = $this->connectionHR->select($sql);

        $sql = "--Do nguon user" . PHP_EOL;
        $sql .= "EXEC W76P2021 '" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "', 'UserID', 0";
        $user = $this->connectionHR->select($sql);


        $sql = "--Do nguon Assignee" . PHP_EOL;
        $sql .= "EXEC W76P2022 '$userid', N''";
        $assignees = $this->connectionHR->select($sql);

        //$rsData = [];
        if ($id != '') { //truong hop sua
            $sql = "--Do nguon form" . PHP_EOL;
            $sql .= "EXEC W76P2020 '$userid','" . Session::get('Lang') . "', '',null,null,0, $id";
            $rsData = $this->connectionHR->selectOne($sql);
        }
        return View::make("W7X.W76.W76F4071", compact('g', 'status', 'g', 'priority', 'user', 'id', 'rsData', 'mode', 'assignees'));
    }
}
