<?php
namespace W3X\W38;

use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W3X\W3XController;
use Debugbar;

class W38F2000Controller extends W3XController
{
    public function index($pForm, $g, $probathid = '', $proposalid = '', $status = 0)
    {
        $UserID = Auth::user()->user()->UserID;
        //$lang = Session::get('Lang');
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $session = Session::getId();
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $cbApprovalFlow = $this->LoadtdbcApprovalFlow($divisionHR, $UserID, $session, $pForm);
        \Debugbar::info($cbApprovalFlow);
        $cbTransID = $this->LoadtdbcTransID($divisionHR, $UserID, $session, $pForm, $tranMonth, $tranYear);
        \Debugbar::info($cbTransID);
        $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);

        $trainfields = $this->LoadtdbcTrainingField();//linh vuc DT

        $currencies = $this->LoadCurrencyIDData(false); // loai tien
        $proposals = $this->LoadtdbcProposerID($pForm);
        $hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
        if ($probathid != "" && $proposalid != "") { //Truong hop them moi
            $sql = "--Do nguon cho master" . PHP_EOL;
            $sql .= " EXEC W38P2000	'$probathid','$proposalid',1";
            $dataMasterW38F2000 = $this->connectionHR->select($sql);
            \Debugbar::info($dataMasterW38F2000);
            if (count($dataMasterW38F2000) > 0){
                $team = $this->LoadTeamByG4($pForm, Session::get("W91P0000")['HRDivisionID'], $dataMasterW38F2000[0]["DepartmentID"], 1);
                $traincourses = $this->LoadtdbcTrainingCourse($dataMasterW38F2000[0]["TrainingFieldID"],'');
            }else{
                $team = $this->LoadTeamByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '', 1);
                $traincourses = $this->LoadtdbcTrainingCourse('%','');
            }

        }else{
            $team = $this->LoadTeamByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '', 1);
            $traincourses = $this->LoadtdbcTrainingCourse('%','');
        }
        return View::make("W3X.W38.W38F2000", compact("pForm", "g","status", "probathid", "proposalid",'cbApprovalFlow','cbTransID', "dataMasterW38F2000", "department", "team", "trainfields", "traincourses", "currencies", "proposals","hr_employee_id"));
    }

    public function ReloadCombo($pForm, $g, $name)
    {
        $UserID = Auth::user()->user()->UserID;
        $session = Session::getId();
        //$lang = Session::get('Lang');
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        \Debugbar::info($name);
        if($name == "TransID"){
            \Debugbar::info(Input::all());
            $tranID = Input::get('slTransIDW38F2000');
            $sql = "--Default gia tri sau khi chon ke hoach dao tao".PHP_EOL;
            $sql .= "EXEC W38P2006  '$divisionHR','$tranID', '$UserID','$session' , '$pForm','','',0";
            \Debugbar::info($sql);
            $str2006 = $this->connectionHR->select($sql);

            $sql1 = "--Do nguon linh vuc dao tao".PHP_EOL;
            $sql1 .= "EXEC W38P2005	'$divisionHR', '$UserID', 'TrainingField', '%', '%', '$tranID'";
            //\Debugbar::info($sql1);
            $rs1 = $this->connectionHR->select($sql1);
            \Debugbar::info($rs1);
            $strTranField = "<option value = '%'></option>";
            foreach ($rs1 as $row) {
                $strTranField .= "<option value='" . $row["TrainingFieldID"] . "'>" . $row["TrainingFieldName"] . "</option>";
            }

            $sql2 = "--Do nguon danh sach khoa dao tao".PHP_EOL;
            $sql2 .= "EXEC W38P2005	'$divisionHR', '$UserID', 'TrainingCourse', '%', '%', '$tranID'";
            \Debugbar::info($sql2);
            $rs2 = $this->connectionHR->select($sql2);
            //$strTranCourse = "<option value = ''></option>";
            $strTranCourse = "";

            if($tranID == ''){//khi ko chọn combo kế hoạch ĐT
                foreach ($rs2 as $row) {
                    $strTranCourse .= "<option value='" . $row["TrainingCourseID"] . "'>" . $row["TrainingCourseName"] . "</option>";
                }
            }else{
                foreach ($rs2 as $row) {
                    $strTranCourse .= "<option proTransID = '". $row["ProTransID"] ."' proposalID = '". $row["ProposalID"] ."' value='" . $row["TrainingCourseID"] . "'>" . $row["TrainingCourseName"] . "</option>";
                }
            }

            $str = array(
                0 => $str2006,
                1 => $strTranField,
                2 => $strTranCourse
            );

            \Debugbar::info($str);
        }
        if ($name == "team") {
            $value = Input::get('cboDepartmentID');
            $rs = $this->LoadTeamByG4($pForm, Session::get("W91P0000")['HRDivisionID'], $value, 1);
            $str = "<option value = ''></option>";
            foreach ($rs as $row) {
                $str .= "<option value='" . $row["TeamID"] . "'>" . $row["TeamName"] . "</option>";
            }
        } elseIf ($name == "trainingcourse") {
            $value = Input::get('cboTrainingFieldID');
           /* if($value == ''){
                $value = '%';
            }*/
            $tranID = Input::get('slTransIDW38F2000');
            \Debugbar::info($value);
            $rs = $this->LoadtdbcTrainingCourse($value, $tranID);
            /*$sql = "--Do nguon danh sach khoa dao tao".PHP_EOL;
            $sql .= "EXEC W38P2005	'$divisionHR', '$UserID', 'TrainingCourse', '$value', '%', '$tranID'";
            \Debugbar::info($sql);
            $rs = $this->connectionHR->select($sql);*/
            //$str = "<option value = ''></option>";
            $str = '';
            if($tranID == ''){//khi ko chọn combo kế hoạch ĐT
                foreach ($rs as $row) {
                    $str .= "<option value='" . $row["TrainingCourseID"] . "'>" . $row["TrainingCourseName"] . "</option>";
                }
            }else{
                foreach ($rs as $row) {
                    $str .= "<option proTransID = '". $row["ProTransID"] ."' proposalID = '". $row["ProposalID"] ."' value='" . $row["TrainingCourseID"] . "'>" . $row["TrainingCourseName"] . "</option>";
                }
            }
        }elseIf ($name == "defaultvalue") {
            \Debugbar::info(Input::all());
            $cboTrainingFieldID = Input::get('cboTrainingFieldID');
            $cboTrainingCourseID = Input::get('cboTrainingCourseID');
            $slTransIDW38F2000 = Input::get('slTransIDW38F2000');
            $ProposalID = Input::get('ProposalID');
            $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;

            /*$sql = "--Default gia tri sau khi chon khoa dao tao" . PHP_EOL;
            $sql .= " EXEC W38P2005	'$divisionHR','$userid','DetailTraningCourse','$cboTrainingFieldID','$cboTrainingCourseID'";*/
            $sql = "--Default gia tri sau khi chon khoa dao tao" . PHP_EOL;
            $sql .= "EXEC W38P2006 	'$divisionHR', '$slTransIDW38F2000', '$UserID', '$session', 'D38F2000','$ProposalID', '$cboTrainingCourseID',1";
            \Debugbar::info($sql);
            $str = json_encode($this->connectionHR->select($sql));
        }
        return $str;
    }

    public function Loadtdbg($pForm, $g)
    {
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $probatchid = Input::get('probatchid');
        $proposalid = Input::get('proposalid');
        $trainingcourseid = Input::get('trainingcourseid');
        $sql = "--Do nguon cho luoi" . PHP_EOL;
        $sql .= "EXEC W38P2001	'$divisionhr','$userid','D38F3000',1,'$probatchid','$proposalid','$trainingcourseid'";
        $dataW38F2000 = $this->connectionHR->select($sql);
        return View::make("W3X.W38.W38F2000_Ajax", compact('pForm', 'g', 'dataW38F2000'));
    }

    public function SaveMaster($pForm, $g, $probathid, $proposalid, $status)
    {
        $all = Input::all();
        \Debugbar::info($all);
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];
        $txtProposalName = isset($all['txtProposalName']) ? $this->sqlstring($all['txtProposalName']) : "";
        $txtProNumber = str_replace(",", "", isset($all['txtProNumber']) ? $all['txtProNumber'] : 0);
        $txtTrainingPeriod = \Helpers::sqlNumber($all['txtTrainingPeriod']);
        $txtTrainningEmpName = isset($all['txtTrainningEmpName']) ? $this->sqlstring($all['txtTrainningEmpName']): "";
        $txtContent =isset($all['txtContent']) ?$this->sqlstring($all['txtContent']): "";
        $txtTrainingPurpose =isset($all['txtTrainingPurpose']) ?$this->sqlstring($all['txtTrainingPurpose']): "";
        $txtProCost = str_replace(",", "",isset($all['txtProCost']) ? $all['txtProCost'] : 0);
        $txtProExchangeRate = str_replace(",", "", isset($all['txtProExchangeRate']) ? $all['txtProExchangeRate']:0);
        $txtProCCost = str_replace(",", "", isset($all['txtProCCost'] ) ? $all['txtProCCost'] : 0);
        $txtProNote =isset($all['txtProNote']) ?$this->sqlstring($all['txtProNote']): "";
        $txtAddress =isset($all['txtAddress']) ?$this->sqlstring($all['txtAddress']): "";
        $cboProposerID = isset($all['cboProposerID']) ? $all['cboProposerID']: "";
        $cboDepartmentID = isset($all['cboDepartmentID']) ? $all['cboDepartmentID']: "";
        $cboTeamID = isset($all['cboTeamID']) ? $all['cboTeamID']: "";
        $cboTrainingFieldID = isset($all['cboTrainingFieldID']) ? $all['cboTrainingFieldID']: "";
        $cboTrainingCourseID = isset($all['cboTrainingCourseID']) ? $all['cboTrainingCourseID']: "";
        $cboApprovalFlowID = isset($all['cboApprovalFlowIDW38F2000']) ? $all['cboApprovalFlowIDW38F2000']: "";
        $slTransIDW38F2000 = isset($all['slTransIDW38F2000']) ? $all['slTransIDW38F2000']: "";
        $cboProCurrencyID =isset($all['cboProCurrencyID']) ? $all['cboProCurrencyID']: "";
        $idFromDate =isset($all['idFromDate']) ? date("m/d/Y",  strtotime(str_replace('/', '-',$all['idFromDate']))): date("m/d/Y");// date("m/d/Y", strtotime(str_replace('/', '-',isset($all['idFromDate']) ? $all['idFromDate'] : date())));
        $idToDate =isset($all['idToDate']) ? date("m/d/Y",  strtotime(str_replace('/', '-',$all['idToDate']))): date("m/d/Y");// date("m/d/Y", strtotime(str_replace('/', '-',isset($all['idToDate']) ? $all['idToDate'] : date() )));
        $chkIsInternal = isset($all['chkIsInternal'])  ? $all['chkIsInternal'] : 0;
        $idProposalDate =  \Helpers::convertDate(Input::get('idProposalDate',''));
      //  $hdCreateUserIDW38F2000 =isset($all['hdCreateUserIDW38F2000'])  ? $all['hdCreateUserIDW38F2000']:$userid ;
      //  $hdCreateDateW38F2000 = isset($all['hdCreateDateW38F2000']) ? date("m/d/Y h:i:s",  strtotime(str_replace('/', '-',$all['hdCreateDateW38F2000']))): date("m/d/Y h:i:s");// date("m/d/Y", strtotime(str_replace('/', '-', isset($all['hdCreateDateW38F2000']) ? $all['hdCreateDateW38F2000'] : date())));

        if ($proposalid == "-1") { //Mode them moi
            $probathid = $this->CreateIGE($g, 'D38T2000', '38', 'PB');
            $proposalid = $this->CreateIGE($g, 'D38T2000', '38', 'PR');

            $sql = "--Insert master" . PHP_EOL;
            $sql .= " INSERT INTO D38T2000(";
            $sql .= " TranMonth, TranYear, ProposalID,";
            $sql .= " ProposalNameU, ProposalDate,";
            $sql .= " ProposerID, DivisionID, DepartmentID,";
            $sql .= " TeamID, ProNumber, ProCost, ProCurrencyID,";
            $sql .= " TrainingFieldID, FromDate, ToDate, TrainingCourseID,";
            $sql .= " TrainingPurposeU, ProNoteU, Disabled,";
            $sql .= " CreateUserID, CreateDate, LastModifyUserID, LastModifyDate,";
            $sql .= " ProExchangeRate, ProCCost,";
            $sql .= " ProBatchID, VoucherDate,IsInternal, TrainingPeriod,";
            $sql .= " TrainningEmpNameU, ContentU, TransID, Address, ApprovalFlowID)";
            $sql .= " VALUES(";
            $sql .= " $tranmonth, $tranyear, '$proposalid',";
            $sql .= " N'$txtProposalName', $idProposalDate,";
            $sql .= " '$cboProposerID', '$divisionhr', '$cboDepartmentID',";
            $sql .= " '$cboTeamID', $txtProNumber, $txtProCost, '$cboProCurrencyID',";
            $sql .= " '$cboTrainingFieldID', '$idFromDate',  '$idToDate', '$cboTrainingCourseID',";
            $sql .= " N'$txtTrainingPurpose', N'$txtProNote', 0,";
            $sql .= " '$userid', getdate(), '$userid',  getdate(),";
            $sql .= " $txtProExchangeRate, $txtProCCost,";
            $sql .= " '$probathid', getdate(), $chkIsInternal, $txtTrainingPeriod,";
            $sql .= " N'$txtTrainningEmpName', N'$txtContent', '$slTransIDW38F2000', N'$txtAddress', '$cboApprovalFlowID')";
        } else {
            $sql = "--Cap nhat de xuat dao tao" . PHP_EOL;
            if ($status == 0){//Chua duyet
                $sql .= " UPDATE	D38T2000";
                $sql .= " SET		TranMonth = $tranmonth,";
                $sql .= " TranYear = $tranyear,";
                $sql .= " ProposalNameU = N'$txtProposalName',";
                $sql .= " ProposerID = '$cboProposerID',";
                $sql .= " DivisionID = '$divisionhr',";
                $sql .= " DepartmentID = '$cboDepartmentID',";
                $sql .= " TeamID = '$cboTeamID',";
                $sql .= " ProNumber = '$txtProNumber',";
                $sql .= " ProCost = $txtProCost,";
                $sql .= " ProCurrencyID = '$cboProCurrencyID',";
                $sql .= " TrainingFieldID = '$cboTrainingFieldID',";
                $sql .= " FromDate = '$idFromDate',";
                $sql .= " ToDate = '$idToDate',";
                $sql .= " TrainingCourseID = '$cboTrainingCourseID',";
                $sql .= " TrainingPurposeU = N'$txtTrainingPurpose',";
                $sql .= " ProNoteU = N'$txtProNote',";
//                $sql .= " Disabled = 0, ";
//                $sql .= " CreateUserID = '$hdCreateUserIDW38F2000',";
//                $sql .= " CreateDate = '$hdCreateDateW38F2000',";
                $sql .= " LastModifyUserID = '$userid',";
                $sql .= " LastModifyDate = getdate(),";
                $sql .= " ProExchangeRate = $txtProExchangeRate,";
                $sql .= " ProCCost = $txtProCCost, ";
                $sql .= " VoucherDate = $idProposalDate, ";
                $sql .= " IsInternal = $chkIsInternal,";
                $sql .= " TrainingPeriod = $txtTrainingPeriod,";
                $sql .= " TrainningEmpNameU = N'$txtTrainningEmpName',";
                $sql .= " ContentU = N'$txtContent',";

                $sql .= " TransID  = '$slTransIDW38F2000',";
                $sql .= " Address  = N'$txtAddress',";
                $sql .= " ApprovalFlowID  = '$cboApprovalFlowID'";
                $sql .= " WHERE	ProposalID = '$proposalid' AND ProBatchID = '$probathid'";
            }else{//da duyet
                $sql .= " UPDATE D38T2000 ";
                $sql .= " SET ProposalNameU = N'$txtProposalName' ";
                $sql .= " WHERE ProposalID = '$proposalid'";
            }
        }
        try {
            \Debugbar::info($sql);
            $this->connectionHR->statement($sql);
            return $proposalid;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function SaveDetail($pForm, $g, $mode)
    {
        $details = Input::get('obj');
        $ProposalID = Input::get('ProposalID');
        $TrainingCourseID = Input::get('TrainingCourseID');
        $CompanyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $UserID = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $language = Session::get('Lang');
        $oldIGE = "";
        $count = count($details);
        $firsttran = "";
        $sql = "--Them nhan vien vao trong khoa dao tao";
        $sql .= " SET NOCOUNT ON" . PHP_EOL;
        if (Input::get('hdStatus') <> 1){//truong hop dang duyet
            $sql .= " DELETE FROM D38T2001 WHERE ProposalID = '$ProposalID'" . PHP_EOL;
        }
        if (count($details)>0){
            if (Input::get('hdStatus') <> 1){ //truong hop dang duyet
                foreach ($details as $key => $row) {
                    $ProTransID = $this->CreateIGENewS($g, 'D38T2001', '38', 'PT', $oldIGE, $count, $firsttran);
                    $EmployeeID = $row["EmployeeID"];
                    $sql .= " INSERT INTO D38T2001(ProposalID, ProTransID, EmployeeID, TrainingCourseID, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate, ModuleID)";
                    $sql .= " VALUES ('$ProposalID', '$ProTransID', '$EmployeeID', '$TrainingCourseID', '$UserID', getdate(), '$UserID',  getdate(), '38')" . PHP_EOL;
                }
            }
        }
        $sql .= "--Xoa record trong bang D09T6666" . PHP_EOL;
        $sql .= " DELETE FROM D09T6666 WHERE UserID = '$UserID' AND FormID = 'D38F2000'" . PHP_EOL;
        $sql .= "--Insert du lieu vao D09T6666" . PHP_EOL;
        $sql .= " INSERT INTO D09T6666(UserID, HostID, FormID, Key01ID) VALUES('$UserID','WEB', 'D38F2000', '$ProposalID')" . PHP_EOL;
        $this->connectionHR->statement($sql);
        $sql = "--Goi tinh nang send mail" . PHP_EOL;
        $sql .= " EXEC D84P2020	'$CompanyID','4','D38','D38F2000','$divisionhr','$UserID','WEB',1,'$language',$mode,0,0,'D38F2000','$ProposalID','',1" . PHP_EOL;
        $data = $this->connectionHR->select($sql);

        $sql1 = "DELETE FROM D09T6666 WHERE UserID = '$UserID' AND FormID = 'W38F2000'";
        $this->connectionHR->statement($sql1);
        \Debugbar::info($data);
        if (count($data) > 0) {
            $rs = $data[0];
            if ($rs['IsSendMail'] == 1) {
                if ($rs['IsShowMailScreen'] == 0) {
                    $res = $this->SendMailAuto($rs['EmailContent'], $rs);
                    return json_encode(['CODE' => 1, 'name' => $rs['EmailReceivedAddress'], "message" => $res, "key"=>$ProposalID,"receivedUserName"=>$rs["ReceivedUserName"]]); // ?� g?i mail
                } else {
                    return json_encode(['CODE' => 2, 'name' => $rs['EmailReceivedAddress'], "key"=>$ProposalID, 'rsvalue' => View::make('layout.sendmail', compact('rs'))->render()]);
                }
            } else {
                return json_encode(['CODE' => 3, 'name' => '', "key"=>$ProposalID]);  // kh�ng g?i mail
            }
        } else {
            return json_encode(['CODE' => 3, 'name' => '', "key"=>$ProposalID]);  // kh�ng g?i mail
        }
    }

    public function Close($pForm, $g)
    {
        $UserID = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $this->connectionHR->statement("DELETE FROM D09T6666 WHERE UserID = '$UserID' AND FormID =  'D38F3000'");
    }
}
