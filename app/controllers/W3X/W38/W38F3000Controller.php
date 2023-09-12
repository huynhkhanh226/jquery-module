<?php
namespace W3X\W38;

use DebugBar\DebugBar;
use Helpers;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W3X\W3XController;

class W38F3000Controller extends W3XController
{
    public function index($pForm, $g)
    {
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $UserID = Auth::user()->user()->UserID;
        $lang = Session::get('Lang');
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $session = Session::getId();
        $time = $this->LoadFixData("TimeW38F3000");
        $rsStatus = $this->LoadFixData("AppStatusD38");
        $rsFilter= $this->LoadSearchFieldName("W38F3000","W38",$g);
        $sql = "--Combo Ke hoach tong the". PHP_EOL;
        $sql .= "EXEC W38P2025 '$divisionHR' ,'$UserID' , '$session', '$pForm', '$tranMonth', '$tranYear'";
        \Debugbar::info($sql);
        $cbTransID = $this->connectionHR->select($sql);
        \Debugbar::info($cbTransID);
        return View::make("W3X.W38.W38F3000", compact("time","rsStatus","rsFilter","pForm","g", "cbTransID"));
    }

    public function filterData($pForm,$g) {
        $input=Input::all();
        \Debugbar::info($input);
        $tranID = isset($input['slTransIDW38F3000']) ? $input['slTransIDW38F3000']: "";
        $appstatus = isset($input['slAppStatusID']) ? $input['slAppStatusID']: "";
        $search = isset($input['slSearchFieldID']) ? $input['slSearchFieldID']: "";
        $svalue = isset($input["txtSearchValue"])?$this->sqlstring($input["txtSearchValue"]):"";
        $datefrom = Helpers::convertDate($input['datefrom']);
        $dateto = Helpers::convertDate($input['dateto']);
        $status = $input['status']==0?0:1;
        $key = $input['key'];
        $sql="--Do nguon cho form".PHP_EOL;
        $sql .= "EXEC W38P4000 '".Session::get("W91P0000")['HRDivisionID']."','".Auth::user()->user()->UserID."','$pForm','$appstatus',N'$search',N'$svalue',$datefrom,$dateto, $status, '$key', '$tranID'";
        if ($status==0)
        {
            $rs=json_encode($this->connectionHR->select($sql));
            return View::make("W3X.W38.W38F3000_Ajax",compact('pForm','g','rs'));
        }
        else
        {
            return json_encode($this->connectionHR->selectOne($sql));
        }

    }

    public function CheckStatus($pForm,$g) {
        $ProposalID = Input::get('ProposalID');
        $Mode = Input::get('Mode');
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];
        $language = Session::get('Lang');
        $sql = "--Kiem tra truoc khi them " . PHP_EOL;
        $sql .= " EXEC W38P5555 '$divisionhr', $tranmonth, $tranyear,'$userid', 'W38F3000', $Mode, '$language', '$ProposalID', '', '', '', ''";
        $data = $this->connectionHR->select($sql);
        if (count($data) > 0) {
            if ($data[0]["Status"] == "1")
            {
                return json_encode(['CODE' => 1, 'message' => $data[0]["Message"]]);
            } else
            {
                if ($Mode == 0){//Mode xoa de xuat
                    $sql = "--Xoa de xuat " . PHP_EOL;
                    $sql .= " EXEC W38P2002 '$divisionhr', '$userid', 'W38F3000', '$ProposalID'";
                    $result = $this->connectionHR->statement($sql);
                    return json_encode(['CODE' => 0, 'message' => \Helpers::getRS($g,'De_xuat_dao_tao_da_duoc_xoa')]);
                }

                return json_encode(['CODE' => 0, 'message' => '']);
            }
        }

    }
}
