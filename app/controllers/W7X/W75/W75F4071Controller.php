<?php
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
	
	class W75F4071Controller extends W7XController {
		//Khi open tab s? g?i controller này

		public function index($pForm, $g, $task='')
		{
			$all = Input::all();
			$division = Session::get("W91P0000")['HRDivisionID'];
			$hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
			$lang = Session::get('Lang');
			$userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
			$tranmonth = Session::get("W91P0000")['HRTranMonth'];
			$tranyear = Session::get("W91P0000")['HRTranYear'];
			\Debugbar::info($task);
			$modalTitle= $this->getModalTitleG4($pForm);
            $sql = "--Lay thong thiet OT" . PHP_EOL;
            $sql .= " set nocount on " . PHP_EOL;
            $sql .= " select * from D29T0003 where TransTypeID='DKTC'" . PHP_EOL;
            $rsTemp = $this->connectionHR->selectOne($sql);
            $isHideOT = $rsTemp["NumValue"] == 0 ? true : false;
            //$isHideOT = true;
            $daysInMonth = Helpers::getDaysInAnyMonth($tranmonth, $tranyear);
            $sql = "--Lay thong thiet OT" . PHP_EOL;
            $sql .= " set nocount on " . PHP_EOL;
            $sql .= " select * from D29T0003 where TransTypeID='ConfirmOT'" . PHP_EOL;
            $rsTemp = $this->connectionHR->selectOne($sql);
            $isHideConfirmOT = $rsTemp["NumValue"] == 0 ? true : false;
            $hostID = Session::getId();
            //$isHideConfirmOT = false;
			switch($task){
				case '':
					/*$sql = "--Lay danh sach ngay".PHP_EOL;
					$sql .= "Exec D75P4073 '$division', $tranmonth, $tranyear, '$userid', '$lang', 1, '$hr_employee_id', 0";
					$dateList =$this->connectionHR->select($sql);*/

                    $sql = "SELECT AttPeriodFrom, AttPeriodTo FROM d29t0000";
                    $daynMonth = $this->connectionHR->selectOne($sql);// lấy mảng chứa ngày bắt đầu và kết thúc của chu kỳ
                    \Debugbar::info($daynMonth);
                    $AttPeriodFrom = intval($daynMonth['AttPeriodFrom']);
                    $AttPeriodTo = intval($daynMonth['AttPeriodTo']);
                    $monthPeriod = 0;// tháng kết thúc của chu kỳ
                    if($AttPeriodFrom > $AttPeriodTo){//nếu ngày bắt đầu lớn hơn ngày kết thúc
                        $monthPeriod = intval($tranmonth) - 1;
                    }else{
                        $AttPeriodTo = $daysInMonth;
                        $monthPeriod = intval($tranmonth);
                    }

                    //\Debugbar::info($monthPeriod);
					$sql = "--Do nguon luoi dang ky tang ca".PHP_EOL;
					$sql .= "Exec W75P4071 '$division', $tranmonth, $tranyear, '$userid', '$lang', 1, '$hr_employee_id', 0";
					$shiftList = $this->connectionHR->select($sql);
					\Debugbar::info(json_encode($shiftList));
					return View::make("W7X.W75.W75F4071", compact('AttPeriodFrom', 'AttPeriodTo', 'monthPeriod','daysInMonth','isHideConfirmOT',"isHideOT",'pForm', 'g','modalTitle','task','shiftList','tranmonth'));
					break;
				/*case 'settext':
					$wokingDate = Helpers::convertDate(Helpers::decode_string(Input::get('wokingDate')));
					$sql = "--Lay danh sach ngay".PHP_EOL;
					$sql .= "Exec W75P4073 '$division', '$userid', '$lang', '$hr_employee_id', $wokingDate, 0";
					\Debugbar::info($sql);
					$dateList =$this->connectionHR->select($sql);

					return $dateList;
					break;*/

                case "settext":
                    \Debugbar::info(Input::all());
                    $AttendanceDate = Helpers::convertDate(Helpers::decode_string(Input::get('wokingDate')));
                    $sqlLoad ="-- load du lieu cho master gan các gia tri khi chon ngay lam viec".PHP_EOL;
                    $sqlLoad .= "EXEC W75P4073 " .PHP_EOL;
                    $sqlLoad .= "'$division',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                    $sqlLoad .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[50], NOT NULL
                    $sqlLoad .= "'$lang',".PHP_EOL; //Language, varchar[5], NOT NULL
                    $sqlLoad .= "'$hr_employee_id',".PHP_EOL; //EmployeeID, varchar[50], NOT NULL
                    $sqlLoad .= "$AttendanceDate,".PHP_EOL; //AttendanceDate, datetime, NOT NULL
                    $sqlLoad .= "0"; //Mode, tinyint, NOT NULL

                    /*$sql = "SELECT 	TOP 1 1 ".PHP_EOL;
                    $sql .= "FROM 	D29T2000".PHP_EOL;
                    $sql .= "WHERE 	EmployeeID = '$hr_employee_id'".PHP_EOL;
                    $sql .= "AND WorkingDay = $AttendanceDate".PHP_EOL;

                    $rsSelect = $this->connectionHR->select($sql);
                    \Debugbar::info($rsSelect);

                    if(count($rsSelect) == 0){
                        $sql = "DELETE D09T6666".PHP_EOL;
                        $sql .= "WHERE  UserID = '$userid' AND HostID = '$hostID' AND FormID = 'D29F2130'".PHP_EOL;
                        $sql .= "INSERT INTO D09T6666 (UserID, HostID, Key01ID, FormID)".PHP_EOL;
                        $sql .= "SELECT '$userid', '$hostID',DepartmentID,'D29F2130'".PHP_EOL;
                        $sql .= "FROM D91T0012 WITH (NOLOCK)".PHP_EOL;
                        $sql .= "WHERE DivisionID = '$division'".PHP_EOL;

                        $this->connectionHR->statement($sql);

                        $sql ="--SP kiem tra".PHP_EOL;
                        $sql .= "EXEC W75P5555 " .PHP_EOL;
                        $sql .= "'$division',".PHP_EOL; //DivisionID, varchar[20], NOT NULL
                        $sql .= "'$lang',".PHP_EOL; //Language, varchar[20], NOT NULL
                        $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[20], NOT NULL
                        $sql .= "'".Session::getId()."',".PHP_EOL; //HostID, varchar[20], NOT NULL
                        $sql .= "3,".PHP_EOL; //Mode, int, NOT NULL
                        $sql .= "'D75F4071',".PHP_EOL; //FormID, varchar[20], NOT NULL
                        $sql .= "'$hr_employee_id',".PHP_EOL; //EmployeeID, varchar[20], NOT NULL
                        $sql .= "'',".PHP_EOL; //Key01ID, varchar[20], NOT NULL
                        $sql .= "'',".PHP_EOL; //Key02ID, varchar[20], NOT NULL
                        $sql .= "'',".PHP_EOL; //Key03ID, varchar[20], NOT NULL
                        $sql .= "'',".PHP_EOL; //Key04ID, varchar[20], NOT NULL
                        $sql .= "'',".PHP_EOL; //Key05ID, varchar[20], NOT NULL
                        $sql .= "'',".PHP_EOL; //Key06ID, varchar[20], NOT NULL
                        $sql .= "0,".PHP_EOL; //Num01, decimal, NOT NULL
                        $sql .= "0,".PHP_EOL; //Num02, decimal, NOT NULL
                        $sql .= "0,".PHP_EOL; //Num03, decimal, NOT NULL
                        $sql .= "0,".PHP_EOL; //Num04, decimal, NOT NULL
                        $sql .= "0,".PHP_EOL; //Num05, decimal, NOT NULL
                        $sql .= "$AttendanceDate,".PHP_EOL; //Date01, datetime, NOT NULL
                        $sql .= "'',".PHP_EOL; //Date02, datetime, NOT NULL
                        $sql .= "'',".PHP_EOL; //Date03, datetime, NOT NULL
                        $sql .= "''"; //Key07ID, varchar[20], NOT NULL

                        $rsCheck = $this->connectionHR->selectOne($sql);
                        \Debugbar::info($rsCheck);
                        if(intval($rsCheck['Status']) == 1){
                            return json_encode(array('status' => 'STOP', 'data'=>$rsCheck['Message']));
                        }
                        if(intval($rsCheck['Status']) == 0){
                            $sql = "EXEC D29P2070" .PHP_EOL;
                            $sql .= "'$division',".PHP_EOL; //DivisionID, varchar[50], NOT NULL
                            $sql .= "$AttendanceDate,".PHP_EOL; //AttDateFrom, datetime, NOT NULL
                            $sql .= "$AttendanceDate,".PHP_EOL; //AttDateTo, datetime, NOT NULL
                            $sql .= "0,".PHP_EOL; //IsPreOT, tinyint, NOT NULL
                            $sql .= "0,".PHP_EOL; //IsAfterOT, tinyint, NOT NULL
                            $sql .= "1,".PHP_EOL; //IsEmployee, tinyint, NOT NULL
                            $sql .= "'$hr_employee_id',".PHP_EOL; //EmployeeID, varchar[50], NOT NULL
                            $sql .= "'".Auth::user()->user()->UserID."',".PHP_EOL; //UserID, varchar[50], NOT NULL
                            $sql .= "'".Session::getId()."',".PHP_EOL; //HostID, varchar[50], NOT NULL
                            $sql .= "'D29F2130',".PHP_EOL; //FormID, varchar[50], NOT NULL
                            $sql .= "'$lang',".PHP_EOL; //Language, varchar[2], NOT NULL
                            $sql .= "'',".PHP_EOL; //ShiftRotationTypeID, varchar[50], NOT NULL
                            $sql .= "0"; //ApplyLevel, tinyint, NOT NULL

                            try{
                                $this->connectionHR->statement($sql);
                                $rsMaster = $this->connectionHR->selectOne($sqlLoad);
                                \Debugbar::info($rsMaster);
                                return json_encode(array('status' => 'SUCCESS', 'data' => $rsMaster));
                            }catch (Exception $e){
                                return json_encode(array('status' => 'FAILED', 'data'=>$e->getMessage()));
                            }
                        }
                    }*/
                    $rsMaster = $this->connectionHR->selectOne($sqlLoad);
                    return json_encode(array('status' => 'SUCCESS', 'data' => $rsMaster));
                    break;

				case "save":
					$transid = '';
					$Times = $all['time'] + 1;
					$attdate =Helpers::convertDate(Helpers::decode_string($all['attdate']));
					$shiftID = Helpers::decode_string($all['shift']);
					$preOTFrom=str_replace(":","", Helpers::decode_string($all['preOTFrom']));
					$preOTTo=str_replace(":","",Helpers::decode_string($all['preOTTo']));
					$preOTHour=Helpers::decode_string($all['preOTHour']);
					$afterOTFrom=str_replace(":","",Helpers::decode_string($all['afterOTFrom']));
					$afterOTTo=str_replace(":","",Helpers::decode_string($all['afterOTTo']));
					$afterOTHour=Helpers::decode_string($all['afterOTHour']);
					$reason=urldecode($all['reason']);
                    $txtResult=urldecode($all['result']);
					$session = Session::getId();

                    $preOTHoursSplit = Input::get("preOTHoursSplit", 0);
                    $preOTLeave  = Input::get("preOTLeave", 0);
                    $afterOTHoursSplit   = Input::get("afterOTHoursSplit", 0);
                    $afterOTLeave  = Input::get("afterOTLeave", 0);
                    $isPriorityLeave = Input::get("isPriorityLeave", 0);
                    $optIsOTCompany = Input::get("optIsOTCompany", 0);
                    //$mode = Input::get("mode", 0);

					$rData=$this->connectionHR->selectOne("EXEC W75P1005 '".Session::get("W91P0000")['HRDivisionID']."', ".Session::get("W91P0000")['HRTranMonth'] . ",". Session::get("W91P0000")['HRTranYear'] .",'".$userid."', 'D75F1005', '". $hr_employee_id ."'");

					$DirectManagerID = $rData['DirectManagerID'];
					$sql = "Exec W75P5555 '$division', '$lang', '$userid', '$session', 0, 'D75F4071', '$hr_employee_id','$shiftID','$preOTFrom','$preOTTo','$afterOTFrom','$afterOTTo','',0,0,0,0,0,$attdate, null,null";

					$result = $this->connectionHR->select($sql);
					if (count($result)>0){
						if ($result[0]['Status'] == 1){
							return array('status'=>0,'message'=> $result[0]['Message'],'rowData'=>'');
						}else{
							$transid = $this->CreateIGE($g, 'D75T4071', '75', 'OT');
							try {
								$sql = "--Tao bang tam chua du lieu luu" .PHP_EOL;
								$sql.="CREATE TABLE #W75P4071 (";
								$sql.="TransID		Varchar(50),";
								$sql.="Times 		INT ,";
								$sql.="EmployeeID		VARCHAR(20),";
								$sql.="AttendanceDate	DATETIME,";
								$sql.="ShiftID		Varchar (20),";
								$sql.="PreOTFrom		Varchar(20),";
								$sql.="PreOTTo		Varchar(20),";
								$sql.="PreOTHours		decimal(19,4) ,";
								$sql.="PreOTStatus		INT,";
								$sql.="AfterOTFrom	Varchar(6),";
								$sql.="AfterOTTo		Varchar(6),";
								$sql.="AfterOTHours	 decimal(19,4) ,";
								$sql.="AfterOTStatus	Int,";
								$sql.="CreateUserID	Varchar(20),";
								$sql.="LastModifyUserID Varchar(20),";
								$sql.="LastModifyDate	Datetime,";
								$sql.="CreateDate		Datetime,";
								$sql.="[Disabled]		Int,";

                                $sql.=" PreOTHoursSplit	decimal(19,4),";
                                $sql.=" PreOTLeave	decimal(19,4),";
                                $sql.=" AfterOTHoursSplit 	decimal(19,4),";
                                $sql.=" AfterOTLeave	decimal(19,4),";
                                $sql.=" IsPriorityLeave	 Tinyint,";
                                $sql.=" IsOTCompany	 Tinyint,";

								$sql.="NoteU		Nvarchar(500),";
								$sql.="ReasonU		Nvarchar(1000),";
                                $sql.="ResultU		Nvarchar(1000),";
								$sql.="UserID		Varchar(20),";
								$sql.="HostID		Varchar(max),";
								$sql.="DirectManagerID 	Varchar(50)";
								$sql.=")".PHP_EOL;

								$sql.="--Insert dang ky tang ca vang bang tam".PHP_EOL;
								$sql.="set nocount on".PHP_EOL;
								$sql.="INSERT INTO #W75P4071(";
								$sql.="TransID,";
								$sql.="Times,";
								$sql.="EmployeeID,";
								$sql.="AttendanceDate,";
								$sql.="ShiftID,";
								$sql.="PreOTFrom,";
								$sql.="PreOTTo,";
								$sql.="PreOTHours,";
								$sql.="PreOTStatus,";
								$sql.="AfterOTFrom,";
								$sql.="AfterOTTo,";
								$sql.="AfterOTHours,";
								$sql.="AfterOTStatus,";
								$sql.="CreateUserID,";
								$sql.="LastModifyUserID,";
								$sql.="LastModifyDate,";
								$sql.="CreateDate,";
								$sql.="[Disabled],";

                                $sql.="PreOTHoursSplit,";
                                $sql.="PreOTLeave,";
                                $sql.="AfterOTHoursSplit ,";
                                $sql.="AfterOTLeave, ";
                                $sql.="IsPriorityLeave,";
                                $sql.="IsOTCompany,";
								$sql.="NoteU,";
								$sql.="ReasonU,";
                                $sql.="ResultU,";
								$sql.="UserID,";
								$sql.="HostID,";
								$sql.="DirectManagerID";
								$sql.=")VALUES(";
								$sql.="'$transid',";//		-- AddNew: ��, Edit:  @TransID
								$sql.="$Times,";
								$sql.="'$hr_employee_id',";
								$sql.="$attdate,";
								$sql.="'$shiftID',";
								$sql.="'$preOTFrom',";
								$sql.="'$preOTTo',";
								$sql.="$preOTHour,";
								$sql.="0,";
								$sql.="'$afterOTFrom',";
								$sql.="'$afterOTTo',";
								$sql.="$afterOTHour,";
								$sql.="0,";
								$sql.="'$userid',";
								$sql.="'$userid',";
								$sql.="GetDate(),";
								$sql.="GetDate(),";
								$sql.="0,";

                                $sql.="$preOTHoursSplit,";
                                $sql.="$preOTLeave,";
                                $sql.="$afterOTHoursSplit,";
                                $sql.="$afterOTLeave,";
                                $sql.="$isPriorityLeave,";
                                $sql.="$optIsOTCompany,";


								$sql.="N'',";
								$sql.="N'".$this->sqlstring($reason)."',";
                                $sql.="N'".$this->sqlstring($txtResult)."',";
								$sql.="'$userid',";
								$sql.="'$session',";
								$sql.="'$DirectManagerID'";
								$sql.=")".PHP_EOL ;
								$sql.="---	Thuc thi store luu du lieu ".PHP_EOL;
								$sql.="EXEC  W75P4072 '$division', 0, '$userid', '$session' ";

								//\Debugbar::info($sql);
								//$this->connectionHR->statement($sql);

								$this->connectionHR->getPdo()->beginTransaction();
								$this->connectionHR->getPdo()->exec($sql);
								$this->connectionHR->getPdo()->commit();

								$sql = "--Do nguon luoi dang ky tang ca".PHP_EOL;
								$sql .= "Exec W75P4071 '$division', $tranmonth, $tranyear, '$userid', '$lang', 1, '$hr_employee_id', 0, '$transid'";
								$shiftList = $this->connectionHR->selectOne($sql);


								//\Debugbar::info($shiftList);
                                if($shiftList['IsSentMail']==1)
                                {
                                    if($shiftList['IsShowMailScreen']==0)
                                    {
                                        $this->SendMailAuto($shiftList['EmailContent'],$shiftList);
                                    }
                                }
								return array('status'=>1,'message'=> '','rowData'=>$shiftList);
							} catch (Exception $ex) {
								//\Debugbar::info($ex);
								$this->connectionHR->getPdo()->rollBack();
								return array('status'=>2,'message'=> $ex->getMessage(),'rowData'=>'');
							}

						}
					}


					break;

				case "update":
					$transid = $all['transid'];
					$Times = $all['time'];
					$attdate =Helpers::convertDate(Helpers::decode_string($all['attdate']));
					$shiftID = Helpers::decode_string($all['shift']);
					$preOTFrom=str_replace(":","", Helpers::decode_string($all['preOTFrom']));
					$preOTTo=str_replace(":","",Helpers::decode_string($all['preOTTo']));
					$preOTHour=Helpers::decode_string($all['preOTHour']);
					$afterOTFrom=str_replace(":","",Helpers::decode_string($all['afterOTFrom']));
					$afterOTTo=str_replace(":","",Helpers::decode_string($all['afterOTTo']));
					$afterOTHour=Helpers::decode_string($all['afterOTHour']);

                    $preOTHoursSplit = Input::get("preOTHoursSplit", 0);
                    $preOTLeave  = Input::get("preOTLeave", 0);
                    $afterOTHoursSplit   = Input::get("afterOTHoursSplit", 0);
                    $afterOTLeave  = Input::get("afterOTLeave", 0);
                    $isPriorityLeave = Input::get("isPriorityLeave", 0);
                    $optIsOTCompany = Input::get("optIsOTCompany", 0);
                    $mode = Input::get("mode", 1);
					$reason=urldecode($all['reason']);
                    $txtResult = urldecode($all['result']);
					$session = Session::getId();


					$rData=$this->connectionHR->selectOne("EXEC W75P1005 '".Session::get("W91P0000")['HRDivisionID']."', ".Session::get("W91P0000")['HRTranMonth'] . ",". Session::get("W91P0000")['HRTranYear'] .",'".$userid."', 'D75F1005', '". $hr_employee_id ."'");

					$DirectManagerID = $rData['DirectManagerID'];
					//$sql = "Exec W75P5555 '$division', '$lang', '$userid', '$session', 1, 'D75F4071', '$hr_employee_id','$transid','','','','','',0,0,0,0,0,$attdate, null,null";
					$sql = "Exec W75P5555 '$division', '$lang', '$userid', '$session', 0, 'D75F4071', '$hr_employee_id','$shiftID','$preOTFrom','$preOTTo','$afterOTFrom','$afterOTTo','$transid',0,0,0,0,0,$attdate, null,null";
					$result = $this->connectionHR->select($sql);
					if (count($result)>0){
						if ($result[0]['Status'] == 1){
							return array('status'=>0,'message'=> $result[0]['Message'],'rowData'=>'');
						}else{
							try {
								$sql = "--Tao bang tam chua du lieu luu" .PHP_EOL;
								$sql.="CREATE TABLE #W75P4071 (";
								$sql.="TransID		Varchar(50),";
								$sql.="Times 		INT ,";
								$sql.="EmployeeID		VARCHAR(20),";
								$sql.="AttendanceDate	DATETIME,";
								$sql.="ShiftID		Varchar (20),";
								$sql.="PreOTFrom		Varchar(20),";
								$sql.="PreOTTo		Varchar(20),";
								$sql.="PreOTHours		decimal(19,4) ,";
								$sql.="PreOTStatus		INT,";
								$sql.="AfterOTFrom	Varchar(6),";
								$sql.="AfterOTTo		Varchar(6),";
								$sql.="AfterOTHours	 decimal(19,4) ,";
								$sql.="AfterOTStatus	Int,";
								$sql.="CreateUserID	Varchar(20),";
								$sql.="LastModifyUserID Varchar(20),";
								$sql.="LastModifyDate	Datetime,";
								$sql.="CreateDate		Datetime,";
								$sql.="[Disabled]		Int,";

                                $sql.=" PreOTHoursSplit	decimal(19,4),";
                                $sql.=" PreOTLeave	decimal(19,4),";
                                $sql.=" AfterOTHoursSplit 	decimal(19,4),";
                                $sql.=" AfterOTLeave	decimal(19,4),";
                                $sql.=" IsPriorityLeave	 Tinyint,";
                                $sql.=" IsOTCompany	 Tinyint,";

								$sql.="NoteU		Nvarchar(500),";
								$sql.="ReasonU		Nvarchar(1000),";
                                $sql.="ResultU		Nvarchar(1000),";
								$sql.="UserID		Varchar(20),";
								$sql.="HostID		Varchar(max),";
								$sql.="DirectManagerID 	Varchar(50)";
								$sql.=")".PHP_EOL;

								$sql.="--Insert dang ky tang ca vang bang tam".PHP_EOL;
								$sql.="set nocount on".PHP_EOL;
								$sql.="INSERT INTO #W75P4071(";
								$sql.="TransID,";
								$sql.="Times,";
								$sql.="EmployeeID,";
								$sql.="AttendanceDate,";
								$sql.="ShiftID,";
								$sql.="PreOTFrom,";
								$sql.="PreOTTo,";
								$sql.="PreOTHours,";
								$sql.="PreOTStatus,";
								$sql.="AfterOTFrom,";
								$sql.="AfterOTTo,";
								$sql.="AfterOTHours,";
								$sql.="AfterOTStatus,";
								$sql.="CreateUserID,";
								$sql.="LastModifyUserID,";
								$sql.="LastModifyDate,";
								$sql.="CreateDate,";
								$sql.="[Disabled],";


                                $sql.="PreOTHoursSplit,";
                                $sql.="PreOTLeave,";
                                $sql.="AfterOTHoursSplit ,";
                                $sql.="AfterOTLeave, ";
                                $sql.="IsPriorityLeave,";
                                $sql.="IsOTCompany,";


                                $sql.="NoteU,";
								$sql.="ReasonU,";
                                $sql.="ResultU,";
								$sql.="UserID,";
								$sql.="HostID,";
								$sql.="DirectManagerID";
								$sql.=")VALUES(";
								$sql.="'$transid',";//		-- AddNew: ��, Edit:  @TransID
								$sql.="$Times,";
								$sql.="'$hr_employee_id',";
								$sql.="$attdate,";
								$sql.="'$shiftID',";
								$sql.="'$preOTFrom',";
								$sql.="'$preOTTo',";
								$sql.="$preOTHour,";
								$sql.="0,";
								$sql.="'$afterOTFrom',";
								$sql.="'$afterOTTo',";
								$sql.="$afterOTHour,";
								$sql.="0,";
								$sql.="'$userid',";
								$sql.="'$userid',";
								$sql.="GetDate(),";
								$sql.="GetDate(),";
								$sql.="0,";

                                $sql.="$preOTHoursSplit,";
                                $sql.="$preOTLeave,";
                                $sql.="$afterOTHoursSplit,";
                                $sql.="$afterOTLeave,";
                                $sql.="$isPriorityLeave,";
                                $sql.="$optIsOTCompany,";

								$sql.="N'',";
								$sql.="N'".$this->sqlstring($reason)."',";
                                $sql.="N'".$this->sqlstring($txtResult)."',";
								$sql.="'$userid',";
								$sql.="'$session',";
								$sql.="'$DirectManagerID'";
								$sql.=")".PHP_EOL ;
								$sql.="---	Thuc thi store luu du lieu ".PHP_EOL;
								$sql.="EXEC  W75P4072 '$division', $mode, '$userid', '$session' ";

                                //\Debugbar::info($sql);
								//$this->connectionHR->statement($sql);

								$this->connectionHR->getPdo()->beginTransaction();
								$this->connectionHR->getPdo()->exec($sql);
								$this->connectionHR->getPdo()->commit();

								$sql = "--Do nguon luoi dang ky tang ca".PHP_EOL;
								$sql .= "Exec W75P4071 '$division', $tranmonth, $tranyear, '$userid', '$lang', 1, '$hr_employee_id', 0, '$transid'";
								$shiftList = $this->connectionHR->selectOne($sql);


								//\Debugbar::info($result);
                                if($shiftList['IsSentMail']==1)
                                {
                                    if($shiftList['IsShowMailScreen']==0)
                                    {
                                        $this->SendMailAuto($shiftList['EmailContent'],$shiftList);
                                    }
                                }
								return array('status'=>1,'message'=> '','rowData'=>$shiftList);
							} catch (Exception $ex) {
								//\Debugbar::info($ex);
								$this->connectionHR->getPdo()->rollBack();
								return array('status'=>2,'message'=> $ex->getMessage(),'rowData'=>'');
							}

						}
					}


					break;

				case "delete":
					$session = Session::getId();
					$transid = $all["transid"];
					$attdate =Helpers::convertDate(Helpers::decode_string($all['attendanceDate']));
					$sql = "Exec W75P5555 '$division', '$lang', '$userid', '$session', 2, 'D75F4071', '$hr_employee_id','$transid','','','','','',0,0,0,0,0,$attdate, null,null";

					$result = $this->connectionHR->select($sql);

					if (count($result)>0){
						if ($result[0]['Status'] == 1){
							return array('status'=>0,'message'=> $result[0]['Message']);
						}else{
							try {

								$sql = "--Xoa du lieu".PHP_EOL;
								$sql.="DELETE FROM D75T4070 where TransID = '$transid'";
								//\Debugbar::info($sql);
								$aaa = $this->connectionHR->statement($sql);
								//\Debugbar::info($aaa);
								return array('status'=>1);
							} catch (Exception $e) {
								return array('status'=>2,'message'=>$e->getMessage());
							}
						}
					}

					break;
				default:
					//Do nothing here
			}

		}

		public function viewFromMail($pForm,$g,$isApproval=0,$id='',$iddt='') {
			$all = Input::all();
			$division = Session::get("W91P0000")['HRDivisionID'];
			$hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
			$lang = Session::get('Lang');
			$userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
			$tranmonth = Session::get("W91P0000")['HRTranMonth'];
			$tranyear = Session::get("W91P0000")['HRTranYear'];
			/*$sql = "--Lay danh sach ngay".PHP_EOL;
					$sql .= "Exec D75P4073 '$division', $tranmonth, $tranyear, '$userid', '$lang', 1, '$hr_employee_id', 0";
					$dateList =$this->connectionHR->select($sql);*/
			$task = '';
			$sql = "--Do nguon luoi dang ky tang ca".PHP_EOL;
			$sql .= "Exec W75P4071 '$division', $tranmonth, $tranyear, '$userid', '$lang', 1, '$hr_employee_id', 0";
			$shiftList = $this->connectionHR->select($sql);
			$modalTitle= $this->getModalTitleG4($pForm);

            $sql = "--Lay thong thiet lap an hien tach ca" . PHP_EOL;
            $sql .= "set nocount on " . PHP_EOL;
            $sql .= "select NumValue from D29T0003 where ProcessTypeID = 'PriorityLeave' AND TransTypeID = 'ConfirmOT'" . PHP_EOL;
            $rsTemp = $this->connectionHR->selectOne($sql);
            $numValue = $rsTemp["NumValue"];
            \Debugbar::info($numValue);
			return View::make("W7X.W75.W75F4071", compact("numValue",'pForm', 'g','modalTitle','task','shiftList'));
		}
	}
