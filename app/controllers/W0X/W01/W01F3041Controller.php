<?php

namespace W0X\W01;

use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Auth;
use W0X\W0XController;

class W01F3041Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {

        $userid = Auth::user()->user()->UserID;
        $modalTitle = $this->getModalTitle($pForm);
        switch ($task) {
            case "":
                $division = Input::get('divisionID', '');
                $subdiv = '';
                $property = Input::get('projectID', '');
                $yearshow = Input::get('yearShow', '');
                $showdetail = 0;
                $chkIsReceive = 0;
                $chkIsPayment = 1;
                $isStore = 0;
                $isAll = 0;
                $formID = "W01F3041";

                $sql = "--Do nguon cot dong" . PHP_EOL;
                $sql .= "EXEC W01P3040 '$division','$subdiv','$property', $yearshow , $showdetail, $chkIsReceive,$chkIsPayment, $isStore, $isAll, '$formID' ";
                $rsCol = $this->connection->select($sql);
                \Debugbar::info($sql);

                $subDivisionID = '';
                $reportDate = \Helpers::convertDate( Input::get('reportDate', ''));
                $session = Session::getId();
                $mode = 2;
                $dateID = Input::get("dateID", "");
                $sql = "--Do nguon du lieu" . PHP_EOL;
                $sql .= "EXEC W01P3041 '$division', '$userid', '$subDivisionID', '$property', $reportDate, $yearshow, $showdetail, $chkIsReceive,$chkIsPayment, '$session',$mode, '$dateID'";

                $rsData = $this->connection->select($sql);
                \Debugbar::info($sql);
                return View::make("W0X.W01.W01F3041", compact('pForm', 'g', 'modalTitle', 'rsCol', 'rsData'));
                break;

        }
    }

}
