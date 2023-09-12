<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 12/12/2017
 * Time: 8:54 AM
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

class W75F2030Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        Debugbar::info($pForm);
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $modalTitle = $this->getModalTitleG4($pForm);
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        switch ($task){
            case "":
                Debugbar::info($modalTitle);
                $sql = "--Do nguon luoi nhan vien" .PHP_EOL;
                $sql .= "EXEC W75P4104 '$divisionHR', '$userID', '$pForm', '%', '%', '%', '%'";
                $valueGrid1 = $this->connectionHR->select($sql);
                Debugbar::info($sql);
                Debugbar::info($valueGrid1);

                $sql1 = "--Do nguon cot dong" .PHP_EOL;
                $sql1 .= "EXEC W75P2037	'$divisionHR', '$userID', '$lang', '$pForm', '".$valueGrid1[0]['EmployeeID']."', '$tranMonth', '$tranYear'";
                $captionGrid2 = $this->connectionHR->select($sql1);
                Debugbar::info($sql1);
                Debugbar::info($captionGrid2);

                $sql2 = "--Do nguon luoi tach gio tang ca" .PHP_EOL;
                $sql2 .= "EXEC W75P2035	'$divisionHR', '$userID', '$lang', '$pForm', '".$valueGrid1[0]['EmployeeID']."', '$tranMonth', '$tranYear'";
                $valueGrid2 = $this->connectionHR->select($sql2);
                Debugbar::info($sql2);
                for($i = 0; $i < count($valueGrid2); $i++){
                    $valueGrid2[$i]['OTHourt'] = number_format($valueGrid2[$i]['OTHourt'], 2);
                    $valueGrid2[$i]['OTHoursSplit'] = number_format($valueGrid2[$i]['OTHoursSplit'], 2);
                    $valueGrid2[$i]['OTLeaveSplit'] = number_format($valueGrid2[$i]['OTLeaveSplit'], 2);
                }
                Debugbar::info($valueGrid2);
                $valueGrid1 = json_encode($this->connectionHR->select($sql));
                $valueGrid2 = json_encode($valueGrid2);
                return View::make("W7X.W75.W75F2030", compact("pForm", "g", "modalTitle", "valueGrid1", "captionGrid2", "valueGrid2"));
                break;

            case "save":
                \Debugbar::info(Input::all());
                $dataSender = json_decode(Input::get('dataSender'));
                \Debugbar::info($dataSender);
                $sql = "--tao bang tam".PHP_EOL;
                $sql .= "Create table #W75F2030";
                $sql .= "(EmployeeID Nvarchar(50),";
                $sql .= "Attendancedate Datetime,";
                $sql .= "AttendancedateType varchar(50),";
                $sql .= "OTHourt Decimal(19,4),";
                $sql .= "OTHoursSplit Decimal(19,4),";
                $sql .= "OTLeaveSplit Decimal(19,4),";
                $sql .= "IsEdit tinyint)".PHP_EOL;

                $sql .= "--insert vao bang tam".PHP_EOL;
                for($i = 0; $i < count($dataSender); $i++){
                    $EmployeeID = $this->sqlstring($dataSender[$i]->EmployeeID);
                    $Attendancedate = Helpers::convertDate($dataSender[$i]->Attendancedate);
                    $AttendancedateType = $this->sqlstring($dataSender[$i]->AttendancedateType);
                    $OTHourt = Helpers::sqlNumber($dataSender[$i]->OTHourt);
                    $OTHoursSplit = Helpers::sqlNumber($dataSender[$i]->OTHoursSplit);
                    $OTLeaveSplit = Helpers::sqlNumber($dataSender[$i]->OTLeaveSplit);
                    $IsEdit = intval($dataSender[$i]->IsEdit);
                    $sql .= "INSERT INTO #W75F2030 (EmployeeID ,Attendancedate ,AttendancedateType ,OTHourt ,OTHoursSplit ,OTLeaveSplit ,IsEdit)".PHP_EOL;
                    $sql .= "VALUES ('$EmployeeID', $Attendancedate, '$AttendancedateType', $OTHourt, $OTHoursSplit, $OTLeaveSplit, $IsEdit)".PHP_EOL;
                }
                $sql .= "--thuc thi store save".PHP_EOL;
                $sql .= "EXEC W75P2036 '$divisionHR', '$userID', '$pForm', '$EmployeeID', '$tranMonth', '$tranYear'".PHP_EOL;

                \Debugbar::info($sql);
                break;
        }
    }
}