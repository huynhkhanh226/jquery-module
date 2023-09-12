<?php

namespace W3X\W39;

use Exception;
use Helpers;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W3X\W3XController;

class W39F2022Controller extends W3XController
{

    public function detail($vou, $g, $isApproval)
    {

        \Debugbar::info(Session::get("W91P0000"));
        $pForm = 'D39F2022';
        $moduleID = 'D39';
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeIDHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $session = Session::getId();
        $perD39F2022 = Session::get($pForm);
        $titleD39F2022 = $this->getModalTitle($pForm);

        $Mode = 0;
        $sql = "--Do nguon chi tiet" . PHP_EOL;
        $sql .= "EXEC W84P4001 '$divisionHR', '$moduleID', '$pForm', '$vou', '$lang',$Mode,'$userID', $isApproval";
        $rsDetail = $this->connectionHR->select($sql);
        \Debugbar::info($rsDetail);
        for($i = 0; $i < count($rsDetail); $i++){//duyệt mảng để gắn biến calParentID
            if($rsDetail[$i]['GroupID'] == "" && $rsDetail[$i]['IsAddNew'] == 1){//nếu groupID rỗng
                $rsDetail[$i]['isChild'] = 1;//gỡ rem cho cột groupID
            }else{
                $rsDetail[$i]['isChild'] = 0;//vẫn rem
            }
        }
        $sql = "--do nguon cot dong" .PHP_EOL;
        $sql .= "SET NOCOUNT ON SELECT RefID, RefCaptionU AS RefCaption, Disabled" .PHP_EOL;
        $sql .= "FROM D09T0080" .PHP_EOL;
        $sql .= "WHERE Type='W39F2021'" .PHP_EOL;
        $sql .= "ORDER BY RefID" .PHP_EOL;
        $caption = $this->connectionHR->select($sql);
        \Debugbar::info($caption);
        return View::make("W3X.W39.W39F2022_DTAjax", compact("titleD39F2022", 'perD39F2022','rsDetail','vou','pForm', 'g', 'isApproval', 'caption'));
    }

    public function action($pForm, $g, $task = ""){
        \Debugbar::info(Session::get("W91P0000"));
        $pForm = 'D39F2022';
        $moduleID = 'D39';
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeIDHR = Auth::user()->user()->HREmployeeID;
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $session = Session::getId();

        switch ($task){
            case "save":
                $obj = json_decode(Input::get("obj", []));
                $sql = "--Xoa bang tam" . PHP_EOL;
                $sql .= "SET NOCOUNT ON" . PHP_EOL;
                $sql .= "DELETE FROM D09T6666  WHERE UserID ='$userID' AND HostID ='$session' AND FormID = 'D39F2022'" . PHP_EOL;

                \Debugbar::info('dfdsfsdf');
                $i = 0;
                $empCriterionID = '';
                foreach ($obj as $row) {
                    if ($i == 0){
                        $empCriterionID = $row->EmpCriterionID;
                    }
                    $ParentID = isset($row->ParentID) ? $row->ParentID : '';
                    $appCriterionSetID = $row->AppCriterionSetID;
                    $appCriterionGroupID = $row->AppCriterionGroupID;
                    $rate = isset($row->Rate) ? $row->Rate : 0;
                    $isUpdate = isset($row->IsUpdate) ? $row->IsUpdate : 1;
                    $confim = isset($row->Confim) ? $row->Confim : 0;
                    $result = isset($row->Result) ? $row->Result : 0;
                    $noteCriterion = isset($row->NoteCriterion) ? $row->NoteCriterion : '';
                    $isDistribute = isset($row->IsDistribute) ? $row->IsDistribute : 0;
                    $elementName = isset($row->ElementName) ? $row->ElementName : '';
                    $content = isset($row->Content) ? $row->Content : '';
                    $Level = isset($row->Level) ? $row->Level : '';
                    $EvaluationCriteria01 = isset($row->EvaluationCriteria01) ? $row->EvaluationCriteria01 : '';
                    $EvaluationCriteria02 = isset($row->EvaluationCriteria02) ? $row->EvaluationCriteria02 : '';
                    $EvaluationCriteria03 = isset($row->EvaluationCriteria03) ? $row->EvaluationCriteria03 : '';
                    $EvaluationCriteria04 = isset($row->EvaluationCriteria04) ? $row->EvaluationCriteria04 : '';
                    $EvaluationCriteria05 = isset($row->EvaluationCriteria05) ? $row->EvaluationCriteria05 : '';
                    /*$sql .= "--Insert bang tam" . PHP_EOL;
                    $sql .= " INSERT INTO  D09T6666 (UserID, HostID, FormID,Key01ID, Key02ID, Num01, Num02,Num03, Num04, Str01, Str02, Str03, Num05 )" . PHP_EOL;
                    $sql .= " VALUES   ('$userID', '$session', '$pForm', '$appCriterionSetID',  '$appCriterionGroupID', $i, $rate, $confim,$result,N'$elementName',N'$content',N'$noteCriterion',$isUpdate)" . PHP_EOL;
                    $i++;*/

                    $sql .= "--Insert bang tam" . PHP_EOL;
                    $sql .= " INSERT INTO  D09T6666 (UserID, HostID, FormID,Key01ID, Key02ID, Num01, Num02,Num03, Num04, Str01, Str02, Str03, Str04, Str05, Str06, Str07, Str08, Str09, Num05, Num06, Num07)" . PHP_EOL;
                    $sql .= " VALUES   ('$userID', '$session', '$pForm', '$appCriterionSetID',  '$ParentID', $i, $rate, $confim,$result,N'$elementName',N'$content',N'$noteCriterion','$appCriterionGroupID',N'$EvaluationCriteria01',N'$EvaluationCriteria02',N'$EvaluationCriteria03',N'$EvaluationCriteria04',N'$EvaluationCriteria05', $isUpdate, $Level, '$isDistribute')" . PHP_EOL;
                    $i++;
                }
                $mode = 1;
                $sql .= "--Thuc hien checkstore " . PHP_EOL;
                $sql .= "EXEC D39P5555 	'$divisionHR',  $tranMonth,  $tranYear, $lang, '$userID', '$session', $mode ,'W39F2022' , '$appCriterionSetID', '', '' , '', ''" . PHP_EOL;
                \Debugbar::info($sql);
                try {
                    $rsData = $this->connectionHR->select($sql);
                    if (intval($rsData[0]["Status"]) == 0) {

                        $mode = 2;
                        $sql = "--Thuc thi store luu" . PHP_EOL;
                        $sql .= " SET NOCOUNT ON" . PHP_EOL;
                        $sql .= "EXEC W39P2025 '$divisionHR', '$userID',  '$session', 'D39F2022' ,1, '$lang',$mode,	'$empCriterionID','$employeeIDHR'" . PHP_EOL;
                        \Debugbar::info($sql);
                        $this->connectionHR->statement($sql);

                        $sql = "--Xoa bang tam" . PHP_EOL;
                        $sql .= "SET NOCOUNT ON" . PHP_EOL;
                        $sql .= "DELETE FROM D09T6666  WHERE UserID ='$userID' AND HostID ='$session' AND FormID = 'D39F2022'" . PHP_EOL;
                        $this->connectionHR->statement($sql);

                        return json_encode(['status' => 'OKAY']);

                    } else {
                        return json_encode(['status' => 'CHECKSTORE', "message" => $rsData[0]["Message"] , 'data'=> $rsData[0]]);
                    }
                } catch (Exception $ex) {
                    return json_encode(['status' => 'ERROR', "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }
                break;
        }
    }

}
