<?php
namespace W9X\W94;

use Auth;
use Carbon\Carbon;
use Debugbar;
use Session;
use View;
use W9X\W9XController;

class W94F4001Controller extends W9XController
{
    /**
     * @param $pFrom
     * @param $g
     * @return \Illuminate\View\View
     */

    public function index($pFrom, $g, $task = '')
    {
        \Debugbar::info(Session::get("W91P0000"));
        $divisionID = Session::get("W91P0000")['DivisionID'];
        $userID = Auth::user()->user()->UserID;
        $hostID = Session::getId();
        $lang = Session::get('Lang');
        $tranMonth = Session::get("W91P0000")['TranMonth'];
        $tranYear = Session::get("W91P0000")['TranYear'];
        $title = \Input::get('title', '');
        switch ($task){
            case '':
                $sql ="--Do nguon Ky".PHP_EOL;
                $sql .= "EXEC W94P4000 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'W94F4001',".PHP_EOL; //ReportID, varchar[50], NOT NULL
                $sql .= "'Period',".PHP_EOL; //CodeID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key02ID, varchar[50], NOT NULL
                $sql .= "''"; //Key03ID, varchar[50], NOT NULL
                \Debugbar::info($sql);
                $rsPeriod = $this->connection->select($sql);
                \Debugbar::info($rsPeriod);
                $sql ="--Do nguon Khach hang".PHP_EOL;
                $sql .= "EXEC W94P4000 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'W94F4001',".PHP_EOL; //ReportID, varchar[50], NOT NULL
                $sql .= "'Customer',".PHP_EOL; //CodeID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key02ID, varchar[50], NOT NULL
                $sql .= "''"; //Key03ID, varchar[50], NOT NULL
                \Debugbar::info($sql);
                $rsCustomers = $this->connection->select($sql);
                \Debugbar::info($rsCustomers);


                $customerID = \Input::get('customerID', '');
                $sql ="--Do nguon Khach hang".PHP_EOL;
                $sql .= "EXEC W94P4000 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'W94F4001',".PHP_EOL; //ReportID, varchar[50], NOT NULL
                $sql .= "'Inventory',".PHP_EOL; //CodeID, varchar[50], NOT NULL
                $sql .= "'%',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key02ID, varchar[50], NOT NULL
                $sql .= "''"; //Key03ID, varchar[50], NOT NULL
                \Debugbar::info($sql);
                $rsProducts = $this->connection->select($sql);
                \Debugbar::info($rsProducts);
                return View::make("W9X.W94.W94F4001", compact('rsProducts','rsCustomers','rsPeriod','task', 'g', 'title'));
                break;
            case 'loadproduct':
                $customerID = \Input::get('customerID', '');
                $sql ="--Do nguon Khach hang".PHP_EOL;
                $sql .= "EXEC W94P4000 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "'W94F4001',".PHP_EOL; //ReportID, varchar[50], NOT NULL
                $sql .= "'Inventory',".PHP_EOL; //CodeID, varchar[50], NOT NULL
                $sql .= "'$customerID',".PHP_EOL; //Key01ID, varchar[50], NOT NULL
                $sql .= "'',".PHP_EOL; //Key02ID, varchar[50], NOT NULL
                $sql .= "''"; //Key03ID, varchar[50], NOT NULL
                \Debugbar::info($sql);
                $rsProducts = $this->connection->select($sql);
                \Debugbar::info($rsProducts);
                $str = '';
                foreach ($rsProducts as $row){
                    $str .= '<option value="'.$row["InventoryID"].'">'.$row["InventoryName"].'</option>';
                }
                return $str;
                break;
            case 'loadgrid':
                $optIsPeriodW94F4001 = \Input::get('optIsPeriodW94F4001', 1);
                $cboPeriodFromW94F4001 = \Input::get('cboPeriodFromW94F4001','');
                $cboPeriodToW94F4001 = \Input::get('cboPeriodToW94F4001','');
                $txtDateFromW94F4001 = \Helpers::convertDate(\Input::get('txtDateFromW94F4001',''));
                $txtDateToW94F4001 = \Helpers::convertDate(\Input::get('txtDateToW94F4001',''));
                $customer = \Input::get('customer','');
                $product = \Input::get('product','');

                $sql ="--Do nguon ...".PHP_EOL;
                $sql .= "EXEC W94P4001 " .PHP_EOL;
                $sql .= "'$divisionID',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                $sql .= "'$userID',".PHP_EOL; //UserID, varchar[50], NOT NULL
                $sql .= "$optIsPeriodW94F4001,".PHP_EOL; //IsPeriod, tinyint, NOT NULL
                $sql .= "'$cboPeriodFromW94F4001',".PHP_EOL; //PeriodFrom, varchar[50], NOT NULL
                $sql .= "'$cboPeriodToW94F4001',".PHP_EOL; //PeriodTo, varchar[50], NOT NULL
                $sql .= "$txtDateFromW94F4001,".PHP_EOL; //DateFrom, datetime, NOT NULL
                $sql .= "$txtDateToW94F4001,".PHP_EOL; //DateTo, datetime, NOT NULL
                $sql .= "'$customer',".PHP_EOL; //CustomerID, varchar[50], NOT NULL
                $sql .= "'$product'"; //InventoryID, varchar[50], NOT NULL
                Debugbar::info($sql);
                $rsProducts = $this->connection->select($sql);
                \Debugbar::info($rsProducts);
                return json_encode($rsProducts);
                return View::make("W9X.W94.W94F4001_Grid", compact('task', 'g', 'title', 'rsColumns', 'rsData'));
                break;
        }



    }
}

