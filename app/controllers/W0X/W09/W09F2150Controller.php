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

class W09F2150Controller extends W0XController
{
    public function Index($pForm, $g, $task = "")
    {
        $titleW09F2150 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeID = Auth::user()->user()->HREmployeeID;
        switch ($task){
            case "":
                $statuss = $this->LoadFixData("AppStatusW09F2150");
                $sql = "-- Do nguon cot dong" . PHP_EOL;
                $sql .= " SELECT 	Code, ShortU AS CaptionName, Decimals, Disabled " . PHP_EOL;
                $sql .= " FROM 	D13T9000 " . PHP_EOL;
                $sql .= " WHERE 	[Type] = 'SALBA'" . PHP_EOL;
                $rsColumns = [];
                $rsTemp = $this->connectionHR->select($sql);

                foreach ($rsTemp as $row){
                    $code = $row["Code"];
                    //$r = Helpers::arraySearch($rsTemp, "Code", $code);
                    $row["Field"] = "BaseSalary".substr($code, strlen ($code) -2, strlen ($code));
                    array_push($rsColumns, $row);
                }
                \Debugbar::info($rsColumns);
                return View::make("W0X.W09.W09F2150", compact('rsColumns','g', 'pForm','titleW09F2150', 'lang', "statuss"));
                break;
            case 'filter':

                $txtDate = Input::get("txtDateW09F2150", "") ;
                //\Debugbar::info($txtDate);
                //$arr = explode("-", $txtDate);
                //\Debugbar::info($arr);
                $txtDateFrom = \Helpers::convertDate(Input::get("txtDateFromW09F2150", ""));
                $txtDateTo = \Helpers::convertDate(Input::get("txtDateToW09F2150", ""));
                $cbAppStatusID = Input::get("cbAppStatusID", "") ;


                $sql=" -- Do nguon cho form ".PHP_EOL;
                $sql .=" EXEC W09P2150 '$divisionHR', '$userID', $tranMonth, $tranYear,'$pForm', $txtDateFrom, $txtDateTo, '$cbAppStatusID', '$userID' ".PHP_EOL;
                \Debugbar::info($sql);
                $rsData = $this->connectionHR->select($sql);
                \Debugbar::info(json_encode($rsData));
                return ($rsData);
                break;
            case "delete":
                $proTransID = Input::get("proTransID");
                $sql=" -- Thuc thi store xoa du lieu".PHP_EOL;
                $sql .=" EXEC W09P2152 '$divisionHR', '$userID', $tranMonth, $tranYear, 'D09F2150', '$proTransID', '$employeeID'";
                try {
                    $this->connectionHR->statement($sql);
                    return 1;
                } catch (Exception $ex) {
                    return 0;
                }
        }
    }

}
