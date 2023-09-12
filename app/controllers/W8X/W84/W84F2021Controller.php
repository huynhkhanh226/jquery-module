<?php
namespace W8X\W84;

use Auth;
use DB;
use Debugbar;
use Input;
use Mail;
use Request;
use Session;
use View;
use Helpers;
use W8X\W8XController;

class W84F2021Controller extends W8XController {
    //L?u + load chi ti?t, l?ch s?
    public function index($pForm,$vou,$g,$isApproval,$applevel=0) {

        $division = $g==4?Session::get("W91P0000")['HRDivisionID']:Session::get("W91P0000")['DivisionID'];
        $database = $g==4?\Helpers::decrypt_userpass(\Config::get("database.sqlsrvHR.database")):\Helpers::decrypt_userpass(Session::get('CONDEFAULT')['database']);
        //Bi?n approvalLevel b? sung theo yêu c?u ch? Thu?n
        $approvalLevel = Input::get("approvalLevel", 0);
        $tranYear = 0;
        $tranMonth = 0;
        $mode = 0;
        $host = 'WEB';//Session::getId();

        if ($g == 4){
            $tranYear = Session::get("W91P0000")['HRTranYear'];
            $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        }else{
            $tranYear = Session::get("W91P0000")['TranYear'];
            $tranMonth = Session::get("W91P0000")['TranMonth'];
        }


        if(Request::isMethod("post")) {
            $mod= substr($pForm,0,3);
            $input=Input::all();
            $sql = "--Thuc hien duyet".PHP_EOL;
            $sql .="EXEC W84P4002 '$division', '".substr($pForm,0,3)."', '".$pForm."', '". Auth::user()->user()->UserID ."', '$vou', ".$input['IsApproval'].", '".date("m/d/Y")."', N'', N'".$this->sqlstring($input['txtAppNotes'])."', '$host', $mode, $tranMonth, $tranYear";
            $rscheck= $this->returnDataOne($sql,$g==4);
            if ($rscheck["Status"] != "0")
                return json_encode(['rs' => 10, 'name' => $rscheck['Message']]); // l?i ko cho phép l?u
            $sql1= "EXEC D84P2020 '$database', '$g', '$mod', '$pForm', '$division', '". Auth::user()->user()->UserID ."', 'WEB', 1, '".Session::get('Lang')."', 1, '".$input['IsApproval']."', $approvalLevel, '$pForm', '$vou','',1";
            $rs=$this->returnDataOne($sql1,$g==4);
            if($rs['IsSendMail']==1) {
                if($rs['IsShowMailScreen']==0) {
                    ob_end_clean();
                    ob_start();
                    Mail::send('mail.default', ['content' => $rs["EmailContent"]], function ($message) use ($rs) {
                        $message->from($rs['EmailSenderAddress'], $rs['EmailSenderAddress']);

                        /*$message->to($rs['EmailReceivedAddress'])
                            ->subject($rs['Subject']);
                        if($rs['EmailCCAddress']!=null)
                            $message->cc($rs['EmailCCAddress']);
                        if($rs['EmailBCCAddress']!=null)
                            $message->bcc($rs['EmailBCCAddress']);*/

                        //Sua lai gui cho nhieu nguoi theo man hinh W09F2190, Theo yeu cau THITHUY, Nhom G4
                        $arrTo = explode(";", trim($rs['EmailReceivedAddress']));
                        foreach ($arrTo as $to) {
                            if (trim($to) != null && trim($to) != '')
                                $message->to(trim($to))->subject($rs['Subject']);
                        }
                        //Thêm ??a ch? CC
                        $arrCC = explode(";", trim($rs['EmailCCAddress']));

                        foreach ($arrCC as $cc) {
                            if (trim($cc) != null && trim($cc) != '')
                                $message->cc(trim($cc));
                        }
                        //Thêm ??a ch? BCC
                        $arrBCC = explode(";", trim($rs['EmailBCCAddress']));
                        foreach ($arrBCC as $bcc) {
                            if (trim($bcc) != null && trim($bcc) != '')
                                $message->bcc(trim($bcc));
                        }

                    });

                    return json_encode(['rs' => 1, 'name' => $rs['ReceivedUserName']]); // ?ã g?i mail
                }

                else {
                    $rs["rs"]=2;
                    $rs["name"]=$rs['ReceivedUserName'];
                    return json_encode($rs);
                }
            }
            else {
                return json_encode(['rs' => 3, 'name' =>'']);  // không g?i mail
            }
        }
        // Thông tin master phi?u
        $query = "-- Do nguon master".PHP_EOL;
        $query .= "EXEC W84P4001 '$division', '". substr($pForm,0,3) ."', '".$pForm."', '$vou', '" . Session::get('Lang') ."',2,'" . Auth::user()->user()->UserID."',$isApproval, $applevel";
        //l?ch s? duy?t
        $query1 = "-- Do nguon Lich su duyet".PHP_EOL;
        $query1 .= "EXEC W84P4001 '$division','". substr($pForm,0,3) ."', '".$pForm."', '$vou', '" . Session::get('Lang') ."',1,'" . Auth::user()->user()->UserID."',$isApproval, $applevel";
        //\Debugbar::info($query1);
        $rs=$this->returnDataOne($query,$g==4);
        //B? sung g?i màn hình l?ch s? duy?t theo ID:103695
        $isCallW09F3030 = $this->isCallW09F3030($pForm, $g);
        if ($isCallW09F3030 == 1){
            //Goi qua man hinh lich su, minh se do nguon sau
            $rsHistory = [];
        }else{
            $rsHistory=$this->returnData($query1,$g==4);
        }


        return View::make("W8X.W84.W84F2021",compact('isCallW09F3030', 'pForm','vou','g','rs','rsHistory'));
    }
}
