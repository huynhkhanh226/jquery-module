<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 29/11/2017
 * Time: 11:07 AM
 */

namespace W0X\W09;

use Auth;
use Carbon\Carbon;
use Config;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W0X\W0XController;
use Debugbar;

class W09F2002Controller extends W0XController
{
    public function detail($vou, $g, $isApproval)
    {
        $pForm = 'D09F2002';
        $titleD09F2002 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $moduleID = 'D09';
        $Mode = 0;
        $sql2 = "--Do nguon chi tiet" . PHP_EOL;
        $sql2 .= "EXEC W84P4001 '$divisionHR', 'D09', '$pForm', '$vou', '$lang',2,'$userID', $isApproval";
        Debugbar::info($sql2);
        $rsApprover = $this->connectionHR->select($sql2);
        Debugbar::info($rsApprover);

        $ApprovalLevel = Helpers::sqlNumber($rsApprover[0]["ApprovalLevel"]);
        $sql = "--Do nguon chi tiet" . PHP_EOL;
        $sql .= "EXEC W84P4001 '$divisionHR', '$moduleID', '$pForm', '$vou', '$lang',$Mode,'$userID', $isApproval, $ApprovalLevel";
        Debugbar::info($sql);
        $rsDetail = $this->connectionHR->select($sql);
        Debugbar::info($rsDetail);

        $sql1 = "--Do nguon caption dong" . PHP_EOL;
        $sql1 .= "SET NOCOUNT ON SELECT Code, ShortU, Disabled, Decimals". PHP_EOL;
        $sql1 .= "From D13T9000". PHP_EOL;
        $sql1 .= "Where	Type='SALBA'". PHP_EOL;
        $sql1 .= "Order by Code". PHP_EOL;
        $caption = $this->connectionHR->select($sql1);
        Debugbar::info($sql1);
        Debugbar::info($caption);

        $captionBase01 = Helpers::arraySearch($caption, "Code", "BASE01");
        $captionBase02 = Helpers::arraySearch($caption, "Code", "BASE02");
        $captionBase03 = Helpers::arraySearch($caption, "Code", "BASE03");
        $captionBase04 = Helpers::arraySearch($caption, "Code", "BASE04");
        Debugbar::info($captionBase01);
        Debugbar::info(count($rsDetail));
        if(count($rsDetail)> 0 ){
            $rsDetail[0]["BaseSalary01"] = number_format($rsDetail[0]["BaseSalary01"],intval($captionBase01[0]['Decimals']));
            $rsDetail[0]["BaseSalary02"] = number_format($rsDetail[0]["BaseSalary02"],intval($captionBase02[0]['Decimals']));
            $rsDetail[0]["BaseSalary03"] = number_format($rsDetail[0]["BaseSalary03"],intval($captionBase03[0]['Decimals']));
            $rsDetail[0]["BaseSalary04"] = number_format($rsDetail[0]["BaseSalary04"],intval($captionBase04[0]['Decimals']));

            $rsDetail[0]["ProBaseSalary01"] = number_format($rsDetail[0]["ProBaseSalary01"],intval($captionBase01[0]['Decimals']));
            $rsDetail[0]["ProBaseSalary02"] = number_format($rsDetail[0]["ProBaseSalary02"],intval($captionBase02[0]['Decimals']));
            $rsDetail[0]["ProBaseSalary03"] = number_format($rsDetail[0]["ProBaseSalary03"],intval($captionBase03[0]['Decimals']));
            $rsDetail[0]["ProBaseSalary04"] = number_format($rsDetail[0]["ProBaseSalary04"],intval($captionBase04[0]['Decimals']));

            $rsDetail[0]["AppBaseSalary01"] = number_format($rsDetail[0]["AppBaseSalary01"],intval($captionBase01[0]['Decimals']));
            $rsDetail[0]["AppBaseSalary02"] = number_format($rsDetail[0]["AppBaseSalary02"],intval($captionBase02[0]['Decimals']));
            $rsDetail[0]["AppBaseSalary03"] = number_format($rsDetail[0]["AppBaseSalary03"],intval($captionBase03[0]['Decimals']));
            $rsDetail[0]["AppBaseSalary04"] = number_format($rsDetail[0]["AppBaseSalary04"],intval($captionBase04[0]['Decimals']));
        }
        return View::make("W0X.W09.W09F2002_DTAjax", compact("titleD09F2002", 'rsDetail','vou', 'g', 'isApproval', 'caption', 'captionBase01', 'captionBase02', 'captionBase03', 'captionBase04'));
    }

    public function action($task = ""){
        switch ($task){
            case "save":
                \Debugbar::info(Input::all());
                $SalaryProposalID = $this->sqlstring(Input::get("SalaryProposalID"));
                $isApproval = Helpers::sqlNumber(Input::get("isApproval"));
                $AppBaseSalary01 = Helpers::sqlNumber(Input::get("txtAppBaseSalary01W09F2002"));
                $AppBaseSalary02 = Helpers::sqlNumber(Input::get("txtAppBaseSalary02W09F2002"));
                $AppBaseSalary03 = Helpers::sqlNumber(Input::get("txtAppBaseSalary03W09F2002"));
                $AppBaseSalary04 = Helpers::sqlNumber(Input::get("txtAppBaseSalary04W09F2002"));
                $Notes = $this->sqlstring(Input::get("txtNotesW09F2002"));
                $AppValidDate = Helpers::convertDate(Input::get("txtAppValidDateW09F2002"));
                $EmployeeID = $this->sqlstring(Input::get("EmployeeID"));

                $companyID = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
                $userID = Auth::user()->user()->UserID;
                $divisionHR = Session::get("W91P0000")['HRDivisionID'];
                $session = Session::getId();
                $lang = Session::get('Lang');
                $pForm = 'D09F2002';
                $sql2 = "--Do nguon chi tiet" . PHP_EOL;
                $sql2 .= "EXEC W84P4001 '$divisionHR', 'D09', '$pForm', '$SalaryProposalID', '$lang',2,'$userID', $isApproval";
                Debugbar::info($sql2);
                $rsApprover = $this->connectionHR->select($sql2);
                Debugbar::info($rsApprover);

                $ApprovalLevel = Helpers::sqlNumber($rsApprover[0]["ApprovalLevel"]);
                $NotApproval = Helpers::sqlNumber($rsApprover[0]["NotApprovalDisplay"]);
                $ApproverID = $this->sqlstring($rsApprover[0]["ApproverID"]);
                $ApproveDate = Helpers::convertDate($rsApprover[0]["ApproveDate"]);
                //$ApprovalStatus = $this->sqlstring($rsApprover[0]["ApprovalStatus"]);

                $sql = "--Luu du lieu tai tung cap duyet" .PHP_EOL;
                $sql .= "DELETE D09T2002 WHERE 	VoucherID = '$SalaryProposalID' AND ApprovalLevel = $ApprovalLevel" .PHP_EOL;

                $sql .= "SET NOCOUNT ON INSERT INTO D09T2002 (ApprovalFlowID, VoucherID, ApprovalLevel, ApproverID, ApprovalStatus, ApprovalDate, AppBaseSalary01, AppBaseSalary02," .PHP_EOL;
                $sql .= "AppBaseSalary03,  AppBaseSalary04, AppValidDate, AppNotes, CreateDate, CreateUserID, LastModifyDate, LastModifyUserID)" .PHP_EOL;
                $sql .= "VALUES ('', '$SalaryProposalID', $ApprovalLevel, '$ApproverID', 0, $ApproveDate, $AppBaseSalary01, $AppBaseSalary02," .PHP_EOL;
                $sql .= "$AppBaseSalary03, $AppBaseSalary04, $AppValidDate, N'$Notes', GetDate(), '$userID',GetDate(), '$userID')";

               /* $sql1 = "--xoa du lieu bang tam" . PHP_EOL;
                $sql1 .= "DELETE D09T6666 WHERE	UserID = '$userID' AND HostID = '$session' AND FormID = '$pForm'";
                $this->connectionHR->statement($sql1);

                $sql = "--Insert bang tam" . PHP_EOL;
                $sql .= "SET NOCOUNT ON INSERT INTO D09T6666 (UserID, HostID, FormID, Key01ID, Key02ID, Num01, Num02, Num03, Num04, Num05, Num06,Num07,Date01, Str01)". PHP_EOL;
                $sql .= "VALUES ('$userID','$session','D09F2002','$SalaryProposalID','$EmployeeID',$ApprovalLevel, $isApproval, $NotApproval, $AppBaseSalary01, $AppBaseSalary02, $AppBaseSalary03, $AppBaseSalary04,$AppValidDate, N'$Notes')". PHP_EOL;*/

              /*  $sql = "--store luu khi duyet" . PHP_EOL;
                $sql .= "EXEC W84P4002 '$divisionHR', 'D09', 'D09F2002', '$userID', '$SalaryProposalID', 0, null, '', '', '$session', 0". PHP_EOL;*/

                /*$sql .= " -- Ra User va cap duyet tiep theo " . PHP_EOL;
                $sql .= "EXEC D84P2020 '$companyID', '4', 'D09', '', '$divisionHR', '$userID', '$session', 1, '$lang', 1, 0, $ApprovalLevel, 'D09F2002', '$SalaryProposalID'" . PHP_EOL;*/
                \Debugbar::info($sql);
                if ($sql != "") {
                    $this->connectionHR->statement($sql);
                    return ['status' => 0];
                    /*try {
                        //$this->connectionHR->statement($sql);


                        if (count($data) > 0){
                            $rs = $data[0];
                            \Debugbar::info($data[0]);
                            if($rs['IsSendMail']==1)
                            {
                                if($rs['IsShowMailScreen']==0)
                                {
                                    $res = $this->SendMailAuto($rs['EmailContent'],$rs);
                                    return json_encode(['status' => 'BACKGROUND', 'name' => $rs['EmailReceivedAddress'],"message"=>$res]); // đã gửi mail
                                }
                                else
                                {
                                    \Debugbar::info($rs);
                                    return json_encode(['status' => "SHOWMAIL", 'name' => $rs['EmailReceivedAddress'], 'data'=> $rs, 'rsvalue' => View::make('layout.sendmail',compact('rs'))->render()]);
                                }
                            }
                            else
                            {
                                return json_encode(['status' => "NOSEND", 'data'=> $rs]);  // không gửi mail
                            }
                        }else{
                            return json_encode(['status' => "NOSEND"]);  // không gửi mail
                        }
                    } catch (Exception $ex) {
                        return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS(4,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }*/
                }
                break;
        }
    }
}