<?php

namespace W4X\W47;

use Auth;
use Config;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W4X\W4XController;

class W47F3000Controller extends W4XController
{

    public function index($pForm, $g, $task = '')
    {
        $userid = Auth::user()->user()->UserID;
        $lang = Session::get('Lang');
        $rowTemp = $this->connection->selectOne("SELECT Value FROM D47V3001 WHERE Type = 'IsPlanOfMaster'");
        $isShowMasterPlan = 0;
        if (count($rowTemp) > 0) {
            $isShowMasterPlan = $rowTemp['Value'];
        }
        if (Request::isMethod('post')) {//Nhấn button Lọc hoặc thêm tab

            if ($task == 'isCollect') {
                $sql = "--Tap hop du lieu" . PHP_EOL;
                $sql .= "Exec D47P3000 0, '$userid'";
                try {
                    $this->connection->statement($sql);
                } catch (\Exception $ex) {
                    \Debugbar::info($ex->getMessage());
                }

                return 1;
            } else if ($task == 'getDate') {
                $sql = "--Get Date" . PHP_EOL;
                $sql .= "Exec W47P3007 '$userid', '$lang'";
                try {
                    $rs = $this->connection->selectOne($sql);
                    return $rs["Message"];
                } catch (\Exception $ex) {
                    \Debugbar::info($ex->getMessage());
                    return '';
                }
            } else {
                try {
                    $division = str_replace(",", ";", Input::get("div", ""));
                    $subdiv = str_replace(",", ";", Input::get("subdiv", ""));
                    $unit = Input::get("slMoneyUnitID", "");
                    $datefrom = Input::get("datef", date('Y-m-d'));
                    $dateto = Input::get("datet", date('Y-m-d'));
                    $itemcode = Input::get("itemcode", '');
                    $showdetail = Input::get("chkIsShowDetail", "off") == "on" ? 1 : 0;
                    $arrayField = Input::get("array", '');
                    $textunit = Input::get("textunit", '');
                    $widthcol = Input::get("widthcol", '');
                    $parameter = Input::get("parameter", "");
                    $isPlan = intval(Input::get("isPlan", 0));
                    $isShowPlan = intval(Input::get("isShowPlan", ""));
                    $isShowButton = intval(Input::get("isShowButton", ""));
                    $inputAll = Input::all();
                    $level = intval(Input::get("level", ""));
                    $template = intval(Input::get("template", ""));
                    $isBeginMonth = intval(Input::get("IsBeginMonth", 0));
                    $isPaging = intval(Input::get("isPaging", 0));
                    \Debugbar::info("tet". $isPaging);
                    if ($arrayField != '') {//Dùng lấy lại các giá trị cũ của master khi add tab
                        $arrayField = json_decode($arrayField, true);
                        $inputAll = $arrayField;
                        $datefrom = $arrayField['datef'];
                        $dateto = $arrayField['datet'];
                        $textunit = $arrayField["textunit"];
                        $widthcol = $arrayField["widthcol"];
                        $division = $arrayField["div"];
                        $unit = $arrayField["slMoneyUnitID"];
                        $showdetail = isset($arrayField["chkIsShowDetail"]) ? 1 : 0;
                    }

                    //$newDateFrom = ($isBeginMonth == 1 ? date('Y-m-01'):$datefrom);
                    $newDateFrom = $datefrom;
                    //Get all input for next request
                    $inputAll['div'] = $division;
                    if ($template == 0) {
                        \Debugbar::info($datefrom);
                        $sql = "--Do nguon form" . PHP_EOL;
                        $sql .= "EXEC W47P3000 '$userid','$lang', N'$division', N'$unit', '$datefrom', '$dateto',$showdetail, 0, $level, '$itemcode', '$parameter', $isPlan, '$subdiv'";
                        $rsData = $this->connection->select($sql);
                        return View::make("W4X.W47.W47F3000_Template1", compact('pForm', 'g', 'rsData', 'datefrom', 'newDateFrom', 'dateto', 'inputAll', 'itemcode', 'textunit', 'isPlan', 'parameter', 'level', 'isShowPlan', 'isShowButton', 'widthcol', 'unit', 'isBeginMonth'));
                    } else {
                        $sql = "--Do nguon cot dong" . PHP_EOL;
                        $sql .= "EXEC W47P3002 '$userid','$lang', '$datefrom', '$dateto', '$parameter',0,$isPlan, '$unit'";
                        \Debugbar::info($sql);
                        $rsCol = $this->connection->select($sql);
                        $rsColLevel0 = [];
                        $rsColLevel1 = [];
                        foreach ($rsCol as $row) {
                            if ($row['Level'] == 0) {
                                array_push($rsColLevel0, $row);
                            } else {
                                array_push($rsColLevel1, $row);
                            }
                        }
                        $sql = "--Do nguon form" . PHP_EOL;
                        $sql .= "EXEC W47P3000 '$userid','$lang', N'$division', N'$unit', '$datefrom', '$dateto',$showdetail, 2, $level, '$itemcode', '$parameter', $isPlan";

                        $rsData = $this->connection->select($sql);
                        $sql = Helpers::encryptData($sql);
                        $numberOfFixedColumns = Helpers::arraySearch($rsCol, "IsFixed","1");
                        \Debugbar::info($rsCol);
                        $numberOfFixedColumns = count($numberOfFixedColumns) + 1;
                        //$rsData = array_slice($rsData, 0, 100);
                        if ($isPaging == 0){
                            return View::make("W4X.W47.W47F3000_Template2", compact('pForm', 'g', 'rsData', 'rsCol', 'datefrom', 'dateto', 'inputAll', 'itemcode', 'textunit', 'isPlan', 'parameter', 'level', 'isShowPlan', 'unit', 'rsColLevel0', 'rsColLevel1', 'numberOfFixedColumns','isPaging'));
                        }else{
                            return View::make("W4X.W47.W47F3000_Template3", compact('sql','pForm', 'g', 'rsData', 'rsCol', 'datefrom', 'dateto', 'inputAll', 'itemcode', 'textunit', 'isPlan', 'parameter', 'level', 'isShowPlan', 'unit', 'rsColLevel0', 'rsColLevel1', 'numberOfFixedColumns','isPaging'));
                        }

                    }
                } catch (Exception $ex) {
                    \Debugbar::info($ex->getMessage());
                }

            }


        } else {
            $modalTitle = $this->getModalTitle($pForm);
            $sql = "--Do nguon Don vi" . PHP_EOL;
            $sql .= "EXEC W47P3001 '$userid', 'Division', '$lang'";
            $div = $this->connection->select($sql);

            $sql = "--Do nguon Phan nhom" . PHP_EOL;
            $sql .= "EXEC W47P3001 '$userid', 'SubDivision', '$lang'";
            $subdiv = $this->connection->select($sql);

            $sql = "--Do nguon DVT" . PHP_EOL;
            $sql .= "EXEC W47P3001 '$userid', 'MoneyUnit', '$lang'";
            $unit = $this->connection->select($sql);
            $jsonunit = [];
            foreach ($unit as $row) {
                $jsonunit[$row['Value']] = $row['Caption'];
            }
            $title3001 = $this->getModalTitle('W47F3001');
            return View::make("W4X.W47.W47F3000", compact('pForm', 'g', 'modalTitle', 'div', 'unit', 'lang', 'title3001', 'subdiv', 'jsonunit', 'isShowMasterPlan'));
        }
    }

    //Hiển thị các dòng con
    function showRows()
    {
        $userid = Auth::user()->user()->UserID;
        $itemcode = Input::get("itemcode", "");
        $level = Input::get("level", "");
        $parameter = Input::get("parameter", "");
        $isPlan = intval(Input::get("isPlan", ""));
        $arrayField = json_decode(Input::get("array", ''), true);
        $datefrom = $arrayField['datef'];
        //Nếu là dự án thì lấy ngày đầu của tháng
        $isBeginMonth = intval(Input::get("isBeginMonth", 0));
        //$newDateFrom = ($isBeginMonth == 1 ? date('Y-m-01'):$datefrom);
        $newDateFrom = $datefrom;
        //////////////////////////////////////////////////////////////////
        $dateto = $arrayField['datet'];
        $lang = Session::get('Lang');
        $showdetail = isset($arrayField["chkIsShowDetail"]) ? 1 : 0;
        $sql = "--Do nguon form" . PHP_EOL;
        $sql .= "EXEC W47P3000 '$userid','$lang', '" . $arrayField['div'] . "', N'" . $arrayField['slMoneyUnitID'] . "', '$newDateFrom', '$dateto', $showdetail, 1, $level, N'$itemcode', '$parameter', $isPlan";
        $rsData = $this->connection->select($sql);
        $row1 = "";
        $row2 = "";
        $begin = new DateTime($datefrom);
        $end = new DateTime($dateto);
        $end = $end->modify('+1 day');
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        //Generate rows for table
        foreach ($rsData as $row) {
            $parent = $row["ParentID"];
            $itemcode = $row["ItemCode"];
            $style = $row["Style"];
            $parameter = htmlspecialchars($row["Parameter"]);
            //Get format
            $format = json_decode($row["Format"]);
            $isPlan = $format->IsPlan;
            $isShowDetail = $format->IsShowDetail;
            $isHaveDetail = $format->IsHaveDetail;
            $isHyperlink = $format->IsHyperlink;
            $isColSpan = $format->IsColspan;
            $viewTemplate = $format->ViewTemplate;
            $isBeginMonth = $format->IsBeginMonth;;

            $rowHTML = "<tr class='ui-widget-content detail-row $parent' style='$style' data-parent='$parent' data-itemcode='$itemcode'>";
            $rowHTML .= "<td class='fixcol " . ($isShowDetail == 1 ? 'rowloaded' : '') . "' style='$style' " . ($isColSpan == 1 ? 'colspan="2"' : '') . " data-mode='" . $isShowDetail . "' data-parent='$parent' data-itemcode='$itemcode' data-level=\"" . $row['Level'] . "\" data-parameter='$parameter' data-isPlan='$isPlan'>";
            if ($isHaveDetail == 1) {
                $rowHTML .= "<span class=\"pointer fa " . ($isShowDetail == 1 ? 'fa-chevron-circle-down' : 'fa-chevron-circle-right') . "\" id=\"spShowChild_$itemcode\"></span>&nbsp;";
            }
            if ($isHyperlink == 1) {
                $rowHTML .= '<a style="text-decoration: underline !important;" onclick="addTabW47F3000(\'' . $itemcode . '\', \'' . $row["TabName"] . '\', this, ' . intval($viewTemplate) . ',' . intval($isBeginMonth) . ')">' . $row["ItemDesc84"] . '</a>';
            } else {
                $rowHTML .= $row["ItemDesc84"];
            }
            $rowHTML .= "</td>";
            if ($isColSpan == 0) {
                $rowHTML .= "<td style='$style'>" . $row["ItemDesc01"] . "</td>";
            }
            $row1 .= $rowHTML . "</tr>";
            $row2 .= $rowHTML;
            foreach ($period as $dt) {
                $format = json_decode($row[$dt->format("Ymd") . '_Format'], true);
                $value = $row[$dt->format("Ymd")];
                $val = $format['Decimal'] == -1 ? $value : $value == 0 || $value == '' ? '' : Helpers::formatNegativeNumber($value, $format['Decimal']);
                $row2 .= "<td class='text-right' style='" . $format['Style'] . "'>" . $val . "</td>";
                //$row2 .= "<td class='text-right' style='" . $format['Style'] . "'>" . $row[$dt->format("Ymd")] . "</td>";
            }
            $row2 .= "</tr>";
        }
        number_format(0, 4);

        if (num < 10){
            return "0000".num;
        }

        return json_encode(["row1" => $row1, "row2" => $row2]);
    }

}
