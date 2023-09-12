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

class W17F2041Controller extends W1XController
{
    public function index($pForm, $g)
    {
        $user = Auth::user()->user()->UserID;
        if (Request::isMethod("get")) {
            $id = Input::get('id', '');
            $sql = "-- Combo Nguon goc" . PHP_EOL;
            $sql .= "SELECT 		LeadSourceID, LeadSourceNameU AS LeadSourceName" . PHP_EOL;
            $sql .= "FROM 		D17T1150 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE		Disabled = 0" . PHP_EOL;
            $sql .= "ORDER BY 	LeadSourceID, LeadSourceNameU" . PHP_EOL;
            $leadsource = $this->connection->select($sql);

            $sql = "-- Combo doanh thu nam" . PHP_EOL;
            $sql .= "SELECT 		RefInfoID As LeadRevenueID, RefInfoNameU As LeadRevenueName" . PHP_EOL;
            $sql .= "FROM		D17T1140 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE 		RefInfoTypeID='0002'" . PHP_EOL;
            $sql .= "ORDER BY 	RefInfoID" . PHP_EOL;
            $revenue = $this->connection->select($sql);

            $sql = "-- Combo quy mo cong ty" . PHP_EOL;
            $sql .= "SELECT 		RefInfoID As LeadCompanySizeID,  " . PHP_EOL;
            $sql .= "	RefInfoNameU As LeadCompanySizeName" . PHP_EOL;
            $sql .= "FROM		D17T1140 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE 		RefInfoTypeID ='0001'" . PHP_EOL;
            $sql .= "ORDER BY 	RefInfoID" . PHP_EOL;
            $comsize = $this->connection->select($sql);

            $sql = "-- Combo nhom nganh nghe" . PHP_EOL;
            $sql .= "SELECT 		LookupID As LeadIndustryGroupID, " . PHP_EOL;
            $sql .= "DescriptionU As LeadIndustryGroupName" . PHP_EOL;
            $sql .= "FROM		D91T0320 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE 		LookupType = 'D17_IndustryGroup' " . PHP_EOL;
            $sql .= "AND Disabled = 0 " . PHP_EOL;
            $sql .= "ORDER BY 	LeadIndustryGroupName" . PHP_EOL;
            $industry = $this->connection->select($sql);

            $sql = "-- Combo nhom cong ty" . PHP_EOL;
            $sql .= "	SELECT 		LookupID AS CompanyGroupID, " . PHP_EOL;
            $sql .= "     			DescriptionU AS CompanyGroupName" . PHP_EOL;
            $sql .= "FROM 		D91T0320 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE		LookupType = 'D17_CompanyGroup' AND Disabled = 0" . PHP_EOL;
            $sql .= "			AND ( DAGroupID = '' " . PHP_EOL;
            $sql .= "OR DAGroupID In " . PHP_EOL;
            $sql .= "(SELECT 		DAGroupID " . PHP_EOL;
            $sql .= "			FROM 		LemonSys.DBO.D00V0080 " . PHP_EOL;
            $sql .= "			WHERE 		UserID= '$user') " . PHP_EOL;
            $sql .= "OR '$user' ='LWADMIN')" . PHP_EOL;
            $sql .= "ORDER BY 	DisplayOrder, CompanyGroupName" . PHP_EOL;
            $comgroup = $this->connection->select($sql);

            $sql = "-- Combo Nhom kinh doanh" . PHP_EOL;
            $sql .= "SELECT 		GroupSalesID, GroupSalesNameU AS GroupSalesName" . PHP_EOL;
            $sql .= "FROM 		D17T1100 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE		Disabled = 0" . PHP_EOL;
            $sql .= "ORDER BY 	GroupSalesName" . PHP_EOL;
            $sales = $this->connection->select($sql);

            $sql = "-- Combo Chuc vu" . PHP_EOL;
            $sql .= "SELECT 		LookupID As LeadPositionID, " . PHP_EOL;
            $sql .= "DescriptionU As LeadPositionName, DisplayOrder" . PHP_EOL;
            $sql .= "FROM		D91T0320 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE 		LookupType = 'D17_Position' " . PHP_EOL;
            $sql .= "AND Disabled = 0 " . PHP_EOL;
            $sql .= "ORDER BY 	DisplayOrder, DescriptionU" . PHP_EOL;
            $position = $this->connection->select($sql);

            $sql = "--Combo Trang thai" . PHP_EOL;
            $sql .= "EXEC W17P1111 '$user','" . Session::get("W91P0000")['DivisionID'] . "', '" . Session::getId() . "', '" . Session::get('Lang') . "', '0007',0";
            $status = $this->connection->select($sql);

            $sql = "--Combo Xung ho" . PHP_EOL;
            $sql .= "EXEC W17P1111 '$user','" . Session::get("W91P0000")['DivisionID'] . "', '" . Session::getId() . "', '" . Session::get('Lang') . "', '0011',0";
            $call = $this->connection->select($sql);
            $rsData = [];
            $rsCheck = [];
            if ($id != '') {
                $sql = "--Do nguon form" . PHP_EOL;
                $sql .= "EXEC W17P2040 '$user', '" . Session::getId() . "','" . Session::get('Lang') . "', '$id',0, '', '', ''";
                $rsData = $this->connection->selectOne($sql);
                $rsCheck = $this->checkW17P5555("2", "W17F2041", $id, '1000');
            }
            $permission = $this->getPermission('D17F2040');
            return View::make("W1X.W17.W17F2041", compact('pForm', 'g', 'id', 'leadsource', 'status', 'revenue', 'comsize', 'industry', 'comgroup', 'position', 'call', 'rsData', 'sales', 'permission','rsCheck'));
        } else {
            $id = Input::get('hdLeadID', '');
            $leadNo = strtoupper(Input::get('txtLeadNo', ''));
            $leadContactName = Input::get('txtLeadContactName', '');
            $leadCompanyName = Input::get('txtLeadCompanyName', '');
            $leadIndustry = Input::get('slLeadIndustryGroupID', '');
            $leadRevenueID = Input::get('slLeadRevenueID', '');
            $leadCompanySizeID = Input::get('slLeadCompanySizeID', '');
            $leadStatusID = Input::get('slLeadStatusID', '');
            $note = Input::get('txtNotes', '');
            $telephone = Input::get('txtTelephone', '');
            $faxNo = Input::get('txtFax', '');
            $website = Input::get('txtWebsite', '');
            $address = Input::get('txtAddress', '');
            $emailContact = Input::get('txtEmailContact', '');
            $department = Input::get('txtDepartment', '');
            $telephoneContact = Input::get('txtTelephoneContact', '');
            $mobileContact = Input::get('txtMobileContact', '');
            $faxContact = Input::get('txtFaxContact', '');
            $leadPositionID = Input::get('slLeadPositionID', '');
            $companyGroupID = Input::get('slCompanyGroupID', '');
            $birthday = \Helpers::convertDate(Input::get('txtBirthday', ''));
            $leadDate = \Helpers::convertDate(Input::get('txtLeadDate', ''));
            $groupSalesID = Input::get('slGroupSalesID', '');
            $addSalesGroupID =str_replace(",", ";", Input::get('add', ''));
            $addressContactPerson = Input::get('txtAddressContactPerson', '');
            $callID = Input::get('slCallID', '');
            $leadSourceID = Input::get('slLeadSourceID', '');
            $sex = intval(Input::get('optSex', ''));
            $sql = '';
            try {
                if ($id == '') {
                    $id = $this->CreateIGE(6, "D17T2040", "17", "LE");
                    $createuserid = $user;
                    $createdate = "getdate()";

                } else {
                    $rs = $this->checkW17P5555("3", "W17F2041", $id, $leadStatusID, $telephoneContact);
                    if ($rs["Status"] == 0) {
                        $createuserid = Input::get('hdCreateUserID',$user);
                        $createdate = "'".Input::get('hdCreateDate','')."'";
                        $sql = "--Xoa du lieu" . PHP_EOL;
                        $sql .= "Delete From D17T2040";
                        $sql .= " Where ";
                        $sql .= "LeadID =  '$id'" . PHP_EOL;
                    } else
                        return json_encode(["code" => 0, "mess" => $rs["Message"]]);
                }
                $sql .= "--Luu du lieu" . PHP_EOL;
                $sql .= "Insert Into D17T2040(";
                $sql .= "LeadID, LeadNo, LeadContactNameU, LeadCompanyNameU, LeadIndustryGroupID, ";
                $sql .= "LeadRevenueID, LeadCompanySizeID, LeadStatusID, NotesU, Telephone, ";
                $sql .= "FaxNo, Website, AddressU, EmailContact, DepartmentU, ";
                $sql .= "TelephoneContact, MobileContact, FaxContact, CreateUserID, CreateDate, ";
                $sql .= "LastModifyUserID, LastModifyDate, LeadPositionID, Birthday, CompanyGroupID, ";
                $sql .= "GroupSalesID, AddSalesGroupID, LeadDate, AddressContactPerson, CallID, ";
                $sql .= "LeadSourceID, Sex";
                $sql .= ") Values(";
                $sql .= " '$id',  '$leadNo',  N'$leadContactName',  N'$leadCompanyName',  N'$leadIndustry', ";
                $sql .= " N'$leadRevenueID',  N'$leadCompanySizeID',  N'$leadStatusID',  N'$note',  N'$telephone', ";
                $sql .= " N'$faxNo',  N'$website',  N'$address',  N'$emailContact',  N'$department', ";
                $sql .= " N'$telephoneContact',  N'$mobileContact',  N'$faxContact',  '$createuserid', $createdate, ";
                $sql .= " N'$user', getdate(),  N'$leadPositionID', $birthday,  N'$companyGroupID', ";
                $sql .= " N'$groupSalesID',  N'$addSalesGroupID', $leadDate,  N'$addressContactPerson',  N'$callID', ";
                $sql .= " N'$leadSourceID', $sex";
                $sql .= ")";
                $this->connection->statement($sql);
                $sql = "--Lay du lieu" . PHP_EOL;
                $sql .= "EXEC W17P2040 '$user', '" . Session::getId() . "','" . Session::get('Lang') . "', '$id',0, '', '', ''";
                $rsData = $this->connection->selectOne($sql);
                $rsData["code"]=1;
                return json_encode($rsData);
            } catch (Exception $ex) {
                return json_encode(["code" => 0, "mess" => $ex->getMessage()]);
            }
        }
    }

}
