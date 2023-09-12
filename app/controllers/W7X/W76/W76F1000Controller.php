<?php

namespace W7X\W76;

use Carbon\Carbon;
use DB;
use Exception;
use Request;
use View;
use W7X\W7XController;
use Input;

class W76F1000Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        $permission = \Session::get($pForm);
        //$permission == 0 ; khong co quyen
        //$permission = 1; Co quyen view
        //$permission = 2; Co quyen add
        //$permission = 3; Co quyen edit
        //$permission = 4; Co quyen delete
        $divisionID = \Session::get("W91P0000")["DivisionID"];
        $userID = \Auth::user()->user()->UserID;
        $tranMonth = \Session::get("W91P0000")['TranMonth'];
        $tranYear = \Session::get("W91P0000")['TranYear'];
        $lang = \Session::get('Lang');
        $hostID = \Session::getId();
        $caption = $this->getModalTitle($pForm);


        switch ($task) {
            case "":
                $disabled = 0;
                $mode = 1;
                $sql = "--Do nguon luoi" . PHP_EOL;
                $sql .= "SELECT ID, DocGroupCode, DocGroupName, Note, DisplayOrder, Disabled FROM   DRD02.dbo.D76T1000 Where Deleted = '0' Order by DisplayOrder" . PHP_EOL;
                $rsData = $this->connection->select($sql);
                $rsData = json_encode($rsData);
                return View::make("W7X.W76.W76F1000", compact('caption', 'hello', 'permission', 'pForm', 'g', 'task', 'rsData'));
                break;
            case "edit":
            case "view":

                $DocGroupCode = Input::get('DocGroupCode', 0);
                $DocGroupName = Input::get('DocGroupName', 0);
                $Note = Input::get('Note', 0);
                $DisplayOrder = Input::get('DisplayOrder', 0);
                $Disable = Input::get('Disable_cb', '0');
                $ID = Input::get('ID', '');

                return View::make("W7X.W76.W76F1000_Action", compact('DocGroupCode', 'DocGroupName', 'Note', 'DisplayOrder', 'Disable', 'pForm', 'ID', 'g', 'task'));
                break;
            case "add":
                return View::make("W7X.W76.W76F1000_Action", compact('pForm', 'g', 'task'));
                break;
            case "save":
                $txtIDW76F1000 = \Input::get("txtIDW76F1000", "");
                $txtDocGroupCodeW76F1000 = $this->sqlstring(Input::get("txtDocGroupCodeW76F1000", ""));
                $txtDocGroupNameW76F1000 = \Helpers::sqlstring(Input::get("txtDocGroupNameW76F1000", ""));
                $txtNoteW76F1000 = \Helpers::sqlstring(Input::get("txtNoteW76F1000", ""));
                $txtDisplayOrderW76F1000 = \Helpers::sqlNumber(Input::get("txtDisplayOrderW76F1000", 0));
                $chDisableW76F1000 = Input::get("chDisableW76F1000", 0);
                //Kiem tra trung ma


                try {
                    $sql = "---Kiem tra du lieu truoc khi luu" . PHP_EOL;
                    $sql .= "SELECT 		Top 1 1 as check_exist " . PHP_EOL;
                    $sql .= "FROM 		D76T1000 WITH(NOLOCK)" . PHP_EOL;
                    $sql .= "WHERE		DocGroupCode = '$txtDocGroupCodeW76F1000'" . PHP_EOL;
                    $check_store = $this->connectionHR->selectOne($sql);
                    $check_store = $check_store['check_exist'];
                    \Debugbar::info('kiem tra', $check_store);
                    if ($check_store == 1) {
                        \Debugbar::info('quyen check');
                        return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Ma_nhom_van_ban_da_ton_tai_ban_khong_duoc_phep_luu")]);
                    } else {
                        $sql = "--Them moi du lieu" . PHP_EOL;
                        $sql .= "insert into D76T1000 (DocGroupCode, DocGroupName, Note, DisplayOrder, Disabled, CreateUserID, LastModifyUserID, CreateDate, LastModifyDate, ID)" . PHP_EOL;
                        $sql .= "output Inserted.ID values (N'$txtDocGroupCodeW76F1000', N'$txtDocGroupNameW76F1000', N'$txtNoteW76F1000', '$txtDisplayOrderW76F1000', '$chDisableW76F1000' ,'$userID', '$userID', getdate(), getdate(), (Select NEWID()))" . PHP_EOL;
                        $result = $this->connection->selectOne($sql);
                        $ID = $result["ID"];
                        $sql = "--Do nguon luoi" . PHP_EOL;
                        $sql .= "SELECT ID,DocGroupCode, DocGroupName, Note, DisplayOrder, Disabled FROM   DRD02.dbo.D76T1000 where ID = '$ID ' Order by DisplayOrder" . PHP_EOL;
                        $rsData = $this->connection->selectOne($sql);
                        $rsData = ($rsData);
                        return json_encode(["status" => "SUC", "message" => \Helpers::getRS($g, "ok"), "dataGrid" => $rsData]);
                    }
                } catch (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

                break;
            case "update":
                $txtDocGroupCodeW76F1000 = Input::get("txtDocGroupCodeW76F1000", "");
                $txtDocGroupNameW76F1000 = Input::get("txtDocGroupNameW76F1000", "");
                $txtNoteW76F1000 = Input::get("txtNoteW76F1000", "");
                $txtDisplayOrderW76F1000 = Input::get("txtDisplayOrderW76F1000", 0);
                $chDisableW76F1000 = Input::get("chDisableW76F1000", 0);
                $LastModifyDate = Carbon::now();
                $ID = Input::get('ID', "");


                try {
                    $sql = "--Cap nhat du lieu" . PHP_EOL;
                    $sql .= "update D76T1000 set DocGroupCode = N'$txtDocGroupCodeW76F1000', DocGroupName = N'$txtDocGroupNameW76F1000', Note = N'$txtNoteW76F1000', DisplayOrder = '$txtDisplayOrderW76F1000', LastModifyDate =getDate(), DISABLED = $chDisableW76F1000 where ID = '$ID'" . PHP_EOL;
                    $this->connection->statement($sql);
                    $sql = "--Lay dong du lieu hien tai" . PHP_EOL;
                    $sql .= "SELECT ID,DocGroupCode, DocGroupName, Note, DisplayOrder, Disabled FROM   DRD02.dbo.D76T1000 where ID = '$ID ' Order by DisplayOrder" . PHP_EOL;
                    $currentRow = $this->connection->selectOne($sql);
                    return json_encode(["status" => "SUC", 'dataGrid' => $currentRow]);

                } catch (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

                break;
            case "delete":
                $ID = Input::get("ID", "");
                $sql = "--Thuc hien xoa du lieu" . PHP_EOL;
                //$sql .= "delete from [D76T1000] where [ID] = '$ID'".PHP_EOL;
                $sql .= "update [dbo].[D76T1000] set [Deleted] = 1 where ID = '$ID'" . PHP_EOL;
                try {
                    $this->connection->statement($sql);
                    return json_encode(["status" => "SUC"]);

                } catch (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }
                break;

        }


    }
}
