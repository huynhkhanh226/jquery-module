<?php
namespace W0X\W01;

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

class W01F9136Controller extends W0XController
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
            $sql .= "EXEC W01P5100 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->User()->UserID."','".Session::get('Lang')."',$dateFrom,$dateTo, N'$status'";
            $detail = $this->connection->select($sql);

            $sql ="--Do nguon combo Trang thai".PHP_EOL;
            $sql .= "EXEC W01P9135 $status, '".Session::get('Lang')."'";
            $status = $this->connection->select($sql);
            $cbStatus = "";
            foreach ($status as $row){
                $cbStatus .= "<option value='".$row["Code"]."'>".$row["Description"]."</option>";
            }
            return View::make("W0X.W01.W01F9136_LeftAjax", compact("detail","cbStatus"));
        } else {
            $sfilter = $this->LoadFixData("ApprovalD01",$g);
            $employee = $this->LoadCreateByData();
            $modalTitle = $this->getModalTitle($pForm);
            return View::make("W0X.W01.W01F9136", compact('modalTitle', 'g', 'pForm','employee','sfilter'));
        }
    }

    public function detail($id)
    {
        $mod = "D01";$g=1;
        $query = "EXEC W84P4001 '" . Session::get('W91P0000')["DivisionID"] . "', 'D01', 'D01F9136', '$id', '" . Session::get('Lang') . "',0,'" . Auth::user()->user()->UserID . "', 0";
        $sql = "EXEC W01P5101 '" . Session::get("W91P0000")['DivisionID'] . "', '" . Auth::user()->user()->UserID . "', 'WEB', '" . Session::get("W91P0000")['TranMonth'] . "', '" . Session::get("W91P0000")['TranYear'] . "', '', '$id', '" . Session::get('Lang') . "'";
        $rs = $this->connection->select($query);
        $rsDetail = $this->connection->select($sql);
        return View::make("W0X.W01.W01F9136_DTAjax", compact("rs", 'rsDetail', 'g', 'mod'));
    }

    public function savedata($id){
        $isacc = intval(Input::get('isaccept'));
        $status = Input::get('status');
        $sql ="--Luu du lieu".PHP_EOL;
        $sql .= "EXEC W01P9136 '".Session::get("W91P0000")['DivisionID']."','".Session::get('Lang')."', 'D01F9136', '".Auth::user()->User()->UserID."',$status, '$id',$isacc";
        return intval($this->connection->statement($sql));
    }
}
