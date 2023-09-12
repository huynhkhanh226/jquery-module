<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 01/11/2017
 * Time: 1:48 PM
 */
namespace W7X\W75;

use Auth;
use DB;
use Exception;
use Input;
use Request;
use Session;
use View;
use W7X\W7XController;
use Debugbar;
use Helpers;
use Config;
use Mail;

class W75F3005Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        $lang = Session::get("Lang");
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $UserID = Auth::user()->user()->UserID;
        $valueGrid1 = json_encode(array());
        $valueGrids = json_encode(array());
        $modalTitle = $this->getModalTitleG4($pForm);
        $caption2 = array();
        $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        $block = $this->LoadBlockByG4(Session::get("W91P0000")['HRDivisionID'], $UserID, $pForm, 1);
        //$employee = $this->LoadEmployeeByG4($pForm, $HRDivisionID, '', '', 1, '', '');
        $team = $this->LoadTeamByG4($pForm, $HRDivisionID, '%', 1);
        $period = $this->LoadPeriodData("D09", Session::get("W91P0000")['DivisionID']);
        \Debugbar::info($valueGrids);
        $creatorName = Session::get("W91P0000")['CreatorNameHR'];
        $creatorID = Session::get("W91P0000")['CreatorHR'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $days = cal_days_in_month(CAL_GREGORIAN,$tranMonth,$tranYear);

        switch ($task){
            case "":
                $sql = "-- Do nguon du an" . PHP_EOL;
                $sql .= "SELECT  '%' As ProjectID, N'".Helpers::getRS($g,"Tat_ca_Web")."' As ProjectName " . PHP_EOL;
                $sql .= "UNION" . PHP_EOL;
                $sql .= "SELECT  T1.ProjectID AS ProjectID, T1.DescriptionU AS ProjectName" . PHP_EOL;
                $sql .= "FROM  D09T1080 T1 WITH (NOLOCK)" . PHP_EOL;
                $sql .= "WHERE  T1.[Disabled] = 0";
                $projects = $this->connectionHR->select($sql);
                \Debugbar::info($projects);

                $sql1 = "--Do nguon Nhom nhan vien" . PHP_EOL;
                $sql1 .= "SELECT '%' As EmpGroupID, N'".Helpers::getRS($g,"Tat_ca_Web")."'  As EmpGroupName" . PHP_EOL;
                $sql1 .= "UNION" . PHP_EOL;
                $sql1 .= "SELECT EmpGroupID, EmpGroupName".$lang."U As EmpGroupName" . PHP_EOL;
                $sql1 .= "FROM D09T1210 T1 WITH(NOLOCK)" . PHP_EOL;
                $sql1 .= "INNER JOIN D91T0012 T2 WITH(NOLOCK) ON T1.DepartmentID = T2.DepartmentID". PHP_EOL;
                $sql1 .= "WHERE	T1.Disabled = 0 And T2.DivisionID = '$HRDivisionID'";
                $groupID = $this->connectionHR->select($sql1);
                \Debugbar::info($groupID);
                return View::make("W7X.W75.W75F3005", compact("valueGrids","pForm","projects","groupID", "g","tranMonth","tranYear","valueGrid1","period", "modalTitle", "block", "department", "team", "days"));
                break;

            case "filter":
                \Debugbar::info(Input::all());
                $AttFrom = Helpers::convertDate(Input::get('datefrom'));
                $AttTo = Helpers::convertDate(Input::get('dateto'));
                $BlockID = Input::get('cbBlockIDW75F3005');
                $DepartmentID = Input::get('cbDepartmentIDW75F3005');
                $TeamID = Input::get('cbTeamIDW75F3005');
                $EmpGroupID = Input::get('cbEmpGroupIDW75F3005');

                $sql = "--do cot ngay grid 1" .PHP_EOL;
                $sql .= "EXEC W75P3011 $AttFrom,$AttTo" .PHP_EOL;
                $colGrid1 = $this->connectionHR->select($sql);

                $sql2 = "--Do nguon grid 1". PHP_EOL;
                $sql2 .= "EXEC W75P3005	$AttFrom, $AttTo, '$BlockID', '$DepartmentID', '$TeamID', '$EmpGroupID', '$pForm', '$UserID','$lang', '$HRDivisionID'";
                $valueGrid1 = $this->connectionHR->select($sql2);

                \Debugbar::info($colGrid1);
                $dataArr = array(
                    0 => $colGrid1,
                    1 => $valueGrid1
                );
                \Debugbar::info($colGrid1);
                return json_encode($dataArr);
                break;

            case "sendMail":
                return json_encode(['rsvalue' => View::make('layout.sendmail',compact('rs'))->render()]);
                break;

            case "loadGrid2":
                \Debugbar::info(Input::all());
                $groupID = Input::get('groupID');
                $formID = Input::get('formID');
                $criteriaID = Input::get('criteriaID');
                $AttFrom = Helpers::convertDate(Input::get('datefrom'));
                $AttTo = Helpers::convertDate(Input::get('dateto'));
                $BlockID = Input::get('cbBlockIDW75F3005');
                $DepartmentID = Input::get('cbDepartmentIDW75F3005');
                $TeamID = Input::get('cbTeamIDW75F3005');
                $EmpGroupID = Input::get('cbEmpGroupIDW75F3005');
                $Project = Input::get('cbProjectIDW75F3005');

                $sql = "--Do caption luoi 2". PHP_EOL;
                $sql .= "EXEC W75P3008 '$groupID', '$criteriaID', '$lang'";
                $caption2 = $this->connectionHR->select($sql);
                \Debugbar::info($caption2);

                $sql1 = "--Do nguon luoi 2". PHP_EOL;
                $sql1 .= "EXEC W75P3006 $AttFrom, $AttTo, '$BlockID', '$DepartmentID', '$TeamID' , '$EmpGroupID', '$groupID', '$criteriaID','$formID','$UserID', '$HRDivisionID', '$Project', '$lang'";
                $valueGrid2 = $this->connectionHR->select($sql1);
                \Debugbar::info($valueGrid2);
                return View::make("W7X.W75.W75F3005_Ajax2", compact("pForm","g","caption2", "valueGrid2"));
                break;

            case "blockChange":
                $block = Input::get('blockID');
                $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], $block, 1,true);
                $strDep = "";
                foreach ($department as $row) {
                    $strDep .= "<option value='" .$row['DepartmentID']."' > ".$row['DepartmentName'].  "</option>";
                }
                $departmentID = count($department) > 0 ? $department[0]["DepartmentID"]: "%";
                $team = $this->LoadTeamByG4($pForm, $HRDivisionID, $departmentID, 1);
                $strTeam = "";
                foreach ($team as $row) {
                    $strTeam .= "<option value='" . $row["TeamID"] . "'>" . $row["TeamName"] . "</option>";
                }
                /*$teamID = count($team) > 0 ? $team[0]["TeamID"]: "%";
                $employee = $this->LoadEmployeeByG4($pForm, $HRDivisionID, $departmentID, $teamID, 1, '', $block);
                $strEm = "";
                foreach ($employee as $row) {
                    $strEm .= "<option value='" . $row["EmployeeID"] . "'>" . $row["EmployeeName"] . "</option>";
                }*/
                $valueCombos = array(
                    "strDep" => $strDep,
                    "strTeam" => $strTeam
                    //"strEm"=> $strEm
                );
                return $valueCombos;
                break;

            case "departmentChange":
                $blockID = Input::get('blockID');
                $departmentID = Input::get('departmentID');
                $team = $this->LoadTeamByG4($pForm, $HRDivisionID, $departmentID, 1);
                $strTeam = "";
                foreach ($team as $row) {
                    $strTeam .= "<option value='" . $row["TeamID"] . "'>" . $row["TeamName"] . "</option>";
                }
                /*$teamID = count($team) > 0 ? $team[0]["TeamID"]: "%";
                $employee = $this->LoadEmployeeByG4($pForm, $HRDivisionID, $departmentID, $teamID, 1, '', $blockID);
                $strEm = "";
                foreach ($employee as $row) {
                    $strEm .= "<option value='" . $row["EmployeeID"] . "'>" . $row["EmployeeName"] . "</option>";
                }*/
                $valueCombos = array(
                    "strTeam" => $strTeam
                    //"strEm"=> $strEm
                );
                return $valueCombos;
                break;

            case "teamChange":
                /*$blockID = Input::get('blockID');
                $departmentID = Input::get('departmentID');
                $teamID = Input::get('teamID');
                $employee = $this->LoadEmployeeByG4($pForm, $HRDivisionID, $departmentID, $teamID, 1, '', $blockID);
                $strEm = "";
                foreach ($employee as $row) {
                    $strEm .= "<option value='" . $row["EmployeeID"] . "'>" . $row["EmployeeName"] . "</option>";
                }
                $valueCombos = array(
                    "strEm"=> $strEm
                );
                return $valueCombos;
                break;*/

            case "save":
                \Debugbar::info(Input::all());
                $sql = "";
                $dataSender = Input::get('dataSender');
                \Debugbar::info($dataSender[0]['GroupID']);
                $tableName = "#W75P3007_$UserID";
                \Debugbar::info($tableName);
                \Debugbar::info(count($dataSender));
                if(intval($dataSender[0]['GroupID']) == 2){
                    $sql = "--Tao bang tam chua du lieu luu" . PHP_EOL;
                    $sql .= "CREATE TABLE $tableName (";
                    $sql .= " EmployeeID varchar(50),";
                    $sql .= " FormID varchar(50),";
                    $sql .= " GroupID varchar(50),";
                    $sql .= " CriteriaID varchar(50),";
                    $sql .= " AttendanceDate DATETIME,";
                    $sql .= " AttendanceType varchar(50),";
                    $sql .= " ShiftID varchar(50)," . PHP_EOL;
                    $sql .= " TimeOn1 varchar(6),";
                    $sql .= " TimeOff1 varchar(6),";
                    $sql .= " TimeOn2 varchar(6),";
                    $sql .= " TimeOff2 varchar(6),";
                    $sql .= " TimeOn3 varchar(6),";
                    $sql .= " TimeOff3 varchar(6)," . PHP_EOL;
                    $sql .= " TimeOn4 varchar(6),";
                    $sql .= " TimeOff4 varchar(6),";
                    $sql .= " TimeOn5 varchar(6),";
                    $sql .= " TimeOff5 varchar(6)";
                    $sql .= ")" . PHP_EOL;

                    for ($i = 0; $i < count($dataSender); $i++) {
                        $EmployeeID = $this->sqlstring($dataSender[$i]["EmployeeID"]);
                        $FormID = $this->sqlstring($dataSender[$i]["FormID"]);
                        $GroupID = $this->sqlstring($dataSender[$i]["GroupID"]);
                        $CriteriaID = $this->sqlstring($dataSender[$i]["CriteriaID"]);
                        $AttendanceDate = Helpers::convertDate($dataSender[$i]["AttendanceDate"]);
                        $AttendanceType = $this->sqlstring($dataSender[$i]["AttendanceType"]);
                        $ShiftID = $this->sqlstring($dataSender[$i]["ShiftID"]);
                        $TimeOn1 = $this->sqlstring($dataSender[$i]["TimeOn1"]);
                        $TimeOff1 = $this->sqlstring($dataSender[$i]["TimeOff1"]);
                        $TimeOn2 = $this->sqlstring($dataSender[$i]["TimeOn2"]);
                        $TimeOff2 = $this->sqlstring($dataSender[$i]["TimeOff2"]);
                        $TimeOn3 = $this->sqlstring($dataSender[$i]["TimeOn3"]);
                        $TimeOff3 = $this->sqlstring($dataSender[$i]["TimeOff3"]);
                        $TimeOn4 = $this->sqlstring($dataSender[$i]["TimeOn4"]);
                        $TimeOff4 = $this->sqlstring($dataSender[$i]["TimeOff4"]);
                        $TimeOn5 = $this->sqlstring($dataSender[$i]["TimeOn5"]);
                        $TimeOff5 = $this->sqlstring($dataSender[$i]["TimeOff5"]);

                        $sql .= "--Insert $tableName" . PHP_EOL;
                        $sql .= "set nocount on" . PHP_EOL;
                        $sql .= "INSERT INTO $tableName(";
                        $sql .= " EmployeeID,";
                        $sql .= " FormID,";
                        $sql .= " GroupID,";
                        $sql .= " CriteriaID,";
                        $sql .= " AttendanceDate,";
                        $sql .= " AttendanceType,";
                        $sql .= " ShiftID," . PHP_EOL;
                        $sql .= " TimeOn1,";
                        $sql .= " TimeOff1,";
                        $sql .= " TimeOn2,";
                        $sql .= " TimeOff2,";
                        $sql .= " TimeOn3," . PHP_EOL;
                        $sql .= " TimeOff3,";
                        $sql .= " TimeOn4,";
                        $sql .= " TimeOff4,";
                        $sql .= " TimeOn5,";
                        $sql .= " TimeOff5";
                        $sql .= ")VALUES(";
                        $sql .= " '$EmployeeID',";
                        $sql .= " '$FormID',";
                        $sql .= " '$GroupID',";
                        $sql .= " '$CriteriaID',";
                        $sql .= " $AttendanceDate,";
                        $sql .= " '$AttendanceType',";
                        $sql .= " '$ShiftID'," . PHP_EOL;
                        $sql .= " '$TimeOn1',";
                        $sql .= " '$TimeOff1',";
                        $sql .= " '$TimeOn2',";
                        $sql .= " '$TimeOff2',";
                        $sql .= " '$TimeOn3',";
                        $sql .= " '$TimeOff3'," . PHP_EOL;
                        $sql .= " '$TimeOn4',";
                        $sql .= " '$TimeOff4',";
                        $sql .= " '$TimeOn5',";
                        $sql .= " '$TimeOff5'";
                        $sql .= ")" . PHP_EOL;
                    }
                }

               // \Debugbar::info($sql);
               if ($sql != '') {
                    try {
                        $sql .= "-- Thuc thi store luu du lieu". PHP_EOL;
                        $sql .="EXEC  W75P3007 '$HRDivisionID', '$UserID', '$pForm'";
                        \Debugbar::info($sql);
                        $this->connectionHR->statement($sql);
                        //$rs = $this->connectionHR->statement($sql);
                        //\Debugbar::info($rs);
                        return array('status' => 1, 'message' => '');
                    } catch (Exception $ex) {
                        \Debugbar::info($ex);
                        return array('status' => 0, 'message' => $ex->getMessage());
                    }
                } else {
                    return array('status' => 0);
                }
                break;
        }
    }
}