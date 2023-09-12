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

class W15F2170Controller extends W1XController {
    //xuat excel
    public function common($task){
        $sql = "--Lay dinh dang so le".PHP_EOL;
        $sql .= " SELECT LeaveQtyDecimals FROM D15T0000".PHP_EOL;
        $rsTemp= $this->connectionHR->select($sql);
        $decimals = 2;
        if (count($rsTemp) > 0){
            $decimals =  $rsTemp[0]["LeaveQtyDecimals"];
        }
        switch($task){
            case 'loadpopupExcel':
                $rs =json_encode([]);
                $AppStatus= $this->LoadFixData('AppStatusD15_01');
                return View::make('W1X.W15.W15F2170exportexcel', compact('AppStatus', 'rs'));
                break;
            case 'xuatRaFileEX':
                $datefrom = Helpers::convertDate(Input::get('datefrom'));
               // \Debugbar::info($datefrom);
                //\Debugbar::info(DateTime::createFromFormat('d/m/Y', Input::get('datefrom')));
                $dateto = Helpers::convertDate(Input::get('dateto'));
                //$divisionID = Session::get("W91P0000")['HRDivisionID'];
                $userid =  Auth::user()->user()->UserID;
               // \Debugbar::info($userid);
                $trangthai = Input::get('trangThai');
               // \Debugbar::info($trangthai);
                $sql = "EXEC W15P2175 ". $datefrom ." ," .$dateto. ",  '".$userid."', '".$trangthai."'";
                $data = $this->connectionHR->select($sql);

                \Debugbar::info($data);
                $rs = json_encode($data);

                return $rs;
                break;
            default:
                break;
        }
    }
    public function index($pForm,$g,$isApproval=0,$id='',$iddt='') {
        $AppStatus= $this->LoadFixData('AppStatusD15');
        $Time= $this->LoadFixData('TimeD15');
        try {
            $modalTitle="";
            $listColumn=[];
            $detail=[];

            $modalTitle= $this->getModalTitleG4($pForm);

            //$SQLData = $mrow['SQLData'];
            if(Request::isMethod("post") ) {
                $AppStatusID= intval(Input::get('isApproval'));
                $TimeID=intval(Input::get('FromTo'));
                $SQLData = "EXEC W15P2170 '". Auth::user()->user()->UserID ."', '". Auth::user()->user()->HREmployeeID ."', ".Session::get("W91P0000")['HRTranMonth'].", ".Session::get("W91P0000")['HRTranYear'].","  .  $AppStatusID . "," . $TimeID;
                $detail=$this->connectionHR->select($SQLData);
            }
        }catch (Exception $e) {
            Debugbar::info($e);
        }
        if(Request::isMethod("post") ) {
            return View::make("W1X.W15.W15F2170_LeftAjax",compact('detail','isApproval','g','AppStatus','AppStatusID','Time','TimeID'));
        }
        else
            return View::make("W1X.W15.W15F2170",compact('modalTitle','detail','listColumn','index','isApproval','g','pForm','AppStatus',"Time","id","iddt"));
    }

    public function detail($eid,$asid,$tid) {
        $sql = "--Lay dinh dang so le".PHP_EOL;
        $sql .= " SELECT LeaveQtyDecimals FROM D15T0000".PHP_EOL;
        $rsTemp= $this->connectionHR->select($sql);
        $decimals = 2;
        if (count($rsTemp) > 0){
            $decimals =  $rsTemp[0]["LeaveQtyDecimals"];
        }
        $g=4;
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];


        $sql1= "Exec W15P2173 '".Session::get("W91P0000")['HRDivisionID']."','". Auth::user()->user()->UserID ."','$eid',".Session::get("W91P0000")['HRTranMonth'].", ".Session::get("W91P0000")['HRTranYear'] . ",'".Session::get("Lang")."',0";
        $rs1=$this->connectionHR->select($sql1);

        $sql2= "Exec W15P2173 '".Session::get("W91P0000")['HRDivisionID']."','". Auth::user()->user()->UserID ."','$eid',".Session::get("W91P0000")['HRTranMonth'].", ".Session::get("W91P0000")['HRTranYear']. ",'".Session::get("Lang")."',1";
        $rs2=$this->connectionHR->select($sql2);

        $sql3= "Exec W15P2173 '".Session::get("W91P0000")['HRDivisionID']."','". Auth::user()->user()->UserID ."','$eid',".Session::get("W91P0000")['HRTranMonth'].", ".Session::get("W91P0000")['HRTranYear']. ",'".Session::get("Lang")."',2";
        $rs3=$this->connectionHR->select($sql3);

        return View::make("W1X.W15.W15F2170_DTAjax",compact('decimals',"rs1",'rs2','rs3','asid','tid','g','tranmonth','tranyear','decimal1','decimal2','decimal3'));
    }

    // thông tin nhân viên

    public function employInfo($eid,$asid,$tid)
    {
        $sql= "Exec W15P2171 '". Auth::user()->user()->UserID ."','$eid',".Session::get("W91P0000")['HRTranMonth'].", ".Session::get("W91P0000")['HRTranYear'].",$asid,$tid";
        $rs= DB::connection('sqlsrvHR')->selectOne($sql);
        $countW15 = count($rs);
		return View::make('layout.component.employW15',compact('rs','countW15'));
	}

    // Approve
    public function listApproval($eid,$asid,$tid)
    {
        $sql = "--Lay dinh dang so le".PHP_EOL;
        $sql .= " SELECT LeaveQtyDecimals FROM D15T0000".PHP_EOL;
        $rsTemp= $this->connectionHR->select($sql);
        $decimals = 2;
        if (count($rsTemp) > 0){
            $decimals =  $rsTemp[0]["LeaveQtyDecimals"];
        }
        if(Request::isMethod("post")) {
            \Debugbar::info('sdfsdf');
            $mode=Input::get('mode');
            if ($mode=="app")
            {
                $input=Input::all();
                //Kiểm tra hợp lệ trước khi lưu
                $sql1= "EXEC W15P5555 '".Session::get("W91P0000")['HRDivisionID']."', ".Session::get("W91P0000")['HRTranMonth'].", ".Session::get("W91P0000")['HRTranYear'].", '".Session::get('Lang')."', '".Auth::user()->user()->UserID."', '".$input['IsApproval']."', 'W15F2170', '$eid', '".$input['tranid']."'";

                \Debugbar::info($sql1);
                $rsCheck= $this->connectionHR->selectOne($sql1);
                if (intval($rsCheck["Status"])==1)
                {
                    return json_encode(['rs' => 10, 'message' => $rsCheck["Message"]]);
                }
                $sql1 = "--Lưu dữ liệu".PHP_EOL;
                $sql1 .= "EXEC W15P2172  '".Session::get("W91P0000")['HRDivisionID']."', ".Session::get("W91P0000")['HRTranMonth'].", ".Session::get("W91P0000")['HRTranYear'].", 'W15F2170', '".$input['tranid']."', N'".$input['txtAppNotes']."', '$eid', '".$input['IsApproval']."', '". Auth::user()->user()->UserID ."'";

                \Debugbar::info($sql1);
                $rs= $this->connectionHR->select($sql1)[0];
                if($rs['IsSendMail']==1) {
                    if($rs['IsShowMailScreen']==0) {
                        $res = $this->SendMailAuto($rs['EmailContent'],$rs);
                        return json_encode(['rs' => 1,'message'=>$res]); // Luôn trả về message, nếu $res=='' là gởi thành công
                    }
                    else {
                        return json_encode(['rs' => 2, 'rsvalue' => View::make('layout.sendmail',compact('rs'))->render()]);
                    }
                }
                else {
                    return json_encode(['rs' => 3, 'name' =>'']);  // không gửi mail
                }
            }
        }
        else
        {

            Debugbar::info($asid);
            $g=4;
			$statusApproval = $asid;
            $sql= "Exec W15P2171 '". Auth::user()->user()->UserID ."','$eid',".Session::get("W91P0000")['HRTranMonth'].", ".Session::get("W91P0000")['HRTranYear'].",$asid,$tid";
            $rs= DB::connection('sqlsrvHR')->select($sql);
            return View::make('W1X.W15.W15F2170_ListApproval',compact('rs','g','statusApproval','decimals'));
        }
    }

    function saveApprove(){
        //Debugbar::info('sddsfds');
        $obj = Input::get("obj");
        $HREmployeeID = Auth::user()->user()->HREmployeeID;

        $userID = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $language = Session::get('Lang');
        $sql = "--Xoa bang tam".PHP_EOL;
        $sql .= " set nocount on".PHP_EOL;
        $sql .= " DELETE D09T6666 WHERE UserID = '$userID' AND HostID= 'WEB' AND FormID = 'W15F2170'".PHP_EOL;
        $sql .= "--Insert bang tam".PHP_EOL;
        foreach ($obj as $key => $row) {
            $approve = $row['Approval'];
            $notApprove = $row['NotApproval'];
            $transID = $row['TransID'];
            $noteApp = $this->sqlstring($row['NoteApp']);
            if ($approve == 1 || $notApprove == 1){
                $sql .= " INSERT INTO D09T6666(UserID, HostID, FormID, Num01, Num02, Key01ID, Str01) VALUES ('$userID', 'WEB', 'W15F2170', $approve, $notApprove, '$transID',N'$noteApp')".PHP_EOL;
            }
        }
        //Debugbar::info($sql);
        $sql .= "--Kiem tra truoc khi luu".PHP_EOL;
        $sql .= " EXEC W15P5555 '$divisionhr', $tranMonth, $tranYear, '$language', '$userID', 0, 'W15F2170','$HREmployeeID',''".PHP_EOL;


        //Debugbar::info($sql);
        $data = $this->connectionHR->select($sql);
        //Debugbar::info(count($data));
        if (count($data) > 0) {
            if ($data[0]["Status"] == "1")
            {
                return json_encode(['Status' => 0, 'message' => $data[0]["Message"]]);
            } else
            {
                //DB::beginTransaction();
                try {
                    //$sql = "BEGIN TRAN" . PHP_EOL;
                    $sql = "--Luu du lieu " . PHP_EOL;
                    $sql .= " EXEC W15P2172  '$divisionhr', $tranMonth, $tranYear, 'D15F2170', 'nouse', '', '', 0, '$userID'". PHP_EOL;
                    //$sql .= "ROLLBACK" . PHP_EOL;

                    $rsData= $this->connectionHR->select($sql);
                    //\Debugbar::info($rsData);


                    //DB::commit();
                    if($rsData[0]['IsSendMail']==1) {
                        //Thuc hien gui mail ngam truoc
                        $emailNoShow = array_filter($rsData, function($row){
                            return $row["IsShowMailScreen"] == 0;
                        });
                        foreach ($emailNoShow as $rs){
                            $res = $this->SendMailAuto($rs['EmailContent'],$rs);
                            if ($res != ""){//Neu gui mail co loi thi se khong lam gi nua. return ve view thong bao
                                return json_encode(['Status' => 1,'message'=>$res]);
                            }
                        }
                        $emailShow = array_filter($rsData, function($row){
                            return $row["IsShowMailScreen"] == 1;
                        });

                        if (count($emailShow) > 0){
                            $rs = $emailShow[0];
                            return json_encode(['Status' => 2, 'rsvalue' => View::make('layout.sendmail',compact('rs'))->render()]);
                        }else{
                            return json_encode(['Status' => 1,'message'=>'']);
                        }
                    }
                    else {
                        return json_encode(['Status' => 3, 'name' =>'']);  // không gửi mail
                    }


                    /*$rs= $this->connectionHR->select($sql)[0];
                    //DB::commit();
                    if($rs['IsSendMail']==1) {
                        if($rs['IsShowMailScreen']==0) {
                            $res = $this->SendMailAuto($rs['EmailContent'],$rs);
                            return json_encode(['Status' => 1,'message'=>$res]); // Luôn trả về message, nếu $res=='' là gởi thành công
                        }
                        else {
                            return json_encode(['Status' => 2, 'rsvalue' => View::make('layout.sendmail',compact('rs'))->render()]);
                        }
                    }
                    else {
                        return json_encode(['Status' => 3, 'name' =>'']);  // không gửi mail
                    }*/
                }catch (\Exception $e) {
                    //DB::rollback();
                    return json_encode(['Status' => 4, 'message' =>$e->getMessage()]);
                    //array_push($results, ['Status' => 4, 'message' =>$e->getMessage()]);
                }

                //\Debugbar::info($results);
                //return json_encode($results);

            }
        }

    }
}
