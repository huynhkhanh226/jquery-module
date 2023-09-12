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

class W90F1300Controller extends W9XController
{
    public function index($pForm, $g)
    {
        if (Request::isMethod('post')) {
            $input = Input::all();
            $pefrom = Input::get("slPeriodFrom","");
            $peto = Input::get("slPeriodTo","");
            $dfrom = Helpers::convertDate(Input::get("txtDateFrom",""),false);
            $dto = Helpers::convertDate(Input::get("txtDateTo",""),false);
            $mode = intval($input["mode"]) - 1;
            $vou = $input["slVoucherTypeID"];
            $vouno = $this->sqlstring($input["txtVoucherNo"]);
            $mod = $input["slModuleID"];
            $type = intval($input["optType"]);
            $user = Auth::user()->User()->UserID;
            $div = $input["slDivisionID"];

            $sql = "--Do nguon luoi" . PHP_EOL;
            $sql .= "EXEC W90P1300 '$user', '$div','".Session::get('Lang')."', '$pefrom', '$peto', $dfrom, $dto, N'$vou', N'$vouno',$type, N'$mod',$mode";
            $rs = $this->connection->select($sql);
            return View::make("W9X.W90.W90F1300_Ajax".($mode+1), compact('pForm', 'g', 'rs'));
        } else {
            $div = $this->LoadDivisionID("D90", $g);
            $period = $this->LoadPeriodData("D90", Session::get("W91P0000")['DivisionID']);
            $voutype = $this->LoadVoucherTypeIDData("D90", true, false);
            $sql = "--Do nguon module".PHP_EOL;
            $sql .= "SELECT '%' AS ModuleID, N'".Helpers::getRS($g,"Tat_ca_Web")."' AS ModuleName".PHP_EOL;
            $sql .= "UNION ALL".PHP_EOL;
            $sql .= "SELECT T1.ModuleID, T0.ModuleNameU as ModuleName".PHP_EOL;
            $sql .= "FROM D91T0021 T1  WITH(NOLOCK) INNER JOIN LEMONSYS.dbo.D00T0130 T0 WITH(NOLOCK) ";
            $sql .= "ON 'D'+T1.ModuleID = T0.ModuleID";
            $module = $this->connection->select($sql);
            return View::make("W9X.W90.W90F1300", compact("period", "pForm", "g", "div", "voutype","module"));
        }
    }

}
