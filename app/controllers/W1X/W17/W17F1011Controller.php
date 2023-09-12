<?php

namespace W1X\W17;

use Auth;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W1X\W1XController;
use Debugbar;

class W17F1011Controller extends W1XController
{
    public function index($pForm, $g, $task = '')
    {
        $perD17F1010 = $this->getPermission("D17F1010");
        $userID = Auth::user()->user()->UserID;
        \Debugbar::info('vinh',$userID);
        $lang = Session::get('Lang');
        $divisionID = Session::get("W91P0000")['DivisionID'];
        $moduleID = "D17";
        $sessionID = Session::getId();
        //$companyID = Session::get("CONDEFAULT")["database"];
        $formID = "W17F1010";
        $sql = "-- Combo Phan loai" . PHP_EOL;
        $sql .= "EXEC W17P1000 '$divisionID', '$userID', 'W17F1011', 'CompanyKind'" . PHP_EOL;
        $dsCompanyKind = $this->connection->select($sql);

        $sql = "-- Combo Trang Thai" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'Status'" . PHP_EOL;
        $dsCompanyStatus = $this->connection->select($sql);
        \Debugbar::info($dsCompanyStatus);

        $sql = "-- Combo Nguon goc" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'CaseSource'" . PHP_EOL;
        $dsCaseSource = $this->connection->select($sql);

        $sql = "-- Combo nhom cong ty" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'CompanyGroup'" . PHP_EOL;
        $dsCompanyGroup = $this->connection->select($sql);


        $sql = "-- Combo Nhom kinh doanh" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'GroupSales'" . PHP_EOL;
        $dsGroupSales = $this->connection->select($sql);


        $sql = "-- Combo Nhan vien" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'SalesPerson'" . PHP_EOL;
        $dsSalesPerson = $this->connection->select($sql);


        $sql = "-- Combo nhom nganh nghe" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'LeadIndustryGroup'" . PHP_EOL;
        $dsLeadIndustryGroup = $this->connection->select($sql);


        $sql = "----Combo xung ho" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'Duty'" . PHP_EOL;
        $dsVocative = $this->connection->select($sql);

        $sql = "----Combo Chuc vu" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'Position'" . PHP_EOL;
        $dsContactPosition = $this->connection->select($sql);

        $sql = "--Do nguon dropdown value" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'Value'" . PHP_EOL;
        $valuesComboVL = $this->connection->select($sql);

        $sql = "--Dropdown ma loai thong tin" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'NormType'" . PHP_EOL;
        $comboNormID = $this->connection->select($sql);
        \Debugbar::info($comboNormID);

        $perW17F1011 = $this->getPermission("D17F1010");
        $sql = "--Combo Tim kiem" . PHP_EOL;
        $sql .= "EXEC W91P1015 '$moduleID', '$divisionID', '$userID', '$formID'";
        $dsSearch = $this->connection->select($sql);

        $formCall = Input::get("formCall", "W17F1010");

        $sql = "--Dropdown ma thong tin" . PHP_EOL;
        $sql .= "Exec W17P1000 '$divisionID', '$userID', 'W17F1011', 'Norm'" . PHP_EOL;
        $comboValueID = $this->connection->select($sql);
        \Debugbar::info($comboValueID);

        //TRIHAO..
        $sql = "--- Do nguon cac combo Tinh/ Thanh pho" . PHP_EOL;
        $sql .= "EXEC W17P1014 '$userID', '$sessionID', '$lang', 6, 'W17F1011', 'Province', '', ''";
        $dsProvinces = $this->connection->select($sql);

        $sql = "--- Do nguon cac combo Quan / Huyen" . PHP_EOL;
        $sql .= "EXEC W17P1014 '$userID', '$sessionID', '$lang', 6, 'W17F1011', 'District', '', ''";
        $dsDistricts = $this->connection->select($sql);

        $sql = "--- Do nguon cac combo Xa/ Phuong" . PHP_EOL;
        $sql .= "EXEC W17P1014 '$userID', '$sessionID', '$lang', 6, 'W17F1011', 'Ward', '', ''";
        $dsWards = $this->connection->select($sql);
        //End TRIHAO

        switch ($task) {
            case 'add':
                $mode = 2;
                $formID = 'W17F1011';
                $searchID = '';
                $strSearch = '';
                $companyID = '';
                $sql = "--Sinh ma" . PHP_EOL;
                $sql .= "EXEC W17P1014 '$userID', '$sessionID', '$lang', $mode, '$formID', '$searchID', '$strSearch', '$companyID'";
                $dsKey = $this->connection->selectOne($sql);

                $mode = 4;
                $formID = "W17F1011";
                $sql = "--Do nguon cho grid chi tieu nhom cong ty" . PHP_EOL;
                $sql .= "EXEC W17P1014 '$userID', '$sessionID', '$lang', $mode, '$formID', '', '', ''" . PHP_EOL;
                $dsCriterial = $this->connection->select($sql);

                $sql = "-- do nguon thong tin bo sung" . PHP_EOL;
                $sql .= "EXEC	W17P1014 '$userID', '$sessionID', '$lang', 5, 'W17F1011', '', '', '$companyID' " . PHP_EOL;
                \Debugbar::info($sql);
                $Extrainformation = $this->connection->select($sql);

                $sql = "-- do nguon goi y ten khach hang" . PHP_EOL;
                $sql .= "EXEC	W17P1014 '$userID', '$sessionID', '$lang', 6, 'W17F1011', 'Company', '', '' " . PHP_EOL;
                \Debugbar::info($sql);
                $suggestCustomers = $this->connection->select($sql);

                return View::make("W1X.W17.W17F1011", compact('comboValueID', 'comboNormID', 'Extrainformation', 'valuesComboVL', 'dsCriterial', 'formCall', 'perD17F1010', 'dsKey', 'dsCompanyKind', 'dsCompanyStatus', 'dsCaseSource', 'dsCompanyGroup', 'dsGroupSales', 'dsSalesPerson', 'dsLeadIndustryGroup', 'dsVocative', 'dsContactPosition', 'dsSearch', 'dsProvinces', 'dsDistricts', 'dsWards', 'suggestCustomers', 'perW17F1011', 'task', 'pForm', 'g'));
                break;
            case 'view':
            case 'edit':
                $mode = 3;
                $formID = 'W17F1011';
                $searchID = '';
                $strSearch = '';
                $companyID = Input::get('companyID', '');
                $sql = "--Load master when view / edit" . PHP_EOL;
                $sql .= "EXEC W17P1014 '$userID', '$sessionID', '$lang', $mode, '$formID', '$searchID', '$strSearch', '$companyID'";
                $rsData = $this->connection->selectOne($sql);
                \Debugbar::info($rsData);
                $mode = 4;
                $formID = "W17F1011";
                $sql = "--Do nguon cho grid chi tieu nhom cong ty" . PHP_EOL;
                $sql .= "EXEC W17P1014 '$userID', '$sessionID', '$lang', $mode, '$formID', '', '', '$companyID'" . PHP_EOL;
                $dsCriterial = $this->connection->select($sql);

                $sql = "-- do nguon thong tin bo sung" . PHP_EOL;
                $sql .= "EXEC	W17P1014 '$userID', '$sessionID', '$lang', 5, 'W17F1011', '', '', '$companyID' " . PHP_EOL;
                \Debugbar::info($sql);
                $Extrainformation = $this->connection->select($sql);

                $sql = "-- do nguon goi y ten khach hang" . PHP_EOL;
                $sql .= "EXEC	W17P1014 '$userID', '$sessionID', '$lang', 6, 'W17F1011', 'Company', '', '' " . PHP_EOL;
                \Debugbar::info($sql);
                $suggestCustomers = $this->connection->select($sql);

                return View::make("W1X.W17.W17F1011", compact('companyID', 'comboValueID', 'comboNormID', 'dsCriterial', 'valuesComboVL', 'formCall', 'perD17F1010', 'rsData', 'dsCompanyKind', 'dsCompanyStatus', 'dsCaseSource', 'dsCompanyGroup', 'dsGroupSales', 'dsSalesPerson', 'dsLeadIndustryGroup', 'dsVocative', 'dsContactPosition', 'dsSearch', 'dsProvinces', 'dsDistricts', 'dsWards', 'suggestCustomers', 'Extrainformation', 'perW17F1011', 'task', 'pForm', 'g'));
                break;
            case 'save2':
                \Debugbar::info(Input::all());
                $companyID = Input::get('companyIDW17F1011', '');
                $sql = "--delete luu tai chi tieu" . PHP_EOL;
                $sql .= "SET NOCOUNT ON DELETE FROM D17T1011" . PHP_EOL;
                $sql .= "WHERE CompanyID= '$companyID' AND Type = 'CompanyGroupID'" . PHP_EOL;
                $this->connection->statement($sql);

                $valueGrid1 = json_decode(Input::get('arrayGrid1'));
                \Debugbar::info($valueGrid1);
                for ($i = 0; $i < count($valueGrid1); $i++) {
                    $CompanyTypeID = $valueGrid1[$i]->CompanyTypeID;
                    $CompanyID = $valueGrid1[$i]->CompanyID;
                    $NormID = $valueGrid1[$i]->NormID;
                    $ValueID = $this->sqlstring($valueGrid1[$i]->ValueID);
                    $Note = $valueGrid1[$i]->Note;
                    //$DataType = $valueGrid1[$i]->DataType;

                    $sql .= "INSERT INTO D17T1011 (CompanyTypeID, CompanyID, NormID, ValueID, NotesU, Type)" . PHP_EOL;
                    $sql .= "Values('$CompanyTypeID', '$companyID', '$NormID', N'$ValueID', N'$Note', 'CompanyGroupID')" . PHP_EOL;
                }
                \Debugbar::info($sql);
                if ($sql != "") {
                    try {
                        $this->connection->statement($sql);
                        $this->connection->statement("EXEC W17P1013  '$userID', '$sessionID' ,2, '$companyID'");

                        return json_encode(['status' => "SUCCESS"]);
                    } catch (Exception $ex) {

                        return json_encode(['status' => 'ERROR', 'name' => '', "message" => Helpers::getRS($g,"Chi_tieu_theo_nhom_Cong_ty") . ': ' . Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }
                break;

            case 'save3':
                \Debugbar::info("save 3");
                $companyID = Input::get('companyIDW17F1011', '');
                $sql = "--delete luu tai chi tieu" . PHP_EOL;
                $sql .= "SET NOCOUNT ON DELETE FROM D17T1011" . PHP_EOL;
                $sql .= "WHERE CompanyID= '$companyID' AND Type = ''" . PHP_EOL;
                $this->connection->statement($sql);

                $valueGrid1 = json_decode(Input::get('arrayGrid2'));
                \Debugbar::info($valueGrid1);
                for ($i = 0; $i < count($valueGrid1); $i++) {
                    $CompanyTypeID = $valueGrid1[$i]->CompanyTypeID;
                    $CompanyID = $valueGrid1[$i]->CompanyID;
                    $NormID = $valueGrid1[$i]->NormID;
                    $ValueID = $this->sqlstring($valueGrid1[$i]->ValueID);
                    $Note = $valueGrid1[$i]->Note;
                    //$DataType = $valueGrid1[$i]->DataType;

                    $sql .= "INSERT INTO D17T1011 (CompanyTypeID, CompanyID, NormID, ValueID, NotesU, Type)" . PHP_EOL;
                    $sql .= "Values('TN', '$companyID', '$NormID', N'$ValueID', N'$Note', '')" . PHP_EOL;
                }
                \Debugbar::info($sql);
                if ($sql != "") {
                    try {
                        $this->connection->statement($sql);
                        $this->connection->statement("EXEC W17P1013  '$userID', '$sessionID' ,3, '$companyID'");
                        return json_encode(['status' => "SUCCESS"]);
                    } catch (Exception $ex) {

                        return json_encode(['status' => 'ERROR', 'message' => Helpers::getRS($g,"Thong_tin_bo_sung") . ': ' .Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }


                break;
            case 'save':
            case 'update':

                $txtCompanyIDW17F1011 = Input::get("txtCompanyIDW17F1011", "");
                $txtCompanyNameW17F1011 = Input::get("txtCompanyNameW17F1011", "");
//                $optIsPersonW17F1011 = Input::get("optIsPersonW17F1011", 0);
                $dtpFindDateW17F1011 = Helpers::convertDate(Input::get("dtpFindDateW17F1011", ""));
                $txtCompanyShortW17F1011 = Input::get("txtCompanyShortW17F1011", "");
                $chkDisabledW17F1011 = Input::get("chkDisabledW17F1011", 0);
                $cboCompanyKindIDW17F1011 = Input::get("cboCompanyKindIDW17F1011", "");
                $cboCompanyStatusW17F1011 = Input::get("cboCompanyStatusW17F1011", "");
                $cboCaseSourceIDW17F1011 = Input::get("cboCaseSourceIDW17F1011", "");
                $cboCompanyGroupIDW17F1011 = Input::get("cboCompanyGroupIDW17F1011", "");
                $cboGroupSalesIDW17F1011 = Input::get("cboGroupSalesIDW17F1011", "");
                $cboSalePersonIDW17F1011 = Input::get("cboSalePersonIDW17F1011", "");
                $cboIndustryGroupIDW17F1011 = Input::get("cboIndustryGroupIDW17F1011", "");
                $txtNotesW17F1011 = Input::get("txtNotesW17F1011", "");
                $addressIDW17F1011 = Input::get("addressIDW17F1011", "");
                $chkisNewFindW17F1011 = Input::get("chkisNewFindW17F1011", 0);

                $txtTelNoW17F1011 = Input::get("txtTelNoW17F1011", "");
                $contactIDW17F1011 = Input::get("contactIDW17F1011", "");
                $txtFullNameW17F1011 = Input::get("txtFullNameW17F1011", "");
                $cboVocativeIDW17F1011 = Input::get("cboVocativeIDW17F1011", "");
                $txtMobileNoW17F1011 = Input::get("txtMobileNoW17F1011", "");
                $cboContactPositionIDW17F1011 = Input::get("cboContactPositionIDW17F1011", "");

                $cboProvinceIDW17F1011 = Input::get("cboProvinceIDW17F1011", "");
                $provinceNameW17F1011 = Input::get("provinceNameW17F1011", "");
                $cboDistrictIDW17F1011 = Input::get("cboDistrictIDW17F1011", "");
                $districtNameW17F1011 = Input::get("districtNameW17F1011", "");
                $cboWardIDW17F1011 = Input::get("cboWardIDW17F1011", "");
                $wardNameW17F1011 = Input::get("wardNameW17F1011", "");
                $txtQuarterW17F1011 = Input::get("txtQuarterW17F1011", "");

                $txtAddressLine1W17F1011 = $txtQuarterW17F1011;
                if (!empty($wardNameW17F1011)) {
                    $txtAddressLine1W17F1011 .= ', ' . $wardNameW17F1011;
                }
                if (!empty($districtNameW17F1011)) {
                    $txtAddressLine1W17F1011 .= ', ' . $districtNameW17F1011;
                }
                if (!empty($provinceNameW17F1011)) {
                    $txtAddressLine1W17F1011 .= ', ' . $provinceNameW17F1011;
                }

                $sql = "--check existing companyid" . PHP_EOL;
                $sql .= "SELECT CompanyID FROM 	D17T1010 WITH(NOLOCK) WHERE CompanyID = '$txtCompanyIDW17F1011'";
                $dsCheck = $this->connection->select($sql);

                if (count($dsCheck) == 1 && $task == 'save') {
                    $mode = 2;
                    $formID = 'W17F1011';
                    $searchID = '';
                    $strSearch = '';
                    $companyID = '';
                    $sql = "--Sinh ma" . PHP_EOL;
                    $sql .= "EXEC W17P1014 '$userID', '$sessionID', '$lang', $mode, '$formID', '$searchID', '$strSearch', '$companyID'";
                    $dsKey = $this->connection->selectOne($sql);
                    $txtCompanyIDW17F1011 = $dsKey["ID"];
                    //return json_encode(['status' => 'EXIST', 'message' => Helpers::getRS($g, "Ma_nay_da_ton_tai_Vui_long_chon_ma_khac")]);
                } else {

                }

                $mode = ($task == "save" ? 0 : 1);
                $formID = "W17F1011";
                $sql = "--Check before saving" . PHP_EOL;
                $sql .= "EXEC W17P5555 '$lang', '$userID', '$sessionID', $mode, '$formID' , '$txtCompanyIDW17F1011', '$cboGroupSalesIDW17F1011', '$cboSalePersonIDW17F1011', '$cboCompanyGroupIDW17F1011', '$txtTelNoW17F1011'";
                $dsCheck = $this->connection->selectOne($sql);

                if (intval($dsCheck["Status"]) == 1) {
                    return json_encode(['status' => 'EXIST2', 'message' => Helpers::getRS($g, "So_dien_thoai_nay_da_duoc_su_dung")]);
                } else {
                    try {
                        if (intval($dsCheck["Status"]) == 0) {

                            if ($task == 'update') {
                                $sql = "----Xoa thong tin cty truoc khi insert" . PHP_EOL;
                                $sql .= " DELETE FROM D17T1010 WHERE CompanyTypeID = 'TN' AND CompanyID = '$txtCompanyIDW17F1011'" . PHP_EOL;
                                $sql .= "----Luu Thong tin cong ty" . PHP_EOL;
                            } else {
                                $sql = "----Luu Thong tin cong ty" . PHP_EOL;
                            }

                            $sql .= "INSERT INTO 	D17T1010" . PHP_EOL;
                            $sql .= "(CompanyID, CompanyTypeID, ReviseDate," . PHP_EOL;
                            $sql .= "CompanyNameU,CompanyShortU, IsPerson, Disabled, FindDate," . PHP_EOL;
                            $sql .= "CompanyKindID, CompanyStatus, CaseSourceID,  CompanyGroupID," . PHP_EOL;
                            $sql .= "GroupSalesID, SalesPersonID, IndustryGroupID, NotesU," . PHP_EOL;
                            $sql .= "CreateUserID, CreateDate, LastModifyUserID,  LastModifyDate," . PHP_EOL;
                            $sql .= "RevenueID,CompanySizeID, TaxNo, StockID, Website," . PHP_EOL;
                            $sql .= "LicenseDate, LicenseNo, KeyFind, KeyFindU," . PHP_EOL;
                            $sql .= "CapitalAmount, CapitalCurrencyID, DateOfBirth, Age, Gender," . PHP_EOL;
                            $sql .= "ObjectTypeID, ObjectID, AddressLine, ContactName, " . PHP_EOL;
                            $sql .= "LeadID, LinkCompanyID, S1, S2, S3, IsNewFind," . PHP_EOL;
                            $sql .= "ProvinceID, ProvinceName, DistrictID, DistrictName, " . PHP_EOL;
                            $sql .= "WardID, WardName, Quarter)" . PHP_EOL;
                            $sql .= "Values('$txtCompanyIDW17F1011', 'TN', GETDATE(), " . PHP_EOL;
                            $sql .= "N'$txtCompanyNameW17F1011', N'$txtCompanyShortW17F1011', 0, $chkDisabledW17F1011, $dtpFindDateW17F1011," . PHP_EOL;
                            $sql .= "'$cboCompanyKindIDW17F1011', '$cboCompanyStatusW17F1011', '$cboCaseSourceIDW17F1011',  '$cboCompanyGroupIDW17F1011'," . PHP_EOL;
                            $sql .= "'$cboGroupSalesIDW17F1011', '$cboSalePersonIDW17F1011', '$cboIndustryGroupIDW17F1011', N'$txtNotesW17F1011'," . PHP_EOL;
                            $sql .= "'$userID', GetDate(), '$userID', GetDate()," . PHP_EOL;
                            $sql .= "'', '', '', '', ''," . PHP_EOL;
                            $sql .= "null, '', '', ''," . PHP_EOL;
                            $sql .= "0, '', null, 0,''," . PHP_EOL;
                            $sql .= "'', '', '', ''," . PHP_EOL;

                            $sql .= "'', '', '', '', '', $chkisNewFindW17F1011, " . PHP_EOL;
                            $sql .= "'$cboProvinceIDW17F1011', N'$provinceNameW17F1011', '$cboDistrictIDW17F1011', N'$districtNameW17F1011'," . PHP_EOL;
                            $sql .= "'$cboWardIDW17F1011', N'$wardNameW17F1011', N'$txtQuarterW17F1011')" . PHP_EOL;
                            $this->connection->statement($sql);

                            $sql = "----Luu lich su cong ty" . PHP_EOL;
                            $sql .= "DELETE  D91T9009  WHERE UserID = '$userID' AND Key01ID = '$sessionID' and FormID = 'W17F1011' AND Key02ID = 'History'" . PHP_EOL;
                            $sql .= "INSERT INTO D91T9009(UserID, Key01ID, Key02ID, Key03ID, FormID)" . PHP_EOL;
                            $sql .= "VALUES('$userID', '$sessionID', 'History', '$txtCompanyIDW17F1011', 'W17F1011')" . PHP_EOL;
                            $mode = 1;
                            $sql .= "EXEC W17P1013 '$userID', '$sessionID', $mode" . PHP_EOL;
                            $this->connection->statement($sql);

                            $sql = "----Luu Dia chi" . PHP_EOL;
                            $sql .= "DELETE D91T9009 WHERE UserID = '$userID' AND Key01ID = '$sessionID' and FormID = 'W17F1011' AND Key02ID = 'Address'" . PHP_EOL;
                            $sql .= "INSERT INTO D91T9009(UserID, Key01ID, FormID, Key02ID, Key03ID, Key04ID, " . PHP_EOL;
                            $sql .= "Key05ID, Key06ID)" . PHP_EOL;
                            $sql .= "VALUES('$userID', '$sessionID', 'W17F1011', 'Address', '$txtCompanyIDW17F1011', N'$addressIDW17F1011'," . PHP_EOL;
                            $sql .= "N'$txtAddressLine1W17F1011', N'$txtTelNoW17F1011')" . PHP_EOL;
                            $mode = 1;
                            $sql .= "EXEC W17P1016 '$userID', '$sessionID', 'W17F1011', $mode" . PHP_EOL;
                            $this->connection->statement($sql);

                            $sql = "----Nguoi lien he" . PHP_EOL;
                            $sql .= "DELETE D91T9009 WHERE UserID = '$userID' AND Key01ID = '$sessionID' and FormID = 'W17F1011' AND Key02ID = 'ContactPerson'" . PHP_EOL;
                            $sql .= "INSERT INTO D91T9009(UserID, Key01ID, FormID, Key02ID, Key03ID, Key04ID, " . PHP_EOL;
                            $sql .= "Key05ID, Key06ID, Key07ID, Key08ID)" . PHP_EOL;
                            $sql .= "VALUES('$userID', '$sessionID', 'W17F1011', 'ContactPerson', '$txtCompanyIDW17F1011', '$contactIDW17F1011', " . PHP_EOL;
                            $sql .= "N'$txtFullNameW17F1011', '$cboVocativeIDW17F1011', N'$txtMobileNoW17F1011', '$cboContactPositionIDW17F1011')" . PHP_EOL;
                            $mode = 2;
                            $sql .= "EXEC W17P1016 '$userID', '$sessionID', 'W17F1011', $mode" . PHP_EOL;
                            Helpers::log($sql);

                            $this->connection->statement($sql);


                            //Do nguon lai cho 2 luoi thiet lap
//                            $mode = 4;
//                            $formID = "W17F1011";
//                            $sql = "--Do nguon cho grid chi tieu nhom cong ty" . PHP_EOL;
//                            $sql .= "EXEC W17P1014 '$userID', '$sessionID', '$lang', $mode, '$formID', '', '', '$txtCompanyIDW17F1011'" . PHP_EOL;
//                            $dsCriterial = $this->connection->select($sql);
//
//                            $sql = "-- do nguon thong tin bo sung" . PHP_EOL;
//                            $sql .= "EXEC	W17P1014 '$userID', '$sessionID', '$lang', 5, 'W17F1011', '', '', '$txtCompanyIDW17F1011' " . PHP_EOL;
//                            $Extrainformation = $this->connection->select($sql);

                            return json_encode(['status' => 'OKAY', 'companyID'=>$txtCompanyIDW17F1011]);


                        }
                    } catch (Exception $ex) {

                        return json_encode(['status' => 'ERROR', 'message' => Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                    }
                }

                break;
            case 'getkey':
                $mode = 2;
                $formID = 'W17F1011';
                $searchID = '';
                $strSearch = '';
                $companyID = '';
                $sql = "--Sinh ma" . PHP_EOL;
                $sql .= "EXEC W17P1014 '$userID', '$sessionID', '$lang', $mode, '$formID', '$searchID', '$strSearch', '$companyID', 1";
                $dsKey = $this->connection->selectOne($sql);
                return $dsKey;
                break;
            default:
                break;
        }

    }

}
