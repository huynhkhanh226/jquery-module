<?php
namespace W2X\W27;

use Auth;
use DB;
use Input;
use Mail;
use Request;
use Session;
use View;
use W2X\W2XController;
use Debugbar;

class W27F3000Controller extends W2XController
{

    public function index($pForm, $g)
    {
        if (Request::isMethod("post")) {
            $tree = array();
            $child = array();
            $proid = '';
            $proname = '';
            $div = Input::get('div');
            foreach ($this->connection->select("EXEC W27P3005 '$div', '" . Auth::user()->user()->UserID . "'") as $row) {
                if ($proid == $row["PropertyID"]) {
                    array_push($child, ["text" => $row["Description"], "tags" => $row["ID"], "proid" => $row["PropertyID"], "level01" => $row["Level01ID"], "level02" => $row["Level02ID"], "protype" => $row["PropertyTypeID"]]);
                } else {
                    if ($proid != '') {
                        //Add các node trước đó
                        $tree[] = ["text" => $proname, "tags" => $proid, "nodes" => $child, "icon" => "digi digi-duanbatdongsan", "selectable" => false, "state" => ["expanded" => false, "selected" => false]];
                    }
                    $child = array();
                    $child[] = ["text" => $row["Description"], "tags" => $row["ID"], "proid" => $row["PropertyID"], "level01" => $row["Level01ID"], "level02" => $row["Level02ID"], "protype" => $row["PropertyTypeID"]];
                }
                $proid = $row["PropertyID"];
                $proname = $row["PropertyName"];
            }
            $tree[] = ["text" => $proname, "tags" => $proid, "nodes" => $child, "icon" => "digi digi-duanbatdongsan", "selectable" => false, "state" => ["expanded" => false, "selected" => false]];
            return json_encode(array_values($tree));
        }
        $modalTitle = $this->getModalTitle($pForm);
        $div = $this->connection->select("Exec W27P3007 '" . Auth::user()->user()->UserID . "'");
        return View::make("W2X.W27.W27F3000", compact('modalTitle', 'g','div','pForm'));
    }

    public function getColorStatus($div)
    {
        if (Request::isMethod("post")) {
            $input = Input::all();
            $string = "";
            foreach ($this->connection->select("EXEC W27P3000 '$div', '" . $input['proid'] . "', '" . $input['tags'] . "', '" . $input['level01'] . "', '" . $input['level02'] . "', '" . Session::get('Lang') . "', 1, '" . Auth::user()->user()->UserID . "', 'D27F3000', '" . $input['protype'] . "'") as $row) {
                if ($string == "")
                    $string .= "<div class='statuscolor' style='margin-left:0;background-color:" . $row["ColorCode"] . "'>" . $row["Description"] . "</div>";
                else
                    $string .= "<div class='statuscolor' style='background-color:" . $row["ColorCode"] . "'>" . $row["Description"] . "</div>";

            }
            return $string;
        }
    }

    public function drawDiagram($div)
    {
        $g = 6;
        if (Request::isMethod("post")) {
            $input = Input::all();
            //Debugbar::info($input);
            $rs = $this->connection->select("EXEC W27P3001 '$div', '" . $input['proid'] . "', '" . $input['tags'] . "', '" . $input['level01'] . "', '" . $input['level02'] . "', '" . Session::get('Lang') . "', '" . $input['protype'] . "'");
            return View::make("W2X.W27.W27F3000_Diagram", compact('input', 'rs', 'g','div'));
        }
    }

    public function ShowDetail($mode)
    {
        $g = 6;$div = Input::get('div');
        $officeno = Input::get("offno");
        if ($mode == 0) //Show info
        {
            return View::make("W2X.W27.W27F3000_Info", compact('officeno', 'g', 'div'));
        } elseif ($mode == 1)//Show Phiếu giữ chỗ
        {
            $rs = $this->connection->select("EXEC W27P3003 '$div', " . Session::get("W91P0000")['TranMonth'] . ", " . Session::get("W91P0000")['TranYear'] . ", '" . Auth::user()->user()->UserID . "', '$officeno'");
            if (isset($rs[0]["OfficeID"])) {
                $row = $rs[0];
                $pro = Input::get("proid");
                return View::make("W2X.W27.W27F3000_Booking", compact('row', 'pro', 'g', 'div'));
            }
        } elseif ($mode == 2)//Kiểm tra trước khi show Phiếu giữ chỗ
        {
            $sql = "EXEC D27P5555 '$div', " . Session::get("W91P0000")['TranMonth'] . ", " . Session::get("W91P0000")['TranYear'] . ", '" . Session::get('Lang') . "', '" . Auth::user()->user()->UserID . "', 'web', 'E', 'D27F3000', '$officeno', '', '', '', '', ''";
            $rs = $this->connection->select($sql);
            if (isset($rs[0]["Status"])) {
                if ($rs[0]["Status"] == "1") {
                    return $rs[0]["Message"];
                }
            }
            return 0;
        } elseif ($mode == 3)//Đổ nguồn combo Phiếu giữ chỗ
        {
            $string = "";
            $pro = Input::get("proid");
            $sales = Input::get("sales");
            $sqlVoucherNo = "EXEC W27P3006 '$div', " . Session::get("W91P0000")['TranMonth'] . ", " . Session::get("W91P0000")['TranYear'] . ", '$pro', '$officeno', '$sales'";
            foreach ($this->connection->select($sqlVoucherNo) as $row) {
                $string .= "<option name='VoucherNo' value ='" . $row['VoucherNo'] . "' >" . $row['VoucherNo'] . "</option>";
            }
            return $string;
        }
    }

    public function SaveData()//Lưu dữ liệu
    {
        $voucherno = Input::get("optVoucherNo");
        $salepersonid = Input::get("optSalesPersonID");
        $officeid = Input::get("off");
        $oamount = Input::get("amo");
        $prioritylevel = Input::get("txtPriorityLevel");
        $div = Input::get('div');
        $sql = "EXEC D27P5555 '$div', " . Session::get("W91P0000")['TranMonth'] . ", " . Session::get("W91P0000")['TranYear'] . ", '" . Session::get('Lang') . "', '" . Auth::user()->user()->UserID . "', 'web', 'A', 'D27F3001', '$voucherno', '$salepersonid', '$officeid', '', '', ''";
        $rs = $this->connection->select($sql);
        if (isset($rs[0]["Status"])) {
            if ($rs[0]["Status"] == "1") {
                return $rs[0]["Message"];
            }
        }
        $sql = "Exec W27P3004 '$div', " . Session::get("W91P0000")['TranMonth'] . ", " . Session::get("W91P0000")['TranYear'] . ",'" . Auth::user()->user()->UserID . "', '$officeid', '$voucherno', '$salepersonid' , $oamount, $prioritylevel ";
        return intval($this->connection->statement($sql));
    }
}
