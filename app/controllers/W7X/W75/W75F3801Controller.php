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
	
	class W75F3801Controller extends W7XController {
		//Khi open tab s? g?i controller này
		public function index($pForm, $g)
		{
			//Debugbar::info(Session::get("W91P0000"));
			$lang = Session::get("locate");
			$modalTitle = $this->getModalTitleG4($pForm);
			return View::make("W7X.W75.W75F3801", compact('pForm', 'g','modalTitle','lang'));
		}

		public function loadTDBC($pForm, $g, $name)
		{
			$divisionhr = Session::get("W91P0000")['HRDivisionID'];
			$hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
			$userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
			$isDate = Input::get('isDate') == "true"? 1:0;
			$dateFrom = Input::get('dateFrom');
			$dateTo = Input::get('dateTo');
			$lang = Session::get("locate");
			switch($name){
				case "left":
					$sql = "-- Do nguon luoi trai " . PHP_EOL;
					$sql .= " EXEC W75P3801 '$divisionhr', '$hr_employee_id', '$userid',  '$pForm', 0, '',$isDate,";
					if ($dateFrom == "")
						$sql .= DB::raw('null').",";
					else
						$sql .= "'".date("m/d/Y", strtotime(str_replace("/", "-", $dateFrom)))."',";
					if ($dateTo == "")
						$sql .= DB::raw('null').",";
					else
						$sql .= "'".date("m/d/Y", strtotime(str_replace("/", "-", $dateTo)))."',";
					$sql .= "'','',''";
					$dsCourse = $this->connectionHR->select($sql);
					\Debugbar::info($dsCourse);
					return View::make("W7X.W75.W75F3801_Course", compact('pForm', 'g', 'dsCourse'));
					break;
				case 'reloadleft':
					$sql = "-- Do nguon luoi trai " . PHP_EOL;
					$sql .= " EXEC W75P3801 '$divisionhr', '$hr_employee_id', '$userid',  '$pForm', 0, '',$isDate,";
					if ($dateFrom == "")
						$sql .= DB::raw('null').",";
					else
						$sql .= "'".date("m/d/Y", strtotime(str_replace("/", "-", $dateFrom)))."',";
					if ($dateTo == "")
						$sql .= DB::raw('null').",";
					else
						$sql .= "'".date("m/d/Y", strtotime(str_replace("/", "-", $dateTo)))."',";
					$sql .= "'','',''";
					$dsCourse = $this->connectionHR->select($sql);
					//Debugbar::info($dsCourse);
					return ($dsCourse);
					break;
				case "right":
					$voucherID = Input::get('voucherID');
					$planTransID = Input::get('planTransID');
					$transID = Input::get('transID');
					$trainingCourseID = Input::get('trainingCourseID');
					$sql = "-- Do nguon luoi phai " . PHP_EOL;
					$sql .= " EXEC W75P3801 '$divisionhr', '$hr_employee_id', '$userid',  '$pForm', 1, '$trainingCourseID',$isDate,";
					if ($dateFrom == "")
						$sql .= DB::raw('null').",";
					else
						$sql .= "'".date("m/d/Y", strtotime(str_replace("/", "-", $dateFrom)))."',";
					if ($dateTo == "")
						$sql .= DB::raw('null').",";
					else
						$sql .= "'".date("m/d/Y", strtotime(str_replace("/", "-", $dateTo)))."',";
					$sql .= "'$voucherID','$planTransID','$transID'";
					$dsPurpose = $this->connectionHR->select($sql);
					return View::make("W7X.W75.W75F3801_Purpose", compact('pForm', 'g', 'dsPurpose','lang'));
					break;
				case "reloadright":
					$voucherID = Input::get('voucherID');
					$planTransID = Input::get('planTransID');
					$transID = Input::get('transID');
					$trainingCourseID = Input::get('trainingCourseID');
					$sql = "-- Do nguon luoi phai " . PHP_EOL;
					$sql .= " EXEC W75P3801 '$divisionhr', '$hr_employee_id', '$userid',  '$pForm', 1, '$trainingCourseID',$isDate,";
					if ($dateFrom == "")
						$sql .= DB::raw('null').",";
					else
						$sql .= "'".date("m/d/Y", strtotime(str_replace("/", "-", $dateFrom)))."',";
					if ($dateTo == "")
						$sql .= DB::raw('null').",";
					else
						$sql .= "'".date("m/d/Y", strtotime(str_replace("/", "-", $dateTo)))."',";
					$sql .= "'$voucherID','$planTransID','$transID'";
					$dsPurpose = $this->connectionHR->select($sql);
					return json_encode($dsPurpose);
					break;
			}

		}

		public function saveData($pForm, $g)
		{
			$obj = Input::get('obj');
			$VoucherID = Input::get('voucherID');
			$TransID = Input::get('transID');
			$PlanTransID = Input::get('planTransID');
			$TrainingCourseID = Input::get('trainingCourseID');
			$hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;

			$sql = "--Xoa truoc khi luu".PHP_EOL;
			$sql .= " DELETE  FROM  D38T2044 ";
 			$sql .= " WHERE TrainingCourseID='$TrainingCourseID'";
			$sql .= " AND 	EmployeeID='$hr_employee_id'";
			$sql .= " AND 	VoucherID ='$VoucherID'";
			$sql .= " AND 	PlanTransID ='$PlanTransID'";
			$sql .= " AND	TransID ='$TransID'".PHP_EOL;

			$sql .= "--Cap nhat muc tieu hanh dong".PHP_EOL;
			if (count($obj)>0){
				Debugbar::info($obj);
				$i = 0;
				foreach ($obj as  $row) {
					$i = $i + 1;
					$ActTarget = $this->sqlstring(str_replace("<br>", "",$row["ActTarget"]));
					$CompletedDate = date("m/d/Y", strtotime(str_replace("/", "-", $row["CompletedDate"])));
					$Notes = isset($row["Notes"]) ? $this->sqlstring(str_replace("<br>", "",$row["Notes"])): "";
					$sql .= " INSERT INTO D38T2044";
					$sql .= " (";
						$sql .= " OrderNo,";
						$sql .= " TransID,";
						$sql .= " PlanTransID,";
						$sql .= " VoucherID,";
						$sql .= " TrainingCourseID,";
						$sql .= " EmployeeID  ,";
						$sql .= " ActTarget,";
						$sql .= " ActTargetU,";
						$sql .= " Notes,";
						$sql .= " NotesU,";
						$sql .= " CompletedDate";
					$sql .= " )";
					$sql .= " VALUES";
					$sql .= " (";
						$sql .= " $i,";
						$sql .= " '$TransID',";
						$sql .= " '$PlanTransID',";
						$sql .= " '$VoucherID',";
						$sql .= " '$TrainingCourseID',";
						$sql .= " '$hr_employee_id'  ,";
						$sql .= " '$ActTarget',";
						$sql .= " N'$ActTarget',";
						$sql .= " '$Notes',";
						$sql .= " N'$Notes',";
						$sql .= " '$CompletedDate'";
					$sql .= " )".PHP_EOL;
				}

			}
			$result = $this->connectionHR->statement($sql);
			/*try {
                $this->connection->getPdo()->beginTransaction();
                Debugbar::info($sql);
                $this->connection->getPdo()->exec($sql);
                $this->connection->getPdo()->commit();
                $result = true;
            }catch (\Exception $e) {
                Debugbar::info($e->getMessage());
                $this->connection->getPdo()->rollBack();
                $result = false;
            }*/
			return json_encode(['bSaveOK' => $result]);
		}

		function deleteData($pForm, $g){
			$VoucherID = Input::get('voucherID');
			$TransID = Input::get('transID');
			$PlanTransID = Input::get('planTransID');
			$TrainingCourseID = Input::get('trainingCourseID');
			$hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
			$sql = "--Xoa truoc khi luu".PHP_EOL;
			$sql .= " DELETE  FROM  D38T2044 ";
			$sql .= " WHERE TrainingCourseID='$TrainingCourseID'";
			$sql .= " AND 	EmployeeID='$hr_employee_id'";
			$sql .= " AND 	VoucherID ='$VoucherID'";
			$sql .= " AND 	PlanTransID ='$PlanTransID'";
			$sql .= " AND	TransID ='$TransID'".PHP_EOL;
			$result = $this->connectionHR->statement($sql);
			return json_encode(['bSaveOK' => $result]);
		}


	}
