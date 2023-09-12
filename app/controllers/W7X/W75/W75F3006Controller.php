<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 03/11/2017
 * Time: 10:29 AM
 */
namespace W7X\W75;

use Auth;
use DB;
use Exception;
use Input;
use Request;
use Session;
use View;
use W7X\W7XController;
use Debugbar;
use Helpers;
use Config;
use Mail;

class W75F3006Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        $valueGrid = json_encode(array());
        \Debugbar::info($pForm);
        $modalTitle = $this->getModalTitle($pForm);
        $lang = Session::get("Lang");
        //$HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $UserID = Auth::user()->user()->UserID;
        switch ($task) {
            case "":
                $sql = "--do nguon tieu chi thong ke" .PHP_EOL ;
                $sql .= "Exec W75P3009 '$pForm', '$UserID', '$lang'";
                $valueGrid = $this->connectionHR->select($sql);
                \Debugbar::info($valueGrid);
                return View::make("W7X.W75.W75F3006", compact("pForm","valueGrid", "g","modalTitle"));
                break;
            case "save":
                $sql = "";
                $dataSender = Input::get('dataSender');
                for($i =0; $i<count($dataSender); $i++){
                    $Disabled = $dataSender[$i]["Disabled"];
                    $GroupID = $dataSender[$i]["GroupID"];
                    $CriteriaID = $dataSender[$i]["CriteriaID"];
                    $sql .= "--update du lieu" . PHP_EOL;
                    $sql .= " UPDATE D29T3013 " . PHP_EOL;
                    $sql .= " SET Disabled = '$Disabled'". PHP_EOL;
                    $sql .= " WHERE GroupID = '$GroupID' AND CriteriaID = '$CriteriaID'" . PHP_EOL;
                }
                \Debugbar::info($dataSender);
                \Debugbar::info($sql);
                if ($sql != '') {
                    try {
                        $this->connectionHR->statement($sql);
                        return array('status' => 1, 'message' => '');
                    } catch (Exception $ex) {
                        \Debugbar::info($ex);
                        return array('status' => 0, 'message' => $ex->getMessage());
                    }
                } else {
                    return array('status' => 0);
                }
                break;
        }
    }
}