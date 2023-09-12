<?php
namespace W1X\W17;

use Auth;
use Exception;
use Input;
use Request;
use Session;
use View;
use W1X\W1XController;
use Debugbar;

class W17F2040Controller extends W1XController
{
    public function index($pForm, $g)
    {
        $us = Auth::user()->user()->UserID;
        if (Request::isMethod("get")) {
            $sql = "--Do nguon trang thai" . PHP_EOL;
            $sql .= "EXEC W17P1111 '$us','" . Session::get("W91P0000")['DivisionID'] . "', '" . Session::getId() . "', '" . Session::get('Lang') . "', '0007',1";
            $status = $this->connection->select($sql);
            $arrColHide = $this->LoadDataF12("17", "W17F2040");
            $per = $this->getPermission($pForm);
            $sql = "--Combo Tim kiem" . PHP_EOL;
            $sql .= "EXEC W91P1015  'D17','" . Session::get("W91P0000")['DivisionID'] . "', '" . Auth::user()->User()->UserID . "', 'W17F2040'";
            $search = $this->connection->select($sql);
            return View::make("W1X.W17.W17F2040", compact('pForm', 'g', 'status', 'arrColHide', 'per', 'search'));
        } elseif (Request::isMethod("post")) {
            if (Input::get('action', '') == "saveF12") {
                $arrColHide = Input::get('arrHide', []);
                return $this->SaveF12($arrColHide, "17", "W17F2040");
            }
            $lead = Input::get('slLeadStatusID', '');
            $slsearch = Input::get('slSearchFieldID', '');
            $txtsearch = Input::get('txtSearchFieldID', '');
            $sql = "--Do nguon luoi" . PHP_EOL;
            $sql .= "EXEC W17P2040 '$us', '" . Session::getId() . "','" . Session::get('Lang') . "', '',0, '$lead', '$slsearch', N'$txtsearch'";
            $rsData = $this->connection->select($sql);
            return json_encode($rsData);
        } else {
            try {
                $id = Input::get('id', '');
                $rsCheck = $this->checkW17P5555("1", "W17F2041", $id, '1000');
                if ($rsCheck["Status"] == 0) {
                    $sql = "--Xoa du lieu" . PHP_EOL;
                    $sql .= "Delete From D17T2040";
                    $sql .= " Where ";
                    $sql .= "LeadID =  '$id'";
                    $this->connection->statement($sql);
                    return json_encode(["code" => 1, "mess" => '']);
                } else
                    return json_encode(["code" => 0, "mess" => $rsCheck["Message"]]);
            } catch (Exception $ex) {
                return json_encode(["code" => 0, "mess" => $ex->getMessage()]);
            }

        }
    }

}
