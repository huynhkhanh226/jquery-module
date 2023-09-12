<?php
namespace ZXX\PH;

use Auth;
use Debugbar;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Helpers;
use ZXX\ZXXController;

class W09F1920Controller extends ZXXController
{

    public function index($pForm, $g)
    {
        if (Request::isMethod('post')) {
            if (Input::get('action', '') == "saveF12") {
                $arrColHide = Input::get('arrHide', []);
                return $this->SaveF12($arrColHide, "09", "W09F1920");
            }
            $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
            $dep = Input::get('slDepartmentID', '');
            $iswork = intval(Input::get('slIsEmpWork', 1));
            $reload = Input::get('reload', false) == 'true';
            $sql = "--Do nguon luoi" . PHP_EOL;
            $sql .= "EXEC W09P1920 '$user', '$dep',$iswork, '', '".Session::get("W91P0000")['HRDivisionID']."'";
            $rsData = $this->connectionHR->select($sql);
            if ($reload){
                return json_encode($rsData);
            }
            $per = $this->getPermission($pForm);
            return View::make("ZXX.PH.W09F1920_Ajax", compact('pForm', 'g', 'rsData', 'per'));
        } elseif (Request::isMethod("delete")) {
            $id = Input::get('id', '');
            $sql = "SELECT TOP 1 1  FROM D29T2020 WITH(NOLOCK) WHERE EmployeeID = '$id'";
            if (count($this->connectionHR->select($sql))==0) {
                $sql = "--Xoa nhan vien" . PHP_EOL;
                $sql .= "EXEC W09P1921 '".Session::get("W91P0000")['HRDivisionID']."','$id'";
                $this->connectionHR->statement($sql);
                return json_encode(["code" => 1, "mess" => ""]);
            } else
                return json_encode(["code" => 0, "mess" => str_replace('@EmployeeID',$id,Helpers::getRS($g,"Nhan_vien_@EmployeeID_da_ton_tai_du_lieu_dang_ky_thoi_gian_bieu")). Helpers::getRS($g,"Ban_khong_duoc_phep_xoa_nhan_vien_nay")]);
        } elseif (Request::isMethod("get")) {
            $sql = "-- Combo Phong Ban" . PHP_EOL;
            $sql .= "SELECT '%' AS DepartmentID, N'" . Helpers::getRS($g, "Tat_ca_Web") . "' AS DepartmentName, 0 AS DepDisplayOrder, 0 AS DisplayOrder " . PHP_EOL;
            $sql .= "UNION" . PHP_EOL;
            $sql .= "SELECT DepartmentID, DepartmentNameU AS DepartmentName, DepDisplayOrder, 1 AS DisplayOrder" . PHP_EOL;
            $sql .= "FROM D91T0012 WITH(NOLOCK) " . PHP_EOL;
            $sql .= "WHERE Disabled = 0" . PHP_EOL;
            $sql .= "AND DivisionID = '" . Session::get("W91P0000")['HRDivisionID'] . "'" . PHP_EOL;
            $sql .= "ORDER BY DisplayOrder, DepDisplayOrder, DepartmentName";
            $depart = $this->connectionHR->select($sql);
            $arrColHide = $this->LoadDataF12("09", "W09F1920");
            return View::make("ZXX.PH.W09F1920", compact('pForm', 'g', 'depart','arrColHide'));
        }
    }

}
