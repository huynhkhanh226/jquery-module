<?php

namespace W0X\W09;

use Auth;
use Carbon\Carbon;
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

class W09F2021Controller extends W0XController
{
    public function detail($vou, $g, $isApproval)
    {
        $ApprovalLevel = Input::get("ApprovalLevel", 0);
        $pForm = 'D09F2081';
        $titleD09F2021 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $session = Session::getId();
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $perD09F2021 = $this->getPermission($pForm);
        $creatorHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $moduleID = 'D09';
        $Mode = 0;
        $locale = Session::get("locate");

        $sql = "--Do nguon chi tiet" . PHP_EOL;
        $sql .= "EXEC W84P4001 '$divisionHR', '$moduleID', '$pForm', '$vou', '$lang',$Mode,'$userID', $isApproval";
		//return $sql;
        Debugbar::info($sql);
        $rsDetail = $this->connectionHR->select($sql);
        Debugbar::info($rsDetail);

        return View::make("W0X.W09.W09F2021_DTAjax", compact("titleD09F2021","rsDetail", 'vou', 'g', 'isApproval'));
    }



}
