<?php

namespace W3X\W39;

use Exception;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W3X\W3XController;

class W39F2021Controller extends W3XController
{

    public function index($pForm, $g, $task = '')
    {
        \Debugbar::info(Session::get("W91P0000"));
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeIDHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $session = Session::getId();
        $perW39F2021 = Session::get($pForm); //Tai lieu yeu cau phan quyen theo form 2021
        $modalTitle = $this->getModalTitleG4($pForm);
        \Debugbar::info($modalTitle);

        switch ($task) {
            case 'add':
                $sql = '--Do nguon Quy trinh duyet' . PHP_EOL;
                $sql .= "EXEC W84P1000	'$divisionHR','$userID','$pForm','D39DK0001'" . PHP_EOL;
                \Debugbar::info($sql);
                $approvalFlowList = $this->connectionHR->select($sql);
                $sql = '--Do nguon Bo chi tieu danh gia' . PHP_EOL;
                $sql .= "EXEC W39P1050	'$divisionHR','$userID', '$session','$pForm', 'D39'" . PHP_EOL;
                \Debugbar::info($sql);
                $appCriterionSetList = $this->connectionHR->select($sql);
                $rsData = [];

                $sql = "--do nguon cot dong" .PHP_EOL;
                $sql .= "SET NOCOUNT ON SELECT RefID, RefCaptionU AS RefCaption, Disabled" .PHP_EOL;
                $sql .= "FROM D09T0080" .PHP_EOL;
                $sql .= "WHERE Type='W39F2021'" .PHP_EOL;
                $sql .= "ORDER BY RefID" .PHP_EOL;
                $caption = $this->connectionHR->select($sql);
                \Debugbar::info($caption);
                return View::make("W3X.W39.W39F2021", compact('rsData', 'appCriterionSetList', 'approvalFlowList', 'perW39F2021', 'modalTitle', "pForm", "g", "task", "caption"));
                break;
            case 'loadgrid':
                $empCriterionID = Input::get("empCriterionID", "");
                $appCriterionSetID = Input::get("appCriterionSetID", "");

                $Mode = 0;
                $sql = '--Do nguon cho luoi' . PHP_EOL;
                $sql .= "EXEC W39P2010	'$divisionHR', '$userID', '$session', '$pForm',	$Mode, '$empCriterionID', '$appCriterionSetID'" . PHP_EOL;
                \Debugbar::info($sql);
                $rsData = $this->connectionHR->select($sql);
                for($i = 0; $i < count($rsData); $i++){
                    $rsData[$i]['calParentID'] = 0;
                }
                \Debugbar::info($rsData);
                return $rsData;
                break;
            case 'view':
            case 'edit':
            case 'verify':
                $sql = '--Do nguon Quy trinh duyet' . PHP_EOL;
                $sql .= "EXEC W84P1000	'$divisionHR','$userID','$pForm','D39DK0001'" . PHP_EOL;
                \Debugbar::info($sql);
                $approvalFlowList = $this->connectionHR->select($sql);
                $sql = '--Do nguon Bo chi tieu danh gia' . PHP_EOL;
                $sql .= "EXEC W39P1050	'$divisionHR','$userID', '$session','$pForm', 'D39'" . PHP_EOL;
                \Debugbar::info($sql);
                $appCriterionSetList = $this->connectionHR->select($sql);
                $Mode = 1;
                switch ($task) {
                    case 'view':
                        $Mode = 1;
                        break;
                    case 'edit':
                        $Mode = 1;
                        break;
                    case 'verify':
                        $Mode = 2;
                        break;
                }
                $empCriterionID = Input::get("empCriterionID", "");
                $appCriterionSetID = Input::get("appCriterionSetID", "");
                $sql = '--Do nguon cho luoi' . PHP_EOL;
                $sql .= "EXEC W39P2010	'$divisionHR', '$userID', '$session', '$pForm',	$Mode, '$empCriterionID', '$appCriterionSetID'" . PHP_EOL;
                \Debugbar::info($sql);
                $rsData = $this->connectionHR->select($sql);
                for($i = 0; $i < count($rsData); $i++){//duyệt mảng để gắn biến calParentID
                    if(intval($rsData[$i]['IsEdit']) == 1 && intval($rsData[$i]['IsUpdate'] == 1)){//nếu là cấp con nhỏ nhất
                        $rsData[$i]['calParentID'] = (intval($rsData[$i]['Confim']) * intval($rsData[$i]['Rate']))/100;
                    }else{// ko là cấp con nhỏ nhất
                        $rsData[$i]['calParentID'] = (float)$rsData[$i]['Confim'];
                    }
                    if($rsData[$i]['GroupID'] == ""){
                        $rsData[$i]['isChild'] = 1;
                    }else{
                        $rsData[$i]['isChild'] = 0;
                    }
                }
                \Debugbar::info($rsData);
                $sql = "--do nguon cot dong" .PHP_EOL;
                $sql .= "SET NOCOUNT ON SELECT RefID, RefCaptionU AS RefCaption, Disabled" .PHP_EOL;
                $sql .= "FROM D09T0080" .PHP_EOL;
                $sql .= "WHERE Type='W39F2021'" .PHP_EOL;
                $sql .= "ORDER BY RefID" .PHP_EOL;
                $caption = $this->connectionHR->select($sql);
                \Debugbar::info($caption);
                return View::make("W3X.W39.W39F2021", compact('rsData', 'appCriterionSetList', 'approvalFlowList', 'perW39F2021', 'modalTitle', "pForm", "g", "task", "caption"));
                break;
            case 'save':
                $txtDecriptionW39F2021 = $this->sqlstring(Input::get("txtDecriptionW39F2021", ""));
                $cboAppCriterionSetIDW39F2021 = $this->sqlstring(Input::get("cboAppCriterionSetIDW39F2021", ""));
                $txtValidDateFromW39F2021 = \Helpers::convertDate(Input::get("txtValidDateFromW39F2021", ""));
                $txtValidDateToW39F2021 = \Helpers::convertDate(Input::get("txtValidDateToW39F2021", ""));
                $cboApprovalFlowIDW39F2021 = $this->sqlstring(Input::get("cboApprovalFlowIDW39F2021", ""));
                $txtVoucherDateW39F2021 = \Helpers::convertDate(Input::get("txtVoucherDateW39F2021", ""));
                $txtEmployeeIDW39F2021 = $this->sqlstring(Input::get("txtEmployeeIDW39F2021", ""));
                $txtDepartmentNameW39F2021 = $this->sqlstring(Input::get("txtDepartmentNameW39F2021", ""));
                $txtEmployeeNameW39F2021 = $this->sqlstring(Input::get("txtEmployeeNameW39F2021", ""));
                $txtTotalResultW39F2021 = \Helpers::sqlNumber(Input::get("txtTotalResultW39F2021", ""));
                $txtEmployeeIDW39F2021 = $this->sqlstring(Input::get("txtEmployeeIDW39F2021", ""));
                $txtDepartmentNameW39F2021 = $this->sqlstring(Input::get("txtDepartmentNameW39F2021", ""));

                \Debugbar::info(Input::get("obj", []));
                $obj = json_decode(urldecode(Input::get("obj", [])));
                $sql = "--Xoa bang tam" . PHP_EOL;
                $sql .= "SET NOCOUNT ON" . PHP_EOL;
                $sql .= "DELETE FROM D09T6666  WHERE UserID ='$userID' AND HostID ='$session' AND FormID = 'D39F2021'" . PHP_EOL;

                $i = 0;
                \Debugbar::info($obj);
                foreach ($obj as $row) {
                    $ParentID = isset($row->ParentID) ? $row->ParentID : '';
                    //$appCriterionGroupID = isset($row->AppCriterionGroupID) ? $row->AppCriterionGroupID : '';
                    $appCriterionGroupID = isset($row->GroupID) ? $row->GroupID : '';
                    \Debugbar::info($appCriterionGroupID);
                    if($appCriterionGroupID == ""){// nếu là khoản trắng thì nhận khoản trắng
                        $appCriterionGroupID = $appCriterionGroupID;
                    }
                    if($appCriterionGroupID != ""){// nếu khác khoản trắng thì nhận AppCriterionGroupID
                        $appCriterionGroupID = isset($row->AppCriterionGroupID) ? $row->AppCriterionGroupID : '';
                    }
                    \Debugbar::info($appCriterionGroupID);
                    $rate = isset($row->Rate) ? $row->Rate : 0;
                    $isEdit = isset($row->IsEdit) ? $row->IsEdit : 0;
                    $confim = isset($row->Confim) ? $row->Confim : 0;
                    $result = isset($row->Result) ? $row->Result : 0;
                    $noteCriterion = isset($row->NoteCriterion) ? $row->NoteCriterion : '';
                    $isDistribute = isset($row->IsDistribute) ? $row->IsDistribute : 0;
                    $elementName = isset($row->ElementName) ? $row->ElementName : '';
                    $content = isset($row->Content) ? $row->Content : '';
                    $Level = isset($row->Level) ? $row->Level : '';
                    $EvaluationCriteria01 = isset($row->EvaluationCriteria01) ? $row->EvaluationCriteria01 : '';
                    $EvaluationCriteria02 = isset($row->EvaluationCriteria02) ? $row->EvaluationCriteria02 : '';
                    $EvaluationCriteria03 = isset($row->EvaluationCriteria03) ? $row->EvaluationCriteria03 : '';
                    $EvaluationCriteria04 = isset($row->EvaluationCriteria04) ? $row->EvaluationCriteria04 : '';
                    $EvaluationCriteria05 = isset($row->EvaluationCriteria05) ? $row->EvaluationCriteria05 : '';
                    $sql .= "--Insert bang tam" . PHP_EOL;
                    $sql .= " INSERT INTO  D09T6666 (UserID, HostID, FormID,Key01ID, Key02ID, Num01, Num02,Num03, Num04, Str01, Str02, Str03, Str04, Str05, Str06, Str07, Str08, Str09, Num05, Num06, Num07 )" . PHP_EOL;
                    $sql .= " VALUES   ('$userID', '$session', '$pForm', '$cboAppCriterionSetIDW39F2021',  '$ParentID', $i, $rate, $confim,$result,N'$elementName',N'$content',N'$noteCriterion','$appCriterionGroupID',N'$EvaluationCriteria01',N'$EvaluationCriteria02',N'$EvaluationCriteria03',N'$EvaluationCriteria04',N'$EvaluationCriteria05', $isEdit, $Level, '$isDistribute')" . PHP_EOL;
                    $i++;
                }
                $mode = 1;
                $sql .= "EXEC D39P5555 	'$divisionHR',  $tranMonth,  $tranYear, $lang, '$userID', '$session', $mode ,'W39F2021' , '$cboAppCriterionSetIDW39F2021', '', '' , '', ''" . PHP_EOL;
                \Debugbar::info($sql);
                try {
                    $rsData = $this->connectionHR->select($sql);
                    //\Debugbar::info($rsData[0]["Status"]);
                    if (intval($rsData[0]["Status"]) == 0) {
                        $EmpCriterionID = $this->CreateIGE($g, "D39T1000 ", "39", "CT");
                        $sql = "--Insert master" . PHP_EOL;
                        //$sql .= " BEGIN TRAN" . PHP_EOL;
                        $sql = "SET NOCOUNT ON" . PHP_EOL;
                        $sql .= " INSERT INTO D39T2015 (EmpCriterionID,Decription,AppCriterionSetID,ApprovalFlowID,ValidDateFrom,ValidDateTo,VoucherDate,EmployeeID,TotalResult, CreateUserID,CreateDate, LastModifyUserID, LastModifyDate)" . PHP_EOL;
                        $sql .= " VALUES ('$EmpCriterionID',N'$txtDecriptionW39F2021','$cboAppCriterionSetIDW39F2021','$cboApprovalFlowIDW39F2021',$txtValidDateFromW39F2021,$txtValidDateToW39F2021,$txtVoucherDateW39F2021, '$txtEmployeeIDW39F2021',$txtTotalResultW39F2021 ,'$userID', GetDate(), '$userID', GetDate())" . PHP_EOL;

                        $mode = 0;
                        $sql .= "--Thuc thi store luu" . PHP_EOL;
                        $sql .= " SET NOCOUNT ON" . PHP_EOL;
                        $sql .= "EXEC W39P2025 '$divisionHR', '$userID',  '$session', 'D39F2021' ,1, '$lang',$mode,	'$EmpCriterionID','$employeeIDHR'" . PHP_EOL;
                        //$sql .= "EXEC W39P2025 '$divisionHR', '$userID',  '$session', 'D39F2021' ,$mode,	'$EmpCriterionID','$employeeIDHR'" . PHP_EOL;
                        //$sql .= " ROLLBACK" . PHP_EOL;
                        \Debugbar::info($sql);
                        $this->connectionHR->statement($sql);
                        //Insert bang tam + ra quy trinh duyet
                        $sql = "--Xoa bang tam" . PHP_EOL;
                        //$sql .= " BEGIN TRAN" . PHP_EOL;
                        $sql .= " SET NOCOUNT ON" . PHP_EOL;
                        $sql .= "DELETE FROM D09T6666  WHERE UserID ='$userID' AND HostID ='$session' AND FormID = 'D39F2021'" . PHP_EOL;
                        $sql .= "--Insert bang tam" . PHP_EOL;
                        $sql .= " INSERT INTO D09T6666 (UserID, HostID, FormID,Key01ID)" . PHP_EOL;
                        $sql .= " VALUES ('$userID', '$session', '$pForm', '$EmpCriterionID')" . PHP_EOL;
                        $sql .= " -- Ra User va cap duyet tiep theo " . PHP_EOL;
                        $mode = 0;
                        $sql .= " EXEC D84P2020 '$companyID', '$g', 'D39', '', '$divisionHR', '$userID', '$session', 1, '$lang', $mode, 0, 0, 'W39F2021', '$EmpCriterionID' " . PHP_EOL;
                        //$sql .= " ROLLBACK" . PHP_EOL;
                        \Debugbar::info($sql);
                        $data = $this->connectionHR->select($sql);

                        //Xoa bang tam sau khi hoan thanh
                        $sql = "--Xoa bang tam" . PHP_EOL;
                        $sql .= "SET NOCOUNT ON" . PHP_EOL;
                        $sql .= "DELETE FROM D09T6666  WHERE UserID ='$userID' AND HostID ='$session' AND FormID = 'D39F2021'" . PHP_EOL;
                        $this->connectionHR->statement($sql);

                        if (count($data) > 0) {
                            $rs = $data[0];
                            \Debugbar::info($data);
                            if ($rs['IsSendMail'] == 1) {
                                if ($rs['IsShowMailScreen'] == 0) {
                                    $res = $this->SendMailAuto($rs['EmailContent'], $rs);
                                    return json_encode(['status' => 'BACKGROUND', 'name' => $rs['EmailReceivedAddress'], "message" => $res]); // đã gửi mail
                                } else {
                                    \Debugbar::info($rs);
                                    return json_encode(['status' => "SHOWMAIL", 'name' => $rs['EmailReceivedAddress'], 'data' => $rs, 'rsvalue' => View::make('layout.sendmail', compact('rs'))->render()]);
                                }
                            } else {
                                return json_encode(['status' => "NOSEND"]);  // không gửi mail
                            }
                        } else {
                            return json_encode(['status' => "NOSEND"]);  // không gửi mail
                        }

                    } else {
                        return json_encode(['status' => 'CHECKSTORE', "message" => $rsData[0]["Message"], 'data'=> $rsData[0]]);
                    }
                } catch (Exception $ex) {
                    return json_encode(['status' => 'ERROR', "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

                break;
            case 'update':
            case 'updateverify':
                \Debugbar::info($task);
                $txtDecriptionW39F2021 = $this->sqlstring(Input::get("txtDecriptionW39F2021", ""));
                $cboAppCriterionSetIDW39F2021 = $this->sqlstring(Input::get("cboAppCriterionSetIDW39F2021", ""));
                $txtValidDateFromW39F2021 = \Helpers::convertDate(Input::get("txtValidDateFromW39F2021", ""));
                $txtValidDateToW39F2021 = \Helpers::convertDate(Input::get("txtValidDateToW39F2021", ""));
                $cboApprovalFlowIDW39F2021 = $this->sqlstring(Input::get("cboApprovalFlowIDW39F2021", ""));
                $txtVoucherDateW39F2021 = \Helpers::convertDate(Input::get("txtVoucherDateW39F2021", ""));
                $txtEmployeeIDW39F2021 = $this->sqlstring(Input::get("txtEmployeeIDW39F2021", ""));
                $txtDepartmentNameW39F2021 = $this->sqlstring(Input::get("txtDepartmentNameW39F2021", ""));
                $txtEmployeeNameW39F2021 = $this->sqlstring(Input::get("txtEmployeeNameW39F2021", ""));
                $txtTotalResultW39F2021 = \Helpers::sqlNumber(Input::get("txtTotalResultW39F2021", ""));
                $txtEmployeeIDW39F2021 = $this->sqlstring(Input::get("txtEmployeeIDW39F2021", ""));
                $txtDepartmentNameW39F2021 = $this->sqlstring(Input::get("txtDepartmentNameW39F2021", ""));

                \Debugbar::info(Input::get("obj", []));
                $obj = json_decode(urldecode(Input::get("obj", [])));
                $EmpCriterionID = $obj[0]->EmpCriterionID;
                $sql = "--Xoa bang tam" . PHP_EOL;
                $sql .= "SET NOCOUNT ON" . PHP_EOL;
                $sql .= "DELETE FROM D09T6666  WHERE UserID ='$userID' AND HostID ='$session' AND FormID = 'D39F2021'" . PHP_EOL;

                $i = 0;
                \Debugbar::info($obj);
                foreach ($obj as $row) {
                    $ParentID = isset($row->ParentID) ? $row->ParentID : '';
                    //$appCriterionGroupID = isset($row->AppCriterionGroupID) ? $row->AppCriterionGroupID : '';
                    $appCriterionGroupID = isset($row->GroupID) ? $row->GroupID : '';
                    \Debugbar::info($appCriterionGroupID);
                    if($appCriterionGroupID == ""){// nếu là khoản trắng thì nhận khoản trắng
                        $appCriterionGroupID = $appCriterionGroupID;
                    }
                    if($appCriterionGroupID != ""){// nếu khác khoản trắng thì nhận AppCriterionGroupID
                        $appCriterionGroupID = isset($row->AppCriterionGroupID) ? $row->AppCriterionGroupID : '';
                    }
                    \Debugbar::info($appCriterionGroupID);
                    $rate = isset($row->Rate) ? $row->Rate : 0;
                    $isEdit = isset($row->IsEdit) ? $row->IsEdit : 0;
                    $confim = isset($row->Confim) ? $row->Confim : 0;
                    $result = isset($row->Result) ? $row->Result : 0;
                    $noteCriterion = isset($row->NoteCriterion) ? $row->NoteCriterion : '';
                    $isDistribute = isset($row->IsDistribute) ? $row->IsDistribute : 0;
                    $elementName = isset($row->ElementName) ? $row->ElementName : '';
                    $content = isset($row->Content) ? $row->Content : '';
                    $Level = isset($row->Level) ? $row->Level : '';
                    $EvaluationCriteria01 = isset($row->EvaluationCriteria01) ? $row->EvaluationCriteria01 : '';
                    $EvaluationCriteria02 = isset($row->EvaluationCriteria02) ? $row->EvaluationCriteria02 : '';
                    $EvaluationCriteria03 = isset($row->EvaluationCriteria03) ? $row->EvaluationCriteria03 : '';
                    $EvaluationCriteria04 = isset($row->EvaluationCriteria04) ? $row->EvaluationCriteria04 : '';
                    $EvaluationCriteria05 = isset($row->EvaluationCriteria05) ? $row->EvaluationCriteria05 : '';
                    $sql .= "--Insert bang tam" . PHP_EOL;
                    $sql .= " INSERT INTO  D09T6666 (UserID, HostID, FormID,Key01ID, Key02ID, Num01, Num02,Num03, Num04, Str01, Str02, Str03, Str04, Str05, Str06, Str07, Str08, Str09, Num05, Num06, Num07 )" . PHP_EOL;
                    $sql .= " VALUES   ('$userID', '$session', '$pForm', '$cboAppCriterionSetIDW39F2021',  '$ParentID', $i, $rate, $confim,$result,N'$elementName',N'$content',N'$noteCriterion','$appCriterionGroupID',N'$EvaluationCriteria01',N'$EvaluationCriteria02',N'$EvaluationCriteria03',N'$EvaluationCriteria04',N'$EvaluationCriteria05', $isEdit, $Level, '$isDistribute')" . PHP_EOL;
                    $i++;
                }
                $this->connectionHR->statement($sql);
                $mode = 1;
                $sql = "EXEC D39P5555 	'$divisionHR',  $tranMonth,  $tranYear, $lang, '$userID', '$session', $mode ,'W39F2021' , '$cboAppCriterionSetIDW39F2021', '', '' , '', ''" . PHP_EOL;

                try {
                    if($task != 'updateverify'){
                        $rsData = $this->connectionHR->select($sql);
                    }else{
                        $rsData[0]["Status"] = 0;
                    }
                    if (intval($rsData[0]["Status"]) == 0) {
                        //\Debugbar::info($sql);
                        if ($task == 'update'){
                            $sql = " --Cap nhat chi tieu danh gia" . PHP_EOL;
                            $sql .= " UPDATE D39T2015" . PHP_EOL;
                            $sql .= " SET Decription = N'$txtDecriptionW39F2021' ," . PHP_EOL;
                            $sql .= " ApprovalFlowID = '$cboApprovalFlowIDW39F2021' ," . PHP_EOL;
                            $sql .= " ValidDateFrom = $txtValidDateFromW39F2021," . PHP_EOL;
                            $sql .= " ValidDateTo = $txtValidDateToW39F2021, " . PHP_EOL;
                            $sql .= " LastModifyUserID = '$userID'," . PHP_EOL;
                            $sql .= " LastModifyDate = Getdate()" . PHP_EOL;
                            $sql .= " WHERE	EmpCriterionID = '$EmpCriterionID' " . PHP_EOL;
                            $this->connectionHR->statement($sql);
                        }
                        $mode = 2;
                        if ($task == 'updateverify'){
                            $mode = 3;
                        }
                        $sql = "--Thuc thi store luu" . PHP_EOL;
                        $sql .= "SET NOCOUNT ON" . PHP_EOL;
                        $sql .= "EXEC W39P2025 '$divisionHR', '$userID',  '$session', 'D39F2021' ,1, '$lang',$mode,	'$EmpCriterionID','$employeeIDHR'" . PHP_EOL;
                        \Debugbar::info($sql);
                        $this->connectionHR->statement($sql);
                        //Insert bang tam + ra quy trinh duyet
                        $sql = "--Xoa bang tam" . PHP_EOL;
                        $sql .= " SET NOCOUNT ON" . PHP_EOL;
                        $sql .= "DELETE FROM D09T6666  WHERE UserID ='$userID' AND HostID ='$session' AND FormID = 'D39F2021'" . PHP_EOL;
                        $sql .= "--Insert bang tam" . PHP_EOL;
                        $sql .= " INSERT INTO D09T6666 (UserID, HostID, FormID,Key01ID)" . PHP_EOL;
                        $sql .= " VALUES ('$userID', '$session', '$pForm', '$EmpCriterionID')" . PHP_EOL;
                        $sql .= " -- Ra User va cap duyet tiep theo " . PHP_EOL;
                        $mode = 2;
                        $sql .= " EXEC D84P2020 '$companyID', '$g', 'D39', '', '$divisionHR', '$userID', '$session', 1, '$lang', $mode, 0, 0, 'W39F2021', '$EmpCriterionID' " . PHP_EOL;
                        \Debugbar::info($sql);
                        $data = $this->connectionHR->select($sql);
                        if (count($data) > 0) {
                            $rs = $data[0];
                            \Debugbar::info($data);
                            if ($rs['IsSendMail'] == 1) {
                                if ($rs['IsShowMailScreen'] == 0) {
                                    $res = $this->SendMailAuto($rs['EmailContent'], $rs);
                                    return json_encode(['status' => 'BACKGROUND', 'name' => $rs['EmailReceivedAddress'], "message" => $res]); // đã gửi mail
                                } else {
                                    \Debugbar::info($rs);
                                    return json_encode(['status' => "SHOWMAIL", 'name' => $rs['EmailReceivedAddress'], 'data' => $rs, 'rsvalue' => View::make('layout.sendmail', compact('rs'))->render()]);
                                }
                            } else {
                                return json_encode(['status' => "NOSEND"]);  // không gửi mail
                            }
                        } else {
                            return json_encode(['status' => "NOSEND"]);  // không gửi mail
                        }
                    } else {
                        \Debugbar::info("go here");
                        return json_encode(['status' => 'CHECKSTORE', "message" => $rsData[0]["Message"] , 'data'=> $rsData[0]]);
                    }
                } catch (Exception $ex) {
                    return json_encode(['status' => 'ERROR', "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

                break;
            default:
                return "";
                break;
        }
    }

}
