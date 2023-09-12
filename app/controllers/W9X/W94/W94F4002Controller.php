<?php
namespace W9X\W94;

use Auth;
use Carbon\Carbon;
use Debugbar;
use Session;
use View;
use W9X\W9XController;

class W94F4002Controller extends W9XController
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
        $title = \Input::get('title', '');
        switch ($task){
            case '':
                $sql ="--Do nguon Year".PHP_EOL;
                $sql .= "EXEC W94P4000 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'W94F4002',".PHP_EOL; //ReportID, varchar[50], NOT NULL
                $sql .= "'Year',".PHP_EOL; //CodeID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key02ID, varchar[50], NOT NULL
                $sql .= "''"; //Key03ID, varchar[50], NOT NULL
                \Debugbar::info($sql);
                $rsYear = $this->connection->select($sql);
                \Debugbar::info($rsYear);
                $sql ="--Do nguon Division".PHP_EOL;
                $sql .= "EXEC W94P4000 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'W94F4002',".PHP_EOL; //ReportID, varchar[50], NOT NULL
                $sql .= "'Division',".PHP_EOL; //CodeID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key02ID, varchar[50], NOT NULL
                $sql .= "''"; //Key03ID, varchar[50], NOT NULL
                \Debugbar::info($sql);
                $rsDivision = $this->connection->select($sql);
                \Debugbar::info($rsDivision);

                return View::make("W9X.W94.W94F4002", compact('rsDivision','rsYear','task', 'g', 'rsBudgetList', 'title'));
                break;

            case 'loaddepartment':
                $divisionID = \Input::get('divisionIDList', '');
                $sql ="--Do nguon Department".PHP_EOL;
                $sql .= "EXEC W94P4000 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'W94F4002',".PHP_EOL; //ReportID, varchar[50], NOT NULL
                $sql .= "'Department',".PHP_EOL; //CodeID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key02ID, varchar[50], NOT NULL
                $sql .= "''"; //Key03ID, varchar[50], NOT NULL
                \Debugbar::info($sql);
                $rsDepartment = $this->connection->select($sql);
                $str = '';
                foreach ($rsDepartment as $row){
                    $str .= '<option title= "'.$row["DepartmentID"].'" value="'.$row["DepartmentID"].'" >'.$row["DepartmentName"].'</option>';
                }
                return $str;
                break;

            case 'loadgrid':
                $optIsYearW94F4002 = \Input::get('optIsYearW94F4002', 1);
                $cboDivisionW94F4002 = \Input::get('cboDivisionW94F4002', 1);
                $cboYearW94F4002 = \Input::get('cboYearW94F4002', 1);
                $cboDepartmentW94F4002 = \Input::get('cboDepartmentW94F4002', 1);
                $divisionIDList = \Input::get('divisionIDList', 1);
                $departmentIDList = \Input::get('departmentIDList', 1);
                $sql ="--Do nguon ...".PHP_EOL;
                $sql .= "EXEC W94P4002 " ;
                $sql .= "'$divisionIDList',"; //DivisionID, varchar[250], NOT NULL
                $sql .= "'$userID',"; //UserID, varchar[50], NOT NULL
                $sql .= "$optIsYearW94F4002,"; //IsYear, tinyint, NOT NULL
                $sql .= "$cboYearW94F4002,"; //TranYear, int, NOT NULL
                $sql .= "'$departmentIDList',"; //DepartmentID, varchar[250], NOT NULL
                $sql .= "0"; //Mode, tinyint, NOT NULL
                \Debugbar::info($sql);
                $rsColumns = $this->connection->select($sql);
                $sql ="--Do nguon ...".PHP_EOL;
                $sql .= "EXEC W94P4002 " ;
                $sql .= "'$divisionIDList',"; //DivisionID, varchar[250], NOT NULL
                $sql .= "'$userID',"; //UserID, varchar[50], NOT NULL
                $sql .= "$optIsYearW94F4002,"; //IsYear, tinyint, NOT NULL
                $sql .= "$cboYearW94F4002,"; //TranYear, int, NOT NULL
                $sql .= "'$departmentIDList',"; //DepartmentID, varchar[250], NOT NULL
                $sql .= "1"; //Mode, tinyint, NOT NULL
                \Debugbar::info($sql);
                $rsData = $this->connection->select($sql);
                $rsData = json_encode($rsData);
                return View::make("W9X.W94.W94F4002_Grid", compact('task', 'g', 'title', 'rsColumns', 'rsData'));
                break;
        }



    }
}

