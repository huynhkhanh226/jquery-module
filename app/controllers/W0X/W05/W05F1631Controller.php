<?php
namespace W0X\W05;

use Auth;
use Config;
use DB;
use Debugbar;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W0X\W0XController;

class W05F1631Controller extends W0XController
{
    public function index($pForm, $g)
    {
        if (Request::isMethod("post")) {
            $dateFrom = "'01/01/2000'";
            $dateTo = "'01/01/9999'";
            $FromTo = intval(Input::get('FromTo'));
            Helpers::getFromToDate($FromTo, $dateFrom, $dateTo);
            $status = Input::get("status");

            $sql = "--Do nguon du lieu loc" . PHP_EOL;
            $sql .= "EXEC W05P1632 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->User()->UserID."','".Session::get('Lang')."',$dateFrom,$dateTo, N'$status'";
            $detail = $this->connection->select($sql);

            $sql ="--Do nguon combo Trang thai".PHP_EOL;
            $sql .= "EXEC W05P1631 $status, '".Session::get('Lang')."'";
            $status = $this->connection->select($sql);
            $cbStatus = "";
            foreach ($status as $row){
                $cbStatus .= "<option value='".$row["Status"]."'>".$row["StatusName"]."</option>";
            }
            return View::make("W0X.W05.W05F1631_LeftAjax", compact("detail","cbStatus"));
        } else {
            $sfilter = $this->LoadFixData("ApproveOrdersID",$g);
            $employee = $this->LoadCreateByData();
            $modalTitle = $this->getModalTitle($pForm);
            return View::make("W0X.W05.W05F1631", compact('modalTitle', 'g', 'pForm','employee','sfilter'));
        }
    }

    public function detail($id)
    {
        $mod = "D05";$g=1;
        $query = "EXEC W84P4001 '" . Session::get('W91P0000')["DivisionID"] . "', 'D05', 'D05F1631', '$id', '" . Session::get('Lang') . "',0,'" . Auth::user()->user()->UserID . "', 0";
        $rs = $this->connection->select($query);
        $sql ="--Do nguon luoi chi tiet".PHP_EOL;
        $sql .= "EXEC W05P1634 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->User()->UserID."','WEB', 'D05F1631','".Session::get('Lang')."', '$id', 1";
        $rsDetail = $this->connection->select($sql);
        return View::make("W0X.W05.W05F1631_DTAjax", compact("rs", 'rsDetail', 'g', 'mod'));
    }

    public function savedata($id){
        $status = Input::get('status');
        $sql ="--Luu du lieu".PHP_EOL;
        $sql .= "EXEC W05P1633 '".Session::get("W91P0000")['DivisionID']."','".Session::get('Lang')."', 'D05F1631','".Auth::user()->User()->UserID."',$status, N'$id'";
        return json_encode($this->connection->selectOne($sql));
    }
}
