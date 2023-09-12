<?php
namespace W2X\W27;

use Auth;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use Debugbar;
use W2X\W2XController;

class W27F3400Controller extends W2XController
{

    public function index($pForm, $g)
    {
        $userid = Auth::user()->user()->UserID;
        if (Request::isMethod('post')) {
            try{
                $division = str_replace(",", ";", Input::get("div", ""));
                $property = str_replace(",", ";", Input::get("property", ""));
                $protype = str_replace(",", ";", Input::get("protype", ""));
                $subdiv = str_replace(",", ";", Input::get("subdiv", ""));
                $yearshow = Input::get("slYearShow", "");
                $showdetail = Input::get("chkIsShowDetail", "off") == "on" ? 1 : 0;
                $redate = Helpers::convertDate(Input::get("txtReportDate", ""));
                $sessionid= Session::getId();
                $sql = "--Do nguon cot dong" . PHP_EOL;
                $sql .= "EXEC W27P3400 '$division','$subdiv','$property','$protype','$yearshow', $showdetail";
                $rsCol = $this->connection->select($sql);
                $sql = "--Do nguon truy van" . PHP_EOL;
                $sql .= "EXEC W27P3401 '$division','$userid','$subdiv','$property','$protype', $redate,'$yearshow','$showdetail', '$sessionid', 0";
                $rsData = $this->connection->select($sql);
                $header = "";
                $level = 0;
                $arrayField = [];
                $header .= "<tr>";
                $header .= "<th rowspan=\"" . (($rsCol[count($rsCol) - 1]["Level"]) + 1) . "\" style=\"min-width: 160px;width: 160px;max-width: 160px\" class='flashreport'><img src='". asset("packages/default/L3/images/companylogo-large.png")."' class='logo-image' alt='Logo Image' width='40px' valign=middle/></th>";
                foreach ($rsCol as $row) {
                    if ($level != $row['Level'])
                        $header .= "</tr><tr>";
                    $header .= "<th colspan=\"" . $row["CountCol"] . "\" style='background-color:" . $row["Color"] . ";color:" . $row["ColorText"] . ";" . ($row["Length"] > 0 ? "min-width:" . $row["Length"] . "px" : "") . "'>" . $row["Caption"] . "</th>";
                    $level = $row['Level'];
                    if ($row['IsDetail'] == 1)
                        $arrayField[] = ["FieldName" => $row['FieldName'], "NumberFormat" => $row['NumberFormat'], "Length" => $row["Length"]];
                }
                $header .= "</tr>";
                return View::make("W2X.W27.W27F3400_Ajax", compact('pForm', 'g', 'rsCol', 'rsData', 'header', 'arrayField', 'showdetail', 'division', 'property', 'subdiv', 'rsLogo', 'protype', 'redate'));
            } catch (Exception $ex) {
                \Debugbar::info($ex->getMessage());
            }

        } elseif (Request::isMethod('delete')){
            try{
                $this->connection->statement("Drop Table W27P3401_".$userid.'_'.Session::getId());
            } catch (Exception $ex) {
            }
        }else {
            $modalTitle = $this->getModalTitle($pForm);
            $sql = "--Do nguon Don vi" . PHP_EOL;
            $sql .= "EXEC W27P3403 '$userid', 0";
            $div = $this->connection->select($sql);
            $sql = "--Do nguon Phan_khu" . PHP_EOL;
            $sql .= "EXEC W27P3403 '$userid', 1";
            $subdiv = $this->connection->select($sql);
            $sql = "--Combo so nam hien thi" . PHP_EOL;
            $sql .= "EXEC W27P3403 '$userid', 2";
            $year = $this->connection->select($sql);
            $sql = "--Combo Loai hinh san pham" . PHP_EOL;
            $sql .= "EXEC W27P3403 '$userid', 3";
            $proptype = $this->connection->select($sql);
            return View::make("W2X.W27.W27F3400", compact('pForm', 'g', 'modalTitle', 'div', 'subdiv', 'year', 'proptype'));
        }
    }

    function showRow(){
        $userid = Auth::user()->user()->UserID;
        $sessionid= Session::getId();
        $dateid = Input::get("dateid", "");
        $arrayField = (Input::get("arrayField"));
        $showdetail= Input::get("showdetail", 0);
        $sql = "--Do nguon chi tiet" . PHP_EOL;
        $sql .= "EXEC W27P3401 '','$userid','','','', null,'','', '$sessionid', 1, '$dateid'";
        $rsData = $this->connection->select($sql);
        $row1 = "";$row2="";
        foreach($rsData as $row){
            $classpa = $row["ClassParent"];
            $parent = $row["Parent"];
            $dateid= $row["DateID"];
            $color= $row["Color"];
            $textcolor= $row["ColorText"];
            $row1 .= "<tr class='ui-widget-content detail-row $classpa' data-parent='$parent' data-id='$dateid'>";
            $row1 .= "<td class='fixcol ".($row["IsChild"]==0?"detail-date":"")."' data-mode='0' data-parent='$parent' data-id='$dateid' style='min-width: 160px;background-color:$color;color:$textcolor;".($row["IsChild"]==0 ? "cursor:pointer":"")."'>";

            $row2 .= "<tr class='ui-widget-content detail-row $classpa' data-parent='$parent' data-id='$dateid'>";
            $row2 .= "<td class='fixcol ".($row["IsChild"]==0?"detail-date":"")."' data-mode='0' data-parent='$parent' data-id='$dateid' style='min-width: 160px;background-color:$color;color:$textcolor;".($row["IsChild"]==0 ? "cursor:pointer":"")."'>";
            if ($row["IsChild"]==0){
                $row1 .= str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",str_pad("", $row["Level"], "-"));
                $row1 .= "<span style='cursor: default' class='fa fa-plus-square-o'></span>&nbsp;";
                $row2 .= str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",str_pad("", $row["Level"], "-"));
                $row2 .= "<span style='cursor: default' class='fa fa-plus-square-o'></span>&nbsp;";
            }elseif($row["IsChild"]==1 && $row["Level"]==0){
                $row1 .= "&nbsp;";
                $row2 .= "&nbsp;";
            }else{
                $row1 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                $row2 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            $row1 .= $row["Date"];
            $row2 .= $row["Date"];
            $row1 .= "</td></tr>";
            $row2 .= "</td>";
            foreach($arrayField as $field){
                $row2 .= "<td class='text-right ".(($showdetail==1 && !($row["IsChild"]==1 && $row["Level"]==0)) || ($showdetail==0 && $row["Parent"]!="" && !($row["IsChild"]==1 && $row["Level"]==0))?"cell-detail":"")."' data-dateid='$dateid' data-field='".htmlspecialchars ($field["FieldName"])."'";
                $row2 .= "style='min-width:".$field["Length"]."px'>".number_format($row[$field["FieldName"]], $field["NumberFormat"])."</td>";
            }
            $row2 .= "</tr>";
        }
        return json_encode(["row1"=>$row1, "row2"=>$row2]);
    }

    function loadCombo()
    {
        $userid = Auth::user()->user()->UserID;
        $div = Input::get("div", []);
        $subdiv = Input::get("subdiv", []);
        if ($div == "" || $div == [] || $subdiv == '' || $subdiv == [])
            return "";
        $div = join(';', $div);
        $subdiv = join(';', $subdiv);
        $sql = "--Do nguon Du an" . PHP_EOL;
        $sql .= "EXEC W27P3404 '$userid', '$div', '$subdiv'";
        $property = $this->connection->select($sql);
        $html = "";
        foreach ($property as $row) {
            $html .= "<option title='" . $row["Caption"] . "' value='" . $row["Value"] . "'>" . $row["Caption"] . "</option>";
        };
        return $html;
    }

    function showDetail()
    {
        $userid = Auth::user()->user()->UserID;
        $div = Input::get("div", "");
        $field = Input::get("field", "");
        $id = Input::get("id", "");
        $property = Input::get("property", "");
        $redate = Input::get("redate", "null");
        $subdiv = Input::get("subdiv", "");
        $protype = Input::get("protype", "");
        $showdetail = intval(Input::get("showdetail", 0));
        $sql = "--Load chi tiet" . PHP_EOL;
        $sql .= "EXEC W27P3402 '$div','$userid','$showdetail','$field','$id', '$property', '$subdiv', '$protype', $redate";
        $data = $this->connection->selectOne($sql);
        $strtable = $data["StrHTML"];
      //  $cmodal = ($data["style"]);
        $summary = ($data["Summary"]);
        return View::make("W2X.W27.W27F3400_Detail", compact('strtable', 'summary'));
    }

}
