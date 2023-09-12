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

class W90F0120Controller extends W9XController
{
    public function index($pForm, $g)
    {
        if(Request::isMethod('post')) {
            $input = Input::all();
            $pefrom = $input["slPeriodFrom"];
            $peto = $input["slPeriodTo"];
            $mode = intval($input["mode"]);
            $acc = $input["slAccountID"];
            $user = Auth::user()->User()->UserID;
            $div = $input["slDivisionID"];

            $sql ="--Do nguon luoi".PHP_EOL;
            $sql .= "EXEC W90P0120 '$user','$div', '$pefrom', '$peto','".Session::get('Lang')."', N'$acc',$mode";
            $rs=$this->connection->select($sql);
            return View::make("W9X.W90.W90F0120_Ajax".($mode+1),compact('pForm','g','rs'));
        }else{
            $div = $this->LoadDivisionID("D90",$g);
            $period = $this->LoadPeriodData("D90",Session::get("W91P0000")['DivisionID']);
            $rsAcc=$this->LoadAccountID();
            return View::make("W9X.W90.W90F0120", compact("period","pForm","g","div","rsAcc"));
        }
    }

}
