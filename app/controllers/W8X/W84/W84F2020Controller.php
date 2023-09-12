<?php
namespace W8X\W84;

use Auth;
use DB;
use Input;
use Mail;
use Request;
use Session;
use View;
use Helpers;
use W8X\W8XController;

class W84F2020Controller extends W8XController {
    public function index($pForm,$cForm,$g, $module, $ApprovalStatus=0, $key1=null,$key2=null )
    {

        ob_end_clean();
        ob_start();
        if(Request::isMethod("post")) {
            $dateFrom="'01/01/2000'";$dateTo="'01/01/9999'";
            $isApproval= intval(Input::get('isApproval'));
            $FromTo=intval(Input::get('FromTo'));
            Helpers::getFromToDate($FromTo, $dateFrom, $dateTo);
            if ($g==4)
            {
                $SQLData = "EXEC W84P4000 '". Session::get("W91P0000")['HRDivisionID'] ."', '$module', '$pForm',  ". $isApproval .", 0, 0, ".Session::get("W91P0000")['HRTranMonth'].", ". Session::get("W91P0000")['HRTranYear'] .", '". Auth::user()->user()->UserID ."', '".Session::get('Lang')."', 1," .  $dateFrom . "," . $dateTo;
                $detail=$this->connectionHR->select($SQLData);
            }
            else
            {
                $SQLData = "EXEC W84P4000 '". Session::get("W91P0000")['DivisionID'] ."', '$module', '$pForm',  ". $isApproval .", 0, 0, ".Session::get("W91P0000")['TranMonth'].", ". Session::get("W91P0000")['TranYear'] .", '". Auth::user()->user()->UserID ."', '".Session::get('Lang')."', 1," .  $dateFrom . "," . $dateTo;
                $detail=$this->connection->select($SQLData);
            }
            \Debugbar::info($SQLData);
            \Debugbar::info($detail);

            return View::make("layout.component.listvoucher",compact('detail','isApproval','g','cForm'));
        }
        else{
            $modalTitle= $this->getModalTitle($pForm);
            return View::make("W8X.W84.W84F2020",compact('modalTitle','cForm','g','pForm','ApprovalStatus','key1','key2'));
        }
    }
}
