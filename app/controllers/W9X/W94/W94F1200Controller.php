<?php

namespace W9X\W94;

use Auth;
use D94T1000;
use D94T1200;
use Exception;
use Input;
use Session;
use View;
use W9X\W9XController;
use Debugbar;

class W94F1200Controller extends W9XController
{
    public function index($pForm, $g)
    {
        return View::make("W9X.W94.W94F1200", compact('pForm', 'g'));
    }

    public function indexAjax($pForm, $g)
    {
        // $rsData = D94T1200::leftJoin("D94T1000", "D94T1200.ReportGroupID", "=", "D94T1000.ReportGroupID")->select("D94T1200.MReportID","D94T1200.MReportNameU","D94T1200.DisplayOrder","D94T1200.ReportFileName","D94T1200.RemarkU","D94T1200.Disabled","D94T1200.PlatformID", "D94T1000.ReportGroupName")->orderBy('D94T1200.DisplayOrder')->get();
        $sql = "EXEC W94P1200 '" . Session::get("W91P0000")['DivisionID'] . "', '" . Auth::user()->user()->UserID . "', 'WEB', '" . Session::get('Lang') . "'";
        $rsData = $this->connection->select($sql);

        return View::make("W9x.W94.W94F1200_Ajax", compact('pForm', 'g', "rsData"));
    }

    public function Action($pForm, $action = "", $id = null)
    {
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $hr_employee_id = Auth::user()->user()->HREmployeeID;
        $language = Session::get('Lang');
        $userid = Auth::user()->user()->UserID;
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];
        $hostID = Session::getId();
        $reportID = "";
        $g = 0;
        if (isset($id)) {
            $row = D94T1200::where("MReportID", $id)->first();
            $cls = 'disabled';
            $reportID = $row->ReportID;
        } else {
            $row = [];
            $cls = '';
        }
        $sql = "--Load combo Nhom bao cao" . PHP_EOL;
        $sql .= "Select * from D94T1000 WITH(NOLOCK) Where Disabled=0 AND (DAGroupID IN (SELECT DAGroupID FROM lemonsys.dbo.D00V0080 " . PHP_EOL;
        $sql .= "WHERE  UserID = '" . Auth::user()->user()->UserID . "') OR 'LEMONADMIN' = '" . Auth::user()->user()->UserID . "' OR ISNULL(DAGroupID, '') = '')";
        $regroup = $this->connection->select($sql);
        $listPlatform = $this->LoadFixData('ReportPlatform', $g);


        $sql = "-- Do nguon loai bao cao" . PHP_EOL;
        $sql .= "SELECT 'BIRT' AS ReportType" . PHP_EOL;
        $sql .= "UNION" . PHP_EOL;
        $sql .= "SELECT 'EMBED' AS ReportType" . PHP_EOL;
        $sql .= "UNION " . PHP_EOL;
        $sql .= "SELECT 'FORM' AS  ReportType" . PHP_EOL;

        $reportTypeList = $this->connection->select($sql);
        \Debugbar::info($row);

        $sql ="--Do nguon ...".PHP_EOL;
        $sql .= "EXEC W94P1201 " .PHP_EOL;
        $sql .= "'$divisionhr',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
        $sql .= "'$userid',".PHP_EOL; //UserID, varchar[50], NOT NULL
        $sql .= "'$hostID',".PHP_EOL; //HostID, varchar[50], NOT NULL
        $sql .= "'$id',".PHP_EOL; //ReportID, varchar[50], NOT NULL
        $sql .= "0"; //Mode, tinyint, NOT NULL
        \Debugbar::info($sql);
        $rsTemp = $this->connection->select($sql);
        $rsRoleList = [];
        $rsDataList = [];
        array_filter($rsTemp, function($row) use(&$rsRoleList){
            if ($row["IsRole"] == 1){
                array_push($rsRoleList, $row);
            }
            return $row["IsRole"] == 1;
        });
        array_filter($rsTemp, function($row) use(&$rsDataList){
            if ($row["IsRole"] == 0){
                array_push($rsDataList, $row);
            }
            return $row["IsRole"] == 0;
        });
        $rsRoleList = json_encode($rsRoleList);
        \Debugbar::info($rsRoleList);
        $rsDataList = json_encode($rsDataList);
        \Debugbar::info($rsDataList);
        return View::make("W9X.W94.W94F1200_Action", compact('rsDataList','rsRoleList','reportTypeList', 'row', "action", 'cls', 'pForm', 'g', 'regroup', 'listPlatform'));
    }

    // return 0 la co loi khi cap nhat du lieu,
    // return 1 la cap nhat thanh cong
    // return -1 la loi da co
    public function postAction($pForm, $action = 'edit', $id = null)
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '180');
        ini_set('max_input_time', '180');
        ini_set('post_max_size', '512M');
        $all = Input::all();
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $hr_employee_id = Auth::user()->user()->HREmployeeID;
        $language = Session::get('Lang');
        $userid = Auth::user()->user()->UserID;
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];

        if ($action == 'delete') {
            try {
                D94T1200::where("MReportID", $id)->delete();
                $sql ="--Delete...".PHP_EOL;
                $sql .="Delete From D94T1201".PHP_EOL;
                $sql .=" Where ReportID='$id'".PHP_EOL;
                $this->connection->statement($sql);
                return 1;
            } catch (Exception $e) {
                return 0;
            }

        } else {
            $txtMReportNameU = $all['txtMReportNameU'];
            $txtDisplayOrder = intval($all['txtDisplayOrder']);
            $txtReportFileName = $all['txtReportFileName'];
            $txtRemarkU = $all['txtRemarkU'];
            $chDisable = $all['chDisable'] == 'false' ? 0 : 1;
            $now = date("Y-m-d h:i:s");
            $cbbReportGroupID = $all['cbbReportGroupID'];//6416
            $cboReportType = $all['cboReportType'];
            $cbbPlatformID = $all['cbbPlatformID'];//6416
            $imageURL = $all['hdImageUrl'];
            $imageThumbNailURL = $all['hdImageThumbNailUrl'];
            //Debugbar::info($imageThumbNailURL);
            if ($action == 'edit') {
                $row = D94T1200::where("MReportID", $id)->first();
                $row['MReportNameU'] = $txtMReportNameU;
                $row['DisplayOrder'] = $txtDisplayOrder;
                if ($cboReportType == "BIRT" || $cboReportType == "FORM") {
                    $row['ReportFileName'] = $txtReportFileName;
                    $row['EmbedCode'] = '';
                }
                if ($cboReportType == "EMBED") {
                    $row['EmbedCode'] = $txtReportFileName;
                    $row['ReportFileName'] = '';
                }
                $row['RemarkU'] = $txtRemarkU;
                $row['Disabled'] = $chDisable;
                $row['LastModifyUserID'] = Auth::user()->user()->UserID;
                $row['LastModifyDate'] = $now;
                $row['ReportGroupID'] = $cbbReportGroupID;//6416
                $row['ReportType'] = $cboReportType;
                $row['PlatformID'] = $cbbPlatformID;//6416
                if ($imageURL != "") {
                    $row['ThumbNail'] = $imageThumbNailURL;
                    $row['Image'] = $imageURL;
                }

                //Debugbar::info($row);
                try {
                    $row->save();
                    $row['Remark'] = $txtRemarkU;
                    $row['MReportName'] = $txtMReportNameU;

                    $roleList = Input::get('roleList', []);
                    if ($roleList != ''){
                        $roleList = json_decode($roleList);
                    }
                    $dataList = Input::get('dataList', []);
                    if ($dataList != ''){
                        $dataList = json_decode($dataList);
                    }

                    Debugbar::info($roleList);
                    Debugbar::info($dataList);
                    //insert role & data access
                    $sql ="--Delete...".PHP_EOL;
                    $sql .="Delete From D94T1201".PHP_EOL;
                    $sql .=" Where ReportID='$id'".PHP_EOL;
                    $sql .="--insert du lieu cho role".PHP_EOL;
                    foreach ($roleList as $rowRole){
                        $CodeID = $rowRole->CodeID;
                        $IsRole = $rowRole->IsRole;

                        $sql .="Insert Into D94T1201(".PHP_EOL;
                        $sql .="ReportID, CodeID, IsRole, LastModifyUserID, LastModifyDate".PHP_EOL;
                        $sql .=") Values(".PHP_EOL;
                        $sql .="'$id', '$CodeID', $IsRole, '$userid', getdate()".PHP_EOL;
                        $sql .=")";
                    }
                    $sql .="--insert du lieu cho data access".PHP_EOL;
                    foreach ($dataList as $rowData){
                        $CodeID = $rowData->CodeID;
                        $IsRole = $rowData->IsRole;

                        $sql .="Insert Into D94T1201(".PHP_EOL;
                        $sql .="ReportID, CodeID, IsRole, LastModifyUserID, LastModifyDate".PHP_EOL;
                        $sql .=") Values(".PHP_EOL;
                        $sql .="'$id', '$CodeID', $IsRole, '$userid', getdate()".PHP_EOL;
                        $sql .=")";
                    }
                    Debugbar::info($sql);
                    $this->connection->statement($sql);
                    return json_encode($row);
                } catch (Exception $ex) {
                    return 0;
                }

            }

            if ($action == 'add') {
                $txtMReportID = strtoupper($all['txtMReportID']);
                //Debugbar::info($txtMReportID);

                $count = D94T1200::where("MReportID", $txtMReportID)->count();
                if ($count > 0)
                    return -1;
                else {
                    try {
                        $row = new D94T1200;
                        $row['MReportID'] = strtoupper($txtMReportID);
                        $row['MReportNameU'] = $txtMReportNameU;
                        $row['DisplayOrder'] = $txtDisplayOrder;

                        $row['RemarkU'] = $txtRemarkU;
                        $row['Disabled'] = $chDisable;
                        $row['LastModifyUserID'] = Auth::user()->user()->UserID;
                        $row['LastModifyUserID'] = '';
                        $row['CreateDate'] = $now;
                        $row['LastModifyDate'] = $now;
                        $row['ReportGroupID'] = $cbbReportGroupID;//6416
                        $row['ReportType'] = $cboReportType;
                        if ($cboReportType == "BIRT" || $cboReportType == "FORM") {
                            $row['ReportFileName'] = $txtReportFileName;
                            $row['EmbedCode'] = '';
                        }
                        if ($cboReportType == "EMBED") {
                            $row['EmbedCode'] = $txtReportFileName;
                            $row['ReportFileName'] = '';
                        }
                        $row['PlatformID'] = $cbbPlatformID;//6416
                        $row['ThumbNail'] = $imageThumbNailURL;
                        $row['Image'] = $imageURL;

                        $row->save();
                        $roleList = Input::get('roleList', []);
                        if ($roleList != ''){
                            $roleList = json_decode($roleList);
                        }
                        $dataList = Input::get('dataList', []);
                        if ($dataList != ''){
                            $dataList = json_decode($dataList);
                        }

                        Debugbar::info($roleList);
                        Debugbar::info($dataList);
                        //insert role & data access
                        $sql ="--Delete...".PHP_EOL;
                        $sql .="Delete From D94T1201".PHP_EOL;
                        $sql .=" Where ReportID='$txtMReportID'".PHP_EOL;
                        $sql .="--insert du lieu cho role".PHP_EOL;
                        foreach ($roleList as $rowRole){
                            $CodeID = $rowRole->CodeID;
                            $IsRole = $rowRole->IsRole;

                            $sql .="Insert Into D94T1201(".PHP_EOL;
                            $sql .="ReportID, CodeID, IsRole, LastModifyUserID, LastModifyDate".PHP_EOL;
                            $sql .=") Values(".PHP_EOL;
                            $sql .="'$txtMReportID', '$CodeID', $IsRole, '$userid', getdate()".PHP_EOL;
                            $sql .=")";
                        }
                        $sql .="--insert du lieu cho data access".PHP_EOL;
                        foreach ($dataList as $rowData){
                            $CodeID = $rowData->CodeID;
                            $IsRole = $rowData->IsRole;

                            $sql .="Insert Into D94T1201(".PHP_EOL;
                            $sql .="ReportID, CodeID, IsRole, LastModifyUserID, LastModifyDate".PHP_EOL;
                            $sql .=") Values(".PHP_EOL;
                            $sql .="'$txtMReportID', '$CodeID', $IsRole, '$userid', getdate()".PHP_EOL;
                            $sql .=")";
                        }
                        Debugbar::info($sql);
                        $this->connection->statement($sql);

                        $row['ReportGroupName'] = "";
                        $row['PlatformName'] = "";
                        $row['MReportName'] = $txtMReportNameU;
                        $row['Remark'] = $txtRemarkU;
                        $row['MReportID'] = strtoupper($txtMReportID);

                        return json_encode($row);
                    } catch (Exception $ex) {
                        Debugbar::info($ex);
                        return 0;
                    }

                }

            }
        }

    }


}
