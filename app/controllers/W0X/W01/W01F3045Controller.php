<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 05/01/2018
 * Time: 10:17 AM
 */
namespace W0X\W01;
use Input;
use Lang;
//use Predis\Helpers;
use Request;
use View;
use Session;
use DB;
use Auth;
use Helpers;
use W0X\W0XController;

class W01F3045Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        \Debugbar::info("W01F3045Controller");
        switch ($task){
            case "":
                $sql = "-- Combo don vi".PHP_EOL;
                $sql .= "  EXEC W01P3042 '$userID','DivisionID'";
                \Debugbar::info($sql);
                $cbDivisionIDW01F3045 = $this->connection->select($sql);
                \Debugbar::info($cbDivisionIDW01F3045);

                $sql1 = "-- Combo phan khu".PHP_EOL;
                $sql1 .= "  EXEC W01P3042 '$userID','SubDivisionID'";
                \Debugbar::info($sql1);
                $cbSubDivisionIDW01F3045 = $this->connection->select($sql1);
                \Debugbar::info($cbSubDivisionIDW01F3045);

                return View::make("W0X.W01.W01F3045", compact("pForm", "g", "cbDivisionIDW01F3045","cbSubDivisionIDW01F3045"));
                break;

            case "loadCBProjectID":
                \Debugbar::info(Input::all());
                $divisionID = Input::get('cbDivisionIDW01F3045', []);
                $subDivisionID = Input::get('cbSubDivisionIDW01F3045', []);
                if ($divisionID == "" || $divisionID == [])
                    return "";
                $divisionID = join(';', $divisionID);
                if ($subDivisionID != '') {
                    $subDivisionID = join(';', $subDivisionID);
                }
                $sql = "-- Combo du an".PHP_EOL;
                $sql .= "  EXEC W01P3043 '$userID','$divisionID','$subDivisionID'";
                \Debugbar::info($sql);
                $cbProjectIDW01F3045 = $this->connection->select($sql);
                \Debugbar::info($cbProjectIDW01F3045);
                $str = '';
                foreach ($cbProjectIDW01F3045 as $row) {
                    $str .= "<option title='" . $row["Value"] . "' value='" . $row["Value"] . "'>" . $row["Caption"] . "</option>";
                }
                return $str;
                break;

            case "filter":
                \Debugbar::info(Input::all());
                $ReportDate = Helpers::convertDate(Input::get('txtReportDateW01F3045'));
                $divisionID = str_replace(",", ";", Input::get("cbDivisionIDW01F3045", ""));
                $subDivisionID = str_replace(",", ";", Input::get("cbSubDivisionIDW01F3045", ""));
                if($subDivisionID == "null"){
                    $subDivisionID = '';
                }
                $ProjectID = str_replace(",", ";", Input::get("cbProjectIDW01F3045", ""));
                \Debugbar::info($divisionID);
                $sql = "--do nguon khi filter" .PHP_EOL;
                $sql .= "EXEC W01P3044 '$userID', '$divisionID', '$subDivisionID', '$ProjectID', $ReportDate";
                \Debugbar::info($sql);
                $valueGrid = $this->connection->select($sql);
                \Debugbar::info($valueGrid);
                if(count($valueGrid) > 0){
                    for ($i = 0; $i < count($valueGrid); $i++) {
                        //$valueGrid[$i]["IsUpdate"] = 0;
                        $valueGrid[$i]['Receive'] = number_format($valueGrid[$i]['Receive'], 0);
                        $valueGrid[$i]['Cost'] = number_format($valueGrid[$i]['Cost'], 0);
                        $valueGrid[$i]['Different'] = number_format($valueGrid[$i]['Different'], 0);
                        $valueGrid[$i]['RemainReceive'] = number_format($valueGrid[$i]['RemainReceive'], 0);
                        $valueGrid[$i]['Budget'] = number_format($valueGrid[$i]['Budget'], 0);
                        $valueGrid[$i]['RemainCost'] = number_format($valueGrid[$i]['RemainCost'], 0);
                    }
                }
                return json_encode($valueGrid);
                break;
        }
    }
}