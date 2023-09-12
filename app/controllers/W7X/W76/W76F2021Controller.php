<?php
namespace W7X\W76;

use Config;
use Debugbar;
use Exception;
use File;
use scanDir;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F2021Controller extends W7XController
{
    public function DetailAlbumVideo($pFrom, $g, $id)
    {
        $caption = $this->getModalTitle("D76F2021");
        if ($id != -1) {
            $sSQL = "--Lay thong tin chi tiet album" . PHP_EOL;
            $sSQL .= "Select AlbumID, AlbumNameU, AlbumType, FilePath, Thumbnail, CreateUserID, CONVERT(VARCHAR(10),AlbumDate,103) as AlbumDate, RemarkU, Disabled  from D76T2010 With(NOLOCK) where AlbumID = $id";
            $rsAlbum = $this->connectionHR->selectOne($sSQL);
            return View::make("W7X.W76.W76F2021", compact('pFrom', 'g', 'id', 'rsAlbum', 'caption'));
        } else {
            $folder = scanDir::directoryToArray(Config::get("services.path_video"), false, true, false,[],true,["mp4", "avi", "mpeg"],Config::get("services.path_video"),false);
            return View::make("W7X.W76.W76F2021", compact('pFrom', 'g', 'id', 'folder', 'caption'));
        }
    }

    public function VideoList($pFrom, $g, $id)
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', '180');
        ini_set('max_input_time', '180');
        ini_set('post_max_size', '300M');
        $sSQL = "Select AlbumItemID, AlbumID, RemarkU, LocationPath, FileType From D76T2011 WITH(NOLOCK) Where AlbumID = $id";
        $dsVideoList = $this->connectionHR->select($sSQL);
        return View::make("W7X.W76.W76F2021_Ajax", compact('pFrom', 'g', 'dsVideoList'));
    }

    public function SaveAlbumVideo($pFrom, $g, $id)
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '180');
        ini_set('max_input_time', '180');
        ini_set('post_max_size', '512M');
        $all = Input::all();
        $AlbumName = $this->sqlstring($all["txtAlbumNameW76F2021"]);
        $Remark = $this->sqlstring($all["txtRemarkW76F2021"]);
        $slFolderW76F2021 = $this->sqlstring(isset($all["txtFilePathW76F2021"]) ? $all["txtFilePathW76F2021"] : "");
        $chkDisabledW76F2021 = isset($all['chkDisabledW76F2021']) ? 1 : 0;
        $imgThumnailVideo = $all["hdThumbnailW76F2021"];
        $CreateUserID = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        try {
            if ($id != -1) { //truong hop update
                $sSQL = "--Cap nhat video" . PHP_EOL;
                $sSQL .= "Update D76T2010 set AlbumNameU = N'$AlbumName', RemarkU = N'$Remark', Thumbnail = '$imgThumnailVideo',Disabled = $chkDisabledW76F2021, LastModifyUserID = '$CreateUserID',LastModifyDate = getdate()  where AlbumID = $id";
                $this->connectionHR->statement($sSQL);
                $albumID = $id;
            } else {//truong hop them moi
                $AlbumDate = date("m/d/Y", strtotime(str_replace('/', '-', $all['txtAlbumDateW76F2021'])));
                $sSQL = "--Luu moi album video" . PHP_EOL;
                $sSQL .= " Insert into D76T2010 (AlbumNameU, AlbumType, AlbumDate, FilePath, RemarkU, Thumbnail, Disabled, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate) Output Inserted.AlbumID ";
                $sSQL .= " values(N'$AlbumName','V','$AlbumDate','$slFolderW76F2021',N'$Remark','$imgThumnailVideo',$chkDisabledW76F2021,'$CreateUserID',getdate(),'$CreateUserID',getdate())";
                $albumID = $this->connectionHR->selectOne($sSQL)['AlbumID'];
            }
            return json_encode(['bSaveOK' => 1, 'albumID' => $albumID]);
        } catch (Exception $ex) {
            return json_encode(['bSaveOK' => 0, 'albumID' => "", "mess" => $ex->getMessage()]);
        }
    }

    public function DetailVideo($pFrom, $g, $itemid)
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', '180');
        ini_set('max_input_time', '180');
        ini_set('post_max_size', '300M');

        if ($itemid != -1) {
            $sSQL = "--Lay thong tin video" . PHP_EOL;
            $sSQL .= "select AlbumID , AlbumItemID, RemarkU, LocationPath from D76T2011 where AlbumItemID = $itemid";
            $dsData = $this->connectionHR->selectOne($sSQL);
            return View::make("W7X.W76.W76F2021_AddVideo", compact('pFrom', 'g', 'dsData', 'itemid'));
        } else {
            $path = Config::get("services.path_video") . str_replace(".\\", "\\", urldecode(Input::get("path")));
            $id = Input::get("id");
            $exclude = $this->connectionHR->select("Select RemarkU From D76T2011 where AlbumID = $id");//get những video đã lưu
            $rsListVideo = scanDir::directoryToArray($path, true, false, true, $exclude, true, ["mp4", "avi", "mpeg"],Config::get("services.path_video"));
            return View::make("W7X.W76.W76F2021_AddVideo", compact('pFrom', 'g', 'itemid', 'rsListVideo'));
        }
    }

    public function saveVideo()
    {
        $all = Input::all();
        $itemid = $all["itemid"];
        $id = $all["id"];
        $createUserID = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $remark = $this->sqlstring($all["remark"]);
        $path = ($all["path"]);
        if ($itemid != -1) { //truong hop update
            $sql = "--Cap nhat video" . PHP_EOL;
            $sql .= " Update D76T2011 set RemarkU = N'$remark', LocationPath='$path', LastModifyUserID = '$createUserID', LastModifyDate = getdate() where AlbumItemID = $itemid";
        } else {//truong hop them moi
            $mode = $all["mode"];
            $sql = "--Add video" . PHP_EOL;
            if ($mode == 0) {//Youtube
                preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $path, $matches);
                $imageContents = file_get_contents('http://img.youtube.com/vi/' . $matches[0] . '/0.jpg');
                $path = "https://www.youtube.com/embed/".$matches[0];
                $thumb = "data:image/jpeg;base64," .base64_encode($imageContents);
                $sql .= "Insert Into D76T2011 (AlbumID, RemarkU, LocationPath, Thumbnail, FileType, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate)".PHP_EOL;
                $sql .= "values($id, N'$remark', '$path', '$thumb', 0,'$createUserID', getdate(),'$createUserID', getdate())".PHP_EOL;
            } else {//File trên local
                $list = $all["list"];
                foreach ($list as $ls) {
                    $remark = $this->sqlstring($ls["rowData"]["Name"]);
                    $path = $this->sqlstring($ls["rowData"]["FolderName"]);
                    if ($path!="")$path.="/";
                    $fthum = base_path() . "/temp/thumb/";
                    if (!File::isDirectory($fthum))
                        File::makeDirectory($fthum);
                    $thumbnail =  $fthum . $remark . ".jpg";
                    $video =  Config::get("services.path_video")."/" . substr($path, 2) . $remark;
                    $thumb="";
                    try{
                        //Tạo thumbnail từ video
                        $ffmpeg = $_SERVER['DOCUMENT_ROOT']."/ffmpeg/bin";
                        if (File::isDirectory($ffmpeg)){
                            $ffmpeg = str_replace("/","\\",$ffmpeg."/ffmpeg");
                            $cmd = "$ffmpeg -i \"$video\" -an -y -f mjpeg -ss 00:00:02 -vframes 1 \"$thumbnail\"";
                            system($cmd);
                            $imageContents = file_get_contents($thumbnail);
                            $thumb = "data:image/jpeg;base64," .base64_encode($imageContents);
                        }
                    } catch (Exception $ex) {
                        Debugbar::info($ex->getMessage());
                    }
                    $sql .= "Insert Into D76T2011 (AlbumID, RemarkU, LocationPath, Thumbnail, FileType, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate)".PHP_EOL;
                    $sql .= "values($id, N'$remark', '$path', '$thumb', 1,'$createUserID', getdate(),'$createUserID', getdate())".PHP_EOL;
                }
            }
        }
        return intval($this->connectionHR->statement($sql));
    }

    public function RemoveVideo($itemid)
    {
        $sSQL = "--Xoa video" . PHP_EOL;
        $sSQL .= "Delete from D76T2011 where AlbumItemID = $itemid" . PHP_EOL;
        return intval($this->connectionHR->statement($sSQL));
    }

}
