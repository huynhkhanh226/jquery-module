<?php

namespace W2X\W25;

use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use Helpers;
use W2X\W2XController;

class W25F3020Controller extends W2XController
{
    public function index($pForm, $g, $task = "")
    {
        $modalTitle = $this->getModalTitle($pForm);
        $rs1 = json_encode(array());
        $rs2 = json_encode(array());
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $UserID = Auth::user()->user()->UserID;
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        switch ($task) {
            case "":
                return View::make("W2X.W25.W25F3020", compact("pForm", "g", "modalTitle", 'rs1', 'rs2', 'tranMonth', 'tranYear'));
                break;
            case "leftgrid":
                $input = Input::all();
                $isPendding = Input::get('isPedding', 0);
                $isCancel = Input::get('isCancel', 0);
                $voucherFromDate = \Helpers::convertDate($input['voucherFromDate']);
                $voucherDateTo = \Helpers::convertDate($input['voucherDateTo']);
                $sql = "--Do nguon cho luoi 1" . PHP_EOL;
                $sql .= "EXEC W25P3020 '$HRDivisionID', $voucherFromDate, $voucherDateTo, $isPendding ,$isCancel, '$UserID','$pForm', 0 ";
                $rs1 = $this->connectionHR->select($sql);
                return $rs1;
                break;

            case "righgrid":
                $input = Input::all();
                $isPendding = Input::get('isPedding', 0);
                $isCancel = Input::get('isCancel', 0);
                $interviewFileID = $input['interviewFileID'];
                $voucherFromDate = \Helpers::convertDate($input['voucherFromDate']);
                $voucherDateTo = \Helpers::convertDate($input['voucherDateTo']);
                $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
                $UserID = Auth::user()->user()->UserID;
                $sql1 = "--Do nguon cho luoi 2" . PHP_EOL;
                $sql1 .= "EXEC W25P3020 '$HRDivisionID', $voucherFromDate, $voucherDateTo, $isPendding ,$isCancel, '$UserID','$pForm', 1, '$interviewFileID' ";
                $rs2 = $this->connectionHR->select($sql1);
                for ($i = 0; $i < count($rs2); $i++) {
                    $rs2[$i]["IsEdit"] = 0;
                }

                \Debugbar::info($rs2);
                return $rs2;
                break;

            case "loadDD":
                $sql = "--Do nguon cho DD" . PHP_EOL;
                $sql .= "SELECT* FROM  W25N5555 ('W25F3020','IntStatusID')";
                $rs = $this->connectionHR->select($sql);
                return $rs;
                break;

            case "download":
                $candidateID = Input::get('candidateID');
                \Debugbar::info($candidateID);
                $mainsql = "EXEC W25P3021 '$HRDivisionID', '$candidateID', 'W25R3021'";
                //$sqlsub = "SELECT * From 'W25R3022'";
                $subreport = array(
                    0 => "W25R3022",
                    1 => "W25R3023",
                    2 => "W25R3024",
                    3 => "W25R3025"
                );
                 $sqlsub = array(
                     0 => "EXEC W25P3022 '$HRDivisionID', '$candidateID', 0",
                     1 => "EXEC W25P3022 '$HRDivisionID', '$candidateID', 1",
                     2 => "EXEC W25P3022 '$HRDivisionID', '$candidateID', 2",
                     3 => "EXEC W25P3022 '$HRDivisionID', '$candidateID', 3"
                 );
                $condef = Session::get("CONDEFAULT");
                $reportid = 'W25R3021';
                $rp = Helpers::Report($condef, $reportid, $subreport, $mainsql, $sqlsub);
                //$rp = Helpers::printReport($condef, $reportid, $subreport, $mainsql, $sqlsub);
                \Debugbar::info($rp);
                return $rp;
                break;

            case "checkBeforeSave":
                $interviewFileID = Input::get('interviewFileID');
                $interviewLevelID = Input::get('interviewLevelID');
                \Debugbar::info($interviewFileID);
                \Debugbar::info($interviewLevelID);
                $sql = "--kiem tra truoc khi luu" . PHP_EOL;
                $sql .= "EXEC W25P5555 'W25F3020', '', '$interviewFileID','$interviewLevelID'";
                $rs = $this->connectionHR->select($sql);
                return $rs;
                break;

            case "save":
                $sql = "";
                $dataSender = Input::get('dataSender');
                \Debugbar::info($dataSender);
                for ($i = 0; $i < count($dataSender); $i++) {
                    $candidateID = $dataSender[$i]["CandidateID"];
                    $interviewFileID = $dataSender[$i]["InterviewFileID"];
                    $intStatusID = $dataSender[$i]["IntStatusID"];
                    $result = $dataSender[$i]["Result"];
                    \Debugbar::info($candidateID, $interviewFileID, $intStatusID, $result);
                    $sql .= "--update du lieu" . PHP_EOL;
                    $sql .= " UPDATE D25T2011" . PHP_EOL;
                    $sql .= " SET IntStatusID = '$intStatusID', ResultU = N'$result'" . PHP_EOL;
                    $sql .= " WHERE InterviewFileID = '$interviewFileID' AND CandidateID = '$candidateID'" . PHP_EOL;
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
        }


    }

    public function viewFromMail($pForm,$cForm,$g, $module, $ApprovalStatus=0, $key1=null,$key2=null ){
        $modalTitle = $this->getModalTitle($pForm);
        $rs1 = json_encode(array());
        $rs2 = json_encode(array());
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $UserID = Auth::user()->user()->UserID;
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        return View::make("W2X.W25.W25F3020", compact("pForm", "g", "modalTitle", 'rs1', 'rs2', 'tranMonth', 'tranYear'));
    }
}
