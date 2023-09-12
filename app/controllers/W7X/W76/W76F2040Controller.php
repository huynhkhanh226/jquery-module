<?php
namespace W7X\W76;

use Debugbar;
use Request;
use View;
use Input;
use W7X\W7XController;

class W76F2040Controller extends W7XController
{
    public function index($pFrom, $g)
    {
        if (Request::isMethod("POST")) {
            $userid = (\Auth::user()->check()) ? \Auth::user()->user()->UserID : \Auth::ess()->user()->UserID;
            $sSQL = "--Lay danh sach album video" . PHP_EOL;
            $sSQL .= " EXEC W76P2010 '$userid', 'M', 1";
            $rsData = json_encode($this->connectionHR->select($sSQL));
            return View::make("W7X.W76.W76F2040_Ajax", compact('pFrom', 'rsData', 'g'));
        } elseif (Request::isMethod("DELETE")) {
            $id = Input::get("id");
            $sSQL = "--Xoa anh trong album" . PHP_EOL;
            $sSQL .= "Delete from D76T2011 where AlbumID = '$id'" . PHP_EOL;
            $sSQL .= "--Xoa album" . PHP_EOL;
            $sSQL .= "Delete from D76T2010 where AlbumID = '$id'" . PHP_EOL;
            $result = $this->connectionHR->statement($sSQL);
            return json_encode(['bSaveOK' => $result]);
        }
        $caption = $this->getModalTitle("D76F2040");
        return View::make("W7X.W76.W76F2040", compact('pFrom', 'g', 'caption'));
    }
}
