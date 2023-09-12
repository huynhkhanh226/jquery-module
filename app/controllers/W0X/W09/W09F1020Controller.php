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

class W09F1020Controller extends W0XController
{

    public $i = 0;
    public function index($pForm, $g, $task = "")
    {
        $titleW09F1020 = $this->getModalTitle('W09F1020');
        $lang = Session::get('Lang');
        $UserID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeID = Auth::user()->user()->HREmployeeID;
        $session = Session::getId();
        \Debugbar::info($titleW09F1020);
        switch ($task) {
            case "":
                $sql ="--Do nguon combo co cau to chuc".PHP_EOL;
                $sql .= "EXEC W09P1010 " .PHP_EOL;
                $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[500], NOT NULL
                $sql .= "'W09F1020',".PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'$session'"; //HostID, varchar[500], NOT NULL
                //$cbOrgChart = $this->connectionHR->select($sql);
                $tmp = $this->connectionHR->select($sql);
                $cbOrgChart = [];
                foreach ($tmp as $r) {
                    if ($r['OrgChartParentID'] == $r['OrgChartID']) {
                        unset($r['OrgChartParentID']);
                        $r['expanded'] = true;//bung ra list con
                    }else{
                        $r['expanded'] = false;//ko bung list con
                    }
                    $cbOrgChart[] = $r;//bỏ phần tử vào mảng
                }
                \Debugbar::info($cbOrgChart);

                $sql ="--Do nguon so do".PHP_EOL;
                $sql .= "EXEC W09P1020 " .PHP_EOL;
                $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[500], NOT NULL
                $sql .= "'W09F1020',".PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'$session',".PHP_EOL; //HostID, varchar[500], NOT NULL
                $sql .= "''"; //OrgChartID, varchar[500], NOT NULL
                $dataOrgChart = $this->connectionHR->select($sql);
                foreach ($dataOrgChart as &$row) {
                    $row['ImageID'] = "data:image/jpeg;base64,". base64_encode(pack('H'.strlen($row['ImageID']), $row['ImageID']));
                    //\Debugbar::info($row['ImageID']);
                }
                $result = array_shift($dataOrgChart);
                $this->convertOrgChartData($result, $dataOrgChart);
                return View::make('W0X.W09.W09F1020', compact('pForm', 'g', 'titleW09F1020', 'result', 'cbOrgChart'));
                break;

            case "reloadCBOrgChartID":
                \Debugbar::info(Input::get('OrgChartID', ''));
                $OrgChartID = Input::get('OrgChartID', '');
                $sql ="--Do nguon so do".PHP_EOL;
                $sql .= "EXEC W09P1020 " .PHP_EOL;
                $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[500], NOT NULL
                $sql .= "'W09F1020',".PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'$session',".PHP_EOL; //HostID, varchar[500], NOT NULL
                $sql .= "'$OrgChartID'"; //OrgChartID, varchar[500], NOT NULL

                $dataOrgChart = $this->connectionHR->select($sql);
                foreach ($dataOrgChart as &$row) {
                    $row['ImageID'] = "data:image/jpeg;base64,". base64_encode(pack('H'.strlen($row['ImageID']), $row['ImageID']));
                    //\Debugbar::info($row['ImageID']);
                }

                $result = array_shift($dataOrgChart);
                $this->convertOrgChartData($result, $dataOrgChart);
                \Debugbar::info($result);
                return $result;
                break;
        }
    }

    public function convertOrgChartData(&$rowData, $arr){
        $ID = $rowData['StuctureID'];
        $arrChild = [];
        foreach ($arr as $key => $item) {
            if ($item['StructureParentID'] == $ID){
                $arrChild[] = $item;//
                unset($arr[$key]);
            }
        }

        if(count($arrChild) > 0){
            foreach($arrChild as &$row) {//duyệt mảng phần tử con
                $this->convertOrgChartData($row, $arr);
            }
        }
        if (!empty($arrChild)) {//
            foreach ($arrChild as $item) {//lấy phần tử ra xong add lại vào mảng để đúng cấu trúc
                $rowData['children'][] = $item;
            }
        }
    }
}
