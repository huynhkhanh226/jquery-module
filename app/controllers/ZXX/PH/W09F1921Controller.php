<?php
namespace ZXX\PH;

use Auth;
use Debugbar;
use Exception;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Helpers;
use ZXX\ZXXController;

class W09F1921Controller extends ZXXController
{

    /**
     * @param $pForm
     * @param $g
     * @return \Illuminate\View\View
     */
    public function index($pForm, $g)
    {
        $id = Input::get('id', '');
        $division = Session::get("W91P0000")['HRDivisionID'];

        if (Request::isMethod('post')) {
            $id = Input::get('hdID', '');
            try {
                $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
                $employee = mb_strtoupper(Input::get('txtEmployeeID', ''));
                $lastname = Input::get('txtLastName', '');
                $midname = Input::get('txtMiddleName', '');
                $firstname = Input::get('txtFirstName', '');
                $dep = Input::get('slDepartmentID', '');
                $duty = Input::get('slDutyID', '');
                $country = Input::get('slCountryID', '');
                $manager = Input::get('slDirectManagerID', '');
                $work = Input::get('slWorkID', '');
                $pager = Input::get('txtPager', '');
                $companyno = Input::get('txtCompanyTelephone', '');
                $sex = intval(Input::get('optSex', 0));;
                $disabled = (Input::get('chkDisabled', "off") == "on" ? 1 : 0);
                $birthday = Helpers::convertDate(Input::get('txtBirthDate', ''));
                $datejoin = Helpers::convertDate(Input::get('txtDateJoined', ''));
                $dateleft = Helpers::convertDate(Input::get('txtDateLeft', ''));
                if ($id == '') {
                    $sql = "SELECT 	TOP 1 1 FROM D09T0201 WITH(NOLOCK) WHERE EmployeeID = '$employee'";
                    if (count($this->connectionHR->select($sql))>0){
                        return json_encode(['code' => 0, 'mess' => Helpers::getRS($g,"Du_lieu_da_bi_trung_ban_khong_the_luu")]);
                    }
                    $sql = "--Luu them moi" . PHP_EOL;
                    $sql .= "Insert Into D09T0201(";
                    $sql .= "EmployeeID, LastNameU, MiddleNameU, FirstNameU, DutyID, ";
                    $sql .= "Birthdate, CountryID, DepartmentID, DateJoined, WorkID, DirectManagerID,";
                    $sql .= "Pager, Disabled, Sex, DivisionID, CreateUserID, ";
                    $sql .= "CreateDate, LastModifyUserID, LastModifyDate, CompanyTelephone, DateLeft ";
                    $sql .= ") Values(";
                    $sql .= "'$employee',  N'$lastname',  N'$midname',  N'$firstname',  N'$duty', ";
                    $sql .= "$birthday,  N'$country',  N'$dep', $datejoin,  N'$work', '$manager',";
                    $sql .= " '$pager', $disabled, $sex, '$division',  N'$user', ";
                    $sql .= "getdate(),  N'$user', getdate(),  '$companyno', $dateleft ";
                    $sql .= ")".PHP_EOL;
                    $database = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
                    $sql .="--Tao User".PHP_EOL;
                    $sql .= "EXEC W09P1922 '$user', '$database','".Session::get('Lang')."','$employee'";
                    $id = $employee;
                } else {
                    $sql = "--Luu edit" . PHP_EOL;
                    $sql .= "Update D09T0201 Set ";
                    $sql .= "LastNameU =  N'$lastname',";
                    $sql .= "MiddleNameU =  N'$midname',";
                    $sql .= "FirstNameU =  N'$firstname',";
                    $sql .= "DutyID =  N'$duty',";
                    $sql .= "Birthdate = $birthday,";
                    $sql .= "CountryID =  N'$country',";
                    $sql .= "DepartmentID =  N'$dep',";
                    $sql .= "DateJoined = $datejoin,";
                    $sql .= "WorkID =  N'$work',";
                    $sql .= "Pager =  N'$pager',";
                    $sql .= "Disabled = $disabled,";
                    $sql .= "Sex = $sex,";
                    $sql .= "LastModifyUserID =  N'$user',";
                    $sql .= "LastModifyDate = getdate(),";
                    $sql .= "CompanyTelephone =  N'$companyno',";
                    $sql .= "DirectManagerID =  '$manager',";
                    $sql .= "DateLeft = $dateleft";
                    $sql .= " Where EmployeeID = '$id'";
                }
                $this->connectionHR->statement($sql);
                $sql = "--Do nguon du lieu vua luu" . PHP_EOL;
                $sql .= "EXEC W09P1920 '$user', '$dep', 2, '$id'";
                $row = $this->connectionHR->selectOne($sql);
                $row["code"] = 1;
                return json_encode($row);
            } catch (Exception $ex) {
                return json_encode(['code' => 0, 'mess' => $ex->getMessage()]);
            }

        } else {
            $sql = "-- Combo Phong Ban" . PHP_EOL;
            $sql .= "SELECT DepartmentID, DepartmentNameU AS DepartmentName, DepDisplayOrder" . PHP_EOL;
            $sql .= "FROM D91T0012 WITH(NOLOCK) " . PHP_EOL;
            $sql .= "WHERE Disabled = 0" . PHP_EOL;
            $sql .= "AND DivisionID = '$division'" . PHP_EOL;
            $sql .= "ORDER BY DepDisplayOrder, DepartmentName";
            $depart = $this->connectionHR->select($sql);

            $sql = " -- Combo Quoc tich" . PHP_EOL;
            $sql .= "SELECT CountryID, CountryNameU AS CountryName" . PHP_EOL;
            $sql .= "FROM D91T0017  WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE Disabled = 0 ";
            $sql .= "ORDER BY CountryName";
            $country = $this->connectionHR->select($sql);

            $sql = "-- Combo chuc vu" . PHP_EOL;
            $sql .= "SELECT DutyID, DutyNameU AS DutyName, DutyDisplayOrder" . PHP_EOL;
            $sql .= "FROM D09T0211 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE Disabled = 0" . PHP_EOL;
            $sql .= "ORDER BY DutyDisplayOrder, DutyName";
            $duty = $this->connectionHR->select($sql);

            $sql = "-- Combo Du an" . PHP_EOL;
            $sql .= "SELECT		ProjectID, DescriptionU As ProjectName" . PHP_EOL;
            $sql .= "FROM		D54T2010 WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE	 	ProStatusID <> '0004'" . PHP_EOL;
            $sql .= "AND DivisionID ='$division' ";
            $sql .= "ORDER BY	ProjectName";
            $project = $this->connectionHR->select($sql);

            $sql = "-- Combo cong viec" . PHP_EOL;
            $sql .= "SELECT WorkID, WorkNameU as WorkName" . PHP_EOL;
            $sql .= "FROM D09T0224  WITH(NOLOCK)" . PHP_EOL;
            $sql .= "WHERE Disabled = 0 AND (DivisionID = '$division' OR DivisionID = '')" . PHP_EOL;
            $sql .= "ORDER BY 	WorkName";
            $work = $this->connectionHR->select($sql);

            $sql = "--Do nguon nguoi quan ly truc tiep" . PHP_EOL;
            $sql .= "EXEC W09P1508 '$division'";
            $dirManager = $this->connectionHR->select($sql);

            $caption = $this->getModalTitle($pForm);

            $permission = $this->getPermission($pForm);
            return View::make("ZXX.PH.W09F1921", compact('pForm', 'g', 'depart', 'id', 'caption', 'country', 'duty', 'project', 'work', 'dirManager', 'permission'));
        }
    }

}
