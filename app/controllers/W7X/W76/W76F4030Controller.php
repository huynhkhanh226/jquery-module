<?php
namespace W7X\W76;

use Debugbar;
use Helpers;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F4030Controller extends W7XController
{
    public function ListAlbum($pForm , $g)
    {
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $sql ="--Do nguon danh sach album".PHP_EOL;
        $sql .= "EXEC W76P4020 '$userid', 'D76F4030', 'V',0,0,0";
        $rsListAlbum = $this->connectionHR->select($sql);
        $caption = $this->getModalTitle("D76F4030");
        return View::make("W7X.W76.W76F4030", compact('pForm', 'g', 'rsListAlbum', 'caption'));
    }

    public function ListVideo()
    {
        $g=4;$id=Input::get("id");
        $caption = $this->getModalTitle("D76F4030");
        $modalTitle = "<a onclick='closePopW76F4031();' class='text-white' style='text-decoration: underline;'>$caption</a>"." > ".Input::get("name");
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $sql ="--Do nguon danh sach video".PHP_EOL;
        $sql .= "EXEC W76P4020 '$userid', 'D76F4030', 'V',$id,0,2";
        $rsList = $this->connectionHR->select($sql);
        return View::make("W7X.W76.W76F4031", compact('g','rsList',"modalTitle"));
    }
}
