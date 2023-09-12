<?php
namespace W9X\W90;

use Debugbar;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W9X\W9XController;

class W90F0110Controller extends W9XController
{
    public function index($pForm, $g)
    {
        if(Request::isMethod('post')) {
            $input = Input::all();
            $tyfrom = substr($input["slPeriodFrom"],0,4);
            $tmfrom = substr($input["slPeriodFrom"],4);
            $tyto = substr($input["slPeriodTo"],0,4);
            $tmto = substr($input["slPeriodTo"],4);
            $mode = intval($input["optMode"]);
            $acc = $input["txtAccountID"];
            $div = $input["slDivisionID"];
            $sql ="--Do nguon luoi".PHP_EOL;
            $sql .= "EXEC W90P0110 '".Auth::user()->User()->UserID."','$div',$tmfrom,$tyfrom,$tmto,$tyto,$mode,'".Session::get('Lang')."', '$acc'";
            $rs=$this->connection->select($sql);
            return View::make("W9X.W90.W90F0110_Ajax",compact('pForm','g','rs'));
        }else{
            $div = $this->LoadDivisionID("D90",$g);
            $period = $this->LoadPeriodData("D90",Session::get("W91P0000")['DivisionID']);
            return View::make("W9X.W90.W90F0110", compact("period","pForm","g","div"));
        }
    }

}
