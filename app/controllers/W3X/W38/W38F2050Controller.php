<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 27/11/2017
 * Time: 11:34 AM
 */
namespace W3X\W38;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use Helpers;
use W3X\W3XController;

class W38F2050Controller extends W3XController
{
    public function index($pForm, $g, $task = '')
    {
        $employeeID = Auth::user()->user()->HREmployeeID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $creatorName = Session::get("W91P0000")['CreatorNameHR'];
        $creatorID = Session::get("W91P0000")['CreatorHR'];
        \Debugbar::info($creatorID);
        //$perW38F2041 = $this->getPermission("D38F2042"); //Phân quyền cho combo phòng bạn
        //$perW38F2042 = Session::get($pForm); //Phân quyền cho form
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $perW38F2050 = $this->getPermission("D09F5650"); //Phân quyền cho combo phòng bạn
        $UserID = Auth::user()->user()->UserID;
        $session = Session::getId();
        $lang = Session::get('Lang');
        $departments = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        \Debugbar::info($departments);
        switch($task){
            case "":
                $rsData = array();
                $titleW38F2050 = $this->getModalTitle($pForm);
               /* $sql = "-- lay 2 dong" .PHP_EOL;
                $sql .= "DECLARE @ValiddateFrom DATETIME".PHP_EOL;
                $sql .= "SELECT @ValiddateFrom = MAX(ValiddateFrom)".PHP_EOL;
                $sql .= "FROM D84T1100".PHP_EOL;
                $sql .= "WHERE TransactionID = 'D38KHDTTT'".PHP_EOL;*/

                $sql = "-- Combo Cap duyet" .PHP_EOL;
                $sql .= "SELECT T1.ApprovalLevel".PHP_EOL;
                $sql .= "FROM D84T2000 T1 WITH(NOLOCK)".PHP_EOL;
                $sql .= "INNER JOIN	D84T1100 T2 WITH(NOLOCK) ON T1.ApprovalFlowID = T2.ApprovalFlowID".PHP_EOL;
                $sql .= "WHERE T1.ApproverID = '$UserID'".PHP_EOL;
                $sql .= "AND T2.TransactionID = 'D38KHDTTT'".PHP_EOL;
                $sql .= "AND T1.ApprovalLevel> 1 AND (T2.ValiddateFrom IS NULL OR CONVERT(VARCHAR(20), T2.ValiddateFrom, 111) <= CONVERT(VARCHAR(20), GETDATE(), 111))".PHP_EOL;
                $sql .= "AND (T2.ValiddateTo IS NULL OR CONVERT(VARCHAR(20), T2.ValiddateTo, 111) >= CONVERT(VARCHAR(20), GETDATE(), 111)) AND T2.[Disabled] = 0".PHP_EOL;
                $sql .= "GROUP BY T1.ApprovalLevel".PHP_EOL;
                $sql .= "ORDER BY T1.ApprovalLevel";
                $cbApprovalLevel = $this->connectionHR->select($sql);
                \Debugbar::info($sql);
                \Debugbar::info($cbApprovalLevel);

                $sql1 = "-- Combo Trang thai" .PHP_EOL;
                $sql1 .= "EXEC W91P0500 'ApprovalStatus', '$lang'";
                $cbstatus = $this->connectionHR->select($sql1);
                \Debugbar::info($sql1);
                \Debugbar::info($cbstatus);

                $sql2 = "--Do nguon Don vi" .PHP_EOL;
                $sql2 .= "EXEC W38P0001 '$divisionHR', '$tranMonth', '$tranYear', '$UserID', 1";
                $cbDivision = $this->connectionHR->select($sql2);
                \Debugbar::info($sql2);
                \Debugbar::info($cbDivision);
                //\Debugbar::info($cbstatus);

                $sql3 = "-- Combo Nam" .PHP_EOL;
                $sql3 .= "SET NOCOUNT ON  SELECT '%' as YEAR, N'<--Tất cả-->' AS YEARNAME, 0 As DisplayOrder".PHP_EOL;
                $sql3 .= "UNION".PHP_EOL;
                $sql3 .= "SELECT Convert(varchar(5),[YEAR]) AS [YEAR], Convert(varchar(5),[YEAR]) AS YEARNAME,  1 As DisplayOrder".PHP_EOL;
                $sql3 .= "FROM D38T2032 WITH(NOLOCK)".PHP_EOL;
                $sql3 .= "WHERE YEAR <> 0".PHP_EOL;
                $sql3 .= "GROUP BY YEAR".PHP_EOL;
                $sql3 .= "ORDER BY YEAR DESC".PHP_EOL;

                $cbYear = $this->connectionHR->select($sql3);
                \Debugbar::info($sql3);
                \Debugbar::info($cbYear);
                return View::make("W3X.W38.W38F2050", compact("perW38F2050","rsData","cbYear","pForm", "g", 'task', "titleW38F2050", "departments", "cbstatus", "cbApprovalLevel", "cbDivision"));
                break;

            case "filter":
                \Debugbar::info(Input::all());
                $ApprovalLevel = $this->sqlstring(Input::get('cbApprovalLevelW38F2050'));
                //$FromDate = Helpers::convertDate(Input::get('txtDateFromW38F2050'));
                //$ToDate = Helpers::convertDate(Input::get('txtDateToW38F2050'));
                $Year = $this->sqlstring(Input::get('cbYearW38F2050'));
                $AppStatusID = $this->sqlstring(Input::get('cbStatusIDW38F2050'));
                $DepartmentID = $this->sqlstring(Input::get('cbDepartmentIDW38F2050'));
                $DivisionID = $this->sqlstring(Input::get('cbDivisionIDW38F2050'));
                $valueGrid2 = [];
                $ProposalID = '';
                $sql1 = '';

                $sql = "-- Do nguon cho luoi 1" .PHP_EOL;
                $sql .= "EXEC W38P2050	'D38', '$pForm', '$UserID', '$ApprovalLevel','$Year', '$AppStatusID', '$DepartmentID', '$DivisionID',0,''";
                $valueGrid1 = $this->connectionHR->select($sql);
                \Debugbar::info($sql);
                \Debugbar::info($valueGrid1);

                if(count($valueGrid1) > 0){
                    $ProposalID = $valueGrid1[0]['ProposalID'];
                    $sql1 = "--do nguon cho luoi 2".PHP_EOL;
                    $sql1 .= "EXEC W38P2050	'D38', '$pForm', '$UserID', '$ApprovalLevel','$Year', '$AppStatusID', '$DepartmentID', '$DivisionID',1,'$ProposalID'";
                    $valueGrid2 = $this->connectionHR->select($sql1);
                }
                \Debugbar::info($sql1);
                \Debugbar::info($valueGrid2);

                $value2Grid = array(
                    "grid1" => $valueGrid1,
                    "grid2" => $valueGrid2
                );

                return $value2Grid;
                break;

            case "viewDetailGrid2":
                \Debugbar::info(Input::all());
                $ProposalID = Input::get('ProposalID');
                $ApprovalLevel = $this->sqlstring(Input::get('cbApprovalLevelW38F2050'));
                $Year = $this->sqlstring(Input::get('cbYearW38F2050'));
                $AppStatusID = $this->sqlstring(Input::get('cbStatusIDW38F2050'));
                $DepartmentID = $this->sqlstring(Input::get('cbDepartmentIDW38F2050'));
                $DivisionID = $this->sqlstring(Input::get('cbDivisionIDW38F2050'));

                $sql1 = "--do nguon cho luoi 2".PHP_EOL;
                $sql1 .= "EXEC W38P2050	'D38', '$pForm', '$UserID', '$ApprovalLevel','$Year', '$AppStatusID', '$DepartmentID', '$DivisionID',1,'$ProposalID'";
                $valueGrid2 = $this->connectionHR->select($sql1);

                return $valueGrid2;
                break;

            case "save":
                $dataSender = Input::get('dataSender');
                $AprovalLV = Helpers::sqlNumber(Input::get('aprovalLV'));
                $companyID = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
               /* $sql2 = "--so quy trinh duyet" . PHP_EOL;
                $sql2 .= "SELECT ApprovalFlowID FROM D84T1100 WHERE TransactionID = 'D38KHDTTT'";
                $AppFlowTable = $this->connectionHR->select($sql2);
                \Debugbar::info($AppFlowTable);*/

               // $sql = "";
                \Debugbar::info($dataSender);
                $sql = "--xoa du lieu bang tam" . PHP_EOL;
                $sql .= "SET NOCOUNT ON DELETE D09T6666 WHERE	UserID = '$UserID' AND HostID = '$session' AND FormID = 'D38F2045'". PHP_EOL;
                //$this->connectionHR->statement($sql1);

                //\Debugbar::info($sql1);
                for ($i = 0; $i < count($dataSender); $i++) {
                    $ProposalID =  $this->sqlstring($dataSender[$i]["ProposalID"]);
                    $ApprovalLevel =  $this->sqlstring($dataSender[$i]["ApprovalLevel"]);
                    $Approval =  Helpers::sqlNumber($dataSender[$i]["Approval"]);
                    $NotApproval =  Helpers::sqlNumber($dataSender[$i]["NotApproval"]);
                    //$Number =  Helpers::sqlNumber($dataSender[$i]["Number"]);
                    $Notes =  $this->sqlstring($dataSender[$i]["Notes"]);
                    //$ApprovalFlowID = $this->sqlstring($dataSender[$i]["ApprovalFlowID"]);
                    $sql .= "--Insert bang tam" . PHP_EOL;
                    $sql .= "INSERT INTO D09T6666 (UserID, HostID, FormID, Key01ID, Num01, Num02, Num03, Str01)". PHP_EOL;
                    $sql .= "VALUES ('$UserID','$session','D38F2045','$ProposalID','$ApprovalLevel',$Approval, $NotApproval, N'$Notes')". PHP_EOL;
                    //$this->connectionHR->statement($sql1);
                }
                $sql .= "--store luu khi duyet" . PHP_EOL;
                $sql .= "EXEC D84P4002 '$divisionHR', 'D38', 'D38F2045', '$UserID', '', 0, null, '', '', '$session', 1". PHP_EOL;

                $sql .= " -- Ra User va cap duyet tiep theo " . PHP_EOL;
                $sql .= "EXEC D84P2020 '$companyID', '$g', 'D38', '', '$divisionHR', '$UserID', '$session', 1, '$lang', 1, 0, $AprovalLV, 'D38F2045', '$ProposalID'" . PHP_EOL;

                $sql .= "--xoa du lieu bang tam" . PHP_EOL;
                $sql .= "DELETE D09T6666 WHERE	UserID = '$UserID' AND HostID = '$session' AND FormID = 'D38F2045'";

                \Debugbar::info($sql);
                //\Debugbar::info($sql1);
                if ($sql != "") {
                    try {
                        //$this->connectionHR->statement($sql);
                        $data = $this->connectionHR->select($sql);
                        //$this->connectionHR->statement($sql2);
                        \Debugbar::info($data);
                        if (count($data) > 0){
                            $rs = $data[0];
                            \Debugbar::info($data[0]);
                            if($rs['IsSendMail']==1)
                            {
                                if($rs['IsShowMailScreen']==0)
                                {
                                    $res = $this->SendMailAuto($rs['EmailContent'],$rs);
                                    //$this->connectionHR->statement($sql1);
                                    return json_encode(['status' => 'BACKGROUND', 'name' => $rs['EmailReceivedAddress'],"message"=>$res]); // đã gửi mail
                                }
                                else
                                {
                                    \Debugbar::info($rs);
                                    //$this->connectionHR->statement($sql1);
                                    return json_encode(['status' => "SHOWMAIL", 'name' => $rs['EmailReceivedAddress'], 'data'=> $rs, 'rsvalue' => View::make('layout.sendmail',compact('rs'))->render()]);
                                }
                            }
                            else
                            {
                                //$this->connectionHR->statement($sql1);
                                return json_encode(['status' => "NOSEND", 'data'=> $rs]);  // không gửi mail
                            }
                        }else{
                            //$this->connectionHR->statement($sql1);
                            return json_encode(['status' => "NOSEND"]);  // không gửi mail
                        }
                    } catch (Exception $ex) {
                        //$this->connectionHR->statement($sql1);
                        return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }
                break;
        }
    }

    public function viewFromMail($pForm,$g,$isApproval=0,$id='',$iddt='') {
        $employeeID = Auth::user()->user()->HREmployeeID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $creatorName = Session::get("W91P0000")['CreatorNameHR'];
        $creatorID = Session::get("W91P0000")['CreatorHR'];
        \Debugbar::info($creatorID);
        //$perW38F2041 = $this->getPermission("D38F2042"); //Phân quyền cho combo phòng bạn
        //$perW38F2042 = Session::get($pForm); //Phân quyền cho form
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $perW38F2050 = $this->getPermission("D09F5650"); //Phân quyền cho combo phòng bạn
        $UserID = Auth::user()->user()->UserID;
        $session = Session::getId();
        $lang = Session::get('Lang');
        $departments = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        \Debugbar::info($departments);
        $rsData = array();
        $titleW38F2050 = $this->getModalTitle($pForm);
        /* $sql = "-- lay 2 dong" .PHP_EOL;
         $sql .= "DECLARE @ValiddateFrom DATETIME".PHP_EOL;
         $sql .= "SELECT @ValiddateFrom = MAX(ValiddateFrom)".PHP_EOL;
         $sql .= "FROM D84T1100".PHP_EOL;
         $sql .= "WHERE TransactionID = 'D38KHDTTT'".PHP_EOL;*/

        $sql = "-- Combo Cap duyet" .PHP_EOL;
        $sql .= "SELECT T1.ApprovalLevel".PHP_EOL;
        $sql .= "FROM D84T2000 T1 WITH(NOLOCK)".PHP_EOL;
        $sql .= "INNER JOIN	D84T1100 T2 WITH(NOLOCK) ON T1.ApprovalFlowID = T2.ApprovalFlowID".PHP_EOL;
        $sql .= "WHERE T1.ApproverID = '$UserID'".PHP_EOL;
        $sql .= "AND T2.TransactionID = 'D38KHDTTT'".PHP_EOL;
        $sql .= "AND T1.ApprovalLevel> 1 AND (T2.ValiddateFrom IS NULL OR CONVERT(VARCHAR(20), T2.ValiddateFrom, 111) <= CONVERT(VARCHAR(20), GETDATE(), 111))".PHP_EOL;
        $sql .= "AND (T2.ValiddateTo IS NULL OR CONVERT(VARCHAR(20), T2.ValiddateTo, 111) >= CONVERT(VARCHAR(20), GETDATE(), 111)) AND T2.[Disabled] = 0".PHP_EOL;
        $sql .= "GROUP BY T1.ApprovalLevel".PHP_EOL;
        $sql .= "ORDER BY T1.ApprovalLevel";
        $cbApprovalLevel = $this->connectionHR->select($sql);
        \Debugbar::info($sql);
        \Debugbar::info($cbApprovalLevel);

        $sql1 = "-- Combo Trang thai" .PHP_EOL;
        $sql1 .= "EXEC W91P0500 'ApprovalStatus', '$lang'";
        $cbstatus = $this->connectionHR->select($sql1);
        \Debugbar::info($sql1);
        \Debugbar::info($cbstatus);

        $sql2 = "--Do nguon Don vi" .PHP_EOL;
        $sql2 .= "EXEC W38P0001 '$divisionHR', '$tranMonth', '$tranYear', '$UserID', 1";
        $cbDivision = $this->connectionHR->select($sql2);
        \Debugbar::info($sql2);
        \Debugbar::info($cbDivision);
        //\Debugbar::info($cbstatus);

        $sql3 = "-- Combo Nam" .PHP_EOL;
        $sql3 .= "SET NOCOUNT ON  SELECT '%' as YEAR, N'<--Tất cả-->' AS YEARNAME, 0 As DisplayOrder".PHP_EOL;
        $sql3 .= "UNION".PHP_EOL;
        $sql3 .= "SELECT Convert(varchar(5),[YEAR]) AS [YEAR], Convert(varchar(5),[YEAR]) AS YEARNAME,  1 As DisplayOrder".PHP_EOL;
        $sql3 .= "FROM D38T2032 WITH(NOLOCK)".PHP_EOL;
        $sql3 .= "WHERE YEAR <> 0".PHP_EOL;
        $sql3 .= "GROUP BY YEAR".PHP_EOL;
        $sql3 .= "ORDER BY YEAR DESC".PHP_EOL;

        $cbYear = $this->connectionHR->select($sql3);
        \Debugbar::info($sql3);
        \Debugbar::info($cbYear);
        return View::make("W3X.W38.W38F2050", compact("perW38F2050","rsData","cbYear","pForm", "g", 'task', "titleW38F2050", "departments", "cbstatus", "cbApprovalLevel", "cbDivision"));
    }
}