<?php

namespace W7X\W76;

use Debugbar;
use Helpers;
use Request;
use Session;
use Symfony\Component\Console\Tests\Input\InputTest;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F2120Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        $userID = Auth::user()->user()->UserID;
        $session = Session::getId();
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $perD76F2120 = $this->getPermission($pForm);
        \Debugbar::info($perD76F2120);
        $lang = Session::get('Lang');
        $session = Session::getId();
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $codeTable = 1;
        $hostID = Session::getId();
        switch ($task) {
            case "":
                $emergencyList = \eHelpers::LoadFixData("W76F2100_Emergency", "Do nguon do khan cap");
                $securityList = \eHelpers::LoadFixData("W76F2100_Security", "Do nguon do bao mat");
                $docGroupList = \eHelpers::LoadDocGroup();
                $caption = $this->getModalTitle("D76F2120");
                return View::make("W7X.W76.W76F2120", compact("docGroupList", "securityList", "emergencyList", 'perD76F2120', 'g', 'pForm', 'caption', 'task'));
                break;
            case "filter":
                //Nhan du lieu
                $txtDocNo = $this->sqlstring(Input::get("txtDocNo", ""));
                $cboDocGroupID = $this->sqlstring(Input::get("cboDocGroupID", ""));
                $txtSearchValue = $this->sqlstring(Input::get("txtSearchValue", ""));

                $dtpReleaseDate1 = Helpers::convertDate(Input::get("dtpReleaseDate1", ""));
                $dtpReleaseDate2 = Helpers::convertDate(Input::get("dtpReleaseDate2", ""));
                $dtpReleaseDate1 = $dtpReleaseDate1 == "null" ? $dtpReleaseDate2 : $dtpReleaseDate1;
                $dtpReleaseDate2 = $dtpReleaseDate2 == "null" ? $dtpReleaseDate1 : $dtpReleaseDate2;

                $dtpEffectDateFrom1 = Helpers::convertDate(Input::get("dtpEffectDateFrom1", ""));
                $dtpEffectDateFrom2 = Helpers::convertDate(Input::get("dtpEffectDateFrom2", ""));

                $dtpEffectDateFrom1 = $dtpEffectDateFrom1 == "null" ? $dtpEffectDateFrom2 : $dtpEffectDateFrom1;
                $dtpEffectDateFrom2 = $dtpEffectDateFrom2 == "null" ? $dtpEffectDateFrom1 : $dtpEffectDateFrom2;

                $dtpEffectDateTo1 = Helpers::convertDate(Input::get("dtpEffectDateTo1", ""));
                $dtpEffectDateTo2 = Helpers::convertDate(Input::get("dtpEffectDateTo2", ""));

                $dtpEffectDateTo1 = $dtpEffectDateTo1 == "null" ? $dtpEffectDateTo2 : $dtpEffectDateTo1;
                $dtpEffectDateTo2 = $dtpEffectDateTo2 == "null" ? $dtpEffectDateTo1 : $dtpEffectDateTo2;


                $cbEmergency = $this->sqlstring(Input::get("cbEmergency", ""));
                $cbSecurity = $this->sqlstring(Input::get("cbSecurity", ""));

                //Chay store lay du lieu
                $sql = "--Do nguon ..." . PHP_EOL;
                $sql .= "EXEC W76P2120 " . PHP_EOL;
                $sql .= " N'$txtDocNo'," . PHP_EOL; //DocNo, nvarchar, NOT NULL
                $sql .= "'$cboDocGroupID'," . PHP_EOL; //DocGroupID, varchar[50], NOT NULL
                $sql .= " N'$txtSearchValue'," . PHP_EOL; //KeyWords, nvarchar, NOT NULL
                $sql .= "$dtpReleaseDate1," . PHP_EOL; //ReleaseDate1, datetime, NOT NULL
                $sql .= "$dtpReleaseDate2," . PHP_EOL; //ReleaseDate2, datetime, NOT NULL
                $sql .= "$dtpEffectDateFrom1," . PHP_EOL; //EffectDateFrom1, datetime, NOT NULL
                $sql .= "$dtpEffectDateFrom2," . PHP_EOL; //EffectDateFrom2, datetime, NOT NULL
                $sql .= "$dtpEffectDateTo1," . PHP_EOL; //EffectDateTo1, datetime, NOT NULL
                $sql .= "$dtpEffectDateTo2," . PHP_EOL; //EffectDateTo2, datetime, NOT NULL
                $sql .= "'$cbEmergency'," . PHP_EOL; //Emergency, varchar[100], NOT NULL
                $sql .= "'$cbSecurity',"; //Security, varchar[100], NOT NULL
                $sql .= "'',"; //Security, varchar[100], NOT NULL
                $sql .= "'$lang'"; //Security, varchar[100], NOT NULL
                try {
                    $rsData = $this->connectionHR->select($sql);
                    return ['status' => 'OKAY', 'data' => $rsData];
                } catch (\Exception $ex) {
                    Helpers::log($ex->getMessage());
                    return ['status' => 'ERROR', 'message' => Helpers::getRS($g, 'Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu')];
                }
                break;
            case "edit":
            case "view":
                $ID = Input::get('ID', '');
                $txtDocNoW76F2121 = Input::get('txtDocNoW76F2121', "");
                $cbDocGroupIDW76F2121 = Input::get('cbDocGroupIDW76F2121', "");
                $cbDivisionIDW76F2121 = Input::get('cbDivisionIDW76F2121', "");
                $ReceiveSendOrganization = Input::get('ReceiveSendOrganization', "");
                $txtSignerW76F2121 = Input::get('txtSignerW76F2121', "");
                $dtpReleaseDate1W76F2121 = Input::get('dtpReleaseDate1W76F2121', "");
                $txtKeyWordW76F2121 = Input::get('txtKeyWordW76F2121', "");
                $dtpEffectDateFrom1W76F2121 = Input::get('dtpEffectDateFrom1W76F2121', "");
                $dtpEffectDateTo1W76F2121 = Input::get('dtpEffectDateTo1W76F2121', "");
                $txtSheftNoW76F2121 = Input::get('txtSheftNoW76F2121', "");
                $txtFloorNoW76F2121 = Input::get('txtFloorNoW76F2121', "");
                $txtPartitionNoW76F2121 = Input::get('txtPartitionNoW76F2121', "");
                $txtFolderNoW76F2121 = Input::get('txtFolderNoW76F2121', "");
                $cbEmergencyW76F2121 = Input::get('cbEmergencyW76F2121', "");
                $cbSecurityW76F2121 = Input::get('cbSecurityW76F2121', "");
                $cbDocTypeW76F2121 = Input::get('cbDocTypeW76F2121', "");
                $txtQuanPageW76F2121 = Input::get('txtQuanPageW76F2121', "");
                $chkIsPublicW76F2121 = Input::get('chkIsPublicW76F2121', "");
                return View::make("W7X.W76.W76F2121", compact( 'cbEmergencyW76F2121','cbSecurityW76F2121','cbDocTypeW76F2121','txtQuanPageW76F2121','chkIsPublicW76F2121','txtSheftNoW76F2121','txtFloorNoW76F2121','txtPartitionNoW76F2121','txtFolderNoW76F2121','txtKeyWordW76F2121','dtpEffectDateFrom1W76F2121','dtpEffectDateTo1W76F2121','txtDocNoW76F2121','cbDocGroupIDW76F2121','cbDivisionIDW76F2121','ReceiveSendOrganization','txtSignerW76F2121','dtpReleaseDate1W76F2121','pForm', 'ID', 'g', 'task'));
                break;
            case "delete":
                //$empCriterionID = Input::get("empCriterionID", "");
                $ID = Input::get('ID', '');
                $mode  = 'D';
                $sql ="--Kiem tra truoc khi xoa".PHP_EOL;
                $sql .= "EXEC W76P5555 " .PHP_EOL;
                $sql .= "'$divisionHR',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "$tranMonth,".PHP_EOL; //TranMonth, int, NOT NULL
                $sql .= "$tranYear,".PHP_EOL; //TranYear, int, NOT NULL
                $sql .= "'$lang',".PHP_EOL; //Language, varchar[2], NOT NULL
                $sql .= "$codeTable,".PHP_EOL; //CodeTable, tinyint, NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'$hostID',".PHP_EOL; //HostID, varchar[50], NOT NULL
                $sql .= "'D',".PHP_EOL; //Mode, varchar[50], NOT NULL
                $sql .= "'W76F2120',".PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //CodeID, varchar[50], NOT NULL
                $sql .= " N'$ID',".PHP_EOL; //Key01ID, nvarchar, NOT NULL
                $sql .= " N'',".PHP_EOL; //Key02ID, nvarchar, NOT NULL
                $sql .= " N'',".PHP_EOL; //Key03ID, nvarchar, NOT NULL
                $sql .= " N'',".PHP_EOL; //Key04ID, nvarchar, NOT NULL
                $sql .= " N'',".PHP_EOL; //Key05ID, nvarchar, NOT NULL
                $sql .= "0,".PHP_EOL; //Num01, decimal, NOT NULL
                $sql .= "0,".PHP_EOL; //Num02, decimal, NOT NULL
                $sql .= "0,".PHP_EOL; //Num03, decimal, NOT NULL
                $sql .= "0,".PHP_EOL; //Num04, decimal, NOT NULL
                $sql .= "0,".PHP_EOL; //Num05, decimal, NOT NULL
                $sql .= "null,".PHP_EOL; //Dat01, datetime, NOT NULL
                $sql .= "null,".PHP_EOL; //Dat02, datetime, NOT NULL
                $sql .= "null,".PHP_EOL; //Dat03, datetime, NOT NULL
                $sql .= "null,".PHP_EOL; //Dat04, datetime, NOT NULL
                $sql .= "null"; //Dat05, datetime, NOT NULL
                \Debugbar::info($sql);
                try{
                    $rsData = $this->connectionHR->selectOne($sql);
                    if ($rsData != null){
                        if (intval($rsData["Status"]) == 0){
                            $sql = '--Thuc hien xoa du lieu'.PHP_EOL;
                            $sql .= "delete from D76T2091  where DocID = '$ID'" . PHP_EOL;
                            $sql .= "update [dbo].[D76T2090] set [Deleted] = 1 where ID = '$ID'" . PHP_EOL;
                            $this->connectionHR->statement($sql);
                            return json_encode(array('status'=>'SUC'));
                        }else{
                            return json_encode(array('status'=>'CHECKSTORE', 'message'=>$rsData["Message"]));
                        }
                        \Debugbar::info($rsData["Status"]);
                    }else{
                        return json_encode(array('status'=>'ERROR', 'message'=>\Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")));
                    }
                }catch (\Exception $ex){
                    return json_encode(array('status'=>'ERROR', 'message'=>\Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")));
                }
                break;
        }
    }
}
