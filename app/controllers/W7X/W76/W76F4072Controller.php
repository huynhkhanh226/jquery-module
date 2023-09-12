<?php

namespace W7X\W76;

use Carbon\Carbon;
use DateTime;
use DB;
use Debugbar;
use Exception;
use Helpers;
use Illuminate\Support\Facades\Response;
use Request;
use Session;
use View;
use Input;
use Auth;
use Config;
use W7X\W7XController;

class W76F4072Controller extends W7XController
{
    public function index($g)
    {
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $arrFileExt = Config::get('attachment.fileExtension');
        $arrFileType = array();

        foreach ($arrFileExt as $key => $value){
            if($value['val'] == true){
                if($key != "zip1"){//lo?i tr? file zip1
                    array_push($arrFileType,'.'.$key);
                }
            }
        }
        //var_dump(implode(", .",$arrFileType));die;
        if (Request::isMethod('post')) {
            $content = Input::get('txtMemoContent', '');
            $taskid = Input::get('hdTaskID', '');
            $delAttachment = json_decode(Input::get('delAttachment', '[]'));
            try {
                $this->connectionHR->table('D76T2052')->whereIn('FileID',$delAttachment)->delete();
                $sql = "--Luu them moi" . PHP_EOL;
                $sql .="Insert Into D76T2051(";
                $sql .="TaskID, MemoContent, Creator, CreateDate, LastModifyDate";
                $sql .=") OUTPUT Inserted.MemoID  Values(";
                $sql .="$taskid, N'$content',  '$userid', getdate(),  getdate()";
                $sql .=")";
                $result = $this->connectionHR->selectOne($sql);
                $memoid = $result['MemoID'];
                //Save file Attachment
                if (Input::hasFile('file')) {
                    foreach (Input::file("file") as $file) {
                        $byteArray = ("0x" . bin2hex(file_get_contents($file->getRealPath())));
                        $filename = $file->getClientOriginalName();
                        $ext = $file->getClientOriginalExtension();
                        $sql ="--Luu dinh kem cho memo".PHP_EOL;
                        $sql .="Insert Into D76T2052(";
                        $sql .="MemoID, FileContent, FileExtension, FileName";
                        $sql .=") Values(";
                        $sql .="$memoid, CONVERT(varbinary(MAX), " . $byteArray . "),  '$ext',  N'$filename'";
                        $sql .=")";
                        $this->connectionHR->statement($sql);
                    }
                }
                $row =  $this->connectionHR->selectOne("SELECT T1.MemoID, T1.MemoContent, T1.Creator, T1.CreateDate,t2.UserPicture from D76T2051  T1 LEFT JOIN lemonsys..D00T0030  T2 ON T1.Creator = T2.UserID WHERE T1.MemoID = $memoid");
                return View::make("W7X.W76.W76F4072_item", compact('g', 'memoid',  'row', 'userid', 'arrFileType'));
            } catch (Exception $ex) {
                \Debugbar::info($ex->getMessage());
                return 0;
            }
        }
        $id = intval(Input::get('id', 0));
        $memo =  $this->connectionHR->select("SELECT T1.MemoID, T1.MemoContent, T1.Creator, T1.CreateDate,t2.UserPicture from D76T2051  T1 LEFT JOIN lemonsys..D00T0030  T2 ON T1.Creator = T2.UserID WHERE T1.TaskID = $id ORDER BY T1.CreateDate");
        return View::make("W7X.W76.W76F4072", compact('g', 'id',  'memo', 'userid', 'arrFileType'));
    }

    public function getFile($id)
    {
        ob_end_clean();
        ob_start();
        $id = Helpers::decryptData($id );
        if ($id == "") return "";
        $file = $this->connectionHR->selectOne("Select FileContent, FileName From D76T2052 With(Nolock) Where FileID = $id");

        $fileName = $file['FileName'];
        $content = $file['FileContent'];
        $len = strlen($content);
        $content = pack("H" . $len, $content);

        if (!file_exists(storage_path() . "\downloads\\")) {
            mkdir(storage_path() . "\downloads\\");
        }

        $pathFile = storage_path() . "\downloads\\" . $fileName ;
        //Write file zip
        $fp = fopen($pathFile, 'w');
        fwrite($fp, $content);
        fclose($fp);

        /*header("Cache-Control: no-cache private");
        header("Content-Description: File Transfer");
        header('Content-disposition: attachment; filename='.$fileName);
        header("Content-Type: " . Helpers::get_content_type($fileName)). ";charset=UTF-8";
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: '. $len);
        echo  $content;
        exit;*/
        return Response::download($pathFile);
    }

    public function action(){
        $id= Input::get('id', 0);
        if ($id > 0){
            $this->connectionHR->beginTransaction();
            try{
                $this->connectionHR->statement("DELETE FROM D76T2052 WHERE MemoID = $id");
                $this->connectionHR->statement("DELETE FROM D76T2051 WHERE MemoID = $id ");
                $this->connectionHR->commit();
            } catch (Exception $ex) {
                \Debugbar::info($ex->getMessage());
                $this->connectionHR->rollBack();
                return $ex->getMessage();
            }
            return 1;
        }
    }
}
