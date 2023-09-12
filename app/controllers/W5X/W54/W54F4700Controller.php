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

class W54F4700Controller extends W5XController
{

    public function index($pForm, $g)
    {
        $userid = Auth::user()->user()->UserID;
        $lang = Session::get('Lang');

		$sql = "--Load Divisions" . PHP_EOL;
		$sql .= "EXEC W54P4701 '','$userid','$lang','Division', '$pForm'";
		\Debugbar::info($sql);
		$divisions = $this->connection->select($sql);

		$division = Session::get("W91P0000")['DivisionID'];
		$sql = "--Load Project" . PHP_EOL;
		$sql .= "EXEC W54P4701 '$division','$userid','$lang','Project', '$pForm'";
		\Debugbar::info($sql);
		$projects = $this->connection->select($sql);

		$sql = "--Load Period" . PHP_EOL;
		$sql .= "EXEC W54P4701 '$division','$userid','$lang','Period', '$pForm'";
		\Debugbar::info($sql);
		$periods = $this->connection->select($sql);


		return View::make("W5X.W54.W54F4700", compact('g','pForm','divisions','projects','periods'));
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
				$periodFrom = Input::get('cbPeriodFrom','');
				$periodTo = Input::get('cbPeriodTo','');
				$companyID = \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
				$sql = "--Load Grid" . PHP_EOL;
				$sql .= "EXEC W54P4700 '$divisions','$userid','$lang','$projects', '$periodFrom','$periodTo','$companyID'";
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
