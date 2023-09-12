<?php
namespace W0X\W05;

use Auth;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Helpers;

class W05F1621Controller extends \W0X\W0XController
{

    public function index($pForm, $g)
    {
        $listStatus =$this->LoadFixData('SOStatus',$g);
        $listTime = $this->LoadFixData("SOTimes",$g);
        $listSearch= $this->LoadSearchFieldName($pForm,'D05',$g);

        Helpers::getFromToDate(6,$F,$T);
        \Debugbar::info(Session::get('W91P0000'));
        if(Request::isMethod('post')) {
            $TimeID= Input::get("slTime");
            $StatusID= Input::get("slStatus");
            $SearchID= Input::get("slSearch");
            $StrSearch= Input::get("txtSearch");
            Helpers::getFromToDate($TimeID,$F,$T);
            $sql ="--Do nguon luoi don hang ".PHP_EOL;
            $sql .= "EXEC W05P1621 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."','$TimeID','$StatusID','$SearchID','$StrSearch',$F,$T";
            $listOrder= $this->connection->select($sql);
            $fmqd = Session::get('W91P0000')['D90_ConvertedDecimals'];
            /*for($i=0;$i<count($listOrder);$i++) {
                $listOrder[$i]['VoucherDate']= date('d/m/Y',strtotime($listOrder[$i]['VoucherDate']));
                $listOrder[$i]['TotalAmount']= number_format($listOrder[$i]['TotalAmount'],$fmqd,".",',');
            }*/
            \Debugbar::info($pForm);
            return json_encode($listOrder);
        }

        return View::make("W0X.W05.W05F1621", compact("listTime","listStatus","listSearch",'g','pForm'));
    }
}
