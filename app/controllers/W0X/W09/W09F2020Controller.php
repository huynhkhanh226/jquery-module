<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 25/10/2017
 * Time: 9:21 AM
 */

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

class W09F2020Controller extends W0XController
{
    public function Index($pForm, $g, $task = "")
    {
        //\Debugbar::info("da chay vao");
        $modalTitle = $this->getModalTitle($pForm);
        \Debugbar::info(Session::get("W91P0000"));
        //$rs1 = json_encode(array());
        $valueGrid = json_encode(array());
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $lang = Session::get("Lang");
        $UserID = Auth::user()->user()->UserID;
        $session = Session::getId();
        $employeeID = Auth::user()->user()->HREmployeeID;
        $companyID = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
        //\Debugbar::info($employeeID);
        //$tranMonth = Session::get("W91P0000")['HRTranMonth'];
        //$tranYear = Session::get("W91P0000")['HRTranYear'];
        switch ($task) {
            case "":
                $sql = "--Do nguon len cac master" . PHP_EOL;
                $sql .= "Exec W09P2020 '$employeeID'";
                $employeeInfo = $this->connectionHR->select($sql);
                \Debugbar::info($employeeInfo);

                $sql1 = "--Do nguon len luoi lich su xin nghi" . PHP_EOL;
                $sql1 .= "Exec W09P2021 '$employeeID', ''";
                $valueGrid = $this->connectionHR->select($sql1);
                \Debugbar::info($sql1);
                \Debugbar::info($valueGrid);

                return View::make("W0X.W09.W09F2020", compact("pForm", "g", "modalTitle", "employeeInfo", "valueGrid"));
                break;

            case "checkBeforeSave"://kiểm tra trước khi save
                \Debugbar::info(Input::all());
                $sql = "--kiem tra truoc khi luu".PHP_EOL;
                $sql .= "EXEC W09P5555 '$HRDivisionID', '$UserID', '0002', '$employeeID', '$lang', 0, NULL, 0, '', 'D09F2080'";
                \Debugbar::info($sql);
                $rsCheck = $this->connectionHR->select($sql);
                return json_encode($rsCheck[0]);
                break;

            case "save":
                $IGE = $this->CreateIGE($g, "D09T2020", "09", "LE");
                \Debugbar::info($IGE);
                $dateLeft = Helpers::convertDate(Input::get('txtDateLeftW092020'));
                $noteDate = Helpers::convertDate(Input::get('txtNoticeDateW092020'));
                $dateNumber = Input::get('txtDateNumberW092020');
                $reason = Input::get('txtReasonW092020');
                $notes = Input::get('txtNotesW092020');
                \Debugbar::info(Input::all());
                $sql = "--Luu nghiep vu" . PHP_EOL;
                $sql .= "set nocount on INSERT INTO D09T2020 (" . PHP_EOL;
                $sql .= "LeaveTransID, EmployeeID, DateLeft, Reason, Notes, CreateDate, CreateUserID,LastModifyDate, LastModifyUserID,ApprovedStatusID, ProApproved, NoticeDate, DateNumber)" . PHP_EOL;
                $sql .= "VALUES ('$IGE', '$employeeID', $dateLeft, N'$reason', N'$notes', Getdate(), '$employeeID', Getdate(), '$UserID', 1, 0, $noteDate,$dateNumber)";
                \Debugbar::info($sql);

                $sql .= "--Ra User va cap duyet tiep theo" . PHP_EOL;
                $sql .= "EXEC D84P2020 '$companyID', $g, 'D09', '', '$HRDivisionID', '$UserID', '$session', 1, '$lang', 0, 0,0, 'D09F2080', '$IGE'";

                \Debugbar::info($sql);

                //$cd = $this->connectionHR->select($sql);
                //\Debugbar::info($cd);
                if ($sql != '') {
                    try {
                        //$this->connectionHR->statement($sql);
                        $cd = $this->connectionHR->select($sql);
                        \Debugbar::info($cd);
                        $sql2 = "--lay dong vua save" . PHP_EOL;
                        $sql2 .= "Exec W09P2021 '$employeeID', '$IGE'";
                        $rowDataSave = $this->connectionHR->select($sql2);

                        $sql1 = "--Do nguon len luoi lich su xin nghi" . PHP_EOL;
                        $sql1 .= "Exec W09P2021 '$employeeID', ''";
                        $valueGrid = $this->connectionHR->select($sql1);

                        return array('sendMail' => $cd, 'rowDataSave' => $rowDataSave, 'valueGrid' => $valueGrid, 'status' => 1, 'message' => '');
                    } catch (Exception $ex) {
                        \Debugbar::info($ex);
                        return array('status' => 0, 'message' => $ex->getMessage());
                    }
                } else {
                    return array('status' => 0);
                }
                break;

            case "delete":
                //\Debugbar::info("da chay del");
                $leaveTransID = Input::get('LeaveTransID');
                $sql = "--xoa nghiep vu" . PHP_EOL;
                //$sql .= "Delete  D09T2020 where LeaveTransID = '$leaveTransID'";
                $sql .= "EXEC W09P2023 '$leaveTransID'";
                $this->connectionHR->statement($sql);

                $sql1 = "--Do nguon len luoi lich su xin nghi" . PHP_EOL;
                $sql1 .= "Exec W09P2021 '$employeeID', ''";
                $valueGrid = $this->connectionHR->select($sql1);
                return $valueGrid;
                break;

            case "edit":
                \Debugbar::info("da chay edit");
                $dateLeft = Helpers::convertDate(Input::get('txtDateLeftW092020'));
                $reason = Input::get('txtReasonW092020');
                $notes = Input::get('txtNotesW092020');
                $leaveTransID = Input::get('leaveTransID');
                $noteDate = Helpers::convertDate(Input::get('txtNoticeDateW092020'));
                $dateNumber = Input::get('txtDateNumberW092020');
                $sql = "--Sua nghiep vu" . PHP_EOL;
                $sql .= "set nocount on UPDATE D09T2020 SET" . PHP_EOL;
                $sql .= "DateLeft = $dateLeft," . PHP_EOL;
                $sql .= "Reason = N'$reason'," . PHP_EOL;
                $sql .= "Notes = N'$notes'," . PHP_EOL;
                $sql .= "ApprovedStatusID = 1," . PHP_EOL;
                $sql .= "ProApproved = 0," . PHP_EOL;
                $sql .= "NoticeDate = $noteDate," . PHP_EOL;
                $sql .= "DateNumber = $dateNumber," . PHP_EOL;
                $sql .= "LastModifyDate = Getdate()," . PHP_EOL;
                $sql .= "LastModifyUserID = '$UserID'" . PHP_EOL;
                $sql .= "WHERE LeaveTransID = '$leaveTransID'";

                $sql .= "--Ra User va cap duyet tiep theo" . PHP_EOL;
                $sql .= "EXEC D84P2020 '$companyID', $g, 'D09', '', '$HRDivisionID', '$UserID', '$session', 1, '$lang', 2, 0,0, 'D09F2080', '$leaveTransID'";
                \Debugbar::info($sql);
                //\Debugbar::info($sql);
                if ($sql != '') {
                    try {
                        $cd = $this->connectionHR->select($sql);
                        \Debugbar::info($cd);

                        $sql1 = "--Do nguon len luoi lich su xin nghi" . PHP_EOL;
                        $sql1 .= "Exec W09P2021 '$employeeID', ''";
                        $valueGrid = $this->connectionHR->select($sql1);

                        $sql2 = "--lay dong vua save" . PHP_EOL;
                        $sql2 .= "Exec W09P2021 '$employeeID', '$leaveTransID'";
                        $rowDataSave = $this->connectionHR->select($sql2);
                        \Debugbar::info($rowDataSave);

                        return array('sendMail' => $cd,'rowDataSave' => $rowDataSave, 'valueGrid' => $valueGrid, 'status' => 1, 'message' => '');
                    } catch (Exception $ex) {
                        \Debugbar::info($ex);
                        return array('status' => 0, 'message' => $ex->getMessage());
                    }
                } else {
                    return array('status' => 0);
                }
                break;

            case "sendMail":
                return json_encode(['rsvalue' => View::make('layout.sendmail', compact('rs'))->render()]);
                break;

            case "sendAutoMail":
                $arrMail = Input::get('arrMail');
                \Debugbar::info($arrMail);
                $res = $this->SendMailAuto($arrMail['EmailContent'],$arrMail);
                return json_encode(['status' => 'BACKGROUND', 'name' => $arrMail['EmailReceivedAddress'],"message"=>$res]);
                break;
        }
    }
}