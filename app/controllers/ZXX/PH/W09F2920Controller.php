<?php
namespace ZXX\PH;

use Auth;
use Debugbar;
use Input;
use Lang;
use Request;
use View;
use Session;
use DB;
use Helpers;
use ZXX\ZXXController;

class W09F2920Controller extends ZXXController
{

    public function index($pForm, $g, $task = "")
    {
        $mon = "";
        $sun = "";
        $caption = $this->getModalTitle($pForm);
        $lang = Session::get("locate");//$this->getLang();
        $userID = Auth::user()->user()->UserID;//Auth::user()->user()->HREmployeeID;
        $employeeID = Auth::user()->user()->HREmployeeID;
        //$employeeID = Input::get("employeeID");
        $divisionID = Session::get("W91P0000")['HRDivisionID'];
        $session = Session::getId();
        //$divisionhr = Session::get("W91P0000")['HRDivisionID'];
        //Debugbar::info(Session::get("locate"));
        switch($task){
            case "": //truong hop nay la dc goi tu left menu
                $sql = "--Do nguon cho master" . PHP_EOL;
                $sql .= " EXEC W09P2920 '$userID','$divisionID',0,'$employeeID',null,null";
                $masterW09F2920 = $this->connectionHR->select($sql);
                //Debugbar::info($dataW09F2920);
                return View::make("ZXX.PH.W09F2920", compact('pForm', 'g','caption','mon','sun','task','lang','masterW09F2920'));
            case "getinheritdate": //get fromDate, toDate when inheriting
                $weekNo = Input::get("weekno") == "" ? 1 : Input::get("weekno");
                $this->getInheritDate($weekNo,$mon,$sun);
                $dateFrom = date("m/d/Y", strtotime(str_replace('/', '-',  $mon)));
                $dateTo = date("m/d/Y", strtotime(str_replace('/', '-',  $sun)));
                $sql = "--Ke thua" . PHP_EOL;
                $sql .= " EXEC W09P2920 '$userID','$divisionID',2,'$employeeID','$dateFrom','$dateTo'";
                $dsInherit = $this->connectionHR->select($sql);
                for($i=0;$i<count($dsInherit);$i++) {
                    $dsInherit[$i]['Mon'] = number_format($dsInherit[$i]['Mon'],2,".",',');
                    $dsInherit[$i]['Tue'] = number_format($dsInherit[$i]['Tue'],2,".",',');
                    $dsInherit[$i]['Wed'] = number_format($dsInherit[$i]['Wed'],2,".",',');
                    $dsInherit[$i]['Thu'] = number_format($dsInherit[$i]['Thu'],2,".",',');
                    $dsInherit[$i]['Fri'] = number_format($dsInherit[$i]['Fri'],2,".",',');
                    $dsInherit[$i]['Sat'] = number_format($dsInherit[$i]['Sat'],2,".",',');
                    $dsInherit[$i]['Sun'] = number_format($dsInherit[$i]['Sun'],2,".",',');
                    $dsInherit[$i]['SumWeek'] = number_format($dsInherit[$i]['SumWeek'],2,".",',');
                }
                return json_encode(['mon' => $mon, 'sun' => $sun, 'dsInherit' => $dsInherit]);
            case "loadgrid":
                return View::make("ZXX.PH.W09F2920_Ajax", compact('pForm', 'g'));
            case "reloadgrid":
                $sql = "--Do nguon cho detail" . PHP_EOL;
                $dateFrom = date("m/d/Y", strtotime(str_replace('/', '-',  Input::get("dateFrom"))));
                $dateTo = date("m/d/Y", strtotime(str_replace('/', '-',  Input::get("dateTo"))));
                $sql .= " EXEC W09P2920 '$userID','$divisionID',1,'$employeeID','$dateFrom','$dateTo'";
                $dsTimeSheet = $this->connectionHR->select($sql);
                Debugbar::info($dsTimeSheet);
                for($i=0;$i<count($dsTimeSheet);$i++) {
                    $dsTimeSheet[$i]['Mon'] = number_format($dsTimeSheet[$i]['Mon'],2,".",',');
                    $dsTimeSheet[$i]['Tue'] = number_format($dsTimeSheet[$i]['Tue'],2,".",',');
                    $dsTimeSheet[$i]['Wed'] = number_format($dsTimeSheet[$i]['Wed'],2,".",',');
                    $dsTimeSheet[$i]['Thu'] = number_format($dsTimeSheet[$i]['Thu'],2,".",',');
                    $dsTimeSheet[$i]['Fri'] = number_format($dsTimeSheet[$i]['Fri'],2,".",',');
                    $dsTimeSheet[$i]['Sat'] = number_format($dsTimeSheet[$i]['Sat'],2,".",',');
                    $dsTimeSheet[$i]['Sun'] = number_format($dsTimeSheet[$i]['Sun'],2,".",',');
                    $dsTimeSheet[$i]['SumWeek'] = number_format($dsTimeSheet[$i]['SumWeek'],2,".",',');
                }
                Debugbar::info($dsTimeSheet);
                return json_encode(['dsTimeSheet' => $dsTimeSheet]);;
            case "setdatasource":
                 $sql = "--Do nguon cho detail" . PHP_EOL;
                 $dateFrom = date("m/d/Y", strtotime(str_replace('/', '-',  Input::get("dateFrom"))));
                 $dateTo = date("m/d/Y", strtotime(str_replace('/', '-',  Input::get("dateTo"))));
                 $sql .= " EXEC W09P2920 '$userID','$divisionID',1,'$employeeID','$dateFrom','$dateTo'";
                 $dsTimeSheet = $this->connectionHR->select($sql);
                return json_encode($dsTimeSheet);
            case "loadproject":
                $strSearch = Input::get("strSearch");
                $sql = "-- Combo Du an" . PHP_EOL;
                if ($strSearch == "")
                    $sql .= " SELECT ProjectID, DescriptionU As ProjectName  FROM D54T2010 WITH(NOLOCK) ORDER BY	ProjectName";
                else
                    $sql .= " SELECT ProjectID, DescriptionU As ProjectName  FROM D54T2010 T54 WITH(NOLOCK) where ProjectID like N'%$strSearch%' or DescriptionU like N'%$strSearch%'  ORDER BY	ProjectName";
                $dsProjectID = $this->connectionHR->select($sql);
                return $dsProjectID;
            case "reloadprojectid":
                $strSearch = Input::get("strSearch");
                $sql = "-- Combo Du an" . PHP_EOL;
                if ($strSearch == "")
                    $sql .= " SELECT ProjectID, DescriptionU As ProjectName  FROM D54T2010 WITH(NOLOCK) ORDER BY	ProjectName";
                else
                    $sql .= " SELECT ProjectID, DescriptionU As ProjectName  FROM D54T2010 T54 WITH(NOLOCK) where ProjectID like N'%$strSearch%' or DescriptionU like N'%$strSearch%'  ORDER BY	ProjectName";
                $dsProjectID = $this->connectionHR->select($sql);
                return $dsProjectID;
            case "loadwork":
                $strSearch = Input::get("strSearch");
                $sql = "-- Combo work" . PHP_EOL;
                if ($strSearch == "")
                    $sql .= " SELECT WorkID, WorkNameU as WorkName  FROM	D09T0224  WITH(NOLOCK)  ORDER BY	WorkName";
                else
                    $sql .= " SELECT WorkID, WorkNameU as WorkName  FROM	D09T0224  WITH(NOLOCK) where WorkID like N'%$strSearch%' or WorkNameU like N'%$strSearch%'  ORDER BY	WorkName";
                $dsWorkID = $this->connectionHR->select($sql);
                return $dsWorkID;
            case "reloadworkid":
                $strSearch = Input::get("strSearch");
                $sql = "-- Combo work" . PHP_EOL;
                if ($strSearch == "")
                    $sql .= " SELECT WorkID, WorkNameU as WorkName  FROM	D09T0224  WITH(NOLOCK)  ORDER BY	WorkName";
                else
                    $sql .= " SELECT WorkID, WorkNameU as WorkName  FROM	D09T0224  WITH(NOLOCK) where WorkID like N'%$strSearch%' or WorkNameU like N'%$strSearch%'  ORDER BY	WorkName";
                $dsWorkID = $this->connectionHR->select($sql);
                return $dsWorkID;
            case "savedata":
                $dutyID = Input::get("dutyID");
                $dateFrom = date("m/d/Y", strtotime(str_replace('/', '-',  Input::get("dateFrom"))));
                $dateTo = date("m/d/Y", strtotime(str_replace('/', '-',  Input::get("dateTo"))));
                $weekNo = Input::get("weekNo");
                $details = json_decode(Input::get('dataW09F2920'));
                //Debugbar::info($details);
                $sql = "--Xoa bang tam".PHP_EOL;
                $sql .= " DELETE D09T6666 WHERE 	UserID = '$userID' AND HostID = '$session' AND FormID = 'W09F2920'".PHP_EOL;
                $sql .= "--Insert bang tam".PHP_EOL;
                foreach ($details as  $row) {
                    //Debugbar::info($row->ProjectID);
                    $projectID = isset($row->ProjectID) ? $row->ProjectID : "";
                    $workID = isset($row->WorkID) ? $row->WorkID : "";
                    $Mon =  isset($row->Mon) ? str_replace(",","", $row->Mon) :  number_format(0,2);
                    $IsApproveMon = isset($row->IsApproveMon) ? str_replace(",","", $row->IsApproveMon) :0;
                    $Tue = isset($row->Tue) ? str_replace(",","", $row->Tue) :number_format(0,2);
                    $IsApproveTue = isset($row->IsApproveTue) ? str_replace(",","", $row->IsApproveTue) : 0;
                    $Wed = isset($row->Wed) ? str_replace(",","", $row->Wed) : number_format(0,2);
                    $IsApproveWed = isset($row->IsApproveWed) ? str_replace(",","", $row->IsApproveWed) : 0;
                    $Thu = isset($row->Thu) ? str_replace(",","", $row->Thu) : number_format(0,2);
                    $IsApproveThu = isset($row->IsApproveThu) ? str_replace(",","", $row->IsApproveThu) : 0;
                    $Fri = isset($row->Fri) ? str_replace(",","", $row->Fri) : number_format(0,2);
                    $IsApproveFri = isset($row->IsApproveFri) ? str_replace(",","", $row->IsApproveFri) : 0;
                    $Sat = isset($row->Sat) ? str_replace(",","", $row->Sat) : number_format(0,2);
                    $IsApproveSat = isset($row->IsApproveSat) ? str_replace(",","", $row->IsApproveSat) : 0;
                    $Sun = isset($row->Sun) ? str_replace(",","", $row->Sun) : number_format(0,2);
                    $IsApproveSun = isset($row->IsApproveSun) ? str_replace(",","", $row->IsApproveSun) : 0;
                    $note = isset($row->Note) ? $this->sqlstring($row->Note) : "" ;

                    $sql .= " INSERT INTO D09T6666 (UserID, HostID, FormID," . PHP_EOL;
                    $sql .= " Key01ID, Str01, Str02," . PHP_EOL;
                    $sql .= " Num01, Num02, Num03, Num04," . PHP_EOL;
                    $sql .= " Num05, Num06, Num07, Num08," . PHP_EOL;
                    $sql .= " Num09, Num10, Num11, Num12," . PHP_EOL;
                    $sql .= " Num13, Num14,Str03)" . PHP_EOL;
                    $sql .= " VALUES ('$userID', '$session', 'W09F2920', " . PHP_EOL;
                    $sql .= " '$employeeID', '$projectID', '$workID', " . PHP_EOL;
                    $sql .= " $Mon, $IsApproveMon, $Tue, $IsApproveTue, " . PHP_EOL;
                    $sql .= " $Wed, $IsApproveWed, $Thu, $IsApproveThu, " . PHP_EOL;
                    $sql .= " $Fri, $IsApproveFri, $Sat, $IsApproveSat, " . PHP_EOL;
                    $sql .= " $Sun, $IsApproveSun, N'$note') " . PHP_EOL;
                }
                $sql .= "--Thuc thi store luu du lieu".PHP_EOL;
                $sql .= " EXEC W09P2922	'$userID','$session', '$divisionID', '$employeeID', $weekNo, '$dateFrom', '$dateTo', '$dutyID'".PHP_EOL;
                $sql .= "--Xoa bang tam".PHP_EOL;
                $sql .= " DELETE D09T6666 WHERE 	UserID = '$userID' AND HostID = '$session' AND FormID = 'W09F2920'".PHP_EOL;
                Debugbar::info($sql);
                if (Session::get($pForm) >= 2 && $this->connectionHR->statement($sql))
                    return 1;
                else
                    return 0;
                /*try {
                    $this->connection->getPdo()->beginTransaction();
                    $this->connection->getPdo()->exec($sql);
                    $this->connection->getPdo()->commit();
                    return 1;
                }catch (\Exception $e) {
                    Debugbar::info($e->getMessage());
                    $this->connection->getPdo()->rollBack();
                    return 0;
                }*/
            case "delete":
                $projectID = Input::get("ProjectID");
                $workID = Input::get("WorkID");
                $dateFrom = date("m/d/Y", strtotime(str_replace('/', '-',  Input::get("dateFrom"))));
                $dateTo = date("m/d/Y", strtotime(str_replace('/', '-',  Input::get("dateTo"))));
                $weekNo = Input::get("weekNo");

                $sql = "-- Xoa dang ky ".PHP_EOL;
                $sql .= " EXEC W09P2924 	'$userID', '$session', '$divisionID', '$employeeID','$projectID', '$workID', '$weekNo', '$dateFrom', '$dateTo'".PHP_EOL;
                //Debugbar::info($sql);
                if (Session::get($pForm) >= 4 && $this->connectionHR->statement($sql))
                    return 1;
                else
                    return 0;
        }
    }

    private function getLang(){
        $lang = Session::get('Lang');
        switch($lang){
            case "84":
                return "vi";
            default:
                return "en";
        }
    }

    private function getInheritDate($weekNo, &$mon, &$sun){
        $date = new \DateTime();
        $mon = $date->setISODate(date("Y"), $weekNo, 1)->format('d/m/Y');
        $sun = $date->setISODate(date("Y"), $weekNo, 7)->format('d/m/Y');
    }



}

class CellW09F2920{

    public $_rowIndx;
    public $_colIndx;
    public $_fieldName;
    public $_isLocked;

    function __construct($rowIndx, $colIndx, $fieldName, $isLocked) {
        $this->_rowIndx = $rowIndx;
        $this->_colIndx = $colIndx;
        $this->_fieldName = $fieldName;
        $this->_isLocked = $isLocked;
    }

}