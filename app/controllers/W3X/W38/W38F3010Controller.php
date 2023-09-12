<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 06/12/2017
 * Time: 9:13 AM
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

class W38F3010Controller extends W3XController
{
    public function index($pForm, $g, $task = '')
    {
        \Debugbar::info($pForm);
        $titleW38F3010 = $this->getModalTitle($pForm);
        \Debugbar::info($titleW38F3010);
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $UserID = Auth::user()->user()->UserID;
        $session = Session::getId();
        $lang = Session::get('Lang');
        $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        switch ($task){
            case "":
                $sql = "--Do nguon don vi" .PHP_EOL;
                $sql .= "EXEC W38P0001 '$divisionHR', '$tranMonth', '$tranYear','$UserID', 1";
                \Debugbar::info($sql);
                $cbDivision = $this->connectionHR->select($sql);
                \Debugbar::info($cbDivision);

                $now = getdate(); //lay ngay thang nam hien tai
                $FromDate = "01/01/".$now['year'].""; //ngay dau tien cua nam
                $ToDate = "12/31/".$now['year'].""; //ngay cuoi cung cua nam
                $sql1 = "--Do nguon ke hoach dao tao" .PHP_EOL;
                $sql1 .= "EXEC W38P2048 '$divisionHR', '$lang', '', '', '$FromDate','$ToDate', 0";
                \Debugbar::info($sql1);
                $cbPlanTran = $this->connectionHR->select($sql1);
                \Debugbar::info($cbPlanTran);

                $sql2 = "--Do nguon loai hinh dao tao" .PHP_EOL;
                $sql2 .= "SELECT ID AS TrainningTypeID, Name84 AS TrainningTypeName".PHP_EOL;
                $sql2 .= "FROM W38N5555 ('D38F3010','TrainningType')";
                \Debugbar::info($sql2);
                $cbTranType = $this->connectionHR->select($sql2);
                \Debugbar::info($cbTranType);

                $sql3 = "--Do combo thang" .PHP_EOL;
                $sql3 .= "EXEC W38P0001 '$divisionHR', '$tranMonth', '$tranYear','$UserID', 0";
                \Debugbar::info($sql3);
                $cbMonthYear = $this->connectionHR->select($sql3);
                \Debugbar::info($cbMonthYear);
                return View::make("W3X.W38.W38F3010", compact("pForm", "g", "titleW38F3010", "cbDivision", "cbPlanTran","cbTranType", "department" ,"cbMonthYear"));
                break;

            case "filter":
                \Debugbar::info(Input::all());
                $TrainingPlanID = Input::get('cbTrainingPlanIDW38F3010');
                $TrainningTypeID = Input::get('cbTrainningTypeIDW38F3010');
                if($TrainningTypeID == 'All'){
                    $TrainningTypeID = '';
                }
                $DivisionID = Input::get('cbDivisionIDW38F3010');
                $DepartmentID = Input::get('cbDepartmentIDW38F3010');
                $PeriodFrom = Input::get('txtPeriodFromW38F3010');
                $PeriodTo = Input::get('txtPeriodToW383010');
                $arrFrom = explode("/", $PeriodFrom); //tách ngày thành mảng
                $TranMonthFrom = $arrFrom[0];
                $TranYearFrom = $arrFrom[1];
                $arrTo = explode("/", $PeriodTo); //tách ngày thành mảng
                $TranMonthTo = $arrTo[0];
                $TranYearTo = $arrTo[1];
                $sql = "--Do nguon grid" .PHP_EOL;
                $sql .= "EXEC W38P3010 '$DivisionID', '$tranMonth', '$tranYear','$TrainingPlanID','$TrainningTypeID','$DepartmentID',$TranMonthFrom,$TranYearFrom,$TranMonthTo,$TranYearTo";
                \Debugbar::info($sql);
                $valueGrid = $this->connectionHR->select($sql);
                \Debugbar::info($valueGrid);
                return $valueGrid;
                break;

            case "monthChange":
                \Debugbar::info(Input::all());
                $PeriodFrom = Input::get('PeriodFrom');
                $PeriodTo = Input::get('PeriodTo');
                $arrTo = explode("/", $PeriodTo); //tách ngày thành mảng
                $TranMonthTo = $arrTo[0];
                $TranYearTo = $arrTo[1];
                $dayTo = 0;
                if(intval($TranMonthTo) == 1 || intval($TranMonthTo) ==3 || intval($TranMonthTo) ==5 || intval($TranMonthTo) ==7 || intval($TranMonthTo) ==8 || intval($TranMonthTo) ==10 || intval($TranMonthTo) ==12){
                    $dayTo = "31";
                }
                if(intval($TranMonthTo) == 4 || intval($TranMonthTo) == 6 || intval($TranMonthTo) == 9 || intval($TranMonthTo) == 11 ){
                    $dayTo = "30";
                }
                if(intval($TranMonthTo) == 2){
                    if (intval($TranYearTo) % 100 == 0)
                    {
                        // nêu chia hết cho 400 thì là năm nhuận
                        if (intval($TranYearTo) % 400 == 0){
                            $dayTo = "29";
                        }
                        else { // ngược lại không phải năm nhuận
                            $dayTo  = "28";
                        }
                    }
                    else if (intval($TranYearTo) % 4 == 0){ // trường hợp chia hết cho 4 thì là năm nhuận
                        $dayTo  = "29";
                    }
                    else { // cuối cùng trường hợp không phải năm nhuận
                        $dayTo  = "28";
                    }
                }
                $dateFrom = Helpers::convertDate("01/".$PeriodFrom."");
                $dateTo = Helpers::convertDate("".$dayTo."/".$PeriodTo."");
                $sql = "--Do nguon ke hoach dao tao" .PHP_EOL;
                $sql .= "EXEC W38P2048 '$divisionHR', '$lang', '', '', $dateFrom, $dateTo, 0";
                \Debugbar::info($sql);
                $cbPlanTran = $this->connectionHR->select($sql);
                \Debugbar::info($cbPlanTran);
                $str = "";
                foreach ($cbPlanTran as $row) {
                    $str .= "<option value='" . $row["TrainingPlanID"] . "'>" . $row["TrainingPlanName"] . "</option>";
                }
                return $str;
                break;
        }
    }


}

