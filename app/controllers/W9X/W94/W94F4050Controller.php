<?php
namespace W9X\W94;

use Auth;
use Carbon\Carbon;
use Debugbar;
use Session;
use View;
use W9X\W9XController;

class W94F4050Controller extends W9XController
{
    /**
     * @param $pFrom
     * @param $g
     * @return \Illuminate\View\View
     */

    public function index($pFrom, $g, $task = '')
    {
        $divisionID = Session::get("W91P0000")['DivisionID'];
        $userID = Auth::user()->user()->UserID;
        $hostID = Session::getId();
        $lang = Session::get('Lang');
        $tranMonth = Session::get("W91P0000")['TranMonth'];
        $tranYear = Session::get("W91P0000")['TranYear'];
        \Debugbar::info(Session::get("W91P0000"));
        switch ($task){
            case '':
                $title = \Input::get('title', '');
                $sql ="--Do nguon ...".PHP_EOL;
                $sql .= "EXEC D10P1071 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "1,".PHP_EOL; //CodeTable, tinyint, NOT NULL
                $sql .= "'$lang',".PHP_EOL; //Language, varchar[10], NOT NULL
                $sql .= "'Budget',".PHP_EOL; //CodeID, varchar[50], NOT NULL
                $sql .= "'W94F4050',".PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key02ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //TransTypeID, varchar[20], NOT NULL
                $sql .= "0,".PHP_EOL; //IsNotL3Division, tinyint, NOT NULL
                $sql .= "''"; //Key03ID, varchar[50], NOT NULL
                $rsBudgetList = $this->connection->select($sql);
                return View::make("W9X.W94.W94F4050", compact('task', 'g', 'rsBudgetList', 'title'));
                break;
            case 'loadperiod':
                $budgetID = \Input::get('budgetID', '');
                $sql ="--Do nguon ...".PHP_EOL;
                $sql .= "EXEC D10P1071 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "1,".PHP_EOL; //CodeTable, tinyint, NOT NULL
                $sql .= "'$lang',".PHP_EOL; //Language, varchar[10], NOT NULL
                $sql .= "'Period',".PHP_EOL; //CodeID, varchar[50], NOT NULL
                $sql .= "'W94F4050',".PHP_EOL; //FormID, varchar[50], NOT NULL
                $sql .= "'$budgetID',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key02ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //TransTypeID, varchar[20], NOT NULL
                $sql .= "0,".PHP_EOL; //IsNotL3Division, tinyint, NOT NULL
                $sql .= "''"; //Key03ID, varchar[50], NOT NULL
                $rsPeriod = $this->connection->select($sql);
                $str = '';
                \Debugbar::info($tranMonth . "/" .$tranYear);
                foreach ($rsPeriod as $row){
                    $selected = "";

                    if ($row["Period"] == $tranMonth . "/" .$tranYear){
                        $selected = "selected";
                    }
                    $str .= '<option value="'.$row["Period"].'" tranmonth="'.$row["TranMonth"].'" tranyear="'.$row["TranYear"].'" '.$selected.'>'.$row["Period"].'</option>';
                }
                return $str;
                break;
            case 'filter':
                $periodForm = \Input::get('cboPeriodFromW94F4050', '');
                $periodTo = \Input::get('cboPeriodToW94F4050', '');
                if ($periodForm == ''){
                    $periodForm = $periodTo;
                }
                if ($periodTo == ''){
                    $periodTo = $periodForm;

                }
                $budgetID = \Input::get('cboBudgetIDW94F4050', '');
                $sql ="--Do nguon ...".PHP_EOL;
                $sql .= "EXEC W10P4050 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'$periodForm',".PHP_EOL; //PeriodFrom, varchar[10], NOT NULL
                $sql .= "'$periodTo',".PHP_EOL; //PeriodTo, varchar[10], NOT NULL
                $sql .= "'$budgetID'"; //BudgetID, varchar[50], NOT NULL
                \Debugbar::info($sql);
                $rsData = ($this->connection->select($sql)) ;
                return $rsData;
        }



    }
}

