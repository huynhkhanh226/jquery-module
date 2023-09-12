<?php
/**
 * Created by PhpStorm.
 * User: QUYENNGUYEN
 * Date: 10/07/2018
 * Time: 11:34 AM
 */

namespace W7X\W76;

use Carbon\Carbon;
use DB;
use Exception;
use Request;
use View;
use W7X\W7XController;
use Input;
use Session;

class W76F2101Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        $permission = Session::get($pForm);
        //$permission == 0 ; //khong co quyen
        //$permission = 1; Co quyen view
        //$permission = 2; Co quyen add
        //$permission = 3; Co quyen edit
        //$permission = 4; Co quyen delete
        $divisionID = \Session::get("W91P0000")["DivisionID"];
        $userID = \Auth::user()->user()->UserID;
        $tranMonth = \Session::get("W91P0000")['TranMonth'];
        $tranYear = \Session::get("W91P0000")['TranYear'];
        $lang = \Session::get('Lang');
        $hostID = \Session::getId();
        $caption = $this->getModalTitle($pForm);

        switch ($task) {
            case "view":
            case "edit":
                //lay thong tin master
                $ID = Input::get('ID', '');
                $sql = "--Do nguon bang D76T2090" . PHP_EOL;
                $sql .= "SELECT convert(varchar(50), EffectDateTo, 103) as EffectDateTo, convert(varchar(50), ReceiveSendDate, 103) as ReceiveSendDate, * FROM   DRD02.dbo.D76T2090 where ID = '$ID'" . PHP_EOL;
                $rsData = $this->connection->selectOne($sql);

                //Lay thong tin chi tiet
                $sql1 = "--Do nguon luoi bang D76T2091" . PHP_EOL;
                $sql1 .= "EXEC W76P2091 '$ID', '$userID', '84'" . PHP_EOL;
                $rsData1 = $this->connection->select($sql1);
                $rsDetail = json_encode($rsData1);


                $levelList = \eHelpers::LoadFixData('W76F2100_Emergency', 'Do nguon cho Do khan cap', false);
                $levelListSecurity = \eHelpers::LoadFixData('W76F2100_Security', 'Do nguon cho Do Bao Mat');
                $ListStutus = \eHelpers::LoadFixData('W76F2090_StatusID', 'Do nguon combo Trang Thai');
                $ListDocGroup = \eHelpers::LoadDocGroup();
                $ListDocGroup = json_encode($ListDocGroup);

                $ListDivision = \eHelpers::LoadDivision($lang, 'DIV', 'LemonHR', $userID);
                $ListDivision = json_encode($ListDivision);

                $ListDepartment = \eHelpers::LoadDepartment($lang, 'DEP', 'LemonHR', $userID);
                $ListDepartment = json_encode($ListDepartment);

                $ListEmployee = \eHelpers::LoadEmployee($lang, 'EMP', 'LemonHR', $userID);
                $ListEmployee = json_encode($ListEmployee);

                $ListSender = \eHelpers::Loadsender($lang, 'EMP', 'LemonHR', $userID, 'DivisionID');
                $ListSender = json_encode($ListSender);

                $ListDocType = \eHelpers::LoadFixData('W76F2090_DocType', 'Do nguon dang van bang');
                $ListDocType = json_encode($ListDocType);

                $arrFileType = \eHelpers::getAttExtList();
                return View::make("W7X.W76.W76F2101", compact('ListSender', 'ListDocGroup', 'arrFileType', 'rsData', 'rsDetail', 'ListDivisionGrid', 'ListEmployee', 'ListStutus', 'levelList', 'levelListSecurity', 'ListDocType', 'ListDivision', 'ListDepartment', 'g', 'task', 'pForm', 'permission'));

                break;
            case "add":
                $rsDetail = [];
                $rsDetail = json_encode($rsDetail);
                $rsData = [];
                $rsData = json_encode($rsData);

                $levelList = \eHelpers::LoadFixData('W76F2100_Emergency', 'Do nguon cho Do khan cap', false);
                $levelListSecurity = \eHelpers::LoadFixData('W76F2100_Security', 'Do nguon cho Do Bao Mat');
                $ListStutus = \eHelpers::LoadFixData('W76F2090_StatusID', 'Do nguon combo Trang Thai');
                $ListDocGroup = \eHelpers::LoadDocGroup();
                $ListDocGroup = json_encode($ListDocGroup);

                $ListDivision = \eHelpers::LoadDivision($lang, 'DIV', 'LemonHR', $userID);
                $ListDivision = json_encode($ListDivision);

                $ListDepartment = \eHelpers::LoadDepartment($lang, 'DEP', 'LemonHR', $userID);
                $ListDepartment = json_encode($ListDepartment);

                $ListEmployee = \eHelpers::LoadEmployee($lang, 'EMP', 'LemonHR', $userID);
                $ListEmployee = json_encode($ListEmployee);

                $ListSender = \eHelpers::Loadsender($lang, 'EMP', 'LemonHR', $userID, 'DivisionID');
                $ListSender = json_encode($ListSender);

                $ListDocType = \eHelpers::LoadFixData('W76F2090_DocType', 'Do nguon dang van bang');
                $ListDocType = json_encode($ListDocType);

                $arrFileType = \eHelpers::getAttExtList();
                return View::make("W7X.W76.W76F2101", compact('ListSender', 'rsData', 'rsDetail', 'ListDocGroup', 'arrFileType', 'ListDivisionGrid', 'ListEmployee', 'ListStutus', 'levelList', 'levelListSecurity', 'ListDocType', 'ListDivision', 'ListDepartment', 'g', 'task', 'pForm', 'permission'));
                break;
            case "update":
            case "save":
                \Debugbar::info(Input::all());
                $ID = Input::get('ID', "");
                $cbDivisionID = Input::get("cbDivisionID", "");
                $txtDocNoW76F2101 = \Helpers::sqlstring(Input::get("txtDocNoW76F2101", ""));
                $txtDocGroupIDW76F2100 = Input::get("txtDocGroupIDW76F2101", "");
                $txtReceiveSendOrganizationW76F2100 = \Helpers::sqlstring(Input::get("txtReceiveSendOrganizationW76F2101", ""));
                $txtReceiveSendDateW76F2100 = \Helpers::convertDate(Input::get("txtReceiveSendDateW76F2101", Carbon::now()));
                $txtSignerW76F2100 = \Helpers::sqlstring(Input::get("txtSignerW76F2101", ""));
                $txtReleaseDateW76F2100 = \Helpers::convertDate(Input::get("txtReleaseDateW76F2101", Carbon::now()));
                $txtEffectDateFromW76F2100 = \Helpers::convertDate(Input::get("txtEffectDateFromW76F2101", Carbon::now()));
                $txtEffectDateToW76F2100 = \Helpers::convertDate(Input::get("txtEffectDateToW76F2101", 0));
                $txtEmergencyW76F2100 = Input::get("cbEmergencyW76F2101", "");
                $txtSecurityW76F2100 = Input::get("cbSecurityW76F2101", "");
                $txtDocTypeW76F2100 = Input::get("cbDocTypeW76F2101", "");
                $txtQuanPageW76F2100 = \Helpers::sqlNumber(Input::get("txtQuanPageW76F2101", ""));
                $txtKeyWordsW76F2100 = \Helpers::sqlstring(Input::get("txtKeyWordsW76F2101", ""));
                $txtContentW76F2100 = \Helpers::sqlstring(Input::get("txtContentW76F2101", ""));
                $txtRefReceiveDocNoW76F2100 = \Helpers::sqlstring(Input::get("txtRefReceiveDocNoW76F2101", ""));
                $txtRefSentDocNoW76F2100 = \Helpers::sqlstring(Input::get("txtRefSentDocNoW76F2101", ""));
                $txtSheftNoW76F2100 = Input::get("txtSheftNoW76F2101", "");
                $txtFloorNoW76F2100 = Input::get("txtFloorNoW76F2101", "");
                $txtPartitionNoW76F2100 = \Helpers::sqlstring(Input::get("txtPartitionNoW76F2101", ""));
                $txtFolderNoW76F2100 = \Helpers::sqlstring(Input::get("txtFolderNoW76F2101", ""));
                $cbStatusID = Input::get("cbStatusID", "");
                $txtSenderIDW76F2100 = \Helpers::sqlstring(Input::get("cbSenderID", ""));
                $rowList = Input::get("rowList", "[]");
                $rowList = json_decode($rowList);

                try {
                    //Kiem tra truoc khi luu
                    if ($task == "save") { //Kiem tra ton tai o truong hop them moi
                        $isExist = $this->connectionHR->selectOne("select top 1 1 from D76T2090 where DocNo='$txtDocNoW76F2101' and Deleted = 0");
                    } else {
                        $isExist = null;
                    }

                    if ($isExist == null) {
                        //Phan master
                        if ($task == "save") { //Kiem tra ton tai o truong hop them moi
                            $sql = "--Them moi du lieu master" . PHP_EOL;
                            $sql .= "insert into D76T2090 (ID, DivisionID, DocNo, DocGroupID, ReceiveSendOrganization, ReceiveSendDate, Signer, ReleaseDate, EffectDateFrom, EffectDateTo, Emergency, Security, DocType, QuanPage, KeyWords, Content, RefReceiveDocNo, RefSentDocNo, SheftNo, FloorNo, PartitionNo, FolderNo, StatusID, CreateUserID, LastModifyUserID, CreateDate, LastModifyDate, DocCategory, SenderID)" . PHP_EOL;
                            $sql .= "output Inserted.ID values (NEWID(), '$cbDivisionID', N'$txtDocNoW76F2101', N'$txtDocGroupIDW76F2100', 
                                N'$txtReceiveSendOrganizationW76F2100', $txtReceiveSendDateW76F2100, N'$txtSignerW76F2100', $txtReleaseDateW76F2100, 
                                $txtEffectDateFromW76F2100, $txtEffectDateToW76F2100, N'$txtEmergencyW76F2100', N'$txtSecurityW76F2100', 
                                N'$txtDocTypeW76F2100', $txtQuanPageW76F2100, N'$txtKeyWordsW76F2100', N'$txtContentW76F2100', N'$txtRefReceiveDocNoW76F2100', '$txtRefSentDocNoW76F2100',
                                N'$txtSheftNoW76F2100', N'$txtFloorNoW76F2100', N'$txtPartitionNoW76F2100', N'$txtFolderNoW76F2100'
                                , N'$cbStatusID', '$userID', '$userID', getdate(), getdate(), 'DOCSENT', N'$txtSenderIDW76F2100')" . PHP_EOL;
                            \Debugbar::info($sql);
                            $result = $this->connectionHR->selectOne($sql);
                            $ID = $result["ID"];
                        } else {
                            $sql = "--Cap nhat du lieu master" . PHP_EOL;
                            $sql .= "update D76T2090 set DivisionID = '$cbDivisionID', DocNo = N'$txtDocNoW76F2101', DocGroupID = N'$txtDocGroupIDW76F2100', ReceiveSendOrganization = N'$txtReceiveSendOrganizationW76F2100', ";
                            $sql .= "ReceiveSendDate = $txtReceiveSendDateW76F2100, Signer = N'$txtSignerW76F2100', ReleaseDate = $txtReleaseDateW76F2100, EffectDateFrom = $txtEffectDateFromW76F2100,";
                            $sql .= "EffectDateTo = $txtEffectDateToW76F2100, Emergency = N'$txtEmergencyW76F2100', Security = N'$txtSecurityW76F2100', DocType = N'$txtDocTypeW76F2100', QuanPage = N'$txtQuanPageW76F2100', ";
                            $sql .= "KeyWords = N'$txtKeyWordsW76F2100', Content = N'$txtContentW76F2100', RefReceiveDocNo = N'$txtRefReceiveDocNoW76F2100', ";
                            $sql .= "RefSentDocNo = N'$txtRefSentDocNoW76F2100', SheftNo = N'$txtSheftNoW76F2100', FloorNo = N'$txtFloorNoW76F2100', PartitionNo = N'$txtPartitionNoW76F2100', ";
                            $sql .= "FolderNo = N'$txtFolderNoW76F2100', StatusID = N'$cbStatusID',LastModifyDate =getDate(), SenderID = N'$txtSenderIDW76F2100' where ID = '$ID'";
                            $result = $this->connectionHR->statement($sql);
                        }


                        //Phan detail
                        if ($result) {
                            $sql = '';
                            foreach ($rowList as $rowData) {
                                $detailID = $rowData->ID;
                                $docID = $ID;
                                $txtDivisionIDW76F2100 = $rowData->DivisionID;
                                $txtDepartmentIDW76F2100 = $rowData->DepartmentID;
                                $txtEmployeeIDW76F2100 = $rowData->EmployeeID;
                                $txtNotesW76F2100 = \Helpers::sqlstring($rowData->Notes);

                                if ($detailID == '') {
                                    $sql .= "--Them moi chi tiet" . PHP_EOL;
                                    $sql .= "insert into D76T2091 (ID, DocID, DivisionID, DepartmentID, EmployeeID, Notes, CreateUserID, LastModifyUserID, CreateDate, LastModifyDate)" . PHP_EOL;
                                    $sql .= "output Inserted.ID values ((SELECT NEWID()), '$docID', '$txtDivisionIDW76F2100', '$txtDepartmentIDW76F2100','$txtEmployeeIDW76F2100', '$txtNotesW76F2100','$userID','$userID',getdate(), getdate())" . PHP_EOL;
                                } else {
                                    $sql .= "--Cap nhat chi tiet" . PHP_EOL;
                                    $sql .= "update DRD02.dbo.D76T2101 set Notes = '$txtNotesW76F2100' where ID = '$detailID'";
                                }
                            }

                            try {
                                if ($sql != '') {
                                    $this->connectionHR->statement($sql);
                                }

                                $sql = "--Do nguon luoi Filter" . PHP_EOL;
                                $sql .= "EXEC W76P2100 '', '', '', '', '', '', '', '', '','', '', '$ID', '$lang'";
                                $rsData = $this->connection->select($sql);
                                return json_encode(["status" => "SUC", 'data' => $rsData]);

                            } catch (Exception $ex) {
                                \Helpers::log($ex->getMessage());
                                return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu"), 'error' => $ex->getMessage()]);
                            }
                        }
                    } else {
                        return json_encode(["status" => "EXIST", "message" => \Helpers::getRS($g, "Ma_nay_da_ton_tai_Vui_long_chon_ma_khac")]);
                    }

                } catch (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu"), 'error' => $ex->getMessage()]);
                }

                break;
            case 'delete':
                $detailID = Input::get('detailID', "");
                $sql = "--Thuc hien xoa dong luoi chi tiet" . PHP_EOL;
                $sql .= "delete from D76T2091 where ID='$detailID'";
                try {
                    $this->connectionHR->statement($sql);
                    return json_encode(["status" => "SUC"]);
                } catch (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    return json_encode(['status' => 'ERROR', 'message' => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu"), 'error' => $ex->getMessage()]);
                }
                break;
        }
    }
}