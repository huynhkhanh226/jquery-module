<?php
namespace W7X\W76;

use Auth;
use Request;
use View;
use W7X\W7XController;
use Debugbar;

class W76F2050Controller extends W7XController
{
    public function index($pForm, $g)
    {
        if (Request::isMethod("get")) {
            return View::make("W7X.W76.W76F2050", compact('pForm', 'g'));
        } else {
            $us = Auth::user()->user()->UserID;
            $sql = "--Do nguon luoi" . PHP_EOL;
            $sql .= "EXEC W76P2050 '$us', 'R'";
            $rsData = $this->connectionHR->select($sql);
            return View::make("W7X.W76.W76F2050_Ajax", compact('pForm', 'g', 'rsData'));
        }
    }

    public function action($id)
    {
        if (Request::isMethod("delete")) {
            $rs = $this->checkW76P5555("D", "W76F2050", "Room", $id);
            if ($rs["Status"] == 0) {
                $sql = "--Xoa phong hop" . PHP_EOL;
                $sql .= "DELETE FROM D76T2020 WHERE FacilityID = $id";
                $this->connectionHR->statement($sql);
                return json_encode(["code" => 0, "mess" => ""]);
            } else {
                return json_encode(["code" => 1, "mess" => $rs["Message"]]);
            }
        }elseif (Request::isMethod("post")){  //Ki?m tra tr??c khi s?a
            $rs = $this->checkW76P5555("E", "W76F2050", "Room", $id);
            if ($rs["Status"] == 0)
                return 1;
            else
                return $rs["Message"];
        }

    }


}
