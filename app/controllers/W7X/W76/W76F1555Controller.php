<?php

namespace W7X\W76;

use Auth;
use DB;
use Debugbar;
use Illuminate\Support\Facades\Input;
use Session;
use View;
use W7X\W7XController;
use Carbon\Carbon;
class W76F1555Controller extends W7XController
{

    public function index($pForm, $g, $task = '')
    {
        Debugbar::info(Session::get("W91P0000"));
        //$titleW09F2022 = $this->getModalTitle($pForm);
        $lang = Session::get('Lang');
        $session = Session::getId();// hostID
        $userID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonthHR = Session::get("W91P0000")['HRTranMonth'];
        $tranYearHR = Session::get("W91P0000")['HRTranYear'];
        //$perD09F2022 =  Session::get($pForm);// $this->getPermission("D09F2022");
        //\Debugbar::info($perD09F2022);
        $employeeID = Auth::user()->user()->HREmployeeID;
        //------------------------------------------

        switch ($task) {
            case '':
                $sql = "-- Do nguon Combo Loai bai viet" . PHP_EOL;
                $sql .= "select ListTypeID, ListTypeName$lang as ListTypeName from D76T1555  with (nolock)";
                $listTypeID = $this->connectionHR->select($sql);
                return View::make("W7X.W76.W76F1555", compact('userID', 'listTypeID', 'pForm', 'g'));
                break;
            case 'loadgrid':

                $type = \Input::get('listTypeID', '');
                $sql = "-- Do nguon cho luoi" . PHP_EOL;
                $sql .= "select * from D76T1556 with (nolock) where Disabled = 0 and ListTypeID = '$type' order by DisplayOrder,CodeName,CodeID ";
                //   $dataGrid = [];
                $dataGrid = $this->connectionHR->select($sql);
                return $dataGrid;
                break;
            case 'delete';
                $codeID = \Input::get('codeID', '');
                $listTypeID = \Input::get('listTypeID', '');
                $sql = "--Update D76T1556" . PHP_EOL;
                $sql .= "Update D76T1556 set Disabled=1" ;
                $sql .= " Where  CodeID  = '$codeID' and ListTypeID = '$listTypeID'" . PHP_EOL;
                $this->connectionHR->statement($sql);

                $sql = "-- Do nguon cho luoi" . PHP_EOL;
                $sql .= "select * from D76T1556 with (nolock) where Disabled = 0 and ListTypeID = '$listTypeID' order by DisplayOrder,CodeName,CodeID  ";
                $dataGrid = $this->connectionHR->select($sql);


                return $dataGrid;
                break;
            case 'UpdateData':
                $rowData = json_decode(\Input::get('RowData', ''));
                $codeID = $rowData->CodeID;
                $listTypeID= \Input::get('listTypeID', '');
                $sql = "";
                if ($rowData->ID == "") {

                    $sql = "-- Kiem tra trung ma" . PHP_EOL;
                    $sql .= "select top 1 1 from D76T1556 with (nolock) where  CodeID = '$codeID' and Disabled =0 and ListTypeID = '$listTypeID' ";
                    Debugbar::info($sql);
                    $result = $this->connectionHR->select($sql);
                    if (count($result) > 0)
                        return -1;

                }
                else
                {
                    $sql = "--Delete D76T1556" . PHP_EOL;
                    $sql .= "Delete From D76T1556";
                    $sql .= " Where CodeID  = '$codeID' and ListTypeID = '$listTypeID'" . PHP_EOL;
                }
                $CodeName = $rowData->CodeName;
                $Remark = $rowData->Remark;
                $DisplayOrder = $rowData->DisplayOrder;

                $Inactive = \Helpers::sqlNumber($rowData->Inactive);
                $CreateUserID = $rowData->CreateUserID;
                $CreateDate = $rowData->CreateDate;
                if ($CreateUserID == "")
                    $CreateUserID = $userID;
                if ($CreateDate == "")
                    $CreateDate = Carbon::now();
                $IsDefault = $rowData->IsDefault==false ? 0:1;



                if ($IsDefault == 1)
                {
                    $sqlchk = "-- Kiem tra ton tai IsDefault" . PHP_EOL;
                    $sqlchk .= "select CodeID from D76T1556 with (nolock) where IsDefault = 1 and ListTypeID = '$listTypeID'  ";
                    $result2 = $this->connectionHR->select($sqlchk);
                        foreach ($result2 as $item) {
                            $ID = $item["CodeID"];
                            $sql .= "--Update IsDefault D76T1556" . PHP_EOL;
                            $sql .= "Update D76T1556 set IsDefault =0 where CodeID ='$ID'" . PHP_EOL;
                        }
                }

                $sql .= "--Insert D76T1556" . PHP_EOL;
                    $sql .= "Insert Into D76T1556(" . PHP_EOL;
                    $sql .= "ListTypeID, CodeID, CodeName, Remark, " . PHP_EOL;
                    $sql .= "DisplayOrder, IsDefault, Inactive, CreateUserID, " . PHP_EOL;
                    $sql .= "CreateDate, LastModifyUserID, LastModifyDate" . PHP_EOL;
                    $sql .= ") Values(" . PHP_EOL;
                    $sql .= "'$listTypeID', '$codeID',  N'$CodeName',  N'$Remark', " . PHP_EOL;
                    $sql .= "$DisplayOrder, $IsDefault, $Inactive,  '$CreateUserID', " . PHP_EOL;
                    $sql .= "'$CreateDate', '$userID',getdate()" . PHP_EOL;
                    $sql .= ")" . PHP_EOL;
                $this->connectionHR->statement($sql);
                $sql = "-- Do nguon cho luoi" . PHP_EOL;
                $sql .= "select * from D76T1556 with (nolock) where Disabled = 0 and ListTypeID = '$listTypeID' order by DisplayOrder,CodeName,CodeID  ";
                $dataGrid = $this->connectionHR->select($sql);
                return $dataGrid;
                break;


        }

    }
}
