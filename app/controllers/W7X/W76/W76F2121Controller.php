<?php

namespace W7X\W76;

use Exception;
use Helpers;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W7X\W7XController;

class W76F2121Controller extends W7XController
{
    public function index($pForm, $g, $task = '')
    {
        \Debugbar::info(Session::get("W91P0000"));
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeIDHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $session = Session::getId();
        $perW76F2121 = Session::get($pForm); //Tai lieu yeu cau phan quyen theo form 2021
        $modalTitle = $this->getModalTitle($pForm);
        $arrFileExt = \Config::get('attachment.fileExtension');
        $arrFileType = array();
        foreach ($arrFileExt as $key => $value) {
            if ($value['val'] == true) {
                if ($key != "zip1") {//lo?i tr? file zip1
                    array_push($arrFileType, '.' . $key);
                }
            }
        }
        switch ($task) {
            case "view":
            case "edit":
                $ID = Input::get("ID", "");
                //lay thong tin master
                $sql = "--Do nguon ..." . PHP_EOL;
                $sql .= "EXEC W76P2120 " . PHP_EOL;
                $sql .= " N''," . PHP_EOL; //DocNo, nvarchar, NOT NULL
                $sql .= "''," . PHP_EOL; //DocGroupID, varchar[50], NOT NULL
                $sql .= " N''," . PHP_EOL; //KeyWords, nvarchar, NOT NULL
                $sql .= "null," . PHP_EOL; //ReleaseDate1, datetime, NOT NULL
                $sql .= "null," . PHP_EOL; //ReleaseDate2, datetime, NOT NULL
                $sql .= "null," . PHP_EOL; //EffectDateFrom1, datetime, NOT NULL
                $sql .= "null," . PHP_EOL; //EffectDateFrom2, datetime, NOT NULL
                $sql .= "null," . PHP_EOL; //EffectDateTo1, datetime, NOT NULL
                $sql .= "null," . PHP_EOL; //EffectDateTo2, datetime, NOT NULL
                $sql .= "''," . PHP_EOL; //Emergency, varchar[100], NOT NULL
                $sql .= "'',"; //Security, varchar[100], NOT NULL
                $sql .= "'$ID',"; //ID, varchar[100], NOT NULL
                $sql .= "'$lang'"; //ID, varchar[100], NOT NULL
                $rsData = $this->connectionHR->selectOne($sql);

                //Lay thong tin chi tiet
                $sql1 = "--Do nguon luoi bang D76T2091" . PHP_EOL;
                $sql1 .= "EXEC W76P2091 '$ID', '$userID', '$lang'" . PHP_EOL;
                $rsData1 = $this->connection->select($sql1);
                $rsDetail = json_encode($rsData1);
                $emergencyList = \eHelpers::LoadFixData("W76F2100_Emergency", "Do nguon do khan cap");
                $securityList = \eHelpers::LoadFixData("W76F2100_Security", "Do nguon do bao mat");
                $docTyeList = \eHelpers::LoadFixData("W76F2090_DocType", "Do nguon dang van ban");
                $docGroupList = \eHelpers::LoadDocGroup();
                $divisionList = \eHelpers::LoadDivision($lang, 'DIV', 'LemonHR', $userID);
                $divisionList = json_encode($divisionList);
                $departmentList = \eHelpers::LoadDepartment($lang, 'DEP', 'LemonHR', $userID);
                $departmentList = json_encode($departmentList);
                $employeeList = \eHelpers::LoadEmployee($lang, 'EMP', 'LemonHR', $userID);
                $employeeList = json_encode($employeeList);
                $arrFileType = \eHelpers::getAttExtList();
                return View::make("W7X.W76.W76F2121", compact('rsData', 'rsDetail', "arrFileType", "docTyeList", "employeeList", "departmentList", "divisionList", "securityList", "docGroupList", "emergencyList", 'modalTitle', "pForm", "g", "task"));
                break;
            case 'add':
                $rsDetail = json_encode([]);
                \Debugbar::info("hsgahdgsjgdjhgasd");
                $emergencyList = \eHelpers::LoadFixData("W76F2100_Emergency", "Do nguon do khan cap");
                $securityList = \eHelpers::LoadFixData("W76F2100_Security", "Do nguon do bao mat");
                $docTyeList = \eHelpers::LoadFixData("W76F2090_DocType", "Do nguon dang van ban");
                $docGroupList = \eHelpers::LoadDocGroup();
                $divisionList = \eHelpers::LoadDivision($lang, 'DIV', 'LemonHR', $userID);
                $divisionList = json_encode($divisionList);
                $departmentList = \eHelpers::LoadDepartment($lang, 'DEP', 'LemonHR', $userID);
                $departmentList = json_encode($departmentList);
                $employeeList = \eHelpers::LoadEmployee($lang, 'EMP', 'LemonHR', $userID);
                $employeeList = json_encode($employeeList);
                return View::make("W7X.W76.W76F2121", compact('rsDetail', "arrFileType", "docTyeList", "employeeList", "departmentList", "divisionList", "securityList", "docGroupList", "emergencyList", 'modalTitle', "pForm", "g", "task"));
                break;
            case "save":
            case "update":
                $ID = Input::get("ID", "");
                $cbDivisionIDW76F2121 = $this->sqlstring(Input::get("cbDivisionIDW76F2121", ""));
                $txtDocNoW76F2121 = $this->sqlstring(Input::get("txtDocNoW76F2121", ""));
                $cbDocGroupIDW76F2121 = $this->sqlstring(Input::get("cbDocGroupIDW76F2121", ""));
                $txtSignerW76F2121 = $this->sqlstring(Input::get("txtSignerW76F2121", ""));
                $dtpReleaseDate1W76F2121 = Helpers::convertDate(Input::get("dtpReleaseDate1W76F2121", ""));
                $dtpEffectDateFrom1W76F2121 = Helpers::convertDate(Input::get("dtpEffectDateFrom1W76F2121", ""));
                $dtpEffectDateTo1W76F2121 = Helpers::convertDate(Input::get("dtpEffectDateTo1W76F2121", ""));
                $cbEmergencyW76F2121 = $this->sqlstring(Input::get("cbEmergencyW76F2121", ""));
                $cbSecurityW76F2121 = $this->sqlstring(Input::get("cbSecurityW76F2121", ""));
                $cbDocTypeW76F2121 = $this->sqlstring(Input::get("cbDocTypeW76F2121", ""));
                $txtQuanPageW76F2121 = Helpers::sqlNumber(Input::get("txtQuanPageW76F2121"));
                $hdAttFileNameW76F2121 = $this->sqlstring(Input::get("hdAttFileNameW76F2121", ""));
                $txtKeyWordW76F2121 = Helpers::sqlstring(Input::get('txtKeyWordW76F2121', ''));
                $txtContentW76F2121 = $this->sqlstring(Input::get("txtContentW76F2121", ""));
                $txtRefReceiveDocNoW76F2121 = $this->sqlstring(Input::get("txtRefReceiveDocNoW76F2121", ""));
                $txtRefSentDocNoW76F2121 = $this->sqlstring(Input::get("txtRefSentDocNoW76F2121", ""));
                $txtSheftNoW76F2121 = $this->sqlstring(Input::get("txtSheftNoW76F2121", ""));
                $txtFloorNoW76F2121 = $this->sqlstring(Input::get("txtFloorNoW76F2121", ""));
                $txtPartitionNoW76F2121 = $this->sqlstring(Input::get("txtPartitionNoW76F2121", ""));
                $txtFolderNoW76F2121 = $this->sqlstring(Input::get("txtFolderNoW76F2121", ""));
                $chkIsPublicW76F2121 = Input::get("chkIsPublicW76F2121", 0);
                $detail = Input::get("detail", "[]");
                $status = '';
                $receiveSendDate = Helpers::convertDate('');
                $docCategory = 'DOCINTERNAL';
                $deleted = 0;
                $senderID = '';
                $receiveSendOrganization = '';
                try {
                    //Check valid DocNo
                    if ($task == "save") { //add new
                        $sql = "--kiem tra Docno xem co ton tai hay chua" . PHP_EOL;
                        $sql .= "select top 1 1 from D76T2090 where DocNo = '$txtDocNoW76F2121'";
                        $result = $this->connectionHR->selectOne($sql);
                        if ($result != null) { //existed
                            return json_encode(["status" => "EXIST", 'message' => Helpers::getRS($g, 'Ma_nay_da_ton_tai_Vui_long_chon_ma_khac')]);
                        }
                        $sql = "--Luu du lieu cho master" . PHP_EOL;
                        $sql .= "Insert Into D76T2090(" . PHP_EOL;
                        $sql .= "ID, DocCategory, DocNo, DocGroupID, DivisionID, " . PHP_EOL;
                        $sql .= "ReceiveSendOrganization, Signer, ReceiveSendDate, ReleaseDate, KeyWords, " . PHP_EOL;
                        $sql .= "Content, StatusID, RefReceiveDocNo, RefSentDocNo, EffectDateFrom, " . PHP_EOL;
                        $sql .= "EffectDateTo, SheftNo, FloorNo, PartitionNo, FolderNo, " . PHP_EOL;
                        $sql .= "Emergency, Security, DocType, QuanPage, Deleted, " . PHP_EOL;
                        $sql .= "CreateUserID, CreateDate, LastModifyUserID, LastModifyDate, IsPublic, " . PHP_EOL;
                        $sql .= "SenderID" . PHP_EOL;
                        $sql .= ") output Inserted.ID Values(" . PHP_EOL;
                        $sql .= " NEWID(), '$docCategory',  N'$txtDocNoW76F2121', '$cbDocGroupIDW76F2121', '$cbDivisionIDW76F2121', " . PHP_EOL;
                        $sql .= " N'$receiveSendOrganization',  N'$txtSignerW76F2121', getdate(), $dtpReleaseDate1W76F2121,  N'$txtKeyWordW76F2121', " . PHP_EOL;
                        $sql .= " N'$txtContentW76F2121', '$status',  N'$txtRefReceiveDocNoW76F2121',  N'$txtRefSentDocNoW76F2121', $dtpEffectDateFrom1W76F2121, " . PHP_EOL;
                        $sql .= "$dtpEffectDateTo1W76F2121,  N'$txtSheftNoW76F2121',  N'$txtFloorNoW76F2121',  N'$txtPartitionNoW76F2121',  N'$txtFolderNoW76F2121', " . PHP_EOL;
                        $sql .= "'$cbEmergencyW76F2121', '$cbSecurityW76F2121', '$cbDocTypeW76F2121', $txtQuanPageW76F2121, $deleted, " . PHP_EOL;
                        $sql .= "'$userID', getdate(), '$userID', getdate(), $chkIsPublicW76F2121, " . PHP_EOL;
                        $sql .= "'$senderID'" . PHP_EOL;
                        $sql .= ")";
                        \Debugbar::info($sql);
                        $result = $this->connection->selectOne($sql);
                        $ID = $result["ID"];
                    } else {
                        $sql = "--Cap nhat du lieu master" . PHP_EOL;
                        $sql .= "Update D76T2090 set " . PHP_EOL;
                        $sql .= "DocCategory = '$docCategory'," . PHP_EOL;
                        $sql .= "DocNo =  N'$txtDocNoW76F2121'," . PHP_EOL;
                        $sql .= "DocGroupID = N'$cbDocGroupIDW76F2121'," . PHP_EOL;
                        $sql .= "DivisionID = '$cbDivisionIDW76F2121'," . PHP_EOL;
                        $sql .= "ReceiveSendOrganization =  N'$receiveSendOrganization'," . PHP_EOL;
                        $sql .= "Signer =  N'$txtSignerW76F2121'," . PHP_EOL;
                        $sql .= "ReceiveSendDate = $dtpReleaseDate1W76F2121," . PHP_EOL;
                        $sql .= "ReleaseDate = $dtpReleaseDate1W76F2121," . PHP_EOL;
                        $sql .= "KeyWords =  N'$txtKeyWordW76F2121'," . PHP_EOL;
                        $sql .= "Content =  N'$txtContentW76F2121'," . PHP_EOL;
                        $sql .= "StatusID = '$status'," . PHP_EOL;
                        $sql .= "RefReceiveDocNo =  N'$txtRefReceiveDocNoW76F2121'," . PHP_EOL;
                        $sql .= "RefSentDocNo = N'$txtRefSentDocNoW76F2121'," . PHP_EOL;
                        $sql .= "EffectDateFrom = $dtpEffectDateFrom1W76F2121," . PHP_EOL;
                        $sql .= "EffectDateTo =$dtpEffectDateTo1W76F2121," . PHP_EOL;
                        $sql .= "SheftNo =  N'$txtSheftNoW76F2121'," . PHP_EOL;
                        $sql .= "FloorNo =  N'$txtFloorNoW76F2121'," . PHP_EOL;
                        $sql .= "PartitionNo =  N'$txtPartitionNoW76F2121'," . PHP_EOL;
                        $sql .= "FolderNo =  N'$txtFolderNoW76F2121'," . PHP_EOL;
                        $sql .= "Emergency = '$cbEmergencyW76F2121'," . PHP_EOL;
                        $sql .= "Security = '$cbSecurityW76F2121'," . PHP_EOL;
                        $sql .= "DocType = '$cbDocTypeW76F2121'," . PHP_EOL;
                        $sql .= "QuanPage = $txtQuanPageW76F2121," . PHP_EOL;
                        $sql .= "Deleted = $deleted," . PHP_EOL;
                        $sql .= "LastModifyUserID = '$userID'," . PHP_EOL;
                        $sql .= "LastModifyDate = getdate()," . PHP_EOL;
                        $sql .= "IsPublic = $chkIsPublicW76F2121," . PHP_EOL;
                        $sql .= "SenderID = '$senderID'" . PHP_EOL;
                        $sql .= " Where ID='$ID'" . PHP_EOL;
                        $this->connection->statement($sql);
                    }
                    //save detail
                    if (intval($chkIsPublicW76F2121) == 1){
                        $sql = "delete from D76T2091 where DocID = '$ID'";
                    }else{
                        $sql = '';
                        foreach (json_decode($detail) as $rowData) {
                            $detailID = $rowData->ID;
                            $docID = $ID;
                            $txtDivisionIDW76F2120 = $rowData->DivisionID;
                            $txtDepartmentIDW76F2120 = $rowData->DepartmentID;
                            $txtEmployeeIDW76F2120 = $rowData->EmployeeID;
                            $txtNotesW76F2120 = \Helpers::sqlstring($rowData->Notes);
                            if ($detailID == '') {
                                $sql .= "--Luu phan chi tiet" . PHP_EOL;
                                $sql .= "insert into D76T2091 (ID, DocID, DivisionID, DepartmentID, EmployeeID, Notes, CreateUserID, LastModifyUserID, CreateDate, LastModifyDate)" . PHP_EOL;
                                $sql .= "values (NEWID(), '$docID', '$txtDivisionIDW76F2120', 
                            '$txtDepartmentIDW76F2120','$txtEmployeeIDW76F2120', '$txtNotesW76F2120','$userID','$userID',getdate(), getdate())" . PHP_EOL;
                            } else {
                                $sql .= "--Cap nhat  chi tiet" . PHP_EOL;
                                $sql .= "update D76T2091 set Notes = N'$txtNotesW76F2120' where ID='$detailID'" . PHP_EOL;
                            }
                        }
                    }
                    try {
                        if ($sql != "") {
                            $this->connectionHR->statement($sql);
                        }
                        //Chay store lay du lieu
                        $sql = "--Do nguon ..." . PHP_EOL;
                        $sql .= "EXEC W76P2120 " . PHP_EOL;
                        $sql .= " N''," . PHP_EOL; //DocNo, nvarchar, NOT NULL
                        $sql .= "''," . PHP_EOL; //DocGroupID, varchar[50], NOT NULL
                        $sql .= " N''," . PHP_EOL; //KeyWords, nvarchar, NOT NULL
                        $sql .= "null," . PHP_EOL; //ReleaseDate1, datetime, NOT NULL
                        $sql .= "null," . PHP_EOL; //ReleaseDate2, datetime, NOT NULL
                        $sql .= "null," . PHP_EOL; //EffectDateFrom1, datetime, NOT NULL
                        $sql .= "null," . PHP_EOL; //EffectDateFrom2, datetime, NOT NULL
                        $sql .= "null," . PHP_EOL; //EffectDateTo1, datetime, NOT NULL
                        $sql .= "null," . PHP_EOL; //EffectDateTo2, datetime, NOT NULL
                        $sql .= "''," . PHP_EOL; //Emergency, varchar[100], NOT NULL
                        $sql .= "'',"; //Security, varchar[100], NOT NULL
                        $sql .= "'$ID',"; //ID, varchar[100], NOT NULL
                        $sql .= "'$lang'"; //ID, varchar[100], NOT NULL
                        $data = $this->connectionHR->select($sql);
                        //Lay thong tin chi tiet
                        $sql = "--Do nguon luoi bang D76T2091" . PHP_EOL;
                        $sql .= "EXEC W76P2091 '$ID', '$userID', '$lang'" . PHP_EOL;
                        $rsDetail = $this->connection->select($sql);
                        return json_encode(["status" => "SUC", 'data' => $data, 'detail'=>$rsDetail]);
                    } catch (Exception $ex) {
                        \Helpers::log($ex->getMessage());
                        return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu"), 'errorMsg' => $ex->getMessage()]);
                    }
                } catch (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu"), 'errorMsg' => $ex->getMessage()]);
                }
                break;
            case "delete":
                $detailID = Input::get("detailID", "");
                $sql = "delete from D76T2091 where ID = '$detailID'";
                try {
                    $this->connectionHR->statement($sql);
                    return json_encode(["status" => "SUC"]);
                } catch (Exception $ex) {
                    Helpers::log($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu"), 'errorMsg' => $ex->getMessage()]);
                }
                break;
        }
    }
}
