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
	use Helpers;
	use Config;
	use Mail;
	
	class W75F4081Controller extends W7XController {
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
            $daysInMonth = Helpers::getDaysInAnyMonth($tranmonth, $tranyear);
            $hostID = Session::getId();
			switch($task){
				case '':
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

					$sql = "--Do nguon luoi di tre ve som".PHP_EOL;
					$sql .= "Exec W75P4081 '$division', $tranmonth, $tranyear, '$userid', '$lang', '$hr_employee_id', 0, 0, null";
					$shiftList = $this->connectionHR->select($sql);
					\Debugbar::info($shiftList);
                    $sql = "--Do nguon so phut di tre".PHP_EOL;
                    $sql .= " SET NOCOUNT ON SELECT CONVERT(int,t1.[Values]) AS LateMinute".PHP_EOL;
                    $sql .= " FROM D29T1091 AS T1 WITH (NOLOCK)".PHP_EOL;
                    $sql .= " WHERE T1.[Type] = 'Division' AND T1.Maxvalues <> 0 AND T1.TimeCode = 1".PHP_EOL;
                    $sql .= " GROUP BY t1.[Values]".PHP_EOL;
                    $sql .= " ORDER BY t1.[Values]".PHP_EOL;
                    $cbAfter = $this->connectionHR->select($sql);
                    $isShowLate = count($cbAfter) > 0;
                    //$isShowLate = false;
					\Debugbar::info($cbAfter);
                    $sql = "--Do nguon so phut ve som".PHP_EOL;
                    $sql .= " SET NOCOUNT ON SELECT CONVERT(int,t1.[Values]) AS EarlyMinute".PHP_EOL;
                    $sql .= " FROM D29T1091 AS T1 WITH (NOLOCK)".PHP_EOL;
                    $sql .= " WHERE T1.[Type] = 'Division' AND T1.Maxvalues <> 0 AND T1.TimeCode = 2".PHP_EOL;
                    $sql .= " GROUP BY t1.[Values]".PHP_EOL;
                    $sql .= " ORDER BY t1.[Values]".PHP_EOL;
                    $cbEarly = $this->connectionHR->select($sql);
                    $isShowEarly = count($cbEarly) > 0;
                    //$isShowEarly = false;
					return View::make("W7X.W75.W75F4081", compact('tranmonth','AttPeriodFrom', 'AttPeriodTo', 'monthPeriod','isShowLate','isShowEarly','pForm', 'g','modalTitle','task','shiftList','cbAfter','cbEarly'));
					break;
				/*case 'settext':
					$wokingDate = Helpers::convertDate(Helpers::decode_string(Input::get('wokingDate')));
					$sql = "--Lay danh sach ngay".PHP_EOL;
					$sql .= "Exec W75P4083 '$division', '$userid', '$lang', '$hr_employee_id', $wokingDate, 0";
					\Debugbar::info($sql);
					$dateList =$this->connectionHR->select($sql);
					return $dateList;
					break;*/

                case 'settext':
                    \Debugbar::info(Input::all());
                    $AttendanceDate = Helpers::convertDate(Helpers::decode_string(Input::get('wokingDate')));
                    $sqlLoad ="-- load du lieu cho master gan các gia tri khi chon ngay lam viec".PHP_EOL;
                    $sqlLoad .= "EXEC W75P4083" .PHP_EOL;
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
                    \Debugbar::info($rsMaster);
                    return json_encode(array('status' => 'SUCCESS', 'data' => $rsMaster));
                    break;

				case "save":
					$times = $all['times'] + 1;
					$wday =Helpers::convertDate(Helpers::decode_string($all['wday']));
					$shiftID = Helpers::decode_string($all['shiftID']);
					$session = Session::getId();
					$lateMin= Helpers::sqlNumber( $all['lateMin']);
					$lateTimeIn=str_replace(":","",Helpers::decode_string($all['lateTimeIn']));
					$earlyMin= Helpers::sqlNumber( $all['earlyMin']);
					$earlyTimeout=str_replace(":","",Helpers::decode_string($all['earlyTimeout']));
					$reason=urldecode($all['reason']);
					$isApprovedLate= $all['isApprovedLate'] == 'true'  ? 1 : 0;
					$isApprovedEarly= $all['isApprovedEarly'] == 'true' ? 1 : 0;
					//\Debugbar::info($isApprovedLate);

					$rData=$this->connectionHR->selectOne("EXEC W75P1005 '".Session::get("W91P0000")['HRDivisionID']."', ".Session::get("W91P0000")['HRTranMonth'] . ",". Session::get("W91P0000")['HRTranYear'] .",'".$userid."', 'D75F1005', '". $hr_employee_id ."'");
					$DirectManagerID = $rData['DirectManagerID'];

					$sql = "--Kiem tra truoc khi luu".PHP_EOL;
					$sql .= "Exec W75P5555 '$division', '$lang', '$userid', '$session', 0, 'D75F4081', '$hr_employee_id','$shiftID','$lateMin','$lateTimeIn','$earlyMin','$earlyTimeout','',0,0,0,0,0,$wday, null,null";

					$result = $this->connectionHR->select($sql);
					if (count($result)>0){
						if ($result[0]['Status'] == 1){
							return array('status'=>0,'message'=> $result[0]['Message'],'rowData'=>'');
						}else{
							try {
								$sql = "--Tao bang tam chua du lieu luu" .PHP_EOL;
								$sql.="CREATE TABLE #W75P4081 (";
								$sql.="Times 		INT ,";
								$sql.="EmployeeID		VARCHAR(20),";
								$sql.="AttendanceDate	DATETIME,";
								$sql.="ShiftID		Varchar (20),";
								$sql.="LateMinute		Int,";
								$sql.="LateTimeIn		Varchar(6),";
								$sql.="IsApprovedLate   Tinyint,";
								$sql.="EarlyMinute	Int ,";
								$sql.="EarlyTimeOut	Varchar(6),";
								$sql.="IsApprovedEarly Tinyint,";
								$sql.="CreateUserID	Varchar(50),";
								$sql.="LastModifyUserID Varchar(50),";
								$sql.="LastModifyDate	Datetime,";
								$sql.="CreateDate		Datetime,";
								$sql.="ReasonU 		Nvarchar(1000),";
								$sql.="UserID		Varchar(20),";
								$sql.="HostID		Varchar(max),";
								$sql.="DirectManagerID 	Varchar(50)";
								$sql.=")".PHP_EOL;


								$sql.="--Insert dang ky ditre/vesom".PHP_EOL;
								$sql.="set nocount on".PHP_EOL;
								$sql.="INSERT INTO #W75P4081(";
								$sql.="Times,";
								$sql.="EmployeeID,";
								$sql.="AttendanceDate,";
								$sql.="ShiftID,";
								$sql.="LateMinute,";
								$sql.="LateTimeIn,";
								$sql.="IsApprovedLate,";
								$sql.="EarlyMinute,";
								$sql.="EarlyTimeOut,";
								$sql.="IsApprovedEarly,";
								$sql.="CreateUserID,";
								$sql.="LastModifyUserID,";
								$sql.="LastModifyDate,";
								$sql.="CreateDate,";
								$sql.="ReasonU,";
								$sql.="UserID,";
								$sql.="HostID,";
								$sql.="DirectManagerID";
								$sql.=")VALUES(";
								$sql.="$times,";
								$sql.="'$hr_employee_id',";
								$sql.="$wday,";
								$sql.="'$shiftID',";
								$sql.="$lateMin,";
								$sql.="'$lateTimeIn',";
								$sql.="$isApprovedLate,";
								$sql.="$earlyMin,";
								$sql.="'$earlyTimeout',";
								$sql.="$isApprovedEarly,";
								$sql.="'$userid',";
								$sql.="'$userid',";
								$sql.="GetDate(),";
								$sql.="GetDate(),";
								$sql.="N'".$this->sqlstring($reason)."',";
								$sql.="'$userid',";
								$sql.="'$session',";
								$sql.="'$DirectManagerID'";
								$sql.=")".PHP_EOL ;
								$sql.="---	Thuc thi store luu du lieu ".PHP_EOL;
								$sql.="EXEC  W75P4082  '$division', 0, '$userid', '$session' ";


								//\Debugbar::info($sql);
								//$this->connectionHR->statement($sql);

								$this->connectionHR->getPdo()->beginTransaction();
								$this->connectionHR->getPdo()->exec($sql);
								$this->connectionHR->getPdo()->commit();

								$sql = "--Lay dong vua luu".PHP_EOL;
								$sql .= "Exec W75P4081 '$division', $tranmonth, $tranyear, '$userid', '$lang', '$hr_employee_id', 0, $times, $wday";
								$shiftList = $this->connectionHR->selectOne($sql);
                                if(intval($shiftList['IsSentMail'])== 1)
                                {
                                    if(intval($shiftList['IsShowMailScreen'])== 0)
                                    {
                                        $this->SendMailAuto($shiftList['EmailContent'],$shiftList);
                                    }
                                }
								return array('status'=>1,'message'=> '','rowData'=>$shiftList);
							} catch (Exception $ex) {
								//$this->connectionHR->getPdo()->rollBack();
								return array('status'=>2,'message'=> $ex->getMessage(),'rowData'=>'');
							}

						}
					}
					break;

				case "update":
					$times = $all['times'];
					$wday =Helpers::convertDate(Helpers::decode_string($all['wday']));
					$shiftID = Helpers::decode_string($all['shiftID']);
					$session = Session::getId();
					$lateMin= Helpers::sqlNumber($all['lateMin']);
					$lateTimeIn=str_replace(":","",Helpers::decode_string($all['lateTimeIn']));
					$earlyMin= Helpers::sqlNumber($all['earlyMin']);
					$earlyTimeout=str_replace(":","",Helpers::decode_string($all['earlyTimeout']));
					$reason=urldecode($all['reason']);
					$isApprovedLate= $all['isApprovedLate'] == 'true'  ? 1 : 0;
					$isApprovedEarly= $all['isApprovedEarly'] == 'true' ? 1 : 0;


					$rData=$this->connectionHR->selectOne("EXEC W75P1005 '".Session::get("W91P0000")['HRDivisionID']."', ".Session::get("W91P0000")['HRTranMonth'] . ",". Session::get("W91P0000")['HRTranYear'] .",'".$userid."', 'D75F1005', '". $hr_employee_id ."'");
					$DirectManagerID = $rData['DirectManagerID'];

					$sql = "--Kiem tra truoc khi luu".PHP_EOL;
					$sql .= "Exec W75P5555 '$division', '$lang', '$userid', '$session', 1, 'D75F4081', '$hr_employee_id','$shiftID','$lateMin','$lateTimeIn','$earlyMin','$earlyTimeout','',$times,0,0,0,0,$wday, null,null";

					$result = $this->connectionHR->select($sql);
					if (count($result)>0){
						if ($result[0]['Status'] == 1){
							return array('status'=>0,'message'=> $result[0]['Message'],'rowData'=>'');
						}else{
							try {
								$sql = "--Tao bang tam chua du lieu luu" .PHP_EOL;
								$sql.="CREATE TABLE #W75P4081 (".PHP_EOL;
								$sql.="Times 		INT ,";
								$sql.="EmployeeID		VARCHAR(20),";
								$sql.="AttendanceDate	DATETIME,";
								$sql.="ShiftID		Varchar (20),";
								$sql.="LateMinute		Int,".PHP_EOL;
								$sql.="LateTimeIn		Varchar(6),";
								$sql.="IsApprovedLate   Tinyint,";
								$sql.="EarlyMinute	Int ,";
								$sql.="EarlyTimeOut	Varchar(6),";
								$sql.="IsApprovedEarly Tinyint,".PHP_EOL;
								$sql.="CreateUserID	Varchar(50),";
								$sql.="LastModifyUserID Varchar(50),";
								$sql.="LastModifyDate	Datetime,";
								$sql.="CreateDate		Datetime,";
								$sql.="ReasonU 		Nvarchar(1000),".PHP_EOL;
								$sql.="UserID		Varchar(20),";
								$sql.="HostID		Varchar(max),";
								$sql.="DirectManagerID 	Varchar(50)".PHP_EOL;
								$sql.=")".PHP_EOL;


								$sql.="--Insert dang ky ditre/vesom".PHP_EOL;
								$sql.="set nocount on".PHP_EOL;
								$sql.="INSERT INTO #W75P4081(".PHP_EOL;
								$sql.="Times,";
								$sql.="EmployeeID,";
								$sql.="AttendanceDate,";
								$sql.="ShiftID,";
								$sql.="LateMinute,".PHP_EOL;
								$sql.="LateTimeIn,";
								$sql.="IsApprovedLate,";
								$sql.="EarlyMinute,";
								$sql.="EarlyTimeOut,";
								$sql.="IsApprovedEarly,".PHP_EOL;
								$sql.="CreateUserID,";
								$sql.="LastModifyUserID,";
								$sql.="LastModifyDate,";
								$sql.="CreateDate,";
								$sql.="ReasonU,".PHP_EOL;
								$sql.="UserID,";
								$sql.="HostID,";
								$sql.="DirectManagerID".PHP_EOL;
								$sql.=")VALUES(".PHP_EOL;
								$sql.="$times,";
								$sql.="'$hr_employee_id',";
								$sql.="$wday,";
								$sql.="'$shiftID',";
								$sql.="$lateMin,".PHP_EOL;
								$sql.="'$lateTimeIn',";
								$sql.="$isApprovedLate,";
								$sql.="$earlyMin,";
								$sql.="'$earlyTimeout',";
								$sql.="$isApprovedEarly,".PHP_EOL;
								$sql.="'$userid',";
								$sql.="'$userid',";
								$sql.="GetDate(),";
								$sql.="GetDate(),";
								$sql.="N'".$this->sqlstring($reason)."',".PHP_EOL;
								$sql.="'$userid',";
								$sql.="'$session',";
								$sql.="'$DirectManagerID'".PHP_EOL;
								$sql.=")".PHP_EOL ;
								$sql.="---	Thuc thi store luu du lieu ".PHP_EOL;
								$sql.="EXEC  W75P4082  '$division', 1, '$userid', '$session' ";


								\Debugbar::info($sql);
								//$this->connectionHR->statement($sql);

								$this->connectionHR->getPdo()->beginTransaction();
								$this->connectionHR->getPdo()->exec($sql);
								$this->connectionHR->getPdo()->commit();

								$sql = "--Lay dong vua luu".PHP_EOL;
								$sql .= "Exec W75P4081 '$division', $tranmonth, $tranyear, '$userid', '$lang', '$hr_employee_id', 0, $times, $wday";
								$shiftList = $this->connectionHR->selectOne($sql);

								\Debugbar::info($result);
                                if(intval($shiftList['IsSentMail'])==1)
                                {
                                    if(intval($shiftList['IsShowMailScreen'])==0)
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

					break;

				case "delete":
					$times = $all['times'];
					$wday =Helpers::convertDate(Helpers::decode_string($all['wday']));
					$shiftID = $all['shiftID'];
					$session = Session::getId();

					$sql = "--Kiem tra truoc khi xoa".PHP_EOL;
					$sql .= "Exec W75P5555 '$division', '$lang', '$userid', '$session', 2, 'D75F4081', '$hr_employee_id','$shiftID','','','','','',0,0,0,0,0,$wday, null,null";

					$result = $this->connectionHR->select($sql);
					if (count($result)>0){
						if ($result[0]['Status'] == 1){
							return array('status'=>0,'message'=> $result[0]['Message']);
						}else{
							try {
								$sql = "DELETE FROM D75T4071 ";
								$sql.="WHERE EmployeeID = '$hr_employee_id' and AttendanceDate  = $wday and Times=$times";
								\Debugbar::info($sql);
								$this->connectionHR->statement($sql);
								return 1;
							} catch (Exception $e) {
								return 0;
							}
							break;
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
			$sql = "--Do nguon luoi di tre ve som".PHP_EOL;
			$sql .= "Exec W75P4081 '$division', $tranmonth, $tranyear, '$userid', '$lang', '$hr_employee_id', 0, 0, null";
			$shiftList = $this->connectionHR->select($sql);
			$task = '';
			$modalTitle= $this->getModalTitleG4($pForm);

			$sql = "--Do nguon so phut di tre".PHP_EOL;
			$sql .= " SET NOCOUNT ON SELECT CONVERT(int,t1.[Values]) AS LateMinute".PHP_EOL;
			$sql .= " FROM D29T1091 AS T1 WITH (NOLOCK)".PHP_EOL;
			$sql .= " WHERE T1.[Type] = 'Division' AND T1.Maxvalues <> 0 AND T1.TimeCode = 1".PHP_EOL;
			$sql .= " GROUP BY t1.[Values]".PHP_EOL;
			$sql .= " ORDER BY t1.[Values]".PHP_EOL;
			$cbAfter = $this->connectionHR->select($sql);
			\Debugbar::info($cbAfter);
			$sql = "--Do nguon so phut ve som".PHP_EOL;
			$sql .= " SET NOCOUNT ON SELECT CONVERT(int,t1.[Values]) AS EarlyMinute".PHP_EOL;
			$sql .= " FROM D29T1091 AS T1 WITH (NOLOCK)".PHP_EOL;
			$sql .= " WHERE T1.[Type] = 'Division' AND T1.Maxvalues <> 0 AND T1.TimeCode = 2".PHP_EOL;
			$sql .= " GROUP BY t1.[Values]".PHP_EOL;
			$sql .= " ORDER BY t1.[Values]".PHP_EOL;
			$cbEarly = $this->connectionHR->select($sql);

			return View::make("W7X.W75.W75F4081", compact('pForm', 'g','modalTitle','task','shiftList','cbAfter','cbEarly'));
		}
	}
