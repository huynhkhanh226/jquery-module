<?php
namespace W7X\W76;

use Auth;
use Illuminate\Support\Facades\Input;
use Request;
use View;
use W7X\W7XController;
use Debugbar;

class W76F0001Controller extends W7XController
{
    public function index($pForm, $g)
    {
        if (Request::isMethod("get")) {
            $sql = "SELECT * FROM D76T0000 WITH(NOLOCK)";
            $rsData = $this->connectionHR->select($sql);
            $caption = $this->getModalTitle($pForm);
            return View::make("W7X.W76.W76F0001", compact('pForm', 'g', 'rsData', 'caption'));
        } else {
            //$userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
            $timefrom = Input::get("txtTimeFrom", "08:00");
            $timeto = Input::get("txtTimeTo", "17:00");
            $startweek = intval(Input::get("optStartOfWeek", 1));
            $sql = "--Luu du lieu" . PHP_EOL;
            $sql .= "IF EXISTS (SELECT TOP 1 1 FROM D76T0000 WITH(NOLOCK))" . PHP_EOL;
            $sql .= "Update D76T0000 Set ";
            $sql .= "BookingTimeFrom = '$timefrom',";
            $sql .= "BookingTimeTo = '$timeto', ";
            $sql .= "StartOfWeek = $startweek". PHP_EOL;
            $sql .= " ELSE ". PHP_EOL;
            $sql .="Insert Into D76T0000(BookingTimeFrom, BookingTimeTo, StartOfWeek)";
            $sql .=" Values ('$timefrom', '$timeto', $startweek)";
            return intval($this->connectionHR->statement($sql));
        }
    }

}
