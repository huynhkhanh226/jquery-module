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

class W09F1100Controller extends W0XController
{
    public function index($pForm, $g, $task = "")
    {
        $permission = \Session::get($pForm);
        $titleW09F1100 = $this->getModalTitle('W09F1100');
        $lang = Session::get('Lang');
        $UserID = Auth::user()->user()->UserID;
        $divisionHR = Session::get("W91P0000")['HRDivisionID'];
        $tranMonth = Session::get("W91P0000")['HRTranMonth'];
        $tranYear = Session::get("W91P0000")['HRTranYear'];
        $employeeID = Auth::user()->user()->HREmployeeID;
        $session = Session::getId();
        switch ($task) {
            case "":
                //\Debugbar::info('vo roi ne');

                $sql = "--Do nguon DD gioi tinh" . PHP_EOL;
                $sql .= "SELECT 0 AS Sex , N'Nam' AS SexName" . PHP_EOL;
                $sql .= "UNION ALL" . PHP_EOL;
                $sql .= "SELECT 1 AS Sex , N'Nữ' AS SexName" . PHP_EOL;
                $sql .= "UNION ALL" . PHP_EOL;
                $sql .= "SELECT 2 AS Sex , '' AS SexNames" . PHP_EOL;
                $cbGender = $this->connectionHR->select($sql);
                //\Debugbar::info($cbGender);

                $sql = "-- Do nguon Combo Ho khau" . PHP_EOL;
                $sql .= "EXEC D09P1509 '$lang', 1, 'TINH/THANH', ''" . PHP_EOL;
                $Population = $this->connectionHR->select($sql);

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
                //\Debugbar::info($cbProfess);

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
                \Debugbar::info($cbComputerLvl);

                $sql = "-- Combo Tinh trang hon nhan" . PHP_EOL;
                $sql .= "SELECT 0 AS MaritalStatusID, N'".Helpers::getRS($g,'Doc_thanU')."' AS MaritalStatusName" . PHP_EOL;
                $sql .= "UNION" . PHP_EOL;
                $sql .= "SELECT 1 AS MaritalStatusID, N'".Helpers::getRS($g,'Ket_honU')."' AS MaritalStatusName" . PHP_EOL;
                $sql .= "UNION" . PHP_EOL;
                $sql .= "SELECT 2 AS MaritalStatusID, N'".Helpers::getRS($g,'Khong_xetU')."' AS MaritalStatusName" . PHP_EOL;
                $MaritalStatus = $this->connectionHR->select($sql);

                $sql = " -- Combo Ton giao" . PHP_EOL;
                $sql .= "SELECT 		ReligionID, ReligionNameU AS ReligionName " . PHP_EOL;
                $sql .= "FROM		D09T0204 WITH(NOLOCK)  " . PHP_EOL;
                $sql .= "WHERE		Disabled = 0 " . PHP_EOL;
                $sql .= "ORDER BY	ReligionID" . PHP_EOL;
                $Religion = $this->connectionHR->select($sql);

                $sql = "   -- Combo Quoc tich" . PHP_EOL;
                $sql .= "SELECT 	CountryID as NationalityID, CountryNameU as NationalityName" . PHP_EOL;
                $sql .= "FROM	D91T0017 WITH(NOLOCK)" . PHP_EOL;
                $sql .= "Where	Disabled = 0 " . PHP_EOL;
                $sql .= "Order by	CountryID" . PHP_EOL;
                $Nationality = $this->connectionHR->select($sql);

                $sql = "   -- Combo Loai tien" . PHP_EOL;
                $sql .= "SELECT 		CurrencyID, CurrencyNameU AS  CurrencyName" . PHP_EOL;
                $sql .= "FROM		D91T0010 " . PHP_EOL;
                $sql .= "WHERE		Disabled = 0" . PHP_EOL;
                $sql .= "ORDER BY	CurrencyID" . PHP_EOL;
                $Currency = $this->connectionHR->select($sql);

                $sql = "   -- Dropdown Ma chi tieu" . PHP_EOL;
                $sql .= "SELECT	EvaluationElementID, EvaluationElementNameU AS  EvaluationElementName " . PHP_EOL;
                $sql .= "FROM		D39T1000" . PHP_EOL;
                $sql .= "WHERE		Disabled = 0" . PHP_EOL;
                $sql .= "ORDER BY	EvaluationElementID" . PHP_EOL;
                $Evaluation = json_encode($this->connectionHR->select($sql));


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

                }
                \Debugbar::info($permission);

                return View::make('W0X.W09.W09F1100', compact('cbComputerLvl','cbForeignLang','cbProfess','cbAdress','cbEducation','cbGender','Tab_Grid', 'Coefficient', 'Grid1', 'pForm', 'g', 'titleW09F1100', 'Nationality', 'Religion', 'Currency', 'MaritalStatus', 'Population', 'Evaluation', 'permission'));
                break;

            case "reloadGrid":
                $sql = "--Do nguon luoi truy van" . PHP_EOL;
                $sql .= "Set nocount on EXEC D09P2098 '',0" . PHP_EOL;
                $Grid1 = $this->connectionHR->select($sql);
                \Debugbar::info($Grid1);
                return $Grid1;
                break;

            case 'filter':
                \Debugbar::info(Input::all());
                $Duty_Id = Input::get('Duty_ID', '');
                $Duty_Name = Input::get('Duty_NAME', '');
                $mode = Input::get('mode', 0);
                //thao test dutyID
                $sql = " --Do nguon Tab1. Thong tin tuyen dung" . PHP_EOL;
                $sql .= "EXEC W09P1100 '$Duty_Id',1" . PHP_EOL;
                $Tab = $this->connectionHR->select($sql);

            /*    foreach ($Tab as $row){
                    $row['FromWeight'] = number_format(intval($row['FromWeight']),2);
                    \Debugbar::info($row['FromWeight']);
                }*/
                \Debugbar::info($Tab);
                $sql = " --Do nguon Grid chi tieu yeu cau" . PHP_EOL;
                $sql .= "EXEC W09P1100 '$Duty_Id',0" . PHP_EOL;
                $Tab_Grid = $this->connectionHR->select($sql);

                $sql = " --Do nguon Grid nv sao thu viec" . PHP_EOL;
                $sql .= "EXEC W09P1100 '$Duty_Id',3" . PHP_EOL;
                $Tab_Grid2 = $this->connectionHR->select($sql);

                $sql = " --Do nguon Grid tai ky HDLD" . PHP_EOL;
                $sql .= "EXEC W09P1100 '$Duty_Id',4" . PHP_EOL;
                $Tab_Grid3 = $this->connectionHR->select($sql);

                $sql = " --Do nguon Tab2. Thong tin he so" . PHP_EOL;
                $sql .= " EXEC W09P1100 '$Duty_Id',2" . PHP_EOL;
                $Tab2 = $this->connectionHR->select($sql);

                return json_encode(array('Tab' => $Tab, 'Tab_Grid' => $Tab_Grid,'Tab_Grid2' => $Tab_Grid2,'Tab_Grid3' => $Tab_Grid3, 'Tab2' => $Tab2, 'Duty_ID' => $Duty_Id, 'Duty_Name' => $Duty_Name));

                \Debugbar::info('filter');
                break;
            case 'save':
                \Debugbar::info('vinh save');
                \Debugbar::info(Input::all());

                $DutyID =  $this->sqlstring(Input::get('Duty_id', ''));
                $DutyName =  $this->sqlstring(Input::get('Duty_name', ''));
                $SexName =  Input::get('txtSexNameW09F1100', '');
                $FromAge = Helpers::sqlNumber(Input::get('txtFromAgeW09F1100', 0));
                $ToAge = Helpers::sqlNumber(Input::get('txtToAgeW09F1100', 0));
                $FromHeight = Helpers::sqlNumber(Input::get('txtFromHeightW09F1100', 0));
                $ToHeight = Helpers::sqlNumber(Input::get('txtToHeightW09F1100', 0));
                $FromWeight = Helpers::sqlNumber(Input::get('txtFromWeightW09F1100', 0));
                $ToWeight = Helpers::sqlNumber(Input::get('txtToWeightW09F1100', 0));
                $Health =  $this->sqlstring(Input::get('txtHealthW09F1100', ''));
                $Appearance =  $this->sqlstring(Input::get('txtAppearanceW09F1100', ''));
                $MaritalStatusID = Input::get('cboMaritalStatusW09F1100', '');
                $PopulationID = Input::get('cboPopulationW09F1100', '');
                $ReligionID = Input::get('cboReligionW09F1100', '');
                $NationalityID = Input::get('cboNationalityW09F1100', '');
                $EducationLevel =  $this->sqlstring(Input::get('txtEducationLevelW09F1100', ''));
                $ProfessionalLevel =  $this->sqlstring(Input::get('txtProfessionalLevelW09F1100', ''));
                $LanguageLevel =  $this->sqlstring(Input::get('txtLanguageLevelW09F1100', ''));
                $ComputingLevel = $this->sqlstring( Input::get('txtComputingLevelW09F1100', ''));
                $OtherTransaction =  $this->sqlstring(Input::get('txtOtherTransactionW09F1100', ''));
                $Experience =  $this->sqlstring(Input::get('txtExperienceW09F1100', ''));
                $SalaryFrom = Helpers::sqlNumber(Input::get('txtSalaryFromW09F1100', 0));
                $SalaryTo = Helpers::sqlNumber(Input::get('txtSalaryToW09F1100', 0));
                $CurrencyID = Input::get('cboCurrencyW09F1100', '');
                $OtherRequirement =  $this->sqlstring(Input::get('txtOtherRequirementW09F1100', ''));
                $JobDescription =  $this->sqlstring(Input::get('txtJobDescriptionW09F1100', ''));
                $Note =$this->sqlstring( Input::get('txtNoteW09F1100', ''));
                \Debugbar::info($Note);

                $Grid2W09F1100 = json_decode(Input::get('Grid2W09F1100'));
                $Grid2W09F1100_2 = json_decode(Input::get('Grid2W09F1100_2'));
                $Grid2W09F1100_3 = json_decode(Input::get('Grid2W09F1100_3'));
                $Coefficient1 = Helpers::sqlNumber(Input::get('Coefficient1', 0));
                $Coefficient2 = Helpers::sqlNumber(Input::get('Coefficient2', 0));
                $Coefficient3 = Helpers::sqlNumber(Input::get('Coefficient3', 0));
                $Coefficient4 = Helpers::sqlNumber(Input::get('Coefficient4', 0));
                $Coefficient5 = Helpers::sqlNumber(Input::get('Coefficient5', 0));
                $Coefficient6 = Helpers::sqlNumber(Input::get('Coefficient6', 0));
                $Coefficient7 = Helpers::sqlNumber(Input::get('Coefficient7', 0));
                $Coefficient8 = Helpers::sqlNumber(Input::get('Coefficient8', 0));
                $Coefficient9 = Helpers::sqlNumber(Input::get('Coefficient9', 0));
                $Coefficient10 = Helpers::sqlNumber(Input::get('Coefficient10', 0));
                $Coefficient11 = Helpers::sqlNumber(Input::get('Coefficient11', 0));
                $Coefficient12 = Helpers::sqlNumber(Input::get('Coefficient12', 0));
                $Coefficient13 = Helpers::sqlNumber(Input::get('Coefficient13', 0));
                $Coefficient14 = Helpers::sqlNumber(Input::get('Coefficient14', 0));
                $Coefficient15 = Helpers::sqlNumber(Input::get('Coefficient15', 0));
                $Coefficient16 = Helpers::sqlNumber(Input::get('Coefficient16', 0));
                $Coefficient17 = Helpers::sqlNumber(Input::get('Coefficient17', 0));
                $Coefficient18 = Helpers::sqlNumber(Input::get('Coefficient18', 0));
                $Coefficient19 = Helpers::sqlNumber(Input::get('Coefficient19', 0));
                $Coefficient20 = Helpers::sqlNumber(Input::get('Coefficient20', 0));
                $Coefficient21 = Helpers::sqlNumber(Input::get('Coefficient21', 0));
                $Coefficient22 = Helpers::sqlNumber(Input::get('Coefficient22', 0));
                $Coefficient23 = Helpers::sqlNumber(Input::get('Coefficient23', 0));
                $Coefficient24 = Helpers::sqlNumber(Input::get('Coefficient24', 0));
                $Coefficient25 = Helpers::sqlNumber(Input::get('Coefficient25', 0));
                $Coefficient26 = Helpers::sqlNumber(Input::get('Coefficient26', 0));
                $Coefficient27 = Helpers::sqlNumber(Input::get('Coefficient27', 0));
                $Coefficient28 = Helpers::sqlNumber(Input::get('Coefficient28', 0));
                $Coefficient29 = Helpers::sqlNumber(Input::get('Coefficient29', 0));
                $Coefficient30 = Helpers::sqlNumber(Input::get('Coefficient30', 0));

//                \Debugbar::info($Grid2W09F1100);
                try {
                    $sql = "-- Tab1. Thông tin tuyển dụng (Chỉ tiêu yêu cầu)" . PHP_EOL;
                    $sql .= "DELETE FROM 	D25T1021" . PHP_EOL;
                    $sql .= "WHERE  		RecPositionID  = '$DutyID'" . PHP_EOL;
                    $sql .= '--Lưu lưới Thông tin tuyển dụng' . PHP_EOL;

                    foreach ($Grid2W09F1100 as $item) {
                        // $arr[3] will be updated with each value from $arr...
                        \Debugbar::info($item->EvaluationElementID);
                        $EvaluationElementID =  $this->sqlstring($item->EvaluationElementID);
                        $Note_grid =  $this->sqlstring($item->Note);
                        $OrderNo= Helpers::sqlNumber($item->OrderNo);

                        $sql .= "INSERT INTO	D25T1021" . PHP_EOL;
                        $sql .= "(RecPositionID, OrderNo, EvaluationElementID, NoteU)" . PHP_EOL;
                        $sql .= "VALUES 		('$DutyID', $OrderNo, '$EvaluationElementID', N'$Note_grid')" . PHP_EOL;

                    }

                    $sql .= "-- Tab Đánh giá nhân viên sau thời gian thử việc" . PHP_EOL;
                    $sql .= "DELETE FROM 	D39T1070" . PHP_EOL;
                    $sql .= "WHERE  		PositionID  = '$DutyID' AND ElementType = '01'" . PHP_EOL;
                    $sql .= '--Lưu lưới Đánh giá nhân viên sau thời gian thử việc' . PHP_EOL;

                    foreach ($Grid2W09F1100_2 as $item) {
                        // $arr[3] will be updated with each value from $arr...
                        \Debugbar::info($item->EvaluationElementID);
                        $EvaluationElementID =  $this->sqlstring($item->EvaluationElementID);
                        $Note_grid =  $this->sqlstring($item->Note);
                        $OrderNo= Helpers::sqlNumber($item->OrderNo);

                        $sql .= "INSERT INTO	D39T1070" . PHP_EOL;
                        $sql .= "(PositionID, OrderNo, EvaluationElementID, Note, ElementType)" . PHP_EOL;
                        $sql .= "VALUES 		('$DutyID', $OrderNo, '$EvaluationElementID', N'$Note_grid', '01')" . PHP_EOL;

                    }

                    $sql .= "-- Tab. Đánh giá nhân viên tái ký HĐLĐ" . PHP_EOL;
                    $sql .= "DELETE FROM 	D39T1070" . PHP_EOL;
                    $sql .= "WHERE  		PositionID  = '$DutyID' AND ElementType = '02'" . PHP_EOL;
                    $sql .= '--Lưu lưới Đánh giá nhân viên sau thời gian thử việc' . PHP_EOL;

                    foreach ($Grid2W09F1100_3 as $item) {
                        // $arr[3] will be updated with each value from $arr...
                        \Debugbar::info($item->EvaluationElementID);
                        $EvaluationElementID =  $this->sqlstring($item->EvaluationElementID);
                        $Note_grid =  $this->sqlstring($item->Note);
                        $OrderNo= Helpers::sqlNumber($item->OrderNo);

                        $sql .= "INSERT INTO	D39T1070" . PHP_EOL;
                        $sql .= "(PositionID, OrderNo, EvaluationElementID, Note, ElementType)" . PHP_EOL;
                        $sql .= "VALUES 		('$DutyID', $OrderNo, '$EvaluationElementID', N'$Note_grid', '02')" . PHP_EOL;

                    }

                    $sql .= "--Luu Tab1. Thông tin tuyển dụng" . PHP_EOL;
                    $sql .= "DELETE FROM 	D25T1020" . PHP_EOL;
                    $sql .= "WHERE  		RecPositionID  = '$DutyID'" . PHP_EOL;

                    $sql .= "INSERT INTO	D25T1020" . PHP_EOL;
                    $sql .= "(RecPositionID, RecPositionNameU, Sex, FromAge, ToAge, FromHeight, ToHeight, FromWeight, ToWeight, HealthU, AppearanceU, MaritalStatusID, PopulationID, ReligionID, NationalityID, EducationLevelID, ProfessionalLevelID, LanguageLevelID, ComputingLevelID, OtherTransactionU, ExperienceU, SalaryFrom, SalaryTo, CurrencyID, OtherRequirementU, JobDescriptionU, NoteU)" . PHP_EOL;
                    $sql .= "VALUES 	('$DutyID', N'$DutyName', N'$SexName', $FromAge, $ToAge, $FromHeight, $ToHeight, $FromWeight, $ToWeight, N'$Health', N'$Appearance', '$MaritalStatusID', '$PopulationID', '$ReligionID', '$NationalityID', N'$EducationLevel', N'$ProfessionalLevel', N'$LanguageLevel', N'$ComputingLevel', N'$OtherTransaction', N'$Experience', $SalaryFrom, $SalaryTo, '$CurrencyID', N'$OtherRequirement', N'$JobDescription', N'$Note')" . PHP_EOL;


                    $sql .= "-- Tab2. Thông tin hệ số" . PHP_EOL;
                    $sql .= "DELETE	D13T1111" . PHP_EOL;
                    $sql .= "WHERE	Type = 'D09T0211'" . PHP_EOL;
                    $sql .= " AND TypeID = '$DutyID'" . PHP_EOL;

                    $sql .= "  INSERT INTO D13T1111" . PHP_EOL;
                    $sql .= "   (" . PHP_EOL;
                    $sql .= "  Type, DivisionID, TypeID, Coefficient01, Coefficient02, Coefficient03, Coefficient04, Coefficient05, Coefficient06, Coefficient07, Coefficient08, Coefficient09, Coefficient10, Coefficient11, Coefficient12, Coefficient13, Coefficient14, Coefficient15, Coefficient16, Coefficient17, Coefficient18, Coefficient19, Coefficient20, Coefficient21, Coefficient22, Coefficient23, Coefficient24, Coefficient25, Coefficient26, Coefficient27, Coefficient28, Coefficient29, Coefficient30, CreateUserID, CreateDate, LastModifyUserID, LastModifyDate" . PHP_EOL;
                    $sql .= ")" . PHP_EOL;
                    $sql .= "VALUES" . PHP_EOL;
                    $sql .= "(" . PHP_EOL;
                    $sql .= "'D09T0211', '$divisionHR ', '$DutyID', $Coefficient1, $Coefficient2, $Coefficient3, $Coefficient4, $Coefficient5, $Coefficient6, $Coefficient7, $Coefficient8, $Coefficient9, $Coefficient10, $Coefficient11, $Coefficient12, $Coefficient13, $Coefficient14, $Coefficient15, $Coefficient16, $Coefficient17, $Coefficient18, $Coefficient19, $Coefficient20, $Coefficient21, $Coefficient22, $Coefficient23, $Coefficient24, $Coefficient25, $Coefficient26, $Coefficient27, $Coefficient28, $Coefficient29, $Coefficient30, '   $UserID', getDate(), '   $UserID', getDate()" . PHP_EOL;
                    $sql .= ")" . PHP_EOL;

                    \Debugbar::info($sql);
                    $this->connectionHR->statement($sql);
                    return json_encode(["status" => "SUCCESS", "message" => \Helpers::getRS($g, "ok")]);
                } catch (Exception $ex) {
                    \Helpers::log($ex->getMessage());
                    return json_encode(["status" => "ERROR", "message" => \Helpers::getRS($g, "Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                }

                break;
            case 'delete_all':
                $gridW09F1100_data = json_decode(Input::get('gridW09F1100_data', ''));
                \Debugbar::info($gridW09F1100_data);
                $sql = "--  Xóa tất cả" . PHP_EOL;
                $sql .= "DELETE D09T6666 " . PHP_EOL;
                $sql .= "WHERE UserID = '$UserID' AND HostID = '$session' AND FormID = 'W09F1100'" . PHP_EOL;
                $this->connectionHR->statement($sql);
                $sql = "--Insert vào những dòng xuất hiện trên lưới" . PHP_EOL;
                foreach ($gridW09F1100_data as $item) {
                    $DutyID =  $this->sqlstring($item->DutyID);
                    $sql .= "INSERT INTO	D09T6666 (UserID, HostID, FormID, Key01ID)" . PHP_EOL;
                    $sql .= "VALUES('$UserID', '$session', 'W09F1100', '$DutyID')" . PHP_EOL;
                }
                $this->connectionHR->statement($sql);


                $sql = "--Kiem tra truoc khi xoa" . PHP_EOL;
                $sql .= "EXEC W09P5555 '','$UserID','%','','84',0,NULL,0,'', 'W09F1100','$session'	" . PHP_EOL;
                $Check_delete = $this->connectionHR->selectOne($sql);
                if ($Check_delete['Status'] == 0) {
                    $sql = "--Xoa tat ca" . PHP_EOL;
                    $sql .= "EXEC W09P1102 '$UserID','$session','W09F1100',1" . PHP_EOL;
                    $this->connectionHR->statement($sql);
                    return json_encode(["status" => "SUCCESS"]);
                } else {
                    return json_encode(["status" => "ERROR", "message" => $Check_delete['Message']]);
                }
                break;
            case 'delete':
                \Debugbar::info('delete');
                $rowW09F1100_data = Input::get('rowW09F1100', '');
                $DutyID = $rowW09F1100_data['DutyID'];

                $sql = "--Xóa 1 dòng trên lưới" . PHP_EOL;
                $sql .= "DELETE D09T6666 " . PHP_EOL;
                $sql .= "WHERE UserID = '$UserID' AND HostID = '$session' AND FormID = 'W09F1100'" . PHP_EOL;
                $this->connectionHR->statement($sql);

                $sql = "--Insert vào dòng được xóa" . PHP_EOL;
                $sql .= "INSERT INTO	D09T6666 (UserID, HostID, FormID, Key01ID)" . PHP_EOL;
                $sql .= "VALUES	('$UserID', '$session', 'W09F1100', '$DutyID')" . PHP_EOL;
                $this->connectionHR->statement($sql);


                $sql = " --Kiem tra truoc khi xoa" . PHP_EOL;
                $sql .= "EXEC W09P5555 '','$UserID','$DutyID','','84',0,NULL,0,'','W09F1100','$session'" . PHP_EOL;
                $Check_delete = $this->connectionHR->selectOne($sql);
                \Debugbar::info('vinh check', $Check_delete['Status']);
                if ($Check_delete['Status'] == 0) {

                    \Debugbar::info($Check_delete['Status']);
                    $sql = "--Xoa 1 dong" . PHP_EOL;
                    $sql .= "EXEC W09P1102 '$UserID','$session','W09F1100',1" . PHP_EOL;
                    $this->connectionHR->statement($sql);


                    return json_encode(["status" => "SUCCESS"]);
                } else {

                    return json_encode(["status" => "ERROR", "message" => $Check_delete['Message']]);


                }


                break;

        }
    }
}
