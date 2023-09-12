<?php

namespace W4X\W47;

use Config;
use Debugbar;
use Exception;
use File;
use Helpers;
use Lang;
use Mail;
use Request;
use Session;
use View;
use Input;
use Auth;
use W4X\W4XController;

class W47F3002Controller extends W4XController
{
    public function index($mode = 0)
    {
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $lang = Session::get('Lang');
        if (Request::isMethod('post')) {
            if ($mode == 1) {//Lọc
				//Do nguon cho cot dong

                $isSendMail = Input::get("chkIsSendMail", "off") == 'on' ? 1 : 0;
                $status = Input::get("slStatus", "");
				$planType = Input::get("planType", "%");
                $parameter = Input::get("parameter", "");
                $datef = Helpers::convertDate(Input::get("datef", ""));
                $datet = Helpers::convertDate(Input::get("datet", ""));
				$unit = Input::get("unit", '');
				$isPlan = intval(Input::get("isPlan", 0));
				$sql = "--Do nguon cot dong" . PHP_EOL;
				$sql .= "EXEC W47P3002 '$userid','$lang', $datef, $datet, '$parameter',1,$isPlan,'$unit','W47F3002', 0, null, null, '', '$planType'";
				$rsCol = $this->connection->select($sql);


                $sql = "--Do nguon luoi" . PHP_EOL;
                $sql .= "EXEC W47P3002 '$userid','$lang', null, null,'$parameter',3,0, '1', 'W47F3002', $isSendMail, $datef, $datet, '$status', '$planType'";
                $rsData = json_encode($this->connection->select($sql));
				//return json_encode($this->connection->select($sql));
				return View::make('W4X.W47.W47F3002_Grid', compact('rsData', 'rsCol'));
            } elseif ($mode == 2) {//Hủy giả định
                $data = json_decode(Input::get('dataModal', ''), true);
                $sql = "--Xoa du lieu" . PHP_EOL;
                $sql .= "Delete From D47T9009";
                $sql .= " Where UserID='$userid' AND	FormID = 'W47F3002' AND Key01ID = 'CancelPlan' " . PHP_EOL;
                for ($i = 0; $i < count($data); $i++) {
                    $transid = $this->sqlstring($data[$i]['TransID']);
                    $contractid = $this->sqlstring($data[$i]['ContractID']);
                    $sql .= "--Luu bang tam" . PHP_EOL;
                    $sql .= "Insert Into D47T9009(";
                    $sql .= "UserID, FormID, Key01ID, Key02ID, Key03ID";
                    $sql .= ") Values(";
                    $sql .= "'$userid', 'W47F3002', 'CancelPlan', '$contractid', '$transid'";
                    $sql .= ")" . PHP_EOL;
                }
                $this->connection->statement($sql);
                $sql = "--Luu du lieu" . PHP_EOL;
                $sql .= "EXEC W47P3003 '$userid','$lang', '1', '',0, N'W47F3002', 1";
                $result = $this->connection->selectOne($sql);
                return json_encode($result);
            } elseif ($mode == 'setisoff'){
                $transid = Input::get("transID", "");
                $isOff = Input::get("isOff", 0);
                $sql = "--set IsOff" . PHP_EOL;
                $sql .= "EXEC W47P3008 '$userid','$lang', 0, $isOff, '$transid'";
                try{
                    //\Debugbar::info($this->connection->select($sql));
                    //$this->connection->statement($sql);
                    return json_encode(['status'=>'OKAY', 'data'=>$this->connection->select($sql)]);
                }catch (Exception $ex){
                    return json_encode(['status'=>'FAILED', 'message'=>Helpers::getRS(2, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu"), 'error'=>$ex->getMessage()]);
                }


            } else {
                //Gởi mail, xuất file excel
                $data = json_decode(Input::get('dataModal', ''), true);
                $title = json_decode(Input::get('title', []), true);
                $dataIndx = json_decode(Input::get('dataIndx', []), true);
                $align = json_decode(Input::get('align', []), true);
                $format = json_decode(Input::get('format', []), true);
                $to = str_replace('"', '', Input::get('mailto', ''));
                $userTo = str_replace('"', '',Input::get('userid', ''));
                $cc = Input::get('txtEmailCCAddress', '');
                $bcc = Input::get('txtEmailBCCAddress', '');
                $subject = Input::get('txtEmailTitle', '');
                $content = Input::get('txtEmailContent', '');
                $file = $this->ExportExcel($title, $data, $format, $dataIndx, $align, "PaymentPlan");
                //Send mail
                if ($to != '') {
                    try {
                        Mail::send('mail.default', ['content' => $content], function ($message) use ($to, $cc, $bcc, $subject, $file) {
                            $sender = Helpers::decrypt_userpass(Config::get('mail.username'));
                            $message->from($sender, Auth::user()->user()->UserNameU);
                            $arrTo = explode(";", trim($to));
                            foreach ($arrTo as $row) {
                                if (trim($row) != null && trim($row) != '')
                                    $message->to(trim($row))->subject($subject);
                            }
                            //Thêm địa chỉ CC
                            $arrCC = explode(";", trim($cc));
                            foreach ($arrCC as $row) {
                                if (trim($row) != null && trim($row) != '')
                                    $message->cc(trim($row));
                            }
                            //Thêm địa chỉ BCC
                            $arrBCC = explode(";", trim($bcc));
                            foreach ($arrBCC as $row) {
                                if (trim($row) != null && trim($row) != '')
                                    $message->bcc(trim($row));
                            }
                            $message->attach($file);
                        });
                    } catch (Exception $ex) {
                        return json_encode(["code" => 0, "mess" => Lang::get('message.Co_loi_xay_ra_khi_gui_mail') . '<br>' . $ex->getMessage()]);
                    }
                    //Lưu bảng D47T2720
                    $arrTransID = array();
                    for ($i = 0; $i < count($data); $i++) {
                        $arrTransID[] = $this->sqlstring($data[$i]['TransID']);
                    }
                    $sql = "--Update date" . PHP_EOL;
                    $sql .= "Update D47T2720 Set ";
                    $sql .= "IsApprove = 1,";
                    $sql .= "ToUserID  = '$userTo',";
                    $sql .= "ApproveUserID =  '$userid',";
                    $sql .= "ApproveDate = getdate()";
                    $sql .= " Where ";
                    $sql .= "TransID IN (" . implode(",", $arrTransID) . ")";
                    $this->connection->statement($sql);
                    $filename = basename($file);
                    //Xóa file tạm
                    File::delete(Config::get('app.path_export') . '/' . $filename);
                    if (count(Mail::failures()) > 0) {
                        return json_encode(["code" => 0, "mess" => Lang::get('message.Co_loi_xay_ra_khi_gui_mail')]);
                    } else
                        return json_encode(["code" => 1, "filename" => $filename]);
                }
            }

        } else {
            $g = 1;
            $title3002 = $this->getModalTitle('W47F3002');
            $arrayField = json_decode(Input::get("array", ''), true);
            $unit = $arrayField["slMoneyUnitID"];
            $parameter = Input::get("parameter", "");
            $isPlan = intval(Input::get("isPlan", 0));
            $datefrom = $arrayField['datef'];
            $dateto = $arrayField['datet'];
            $textunit = $arrayField["textunit"];
            /*$sql = "--Do nguon cot dong" . PHP_EOL;
            $sql .= "EXEC W47P3002 '$userid','$lang', '$datefrom', '$dateto', '$parameter',1,$isPlan,'$unit','W47F3002'";
            $rsCol = $this->connection->select($sql);*/
            $sql = "--Do nguon mail" . PHP_EOL;
            $sql .= "EXEC W47P3004 '$userid', N'$parameter'";
            $rsMail = $this->connection->selectOne($sql);
            $sql = "--Do nguon To" . PHP_EOL;
            $sql .= "SELECT UserID, UserNameU AS UserName, Email" . PHP_EOL;
            $sql .= "FROM LEMONSYS..D00T0030 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE Disabled = 0 and Email <> ''" . PHP_EOL;
            $resTo = $this->connection->select($sql);
            $sql ="--Do nguon trang thai".PHP_EOL;
            $sql .= "EXEC W47P3001 '$userid', 'Status','$lang'";
            $status = $this->connection->select($sql);
			$sql ="--Do nguon Plan type".PHP_EOL;
			$sql .= "EXEC W47P3001 '$userid', 'PlanType','$lang'";
			$planType = $this->connection->select($sql);
            $per3002 = $this->getPermission('D47F5610');
            return View::make('W4X.W47.W47F3002', compact('title3002', 'g', 'rsMail', 'parameter', 'isPlan','unit', 'textunit', 'per3002', 'resTo', 'status', 'planType'));
        }
    }
}
