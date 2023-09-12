<?php
namespace W9X\W90;

use Debugbar;
use Helpers;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W9X\W9XController;

class W90F1302Controller extends W9XController
{
    public function index()
    {
        $g = 1;
        $input = Input::get("row");
        $div = Input::get("div");
        $vou = $input["VoucherID"];
        $voudate = Helpers::convertDate($input["VoucherDate"]);
        $mod = $input["ModuleID"];
        $user = Auth::user()->User()->UserID;

        $sql = "--Do nguon But toan kep" . PHP_EOL;
        $sql .= "EXEC W90P1302 '$user','$div','".Session::get('Lang')."', '$vou', $voudate, '$mod', 0";
        $rs1 = $this->connection->select($sql);

        $sql = "--Do nguon But toan don" . PHP_EOL;
        $sql .= "EXEC W90P1302 '$user','$div','".Session::get('Lang')."', '$vou', $voudate, '$mod', 1";
        $rs2 = $this->connection->select($sql);
        return View::make("W9X.W90.W90F1302", compact('g', 'rs1', 'rs2'));
    }

}
