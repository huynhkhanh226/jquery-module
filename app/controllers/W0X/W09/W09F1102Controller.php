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

class W09F1102Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {
        $titleW09F1102 = $this->getModalTitle('W09F1102');
        $lang = Session::get('Lang');
        $UserID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeID = Auth::user()->user()->HREmployeeID;
        $session = Session::getId();
        switch ($task) {
            case "":
                \Debugbar::info('vo roi ne');

                $sql = " -- Do nguon DD Chuc danh quan ly" . PHP_EOL;
                $sql .= "SELECT 		DutyID As DutyManagerID, DutyNameU AS DutyManagerName" . PHP_EOL;
                $sql .= "FROM		D09T0211 WITH(NOLOCK)  " . PHP_EOL;
                $sql .= "WHERE		Disabled = 0 And IsManager = 1" . PHP_EOL;
                $sql .= "ORDER BY	DutyID" . PHP_EOL;
                $DutyCb = json_encode($this->connectionHR->select($sql));

              /*  $sql = " -- Do nguon luoi Chuc danh quan ly" . PHP_EOL;
                $sql .= "SELECT  T1.DutyID, T1.DutyNameU AS DutyName, T1.DutyManagerID, T2.DutyNameU AS DutyManagerName, 0 AS IsUpdate" . PHP_EOL;
                $sql .= "FROM  D09T0211 T1 WITH(NOLOCK)  " . PHP_EOL;
                $sql .= "LEFT JOIN D09T0211 T2 WITH(NOLOCK)" . PHP_EOL;
                $sql .= "ON   T1.DutyID = T2.DutyManagerID" . PHP_EOL;
                $sql .= "WHERE  T1.Disabled = 0 AND T1.IsMaxDutyManager = 0" . PHP_EOL;
                $sql .= "ORDER BY DutyID" . PHP_EOL;*/
                $sql = "-- Do nguon luoi Chuc danh quan ly" . PHP_EOL;
                $sql .= "SELECT  T1.DutyID, T1.DutyNameU AS DutyName, T1.DutyManagerID, T2.DutyNameU AS DutyManagerName, 0 AS IsUpdate" . PHP_EOL;
                $sql .= "FROM  D09T0211 T1 WITH(NOLOCK)" . PHP_EOL;
                $sql .= "LEFT JOIN D09T0211 T2 WITH(NOLOCK)" . PHP_EOL;
                $sql .= "ON   T2.DutyID = T1.DutyManagerID" . PHP_EOL;
                $sql .= "WHERE  T1.Disabled = 0 AND T1.IsMaxDutyManager = 0" . PHP_EOL;
                $sql .= "ORDER BY DutyID" . PHP_EOL;
                $Duty_grid = json_encode($this->connectionHR->select($sql));
                \Debugbar::info($Duty_grid);


                return View::make('W0X.W09.W09F1102', compact('g', 'pForm', 'DutyCb', 'Duty_grid', 'titleW09F1102'));
                break;
            case "save":
                \Debugbar::info('save');
                try {
                    $data_grid_filter = Input::get('data_grid_filter', '');
                    \Debugbar::info($data_grid_filter);
                    $sql = "--Insert vào những dòng có nhập thông tin thay đổi" . PHP_EOL;
                    $sql .= " DELETE D09T6666 " . PHP_EOL;
                    $sql .= "WHERE UserID = '$UserID' AND HostID = '$session' AND FormID = 'W09F1102'" . PHP_EOL;

                    foreach ($data_grid_filter as $item) {
                        $sql .= "INSERT INTO	D09T6666 (UserID, HostID, FormID, Key01ID, Str01)" . PHP_EOL;
                        $sql .= "VALUES				('$UserID', '$session', 'W09F1102', '" . $item['DutyID'] . "', '" . $item['DutyManagerID'] . "')" . PHP_EOL;

                    }
                    $sql .= "EXEC W09P1102 '$UserID','$session','W09F1102',0" . PHP_EOL;


                    $this->connectionHR->statement($sql);

                    $sql = "-- Do nguon luoi Chuc danh quan ly" . PHP_EOL;
                    $sql .= "SELECT  T1.DutyID, T1.DutyNameU AS DutyName, T1.DutyManagerID, T2.DutyNameU AS DutyManagerName, 0 AS IsUpdate" . PHP_EOL;
                    $sql .= "FROM  D09T0211 T1 WITH(NOLOCK)" . PHP_EOL;
                    $sql .= "LEFT JOIN D09T0211 T2 WITH(NOLOCK)" . PHP_EOL;
                    $sql .= "ON   T2.DutyID = T1.DutyManagerID" . PHP_EOL;
                    $sql .= "WHERE  T1.Disabled = 0 AND T1.IsMaxDutyManager = 0" . PHP_EOL;
                    $sql .= "ORDER BY DutyID" . PHP_EOL;
                    $Duty_grid = $this->connectionHR->select($sql);
                    \Debugbar::info($Duty_grid);


                    return json_encode(["status" => "SUCCESS", "data" => $Duty_grid]);
                } catch
                (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    \Debugbar::info($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

                break;
        }
    }
}
