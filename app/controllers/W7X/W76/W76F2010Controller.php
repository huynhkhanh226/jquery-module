<?php
namespace W7X\W76;

use Debugbar;
use View;
use Input;
use W7X\W7XController;

class W76F2010Controller extends W7XController
{
    public function listAlbum($pFrom, $g)
    {
        if(\Request::isMethod("POST")) {
           // $disabled = isset( $all['disabled']) ? 1 : 0;
            $userid = (\Auth::user()->check()) ? \Auth::user()->user()->UserID :  \Auth::ess()->user()->UserID;
            if ($pFrom == "D76F2010"){
                $sSQL = "--Lay danh sach album picture" . PHP_EOL;
                $sSQL .= " EXEC W76P2010 '$userid', 'P', 1";
            }
            else if ($pFrom == "D76F2020"){
                $sSQL = "--Lay danh sach album video" . PHP_EOL;
                $sSQL .= " EXEC W76P2010 '$userid', 'V', 1";
            }
            $data = json_encode($this->connectionHR->select($sSQL));
            return View::make("W7X.W76.W76F2010_Ajax", compact('pFrom', 'data','g'));
        }
        $caption = $this->getModalTitle($pFrom);
        return View::make("W7X.W76.W76F2010", compact('pFrom', 'g',"caption"));
    }


    public function removeAlbum($pFrom, $g, $id)
    {
        $sSQL = "--Xoa anh trong album" . PHP_EOL;
        $sSQL .= "DELETE FROM D76T2011 WHERE AlbumID = '$id'".PHP_EOL;
        $sSQL .= "--Xoa album" . PHP_EOL;
        $sSQL .= "DELETE FROM D76T2010 WHERE AlbumID = '$id'".PHP_EOL;
        $result = $this->connectionHR->statement($sSQL);
        return json_encode(['bSaveOK' => $result]);
    }

}
