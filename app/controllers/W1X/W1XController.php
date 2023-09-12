<?php
namespace W1X;

use Auth;
use Session;

class W1XController extends \BaseController {

    public function checkW17P5555($mode, $formid, $key01 = '', $key02 = '', $key03 = '', $key04 = '', $key05 = ''){
        $us = Auth::user()->User()->UserID;
        $sql = "--Kiem tra truoc khi sua/xoa".PHP_EOL;
        $sql .= "EXEC W17P5555 '".Session::get('Lang')."','$us', '".Session::getId()."',$mode, '$formid', N'$key01', N'$key02', N'$key03', N'$key04', N'$key05'";
        return $this->connection->selectOne($sql);
    }
}
