<?php
namespace W7X\W76;

use Debugbar;
use Helpers;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F4020Controller extends W7XController
{
    public function ListAlbum($pForm , $g)
    {
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $sql ="--Do nguon danh sach album".PHP_EOL;
        $sql .= "EXEC W76P4020 '$userid', 'D76F4020', 'P',0,0,0";
        $rsListAlbum = $this->connectionHR->select($sql);
        $caption = $this->getModalTitle("D76F4020");
        return View::make("W7X.W76.W76F4020", compact('pForm', 'g', 'rsListAlbum', 'caption'));
    }

    public function ListImage()
    {
        $g=4;
        $caption = $this->getModalTitle("D76F4020");
        $modalTitle = "<a onclick='closePopW76F4021();' class='text-white' style='text-decoration: underline;'>$caption</a>"." > ".Input::get("name");
        $id = Input::get("id");
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $sql ="--Do nguon danh sach image".PHP_EOL;
        $sql .= "EXEC W76P4020 '$userid', 'D76F4020', 'P',$id,0,1";
        $rsImageList = $this->connectionHR->select($sql);

        $sql ="--Do nguon danh sach Thumbnail".PHP_EOL;
        $sql .= "EXEC W76P4020 '$userid', 'D76F4020', 'P',$id,0,2";
        $rsThumbnailList = $this->connectionHR->select($sql);
        return View::make("W7X.W76.W76F4021", compact('pForm', 'g','rsImageList','rsThumbnailList',"modalTitle"));
    }

    public function GetImage()
    {
        $g = 4;
        $albumID = Input::get("albumID");
        $albumItemID = Input::get("albumItemID");
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $sql ="--Lay thong tin Image".PHP_EOL;
        $sql .= "EXEC W76P4020 '$userid', 'D76F4020', 'P',$albumID,$albumItemID,3";
        $rsAlbumItem = $this->connectionHR->select($sql);
        return View::make("W7X.W76.W76F4021_Item", compact('g','rsAlbumItem'));
    }
}
