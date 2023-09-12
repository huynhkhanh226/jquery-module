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

class W09F1010Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {
        $titleW09F1010 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeID = Auth::user()->user()->HREmployeeID;
        $session = Session::getId();
        \Debugbar::info($titleW09F1010);
        switch ($task) {
            case "":
                $sql = "--do nguon luoi".PHP_EOL;
                $sql .= "Exec W09P1010 '$userID', 'W09F1010', '$session'".PHP_EOL;
                \Debugbar::info($sql);
                $rsDataGrid = $this->connectionHR->select($sql);
                $rsDataGrid = json_encode($rsDataGrid);
                return View::make("W0X.W09.W09F1010", compact('g', 'pForm', 'titleW09F1010', 'rsDataGrid'));
                break;

            case "reloadGrid":
                $sql = "--do nguon luoi".PHP_EOL;
                $sql .= "Exec W09P1010 '$userID', 'W09F1010', '$session'".PHP_EOL;
                \Debugbar::info($sql);
                $rsDataGrid = $this->connectionHR->select($sql);
                return $rsDataGrid;
                break;

            case "delete":
                \Debugbar::info(Input::all());
                $OrgChartID = Input::get('OrgChartID');
                $OrgLevelID = Input::get('OrgLevelID');

                $sql = "EXEC W09P5555 " .PHP_EOL;
                $sql .= "'$OrgChartID',".PHP_EOL; //OrgChartID, varchar[50], NOT NULL
                $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'$OrgLevelID',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key03ID, varchar[50], NOT NULL
                $sql .= "'$lang',".PHP_EOL; //Language, varchar[50], NOT NULL
                $sql .= "2,".PHP_EOL; //Mode, tinyint, NOT NULL
                $sql .= "null,".PHP_EOL; //Date01, datetime, NOT NULL
                $sql .= "0,".PHP_EOL; //Status, int, NOT NULL
                $sql .= " N'',".PHP_EOL; //Message, nvarchar, NOT NULL
                $sql .= "'W09F1010',".PHP_EOL; //FormID, varchar[20], NOT NULL
                $sql .= "'$session'"; //HostID, varchar[500], NOT NULL

                \Debugbar::info($sql);
                $rsCheck = $this->connectionHR->select($sql);
                \Debugbar::info($rsCheck);

                if(intval($rsCheck[0]['Status']) == 1){
                    return $rsCheck[0]['Message'];
                }
                if(intval($rsCheck[0]['Status']) == 0) {
                    try {
                        $sql ="--xoa ".PHP_EOL;
                        $sql .= "EXEC W09P1002 " .PHP_EOL;
                        $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[500], NOT NULL
                        $sql .= "'W09F1010',".PHP_EOL; //FormID, varchar[50], NOT NULL
                        $sql .= "'".Session::getId()."',".PHP_EOL; //HostID, varchar[500], NOT NULL
                        $sql .= "'$OrgChartID'"; //Key01ID, varchar[50], NOT NULL

                        $this->connectionHR->statement($sql);
                        return "SUCCESS";
                    } catch (Exception $ex) {
                        return "FAILED";
                    }
                }
                break;
        }
    }

}
