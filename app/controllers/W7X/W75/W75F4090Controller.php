<?php
namespace W7X\W75;

use Auth;
use DB;
use Exception;
use Input;
use Request;
use Session;
use View;
use W7X\W7XController;
use Helpers;
use Config;
use Mail;

class W75F4090Controller extends W7XController
{
    //Khi open tab s? g?i controller này

    public function index($pForm, $g, $task = '')
    {
        $all = Input::all();
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $employeeHR = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID : Auth::ess()->user()->HREmployeeID;
        $lang = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $tranmonthHR = Session::get("W91P0000")['HRTranMonth'];
        $tranyearHR = Session::get("W91P0000")['HRTranYear'];
        $modalTitle= $this->getModalTitleG4($pForm);
        $days=cal_days_in_month(CAL_GREGORIAN,$tranmonthHR,$tranyearHR);
        \Debugbar::info($days);
        switch ($task) {
            case '':
                $sql = "--Do nguon thong tin cong/phep" . PHP_EOL;
                $sql .= "EXEC W75P4090 '$divisionHR',$tranmonthHR,$tranyearHR,'$userid','$lang',1,'$employeeHR'". PHP_EOL;
                $rs = $this->connectionHR->select($sql);
                return View::make("W7X.W75.W75F4090", compact('pForm', 'g','rs','modalTitle','days'));
                break;
            default:
        }
    }
}
