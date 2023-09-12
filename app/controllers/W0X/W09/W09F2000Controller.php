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

class W09F2000Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {
        $titleW09F2000 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeID = Auth::user()->user()->HREmployeeID;
        $perD09F2000 = Session::get($pForm);
        \Debugbar::info($perD09F2000);
        switch ($task) {
            case "":
                $timeList = $this->LoadFixData("TimeD09");
                $statusList = $this->LoadFixData("AppStatusW09F2000");
                $searchList = $this->LoadSearchFieldName("W09F2000", "W09", $g);
                $rsData = [];

                return View::make("W0X.W09.W09F2000", compact('perD09F2000',"rsData", "searchList", "statusList", "timeList", 'g', 'pForm', 'titleW09F2000'));
                break;
            case 'filter':
                $TimeID = Input::get("slTimeID", 0);
                $AppStatusID = Input::get("slAppStatusID", "");
                $SearchFieldID = Input::get("slSearchFieldID", "");
                $SearchValue = $this->sqlstring(Input::get("txtSearchValue", ""));
                $SalaryProposalID = Input::get("salaryProposalID", "");
                $Mode = 0;
                $sql = "--Do nguon cho luoi" . PHP_EOL;
                $sql .= " EXEC W09P2010 '$divisionHR', $tranMonth, $tranYear, $Mode, N'$SearchFieldID', N'$SearchValue', $TimeID, '$AppStatusID','$userID','$pForm','$SalaryProposalID'";
                $rsData = $this->connectionHR->select($sql);
                \Debugbar::info($rsData);
                return ($rsData);
                break;
            case 'deleterow':
                $salaryProposalID = Input::get("salaryProposalID", "");
                $sql = "--Thuc hien xoa du lieu" . PHP_EOL;
                $sql .= " EXEC W09P2011 1, '$userID', '$salaryProposalID' " . PHP_EOL;
                try{
                    $this->connectionHR->statement($sql);
                    return 1;
                } catch (Exception $ex) {
                    return 0;
                }
                break;
        }
    }


}
