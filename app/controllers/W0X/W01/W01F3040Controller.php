<?php

namespace W0X\W01;

use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W0X\W0XController;

class W01F3040Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {

        \Debugbar::info($task);
        $userid = Auth::user()->user()->UserID;
        $modalTitle = $this->getModalTitle($pForm);
        switch ($task) {
            case "":
                $sql = "--Do nguon Don vi" . PHP_EOL;
                $sql .= "EXEC W01P3042 '$userid', 'DivisionID'";
                \Debugbar::info($sql);
                $div = $this->connection->select($sql);
                $sql = "--Do nguon Phan_khu" . PHP_EOL;
                $sql .= "EXEC W01P3042 '$userid', 'SubDivisionID'";
                \Debugbar::info($sql);
                $subdiv = $this->connection->select($sql);
                $sql = "--Combo so nam hien thi" . PHP_EOL;
                $sql .= "EXEC W01P3042 '$userid', 'YearShow'";
                \Debugbar::info($sql);
                $year = $this->connection->select($sql);
                return View::make("W0X.W01.W01F3040", compact('pForm', 'g', 'modalTitle', 'div', 'subdiv', 'year'));
                break;
            case "loadCombo":
                $userid = Auth::user()->user()->UserID;
                $div = Input::get("div", []);
                \Debugbar::info($div);
                $subdiv = Input::get("subdiv", '');
                if ($subdiv == "null" ){
                    $subdiv = '';
                }
                \Debugbar::info(Input::all());
                if ($div == "" || $div == [])
                    return "";
                $div = join(';', $div);
                if ($subdiv != '') {
                    $subdiv = join(';', $subdiv);
                }

                $sql = "--Do nguon Du an" . PHP_EOL;
                $sql .= "EXEC W01P3043 '$userid', '$div', '$subdiv'";
                \Debugbar::info($sql);
                $property = $this->connection->select($sql);
                $html = "";
                foreach ($property as $row) {
                    $html .= "<option title='" . $row["Value"] . "' value='" . $row["Value"] . "'>" . $row["Caption"] . "</option>";
                };
                return $html;
                break;
            case "filter":
                $division = str_replace(",", ";", Input::get("div", ""));
                $property = str_replace(",", ";", Input::get("property", ""));
                $subdiv = str_replace(",", ";", Input::get("subdiv", ""));
                if ($subdiv == "null" ){

                    $subdiv = '';
                    \Debugbar::info("sdfdsf" . $subdiv);
                }

                $yearshow = Input::get("cboYearShowW01F3040", "");
                $showdetail = Input::get("isShowDetail", 0);
                $chkIsReceive = Input::get("isReceive", 1);
                $chkIsPayment = Input::get("isPayment", 1);
                $redate = \Helpers::convertDate(Input::get("txtReportDateW01F3040", ""));
                $sessionid = Session::getId();
                $sql = "--Do nguon cot dong" . PHP_EOL;
                $sql .= "EXEC W01P3040 '$division','$subdiv','$property','$yearshow', $showdetail, $chkIsReceive,$chkIsPayment ";
                $rsCol = $this->connection->select($sql);
                $sql = "--Do nguon truy van" . PHP_EOL;
                $sql .= "EXEC W01P3041 '$division','$userid','$subdiv','$property', $redate,'$yearshow',$showdetail, $chkIsReceive,$chkIsPayment";
                $rsData = [];
                $rsData = $this->connection->select($sql);
                $header = "";
                $level = 0;
                $arrayField = [];
                $header .= "<tr>";
                $header .= "<th rowspan=\"" . (($rsCol[count($rsCol) - 1]["Level"]) + 1) . "\" style=\"min-width: 200px;width: 200px;max-width:200px\" class='flashreport'></th>";
                foreach ($rsCol as $row) {
                    if ($level != $row['Level'])
                        $header .= "</tr><tr>";
                    $header .= "<th colspan=\"" . $row["CountCol"] . "\" style='background-color:" . $row["Color"] . ";color:" . $row["ColorText"] . ";" . ($row["Length"] > 0 ? "min-width:" . $row["Length"] . "px" : "") . "'>" . $row["Caption"] . "</th>";
                    $level = $row['Level'];
                    if ($row['IsDetail'] == 1)
                        $arrayField[] = ["FieldName" => $row['FieldName'], "NumberFormat" => $row['NumberFormat'], "Length" => $row["Length"], 'IsHyperlink'=>$row["IsHyperlink"], 'DivisionID'=> $row["DivisionID"], 'ProjectID'=> $row["ProjectID"]];
                }
                $header .= "</tr>";
                return View::make("W0X.W01.W01F3040_Ajax", compact('pForm', 'g', 'rsCol', 'rsData', 'header', 'arrayField', 'showdetail', 'division', 'property', 'subdiv', 'rsLogo', 'protype', 'redate'));

            case "showDetail":
                $userid = Auth::user()->user()->UserID;
                $div = Input::get("div", "");
                $field = Input::get("field", "");
                $id = Input::get("id", "");
                $property = Input::get("property", "");
                $redate = Input::get("redate", "null");
                $subdiv = Input::get("subdiv", "");
                if ($subdiv == "null" ){
                    $subdiv = '';
                }
                $protype = Input::get("protype", "");
                $showdetail = intval(Input::get("showdetail", 0));


                $sql = "--Load chi tiet" . PHP_EOL;
                $sql .= "EXEC W27P3402 '$div','$userid','$showdetail','$field','$id', '$property', '$subdiv', '$protype', $redate";
                \Debugbar::info($sql);
                $data = $this->connection->selectOne($sql);
                $strtable = $data["StrHTML"];
                //  $cmodal = ($data["style"]);
                $summary = ($data["Summary"]);
                return View::make("W0X.W01.W01F3040_Detail", compact('strtable', 'summary'));
                break;
            case "showRow":
                $userid = Auth::user()->user()->UserID;
                $sessionid = Session::getId();
                $dateid = Input::get("dateid", "");
                $arrayField = json_decode(base64_decode(Input::get("arrayField")));
                \Debugbar::info($arrayField);
                $showdetail = Input::get("showdetail", 0);
                $sql = "--Do nguon chi tiet" . PHP_EOL;
                //$sql .= "EXEC W27P3401 '','$userid','','','', null,'','', '$sessionid', 0, '$dateid'";
                //$sql = "--Do nguon truy van" . PHP_EOL;

                //----------------
                $division = str_replace(",", ";", Input::get("div", ""));
                $property = str_replace(",", ";", Input::get("property", ""));
                $subdiv = str_replace(",", ";", Input::get("subdiv", ""));
                if ($subdiv == "null" ){
                    $subdiv = '';
                }
                $yearshow = Input::get("cboYearShowW01F3040", "");
                //$showdetail = Input::get("isShowDetail", 0);
                $chkIsReceive = Input::get("isReceive", 1);
                $chkIsPayment = Input::get("isPayment", 1);
                $redate = \Helpers::convertDate(Input::get("txtReportDateW01F3040", ""));
                //----------------


                $sql .= "EXEC W01P3041 '$division','$userid','$subdiv','$property', $redate,'$yearshow',$showdetail, $chkIsReceive,$chkIsPayment, '$sessionid', 1, '$dateid'";
                \Debugbar::info($sql);
                $rsData = $this->connection->select($sql);
                \Debugbar::info($rsData);
                $row1 = "";
                $row2 = "";
                foreach ($rsData as $row) {
                    $classpa = $row["ClassParent"];
                    $parent = $row["Parent"];
                    $dateid = $row["DateID"];
                    $color = $row["Color"];
                    $textcolor = $row["ColorText"];
                    $row1 .= "<tr class='ui-widget-content detail-row $classpa' data-parent='$parent' data-id='$dateid'>";
                    $row1 .= "<td class='fixcol " . ($row["IsChild"] == 0 ? "detail-date" : "") . "' data-mode='0' data-parent='$parent' data-id='$dateid' style='min-width: 200px;background-color:$color;color:$textcolor;" . ($row["IsChild"] == 0 ? "cursor:pointer" : "") . "'>";

                    $row2 .= "<tr class='ui-widget-content detail-row $classpa' data-parent='$parent' data-id='$dateid'>";
                    $row2 .= "<td class='fixcol " . ($row["IsChild"] == 0 ? "detail-date" : "") . "' data-mode='0' data-parent='$parent' data-id='$dateid' style='min-width: 200px;background-color:$color;color:$textcolor;" . ($row["IsChild"] == 0 ? "cursor:pointer" : "") . "'>";
                    if ($row["IsChild"] == 0) {
                        $row1 .= str_replace("-", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", str_pad("", $row["Level"], "-"));
                        $row1 .= "<span style='cursor: default' class='fa fa-plus-square-o'></span>&nbsp;";
                        $row2 .= str_replace("-", "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", str_pad("", $row["Level"], "-"));
                        $row2 .= "<span style='cursor: default' class='fa fa-plus-square-o'></span>&nbsp;";
                    } elseif ($row["IsChild"] == 1 && $row["Level"] == 0) {
                        $row1 .= "&nbsp;";
                        $row2 .= "&nbsp;";
                    } else {
                        $row1 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        $row2 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                    $row1 .= $row["Date"];
                    $row2 .= $row["Date"];
                    $row1 .= "</td></tr>";
                    $row2 .= "</td>";
                    foreach ($arrayField as $field) {
                        \Debugbar::info($row[$field->FieldName]);
                        if ($field->IsHyperlink == 1){
                            $row2 .= "<td class='text-right " . (($showdetail == 1 && !($row["IsChild"] == 1 && $row["Level"] == 0)) || ($showdetail == 0 && $row["Parent"] != "" && !($row["IsChild"] == 1 && $row["Level"] == 0)) ? "cell-detail" : "") . "' data-dateid='$dateid' data-field='" . htmlspecialchars($field->FieldName) . "'";
                            $row2 .= "style='min-width:" . $field->Length . "px; ".$row['Style']."'><a style='text-decoration: underline;' onclick='showFormDetailW01F3041(\"".base64_encode(json_encode($row))."\", \"".$field->DivisionID."\", \"".$field->ProjectID."\")'>" . (number_format($row[$field->FieldName], 0) == 0 ? "": number_format($row[$field->FieldName], $field->NumberFormat)) . "</a></td>";
                        }else{
                            $row2 .= "<td class='text-right " . (($showdetail == 1 && !($row["IsChild"] == 1 && $row["Level"] == 0)) || ($showdetail == 0 && $row["Parent"] != "" && !($row["IsChild"] == 1 && $row["Level"] == 0)) ? "cell-detail" : "") . "' data-dateid='$dateid' data-field='" . htmlspecialchars($field->FieldName) . "'";
                            $row2 .= "style='min-width:" . $field->Length . "px; ".$row['Style']."'>" . (number_format($row[$field->FieldName], 0) == 0 ? "": number_format($row[$field->FieldName], $field->NumberFormat)) . "</td>";
                        }

                    }
                    $row2 .= "</tr>";
                }
                return json_encode(["row1" => $row1, "row2" => $row2]);
                break;
            case 'collect':
                $sql = "--Tap hop du lieu" . PHP_EOL;
                $sql .= "Exec W01P3046 '$userid'";
                try {
                    $this->connection->statement($sql);
                    return 1;
                } catch (\Exception $ex) {
                    \Debugbar::info($ex->getMessage());
                    return 0;
                }
                break;
            case 'getdate':
                $lang = Session::get('Lang');
                $sql = "--Get Date" . PHP_EOL;
                $sql .= "Exec W01P3045 '$userid', '$lang'";
                try {
                    $rs = $this->connection->selectOne($sql);
                    return $rs["Message"];
                } catch (\Exception $ex) {
                    \Debugbar::info($ex->getMessage());
                    return '';
                }
        }
    }

}
