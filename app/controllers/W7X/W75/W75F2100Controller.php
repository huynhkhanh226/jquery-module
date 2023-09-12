<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 10/11/2017
 * Time: 9:31 AM
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

class W75F2100Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        $lang = Session::get("Lang");
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $UserID = Auth::user()->user()->UserID;
        $valueGrid = json_encode(array());
        $modalTitle = $this->getModalTitleG4($pForm);
        $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        $hostName = Session::getId();
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        switch ($task) {
            case "":
                $sql = "--Do nguon trang thai" . PHP_EOL;
                $sql .= "SELECT ID, Name84U as Name " . PHP_EOL;
                $sql .= "FROM W75N5555 ('W75F2100','','','','')" . PHP_EOL;
                $sql .= "ORDER BY OrderNo" . PHP_EOL;
                //\Debugbar::info($sql);
                $statusList = $this->connectionHR->select($sql);

                $sql1 = "--Do nguon vi tri" . PHP_EOL;
                $sql1 .= "SELECT '%' AS RecPositionID, N'<--Tất cả-->' AS RecPositionName, 0 as DisplayOrder" . PHP_EOL;
                $sql1 .= "UNION" . PHP_EOL;
                $sql1 .= "SELECT DutyID As RecPositionID, DutyNameU AS RecPositionName, 1 as DisplayOrder" . PHP_EOL;
                $sql1 .= "FROM D09T0211  WITH(NOLOCK)" . PHP_EOL;
                $sql1 .= "WHERE	Disabled = 0" . PHP_EOL;
                $sql1 .= "ORDER BY DisplayOrder, RecPositionName" . PHP_EOL;

                // \Debugbar::info($sql1);
                $posList = $this->connectionHR->select($sql1);
                //\Debugbar::info($department);

                $sql2 = "--Do nguon caption luoi" . PHP_EOL;
                $sql2 .= "SELECT Code, ShortU AS CaptionName, Decimals, Disabled," . PHP_EOL;
                $sql2 .= "CASE WHEN Code = 'BASE01' THEN 'BaseSalary01'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'BASE02' THEN 'BaseSalary02'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'BASE03' THEN 'BaseSalary03'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'BASE04' THEN 'BaseSalary04' END AS CaptionField" . PHP_EOL;
                $sql2 .= "FROM D13T9000 WHERE [Type] = 'SALBA'" . PHP_EOL;

                // \Debugbar::info($sql);
                $caption = $this->connectionHR->select($sql2);
                \Debugbar::info($caption);
                return View::make("W7X.W75.W75F2100", compact("pForm", "g", "modalTitle", "statusList", "posList", "valueGrid", "department", "caption"));
                break;

            case "filter":
                $appStatusID = Input::get('cbStatusID');
                $departmentID = Input::get('cbDepartmentID');
                $recPositionID = Input::get('cbRecPositionID');
                $dateFrom = Helpers::convertDate(Input::get('datefrom'));
                $dateTo = Helpers::convertDate(Input::get('dateto'));
                $sql = "--Do nguon khi fillter" . PHP_EOL;
                $sql .= "EXEC W75P2100 '$HRDivisionID', $dateFrom, $dateTo, '$appStatusID' ,'$departmentID','$recPositionID','$pForm', '$UserID', '$lang'";
                $valueGrid = $this->connectionHR->select($sql);


                $sql2 = "--Do nguon caption luoi" . PHP_EOL;
                $sql2 .= "SELECT Code, ShortU AS CaptionName, Decimals, Disabled," . PHP_EOL;
                $sql2 .= "CASE WHEN Code = 'BASE01' THEN 'BaseSalary01'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'BASE02' THEN 'BaseSalary02'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'BASE03' THEN 'BaseSalary03'" . PHP_EOL;
                $sql2 .= "WHEN Code = 'BASE04' THEN 'BaseSalary04' END AS CaptionField" . PHP_EOL;
                $sql2 .= "FROM D13T9000 WHERE [Type] = 'SALBA'" . PHP_EOL;

                // \Debugbar::info($sql);
                $caption = $this->connectionHR->select($sql2);


                for ($i = 0; $i < count($valueGrid); $i++) {
                    $valueGrid[$i]["IsUpdate"] = 0;
                    foreach ($caption as $row) {
                        $valueGrid[$i][$row["CaptionField"]] = number_format($valueGrid[$i][$row["CaptionField"]], 0);
                    }
                }
                \Debugbar::info($valueGrid);
                return $valueGrid;
                break;

            case "save":
                $sql = "";
                $now = getdate();
                $date = Helpers::convertDate($now["mday"] . "/" . $now["mon"] . "/" . $now["year"]);
                $dataSender = Input::get('dataSender');
                \Debugbar::info($dataSender);
                for ($i = 0; $i < count($dataSender); $i++) {
                    $approved = $dataSender[$i]["Approved"];
                    $notApproved = $dataSender[$i]["NotApproved"];
                    $transID = $dataSender[$i]["TransID"];
                    $candidateID = $dataSender[$i]["CandidateID"];
                    $SalaryObjectID = $dataSender[$i]["SalaryObjectID"];

                    $base1 = Helpers::sqlNumber($dataSender[$i]["BaseSalary01"]);
                    $base2 = Helpers::sqlNumber($dataSender[$i]["BaseSalary02"]);
                    $base3 = Helpers::sqlNumber($dataSender[$i]["BaseSalary03"]);
                    $base4 = Helpers::sqlNumber($dataSender[$i]["BaseSalary04"]);
                    \Debugbar::info($approved, $notApproved, $transID, $candidateID);
                    $sql .= "--update du lieu" . PHP_EOL;
                    $sql .= " UPDATE D25T2061 " . PHP_EOL;
                    $sql .= " SET 	Approved = '$approved', 
                                NotApproved =  '$notApproved',
                                ApproverID = '$UserID',
                                BaseSalary01 = '$base1',
                                BaseSalary02 = '$base2',
                                BaseSalary03 = '$base3',
                                BaseSalary04 = '$base4',
                                AppDate = $date,
                                SalaryObjectID = '$SalaryObjectID',
                                LastModifyUserID = '$UserID',
                                LastModifyDate = $date" . PHP_EOL;
                    $sql .= " WHERE TransID = '$transID' AND CandidateID = '$candidateID'" . PHP_EOL;
                    \Debugbar::info($sql);
                }
                if ($sql != '') {
                    try {
                        $rs = $this->connectionHR->statement($sql);
                        \Debugbar::info($rs);
                        return array('status' => 1, 'message' => '');
                    } catch (Exception $ex) {
                        \Debugbar::info($ex);
                        return array('status' => 0, 'message' => $ex->getMessage());
                    }
                } else {
                    return array('status' => 0);
                }
                break;
            case 'updatesalaryobject':
                $data = json_decode(Input::get('data', []));
                if (count($data) > 0) {
                    $sql = "set nocount on". PHP_EOL;
                    foreach ($data as $row) {
                        $sql .= "-- Thuc hien Insert tung dong " . PHP_EOL;
                        $CandidateID = $row->CandidateID;
                        $SalaryObjectID = $row->SalaryObjectID;
                        $InterviewFileID = $row->InterviewFileID;
                        $BaseSalary01 = Helpers::sqlNumber($row->BaseSalary01);
                        $BaseSalary02 = Helpers::sqlNumber($row->BaseSalary02);
                        $BaseSalary03 = Helpers::sqlNumber($row->BaseSalary03);
                        $BaseSalary04 = Helpers::sqlNumber($row->BaseSalary04);
                        $sql .= "Insert Into D13T1030(Users, HostName, Key01ID, Key02ID, Key03ID, Key04ID,Num01, Num02, Num03, Num04) " . PHP_EOL;
                        $sql .= "Values('$UserID', '$hostName', '$CandidateID', '$SalaryObjectID', 'D25F2060', '$InterviewFileID', $BaseSalary01, $BaseSalary02, $BaseSalary03, $BaseSalary04)" . PHP_EOL;
                    }

                    $sql .= "Exec D13P1033 '$UserID','$hostName','D25F2060','$HRDivisionID',$tranMonth,$tranYear";
                    \Debugbar::info($sql);
                    $data = $this->connectionHR->select($sql);
                    \Debugbar::info(json_encode($data));
                    return json_encode($data);
                }
                break;
        }
    }

}
