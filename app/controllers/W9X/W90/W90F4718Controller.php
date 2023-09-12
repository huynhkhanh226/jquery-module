<?php

namespace W9X\W90;

use Debugbar;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W9X\W9XController;

class W90F4718Controller extends W9XController
{
    public function index($pForm, $g, $task = "")
    {
        $titleW90F4718 = $this->getModalTitle($pForm);
        \Debugbar::info(Session::get("W91P0000"));
        $userID = Auth::user()->user()->UserID;
        $division = Session::get("W91P0000")['DivisionID'];
        $session = Session::getId();
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $lang = Session::get('Lang');

        switch ($task) {
            case "":
                $divisionList = $this->LoadDivisionID("D90", $g, false, true);
                $yearList = $this->LoadComboYear("D90", count($divisionList) > 0 ? $divisionList[0]["DivisionID"] : $division);
                //\Debugbar::info($yearList);
                $sql = "--Do nguon mau bao cao" . PHP_EOL;
                $sql .= " set nocount on" . PHP_EOL;
                $sql .= " SELECT ReportCode, ReportName1U AS ReportName" . PHP_EOL;
                $sql .= " FROM 	D90T4900 WITH(NOLOCK)" . PHP_EOL;
                $sql .= " WHERE	Disabled = 0" . PHP_EOL;
                $sql .= " Order by  	ReportCode" . PHP_EOL;
                $reportList = $this->connection->select($sql);
                return View::make("W9X.W90.W90F4718", compact('reportList', 'yearList', 'divisionList', 'titleW90F4718', 'pForm', 'g'));
                break;
            case "reloadyear":
                $divisionID = Input::get("cboDivisionIDW90F4718", $division);
                $yearList = $this->LoadComboYear("D90", $divisionID, true);
                return $yearList;
                break;
            case "filter":
                $cboDivisionIDW90F4718 = Input::get("cboDivisionIDW90F4718", "");
                $cboYearW90F4718 = Input::get("cboYearW90F4718", "");
                $cboReportIDW90F4718 = Input::get("cboReportIDW90F4718", "");
                $sql = "-- Do nguon danh sach ma bao cao da luu" . PHP_EOL;
                $sql .= " set nocount on" . PHP_EOL;
                $sql .= " SELECT ReportCode, ReportSaveID, ReportSaveName" . PHP_EOL;
                $sql .= " FROM		D90T4912 WITH(NOLOCK)" . PHP_EOL;
                $sql .= " WHERE	DivisionID = '$cboDivisionIDW90F4718'" . PHP_EOL;
                $sql .= " AND		TranYear = $cboYearW90F4718" . PHP_EOL;
                $sql .= "  AND		ReportCode = '$cboReportIDW90F4718'" . PHP_EOL;
                $rsMaster = $this->connection->select($sql);
                \Debugbar::info($rsMaster);
                return $rsMaster;
                break;
            case "loaddetail":
                $cboDivisionIDW90F4718 = Input::get("cboDivisionIDW90F4718", "");
                $cboYearW90F4718 = Input::get("cboYearW90F4718", "");
                $cboReportIDW90F4718 = Input::get("cboReportIDW90F4718", "");
                $reportSaveID = Input::get("ReportSaveID", "");
                $mode = 0;

                $sql = "-- Dung cot dong cho luoi Noi dung bao cao" . PHP_EOL;
                $sql .= " EXEC W90P4918 '$cboDivisionIDW90F4718', $cboYearW90F4718, '$cboReportIDW90F4718', '$reportSaveID', '$userID', '$session',  1, '$lang', $mode " . PHP_EOL;
                $rsColumns = $this->connection->select($sql);
                \Debugbar::info($rsColumns);
                $mode = 1;
                $sql = "-- Dung cot dong cho luoi Noi dung bao cao" . PHP_EOL;
                $sql .= " EXEC W90P4918 '$cboDivisionIDW90F4718', $cboYearW90F4718, '$cboReportIDW90F4718', '$reportSaveID', '$userID', '$session',  1, '$lang', $mode " . PHP_EOL;
                $rsDataDetail = $this->connection->select($sql);
                return View::make("W9X.W90.W90F4718_Detail", compact('rsDataDetail', 'rsColumns', 'titleW90F4718', 'pForm', 'g'));
                break;

            case "deletereport":

                $reportCode = Input::get("reportCode", "");
                $reportSaveID = Input::get("reportSaveID", "");

                $sql = " -- Thuc hien xoa bao cao" . PHP_EOL;
                $sql .= " DELETE D90T4913 WHERE ReportCode = '$reportCode' AND ReportSaveID = '$reportSaveID' " . PHP_EOL;
                $sql .= " DELETE D90T4912 WHERE ReportCode = '$reportCode' AND ReportSaveID = '$reportSaveID' " . PHP_EOL;
                \Debugbar::info($sql);
                try {
                    $this->connection->statement($sql);
                    return 1;
                } catch (\Exception $ex) {
                    return 0;
                }
                break;
        }


    }


    private function loadCboYear($divisionID)
    {

    }

}
