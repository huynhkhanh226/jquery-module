<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 07/12/2017
 * Time: 8:48 AM
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

class W38F2021Controller extends W3XController
{
    public function index($pForm, $g, $task = '')
    {
        $pForm = 'D38F2021';
        \Debugbar::info($pForm);
        $titleW38F2021 = $this->getModalTitle($pForm);
        $employeeID = Auth::user()->user()->HREmployeeID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $creatorName = Session::get("W91P0000")['CreatorNameHR'];
        $creatorID = Session::get("W91P0000")['CreatorHR'];
        \Debugbar::info($creatorID);
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $UserID = Auth::user()->user()->UserID;
        $session = Session::getId();
        $lang = Session::get('Lang');
        switch($task){
            case "view":
                $employeeInfo = Input::all();
                \Debugbar::info($employeeInfo);
                $DivisionID = $employeeInfo['DivisionID'];
                $TrainingPlanID = $employeeInfo['TrainingPlanID'];
                $PlanTransID = $employeeInfo['PlanTransID'];
                $TrainingFieldID = $employeeInfo['TrainingFieldID'];
                $ProposalID = $employeeInfo['ProposalID'];
                $sql = "--Do nguon cho luoi".PHP_EOL;
                $sql .= "EXEC W38P2021 '$DivisionID','$TrainingPlanID','$PlanTransID','$TrainingFieldID','$ProposalID','$UserID','D38F3010'";
                \Debugbar::info($sql);
                $valueGrid = $this->connectionHR->select($sql);
                \Debugbar::info($valueGrid);
                return View::make("W3X.W38.W38F2021", compact("pForm", "g","employeeInfo", "titleW38F2021", "valueGrid"));
                break;
        }
    }
}