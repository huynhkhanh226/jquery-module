<?php
namespace W7X\W75;
use Auth;
use Carbon\Carbon;
use D75T1010;
use DB;
use Exception;
use Input;
use Request;
use Session;
use View;
use W7X\W7XController;

class W75F1010Controller extends W7XController {

    public function index($action,$pro="") {
        \Debugbar::info($action);
        $employeeid= (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
        $g=4;
        $lang = Session::get('Lang');
        //$modalTitle= $this->getModalTitleG4("W75F3010");
        if ($action == "reloadForm"){
            $sql2 = "-- Combo phuong/xa" . PHP_EOL;
            $sql2 .= "EXEC D09P1509 '$lang', 1, 'XA/PHUONG',''";
            \Debugbar::info($sql2);
            $rsWard = $this->connectionHR->select($sql2);
            \Debugbar::info($rsWard);
            $str = "<option value=''></option>";
            foreach ($rsWard as $row) {
                $str .= "<option WardName='" . $row["Name"] . "' value='" . $row["Code"] . "'>" . $row["Name"] . "</option>";
            }
            return $str;
        }
        if ($action=="table")
        {
            \Debugbar::info("Select E.TransID, E.PropertyID, V.Desc84 as PropertyName, E.Notes, E.PropertyValueU, Convert(varchar(20), E.TransDate, 103) as TransDate, E.Approved, E.Deleted, E.TransDate as SortDate, E.ProvinceID, E.DistrictID, E.WardID, E.AddressName, E.LabelProvince, E.LabelDistrict, E.LabelWard From D75T1010 E Left Join D91T0500 V On E.PropertyID = V.SKey And V.DataID = 'PersonalDataID' Where E.TransUserID ='".$employeeid."' And PropertyID='".$pro."' Order By SortDate DESC");
            //$rs = $this->connectionHR->select("Select E.TransID, E.PropertyID, V.Desc".Session::get('Lang')." as PropertyName, E.Notes, E.PropertyValueU, Convert(varchar(20), E.TransDate, 103) as TransDate, E.Approved, E.Deleted, E.TransDate as SortDate From D75T1010 E Left Join D91T0500 V On E.PropertyID = V.SKey And V.DataID = 'PersonalDataID' Where E.TransUserID ='".$employeeid."' And PropertyID='".$pro."' Order By SortDate DESC");
            $rs = $this->connectionHR->select("Select E.TransID, E.PropertyID, V.Desc84 as PropertyName, E.Notes, E.PropertyValueU, Convert(varchar(20), E.TransDate, 103) as TransDate, E.Approved, E.Deleted, E.TransDate as SortDate, E.ProvinceID, E.DistrictID, E.WardID, E.AddressName, E.LabelProvince, E.LabelDistrict, E.LabelWard From D75T1010 E Left Join D91T0500 V On E.PropertyID = V.SKey And V.DataID = 'PersonalDataID' Where E.TransUserID ='".$employeeid."' And PropertyID='".$pro."' Order By SortDate DESC");
            return View::make("W7X.W75.W75F1010_Ajax", compact('g','employeeid', 'pro','rs'));
        }
        if(Request::isMethod("post")) {
            $val= Input::get('txtW75F1010_Val');
            $note= Input::get('txtW75F1010_Note');
            $ProvinceID= Input::get('slProvinceIDW75F1010');
            $DistrictID= Input::get('slDistrictIDW75F1010');
            $WardID= Input::get('slWardIDW75F1010');
            $AddressName= Input::get('slAddressNameW75F1010');
            $LabelProvince= Input::get('slLabelProvinceW75F1010');
            $LabelDistrict= Input::get('slLabelDistrictW75F1010');
            $LabelWard= Input::get('slLabelWardW75F1010');
            if ($action == "ProvinceChange"){
                //\Debugbar::info(Input::all());
                $ProvinceID = Input::get('slProvinceID');
                $sql = "-- Combo quan/huyen" . PHP_EOL;
                $sql .= "EXEC D09P1509 '$lang', 1, 'QUAN/HUYEN','$ProvinceID'";
                \Debugbar::info($sql);
                $rsDistrict = $this->connectionHR->select($sql);
                \Debugbar::info($rsDistrict);
                $str = "<option value=''></option>";
                foreach ($rsDistrict as $row) {
                    $str .= "<option DistrictName='" . $row["Name"] . "' value='" . $row["Code"] . "'>" . $row["Name"] . "</option>";
                }
                return $str;

            }
            if ($action == "DistrictChange"){
                //\Debugbar::info(Input::all());
                $DistrictID = Input::get('slDistrictID');
                $sql = "-- Combo phuong/xa" . PHP_EOL;
                $sql .= "EXEC D09P1509 '$lang', 1, 'XA/PHUONG','$DistrictID'";
                \Debugbar::info($sql);
                $rsWard = $this->connectionHR->select($sql);
                \Debugbar::info($rsWard);
                $str = "<option value=''></option>";
                foreach ($rsWard as $row) {
                    $str .= "<option WardName='" . $row["Name"] . "' value='" . $row["Code"] . "'>" . $row["Name"] . "</option>";
                }
                return $str;

            }
            if ($action == "checkStore"){
                  $DivisionID = Session::get("W91P0000")['HRDivisionID'];
                  $TranMonth = Session::get("W91P0000")['HRTranMonth'];
                  $TranYear = Session::get("W91P0000")['HRTranYear'];
                  $Language = Session::get('Lang');
                  $UserID = Auth::user()->user()->UserID;

                  $Mode	= 0;
                  $FormID = "D75F1010";
                  $Num01 = 0;
                  $Num02 = 0;
                  $Num03 = 0;
                  $Num04 = 0;
                  $Num05 = 0;
                  $Key01ID  = "NumIDCard";
                  $Key02ID	= $val;
                  $Key03ID	= Auth::user()->user()->HREmployeeID;
                  $Key04ID	= "";
                  $Key05ID = "";
                  $Date01 = \Helpers::convertDate("" );
                  $Date02 = \Helpers::convertDate("" );;
                  $Date03 = \Helpers::convertDate("" );;
                  $Date04 = \Helpers::convertDate("" );;
                  $CodeTable = 1;
                  $Date05 = \Helpers::convertDate("" );;
                  $IsDesktop = 0;
                      $session = Session::getId();

                $sql = " ---- Thuc thi kiem tra trung so CMND".PHP_EOL;
                $sql .= " Exec D09P5555 '$DivisionID' , $TranMonth, $TranYear, '$Language', '$UserID', '$session' , $Mode, '$FormID',".PHP_EOL;
                $sql .= " $Num01, $Num02, $Num03, $Num04, $Num05, '$Key01ID', '$Key02ID', '$Key03ID', '$Key04ID',".PHP_EOL;
                $sql .= " '$Key05ID', $Date01, $Date02, $Date03, $Date04, $CodeTable, $Date05, $IsDesktop ".PHP_EOL;

                \Debugbar::info($sql);
                $rs = $this->connectionHR->select($sql);
                \Debugbar::info($rs);
                return $rs;

            }else if($action=='edit') {
                $tranid= Input::get('hdW75F1010_TransID');
                $row =D75T1010::where("TransID",$tranid)->first();
                $row['PropertyValueU']= $val;
                $row['TransDate']= Carbon::now();
                $row['Notes']= $note;
                $row['IssuedPlaceID']= '';
                if($pro == "PERADDR" || $pro == "PROADDR" || $pro == "EMCONADD1" || $pro == "EMCONADD2" || $pro == "CONADDR") {
                    $row['ProvinceID'] = $ProvinceID;
                    $row['DistrictID'] = $DistrictID;
                    $row['WardID'] = $WardID;
                    $row['AddressName'] = $AddressName;
                    $row['LabelProvince'] = $LabelProvince;
                    $row['LabelDistrict'] = $LabelDistrict;
                    $row['LabelWard'] = $LabelWard;
                }
                if($pro == "NUMIDPLACE") {
                    $row['IssuedPlaceID'] = $val;
                }
                try {
                    $row->save();
                }
                catch(Exception $ex){
                    return 0;
                }
            }
            elseif ($action=='del')
            {
                $tranid= Input::get('hdW75F1010_TransID');
                $row =D75T1010::where("TransID",$tranid)->first();
                try {
                    $row->delete();
                    return 1;
                }
                catch(Exception $ex){
                    return 0;
                }
            }
            else{
                try {
                    \Debugbar::info("da chay save");
                    \Debugbar::info(Input::all());
                    $tranid = date('YmdHis').str_random(4);
                    \Debugbar::info($tranid);
                    $proid= Input::get('slPropertyID');
                    $row= new D75T1010;
                    $row['TransID']= $tranid;
                    $row['PropertyID']= $proid;
                    $row['PropertyValueU']= $val;
                    $row['Notes']= $note;
                    $row['TransUserID']= $employeeid;
                    $row['IssuedPlaceID']= '';
                    if($pro == "PERADDR" || $pro == "PROADDR" || $pro == "EMCONADD1" || $pro == "EMCONADD2" || $pro == "CONADDR") {
                        $row['ProvinceID'] = $ProvinceID;
                        $row['DistrictID'] = $DistrictID;
                        $row['WardID'] = $WardID;
                        $row['AddressName'] = $AddressName;
                        $row['LabelProvince'] = $LabelProvince;
                        $row['LabelDistrict'] = $LabelDistrict;
                        $row['LabelWard'] = $LabelWard;
                    }
                    if($pro == "NUMIDPLACE") {
                       $row['IssuedPlaceID'] = $val;
                    }
                    \Debugbar::info($row);
                    $row->save();
                }catch (Exception $ex) {
                    return 0;
                }
            }
            //$row=$this->connectionHR->select("Select E.TransID, E.PropertyID, V.Desc".Session::get('Lang')." as PropertyName, E.Notes, E.PropertyValueU, Convert(varchar(20), E.TransDate, 103) as TransDate, E.Approved, E.Deleted From D75T1010 E Left Join D91T0500 V On E.PropertyID = V.SKey And V.DataID = 'PersonalDataID' Where E.TransUserID ='".$employeeid."' And TransID='$tranid' And PropertyID='".$pro."' Order By E.TransDate DESC");
            $row = $this->connectionHR->select("Select E.TransID, E.PropertyID, V.Desc84 as PropertyName, E.Notes, E.PropertyValueU, Convert(varchar(20), E.TransDate, 103) as TransDate, E.Approved, E.Deleted, E.TransDate as SortDate, E.ProvinceID, E.DistrictID, E.WardID, E.AddressName, E.LabelProvince, E.LabelDistrict, E.LabelWard From D75T1010 E Left Join D91T0500 V On E.PropertyID = V.SKey And V.DataID = 'PersonalDataID' Where E.TransUserID ='".$employeeid."' And PropertyID='".$pro."' Order By SortDate DESC");
            return json_encode($row);
        }
        else{
            \Debugbar::info($pro);
            $rsProvince = array();
            $rsDistrict = array();
            $rsWard = array();
            if($pro == "PERADDR" || $pro == "PROADDR" || $pro == "EMCONADD1" || $pro == "EMCONADD2" || $pro == "CONADDR") {
                $sql = "-- Combo tinh/thanh pho" . PHP_EOL;
                $sql .= "EXEC D09P1509 '$lang', 1, 'TINH/THANH',''";
                \Debugbar::info($sql);
                $rsProvince = $this->connectionHR->select($sql);
                \Debugbar::info($rsProvince);

                $sql1 = "-- Combo quan/huyen" . PHP_EOL;
                $sql1 .= "EXEC D09P1509 '$lang', 1, 'QUAN/HUYEN',''";
                \Debugbar::info($sql1);
                $rsDistrict = $this->connectionHR->select($sql1);
                \Debugbar::info($rsDistrict);

                $sql2 = "-- Combo phuong/xa" . PHP_EOL;
                $sql2 .= "EXEC D09P1509 '$lang', 1, 'XA/PHUONG',''";
                \Debugbar::info($sql2);
                $rsWard = $this->connectionHR->select($sql2);
                \Debugbar::info($rsWard);

                $sql3 = "-- Combo label tinh/thanh pho" . PHP_EOL;
                $sql3 .= "EXEC D09P1509 '$lang', 1, 'ProvinceLabel',''";
                \Debugbar::info($sql3);
                $cbLabelProvince = $this->connectionHR->select($sql3);
                \Debugbar::info($cbLabelProvince);

                $sql4 = "-- Combo label quan/huyen" . PHP_EOL;
                $sql4 .= "EXEC D09P1509 '$lang', 1, 'DistrictLabel',''";
                \Debugbar::info($sql3);
                $cbLabelDistrict = $this->connectionHR->select($sql4);
                \Debugbar::info($cbLabelDistrict);

                $sql5 = "-- Combo label phuong/xa" . PHP_EOL;
                $sql5 .= "EXEC D09P1509 '$lang', 1, 'WardLabel',''";
                \Debugbar::info($sql5);
                $cbLabelWard = $this->connectionHR->select($sql5);
                \Debugbar::info($cbLabelWard);
            }
            $cbNumIDPlace = array();
            if($pro == "NUMIDPLACE"){
                $sql = "-- Combo gia tri de xuat" . PHP_EOL;
                $sql .= "SELECT ZoneCode As ProvinceID, ZoneNameU AS PropertyName". PHP_EOL;
                $sql .= "FROM D91T1620 WITH(NOLOCK)". PHP_EOL;
                $sql .= "WHERE ZoneLevelID = 'TINH/THANH' And Disabled = 0". PHP_EOL;
                \Debugbar::info($sql);
                $cbNumIDPlace = $this->connectionHR->select($sql);
                \Debugbar::info($cbNumIDPlace);
            }
            return View::make("W7X.W75.W75F1010",compact('pro','g', 'cbNumIDPlace', 'employeeid','cbLabelDistrict','cbLabelProvince','cbLabelWard', 'rsDistrict', 'rsProvince', 'rsWard'));
        }
    }
}
