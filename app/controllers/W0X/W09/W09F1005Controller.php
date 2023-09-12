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

class W09F1005Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {
        $titleW09F1005 = $this->getModalTitle('W09F1005');
        $lang = Session::get('Lang');
        $UserID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeID = Auth::user()->user()->HREmployeeID;
        $session = Session::getId();
        \Debugbar::info(Input::all());
        $session = Session::getId();
        $actionFromW09F1010 = Input::get('action'); //biến action nhận từ màn hình W09F1010
        $rowDataFromW09F1010 = Input::get('rowData',[]); //Dữ liệu của dòng từ màn hình W09F1010 trong trường hợp edit và view
        $modeFromW09F1010 = Input::get('mode', 0);
        //\Debugbar::info($rowDataFromW09F1010);
        switch ($task) {
            case "":
                $orChartID = isset($rowDataFromW09F1010['OrgChartID']) ? $rowDataFromW09F1010['OrgChartID']: '';
                $OrgchartParentID = isset($rowDataFromW09F1010['OrgChartParentID']) ? $rowDataFromW09F1010['OrgChartParentID']: '';
                \Debugbar::info($OrgchartParentID);
                $sql ="--Do nguon Combo Thuoc don vi".PHP_EOL;
                $sql .= "EXEC W09P1010 " .PHP_EOL;
                $sql .= "'$UserID',".PHP_EOL; //UserID, varchar[500], NOT NULL
                $sql .= "'W09F1005',".PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'$session'"; //HostID, varchar[500], NOT NULL
                $tmp = $this->connectionHR->select($sql);
                $rsOrgChartParentID = [];
                foreach ($tmp as $r) {
                    if ($r['OrgChartParentID'] == $r['OrgChartID']) {
                        unset($r['OrgChartParentID']);
                        $r['expanded'] = true;//bung ra list con
                    }else{
                        $r['expanded'] = false;//ko bung list con
                    }
                    $rsOrgChartParentID[] = $r;//thêm $r vào mảng
                }
                \Debugbar::info($rsOrgChartParentID);
                if($actionFromW09F1010 == "add"){
                    $sql ="--Do nguon Combo Cap to chuc".PHP_EOL;
                    $sql .= "EXEC W09P1001 " .PHP_EOL;
                    $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[500], NOT NULL
                    $sql .= "'W09F1005',".PHP_EOL; //FormID, varchar[50], NOT NULL
                    $sql .= "'$session',".PHP_EOL; //HostID, varchar[500], NOT NULL
                    $sql .= "'',".PHP_EOL; //OrgchartID, varchar[500], NOT NULL
                    $sql .= "$modeFromW09F1010,".PHP_EOL;
                    $sql .= "'$orChartID'";
                }else{
                    $sql ="--Do nguon Combo Cap to chuc".PHP_EOL;
                    $sql .= "EXEC W09P1001 " .PHP_EOL;
                    $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[500], NOT NULL
                    $sql .= "'W09F1005',".PHP_EOL; //FormID, varchar[50], NOT NULL
                    $sql .= "'$session',".PHP_EOL; //HostID, varchar[500], NOT NULL
                    $sql .= "'$orChartID',".PHP_EOL; //OrgchartID, varchar[500], NOT NULL
                    $sql .= "$modeFromW09F1010,".PHP_EOL;
                    $sql .= "'$OrgchartParentID'";
                }

                \Debugbar::info($sql);
                $rsOrgLevelID = $this->connectionHR->select($sql);

                \Debugbar::info($rsOrgLevelID);
                return View::make("W0X.W09.W09F1005", compact('g', 'pForm','modeFromW09F1010', 'titleW09F1005', 'actionFromW09F1010', 'rsOrgChartParentID','rsOrgLevelID', 'rowDataFromW09F1010'));
                break;

            case "save":
                \Debugbar::info(Input::all());
                $action = Input::get('task');
                $sql = "";
                $mode = 0;
                $txtOrgChartIDW09F1005 = strtoupper($this->sqlstring(Input::get('txtOrgChartIDW09F1005')));
                $txtOrgChartNameW09F1005= $this->sqlstring(Input::get('txtOrgChartNameW09F1005'));
                $slOrgChartParentIDW09F1005= $this->sqlstring(Input::get('slOrgChartParentIDW09F1005'));
                $slOrgLevelIDW09F1005= $this->sqlstring(Input::get('slOrgLevelIDW09F1005'));
                $txtOrgAddressW09F1005= $this->sqlstring(Input::get('txtOrgAddressW09F1005'));
                $chkDisabledW09F1005 = Helpers::sqlNumber(Input::get('chkDisabledW09F1005'));
                //$chkDisabledW09F1005 = Input::get('chkDisabledW09F1005', "off") == "on" ? 1 : 0;
                if($action == 'add'){
                    $mode = 0;
                }
                if($action == 'edit'){
                    $mode = 1;
                }
                $sql = "DELETE FROM D09T6666".PHP_EOL;
                $sql .= "WHERE UserID =  '$UserID' AND HostID = '$session'  AND  FormID = 'W09F1005'".PHP_EOL;

                $this->connectionHR->statement($sql);

                $sql ="--insert bang tam".PHP_EOL;
                $sql .="Insert Into D09T6666(".PHP_EOL;
                $sql .="UserID, HostID, Key01ID, Key02ID, Key03ID, ".PHP_EOL;
                $sql .="Str01, Str02, Num01, FormID".PHP_EOL;
                $sql .=") Values(".PHP_EOL;
                $sql .="'".Auth::user()->user()->UserID."', '".Session::getId()."', '$txtOrgChartIDW09F1005', '$slOrgChartParentIDW09F1005', '$slOrgLevelIDW09F1005', ".PHP_EOL;
                $sql .=" N'$txtOrgChartNameW09F1005',  N'$txtOrgAddressW09F1005', $chkDisabledW09F1005, 'W09F1005'".PHP_EOL;
                $sql .=")".PHP_EOL;

                $this->connectionHR->statement($sql);

                $sql = "EXEC W09P5555 " .PHP_EOL;
                $sql .= "'$txtOrgChartIDW09F1005',".PHP_EOL; //OrgChartID, varchar[50], NOT NULL
                $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'$slOrgLevelIDW09F1005',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key03ID, varchar[50], NOT NULL
                $sql .= "'$lang',".PHP_EOL; //Language, varchar[50], NOT NULL
                $sql .= "$mode,".PHP_EOL; //Mode, tinyint, NOT NULL
                $sql .= "null,".PHP_EOL; //Date01, datetime, NOT NULL
                $sql .= "0,".PHP_EOL; //Status, int, NOT NULL
                $sql .= " N'',".PHP_EOL; //Message, nvarchar, NOT NULL
                $sql .= "'W09F1005',".PHP_EOL; //FormID, varchar[20], NOT NULL
                $sql .= "'$session'"; //HostID, varchar[500], NOT NULL

                \Debugbar::info($sql);
                $rsCheck = $this->connectionHR->select($sql);
                \Debugbar::info($rsCheck);

                if(intval($rsCheck[0]['Status']) == 1){
                    return json_encode(array("rowData" => [], "status" => $rsCheck[0]['Message'], "msgAsk" => $rsCheck[0]['MsgAsk']));
                }
                if(intval($rsCheck[0]['Status']) == 0) {
                    try {
                        $sql = "EXEC W09P1005 " . PHP_EOL;
                        $sql .= "'" . Auth::user()->user()->UserID . "'," . PHP_EOL; //UserID, varchar[500], NOT NULL
                        $sql .= "'" . Session::getId() . "'," . PHP_EOL; //HostID, varchar[500], NOT NULL
                        $sql .= "'W09F1005'," . PHP_EOL; //FormID, varchar[50], NOT NULL
                        $sql .= "$mode"; //Mode, tinyint, NOT NULL
                        $this->connectionHR->statement($sql);

                        $sql = "DELETE FROM D09T6666" . PHP_EOL;
                        $sql .= "WHERE UserID =  '$UserID' AND HostID = '$session'  AND  FormID = 'W09F1005'" . PHP_EOL;

                        $this->connectionHR->statement($sql);
                        return json_encode(array("rowData" => [], "status" => 'SUCCESS'));
                    } catch (Exception $ex) {
                        return json_encode(array("rowData" => [], "status" => 'ERROR'));
                    }
                }
                break;

            case "saveConfirm":
                \Debugbar::info('da chay confirm');
                $action = Input::get('actionSave');
                $sql = "";
                //\Debugbar::info($action);
                try{
                    \Debugbar::info($action);
                    if($action == 'add'){// trường hợp thêm mới
                        \Debugbar::info($action);
                        $sql .= "EXEC W09P1005 " .PHP_EOL;
                        $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[500], NOT NULL
                        $sql .= "'".Session::getId()."',".PHP_EOL; //HostID, varchar[500], NOT NULL
                        $sql .= "'W09F1005',".PHP_EOL; //FormID, varchar[50], NOT NULL
                        $sql .= "0"; //Mode, tinyint, NOT NULL
                        //\Debugbar::info($sql);
                    }
                    if($action == 'edit'){//trường hợp edit
                        $sql .= "EXEC W09P1005 " .PHP_EOL;
                        $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[500], NOT NULL
                        $sql .= "'".Session::getId()."',".PHP_EOL; //HostID, varchar[500], NOT NULL
                        $sql .= "'W09F1005',".PHP_EOL; //FormID, varchar[50], NOT NULL
                        $sql .= "1"; //Mode, tinyint, NOT NULL
                    }
                    //\Debugbar::info($sql);
                    $this->connectionHR->statement($sql);

                    $sql = "DELETE FROM D09T6666".PHP_EOL;
                    $sql .= "WHERE UserID =  '$UserID' AND HostID = '$session'  AND  FormID = 'W09F1005'".PHP_EOL;

                    $this->connectionHR->statement($sql);
                    return "SUCCESS";
                }catch (Exception $ex){
                     //$ex->getMessage();
                    return "FAILED";
                }
                break;

            case "reloadComboOrgLevel":
                $mode = Input::get('mode',0);
                $OrgChartID = "";
                $OrgChartParentID = Input::get('OrgChartParentID');
                if(intval($mode) != 0){
                    $OrgChartID = Input::get('OrgChartID');
                }
                $sql ="--Do nguon Combo Cap to chuc".PHP_EOL;
                $sql .= "EXEC W09P1001 " .PHP_EOL;
                $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[500], NOT NULL
                $sql .= "'W09F1005',".PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'$session',".PHP_EOL; //HostID, varchar[500], NOT NULL
                $sql .= "'$OrgChartID',".PHP_EOL; //OrgchartID, varchar[500], NOT NULL
                $sql .= "$mode,".PHP_EOL;
                $sql .= "'$OrgChartParentID'";
                $rsOrgLevelID = $this->connectionHR->select($sql);

                \Debugbar::info($sql);
                $str = "<option value=''></option>";
                foreach ($rsOrgLevelID as $row) {
                    $str .= "<option value='" . $row["OrgLevelID"] . "'>" . $row["OrgLevelName"] . "</option>";
                }
                return $str;
                break;
        }
    }
}
