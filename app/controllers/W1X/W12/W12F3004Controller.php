<?php
namespace W1X\W12;

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
use W1X\W1XController;

class W12F3004Controller extends W1XController
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
            $sql .= "EXEC W12P2015 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->User()->UserID."','".Session::get('Lang')."',$dateFrom,$dateTo, N'$status'";
            $detail = $this->connection->select($sql);
            return View::make("W1X.W12.W12F3004_LeftAjax", compact('detail'));
        } else {
            $sql = "Select StatusID, DescriptionU as Description From D12V9010 Where Language = '" . Session::get('Lang') . "'";
            $status = $this->connection->select($sql);
            $employee = $this->LoadCreateByData();
            $modalTitle = $this->getModalTitle($pForm);
            return View::make("W1X.W12.W12F3004", compact('modalTitle', 'status', 'g', 'pForm','employee'));
        }
    }

    public function detail($id)
    {
        $mod = "D12";$g=4;
        $query = "EXEC W84P4001 '" . Session::get('W91P0000')["DivisionID"] . "', 'D12', 'D12F3003', '$id', '" . Session::get('Lang') . "',0,'" . Auth::user()->user()->UserID . "', 0";
        $sql = "EXEC D12P3003 '" . Session::get("W91P0000")['DivisionID'] . "', '" . Auth::user()->user()->UserID . "', 'WEB', '" . Session::get("W91P0000")['TranMonth'] . "', '" . Session::get("W91P0000")['TranYear'] . "', '', '$id'";
        $rs = $this->connection->select($query);
        $rsDetail = $this->connection->select($sql);
        return View::make("W1X.W12.W12F3004_DTAjax", compact("rs", 'rsDetail', 'g', 'mod'));
    }

    public function savedata($id, $ostatus){
        $newstatus = Input::get('status');
        $des = Input::get('des');
        $emp = Input::get('emp');
        $sql ="--Luu du lieu".PHP_EOL;
        $sql .= "EXEC D12P2017 '".Session::get("W91P0000")['DivisionID']."', N'$id', N'$ostatus', N'$newstatus','".Session::get('Lang')."'".PHP_EOL;
        $sql .= "Delete D12T2020 Where PRID = '$id'".PHP_EOL;
        $sql .= "Insert Into D12T2020(PRID,StatusID, UserID, ModifyDate, ModifyNotes) ";
        $sql .= "Values('$id', '$newstatus', '" . Auth::user()->user()->UserID . "', getdate(), '$des')".PHP_EOL;
        $sql .= "IF NOT EXISTS (SELECT TOP 1 1 FROM D12T2030 WITH(NOLOCK) WHERE PRID= '$id' AND IsApproval = 0)".PHP_EOL;
        $sql .= "BEGIN".PHP_EOL;
        $sql .= "Delete From D12T2030 Where PRID='$id'".PHP_EOL;
        $sql .= "END".PHP_EOL;
        $sql .= "Update D12T2010 Set MStatus='$newstatus', LastModifyUserID='" . Auth::user()->user()->UserID . "', LastModifyDate=getdate(), ApproverID='$emp'".PHP_EOL;
        $sql .= "Where PRID = '$id'".PHP_EOL;
        return intval($this->connection->statement($sql));
    }
}
