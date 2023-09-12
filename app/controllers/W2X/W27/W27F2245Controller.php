<?php
namespace W2X\W27;
use Auth;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use Debugbar;
use W2X\W2XController;

class W27F2245Controller extends W2XController {

    public function detail($vou,$g,$isApproval) {
        $query=  "EXEC W84P4001 '". Session::get('W91P0000')["DivisionID"] ."', 'D27', 'D27F2245', '$vou', '" . Session::get('Lang') ."',0,'" . Auth::user()->user()->UserID."',".$isApproval;
        $sqla = "EXEC D27P2260 '".Session::get("W91P0000")['DivisionID']."', '" . Auth::user()->user()->UserID."', '".Session::get("Lang") ."', '1', '$vou', 1";
        $sqlb = "EXEC D27P2260 '".Session::get("W91P0000")['DivisionID']."', '" . Auth::user()->user()->UserID."', '".Session::get("Lang") ."', '1', '$vou', 2";
        if($g==4)  {
            $rs=$this->connectionHR->select($query);
            $rsDetaila=$this->connectionHR->select($sqla);
            $rsDetailb=$this->connectionHR->select($sqla);
        }
        else {
            $rs=$this->connection->select($query);
            $rsDetaila=$this->connection->select($sqla);
            $rsDetailb=$this->connection->select($sqlb);
        }

        return View::make("W2X.W27.W27F2245_DTAjax",compact("rs",'rsDetaila','rsDetailb','vou','g'));
    }

    public function customer($vou,$g,$ObjectID,$ObjectTypeID) {
        $query = "EXEC D27P0100 '". Session::get('W91P0000')["DivisionID"] ."', '" . Auth::user()->user()->UserID."', 'WEB', '$ObjectTypeID', '$ObjectID', '','$vou'";
        if($g==4)  {
            $rs=$this->connectionHR->select($query);
        }
        else {
            $rs=$this->connection->select($query);
        }
        return View::make('layout.component.customerpop',compact('rs','g'));
    }

    public function updateSalary($vou) {

        $eff=Input::get('eff');
        $amo=Input::get('amo');
        $approvalLevel=Input::get('approvalLevel', 0);
        $sql = "EXEC D27P2258 '". Session::get('W91P0000')["DivisionID"] ."', '" . Auth::user()->user()->UserID."', '".Session::get("Lang") ."', '$vou', $eff, $amo, $approvalLevel";
        try {
            $this->connection->statement($sql);
        }
        catch(Exception $e){
            return $e->getMessage();
        };
        return 1;

    }
    public function report($vou)
    {
        $ObjectTypeID= Input::get('ObjectTypeID');
        $ObjectID= Input::get('ObjectID');
        $reportid = 'D27R2240';
        $subreport[0] = "D91R0000.rpt"; //array($row['SubReportID'].".rpt");
        $subreport[1] = "D27R2241.rpt"; //array($row['SubReportID'].".rpt");
        $subreport[2] = "D27R0100.rpt"; //array($row['SubReportID'].".rpt");
        $sqlsub[0] = "Select * from D91V0016 Where DivisionID ='". Session::get('W91P0000')["DivisionID"] ."'";
        $sqlsub[1] ="EXEC D27P2259 '".Session::get('W91P0000')["DivisionID"]."', '" . Auth::user()->user()->UserID."', 1, '$vou'";
        $sqlsub[2] ="EXEC D27P0100 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."','WEB','$ObjectTypeID','$ObjectID','SalesVoucher','$vou'";
        $mainsql = "EXEC D27P2243 '".Session::get('W91P0000')["DivisionID"]."', '" . Auth::user()->user()->UserID."', '$reportid', 1, '$vou'";

        $condef= Session::get("CONDEFAULT");
        $url = Helpers::Report($condef,$reportid,$subreport,$mainsql,$sqlsub);
        return View::make("layout.component.pdf-viewer", compact('url','pForm', 'g'));
        //return Helpers::Report($condef,$reportid,$subreport,$mainsql,$sqlsub)	;

    }


}
