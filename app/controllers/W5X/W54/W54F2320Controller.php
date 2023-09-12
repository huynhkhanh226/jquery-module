<?php

namespace W5X\W54;

use Auth;
use Config;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use Exception;
use Helpers;
use Input;
use Request;
use Session;
use View;
use W5X\W5XController;

class W54F2320Controller extends W5XController
{

    public function index($pForm, $g)
    {
        $userid = Auth::user()->user()->UserID;
        $lang = Session::get('Lang');

		$sql = "--Load Divisions" . PHP_EOL;
		$sql .= "EXEC W54P4701 '','$userid','$lang','Division', 'W54F2320'";
		\Debugbar::info($sql);
		$divisions = $this->connection->select($sql);

		$division = Session::get("W91P0000")['DivisionID'];
		$sql = "--Load Project" . PHP_EOL;
		$sql .= "EXEC W54P4701 '$division','$userid','$lang','Project', 'W54F2320'";
		\Debugbar::info($sql);
		$projects = $this->connection->select($sql);

		$sql = "--Load Period" . PHP_EOL;
		$sql .= "EXEC W54P4701 '$division','$userid','$lang','Period', 'W54F2320'";
		\Debugbar::info($sql);
		$periods = $this->connection->select($sql);


		return View::make("W5X.W54.W54F2320", compact('g','pForm','divisions','projects','periods'));
    }

	public function action($pForm, $g, $task)
	{
		$userid = Auth::user()->user()->UserID;
		$lang = Session::get('Lang');

		switch($task){
			case 'project': //Load project
				$division = Input::get("divisionID");
				$sql = "--Reload Project" . PHP_EOL;
				$sql .= "EXEC W54P4701 '$division','$userid','$lang','Project', '$pForm'";
				$projects = $this->connection->select($sql);
				$str='';
				foreach ($projects as $row) {
					$str .= "<option value='" . $row["ProjectID"] . "'>" . $row["ProjectName"] . "</option>";
				}
				return $str;
				break;
			case 'filter': //Load grid
				$divisions = Input::get('divisionIDs','');
				$projects = Input::get('projectIDs','');
				$periodFrom = Input::get('cbPeriodFromW54F2320','');
				$periodTo = Input::get('cbPeriodToW54F2320','');
				$companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
				$sql = "--Load Grid" . PHP_EOL;
				$sql .= "EXEC W54P2320 '$divisions','$userid','$lang','$projects', '$periodFrom','$periodTo','$companyID'";
				\Debugbar::info($sql);
				$rsGrid = $this->connection->select($sql);
				\Debugbar::info($rsGrid);
				return ($rsGrid);
				break;
			default:
				//nothing
		}
	}
}
