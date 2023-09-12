<?php
namespace W7X\W75;
use Auth;
use Session;
use View;
use W7X\W7XController;

class W75F3030Controller extends W7XController {

    public function index($pForm, $g) {
        $g=4;
        $userid= (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $employeeid= (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
        $rData=$this->connectionHR->selectOne("EXEC W75P3030 '".Session::get("W91P0000")['HRDivisionID']."', ".Session::get("W91P0000")['HRTranMonth'] . ",". Session::get("W91P0000")['HRTranYear'] .",'".$userid."', 'D75F1005', '". $employeeid ."'");
        $sql ="--Do nguon Lich su tham gia BH".PHP_EOL;
        $sql .= "EXEC W75P3031 '".Session::get("W91P0000")['HRDivisionID']."','$userid', N'W75F3030','$employeeid','".Session::get('Lang')."'";
        $rsHistory = $this->connectionHR->select($sql);
        $modalTitle = $this->getModalTitleG4($pForm);
        return View::make("W7X.W75.W75F3030",compact('g','rData','rsHistory','modalTitle'));
    }
}
