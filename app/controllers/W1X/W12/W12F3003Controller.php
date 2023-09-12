<?php
namespace W1X\W12;

use Auth;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W1X\W1XController;

class W12F3003Controller extends W1XController
{
    public function detail($vou, $g, $isApproval)
    {
        $mod="D12";
        $query = "EXEC W84P4001 '" . Session::get('W91P0000')["DivisionID"] . "', 'D12', 'D12F3003', '$vou', '" . Session::get('Lang') . "',0,'" . Auth::user()->user()->UserID . "'," . $isApproval;
        $sql = "EXEC D12P3003 '" . Session::get("W91P0000")['DivisionID'] . "', '" . Auth::user()->user()->UserID . "', 'WEB', '" . Session::get("W91P0000")['TranMonth'] . "', '" . Session::get("W91P0000")['TranYear'] . "', '', '$vou'";
        if ($g == 4) {
            $rs = $this->connectionHR->select($query);
            $rsDetail = $this->connectionHR->select($sql);
        } else {
            $rs = $this->connection->select($query);
            $rsDetail = $this->connection->select($sql);
        }

        return View::make("W1X.W12.W12F3003_DTAjax", compact("rs", 'rsDetail','g','mod'));
    }
}
