<?php
namespace W2X\W25;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W2X\W2XController;

class W25F2080Controller extends W2XController
{
    public function index($pForm, $g, $task = '')
    {
        $userID = Auth::user()->user()->UserID;
        $employeeID= Auth::user()->user()->HREmployeeID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $perW25F2080 = $this->getPermission("D25F2080"); //Phân quyền cho combo phòng bạn
        $perW25F2082 = Session::get($pForm); //Phân quyền cho form
        //$perW25F2080 = 3;
        //$perW25F2082 = 2;
        \Debugbar::info($perW25F2080);
        \Debugbar::info($perW25F2082);
        \Debugbar::info(Session::get("W91P0000"));

        switch ($task){
            case '':
                $departments = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1, false);
                $statuss = $this->LoadFixData("AppStatusW25F2080");
                $sql=" --Do nguon vi tri tuyen dung".PHP_EOL;
                $sql.=" SELECT		DutyID As PositionID, DutyNameU AS PositionName, DutyDisplayOrder".PHP_EOL;
                $sql.=" FROM		D09T0211  WITH(NOLOCK) ".PHP_EOL;
                $sql.=" WHERE		Disabled = 0".PHP_EOL;
                $sql.=" ORDER BY	DutyDisplayOrder, DutyName".PHP_EOL;
                $positions = [];
                $positions = $this->connectionHR->select($sql);
                return View::make("W2X.W25.W25F2080", compact("perW25F2080", "perW25F2082","pForm","g", "departments", "positions", "statuss"));
                break;
            case 'filter':
                $transID = Input::get("transID", "");
                $txtDateFromW25F2080 = Input::get("txtDateFromW25F2080", "") ;
                $txtDateToW25F2080 = Input::get("txtDateToW25F2080", "") ;
                //$txtDate = Input::get("txtDate", "") ;
                //$arr = explode("-", $txtDate);
                $txtDateFrom = \Helpers::convertDate($txtDateFromW25F2080);
                $txtDateTo = \Helpers::convertDate($txtDateToW25F2080);
                $cboDepartmentID = Input::get("departmentIDW25F2080", "") ;
                $cboPositionID = Input::get("cboPositionID", "") ;
                $cbAppStatusID = Input::get("cbAppStatusID", "") ;


                $sql=" -- Do nguon cho form".PHP_EOL;
                $sql .=" EXEC W25P2080 '$divisionHR', '$userID' ,'$pForm' , $txtDateFrom, $txtDateTo, '$cbAppStatusID', '$cboDepartmentID', '$cboPositionID', '$transID' ".PHP_EOL;
                \Debugbar::info($sql);
                $rsData = $this->connectionHR->select($sql);
                \Debugbar::info(json_encode($rsData));
                return ($rsData);
                break;
            case 'delete':
                $transID = Input::get("transID", "");
                $sql =" -- Thuc thi store xoa du lieu".PHP_EOL;
                $sql .="  EXEC W25P2082 '$divisionHR', '$userID', '$transID'	".PHP_EOL;
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
