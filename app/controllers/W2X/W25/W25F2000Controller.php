<?php
namespace W2X\W25;

use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W2X\W2XController;

class W25F2000Controller extends W2XController
{
    public function index($pForm, $g)
    {
        $time = $this->LoadFixData("TimeW25F2000");
        $rsStatus = $this->LoadFixData("AppStatusW25F2000");
        $rsFilter= $this->LoadSearchFieldName("W25F2000","W25",$g);
        return View::make("W2X.W25.W25F2000", compact("time","rsStatus","rsFilter","pForm","g"));
    }

    public function filterData($pForm,$g) {
        $input=Input::all();
        $chkIsInStock = (Input::get('chkIsInStock') == null ? 0 : 1);
        $appstatus = isset($input['slAppStatusID'])?$input['slAppStatusID']:"";
        $status =$input['status']==0?0:1;
        $key = $input['key'];
        $sql="--Do nguon cho form".PHP_EOL;
        $sql.="EXEC W25P2000 '".Session::get("W91P0000")['HRDivisionID']."', '". Auth::user()->user()->UserID ."', ".Session::get("W91P0000")['HRTranMonth'].", ".Session::get("W91P0000")['HRTranYear'] . ", '$pForm', '".$input["slSearchFieldID"]."', N'".$input["txtSearchValue"]."', '".$input["slTimeID"]."', $chkIsInStock, '$appstatus', $status, '$key'";
        if ($status==0)
        {
            $rs = $this->connectionHR->select($sql);
            //\Debugbar::info(Session::get("W91P0000"));
            \Debugbar::info($rs);
            return View::make("W2X.W25.W25F2000_Ajax",compact('pForm','g','rs'));
        }
        else
        {
            $rs1 = $this->connectionHR->selectOne($sql);
            return $rs1;
        }
    }
}
