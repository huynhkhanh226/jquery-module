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
                $sql = "--Do nguon linh vuc dao tao" .PHP_EOL;
                $sql .= "EXEC W38P2005 '$divisionHR','$userID', 'TrainingField','',''";
                $cbTrainingField = $this->connectionHR->select($sql);

                $sql1 = "--Do nguon khoa dao tao" .PHP_EOL;
                $sql1 .= "EXEC W38P2005 '$divisionHR','$userID', 'TrainingCourse','',''";
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
                $valueGrid = json_encode($this->connectionHR->select($sql4));
                \Debugbar::info($valueGrid);
                //\Debugbar::info($cbTrainingField);
                //\Debugbar::info($cbTrainingCourses);
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
                $TrainingFieldID = $rowDT['TrainingFieldID'];
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

           /* case "save":
                \Debugbar::info(Input::all());
                $ProposalID = "";
                \Debugbar::info($ProposalID);
                $status = Input::get('Task');
                $sql ="";
                $mode = 0;
                \Debugbar::info($status);
                $companyID = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
                $ProposalName = $this->sqlstring(Input::get("txtProposalNameW38F2041"));
                $ProposalDate = Helpers::convertDate(Input::get("txtProposalDateW38F2041"));
                $DepartmentID = $this->sqlstring(Input::get("slDepartmentIDW38F2041"));
                if($DepartmentID == ""){
                    $DepartmentID = Session::get("W91P0000")['DepartmentID'];
                }
                $TeamID = $this->sqlstring(Input::get("slTeamIDW38F2041"));
                $TrainingFieldID = $this->sqlstring(Input::get("slTrainingFieldIDW38F2041"));
                $TrainingCourseID = $this->sqlstring(Input::get("slTrainingCourseIDW38F2041"));
                $TrainingObjectID = $this->sqlstring(Input::get("TrainingObjectID"));
                $TrainningEmpID = $this->sqlstring(Input::get("TrainningEmpID"));
                $TrainningEmpName = $this->sqlstring(Input::get("txtTrainningEmpNameW38F2041"));
                $Content = $this->sqlstring(Input::get("txtContentW38F2041"));
                $FromDate = Helpers::convertDate(Input::get("txtDateFromW38F2041"));
                $ToDate = Helpers::convertDate(Input::get("txtDateToW38F2041"));
                $TrainingPurpose = $this->sqlstring(Input::get("txtTrainingPurposeW38F2041"));
                $ProNumber = Helpers::sqlNumber(intval(Input::get("txtProNumberW38F2041")));
                $ProCost = Helpers::sqlNumber(Input::get("txtProCostW38F2041"));
                $ProCCost = Helpers::sqlNumber(Input::get("txtProCCostW38F2041"));
                $ProCurrencyID = $this->sqlstring(Input::get("slProCurrencyIDW38F2041"));
                $ProNote = $this->sqlstring(Input::get("txtProNoteW38F2041"));
                $ProExchangeRate = Helpers::sqlNumber(Input::get("txtProExchangeRateW38F2041"));
                $ProCompanyRate = Helpers::sqlNumber(Input::get("txtProCompanyRateW38F2041"));
                $ProEmployeeRate = Helpers::sqlNumber(Input::get("txtProEmployeeRateW38F2041"));
                $ProAverageCosts = Helpers::sqlNumber(Input::get("txtProAverageCostsW38F2041"));
                $ApprovalFlowID = $this->sqlstring(Input::get("slApprovalFlowIDW38F2041"));
                if($status == "add"){
                    $ProposalID = $this->CreateIGE($g, "D38T2030", "38", "PT");
                    $mode = 0;
                    $sql = "--Luu nghiep vu" . PHP_EOL;
                    $sql .= "INSERT INTO D38T2030(" . PHP_EOL;
                    $sql .= "TranMonth, TranYear, ProposalID,". PHP_EOL;
                    $sql .= "ProposalName, ProposalDate, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate," . PHP_EOL;
                    $sql .= "ProposerID, DivisionID, DepartmentID, TeamID, TrainingFieldID, TrainingCourseID, TrainingObjectID,TrainningEmpID," . PHP_EOL;
                    $sql .= "TrainningEmpName, Content, FromDate, ToDate, TrainingPurpose,ProNumber, ProCost," . PHP_EOL;
                    $sql .= "ProCCost, ProCurrencyID,ProNote, ProExchangeRate, ProCompanyRate,ProEmployeeRate, ProAverageCosts, ApprovalFlowID)" . PHP_EOL;
                    $sql .= "VALUES ('$tranMonth', '$tranYear', '$ProposalID',N'$ProposalName', $ProposalDate, '$UserID', Getdate(), '$UserID',". PHP_EOL;
                    $sql .="Getdate(),'$creatorID','$divisionHR','$DepartmentID','$TeamID', '$TrainingFieldID','$TrainingCourseID','$TrainingObjectID','$TrainningEmpID', N'$TrainningEmpName',N'$Content',$FromDate,$ToDate," . PHP_EOL;
                    $sql .="N'$TrainingPurpose',$ProNumber,$ProCost,$ProCCost,'$ProCurrencyID',N'$ProNote',$ProExchangeRate,$ProCompanyRate,$ProEmployeeRate,$ProAverageCosts,'$ApprovalFlowID')". PHP_EOL;
                }
                if($status == "edit"){
                    $ProposalID =  $this->sqlstring(Input::get("ProposalID"));
                    $mode = 2;
                    $sql .= "--update du lieu" . PHP_EOL;
                    $sql .= " UPDATE D38T2030 " . PHP_EOL;
                    $sql .= " SET  TranMonth = '$tranMonth',
                                TranYear = '$tranYear',
                                ProposalDate  = $ProposalDate,
                                DepartmentID = '$DepartmentID',
                                TeamID ='$TeamID',
                                TrainingFieldID ='$TrainingFieldID',
                                TrainingCourseID ='$TrainingCourseID',
                                TrainingObjectID ='$TrainingObjectID',
                                TrainningEmpID ='$TrainningEmpID',
                                TrainningEmpName = N'$TrainningEmpName',
                                Content = N'$Content',
                                FromDate = $FromDate,
                                ToDate = $ToDate,
                                TrainingPurpose = N'$TrainingPurpose',
                                ProNumber = $ProNumber,
                                ProCost = $ProCost,
                                ProCurrencyID = '$ProCurrencyID',
                                ProNote = N'$ProNote',
                                ProExchangeRate = $ProExchangeRate,
                                ProCompanyRate = $ProCompanyRate,
                                ProEmployeeRate = $ProEmployeeRate,
                                ProAverageCosts = $ProAverageCosts,
                                ProCCost = $ProCCost,
                                LastModifyDate = GETDATE(),
                                LastModifyUserID ='$UserID',
                                ProposalName = N'$ProposalName',
                                ApprovalFlowID = '$ApprovalFlowID'" . PHP_EOL;
                    $sql .= " WHERE ProposalID = '$ProposalID'" . PHP_EOL;
                }

                $sql .= "-- xoa ban tam " . PHP_EOL;
                $sql .= " DELETE D09T6666". PHP_EOL;;
                $sql .= " WHERE UserID = '$userID' AND  HostID = '$session' AND FormID = 'D38F2042'" . PHP_EOL;

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
               /* if ($sql != '') {
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
                }*/
                //break;

            case "save":
                \Debugbar::info("save");
                break;
        }
    }
}