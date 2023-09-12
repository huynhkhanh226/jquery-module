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

class W09F1001Controller extends W0XController
{

    public function index($pForm, $g, $task = "")
    {

        $permission = $this->getPermission($pForm); //Lay permission, return number
        //$test = \Session::get("W91P0000");
        //\Debugbar::info($test);
        $divisionID = \Session::get("W91P0000")["HRDivisionID"];
        $userID = \Auth::user()->user()->UserID;
        $tranMonth = \Session::get("W91P0000")['HRTranMonth'];
        $tranYear = \Session::get("W91P0000")['HRTranYear'];
        $lang = \Session::get('Lang');
        $hostID = \Session::getId();

        $modalTitle = $this->getModalTitle('W09F1001');
        switch ($task) {
            case "": //do du lieu len luoi
                //\Debugbar::info('vinh');
                $disabled = 0;
                $mode = 1;
                $sql = "--Do nguon luoi" . PHP_EOL;
                $sql .= "EXEC W09P1001 '$userID', '$pForm', '$hostID'" . PHP_EOL;

                $rsData = $this->connection->select($sql); //Thuc thi lay du lieu
                $rsData = json_encode($rsData); //Chuyen array thanh chuoi json

                return View::make('W0X.W09.W09F1001', compact('modalTitle', 'g', 'pForm', 'task', 'rsData'));
                break;

            case"view":
            case "update":
            case"add":
            case"save":
                \Debugbar::info(Input::all());
                $txtOrgLevelNameW09F1001 = $this->sqlstring(Input::get("txtOrgLevelNameW09F1001"));
                $txtOrgLevelW09F1001 = Helpers::sqlNumber(Input::get("txtOrgLevelW09F1001"));
                $txtNotesW09F1001 = $this->sqlstring(Input::get("txtNotesW09F1001"));
                $Key01ID = "";
                $Key03ID = "";
                if ($task == "save") { //Luu them moi
                    $Mode = 0;
                    $OrgChartID = "";
                } else if ($task == "update") { //Truong hop update
                    $Mode = 1;
                    $OrgChartID = Input::get("orgChartID", "");
                    $Key01ID = Input::get("OrgLevelID", "");
                }
                \Debugbar::info($txtOrgLevelNameW09F1001, $txtOrgLevelW09F1001, $txtNotesW09F1001);
                $sql = "--Xoa du lieu bang tam" . PHP_EOL;
                $sql .= "SET NOCOUNT ON " . PHP_EOL;
                $sql .= "DELETE FROM D09T6666 " . PHP_EOL;
                $sql .= "WHERE 		UserID =  '$userID' AND HostID = '$hostID'  AND  FormID =  'W09F1001'" . PHP_EOL;

                $sql .= "--Them du lieu vo bang tam" . PHP_EOL;
                $sql .= "insert into D09T6666 (UserID, HostID, FormID ,  Str01, Str02,Num01, Key01ID)" . PHP_EOL;
                $sql .= "values ('$userID', '$hostID', 'W09F1001', N'$txtOrgLevelNameW09F1001', N'$txtNotesW09F1001',$txtOrgLevelW09F1001, '$Key01ID')" . PHP_EOL;

                $Date01 = null;
                $Status = 0;
                $Message = "";
                $FormID = "W09F1001";

                $sql .= "--kiem tra truoc khi luu" . PHP_EOL;
                $sql .= "EXEC W09P5555 " . PHP_EOL;
                $sql .= "'$OrgChartID'," . PHP_EOL; //OrgChartID, varchar[50], NOT NULL
                $sql .= "'$userID'," . PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'$Key01ID'," . PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'$Key03ID'," . PHP_EOL; //Key03ID, varchar[50], NOT NULL
                $sql .= "'$lang'," . PHP_EOL; //Language, varchar[50], NOT NULL
                $sql .= "$Mode," . PHP_EOL; //Mode, tinyint, NOT NULL
                $sql .= "'$Date01'," . PHP_EOL; //Date01, datetime, NOT NULL
                $sql .= "$Status," . PHP_EOL; //Status, int, NOT NULL
                $sql .= " N'$Message'," . PHP_EOL; //Message, nvarchar, NOT NULL
                $sql .= "'$FormID'," . PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'$hostID'"; //HostID, varchar[500], NOT NULL
                $rsCheck = $this->connectionHR->selectOne($sql);//ket qua kiem tra truoc khi luu
                \Debugbar::info($rsCheck);
                if ($rsCheck != null) {
                    if ($rsCheck["Status"] == 0) {
                        //thuc hien luu du lieu
                        $sql = "--Luu du lieu" . PHP_EOL;
                        $sql .= "EXEC W09P1005 " . PHP_EOL;
                        $sql .= "'$userID'," . PHP_EOL; //UserID, varchar[500], NOT NULL
                        $sql .= "'$hostID'," . PHP_EOL; //HostID, varchar[500], NOT NULL
                        $sql .= "'$FormID'," . PHP_EOL; //FormID, varchar[50], NOT NULL
                        $sql .= "$Mode"; //Mode, tinyint, NOT NULL
                        \Debugbar::info($sql);
                        try {
                            $rs = $this->connectionHR->select($sql);
                            $rs = $rs[0];
                            \Debugbar::info($rs);
                        } catch (Exception $e) {//truong hop loi
                            return json_encode(array("rowData" => [], "status" => 'ERROR'));
                        }
                        return json_encode(array("rowData" => $rs, "status" => 'SUCCESS'));
                    } else {//truong hop status = 1
                        return json_encode(array("rowData" => [], "status" => $rsCheck['Message'], "msgAsk" => $rsCheck['MsgAsk']));
                    }
                }
//                \Debugbar::info($sql);
//                \Debugbar::info($result);
//                return View::make("W0X.W09.W09F1001", compact('pForm', 'g', 'task', 'rsData', 'permission', 'txtOrgLevelNameW09F1001', 'txtOrgLevelW09F1001', 'txtNotesW09F1001'));
//                \Debugbar::info($txtOrgLevelNameW09F1001, $txtOrgLevelW09F1001, $txtNotesW09F1001);
//                // return $txtOrgLevelNameW09F1001;
//                //return $txtOrgLevelNameW09F1001;
                break;

            case "delete":
                \Debugbar::info(Input::get("OrgLevelID"));
                $OrgLevelID = Input::get("OrgLevelID");

                $Date01 = null;
                $Status = 0;
                $Message = "";
                $FormID = "W09F1001";

                $sql = "--kiem tra truoc khi xoa" . PHP_EOL;
                $sql .= "EXEC W09P5555 " . PHP_EOL;
                $sql .= "''," . PHP_EOL; //OrgChartID, varchar[50], NOT NULL
                $sql .= "'$userID'," . PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'$OrgLevelID'," . PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "''," . PHP_EOL; //Key03ID, varchar[50], NOT NULL
                $sql .= "'$lang'," . PHP_EOL; //Language, varchar[50], NOT NULL
                $sql .= "2," . PHP_EOL; //Mode, tinyint, NOT NULL
                $sql .= "'$Date01'," . PHP_EOL; //Date01, datetime, NOT NULL
                $sql .= "$Status," . PHP_EOL; //Status, int, NOT NULL
                $sql .= " N'$Message'," . PHP_EOL; //Message, nvarchar, NOT NULL
                $sql .= "'$FormID'," . PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'$hostID'"; //HostID, varchar[500], NOT NULL
                $rsCheck = $this->connectionHR->selectOne($sql);//ket qua kiem tra truoc khi luu
                \Debugbar::info($rsCheck);
                if ($rsCheck != null) {
                    if ($rsCheck["Status"] == 0) {
                        //thuc hien luu du lieu
                        $sql = "--Xoa du lieu" . PHP_EOL;
                        $sql .= "EXEC W09P1002 " . PHP_EOL;
                        $sql .= "'$userID'," . PHP_EOL; //UserID, varchar[500], NOT NULL
                        $sql .= "'W09F1001'," . PHP_EOL; //FormID, varchar[50], NOT NULL
                        $sql .= "'$hostID'," . PHP_EOL; //HostID, varchar[500], NOT NULL
                        $sql .= "'$OrgLevelID'"; //Key01ID, varchar[50], NOT NULL
                        try {
                            $this->connectionHR->statement($sql);
                        } catch (Exception $e) {//truong hop loi
                            return "ERROR";
                        }
                        return "SUCCESS";
                    } else {//truong hop status = 1
                        return $rsCheck['Message'];
                    }
                }
                break;

            case "checkBeforeEdit":
                \Debugbar::info(Input::get("OrgLevelID"));
                $OrgLevelID = Input::get("OrgLevelID");

                $Date01 = null;
                $Status = 0;
                $Message = "";
                $FormID = "W09F1001";

                $sql = "--kiem tra truoc khi sua" . PHP_EOL;
                $sql .= "EXEC W09P5555 " . PHP_EOL;
                $sql .= "''," . PHP_EOL; //OrgChartID, varchar[50], NOT NULL
                $sql .= "'$userID'," . PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'$OrgLevelID'," . PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "''," . PHP_EOL; //Key03ID, varchar[50], NOT NULL
                $sql .= "'$lang'," . PHP_EOL; //Language, varchar[50], NOT NULL
                $sql .= "3," . PHP_EOL; //Mode, tinyint, NOT NULL
                $sql .= "'$Date01'," . PHP_EOL; //Date01, datetime, NOT NULL
                $sql .= "$Status," . PHP_EOL; //Status, int, NOT NULL
                $sql .= " N'$Message'," . PHP_EOL; //Message, nvarchar, NOT NULL
                $sql .= "'$FormID'," . PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'$hostID'"; //HostID, varchar[500], NOT NULL
                $rsCheck = $this->connectionHR->selectOne($sql);//ket qua kiem tra truoc khi luu
                \Debugbar::info($rsCheck);
                if ($rsCheck != null) {
                    if ($rsCheck["Status"] == 0) {
                        return "SUCCESS";
                    } else {//truong hop status = 1
                        return $rsCheck['Message'];
                    }
                }
                break;

            case "confirmSave":
                $action = Input::get('action');
                $mode = 0;
                if($action == 'add'){
                    $mode = 0;
                }
                if($action == 'edit'){
                    $mode = 1;
                }
                $sql = "--Luu du lieu" . PHP_EOL;
                $sql .= "EXEC W09P1005 " . PHP_EOL;
                $sql .= "'$userID'," . PHP_EOL; //UserID, varchar[500], NOT NULL
                $sql .= "'$hostID'," . PHP_EOL; //HostID, varchar[500], NOT NULL
                $sql .= "'W09F1001'," . PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "$mode"; //Mode, tinyint, NOT NULL
                \Debugbar::info($sql);
                try {
                    $rs = $this->connectionHR->select($sql);
                    $rs = $rs[0];
                    \Debugbar::info($rs);
                } catch (Exception $e) {//truong hop loi
                    return json_encode(array("rowData" => [], "status" => 'ERROR'));
                }
                return json_encode(array("rowData" => $rs, "status" => 'SUCCESS'));

                break;

        }
    }
}
