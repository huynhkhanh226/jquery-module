<?php
namespace W7X\W75;
use Auth;
use DB;
use Session;
use View;
use W7X\W7XController;

class W75F0000Controller extends W7XController {

    public function index($pFrom,$g) {
        $userID = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $sql = "--Store do nguon man hinh cho ESS va MSS".PHP_EOL;
        $sql.= "EXEC W00P1011 '".\Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"])."','".$userID."','%','".Session::get('Lang')."','".\Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrvHR.database'))."'";
        $temList = $this->connectionLMS->select($sql);
        $menuList = array();

        if ($pFrom == "D75F0001"){
            $menuList = array_filter($temList, function($row) {
                return $row["ModuleGroupID"] == "MSS";
            });
        }

        if ($pFrom == "D75F0000"){
            $menuList = array_filter($temList, function($row) {
                return $row["ModuleGroupID"] == "ESS";
            });
        }

        \Debugbar::info($menuList);
        return View::make("W7X.W75.W75F0000",compact('pFrom','g','menuList'));
    }

    public function loadTable($emp){
        $g=4;
        $employeeid = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
        return View::make("W7X.W75.W75F0000_Ajax",compact('emp','g','employeeid'));
    }
}
