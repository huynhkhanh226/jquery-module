<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 27/10/2017
 * Time: 8:51 AM
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

class W75F2130Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        $lang = Session::get("Lang");
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $UserID = Auth::user()->user()->UserID;
        $valueGrid = json_encode(array());
        $modalTitle = $this->getModalTitleG4($pForm);
        $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        $block = $this->LoadBlockByG4(Session::get("W91P0000")['HRDivisionID'], $UserID, $pForm, 1);
        $employee = $this->LoadEmployeeByG4($pForm, $HRDivisionID, '', '', 1, '', '');
        $team = $this->LoadTeamByG4($pForm, $HRDivisionID, '', 1);
        $sql3 = "--Sinh so tu dong" . PHP_EOL;
        $sql3 .= "SELECT * FROM D09T0000";
        $session = Session::getId();
        $autoNumber = $this->connectionHR->select($sql3);
        $creatorName = Session::get("W91P0000")['CreatorNameHR'];
        $creatorID = Session::get("W91P0000")['CreatorHR'];
        \Debugbar::info($autoNumber);
        $decisionNumAuto = $autoNumber[0]['DecisionNumAuto'];
        $isUseDecisionNum = $autoNumber[0]['IsUseDecisionNum'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $sql1 = "--Lay dinh dang so le" . PHP_EOL;
        $sql1 .= "select Decimals from d13t9000 WHERE TYPE = 'REWARD'";
        $decimals = $this->connectionHR->select($sql1);
        //\Debugbar::info($rsTemp);
        //$decimals = 2;

        /*if (count($rsTemp) > 0){
            $decimals =  $rsTemp[0]["LeaveQtyDecimals"];
        }*/
        //\Debugbar::info($decisionNumAuto, $isUseDecisionNum);
        switch ($task) {
            case "":
                $sql = "--Do nguon trang thai" . PHP_EOL;
                $sql .= "SELECT ID, Name84U as Name " . PHP_EOL;
                $sql .= "FROM W75N5555 ('W75F2100','','','','')" . PHP_EOL;
                $sql .= "ORDER BY OrderNo" . PHP_EOL;
                //\Debugbar::info($sql);
                $statusList = $this->connectionHR->select($sql);

                $sql2 = "--Do nguon caption luoi" . PHP_EOL;
                $sql2 .= "SELECT Code, ShortU AS CaptionName, Decimals, DISABLED," . PHP_EOL;
                $sql2 .= "CASE WHEN Code = 'REWARD01' THEN 'Coefficient01'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD02' THEN 'Coefficient02'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD03' THEN 'Coefficient03'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD04' THEN 'Coefficient04'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD05' THEN 'Coefficient05'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD06' THEN 'Coefficient06'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD07' THEN 'Coefficient07'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD08' THEN 'Coefficient08'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD09' THEN 'Coefficient09'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD10' THEN 'Coefficient10' END AS CD" . PHP_EOL;
                $sql2 .= "FROM 	D13T9000" . PHP_EOL;
                $sql2 .= "WHERE [Type] = 'REWARD'";
                $caption = $this->connectionHR->select($sql2);
                \Debugbar::info($caption);
                return View::make("W7X.W75.W75F2130", compact("decimals","pForm", "g", "modalTitle", "valueGrid", "block", "department", "caption", "employee", "team", "statusList"));
                break;

            case "blockChange":
                //\Debugbar::info(Input::get('blockID'));
                $teamID = Input::get('teamID');
                if($teamID == '%'){
                    $teamID = '';
                }
                $dep = Input::get('departmentID');
                if($dep == '%'){
                    $dep = '';
                }
                $block = Input::get('blockID');
                \Debugbar::info($block, $teamID, $dep);
                $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], $block, 1);
                \Debugbar::info($department);
                $strDep = "";
                foreach ($department as $key=>$value) {
                    $strDep .= "<option value='" .$key."' > ".$value.  "</option>";
                }
                $employee = $this->LoadEmployeeByG4($pForm, $HRDivisionID, $dep, $teamID, 1, '', $block);
                \Debugbar::info($employee);
                $strEm = "";
                foreach ($employee as $row) {
                    $strEm .= "<option value='" . $row["EmployeeID"] . "'>" . $row["EmployeeName"] . "</option>";
                }
                $valueCombos = array(
                    "dep" => $strDep,
                    "employee" => $strEm,
                );
                return $valueCombos;
                break;

            case "departmentChange":
                //\Debugbar::info(Input::get('departmentID'));
                $teamID = Input::get('teamID');
                if($teamID == '%'){
                    $teamID = '';
                }
                $dep = Input::get('departmentID');
                if($dep == '%'){
                    $dep = '';
                }
                $block = Input::get('blockID');
                if($block == '%'){
                    $block = '';
                }
                \Debugbar::info($block, $teamID, $dep);
                $team = $this->LoadTeamByG4($pForm, $HRDivisionID, $dep, 1);
                \Debugbar::info($team);
                $strTeam = "";
                foreach ($team as $row) {
                    $strTeam .= "<option value='" . $row["TeamID"] . "'>" . $row["TeamName"] . "</option>";
                }

                $employee = $this->LoadEmployeeByG4($pForm, $HRDivisionID, $dep, $teamID, 1, '', $block);
                \Debugbar::info($employee);
                $strEm = "<option value=''></option>";
                foreach ($employee as $row) {
                    $strEm .= "<option value='" . $row["EmployeeID"] . "'>" . $row["EmployeeName"] . "</option>";
                }
                $valueCombos = array(
                    "team" => $strTeam,
                    "employee" => $strEm,
                );
                return $valueCombos;
                break;

            case "teamChange":
                \Debugbar::info(Input::get('teamID'));
                $teamID = Input::get('teamID');
                $dep = Input::get('departmentID');
                $block = Input::get('blockID');
                $employee = $this->LoadEmployeeByG4($pForm, $HRDivisionID, $dep, $teamID, 1, '', $block);
                \Debugbar::info($employee);
                $strEm = "";
                foreach ($employee as $row) {
                    $strEm .= "<option value='" . $row["EmployeeID"] . "'>" . $row["EmployeeName"] . "</option>";
                }
                return $strEm;
                break;

            case "filter":
                //\Debugbar::info(Input::all());
                $appStatusID = Input::get('cbStatusIDW75F2130');
                $departmentID = Input::get('cbDepartmentIDW75F2130');
                $teamID = Input::get('cbTeamIDW75F2130');
                $employeeID = Input::get('cbEmployeeW75F2130');
                $blockID = Input::get('cbBlockIDW75F2130');
                $dateFrom = Helpers::convertDate(Input::get('datefrom'));
                $dateTo = Helpers::convertDate(Input::get('dateto'));
                $sql = "--Do nguon cho luoi" . PHP_EOL;
                $sql .= "EXEC W75P2130 '$HRDivisionID', $dateFrom, $dateTo, '$appStatusID' ,'$blockID','$departmentID','$teamID','$employeeID','$pForm','0006', '$UserID', '$lang'";
                $valueGrid = $this->connectionHR->select($sql);

                $sql2 = "--Do nguon caption luoi" . PHP_EOL;
                $sql2 .= "SELECT Code, ShortU AS CaptionName, Decimals, DISABLED," . PHP_EOL;
                $sql2 .= "CASE WHEN Code = 'REWARD01' THEN 'Coefficient01'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD02' THEN 'Coefficient02'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD03' THEN 'Coefficient03'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD04' THEN 'Coefficient04'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD05' THEN 'Coefficient05'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD06' THEN 'Coefficient06'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD07' THEN 'Coefficient07'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD08' THEN 'Coefficient08'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD09' THEN 'Coefficient09'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'REWARD10' THEN 'Coefficient10' END AS CD" . PHP_EOL;
                $sql2 .= "FROM 	D13T9000" . PHP_EOL;
                $sql2 .= "WHERE [Type] = 'REWARD'";
                $caption = $this->connectionHR->select($sql2);

                for ($i = 0; $i < count($valueGrid); $i++) {
                    //$valueGrid[$i]["IsUpdate"] = 0;
                    foreach ($caption as $row) {
                        $valueGrid[$i][$row["CD"]] = number_format($valueGrid[$i][$row["CD"]], 0);
                    }
                }

                \Debugbar::info($valueGrid);
                return $valueGrid;
                break;

            case "save":
                $sql = "";
                $dataSender = Input::get('dataSender');
                $now = getdate();
                $date = Helpers::convertDate($now["mday"] . "/" . $now["mon"] . "/" . $now["year"]);
                \Debugbar::info($dataSender);
                if ($isUseDecisionNum == 1 && $decisionNumAuto == 1) {
                    $sql1 = "--xoa du lieu bang tam" . PHP_EOL;
                    $sql1 .= "DELETE D09T6666 WHERE	UserID = '$UserID' AND HostID = '$session'";
                    $this->connectionHR->statement($sql1);
                    Debugbar::info($sql1);
                    for ($i = 0; $i < count($dataSender); $i++) {
                        if ($dataSender[$i]["Approved"] == 1) {
                            if ($dataSender[$i]["ApproverID"] == "") {
                                $dataSender[$i]["ApproverID"] = $creatorID;
                            }
                            if ($dataSender[$i]["ApproverName"] == "") {
                                $dataSender[$i]["ApproverName"] = $creatorName;
                            }
                            if ($dataSender[$i]["AppDate"] == "") {
                                $dataSender[$i]["AppDate"] = $date;
                            }else{
                                $dataSender[$i]["AppDate"] = Helpers::convertDate($dataSender[$i]["AppDate"]);
                            }
                            $approverID = $dataSender[$i]["ApproverID"];
                            $teamID = $dataSender[$i]["TeamID"];
                            $times = intval($dataSender[$i]["Times"]) + 1;
                            $lastTime = intval($dataSender[$i]["LastTime"]) + 1;
                            $notice = $this->sqlstring($dataSender[$i]["Notice"]);
                            $departmentID = $dataSender[$i]["DepartmentID"];
                            $content = $this->sqlstring($dataSender[$i]["Content"]);
                            $appDate = $dataSender[$i]["AppDate"];
                            $transTypeID = $dataSender[$i]["TransTypeID"];
                            $employeeID = $dataSender[$i]["EmployeeID"];
                            $disRewardLevelID = $dataSender[$i]["DisRewardLevelID"];
                            $disRewardFormID = $dataSender[$i]["DisRewardFormID"];
                            $coefficient01 = Helpers::sqlNumber($dataSender[$i]["Coefficient01"]);
                            $coefficient02 = Helpers::sqlNumber($dataSender[$i]["Coefficient02"]);
                            $coefficient03 = Helpers::sqlNumber($dataSender[$i]["Coefficient03"]);
                            $coefficient04 = Helpers::sqlNumber($dataSender[$i]["Coefficient04"]);
                            $coefficient05 = Helpers::sqlNumber($dataSender[$i]["Coefficient05"]);
                            $coefficient06 = Helpers::sqlNumber($dataSender[$i]["Coefficient06"]);
                            $coefficient07 = Helpers::sqlNumber($dataSender[$i]["Coefficient07"]);
                            $coefficient08 = Helpers::sqlNumber($dataSender[$i]["Coefficient08"]);
                            $coefficient09 = Helpers::sqlNumber($dataSender[$i]["Coefficient09"]);
                            $coefficient10 = Helpers::sqlNumber($dataSender[$i]["Coefficient10"]);
                            $sql2 = "--insert tung dong vao bang tam" . PHP_EOL;
                            $sql2 .= "INSERT INTO D09T6666 (UserID, HostID, FormID, Key01ID, Key02ID, Num01, Date01, Date02, Date03)" . PHP_EOL;
                            $sql2 .= "VALUES ('$UserID', '$session', 'W75F2130', '$employeeID', 'D09F2090', " . $dataSender[$i]["OrderNo"] . " ,$appDate, $appDate, $appDate)";
                            $this->connectionHR->statement($sql2);
                            Debugbar::info($sql2);

                            $sql7 = "--lay ra methodID" . PHP_EOL;
                            $sql7 .= " SELECT MethodID FROM D09T1600 WHERE TypeCode='3' AND TransactionID = '0006' AND IsDefault = 1";
                            $rs7 = $this->connectionHR->select($sql7);
                            Debugbar::info($rs7);
                            if($rs7 != []){
                                $sql3 = "--thuc thi store chi chay 1 lan" . PHP_EOL;
                                $sql3 .= " EXEC D09P2016 '$HRDivisionID', '$tranMonth','$tranYear' , '$UserID', '$session', '$lang', '".$rs7[0]['MethodID']."', 2, 1";
                                $rs = $this->connectionHR->select($sql3);
                                Debugbar::info($rs);
                                $this->connectionHR->statement($sql1);
                                $IGE = $this->CreateIGE($g, "D09T2060", "75", "ID");
                                Debugbar::info($IGE);

                                $sql5 = "--Luu vao bang nghiep vu khen thuong" . PHP_EOL;
                                $sql5 .= "INSERT INTO D09T2060 (" . PHP_EOL;
                                $sql5 .= "TranMonth, TranYear, TranTypeID, DivisionID, DepartmentID,". PHP_EOL;
                                $sql5 .= "TeamID, EmployeeID, ExamineDate, SignDate, ValidDate, DecisionNum, DecisionNumU, SignerID, Notice, NoticeU, Content, ContentU, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate," . PHP_EOL;
                                $sql5 .= "TransID, Times, LastTime, DisRewardLevelID, DisRewardFormID," . PHP_EOL;
                                $sql5 .= "Coefficient01, Coefficient02, Coefficient03, Coefficient04," . PHP_EOL;
                                $sql5 .= "Coefficient05, Coefficient06, Coefficient07, Coefficient08, Coefficient09, Coefficient10)" . PHP_EOL;
                                $sql5 .= "VALUES ('$tranMonth', '$tranYear', '$transTypeID', '$HRDivisionID', '$departmentID','$teamID', '$employeeID',  Getdate(), Getdate(), Getdate(),". PHP_EOL;
                                $sql5 .="'".$rs[0]['DecisionNum']."','".$rs[0]['DecisionNum']."','$UserID',N'$notice',N'$notice',N'$content',N'$content','$creatorID', Getdate(),'$UserID',Getdate(),'$IGE',$times,$lastTime,'$disRewardLevelID', '$disRewardFormID'," . PHP_EOL;
                                $sql5 .=" $coefficient01,$coefficient02,$coefficient03,$coefficient04,$coefficient05,$coefficient06,$coefficient07,$coefficient08,$coefficient09,$coefficient10)";
                                $this->connectionHR->statement($sql5);
                            }else{
                                $sql3 = "--thuc thi store chi chay 1 lan" . PHP_EOL;
                                $sql3 .= " EXEC D09P2016 '$HRDivisionID', '$tranMonth','$tranYear' , '$UserID', '$session', '$lang', '', 2, 1";
                                $rs = $this->connectionHR->select($sql3);
                                Debugbar::info($rs);
                                $this->connectionHR->statement($sql1);
                                $IGE = $this->CreateIGE($g, "D09T2060", "75", "ID");
                                Debugbar::info($IGE);

                                $sql5 = "--Luu vao bang nghiep vu khen thuong" . PHP_EOL;
                                $sql5 .= "INSERT INTO D09T2060 (" . PHP_EOL;
                                $sql5 .= "TranMonth, TranYear, TranTypeID, DivisionID, DepartmentID,". PHP_EOL;
                                $sql5 .= "TeamID, EmployeeID, ExamineDate, SignDate, ValidDate, DecisionNum, DecisionNumU, SignerID, Notice, NoticeU, Content, ContentU, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate," . PHP_EOL;
                                $sql5 .= "TransID, Times, LastTime, DisRewardLevelID, DisRewardFormID," . PHP_EOL;
                                $sql5 .= "Coefficient01, Coefficient02, Coefficient03, Coefficient04," . PHP_EOL;
                                $sql5 .= "Coefficient05, Coefficient06, Coefficient07, Coefficient08, Coefficient09, Coefficient10)" . PHP_EOL;
                                $sql5 .= "VALUES ('$tranMonth', '$tranYear', '$transTypeID', '$HRDivisionID', '$departmentID','$teamID', '$employeeID',  Getdate(), Getdate(), Getdate(),". PHP_EOL;
                                $sql5 .="'','','$UserID',N'$notice',N'$notice',N'$content',N'$content','$creatorID', Getdate(),'$UserID',Getdate(),'$IGE',$times,$lastTime,'$disRewardLevelID', '$disRewardFormID'," . PHP_EOL;
                                $sql5 .=" $coefficient01,$coefficient02,$coefficient03,$coefficient04,$coefficient05,$coefficient06,$coefficient07,$coefficient08,$coefficient09,$coefficient10)";
                                $this->connectionHR->statement($sql5);
                            }
                        }
                    }
                }else {
                    for ($i = 0; $i < count($dataSender); $i++) {
                        if ($dataSender[$i]["Approved"] == 1) {
                            if ($dataSender[$i]["ApproverID"] == "") {
                                $dataSender[$i]["ApproverID"] = $creatorID;
                            }
                            if ($dataSender[$i]["ApproverName"] == "") {
                                $dataSender[$i]["ApproverName"] = $creatorName;
                            }
                            if ($dataSender[$i]["AppDate"] == "") {
                                $dataSender[$i]["AppDate"] = $date;
                            } else {
                                $dataSender[$i]["AppDate"] = Helpers::convertDate($dataSender[$i]["AppDate"]);
                            }
                            $approverID = $dataSender[$i]["ApproverID"];
                            $teamID = $dataSender[$i]["TeamID"];
                            $times = Helpers::sqlNumber($dataSender[$i]["Times"]);
                            $lastTime = Helpers::sqlNumber($dataSender[$i]["LastTime"]);
                            $notice = $this->sqlstring($dataSender[$i]["Notice"]);
                            $departmentID = $dataSender[$i]["DepartmentID"];
                            $content = $this->sqlstring($dataSender[$i]["Content"]);
                            $appDate = $dataSender[$i]["AppDate"];
                            $transTypeID = $dataSender[$i]["TransTypeID"];
                            $employeeID = $dataSender[$i]["EmployeeID"];
                            $disRewardLevelID = $dataSender[$i]["DisRewardLevelID"];
                            $disRewardFormID = $dataSender[$i]["DisRewardFormID"];
                            $coefficient01 = Helpers::sqlNumber($dataSender[$i]["Coefficient01"]);
                            $coefficient02 = Helpers::sqlNumber($dataSender[$i]["Coefficient02"]);
                            $coefficient03 = Helpers::sqlNumber($dataSender[$i]["Coefficient03"]);
                            $coefficient04 = Helpers::sqlNumber($dataSender[$i]["Coefficient04"]);
                            $coefficient05 = Helpers::sqlNumber($dataSender[$i]["Coefficient05"]);
                            $coefficient06 = Helpers::sqlNumber($dataSender[$i]["Coefficient06"]);
                            $coefficient07 = Helpers::sqlNumber($dataSender[$i]["Coefficient07"]);
                            $coefficient08 = Helpers::sqlNumber($dataSender[$i]["Coefficient08"]);
                            $coefficient09 = Helpers::sqlNumber($dataSender[$i]["Coefficient09"]);
                            $coefficient10 = Helpers::sqlNumber($dataSender[$i]["Coefficient10"]);

                            $IGE = $this->CreateIGE($g, "D09T2060", "75", "ID");
                            Debugbar::info($IGE);

                            $sql5 = "--Luu vao bang nghiep vu khen thuong" . PHP_EOL;
                            $sql5 .= "INSERT INTO D09T2060 (" . PHP_EOL;
                            $sql5 .= "TranMonth, TranYear, TranTypeID, DivisionID, DepartmentID," . PHP_EOL;
                            $sql5 .= "TeamID, EmployeeID, ExamineDate, SignDate, ValidDate, DecisionNum, DecisionNumU, SignerID, Notice, NoticeU, Content, ContentU, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate," . PHP_EOL;
                            $sql5 .= "TransID, Times, LastTime, DisRewardLevelID, DisRewardFormID," . PHP_EOL;
                            $sql5 .= "Coefficient01, Coefficient02, Coefficient03, Coefficient04," . PHP_EOL;
                            $sql5 .= "Coefficient05, Coefficient06, Coefficient07, Coefficient08, Coefficient09, Coefficient10)" . PHP_EOL;
                            $sql5 .= "VALUES ('$tranMonth', '$tranYear', '$transTypeID', '$HRDivisionID', '$departmentID','$teamID', '$employeeID', $appDate,$appDate,$appDate," . PHP_EOL;
                            $sql5 .= "'','','$approverID',N'$notice',N'$notice',N'$content',N'$content','$creatorID', Getdate(),'$UserID',Getdate(),'$IGE','$times','$lastTime','$disRewardLevelID', '$disRewardFormID'," . PHP_EOL;
                            $sql5 .= " $coefficient01,$coefficient02,$coefficient03,$coefficient04,$coefficient05,$coefficient06,$coefficient07,$coefficient08,$coefficient09,$coefficient10)";
                            $this->connectionHR->statement($sql5);
                        }
                    }
                }
                for ($i = 0; $i < count($dataSender); $i++) {
                    if ($dataSender[$i]["ApproverID"] == "") {
                        $dataSender[$i]["ApproverID"] = $creatorID;
                    }
                    if ($dataSender[$i]["ApproverName"] == "") {
                        $dataSender[$i]["ApproverName"] = $creatorName;
                    }
                    if ($dataSender[$i]["AppDate"] == "") {
                        $dataSender[$i]["AppDate"] = $date;
                    }
                    $approved = $dataSender[$i]["Approved"];
                    $notApproved = $dataSender[$i]["NotApproved"];
                    $approverID = $dataSender[$i]["ApproverID"];
                    $approvedDate = $dataSender[$i]["AppDate"];
                    $divisionID = $dataSender[$i]["DivisionID"];
                    $teamID = $dataSender[$i]["TeamID"];
                    $proTransID = $dataSender[$i]["ProTransID"];
                    $notice = $dataSender[$i]["Notice"];
                    $departmentID = $dataSender[$i]["DepartmentID"];
                    $content = $dataSender[$i]["Content"];
                    $dutyID = $dataSender[$i]["DutyID"];
                    $disRewardLevelID = $dataSender[$i]["DisRewardLevelID"];
                    $disRewardFormID = $dataSender[$i]["DisRewardFormID"];
                    $coefficient01 = Helpers::sqlNumber($dataSender[$i]["Coefficient01"]);
                    $coefficient02 = Helpers::sqlNumber($dataSender[$i]["Coefficient02"]);
                    $coefficient03 = Helpers::sqlNumber($dataSender[$i]["Coefficient03"]);
                    $coefficient04 = Helpers::sqlNumber($dataSender[$i]["Coefficient04"]);
                    $coefficient05 = Helpers::sqlNumber($dataSender[$i]["Coefficient05"]);
                    $coefficient06 = Helpers::sqlNumber($dataSender[$i]["Coefficient06"]);
                    $coefficient07 = Helpers::sqlNumber($dataSender[$i]["Coefficient07"]);
                    $coefficient08 = Helpers::sqlNumber($dataSender[$i]["Coefficient08"]);
                    $coefficient09 = Helpers::sqlNumber($dataSender[$i]["Coefficient09"]);
                    $coefficient10 = Helpers::sqlNumber($dataSender[$i]["Coefficient10"]);
                    $sql .= "--update du lieu" . PHP_EOL;
                    $sql .= " UPDATE D09T2151 " . PHP_EOL;
                    $sql .= " SET Approved = '$approved', 
                                NotApproved =  '$notApproved',
                                ApproverID = '$approverID',
                                ApprovedDate = $approvedDate,
                                DivisionID = '$divisionID',
                                ProDepartmentID = '$departmentID',
                                ProTeamID = '$teamID',
                                ProDutyID = '$dutyID',
                                ProContentU = N'$content',
                                ProDisRewardLevelID = '$disRewardLevelID',
                                ProDisRewardFormID = '$disRewardFormID',
                                ProNoticeU = N'$notice',
                                AppCoefficient01 = $coefficient01, 
                                AppCoefficient02 = $coefficient02, 
                                AppCoefficient03 = $coefficient03, 
                                AppCoefficient04 = $coefficient04, 
                                AppCoefficient05 = $coefficient05, 
                                AppCoefficient06 = $coefficient06,
                                AppCoefficient07 = $coefficient07, 
                                AppCoefficient08 = $coefficient08, 
                                AppCoefficient09 = $coefficient09, 
                                AppCoefficient10 = $coefficient10,
                                LastModifyUserID = '$UserID',
                                LastModifyDate = Getdate()" . PHP_EOL;
                    $sql .= " WHERE ProTransID = '$proTransID' AND TransTypeID = '0006'" . PHP_EOL;
                }
                \Debugbar::info($sql);
                if ($sql != '') {
                    try {
                        $rs = $this->connectionHR->statement($sql);
                        \Debugbar::info($rs);
                        return array('status' => 1, 'message' => '');
                    } catch (Exception $ex) {
                        \Debugbar::info($ex);
                        return array('status' => 0, 'message' => $ex->getMessage());
                    }
                } else {
                    return array('status' => 0);
                }
                break;
        }
    }
}