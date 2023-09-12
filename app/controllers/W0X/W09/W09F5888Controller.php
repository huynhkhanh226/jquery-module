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

class W09F5888Controller extends W0XController
{
    public function Index($pForm, $g)
    {
        $Department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        $ListStatus = $this->LoadFixData('SearchKeyW09F5888', $g);
        $WorkingStatusID = $this->LoadtdbcWorkingStatusID(true);

        return View::make("W0X.W09.W09F5888", compact('g', 'pForm', 'Department', 'WorkingStatusID', 'ListStatus'));
    }

    public function Filter($pForm, $g)
    {
        $all = Input::all();
        //L?u mode F12
        if (isset($all['action']) && $all['action'] == "saveF12") {
            $arrColHide = Input::get('arrHide', []);
            return $this->SaveF12($arrColHide, "09", "W09F5888");
        } else {
            $DepartmentID = $all['cbDepartmentID'];
            $RangeID = $all['cbRangeID'];
            $WorkingStatusID = $all['cbWorkingStatusID'];
            $UserID = Auth::user()->user()->UserID;

            $sql = "--Do nguon cho luoi" . PHP_EOL;
            $sql .= "EXEC W09P5888 '$DepartmentID', '$RangeID', '$WorkingStatusID', '$UserID'";
            $rs = $this->connectionHR->select($sql);

            $arrColHide = $this->LoadDataF12("09", "W09F5888");
            return View::make("W0X.W09.W09F5888_Ajax", compact('g', 'pForm', 'rs', 'arrColHide'));
        }
    }
}
