<?php

namespace W0X\W09;

use Auth;
use Carbon\Carbon;
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
use Jenssegers\Agent\Agent;

class W09F2001Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {
        //$agent = new Agent();
        //$agent = Request::getClientIp();
        //\Debugbar::info($agent);
        //$ip = $_SERVER;
        //\Debugbar::info($ip);

        $titleW09F2001 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        \Debugbar::info(Session::get("W91P0000"));
        $employeeIDHR = Auth::user()->user()->HREmployeeID;
        $perD09F5650 = $this->getPermission("D09F5650");
        $perD09F2000 = Session::get($pForm);
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $session = Session::getId();
        switch ($task) {
            case "add":
                $blockList = $this->LoadBlockByG4($divisionHR, $userID, $pForm, true);
                $blockID = $perD09F5650 <= 2 ? Session::get("W91P0000")['BlockID'] : $blockList[0]["BlockID"];
                $departmentList = $this->LoadDepartmentByG4($pForm, $divisionHR, "$blockID", true, true, "");
                $departmentID = $perD09F5650 <= 2 ? Session::get("W91P0000")['DepartmentID'] : $departmentList[0]["DepartmentID"];
                $teamList = $this->LoadTeamByG4($pForm, $divisionHR, $departmentID, true);

                //$departmentList = [];
                //$teamList = [];
                $workList = $this->LoadWorkbyG4(true);
                $contractTypeList = $this->LoadContractCategoryG4(true);

                $sql = "--Lay danh sach cot dong" . PHP_EOL;
                $sql .= " set nocount on SELECT	Code, ShortU as CaptionName, Disabled, Decimals" . PHP_EOL;
                $sql .= " From		D13T9000" . PHP_EOL;
                $sql .= " Where	Type='SALBA'" . PHP_EOL;
                $sql .= " Order by	Code" . PHP_EOL;
                $rsTemp = $this->connectionHR->select($sql);
                $rsColumns = [];
                foreach ($rsTemp as $row) {
                    $code = $row["Code"];
                    //$r = Helpers::arraySearch($rsTemp, "Code", $code);
                    $row["Field"] = "BaseSalary" . substr($code, strlen($code) - 2, strlen($code));
                    array_push($rsColumns, $row);
                }
                $rsDetailData = [];
                return View::make("W0X.W09.W09F2001", compact('perD09F2000', 'perD09F5650', 'task', 'rsDetailData', 'lang', 'rsColumns', 'contractTypeList', 'workList', 'teamList', 'departmentList', 'blockList', 'g', 'pForm', 'titleW09F2001'));
                break;

            case 'edit':
            case "view":
                $SalaryProposalID = Input::get("salaryProposalID", "");
                //--------------get Master-------------
                $sql = " -- Do nguon master" . PHP_EOL;
                $sql .= " EXEC W09P2011 0, '$userID', '$SalaryProposalID' " . PHP_EOL;
                $rsMasterData = $this->connectionHR->select($sql);
                //--------------get Detail ------------
                //$status = Input::get("status", 0);
                $Mode = 1;
                $BlockID = "";
                $DepartmentID = "";
                $TeamID = "";
                $StrEmployeeID = "";
                $StrEmployeeName = "";
                $WorkFormID = "";
                $Seniority = 0;
                $sql = "-- Do nguon load luoi" . PHP_EOL;
                $sql .= " EXEC W09P2001 '$divisionHR', $tranMonth, $tranYear,'$BlockID','$DepartmentID','$TeamID','$StrEmployeeID',N'$StrEmployeeName','$WorkFormID','',$Seniority, '$SalaryProposalID',$Mode,'$userID','$pForm'" . PHP_EOL;
                $rsDetailData = $this->connectionHR->select($sql);
                $blockList = $this->LoadBlockByG4($divisionHR, $userID, $pForm, true);
                $blockID = $rsMasterData[0]["BlockID"];
                $departmentList = $this->LoadDepartmentByG4($pForm, $divisionHR, "$blockID", true, true, "");
                $departmentID = $rsMasterData[0]["DepartmentID"];
                $teamList = $this->LoadTeamByG4($pForm, $divisionHR, $departmentID, true);

                //$departmentList = [];
                //$teamList = [];
                $workList = $this->LoadWorkbyG4(true);
                $contractTypeList = $this->LoadContractCategoryG4(true);

                $sql = "--Lay danh sach cot dong" . PHP_EOL;
                $sql .= " set nocount on SELECT	Code, ShortU as CaptionName, Disabled, Decimals" . PHP_EOL;
                $sql .= " From		D13T9000" . PHP_EOL;
                $sql .= " Where	Type='SALBA'" . PHP_EOL;
                $sql .= " Order by	Code" . PHP_EOL;
                $rsTemp = $this->connectionHR->select($sql);
                $rsColumns = [];
                foreach ($rsTemp as $row) {
                    $code = $row["Code"];
                    //$r = Helpers::arraySearch($rsTemp, "Code", $code);
                    $row["Field"] = "BaseSalary" . substr($code, strlen($code) - 2, strlen($code));
                    array_push($rsColumns, $row);
                }


                //--------------------------------------
                return View::make("W0X.W09.W09F2001", compact('perD09F2000', 'perD09F5650', 'task', 'rsMasterData', 'rsDetailData', 'lang', 'rsColumns', 'contractTypeList', 'workList', 'teamList', 'departmentList', 'blockList', 'g', 'pForm', 'titleW09F2001'));
                break;

            case 'reloaddepartment':
                $blockID = Input::get("blockID", "%");
                $departmentList = $this->LoadDepartmentByG4($pForm, $divisionHR, "$blockID", true, true, "");
                $str = "";
                foreach ($departmentList as $row) {
                    $str .= '<option value="' . $row['DepartmentID'] . '">' . $row['DepartmentName'] . '</option>';
                }
                return $str;
                break;
            case 'reloadteam':
                $departmentID = Input::get("departmentID", "%");
                $teamList = $this->LoadTeamByG4($pForm, $divisionHR, $departmentID, true);
                $str = "";
                foreach ($teamList as $row) {
                    $str .= '<option value="' . $row['TeamID'] . '">' . $row['TeamName'] . '</option>';
                }
                return $str;
                break;
            case 'filter':
                //\Debugbar::info(Input::get("txtSeniorityW09F2001",0));
                $BlockID = Input::get("cboBlockIDW09F2001", "");
                $DepartmentID = Input::get("cboDepartmentIDW09F2001", "");
                $TeamID = Input::get("cbTeamIDW09F2001", "");
                $StrEmployeeID = Input::get("txtEmployeeIDW09F2001", "");
                $StrEmployeeName = Input::get("txtEmployeeNameW09F2001", "");
                $WorkFormID = Input::get("cbWorkIDW09F2001", "");
                $ContractTypeIDW09F2001 = Input::get("cboContractTypeIDW09F2001", "");


                $Seniority = Input::get("txtSeniorityW09F2001", 0) == "" ? 0 : Input::get("txtSeniorityW09F2001", 0);
                $SalaryProposalID = Input::get("", "");
                //$status = Input::get("status", 0);
                $Mode = Input::get("status", 0);


                $sql = "-- Do nguon load luoi" . PHP_EOL;
                $sql .= " EXEC W09P2001 '$divisionHR', $tranMonth, $tranYear,'$BlockID','$DepartmentID','$TeamID','$StrEmployeeID',N'$StrEmployeeName','$WorkFormID', '$ContractTypeIDW09F2001',$Seniority, '$SalaryProposalID',$Mode,'$userID','$pForm'" . PHP_EOL;

                $rsDetailData = $this->connectionHR->select($sql);
                return ($rsDetailData);
                break;

            case 'save':
            case 'update':
                if ($task == "save") {
                    $SalaryProposalID = $this->CreateIGE($g, 'D09T2000', '09', 'SP');
                } else {//task == update
                    $SalaryProposalID = Input::get("salaryProposalID", "");
                }

                $txtSalaryProposalNameW09F2001 = $this->sqlstring(Input::get("txtSalaryProposalNameW09F2001", ""));
                $txtValidDateW09F2001 = Helpers::convertDate(Input::get("txtValidDateW09F2001", ""));
                $txtProNoteW09F2001 = $this->sqlstring(Input::get("txtProNoteW09F2001", ""));
                $txtReasonNameW09F2001 = $this->sqlstring(Input::get("txtReasonNameW09F2001", ""));
                $obj = json_decode(Input::get("obj", "[]"));
                //\Debugbar::info(json_decode( Input::get("obj")));
                $VoucherDate = Helpers::convertDate(Input::get("voucherDate", ""));
                $ProposerID = Input::get("proposerID", "");
                $cboDepartmentIDW09F2001 = Input::get("cboDepartmentIDW09F2001", "");
                $cboTeamIDW09F2001 = Input::get("cboTeamIDW09F2001", "");
                $ProNumber = count($obj);
                $Disabled = 0;
                $Approved = 0;
                $AppNumber = 0;
                $CreateUserID = $userID;
                $CreateDate = Carbon::now();
                $LastModifyUserID = $userID;
                $LastModifyDate = Carbon::now();


                $sql = " " . PHP_EOL;
                //$sql .= " BEGIN TRAN " . PHP_EOL;
                $sql .= " SET NOCOUNT ON" . PHP_EOL;
                if ($task == "save") {
                    $sql .= "--Insert du lieu cho master" . PHP_EOL;
                    $sql .= " INSERT INTO D09T2000	(TranMonth,TranYear,VoucherDate," . PHP_EOL;
                    $sql .= " SalaryProposalID,SalaryProposalNameU,SAValidDate,ReasonU, ProposerID,DivisionID,DepartmentID," . PHP_EOL;
                    $sql .= " TeamID,ProNoteU,ProNumber,Disabled,Approved,AppNumber,CreateUserID,CreateDate,LastModifyUserID,LastModifyDate, PlanApproverID) " . PHP_EOL;
                    $sql .= " VALUES 	($tranMonth, $tranYear, $VoucherDate," . PHP_EOL;
                    $sql .= " '$SalaryProposalID', N'$txtSalaryProposalNameW09F2001',$txtValidDateW09F2001 , N'$txtReasonNameW09F2001', '$ProposerID', '$divisionHR', '$cboDepartmentIDW09F2001'," . PHP_EOL;
                    $sql .= " '$cboTeamIDW09F2001', N'$txtProNoteW09F2001', $ProNumber, $Disabled, $Approved, $AppNumber, '$CreateUserID', '$CreateDate', '$LastModifyUserID', '$LastModifyDate','')" . PHP_EOL;

                } else {//task == update
                    $sql .= "--Update master" . PHP_EOL;
                    $sql .= " UPDATE D09T2000" . PHP_EOL;
                    $sql .= " SET SAValidDate = $txtValidDateW09F2001," . PHP_EOL;
                    $sql .= " SalaryProposalNameU = N'$txtSalaryProposalNameW09F2001'," . PHP_EOL;
                    $sql .= " ReasonU = N'$txtReasonNameW09F2001', " . PHP_EOL;
                    //$sql .= " PlanAppDate = null, " . PHP_EOL;
                    //$sql .= " PlanApproverID = '', " . PHP_EOL;
                    //$sql .= " DivisionID = '$divisionHR', " . PHP_EOL;
                    //$sql .= " DepartmentID = '$cboDepartmentIDW09F2001', " . PHP_EOL;
                    //$sql .= " TeamID = '$cboTeamIDW09F2001', " . PHP_EOL;
                    $sql .= " ProNoteU = N'$txtProNoteW09F2001', " . PHP_EOL;
                    //$sql .= " ProNumber = $ProNumber," . PHP_EOL;
                    $sql .= " LastModifyUserID = '$LastModifyUserID', " . PHP_EOL;
                    $sql .= " LastModifyDate = '$LastModifyDate'" . PHP_EOL;
                    $sql .= " WHERE	SalaryProposalID = '$SalaryProposalID'" . PHP_EOL;

                }

                foreach ($obj as $row) {
                    if ($task == "save") {
                        $ProTransID = $this->CreateIGENewS($g, 'D09T2001', '09', 'PT', '', count($obj), '');
                    } else {
                        $ProTransID = $row->ProTransID;
                    }

                    $EmployeeID = $row->EmployeeID;
                    $BaseSalary01 = Helpers::sqlNumber($row->BaseSalary01);
                    $BaseSalary02 = Helpers::sqlNumber($row->BaseSalary02);
                    $BaseSalary03 = Helpers::sqlNumber($row->BaseSalary03);
                    $BaseSalary04 = Helpers::sqlNumber($row->BaseSalary04);
                    $NewBaseSalary01 = Helpers::sqlNumber($row->NewBaseSalary01);
                    $NewBaseSalary02 = Helpers::sqlNumber($row->NewBaseSalary02);
                    $NewBaseSalary03 = Helpers::sqlNumber($row->NewBaseSalary03);
                    $NewBaseSalary04 = Helpers::sqlNumber($row->NewBaseSalary04);
                    $IsNotApprove = 0;

                    if ($task == "save") {
                        $sql .= "--Insert du lieu cho detail" . PHP_EOL;
                        $sql .= " INSERT INTO D09T2001(" . PHP_EOL;
                        $sql .= " ProTransID, SalaryProposalID, EmployeeID, BaseSalary01, BaseSalary02, BaseSalary03, BaseSalary04," . PHP_EOL;
                        $sql .= " NewBaseSalary01, NewBaseSalary02, NewBaseSalary03, NewBaseSalary04,NoticeU,ReasonU,ValidDate,IsNotApprove)" . PHP_EOL;
                        $sql .= " VALUES 	(" . PHP_EOL;
                        $sql .= " '$ProTransID', '$SalaryProposalID', '$EmployeeID', $BaseSalary01, $BaseSalary02, $BaseSalary03, $BaseSalary04," . PHP_EOL;
                        $sql .= " $NewBaseSalary01, $NewBaseSalary02, $NewBaseSalary03, $NewBaseSalary04, N'$txtProNoteW09F2001', N'$txtReasonNameW09F2001',$txtValidDateW09F2001,$IsNotApprove" . PHP_EOL;
                        $sql .= " )" . PHP_EOL;

                    } else {//task == update
                        $sql .= "--Update detail" . PHP_EOL;
                        $sql .= " UPDATE D09T2001" . PHP_EOL;
                        $sql .= " SET NewBaseSalary01 = $NewBaseSalary01," . PHP_EOL;
                        $sql .= " NewBaseSalary02 = $NewBaseSalary02," . PHP_EOL;
                        $sql .= " NewBaseSalary03 = $NewBaseSalary03, " . PHP_EOL;
                        $sql .= " NewBaseSalary04 = $NewBaseSalary04 ," . PHP_EOL;

                        $sql .= " ValidDate = $txtValidDateW09F2001," . PHP_EOL;
                        $sql .= " ReasonU = N'$txtReasonNameW09F2001', " . PHP_EOL;
                        $sql .= " NoticeU = N'$txtProNoteW09F2001' " . PHP_EOL;
                        $sql .= " WHERE	ProTransID = '$ProTransID'" . PHP_EOL;


                    }
                }

                if ($task == "save") {
                    $mode = 0;
                } else {//task == update
                    $mode = 2;
                }
                $sql .= " -- Ra User va cap duyet tiep theo " . PHP_EOL;
                $sql .= " EXEC D84P2020 '$companyID', '$g', 'D09', 'W09F2002', '$divisionHR', '$userID', '$session', 1, '$lang', $mode, 0, 1, 'D09F2000', '$SalaryProposalID' " . PHP_EOL;
                //$sql .= " ROLLBACK " . PHP_EOL;

                \Debugbar::info($sql);
                if ($sql != "") {
                    try {
                        $data = $this->connectionHR->select($sql);
                        \Debugbar::info($data);
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
                    } catch (Exception $ex) {
                        return json_encode(['status' => 'ERROR', 'name' => '', "message" => Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }
                break;
        }
    }


}
