<?php
/**
 * Created by PhpStorm.
 * User: QUYENNGUYEN
 * Date: 05/07/2018
 * Time: 3:52 PM
 */


namespace W7X\W76;

use Carbon\Carbon;
use DB;
use Exception;
use Request;
use View;
use W7X\W7XController;
use Input;
use Helpers;


class W76F2090Controller extends W7XController
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
                $rsData = \eHelpers::LoadDocGroup(true);
                $rsData = json_encode($rsData);

                $levelList = \eHelpers::LoadFixData('W76F2100_Emergency', 'Do nguon cho combo khan cap', true);
                $levelListSecurity = \eHelpers::LoadFixData('W76F2100_Security', 'Do nguon do bao mat', true);

                return View::make("W7X.W76.W76F2090", compact('caption', 'hello', 'levelList', 'levelListSecurity', 'permission', 'pForm', 'g', 'task', 'rsData', 'rsData1'));
                break;
            case "edit":
            case "view":
                $ID = Input::get('ID', '');
                $DocNo = Input::get('DocNo', "");
                $DocGroupID = Input::get('DocGroupID', "");
                $DivisionID = Input::get('DivisionID', "");
                $ReceiveSendOrganization = Input::get('ReceiveSendOrganization', "");
                $Signer = Input::get('Signer', "");
                $ReleaseDate = Input::get('ReleaseDate', "");
                $Emergency = Input::get('Emergency', "");
                $Security = Input::get('Security', "");
                $StatusID = Input::get('StatusID', "");
                $Content = Input::get('Content', "");
                $EffectDateFrom = Input::get('EffectDateFrom', "");
                $EffectDateTo = Input::get('EffectDateTo', "");

                return View::make("W7X.W76.W76F2090_Action", compact('DocNo', 'DocGroupID', 'DivisionID', 'ReceiveSendOrganization', 'Signer', 'ReleaseDate', 'Emergency', 'Security', 'StatusID', 'Content', 'EffectDateFrom', 'EffectDateTo', 'pForm', 'ID', 'g', 'task'));
                break;
            case "add":
                \Debugbar::info('add ');
                return View::make("W7X.W76.W76F2090_Action", compact('pForm', 'g', 'task'));
                break;
            case 'loadGrid':
                $userid = (\Auth::user()->check()) ? \Auth::user()->user()->UserID : \Auth::ess()->user()->UserID;
                $sql = "--Filter Data" . PHP_EOL;
                $sql .= " EXEC W76P2090 '$userid', '$lang'" . PHP_EOL;
                $rsData = $this->connection->select($sql);
                $rsData = json_encode($rsData);
                return View::make("W7X.W76.W76F2090", compact('pForm', 'g', 'task', 'rsData'));
                break;
            case "save":
                $txtDocNoW76F2090 = Input::get("txtDocNoW76F2090", "");
                $txtDocGroupIDW76F2090 = Input::get("txtDocGroupIDW76F2090", "");
                $txtDivisionIDW76F2090 = Input::get("txtDivisionIDW76F2090", "");
                $txtReceiveSendOrganizationW76F2090 = Input::get("txtReceiveSendOrganizationW76F2090", "");
                $txtSignerW76F2090 = Input::get("txtSignerW76F2090", "");
                $txtReleaseDateW76F2090 = Input::get("txtReleaseDateW76F2090", "");
                $txtEmergencyW76F2090 = Input::get("txtEmergencyW76F2090", "");
                $txtSecurityW76F2090 = Input::get("txtSecurityW76F2090", "");
                $txtStatusIDW76F2090 = Input::get("txtStatusIDW76F2090", "");
                $txtContentW76F2090 = Input::get("txtContentW76F2090", "");
                $txtEffectDateFromW76F2090 = Input::get("txtEffectDateFromW76F2090", "");
                $txtEffectDateToW76F2090 = Input::get("txtEffectDateToW76F2090", "");

                try {
                    $sql = "--Them moi du lieu" . PHP_EOL;
                    $sql .= "insert into D76T2090 (DocNo, DocGroupID, DivisionID, ReceiveSendOrganization, Signer, ReleaseDate, Emergency, Security, StatusID, Content, EffectDateFrom, EffectDateTo, CreateUserID, LastModifyUserID, CreateDate, LastModifyDate, ID)" . PHP_EOL;
                    $sql .= "output Inserted.ID values (N'$txtDocNoW76F2090', N'$txtDocGroupIDW76F2090', N'$txtDivisionIDW76F2090', '$txtReceiveSendOrganizationW76F2090', '$txtSignerW76F2090', '$txtReleaseDateW76F2090', '$txtEmergencyW76F2090', '$txtSecurityW76F2090', '$txtStatusIDW76F2090', '$txtContentW76F2090', '$txtEffectDateFromW76F2090', '$txtEffectDateToW76F2090', '$userID', '$userID', getdate(), getdate(), (Select NEWID()))" . PHP_EOL;

                    $result = $this->connection->selectOne($sql);
                    $ID = $result["ID"];
                    $sql = "--Do nguon luoi" . PHP_EOL;
                    $sql .= "SELECT * FROM   DRD02.dbo.D76T2090 where ID = '$ID'" . PHP_EOL;
                    $rsData = $this->connection->selectOne($sql);
                    $rsData = ($rsData);
                    return json_encode(["status" => "SUC", "message" => \Helpers::getRS($g, "ok"), "dataGrid" => $rsData]);

                } catch (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

                break;
            case "delete":
                \Debugbar::info('delete');
                $ID = Input::get('ID', '');
                $sql = "--Thuc hien xoa du lieu" . PHP_EOL;
                $sql .= "delete from D76T2091  where DocID = '$ID'" . PHP_EOL;
                $sql .= "update [dbo].[D76T2090] set [Deleted] = 1 where ID = '$ID'" . PHP_EOL;
                \Debugbar::info($sql);
                try {
                    $this->connection->statement($sql);
                    return json_encode(["status" => "SUC"]);
                    \Debugbar::info($sql);

                } catch (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    \Debugbar::info($ex);
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu"), 'error'=>$ex->getMessage()]);
                }
                break;
            case "filter":


                $txtReceiveSendDateW76F2090 = Input::get('txtReceiveSendDateW76F2090');
                $dateFromReceiveSendDate = Input::get('dateFromReceiveSendDate');
                $dateToReceiveSendDate = Input::get('dateToReceiveSendDate');
                if($txtReceiveSendDateW76F2090 == ""){
                    $dateFromReceiveSendDate = '';
                    $dateToReceiveSendDate = '';
                }

                $DocNo = Input::get('txtDocNoW76F2090', '');
                $DocGroupID = Input::get('txtDocGroupIDW76F2090', '');
                $KeyWord = Input::get('txtKeyWordW76F2090', '');

                $txtEffectDateFromW76F2090 = Input::get('txtEffectDateFromW76F2090');
                $dateFromEffectDateFrom = Input::get('dateFromEffectDateFrom');
                $dateToEffectDateFrom = Input::get('dateToEffectDateFrom');
                if($txtEffectDateFromW76F2090 == ""){
                    $dateFromEffectDateFrom = '';
                    $dateToEffectDateFrom = '';
                }

                $txtEffectDateToW76F2090 = Input::get('txtEffectDateToW76F2090');
                $dateFromEffectDateTo = Input::get('dateFromEffectDateTo');
                $dateToEffectDateTo = Input::get('dateToEffectDateTo');
                if($txtEffectDateToW76F2090 == ""){
                    $dateFromEffectDateTo = '';
                    $dateToEffectDateTo = '';
                }
                $Emergency = Input::get('cbEmergencyW76F2090', '');
                $Security = Input::get('cbSecurityW76F2090', '');

                $sql = "--Do nguon luoi Filter" . PHP_EOL;
                $sql .= "EXEC W76P2090 '$dateFromReceiveSendDate', '$dateToReceiveSendDate', '$DocNo', '$DocGroupID', '$KeyWord', '$dateFromEffectDateFrom', '$dateToEffectDateFrom', '$dateFromEffectDateTo', '$dateToEffectDateTo','$Emergency', '$Security', '','$lang'";
                \Debugbar::info($sql);
                try{
                    $rsFilter = $this->connection->select($sql);
                    $rsFilter = json_encode($rsFilter);
                    return View::make("W7X.W76.W76F2090_Grid", compact('pForm', 'g', 'task', 'permission', 'rsFilter'));
                }catch (Exception $ex){
                    Helpers::log($ex->getMessage());
                    return $ex->getMessage();
                }

                break;
        }
    }
}