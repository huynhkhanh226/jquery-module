<?php
namespace W9X\W94;

use Auth;
use D94T1000;
use Exception;
use Input;
use Request;
use Session;
use View;
use W9X\W9XController;
use Debugbar;

class W94F1000Controller extends W9XController
{
    public function index($pForm, $g)
    {
        if (Request::isMethod("get")) {
            return View::make("W9X.W94.W94F1000", compact('pForm', 'g'));
        } else {
            $us = Auth::user()->user()->UserID;

            $sql = "--Do nguon luoi".PHP_EOL;
            $sql.=" EXEC W94P1200 '".Session::get("W91P0000")['DivisionID']."', '$us', 'WEB', '".Session::get('Lang')."', 0, 1";
            $rsData = $this->connection->select($sql);
            return View::make("W9X.W94.W94F1000_Ajax", compact('pForm', 'g','rsData'));
        }
    }

    public function Action($pForm, $action = "", $id = null)
    {
        $g = 0;
        if (isset($id)) {
            $row = D94T1000::where("ReportGroupID", $id)->first();
            $cls = 'disabled';
        } else {
            $row = [];
            $cls = '';
        }
        $rsDAGroup = $this->LoadDAGroupID();
        return View::make("W9X.W94.W94F1000_Action", compact('row', "action", 'cls', 'pForm', 'g','rsDAGroup'));
    }

    // return 0 la co loi khi cap nhat du lieu,
    // return 1 la cap nhat thanh cong
    // return -1 la loi da co
    public function postAction($pForm, $action = '', $id = null)
    {
        $all = Input::all();
        if ($action == 'delete') {
            try {
                if(count($this->connection->select("Select top 1 1 from D94T1200 where ReportGroupID='$id'")) > 0)
                    return 2;
                D94T1000::where("ReportGroupID", $id)->delete();
                return 1;
            } catch (Exception $e) {
                return 0;
            }

        } else {
            $txtReportGroupName = $all['txtReportGroupName'];
            $txtDisplayIcon = $all['txtDisplayIcon'];
            $txtDisplayOrder = intval($all['txtDisplayOrder']);
            $chDisable = $all['chDisable'] == 'false' ? 0 : 1;
            $now = date("Y-m-d h:i:s");
            if ($action == 'edit') {

                $row =  D94T1000::where("ReportGroupID", $id)->first();
                $row['ReportGroupName'] = $all['txtReportGroupName'];//$txtReportGroupName;
                $row['DisplayIcon'] = $txtDisplayIcon;
                $row['DisplayOrder'] = $txtDisplayOrder;
                $row['DAGroupID'] = isset($all['slDAGroupID'])?$all['slDAGroupID']:"";
                $row['Disabled'] = $chDisable;
                $row['LastModifyUserID'] = Auth::user()->user()->UserID;
                $row['LastModifyDate'] = $now;
                try {
                    $row->save();
                    $row["DAGroupName"]=$all["sDAGroupName"];//$this->connection->selectOne("Select DAGroupNamen from lemonsys.dbo.D00T0080 where DAGroupID='".$row['DAGroupID']."'");

//                    $us = Auth::user()->user()->UserID;
//                    $sql = "--Do nguon luoi".PHP_EOL;
//                    $sql.=" EXEC W94P1200 '".Session::get("W91P0000")['DivisionID']."', '$us', 'WEB', '".Session::get('Lang')."', 0, 1, '$id'";
//                    $rsData = $this->connection->selectOne($row);

                    return json_encode($row);
                } catch (Exception $ex) {
                    return 0;
                }
            }

            if ($action == 'add') {
                $txtReportGroupID = $all['txtReportGroupID'];
                //Debugbar::info($txtReportGroupID);

                $count = D94T1000::where("ReportGroupID", $txtReportGroupID)->count();
                if ($count > 0)
                    return -1;
                else {
                    try {
                        $row = new D94T1000;
                        $row['ReportGroupID'] = strtoupper($txtReportGroupID);
                        $row['ReportGroupName'] = $txtReportGroupName;
                        $row['DisplayOrder'] = $txtDisplayOrder;
                        $row['DisplayIcon'] = $txtDisplayIcon;
                        $row['Disabled'] = $chDisable;
                        $row['DAGroupID'] = isset($all['slDAGroupID'])?$all['slDAGroupID']:"";
                        $row['LastModifyUserID'] = Auth::user()->user()->UserID;
                        $row['LastModifyUserID'] = '';
                        $row['CreateDate'] = $now;
                        $row['LastModifyDate'] = $now;
                        $row->save();
//                        Debugbar::info($row);
                        $row['ReportGroupID'] = strtoupper($txtReportGroupID);
                        $row["DAGroupName"]=$all["sDAGroupName"];

                        $rt = $row->toArray();

                        return json_encode($rt);
                    } catch (Exception $ex) {
                        Debugbar::info($ex);
                        return 0;
                    }

                }

            }
        }

    }


}
