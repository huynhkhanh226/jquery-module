<?php

namespace W4X\W47;

use Debugbar;
use Exception;
use Helpers;
use Request;
use Session;
use View;
use Input;
use Auth;
use W4X\W4XController;

class W47F3001Controller extends W4XController
{
    public function index($task = '')
    {
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $data = json_decode(Input::get('data', ''), true);
        $contractid = Input::get('id', '');
        $cAmount = Input::get('cAmount', 0);
        $amount = Helpers::sqlNumber(Input::get('amount', 0));
        $date = Helpers::convertDate(Input::get('date', ''));
        $param = Input::get('param', '');
        $isOff = Input::get("isOff", 0);
        switch ($task){
            case 'save':

                $sql ="--Xoa du lieu".PHP_EOL;
                $sql .="Delete From D47T9009";
                $sql .=" Where UserID='$userid' and FormID='W47F3001' and [Key01ID]='UpdatePlan'".PHP_EOL;
                $sql .="--Luu bang tam".PHP_EOL;
                for ($i=0;$i<count($data);$i++){
                    $sql .="Insert Into D47T9009(";
                    $sql .="UserID, FormID, Key01ID, Key02ID, ";
                    $sql .="Key03ID, Key04ID, Num01, Num02, Num03";
                    $sql .=") Values(";
                    $sql .="'$userid', 'W47F3001', 'UpdatePlan',  '$contractid', ";
                    $sql .=" $date,  ".Helpers::convertDate($data[$i]['PlanDate']).", $amount, ".Helpers::sqlNumber($data[$i]['OAmount']);
                    $sql .=",$isOff)";
                }
                $this->connection->statement($sql);
                $mode = 0;
                $sql ="-- Luu du lieu".PHP_EOL;
                $sql .= "EXEC W47P3003 '$userid','".Session::get('Lang')."', 1, N'$param', $cAmount, 'W47F3001', $mode";
                $result = $this->connection->selectOne($sql);
                return json_encode($result);
                break;
            case 'load':
                $mode = 2;
                $sql ="-- Load luoi".PHP_EOL;
                $sql .= "EXEC W47P3003 '$userid','".Session::get('Lang')."', 1, N'$param', $cAmount, 'W47F3001', $mode, $date";
                $result = $this->connection->select($sql);
                return ($result);
                break;
        }
        if (Request::isMethod('post')) {

        }
    }
}
