<?php
namespace W7X\W75;

use Auth;
use DB;
use Exception;
use Input;
use Request;
use Session;
use View;
use W7X\W7XController;
use Helpers;
use Config;
use Mail;

class W75F4080Controller extends W7XController
{
    //Khi open tab s? g?i controller này

    public function index($pForm, $g, $task = '')
    {
        $all = Input::all();
        $division = Session::get("W91P0000")['HRDivisionID'];
        $hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID : Auth::ess()->user()->HREmployeeID;
        $lang = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];
        \Debugbar::info($task);
        $isApproval = 0;
        $modalTitle= $this->getModalTitleG4($pForm);
        switch ($task) {
            case '':
                $sql = "--Combo StatusID" . PHP_EOL;
                $sql .= "set nocount on " . PHP_EOL;
                $sql .= "SELECT 	ID, Name".$lang."U as Name " . PHP_EOL;
                $sql .= "FROM 	W75N5555 ('D75F4080','','','','') " . PHP_EOL;
                $sql .= "ORDER BY OrderNo" . PHP_EOL;

                //\Debugbar::info($sql);
                $statusList = array();
                $statusList = $this->connectionHR->select($sql);

                $sql = "--Default data from - to" . PHP_EOL;
                $sql .= "EXEC W75P2001 ";
                $sql .= "$tranmonth,";
                $sql .= "$tranyear,";
                $sql .= "null,";
                $sql .= "null,";
                $sql .= "2,";
                $sql .= "0,";
                $sql .= "0,";
                $sql .= "''";
                $rsDate = $this->connectionHR->selectOne($sql);
                if (count($rsDate) > 0){
                    $txtDateFrom = Helpers::convertDate($rsDate["MinDate"]);
                    $txtDateTo = Helpers::convertDate($rsDate["MaxDate"]);
                }else{
                    $txtDateFrom = null;
                    $txtDateTo = null;
                }

				$sql = "--Do nguon so phut di tre".PHP_EOL;
				$sql .= " SET NOCOUNT ON SELECT CONVERT(int,t1.[Values]) AS LateMinute".PHP_EOL;
				$sql .= " FROM D29T1091 AS T1 WITH (NOLOCK)".PHP_EOL;
				$sql .= " WHERE T1.[Type] = 'Division' AND T1.Maxvalues <> 0 AND T1.TimeCode = 1".PHP_EOL;
				$sql .= " GROUP BY t1.[Values]".PHP_EOL;
				$sql .= " ORDER BY t1.[Values]".PHP_EOL;
				$rsAfter = json_encode($this->connectionHR->select($sql));
				\Debugbar::info($rsAfter);
				$sql = "--Do nguon so phut ve som".PHP_EOL;
				$sql .= " SET NOCOUNT ON SELECT CONVERT(int,t1.[Values]) AS EarlyMinute".PHP_EOL;
				$sql .= " FROM D29T1091 AS T1 WITH (NOLOCK)".PHP_EOL;
				$sql .= " WHERE T1.[Type] = 'Division' AND T1.Maxvalues <> 0 AND T1.TimeCode = 2".PHP_EOL;
				$sql .= " GROUP BY t1.[Values]".PHP_EOL;
				$sql .= " ORDER BY t1.[Values]".PHP_EOL;
				$rsEarly =json_encode($this->connectionHR->select($sql));

                $sql = "-- Load nguon cho luoi ". PHP_EOL;
                $sql .= "EXEC W75P4080	'$division', ";
                $sql .= "$txtDateFrom, ";
                $sql .= "$txtDateTo, ";
                $sql .= "'',";
                $sql .= "'$userid', ";
                $sql .= "'D75P4080',";
                $sql .= "'$lang',";
                $sql .= "'0'";
                $rsData = array();
                $rsData = $this->connectionHR->select($sql);
                \Debugbar::info($rsData);
                return View::make("W7X.W75.W75F4080", compact('pForm', 'g','rsAfter','rsEarly','modalTitle', 'task', 'statusList', 'rsDate', 'rsData','isApproval'));
                break;
            case 'list':
                \Debugbar::info($all);
                $txtDateFrom = Helpers::convertDate(Input::get('txtDateFrom',''));
                $txtDateTo = Helpers::convertDate(Input::get('txtDateTo','')) ;
                if ($txtDateFrom == "null" || $txtDateTo == "null"){
                    $sql = "--Default data from - to" . PHP_EOL;
                    $sql .= "EXEC W75P2001 ";
                    $sql .= "$tranmonth,";
                    $sql .= "$tranyear,";
                    $sql .= "null,";
                    $sql .= "null,";
                    $sql .= "2,";
                    $sql .= "0,";
                    $sql .= "0,";
                    $sql .= "''";
                    $rsDate = $this->connectionHR->selectOne($sql);
                    if (count($rsDate) > 0){
                        $txtDateFrom = Helpers::convertDate($rsDate["MinDate"]);
                        $txtDateTo = Helpers::convertDate($rsDate["MaxDate"]);
                    }
                }
                $txtEmployeeIDW75F4080 = Input::get('txtEmployeeIDW75F4080','');
                $cbStatusID = Input::get('cbStatusID',0);
                $sql = "-- Load nguon cho luoi ". PHP_EOL;
                $sql .= "EXEC W75P4080	'$division', ";
                $sql .= "$txtDateFrom, ";
                $sql .= "$txtDateTo, ";
                $sql .= "'$txtEmployeeIDW75F4080',";
                $sql .= "'$userid', ";
                $sql .= "'D75P4080',";
                $sql .= "'$lang',";
                $sql .= "'$cbStatusID'";
                $rsData = array();
                $rsData = array();
                $rsData = $this->connectionHR->select($sql);
                /*foreach($rsData1 as $row){
                    //\Debugbar::info($row["LateMinute"] == "0");
                    $row["LateMinute"] = $row["LateMinute"] == "0" ? null : $row["LateMinute"];
                    $row["EarlyMinute"] = $row["EarlyMinute"] == "0" ? null : $row["EarlyMinute"];
                    if ($row["ApprovedLate"] == 1){
                        $row["IsEditApprovedLate"] = 0;
                    }else{
                        $row["IsEditApprovedLate"] = 1;
                    }
                    if ($row["ApprovedEarly"] == 1){
                        $row["IsEditApprovedEarly"] = 0;
                    }else{
                        $row["IsEditApprovedEarly"] = 1;
                    }
                    array_push($rsData, $row);
                }*/
                \Debugbar::info($rsData);
                return $rsData;
                break;
            case 'save':
                $obj = $all['obj'];
                $sql = '';
                if ($obj != null) {


                    $sql = "--Tao bang tam chua du lieu luu" . PHP_EOL;
                    $sql .= "CREATE TABLE #D75P4080Temp (";
                    $sql .= "Times 		INT ,";
                    $sql .= "EmployeeID         	VARCHAR(20),";
                    $sql .= "AttendanceDate     	DATETIME,";
                    $sql .= "ShiftID            		VARCHAR(20),";
                    $sql .= "LateMinute         		INT,";
                    $sql .= "LateTimeIn         		VARCHAR(6),";
                    $sql .= "ApprovedLate		TINYINT,";
                    $sql .= "NotApprovedLate	TINYINT,";
                    $sql .= "EarlyMinute        		INT,";
                    $sql .= "EarLyTimeOut       	VARCHAR(6),";
                    $sql .= "ApprovedEarly		TINYINT,";
                    $sql .= "NotApprovedEarly	TINYINT,";
                    $sql .= "Reason			NVARCHAR(500),";
                    $sql .= "Note              		NVARCHAR(500),";
                    $sql .= "IsUpdate 			TINYINT";
                    $sql .= ")" . PHP_EOL;
                    foreach ($obj as $row) {
                        \Debugbar::info($row);
                        $Times = $row["Times"];
                        $EmployeeID = $row["EmployeeID"];
                        $AttendanceDate = Helpers::convertDate(Helpers::decode_string($row["AttendanceDate"]));
                        $ShiftID = $row["ShiftID"];
                        $LateMinute = $row["LateMinute"] =="" ? 0 : $row["LateMinute"];
                        $LateTimeIn = str_replace(":", "", Helpers::decode_string($row["LateTimeIn"]));
                        $ApprovedLate = $row["ApprovedLate"];
                        $NotApprovedLate = $row["NotApprovedLate"];
                        $EarlyMinute = $row["EarlyMinute"] == "" ? 0:$row["EarlyMinute"];
                        $EarLyTimeOut = str_replace(":", "", Helpers::decode_string($row["EarLyTimeOut"]));
                        $ApprovedEarly = $row["ApprovedEarly"];
                        $NotApprovedEarly = $row["NotApprovedEarly"];
                        $Reason = $row["Reason"];
                        $Note = $row["Note"];
                        $IsUpdate = $row["IsUpdate"];

                        $sql .= "--Insert du lieu bang tam" . PHP_EOL;
                        $sql .= "set nocount on" . PHP_EOL;
                        $sql .= "INSERT INTO #D75P4080Temp(";
                        $sql .= "Times,";
                        $sql .= "EmployeeID,";
                        $sql .= "AttendanceDate,";
                        $sql .= "ShiftID,";
                        $sql .= "LateMinute,";
                        $sql .= "LateTimeIn,";
                        $sql .= "ApprovedLate,";
                        $sql .= "NotApprovedLate,";
                        $sql .= "EarlyMinute,";
                        $sql .= "EarLyTimeOut,";
                        $sql .= "ApprovedEarly,";
                        $sql .= "NotApprovedEarly,";
                        $sql .= "Reason,";
                        $sql .= "Note,";
                        $sql .= "IsUpdate";
                        $sql .= ")VALUES(";
                        $sql .= "$Times,";
                        $sql .= "'$EmployeeID',";
                        $sql .= "$AttendanceDate,";
                        $sql .= "'$ShiftID',";
                        $sql .= "  $LateMinute,";
                        $sql .= "'$LateTimeIn',";
                        $sql .= "$ApprovedLate,";
                        $sql .= "$NotApprovedLate,";
                        $sql .= "$EarlyMinute,";
                        $sql .= "'$EarLyTimeOut',";
                        $sql .= "$ApprovedEarly,";
                        $sql .= "$NotApprovedEarly,";
                        $sql.="N'".$this->sqlstring($Reason)."',";
                        $sql.="N'".$this->sqlstring($Note)."',";
                        $sql .= "$IsUpdate";
                        $sql .= ")" . PHP_EOL;
                    }
                    $sql .= "---	Thuc thi store luu du lieu " . PHP_EOL;
                    $sql .= "EXEC  W75P4085   '$division','$userid'". PHP_EOL;
                }

                if ($sql != '') {
                    try {
                        //\Debugbar::info($sql);
                        $data = $this->connectionHR->select($sql);
                        \Debugbar::info($data);
                        $rs = [];
                        if (count($data) > 0){
                            $rs = $data[0];
                            \Debugbar::info($rs);
                            \Debugbar::info(intval($rs['IsSentMail']));
                            if (intval($rs['IsSentMail']) == 1) {
                                \Debugbar::info(intval($rs['IsShowMailScreen']));
                                if (intval($rs['IsShowMailScreen']) == 0) {
                                    $res = $this->SendMailAuto($rs['EmailContent'], $rs);
                                    return json_encode(['status' => 'BACKGROUND', 'name' => $rs['EmailReceivedAddress'], "message" => $res]); // đã gửi mail
                                } else {
                                    //\Debugbar::info($rs);
                                    return json_encode(['status' => "SHOWMAIL", 'name' => $rs['EmailReceivedAddress'], 'data' => $rs, 'rsvalue' => View::make('layout.sendmail', compact('rs'))->render()]);
                                }
                            } else {
                                return json_encode(['status' => "NOSEND"]);  // không gửi mail
                            }
                        }else {
                            return json_encode(['status' => "NOSEND"]);  // không gửi mail
                        }
                        //return array('status' => 1, 'rowData'=>$rs);
                    } catch (Exception $ex) {
                        //\Debugbar::info($ex);
                        return json_encode(['status' => 'ERROR', "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }else{
                    return json_encode(['status' => 'ERROR', "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }
                break;
            default:
                //Do nothing here
        }

    }
    public function viewFromMail($pForm,$g,$isApproval=0,$id='',$iddt='') {
        $all = Input::all();
        $modalTitle= $this->getModalTitleG4($pForm);
        $division = Session::get("W91P0000")['HRDivisionID'];
        $hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID : Auth::ess()->user()->HREmployeeID;
        $lang = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];
        $sql = "--Combo StatusID" . PHP_EOL;
        $sql .= "set nocount on " . PHP_EOL;
        $sql .= "SELECT 	ID, Name84U as Name " . PHP_EOL;
        $sql .= "FROM 	W75N5555 ('D75F4080','','','','') " . PHP_EOL;
        $sql .= "ORDER BY OrderNo" . PHP_EOL;
        $statusList = $this->connectionHR->select($sql);

        $sql = "--Default data from - to" . PHP_EOL;
        $sql .= "EXEC W75P2001 ";
        $sql .= "$tranmonth,";
        $sql .= "$tranyear,";
        $sql .= "null,";
        $sql .= "null,";
        $sql .= "2,";
        $sql .= "0,";
        $sql .= "0,";
        $sql .= "''";
        $rsDate = $this->connectionHR->selectOne($sql);


        if (count($rsDate) > 0){
            $txtDateFrom = Helpers::convertDate($rsDate["MinDate"]);
            $txtDateTo = Helpers::convertDate($rsDate["MaxDate"]);
        }else{
            $txtDateFrom = null;
            $txtDateTo = null;
        }

		$rsAfter= [];
		$sql = "--Do nguon so phut di tre".PHP_EOL;
		$sql .= " SET NOCOUNT ON SELECT CONVERT(int,t1.[Values]) AS LateMinute".PHP_EOL;
		$sql .= " FROM D29T1091 AS T1 WITH (NOLOCK)".PHP_EOL;
		$sql .= " WHERE T1.[Type] = 'Division' AND T1.Maxvalues <> 0 AND T1.TimeCode = 1".PHP_EOL;
		$sql .= " GROUP BY t1.[Values]".PHP_EOL;
		$sql .= " ORDER BY t1.[Values]".PHP_EOL;
		\Debugbar::info($sql);
		$rsAfter = json_encode($this->connectionHR->select($sql));
		\Debugbar::info($rsAfter);
		$rsEarly=[];
		$sql = "--Do nguon so phut ve som".PHP_EOL;
		$sql .= " SET NOCOUNT ON SELECT CONVERT(int,t1.[Values]) AS EarlyMinute".PHP_EOL;
		$sql .= " FROM D29T1091 AS T1 WITH (NOLOCK)".PHP_EOL;
		$sql .= " WHERE T1.[Type] = 'Division' AND T1.Maxvalues <> 0 AND T1.TimeCode = 2".PHP_EOL;
		$sql .= " GROUP BY t1.[Values]".PHP_EOL;
		$sql .= " ORDER BY t1.[Values]".PHP_EOL;
		$rsEarly =json_encode($this->connectionHR->select($sql));

        $sql = "-- Load nguon cho luoi ". PHP_EOL;
        $sql .= "EXEC W75P4080	'$division', ";
        $sql .= "$txtDateFrom, ";
        $sql .= "$txtDateTo, ";
        $sql .= "'',";
        $sql .= "'$userid', ";
        $sql .= "'D75P4080',";
        $sql .= "'$lang',";
        $sql .= "0 ";
        $rsData = $this->connectionHR->select($sql);
        \Debugbar::info($rsData);
        return View::make("W7X.W75.W75F4080", compact('pForm', 'g','modalTitle', 'task', 'statusList', 'rsDate', 'rsData','isApproval','rsAfter','rsEarly'));
    }
}
