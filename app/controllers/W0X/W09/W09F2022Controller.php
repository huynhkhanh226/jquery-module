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

class W09F2022Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {
        \Debugbar::info(Session::get("W91P0000"));
        $titleW09F2022 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $session = Session::getId();
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonthHR = Session::get("W91P0000")['HRTranMonth'];
        $tranYearHR = Session::get("W91P0000")['HRTranYear'];
        $perD09F2022 =  Session::get($pForm);// $this->getPermission("D09F2022");
        \Debugbar::info($perD09F2022);
        $employeeID = Auth::user()->user()->HREmployeeID;

        switch ($task) {
            case "":
                $blocks = $this->LoadBlockByG4($divisionHR, $userID, $pForm, 1);
                //$departments = $this->LoadDepartmentByG4($pForm, $divisionHR, "%", 1, true, "");
                //$teams = $this->LoadTeamByG4($pForm, $divisionHR, "%", 1);

                //$sql = "-- Do nguon caption dong va phan quyen du lieu".PHP_EOL;
                //$sql .= "EXEC W09P2022 	'$divisionHR', DeparmentID,@TeamID,@DateFrom,@DateTo,@UserID,@Mode"

                //$rsColumns = $this->connectionHR->select($sql);
                return View::make("W0X.W09.W09F2022", compact("perD09F2022", "blocks",'pForm','task', 'g', 'titleW09F2022' ));
                break;
            case "loaddepartment":
                $blockID = Input::get("blockID");
                $departments = $this->LoadDepartmentByG4($pForm, $divisionHR, "$blockID", 1, true, "");
                $str = "";
                foreach ($departments as $row){
                    $str .= "<option value='".$row["DepartmentID"]."'>".$row["DepartmentName"]."</option>";
                }
                return $str;
                break;
            case "loadteam":
                $blockID = Input::get("blockID");
                $departmentID = Input::get("departmentID");
                $teams = $this->LoadTeamByG4($pForm, $divisionHR, "$departmentID", 1);
                $str = "";
                foreach ($teams as $row){
                    $str .= "<option value='".$row["TeamID"]."'>".$row["TeamName"]."</option>";
                }
                return $str;
                break;
            case "filter":
                $cboBlockIDW09F2022 = Input::get("cboBlockIDW09F2022", "%");
                $cboDepartmentW09F2022 = Input::get("cboDepartmentW09F2022", "%");
                $txtDateFromW09F2022 = Helpers::convertDate(Input::get("txtDateFromW09F2022", ""));
                $txtDateToW09F2022 = Helpers::convertDate(Input::get("txtDateToW09F2022", ""));
                $cboTeamIDW09F2022 = Input::get("cboTeamIDW09F2022", "%");
                $mode = 0;
                $sql = "-- Do nguon caption dong va phan quyen du lieu".PHP_EOL;
                $sql .= "EXEC W09P2022 	'$divisionHR', '$cboDepartmentW09F2022','$cboTeamIDW09F2022',$txtDateFromW09F2022,$txtDateToW09F2022,'$userID',$mode";
                \Debugbar::info($sql);

                $rsColumns = $this->connectionHR->select($sql);
                \Debugbar::info($rsColumns);
                $rsData = [];
                $mode = 1;
                $sql = "-- Do nguon caption dong va phan quyen du lieu".PHP_EOL;
                $sql .= "EXEC W09P2022 	'$divisionHR', '$cboDepartmentW09F2022','$cboTeamIDW09F2022',$txtDateFromW09F2022,$txtDateToW09F2022,'$userID',$mode";
                \Debugbar::info($sql);

                $rsData = $this->connectionHR->select($sql);
                return View::make("W0X.W09.W09F2022_Ajax", compact('g', 'pForm','rsColumns', 'rsData'));
                break;
            case "save":
                $obj = Input::get("data", []);
                $sql = "";
                if ($perD09F2022 >= 2){
                    foreach ($obj as $row){
                        $TransID = $row["TransID"];
                        $EmployeeID = $row["EmployeeID"];
                        $HandOverInf01 = $row["HandOverInf01"];
                        $HandOverInf02 = $row["HandOverInf02"];
                        $HandOverInf03 = $row["HandOverInf03"];
                        $HandOverInf04 = $row["HandOverInf04"];
                        $HandOverInf05 = $row["HandOverInf05"];
                        $HandOverInf06 = $row["HandOverInf06"];
                        $HandOverInf07 = $row["HandOverInf07"];
                        $HandOverInf08 = $row["HandOverInf08"];
                        $HandOverInf09 = $row["HandOverInf09"];
                        $HandOverInf10 = $row["HandOverInf10"];
                        $HandOverInf11 = $row["HandOverInf11"];
                        $HandOverInf12 = $row["HandOverInf12"];
                        $HandOverInf13 = $row["HandOverInf13"];
                        $HandOverInf14 = $row["HandOverInf14"];
                        $HandOverInf15 = $row["HandOverInf15"];
                        $HandOverInf16 = $row["HandOverInf16"];
                        $HandOverInf17 = $row["HandOverInf17"];
                        $HandOverInf18 = $row["HandOverInf18"];
                        $HandOverInf19 = $row["HandOverInf19"];
                        $HandOverInf20 = $row["HandOverInf20"];
                        $HandOverInf21 = $row["HandOverInf21"];
                        $HandOverInf22 = $row["HandOverInf22"];
                        $HandOverInf23 = $row["HandOverInf23"];
                        $HandOverInf24 = $row["HandOverInf24"];
                        $HandOverInf25 = $row["HandOverInf25"];
                        $HandOverInf26 = $row["HandOverInf26"];
                        $HandOverInf27 = $row["HandOverInf27"];
                        $HandOverInf28 = $row["HandOverInf28"];
                        $HandOverInf29 = $row["HandOverInf29"];
                        $HandOverInf30 = $row["HandOverInf30"];

                        $sql .= "--Xoa du lieu truoc khi insert".PHP_EOL;
                        $sql .= "DELETE 	D09T2022".PHP_EOL;
                        $sql .= "WHERE	TransID='$TransID'".PHP_EOL;

                        $sql .= "INSERT INTO	D09T2022 (".PHP_EOL;
                        $sql .= "TransID, EmployeeID,HandOverInf01, HandOverInf02, HandOverInf03,HandOverInf04,HandOverInf05,".PHP_EOL;
                        $sql .= "HandOverInf06, HandOverInf07, HandOverInf08,HandOverInf09,HandOverInf10,".PHP_EOL;
                        $sql .= "HandOverInf11, HandOverInf12, HandOverInf13,HandOverInf14,HandOverInf15,".PHP_EOL;
                        $sql .= "HandOverInf16, HandOverInf17, HandOverInf18,HandOverInf19,HandOverInf20,".PHP_EOL;
                        $sql .= "HandOverInf21, HandOverInf22, HandOverInf23,HandOverInf24,HandOverInf25,".PHP_EOL;
                        $sql .= "HandOverInf26, HandOverInf27, HandOverInf28,HandOverInf29,HandOverInf30".PHP_EOL;
                        $sql .= ")VALUES(".PHP_EOL;
                        $sql .= "'$TransID', '$EmployeeID',$HandOverInf01, $HandOverInf02, $HandOverInf03,$HandOverInf04,$HandOverInf05,".PHP_EOL;
                        $sql .= "$HandOverInf06, $HandOverInf07, $HandOverInf08,$HandOverInf09,$HandOverInf10,".PHP_EOL;
                        $sql .= "$HandOverInf11, $HandOverInf12, $HandOverInf13,$HandOverInf14,$HandOverInf15,".PHP_EOL;
                        $sql .= "$HandOverInf16, $HandOverInf17, $HandOverInf18,$HandOverInf19,$HandOverInf20,".PHP_EOL;
                        $sql .= "$HandOverInf21, $HandOverInf22, $HandOverInf23,$HandOverInf24,$HandOverInf25,".PHP_EOL;
                        $sql .= "$HandOverInf26, $HandOverInf27, $HandOverInf28,$HandOverInf29,$HandOverInf30".PHP_EOL;
                        $sql .= " )".PHP_EOL;

                    }

                    \Debugbar::info($sql);
                    if ($sql != "") {
                        try {
                            $this->connectionHR->statement($sql);
                            return json_encode(['status' => 'SUCC']);
                        } catch (Exception $ex) {
                            return json_encode(['status' => 'ERROR', "message" => Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                        }
                    }
                }else{
                    return json_encode(['status' => 'ERROR', "message" => Helpers::getRS($g, "Ban_khong_co_quyen_thuc_hien_chuc_nang_nay")]);
                }

                break;
            case "getmail":
                $rs = [];
                return View::make('layout.sendmail',compact('rs'))->render();
                break;
        }


    }

    public function viewFromMail($pForm,$g,$isApproval=0,$id='',$iddt='') {
        \Debugbar::info(Session::get("W91P0000"));
        $titleW09F2022 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $session = Session::getId();
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonthHR = Session::get("W91P0000")['HRTranMonth'];
        $tranYearHR = Session::get("W91P0000")['HRTranYear'];
        $perD09F2022 =  Session::get($pForm);// $this->getPermission("D09F2022");
        $employeeID = Auth::user()->user()->HREmployeeID;
        $blocks = $this->LoadBlockByG4($divisionHR, $userID, $pForm, 1);
        return View::make("W0X.W09.W09F2022", compact("perD09F2022", "blocks",'pForm','task', 'g', 'titleW09F2022' ));
    }

}
