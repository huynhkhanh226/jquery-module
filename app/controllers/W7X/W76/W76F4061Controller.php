<?php
namespace W7X\W76;

use Debugbar;
use Helpers;
use Request;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F4061Controller extends W7XController
{
    public function index($id = "")
    {
        $g = 4;
        $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        if (Request::isMethod('post')) {
            $doccategory = Input::get("slDocCategoryID", "");
            $desc = $this->sqlstring(Input::get("txtDocDesc", ""));
            $refno = $this->sqlstring(Input::get("txtRefNo", ""));
            $notes = $this->sqlstring(Input::get("txtNotes", ""));
            $disabled = Input::get("chkDisabled", 0);
            $date = Helpers::convertDate(Input::get("txtUploadedDate", ""));
            $imgThumb =  Input::get("hdThumbnailW76F4061", '');;
            try {
                if ($id == "") {//Addnew
                    if (Input::hasFile('fileW76F4061')) {
                        $file = Input::file('fileW76F4061');
                        $name = $file->getClientOriginalName();
                        if (strlen($name) != strlen(utf8_decode($name))) {
                            return json_encode(['code' => 0, 'mess' => "Tên file không hợp lệ."]);
                        }
                        $size = $file->getSize();
                        if ($size > 5242880) {
                            return json_encode(['code' => 0, 'mess' => Helpers::getRS($g, 'Upload_vuot_qua_dung_luong_cho_phep') . " (5MB)"]);
                        }
                        $mime = \scanDir::get_mime_type($file->getClientOriginalExtension());
                        $class = Helpers::geticonfile($file->getClientOriginalExtension());
                        $byteArray = ("0x" . bin2hex(file_get_contents($file->getRealPath())));
                        $sql = "--Luu tai lieu" . PHP_EOL;
                        $sql .= "Insert Into D76T2060(";
                        $sql .= "DocCategoryID, FileName, DocDesc, RefNo, ";
                        $sql .= "UploadedDate, Notes, Disabled, CreateDate, LastModifyDate, ";
                        $sql .= "CreateUserID, LastModifyUserID, FileType, FileSize, Content, IconClass, Thumbnail";
                        $sql .= ") Output Inserted.DocID Values(";
                        $sql .= "'$doccategory',  N'$name',  N'$desc',  N'$refno', ";
                        $sql .= "$date,  N'$notes', $disabled, getdate(), getdate(), ";
                        $sql .= " N'$user',  N'$user',  N'$mime',  N'$size', CONVERT(varbinary(MAX), " . $byteArray . "), '$class', '$imgThumb'";
                        $sql .= ")";
                        $docid = $this->connectionHR->selectOne($sql)["DocID"];
                        $sql = "--Do nguon luoi" . PHP_EOL;
                        $sql .= "EXEC W76P4060  '', '$user', '', $docid";
                        $rsResult = $this->connectionHR->selectOne($sql);
                        $rsResult["code"] = 1;
                        return json_encode($rsResult);
                    }
                    return json_encode(['code' => 0, "mess" => Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")]);
                } else {
                    $sql = "--Luu edit" . PHP_EOL;
                    $sql .= "Update D76T2060 Set ";
                    $sql .= "DocCategoryID =  N'$doccategory',";
                    $sql .= "DocDesc =  N'$desc',";
                    $sql .= "RefNo =  N'$refno',";
                    $sql .= "UploadedDate = $date,";
                    $sql .= "Notes =  N'$notes',";
                    $sql .= "Disabled = $disabled,";
                    $sql .= "Thumbnail = '$imgThumb',";
                    $sql .= "LastModifyDate = getdate(),";
                    $sql .= "LastModifyUserID =  N'$user'";
                    $sql .= " Where DocID=$id";
                    $this->connectionHR->statement($sql);
                    $sql = "--Do nguon luoi" . PHP_EOL;
                    $sql .= "EXEC W76P4060  '', '$user', '', $id";
                    $rsResult = $this->connectionHR->selectOne($sql);
                    $rsResult["code"] = 1;
                    return json_encode($rsResult);
                }
            } catch (Exception $ex) {
                return json_encode(['code' => 0, "mess" => Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu"), 'detailmess' => $ex->getMessage()]);
            }
        } elseif (Request::isMethod('delete')) {
            $rs = $this->checkW76P5555("D", "W76F2070", "Doc", $id);
            if ($rs["Status"] == 0) {
                $sql = "--Xoa du lieu" . PHP_EOL;
                $sql .= "Delete From D76T2060 Where DocID = $id";
                $code = intval($this->connectionHR->statement($sql));
                return json_encode(['code' => $code, "mess" => Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")]);
            }
            return json_encode(['code' => 0, "mess" => $rs["Message"]]);
        }
        $sql = "SELECT DocCatID, DocCategoryName FROM D76T2070 WITH(NOLOCK) Where Disabled=0";
        $rsCategory = $this->connectionHR->select($sql);
        $rsData = [];
        if ($id != "") {
            $sql = "--Do nguon form" . PHP_EOL;
            $sql .= "EXEC W76P4060  '', '$user', '', $id";
            $rsData = $this->connectionHR->selectOne($sql);
        }
        return View::make("W7X.W76.W76F4061", compact('g', 'id', 'rsCategory', 'rsData'));
    }


}
