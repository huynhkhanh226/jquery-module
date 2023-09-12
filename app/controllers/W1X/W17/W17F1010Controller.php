<?php
namespace W1X\W17;

use Auth;
use Config;
use DB;
use Debugbar;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W1X\W1XController;

class W17F1010Controller extends W1XController
{
    public function index($pForm, $g, $task = '')
    {
        $lang = Session::get('Lang');
        $divisionID = Session::get("W91P0000")['DivisionID'];
        $userID = Auth::user()->user()->UserID;

        $moduleID = "D17";
        $sessionID = Session::getId();
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $formID = "W17F1010";
        $perD17F1010 = $this->getPermission("D17F1010");
        $title = $this->getModalTitle($pForm);
        switch ($task){
            case '':
                $perW17F1010 = $this->getPermission($pForm);
                $companyIDW17F1010 = Input::get("companyIDW17F1010", ""); //Nhan tu fomr W17F21111
                $sql = "--Combo Tim kiem" . PHP_EOL;
                $sql .= "EXEC W91P1015 '$moduleID', '$divisionID', '$userID', '$formID'";
                $dsSearch = $this->connection->select($sql);
                $assigneeID = Input::get('assigneeID', $userID);

                $sql = "--Do nguon du lieu" . PHP_EOL;
                $sql .= "EXEC W17P1014 '$assigneeID', '$sessionID', '$lang', 9, '$formID', 'CompanyName', N'', '' ";
                $dsFields = $this->connection->select($sql);

                return View::make("W1X.W17.W17F1010", compact('assigneeID', 'title','perD17F1010','dsSearch','task','pForm', 'g','companyIDW17F1010', 'dsFields'));
                break;
            case 'filter':
                $companyIDW17F1010 = Input::get("companyIDW17F1010", "");
                $cboStrSearchW17F1010 = Input::get("cboStrSearchW17F1010", '');
                $txtStrSearchW17F1010 = Input::get('txtStrSearchW17F1010', '');

                $assigneeID = Input::get('assigneeID', $userID);

                $sql = "--Do nguon du lieu" . PHP_EOL;
                $sql .= "EXEC W17P1014 '$assigneeID', '$sessionID', '$lang', 9, '$formID', '$cboStrSearchW17F1010', N'$txtStrSearchW17F1010', '$companyIDW17F1010' ";
                $dsFields = $this->connection->select($sql);

                $mode = 0;

                $sql = "--Do nguon du lieu" . PHP_EOL;
                $sql .= "EXEC W17P1014 '$assigneeID', '$sessionID', '$lang', $mode, '$formID', '$cboStrSearchW17F1010', N'$txtStrSearchW17F1010', '$companyIDW17F1010' ";
                $dsData = $this->connection->select($sql);
                \Debugbar::info($dsData);
                return ['dsFields' => $dsFields, 'dsData' => $dsData];
                break;
            case 'delete':
                $mode = 3;
                $formID = "W17F1011";
                $companyID = Input::get("companyID", "");
                $sql = "--Check before saving" . PHP_EOL;
                $sql .= "EXEC W17P5555 '$lang', '$userID', '$sessionID', $mode, '$formID' , '$companyID', '', '', '', ''";
                $dsCheck = $this->connection->selectOne($sql);
                try {
                    if (intval($dsCheck["Status"]) == 0) {
                        $mode = 1;
                        $sql = "--Thuc thi xoa du lieu" . PHP_EOL;
                        $sql .= "EXEC W17P1014	'$userID', '$sessionID', '$lang', $mode, '$formID', '', '', '$companyID'";
                        $this->connection->statement($sql);
                        return json_encode(['status'=>'OKAY', 'message'=>$dsCheck["Message"]]);

                    }else{
                        return json_encode(['status'=>'CHECKSTORE', 'message'=>$dsCheck["Message"]]);
                    }
                }catch (Exception $ex){
                    return json_encode(['status' => 'ERROR', 'message' => Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }
                break;
        }

    }

}
