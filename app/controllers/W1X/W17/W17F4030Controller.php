<?php

namespace W1X\W17;

use Auth;
use Exception;
use Input;
use Request;
use Session;
use View;
use W1X\W1XController;
use Debugbar;

class W17F4030Controller extends W1XController
{
    public function index($pForm, $g, $task = '')
    {
        $divisionID = Session::get("W91P0000")['DivisionID'];
        $userID = Auth::user()->user()->UserID;
        $Language = Session::get('Lang');
        $sessionID = Session::getId();





        switch ($task) {
            case '':
                $sql = '--Do nguon combo nhan vien'.PHP_EOL;
                $sql .= "Exec W76P2311 '$userID', '$sessionID', 3";
                $employees = $this->connection->select($sql);

                $sql = '--Do nguon combo cong ty'.PHP_EOL;
                $sql .= "Exec W76P2311 '$userID', '$sessionID', 2";
                $companies = $this->connection->select($sql);

                return View::make("W1X.W17.W17F4030", compact('companies', 'employees', "g", "pForm", "task"));
                break;

            case 'filter':
                $cboStrSalesPersonCode =  \Helpers::decryptData(Input::get('strSalesPersonCode', [])) ;
                if (count($cboStrSalesPersonCode) > 0)
                    $cboStrSalesPersonCode = implode(",",$cboStrSalesPersonCode);

                $cboStrCompanyCode = \Helpers::decryptData(Input::get('strCompanyCode', []));
                if (count($cboStrCompanyCode) > 0)
                    $cboStrCompanyCode = implode(",",$cboStrCompanyCode);

                $isPerson = Input::get('optIsPersonW17F4030', 1);
                $DateFromW17F4030 = \Helpers::convertDate(Input::get('txtDateFromW17F4030', ''));
                $DateToW17F4030 = \Helpers::convertDate(Input::get('txtDateToW17F4030', ''));


                $sql = "-- Khoi tao cot dong " . PHP_EOL;
                $sql .= "EXEC W17P4030 '$divisionID', '$userID', '$sessionID', 1, '$Language', $DateFromW17F4030, $DateToW17F4030, $isPerson" . PHP_EOL;


                $rsColumns = $this->connection->select($sql);


                $rsData = [];
                $sql = "-- Do du lieu " . PHP_EOL;
                $sql .= "EXEC W17P4030 '$divisionID', '$userID', '$sessionID', 2, '$Language', $DateFromW17F4030, $DateToW17F4030, $isPerson, '', '', '$cboStrSalesPersonCode', '$cboStrCompanyCode'" . PHP_EOL;
                \Debugbar::info($sql);
                //return $sql;
                $rsData = $this->connection->select($sql);

                return View::make("W1X.W17.W17F4030Grid", compact("userID","g", "pForm", "task", "rsColumns", "rsData","isPerson"));

                break;
            case 'detail':
                $isPerson = Input::get('isPerson', 1);
                \Debugbar::info($isPerson);

                $DateFromW17F4030 = \Helpers::convertDate(Input::get('txtDateFromW17F4030', ''));
                $DateToW17F4030 = \Helpers::convertDate(Input::get('txtDateToW17F4030', ''));

                $SalesPersonCode= Input::get('SalesPersonCode');
                $CompanyCode = Input::get( 'CompanyCode');

               $sql = "-- Khoi tao cot dong " . PHP_EOL;
                $sql .= "EXEC W17P4030 '$divisionID', '$userID', '$sessionID', 3, '$Language', $DateFromW17F4030, $DateToW17F4030, $isPerson,'$CompanyCode','$SalesPersonCode'" . PHP_EOL;
                $rsColumns = $this->connection->select($sql);

                $rsData = [];
                $sql = "-- Do du lieu " . PHP_EOL;
                $sql .= "EXEC W17P4030 '$divisionID', '$userID', '$sessionID', 4, '$Language', $DateFromW17F4030, $DateToW17F4030, $isPerson,'$CompanyCode','$SalesPersonCode'" . PHP_EOL;
                $rsData = $this->connection->select($sql);
                return View::make("W1X.W17.W17F4030_detail", compact("g", "pForm", "task","rsColumns","rsData"));




                break;


        }
    }
}