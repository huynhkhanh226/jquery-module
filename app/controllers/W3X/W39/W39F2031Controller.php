<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 26/12/2017
 * Time: 11:36 AM
 */

namespace W3X\W39;

use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use Helpers;
use W3X\W3XController;

class W39F2031Controller extends W3XController
{
    public function index($pForm, $g, $task = '')
    {
        $modalTitle = $this->getModalTitleG4($pForm);
        $lang = Session::get('Lang');
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $session = Session::getId();
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        //\Debugbar::info("da chay 2031");
        switch ($task){
            case "":
                \Debugbar::info(Input::all());
                $EmpCriterionID = Input::get('EmpCriterionID');
                $AppCriterionSetID = Input::get('AppCriterionSetID');
                $Mode = Input::get('Mode');
                $sql = "-- Do nguon cho luoi" .PHP_EOL;
                $sql .= "EXEC W39P2010 '$divisionHR', '$userID', '$session', 'W39F2031', 4 , '$EmpCriterionID'";
                \Debugbar::info($sql);
                $valueGrid = $this->connectionHR->select($sql);
                \Debugbar::info($valueGrid);
                $sql = "--do nguon cot dong" .PHP_EOL;
                $sql .= "SET NOCOUNT ON SELECT RefID, RefCaptionU AS RefCaption, Disabled" .PHP_EOL;
                $sql .= "FROM D09T0080" .PHP_EOL;
                $sql .= "WHERE Type='W39F2021'" .PHP_EOL;
                $sql .= "ORDER BY RefID" .PHP_EOL;
                $caption = $this->connectionHR->select($sql);

                if(count($valueGrid) > 0){
                    for ($i = 0; $i < count($valueGrid); $i++) {
                        //$valueGrid[$i]["IsUpdate"] = 0;
                        for($i = 0; $i < count($valueGrid); $i++){//duyệt mảng để gắn biến calParentID
                            if(intval($valueGrid[$i]['IsEdit']) == 1 && intval($valueGrid[$i]['IsUpdate'] == 1)){//nếu là cấp con nhỏ nhất
                                $valueGrid[$i]['calParentID'] = (intval($valueGrid[$i]['Result']) * intval($valueGrid[$i]['Rate']))/100;
                            }else{// ko là cấp con nhỏ nhất
                                $valueGrid[$i]['calParentID'] = (float)$valueGrid[$i]['Result'];
                            }
                        }
                        /*$valueGrid[$i]['Rate'] = number_format($valueGrid[$i]['Rate'], 0);
                        $valueGrid[$i]['Confim'] = number_format($valueGrid[$i]['Confim'], 0);
                        $valueGrid[$i]['Result'] = number_format($valueGrid[$i]['Result'], 0);*/
                    }
                }
                return View::make("W3X.W39.W39F2031", compact("pForm", "g", "task", "modalTitle", "valueGrid", "Mode", "caption"));
                break;

            case "save":
                $dataSender = json_decode(Input::get('dataSender','[]'));
                \Debugbar::info($dataSender);
                $AppCriterionSetID1st = '';
                $EmpCriterionID = '';
                if(count($dataSender) > 0){
                    $AppCriterionSetID1st = $dataSender[0]->AppCriterionSetID;
                    $EmpCriterionID = $dataSender[0]->EmpCriterionID;
                }
                $sql = "SET NOCOUNT ON DELETE FROM D09T6666 WHERE UserID = '$userID' AND HostID = '$session' AND FormID = 'W39F2031'".PHP_EOL;
                /*for($i = 0; $i < count($dataSender); $i++){
                    $AppCriterionSetID = $this->sqlstring($dataSender[$i]->AppCriterionSetID);
                    $AppCriterionGroupID = $this->sqlstring($dataSender[$i]->AppCriterionGroupID);
                    $OrderNo = $this->sqlstring($dataSender[$i]->OrderNo);
                    $Rate = Helpers::sqlNumber($dataSender[$i]->Rate);
                    $Confim = Helpers::sqlNumber($dataSender[$i]->Confim);
                    $Result = Helpers::sqlNumber($dataSender[$i]->Result);
                    $ElementName = $this->sqlstring($dataSender[$i]->ElementName);
                    $NoteCriterion = $this->sqlstring($dataSender[$i]->NoteCriterion);
                    $sql .= "INSERT INTO D09T6666 (UserID, HostID, FormID,Key01ID, Key02ID, Num01, Num02,Num03, Num04, Str01, Str02)".PHP_EOL;
                    $sql .= "VALUES ('$userID', '$session', 'W39F2031', '$AppCriterionSetID','$AppCriterionGroupID','$OrderNo', $Rate, $Confim,$Result, '$ElementName', N'$NoteCriterion')".PHP_EOL;
                }*/
                $i = 0;
                foreach ($dataSender as $row) {
                    $ParentID = isset($row->ParentID) ? $row->ParentID : '';
                    //$appCriterionGroupID = isset($row->AppCriterionGroupID) ? $row->AppCriterionGroupID : '';
                    $appCriterionGroupID = isset($row->GroupID) ? $row->GroupID : '';
                    \Debugbar::info($appCriterionGroupID);
                    if($appCriterionGroupID == ""){// nếu là khoản trắng thì nhận khoản trắng
                        $appCriterionGroupID = $appCriterionGroupID;
                    }
                    if($appCriterionGroupID != ""){// nếu khác khoản trắng thì nhận AppCriterionGroupID
                        $appCriterionGroupID = isset($row->AppCriterionGroupID) ? $row->AppCriterionGroupID : '';
                    }
                    \Debugbar::info($appCriterionGroupID);
                    $rate = isset($row->Rate) ? $row->Rate : 0;
                    $isEdit = isset($row->IsEdit) ? $row->IsEdit : 0;
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
                    $sql .= "--Insert bang tam" . PHP_EOL;
                    $sql .= " INSERT INTO  D09T6666 (UserID, HostID, FormID,Key01ID, Key02ID, Num01, Num02,Num03, Num04, Str01, Str02, Str03, Str04, Str05, Str06, Str07, Str08, Str09, Num05, Num06 )" . PHP_EOL;
                    $sql .= " VALUES   ('$userID', '$session', 'W39F2031', '$AppCriterionSetID1st',  '$ParentID', $i, $rate, $confim,$result,N'$elementName',N'$content',N'$noteCriterion','$appCriterionGroupID',N'$EvaluationCriteria01',N'$EvaluationCriteria02',N'$EvaluationCriteria03',N'$EvaluationCriteria04',N'$EvaluationCriteria05', $isEdit, $Level)" . PHP_EOL;
                    $i++;
                }
                $sql .= "EXEC D39P5555 '$divisionHR', '$tranMonth', '$tranYear', '$lang', '$userID', '$session', 1, 'W39F2031', '$AppCriterionSetID1st'" .PHP_EOL;
                $rs = $this->connectionHR->select($sql);
                \Debugbar::info($rs);
                if($rs[0]['Status'] == 0){
                    $sql1 = "-- luu nghiep vu" .PHP_EOL;
                    $sql1 .= "EXEC W39P2031	'$divisionHR', '$userID', '$session', 'W39F2031', '$lang', 0, '$EmpCriterionID'" .PHP_EOL;

                    $sql1 .= "DELETE FROM D09T6666 WHERE UserID = '$userID' AND HostID = '$session' AND FormID = 'W39F2031'".PHP_EOL;
                    \Debugbar::info($sql);
                    if ($sql1 != '') {
                        try {
                            $this->connectionHR->statement($sql1);
                            return array('status' => 1, 'message' => '');
                        } catch (Exception $ex) {
                            \Debugbar::info($ex);
                            return array('status' => 0, 'message' => $ex->getMessage());
                        }
                    } else {
                        return array('status' => 0);
                    }
                }else{
                    return array('status' => 0, 'message' => $rs[0]['Message']);
                }
                break;
        }
    }
}