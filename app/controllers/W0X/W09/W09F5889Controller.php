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

class W09F5889Controller extends W0XController
{
    public function Index($pForm, $g, $id)
    {
        $sql = "--Do nguon cho master" . PHP_EOL;
        $sql .= "EXEC W09P5889 '$id',0";
        $rs = $this->connectionHR->select($sql);

        $sql = "--Do nguon cho luoi" . PHP_EOL;
        $sql .= "EXEC W09P5889 '$id',1";
        $rsGrid = $this->connectionHR->select($sql);

        return View::make("W0X.W09.W09F5889", compact('g', 'pForm','rs', 'rsGrid'));
    }

/*    public function Filter($pForm, $g)
    {
        $all = Input::all();
        Debugbar::info($all);
        $DepartmentID =  $all['cbDepartmentID'];
        $RangeID = $all['cbRangeID'];
        $WorkingStatusID  = $all['cbWorkingStatusID'];
        $UserID = Auth::user()->UserID;

        $sql = "--Do nguon cho luoi" . PHP_EOL;
        $sql .= "EXEC W09P5888 '$DepartmentID', '$RangeID', '$WorkingStatusID', '$UserID'";
        $rs = $this->connectionHR->select($sql);
        return View::make("W0X.W09.W09F5888_Ajax", compact('g', 'pForm', 'rs'));
    }*/
}
