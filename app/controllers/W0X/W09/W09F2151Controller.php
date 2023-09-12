<?php

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

class W09F2151Controller extends W0XController
{
    public function Index($pForm, $g, $task = "")
    {
        $titleW09F2151 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $session = Session::getId();
        $userID = Auth::user()->user()->UserID;
        //\Debugbar::info(Session::get("W91P0000"));
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $perD09F2150 = $this->getPermission("D09F2150");
        $perD09F5650 = $this->getPermission("D09F5650");
        \Debugbar::info($perD09F5650);
        $creatorHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        switch ($task) {
            case "add":
                $employeeID = $creatorHR;
                $proTransID = "";
                $sql = "-- Nguon xay dung cot dong luong" . PHP_EOL;
                $sql .= " SELECT 	Code, ShortU AS CaptionName, Decimals, Disabled ";
                $sql .= " FROM 	D13T9000 ";
                $sql .= " WHERE 	[Type] = 'SALBA'";
                $rsColumns = $this->connectionHR->select($sql);

                $employees = $this->LoadEmployeeByG4($pForm, $divisionHR, "%", "%", 0, "", "%", "Role");
                $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, "%", 0, true, "");
                $teams = $this->LoadTeamByG4($pForm, $divisionHR, $departments[0]["DepartmentID"], 0);
                $directManagers = $this->LoadDirectManagerbyG4($divisionHR, $userID, $session, $lang, $pForm);
                $works = $this->LoadWorkbyG4();

                $mode = 0;
                $sql = "-- Load thong tin master" . PHP_EOL;
                $sql .= " EXEC W09P2154 '$divisionHR', '$userID', $tranMonth, $tranYear, '$creatorHR', '$employeeID', $mode, '$proTransID'";
                $rsMaster = $this->connectionHR->select($sql);
                return View::make("W0X.W09.W09F2151", compact("rsMaster", "proTransID", "creatorHR", "employeeID", "perD09F2150", "perD09F5650", "works", "directManagers", "rsColumns", "teams", "departments", 'employees', 'task', 'g', 'titleW09F2151', 'pForm'));
                break;
            case "edit":
                $employeeID = Input::get("employeeID", "");
                $proTransID = Input::get("proTransID", "");
                $sql = "-- Nguon xay dung cot dong luong" . PHP_EOL;
                $sql .= " SELECT 	Code, ShortU AS CaptionName, Decimals, Disabled ";
                $sql .= " FROM 	D13T9000 ";
                $sql .= " WHERE 	[Type] = 'SALBA'";
                $rsColumns = $this->connectionHR->select($sql);


                $mode = 1;
                $sql = "-- Load thong tin master" . PHP_EOL;
                $sql .= " EXEC W09P2154 '$divisionHR', '$userID', $tranMonth, $tranYear, '$creatorHR', '$employeeID', $mode, '$proTransID'";
                $rsMaster = $this->connectionHR->select($sql);

                $employees = $this->LoadEmployeeByG4($pForm, $divisionHR, "%", "%", 0, "", "%", "Role");
                $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, "%", 0, true, "");
                $teams = $this->LoadTeamByG4($pForm, $divisionHR, $rsMaster[0]["NewDepartmentID"], 0);
                $directManagers = $this->LoadDirectManagerbyG4($divisionHR, $userID, $session, $lang, "D09F2150");
                $works = $this->LoadWorkbyG4();


                return View::make("W0X.W09.W09F2151", compact("rsMaster", "creatorHR", "proTransID", "employeeID", "perD09F2150", "perD09F5650", "works", "directManagers", "rsColumns", "teams", "departments", 'employees', 'task', 'g', 'titleW09F2151', 'pForm'));
                break;

            case 'loadmaster':
                $mode = Input::get("mode", 0);
                $employeeID = Input::get("employeeID", ""); //Lấy từ combo trên màn hình 2051
                $proTransID = Input::get("proTransID", "");
                //\Debugbar::info($proTransID);
                $sql = "-- Load thong tin master" . PHP_EOL;
                $sql .= " EXEC W09P2154 '$divisionHR', '$userID', $tranMonth, $tranYear, '$creatorHR', '$employeeID', $mode, '$proTransID'";
                $rsData = $this->connectionHR->select($sql);
                //\Debugbar::info($rsData);
                return $rsData;
                break;
            case 'loadteams':
                $departmentID = Input::get("departmentID", "");
                $rsData = $this->LoadTeamByG4($pForm, $divisionHR, $departmentID, 0);
                $str = '<option value=""></option>';
                foreach ($rsData as $row) {
                    $str .= '<option value="' . $row["TeamID"] . '">'. $row["TeamID"] .' -- ' . $row["TeamName"] . '</option>';
                }
                return $str;
                break;
            case 'checkstore':
                $mode = Input::get("mode", 0);
                $employeeID = Input::get("employeeID", "");
                $proTransID = Input::get("proTransID", "");
                $validDate = \Helpers::convertDate(Input::get("txtValidDateW09F2151", ""));
                //$IsSalaryAdjustment = Helpers::sqlNumber(Input::get("chkIsSalaryAdjustmentW25F2151", "off") == "on" ? 1: 0);
                //\Debugbar::info($IsSalaryAdjustment);
                $sql = "--  Kiem tra truoc khi luu" . PHP_EOL;
                $sql .= " EXEC W09P5556  '$divisionHR', $tranMonth, $tranYear, '$lang', '$userID', " . PHP_EOL;
                $sql .= " '$session', $mode, 'D09F2150' , 0, 0 , " . PHP_EOL;
                $sql .= " 0 ,0 ,0 ,'$employeeID'  ,'$proTransID'  , " . PHP_EOL;
                $sql .= " '', '' ,'' ,$validDate  ,null , " . PHP_EOL;
                $sql .= " null, null, null " . PHP_EOL;

                $rsData = $this->connectionHR->select($sql);
                //\Debugbar::info($rsData);
                return $rsData;
                break;

            case "save":
            case "update":
                \Debugbar::info(Input::all());
                $proTransID = Input::get("proTransID", "");
                $EmployeeID = Input::get("employeeID", "");;
                $ValidDate = \Helpers::convertDate(Input::get("txtValidDateW09F2151", ""));

                $DepartmentID = Input::get("DepartmentID", "");
                $DepartmentName = $this->sqlstring(Input::get("DepartmentIDName", ""));
                $TeamID = Input::get("TeamID", "");
                $TeamName = $this->sqlstring(Input::get("TeamName", ""));
                $DirectManagerID = Input::get("DirectManagerID", "");
                $DirectManagerName = $this->sqlstring(Input::get("DirectManagerIDName", ""));
                $WorkID = Input::get("WorkID", "");
                $WorkName = $this->sqlstring(Input::get("WorkName", ""));
                $BaseSalary01 = Helpers::sqlNumber(Input::get("BaseSalary01", ""));
                $BaseSalary02 = Helpers::sqlNumber(Input::get("BaseSalary02", ""));
                $BaseSalary03 = Helpers::sqlNumber(Input::get("BaseSalary03", ""));
                $BaseSalary04 = Helpers::sqlNumber(Input::get("BaseSalary04", ""));

                $NewDepartmentID = Input::get("cboNewDepartmentIDW25F2151", "");
                $NewTeamID = Input::get("cboNewTeamIDW25F2151", "");
                $NewDirectManagerID = Input::get("cboNewDirectManagerIDW25F2151", "");
                $NewWorkID = Input::get("cboNewWorkIDW25F2151", "");

                //$IsSalaryAdjustment = Input::get("chkIsSalaryAdjustmentW25F2151", 0);
                $IsSalaryAdjustment = Helpers::sqlNumber(Input::get("chkIsSalaryAdjustmentW25F2151"));
                \Debugbar::info($IsSalaryAdjustment);
                $NewBaseSalary01 = Helpers::sqlNumber(Input::get("txtNewBaseSalary01W25F2151", ""));
                $NewBaseSalary02 = Helpers::sqlNumber(Input::get("txtNewBaseSalary02W25F2151", ""));
                $NewBaseSalary03 = Helpers::sqlNumber(Input::get("txtNewBaseSalary03W25F2151", ""));
                $NewBaseSalary04 = Helpers::sqlNumber(Input::get("txtNewBaseSalary04W25F2151", ""));


                $Reason = Helpers::sqlNumber(Input::get("txtReasonW09F2151", ""));

                $mode = Input::get("mode", 0);
                //\Debugbar::info("test");
                $tableName = "#W2150_$EmployeeID ";
                $sql = "--Tao bang tam chua du lieu luu" . PHP_EOL;
                $sql .= "CREATE TABLE $tableName (";
                $sql .= " ProTransID Varchar(50),";
                $sql .= " EmployeeID Varchar(50),";
                $sql .= " ValidDate DATETIME,";
                $sql .= " DepartmentID Varchar(50),";
                $sql .= " DepartmentName Nvarchar(500),";
                $sql .= " NewDepartmentID Varchar(50),";
                $sql .= " TeamID Varchar(50)," . PHP_EOL;
                $sql .= " TeamName Nvarchar(500),";
                $sql .= " NewTeamID Varchar(50),";
                $sql .= " DirectManagerID Varchar(50),";
                $sql .= " DirectManagerName Nvarchar(500),";
                $sql .= " NewDirectManagerID Varchar(50),";
                $sql .= " WorkID Varchar(50)," . PHP_EOL;
                $sql .= " WorkName Nvarchar(500),";
                $sql .= " NewWorkID Varchar(50),";
                $sql .= " IsSalaryAdjustment  Tinyint,";
                $sql .= " BaseSalary01 	decimal(19,8) ,";
                $sql .= " NewBaseSalary01	decimal(19,8) ,";
                $sql .= " BaseSalary02	decimal(19,8) ," . PHP_EOL;
                $sql .= " NewBaseSalary02	decimal(19,8) ,";
                $sql .= " BaseSalary03	decimal(19,8) ,";
                $sql .= " NewBaseSalary03	decimal(19,8) ,";
                $sql .= " BaseSalary04	decimal(19,8) ,";
                $sql .= " NewBaseSalary04	decimal(19,8) ,";
                $sql .= " Reason	Nvarchar(1000)" . PHP_EOL;
                $sql .= ")" . PHP_EOL;

                $sql .= "--Insert $tableName" . PHP_EOL;
                $sql .= "set nocount on" . PHP_EOL;
                $sql .= "INSERT INTO $tableName(";
                $sql .= " ProTransID,";
                $sql .= " EmployeeID,";
                $sql .= " ValidDate,";
                $sql .= " DepartmentID,";
                $sql .= " DepartmentName,";
                $sql .= " NewDepartmentID,";
                $sql .= " TeamID," . PHP_EOL;
                $sql .= " TeamName,";
                $sql .= " NewTeamID,";
                $sql .= " DirectManagerID,";
                $sql .= " DirectManagerName,";
                $sql .= " NewDirectManagerID,";
                $sql .= " WorkID," . PHP_EOL;
                $sql .= " WorkName,";
                $sql .= " NewWorkID,";
                $sql .= " IsSalaryAdjustment,";
                $sql .= " BaseSalary01,";
                $sql .= " NewBaseSalary01,";
                $sql .= " BaseSalary02," . PHP_EOL;
                $sql .= " NewBaseSalary02,";
                $sql .= " BaseSalary03,";
                $sql .= " NewBaseSalary03,";
                $sql .= " BaseSalary04,";
                $sql .= " NewBaseSalary04,";
                $sql .= " Reason" . PHP_EOL;
                $sql .= ")VALUES(";
                $sql .= " '$proTransID',";
                $sql .= " '$EmployeeID',";
                $sql .= " $ValidDate,";
                $sql .= " '$DepartmentID',";
                $sql .= " N'$DepartmentName',";
                $sql .= " '$NewDepartmentID',";
                $sql .= " '$TeamID'," . PHP_EOL;
                $sql .= " N'$TeamName',";
                $sql .= " '$NewTeamID',";
                $sql .= " '$DirectManagerID',";
                $sql .= " N'$DirectManagerName',";
                $sql .= " '$NewDirectManagerID',";
                $sql .= " '$WorkID'," . PHP_EOL;
                $sql .= " N'$WorkName',";
                $sql .= " '$NewWorkID',";
                $sql .= " '$IsSalaryAdjustment',";
                $sql .= " $BaseSalary01,";
                $sql .= " $NewBaseSalary01,";
                $sql .= " $BaseSalary02," . PHP_EOL;
                $sql .= " $NewBaseSalary02,";
                $sql .= " $BaseSalary03,";
                $sql .= " $NewBaseSalary03,";
                $sql .= " $BaseSalary04,";
                $sql .= " $NewBaseSalary04,";
                $sql .= " N'$Reason'" . PHP_EOL;
                $sql .= ")" . PHP_EOL;

                $sql .= " -- Luu nghiep vu: Luu va ra quy trinh duyet nhieu cap" . PHP_EOL;
                $sql .= " EXEC W09P2151 '$companyID', '$divisionHR', '$EmployeeID', $tranMonth, $tranYear, '$userID','$companyID' ,$mode,'$proTransID'";
                $sql .= "-- Xoa bang tam" . PHP_EOL;
                $sql .= " DROP TABLE #W2150_$userID";

                //\Debugbar::info($sql);
                if ($sql != "") {
                    try {
                        $data = $this->connectionHR->select($sql);
                        //\Debugbar::info($data[0]);
                        if (count($data) > 0) {
                            $rs = $data[0];
                            //\Debugbar::info($data);
                            if ($rs['IsSendMail'] == 1) {
                                if ($rs['IsShowMailScreen'] == 0) {
                                    $res = $this->SendMailAuto($rs['EmailContent'], $rs);
                                    return json_encode(['status' => 'BACKGROUND', 'name' => $rs['EmailReceivedAddress'], "message" => $res]); // đã gửi mail
                                } else {
                                    //\Debugbar::info($rs);
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
            case 'deletetable':
                $sql = "-- Xoa bang tam" . PHP_EOL;
                $sql .= " DROP TABLE #W2150_$userID";
                $rsData = $this->connectionHR->select($sql);
                return $rsData;
                return "";
                break;
        }


    }

}
