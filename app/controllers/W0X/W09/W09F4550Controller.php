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

class W09F4550Controller extends W0XController
{

    public function index($pForm, $g)
    {
        if(Request::isMethod("post")) {
            $dep=Input::get("dep");
            $sql ="--Do nguon du lieu loc".PHP_EOL;
            $sql .= "EXEC W09P4550 '$dep','".Auth::user()->user()->UserID."'";
            $detail =  $this->connectionHR->select($sql);
            return View::make("W0X.W09.W09F4550_LeftAjax", compact('detail', "dep"));
        }
        else{
            $department = $this->LoadDepartmentByG4($pForm,Session::get("W91P0000")['HRDivisionID'],'%',1);
            $modalTitle = $this->getModalTitle($pForm);
            return View::make("W0X.W09.W09F4550", compact('modalTitle', 'department', 'g', 'pForm'));
        }
    }

    public function listEmployee($dep,$field)
    {
        $g=4;
        $sql ="--Do nguon danh sach nhan vien".PHP_EOL;
        $sql .= "EXEC W09P4551 '$field','$dep','".Auth::user()->user()->UserID."'";
        $detail =  $this->connectionHR->select($sql);
        return View::make("W0X.W09.W09F4550_ListEmployee", compact('detail','g'));
    }

    public function loadImage()
    {
        $id = Input::get("id");
        $sql = "--Load hinh theo nhan vien" . PHP_EOL;
        $sql .= "Select top 1 EmployeePicture from D09T0300 with (nolock) where EmployeeID='$id'";
        $rs = $this->connectionHR->select($sql);
        $return = "";
        if (isset($rs[0]["EmployeePicture"]) && $rs[0]["EmployeePicture"]!='') {
            $return = "<img src='data:image/jpeg;base64," . base64_encode(pack('H' . strlen($rs[0]["EmployeePicture"]), $rs[0]["EmployeePicture"])) . "' class='user-image imgborder' style='height: 100px'/>";
        } else {
            $return = '<img src="'.asset('packages/default/L3/images/icon-user-default.png').'" class="user-image imgborder" style="height: 100px;width: 80px"/>';
        }
        return $return;
    }
}
