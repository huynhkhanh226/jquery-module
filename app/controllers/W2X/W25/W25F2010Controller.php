<?php
namespace W2X\W25;

use Auth;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W2X\W2XController;
use Debugbar;

;

class W25F2010Controller extends W2XController
{
    public function index($pForm, $action, $tranid, $statusid)
    {
        \Debugbar::info("index");
        \Debugbar::info($pForm);
        $modalTitle = $this->getModalTitle($pForm);
        $departmentID = Session::get("W91P0000")['DepartmentID'];
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $UserID = Auth::user()->user()->UserID;
        \Debugbar::info($departmentID);
        $perW25F2010 = $this->getPermission("D09F5650");
        \Debugbar::info($perW25F2010);
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $lang = Session::get('Lang');
        $recPos = "";
        $department = $this->LoadDepartmentByG4($pForm, $HRDivisionID, '%', 0, true,'');
        if ($perW25F2010 <=2){
            \Debugbar::info("<=2");
            $teams = $this->LoadTeamByG4($pForm, $HRDivisionID, Session::get("W91P0000")['DepartmentID'], 0);
        }else{
            \Debugbar::info(">2");
            $teams = $this->LoadTeamByG4($pForm, $HRDivisionID, $department[0]["DepartmentID"], 0);
        }

        //$team = $this->LoadTeamByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 0);
        $cls = '';
        //=============================================
        $sql = "-- Do nguon combo vi tri tuyen dung" . PHP_EOL;
        $sql .= "SELECT	DutyID As PositionID, DutyNameU AS PositionName, DutyDisplayOrder" . PHP_EOL;
        $sql .= "FROM	D09T0211  WITH(NOLOCK)" . PHP_EOL;
        $sql .= "WHERE	Disabled = 0" . PHP_EOL;
        $sql .= "ORDER BY DutyDisplayOrder, DutyName";
        $positionid = $this->connectionHR->select($sql);
        //=============================================
        $sql = "--Do nguon combo hinh thuc lam viec" . PHP_EOL;
        $sql .= "SELECT WorkingStatusID,WorkingStatusNameU  as WorkingStatusName" . PHP_EOL;
        $sql .= "FROM D09T0070 WITH(NOLOCK)" . PHP_EOL;
        $sql .= "WHERE Disabled = 0" . PHP_EOL;
        $sql .= "ORDER BY WorkingStatusName";
        $workingstatus = $this->connectionHR->select($sql);
        //=============================================
        $sql = "--Do nguon combo cong viec" . PHP_EOL;
        $sql .= "SELECT WorkID, WorkNameU as WorkName FROM D09T0224  WITH(NOLOCK)" . PHP_EOL;
        $sql .= "WHERE Disabled = 0 ORDER BY WorkName";
        $workid = $this->connectionHR->select($sql);
        //=============================================
        $sql = "--Trinh do giao duc pho thong" . PHP_EOL;
        $sql .= "SELECT EducationLevelID, EducationLevelNameU as EducationLevelName " . PHP_EOL;
        $sql .= "FROM D09T0206 WITH(NOLOCK)" . PHP_EOL;
        $sql .= "WHERE Disabled=0 ORDER BY EducationLevelName";
        $education = $this->connectionHR->select($sql);
        //=============================================
        $sql = "--Trinh do chuyen mon" . PHP_EOL;
        $sql .= "Select ProfessionalLevelID, ProfessionalLevelNameU as ProfessionalLevelName" . PHP_EOL;
        $sql .= "From D09T0205 WITH(NOLOCK) Where Disabled=0" . PHP_EOL;
        $sql .= "Order By ProfessionalLevelName";
        $prolevel = $this->connectionHR->select($sql);
        //=============================================
        $sql = "--don vi tien te" . PHP_EOL;
        $sql .= "SELECT CurrencyID, CurrencyNameU As CurrencyName" . PHP_EOL;
        $sql .= "FROM D91T0010" . PHP_EOL;
        $sql .= "WHERE Disabled = 0" . PHP_EOL;
        $sql .= "ORDER BY CurrencyName";
        $currency = $this->connectionHR->select($sql);
        //=============================================
        $sql = "--Loai hop dong" . PHP_EOL;
        $sql .= "Select ContractCategoryID As ContractTypeID , ContractCategoryName".$lang."U As ContractTypeName" . PHP_EOL;
        $sql .= "From D09V2223" . PHP_EOL;
        $sql .= "Order by ContractCategoryID";
        $contractType = $this->connectionHR->select($sql);
        //=============================================
        if ($perW25F2010 <=2){
            //\Debugbar::info("<=2");
            $sql = "--ke hoach tong the" . PHP_EOL;
            $sql .= "EXEC W25P2013 '$HRDivisionID', '$UserID', '$tranMonth', '$tranYear', '$departmentID'";
            //$department = $this->LoadDepartmentByG4($pForm, $HRDivisionID, '%', 0, true,'');
        }else{
            //\Debugbar::info(">2");
            $sql = "--ke hoach tong the" . PHP_EOL;
            $sql .= "EXEC W25P2013 '$HRDivisionID', '$UserID', '$tranMonth', '$tranYear', ''";
            //$department = $this->LoadDepartmentByG4($pForm, $HRDivisionID, '%', 0, true,'');
        }

        $planTrans = $this->connectionHR->select($sql);


        $g=4;

        if ($action == "view") {
            \Debugbar::info("da chay vao view");
            $sql = "--Do nguon cho form" . PHP_EOL;
            $sql .= "EXEC W25P2010 '" . Session::get("W91P0000")['HRDivisionID'] . "', '" . Auth::user()->user()->UserID . "', '$tranid', " . Session::get("W91P0000")['HRTranMonth'] . ", " . Session::get("W91P0000")['HRTranYear'];
            $rData = $this->connectionHR->selectOne($sql);
            $rData["SalaryFrom"] = (float) $rData["SalaryFrom"];
            $rData["SalaryTo"] =  (float) $rData["SalaryTo"];
            $cls = "disabled";
            \Debugbar::info($rData);
            $recPos = $rData['RecPositionID'];
        }

        //=============================================
        $sql1 = "--Dem so luong file dinh kem" .PHP_EOL;
        $sql1 .= "EXEC D91P1010 '$HRDivisionID', 'D09T0211', '$recPos', '', '', '', ''" .PHP_EOL;
        \Debugbar::info($sql1);
        $fileNumber = $this->connectionHR->select($sql1);
        \Debugbar::info($fileNumber);
        return View::make("W2X.W25.W25F2010", compact('fileNumber','perW25F2010','modalTitle', 'pForm', 'action', 'tranid', 'statusid','teams', 'rData', 'department', 'cls','departmentID', 'positionid', 'workingstatus', 'workid', 'education','currency','contractType','planTrans', 'prolevel','g'));
    }

    public function actionData($pForm, $mode)
    {
        \Debugbar::info($mode);
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $division = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $UserID = Auth::user()->user()->UserID;
        $user = Auth::user()->User()->UserID;
        $planTransID = Input::get('slPlanTransID');
        $contractTypeID = Input::get('slContractTypeID');
        $dateJoined = Helpers::convertDate(Input::get('txtDateJoined'));
        $workingPlace = Input::get('txtWorkingPlace');
        $salaryFrom = Input::get('txtSalaryFrom');
        $salaryTo = Input::get('txtSalaryTo');
        $currencyID = Input::get('slCurrencyID');
        $input = Input::all();
        $IGE = "";
        if($mode == "countFile"){
            \Debugbar::info(Input::all());
            $recPos = Input::get('recPos');
            $sql = "--Dem so luong file dinh kem" .PHP_EOL;
            $sql .= "EXEC D91P1010 '$HRDivisionID', 'D09T0211', '$recPos', '', '', '', ''" .PHP_EOL;
            \Debugbar::info($sql);
            $fileNumber = $this->connectionHR->select($sql);
            \Debugbar::info($fileNumber);
            return $fileNumber;
        }
        elseif($mode == "2"){
            \Debugbar::info("da chay plan");
            $planTrans = Input::get('plan');
            $transID = Input::get('transID');

           /* $sql="--Do nguon sau khi chon ke hoach phong van".PHP_EOL;
            $sql.="EXEC W25P2014 '$HRDivisionID', '$UserID', '$planTrans' ";
            $rs1 =$this->connectionHR->select($sql);*/

            $sql1 ="--Do nguon vi tri tuyen dung".PHP_EOL;
            $sql1 .="EXEC W25P2015 '$HRDivisionID', '$UserID', '$planTrans' ";
            $rs2 = $this->connectionHR->select($sql1);

            $strRecPosition = "<option value=''></option>";
            foreach ($rs2 as $row) {
                $strRecPosition .= "<option value='" . $row["RecPositionID"] . "'>" . $row["RecPositionName"] . "</option>";
            }

            \Debugbar::info($strRecPosition);
            $planChange = array(
                "plansID" => $planTrans,
                //"formValue" => $rs1,
                "recPos" => $strRecPosition
            );
            return $planChange;
        }
        elseif($mode == "1"){
            $recPos = Input::get('recPos');
            $planTrans = Input::get('plan');
            $sql="--Do nguon sau khi chon vi tri tuyen dung".PHP_EOL;
            $sql.="EXEC W25P2012 '$HRDivisionID', '$UserID', $tranMonth ,$tranYear, '$recPos' ";
            $rs1 =$this->connectionHR->select($sql);
          //  \Debugbar::info($sql);
           \Debugbar::info($rs1);

            //$recPos = Input::get('recPos');
            $sql1 = "--Dem so luong file dinh kem" .PHP_EOL;
            $sql1 .= "EXEC D91P1010 '$HRDivisionID', 'D09T0211', '$recPos', '', '', '', ''" .PHP_EOL;
            \Debugbar::info($sql1);
            $fileNumber = $this->connectionHR->select($sql1);
            \Debugbar::info($fileNumber);

            $sql2 ="--Do nguon sau khi chon ke hoach phong van".PHP_EOL;
            $sql2 .="EXEC W25P2014 '$HRDivisionID', '$UserID', '$planTrans', '$recPos' ";
            $rs2 =$this->connectionHR->select($sql2);

            if(intval($fileNumber[0]["Count"] == 0)){
                $str = '<button type="button" id="btnFileW25F2010" onclick= "loadW09F4010()" class="btn btn-default smallbtn pull-right" disabled>';
                $str .= '<span class="glyphicon glyphicon-paperclip"></span> '.Helpers::getRS(4,"Dinh_kem").'('.intval($fileNumber[0]["Count"]).')';
                $str .= '</button>';
            }else{
                $str = '<button type="button" id="btnFileW25F2010" onclick= "loadW09F4010()" class="btn btn-default smallbtn pull-right">';
                $str .= '<span class="glyphicon glyphicon-paperclip"></span> '.Helpers::getRS(4,"Dinh_kem").'('.intval($fileNumber[0]["Count"]).')';
                $str .= '</button>';
            }
            $sender = array(
                0 => $rs1,
                1 => $str,
                "formValue" => $rs2
            );

            return $sender;
        }
        elseif ($mode == "0") //?? ngu?n combo TeamID
        {
            $dep = Input::get('dep');
            \Debugbar::info($dep);
            $rs = $this->LoadTeamByG4($pForm, $division, $dep, 0);
            $strTeam = "<option value=''></option>";
            foreach ($rs as $row) {
                $strTeam .= "<option value='" . $row["TeamID"] . "'>" . $row["TeamName"] . "</option>";
            }

            $sql = "--ke hoach tong the" . PHP_EOL;
            $sql .= "EXEC W25P2013 '$HRDivisionID', '$UserID', '$tranMonth', '$tranYear', '$dep'";
            $planTrans = $this->connectionHR->select($sql);
            \Debugbar::info($planTrans);
            $strPlan = "<option value=''></option>";
            foreach ($planTrans as $row) {
                $strPlan .= "<option value='" . $row["PlanTransID"] . "'>" . $row["PlanTransName"] . "</option>";
            }
            $valueCombos = array(
                "plans" => $strPlan,
                "teams" => $strTeam,
                "dep" => $dep
            );

            return $valueCombos;
        } elseif ($mode == "view") {
           //\Debugbar::info("anh bao");
            $optRType = $input["optRecruitmentType"]=='false'?0:1;
            $statusvoucher=1;
            $IGE = $input["hdTransID"];
            if(isset($input["chkStatusVoucher"]))
                $statusvoucher = $input["chkStatusVoucher"]=='false'?1:0;
            $sql = "--Sua nghiep vu" . PHP_EOL;
            $sql .= "set nocount on Update D25T2001 Set ";
            $sql .= "DepartmentID = '" . Input::get("slDepartmentID",'') . "', ";
            $sql .= "TeamID = '" . Input::get("slTeamID",'') . "', ";
            $sql .= "RecpositionID = '" . Input::get("slRecpositionID",'') . "', ";
            $sql .= "RecruitmentType = $optRType, ";
            $sql .= "WorkingStatusID = '" . Input::get("slWorkingStatusID",'') . "', ";
            $sql .= "WorkID = '', ";
            $sql .= "ProNumber = " .intval($input["txtProNumber"]) . ", ";
            $sql .= "MaleQuan = " . intval($input["txtMaleQuan"]) . ", ";
            $sql .= "FemaleQuan = " . intval($input["txtFemaleQuan"]) . ", ";
            $sql .= "DateFrom = '" . $input["datefrom"] . "', ";
            $sql .= "DateTo = '" . $input["dateto"] . "', ";
            $sql .= "InterviewDate = " .Helpers::convertDate($input["txtInterviewDate"]) . ", ";
            $sql .= "ReasonRequest = N'" . $this->sqlstring($input["txtReasonRequest"]). "', ";
            $sql .= "AgeFrom = " . intval($input["txtAgeFrom"]) . ", ";
            $sql .= "AgeTo = " . intval($input["txtAgeTo"]) . ", ";
            $sql .= "EducationLevelID = '" . $input["slEducationLevelID"] . "', ";
            $sql .= "ProfessionalLevelID = '" . $input["slProfessionalLevelID"] . "', ";
            $sql .= "ComputerSkills = N'" .$this->sqlstring( $input["txtComputerSkills"]) . "', ";
            $sql .= "EnglishLevel = N'" . $this->sqlstring($input["txtEnglishLevel"]) . "', ";
            $sql .= "Capability = N'" . $this->sqlstring($input["txtCapability"]) . "', ";
            $sql .= "Appearence = N'" . $this->sqlstring($input["txtAppearence"]) . "', ";
            $sql .= "Personality = N'" . $this->sqlstring($input["txtPersonality"]) . "', ";
            $sql .= "Priority = N'" . $this->sqlstring($input["txtPriority"]) . "', ";
            $sql .= "Experienced = N'" . $this->sqlstring($input["txtExperienced"]) . "', ";
            $sql .= "OtherRequest = N'" . $this->sqlstring($input["txtOtherRequest"]) . "', ";
            $sql .= "DescriptionU = N'" . $this->sqlstring($input["txtDescription"]) . "', ";
            $sql .= "ProNoteU = N'" . $this->sqlstring($input["txtProNote"]) . "', ";
            $sql .= "StatusVoucher = $statusvoucher,";
            $sql .= "LastModifyDate = Getdate(), ";
            $sql .= "LastModifyUserID = '$user', ";
            $sql .= "PlanTransID = '$planTransID', ";
            $sql .= "ContractTypeID = '$contractTypeID', ";
            $sql .= "DateJoined = $dateJoined, ";
            $sql .= "WorkPlace = N'$workingPlace', ";
            $sql .= "SalaryFrom = ".intval($salaryFrom).", ";
            $sql .= "SalaryTo = ".intval($salaryTo).", ";
            $sql .= "CurrencyID = '$currencyID'". PHP_EOL;
            $sql .= "Where TransID='" . $input["hdTransID"] . "'" . PHP_EOL;
           /* $sql .= "--Insert bang tam de ra quy trinh duyet va tra du lieu goi mail". PHP_EOL;
            $sql .= "DELETE D09T6666 WHERE UserID = '$user' AND  HostID ='WEB' AND FormID = 'W25F2010'". PHP_EOL;
            $sql .= "INSERT INTO D09T6666 (UserID, HostID, FormID, Key01ID, Key02ID)". PHP_EOL;
            $sql .= "VALUES ('$user', 'WEB', 'W25F2010', '$IGE', $optRType)". PHP_EOL;

            $sql .="--Ra User va cap duyet tiep theo".PHP_EOL;
            $sql .= "EXEC D84P2020 '". Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'))."','4','D25','','$division','$user','WEB', 1, '".Session::get('Lang')."','2','0','0','D25F2020','" . $input["hdTransID"] . "','',1";*/
            Debugbar::info($sql);
        } elseif ($mode == "add") {
            //\Debugbar::info($salaryTo);
            $sql1 = "";
            \Debugbar::info($input);
            $IGE = $this->CreateIGE(4, "D25T2001", "25", "RE");
            $optRType = $input["optRecruitmentType"]=='false'?0:1;
            $statusvoucher=1;
            //\Debugbar::info("hello");
            //\Debugbar::info($input["chkStatusVoucher"]);
            if(isset($input["chkStatusVoucher"]))
                $statusvoucher = $input["chkStatusVoucher"]=='false'?1:0;
            //Debugbar::info("hello");
            $sql = "--Luu nghiep vu" . PHP_EOL;
            $sql .= "set nocount on INSERT INTO D25T2001 (";
            $sql .= "TransID, TranMonth, TranYear, DivisionID,";
            $sql .= "DepartmentID, TeamID, RecpositionID, RecruitmentType,";
            $sql .= "WorkingStatusID, WorkID, ProNumber, MaleQuan,";
            $sql .= "FemaleQuan, DateFrom, DateTo, StatusVoucher,";
            $sql .= "InterviewDate, ReasonRequest, AgeFrom, AgeTo,";
            $sql .= "EducationLevelID, ProfessionalLevelID, ComputerSkills,";
            $sql .= "EnglishLevel, Capability, Appearence, Personality,";
            $sql .= "Priority, Experienced, OtherRequest, DescriptionU,";
            $sql .= "ProNoteU, VoucherDate, CreatorID, CreateDate,";
            $sql .= "CreateUserID, LastModifyDate, LastModifyUserID, PlanTransID, ContractTypeID, DateJoined, WorkPlace, SalaryFrom, SalaryTo, CurrencyID)";
            $sql .= "VALUES ('$IGE'," . Session::get("W91P0000")['HRTranMonth'] . ", " . Session::get("W91P0000")['HRTranYear'] . ", '$division',";
            $sql .= "'" . Input::get('slDepartmentID') . "','" . $input["slTeamID"] . "', '" . $input["slRecpositionID"] . "', $optRType,";
            $sql .= "'" . $input["slWorkingStatusID"] . "','', " . intval($input["txtProNumber"]) . ", " . intval($input["txtMaleQuan"]) . ",";
            $sql .= "'" . intval($input["txtFemaleQuan"]) . "','" . $input["datefrom"] . "', '" . $input["dateto"] . "', $statusvoucher, ";
            $sql .= Helpers::convertDate($input["txtInterviewDate"]). ", N'" . $this->sqlstring($input["txtReasonRequest"]) . "', " . intval($input["txtAgeFrom"]) . ", " . intval($input["txtAgeTo"]) . ",";
            $sql .= "'" . $input["slEducationLevelID"] . "', N'" . $input["slProfessionalLevelID"] . "', N'" . $this->sqlstring($input["txtComputerSkills"]) . "', ";
            $sql .= "N'" . $this->sqlstring($input["txtEnglishLevel"]) . "', N'" . $this->sqlstring($input["txtCapability"]) . "', N'" . $this->sqlstring($input["txtAppearence"]) . "', N'" . $this->sqlstring($input["txtPersonality"]) . "', ";
            $sql .= "N'" . $this->sqlstring($input["txtPriority"]) . "', N'" . $this->sqlstring($input["txtExperienced"]) . "', N'" . $this->sqlstring($input["txtOtherRequest"]) . "', N'" . $this->sqlstring($input["txtDescription"]) . "', ";
            $sql .= "N'" . $this->sqlstring($input["txtProNote"]) . "', Getdate(), '" . Session::get("W91P0000")['CreatorHR'] . "', Getdate(), ";
            $sql .= "'$user', Getdate(), '$user', '$planTransID', '$contractTypeID', $dateJoined, N'$workingPlace', ".intval($salaryFrom).",".intval($salaryTo).",'$currencyID')". PHP_EOL;
            \Debugbar::info($statusvoucher);
            //if(intval($statusvoucher) == 0){///Da hoan tat
                $sql .= "-- Insert bang tam de ra quy trinh duyet va tra du lieu goi mail". PHP_EOL;
                $sql .= "DELETE D09T6666 WHERE UserID = '$user' AND  HostID ='WEB' AND FormID = 'W25F2010'". PHP_EOL;
                $sql .= "INSERT INTO D09T6666 (UserID, HostID, FormID, Key01ID, Key02ID)". PHP_EOL;
                $sql .= "VALUES ('$user', 'WEB', 'W25F2010', '$IGE', $optRType)". PHP_EOL;

                $sql .="--Ra User va cap duyet tiep theo".PHP_EOL;
                $sql .= "EXEC D84P2020 '". Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'))."','4','D25','','$division','$user','WEB', 1, '".Session::get('Lang')."','0','0','0','D25F2020','$IGE','',1";
            //}

        }
        elseif ($mode == "delete")
        {
            $IGE = $input["trans"];
            $sql = "--Xoa du lieu" . PHP_EOL;
            $sql .= "EXEC W25P2011 '".Session::get("W91P0000")['HRDivisionID']."','".Auth::user()->user()->UserID."',".Session::get("W91P0000")['HRTranMonth'].",".Session::get("W91P0000")['HRTranYear'].",'W25F2010','$IGE'";
           return intval($this->connectionHR->statement($sql));
        }


        try {
            $rData = [];
            //if(intval($statusvoucher) == 0){
                Debugbar::info($sql);
                Debugbar::info($mode);
                if ($mode=="view")
                {
                    $this->connectionHR->statement($sql);
                    $sql1 = "--Do nguon cho form" . PHP_EOL;
                    $sql1 .= "EXEC W25P2010 '$division', '$user', '$IGE', " . Session::get("W91P0000")['HRTranMonth'] . ", " . Session::get("W91P0000")['HRTranYear'];
                    $rData = $this->connectionHR->selectOne($sql1);
                    \Debugbar::info($rData);
                    return json_encode(array_merge(['rs' => 3, 'name' =>'', "key"=>$IGE],$rData));// kh�ng g?i mail
                }
                //Debugbar::info($rs);
                if ($mode=="add"){
                    Debugbar::info($sql);
                    $rs = $this->connectionHR->select($sql);
                    Debugbar::info($rs);
                    $rs = $rs[0];
                    Debugbar::info($rs);
                    if (isset($rs['IsSendMail']))//có trả ra dữ liệu từ store
                    {
                        if($rs['IsSendMail']==1) {
                            if($rs['IsShowMailScreen']==0) {
                                $res = $this->SendMailAuto($rs['EmailContent'],$rs);
                                return json_encode(array_merge(['rs' => 1,'message'=>$res, "key"=>$IGE],$rData)); // ?� g?i mail
                            }
                            else {
                                return json_encode(array_merge(['rs' => 2, "key"=>$IGE, 'rsvalue' => View::make('layout.sendmail',compact('rs'))->render()],$rData));
                            }
                        }
                    }
                    return json_encode(array_merge(['rs' => 3, 'name' =>'', "key"=>$IGE],$rData));// kh�ng g?i mail
                }

           /* }else{
                Debugbar::info($sql);
                $this->connectionHR->statement($sql);
                if ($mode=="view")
                {
                    $sql = "--Do nguon cho form" . PHP_EOL;
                    $sql .= "EXEC W25P2010 '$division', '$user', '$IGE', " . Session::get("W91P0000")['HRTranMonth'] . ", " . Session::get("W91P0000")['HRTranYear'];
                    $rData = $this->connectionHR->selectOne($sql);
                    \Debugbar::info($rData);
                }
                return json_encode(array_merge(['rs' => 3, 'name' =>'', "key"=>$IGE],$rData));// kh�ng g?i mail
            }*/
        } catch (Exception $ex) {
            Debugbar::info($ex->getMessage());
            return json_encode(['rs' => 0, 'name' =>'']);  // kh�ng g?i mail
        }
    }
}
