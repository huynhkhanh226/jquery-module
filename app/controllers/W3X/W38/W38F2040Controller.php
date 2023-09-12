<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 20/11/2017
 * Time: 10:08 AM
 */
namespace W3X\W38;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use Helpers;
use W3X\W3XController;

class W38F2040Controller extends W3XController
{
    public function index($pForm, $g, $task = '')
    {
        $userID = Auth::user()->user()->UserID;
        $employeeID = Auth::user()->user()->HREmployeeID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $perW38F2040 = $this->getPermission("D38F2042"); //Phân quyền cho combo phòng bạn
        $perW38F2042 = Session::get($pForm); //Phân quyền cho form
        switch ($task) {
            case '':
                \Debugbar::info("phan quyen", $perW38F2040);
                $departments = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1, false);
                \Debugbar::info($departments);
                $status = $this->LoadFixData("AppStatusW38F2040");
                return View::make("W3X.W38.W38F2040", compact("perW38F2040","perW38F2042","pForm", "g", "departments", "status"));
                break;

            case 'filter':
                \Debugbar::info(Input::all());
                $transID = Input::get("transID", "");
                $TrainingDateFrom = Helpers::convertDate(Input::get('txtDateFromW38F2040'));
                $TrainingDateTo = Helpers::convertDate(Input::get('txtDateToW38F2040'));
                $DepartmentID = Input::get('departmentIDW38F2040');
                $AppStatusID = Input::get('cbAppStatusID');

                $sql=" -- Do nguon cho grid".PHP_EOL;
                $sql .=" EXEC W38P2040 '$divisionHR', '$userID' ,'$pForm' , $TrainingDateFrom, $TrainingDateTo, '$DepartmentID', '$AppStatusID', '$transID'";
                \Debugbar::info($sql);
                $rsData = $this->connectionHR->select($sql);
                \Debugbar::info(json_encode($rsData));
                return $rsData;
                break;

            case 'delete':
                $transID = Input::get("transID", "");
                $sql =" -- Thuc thi store xoa du lieu".PHP_EOL;
                $sql .="  EXEC W38P2042 '$divisionHR', '$userID', '$transID'".PHP_EOL;
                try {
                    $this->connectionHR->statement($sql) ;
                    return json_encode(['status' => 'SUCCESS']);
                } catch (Exception $ex) {
                    return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }
                break;
        }
    }
}