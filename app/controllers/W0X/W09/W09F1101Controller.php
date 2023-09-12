<?php

namespace W0X\W09;

use Auth;
use Config;
use DB;
use Exception;
use Helpers;
use Illuminate\Support\Contracts\JsonableInterface;
use Input;
use Request;
use Session;
use View;
use W0X\W0XController;
use Debugbar;

class W09F1101Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {
        $permission = \Session::get($pForm);
        $titleW09F1101 = $this->getModalTitle('W09F1101');
        \Debugbar::info($titleW09F1101);
        $lang = Session::get('Lang');
        $UserID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeID = Auth::user()->user()->HREmployeeID;
        $session = Session::getId();
        switch ($task) {
            case "":
                $Action = Input::get('action', '');


                $DutyID = Input::get('DutyID', '');
                $sql = "--Do nguon DD gioi tinh" . PHP_EOL;
                $sql .= "SELECT 2 AS Sex , '' AS SexName " . PHP_EOL;
                $sql .= "UNION ALL" . PHP_EOL;
                $sql .= "SELECT 0 AS Sex , N'Nam' AS SexName" . PHP_EOL;
                $sql .= "UNION ALL" . PHP_EOL;
                $sql .= "SELECT 1 AS Sex , N'Nữ' AS SexName" . PHP_EOL;
                $cbGender = $this->connectionHR->select($sql);

                $sql = "-- Do nguon Combo Trinh do hoc van" . PHP_EOL;
                $sql .= "SELECT	EducationLevelID, EducationLevelNameU AS EducationLevelName" . PHP_EOL;
                $sql .= "FROM D09T0206  WITH(NOLOCK)" . PHP_EOL;
                $sql .= "WHERE Disabled = 0" . PHP_EOL;
                $sql .= "ORDER BY EducationLevelID" . PHP_EOL;
                $cbEducation = $this->connectionHR->select($sql);

                $sql = "-- Do nguon Combo Trinh do chuyen mon" . PHP_EOL;
                $sql .= "SELECT	ProfessionalLevelID, ProfessionalLevelNameU AS ProfessionalLevelName" . PHP_EOL;
                $sql .= "FROM D09T0205 WITH(NOLOCK)" . PHP_EOL;
                $sql .= "WHERE Disabled = 0" . PHP_EOL;
                $sql .= "ORDER BY ProfessionalLevelID" . PHP_EOL;
                $cbProfess = $this->connectionHR->select($sql);

                $sql = "-- Do nguon Combo Trinh do ngoai ngu" . PHP_EOL;
                $sql .= "SELECT	LanguageLevelID, LanguageLevelNameU AS LanguageLevelName" . PHP_EOL;
                $sql .= "FROM D09T0208 WITH(NOLOCK)" . PHP_EOL;
                $sql .= "WHERE Disabled = 0" . PHP_EOL;
                $sql .= "ORDER BY LanguageLevelID" . PHP_EOL;
                $cbForeignLang = $this->connectionHR->select($sql);
                //\Debugbar::info($cbForeignLang);

                $sql = "-- Do nguon Combo Trinh do ngoai ngu" . PHP_EOL;
                $sql .= "SELECT	LookupID AS ComputingLevelID, DescriptionU AS ComputingLevelName" . PHP_EOL;
                $sql .= "FROM D91T0320 WITH(NOLOCK)" . PHP_EOL;
                $sql .= "WHERE LookupType = 'D09_ComputingLevel'" . PHP_EOL;
                $sql .= "And (DAGroupID ='' Or DAGroupID  IN (SELECT" . PHP_EOL;
                $sql .= "DAGroupID FROM lemonsys.dbo.D00V0080" . PHP_EOL;
                $sql .= "WHERE UserID = '$UserID') Or 'LEMONADMIN' = '$UserID')" . PHP_EOL;
                $sql .= "ORDER BY	DisplayOrder, LookupID" . PHP_EOL;
                $cbComputerLvl = $this->connectionHR->select($sql);

                $sql = "-- Combo Chuc danh quan ly" . PHP_EOL;
                $sql .= "SELECT 		DutyID As DutyManagerID, DutyNameU AS DutyManagerName" . PHP_EOL;
                $sql .= "FROM		D09T0211 WITH(NOLOCK)" . PHP_EOL;
                $sql .= "WHERE		Disabled = 0 And IsManager = 1" . PHP_EOL;
                $sql .= "ORDER BY	DutyID" . PHP_EOL;
                $cbo_DutyManagername = $this->connectionHR->select($sql);

                $sql = "-- Combo Co cau to chuc" . PHP_EOL;
                $sql .= "EXEC W09P1010 '$UserID','$session','W09F1010'" . PHP_EOL;
                //$cbo_OrgChart = $this->connectionHR->select($sql);
                $tmp = $this->connectionHR->select($sql);
                $cbo_OrgChart = [];
                foreach ($tmp as $r) {
                    if ($r['OrgChartParentID'] == $r['OrgChartID']) {
                        unset($r['OrgChartParentID']);
                        $r['expanded'] = true;//bung ra list con
                    }else{
                        $r['expanded'] = false;//ko bung list con
                    }
                    $cbo_OrgChart[] = $r;//bỏ phần tử vào mảng
                }


                $sql = "-- Combo Nhom chuc danh cong viec" . PHP_EOL;
                $sql .= "SELECT		DutyGroupID, DutyGroupName84U AS DutyGroupName" . PHP_EOL;
                $sql .= "FROM		D09T0330  WITH(NOLOCK)" . PHP_EOL;
                $sql .= "WHERE		Disabled = 0" . PHP_EOL;
                $sql .= "ORDER BY	DutyGroupDisplayOrder, DutyGroupID" . PHP_EOL;
                $cbo_DutyGroupName = $this->connectionHR->select($sql);


                $sql = "-- Combo Tinh trang hon nhan" . PHP_EOL;
                $sql .= "SELECT 0 AS MaritalStatusID, N'Độc thân' AS MaritalStatusName" . PHP_EOL;
                $sql .= "UNION" . PHP_EOL;
                $sql .= "SELECT 1 AS MaritalStatusID, N'Kết hôn' AS MaritalStatusName" . PHP_EOL;
                $sql .= "UNION" . PHP_EOL;
                $sql .= "SELECT 2 AS MaritalStatusID, N'Không xét' AS MaritalStatusName" . PHP_EOL;
                $cbo_MaritalStatus = $this->connectionHR->select($sql);

                $sql = " -- Combo Ton giao" . PHP_EOL;
                $sql .= "SELECT 		ReligionID, ReligionNameU AS ReligionName " . PHP_EOL;
                $sql .= "FROM		D09T0204 WITH(NOLOCK)  " . PHP_EOL;
                $sql .= "WHERE		Disabled = 0 " . PHP_EOL;
                $sql .= "ORDER BY	ReligionID" . PHP_EOL;
                $cbo_Religion = $this->connectionHR->select($sql);

                $sql = "-- Do nguon Combo Ho khau" . PHP_EOL;
                $sql .= "EXEC D09P1509 '$lang', 1, 'TINH/THANH', ''" . PHP_EOL;
                $cbo_Population = $this->connectionHR->select($sql);
                \Debugbar::info($cbo_Population);

                $sql = "   -- Combo Quoc tich" . PHP_EOL;
                $sql .= "SELECT 	CountryID as NationalityID, CountryNameU as NationalityName" . PHP_EOL;
                $sql .= "FROM	D91T0017 WITH(NOLOCK)" . PHP_EOL;
                $sql .= "Where	Disabled = 0 " . PHP_EOL;
                $sql .= "Order by	CountryID" . PHP_EOL;
                $cbo_Nationality = $this->connectionHR->select($sql);

                $sql = "   -- Combo Loai tien" . PHP_EOL;
                $sql .= "SELECT 		CurrencyID, CurrencyNameU AS  CurrencyName" . PHP_EOL;
                $sql .= "FROM		D91T0010 " . PHP_EOL;
                $sql .= "WHERE		Disabled = 0" . PHP_EOL;
                $sql .= "ORDER BY	CurrencyID" . PHP_EOL;
                $cbo_Currency = $this->connectionHR->select($sql);

                $sql = "   -- Dropdown Ma chi tieu" . PHP_EOL;
                $sql .= "SELECT	EvaluationElementID, EvaluationElementNameU AS  EvaluationElementName " . PHP_EOL;
                $sql .= "FROM		D39T1000" . PHP_EOL;
                $sql .= "WHERE		Disabled = 0" . PHP_EOL;
                $sql .= "ORDER BY	EvaluationElementID" . PHP_EOL;
                $cbo_Evaluation = json_encode($this->connectionHR->select($sql));

                $sql = "--Do nguon luoi truy van" . PHP_EOL;
                $sql .= "Set nocount on EXEC D09P2098 '',0" . PHP_EOL;
                $Grid1 = json_encode($this->connectionHR->select($sql));
                \Debugbar::info($Grid1);


                $sql = " -- Do nguon cot dong" . PHP_EOL;
                $sql .= "SELECT		Code, ShortU, Disabled, Type, Decimals" . PHP_EOL;
                $sql .= "FROM		D13T9000  WITH (NOLOCK) " . PHP_EOL;
                $sql .= "WHERE		Type = 'D09T0211'" . PHP_EOL;
                $sql .= "ORDER BY	Code" . PHP_EOL;

                $Coefficient = $this->connectionHR->select($sql);


                if (Request::isMethod('Post')) {
                    $DutyID = Input::get('DutyID', '');
                    if ($Action == 'view' || $Action == 'edit') {

                        $sql = "--Do nguon Group Thong tin chuc danh cong viec" . PHP_EOL;
                        $sql .= "EXEC D09P2098 '$DutyID',0" . PHP_EOL;
                        $Group_DutyName = $this->connectionHR->selectOne($sql);
                        if($Group_DutyName['IsMaxDutyManager']==1){
                            $CheckIsMaxDutyManager=$Group_DutyName['IsMaxDutyManager'];
                        }
                        else{
                            $sql = "-- Kiem tra Chuc danh quan ly cao nhat" . PHP_EOL;
                            $sql .= "SELECT Top 1 1 as IsMaxDutyManager" . PHP_EOL;
                            $sql .= "FROM 	D09T0211 WITH(NOLOCK)" . PHP_EOL;
                            $sql .= "WHERE	IsMaxDutyManager = 1" . PHP_EOL;
                            $CheckIsMaxDutyManager = $this->connectionHR->selectOne($sql);
                            $CheckIsMaxDutyManager = $CheckIsMaxDutyManager['IsMaxDutyManager'];
                            \Debugbar::info('kiem tra',$CheckIsMaxDutyManager);
                        }

                        $sql = "--Do nguon Group Thong tin tuyen dung" . PHP_EOL;
                        $sql .= "EXEC W09P1100 '$DutyID',1" . PHP_EOL;
                        $Group_Recruitment = $this->connectionHR->selectOne($sql);
                        //\Debugbar::info($Group_Recruitment);

                        $sql = "--Do nguon Group Chi tieu yeu cau" . PHP_EOL;
                        $sql .= "EXEC W09P1100 '$DutyID',0" . PHP_EOL;
                        $Group_Evaluation = json_encode($this->connectionHR->select($sql));

                        $sql = " --Do nguon Grid nv sao thu viec" . PHP_EOL;
                        $sql .= "EXEC W09P1100 '$DutyID',3" . PHP_EOL;
                        $Tab_Grid2 = json_encode($this->connectionHR->select($sql));

                        $sql = " --Do nguon Grid tai ky HDLD" . PHP_EOL;
                        $sql .= "EXEC W09P1100 '$DutyID',4" . PHP_EOL;
                        $Tab_Grid3 = json_encode($this->connectionHR->select($sql));
                        //\Debugbar::info('vinh test',$Group_Evaluation);

                        $sql = "--Do nguon Group Thong tin he so" . PHP_EOL;
                        $sql .= "EXEC W09P1100 '$DutyID',2" . PHP_EOL;
                        $Group_Coefficient = $this->connectionHR->selectOne($sql);

                    } else if ($Action == 'add') {
                        $Group_Coefficient = '';
                        $Group_Recruitment = '';
                        $Group_DutyName = '';
                        $Group_Evaluation = json_encode([]);
                        $Tab_Grid2 = json_encode([]);
                        $Tab_Grid3 = json_encode([]);
                        $sql = "-- Kiem tra Chuc danh quan ly cao nhat" . PHP_EOL;
                        $sql .= "SELECT Top 1 1 as IsMaxDutyManager" . PHP_EOL;
                        $sql .= "FROM 	D09T0211 WITH(NOLOCK)" . PHP_EOL;
                        $sql .= "WHERE	IsMaxDutyManager = 1" . PHP_EOL;
                        $CheckIsMaxDutyManager = $this->connectionHR->selectOne($sql);
                        $CheckIsMaxDutyManager = $CheckIsMaxDutyManager['IsMaxDutyManager'];


                    }
                    \Debugbar::info('vinh action',$Action);
                    return View::make('W0X.W09.W09F1101', compact('Tab_Grid3','Tab_Grid2','cbComputerLvl','cbForeignLang','cbProfess','cbEducation','cbGender','Group_Coefficient', 'Group_DutyName', 'Group_Recruitment', 'Group_Evaluation', 'CheckIsMaxDutyManager', 'cbo_DutyGroupName', 'cbo_OrgChart', 'cbo_DutyManagername', 'Tab_Grid', 'Coefficient', 'Grid1', 'pForm', 'g', 'titleW09F1101', 'cbo_Nationality', 'cbo_Religion', 'cbo_Currency', 'cbo_MaritalStatus', 'cbo_Population', 'cbo_Evaluation', 'permission', 'Action'));


                }


                break;

            case 'update':
                \Debugbar::info('update');
                \Debugbar::info(Input::all());
                $DutyID =  $this->sqlstring(Input::get('txtDutyIDW09F1101', ''));
                $OrgChart=$this->sqlstring(Input::get('cboOrgChartW09F1101', ''));
                $DutyName =  $this->sqlstring(Input::get('txtDutyNameW09F1101', ''));
                $Description= $this->sqlstring(Input::get('txtDescriptionW09F1101', ''));
                $DutyManagerID = Input::get('cboDutyManagerW09F1101', '');
                $DutyName01 = Input::get('txtDutyName01W09F1101', '');
                $Disabled = Helpers::sqlNumber(Input::get('txtDisabledW09F1101', 0));
                $DutyDisplayOrder = Helpers::sqlNumber(Input::get('txtDutyDisplayOrderW09F1101', 0));
                $IsManager = Helpers::sqlNumber(Input::get('txtIsManagerW09F1101', 0));
                $DutyGroup = Input::get('cboDutyGroupW09F1101', '');
                $SexName = Input::get('txtSexNameW09F1101', '');
                $FromAge = Helpers::sqlNumber(Input::get('txtFromAgeW09F1101', 0));
                $ToAge = Helpers::sqlNumber(Input::get('txtToAgeW09F1101', 0));
                $FromHeight = Helpers::sqlNumber(Input::get('txtFromHeightW09F1101', 0));
                $ToHeight = Helpers::sqlNumber(Input::get('txtToHeightW09F1101', 0));
                $FromWeight = Helpers::sqlNumber(Input::get('txtFromWeightW09F1101', 0));
                $ToWeight = Helpers::sqlNumber(Input::get('txtToWeightW09F1101', 0));
                $Health = $this->sqlstring(Input::get('txtHealthW09F1101', ''));
                $Appearance = $this->sqlstring(Input::get('txtAppearanceW09F1101', ''));
                $MaritalStatusID = Input::get('cboMaritalStatusW09F1101', '');
                $PopulationID = Input::get('cboPopulationW09F1101', '');
                $ReligionID = Input::get('cboReligionW09F1101', '');
                $NationalityID = Input::get('cboNationalityW09F1101', '');
                $EducationLevel = $this->sqlstring(Input::get('txtEducationLevelW09F1101', ''));
                $ProfessionalLevel = $this->sqlstring(Input::get('txtProfessionalLevelW09F1101', ''));
                $LanguageLevel = $this->sqlstring(Input::get('txtLanguageLevelW09F1101', ''));
                $ComputingLevel = $this->sqlstring(Input::get('txtComputingLevelW09F1101', ''));
                $OtherTransaction = $this->sqlstring(Input::get('txtOtherTransactionW09F1101', ''));
                $Experience = $this->sqlstring(Input::get('txtExperienceW09F1101', ''));
                $SalaryFrom = Helpers::sqlNumber(Input::get('txtSalaryFromW09F1101', 0));
                $SalaryTo = Helpers::sqlNumber(Input::get('txtSalaryToW09F1101', 0));
                $CurrencyID = Helpers::sqlNumber(Input::get('cboCurrencyW09F1101', 0));
                $OtherRequirement = $this->sqlstring(Input::get('txtOtherRequirementW09F1101', ''));
                $JobDescription =$this->sqlstring( Input::get('txtJobDescriptionW09F1101', ''));
                $Note = $this->sqlstring(Input::get('txtNoteW09F1101', ''));
                $IsMaxDutyManager = Helpers::sqlNumber(Input::get('txtIsMaxDutyManagerW09F1101', 0));
                $GridW09F1101 = json_decode(Input::get('GridW09F1101'));
                $GridW09F1101_2 = json_decode(Input::get('GridW09F1101_2'));
                $GridW09F1101_3 = json_decode(Input::get('GridW09F1101_3'));

                $Coefficient1 = Helpers::sqlNumber(Input::get('txtCoefficient1W09F1101', 0));
                $Coefficient2 = Helpers::sqlNumber(Input::get('txtCoefficient2W09F1101', 0));
                $Coefficient3 = Helpers::sqlNumber(Input::get('txtCoefficient3W09F1101', 0));
                $Coefficient4 = Helpers::sqlNumber(Input::get('txtCoefficient4W09F1101', 0));
                $Coefficient5 = Helpers::sqlNumber(Input::get('txtCoefficient5W09F1101', 0));
                $Coefficient6 = Helpers::sqlNumber(Input::get('txtCoefficient6W09F1101', 0));
                $Coefficient7 = Helpers::sqlNumber(Input::get('txtCoefficient7W09F1101', 0));
                $Coefficient8 = Helpers::sqlNumber(Input::get('txtCoefficient8W09F1101', 0));
                $Coefficient9 = Helpers::sqlNumber(Input::get('txtCoefficient9W09F1101', 0));
                $Coefficient10 = Helpers::sqlNumber(Input::get('txtCoefficient10W09F1101', 0));
                $Coefficient11 = Helpers::sqlNumber(Input::get('txtCoefficient11W09F1101', 0));
                $Coefficient12 = Helpers::sqlNumber(Input::get('txtCoefficient12W09F1101', 0));
                $Coefficient13 = Helpers::sqlNumber(Input::get('txtCoefficient13W09F1101', 0));
                $Coefficient14 = Helpers::sqlNumber(Input::get('txtCoefficient14W09F1101', 0));
                $Coefficient15 = Helpers::sqlNumber(Input::get('txtCoefficient15W09F1101', 0));
                $Coefficient16 = Helpers::sqlNumber(Input::get('txtCoefficient16W09F1101', 0));
                $Coefficient17 = Helpers::sqlNumber(Input::get('txtCoefficient17W09F1101', 0));
                $Coefficient18 = Helpers::sqlNumber(Input::get('txtCoefficient18W09F1101', 0));
                $Coefficient19 = Helpers::sqlNumber(Input::get('txtCoefficient19W09F1101', 0));
                $Coefficient20 = Helpers::sqlNumber(Input::get('txtCoefficient20W09F1101', 0));
                $Coefficient21 = Helpers::sqlNumber(Input::get('txtCoefficient21W09F1101', 0));
                $Coefficient22 = Helpers::sqlNumber(Input::get('txtCoefficient22W09F1101', 0));
                $Coefficient23 = Helpers::sqlNumber(Input::get('txtCoefficient23W09F1101', 0));
                $Coefficient24 = Helpers::sqlNumber(Input::get('txtCoefficient24W09F1101', 0));
                $Coefficient25 = Helpers::sqlNumber(Input::get('txtCoefficient25W09F1101', 0));
                $Coefficient26 = Helpers::sqlNumber(Input::get('txtCoefficient26W09F1101', 0));
                $Coefficient27 = Helpers::sqlNumber(Input::get('txtCoefficient27W09F1101', 0));
                $Coefficient28 = Helpers::sqlNumber(Input::get('txtCoefficient28W09F1101', 0));
                $Coefficient29 = Helpers::sqlNumber(Input::get('txtCoefficient29W09F1101', 0));
                $Coefficient30 = Helpers::sqlNumber(Input::get('txtCoefficient30W09F1101', 0));

                try {
                    $sql = "---Cap nhat du lieu Group Thong tin chuc danh cong viec" . PHP_EOL;
                    $sql .= "UPDATE      	D09T0211" . PHP_EOL;
                    $sql .= "SET                      DutyManagerID = '$DutyManagerID'," . PHP_EOL;
                    $sql .= "DutyNameU = N'$DutyName', DutyName01U = N'$DutyName01'," . PHP_EOL;
                    $sql .= "Disabled = $Disabled, DutyDisplayOrder = $DutyDisplayOrder," . PHP_EOL;
                    $sql .= "IsManager = $IsManager, DutyGroupID= '$DutyGroup'," . PHP_EOL;
                    $sql .= "OrgChartID= '$OrgChart'," . PHP_EOL;
                    $sql .= "DescriptionU= N'$Description'," . PHP_EOL;
                    $sql .= "IsMaxDutyManager = $IsMaxDutyManager," . PHP_EOL;
                    $sql .= "LastModifyUserID ='$UserID'," . PHP_EOL;
                    $sql .= "LastModifyDate = getDate()" . PHP_EOL;
                    $sql .= "WHERE  		DutyID = '$DutyID'" . PHP_EOL;


                    $sql .= " -- Cap nhat du lieu Group Thong tin tuyen dung" . PHP_EOL;
                    $sql .= "DELETE FROM 	D25T1020" . PHP_EOL;
                    $sql .= "WHERE  		RecPositionID  = '$DutyID'" . PHP_EOL;
                    $sql .= "INSERT INTO	D25T1020" . PHP_EOL;
                    $sql .= "    (RecPositionID, RecPositionNameU, Sex, FromAge, ToAge, FromHeight, ToHeight, FromWeight, ToWeight, HealthU, AppearanceU, MaritalStatusID, PopulationID, ReligionID, NationalityID, EducationLevelID, ProfessionalLevelID, LanguageLevelID, ComputingLevelID, OtherTransactionU, ExperienceU, SalaryFrom, SalaryTo, CurrencyID, OtherRequirementU, JobDescriptionU, NoteU)" . PHP_EOL;
                    $sql .= "VALUES 	('$DutyID', '$DutyName', N'$SexName', '$FromAge', $ToAge, $FromHeight, $ToHeight, $FromWeight, $ToWeight, N'$Health', N'$Appearance', '$MaritalStatusID', '$PopulationID', '$ReligionID', '$NationalityID', N'$EducationLevel', N'$ProfessionalLevel', N'$LanguageLevel', N'$ComputingLevel', N'$OtherTransaction', N'$Experience', $SalaryFrom, $SalaryTo, '$CurrencyID', N'$OtherRequirement', N'$JobDescription', N'$Note')" . PHP_EOL;

                    $sql .= " -- Cap nhat du lieu Group Chi tieu yeu cau" . PHP_EOL;
                    $sql .= "DELETE FROM 	D25T1021" . PHP_EOL;
                    $sql .= "WHERE  		RecPositionID  = '$DutyID'" . PHP_EOL;
                    foreach ($GridW09F1101 as $item) {
                        \Debugbar::info($item->EvaluationElementID);
                        if ($item->OrderNo != '') {
                            $OrderNo = $item->OrderNo;

                        } else {
                            $OrderNo = 0;
                        }
                        $EvaluationElementID =  $this->sqlstring($item->EvaluationElementID);
                        $Note =  $this->sqlstring($item->Note);
                        $sql .= "INSERT INTO	D25T1021" . PHP_EOL;
                        $sql .= "   (RecPositionID, OrderNo, EvaluationElementID, NoteU)" . PHP_EOL;
                        $sql .= "VALUES 		('$DutyID', $OrderNo, '$EvaluationElementID', N'$Note')" . PHP_EOL;

                    }

                    $sql .= " -- Cap nhat du lieu danh gia nhan vien sau thu viec" . PHP_EOL;
                    $sql .= "DELETE FROM 	D39T1070" . PHP_EOL;
                    $sql .= "WHERE  		PositionID  = '$DutyID' AND ElementType = '01'" . PHP_EOL;
                    foreach ($GridW09F1101_2 as $item) {
                        \Debugbar::info($item->EvaluationElementID);
                        if ($item->OrderNo != '') {
                            $OrderNo = $item->OrderNo;

                        } else {
                            $OrderNo = 0;
                        }
                        $EvaluationElementID =  $this->sqlstring($item->EvaluationElementID);
                        $Note =  $this->sqlstring($item->Note);
                        $sql .= "INSERT INTO	D39T1070" . PHP_EOL;
                        $sql .= "   (PositionID, OrderNo, EvaluationElementID, Note, ElementType)" . PHP_EOL;
                        $sql .= "VALUES 		('$DutyID', $OrderNo, '$EvaluationElementID', N'$Note' ,'01')" . PHP_EOL;

                    }

                    $sql .= " -- Cap nhat du lieu tai ky HDLD" . PHP_EOL;
                    $sql .= "DELETE FROM 	D39T1070" . PHP_EOL;
                    $sql .= "WHERE  		PositionID  = '$DutyID' AND ElementType = '02'" . PHP_EOL;
                    foreach ($GridW09F1101_3 as $item) {
                        \Debugbar::info($item->EvaluationElementID);
                        if ($item->OrderNo != '') {
                            $OrderNo = $item->OrderNo;

                        } else {
                            $OrderNo = 0;
                        }
                        $EvaluationElementID =  $this->sqlstring($item->EvaluationElementID);
                        $Note =  $this->sqlstring($item->Note);
                        $sql .= "INSERT INTO	D39T1070" . PHP_EOL;
                        $sql .= "   (PositionID, OrderNo, EvaluationElementID, Note, ElementType)" . PHP_EOL;
                        $sql .= "VALUES 		('$DutyID', $OrderNo, '$EvaluationElementID', N'$Note' ,'02')" . PHP_EOL;

                    }

                    $sql .= "-- Cap nhat du lieu Group Thong tin he so" . PHP_EOL;
                    $sql .= "DELETE	D13T1111	 " . PHP_EOL;
                    $sql .= "WHERE	Type = 'D09T0211'" . PHP_EOL;
                    $sql .= "  AND TypeID = '$DutyID'" . PHP_EOL;
                    $sql .= "INSERT INTO D13T1111" . PHP_EOL;
                    $sql .= "  (" . PHP_EOL;
                    $sql .= "Type, DivisionID, TypeID, Coefficient01, Coefficient02, Coefficient03, Coefficient04, Coefficient05, Coefficient06, Coefficient07, Coefficient08, Coefficient09, Coefficient10, Coefficient11, Coefficient12, Coefficient13, Coefficient14, Coefficient15, Coefficient16, Coefficient17, Coefficient18, Coefficient19, Coefficient20, Coefficient21, Coefficient22, Coefficient23, Coefficient24, Coefficient25, Coefficient26, Coefficient27, Coefficient28, Coefficient29, Coefficient30, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate" . PHP_EOL;
                    $sql .= ")" . PHP_EOL;
                    $sql .= "VALUES" . PHP_EOL;
                    $sql .= "(" . PHP_EOL;
                    $sql .= "'D09T0211',  '$divisionHR', '$DutyID', $Coefficient1, $Coefficient2, $Coefficient3, $Coefficient4, $Coefficient5, $Coefficient6, $Coefficient7, $Coefficient8, $Coefficient9, $Coefficient10, $Coefficient11, $Coefficient12, $Coefficient13, $Coefficient14, $Coefficient15, $Coefficient16, $Coefficient17, $Coefficient18, $Coefficient19, $Coefficient20, $Coefficient21, $Coefficient22, $Coefficient23, $Coefficient24, $Coefficient25, $Coefficient26, $Coefficient27, $Coefficient28, $Coefficient29, $Coefficient30, '$UserID', getDate(), '$UserID', getDate()" . PHP_EOL;
                    $sql .= ")" . PHP_EOL;
                    $this->connectionHR->statement($sql);
                    return json_encode(["status" => "SUCCESS", "message" => \Helpers::getRS($g, "ok")]);
                } catch
                (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    \Debugbar::info($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

                break;
            case 'save':
                //Gia tri chuoi
                //$this->sqlstring();
                //Gia tri so
                //Helpers::sqlNumber();
                //Gia tri ngay
                //Helpers::convertDate();
                \Debugbar::info(Input::all());
                $DutyID = strtoupper ($this->sqlstring(Input::get('txtDutyIDW09F1101', '')));
                $DutyName = $this->sqlstring(Input::get('txtDutyNameW09F1101', ''));
                $OrgChart=$this->sqlstring(Input::get('cboOrgChartW09F1101', ''));
                $DutyManagerID = Input::get('cboDutyManagerW09F1101', '');
                $DutyName01 = $this->sqlstring(Input::get('txtDutyName01W09F1101', ''));
                $Disabled = Helpers::sqlNumber(Input::get('txtDisabledW09F1101', 0));
                $Description= $this->sqlstring(Input::get('txtDescriptionW09F1101', ''));
                $DutyDisplayOrder = Helpers::sqlNumber(Input::get('txtDutyDisplayOrderW09F1101', 0));
                $IsManager = Helpers::sqlNumber(Input::get('txtIsManagerW09F1101', 0));
                $DutyGroup = Input::get('cboDutyGroupW09F1101', '');
                $SexName = Input::get('txtSexNameW09F1101', '');
                $FromAge = Helpers::sqlNumber(Input::get('txtFromAgeW09F1101', 0));
                $ToAge = Helpers::sqlNumber(Input::get('txtToAgeW09F1101', 0));
                $FromHeight = Helpers::sqlNumber(Input::get('txtFromHeightW09F1101', 0));
                $ToHeight = Helpers::sqlNumber(Input::get('txtToHeightW09F1101', 0));
                $FromWeight = Helpers::sqlNumber(Input::get('txtFromWeightW09F1101', 0));
                $ToWeight = Helpers::sqlNumber(Input::get('txtToWeightW09F1101', 0));
                $Health = $this->sqlstring(Input::get('txtHealthW09F1101', ''));
                $Appearance = $this->sqlstring(Input::get('txtAppearanceW09F1101', ''));
                $MaritalStatusID =Input::get('cboMaritalStatusW09F1101', '');
                $PopulationID = Input::get('cboPopulationW09F1101', '');
                $ReligionID = Input::get('cboReligionW09F1101', '');
                $NationalityID = Input::get('cboNationalityW09F1101', '');
                $EducationLevel = $this->sqlstring(Input::get('txtEducationLevelW09F1101', ''));
                $ProfessionalLevel = Input::get('txtProfessionalLevelW09F1101', '');
                $LanguageLevel = $this->sqlstring(Input::get('txtLanguageLevelW09F1101', ''));
                $ComputingLevel = $this->sqlstring(Input::get('txtComputingLevelW09F1101', ''));
                $OtherTransaction =$this->sqlstring( Input::get('txtOtherTransactionW09F1101', ''));
                $Experience = $this->sqlstring(Input::get('txtExperienceW09F1101', ''));
                $SalaryFrom = Helpers::sqlNumber(Input::get('txtSalaryFromW09F1101',0));
                $SalaryTo = Helpers::sqlNumber(Input::get('txtSalaryToW09F1101',0));
                $CurrencyID = Input::get('cboCurrencyW09F1101', '');
                \Debugbar::info($CurrencyID);
                $OtherRequirement =$this->sqlstring( Input::get('txtOtherRequirementW09F1101', ''));
                $JobDescription = $this->sqlstring(Input::get('txtJobDescriptionW09F1101', ''));
                $Note = $this->sqlstring(Input::get('txtNoteW09F1101', ''));

                $IsMaxDutyManager = Helpers::sqlNumber(Input::get('txtIsMaxDutyManagerW09F1101', 0));/// xem lai tai liệu câu này
                $GridW09F1101 = json_decode(Input::get('GridW09F1101'));
                $GridW09F1101_2 = json_decode(Input::get('GridW09F1101_2'));
                $GridW09F1101_3 = json_decode(Input::get('GridW09F1101_3'));

                $Coefficient1 = Helpers::sqlNumber(Input::get('txtCoefficient1W09F1101', 0));
                $Coefficient2 = Helpers::sqlNumber(Input::get('txtCoefficient2W09F1101', 0));
                $Coefficient3 = Helpers::sqlNumber(Input::get('txtCoefficient3W09F1101', 0));
                $Coefficient4 = Helpers::sqlNumber(Input::get('txtCoefficient4W09F1101', 0));
                $Coefficient5 = Helpers::sqlNumber(Input::get('txtCoefficient5W09F1101', 0));
                $Coefficient6 = Helpers::sqlNumber(Input::get('txtCoefficient6W09F1101', 0));
                $Coefficient7 = Helpers::sqlNumber(Input::get('txtCoefficient7W09F1101', 0));
                $Coefficient8 = Helpers::sqlNumber(Input::get('txtCoefficient8W09F1101', 0));
                $Coefficient9 = Helpers::sqlNumber(Input::get('txtCoefficient9W09F1101', 0));
                $Coefficient10 = Helpers::sqlNumber(Input::get('txtCoefficient10W09F1101', 0));
                $Coefficient11 = Helpers::sqlNumber(Input::get('txtCoefficient11W09F1101', 0));
                $Coefficient12 = Helpers::sqlNumber(Input::get('txtCoefficient12W09F1101', 0));
                $Coefficient13 = Helpers::sqlNumber(Input::get('txtCoefficient13W09F1101', 0));
                $Coefficient14 = Helpers::sqlNumber(Input::get('txtCoefficient14W09F1101', 0));
                $Coefficient15 = Helpers::sqlNumber(Input::get('txtCoefficient15W09F1101', 0));
                $Coefficient16 = Helpers::sqlNumber(Input::get('txtCoefficient16W09F1101', 0));
                $Coefficient17 = Helpers::sqlNumber(Input::get('txtCoefficient17W09F1101', 0));
                $Coefficient18 = Helpers::sqlNumber(Input::get('txtCoefficient18W09F1101', 0));
                $Coefficient19 = Helpers::sqlNumber(Input::get('txtCoefficient19W09F1101', 0));
                $Coefficient20 = Helpers::sqlNumber(Input::get('txtCoefficient20W09F1101', 0));
                $Coefficient21 = Helpers::sqlNumber(Input::get('txtCoefficient21W09F1101', 0));
                $Coefficient22 = Helpers::sqlNumber(Input::get('txtCoefficient22W09F1101', 0));
                $Coefficient23 = Helpers::sqlNumber(Input::get('txtCoefficient23W09F1101', 0));
                $Coefficient24 = Helpers::sqlNumber(Input::get('txtCoefficient24W09F1101', 0));
                $Coefficient25 = Helpers::sqlNumber(Input::get('txtCoefficient25W09F1101', 0));
                $Coefficient26 = Helpers::sqlNumber(Input::get('txtCoefficient26W09F1101', 0));
                $Coefficient27 = Helpers::sqlNumber(Input::get('txtCoefficient27W09F1101', 0));
                $Coefficient28 = Helpers::sqlNumber(Input::get('txtCoefficient28W09F1101', 0));
                $Coefficient29 = Helpers::sqlNumber(Input::get('txtCoefficient29W09F1101', 0));
                $Coefficient30 = Helpers::sqlNumber(Input::get('txtCoefficient30W09F1101', 0));
                try {
                    $sql = " ---Kiem tra du lieu truoc khi luu" . PHP_EOL;
                    $sql .= "SELECT 		Top 1 1 as check_exist " . PHP_EOL;
                    $sql .= "FROM 		D09T0211 WITH(NOLOCK)" . PHP_EOL;
                    $sql .= "WHERE		DutyID = '$DutyID'" . PHP_EOL;
                    $check_store=$this->connectionHR->selectOne($sql);
                    $check_store=$check_store['check_exist'];
                    \Debugbar::info('kiem tra',$check_store);
                    if($check_store==1){
                        \Debugbar::info('trung');
                        return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Ma_chuc_danh_cong_viec_da_ton_tai_ban_khong_duoc_phep_luu")]);

                    }
                    else{
                        $sql = "--Them moi du lieu Group Thong tin chuc danh cong viec" . PHP_EOL;
                        $sql .= "INSERT INTO      D09T0211" . PHP_EOL;
                        $sql .= "(OrgChartID, DutyManagerID, DutyID, DutyNameU, DutyName01U, Disabled, IsMaxDutyManager, DutyDisplayOrder, IsManager, DutyGroupID, DescriptionU, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate)" . PHP_EOL;

                        $sql .= "VALUES" . PHP_EOL;
                        $sql .= "('$OrgChart','$DutyManagerID', '$DutyID', N'$DutyName', N'$DutyName01', $Disabled, $IsMaxDutyManager, $DutyDisplayOrder, $IsManager, '$DutyGroup', N'$Description', '$UserID', getDate(), '$UserID', getDate())" . PHP_EOL;

                        $sql .= "--Them moi du lieu Group Thong tin tuyen dung" . PHP_EOL;
                        $sql .= "DELETE FROM 	D25T1020" . PHP_EOL;
                        $sql .= "WHERE  		RecPositionID  = '$DutyID'" . PHP_EOL;

                        $sql .= "INSERT INTO	D25T1020" . PHP_EOL;
                        $sql .= "(RecPositionID, RecPositionNameU, Sex, FromAge, ToAge, FromHeight, ToHeight, FromWeight, ToWeight, HealthU, AppearanceU, MaritalStatusID, PopulationID, ReligionID, NationalityID, EducationLevelID, ProfessionalLevelID, LanguageLevelID, ComputingLevelID, OtherTransactionU, ExperienceU, SalaryFrom, SalaryTo, CurrencyID, OtherRequirementU, JobDescriptionU, NoteU)" . PHP_EOL;
                        $sql .= "VALUES 	('$DutyID', N'$DutyName', N'$SexName', $FromAge, $ToAge, $FromHeight, $ToHeight, $FromWeight, $ToWeight, N'$Health', N'$Appearance', '$MaritalStatusID', '$PopulationID', '$ReligionID', '$NationalityID', N'$EducationLevel', N'$ProfessionalLevel', N'$LanguageLevel', N'$ComputingLevel', N'$OtherTransaction', N'$Experience', $SalaryFrom, $SalaryTo, '$CurrencyID', N'$OtherRequirement', N'$JobDescription', N'$Note')" . PHP_EOL;

                        $sql .= "--Them moi du lieu Group Chi tieu yeu cau" . PHP_EOL;
                        $sql .= "DELETE FROM 	D25T1021" . PHP_EOL;
                        $sql .= "WHERE  		RecPositionID  = '$DutyID'" . PHP_EOL;
                        foreach ($GridW09F1101 as $item) {
                            \Debugbar::info($item);
                            if ($item->OrderNo != '') {
                                $OrderNo = $item->OrderNo;

                            } else {
                                $OrderNo = 0;
                            }
                            $EvaluationElementID =  $this->sqlstring($item->EvaluationElementID);
                            $Note =  $this->sqlstring($item->Note);
                            $sql .= "INSERT INTO	D25T1021" . PHP_EOL;
                            $sql .= "  (RecPositionID, OrderNo, EvaluationElementID, NoteU)" . PHP_EOL;
                            $sql .= "VALUES 		('$DutyID', $OrderNo, '$EvaluationElementID', N'$Note')" . PHP_EOL;
                        }

                        $sql .= " -- Cap nhat du lieu danh gia nhan vien sau thu viec" . PHP_EOL;
                        $sql .= "DELETE FROM 	D39T1070" . PHP_EOL;
                        $sql .= "WHERE  		PositionID  = '$DutyID' AND ElementType = '01'" . PHP_EOL;
                        foreach ($GridW09F1101_2 as $item) {
                            \Debugbar::info($item->EvaluationElementID);
                            if ($item->OrderNo != '') {
                                $OrderNo = $item->OrderNo;

                            } else {
                                $OrderNo = 0;
                            }
                            $EvaluationElementID =  $this->sqlstring($item->EvaluationElementID);
                            $Note =  $this->sqlstring($item->Note);
                            $sql .= "INSERT INTO	D39T1070" . PHP_EOL;
                            $sql .= "   (PositionID, OrderNo, EvaluationElementID, Note, ElementType)" . PHP_EOL;
                            $sql .= "VALUES 		('$DutyID', $OrderNo, '$EvaluationElementID', N'$Note' ,'01')" . PHP_EOL;

                        }

                        $sql .= " -- Cap nhat du lieu tai ky HDLD" . PHP_EOL;
                        $sql .= "DELETE FROM 	D39T1070" . PHP_EOL;
                        $sql .= "WHERE  		PositionID  = '$DutyID' AND ElementType = '02'" . PHP_EOL;
                        foreach ($GridW09F1101_3 as $item) {
                            \Debugbar::info($item->EvaluationElementID);
                            if ($item->OrderNo != '') {
                                $OrderNo = $item->OrderNo;

                            } else {
                                $OrderNo = 0;
                            }
                            $EvaluationElementID =  $this->sqlstring($item->EvaluationElementID);
                            $Note =  $this->sqlstring($item->Note);
                            $sql .= "INSERT INTO	D39T1070" . PHP_EOL;
                            $sql .= "   (PositionID, OrderNo, EvaluationElementID, Note, ElementType)" . PHP_EOL;
                            $sql .= "VALUES 		('$DutyID', $OrderNo, '$EvaluationElementID', N'$Note' ,'02')" . PHP_EOL;

                        }

                        $sql .= "--Them moi du lieu Group Thong tin he so" . PHP_EOL;
                        $sql .= "DELETE	D13T1111	" . PHP_EOL;
                        $sql .= "WHERE	Type = 'D09T0211'" . PHP_EOL;
                        $sql .= "  AND TypeID = '$DutyID'" . PHP_EOL;

                        $sql .= "INSERT INTO D13T1111" . PHP_EOL;
                        $sql .= "  (" . PHP_EOL;
                        $sql .= "Type, DivisionID, TypeID, Coefficient01, Coefficient02, Coefficient03, Coefficient04, Coefficient05, Coefficient06, Coefficient07, Coefficient08, Coefficient09, Coefficient10, Coefficient11, Coefficient12, Coefficient13, Coefficient14, Coefficient15, Coefficient16, Coefficient17, Coefficient18, Coefficient19, Coefficient20, Coefficient21, Coefficient22, Coefficient23, Coefficient24, Coefficient25, Coefficient26, Coefficient27, Coefficient28, Coefficient29, Coefficient30, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate" . PHP_EOL;
                        $sql .= ")" . PHP_EOL;
                        $sql .= "VALUES" . PHP_EOL;
                        $sql .= "(" . PHP_EOL;
                        $sql .= "'D09T0211', '$divisionHR ', '$DutyID', $Coefficient1, $Coefficient2, $Coefficient3, $Coefficient4, $Coefficient5, $Coefficient6, $Coefficient7, $Coefficient8, $Coefficient9, $Coefficient10, $Coefficient11, $Coefficient12, $Coefficient13, $Coefficient14, $Coefficient15, $Coefficient16, $Coefficient17, $Coefficient18, $Coefficient19, $Coefficient20, $Coefficient21, $Coefficient22, $Coefficient23, $Coefficient24, $Coefficient25, $Coefficient26, $Coefficient27, $Coefficient28, $Coefficient29, $Coefficient30, '$UserID', getDate(), '$UserID', getDate()" . PHP_EOL;
                        $sql .= ")" . PHP_EOL;

                        $this->connectionHR->statement($sql);
                        return json_encode(["status" => "SUCCESS", "message" => \Helpers::getRS($g, "ok")]);

                    }



                } catch
                (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    \Debugbar::info($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }


                break;


        }
    }
}
