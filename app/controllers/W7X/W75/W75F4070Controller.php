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
use Debugbar;
use Helpers;
use Config;
use Mail;

class W75F4070Controller extends W7XController
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
        //\Debugbar::info($task);
        $txtEmployeeIDW75F4070 = Input::get('txtEmployeeIDW75F4070','');
        //$modalTitle= $this->getModalTitle($pForm);
        $modalTitle = $this->getModalTitleG4($pForm);
        //\Debugbar::info($modalTitle);
        //\Debugbar::info($pForm);
		$isApproval = 0;

        $sql = "--Lay thong thiet OT" . PHP_EOL;
        $sql .= " set nocount on " . PHP_EOL;
        $sql .= " select * from D29T0003 where TransTypeID='DKTC'" . PHP_EOL;
        $rsTemp = $this->connectionHR->selectOne($sql);
        $isHideOT = $rsTemp["NumValue"];
        $sql = "--Lay thong thiet OT" . PHP_EOL;
        $sql .= " set nocount on " . PHP_EOL;
        $sql .= " select * from D29T0003 where TransTypeID='ConfirmOT'" . PHP_EOL;
        $rsTemp = $this->connectionHR->selectOne($sql);
        $isHideConfirmOT = $rsTemp["NumValue"];

        switch ($task) {
            case '':
                $isApproval = Input::get('status', 0); //Tham so nay nhan  tu canh bao
                //\Debugbar::info("sdfsfa");
                $sql = "--Combo StatusID" . PHP_EOL;
                $sql .= "set nocount on " . PHP_EOL;
                $sql .= "SELECT 	ID, Name".$lang."U as Name " . PHP_EOL;
                $sql .= "FROM 	W75N5555 ('D75F4070','','','','') " . PHP_EOL;
                $sql .= "ORDER BY OrderNo" . PHP_EOL;

                //\Debugbar::info('test');
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

                /*$sql = "-- Load nguon cho luoi ". PHP_EOL;
                $sql .= "EXEC W75P4070	'$division', ";
                $sql .= "$txtDateFrom, ";
                $sql .= "$txtDateTo, ";
                $sql .= "'$txtEmployeeIDW75F4070',";
                $sql .= "'$userid', ";
                $sql .= "'D75P4070',";
                $sql .= "'$lang',";
                $sql .= "'0'";
                //\Debugbar::info($sql);
                $rsData = $this->connectionHR->select($sql);*/

                return View::make("W7X.W75.W75F4070", compact("isApproval", "isHideConfirmOT","isHideOT",'pForm', 'g','modalTitle', 'task', 'statusList', 'rsDate','isApproval'));
                break;

            case 'list':
                //\Debugbar::info($all);
                $cboStatus = Input::get("cbStatusID", 0);
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
                $txtEmployeeIDW75F4070 = Input::get('txtEmployeeIDW75F4070','');
                $cbStatusID = Input::get('cbStatusID',0);
                $sql = "-- Load nguon cho luoi ". PHP_EOL;
                $sql .= "EXEC W75P4070	'$division', ";
                $sql .= "$txtDateFrom, ";
                $sql .= "$txtDateTo, ";
                $sql .= "'$txtEmployeeIDW75F4070',";
                $sql .= "'$userid', ";
                $sql .= "'D75P4070',";
                $sql .= "'$lang',";
                $sql .= "'$cbStatusID'";
                $rsTemp = $this->connectionHR->select($sql);
                $rsData = [];
                foreach($rsTemp as $row){
                    $row["PreOTHoursSplit"] = number_format($row["PreOTHoursSplit"], 2);
                    $row["PreOTLeave"] = number_format($row["PreOTLeave"], 2);
                    $row["AfterOTHoursSplit"] = number_format($row["AfterOTHoursSplit"], 2);
                    $row["AfterOTLeave"] = number_format($row["AfterOTLeave"], 2);
                    array_push($rsData, $row);

                }

                //\Debugbar::info($rsData);
				//\Debugbar::info(json_encode($rsData));
                //return $rsData;
                return View::make("W7X.W75.W75F4070_Ajax", compact("cboStatus","isHideConfirmOT","isHideOT",'pForm', 'g','modalTitle', 'task', 'rsData'));
                break;
            case 'save':
                $obj = $all['obj'];
                $statusID = Input::get("statusID", "");
                $sql = '';

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


                if ($obj != null) {
                    $sql = "--Tao bang tam chua du lieu luu" . PHP_EOL;
                    $sql .= "CREATE TABLE #D75P4070Temp (";
                    $sql .= "TransID         		VARCHAR(50),";
                    $sql .= "Times              		INT,";
                    $sql .= "EmployeeID         	VARCHAR(50),";
                    $sql .= "AttendanceDate     	DATETIME,";
                    $sql .= "ShiftID            		VARCHAR(50),";
                    $sql .= "PreOTFrom		VARCHAR(5),";
                    $sql .= "PreOTTo			VARCHAR(5),";
                    $sql .= "PreOTHours		DECIMAL(19, 4),";
                    $sql .= "ApprovedPre			TINYINT,";
                    $sql .= "NotApprovedPre			TINYINT,";
                    $sql .= "AfterOTFrom		VARCHAR(5),";
                    $sql .= "AfterOTTo			VARCHAR(5),";
                    $sql .= "AfterOTHours		DECIMAL(19, 4),";
                    $sql .= "ApprovedAfter			TINYINT,";
                    $sql .= "NotApprovedAfter			TINYINT,";
                    $sql .= "Note 			NVARCHAR (500),";
                    $sql .=" PreOTHoursSplit	decimal(19,4),";
                    $sql .=" PreOTLeave	decimal(19,4),";
                    $sql .=" AfterOTHoursSplit 	decimal(19,4),";
                    $sql .=" AfterOTLeave	decimal(19,4),";
                    $sql .=" IsPriorityLeave	 Tinyint,";
                    $sql .=" PreConfirm	 Tinyint,";
                    $sql .=" PreNotConfirm	 Tinyint,";
                    $sql .=" AfterConfirm	 Tinyint,";
                    $sql .=" AfterNotConfirm	 Tinyint,";
                    $sql .=" IsConfirm	 Tinyint,";


                    $sql .= "IsUpdate 			TINYINT";
                    $sql .= ")" . PHP_EOL;

                    foreach ($obj as $row) {
                        $TransID = $row["TransID"];
                        $Times = $row["Times"];
                        $EmployeeID = $row["EmployeeID"];
                        $AttendanceDate = Helpers::convertDate(Helpers::decode_string($row["AttendanceDate"]));
                        $ShiftID = $row["ShiftID"];
                        $PreOTFrom = str_replace("_","0",str_replace(":", "", Helpers::decode_string($row["PreOTFrom"])));
                        $PreOTTo = str_replace("_","0",str_replace(":", "", Helpers::decode_string($row["PreOTTo"])));
                        $PreOTHours = $row["PreOTHours"] == '' ? number_format(0,2) : $row["PreOTHours"];
                        $ApprovedPre = $row["ApprovedPre"];
                        $NotApprovedPre = $row["NotApprovedPre"];
                        $AfterOTFrom = str_replace("_","0",str_replace(":", "", Helpers::decode_string($row["AfterOTFrom"])));
                        $AfterOTTo = str_replace("_","0",str_replace(":", "", Helpers::decode_string($row["AfterOTTo"])));
                        $AfterOTHours = $row["AfterOTHours"] == '' ? number_format(0,2) : $row["AfterOTHours"];
                        $ApprovedAfter = $row["ApprovedAfter"];
                        $NotApprovedAfter = $row["NotApprovedAfter"];
                        $Note = $this->sqlstring($row["Note"]) ;
                        $IsUpdate = $row["IsUpdate"];
                        $PreConfirm = $row["PreConfirm"];
                        $PreNotConfirm = $row["PreNotConfirm"];
                        $AfterConfirm = $row["AfterConfirm"];
                        $AfterNotConfirm = $row["AfterNotConfirm"];
                        $IsConfirm = $row["IsConfirm"];


                        $preOTHoursSplit = number_format(Helpers::sqlNumber($row["PreOTHoursSplit"]),2);
                        $preOTLeave  = number_format(Helpers::sqlNumber($row["PreOTLeave"]),2);
                        $afterOTHoursSplit   = number_format(Helpers::sqlNumber($row["AfterOTHoursSplit"]),2);
                        $afterOTLeave  = number_format(Helpers::sqlNumber($row["AfterOTLeave"] ),2);
                        $isPriorityLeave = number_format(Helpers::sqlNumber($row["IsPriorityLeave"] ),0);


                        $sql .= "--Insert du lieu bang tam" . PHP_EOL;
                        $sql .= "set nocount on" . PHP_EOL;
                        $sql .= "INSERT INTO #D75P4070Temp(";
                        $sql .= "TransID,";
                        $sql .= "Times,";
                        $sql .= "EmployeeID,";
                        $sql .= "AttendanceDate,";
                        $sql .= "ShiftID,";
                        $sql .= "PreOTFrom,";
                        $sql .= "PreOTTo,";
                        $sql .= "PreOTHours,";
                        $sql .= "ApprovedPre,";
                        $sql .= "NotApprovedPre,";
                        $sql .= "AfterOTFrom,";
                        $sql .= "AfterOTTo,";
                        $sql .= "AfterOTHours,";
                        $sql .= "ApprovedAfter,";
                        $sql .= "NotApprovedAfter,";
                        $sql .= "Note,";
                        $sql .="PreOTHoursSplit,";
                        $sql .="PreOTLeave,";
                        $sql .="AfterOTHoursSplit ,";
                        $sql .="AfterOTLeave, ";
                        $sql .="IsPriorityLeave,";




                        $sql .=" PreConfirm	,";
                        $sql .=" PreNotConfirm,";
                        $sql .=" AfterConfirm,";
                        $sql .=" AfterNotConfirm,";
                        $sql .=" IsConfirm,";

                        $sql .= "IsUpdate";
                        $sql .= ")VALUES(";
                        $sql .= "'$TransID',";
                        $sql .= "$Times,";
                        $sql .= "'$EmployeeID',";
                        $sql .= "$AttendanceDate,";
                        $sql .= "'$ShiftID',";
                        $sql .= "'$PreOTFrom',";
                        $sql .= "'$PreOTTo',";
                        $sql .= "$PreOTHours,";
                        $sql .= "$ApprovedPre,";
                        $sql .= "$NotApprovedPre,";
                        $sql .= "'$AfterOTFrom',";
                        $sql .= "'$AfterOTTo',";
                        $sql .= "$AfterOTHours,";
                        $sql .= "$ApprovedAfter,";
                        $sql .= "$NotApprovedAfter,";
                        $sql.="N'".$this->sqlstring($Note)."',";
                        $sql.="$preOTHoursSplit,";
                        $sql.="$preOTLeave,";
                        $sql.="$afterOTHoursSplit,";
                        $sql.="$afterOTLeave,";
                        $sql.="$isPriorityLeave,";

                        $sql.="$PreConfirm,";
                        $sql.="$PreNotConfirm,";
                        $sql.="$AfterConfirm,";
                        $sql.="$AfterNotConfirm,";
                        $sql.="$IsConfirm,";

                        $sql .= "$IsUpdate";
                        $sql .= ")" . PHP_EOL;
                    }
                    $sql .= "---	Thuc thi store luu du lieu " . PHP_EOL;
                    $sql .= "EXEC  W75P4075   '$division','$userid', $txtDateFrom,$txtDateTo, $statusID". PHP_EOL;
                }
                \Debugbar::info($sql);
                if ($sql != '') {
                    try {
                        //\Debugbar::info($sql);
                        $data = $this->connectionHR->select($sql);
                        \Debugbar::info($data);
                        $rs = [];
                        if (count($data) > 0){
                            $rs = $data[0];
                            \Debugbar::info($rs);
                            if(intval($rs['Status']) == 0){//truong hop khong loi
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
                            }
                            if(intval($rs['Status']) == 1){//truong hop loi
                                return json_encode(['status' => $rs['Message']]);
                            }
                        }else {
                            return json_encode(['status' => "NOSEND"]);  // không gửi mail
                        }
                        //return array('status' => 1, 'rowData'=>$rs);
                    } catch (Exception $ex) {
                        \Debugbar::info($ex);
                        return json_encode(['status' => 'ERROR', "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu"), "message"=>$ex->getMessage()]);
                    }
                }else{
                    return json_encode(['status' => 'ERROR', "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }
                break;
            case 'check':
                $session = Session::getId();
                $row = Input::get('rowData');
                $ShiftID = $row["ShiftID"];
                $PreOTFrom = str_replace("_","0",str_replace(":", "", Helpers::decode_string($row["PreOTFrom"])));
                $PreOTTo = str_replace("_","0",str_replace(":", "", Helpers::decode_string($row["PreOTTo"])));
                $AfterOTFrom = str_replace("_","0",str_replace(":", "", Helpers::decode_string($row["AfterOTFrom"])));
                $AfterOTTo = str_replace("_","0",str_replace(":", "", Helpers::decode_string($row["AfterOTTo"])));
                $TransID = $row["TransID"];
                $ColField = Input::get('field');
                $attdate = Helpers::convertDate(Helpers::decode_string($row['AttendanceDate']));


                $sql = '--Kiem tra du lieu hop le'.PHP_EOL;
                $sql .= "Exec W75P5555
                '$division','$lang', '$userid', '$session', 0,
                'D75F4070', '$hr_employee_id','$ShiftID','$PreOTFrom','$PreOTTo',
                '$AfterOTFrom','$AfterOTTo','$TransID',0
                ,0,0,0,0,$attdate,
                null,null,'$ColField'";

                //\Debugbar::info($sql);
                $result = $this->connectionHR->select($sql);

                if (count($result)>0){
                    return array('status'=>$result[0]['Status'],'message'=> $result[0]['Message']);
                }else{
                    return array('status'=>1,'message'=> 'Fix errors.');
                }
                //return array('status'=>0,'message'=> 'Dữ liệu không hợp lệ.');
                break;
        }

    }
    public function viewFromMail($pForm,$g,$isApproval=0,$id='',$iddt='') {
        $all = Input::all();
        $division = Session::get("W91P0000")['HRDivisionID'];
        $hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID : Auth::ess()->user()->HREmployeeID;
        $lang = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];
        $modalTitle= $this->getModalTitleG4($pForm);
        $sql = "--Combo StatusID" . PHP_EOL;
        $sql .= "set nocount on " . PHP_EOL;
        $sql .= "SELECT 	ID, Name84U as Name " . PHP_EOL;
        $sql .= "FROM 	W75N5555 ('D75F4070','','','','') " . PHP_EOL;
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


        $sql = "-- Load nguon cho luoi ". PHP_EOL;
        $sql .= "EXEC W75P4070	'$division', ";
        $sql .= "$txtDateFrom, ";
        $sql .= "$txtDateTo, ";
        $sql .= "'$hr_employee_id',";
        $sql .= "'$userid', ";
        $sql .= "'D75P4070',";
        $sql .= "'$lang',";
        $sql .= "0 ";
        $rsData = $this->connectionHR->select($sql);
        //$rsData = array();
        $arr = array(
            "EmployeeID"=>"NV001",
            "EmployeeName"=>"Ramond Huynh",
            "TransID"=>"123",
            "Times"=>"1",
            "AttendanceDate"=>"10/10/2017",
            "ShiftID"=>"CA1",
            "TimeStart"=>"06:00",
            "TimeEnd"=>"17:00",
            "OriPreOTFrom"=>"05:00",
            "OriPreOTTo"=>"06:00",
            "OriPreOTHours"=>1,
            "PreOTFrom"=>"",
            "PreOTTo"=>"",
            "PreOTHours"=>null,
            "ApprovedPre"=>0,
            "NotApprovedPre"=>0,
            "OriAfterOTFrom"=>"18:00",
            "OriAfterOTTo"=>"19:00",
            "OriAfterOTHours"=>1,
            "AfterOTFrom"=>'',
            "AfterOTTo"=>'',
            "AfterOTHours" => null,
            "ApprovedAfter" =>0,
            "NotApprovedAfter" =>0,
            "Reason"=>"Ghi chú",
            "Note"=>"",

        );
        /*array_push($rsData, $arr);
        array_push($rsData, $arr);
        array_push($rsData, $arr);
        array_push($rsData, $arr);
        array_push($rsData, $arr);
        array_push($rsData, $arr);
        array_push($rsData, $arr);
        array_push($rsData, $arr);
        array_push($rsData, $arr);*/

        $sql = "--Lay thong thiet lap an hien tach ca" . PHP_EOL;
        $sql .= "set nocount on " . PHP_EOL;
        $sql .= "select NumValue from D29T0003 where ProcessTypeID = 'PriorityLeave' AND TransTypeID = 'ConfirmOT'" . PHP_EOL;
        $rsTemp = $this->connectionHR->selectOne($sql);
        $numValue = $rsTemp["NumValue"];


        //\Debugbar::info($rsData);
        return View::make("W7X.W75.W75F4070", compact("isHideConfirmOT","isHideOT",'pForm', 'g','modalTitle', 'task', 'statusList', 'rsDate', 'rsData', 'isApproval'));

    }
}
