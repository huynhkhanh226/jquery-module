<?php
namespace W4X\W49;

use Auth;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W4X\W4XController;

class W49F2222Controller extends W4XController {

    //Duyệt chứng chỉ thanh toán
    public function detail($vou,$g,$isApproval) {
        $mod="D49";
        $query=  "EXEC W84P4001 '". Session::get('W91P0000')["DivisionID"] ."', '$mod', 'D49F2222', '$vou', '" . Session::get('Lang') ."',0,'" . Auth::user()->user()->UserID."',".$isApproval;
        $rs=$this->connection->select($query);
        return View::make("W4X.W49.W49F2222_DTAjax",compact("rs","g","mod"));
    }
}
