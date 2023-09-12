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

class W09F4444Controller extends W0XController
{
    public function index($g)
    {
        $input = Input::all();
        $empid = isset($input["empid"])?$input["empid"]:"";
        $sql= "--Do nguon cho man hinh thong tin co ban cua nhan vien".PHP_EOL;
        $sql.="EXEC W09P4444 '".Session::get("W91P0000")['HRDivisionID']."', '".Auth::user()->user()->UserID."', '".Session::get('Lang')."', '$empid'";
        $rsData = $this->connectionHR->SelectOne($sql);
        return View::make("W0X.W09.W09F4444", compact('rsData', 'g'));
    }
}
