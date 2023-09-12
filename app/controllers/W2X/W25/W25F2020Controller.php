<?php
namespace W2X\W25;

use Auth;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W2X\W2XController;

class W25F2020Controller extends W2XController {

    //Duyệt đề xuất tuyển dụng
    public function detail($vou,$g,$isApproval, $applevel=0) {
        $mod="D25";
        $query=  "EXEC W84P4001 '". Session::get('W91P0000')["HRDivisionID"] ."', '$mod', 'D25F2020', '$vou', '" . Session::get('Lang') ."',0,'" . Auth::user()->User()->UserID."', $isApproval, $applevel";
        $rs=$this->connectionHR->select($query);
        \Debugbar::info($rs);

        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        //$recPos = Input::get('recPos');
        $sql = "--Dem so luong file dinh kem" .PHP_EOL;
        $sql .= "EXEC D91P1010 '$HRDivisionID', 'D09T0211', '".$rs[0]["RecPositionID"]."', '', '', '', ''" .PHP_EOL;
        \Debugbar::info($sql);
        $fileNumber = $this->connectionHR->select($sql);
        \Debugbar::info($fileNumber);
        return View::make("W2X.W25.W25F2020_DTAjax",compact("rs","g","mod", "fileNumber"));
    }

    public function index($pForm, $g, $task = "") {

        //return View::make("W2X.W25.W25F2020_DTAjax",compact("rs","g","mod"));
    }
}
