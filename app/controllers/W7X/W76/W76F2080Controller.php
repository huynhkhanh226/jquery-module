<?php
namespace W7X\W76;

use Auth;
use Input;
use Request;
use Symfony\Component\Console\Helper\Helper;
use View;
use W7X\W7XController;
use Debugbar;
use Helpers;

class W76F2080Controller extends W7XController
{
    public function index($pForm, $g)
    {
        $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        if (Request::isMethod("get")) {
            $sql = "--Do nguon trang thai" . PHP_EOL;
            $sql .= "SELECT StatusID, StatusName FROM W76V0001";
            $rsStatus = $this->connectionHR->select($sql);
            $sql = "--Do nguon phong" . PHP_EOL;
            $sql .= "SELECT FacilityID, FacilityNo, 1 AS DisplayOrder FROM D76T2020 WITH(NOLOCK) WHERE Disabled = 0 " . PHP_EOL;
            $sql .= "Union All Select 0 as FacilityID,N'" . Helpers::getRS($g, "Tat_ca_Web") . "' as FacilityNo, 0 AS DisplayOrder" . PHP_EOL;
            $sql .= "Order by DisplayOrder, FacilityNo";
            $rsFacilityID = $this->connectionHR->select($sql);
            return View::make("W7X.W76.W76F2080", compact('pForm', 'g', "rsStatus", 'rsFacilityID'));
        } else {
            $status = Input::get("slStatusID", 1);
            $faci = Input::get("slFacilityID", "");
            $date = Helpers::convertDate(Input::get("txtRequestedDate", date("d/m/Y")));
            $sql = "--Do nguon luoi" . PHP_EOL;
            $sql .= "EXEC W76P2080 '$user', $date,'$status','$faci','1'";
            $rsData = $this->connectionHR->select($sql);
            return json_encode($rsData);
        }
    }

    public function changeStatus()
    {
        if (Request::isMethod("post")) {
            $id = Input::get("id", -1);
            $state = Input::get("app");
            $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
            if ( $id > 0) {
                $rs = $this->checkW76P5555("ED", "W76F2080", "R", $id);
                if ($rs["Status"] == 0) {
                    $sql = "UPDATE 	D76T2030 SET" . PHP_EOL;
                    $sql .= "StatusID =  $state,";
                    $sql .= "ApprovalDate = GETDATE(),";
                    $sql .= "ApprovalUser = '$user',";
                    $sql .= "LastModifyDate	= GETDATE(),";
                    $sql .= "LastModifyUserID= '$user'". PHP_EOL;
                    $sql .= "WHERE 	BookingID = $id";
                    $this->connectionHR->statement($sql);
                    $sql = "--Do nguon 1 dong" . PHP_EOL;
                    $sql .= "EXEC W76P2080 '$user', null, 0 ,'','1', $id";
                    $rsData = $this->connectionHR->selectOne($sql);
                    $rsData["code"]=1;
                    return json_encode($rsData);
                } else
                    return json_encode(["code" => 0, "mess" => $rs["Message"]]);
            }
        }
        return "";
    }


}
