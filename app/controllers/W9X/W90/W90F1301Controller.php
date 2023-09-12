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

class W90F1301Controller extends W9XController
{
    public function index($mode)
    {
        $g = 1;
        $input = Input::get("row");
        $pefrom = $input["MPeriodFrom"];
        $peto = $input["MPeriodTo"];
        $dfrom = Helpers::convertDate($input["MFromDate"]);
        $dto = Helpers::convertDate($input["MToDate"]);
        $type = intval($input["MType"]);
        $voutype = $input["MVoucherTypeID"];
        $vouno = $input["MVoucherID"];
        $mod = $input["MModuleID"];
        $user = Auth::user()->User()->UserID;
        $div = $input["MDivisionID"];
        if($mode==0)
            $key01 = Helpers::convertDate($input["VoucherDate"]);
        elseif($mode==1)
            $key01 = "'".$input["ModuleID"]."'";
        else
            $key01 = "'".$input["VoucherTypeID"]."'";

        $sql = "--Do nguon luoi" . PHP_EOL;
        $sql .= "EXEC W90P1301 '$user', '$div','" . Session::get('Lang') . "', '$pefrom', '$peto', $dfrom, $dto, '$voutype', '$vouno',$type, '$mod',$key01,$mode";
        $rs = $this->connection->select($sql);
        return View::make("W9X.W90.W90F1301", compact('g', 'rs', 'div', 'voutype'));
    }

}
