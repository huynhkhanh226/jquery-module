<?php

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

class W75F1065Controller extends W7XController
{
    //Khi open tab s? g?i controller này
    public function W75F1065($pForm, $g)
    {

        Debugbar::info(Session::get("W91P0000"));
        $sql = "--Do nguon combo loai phep" . PHP_EOL;
        //$sql = " Select LeaveTypeID, LeaveTypeNameU as LeaveTypeName";
        //$sql .= " From D15T1020 Where Disabled = 0 AND (PersonalLeave = 1 OR (PersonalLeave = 0 AND LeaveID IN ('L020', 'L030', 'L040'))) ORDER BY LeaveTypeName ";
        $sql .= " SELECT		ID AS LeaveTypeID, Name84U AS LeaveTypeName, Number AS " . PHP_EOL;
        $sql .= " LeaveDisplayOrder, LeaveID " . PHP_EOL;
        $sql .= " FROM 		D15N5555 ('D75F1065',  ' ', ' ', ' ', ' ') " . PHP_EOL;
        $sql .= " ORDER BY	LeaveDisplayOrder, LeaveTypeName " . PHP_EOL;
        \Debugbar::info('anhbao test');
        \Debugbar::info($pForm);
        $modalTitle = $this->getModalTitleG4($pForm);
        \Debugbar::info($sql);

        $data = $this->connectionHR->select($sql);

        $sql = "--Lay dinh dang so le" . PHP_EOL;
        $sql .= " SELECT LeaveQtyDecimals FROM D15T0000" . PHP_EOL;
        $rsTemp = $this->connectionHR->select($sql);
        $decimals = 2;
        $stepInput = 1; //step của number input
        if (count($rsTemp) > 0) {
            $decimals = $rsTemp[0]["LeaveQtyDecimals"];
            for ($i = 0; $i < intval($rsTemp[0]["LeaveQtyDecimals"]); $i++) {// chạy vòng lặp để gán step phù hợp vào input
                $stepInput = $stepInput * 0.1;
            }
        }
        return View::make("W7X.W75.W75F1065", compact('pForm', 'g', 'data', 'modalTitle', 'decimals', 'stepInput'));
    }

    //$mod = 0 S? load lu?i l?ch s? duy?t
    //$mod = 1 S? load du?i d? li?u c?p phép + lu?i chi ti?t ngh? phép
    public function ajaxW75F1065($pForm, $g, $mod)
    {

        $divisionhr = Session::get("W91P0000")['HRDivisionID'];
        $hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID : Auth::ess()->user()->HREmployeeID;
        $language = Session::get('Lang');
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        \Debugbar::info('');
        $tranmonth = Session::get("W91P0000")['HRTranMonth'];
        $tranyear = Session::get("W91P0000")['HRTranYear'];
        $sql = "--Lay dinh dang so le" . PHP_EOL;
        $sql .= " SELECT LeaveQtyDecimals FROM D15T0000" . PHP_EOL;
        $rsTemp = $this->connectionHR->select($sql);
        $decimals = 2;
        if (count($rsTemp) > 0) {
            $decimals = $rsTemp[0]["LeaveQtyDecimals"];
        }
        \Debugbar::info(\Helpers::getStringFormat($decimals));
        switch ($mod) {
            case "0": //Du lieu dang ky nghi phep
                Helpers::getFromToDate(2, $firstOfMonth, $lastOfMonth);
                $sql = "--Do nguon cho luoi lich su" . PHP_EOL;
                $sql .= "EXEC W75P2030 '$divisionhr', '$hr_employee_id', $firstOfMonth,  $lastOfMonth, '$language', 1, 'D75F1065'";
                $data = json_encode($this->connectionHR->select($sql));
                $transID = Input::get("transID");
                return View::make("W7X.W75.W75F1065_History", compact('pForm', 'g', 'data', 'transID', 'decimals'));
                break;
            case "1": //Load luoi du lieu phep tong hop
                Helpers::getFromToDate(2, $firstOfMonth, $lastOfMonth);
                $sql = "--Do nguon cho luoi lich su" . PHP_EOL;
                $sql .= "EXEC W15P2066 '$divisionhr', '', 'WEB',  '$userid', 1, 2,'$language ','$hr_employee_id',$tranmonth,$tranyear,'D75F1065'";
                $data1 = json_encode($this->connectionHR->select($sql));
                $sql = "--Do nguon cho luoi chi tiet" . PHP_EOL;
                $sql .= "EXEC W75P2030 '$divisionhr', '$hr_employee_id', $firstOfMonth,  $lastOfMonth, '$language', 3, 'D75F1065'";
                $data2 = json_encode($this->connectionHR->select($sql));
                return View::make("W7X.W75.W75F1065_General", compact('pForm', 'g', 'data1', 'data2', 'tranmonth', 'tranyear', 'decimals'));
                break;

            case "2": //Kiem tra ngay hop le va luu du lieu
                $all = Input::all();
                $transid = $all['hdTransID'];
                $mod = $transid == "" ? 0 : 2;
                $leavetypeid = $all['cboLeaveTypeID'];
                $quantity = Helpers::sqlNumber($all['txtQuantity']);
                $leavedatefrom = date("m/d/Y", strtotime(str_replace('/', '-', $all['txtLeaveDateFromW75F1065'])));
                $leavedateto = date("m/d/Y", strtotime(str_replace('/', '-', $all['txtLeaveDateTo'])));
                $reason = $this->sqlstring($all['txtReason']);
                $note = $this->sqlstring($all['txtNote']);
                $txt1stAbsDayQuan = Helpers::sqlNumber(Input::get("txt1stAbsDayQuan"));
                $txtLastAbsDayQuan = Helpers::sqlNumber(Input::get("txtLastAbsDayQuan"));
                $TransIDW75F1065 = $this->sqlstring($all['TransIDW75F1065']);
                \Debugbar::info($all);
                $leaveID = $all['leaveID'];
                if ($leaveID != 'L090' && $TransIDW75F1065 != "") {//đã lưu thông tin công tác nhưng chọn loại phép khác
                    $sql = "DELETE FROM D15T2050 WHERE TransID = '$TransIDW75F1065'" . PHP_EOL;
                    $this->connectionHR->statement($sql);
                    $sql = "DELETE FROM D15T2051 WHERE TransID = '$TransIDW75F1065'" . PHP_EOL;
                    $this->connectionHR->statement($sql);
                    $TransIDW75F1065 = "";
                }
                $sql = "--Kiem tra truoc khi them " . PHP_EOL;
                $sql .= " EXEC W15P5555 '$divisionhr'	, $tranmonth, $tranyear,'$language', '$userid', 2, 'D75F1065', '$hr_employee_id', '$transid', '$leavetypeid','','', $quantity, $txt1stAbsDayQuan, $txtLastAbsDayQuan,0,0,'$leavedatefrom','$leavedateto',null,null,null";
                $data = $this->connectionHR->select($sql);
                Debugbar::info($sql);
                if (count($data) > 0) {
                    if ($data[0]["Status"] == "1") {
                        return json_encode(['CODE' => 1, 'message' => $data[0]["Message"]]);
                    } else {
                        $sql = "--Luu du lieu " . PHP_EOL;
                        $sql .= "EXEC W75P2031   '$divisionhr', '$userid',  '$transid', '$hr_employee_id','$leavedatefrom','$leavetypeid',$quantity, $mod, N'$reason' , '', N'$note', '', 0, '$leavedateto','D75F1065', $txt1stAbsDayQuan, $txtLastAbsDayQuan, '$TransIDW75F1065'";
                        $data = $this->connectionHR->select($sql);
                        if (count($data) > 0) {
                            $rs = $data[0];
                            if ($rs['IsSendMail'] == 1) {
                                if ($rs['IsShowMailScreen'] == 0) {
                                    $res = $this->SendMailAuto($rs['EmailContent'], $rs);
                                    return json_encode(['CODE' => 2, 'name' => $rs['EmailReceivedAddress'], "message" => $res, "transID" => $transid]); // đã gửi mail
                                } else {
                                    return json_encode(['CODE' => 3, 'name' => $rs['EmailReceivedAddress'], "transID" => $transid, 'rsvalue' => View::make('layout.sendmail', compact('rs'))->render()]);
                                }
                            } else {
                                return json_encode(['CODE' => 4, 'name' => '', "transID" => $transid]);  // không gửi mail
                            }
                        } else {
                            return json_encode(['CODE' => 4, 'name' => '', "transID" => $transid]);  // không gửi mail
                        }
                    }
                }
                break;
            case "3":
                $transid = Input::get("transid");
                $leavetypeid = Input::get("transid");
                $quantity = Input::get("quantity");
                $leavedatefrom = date("m/d/Y", strtotime(str_replace('/', '-', Input::get("leavedatefrom"))));
                $leavedateto = date("m/d/Y", strtotime(str_replace('/', '-', Input::get("leavedateto"))));

                $sql = "--Kiem tra truoc khi them " . PHP_EOL;
                $sql .= " EXEC W15P5555 '$divisionhr', '$language', '$userid',  '', 2, 'D75F1065','$hr_employee_id','$transid','$leavetypeid','','',$quantity,0,0,0,0, '$leavedatefrom', '$leavedateto', null,null,null,'','','','','','','',$tranmonth,$tranyear,1";
                $data = $this->connectionHR->select($sql);
                if (count($data) > 0) {
                    if ($data[0]["Status"] == "1") {
                        return $data[0]["Message"];
                    } else {
                        return "OK";
                    }
                } else {
                    return "OK";
                }

            case "4": //Hủy
                $transid = Input::get("transid");
                $leavetypeid = Input::get("leavetypeid");
                $leavedatefrom = date("m/d/Y", strtotime(str_replace('/', '-', Input::get("leavedatefrom"))));
                $leavedateto = date("m/d/Y", strtotime(str_replace('/', '-', Input::get("leavedateto"))));
                $reason = $this->sqlstring(Input::get("reason"));
                $sql = "--Huy ngay phep \n " . PHP_EOL;
                $sql .= "EXEC W75P2031   '$divisionhr', '$userid',  '$transid', '$hr_employee_id','$leavedatefrom','$leavetypeid',0, 3, N'$reason' , '', '','', 0, '$leavedateto','D75F1065'";
                $data = $this->connectionHR->select($sql);
                if (count($data) > 0) {
                    $rs = $data[0];
                    if ($rs['IsSendMail'] == 1) {
                        if ($rs['IsShowMailScreen'] == 0) {
                            $res = $this->SendMailAuto($rs['EmailContent'], $rs);
                            return json_encode(['CODE' => 2, 'name' => $rs['EmailReceivedAddress'], "message" => $res, "transID" => $transid]); // đã gửi mail

                        } else {
                            return json_encode(['CODE' => 3, 'name' => $rs['EmailReceivedAddress'], "transID" => $transid, 'rsvalue' => View::make('layout.sendmail', compact('rs'))->render()]);
                        }
                    } else {
                        return json_encode(['CODE' => 4, 'name' => '', "transID" => $transid]);  // không gửi mail
                    }
                }
            case "5":
                \Debugbar::info(Input::all());
                $leavetypeid = Input::get("leavetypeid");
                $leavedatefrom = date("m/d/Y", strtotime(str_replace('/', '-', Input::get("leavedatefrom"))));
                $leavedateto = date("m/d/Y", strtotime(str_replace('/', '-', Input::get("leavedateto"))));
                $txt1stAbsDayQuan = Helpers::sqlNumber(Input::get("txt1stAbsDayQuan"));
                $txtLastAbsDayQuan = Helpers::sqlNumber(Input::get("txtLastAbsDayQuan"));

                $sql = "--Kiem tra hop le \n " . PHP_EOL;
                $sql .= "EXEC W15P2067 '$hr_employee_id', 0, '$leavedatefrom', '$leavedateto', 2, null, null, '$language', '$leavetypeid', 'D75F1065', $tranmonth, $tranyear, $txt1stAbsDayQuan, $txtLastAbsDayQuan";
                \Debugbar::info($sql);
                $data = $this->connectionHR->selectOne($sql);
                \Debugbar::info($data);
//					if (count($data) > 0) {
//						if ($data[0]["Status"] == "1") {
//							Debugbar::info($data[0]["Message"]);
//							return $data[0]["Message"];
//						}
//						else {
//                            //return  number_format($data[0]['Quantity'],1);
//                            return floatval($data[0]['Quantity']);
//                        }
//					}
//					else
//					{
//						return "";
//					}
                if ($data != null){
                    return json_encode($data);
                }else{
                    return '';
                }

            case "deleteW75F1066":
                $TransID = $this->sqlstring(Input::get('TransIDW75F1065'));
                $sql = "DELETE FROM D15T2050 WHERE TransID = '$TransID'" . PHP_EOL;
                $this->connectionHR->statement($sql);
                $sql = "DELETE FROM D15T2051 WHERE TransID = '$TransID'" . PHP_EOL;
                $this->connectionHR->statement($sql);
                break;
            case "6"://Xoa
                $transid = Input::get("transid");
                $leavetypeid = Input::get("leavetypeid");
                $leavedatefrom = date("m/d/Y", strtotime(str_replace('/', '-', Input::get("leavedatefrom"))));
                $leavedateto = date("m/d/Y", strtotime(str_replace('/', '-', Input::get("leavedateto"))));
                $reason = $this->sqlstring(Input::get("reason"));
                $note = $this->sqlstring(Input::get("note"));
                $sql = "--Thuc hien xoa ngay phep \n " . PHP_EOL;
                $sql .= "Exec W75P2031   '$divisionhr', '$userid',  '$transid', '$hr_employee_id','$leavedatefrom','$leavetypeid',0, 1, N'$reason', '' , N'$note','', 0, '$leavedateto','D75F1065'";
                $result = $this->connectionHR->statement($sql);
                return json_encode(['bSaveOK' => $result]);
            case "7": //Load luoi du lieu cham phep
                Helpers::getFromToDate(2, $firstOfMonth, $lastOfMonth);
                $sql = "--Do nguon cho luoi lich su" . PHP_EOL;
                $sql .= "EXEC W15P2066 '$divisionhr', '', 'WEB',  '$userid', 1, 2,'$language ','$hr_employee_id',$tranmonth,$tranyear,'D75F1065'";
                $data1 = json_encode($this->connectionHR->select($sql));
                $sql = "--Do nguon cho luoi chi tiet" . PHP_EOL;
                $sql .= "EXEC W75P2030 '$divisionhr', '$hr_employee_id', $firstOfMonth,  $lastOfMonth, '$language', 3, 'D75F1065'";
                $tem = $this->connectionHR->select($sql);
                $data2 = json_encode($tem);
                $sumQuantity = Helpers::sumFooter($tem, 'Quantity');
                \Debugbar::info($sumQuantity);
                return View::make("W7X.W75.W75F1065_Data", compact('pForm', 'g', 'data1', 'data2', 'tranmonth', 'tranyear', 'sumQuantity', 'decimals'));
                break;
            case "8": //Load luoi nhap lieu
                \Debugbar::info(Input::all());
                $all = Input::all();
                $session = Session::getId();
                $leavetypeid = Input::get('cboLeaveTypeID', '');
                $quantity = Input::get('txtQuantity', '');
                $leavedatefrom = date("m/d/Y", strtotime(str_replace('/', '-', Input::get('txtLeaveDateFromW75F1065', ''))));
                $leavedateto = date("m/d/Y", strtotime(str_replace('/', '-', Input::get('txtLeaveDateTo', ''))));
                $reason = $this->sqlstring(Input::get('txtReason', ''));
                $note = $this->sqlstring(Input::get('txtNote', ''));
                $txt1stAbsDayQuan = Helpers::sqlNumber(Input::get("txt1stAbsDayQuan"));
                $txtLastAbsDayQuan = Helpers::sqlNumber(Input::get("txtLastAbsDayQuan"));

                $sql = "--Them du lieu vao bang tam" . PHP_EOL;
                $sql .= "SET NOCOUNT ON" . PHP_EOL;
                $sql .= "DELETE D09T6666 WHERE UserID = '$userid' and HostID = '$session' and FormID = 'D75F1065'". PHP_EOL;
                $sql .= "INSERT INTO D09T6666 (UserID, HostID, Key01ID, Key02ID, Key03ID, Num01, Date01, Date02, FormID,Num02,Num03) " . PHP_EOL;
                $sql .= "VALUES('$userid', '$session', '', '$hr_employee_id', '$leavetypeid', $quantity, '$leavedatefrom', '$leavedateto', 'D75F1065',$txt1stAbsDayQuan,  $txtLastAbsDayQuan)" . PHP_EOL;
                $sql .= "EXEC W15P2103	'$divisionhr', $tranmonth, $tranyear, 'D75F1065', '$session', '$userid', 1" . PHP_EOL;
                $sql .= "DELETE D09T6666 WHERE UserID = '$userid' and HostID = '$session' and FormID = 'D75F1065'". PHP_EOL;
                \Debugbar::info($sql);
                try {
                    $rsData = $this->connectionHR->select($sql);

                    return json_encode(['status' => 'OKAY', 'data' => $rsData]);
                } catch (\Exception $ex) {
                    return json_encode(['status' => 'FAILED', 'message' => Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

                break;
            default:
                break;

        }
    }

    public function viewFromMail($pForm, $g, $isApproval = 0, $id = '', $iddt = '')
    {
        Debugbar::info(Session::get("W91P0000"));
        $modalTitle = $this->getModalTitleG4($pForm);
        $sql = "--Do nguon combo loai phep" . PHP_EOL;
        //$sql = " Select LeaveTypeID, LeaveTypeNameU as LeaveTypeName";
        //$sql .= " From D15T1020 Where Disabled = 0 AND (PersonalLeave = 1 OR (PersonalLeave = 0 AND LeaveID IN ('L020', 'L030', 'L040'))) ORDER BY LeaveTypeName ";
        $sql .= " SELECT		ID AS LeaveTypeID, Name84U AS LeaveTypeName, Number AS " . PHP_EOL;
        $sql .= " LeaveDisplayOrder, LeaveID " . PHP_EOL;
        $sql .= " FROM 		D15N5555 ('D75F1065',  ' ', ' ', ' ', ' ') " . PHP_EOL;
        $sql .= " ORDER BY	LeaveDisplayOrder, LeaveTypeName " . PHP_EOL;
        $data = $this->connectionHR->select($sql);

        $sql = "--Lay dinh dang so le" . PHP_EOL;
        $sql .= "SELECT LeaveQtyDecimals FROM D15T0000" . PHP_EOL;
        $rsTemp = $this->connectionHR->select($sql);
        $decimals = 2;
        if (count($rsTemp) > 0) {
            $decimals = $rsTemp[0]["LeaveQtyDecimals"];
        }

        Debugbar::info($sql);
        return View::make("W7X.W75.W75F1065", compact('pForm', 'g', 'data', 'id', 'modalTitle', 'decimals'));
    }
}
