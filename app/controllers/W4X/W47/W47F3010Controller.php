<?php

namespace W4X\W47;

use Auth;
use Config;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use Debugbar;
use W4X\W4XController;

class W47F3010Controller extends W4XController
{

    public function index($pForm, $g)
    {
        $userid = Auth::user()->user()->UserID;
        $lang = Session::get('Lang');
        //$all = Input::all();
        if (Request::isMethod('post')) {//Nhấn button Lọc hoặc thêm tab
            try {
                $unit = Input::get("slMoneyUnitID", "");
                $divisionID = Input::get("div", "");
                $subdivs = Input::get("subdiv", '');
                $pro = str_replace(",", ";", Input::get("project", ""));
                $ped = Input::get("slReportPeriod", "");
                $itemcode = Input::get("itemcode", "");
                $parameter = Input::get("parameter", "");
                $showdetail = Input::get("chkIsShowDetail", "off") == "on" ? 1 : 0;
                $inputAll = Input::all();
                $arrayField = Input::get("array", '');
                if ($arrayField != '') {//Phần dùng cho khi thêm tab
                    $arrayField = json_decode($arrayField, true);
                    $inputAll = $arrayField;
                    $divisionID = $arrayField['div'];
                    $pro = str_replace(",", ";", $arrayField['project']);
                    $ped = $arrayField['slReportPeriod'];
                    $unit = $arrayField["slMoneyUnitID"];
                    $showdetail = isset($arrayField["chkIsShowDetail"]) ? 1 : 0;
                }
                $year = intval(substr($ped, 0, 4));
                $btnYear = intval(Input::get("year", $year));
                $sql = "--Do nguon cot dong" . PHP_EOL;
                $sql .= "EXEC W47P3010 '$divisionID','$userid','WEB','$lang'," . intval(substr($ped, 4)) . "," . intval(substr($ped, 0, 4)) . ",'$unit',$showdetail,1, '$parameter', '$pro'";
                $rsCol = $this->connection->select($sql);

                $sql = "--Do nguon form" . PHP_EOL;
                $sql .= "EXEC W47P3010 '$divisionID','$userid','WEB','$lang'," . intval(substr($ped, 4)) . ", $year,'$unit',$showdetail, 3, '$parameter', '$pro'";
                $rsData = $this->connection->select($sql);

                //create param for W91F4010
                $mod = "D47";
                $tablename = "D47T2710";
                $key02ID = $pro;
                $voucherID = substr($ped, 4) . '/' . substr($ped, 0, 4);
                $name_company = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
                return View::make("W4X.W47.W47F3010_Template", compact('pForm', 'g', 'rsData', 'rsCol', 'inputAll', 'itemcode', 'year', 'btnYear', 'divisionID', 'mod', 'voucherID', 'tablename', 'name_company', 'key02ID'));

            } catch (Exception $ex) {
                \Debugbar::info($ex->getMessage());
            }
        } else {
            $modalTitle = $this->getModalTitle($pForm);
            //$div = $this->LoadDivisionID('D90',$g,true);

            $sql = "--Do nguon Don vi" . PHP_EOL;
            $sql .= "EXEC W47P3001 '$userid', 'Division', '$lang'";
            $div = $this->connection->select($sql);

            $sql = "--Do nguon Phan nhom" . PHP_EOL;
            $sql .= "EXEC W47P3001 '$userid', 'SubDivision', '$lang'";
            $subdiv = $this->connection->select($sql);

            $project = $this->loadProject("%");
            $period = $this->loadPeriodLocal();
            $sql = "--Do nguon DVT" . PHP_EOL;
            $sql .= "EXEC W47P3001 '$userid', 'MoneyUnit', '$lang'";
            $unit = $this->connection->select($sql);
            $jsonunit = [];
            foreach ($unit as $row) {
                $jsonunit[$row['Value']] = $row['Caption'];
            }
            return View::make("W4X.W47.W47F3010", compact('subdiv','pForm', 'g', 'modalTitle', 'div', 'unit', 'lang', 'project', 'period'));
        }
    }

    //Ham nay viet rieng theo yeu cau PSAD - THANH HIEN
    public function loadPeriodLocal(){
        $sql = "--Do nguon Ky" . PHP_EOL;
        $sql .= " Select DISTINCT     REPLACE(STR(TranMonth, 2), ' ', '0') + '/' + STR(TranYear, 4) AS Period, TranMonth, TranYear, '%' AS DivisionID,TranMonth+ TranYear*100     as TempCol";
        $sql .= " From D90T9999 WITH(NOLOCK)";
        $sql .= " Order By DivisionID, TranYear DESC, TranMonth DESC";
        $str = "";
        $period = $this->connection->select($sql);
        foreach ($period as $row) {
            $str .= "<option  value='" . $row["TranYear"] . $row["TranMonth"] . "'>" . $row["Period"] . "</option>";
        }
        return $str;
    }

    public function loadProject($division)
    {
        $sql = "--Do nguon du an" . PHP_EOL;
        $sql .= "EXEC W47P3005 '$division','" . Auth::user()->User()->UserID . "',1, 0, 'W47F3010','" . Session::get('Lang') . "'";
        $pro = $this->connection->select($sql);
        $str = "";
        foreach ($pro as $row) {
            $str .= "<option title='" . $row["PropertyID"] . "' value='" . $row["PropertyID"] . "'>" . $row["PropertyName"] . "</option>";
        }
        return $str;
    }
    public function reLoadProject()
    {
        $division = (Input::get("div")) ;
        $sql = "--Do nguon du an" . PHP_EOL;
        $sql .= "EXEC W47P3005 '$division','" . Auth::user()->User()->UserID . "',1, 0, 'W47F3010','" . Session::get('Lang') . "'";
        $pro = $this->connection->select($sql);
        $str = "";
        foreach ($pro as $row) {
            $str .= "<option title='" . $row["PropertyID"] . "' value='" . $row["PropertyID"] . "'>" . $row["PropertyName"] . "</option>";
        }
        return $str;
    }
}
