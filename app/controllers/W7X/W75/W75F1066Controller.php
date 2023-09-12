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
	
	class W75F1066Controller extends W7XController {
		//Khi open tab s? g?i controller này

		public function index($pForm, $g, $task='')
		{
			$division = Session::get("W91P0000")['HRDivisionID'];
			$hr_employee_id = (Auth::user()->check()) ? Auth::user()->user()->HREmployeeID :  Auth::ess()->user()->HREmployeeID;
			$lang = Session::get('Lang');
			$userid = (Auth::user()->check()) ? Auth::user()->user()->UserID :  Auth::ess()->user()->UserID;
			$tranmonth = Session::get("W91P0000")['HRTranMonth'];
			$tranyear = Session::get("W91P0000")['HRTranYear'];
            $valueGrid = [];
            $session = Session::getId();
			\Debugbar::info($task);
            //$isHideConfirmOT = false;
            $LinkTransID = "";
            $TransID = "";
			switch($task){
				case '':
                    \Debugbar::info(Input::all());
                    $action = Input::get('action');
                    $LinkTransID = Input::get('LinkTransIDW75F1065');
                    $TransID = Input::get('TransID1065to1066');

                    $sql1 = "--do nguon master" .PHP_EOL;
                    $sql1 .= "EXEC W75P1066 '$division', '$userid', '$session','$LinkTransID', '$TransID', 0" .PHP_EOL;

                    $rsMaster = $this->connectionHR->select($sql1);
                    \Debugbar::info($rsMaster);

                    $sql2 = "--do nguon grid" .PHP_EOL;
                    $sql2 .= "EXEC W75P1066 '$division', '$userid', '$session','$LinkTransID', '$TransID', 1" .PHP_EOL;

                    $valueGrid = $this->connectionHR->select($sql2);
                    for($i = 0; $i < count($valueGrid); $i++){
                        $valueGrid[$i]['PlanCost'] = str_replace(',', '', number_format($valueGrid[$i]['PlanCost'], 2));
                        $valueGrid[$i]['Cost'] = str_replace(',', '', number_format($valueGrid[$i]['Cost'], 2));
                        //\Debugbar::info(intval(str_replace(',', '', $valueGrid[$i]['PlanCost'])));
                    }
                    \Debugbar::info($valueGrid);

                    $sql = "-- Dropdown loai chi phi" .PHP_EOL;
                    $sql .= "SELECT RecCostID, RecCostName" .PHP_EOL;
                    $sql .= "FROM D15T1070" .PHP_EOL;
                    $sql .= "ORDER BY RecCostID" .PHP_EOL;

                    $RecCostArray = $this->connectionHR->select($sql);
                    \Debugbar::info($RecCostArray);
					return View::make("W7X.W75.W75F1066", compact('pForm', 'g', "valueGrid", "RecCostArray", "action", "rsMaster", "LinkTransID", "TransID"));
					break;


                case "save":
                    \Debugbar::info(Input::all());
                    $action = Input::get('action');
                    $txtContentW75F1066 = $this->sqlstring(Input::get('txtContentW75F1066'));
                    $txtBusinessLocationW75F1066 = $this->sqlstring(Input::get('txtBusinessLocationW75F1066'));
                    $dataGrid = json_decode(Input::get('dataGrid','[]'));
                    $sql = "";
                    $TransID = $this->sqlstring(Input::get('TransIDW75F1066'));
                    $LinkTransID = $this->sqlstring(Input::get('LinkTransIDW75F1066'));
                    if($TransID != ""){
                        $sql = "DELETE FROM D15T2050 WHERE TransID = '$TransID'".PHP_EOL;
                        $this->connectionHR->statement($sql);
                        $sql = "DELETE FROM D15T2051 WHERE TransID = '$TransID'".PHP_EOL;
                        $this->connectionHR->statement($sql);
                    }
                    $TransID = $this->CreateIGE($g, "D15T2050", "75", "DK");
                    if($action == "viewApproved"){
                        $sql = "UPDATE T".PHP_EOL;
                        $sql .= "SET T.LinkTransID = '$TransID'".PHP_EOL;
                        $sql .= "FROM D15T2030 T".PHP_EOL;
                        $sql .= "WHERE T.TransID = '$LinkTransID'".PHP_EOL;
                        $this->connectionHR->statement($sql);
                    }
                    $sql = "--luu nghiep vu master" .PHP_EOL;
                    $sql .= "INSERT INTO D15T2050(TransID, BusinessLocation, Content, CreateDate, CreateUserID, LastModifyDate, LastModifyUserID)" .PHP_EOL;
                    $sql .= "VALUES ('$TransID', N'$txtBusinessLocationW75F1066', N'$txtContentW75F1066', GetDate(),'$userid' ,GetDate(),'$userid')" .PHP_EOL;

                    for($i = 0; $i < count($dataGrid); $i++){
                        $RecCostID = $this->sqlstring($dataGrid[$i]->RecCostID);
                        $RecCostName = $this->sqlstring($dataGrid[$i]->RecCostName);
                        $PlanCost = Helpers::sqlNumber($dataGrid[$i]->PlanCost);
                        $Cost = Helpers::sqlNumber($dataGrid[$i]->Cost);
                        $sql .= "--luu nghiep vu grid" .PHP_EOL;
                        $sql .= "INSERT INTO D15T2051(TransID, RecCostID, PlanCost, Cost, CreateDate, CreateUserID, LastModifyDate, LastModifyUserID)" .PHP_EOL;
                        $sql .= "VALUES ('$TransID', '$RecCostID', $PlanCost, $Cost, GetDate(),'$userid' ,GetDate(),'$userid')" .PHP_EOL;
                    }
                    if ($sql != "") {
                        try {
                            \Debugbar::info($sql);
                            $this->connectionHR->statement($sql);
                            return json_encode(['status' => 'SUCCESS', 'name' =>'', "TransID" => $TransID]);
                        } catch (Exception $ex) {
                            return json_encode(['status' => 'ERROR', 'name' =>'',"message"=> Helpers::getRS($g,"Co_loi_xay_ra_trong_qua_trinh_xu_ly_du_lieu")]);
                        }
                    }
                    break;
				default:
					//Do nothing here
                    break;
			}

		}


	}

/*if($action == "add"){
                    $TransID = $this->CreateIGE($g, "D15T2050", "75", "DK");
                    $sql = "--luu nghiep vu master" .PHP_EOL;
                    $sql .= "INSERT INTO D15T2050(TransID, BusinessLocation, Content, CreateDate, CreateUserID, LastModifyDate, LastModifyUserID)" .PHP_EOL;
                    $sql .= "VALUES ('$TransID', N'$txtBusinessLocationW75F1066', N'$txtContentW75F1066', GetDate(),'$userid' ,GetDate(),'$userid')" .PHP_EOL;

                    for($i = 0; $i < count($dataGrid); $i++){
                        $IG = $this->CreateIGE($g, "D15T2051", "75", "CP");
                        $RecCostID = $this->sqlstring($dataGrid[$i]->RecCostID);
                        $RecCostName = $this->sqlstring($dataGrid[$i]->RecCostName);
                        $PlanCost = Helpers::sqlNumber($dataGrid[$i]->PlanCost);
                        $Cost = Helpers::sqlNumber($dataGrid[$i]->Cost);
                        $sql .= "--luu nghiep vu grid" .PHP_EOL;
                        $sql .= "INSERT INTO D15T2051(TransID, RecCostID, PlanCost, Cost, CreateDate, CreateUserID, LastModifyDate, LastModifyUserID, IG)" .PHP_EOL;
                        $sql .= "VALUES ('$TransID', '$RecCostID', $PlanCost, $Cost, GetDate(),'$userid' ,GetDate(),'$userid', '$IG')" .PHP_EOL;
                    }
                }
                if($action == "edit" || $action == "viewApproved" ){
                    $TransID = $this->sqlstring(Input::get('TransIDW75F1066'));
                    //$IG = $this->sqlstring(Input::get('LinkTransIDW75F1066'));
                    $sql = "--update nghiep vu master" .PHP_EOL;
                    $sql .= " UPDATE D15T2050 " . PHP_EOL;
                    $sql .= " SET  BusinessLocation = N'$txtBusinessLocationW75F1066',
                            Content = N'$txtContentW75F1066',
                            LastModifyDate = Getdate(),
                            LastModifyUserID ='$userid'" .PHP_EOL;
                    $sql .= " WHERE TransID = '$TransID'" . PHP_EOL;

                    for($i = 0; $i < count($dataGrid); $i++){
                        $IG = $this->sqlstring($dataGrid[$i]->IG);
                        $RecCostID = $this->sqlstring($dataGrid[$i]->RecCostID);
                        $RecCostName = $this->sqlstring($dataGrid[$i]->RecCostName);
                        $PlanCost = Helpers::sqlNumber($dataGrid[$i]->PlanCost);
                        $Cost = Helpers::sqlNumber($dataGrid[$i]->Cost);
                        $sql .= "--update nghiep vu master" .PHP_EOL;
                        $sql .= " UPDATE D15T2051 " . PHP_EOL;
                        $sql .= " SET  RecCostID = '$RecCostID',
                            PlanCost = $PlanCost,
                            Cost = $Cost,
                            LastModifyDate = Getdate(),
                            LastModifyUserID ='$userid'" .PHP_EOL;
                        $sql .= " WHERE IG = '$IG'" . PHP_EOL;
                    }
                }*/