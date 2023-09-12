<?php

namespace W7X\W76;

use Debugbar;
use Helpers;
use Request;
use Session;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F4050Controller extends W7XController
{
    public function index($g)
    {
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        if (Request::isMethod('post')) {
            $all = Input::all();
            $capacity = intval($all["txtCapacity"]);
            $location = $all["txtLocation"];
            $requestDate = Input::get("txtRequestedDate", "");
            $reqDate = Helpers::convertDate($requestDate);
            $chkblack = isset($all["chkIsBlackboard"]) ? 1 : 0;
            $chkpro = isset($all["chkIsProjector"]) ? 1 : 0;
            $chkether = isset($all["chkIsEthernet"]) ? 1 : 0;
            $chkmicro = isset($all["chkIsMicrophone"]) ? 1 : 0;
            $chkpc = isset($all["chkIsPC"]) ? 1 : 0;
            $chktel = isset($all["chkIsTeleCon"]) ? 1 : 0;
            $chkvideo = isset($all["chkIsVideoCon"]) ? 1 : 0;
            $chkwifi = isset($all["chkIsWifi"]) ? 1 : 0;

            $sql = "--Do nguon combo PH" . PHP_EOL;
            $sql .= "EXEC W76P2062 '$userid', $capacity, N'$location', null, null, $chkblack,$chkpro,$chkether,$chkmicro,$chkpc,$chktel,$chkvideo,$chkwifi, 0";
            $rsFacility = $this->connectionHR->select($sql);
            $strFacility = '';
            foreach ($rsFacility as $row) {
                $strFacility .= '<option value="' . $row['FacilityID'] . '">' . $row['FacilityNo'] . ' - ' . $row['FacilityName'] . '</option>';
            }

            $sql = "--Do nguon FieldName, Caption phong hop" . PHP_EOL;
            $sql .= "EXEC W76P2060 '$userid', 1, $capacity, N'$location', $reqDate, $chkblack, $chkpro, $chkether, $chkmicro, $chkpc, $chktel, $chkvideo, $chkwifi";
            $rsCaption = $this->connectionHR->select($sql);
            //Lấy thiết lập hệ thống
            $sys = $this->connectionHR->select("SELECT CONVERT(VARCHAR (8), BookingTimeFrom) as BookingTimeFrom, CONVERT(VARCHAR (8), BookingTimeTo) as BookingTimeTo, StartOfWeek from D76T0000");
            $bookingTimeFrom = isset($sys[0]['BookingTimeFrom']) ? $sys[0]['BookingTimeFrom'] : "07:00:00";
            $bookingTimeTo = isset($sys[0]['BookingTimeTo']) ? $sys[0]['BookingTimeTo'] : "18:00:00";
            $startOfWeek = intval(isset($sys[0]['StartOfWeek']) ? $sys[0]['StartOfWeek'] : "1");
            return View::make("W7X.W76.W76F4050_Calendar", compact('rsCaption', 'requestDate', 'all', 'strFacility', 'bookingTimeFrom', 'bookingTimeTo', 'startOfWeek'));
        }
        $caption = $this->getModalTitle("D76F4050");
        $sql = "--Do nguon phong hop" . PHP_EOL;
        $sql .= "EXEC W76P2060 '$userid', 1, 0, N'', null, 0, 0, 0, 0, 0, 0, 0, 0";
        $rsRoom = $this->connectionHR->select($sql);
        $sql = "-- Combo Trang thai" . PHP_EOL;
        $sql .= "SELECT * FROM	W76V0001 WITH(NOLOCK)";
        $rsStatus = $this->connectionHR->select($sql);
        //Lấy thiết lập hệ thống
        $sys = $this->connectionHR->select("SELECT CONVERT(DECIMAL(28,8),DATEDIFF(MINUTE,'00:00',BookingTimeFrom))/60 as BookingTimeFrom, CONVERT(DECIMAL(28,8),DATEDIFF(MINUTE,'00:00',BookingTimeTo))/60 as BookingTimeTo, StartOfWeek from D76T0000");
        $BookingTimeFrom = isset($sys[0]['BookingTimeFrom']) ? $sys[0]['BookingTimeFrom'] : "07:00";
        $BookingTimeTo = isset($sys[0]['BookingTimeTo']) ? $sys[0]['BookingTimeTo'] : "18:00";
        $StartOfWeek = isset($sys[0]['StartOfWeek']) ? $sys[0]['StartOfWeek'] : "1";
        return View::make("W7X.W76.W76F4050", compact('g', 'caption', 'rsRoom', 'rsStatus', 'userid', 'BookingTimeFrom', 'BookingTimeTo', 'StartOfWeek'));
    }

    public function loadCalendar()
    {
        if (Request::isMethod('post')) {
            $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
            $all = Input::get('array', []);
            $start = Input::get('start', date('Y-m-d'));
            $end = Input::get('end', date('Y-m-d'));
            $faci = intval(Input::get('faci', 0));
            $viewmode = Input::get('view', 'agendaDay');
            if ($viewmode == 'agendaDay')
                $faci = 0;
            $capacity = intval($all["txtCapacity"]);
            $location = $all["txtLocation"];
            $chkblack = isset($all["chkIsBlackboard"]) ? 1 : 0;
            $chkpro = isset($all["chkIsProjector"]) ? 1 : 0;
            $chkether = isset($all["chkIsEthernet"]) ? 1 : 0;
            $chkmicro = isset($all["chkIsMicrophone"]) ? 1 : 0;
            $chkpc = isset($all["chkIsPC"]) ? 1 : 0;
            $chktel = isset($all["chkIsTeleCon"]) ? 1 : 0;
            $chkvideo = isset($all["chkIsVideoCon"]) ? 1 : 0;
            $chkwifi = isset($all["chkIsWifi"]) ? 1 : 0;
            $sql = "--Do nguon du lieu phong hop" . PHP_EOL;
            $sql .= "EXEC W76P2062 '$userid', $capacity, N'$location', '$start', '$end', $chkblack,$chkpro,$chkether,$chkmicro,$chkpc,$chktel,$chkvideo,$chkwifi, 0, 1, $faci";
            $rsData = $this->connectionHR->select($sql);
            return json_encode($rsData);
        }
    }

    public function bookingRequest()
    {
        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        if (Request::isMethod('post')) {
            $mode = Input::get("mode", -1);
            if ($mode == 1) {//hủy
                $id = Input::get("bookid", -1);
                $sql = "DELETE D76T2030 WHERE BookingID=$id";
                return intval($this->connectionHR->statement($sql));
            } elseif ($mode == 2) {//Điều chỉnh booking
                $id = intval(Input::get("bookid", -1));
                $dateid = Input::get("date", '');
                $facility = intval(Input::get("room", -1));
                $timefrom = Input::get("timefrom", "");
                $timeto = Input::get("timeto", "");
                if ($dateid != '' && $timefrom != '') {
                    $sql = "--Luu du lieu phong hop" . PHP_EOL;
                    $sql .= "EXEC W76P2063 '$userid','" . Session::get('Lang') . "',1, '$id', '$facility','$timefrom','$timeto', '$dateid'";
                    $rsCheck = $this->connectionHR->selectOne($sql);
                    return json_encode($rsCheck);
                }
                return json_encode(['code' => 0]);
            } else {
                $all = Input::all();
                \Debugbar::info($all);
                $facility = intval($all["slFacilityNo"]);
                $timefrom = ($all["txtTimeFrom"]);
                $timeto = ($all["txtTimeTo"]);
                $rs = $this->checkW76P5555("A", "W76F4050", "R", $facility, $timefrom, $timeto, "", "", 0, 0, 0, 0, 0, Helpers::convertDate($all["txtRequestedDate"]));
                if ($rs["Status"] == 0) {
                    $sql = "--Luu them moi" . PHP_EOL;
                    $sql .= "Insert Into D76T2030(";
                    $sql .= "FacilityID, TimeFrom, TimeTo, UserID, ";
                    $sql .= "StatusID, Description, ";
                    $sql .= "CreateDate, CreateUserID, RequestedDate";
                    $sql .= ") Output Inserted.BookingID Values(";
                    $sql .= " $facility, '$timefrom', '$timeto', '$userid', ";
                    $sql .= " '" . Input::get("slStatusID", 1) . "',  N'" . $this->sqlstring($all["txtDescription"]) . "', ";
                    $sql .= " GETDATE(), '$userid', " . Helpers::convertDate($all["txtRequestedDate"]);
                    $sql .= ")";
                    $bookid = intval($this->connectionHR->selectOne($sql)["BookingID"]);
                    $sql = "-- Get booking data saved" . PHP_EOL;
                    $sql .= "EXEC W76P2062 '" . Auth::user()->User()->UserID . "', 1, '', null, null, 0,0,0,0,0,0,0,0, $bookid, 1";
                    $rsData = $this->connectionHR->selectOne($sql);
                    $rsData['code'] = 0;
                    return json_encode($rsData);
                } else {
                    return json_encode(["code" => 1, "mess" => $rs["Message"]]);
                }
            }
        }
    }

}
