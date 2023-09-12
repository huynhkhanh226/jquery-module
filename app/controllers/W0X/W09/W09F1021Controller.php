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

class W09F1021Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {
        $titleW09F1021 = $this->getModalTitle('W09F1021');
        $lang = Session::get('Lang');
        $UserID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeID = Auth::user()->user()->HREmployeeID;
        $session = Session::getId();
        \Debugbar::info($titleW09F1021);
        $rsDataGrid = [];
        switch ($task) {
            case "":
                $sql ="--Do nguon Form".PHP_EOL;
                $sql .= "EXEC W09P1001 " .PHP_EOL;
                $sql .= "'$UserID',".PHP_EOL; //UserID, varchar[500], NOT NULL
                $sql .= "'W09F1021',".PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'$session'"; //HostID, varchar[500], NOT NULL
                $rsDataGrid = $this->connectionHR->select($sql);
                \Debugbar::info($rsDataGrid);
                return View::make('W0X.W09.W09F1021', compact('pForm', 'g','rsDataGrid', 'titleW09F1021'));
                break;

            case "save":
                //\Debugbar::info(Input::all());
                $dataGrid = json_decode(Input::get('dataGrid'));
                \Debugbar::info($dataGrid);
                $sql1 = "DELETE FROM D09T6666".PHP_EOL;
                $sql1 .= "WHERE UserID = '$UserID'".PHP_EOL;
                $sql1 .= "AND HostID = '$session'".PHP_EOL;
                $sql1 .= "AND FormID = 'W09F1021'".PHP_EOL;

                $this->connectionHR->statement($sql1);
                $sql = "";
                for($i = 0; $i<count($dataGrid); $i++){
                    $OrgLevelID = $this->sqlstring($dataGrid[$i]->OrgLevelID);
                    $ColorCode = $this->sqlstring($dataGrid[$i]->ColorCode);
                    $IsCheck = $this->sqlstring($dataGrid[$i]->IsCheck);
                    $sql .= "INSERT INTO D09T6666 (UserID, HostID, FormID , Key01ID, Str01,Num01)".PHP_EOL;
                    $sql .= "VALUES ('$UserID', '$session','W09F1021', '$OrgLevelID', '$ColorCode' , '$IsCheck')".PHP_EOL;
                }

                $sql .="--SP luu".PHP_EOL;
                $sql .= "EXEC W09P1005 " .PHP_EOL;
                $sql .= "'$UserID',".PHP_EOL; //UserID, varchar[500], NOT NULL
                $sql .= "'$session',".PHP_EOL; //HostID, varchar[500], NOT NULL
                $sql .= "'W09F1021',".PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "0"; //Mode, tinyint, NOT NULL

                try{
                    $this->connectionHR->statement($sql);
                    $this->connectionHR->statement($sql1);
                    return json_encode(array("STATUS" => "SUCCESS"));
                }catch(Exception $e){
                    return json_encode(array("STATUS" => "ERROR","MESSAGE" => $e->getMessage()));
                }
                break;
        }
    }
}
