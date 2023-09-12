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

class W25F2081Controller extends W2XController
{
    public function index($pForm, $g, $task = '')
    {
        \Debugbar::info($pForm);
        $userID = Auth::user()->user()->UserID;
        $employeeID= Auth::user()->user()->HREmployeeID;
        $CreatorHR = $employeeID;//Session::get("W91P0000")['CreatorHR'];
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $session = Session::getId();
        $lang = Session::get('Lang');
        $sql = " -- Tinh Dinh muc, So luong hien tai va So luong ke hoach da lap" . PHP_EOL;
        $sql .= " Exec W25P2084 '$divisionHR', '$userID'" . PHP_EOL;
        $fixData = $this->connectionHR->select($sql);
        $perW25F2080 = $this->getPermission("D25F2080");
        $perW25F2082 =  Session::get($pForm);
        //$perW25F2080 = 3;
        \Debugbar::info($perW25F2082);
        switch ($task) {
            case 'add':
                $transID = "25GP0A000000003";
                $titleW25F2081 = $this->getModalTitle($pForm);
                $rsData = array();
                $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, '%', 0, true,'');
                $teams = array();
                $sql = " -- Do nguon combo vi tri ung tuyen " . PHP_EOL;
                $sql .= " SELECT  DutyID As PositionID, DutyNameU AS PositionName, DutyDisplayOrder " . PHP_EOL;
                $sql .= " FROM  D09T0211  WITH(NOLOCK)  " . PHP_EOL;
                $sql .= " WHERE  Disabled = 0 " . PHP_EOL;
                $sql .= " ORDER BY DutyDisplayOrder, DutyName " . PHP_EOL;
                //\Debugbar::info($sql);
                $positions = $this->connectionHR->select($sql);
                //\Debugbar::info($rsData);

                $sql = " -- Do nguon combo cong viec " . PHP_EOL;
                $sql .= " SELECT 		WorkID, WorkNameU as WorkName  " . PHP_EOL;
                $sql .= " FROM 		D09T0224  WITH(NOLOCK)  " . PHP_EOL;
                $sql .= " WHERE 		Disabled = 0    " . PHP_EOL;
                $sql .= " ORDER BY	WorkName  " . PHP_EOL;
                $works = $this->connectionHR->select($sql);

                $sql = " -- Do nguon cho grid  " . PHP_EOL;
                $sql .= " Exec W25P2081 '$divisionHR', '$transID', 1 " . PHP_EOL;

                if ($perW25F2080 <=2){
                    \Debugbar::info("dsfdf");
                    $teams = $this->LoadTeamByG4($pForm, $divisionHR, Session::get("W91P0000")['DepartmentID'], 0);
                }else{
                    \Debugbar::info("aaa");
                    $teams = $this->LoadTeamByG4($pForm, $divisionHR, $departments[0]["DepartmentID"], 0);
                }

                //\Debugbar::info($sql);
                $rsData = $this->connectionHR->select($sql);
                //\Debugbar::info($rsData);
                return View::make("W2X.W25.W25F2081", compact("perW25F2082","perW25F2080","pForm", "g", 'task', "departments", "titleW25F2081", "rsData", "teams", "positions", "works", "fixData"));
            case "view":
            case 'edit':
                $transID = Input::get("transID", "");
                $departmentID = Input::get("departmentID", "");
                $year = Input::get("year", "");
                $titleW25F2081 = $this->getModalTitle($pForm);
                $rsData = array();
                $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, '%', 0, true);
                $teams = $this->LoadTeamByG4($pForm, $divisionHR, $departmentID, 0);
                $sql = " -- Do nguon combo vi tri ung tuyen " . PHP_EOL;
                $sql .= " SELECT  DutyID As PositionID, DutyNameU AS PositionName, DutyDisplayOrder " . PHP_EOL;
                $sql .= " FROM  D09T0211  WITH(NOLOCK)  " . PHP_EOL;
                $sql .= " WHERE  Disabled = 0 " . PHP_EOL;
                $sql .= " ORDER BY DutyDisplayOrder, DutyName " . PHP_EOL;
                //\Debugbar::info($sql);
                $positions = $this->connectionHR->select($sql);
                //\Debugbar::info($rsData);

                $sql = " -- Do nguon combo cong viec " . PHP_EOL;
                $sql .= " SELECT 		WorkID, WorkNameU as WorkName  " . PHP_EOL;
                $sql .= " FROM 		D09T0224  WITH(NOLOCK)  " . PHP_EOL;
                $sql .= " WHERE 		Disabled = 0    " . PHP_EOL;
                $sql .= " ORDER BY	WorkName  " . PHP_EOL;
                $works = $this->connectionHR->select($sql);

                $sql = " -- Do nguon cho grid  " . PHP_EOL;
                $sql .= " Exec W25P2081 '$divisionHR', '$transID', 1 " . PHP_EOL;

                //\Debugbar::info($sql);
                $rsData = $this->connectionHR->select($sql);
                //\Debugbar::info($rsData);
                return View::make("W2X.W25.W25F2081", compact("perW25F2082","perW25F2080", 'transID', 'departmentID', 'year', "pForm", "g", 'task', "departments", "titleW25F2081", "rsData", "teams", "positions", "works", "fixData"));

            case 'reloadteams':
                $deparmentID = Input::get("departmentID", "");
                $teams = $this->LoadTeamByG4($pForm, $divisionHR, $deparmentID, 0);
                //\Debugbar::info($teams);
                return $teams;
                break;
            case "save":
                \Debugbar::info("save");
                $mode = 0;
                $transIDMaster = "";
                $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);

                $DivisionID = $divisionHR;
                $BlockID = "%";
                $DepartmentID = Input::get("departmentID", "");
                $Year = str_replace("_", "",Input::get("year", 1970)) ;
                $data = Input::get("data");
                $sql = " set nocount on  " . PHP_EOL;
                $sql .= " -- Xoa bang tam " . PHP_EOL;
                $sql .= " DELETE D09T6666 ";
                $sql .= " WHERE UserID = '$userID' AND  HostID ='$session' AND FormID = 'W25F2081' " . PHP_EOL;
                $TransPlanID = $this->CreateIGE($g, "D25T2081", "25", "RE");
                foreach ($data as $row) {
                    $TransID = $this->CreateIGENewS($g, 'D25T2081', '25', 'RE', '', count($data), '');
                    $TeamID = isset($row["TeamID"]) ? $row["TeamID"] : "";
                    $PositionID = isset($row["PositionID"]) ? $row["PositionID"] : "";
                    $WorkID = isset($row["WorkID"]) ? $row["WorkID"] : "";
                    $Number = isset($row["Number"]) ? $row["Number"] : 0;
                    $DateFrom = \Helpers::convertDate($row["DateFrom"]);
                    $DateTo = \Helpers::convertDate($row["DateTo"]);
                    $NoteU = isset($row["Note"]) ? $this->sqlstring($row["Note"]) : "";
                    $GETDATE = Carbon::now();
                    $TranMonth = Session::get("W91P0000")['HRTranMonth'];
                    $TranYear = Session::get("W91P0000")['HRTranYear'];
                    $VoucherDate = Carbon::now();
                    $DescriptionU = isset($row["Description"]) ? $this->sqlstring($row["Description"]) : "";
                    $ExpSalary = isset($row["ExpSalary"]) ? $row["ExpSalary"] : 0;
                    $Reason = isset($row["Reason"]) ? $this->sqlstring($row["Reason"]) : "";
                    $sql .= " -- Luu nghiep vu " . PHP_EOL;
                    $sql .= " INSERT INTO D25T2081( ";
                    $sql .= " TransID, DivisionID, BlockID, DepartmentID, TeamID, ";
                    $sql .= " PositionID,WorkID ,Number, DateFrom, DateTo, NoteU,CreateDate, ";
                    $sql .= " CreateUserID,LastModifyDate, LastModifyUserID, TranMonth,TranYear, ";
                    $sql .= " VoucherDate, DescriptionU, Year,  ExpSalary, CreatorID, Reason, TransPlanID) " . PHP_EOL;
                    $sql .= " VALUES( ";
                    $sql .= " '$TransID', '$DivisionID', '$BlockID', '$DepartmentID', '$TeamID', ";
                    $sql .= " '$PositionID','$WorkID',$Number,$DateFrom,$DateTo,N'$NoteU',GETDATE(), ";
                    $sql .= " '$userID', GETDATE(),'$userID',$TranMonth,$TranYear, ";
                    $sql .= "  GETDATE(),N'$DescriptionU',$Year, $ExpSalary, '$CreatorHR', N'$Reason', '$TransPlanID')  " . PHP_EOL;

                    $sql .= " -- Insert bang tam de ra quy trinh duyet " . PHP_EOL;
                    $sql .= " INSERT INTO 	D09T6666 (UserID, HostID, FormID, Key01ID) ";
                    $sql .= " VALUES ('$userID', '$session', 'W25F2081', '$TransID') " . PHP_EOL;
                }



                $sql .= " -- Ra User va cap duyet tiep theo " . PHP_EOL;
                $sql .= " EXEC D84P2020 '$companyID', '$g', 'D25', '', '$DivisionID', '$userID', '$session', 1, '$lang', $mode, 0, 0, 'D25F2081', '$transIDMaster' " . PHP_EOL;

                \Debugbar::info($sql);
                if ($sql != "") {
                    try {
                        $data = $this->connectionHR->select($sql);
                        \Debugbar::info($data[0]);
                        if (count($data) > 0){
                            $rs = $data[0];
                            \Debugbar::info($data);
                            if($rs['IsSendMail']==1)
                            {
                                if($rs['IsShowMailScreen']==0)
                                {
                                    $res = $this->SendMailAuto($rs['EmailContent'],$rs);
                                    return json_encode(['status' => 'BACKGROUND', 'name' => $rs['EmailReceivedAddress'],"message"=>$res]); // đã gửi mail
                                }
                                else
                                {
                                    \Debugbar::info($rs);
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

                break;
            case "update":
                $mode = 2;
                $transIDMaster = Input::get('transID');
                $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
                $session = Session::getId();

                $DivisionID = $divisionHR;
                $BlockID = "%";
                $DepartmentID = Input::get("departmentID", "");
                $Year = str_replace("_", "",Input::get("year", 1970)) ;
                $data = Input::get("data");
                $sql = " set nocount on  " . PHP_EOL;
                $sql .= " -- Xoa bang tam " . PHP_EOL;
                $sql .= " DELETE D09T6666 ";
                $sql .= " WHERE UserID = '$userID' AND  HostID ='$session' AND FormID = 'W25F2081' " . PHP_EOL;
                foreach ($data as $row) {
                    $TransID = $row["TransID"];// $this->CreateIGENewS($g, 'D25T2081', '25', 'RE', '', count($data), '');
                    $TeamID = isset($row["TeamID"]) ? $row["TeamID"] : "";
                    $PositionID = isset($row["PositionID"]) ? $row["PositionID"] : "";
                    $WorkID = isset($row["WorkID"]) ? $row["WorkID"] : "";
                    $Number = isset($row["Number"]) ? $row["Number"] : 0;
                    $DateFrom = \Helpers::convertDate($row["DateFrom"]);
                    $DateTo = \Helpers::convertDate($row["DateTo"]);
                    $NoteU = isset($row["Note"]) ? $this->sqlstring($row["Note"]) : "";
                    $GETDATE = Carbon::now();
                    $TranMonth = Session::get("W91P0000")['HRTranMonth'];
                    $TranYear = Session::get("W91P0000")['HRTranYear'];
                    $VoucherDate = Carbon::now();
                    $DescriptionU = isset($row["Description"]) ? $this->sqlstring($row["Description"]) : "";
                    $ExpSalary = isset($row["ExpSalary"]) ? $row["ExpSalary"] : 0;
                    $Reason = isset($row["Reason"]) ? $this->sqlstring($row["Reason"]) : "";
                    $sql .= " -- Cap nhat nghiep vu " . PHP_EOL;
                    $sql .= " UPDATE 	D25T2081 set ";
                    $sql .= " BlockID = '$BlockID', ";
                    $sql .= " DepartmentID ='$DepartmentID' , ";
                    $sql .= " TeamID='$TeamID', ";
                    $sql .= " PositionID ='$PositionID', ";
                    $sql .= " WorkID ='$WorkID', ";
                    $sql .= " Number =$Number, ";
                    $sql .= " DateFrom =$DateFrom, ";
                    $sql .= " DateTo =$DateTo, ";
                    $sql .= " NoteU =N'$NoteU', ";
                    $sql .= " LastModifyDate = GETDATE(), ";
                    $sql .= " LastModifyUserID ='$userID', ";
                    $sql .= " TranMonth =$TranMonth, ";
                    $sql .= " TranYear =$TranYear, ";
                    $sql .= " DescriptionU =N'$DescriptionU', ";
                    $sql .= " Year =$Year, ";
                    $sql .= " ExpSalary =$ExpSalary, ";
                    $sql .= " Reason =N'$Reason' ";
                    $sql .= " WHERE 	TransID = '$transIDMaster' ". PHP_EOL;

                    $sql .= " -- Insert bang tam de ra quy trinh duyet " . PHP_EOL;
                    $sql .= " INSERT INTO 	D09T6666 (UserID, HostID, FormID, Key01ID) ";
                    $sql .= " VALUES ('$userID', '$session', 'W25F2081', '$TransID') " . PHP_EOL;
                }


                $sql .= " -- Ra User va cap duyet tiep theo " . PHP_EOL;
                $sql .= " EXEC D84P2020 '$companyID', '$g', 'D25', '', '$DivisionID', '$userID', '$session', 1, '$lang', $mode, 0, 0, 'D25F2081', '$transIDMaster' " . PHP_EOL;

                \Debugbar::info($sql);
                if ($sql != "") {
                    try {
                        $data = $this->connectionHR->select($sql);
                        \Debugbar::info($data[0]);
                        if (count($data) > 0){
                            $rs = $data[0];
                            \Debugbar::info($data);
                            if($rs['IsSendMail']==1)
                            {
                                if($rs['IsShowMailScreen']==0)
                                {
                                    $res = $this->SendMailAuto($rs['EmailContent'],$rs);
                                    return json_encode(['status' => 'BACKGROUND', 'name' => $rs['EmailReceivedAddress'],"message"=>$res]); // đã gửi mail
                                }
                                else
                                {
                                    \Debugbar::info($rs);
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

                break;
            case "deletetemp":
                $sql .= " -- Insert bang tam de ra quy trinh duyet " . PHP_EOL;
                $sql .= " DELETE D09T6666 ";
                $sql .= " WHERE UserID = '$userID' AND  HostID ='$session' AND FormID = 'W25F2081' " . PHP_EOL;

                try{
                    $this->connectionHR->statement($sql);
                    return 1;
                } catch (Exception $ex) {
                    return 0;
                }
        }

    }
}
