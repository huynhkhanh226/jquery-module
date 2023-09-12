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

class W09F3030Controller extends W0XController
{
    public function Index($pForm, $g)
    {
        //$pForm nhận từ form gọi. để truyền vô store đổ nguồn
        $titleW09F3030 = $this->getModalTitle("D09F3030");
        $lang = Session::get('Lang');
        $transID = Input::get("transID");
        $approvalLevel = Input::get("approvalLevel", 0);

        $sql = "-- Do nguon cot dong" . PHP_EOL;
        $sql .= " SELECT	*" . PHP_EOL;
        $sql .= " FROM 	W09V3030" . PHP_EOL;
        $sql .= " WHERE 	FormID = '$pForm'" . PHP_EOL;
        $rsColumns = $this->connectionHR->select($sql);

        $sql = "-- Do nguon cho Form" . PHP_EOL;
        $sql .= " EXEC W09P3030 '$pForm', '$lang', '$transID',$approvalLevel" . PHP_EOL;
        $rsData = $this->connectionHR->select($sql);


        return View::make("W0X.W09.W09F3030", compact('g', 'pForm','rsColumns', 'rsData', 'titleW09F3030', 'lang'));
    }

}
