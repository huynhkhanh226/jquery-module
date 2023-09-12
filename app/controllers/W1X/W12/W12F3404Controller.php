<?php
namespace W1X\W12;

use Auth;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use Debugbar;
use W1X\W1XController;

class W12F3404Controller extends W1XController
{
    public function W12F3404DT($vou, $g, $isApproval)
    {
        $divisionid = Session::get('W91P0000')["DivisionID"];
        $lang = Session::get('Lang');
        $userid = Auth::user()->user()->UserID;
        $tranmonth = Session::get("W91P0000")['TranMonth'];
        $tranyear = Session::get("W91P0000")['TranYear'];
        $mod = "D12";

        $sql = "--Do nguon cho master" . PHP_EOL;
        $sql .= "EXEC W84P4001 '" . Session::get('W91P0000')["DivisionID"] . "', '$mod', 'D12F3404', '$vou', '" . Session::get('Lang') . "',0,'" . Auth::user()->user()->UserID . "'," . $isApproval;
        if ($g == 4) {
            $rsMaster = $this->connectionHR->select($sql);
        } else {
            $rsMaster = $this->connection->select($sql);
        }

        $sql = "--lay cot dong NCC-NhaThau" . PHP_EOL;
        $sql .= "EXEC D12P3403 '$divisionid', '$userid', 'WEB', '$tranmonth', '$tranyear', '$lang', '$vou', 1, 0,'', 1";
        if ($g == 4) {
            $rsCols = $this->connectionHR->select($sql);
        } else {
            $rsCols = $this->connection->select($sql);
        }
        $sql = "--Do nguon cho NCC-NhaThau" . PHP_EOL;
        $sql .= "EXEC D12P3403 '$divisionid', '$userid', 'WEB', '$tranmonth', '$tranyear','$lang', '$vou', 2, 0,'',1";
        if ($g == 4) {
            $rsSupplier = $this->connectionHR->select($sql);
        } else {
            $rsSupplier = $this->connection->select($sql);
        }

        $sql = "--Do nguon luoi theo muc tieu gia" . PHP_EOL;
        $sql .= "EXEC D12P3403 '$divisionid', '$userid', 'WEB', '$tranmonth', '$tranyear','$lang', '$vou', 3,0,'',1";
        if ($g == 4) {
            $rsRate = $this->connectionHR->select($sql);
        } else {
            $rsRate = $this->connection->select($sql);

        }
        $sql = "--Do nguon cho Sub muc tieu gia" . PHP_EOL;
        $sql .= "EXEC D12P3403 '$divisionid', '$userid', 'WEB', '$tranmonth', '$tranyear', '$lang', '$vou', 4,0,'',1";
        if ($g == 4) {
            $rsSubRate = $this->connectionHR->select($sql);
        } else {
            $rsSubRate = $this->connection->select($sql);
        }

        $sql = "--Load luoi mat hang" . PHP_EOL;
        $sql .= "EXEC D12P3403 '$divisionid', '$userid', 'WEB', '$tranmonth', '$tranyear', '$lang', '$vou',5,0,'',1";
        if ($g == 4) {
            $rsProduct = $this->connectionHR->select($sql);
        } else {
            $rsProduct = $this->connection->select($sql);
        }
        $sql = "--Luoi chi tiet mat hang" . PHP_EOL;
        $sql .= "EXEC D12P3403 '$divisionid', '$userid', 'WEB', '$tranmonth', '$tranyear','$lang', '$vou', 6,0,'',1";
        if ($g == 4) {
            $rsProductDetail = $this->connectionHR->select($sql);
        } else {
            $rsProductDetail = $this->connection->select($sql);
        }

        return View::make("W1X.W12.W12F3404_DTAjax", compact("g", "mod", "rsMaster", "rsCols", "rsSupplier", "rsRate", "rsSubRate", "rsProduct", "rsProductDetail"));
    }
}
