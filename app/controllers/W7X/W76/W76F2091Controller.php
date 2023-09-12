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

class W76F2091Controller extends W7XController
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
                $sql .= "SELECT * FROM   DRD02.dbo.D76T2090 where ID = '$ID'" . PHP_EOL;
                $rsData = $this->connection->selectOne($sql);

                //Lay thong tin chi tiet
                $sql1 = "--Do nguon luoi bang D76T2091" . PHP_EOL;
                $sql1 .= "EXEC W76P2091 '$ID', '$userID', '84'" . PHP_EOL;
                $rsData1 = $this->connection->select($sql1);
                $rsDetail = json_encode($rsData1);


                $levelList = \eHelpers::LoadFixData('W76F2100_Emergency', 'Do nguon cho Do khan caop', false);
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

                $ListDocType = \eHelpers::LoadFixData('W76F2090_DocType', 'Do nguon dang van bang');
                $ListDocType = json_encode($ListDocType);

                $arrFileType = \eHelpers::getAttExtList();
                return View::make("W7X.W76.W76F2091", compact('ListDocGroup','arrFileType', 'rsData', 'rsDetail',  'ListDivisionGrid', 'ListEmployee',  'ListStutus', 'levelList', 'levelListSecurity', 'ListDocType', 'ListDivision', 'ListDepartment', 'g', 'task', 'pForm', 'permission'));

                break;
            case "add":
                $rsDetail = [];
                $rsDetail = json_encode($rsDetail);
                $rsData = [];
                $rsData = json_encode($rsData);

                $levelList = \eHelpers::LoadFixData('W76F2100_Emergency', 'Do nguon cho Do khan caop', false);
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

                $ListDocType = \eHelpers::LoadFixData('W76F2090_DocType', 'Do nguon dang van bang');
                $ListDocType = json_encode($ListDocType);

                $arrFileType = \eHelpers::getAttExtList();
                return View::make("W7X.W76.W76F2091", compact('rsData', 'rsDetail','ListDocGroup','arrFileType',  'ListDivisionGrid', 'ListEmployee',  'ListStutus', 'levelList', 'levelListSecurity', 'ListDocType', 'ListDivision', 'ListDepartment', 'g', 'task', 'pForm', 'permission'));
                break;
            case "update":
            case "save":
                \Debugbar::info(Input::all());
                $ID = Input::get('ID', "");
                $cbDivisionID = \Helpers::sqlstring(Input::get("cbDivisionID", ""));
                $txtDocNoW76F2091 = \Helpers::sqlstring(Input::get("txtDocNoW76F2091", ""));
                $txtDocGroupIDW76F2090 = \Helpers::sqlstring(Input::get("txtDocGroupIDW76F2091", ""));
                $txtReceiveSendOrganizationW76F2090 = \Helpers::sqlstring(Input::get("txtReceiveSendOrganizationW76F2091", ""));
                $txtReceiveSendDateW76F2090 = \Helpers::convertDate(Input::get("txtReceiveSendDateW76F2091", Carbon::now()));
                $txtSignerW76F2090 = \Helpers::sqlstring(Input::get("txtSignerW76F2091", "")) ;
                $txtReleaseDateW76F2090 = \Helpers::convertDate(Input::get("txtReleaseDateW76F2091", Carbon::now()));
                $txtEffectDateFromW76F2090 = \Helpers::convertDate(Input::get("txtEffectDateFromW76F2091", Carbon::now()));
                $txtEffectDateToW76F2090 = \Helpers::convertDate(Input::get("txtEffectDateToW76F2091", Carbon::now()));
                $txtEmergencyW76F2090 = Input::get("cbEmergencyW76F2091", "");
                $txtSecurityW76F2090 = Input::get("cbSecurityW76F2091", "");
                $txtDocTypeW76F2090 = Input::get("cbDocTypeW76F2091", "");
                $txtQuanPageW76F2090 = \Helpers::sqlNumber(Input::get("txtQuanPageW76F2091", "")) ;
                $txtKeyWordsW76F2090 = \Helpers::sqlstring( Input::get("txtKeyWordsW76F2091", ""));
                $txtContentW76F2090 = \Helpers::sqlstring(Input::get("txtContentW76F2091", ""));
                $txtRefReceiveDocNoW76F2090 = \Helpers::sqlstring(Input::get("txtRefReceiveDocNoW76F2091", ""));
                $txtRefSentDocNoW76F2090 = \Helpers::sqlstring(Input::get("txtRefSentDocNoW76F2091", ""));
                $txtSheftNoW76F2090 = Input::get("txtSheftNoW76F2091", "");
                $txtFloorNoW76F2090 = Input::get("txtFloorNoW76F2091", "");
                $txtPartitionNoW76F2090 = \Helpers::sqlstring(Input::get("txtPartitionNoW76F2091", ""));
                $txtFolderNoW76F2090 = Input::get("txtFolderNoW76F2091", "");
                $cbStatusID = Input::get("cbStatusID", "");
                $rowList = Input::get("rowList", "[]");
                $rowList = json_decode($rowList);

                try {
                    //Kiem tra truoc khi luu
                    if ($task == "save") { //Kiem tra ton tai o truong hop them moi
                        $isExist = $this->connectionHR->selectOne("select top 1 1 from D76T2090 where DocNo='$txtDocNoW76F2091' and Deleted = 0");
                    } else {
                        $isExist = null;
                    }

                    if ($isExist == null) {
                        //Phan master
                        if ($task == "save") { //Kiem tra ton tai o truong hop them moi
                            $sql = "--Them moi du lieu master" . PHP_EOL;
                            $sql .= "insert into D76T2090 (ID, DivisionID, DocNo, DocGroupID, ReceiveSendOrganization, ReceiveSendDate, Signer, ReleaseDate, EffectDateFrom, EffectDateTo, Emergency, Security, DocType, QuanPage, KeyWords, Content, RefReceiveDocNo, RefSentDocNo, SheftNo, FloorNo, PartitionNo, FolderNo, StatusID, CreateUserID, LastModifyUserID, CreateDate, LastModifyDate, DocCategory)" . PHP_EOL;
                            $sql .= "output Inserted.ID values (NEWID(), '$cbDivisionID', '$txtDocNoW76F2091', N'$txtDocGroupIDW76F2090', 
                                N'$txtReceiveSendOrganizationW76F2090', $txtReceiveSendDateW76F2090, N'$txtSignerW76F2090', $txtReleaseDateW76F2090, 
                                $txtEffectDateFromW76F2090, $txtEffectDateToW76F2090, N'$txtEmergencyW76F2090', N'$txtSecurityW76F2090', 
                                N'$txtDocTypeW76F2090', $txtQuanPageW76F2090, N'$txtKeyWordsW76F2090', N'$txtContentW76F2090', N'$txtRefReceiveDocNoW76F2090', N'$txtRefSentDocNoW76F2090',
                                N'$txtSheftNoW76F2090', N'$txtFloorNoW76F2090', N'$txtPartitionNoW76F2090', N'$txtFolderNoW76F2090'
                                , N'$cbStatusID', '$userID', '$userID', getdate(), getdate(), 'DOCRECEIVE')" . PHP_EOL;
                            \Debugbar::info($sql);
                            $result = $this->connectionHR->selectOne($sql);
                            $ID = $result["ID"];
                        } else {
                            $sql = "--Cap nhat du lieu master" . PHP_EOL;
                            $sql .= "update D76T2090 set DivisionID = '$cbDivisionID', DocNo = '$txtDocNoW76F2091', DocGroupID = N'$txtDocGroupIDW76F2090', ReceiveSendOrganization = N'$txtReceiveSendOrganizationW76F2090', ";
                            $sql .= "ReceiveSendDate = $txtReceiveSendDateW76F2090, Signer = N'$txtSignerW76F2090', ReleaseDate = $txtReleaseDateW76F2090, EffectDateFrom = $txtEffectDateFromW76F2090,";
                            $sql .= "EffectDateTo = $txtEffectDateToW76F2090, Emergency = N'$txtEmergencyW76F2090', Security = N'$txtSecurityW76F2090', DocType = N'$txtDocTypeW76F2090', QuanPage = N'$txtQuanPageW76F2090', ";
                            $sql .= "KeyWords = N'$txtKeyWordsW76F2090', Content = N'$txtContentW76F2090', RefReceiveDocNo = N'$txtRefReceiveDocNoW76F2090', ";
                            $sql .= "RefSentDocNo = N'$txtRefSentDocNoW76F2090', SheftNo = N'$txtSheftNoW76F2090', FloorNo = N'$txtFloorNoW76F2090', PartitionNo = N'$txtPartitionNoW76F2090', ";
                            $sql .= "FolderNo = N'$txtFolderNoW76F2090', StatusID = N'$cbStatusID',LastModifyDate =getDate() where ID = '$ID'";
                            $result = $this->connectionHR->statement($sql);
                        }


                        //Phan detail
                        if ($result) {
                            $sql = '';
                            foreach ($rowList as $rowData) {
                                $detailID = $rowData->ID;
                                $docID = $ID;
                                $txtDivisionIDW76F2090 = $rowData->DivisionID;
                                $txtDepartmentIDW76F2090 = $rowData->DepartmentID;
                                $txtEmployeeIDW76F2090 = $rowData->EmployeeID;
                                $txtNotesW76F2090 = \Helpers::sqlstring($rowData->Notes);

                                if ($detailID == '') {
                                    $sql .= "--Them moi chi tiet" . PHP_EOL;
                                    $sql .= "insert into D76T2091 (ID, DocID, DivisionID, DepartmentID, EmployeeID, Notes, CreateUserID, LastModifyUserID, CreateDate, LastModifyDate)" . PHP_EOL;
                                    $sql .= "output Inserted.ID values ((SELECT NEWID()), '$docID', '$txtDivisionIDW76F2090', '$txtDepartmentIDW76F2090','$txtEmployeeIDW76F2090', '$txtNotesW76F2090','$userID','$userID',getdate(), getdate())" . PHP_EOL;
                                } else {
                                    $sql .= "--Cap nhat chi tiet" . PHP_EOL;
                                    $sql .= "update DRD02.dbo.D76T2091 set Notes = '$txtNotesW76F2090' where ID = '$detailID'";
                                }
                            }

                            try {
                                if ($sql != ''){
                                    $this->connectionHR->statement($sql);
                                }

                                $sql = "--Do nguon luoi Filter" . PHP_EOL;
                                $sql .= "EXEC W76P2090 '', '', '', '', '', '', '', '', '','', '', '$ID', '$lang'";
                                $rsData = $this->connection->select($sql);
                                return json_encode(["status" => "SUC", 'data'=>$rsData]);

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
                $sql = "--Thuc hien xoa dong luoi chi tiet".PHP_EOL;
                $sql .= "delete from D76T2091 where ID='$detailID'";
                try{
                    $this->connectionHR->statement($sql);
                    return json_encode(["status" => "SUC"]);
                }catch (Exception $ex){
                    \Helpers::log($ex->getMessage());
                    return json_encode(['status'=>'ERROR', 'message'=>\Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu"), 'error' => $ex->getMessage()]);
                }
                break;
        }
    }
}