<?php
namespace W1X\W15;

use Auth;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Mail;
use Request;
use Session;
use View;
use W1X\W1XController;
use Debugbar;

class W15F1020Controller extends W1XController {
    //xuat excel
    public function index($pForm, $g, $task='')
    {
        $division = Session::get("W91P0000")['HRDivisionID'];
        $hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
        $lang = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];
        $session = Session::getId();
        $valueGrid = [];
        \Debugbar::info($task);
        //$isHideConfirmOT = false;
        switch($task){
            case '':
                //\Debugbar::info("da chay W15F1020");
                $sql = "-- do nguon cho form grid" .PHP_EOL;
                $sql .= "SET NOCOUNT ON SELECT RecCostID, RecCostName,CreateUserID, CreateDate, LastModifyUserID, LastModifyDate" .PHP_EOL;
                $sql .= "FROM D15T1070 WITH(NOLOCK)" .PHP_EOL;
                $sql .= "ORDER BY RecCostID";
                \Debugbar::info($sql);
                $valueGrid = $this->connectionHR->select($sql);
                \Debugbar::info($valueGrid);
                return View::make("W1X.W15.W15F1020", compact('pForm', 'g', 'valueGrid'));
                break;

            case 'save':
                \Debugbar::info(Input::all());
                $RecCostID = Input::get('txtRecCostIDW15F1020');
                $RecCostName = Input::get('txtRecCostNameW15F1020');
                $action = Input::get('actionW15F1020');
                if($action == "add"){//truong hop them moi
                    $sql = "--Kiem tra du lieu truoc khi luu" .PHP_EOL;
                    $sql .= "SELECT Top 1 1" .PHP_EOL;
                    $sql .= "FROM D15T1070 WITH(NOLOCK)" .PHP_EOL;
                    $sql .= "WHERE RecCostID = '$RecCostID'" .PHP_EOL;

                    $rsCheck = $this->connectionHR->select($sql);
                    \Debugbar::info(count($rsCheck));
                    if(intval(count($rsCheck)) == 0){
                        try{
                            $sql1 = "-- Them moi du lieu" .PHP_EOL;
                            $sql1 .= "INSERT INTO D15T1070 ( RecCostID , RecCostName, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate)" .PHP_EOL;
                            $sql1 .= "VALUES ('$RecCostID', N'$RecCostName', '$userid', GetDate(), '$userid', GetDate())" .PHP_EOL;
                            $this->connectionHR->statement($sql1);

                            $sql1 = "SELECT *" .PHP_EOL;
                            $sql1 .= "FROM D15T1070 WITH(NOLOCK)" .PHP_EOL;
                            $sql1 .= "WHERE RecCostID = '$RecCostID'" .PHP_EOL;
                            \Debugbar::info($sql1);
                            $rs = $this->connectionHR->select($sql1);
                            \Debugbar::info($rs);
                            return json_encode(['status' => 'SUCCESS', 'data' => $rs[0]]);
                        }catch (Exception $ex) {
                            return json_encode(['status' => 'ERROR',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                        }
                    }else{
                        \Debugbar::info('da co loi');
                        return json_encode(['status' => 'ERROR', 'message' => Helpers::getRS($g,"Du_lieu_da_ton_tai")]);
                    }
                }
                if($action == "edit"){//truong hop edit
                    $sql = "--update du lieu" .PHP_EOL;
                    $sql .= "UPDATE D15T1070" .PHP_EOL;
                    $sql .= "SET RecCostName = N'$RecCostName'," .PHP_EOL;
                    $sql .= "LastModifyUserID = '$userid'," .PHP_EOL;
                    $sql .= "LastModifyDate = Getdate()" .PHP_EOL;
                    $sql .= "WHERE RecCostID = '$RecCostID'" .PHP_EOL;
                    try{
                        $this->connectionHR->statement($sql);

                        $sql1 = "SELECT *" .PHP_EOL;
                        $sql1 .= "FROM D15T1070 WITH(NOLOCK)" .PHP_EOL;
                        $sql1 .= "WHERE RecCostID = '$RecCostID'" .PHP_EOL;
                        \Debugbar::info($sql1);
                        $rs = $this->connectionHR->select($sql1);
                        \Debugbar::info($rs);
                        return json_encode(['status' => 'SUCCESS', 'data' => $rs[0]]);
                    }catch (Exception $ex) {
                        return json_encode(['status' => 'ERROR',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }
                break;

            case 'delete':
                \Debugbar::info(Input::all());
                $RecCostID = Input::get('RecCostID');
                $sql = "-- Kiem tra truoc khi xoa" .PHP_EOL;
                $sql .= "EXEC W15P5555 '$division','$tranmonth','$tranyear', '$lang', '$userid', 0, 'W15F1020'," .PHP_EOL;
                $sql .= "'$RecCostID', '', '', '', ''," .PHP_EOL;
                $sql .= "0, 0, 0, 0, 0," .PHP_EOL;
                $sql .= "Null, Null, Null, Null, Null" .PHP_EOL;
                \Debugbar::info($sql);
                $rsCheck = $this->connectionHR->select($sql);
                \Debugbar::info($rsCheck);
                if(intval($rsCheck[0]['Status']) == 0){
                    $sql1 = "-- - Xoa du lieu trong bang danh muc chuc vu" .PHP_EOL;
                    $sql1 .= "DELETE FROM D15T1070" .PHP_EOL;
                    $sql1 .= "WHERE RecCostID = '$RecCostID'" .PHP_EOL;

                    try {
                        $this->connectionHR->statement($sql1);
                        return json_encode(['status' => 'SUCCESS']);
                    } catch (Exception $ex) {
                        return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }else{
                    return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> $rsCheck[0]['Message']]);
                }

                break;
            default:
                //Do nothing here
                break;
        }

    }
}
