<?php
namespace W7X\W76;

use Auth;
use Input;
use Request;
use View;
use W7X\W7XController;
use Debugbar;

class W76F2051Controller extends W7XController
{
    public function index($pForm, $g, $task=0)
    {
        $g = 4;
        $user = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $id = Input::get("id", "");

        switch ($task){
            case "add":
                $rsData = [];
                return View::make("W7X.W76.W76F2051", compact('pForm', 'g', "rsData", "id", "task"));
                break;
            case "view":
            case "edit":
                $sql = "--Do nguon form".PHP_EOL;
                $sql .= "SELECT * FROM 	D76T2020 WITH(NOLOCK) WHERE FacilityID = $id";
                $rsData = $this->connectionHR->selectOne($sql);
                return View::make("W7X.W76.W76F2051", compact('pForm', 'g', "rsData", "id", "task"));
                break;
            case "save":
                $all = Input::all();
                $fno = $this->sqlstring(isset($all["txtFacilityNo"])?$all["txtFacilityNo"]:"");
                $fname = $this->sqlstring($all["txtFacilityName"]);
                $des = $this->sqlstring($all["txtDescription"]);
                $loca = $this->sqlstring($all["txtLocation"]);
                //$cafrom = intval($all["txtCapacityFrom"]);
                $cato = intval($all["txtCapacityTo"]);
                $chkdis = isset($all["chkDisabled"])? 1:0;
                $chkblack = isset($all["chkIsBlackboard"])? 1:0;
                $chkpro = isset($all["chkIsProjector"])? 1:0;
                $chkether = isset($all["chkIsEthernet"])? 1:0;
                $chkmicro = isset($all["chkIsMicrophone"])? 1:0;
                $chkpc = isset($all["chkIsPC"])? 1:0;
                $chktel = isset($all["chkIsTeleCon"])? 1:0;
                $chkvideo = isset($all["chkIsVideoCon"])? 1:0;
                $chkwifi = isset($all["chkIsWifi"])? 1:0;
                $img = $all["hdimgW76F2051"];
                $thumb = $all["hdimgThumbW76F2051"];

                $sql = "--Kiem tra ton tai" . PHP_EOL;
                $sql .= "SELECT TOP 1 1 FROM D76T2020 WITH(NOLOCK) WHERE FacilityNo = '$fno'";
                if (count($this->connectionHR->select($sql)) > 0) {
                    return json_encode(["code"=>1]);
                } else {
                    $sql = "--Luu them moi" . PHP_EOL;
                    $sql .= "Insert Into D76T2020(";
                    $sql .= "FacilityNo, FacilityName, Description, Location, CapacityFrom, ";
                    $sql .= "CapacityTo, Disabled, Thumbnail, Image, IsBlackboard, IsProjector, IsEthernet, ";
                    $sql .= "IsMicrophone, IsPC, IsTeleCon, IsVideoCon, IsWifi, CreateDate, CreateUserID, LastModifyDate, LastModifyUserID";
                    $sql .= ") OUTPUT INSERTED.FacilityID Values(";
                    $sql .= " N'$fno',  N'$fname',  N'$des',  N'$loca', 0, ";
                    $sql .= "$cato, $chkdis, '$thumb', '$img', $chkblack, $chkpro, $chkether, ";
                    $sql .= "$chkmicro, $chkpc, $chktel, $chkvideo, $chkwifi, getdate(), '$user', getdate(), '$user'";
                    $sql .= ")";
                    try{
                        $id = $this->connectionHR->selectOne($sql)["FacilityID"];
                        $sql ="--Lay dong vua luu".PHP_EOL;
                        $sql .= "EXEC W76P2050 '$user', 'Room', $id";
                        $out = $this->connectionHR->selectOne($sql);
                        return json_encode(array_merge(["code"=>0],$out));
                    } catch (Exception $ex) {
                        return json_encode(["code"=>2, "mess"=>$ex->getMessage()]);
                    }
                }
                break;
            case "update":
                $all = Input::all();
                $fno = $this->sqlstring(isset($all["txtFacilityNo"])?$all["txtFacilityNo"]:"");
                $fname = $this->sqlstring($all["txtFacilityName"]);
                $des = $this->sqlstring($all["txtDescription"]);
                $loca = $this->sqlstring($all["txtLocation"]);
                //$cafrom = intval($all["txtCapacityFrom"]);
                $cato = intval($all["txtCapacityTo"]);
                $chkdis = isset($all["chkDisabled"])? 1:0;
                $chkblack = isset($all["chkIsBlackboard"])? 1:0;
                $chkpro = isset($all["chkIsProjector"])? 1:0;
                $chkether = isset($all["chkIsEthernet"])? 1:0;
                $chkmicro = isset($all["chkIsMicrophone"])? 1:0;
                $chkpc = isset($all["chkIsPC"])? 1:0;
                $chktel = isset($all["chkIsTeleCon"])? 1:0;
                $chkvideo = isset($all["chkIsVideoCon"])? 1:0;
                $chkwifi = isset($all["chkIsWifi"])? 1:0;
                $img = $all["hdimgW76F2051"];
                $thumb = $all["hdimgThumbW76F2051"];

                $sql ="--Luu edit".PHP_EOL;
                $sql .="Update D76T2020 Set ";
                $sql .="FacilityName =  N'$fname',";
                $sql .="Description =  N'$des',";
                $sql .="Location =  N'$loca',";
                // $sql .="CapacityFrom = $cafrom,";
                $sql .="CapacityTo = $cato,";
                $sql .="Disabled = $chkdis,";
                $sql .="Thumbnail = '$thumb',";
                $sql .="Image = '$img',";
                $sql .="IsBlackboard = $chkblack,";
                $sql .="IsProjector = $chkpro,";
                $sql .="IsEthernet = $chkether,";
                $sql .="IsMicrophone = $chkmicro,";
                $sql .="IsPC = $chkpc,";
                $sql .="IsTeleCon = $chktel,";
                $sql .="IsVideoCon = $chkvideo,";
                $sql .="IsWifi = $chkwifi,";
                $sql .="LastModifyDate = getdate(),";
                $sql .="LastModifyUserID =  '$user'";
                $sql .=" Where ";
                $sql .="FacilityID = $id";
                try{
                    $this->connectionHR->statement($sql);
                    $sql ="--Lay dong vua luu".PHP_EOL;
                    $sql .= "EXEC W76P2050 '$user', 'Room', $id";
                    $out = $this->connectionHR->selectOne($sql);
                    return json_encode(array_merge(["code"=>0],$out));
                } catch (Exception $ex) {
                    return json_encode(["code"=>2, "mess"=>$ex->getMessage()]);
                }
                break;
        }
        /*if (Request::isMethod("get")) {

        } else {
            $all = Input::all();
            $fno = $this->sqlstring(isset($all["txtFacilityNo"])?$all["txtFacilityNo"]:"");
            $fname = $this->sqlstring($all["txtFacilityName"]);
            $des = $this->sqlstring($all["txtDescription"]);
            $loca = $this->sqlstring($all["txtLocation"]);
            //$cafrom = intval($all["txtCapacityFrom"]);
            $cato = intval($all["txtCapacityTo"]);
            $chkdis = isset($all["chkDisabled"])? 1:0;
            $chkblack = isset($all["chkIsBlackboard"])? 1:0;
            $chkpro = isset($all["chkIsProjector"])? 1:0;
            $chkether = isset($all["chkIsEthernet"])? 1:0;
            $chkmicro = isset($all["chkIsMicrophone"])? 1:0;
            $chkpc = isset($all["chkIsPC"])? 1:0;
            $chktel = isset($all["chkIsTeleCon"])? 1:0;
            $chkvideo = isset($all["chkIsVideoCon"])? 1:0;
            $chkwifi = isset($all["chkIsWifi"])? 1:0;
            $img = $all["hdimgW76F2051"];
            $thumb = $all["hdimgThumbW76F2051"];
            try{
                if ($id == "") {//Addnew
                    $sql = "--Kiem tra ton tai" . PHP_EOL;
                    $sql .= "SELECT TOP 1 1 FROM D76T2020 WITH(NOLOCK) WHERE FacilityNo = '$fno'";
                    if (count($this->connectionHR->select($sql)) > 0) {
                        return json_encode(["code"=>1]);
                    } else {
                        $sql = "--Luu them moi" . PHP_EOL;
                        $sql .= "Insert Into D76T2020(";
                        $sql .= "FacilityNo, FacilityName, Description, Location, CapacityFrom, ";
                        $sql .= "CapacityTo, Disabled, Thumbnail, Image, IsBlackboard, IsProjector, IsEthernet, ";
                        $sql .= "IsMicrophone, IsPC, IsTeleCon, IsVideoCon, IsWifi, CreateDate, CreateUserID, LastModifyDate, LastModifyUserID";
                        $sql .= ") OUTPUT INSERTED.FacilityID Values(";
                        $sql .= " N'$fno',  N'$fname',  N'$des',  N'$loca', 0, ";
                        $sql .= "$cato, $chkdis, '$thumb', '$img', $chkblack, $chkpro, $chkether, ";
                        $sql .= "$chkmicro, $chkpc, $chktel, $chkvideo, $chkwifi, getdate(), '$user', getdate(), '$user'";
                        $sql .= ")";
                        $id = $this->connectionHR->selectOne($sql)["FacilityID"];
                    }
                } else {
                    $sql ="--Luu edit".PHP_EOL;
                    $sql .="Update D76T2020 Set ";
                    $sql .="FacilityName =  N'$fname',";
                    $sql .="Description =  N'$des',";
                    $sql .="Location =  N'$loca',";
                   // $sql .="CapacityFrom = $cafrom,";
                    $sql .="CapacityTo = $cato,";
                    $sql .="Disabled = $chkdis,";
                    $sql .="Thumbnail = '$thumb',";
                    $sql .="Image = '$img',";
                    $sql .="IsBlackboard = $chkblack,";
                    $sql .="IsProjector = $chkpro,";
                    $sql .="IsEthernet = $chkether,";
                    $sql .="IsMicrophone = $chkmicro,";
                    $sql .="IsPC = $chkpc,";
                    $sql .="IsTeleCon = $chktel,";
                    $sql .="IsVideoCon = $chkvideo,";
                    $sql .="IsWifi = $chkwifi,";
                    $sql .="LastModifyDate = getdate(),";
                    $sql .="LastModifyUserID =  '$user'";
                    $sql .=" Where ";
                    $sql .="FacilityID = $id";
                    $this->connectionHR->statement($sql);
                }
                $sql ="--Lay dong vua luu".PHP_EOL;
                $sql .= "EXEC W76P2050 '$user', 'Room', $id";
                $out = $this->connectionHR->selectOne($sql);
                return json_encode(array_merge(["code"=>0],$out));
            } catch (Exception $ex) {
                return json_encode(["code"=>2, "mess"=>$ex->getMessage()]);
            }
        }*/
    }
}
