<?php
namespace W9X\W94;

use Auth;
use Carbon\Carbon;
use Debugbar;
use Session;
use View;
use W9X\W9XController;

class W94F3000Controller extends W9XController
{
    /**
     * @param $pFrom
     * @param $g
     * @return \Illuminate\View\View
     */

    public function index($pFrom, $g, $id = null)
    {
        $key = "1234567891234567"; //16 Character Key
        //Debugbar::info(url()."/".$pFrom."/".$g."/".$id);
        $servername = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.host'));
        $servername = base64_encode(\Security::encrypt($servername, $key));
        $username = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.username'));
        $username = base64_encode(\Security::encrypt($username, $key));
        $password = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.password'));
        $password = base64_encode(\Security::encrypt($password, $key));
        $database = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.database'));
        $database = base64_encode(\Security::encrypt($database, $key));
        $subdatabase = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrvHR.database'));
        $subdatabase = base64_encode(\Security::encrypt($subdatabase, $key));

        //Debugbar::info($servername);
        //Debugbar::info($username);
        //Debugbar::info($password);
        //Debugbar::info($database);

        $config = \Config::get("birt.BIRTCallingMode");

        $DivisionID = Session::get("W91P0000")['DivisionID'];
        $UserID = Auth::user()->user()->UserID;
        $HostID = "WEB";
        $Platform = \Helpers::checkMobile() == "M" ? 3 : 2;
        $query = "EXEC W94P3010 '$DivisionID', '$UserID', '$HostID', $Platform";

        $reportTypeList = $this->connection->select($query);

        $reportName = $this->getModalTitle($pFrom);

        if (is_null($id)) { //Truong hop call 1 report
            $level = 2;
            if (($config == "VT" || $config == "RT") && \Helpers::checkMobile() == "") {
                return View::make("layout.layoutReport", compact('config', 'reportTypeList', 'level', 'pFrom', 'g', 'servername', 'username', 'password', 'database', 'subdatabase'));
            } else {
                return View::make("W9X.W94.W94F3000" . \Helpers::checkMobile(), compact('reportName', 'config', 'reportTypeList', 'level', 'pFrom', 'g', 'servername', 'username', 'password', 'database', 'subdatabase'));
            }

        } else {
            if (\Helpers::checkMobile() == "M") {
                $level = 3;
                $back_url = url() . "/" . "W94F3000" . "/" . $pFrom . "/" . $g;
                $query = "EXEC W94P3000 '" . Auth::user()->user()->UserID . "','" . Session::get("W91P0000")['DivisionID'] . "','" . Session::get("W91P0000")['TranMonth'] . "','" . Session::get("W91P0000")['TranYear'] . "',null,'" . $_SERVER['HTTP_USER_AGENT'] . "','$id'";
                $report = $this->connection->selectOne($query);
                //Debugbar::info($this->arrayFilter($reportTypeList,$id));
                $reportName = $this->arrayFilter($reportTypeList, $id);
                return View::make("W9X.W94.W94F3000DT" . \Helpers::checkMobile(), compact('id', 'reportName', 'back_url', 'level', 'pFrom', 'g', 'reportTypeList', 'servername', 'username', 'password', 'database', 'subdatabase', 'id', 'report'));
            }
        }
    }

    public function loadReportType($pFrom, $g)
    {
        $DivisionID = Session::get("W91P0000")['DivisionID'];
        $UserID = Auth::user()->user()->UserID;
        $HostID = "WEB";
        $mode = \Input::get("mode");
        $Platform = 2;//\Helpers::checkMobile() == "M" ? 3 : 2;
        $query = "EXEC W94P3010 '$DivisionID', '$UserID', '$HostID', '$Platform'";
        $reportTypeList = $this->connection->select($query);
        $arrayReportTypeList = array();
        $arrayTemp = array('');
        foreach ($reportTypeList as $row){
            if (array_search($row['ReportGroupID'], $arrayTemp) == ""){
                array_push($arrayTemp, $row['ReportGroupID']);
                $type = new ReportTypeClass($row['ReportGroupID'],$row['ReportGroupName']);
                array_push($arrayReportTypeList, $type);
            }

        }
        //var_dump($reportTypeList); die;
        return View::make("W9X.W94.W94F3000_ReportTypeLst" . \Helpers::checkMobile(), compact('reportTypeList','arrayReportTypeList', 'pFrom', 'g','mode'));
    }

    public function getTicket($pFrom, $g)
    {
        $ticket = $this->get_trusted_ticket('http://10.0.0.40:8001', 'admin', '10.0.0.174');
        Debugbar::info($ticket);
        return $ticket;
    }

    //Load report tableau
    public function get_trusted_url($user, $server, $view_url)
    {
        $params = ':embed=yes&:toolbar=yes';

        $ticket = get_trusted_ticket($server, $user, $_SERVER['REMOTE_ADDR']);
        if (strcmp($ticket, "-1") != 0) {
            return "http://$server/trusted/$ticket/$view_url?$params";
        } else
            return 0;
    }

    //Cal do_post to get Ticket
    public function get_trusted_ticket($wgserver, $user, $remote_addr)
    {
        $params = array(
            'username' => $user,
            'client_ip' => $remote_addr
        );
        return $this->do_post("$wgserver/trusted", $params);
    }


    //pPost data to get ticket
    function do_post($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        Debugbar::info("data: " . $ch);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    function restClient()
    {
        $reportname = \Input::get('reportname');//
        $format = \Input::get('format');
        $param = \Input::get('param');
        if ($param == null)
            $param = '{"noparam":"noparam"}';

        //$tomcatserver = \Input::get('tomcatserver');
        $rptWidth = \Input::get('rptWidth') - 30;
        $rptHeight = \Input::get('rptHeight') - 30;
        $tomcatserver = \Input::get('tomcatserver');
        $servername = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.host'));
        $username = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.username'));
        $password = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.password'));
        $database = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.database'));
        $subdatabase = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrvHR.database'));
        $path = "";//getenv('BIRT_HOME');
        //Debugbar::info($path."/reports/". $reportname . ".rptdesign");

        $url = $tomcatserver . '/restful/birt-service/run';
        echo $url;
        //Debugbar::info($url);
        //die;
        $method = 'POST';
        $servername = urlencode($servername);
        $data = '{"conn":{"reportName":"' . $reportname . '","format":"' . $format . '", "serverName":"' . $servername . '", "userName":"' . $username . '", "password":"' . $password . '", "database":"' . $database . '", "subDatabase":"' . $subdatabase . '", "rwURL":"' . urlencode($tomcatserver) . '", "excelPath":"' . urlencode($path) . '", "rptWidth":"' . $rptWidth . '", "rptHeight":"' . $rptHeight . '"},"param":' . $param . '}';
        Debugbar::info($url);
        Debugbar::info($data);
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

        switch ($method) {
            case 'POST':
                curl_setopt($handle, CURLOPT_POST, 1);
                curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                break;
        }
        //if (file_exists(getenv("BIRT_HOME")."/outputs/".$reportname.".html"))
        //    unlink(getenv("BIRT_HOME")."/outputs/".$reportname.".html");
        $response = curl_exec($handle);
        //Debugbar::info($response);
        return $response;

    }

    function exportService()
    {
        $reportname = \Input::get('reportname');//
        $format = \Input::get('format');
        $param = \Input::get('param');
        if ($param == null)
            $param = '{"noparam":"noparam"}';
        Debugbar::info($param);
        //$tomcatserver = \Input::get('tomcatserver');
        $rptWidth = \Input::get('rptWidth') - 30;
        $rptHeight = \Input::get('rptHeight') - 30;
        $tomcatserver = \Input::get('tomcatserver');
        $servername = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.host'));
        $username = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.username'));
        $password = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.password'));
        $database = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrv.database'));
        $subdatabase = \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrvHR.database'));
        $path = "";//getenv('BIRT_HOME');
        $url = $tomcatserver . '/restful/birt-service/export';
        $method = 'POST';
        $servername = urlencode($servername);
        $data = '{"conn":{"reportName":"' . $reportname . '","format":"' . $format . '", "serverName":"' . $servername . '", "userName":"' . $username . '", "password":"' . $password . '", "database":"' . $database . '", "subDatabase":"' . $subdatabase . '", "rwURL":"' . urlencode($tomcatserver) . '", "excelPath":"' . urlencode($path) . '", "rptWidth":"' . $rptWidth . '", "rptHeight":"' . $rptHeight . '"},"param":' . $param . '}';
        Debugbar::info($data);
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

        switch ($method) {
            case 'POST':
                curl_setopt($handle, CURLOPT_POST, 1);
                curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                break;
        }
        //if (file_exists(getenv("BIRT_HOME")."/outputs/".$reportname.".html"))
        //    unlink(getenv("BIRT_HOME")."/outputs/".$reportname.".html");
        $response = curl_exec($handle);
        Debugbar::info($response);
        echo $response;

    }
}

class ReportTypeClass
{
    public $id;
    public $name;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
