<?php
namespace W7X\W76;

use Auth;
use Input;
use Request;
use Session;
use Symfony\Component\Console\Helper\Helper;
use View;
use W7X\W7XController;
use Debugbar;
use Helpers;

class W76F2070Controller extends W7XController
{
    public function index($pForm, $g)
    {
        $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        if (Request::isMethod("get")) {
            $permission = $this->getPermission("D76F2070");
            $sql = "--Do nguon luoi" . PHP_EOL;
            $sql .= "EXEC W76P2070 '$user','" . Session::get('Lang') . "'";
            $rsData = json_encode($this->connectionHR->select($sql));
            return View::make("W7X.W76.W76F2070", compact('pForm', 'g', "rsData", 'permission'));
        } else {
            $status = Input::get("slStatusID", 1);
            $faci = Input::get("slFacilityID", "");
            $date = Helpers::convertDate(Input::get("txtRequestedDate", date("d/m/Y")));
            $sql = "--Do nguon luoi" . PHP_EOL;
            $sql .= "EXEC W76P2070 '$user', $date,'$status','$faci','1'";
            $rsData = $this->connectionHR->select($sql);
            return json_encode($rsData);
        }
    }

    public function action($id = "")
    {
        $permission = $this->getPermission("D76F2070");
        if ($permission > 0) {
            if (Request::isMethod("post")) {
                $doctypeid = strtoupper(Input::get("txtDocCategoryID", $id));
                if (!preg_match('/^\w]/', $doctypeid)) {
                    $dtypename = $this->sqlstring(Input::get("txtDocCategoryName", ""));
                    $disabled = Input::get("chkDisabled", "") == "on" ? 1 : 0;
                    $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
                    if ($id == "") {
                        $rs = $this->connectionHR->select("SELECT TOP 1 1 FROM D76T2070 WITH(NOLOCK) WHERE DocCategoryID = '$doctypeid'");
                        if (count($rs) > 0) {//Đã tồn tại
                            return json_encode(["code" => 0, "mess" => Helpers::getRS(4, "Du_lieu_da_bi_trung_ban_khong_the_luu")]);
                        }
                        $sql = "--Luu Addnew" . PHP_EOL;
                        $sql .= "Insert Into D76T2070(";
                        $sql .= "DocCategoryID, DocCategoryName, CreateDate, CreateUserID, LastModifyDate, LastModifyUserID";
                        $sql .= ") Values(";
                        $sql .= " N'$doctypeid',  N'$dtypename', getdate(), '$user', getdate(), '$user'";
                        $sql .= ")";
                    } else {
                        $sql = "--Luu Edit" . PHP_EOL;
                        $sql .= "Update D76T2070 Set ";
                        $sql .= "DocCategoryName =  N'$dtypename',";
                        $sql .= "LastModifyDate = getdate(),";
                        $sql .= "LastModifyUserID =  N'$user',";
                        $sql .= "Disabled = $disabled";
                        $sql .= " Where DocCategoryID='$id'";
                    }
                    $rs = $this->connectionHR->statement($sql);
                    $result["code"] = intval($rs);
                    $result["mess"] = $rs["Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu"];
                    $result["DocCategoryID"] = $doctypeid;
                    $result["DocCategoryName"] = Input::get("txtDocCategoryName", "");
                    $result["Disabled"] = $disabled;
                    return json_encode($result);
                }
            } elseif (Request::isMethod("delete")) {
                $rs = $this->checkW76P5555("ED", "W76F2070", "R", $id);
                if ($rs["Status"] == 0) {
                    $sql = "--Delete Loai tai lieu" . PHP_EOL;
                    $sql .= "Delete From D76T2070";
                    $sql .= " Where DocCategoryID='$id'";
                    $this->connectionHR->statement($sql);
                    return json_encode(["code" => 1, "mess" => ""]);
                } else
                    return json_encode(["code" => 0, "mess" => $rs["Message"]]);
            } elseif (Request::isMethod("get")) {
                $g = 4;
                $rsData = "";
                if ($id != "")
                    $rsData = $this->connectionHR->selectOne("Select DocCategoryID, DocCategoryName, Disabled From D76T2070 With(Nolock) Where DocCategoryID='$id'");
                return View::make("W7X.W76.W76F2070_Action", compact('id', 'g', "rsData", "permission"));
            }
            return json_encode(["code" => 0, "mess" => Helpers::getRS(4, "Co_loi_xay_ra_trong_qua_trinh_gui_du_lieu")]);
        }
    }
}
