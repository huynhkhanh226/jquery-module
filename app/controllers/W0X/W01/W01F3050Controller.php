<?php
namespace W0X\W01;

use Debugbar;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W0X\W0XController;

class W01F3050Controller extends W0XController
{
    public function index($pForm, $g)
    {

        $divisionList = $this->LoadDivisionID("D01", $g, true);
        \Debugbar::info($divisionList);
        //$division = Session::get("W91P0000")['HRDivisionID'];
        //$employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
        $lang = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        //$tranmonth = Session::get("W91P0000")['HRTranMonth'];
        //$tranyear = Session::get("W91P0000")['HRTranYear'];
        $all = Input::all();
        return View::make("W0X.W01.W01F3050", compact( 'pForm', 'g','divisionList'));

    }
    public function my_function($var){
        \Debugbar::info($var);
        return($var & 1);
    }

    public function action($pForm, $g, $task = '')
    {
        $divisionList = $this->LoadDivisionID("D01", $g);
        //$division = Session::get("W91P0000")['HRDivisionID'];
        //$employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
        $lang = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        //$tranmonth = Session::get("W91P0000")['HRTranMonth'];
        //$tranyear = Session::get("W91P0000")['HRTranYear'];
        $all = Input::all();
        \Debugbar::info($all);
        switch($task){
            case 'filter':
                $cboLeaveTypeFrom = $all['cboLeaveTypeFrom'];
                $cboLeaveTypeTo = $all['cboLeaveTypeTo'];
                $txtDataW01F3050 = \Helpers::convertDate($all['txtDataW01F3050']);
                $chkIsViewMoreDivOut = $all['isViewMoreDivOut'];
                $chkIsOnlyViewDivOut = $all['isOnlyViewDivOut'];

                $sql = "-- Store dung cot dong cho luoi".PHP_EOL;
                $sql .= "EXEC W01P3051 '$cboLeaveTypeFrom','$cboLeaveTypeTo','$userid',$txtDataW01F3050,0,$chkIsViewMoreDivOut,$chkIsOnlyViewDivOut".PHP_EOL;
                $colList = ($this->connection->select($sql));

                $sql = "-- Store do nguon luoi".PHP_EOL;
	            $sql .= "EXEC W01P3050 '$cboLeaveTypeFrom','$cboLeaveTypeTo','$userid',$txtDataW01F3050,0,$chkIsViewMoreDivOut,$chkIsOnlyViewDivOut".PHP_EOL;
                $dataList = $this->connection->select($sql);

                $sql = "-- Store dung cot dong cho luoi thuyet minh".PHP_EOL;
                $sql .= "EXEC W01P3051 '$cboLeaveTypeFrom','$cboLeaveTypeTo','$userid',$txtDataW01F3050,1,$chkIsViewMoreDivOut,$chkIsOnlyViewDivOut".PHP_EOL;
                $colList1 = ($this->connection->select($sql));

                $sql = "-- Store do nguon luoi thuyet minh".PHP_EOL;
                $sql .= "EXEC W01P3050 '$cboLeaveTypeFrom','$cboLeaveTypeTo','$userid',$txtDataW01F3050,1,$chkIsViewMoreDivOut,$chkIsOnlyViewDivOut".PHP_EOL;
                $temp = $this->connection->select($sql);
                $dataList1 = array();
                foreach($temp as $rowTest){
                    //$rowTest['Description'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$rowTest['Description'];
                    array_push($dataList1, $rowTest);
                }
                \Debugbar::info($dataList1);
                return View::make("W0X.W01.W01F3050_AjaxMaster", compact('pForm', 'g', 'dsPurpose','lang','colList','dataList','colList1','dataList1'));
                break;
            case 'detail':
                return View::make("W0X.W01.W01F3050_AjaxDetail", compact('pForm', 'g', 'dsPurpose','lang'));
                break;
        }

    }


}
