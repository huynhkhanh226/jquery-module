<?php
namespace ZXX\PH;

use Auth;
use Config;
use Debugbar;
use Input;
use Lang;
use Request;
use View;
use Session;
use Helpers;
use ZXX\ZXXController;

class W09F4292Controller extends ZXXController
{
    public function index($pForm, $g)
    {
        $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $input = Input::all();
        $division = Session::get("W91P0000")['HRDivisionID'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        \Debugbar::info(Session::get("W91P0000"));
        $lang = Session::get('Lang');
        if (Request::isMethod('post')) {

            $do = isset($input['do'])?$input['do']:'';
            if ($do== 'getVoucherNumber'){//Create VoucherNo
                $VoucherTypeID= Input::get('type');
                return $this->CreateIGEVoucherNo("","D91T0001",$VoucherTypeID,0);
            }elseif ($do=='getListPreparedBy'){//Load người lập
                $StrSearch= Input::get('StrSearch');
                $sql ="--Do nguon nguoi lap ".PHP_EOL;
                $sql .= "EXEC W91P9100 '".Session::get("W91P0000")['HRDivisionID']."','$user','$StrSearch','NV'";
                return json_encode($this->connection->select($sql));
            }elseif ($do=='saveno'){//Lưu phiếu
                $gdata = json_decode($input['gdata']);
                $date = Helpers::convertDate($input['hdDateW09F4292']);
                $voutype = $input['slVoucherTypeID'];
                $vouno = $input['txtVoucherID'];
                $employee = $input['txtEmployeeID'];
                $notes = $input['txtNotes'];
                $rsCheck = $this->checkW09P5555('Add','W09F4292',$gdata->ProjectID,'','','','',0,0,0,0,0,$date);
                if ($rsCheck['Status']=="1")
                    return json_encode(['code'=>0, 'mess'=>$rsCheck['Message']]);
                $sql ="--Xoa du lieu".PHP_EOL;
                $sql .="Delete From D09T6666";
                $sql .=" Where UserID = '$user' AND HostID = '".Session::getId()."' AND FormID = 'W09F4292'".PHP_EOL;
                $sql .="--Luu bang tam".PHP_EOL;
                $sql .="Insert Into D09T6666(";
                $sql .="UserID, HostID, Key01ID, Str01, Str02, ";
                $sql .="Str03, Str04, ";
                $sql .="Num01, Num02, FormID";
                $sql .=") Values(";
                $sql .="'$user', '".Session::getId()."',  '".$gdata->ObjTypeID."',  '".$gdata->ObjID."',  N'".$gdata->ObjName."', ";
                $sql .=" N'".$gdata->ProjectID."',  N'".$gdata->ProjectName."', ";
                $sql .= floatval ($gdata->TotalHours).", ".floatval ($gdata->TotalAmount).", 'W09F4292'";
                $sql .=")".PHP_EOL;
                $sql .="--Tao phieu".PHP_EOL;
                $sql .= "EXEC W09P4293 '$user', '".Session::getId()."','".Session::get("W91P0000")['HRDivisionID']."','".Session::get('Lang')."',1, $date, '$voutype', '$vouno', N'$notes', '$employee'".PHP_EOL;
                $sql .="--Xoa du lieu".PHP_EOL;
                $sql .="Delete From D09T6666";
                $sql .=" Where UserID = '$user' AND HostID = '".Session::getId()."' AND FormID = 'W09F4292'".PHP_EOL;
                $this->connection->statement($sql);
                return json_encode(['code'=>1, 'mess'=>'']);
            }else{//Filter data to grid
                $project = $input['slProjectID'];
                $valid = intval($input['optIsValid']);
                if ($valid!=0){
                    $input['datef']="";
                    $input['datet']="";
                }
                if ($valid != 3){
                    $input['txtDate']="";
                }
                $datef = Helpers::convertDate($input['datef']);
                $datet = Helpers::convertDate($input['datet']);
                $date = Helpers::convertDate($input['txtDate']);
                $loadcol = $input['change'];
                $sql ="--Do nguon luoi".PHP_EOL;
                $sql .= "EXEC W09P4292 '".Session::get("W91P0000")['HRDivisionID']."','$user','".Session::get('Lang')."', 1, '$project',$valid,$datef ,$datet, $date";
                $rsData = $this->connectionHR->select($sql);
                if ($loadcol==1){
                    return json_encode(['data'=>$rsData, 'view'=>View::make("ZXX.PH.W09F4292_Ajax", compact('pForm', 'g', 'rsData'))->render()]);
                }
                return json_encode(['data'=>$rsData]);
            }
        } else {
            $sql = "-- Combo Du an".PHP_EOL;
            $sql .= "SELECT '%' AS ProjectID, N'".Helpers::getRS($g,"Tat_ca_Web")."' AS ProjectName, '' AS CompanyID, '' AS CompanyName, 0 DisplayOrder".PHP_EOL;
            $sql .= "UNION".PHP_EOL;
            $sql .= "SELECT		T1.ProjectID, T1.DescriptionU As ProjectName, T1.CompanyID, ".PHP_EOL;
            $sql .= "T2.ObjectNameU AS CompanyName, 1 DisplayOrder".PHP_EOL;
            $sql .= "FROM		D54T2010 T1 WITH(NOLOCK)".PHP_EOL;
            $sql .= "LEFT JOIN	Object T2 WITH(NOLOCK) ON T1.ObjectTypeID = T2.ObjectTypeID ".PHP_EOL;
            $sql .= "AND T1.CompanyID = T2.ObjectID".PHP_EOL;
            $sql .= "WHERE	 	T1.ProStatusID <> '0004' ".PHP_EOL;
            $sql .= "AND DivisionID = '" . Session::get("W91P0000")['HRDivisionID'] . "'".PHP_EOL;
            $sql .= "ORDER BY	DisplayOrder, ProjectID".PHP_EOL;
            $pro = $this->connectionHR->select($sql);

            $sql = "-- Load ty gia".PHP_EOL;
            $sql .= "Exec W09P4290 '$division', '$user', 3, '$lang', $tranMonth, $tranYear".PHP_EOL;
            $rs = $this->connectionHR->select($sql);
            \Debugbar::info($rs);
            $exchangeRate = '';
            if (count($rs) > 0){
                $exchangeRate = number_format($rs[0]["ExchangeRate"],Session::get("W91P0000")['ExchangeRateDecimals']);
            }
            $vouchertype = $this->LoadVoucherTypeIDData('D90');
            $perD09F4292 = $this->getPermission('D09F4292');
            return View::make("ZXX.PH.W09F4292", compact('pForm', 'g', 'pro', 'vouchertype', 'perD09F4292', 'exchangeRate'));
        }
    }
}
