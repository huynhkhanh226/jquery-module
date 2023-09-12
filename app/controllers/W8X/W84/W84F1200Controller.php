<?php
namespace W8X\W84;

use Auth;
use DB;
use Helpers;
use Input;
use Mail;
use Config;
use Request;
use Session;
use View;
use W8X\W8XController;
use Debugbar;

class W84F1200Controller extends W8XController {
    public function index($pForm,$g) {
        try {
            $modalTitle="";
            $modalTitle= $this->getModalTitle($pForm);
            if(Request::isMethod('post')) {
                $sql="--Do nguon grid ".PHP_EOL;
                $sql.= "EXEC W84P1202 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."','$pForm'";
                $grid=$this->connection->select($sql);
                $numline= Input::get("numline");
                return View::make('W8X.W84.W84F1200_ajax',compact('grid','numline','g'));
            }
            $sqlTran= "--combo quy trình duyệt" . PHP_EOL ;
            $sqlTran .= "EXEC W84P1200 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."'";
            $transaction=$this->connection->select($sqlTran);

            if(Request::isMethod("post")) {

            }
        }catch (Exception $e) {

        }
        return View::make("W8X.W84.W84F1200",compact('modalTitle','transaction','pForm','g'));
    }

    public function p1203($pForm,$g,$mode,$vou='null') {
        $maindb=Session::get('companyID');
        $subdb= Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
        $sql ="--Do nguon master".PHP_EOL;
        $sql .= "EXEC W84P1203 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."','$pForm',".$vou.",$mode,'$maindb','$subdb'";
        $row=DB::connection('CONDEFAULT')->selectOne($sql);
        return json_encode($row);
    }

    public function p1201($pForm,$type,$mod) {
        $g=0;
        $maindb=Session::get('companyID');
        $subdb= Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
        $sql ="--Do nguon form danh sach nguoi dung".PHP_EOL;
        $sql .= "EXEC W84P1201 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."','$pForm','$type',$mod,'$maindb','$subdb'";
        $listperson= DB::connection('CONDEFAULT')->select($sql);
        return View::make("W8X.W84.W84F1200_listperson",compact('listperson','type','g'));
    }

    public function saveauthorize($pForm,$mod,$vou='null') {
        if(Request::isMethod("post")) {
            $all=Input::all();
            $tranid= $all['tranid'];
            $authorizeid= $all['authorizeid'];
            $authorizedid= $all['authorizedid'];
            $startDate = $all['startDate'];
            $NotesU = $all['NotesU'] ;
            $creatorid= $all['creatorid'];
            $mode= $mod==0 ? "ADDNEW" : 'CANCEL';

            $sql ="-- kiem tra luu uy quyen ".PHP_EOL;
            if(isset($all['endDate']) && $all['endDate']!='') {
                $endDate=$all['endDate'];
                $sql .= "EXEC W84P5555 '" . Session::get("W91P0000")['DivisionID'] . "','" . Auth::user()->user()->UserID . "','Web','" . Session::get('Lang') . "',0,'$pForm','Authorize','$tranid','$authorizeid','$authorizedid','',0,0,0,0,0,'$startDate','$endDate',null,null,null";
            }
            else {
                $sql .= "EXEC W84P5555 '" . Session::get("W91P0000")['DivisionID'] . "','" . Auth::user()->user()->UserID . "','Web','" . Session::get('Lang') . "',0,'$pForm','Authorize','$tranid','$authorizeid','$authorizedid','',0,0,0,0,0,null,null,null,null,null";
            }
            $result= DB::connection('CONDEFAULT')->selectOne($sql);

            if($result['Status']==0) {
                try {
                    $sqlAdd="-- luu uy quyen" . PHP_EOL;
                    $sqlAdd.="INSERT INTO D84T1200(TransactionID,AuthorizeUserID,AuthorizedUserID,ValidTimeFrom,ValidTimeTo,NotesU,CreateUserID,CreateDate,LastModifyUserID,LastModifyDate,PrepareBy)";
                    if(isset($all['endDate'])&& $all['endDate']!='') {
                        $endDate=$all['endDate'];
                        $sqlAdd.= " VALUES('$tranid','$authorizeid','$authorizedid','$startDate','$endDate',N'".$this->sqlstring($NotesU)."','".Auth::user()->user()->UserID."',Getdate(),'".Auth::user()->user()->UserID."',Getdate(),'$creatorid')";
                    }
                    else
                        $sqlAdd.= " VALUES('$tranid','$authorizeid','$authorizedid','$startDate',null,N'".$this->sqlstring($NotesU)."','".Auth::user()->user()->UserID."',Getdate(),'".Auth::user()->user()->UserID."',Getdate(),'$creatorid')";
                    DB::connection('CONDEFAULT')->statement($sqlAdd);

                    $sql ="-- Xu ly uy quyen ".PHP_EOL;
                    $sql .= "EXEC W84P1205 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."',$vou,'$mode'";
                    DB::connection('CONDEFAULT')->statement($sql);
                    return 1;
                }catch (\Exception $ex) {
                    return $ex->getMessage();
                }
            }
            else {
                return $result['Message'];
            }
        }
    }

    public function cancelauthorize($pForm,$mod,$vou='null') {
        $g=0;
        if(Request::isMethod('post')) {
            $validTime= Input::get('ValidTimeTo');
            $CancelUserID= Input::get('CancelUserID');
            $CancelNotesU= Input::get('CancelNotesU');

            $sql ="-- kiem tra huy uy quyen ".PHP_EOL;
            $sql .= "EXEC W84P5555 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."','Web','".Session::get('Lang')."',0,'$pForm','CancelAuthorize','','','','',$vou,0,0,0,0,'$validTime',null,null,null,null";
            $result= DB::connection('CONDEFAULT')->selectOne($sql);
            if($result['Status']==0) {
                try {
                    $sqlUpdate="-- luu huy uy quyen" . PHP_EOL;
                    $sqlUpdate.=" UPDATE D84T1200 " . PHP_EOL;
                    $sqlUpdate.= "SET IsCancel=1, CancelUserID='".Auth::user()->user()->UserID."',CancelNotesU=N'$CancelNotesU',LastModifyDate=GETDATE(), LastModifyUserID='".Auth::user()->user()->UserID."', CancelledBy='$CancelUserID',CancelDate=GETDATE() " . PHP_EOL;
                    $sqlUpdate.= "WHERE VoucherID='$vou'";

                    DB::connection('CONDEFAULT')->statement($sqlUpdate);

                    $sql ="-- Xu ly huy uy quyen ".PHP_EOL;
                    $sql .= "EXEC W84P1205 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."',$vou,'CANCEL'";
                    DB::connection('CONDEFAULT')->statement($sql);
                    return 1;
                }catch (\Exception $ex) {
                    return $ex->getMessage();
                }
            }
            else {
                return $result['Message'];
            }
        }
        $sql ="--Do nguon form Huy uy quyen".PHP_EOL;
        $sql .= "EXEC W84P1204 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."',$vou,'$mod'";
        $rs=  DB::connection('CONDEFAULT')->selectOne($sql);
        return View::make('W8X.W84.W84F1200_cancelauthorized',compact('rs','mod','g'));
    }

}
