<?php
namespace W0X\W05;

use Auth;
use Debugbar;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Helpers;
use W0X\W0XController;

class W05F1602Controller extends W0XController
{

    public function index($pForm, $g,$qid='')
    {


        Debugbar::info(Session::get('W91P0000'));
        $fmqd = Session::get('W91P0000')['D90_ConvertedDecimals'];
        $D07_QuantityDecimals = Session::get('W91P0000')['D07_QuantityDecimals'];
        $UnitPriceDecimalPlaces = Session::get('W91P0000')['UnitPriceDecimalPlaces'];
        $DecimalPlaces = Session::get('W91P0000')['DecimalPlaces'];
        $D90_ConvertedDecimals = Session::get('W91P0000')['D90_ConvertedDecimals'];
        $ExchangeRateDecimals = Session::get('W91P0000')['ExchangeRateDecimals'];
        //$BaseCurrencyID = Session::get('W91P0000')['BaseCurrencyID'];


        $lang = Session::get('Lang');

        if(Request::isMethod("get")) {
            $ListCurrency= $this->LoadCurrencyIDData(false); // loai tien
            $ListObjType= $this->LoadObjectTypeIDData(false); //khach hang
            $ListNVKD= $this->LoadCreateByData(); // nhan vien kinh doanh
            $ListVoucherType= $this->LoadVoucherTypeIDData("D05"); // voucher type
            $ListStatus= $this->LoadFixData('SOStatus',$g);

            $sql ="--Do nguon combo nhom thue".PHP_EOL;
            $sql.= "Select VATGroupID, VATGroupNameU As VATGroupName,  Str(RateTax, 5, 2) As VATRate " .PHP_EOL;
            $sql.= "FROM D91T0040 WITH(NOLOCK) " .PHP_EOL;
            $sql.= "WHERE Disabled=0 " .PHP_EOL;
            $sql.= "ORDER BY VATGroupID " .PHP_EOL;
            $ListVATGroup= json_encode($this->connection->select($sql));
        }

        if(Request::isMethod("post")) {
            $do= Input::get('do');
            if($do=='getExchaneRate') {
                $curDate= Input::get('curDate');
                $currencyID= Input::get('curencyID');
                return $this->GetExchangeRate($currencyID,$curDate);
            }
            if($do=='getVoucherNumber') {
                $VoucherTypeID= Input::get('VoucherTypeID');
                return $this->CreateIGEVoucherNo("","D91T0001",$VoucherTypeID,0);
            }
            if($do=='getListCustomer') {
                $StrSearch= Input::get('StrSearch');
                $sql ="--Do nguon khach hang ".PHP_EOL;
                $sql .= "EXEC W91P9100 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."','$StrSearch','KH'";
                return json_encode($this->connection->select($sql));
            }
            if($do=='getListPreparedBy') {
                $StrSearch= Input::get('StrSearch');
                $sql ="--Do nguon nguoi lap ".PHP_EOL;
                $sql .= "EXEC W91P9100 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."','$StrSearch','NV'";
                return json_encode($this->connection->select($sql));
            }
            if($do=='getListEmployeeBu') {
                $StrSearch= Input::get('StrSearch');
                $sql ="--Do nguon nvkd ".PHP_EOL;
                $sql .= "EXEC W91P9100 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."','$StrSearch','NV'";
                return json_encode($this->connection->select($sql));
            }
            if($do=='getListInventory') {
                $StrSearch= Input::get('StrSearch');
                $sql ="--Do nguon hang hoa".PHP_EOL;
                $sql .= "EXEC W05P1005 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->user()->UserID."','".Session::get('Lang')."','$StrSearch'";
                return json_encode($this->connection->select($sql));
            }
            if($do=='getListUnitID') {
                $StrSearch= Input::get('StrSearch');
                $InventoryID = Input::get('InventoryID');
                $sql ="--Load DVT theo ma hang".PHP_EOL;
                $sql .="SELECT T04.UNITID as UnitID, T05.UnitNameU as UnitName FROM D07T0004 T04 WITH(NOLOCK) INNER JOIN D07T0005 T05 WITH(NOLOCK) ON T04.UnitID = T05.UnitID AND T04.Disabled = 0 WHERE T04.InventoryID = '$InventoryID'".PHP_EOL;
                if ($StrSearch != "")
                    $sql .=" And T04.UNITID like '%$StrSearch%'".PHP_EOL;
                //Debugbar::info($sql);
                return json_encode($this->connection->select($sql));
            }
            //Debugbar::info("Khanh test".$do);
            if($do=='saveSO')
            {
                $CustomerID= Input::get('txtObjectID');
                $CurrencyID= Input::get('slTypeCurrency');
                $PreparedBy= Input::get('txtPreparedBy');
                $EmployeeID = Input::get('txtemployeebu');
                $ObjectTypeID = Input::get('txtObjectTypeID');
                $ObjecName = Input::get('txtObjectName');
                $CustomerAddress= Input::get('txtObjectAddress');
                $ExchangeRate = str_replace(",","", Input::get('txtExchangeRate', 1));
                $txtdescription= addslashes(Input::get('txtdescription'));
                $VoucherNo = Input::get('voucherNo');
                $Status= Input::get('slstatus');
                $VoucherDate= Input::get('voucherDate');
                //Debugbar::info("qid: ".$qid);
                if($qid=='') {
                    $IGE= $this->CreateIGE($g,'D05T0016','05','MO');
                    $vouchertype= Input::get("slListVoucherType");
                    $VoucherNum = $this->CreateIGEVoucherNo($IGE,'D05T0016',$vouchertype,1);
                    $this->InsertVoucherNoD91T9111($VoucherNum, "D05T0016","VoucherNum",$IGE);
                    $QuotationID= $IGE;
                    $sql ="--insert master".PHP_EOL;
                    // $sql .= "BEGIN TRAN SO" .PHP_EOL;
                    $sql .="Insert Into D05T0016(";
                    $sql .="QuotationID, DivisionID, CustomerID, CustomerNameU,ShipAddressU, TranMonth, TranYear, ";
                    $sql .=" CurrencyID, EmployeeID, CreateUserID, CreateDate, ";
                    $sql .="LastModifyDate, LastModifyUserID, VoucherTypeID,VoucherNo, VoucherNum, ProfessionKind, ObjectTypeID, ";
                    $sql .="Status, ExchangeRate, VoucherDate, ModuleID, PreparedBy, DescriptionU ";
                    $sql .=") Values(";
                    $sql .=" N'$IGE', '".Session::get("W91P0000")['DivisionID']."',  N'$CustomerID',  N'$ObjecName',  N'$CustomerAddress',".Session::get("W91P0000")['TranMonth'].", ".Session::get("W91P0000")['TranYear'].", ";
                    $sql .=" N'$CurrencyID', '".$EmployeeID."',  N'".Auth::user()->user()->UserID."', getdate(), ";
                    $sql .="getdate(),  N'".Auth::user()->user()->UserID ."',  N'$vouchertype', N'$VoucherNo', N'$VoucherNum', N'O',  N'$ObjectTypeID', ";
                    $sql .=" N'$Status', $ExchangeRate, '$VoucherDate',  N'05',  N'$PreparedBy',N'$txtdescription'";
                    $sql .=")" .PHP_EOL;;
                }
                else {
                    $sql ="-- cap nhat master".PHP_EOL;
                    $sql.= "Update D05T0016 SET";
                    $sql.= " VoucherNo=N'" . $VoucherNo . "',";
                    $sql.= " CustomerID=N'" . $CustomerID . "',";
                    $sql.= "CustomerNameU=N'" . $ObjecName . "',";
                    $sql.= "ShipAddressU=N'" . $CustomerAddress . "',";
                    $sql.= "CurrencyID='" . $CurrencyID . "',";
                    $sql.= "EmployeeID='" . $EmployeeID . "',";
                    $sql.= "LastModifyDate=getdate(),";
                    $sql.= "Status='" . $Status . "',";
                    $sql.= "ObjectTypeID='" . $ObjectTypeID . "',";
                    $sql.= "ExchangeRate=" . $ExchangeRate . ",";
                    $sql.= "VoucherDate='" . $VoucherDate . "',";
                    $sql.= "PreparedBy='" . $PreparedBy . "',";
                    $sql.= "DescriptionU=N'" . $txtdescription . "'";
                    $sql.= " Where QuotationID='$qid'";
                    $QuotationID= $qid;
                }


                $details = Input::get('obj');
                Debugbar::info($details);
                $sql.= "DELETE FROM D05T0017 WHERE DivisionID='". Session::get("W91P0000")['DivisionID']. "' AND QuotationID='" . $QuotationID . "'" .PHP_EOL;
                //Debugbar::inf(var_dump($details));
                if (count($details) > 0){
                    foreach($details as $key=>$row) {
                        if(isset($row['QuotationItemID'])) $QuotationItemID=$row['QuotationItemID'];
                        else
                            $QuotationItemID= $this->CreateIGENewS($g,'D05T0017','05','DO','',count($details),'');
                        $sql.="Insert Into D05T0017(";
                        $sql .="QuotationItemID, DivisionID, QuotationID, InventoryID, ItemName, ";
                        $sql .="UnitID, UnitPrice, OrderNum, Quantity, Amount, ";
                        $sql .="OriginalReduce, RateReduce, CAmount, CReduce, CQuantity, ";
                        $sql .="OAmountTmp, CAmountTmp, VATGroupID, VATRate, OVAT, CVAT, IsService, IsKit ";
                        $sql .=") Values(";
                        $sql .=" N'$QuotationItemID', '".Session::get("W91P0000")['DivisionID']."',  N'$QuotationID',  N'". $row['InventoryID'] ."',  N'". $row['InventoryName'] ."', ";
                        $sql .=" N'".$row['UnitID']."', " . Helpers::sqlNumber($row['UnitPrice']) . ", $key,  " . Helpers::sqlNumber($row['Quantity']) . ",  " . Helpers::sqlNumber($row['Amount']) . ", ";
                        $sql .= Helpers::sqlNumber($row['OriginalReduce']) . ",  " . Helpers::sqlNumber($row['RateReduce']) . ",  " . Helpers::sqlNumber($row['CAmount']) . ",  " . Helpers::sqlNumber($row['CReduce']) . ",  " . Helpers::sqlNumber($row['CQuantity']) . ", ";
                        $sql .=" " . Helpers::sqlNumber($row['OAmountTmp']) . ",  " . Helpers::sqlNumber($row['CAmountTmp']) . ",  N' " . str_replace(",","",trim($row['VATGroupID'])) . "',  " . Helpers::sqlNumber($row['VATRate']/100) . ",  " . Helpers::sqlNumber($row['OVAT']) . " ,  " . Helpers::sqlNumber($row['CVAT']).",".$row['IsService'].",".$row['IsKit'] ;
                        $sql .=")" .PHP_EOL;

                        //
                    }
                }


                try {
                    Debugbar::info("SQL : " .$sql);
                    $this->connection->getPdo()->beginTransaction();
                    $this->connection->getPdo()->exec($sql);
                    $this->connection->getPdo()->commit();
                    return 1;
                }catch (\Exception $e) {
                    Debugbar::info($e->getMessage());
                    $this->connection->getPdo()->rollBack();
                    if($qid=="")
                        $this->DeleteVoucherNoD91T9111_Transaction($VoucherNum,"D05T0016","VoucherNum",$IGE);
                    return 0;
                }

            }

        }





        $TotalOAmountTmp=0;
        $TotalCAmountTmp= 0 ;
        $TotalRateReduce=0 ;
        $TotalOriginalReduce= 0 ;
        $TotalCReduce=0 ;

        $TotalOVAT= 0;
        $TotalCVAT=0;
        $TotalAmount= 0;
        $TotalCAmount= 0;
        $grid=[];
        $master=[];
        $mode = "add";
        if($qid!='')  {
            $sql ="--Do nguon master don hang ".PHP_EOL;
            $sql .= "EXEC W05P1697 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->User()->UserID."','WEB', N'W12F1602','".Session::get('Lang')."', N'$qid',0";
            $master = $this->connection->selectOne($sql);
            $mode = "edit";
            //Debugbar::info(var_dump($master));
            $sql1 ="--Do nguon luoi don hang ".PHP_EOL;
            $sql1 .= "EXEC W05P1697 '".Session::get("W91P0000")['DivisionID']."','".Auth::user()->User()->UserID."','WEB', N'W12F1602','".Session::get('Lang')."', N'$qid',1";
            $grid = $this->connection->select($sql1);
            $fm= $this->getArrayValue($ListCurrency,'CurrencyID',$master['CurrencyID'],'UnitPriceDecimals');
            for($i=0;$i<count($grid);$i++) {

                $TotalOAmountTmp+=  $grid[$i]['OAmountTmp'];
                $TotalCAmountTmp+=  $grid[$i]['CAmountTmp'];
                $TotalRateReduce+= $grid[$i]['RateReduce'];
                $TotalOriginalReduce+= $grid[$i]['OriginalReduce'];
                $TotalCReduce+=$grid[$i]['CReduce'];

                $TotalOVAT+=$grid[$i]['OVAT'];
                $TotalCVAT+=$grid[$i]['CVAT'];
                $TotalAmount+=$grid[$i]['Amount'];
                $TotalCAmount+=$grid[$i]['CAmount'];


                $grid[$i]['VATRate'] = number_format($grid[$i]['VATRate']* 100,2,".",',');

                //Replace d?u ph?y ?i, không thôi lên d??i, nó format l?i l?n n?a s? l?i
                $grid[$i]['Quantity'] = str_replace(',','',number_format($grid[$i]['Quantity'],$D07_QuantityDecimals)) ;
                $grid[$i]['UnitPrice'] = str_replace(',','',number_format($grid[$i]['UnitPrice'],$UnitPriceDecimalPlaces));
                $grid[$i]['RateReduce'] = str_replace(',','',number_format($grid[$i]['RateReduce'],$ExchangeRateDecimals));

               /* $grid[$i]['OAmountTmp'] = number_format($grid[$i]['OAmountTmp'],$DecimalPlaces,".",',');
                $grid[$i]['CAmountTmp'] = number_format($grid[$i]['CAmountTmp'],$D90_ConvertedDecimals,".",',');
                $grid[$i]['RateReduce'] = number_format($grid[$i]['RateReduce'],$ExchangeRateDecimals,".",',');
                //Debugbar::info(number_format($grid[$i]['OriginalReduce'],$fm,".",','));
                $grid[$i]['OriginalReduce'] = number_format($grid[$i]['OriginalReduce'],$DecimalPlaces,".",',');
                $grid[$i]['CReduce'] = number_format($grid[$i]['CReduce'],$D90_ConvertedDecimals,".",',');
                $grid[$i]['VATRate'] = number_format($grid[$i]['VATRate']* 100,$ExchangeRateDecimals,".",',');
                $grid[$i]['OVAT'] = number_format($grid[$i]['OVAT'],$DecimalPlaces,".",',');
                $grid[$i]['CVAT'] = number_format($grid[$i]['CVAT'],$D90_ConvertedDecimals,".",',');
                $grid[$i]['Amount'] = number_format($grid[$i]['Amount'],$DecimalPlaces,".",',');
                $grid[$i]['CAmount'] = number_format($grid[$i]['CAmount'],$D90_ConvertedDecimals,".",',');
                $grid[$i]['CQuantity'] = number_format($grid[$i]['CQuantity'],$D90_ConvertedDecimals,".",',');*/
            }
            $TotalOAmountTmp=number_format($TotalOAmountTmp,$DecimalPlaces,".",',');
            $TotalCAmountTmp= number_format($TotalCAmountTmp,$D90_ConvertedDecimals,".",',');
            $TotalRateReduce=number_format($TotalRateReduce,$ExchangeRateDecimals,".",',');
            $TotalOriginalReduce= number_format($TotalOriginalReduce,$DecimalPlaces,".",',');
            $TotalCReduce=number_format($TotalCReduce,$D90_ConvertedDecimals,".",',');

            $TotalOVAT= number_format($TotalOVAT,$DecimalPlaces,".",',');
            $TotalCVAT=number_format($TotalCVAT,$D90_ConvertedDecimals,".",',');
            $TotalAmount= number_format($TotalAmount,$DecimalPlaces,".",',');
            $TotalCAmount= number_format($TotalCAmount,$D90_ConvertedDecimals,".",',');
        }
        \Debugbar::info($grid);
        $grid=json_encode($grid);

        return View::make("W0X.W05.W05F1602", compact("mode","pForm","lang","ListObjType",'ListNVKD','ListCurrency','ListStatus','ListVoucherType','g',"ListVATGroup",'fmqd','master','grid','TotalOAmountTmp','TotalCAmountTmp','TotalRateReduce','TotalOriginalReduce','TotalCReduce','TotalOVAT','TotalCVAT','TotalAmount','TotalCAmount','qid','D07_QuantityDecimals','UnitPriceDecimalPlaces','DecimalPlaces','D90_ConvertedDecimals','ExchangeRateDecimals'));


    }

    public function getArrayValue($array,$key,$value, $ret) {
        foreach($array as $item) {
            if($item[$key]==$value) return $item[$ret];
        }
    }

    public function Delete($pForm, $g,$qid='')
    {
        $voucherNum = Input::get("VoucherNum");
        $sql ="-- Thuc hien xoa SO".PHP_EOL;
        $sql.= "DELETE FROM D05T0016 WHERE DivisionID='". Session::get("W91P0000")['DivisionID']. "' AND QuotationID='" . $qid . "'" .PHP_EOL;
        $sql.= "DELETE FROM D05T0017 WHERE DivisionID='". Session::get("W91P0000")['DivisionID']. "' AND QuotationID='" . $qid . "'" .PHP_EOL;
        try {
            /*$this->connection->getPdo()->beginTransaction();
            $this->connection->getPdo()->exec($sql);
            $this->connection->getPdo()->commit();*/
            $this->connection->statement($sql);
            $this->DeleteVoucherNoD91T9111($voucherNum,"D05T0016","VoucherNum",$qid);
            return 1;
        }catch (\Exception $e) {
            Debugbar::info($e->getMessage());
            return 0;
        }
    }
}
