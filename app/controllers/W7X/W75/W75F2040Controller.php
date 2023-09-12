<?php
/**
 * Created by PhpStorm.
 * User: ANHBAO
 * Date: 18/12/2017
 * Time: 3:27 PM
 */

namespace W7X\W75;
use Auth;
use DB;
use Exception;
use Input;
use Request;
use Session;
use View;
use W7X\W7XController;
use Debugbar;
use Helpers;
use Config;
use Mail;

class W75F2040Controller extends W7XController
{
    public function index($pForm, $g, $task = "")
    {
        $lang = Session::get("Lang");
        \Debugbar::info($pForm);
        $HRDivisionID = Session::get("W91P0000")['HRDivisionID'];
        $UserID = Auth::user()->user()->UserID;
        $valueGrid = json_encode(array());
        $modalTitle = $this->getModalTitleG4($pForm);
        $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], '%', 1);
        $block = $this->LoadBlockByG4(Session::get("W91P0000")['HRDivisionID'], $UserID, $pForm, 1);
        $team = $this->LoadTeamByG4($pForm, $HRDivisionID, '', 1);
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $perW75F2040 = $this->getPermission("D09F5650");
        $companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        switch ($task) {
            case "":
                \Debugbar::info("da chay W75F2040");
                //$modalTitle = $this->getModalTitleG4($pForm);
                return View::make("W7X.W75.W75F2040", compact("perW75F2040", "pForm", "g", "modalTitle", "department", "block", "team" , "tranYear"));
                break;

            case "filter":
                \Debugbar::info(Input::all());

                $BlockID = Input::get('cbBlockIDW75F2040');
                if($BlockID == 'undefined'){
                    $BlockID = '%';
                }
                $DepartmentID = Input::get('cbDepartmentIDW75F2040');
                if($DepartmentID == 'undefined'){
                    $DepartmentID = '%';
                }
                \Debugbar::info($DepartmentID);
                $TeamID = Input::get('cbTeamIDW75F2040');
                if($TeamID == 'undefined'){
                    $TeamID = '%';
                }
                $EmployeeID = Input::get('txtEmployeeIDW75F2040');
                if($EmployeeID == 'undefined'){
                    $EmployeeID = '';
                }
                $ValidDateFrom = Helpers::convertDate(Input::get('txtValidDateFromW75F2040'));
                $ValidDateTo = Helpers::convertDate(Input::get('txtValidDateToW75F2040'));
                $sql = "--Do nguon luoi truy vấn". PHP_EOL;
                $sql .= "EXEC W75P2040 '$HRDivisionID', '$UserID', '$pForm', '$lang', '$BlockID', '$DepartmentID', '$TeamID', '', '$EmployeeID', $ValidDateFrom, $ValidDateTo, '$companyID'";
                \Debugbar::info($sql);
                $valueGrid = $this->connectionHR->select($sql);
                for ($i = 0; $i < count($valueGrid); $i++) {
                    //$valueGrid[$i]["IsUpdate"] = 0;
                    $valueGrid[$i]['Cost'] = number_format($valueGrid[$i]['Cost'], 2);
                }
                \Debugbar::info($valueGrid);
                return $valueGrid;
                break;

            case "BlockIDChange":
                \Debugbar::info(Input::get('blockID'));
                $block = Input::get('blockID');
                $department = $this->LoadDepartmentByG4($pForm, Session::get("W91P0000")['HRDivisionID'], $block, 1);
                \Debugbar::info($department);
                $strDep = "";
                foreach ($department as $key=>$value) {
                    $strDep .= "<option value='" .$key."' > ".$value.  "</option>";
                }
                return $strDep;
                break;

            case "DepartmentIDChange":
                //\Debugbar::info(Input::get('departmentID'));
                $dep = Input::get('DepartmentID');
                \Debugbar::info($dep);
                $team = $this->LoadTeamByG4($pForm, $HRDivisionID, $dep, 1);
                \Debugbar::info($team);
                $strTeam = "";
                foreach ($team as $row) {
                    $strTeam .= "<option value='" . $row["TeamID"] . "'>" . $row["TeamName"] . "</option>";
                }
                return $strTeam;
                break;

            case "delete":
                \Debugbar::info(Input::all());
                $BenefitID = Input::get("BenefitID", "");
                $EmployeeID = Input::get("EmployeeID", "");
                $sql ="--xoa bang nguoi than".PHP_EOL;
                $sql .="DELETE FROM D52T1063 WHERE BenefitID = '$BenefitID'  AND EmployeeID = '$EmployeeID'".PHP_EOL;
                $sql .="--xoa bang nhan vien dang ky".PHP_EOL;
                $sql .="DELETE FROM D52T1062 WHERE BenefitID = '$BenefitID' AND EmployeeID = '$EmployeeID'";
                try {
                    $this->connectionHR->statement($sql) ;
                    return json_encode(['status' => 'SUCCESS']);
                } catch (Exception $ex) {
                    return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }
                break;
        }
    }
}