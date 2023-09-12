<?php

namespace W2X\W25;

use Carbon\Carbon;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W2X\W2XController;

class W25F2085Controller extends W2XController
{
    public function index($pForm, $g, $task = '')
    {
        \Debugbar::info(Session::get("W91P0000"));
        $userID = Auth::user()->user()->UserID;
        $employeeID= Auth::user()->user()->HREmployeeID;
        $CreatorHR = $employeeID;//Session::get("W91P0000")['CreatorHR'];
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $session = Session::getId();
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $lang = Session::get('Lang');
        $perD25F2085 = Session::get($pForm);
        $perD25F2080 = $this->getPermission("D25F2080");
        $titleW25F2085 = $this->getModalTitle($pForm);
        \Debugbar::info($perD25F2085);
        switch ($task) {
            case '':
                $sql = " -- Combo Cap duyet".PHP_EOL;
                $sql .= " SELECT T1.ApprovalLevel ".PHP_EOL;
                $sql .= " FROM 	D84T2000 T1 WITH(NOLOCK)".PHP_EOL;
                $sql .= " INNER JOIN D84T1100 T2 WITH(NOLOCK)".PHP_EOL;
                $sql .= " ON T1.ApprovalFlowID = T2.ApprovalFlowID".PHP_EOL;
                $sql .= " WHERE T1.ApproverID = '$userID'".PHP_EOL;
                $sql .= " AND T2.TransactionID = 'D25KHTDTT'".PHP_EOL;
                $sql .= " AND T1.ApprovalLevel> 1".PHP_EOL;
                $sql .= " GROUP BY  T1.ApprovalLevel".PHP_EOL;
                $sql .= " ORDER BY 	T1.ApprovalLevel".PHP_EOL;
                $levels = $this->connectionHR->select($sql);


                $sql = " -- Combo Nam".PHP_EOL;
                $sql .= " SELECT YEAR ".PHP_EOL;
                $sql .= " FROM	D25T2081 WITH(NOLOCK)".PHP_EOL;
                $sql .= " WHERE	YEAR <>0".PHP_EOL;
                $sql .= " GROUP BY YEAR".PHP_EOL;
                $sql .= " ORDER BY YEAR DESC".PHP_EOL;
                $years = $this->connectionHR->select($sql);

                $statusList = $this->LoadFixData("ApprovalStatus", $g);
                $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, "%", 1, false, "");

                $sql = " -- Do nguon combo vi tri ung tuyen " . PHP_EOL;
                $sql .= " SELECT  DutyID As PositionID, DutyNameU AS PositionName, DutyDisplayOrder " . PHP_EOL;
                $sql .= " FROM  D09T0211  WITH(NOLOCK)  " . PHP_EOL;
                $sql .= " WHERE  Disabled = 0 " . PHP_EOL;
                $sql .= " ORDER BY DutyDisplayOrder, DutyName " . PHP_EOL;
                $positions = $this->connectionHR->select($sql);

                return View::make("W2X.W25.W25F2085", compact("perD25F2080","positions","years","departments","statusList","levels","perD25F2085","pForm", "g", "titleW25F2085"));
            break;
            case "filter":
                $moduleID = "D25";
                $approvalLevel = Input::get("cboLevelIDW25F2085",0);
                $year = Input::get("cboYearIDW25F2085","");
                $approvalStatus = Input::get("cbAppStatusIDW25F2085","");
                $departmentID = Input::get("cboDepartmentIDW25F2085","");
                $positionID = Input::get("cboPositionIDW25F2085","");

                $sql = " -- Do nguon cho luoi  " . PHP_EOL;
                $sql .= " EXEC W25P2085 '$moduleID', '$pForm', '$userID',  $approvalLevel, $year,$approvalStatus, '$departmentID','$positionID'  " . PHP_EOL;

                \Debugbar::info($sql);
                $rsData = [];
                $rsTemp = $this->connectionHR->select($sql);
                foreach ($rsTemp as $row){
                    $row["IsUpdate"] = 0;
                    \Debugbar::info($row);
                    array_push($rsData, $row);
                }

                return $rsData;
            case "save":
                if ($perD25F2085 >=2){
                    $obj = Input::get("data", []);
                    //$sql =" BEGIN TRAN ";
                    $sql =" SET NOCOUNT ON ";
                    $sql .= " -- Xoa bang tam".PHP_EOL;
                    $sql .= " DELETE FROM D09T6666".PHP_EOL;
                    $sql .= " WHERE UserID ='$userID'AND HostID ='$session' AND FormID = '$pForm'".PHP_EOL;

                    foreach ($obj as $row){
                        $TransID = $row["TransID"];
                        $ApprovalLevel = $row["ApprovalLevel"];
                        $IsApproval = $row["IsApproval"];
                        $NotApproval = $row["NotApproval"];
                        //$ApprovalNumber = number_format(\Helpers::sqlNumber($row["ApprovalNumber"]),0);
                        $ApprovalNumber = \Helpers::sqlNumber($row["ApprovalNumber"]);
                        $note = $this->sqlstring($row["Note"]);
                        $sql .= " -- Insert bang tam".PHP_EOL;
                        $sql .= " INSERT INTO D09T6666 (UserID, HostID, FormID, Key01ID, Num01,Num02,Num03,Num04, Str01) VALUES (".PHP_EOL;
                        $sql .= " '$userID','$session','$pForm','$TransID', $ApprovalLevel,$IsApproval,$NotApproval, $ApprovalNumber, N'$note')".PHP_EOL;
                    }

                    $sql .= " -- Luu khi duyet".PHP_EOL;
                    $sql .= "  EXEC D84P4002 '$divisionHR', 'D25', '$pForm', '$userID', '', 0, null, '', '', '$session'".PHP_EOL;

                    $sql .= " -- Ra quy trinh duyet cap tiep theo".PHP_EOL;
                    $sql .= "  EXEC D84P2020 '$companyID', '$g', 'D25', '', '$divisionHR', '$userID', '$session',".PHP_EOL;
                    $sql .= "  1, '$lang', 1, 0, 0, '$pForm', ''".PHP_EOL;
                    //$sql .=" ROLLBACK";

                    if ($sql != "") {
                        try {
                            $data = $this->connectionHR->select($sql);
                            if (count($data) > 0){
                                $rs = $data[0];
                                if($rs['IsSendMail']==1)
                                {
                                    if($rs['IsShowMailScreen']==0)
                                    {
                                        $res = $this->SendMailAuto($rs['EmailContent'],$rs);
                                        return json_encode(['status' => 'BACKGROUND', 'name' => $rs['EmailReceivedAddress'],"message"=>$res]); // đã gửi mail
                                    }
                                    else
                                    {
                                        return json_encode(['status' => "SHOWMAIL", 'name' => $rs['EmailReceivedAddress'], 'data'=> $rs, 'rsvalue' => View::make('layout.sendmail',compact('rs'))->render()]);
                                    }
                                }
                                else
                                {
                                    return json_encode(['status' => "NOSEND"]);  // không gửi mail
                                }
                            }else{
                                return json_encode(['status' => "NOSEND"]);  // không gửi mail
                            }
                        } catch (Exception $ex) {
                            return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                        }
                    }
                }else{
                    return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Ban_khong_co_quyen_thuc_hien_chuc_nang_nay")]);
                }

                break;
            case "deletetmp":
                $sql = " -- Xoa bang tam".PHP_EOL;
                $sql .= " DELETE FROM D09T6666".PHP_EOL;
                $sql .= " WHERE UserID ='$userID'AND HostID ='$session' AND FormID = '$pForm'".PHP_EOL;
                $this->connectionHR->statement($sql);
        }

    }

    public function viewFromMail($pForm,$g,$isApproval=0,$id='',$iddt='') {
        \Debugbar::info(Session::get("W91P0000"));
        $userID = Auth::user()->user()->UserID;
        $employeeID= Auth::user()->user()->HREmployeeID;
        $CreatorHR = $employeeID;//Session::get("W91P0000")['CreatorHR'];
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $session = Session::getId();
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $lang = Session::get('Lang');
        $perD25F2085 = Session::get($pForm);
        $perD25F2080 = $this->getPermission("D25F2080");
        $titleW25F2085 = $this->getModalTitle($pForm);
        \Debugbar::info($perD25F2085);

        //----------------------------------------------------------
        $sql = " -- Combo Cap duyet".PHP_EOL;
        $sql .= " SELECT T1.ApprovalLevel ".PHP_EOL;
        $sql .= " FROM 	D84T2000 T1 WITH(NOLOCK)".PHP_EOL;
        $sql .= " INNER JOIN D84T1100 T2 WITH(NOLOCK)".PHP_EOL;
        $sql .= " ON T1.ApprovalFlowID = T2.ApprovalFlowID".PHP_EOL;
        $sql .= " WHERE T1.ApproverID = '$userID'".PHP_EOL;
        $sql .= " AND T2.TransactionID = 'D25KHTDTT'".PHP_EOL;
        $sql .= " AND T1.ApprovalLevel> 1".PHP_EOL;
        $sql .= " GROUP BY  T1.ApprovalLevel".PHP_EOL;
        $sql .= " ORDER BY 	T1.ApprovalLevel".PHP_EOL;
        $levels = $this->connectionHR->select($sql);


        $sql = " -- Combo Nam".PHP_EOL;
        $sql .= " SELECT YEAR ".PHP_EOL;
        $sql .= " FROM	D25T2081 WITH(NOLOCK)".PHP_EOL;
        $sql .= " WHERE	YEAR <>0".PHP_EOL;
        $sql .= " GROUP BY YEAR".PHP_EOL;
        $sql .= " ORDER BY YEAR DESC".PHP_EOL;
        $years = $this->connectionHR->select($sql);

        $statusList = $this->LoadFixData("ApprovalStatus", $g);
        $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, "%", 1, false, "");

        $sql = " -- Do nguon combo vi tri ung tuyen " . PHP_EOL;
        $sql .= " SELECT  DutyID As PositionID, DutyNameU AS PositionName, DutyDisplayOrder " . PHP_EOL;
        $sql .= " FROM  D09T0211  WITH(NOLOCK)  " . PHP_EOL;
        $sql .= " WHERE  Disabled = 0 " . PHP_EOL;
        $sql .= " ORDER BY DutyDisplayOrder, DutyName " . PHP_EOL;
        $positions = $this->connectionHR->select($sql);

        return View::make("W2X.W25.W25F2085", compact("perD25F2080","positions","years","departments","statusList","levels","perD25F2085","pForm", "g", "titleW25F2085"));
    }
}
