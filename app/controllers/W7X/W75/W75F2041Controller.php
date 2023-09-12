<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 19/12/2017
 * Time: 3:24 PM
 */
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

class W75F2041Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        $mode = Input::get("mode");
        $EmployeeID1st = Input::get('EmployeeID');
        \Debugbar::info($EmployeeID1st);
        $BenefitID1st = Input::get('BenefitID');
        $lang = Session::get("Lang");
        \Debugbar::info($pForm);
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $UserID = Auth::user()->user()->UserID;
        $valueGrid = json_encode(array());
        $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        $block = $this->LoadBlockByG4(Session::get("W91P0000")['HRDivisionID'], $UserID, $pForm, 1);
        $team = $this->LoadTeamByG4($pForm, $HRDivisionID, '', 1);
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $companyID = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
        $perW75F2041 = $this->getPermission("D09F5650");
        \Debugbar::info($perW75F2041);
        switch ($task) {
            case "":
                $sqltitle = "--lay caption cho man hinh" .PHP_EOL;
                $sqltitle .= "Select Desc84 as FormDesc From D00T0500 WHERE DataID = 'FormID' AND SKey = 'D52F1060'";
                \Debugbar::info($sqltitle);
                $modalTitle = $this->connectionLMS->select($sqltitle);
                $modalTitle = $modalTitle[0];
                \Debugbar::info($modalTitle);

                $sql = "--combo chinh sach".PHP_EOL;
                $sql .= "SET NOCOUNT ON SELECT T1.BenefitID, T1.BenefitNameU AS BenefitName".PHP_EOL;
                $sql .= "FROM D52T1060 T1 WITH(NOLOCK)".PHP_EOL;
                $sql .= "WHERE T1.[Disabled] =0".PHP_EOL;
                $sql .= "ORDER BY T1.BenefitNameU";
                \Debugbar::info($sql);
                $cbBenefit = $this->connectionHR->select($sql);
                \Debugbar::info($cbBenefit);
                return View::make("W7X.W75.W75F2041", compact("perW75F2041","pForm", "g", "modalTitle", "EmployeeID1st", "BenefitID1st", "department", "block","mode", "team", "cbBenefit"));
                break;

            case "filtter":
                \Debugbar::info(Input::all());
                $BenefitID = Input::get('cbBenefitIDW75F2041');
                $BlockID = Input::get('cbBlockIDW75F2041');
                if($BlockID == 'undefined'){
                    $BlockID = '%';
                }
                $DepartmentID = Input::get('cbDepartmentIDW75F2041');
                if($DepartmentID == 'undefined'){
                    $DepartmentID = '%';
                }
                $TeamID = Input::get('cbTeamIDW75F2041');
                if($TeamID == 'undefined'){
                    $TeamID = '%';
                }
                $EmployeeID = Input::get('txtEmployeeIDW75F2041');
                if($EmployeeID == 'undefined'){
                    $EmployeeID = '';
                }
                $mode = Input::get('mode');
                $sql = "--Do nguon cot dong".PHP_EOL;
                $sql .= "EXEC W75P2043 '$HRDivisionID', '$UserID', '$pForm', '$BenefitID'";
                \Debugbar::info($sql);

                $dataTemp = $this->connectionHR->select($sql);
                $captionGrid1 = [];
                foreach($dataTemp as $row){
                    $fieldName = $row['FieldName'];
                    $TranTypeID = $row['TranTypeID'];
                    $sqlCaption = "-- do nguon DD cot dong" .PHP_EOL;
                    $sqlCaption .= "EXEC W75P2044 '$HRDivisionID', '$UserID', '$pForm', '$BenefitID', '$TranTypeID'";
                    \Debugbar::info($sqlCaption);
                    $comboTem = $this->connectionHR->select($sqlCaption);
                    $data = [];
                    foreach ($comboTem as $rowData){
                        $rowData[$fieldName] = $rowData["ContentTypeName"];
                        array_push($data,$rowData);
                    }
                    $row['data'] = $data;
                    array_push($captionGrid1,$row);
                }
                //$captionGrid1 = $this->connectionHR->select($sql);
                \Debugbar::info($captionGrid1);
                \Debugbar::info($mode);
                $sql1 = "--Do nguon luoi đăng ký của nhân viên" .PHP_EOL;
                $sql1 .= "EXEC W75P2041 '$HRDivisionID', '$UserID', '$pForm', '$lang', '$BlockID', '$DepartmentID', '$TeamID', '$EmployeeID',$mode, '$BenefitID', '$companyID'";
                \Debugbar::info($sql1);
                $valueGrid1 = json_encode($this->connectionHR->select($sql1));
                \Debugbar::info($valueGrid1);

                return View::make("W7X.W75.W75F2041_Ajax1", compact('valueGrid1',"pForm","g","captionGrid1", "mode"));
                break;

            case "viewGrid2":
                \Debugbar::info(Input::all());
                $EmployeeID = Input::get('EmployeeID');
                $mode = Input::get('mode');
                $BenefitID = Input::get('BenefitID');
                $Participation = Input::get('Participation');
                $sql = "-- Do nguon khi click tuong dong ben luoi 1". PHP_EOL;
                $sql .= "EXEC W75P2042	'$HRDivisionID', '$UserID', '$lang', '$pForm', '$EmployeeID', $mode,'$BenefitID'";
                \Debugbar::info($sql);
                $valueGrid2 = $this->connectionHR->select($sql);
                \Debugbar::info($valueGrid2);

                $sqlSex = "--do nguon DD gioi tinh" .PHP_EOL;
                $sqlSex .= "SELECT '1' AS Sex , N'Nữ' AS SexName".PHP_EOL;
                $sqlSex .= "UNION ALL".PHP_EOL;
                $sqlSex .= "SELECT '0' AS Sex , N'Nam' AS SexName".PHP_EOL;
                $sqlSex .= "UNION ALL".PHP_EOL;
                $sqlSex .= "SELECT '%' AS Sex , N'Khác' AS SexName";
                \Debugbar::info($sqlSex);
                $cbSex = $this->connectionHR->select($sqlSex);
                \Debugbar::info($cbSex);
                return View::make("W7X.W75.W75F2041_Ajax2", compact("pForm","g", "valueGrid2","EmployeeID", "BenefitID", "mode" ,"Participation", "cbSex"));
                break;

            case "save":
                \Debugbar::info(Input::all());
                $dataSender1 = json_decode(Input::get('dataSender1','[]'));
                \Debugbar::info($dataSender1);
                $dataSender2 = json_decode(Input::get('dataSender2','[]'));
                \Debugbar::info($dataSender2);
                $mode = Input::get('mode');
                \Debugbar::info($mode);
                \Debugbar::info($dataSender2);
                $BenefitIDGrid2 = Input::get('BenefitID');
                $EmployeeIDGrid2 = Input::get('EmployeeID');
                if(intval($mode) == 0){
                    $sql = "--luu xuong bang D52T1062" .PHP_EOL;
                    for($i = 0; $i< count($dataSender1); $i++){
                        $BenefitID = $this->sqlstring($dataSender1[$i]->BenefitID);
                        $EmployeeID = $this->sqlstring($dataSender1[$i]->EmployeeID);
                        $Participation = intval($dataSender1[$i]->Participation);
                        $NotParticipation = intval($dataSender1[$i]->NotParticipation);
                        $Reft01 = $this->sqlstring($dataSender1[$i]->Reft01);
                        $Reft02 = $this->sqlstring($dataSender1[$i]->Reft02);
                        $Reft03 = $this->sqlstring($dataSender1[$i]->Reft03);
                        $Reft04 = $this->sqlstring($dataSender1[$i]->Reft04);
                        $Reft05 = $this->sqlstring($dataSender1[$i]->Reft05);
                        $sql .= "INSERT INTO D52T1062 (BenefitID, EmployeeID, Participation, NotParticipation, Reft01, Reft02, Reft03, Reft04," .PHP_EOL;
                        $sql .= "Reft05, CreateDate, CreateUserID, LastModifyDate, LastModifyUserID)" .PHP_EOL;
                        $sql .= "VALUES ('$BenefitID', '$EmployeeID', $Participation, $NotParticipation, N'$Reft01', N'$Reft02', N'$Reft03', N'$Reft04'," .PHP_EOL;
                        $sql .= "N'$Reft05', GetDate(), '$UserID', GetDate(), '$UserID')" .PHP_EOL;
                    }
                    $sql .= "--luu xuong bang D52T1063" .PHP_EOL;

                    for($i = 0; $i< count($dataSender2); $i++){
                        $BenefitID = $this->sqlstring($dataSender2[$i]->BenefitID);
                        $EmployeeID = $this->sqlstring($dataSender2[$i]->EmployeeID);
                        $RelativesID = $this->sqlstring($dataSender2[$i]->RelativesID);
                        $RelativesName = $this->sqlstring($dataSender2[$i]->RelativesName);
                        $Relationship = $this->sqlstring($dataSender2[$i]->Relationship);
                        $Birthdate = Helpers::convertDate($dataSender2[$i]->Birthdate);
                        $NumIDCard = $this->sqlstring($dataSender2[$i]->NumIDCard);
                        $Tel = $this->sqlstring($dataSender2[$i]->Tel);
                        $Sex = intval($dataSender2[$i]->Sex);
                        $Notes = $this->sqlstring($dataSender2[$i]->Notes);
                        $sql .= "INSERT INTO D52T1063 (BenefitID, EmployeeID, RelativesID, RelativesName, Relationship," .PHP_EOL;
                        $sql .= "Birthdate, NumIDCard, Tel, Sex, Notes)" .PHP_EOL;
                        $sql .= "VALUES ('$BenefitID', '$EmployeeID', '$RelativesID', N'$RelativesName', N'$Relationship'," .PHP_EOL;
                        $sql .= "$Birthdate, '$NumIDCard', '$Tel', $Sex, N'$Notes')";
                    }
                }
                if(intval($mode) == 1){
                    $sql = "-- update du lieu D52T1062" .PHP_EOL;
                    for($i = 0; $i< count($dataSender1); $i++){
                        $BenefitID = $this->sqlstring($dataSender1[$i]->BenefitID);
                        $EmployeeID = $this->sqlstring($dataSender1[$i]->EmployeeID);
                        $Participation = intval($dataSender1[$i]->Participation);
                        $NotParticipation = intval($dataSender1[$i]->NotParticipation);
                        $Reft01 = $this->sqlstring($dataSender1[$i]->Reft01);
                        $Reft02 = $this->sqlstring($dataSender1[$i]->Reft02);
                        $Reft03 = $this->sqlstring($dataSender1[$i]->Reft03);
                        $Reft04 = $this->sqlstring($dataSender1[$i]->Reft04);
                        $Reft05 = $this->sqlstring($dataSender1[$i]->Reft05);
                        $sql .= "UPDATE T1" . PHP_EOL;
                        $sql .= "SET T1.Participation = $Participation,
                                T1.NotParticipation = $NotParticipation,
                                T1.Reft01 = N'$Reft01',
                                T1.Reft02 = N'$Reft02',
                                T1.Reft03 = N'$Reft03',
                                T1.Reft04 = N'$Reft04',
                                T1.Reft05 = N'$Reft05',
                                T1.LastModifyDate = GetDate(),
                                T1.LastModifyUserID = '$UserID'". PHP_EOL;
                        $sql .= "FROM D52T1062 T1" . PHP_EOL;
                        $sql .= "WHERE BenefitID = '$BenefitID' AND EmployeeID = '$EmployeeID'" . PHP_EOL;
                    }
                    $sql .= "-- update du lieu D52T1063" .PHP_EOL;
                    $sql .= "--Xoa du lieu luoi 2 truoc khi insert " .PHP_EOL;
                    $sql .= "DELETE FROM D52T1063 WHERE BenefitID =  '$BenefitIDGrid2' AND EmployeeID = '$EmployeeIDGrid2'".PHP_EOL;

                    for($i = 0; $i< count($dataSender2); $i++){
                        $BenefitID = $this->sqlstring($dataSender2[$i]->BenefitID);
                        $EmployeeID = $this->sqlstring($dataSender2[$i]->EmployeeID);
                        $RelativesID = $this->sqlstring($dataSender2[$i]->RelativesID);
                        $RelativesName = $this->sqlstring($dataSender2[$i]->RelativesName);
                        $Relationship = $this->sqlstring($dataSender2[$i]->Relationship);
                        $Birthdate = Helpers::convertDate($dataSender2[$i]->Birthdate);
                        $NumIDCard = $this->sqlstring($dataSender2[$i]->NumIDCard);
                        $Tel = $this->sqlstring($dataSender2[$i]->Tel);
                        $Sex = intval($dataSender2[$i]->Sex);
                        $Notes = $this->sqlstring($dataSender2[$i]->Notes);
                        $sql .= "INSERT INTO D52T1063 (BenefitID, EmployeeID, RelativesID, RelativesName, Relationship," .PHP_EOL;
                        $sql .= "Birthdate, NumIDCard, Tel, Sex, Notes)" .PHP_EOL;
                        $sql .= "VALUES ('$BenefitID', '$EmployeeID', '$RelativesID', N'$RelativesName', N'$Relationship'," .PHP_EOL;
                        $sql .= "$Birthdate, '$NumIDCard', '$Tel', $Sex, N'$Notes')";
                        /*$sql .= "UPDATE T1" . PHP_EOL;
                        $sql .= "SET T1.RelativesID = '$RelativesID',
                                T1.RelativesName = N'$RelativesName',
                                T1.Relationship = N'$Relationship',
                                T1.Birthdate = $Birthdate,
                                T1.NumIDCard = '$NumIDCard',
                                T1.Tel = '$Tel',                   
                                T1.Sex = $Sex". PHP_EOL;
                        $sql .= "FROM D52T1063 T1" . PHP_EOL;
                        $sql .= "WHERE BenefitID = '$BenefitID' AND EmployeeID = '$EmployeeID'" . PHP_EOL;*/
                    }
                }
                \Debugbar::info($sql);
                if ($sql != '') {
                    try {
                        $this->connectionHR->statement($sql);
                        return array('status' => 1, 'message' => '');
                    } catch (Exception $ex) {
                        \Debugbar::info($ex);
                        return array('status' => 0, 'message' => $ex->getMessage());
                    }
                } else {
                    return array('status' => 0);
                }

                break;

            case "deleteRow":
                \Debugbar::info(Input::all());
                $BenefitID = Input::get('BenefitID');
                $EmployeeID = Input::get('EmployeeID');
                $RelativesID = Input::get('RelativesID');
                $sql = "--xoa dong".PHP_EOL;
                $sql .= "DELETE D52T1063 WHERE BenefitID = '$BenefitID'  AND EmployeeID = '$EmployeeID' AND RelativesID = '$RelativesID'";
                //$this->connectionHR->statement($sql);
                try {
                    $this->connectionHR->statement($sql) ;
                    return json_encode(['status' => 'SUCCESS']);
                } catch (Exception $ex) {
                    return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }
                break;
        }
    }
}