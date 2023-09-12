<?php
namespace W3X\W38;

use Auth;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W3X\W3XController;

class W38F2010Controller extends W3XController {

    //Duyệt đề xuất đào tạo
    public function detail($vou,$g,$isApproval, $applevel=0) {
        $mod="D38";
        $query="-- Do nguon master".PHP_EOL;
        $query.="EXEC W84P4001 '". Session::get('W91P0000')["HRDivisionID"] ."', '$mod', 'D38F2010', '$vou', '" . Session::get('Lang') ."',0,'" . Auth::user()->User()->UserID."', $isApproval, $applevel";
        $rs=$this->connectionHR->select($query);
        $sql ="--Do nguon luoi detail".PHP_EOL;
        $sql .= "EXEC W38P2001 '".Session::get("W91P0000")['HRDivisionID']."','".Auth::user()->User()->UserID."', N'W38F2000',2, N'', N'$vou', N''";
        $rsDetail=$this->connectionHR->select($sql);
        \Debugbar::info($rs);
        return View::make("W3X.W38.W38F2010_DTAjax",compact("rs","g","mod","rsDetail"));
    }
}