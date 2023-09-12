<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 20/11/2017
 * Time: 4:03 PM
 */

namespace W3X\W38;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use Helpers;
use W3X\W3XController;

class W38F2041Controller extends W3XController
{
    public function index($pForm, $g, $task = '')
    {
        \Debugbar::info($pForm);
        $userID = Auth::user()->user()->UserID;
        $employeeID = Auth::user()->user()->HREmployeeID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $creatorName = Session::get("W91P0000")['CreatorNameHR'];
        $creatorID = Session::get("W91P0000")['CreatorHR'];
        \Debugbar::info($creatorID);
        $perW38F2041 = $this->getPermission("D09F5650"); //Phân quyền cho combo phòng bạn
        \Debugbar::info($perW38F2041);
        $perW38F2042 = Session::get($pForm); //Phân quyền cho form
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $UserID = Auth::user()->user()->UserID;
        $session = Session::getId();
        $lang = Session::get('Lang');
        switch ($task) {
            case 'add':
                $titleW38F2041 = $this->getModalTitle($pForm);
                $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, '%', 0, true,'');
                $teams = array();
                $rsData = array();
                if ($perW38F2041 <=2){
                    //\Debugbar::info("<=2");
                    $teams = $this->LoadTeamByG4($pForm, $divisionHR, Session::get("W91P0000")['DepartmentID'], 0);
                }else{
                    //\Debugbar::info(">2");
                    $teams = $this->LoadTeamByG4($pForm, $divisionHR, $departments[0]["DepartmentID"], 0);
                }

                //khoảng trắng
                $blankSpace = array(
                    "TrainingFieldID" => "%",
                    "TrainingFieldName" => ""
                );

                $sql = "--Do nguon linh vuc dao tao" .PHP_EOL;
                $sql .= "EXEC W38P2005 '$divisionHR','$userID', 'TrainingField','',''";
                $cbTrainingField = $this->connectionHR->select($sql);

                //chèn khoản trắng vào combo
                array_unshift($cbTrainingField, $blankSpace);

                $sql1 = "--Do nguon khoa dao tao" .PHP_EOL;
                $sql1 .= "EXEC W38P2005 '$divisionHR','$userID', 'TrainingCourse','%','%'";
                $cbTrainingCourses = $this->connectionHR->select($sql1);

                $sql2 = "--Do nguon combo tien te" .PHP_EOL;
                $sql2 .= "SELECT CurrencyID,CurrencyNameU AS CurrencyName,ExchangeRate,Operator,MethodID,OriginalDecimal,ExchangeRateDecimal, UnitPriceDecimals".PHP_EOL;
                $sql2 .= "FROM D91V0010".PHP_EOL;
                $sql2 .= "WHERE Disabled = 0".PHP_EOL;
                $sql2 .= "ORDER BY CurrencyID".PHP_EOL;
                $cbCurrency = $this->connectionHR->select($sql2);

                $sql3 = "--do nguon combo quy trinh duyet".PHP_EOL;
                $sql3 .= "SELECT T2.ApprovalFlowID, T2.ApprovalFlowNameU AS ApprovalFlowName".PHP_EOL;
                $sql3 .= "FROM D84T1100 T2".PHP_EOL;
                $sql3 .= "WHERE	T2.TransactionID = 'D38KHDTTT' AND [Disabled] = 0".PHP_EOL;
                $sql3 .= "AND (T2.ValiddateFrom IS NULL OR CONVERT(VARCHAR(20), T2.ValiddateFrom, 111) <= CONVERT(VARCHAR(20), GETDATE(), 111))".PHP_EOL;
                $sql3 .= "AND (T2.ValiddateTo IS NULL OR CONVERT(VARCHAR(20), T2.ValiddateTo, 111) >= CONVERT(VARCHAR(20), GETDATE(), 111))".PHP_EOL;
                $cbApprovalFlowID = $this->connectionHR->select($sql3);

                $sql4 = "--do nguon cho luoi" .PHP_EOL;
                $sql4 .= "EXEC W38P2041 '$divisionHR', '$userID', 'D38F2042' ,''";
                \Debugbar::info($sql4);
                $valueGrid = json_encode([]);//json_encode($this->connectionHR->select($sql4));
                \Debugbar::info($valueGrid);
                \Debugbar::info($cbTrainingField);
                \Debugbar::info($cbTrainingCourses);
                \Debugbar::info($cbCurrency);
               /* \Debugbar::info($sql);
                \Debugbar::info($sql1);
                \Debugbar::info($cbTrainingField);
                \Debugbar::info($departments);
                \Debugbar::info($teams);
                \Debugbar::info($sql2);
                \Debugbar::info($cbCurrency);
                \Debugbar::info($sql3);
                \Debugbar::info($cbApprovalFlowID);*/
                return View::make("W3X.W38.W38F2041", compact("valueGrid","creatorName","perW38F2041","perW38F2042","pForm", "g", 'task', "titleW38F2041", "departments", "rsData", "teams", "cbTrainingField", "cbTrainingCourses", "cbCurrency", "cbApprovalFlowID"));
                break;

            case 'edit':
                $rowDT = Input::get('rData');
                \Debugbar::info($rowDT);
                $departmentID = $rowDT['DepartmentID'];
                //$TrainingFieldID = $rowDT['TrainingFieldID'];
                $TrainingFieldID = '%';
                $titleW38F2041 = $this->getModalTitle($pForm);
                $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, '%', 0, true,'');
                $teams = array();
                $rsData = array();
                if ($perW38F2041 <=2){
                    \Debugbar::info("<=2");
                    $teams = $this->LoadTeamByG4($pForm, $divisionHR, Session::get("W91P0000")['DepartmentID'], 0);
                }else{
                    \Debugbar::info(">2");
                    $teams = $this->LoadTeamByG4($pForm, $divisionHR, $departmentID, 0);
                }

                $sql4 = "--do nguon cho luoi" .PHP_EOL;
                $sql4 .= "EXEC W38P2041 '$divisionHR', '$userID', 'D38F2042' ,'".$rowDT["ProposalID"]."'";
                \Debugbar::info($sql4);
                $valueGrid = json_encode($this->connectionHR->select($sql4));
                \Debugbar::info($valueGrid);

                //khoảng trắng
                $blankSpace = array(
                    "TrainingFieldID" => "%",
                    "TrainingFieldName" => ""
                );

                $sql = "--Do nguon linh vuc dao tao" .PHP_EOL;
                $sql .= "EXEC W38P2005 '$divisionHR','$userID', 'TrainingField','',''";
                $cbTrainingField = $this->connectionHR->select($sql);

                //chèn khoản trắng vào combo
                array_unshift($cbTrainingField, $blankSpace);

                $sql1 = "--Do nguon khoa" .PHP_EOL;
                $sql1 .= "EXEC W38P2005 '$divisionHR','$userID', 'TrainingCourse','$TrainingFieldID',''";
                $cbTrainingCourses = $this->connectionHR->select($sql1);

                $sql2 = "--Do nguon combo tien te" .PHP_EOL;
                $sql2 .= "SELECT CurrencyID,CurrencyNameU AS CurrencyName,ExchangeRate,Operator,MethodID,OriginalDecimal,ExchangeRateDecimal, UnitPriceDecimals".PHP_EOL;
                $sql2 .= "FROM D91V0010".PHP_EOL;
                $sql2 .= "WHERE Disabled = 0".PHP_EOL;
                $sql2 .= "ORDER BY CurrencyID".PHP_EOL;
                $cbCurrency = $this->connectionHR->select($sql2);

                $sql3 = "--do nguon combo quy trinh duyet".PHP_EOL;
                $sql3 .= "SELECT T2.ApprovalFlowID, T2.ApprovalFlowNameU AS ApprovalFlowName".PHP_EOL;
                $sql3 .= "FROM D84T1100 T2".PHP_EOL;
                $sql3 .= "WHERE	T2.TransactionID = 'D38KHDTTT' AND [Disabled] = 0".PHP_EOL;
                $sql3 .= "AND (T2.ValiddateFrom IS NULL OR CONVERT(VARCHAR(20), T2.ValiddateFrom, 111) <= CONVERT(VARCHAR(20), GETDATE(), 111))".PHP_EOL;
                $sql3 .= "AND (T2.ValiddateTo IS NULL OR CONVERT(VARCHAR(20), T2.ValiddateTo, 111) >= CONVERT(VARCHAR(20), GETDATE(), 111))".PHP_EOL;
                $cbApprovalFlowID = $this->connectionHR->select($sql3);

                \Debugbar::info($sql);
                \Debugbar::info($sql1);
                \Debugbar::info($cbTrainingField);
                \Debugbar::info($departments);
                \Debugbar::info($teams);
                \Debugbar::info($sql2);
                \Debugbar::info($cbCurrency);
                return View::make("W3X.W38.W38F2041", compact("valueGrid","cbApprovalFlowID","rowDT","departmentID","creatorName","perW38F2041","perW38F2042","pForm", "g", 'task', "titleW38F2041", "departments", "rsData", "teams", "cbTrainingField", "cbTrainingCourses", "cbCurrency"));
                break;

            case 'view':
                $rowDT = Input::get('rData');
                \Debugbar::info($rowDT);
                $departmentID = $rowDT['DepartmentID'];
                //$TrainingFieldID = $rowDT['TrainingFieldID'];
                $TrainingFieldID = '%';
                $titleW38F2041 = $this->getModalTitle($pForm);
                $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, '%', 0, true,'');
                $teams = array();
                $rsData = array();
                if ($perW38F2041 <=2){
                    \Debugbar::info("<=2");
                    $teams = $this->LoadTeamByG4($pForm, $divisionHR, Session::get("W91P0000")['DepartmentID'], 0);
                }else{
                    \Debugbar::info(">2");
                    $teams = $this->LoadTeamByG4($pForm, $divisionHR, $departmentID, 0);
                }

                $sql4 = "--do nguon cho luoi" .PHP_EOL;
                $sql4 .= "EXEC W38P2041 '$divisionHR', '$userID', 'D38F2042' ,'".$rowDT["ProposalID"]."'";
                \Debugbar::info($sql4);
                $valueGrid = json_encode($this->connectionHR->select($sql4));
                \Debugbar::info($valueGrid);

                $sql = "--Do nguon linh vuc dao tao" .PHP_EOL;
                $sql .= "EXEC W38P2005 '$divisionHR','$userID', 'TrainingField','',''";
                $cbTrainingField = $this->connectionHR->select($sql);

                $sql1 = "--Do nguon khoa" .PHP_EOL;
                $sql1 .= "EXEC W38P2005 '$divisionHR','$userID', 'TrainingCourse','$TrainingFieldID',''";
                $cbTrainingCourses = $this->connectionHR->select($sql1);

                $sql2 = "--Do nguon combo tien te" .PHP_EOL;
                $sql2 .= "SELECT CurrencyID,CurrencyNameU AS CurrencyName,ExchangeRate,Operator,MethodID,OriginalDecimal,ExchangeRateDecimal, UnitPriceDecimals".PHP_EOL;
                $sql2 .= "FROM D91V0010".PHP_EOL;
                $sql2 .= "WHERE Disabled = 0".PHP_EOL;
                $sql2 .= "ORDER BY CurrencyID".PHP_EOL;
                $cbCurrency = $this->connectionHR->select($sql2);

                $sql3 = "--do nguon combo quy trinh duyet".PHP_EOL;
                $sql3 .= "SELECT T2.ApprovalFlowID, T2.ApprovalFlowNameU AS ApprovalFlowName".PHP_EOL;
                $sql3 .= "FROM D84T1100 T2".PHP_EOL;
                $sql3 .= "WHERE	T2.TransactionID = 'D38KHDTTT' AND [Disabled] = 0".PHP_EOL;
                $sql3 .= "AND (T2.ValiddateFrom IS NULL OR CONVERT(VARCHAR(20), T2.ValiddateFrom, 111) <= CONVERT(VARCHAR(20), GETDATE(), 111))".PHP_EOL;
                $sql3 .= "AND (T2.ValiddateTo IS NULL OR CONVERT(VARCHAR(20), T2.ValiddateTo, 111) >= CONVERT(VARCHAR(20), GETDATE(), 111))".PHP_EOL;
                $cbApprovalFlowID = $this->connectionHR->select($sql3);

                \Debugbar::info($sql);
                \Debugbar::info($sql1);
                \Debugbar::info($cbTrainingField);
                \Debugbar::info($departments);
                \Debugbar::info($teams);
                \Debugbar::info($sql2);
                \Debugbar::info($cbCurrency);
                return View::make("W3X.W38.W38F2041", compact("valueGrid","cbApprovalFlowID","rowDT","departmentID","creatorName","perW38F2041","perW38F2042","pForm", "g", 'task', "titleW38F2041", "departments", "rsData", "teams", "cbTrainingField", "cbTrainingCourses", "cbCurrency"));
                break;

            case "reloadteams":
                \Debugbar::info(Input::all());
                $deparmentID = Input::get("departmentID", "");
                $teams = $this->LoadTeamByG4($pForm, $divisionHR, $deparmentID, 0);
                $strTeam = "<option value=''></option>";
                foreach ($teams as $row) {
                    $strTeam .= "<option value='" . $row["TeamID"] . "'>" . $row["TeamName"] . "</option>";
                }
                \Debugbar::info($teams);
                return $strTeam;
                break;

            case "RLTrainingCourses":
                \Debugbar::info(Input::all());
                $TrainingFieldID = Input::get("TrainingFieldID");
                if($TrainingFieldID == ''){
                    $TrainingFieldID = '%';
                }
                $sql = "--Do nguon danh sach khoa dao tao" .PHP_EOL;
                $sql .= "EXEC W38P2005 '$divisionHR','$userID', 'TrainingCourse','$TrainingFieldID',''";
                $cbTrainingCourses = $this->connectionHR->select($sql);

                \Debugbar::info($sql);
                \Debugbar::info($cbTrainingCourses);
               /* $str = "<option value=''></option>";
                foreach ($cbTrainingCourses as $row) {
                    $str .= "<option value='" . $row["TrainingCourseID"] . "'>" . $row["TrainingCourseName"] . "</option>";
                }
                return $str;*/
                return $cbTrainingCourses;
                break;

            case "RLform":
                \Debugbar::info(Input::all());
                $TrainingFieldID = Input::get("TrainingFieldID");
                $TrainingCourseID = Input::get("TrainingCourseID");
                $sql = "--Do nguon danh sach khoa dao tao" .PHP_EOL;
                $sql .= "EXEC W38P2005 '$divisionHR','$userID', 'DetailTraningCourse','$TrainingFieldID','$TrainingCourseID'";
                \Debugbar::info($sql);
                $formValue = $this->connectionHR->select($sql);
                \Debugbar::info($formValue);
                return $formValue;
                break;

            case "save":
                \Debugbar::info(Input::all());
                $status = Input::get('task');
                $ProposalID = "";
                $mode = 0;
                $sql = "";
                $companyID = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
                $dataGrid = json_decode(Input::get('dataGrid','[]'));
                \Debugbar::info($creatorID);
                \Debugbar::info($dataGrid);
                $ApprovalFlowID = $this->sqlstring(Input::get('slApprovalFlowIDW38F2041',''));
                $ProposalName = $this->sqlstring(Input::get('txtProposalNameW38F2041',''));
                $ProposalDate = Helpers::convertDate(Input::get('txtProposalDateW38F2041',''));
                $DepartmentID = $this->sqlstring(Input::get('slDepartmentIDW38F2041',''));
                $Year = $this->sqlstring(Input::get('txtYearW38F2041',''));
                if($status == "add"){
                    $mode = 0;
                    $ProposalID = $this->CreateIGE($g, "D38T2032", "38", "PT");
                    $sql = "--luu nghiep vu" .PHP_EOL;
                    $sql .= "INSERT INTO D38T2032(TranMonth, TranYear, ProposalID, ApprovalFlowID, " .PHP_EOL;
                    $sql .= "ProposalName, ProposalDate, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate, " .PHP_EOL;
                    $sql .= "ProposerID, DivisionID, DepartmentID, Year)" .PHP_EOL;
                    $sql .= "VALUES('$tranMonth', '$tranYear', '$ProposalID', '$ApprovalFlowID', " .PHP_EOL;
                    $sql .= "N'$ProposalName', $ProposalDate, '$UserID', Getdate(),'$UserID', Getdate(), " .PHP_EOL;
                    $sql .= "'$UserID', '$divisionHR', '$DepartmentID', '$Year')" .PHP_EOL;
                }
                if($status == "edit"){
                    $ProposalID =  $this->sqlstring(Input::get("ProposalID"));
                    $mode = 2;
                    //\Debugbar::info($dataGrid);
                    $sql = "--update du lieu" . PHP_EOL;
                    $sql .= " UPDATE D38T2032 " . PHP_EOL;
                    $sql .= " SET  TranMonth = $tranMonth,
                                TranYear = $tranYear,
                                ProposalDate  = $ProposalDate,
                                DivisionID = '$divisionHR',  
                                DepartmentID = '$DepartmentID',
                                LastModifyDate = Getdate(),
                                LastModifyUserID ='$UserID',
                                ProposalName = N'$ProposalName',
                                ApprovalFlowID = '$ApprovalFlowID',
                                Year = $Year" . PHP_EOL;
                    $sql .= " WHERE ProposalID = '$ProposalID'" . PHP_EOL;
                }

                //$ProTransID = $this->CreateIGE($g, "D38T2030", "38", "PR");
                $sql .= "DELETE FROM D38T2030 WHERE ProTransID = '$ProposalID'" .PHP_EOL;
                for($i = 0; $i < count($dataGrid); $i++){
                    $ProTransID = $this->CreateIGE($g, "D38T2030", "38", "PR");
                    $TrainingFieldID = $this->sqlstring($dataGrid[$i]->TrainingFieldID);
                    $TrainingCourseID = $this->sqlstring($dataGrid[$i]->TrainingCourseID);
                    $TrainingObjectID = $this->sqlstring($dataGrid[$i]->TrainingObjectID);
                    $TrainningEmpName = $this->sqlstring($dataGrid[$i]->TrainningEmpName);
                    $Content = $this->sqlstring($dataGrid[$i]->Content);
                    $FromDate = Helpers::convertDate($dataGrid[$i]->FromDate);
                    $ToDate = Helpers::convertDate($dataGrid[$i]->ToDate);
                    $TrainingPurpose = $this->sqlstring($dataGrid[$i]->TrainingPurpose);
                    $ProNumber = Helpers::sqlNumber($dataGrid[$i]->ProNumber);
                    $ProCost = Helpers::sqlNumber($dataGrid[$i]->ProCost);
                    $ProCCost = Helpers::sqlNumber($dataGrid[$i]->ProCCost);

                    \Debugbar::info(isset($dataGrid[$i]->CurrencyID));//kiểm tra trường currencyID có tồn tại hay ko
                    if(isset($dataGrid[$i]->CurrencyID)){
                        $ProCurrencyID = $this->sqlstring($dataGrid[$i]->CurrencyID);
                    }else{
                        $ProCurrencyID = $this->sqlstring($dataGrid[$i]->ProCurrencyID);
                    }
                    /*if($status == "edit"){
                        $ProCurrencyID = $this->sqlstring($dataGrid[$i]->CurrencyID);
                    }
                    if($status == "add"){
                        $ProCurrencyID = $this->sqlstring($dataGrid[$i]->CurrencyID);
                    }*/
                    $ProNote = $this->sqlstring($dataGrid[$i]->ProNote);
                    $ProExchangeRate = Helpers::sqlNumber($dataGrid[$i]->ProExchangeRate);
                    $ProCompanyRate = Helpers::sqlNumber($dataGrid[$i]->ProCompanyRate);
                    $ProEmployeeRate = Helpers::sqlNumber($dataGrid[$i]->ProEmployeeRate);
                    $ProAverageCosts = Helpers::sqlNumber($dataGrid[$i]->ProAverageCosts);

                    $sql .= "INSERT INTO D38T2030(ProposalID, ProTransID, TrainingFieldID, TrainingCourseID, TrainingObjectID," .PHP_EOL;
                    $sql .= "TrainningEmpName, Content, FromDate, ToDate, TrainingPurpose, ProNumber, ProCost, ProCCost, ProCurrencyID, ProNote," .PHP_EOL;
                    $sql .= "ProExchangeRate, ProCompanyRate, ProEmployeeRate, ProAverageCosts, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate, DivisionID, ProposalDate)" .PHP_EOL;
                    $sql .= "VALUES('$ProTransID','$ProposalID' ,'$TrainingFieldID','$TrainingCourseID', '$TrainingObjectID'," .PHP_EOL;
                    $sql .= "N'$TrainningEmpName', N'$Content', $FromDate, $ToDate, N'$TrainingPurpose', $ProNumber, $ProCost, $ProCCost, '$ProCurrencyID', N'$ProNote'," .PHP_EOL;
                    $sql .= "$ProExchangeRate, $ProCompanyRate, $ProEmployeeRate, $ProAverageCosts, '$UserID', Getdate(),'$UserID', Getdate(), '$divisionHR', Getdate())" .PHP_EOL;
                }

                $sql .= " -- Insert bang tam de ra quy trinh duyet " . PHP_EOL;
                $sql .= "INSERT INTO D09T6666 (UserID, HostID, FormID, Key01ID)". PHP_EOL;
                $sql .= " VALUES ('$userID', '$session', 'D38F2042', '$ProposalID')" . PHP_EOL;

                $sql1 = " -- Ra User va cap duyet tiep theo " . PHP_EOL;
                $sql1 .= " EXEC D84P2020 '$companyID', '$g', 'D38', '', '$divisionHR', '$userID', '$session', 1, '$lang', $mode, 0, 0, 'D38F2042', '$ProposalID' " . PHP_EOL;
                \Debugbar::info($sql);
                if ($sql != "") {
                    try {
                        $this->connectionHR->statement($sql);
                        $data = $this->connectionHR->select($sql1);
                        $sql2 = "-- xoa ban tam " . PHP_EOL;
                        $sql2 .= " DELETE D09T6666". PHP_EOL;;
                        $sql2 .= " WHERE UserID = '$userID' AND  HostID = '$session' AND FormID = 'D38F2042'";
                        \Debugbar::info($data);
                        if (count($data) > 0){
                            $rs = $data[0];
                            \Debugbar::info($data);
                            if($rs['IsSendMail']==1)
                            {
                                if($rs['IsShowMailScreen']==0)
                                {
                                    $res = $this->SendMailAuto($rs['EmailContent'],$rs);
                                    $this->connectionHR->statement($sql2);
                                    return json_encode(['status' => 'BACKGROUND', 'name' => $rs['EmailReceivedAddress'],"message"=>$res]); // đã gửi mail
                                }
                                else
                                {
                                    \Debugbar::info($rs);
                                    $this->connectionHR->statement($sql2);
                                    return json_encode(['status' => "SHOWMAIL", 'name' => $rs['EmailReceivedAddress'], 'data'=> $rs, 'rsvalue' => View::make('layout.sendmail',compact('rs'))->render()]);
                                }
                            }
                            else
                            {
                                $this->connectionHR->statement($sql2);
                                return json_encode(['status' => "NOSEND", 'data'=> $rs]);  // không gửi mail
                            }
                        }else{
                            $this->connectionHR->statement($sql2);
                            return json_encode(['status' => "NOSEND"]);  // không gửi mail
                        }
                    } catch (Exception $ex) {
                        $this->connectionHR->statement($sql2);
                        return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }
                break;
        }
    }
}