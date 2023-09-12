<?php
namespace W7X\W76;

use Auth;
use Config;
use Debugbar;
use Exception;
use File;
use Request;
use scanDir;
use View;
use Input;
use W7X\W7XController;

class W76F2041Controller extends W7XController
{
    public function index($pFrom, $g, $id = "")
    {
        $rsData = [];
        $caption = $this->getModalTitle("D76F2041");
        if ($id != "") {
            $sSQL = "--Do nguon chi tiet" . PHP_EOL;
            $sSQL .= "Select AlbumID, AlbumNameU as AlbumName, AlbumType, FilePath, Thumbnail, CreateUserID, CONVERT(VARCHAR(10),AlbumDate,103) as AlbumDate, RemarkU as Remark, Disabled  from D76T2010 With(NOLOCK) where AlbumID = $id";
            $rsData = $this->connectionHR->selectOne($sSQL);
        }
        return View::make("W7X.W76.W76F2041", compact('pFrom', 'g', 'id', "rsData", "folder", "caption"));
    }

    public function loadGrid($id = "")
    {
        $sSQL = "Select AlbumItemID, AlbumID, RemarkU, LocationPath, FileType From D76T2011 WITH(NOLOCK) Where AlbumID = $id";
        $dsAudio = $this->connectionHR->select($sSQL);
        return View::make("W7X.W76.W76F2041_Ajax", compact('dsAudio'));
    }

    public function action($id = "")
    {
        $all = Input::all();
        $alname = $this->sqlstring($all["txtAlbumNameW76F2041"]);
        $remark = $this->sqlstring($all["txtRemarkW76F2041"]);
        $disabled = isset($all['chkDisabledW76F2041']) ? 1 : 0;
        $imgThumb = $all["hdThumbnailW76F2041"];
        $createuser = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        try {
            if ($id != "") { //Update
                $sSQL = "--Cap nhat album" . PHP_EOL;
                $sSQL .= "Update D76T2010 set AlbumNameU = N'$alname', RemarkU = N'$remark', Thumbnail = '$imgThumb',Disabled = $disabled, LastModifyUserID = '$createuser',LastModifyDate = getdate()  where AlbumID = $id";
                $this->connectionHR->statement($sSQL);
            } else {//truong hop them moi
                $path =  $this->sqlstring($all["txtFilePathW76F2041"]);
                $aldate = date("m/d/Y", strtotime(str_replace('/', '-', $all['txtAlbumDateW76F2041'])));
                $sSQL = "--Them album audio" . PHP_EOL;
                $sSQL .= " Insert Into D76T2010 (AlbumNameU, AlbumType, AlbumDate, FilePath, RemarkU, Thumbnail, Disabled, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate) Output Inserted.AlbumID ";
                $sSQL .= " values(N'$alname','M','$aldate','$path',N'$remark','$imgThumb',$disabled,'$createuser',getdate(),'$createuser',getdate())";
                $id = $this->connectionHR->selectOne($sSQL)['AlbumID'];
            }
            return json_encode(['bSaveOK' => 1, 'albumID' => $id]);
        } catch (Exception $ex) {
            return json_encode(['bSaveOK' => 0, 'albumID' => "", "mess" => $ex->getMessage()]);
        }
    }

    public function actionDetail()
    {
        $root = Config::get("services.path_audio");
        $all = Input::all();
        $id = $all["id"];
        if(Request::isMethod("post")) {
            $list = $all["list"];
            $thum = $all["thumb"];
            $createuser = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
            $sql = "-- Add file audio" . PHP_EOL;
            foreach ($list as $ls) {
                $remark = $this->sqlstring($ls["Name"]);
                $path = $this->sqlstring($ls["FolderName"]);
                $sql .= "Insert Into D76T2011 (AlbumID, RemarkU, Thumbnail, LocationPath, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate)".PHP_EOL;
                $sql .= "values($id, N'$remark', '$thum', '$path', '$createuser', getdate(),'$createuser', getdate())".PHP_EOL;
            }
            return intval($this->connectionHR->statement($sql));
        }elseif (Request::isMethod("delete")) {
            $sSQL = "--Xoa audio" . PHP_EOL;
            $sSQL .= "Delete from D76T2011 where AlbumItemID = $id" . PHP_EOL;
            return intval($this->connectionHR->statement($sSQL));
        }
        $path =  $root. str_replace(".\\", "\\", urldecode(Input::get("path")));
        $exclude = $this->connectionHR->select("Select RemarkU From D76T2011 With(NOLOCK) where AlbumID = $id");//get những video đã lưu
        $rsListAudio  = scanDir::directoryToArray($path, true, false, true, $exclude, true, ["mp3"],$root);
        return View::make("W7X.W76.W76F2041_AddAudio", compact('rsListAudio', "id"));
    }

}
