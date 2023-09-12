<?php
namespace W7X\W76;

use Debugbar;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F2011Controller extends W7XController
{
    public function detailAlbum($pFrom, $g, $id)
    {
        $caption = $this->getModalTitle("D76F2011");
        if ($id != -1) {
            $sSQL = "--Lay thong tin chi tiet album" . PHP_EOL;
            $sSQL .= "SELECT AlbumID, AlbumNameU, AlbumType, CreateUserID, CONVERT(VARCHAR(10),AlbumDate,103)  as AlbumDate,RemarkU, Disabled From D76T2010 WITH(NOLOCK) where AlbumID = $id";
            $rsEditAlbum = $this->connectionHR->select($sSQL);
            return View::make("W7X.W76.W76F2011", compact('pFrom', 'g', 'rsEditAlbum', 'id', 'caption'));
        } else {
            return View::make("W7X.W76.W76F2011", compact('pFrom', 'g', 'id', 'caption'));
        }

    }

    public function imageList($pFrom, $g, $id)
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', '180');
        ini_set('max_input_time', '180');
        ini_set('post_max_size', '300M');
        $sSQL = "SELECT AlbumItemID, AlbumID, RemarkU,ThumbNail FROM D76T2011 WITH(NOLOCK) where AlbumID = $id";
        $rsImageList = $this->connectionHR->select($sSQL);
        return View::make("W7X.W76.W76F2011_ImageList", compact('pFrom', 'g', 'rsImageList'));
    }

    public function saveAlbum($pFrom, $g, $id)
    {
        $albumID = $id;
        $all = Input::all();
        $AlbumNameU = $this->sqlstring($all['txtAlbumName']);
        if ($id == -1) {
            $AlbumType = 'P';
            $AlbumDate = date("m/d/Y", strtotime(str_replace('/', '-', $all['txtAlbumDate'])));
        }
        $RemarkU = $this->sqlstring($all['txtRemarkU']);
        $Disabled = isset($all['chkDisabled']) ? 1 : 0;
        $CreateUserID = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        try {
            if ($id != -1) { //truong hop update
                $sSQL = "--Cap nhat thong tin" . PHP_EOL;
                $sSQL .= " Update D76T2010 set AlbumNameU = N'$AlbumNameU',  CreateUserID = '$CreateUserID',RemarkU = N'$RemarkU', Disabled = $Disabled  from D76T2010 where AlbumID = $id";
                $this->connectionHR->statement($sSQL);
            } else {//truong hop them moi
                $sSQL = "--Luu moi thong tin album" . PHP_EOL;
                $sSQL .= " Insert into D76T2010 (AlbumNameU, AlbumType, CreateUserID, AlbumDate, RemarkU, Disabled) Output Inserted.AlbumID";
                $sSQL .= " values(N'$AlbumNameU','$AlbumType','$CreateUserID','$AlbumDate',N'$RemarkU',$Disabled) ";
                $albumID = $this->connectionHR->selectOne($sSQL)['AlbumID'];
            }
            return json_encode(['bSaveOK' => true, 'albumID' => $albumID]);
        } catch (Exception $ex) {
            return json_encode(['bSaveOK' => false, 'albumID' => -1]);
        }
    }

    public function addImage($pFrom, $g)
    {
        return View::make("W7X.W76.W76F2011_AddImage", compact('pFrom', 'g'));
    }

    public function saveImage($pFrom, $g, $id)
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', '180');
        ini_set('max_input_time', '180');
        ini_set('post_max_size', '1024M');
        $remark = $this->sqlstring(Input::get("remark"));
        $filedata = Input::get("filedata");
        $filethumbnail = Input::get("filethumbnail");
        $CreateUserID = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $sSQL = "--Luu image" . PHP_EOL;
        if ($filedata != "") {
            $sSQL .= " Insert into D76T2011 (AlbumID, RemarkU, ThumbNail,  OriginalPhoto, LocationPath, Disabled, CreateUserID, CreateDate, LastModifyUserID,LastModifyDate) " . PHP_EOL;
            $sSQL .= " values($id,N'$remark','$filethumbnail','$filedata','',0,'$CreateUserID',getdate(),'$CreateUserID',getdate() ) " . PHP_EOL;
            $result = $this->connectionHR->statement($sSQL);
        } else {
            $result = true;
        }
        return json_encode(['bSaveOK' => $result]);
    }

    public function removeImage($pFrom, $g)
    {
        $all = Input::all();
        $AlbumID = $all['AlbumID'];
        $AlbumItemID = $all['AlbumItemID'];
        $sSQL = "--Xoa image" . PHP_EOL;
        $sSQL .= " Delete from D76T2011 where AlbumID = '$AlbumID' and AlbumItemID = '$AlbumItemID'";
        $result = $this->connectionHR->statement($sSQL);
        return json_encode(['bSaveOK' => $result]);
    }

    public function updateImage($pFrom, $g)
    {
        $all = Input::all();
        $AlbumID = $all['AlbumID'];
        $AlbumItemID = $all['AlbumItemID'];
        $Remark = $this->sqlstring($all['Remark']);
        $sSQL = "--Xoa image" . PHP_EOL;
        $sSQL .= " Update D76T2011 set RemarkU = N'$Remark' where AlbumID = '$AlbumID' and AlbumItemID = '$AlbumItemID'";
        $result = $this->connectionHR->statement($sSQL);
        return json_encode(['bSaveOK' => $result]);
    }
}
