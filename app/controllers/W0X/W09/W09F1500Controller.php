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

class W09F1500Controller extends W0XController
{

    public function index($pForm, $g)
    {
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        if (Request::isMethod("post")) {
            $field = Input::get("field");
            $sql = "--Do nguon du lieu loc" . PHP_EOL;
            $sql .= "EXEC W09P1500 '$field','" . Auth::user()->user()->UserID . "','D09F1500','$divisionhr'";
            $detail = $this->connectionHR->select($sql);
            return View::make("W0X.W09.W09F1500_LeftAjax", compact('detail', "field"));
        } else {
            $search = $this->LoadFixData('SearchFieldW09F1500');
            $modalTitle = $this->getModalTitle($pForm);
            return View::make("W0X.W09.W09F1500", compact('modalTitle', 'search', 'g', 'pForm'));
        }
    }

    public function listEmployee($field, $data)
    {
        //$page = Input::get("page");
        $g =4;
        $sql = "--Do nguon danh sach nhan vien" . PHP_EOL;
        $sql .= "EXEC W09P1510 '$field','$data','" . Auth::user()->user()->UserID . "'";
        try{
            $detail = $this->connectionHR->select($sql);
            return View::make("W0X.W09.W09F1500_ListEmployee", compact('detail','g'));
        }catch (Exception $ex){
            return $ex->getMessage();
        }

    }
}
