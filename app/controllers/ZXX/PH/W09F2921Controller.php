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

class W09F2921Controller extends ZXXController
{

    public function index($pForm, $g, $task = "")
    {
        $caption = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');//$this->getLang();
        $userID = Auth::user()->user()->UserID;//Auth::user()->user()->HREmployeeID;
        $employeeID = Auth::user()->user()->HREmployeeID;
        $divisionID = Session::get("W91P0000")['HRDivisionID'];
        $session = Session::getId();
        $locale = Debugbar::info(Session::get("locate"));
        $period = $this->LoadPeriodData("D90", Session::get("W91P0000")['DivisionID']);
        //$department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        //$employee = $this->LoadEmployeeByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', '%', 1);
        switch ($task) {
            case "": //truong hop nay la dc goi tu left menu
                //$sql = "--Do nguon cho master" . PHP_EOL;
                //$sql .= " EXEC W09P2920 '$userID','$divisionID',0,$employeeID,null,null";
                //$masterW09F2920 = $this->connectionHR->select($sql);
                //Debugbar::info($dataW09F2920);

                return View::make("ZXX.PH.W09F2921", compact('pForm', 'g', 'caption', 'period', 'department', 'employee'));
            case "reloaddepartment":
                $StrSearch= Input::get('StrSearch');
                $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1,true,$StrSearch);
                Debugbar::info($department);
                return $department;
            case "reloademployee":
                $StrSearch= Input::get('StrSearch');
                $employee = $this->LoadEmployeeByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', '%', 1,$StrSearch);
                Debugbar::info($employee);
                return $employee;
            case "loaddutyid":
                $sql = " --Do nguon cho chuc vu" . PHP_EOL;
                $sql .= " SELECT 	T1.DutyID, DutyNameU AS DutyName, Coefficient01 AS NNormalHours, DutyDisplayOrder" . PHP_EOL;
                $sql .= " FROM 		D09T0211 T1 WITH(NOLOCK)  " . PHP_EOL;
                $sql .= " LEFT JOIN	D13T1111 T2 WITH(NOLOCK) ON T1.DutyID = T2.TypeID" . PHP_EOL;
                $sql .= " WHERE 		T1.Disabled = 0 AND 	T2.Type = 'D09T0211'" . PHP_EOL;
                $sql .= " ORDER BY 	DutyDisplayOrder, DutyName" . PHP_EOL;
                $dataDutyID = $this->connectionHR->select($sql);
                for ($i = 0; $i < count($dataDutyID); $i++) {
                    $dataDutyID[$i]['NNormalHours'] = round($dataDutyID[$i]['NNormalHours'], 2);
                }
                return $dataDutyID;
            case "reloaddutyid":
                $str = Input::get("strSearch");
                $sql = " --Do nguon cho chuc vu" . PHP_EOL;
                $sql .= " SELECT 	T1.DutyID, DutyNameU AS DutyName, Coefficient01 AS NNormalHours, DutyDisplayOrder" . PHP_EOL;
                $sql .= " FROM 		D09T0211 T1 WITH(NOLOCK)  " . PHP_EOL;
                $sql .= " LEFT JOIN	D13T1111 T2 WITH(NOLOCK) ON T1.DutyID = T2.TypeID" . PHP_EOL;
                $sql .= " WHERE 		T1.Disabled = 0 AND 	T2.Type = 'D09T0211' AND T1.DutyID like '%".$str."%' " . PHP_EOL;
                $sql .= " ORDER BY 	DutyDisplayOrder, DutyName" . PHP_EOL;
                $dataDutyID = $this->connectionHR->select($sql);
                for ($i = 0; $i < count($dataDutyID); $i++) {
                    $dataDutyID[$i]['NNormalHours'] = round($dataDutyID[$i]['NNormalHours'], 2);
                }
                return $dataDutyID;
            case "loadgrid":
                return View::make("ZXX.PH.W09F2921_Ajax", compact('pForm', 'g'));
            case "reloadgrid":
                $input = Input::all();
                $optIsFilter = isset($input['optIsFilter']) ? $input['optIsFilter'] : 0;
                $optIsDate = isset($input['optType']) ? $input['optType'] : 0;
                $dateFrom = Helpers::convertDate(Input::get('txtDateFrom', ''));
                $dateTo = Helpers::convertDate(Input::get('txtDateTo', ''));
                $periodFrom = isset($input['slPeriodFrom']) ? $input['slPeriodFrom'] : "";
                $periodTo = isset($input['slPeriodTo']) ? $input['slPeriodTo'] : "";
                $deparment = isset($input['txtDepartmentW09F2921']) ? $input['txtDepartmentW09F2921'] : "%";
                $employee = isset($input['txtEmployeeW09F2921']) ? $input['txtEmployeeW09F2921'] : "%";

                $sql = "--Do nguon cho detail" . PHP_EOL;
                $sql .= " EXEC W09P2921 '$userID', '$divisionID', '$lang', $optIsFilter, $optIsDate, $dateFrom, $dateTo, '$periodFrom', '$periodTo', '$deparment', '$employee'";
                $dataW09F2921 = $this->connectionHR->select($sql);

                for ($i = 0; $i < count($dataW09F2921); $i++) {
                    $dataW09F2921[$i]['NormalHours'] = round($dataW09F2921[$i]['NormalHours'], 2);
                    $dataW09F2921[$i]['NNormalHours'] = round($dataW09F2921[$i]['NNormalHours'], 2);
                    $dataW09F2921[$i]['NormalAmount'] = round($dataW09F2921[$i]['NormalAmount'], 2);

                }

               /* foreach ($dataW09F2921 as $row) {
                    array_push($dataW09F2921, $row);

                }*/

                return json_encode(['dataW09F2921' => $dataW09F2921]);
            case "saverow":
                $rowDate = Input::get("rowDate");
                Debugbar::info($rowDate);
                $input = Input::all();
                $AttendanceDate = Helpers::convertDate(Input::get('AttendanceDate', ''));
                $ProjectID = $input['ProjectID'];
                $WorkID = $input['WorkID'];
                $NormalHours = $input['NormalHours'];
                $DutyID = $input['DutyID'];
                $NNormalHours = str_replace(',', '', $input['NNormalHours']);
                $NormalAmount = str_replace(',', '', $input['NormalAmount']);
                $employee = Input::get("EmployeeID");
                $sql = "--Luu sua 1 dong tren luoi" . PHP_EOL;
                $sql .= " Exec W09P2925 '$userID', '$session', '$divisionID', '$lang', 2, '$employee', $AttendanceDate, '$ProjectID', '$WorkID', $NormalHours, '$DutyID', $NNormalHours, $NormalAmount";
                if (Session::get($pForm) >= 2 && $this->connectionHR->statement($sql))
                    return 1;
                else
                    return 0;

            case "deleterow":
                $rowDate = Input::get("rowDate");
                Debugbar::info($rowDate);
                $input = Input::all();
                $AttendanceDate = Helpers::convertDate(Input::get('AttendanceDate', ''));
                $ProjectID = $input['ProjectID'];
                $WorkID = $input['WorkID'];
                $NormalHours = $input['NormalHours'];
                $DutyID = $input['DutyID'];
                $NNormalHours = str_replace(',', '', $input['NNormalHours']);
                $NormalAmount = str_replace(',', '', $input['NormalAmount']);
                $employee = Input::get("EmployeeID");
                $sql = "--Xoa 1 dong du lieu tren duoi" . PHP_EOL;
                $sql .= " Exec W09P2925 '$userID', '$session', '$divisionID', '$lang', 3, '$employee', $AttendanceDate, '$ProjectID', '$WorkID', $NormalHours, '$DutyID', $NNormalHours, $NormalAmount";
                if (Session::get($pForm) >= 4 && $this->connectionHR->statement($sql))
                    return 1;
                else
                    return 0;
            case "approverow":
                $rowDate = Input::get("rowDate");
                Debugbar::info($rowDate);
                $input = Input::all();
                $AttendanceDate = Helpers::convertDate(Input::get('AttendanceDate', ''));
                $ProjectID = $input['ProjectID'];
                $WorkID = $input['WorkID'];
                $NormalHours = $input['NormalHours'];
                $DutyID = $input['DutyID'];
                $NNormalHours = str_replace(',', '', $input['NNormalHours']);
                $NormalAmount = str_replace(',', '', $input['NormalAmount']);
                $employee = Input::get("EmployeeID");
                $sql = "--Duyet 1 dong du lieu" . PHP_EOL;
                $sql .= " Exec W09P2925 '$userID', '$session', '$divisionID', '$lang', 0, '$employee', $AttendanceDate, '$ProjectID', '$WorkID', $NormalHours, '$DutyID', $NNormalHours, $NormalAmount";
                if (Session::get($pForm) >= 4 && $this->connectionHR->statement($sql))
                    return 1;
                else
                    return 0;
            case "unapproverow":
                $rowDate = Input::get("rowDate");
                Debugbar::info($rowDate);
                $input = Input::all();
                $AttendanceDate = Helpers::convertDate(Input::get('AttendanceDate', ''));
                $ProjectID = $input['ProjectID'];
                $WorkID = $input['WorkID'];
                $NormalHours = $input['NormalHours'];
                $DutyID = $input['DutyID'];
                $NNormalHours = str_replace(',', '', $input['NNormalHours']);
                $NormalAmount = str_replace(',', '', $input['NormalAmount']);
                $employee = Input::get("EmployeeID");
                $sql = "--Duyet 1 dong du lieu" . PHP_EOL;
                $sql .= " Exec W09P2925 '$userID', '$session', '$divisionID', '$lang', 1, '$employee', $AttendanceDate, '$ProjectID', '$WorkID', $NormalHours, '$DutyID', $NNormalHours, $NormalAmount";
                if (Session::get($pForm) >= 4 && $this->connectionHR->statement($sql))
                    return 1;
                else
                    return 0;
            case "approveall":
                $grid = json_decode(Input::get("data"));
                Debugbar::info($grid);
                $sql = "";
                $sql .= "---- Xoa bang tam, chay 1 lan" . PHP_EOL;
                $sql .= " DELETE 	D09T6666 " . PHP_EOL;
                $sql .= " WHERE 	UserID = '$userID' AND HostID = '$session' AND FormID = 'W09F2921'" . PHP_EOL;
                foreach ($grid as $item) {
                    Debugbar::info($item);
                    $AttendanceDate = Helpers::convertDate($item->AttendanceDate);
                    $ProjectID = $item->ProjectID;
                    $WorkID = $item->WorkID;
                    $NormalHours = $item->NormalHours;
                    $DutyID = $item->DutyID;
                    $NNormalHours = str_replace(',', '', $item->NNormalHours);
                    $NormalAmount = str_replace(',', '', $item->NormalAmount);
                    $employee = $item->EmployeeID;
                    $IsApproved = $item->IsApproved;
                    if ($IsApproved == 0){
                        $sql .= "---- Insert tung dong du lieu vao bang tam" . PHP_EOL;
                        $sql .= " INSERT INTO D09T6666 ( UserID, HostID, FormID, Key01ID, Key02ID, Key03ID,Date01,Num01, Num02, Num03,Str01)" . PHP_EOL;
                        $sql .= " VALUES ( '$userID', '$session', 'W09F2921','$employee', '$ProjectID', '$WorkID',  $AttendanceDate, $NormalHours, $NNormalHours,$NormalAmount,  '$DutyID')" . PHP_EOL;
                    }

                }

                $sql .= "--Duyet 1 dong du lieu" . PHP_EOL;
                $sql .= " Exec W09P2925 '$userID', '$session', '$divisionID', '$lang', 0, '$employee', $AttendanceDate, '$ProjectID', '$WorkID', $NormalHours, '$DutyID', $NNormalHours, $NormalAmount". PHP_EOL;
                $sql .= "---- Xoa bang tam, chay 1 lan" . PHP_EOL;
                $sql .= " DELETE 	D09T6666 " . PHP_EOL;
                $sql .= " WHERE 	UserID = '$userID' AND HostID = '$session' AND FormID = 'W09F2921'" . PHP_EOL;

                if (Session::get($pForm) >= 4)
                    try {
                        $this->connectionHR->getPdo()->beginTransaction();
                        $this->connectionHR->getPdo()->exec($sql);
                        $this->connectionHR->getPdo()->commit();
                        $this->connectionHR->statement($sql);
                        return 1;
                    }catch (\Exception $e) {
                        Debugbar::info($e->getMessage());
                        return 0;
                    }
                else
                    return 0;

        }

    }
}
