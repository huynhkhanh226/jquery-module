<?php
namespace W7X\W76;

use Debugbar;
use View;
use W7X\W7XController;

class W76F4010Controller extends W7XController {

    public function index($pFrom,$g) {
        if(\Request::isMethod("post")) {
            $field = \Input::get("cboSearchFieldID");
            $key= \Input::get("keySearch");
            if($key!="")
            $result= $this->connectionHR->select("EXEC W76P4010 N'" . $key . "', '".$field."'");
            else $result=[];
          //  Debugbar::info($result);
            return View::make('W7X.W76.W76F4010_Ajax',compact('result'));
        }
        $rsField = $this->LoadFixData("SearchFieldW76");
        $caption = $this->getModalTitle("D76F4010");
        return View::make("W7X.W76.W76F4010",compact('pFrom','g','rsField','caption'));

    }
}
