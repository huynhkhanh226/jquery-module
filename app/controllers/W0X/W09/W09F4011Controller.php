<?php

namespace W0X\W09;

use Auth;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W0X\W0XController;
use Debugbar;
use Config;

class W09F4011Controller extends W0XController
{

    public function Index($pForm, $g, $task = "")
    {
        //\Debugbar::info(Input::all());
        \Debugbar::info(Config::get('attachment.fileExtension'));
        $arrFileExt = Config::get('attachment.fileExtension');
        $arrRSFileEXT = array();
        $arrFileType = array();
        foreach ($arrFileExt as $key => $value){
            if($value['val'] == true){
                array_push($arrRSFileEXT,$value['ext']);
            }
        }

        foreach ($arrFileExt as $key => $value){
            if($value['val'] == true){
                if($key != "zip1"){//loại trừ file zip1
                    array_push($arrFileType,$key);
                }
            }
        }
        \Debugbar::info($arrRSFileEXT);
        \Debugbar::info($arrFileType);
        $keyID = Input::get('keyID');
        $key2ID = Input::get('key2ID');
        $key3ID = Input::get('key3ID');
        $key4ID = Input::get('key4ID');
        $key5ID = Input::get('key5ID');
        $tableName = Input::get('tableName');
        $companyID = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $dataATT = [];
        \Debugbar::info(Session::get("W91P0000"));
        if ($g == 4) {
            $creatorName = Session::get("W91P0000")['CreatorNameHR'];
        } else {
            $creatorName = Session::get("W91P0000")['CreatorName'];
        }

        switch ($task) {
            case 'add':
                return View::make("W0X.W09.W09F4011", compact('g', 'pForm', 'creatorName', 'keyID', 'key2ID', 'key3ID', 'key4ID', 'key5ID', 'dataATT', 'task', 'tableName', 'arrRSFileEXT', 'arrFileType'));
                break;
            case 'view':
                ////\Debugbar::info(Input::all());
                $dataATT = Input::get('data');
                $tableName = Input::get('tableName');
                return View::make("W0X.W09.W09F4011", compact('g', 'pForm', 'creatorName', 'keyID', 'key2ID', 'key3ID', 'key4ID', 'key5ID', 'dataATT', 'task', 'tableName', 'arrRSFileEXT', 'arrFileType'));
                break;

            case 'edit':
                //\Debugbar::info(Input::all());
                $dataATT = Input::get('data');
                $tableName = Input::get('tableName');
                return View::make("W0X.W09.W09F4011", compact('g', 'pForm', 'creatorName', 'keyID', 'key2ID', 'key3ID', 'key4ID', 'key5ID', 'dataATT', 'task', 'tableName', 'arrRSFileEXT', 'arrFileType'));
                break;

            case 'save':
                \Debugbar::info(Input::all());
                ////\Debugbar::info($task);
                $all = Input::all();
                $action = $all['action'];
                $tableName = $all['tableName'];
                $dataType = $this->sqlstring($all['type']);
                $keyIDList = explode(";", $this->sqlstring($all['keyID']));

                $key2ID = $this->sqlstring($all['key2ID']);
                $key3ID = $this->sqlstring($all['key3ID']);
                $key4ID = $this->sqlstring($all['key4ID']);
                $key5ID = $this->sqlstring($all['key5ID']);
                $UserID = Auth::user()->user()->UserID;
                if ($g == 4) {
                    $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
                } else {
                    $HRDivisionID = Session::get("W91P0000")['DivisionID'];
                }

                $Description = $this->sqlstring($all['txtDescriptionW09F4011']);
                $FileSize = Helpers::sqlNumber($all['txtFileSizeW09F4011']);
                $Notes = $this->sqlstring($all['txtNotesW09F4011']);
                $AttachmentID = "";
                $attachmentList = [];
                $sql = "";
                if ($action == 'add') {
                    $file = Input::file("file");
                    $name = $this->sqlstring($file->getClientOriginalName());
                    //$size = $file->getSize();
                    $FileExt = $this->sqlstring($file->getClientOriginalExtension());
                    $URL = $this->sqlstring($file->getLinkTarget());
                    $byteArray = ("0x" . bin2hex(file_get_contents($file->getRealPath()))); //chuyển nội dung file qua chuỗi nhị phân
                    //$AttachmentID = $this->CreateIGE($g, "D91T1010", "09", "W91AI");

                    //$sql .= "exec sp_executesql N'" . PHP_EOL;

                    foreach ($keyIDList as $keyIDItem) { //Bo sung luu dinh kem vo nhieu Key, yeu cau ben Finalcial
                        if ($keyIDItem != "") {
                            $AttachmentID = $this->CreateIGENewS($g, 'D91T1010', '09', 'W91AI', '', count($keyIDList) - 1, '');
                            array_push($attachmentList, $AttachmentID);
                            $sql .= "Insert Into D91T1010(DivisionID, AttachmentID, Description,DescriptionU, Sequence," . PHP_EOL;
                            $sql .= "DataType, URL, FileName, TableName, KeyID, Key2ID, Key3ID, Key4ID, Key5ID," . PHP_EOL;
                            $sql .= "FileExt, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate, Notes,NotesU, FileSize, Content)" . PHP_EOL;
                            $sql .= "Values( '$HRDivisionID' , '$AttachmentID' , '$Description' , N'$Description' , 0 ," . PHP_EOL;
                            $sql .= "'' , '$URL' , '$name' , '$tableName' , '$keyIDItem' , '$key2ID' ," . PHP_EOL;
                            $sql .= "'$key3ID' , '$key4ID' , '$key5ID' , '$FileExt' , '$UserID' , Getdate() ," . PHP_EOL;
                            $sql .= "'$UserID' , Getdate() , '$Notes' , N'$Notes' , $FileSize, $byteArray) " . PHP_EOL;
                            //$sql .= " N'@Content varbinary(max)'," . PHP_EOL;
                            //$sql .= "@Content= $byteArray" . PHP_EOL;
                        }

                    }

                }
                if ($action == 'edit') {
                    $AttachmentID = $this->sqlstring($all['AttachmentID']);
                    $editFlag = $all['editFlag'];
                    if (intval($editFlag) == 0) {// không chọn lại file
                        try {
                            $sql .= "SET NOCOUNT ON" . PHP_EOL;

                            foreach ($keyIDList as $keyIDItem) { //Bo sung luu dinh kem vo nhieu Key, yeu cau ben Finalcial
                                if ($keyIDItem != "") {
                                    $sql .= "Update D91T1010" . PHP_EOL;
                                    $sql .= "SET DivisionID = '$HRDivisionID'," . PHP_EOL;
                                    $sql .= "Description = '$Description'," . PHP_EOL;
                                    $sql .= "DescriptionU = N'$Description'," . PHP_EOL;
                                    $sql .= "Sequence = 0," . PHP_EOL;
                                    $sql .= "TableName = '$tableName'," . PHP_EOL;
                                    $sql .= "KeyID = '$keyIDItem'," . PHP_EOL;
                                    $sql .= "Key2ID = '$key2ID'," . PHP_EOL;
                                    $sql .= "Key3ID = '$key3ID'," . PHP_EOL;
                                    $sql .= "Key4ID = '$key4ID'," . PHP_EOL;
                                    $sql .= "Key5ID = '$key5ID'," . PHP_EOL;
                                    $sql .= "CreateUserID= '$UserID'," . PHP_EOL;
                                    $sql .= "CreateDate = Getdate()," . PHP_EOL;
                                    $sql .= "LastModifyUserID = '$UserID'," . PHP_EOL;
                                    $sql .= "LastModifyDate = Getdate()," . PHP_EOL;
                                    $sql .= "Notes = '$Notes'," . PHP_EOL;
                                    $sql .= "NotesU = N'$Notes'" . PHP_EOL;
                                    $sql .= "Where AttachmentID = '$AttachmentID'" . PHP_EOL;
                                }

                            }

                            if ($g == 4) {
                                $this->connectionHR->statement($sql);
                            } else {
                                $this->connection->statement($sql);
                            }

                            return json_encode(array('status' => 'SUCCESS'));
                        } catch (Exception $ex) {
                            return json_encode(array('status' => 'FAILED', 'message' => $ex->getMessage()));
                        }
                    }
                    if (intval($editFlag) == 1) {//chọn lại file
                        $file = Input::file("file");
                        $name = $this->sqlstring($file->getClientOriginalName());
                        //$size = $file->getSize();
                        $FileExt = $this->sqlstring($file->getClientOriginalExtension());
                        $URL = $this->sqlstring($file->getLinkTarget());
                        $byteArray = ("0x" . bin2hex(file_get_contents($file->getRealPath()))); //chuyển nội dung file qua chuỗi nhị phân

                        //$sql .= "exec sp_executesql N'" . PHP_EOL;

                        foreach ($keyIDList as $keyIDItem) { //Bo sung luu dinh kem vo nhieu Key, yeu cau ben Finalcial
                            if ($keyIDItem != "") {
                                $sql .= "Update D91T1010 SET DivisionID = ''$HRDivisionID''," . PHP_EOL;
                                $sql .= "Description = '$Description'," . PHP_EOL;
                                $sql .= "DescriptionU = N'$Description'," . PHP_EOL;
                                $sql .= "Sequence = 0," . PHP_EOL;
                                $sql .= "DataType = ''," . PHP_EOL;
                                $sql .= "URL = '$URL'," . PHP_EOL;
                                $sql .= "FileName = '$name'," . PHP_EOL;
                                $sql .= "TableName = '$tableName'," . PHP_EOL;
                                $sql .= "KeyID = '$keyIDItem'," . PHP_EOL;
                                $sql .= "Key2ID = '$key2ID'," . PHP_EOL;
                                $sql .= "Key3ID = '$key3ID'," . PHP_EOL;
                                $sql .= "Key4ID = '$key4ID'," . PHP_EOL;
                                $sql .= "Key5ID = '$key5ID'," . PHP_EOL;
                                $sql .= "FileExt = '$FileExt'," . PHP_EOL;
                                $sql .= "CreateUserID= '$UserID'," . PHP_EOL;
                                $sql .= "CreateDate = Getdate()," . PHP_EOL;
                                $sql .= "LastModifyUserID = '$UserID'," . PHP_EOL;
                                $sql .= "LastModifyDate = Getdate()," . PHP_EOL;
                                $sql .= "Notes = '$Notes'," . PHP_EOL;
                                $sql .= "NotesU = N'$Notes'," . PHP_EOL;
                                $sql .= "FileSize = $FileSize," . PHP_EOL;
                                $sql .= "Content = $byteArray" . PHP_EOL;
                                $sql .= "Where AttachmentID = '$AttachmentID''," . PHP_EOL;

                                //$sql .= " N'@Content varbinary(max)'," . PHP_EOL;
                                //$sql .= "@Content= $byteArray" . PHP_EOL;
                            }

                        }


                    }
                }
                //var_dump($sql); die;
                if ($g == 4) {
                    $this->connectionHR->statement($sql);
                } else {
                    $this->connection->statement($sql);
                }


                $supfix = ""; //Dung de debug  truong hop tao database

                $sql1 = "IF NOT EXISTS (SELECT name FROM master.dbo.sysdatabases WHERE name = '" . $companyID . "_ATT$supfix')" . PHP_EOL;
                $sql1 .= "Begin" . PHP_EOL;
                $sql1 .= "USE master;" . PHP_EOL;
                $sql1 .= "CREATE DATABASE " . $companyID . "_ATT$supfix;" . PHP_EOL;
                $sql1 .= "End" . PHP_EOL;

                try {

                    if ($g == 4) {
                        $result = $this->connectionHR->statement($sql1);
                    } else {
                        $result = $this->connection->statement($sql1);
                    }
                    if ($result) { //Neu kiem tra database da ton tai thi thuc hien tao bang
                        $sql1 .= "USE " . $companyID . "_ATT$supfix;" . PHP_EOL;
                        $sql1 .= "IF NOT EXISTS" . PHP_EOL;
                        $sql1 .= "(SELECT TOP 1 1 FROM " . $companyID . "_ATT$supfix.DBO.SYSOBJECTS" . PHP_EOL;
                        $sql1 .= "WHERE ID = OBJECT_ID(N'[DBO].$tableName')" . PHP_EOL;
                        $sql1 .= "AND OBJECTPROPERTY(ID, N'IsTable') = 1)" . PHP_EOL;

                        $sql1 .= "BEGIN" . PHP_EOL;
                        $sql1 .= "CREATE TABLE $tableName (AttachmentID varchar(20) NOT NULL, Content varbinary(MAX) NOT NULL," . PHP_EOL;
                        $sql1 .= "KeyID varchar(20) NOT NULL Default(''), Key2ID varchar(20) NOT NULL Default(''),Key3ID varchar(20) NOT NULL Default('')," . PHP_EOL;
                        $sql1 .= "Key4ID varchar(20) NOT NULL Default(''), Key5ID varchar(20) NOT NULL Default(''), FileExt varchar(20) NOT NULL Default('')," . PHP_EOL;
                        $sql1 .= "DivisionID varchar(20) NOT NULL Default(''), ContentArchive varbinary(MAX) NULL)" . PHP_EOL;
                        $sql1 .= "END" . PHP_EOL;

                        $sql1 .= "ELSE" . PHP_EOL;

                        $sql1 .= "BEGIN" . PHP_EOL;
                        $sql1 .= "IF NOT EXISTS(SELECT TOP 1 1 FROM syscolumns col WITH(NOLOCK)" . PHP_EOL;
                        $sql1 .= "INNER JOIN sysobjects tab WITH(NOLOCK) On col . id = tab . id" . PHP_EOL;
                        $sql1 .= "WHERE tab . name = '$tableName' AND col . name = 'ContentArchive')" . PHP_EOL;
                        $sql1 .= "BEGIN" . PHP_EOL;
                        $sql1 .= "ALTER TABLE $tableName ADD ContentArchive varbinary(MAX) NULL" . PHP_EOL;
                        $sql1 .= "End" . PHP_EOL;
                        $sql1 .= "END" . PHP_EOL;
                        $this->attConnectionStatement($sql1);
                        //print_r($keyIDList);die;
                        $i = 0;
                        foreach ($keyIDList as $keyIDItem) {
                            if ($keyIDItem != "") {
                                $sql1 = "exec sp_executesql N'" . PHP_EOL;
                                $sql1 .= "MERGE $tableName T1" . PHP_EOL;
                                $sql1 .= "USING (SELECT @AttachmentID, @Content,@DivisionID,@KeyID, @Key2ID, @Key3ID," . PHP_EOL;
                                $sql1 .= "@Key4ID,@Key5ID,@FileExt, @ContentArchive)" . PHP_EOL;
                                $sql1 .= "AS T2 (AttachmentID, Content,DivisionID,KeyID, Key2ID, Key3ID," . PHP_EOL;
                                $sql1 .= "Key4ID,Key5ID,FileExt, ContentArchive)" . PHP_EOL;
                                $sql1 .= "ON (T1.AttachmentID = T2.AttachmentID)" . PHP_EOL;

                                $sql1 .= "WHEN MATCHED THEN" . PHP_EOL;
                                $sql1 .= "UPDATE SET Content = T2.Content, ContentArchive = T2.ContentArchive, KeyID = T2.KeyID," . PHP_EOL;
                                $sql1 .= "Key2ID = T2.Key2ID," . PHP_EOL;
                                $sql1 .= "Key3ID = T2.Key3ID, Key4ID = T2.Key4ID, Key5ID = T2.Key5ID, FileExt = T2.FileExt," . PHP_EOL;
                                $sql1 .= "DivisionID = T2.DivisionID" . PHP_EOL;

                                $sql1 .= "WHEN NOT MATCHED THEN" . PHP_EOL;
                                $sql1 .= "INSERT(AttachmentID, Content,DivisionID,KeyID, Key2ID, Key3ID, Key4ID,Key5ID,FileExt," . PHP_EOL;
                                $sql1 .= "ContentArchive)" . PHP_EOL;
                                $sql1 .= "VALUES (T2.AttachmentID, T2.Content,T2.DivisionID,T2.KeyID, T2.Key2ID, T2.Key3ID," . PHP_EOL;
                                $sql1 .= "T2.Key4ID,T2.Key5ID,T2.FileExt," . PHP_EOL;
                                $sql1 .= "T2.ContentArchive);'," . PHP_EOL;

                                $sql1 .= "N'@AttachmentID varchar(15) ,@DivisionID varchar(2)," . PHP_EOL;
                                $sql1 .= "@KeyID varchar(800),@Key2ID varchar(8000),@Key3ID varchar(8000),@Key4ID varchar(8000)," . PHP_EOL;
                                $sql1 .= "@Key5ID varchar(8000),@FileExt varchar(3),@ContentArchive binary(8000),@Content varbinary(max)'," . PHP_EOL;
                                $sql1 .= "@AttachmentID = '$attachmentList[$i]' ," . PHP_EOL;
                                $sql1 .= "@DivisionID = '$HRDivisionID', @KeyID = '$keyIDItem'," . PHP_EOL;
                                $sql1 .= "@Key2ID = '$key2ID'," . PHP_EOL;
                                $sql1 .= "@Key3ID = '$key3ID'," . PHP_EOL;
                                $sql1 .= "@Key4ID = '$key4ID'," . PHP_EOL;
                                $sql1 .= "@Key5ID = '$key5ID', @FileExt = '$FileExt'," . PHP_EOL;
                                $sql1 .= "@ContentArchive = NULL," . PHP_EOL;
                                $sql1 .= "@Content = $byteArray" . PHP_EOL;
                                $this->attConnectionStatement($sql1);
                            }
                            $i++;
                        }
                        //var_dump($sql1);die;

                        return json_encode(array('status' => 'SUCCESS'));
                    }
                } catch (Exception $ex) {
                    return json_encode(array('status' => 'FAILED', 'message' => $ex->getMessage()));
                }
                break;

        }

    }
}


