<?php
namespace W7X\W75;
use Auth;
use Session;
use View;
use W7X\W7XController;

class W75F3020Controller extends W7XController {

    public function index($pForm, $g) {
        $g=4;
        $userid= (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $employeeid= (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
        $rData=$this->connectionHR->selectOne("EXEC W75P3020 '".Session::get("W91P0000")['HRDivisionID']."', ".Session::get("W91P0000")['HRTranMonth'] . ",". Session::get("W91P0000")['HRTranYear'] .",'".$userid."', 'D75F1005', '". $employeeid ."'");
        $modalTitle = $this->getModalTitleG4($pForm);
        return View::make("W7X.W75.W75F3020",compact('g','rData','modalTitle'));
    }
}
