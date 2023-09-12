<?php
namespace W0X\W00;

use Config;
use Exception;
use Input;
use PDO;
use Redirect;
use Request;
use Session;
use View;
use Auth;
use W0X\W0XController;

class W00F7130Controller extends W0XController {
    public function __construct()
    {
        parent::__construct(0);
    }



    public function index() {
        $show="hide";
        $typealert="info";
        $message="Update success";

        $server= Config::get('database.connections.sqlsrv.host');
        $db= Config::get('database.connections.sqlsrv.database');
        $subdb= Config::get('database.connections.sqlsrvHR.database');
        $userver= Config::get('database.connections.sqlsrv.username');
        $product= Config::get('database.LWProduct','0');



        if (Session::get("AdminAuth")!==true)
            return Redirect::to("/adminlogin");
        if(Request::isMethod('post')) {
            $mode=Input::get("mode");
            $server=  \Helpers::decryptData(Input::get("p1"));
            \Debugbar::info($server);
            $userver= \Helpers::decryptData(Input::get("p2"));
            $passserver= \Helpers::decryptData(Input::get("p3"));
            $product= Input::get("slProduct",'0');
            $db= \Helpers::decryptData(Input::get("p4",''));

            $subdb= \Helpers::decryptData(Input::get("p5", $db));
            if ($db=='')$db=$subdb;
            if ($subdb=='')$subdb=$db;

            if ($mode=="0" || $mode=="1")
            {
                $connectionInfo = array( "Database"=>"$db", "UID"=>"$userver", "PWD"=>"$passserver");
                if ($mode==1)
                    $connectionInfo = array( "Database"=>"$subdb", "UID"=>"$userver", "PWD"=>"$passserver");

                if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
                    $conn = sqlsrv_connect($server,$connectionInfo);
                } else {
                    $conn = new PDO("dblib:host=$server;dbname=$db", "$userver", "$passserver");
                }

                if($conn==false) {
                    return 0;
                }
                else
                {
                    return 1;
                }
            }
            $connectionInfo = array( "Database"=>"$db", "UID"=>"$userver", "PWD"=>"$passserver");
            //$conn = sqlsrv_connect($server,$connectionInfo);

            if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
                $conn = sqlsrv_connect($server,$connectionInfo);
            } else {
                $conn = new PDO("dblib:host=$server;dbname=$db", "$userver", "$passserver");
            }


            if($conn==false) {
                $show="";
                $typealert="danger";
                $message="Unable connect server $server and database $db";
            }
            else {
                $subconnectionInfo = array( "Database"=>"$subdb", "UID"=>"$userver", "PWD"=>"$passserver");

                if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
                    $subconn = sqlsrv_connect($server,$subconnectionInfo);
                } else {
                    $subconn = new PDO("dblib:host=$server;dbname=$db", "$userver", "$passserver");
                }

                if($subconn==false) {
                    $show="";
                    $typealert="danger";
                    $message="Unable connect server $server and database $subdb";
                }
                else {
                    if ($product == 1){//FN
                        $stmt = sqlsrv_query($conn, "SELECT TOP 1 1 FROM D90T9999");
                    }elseif ($product==2){//HR
                        $stmt = sqlsrv_query($conn, "SELECT TOP 1 1 FROM D09T9999");
                    }else{
                        $stmt = sqlsrv_query($conn, "SELECT TOP 1 1 FROM D90T9999");
                        $stmt1 = sqlsrv_query($subconn, "SELECT TOP 1 1 FROM D09T9999");
                    }
                    if ($stmt) {
                        $rows = sqlsrv_has_rows( $stmt );
                        if ($rows === false){
                            $typealert="danger";
                            $message="Database entered does not match Lemonweb Product";
                        }
                    }
                    if (isset($stmt1)) {
                        $rows = sqlsrv_has_rows( $stmt1 );
                        if ($rows === false){
                            $typealert="danger";
                            $message="HR Database entered does not match Lemonweb Product";
                        }
                    }
                    $show="";
                    if ($typealert!="danger"){
                        try {
                            $server=\Helpers::encrypt_userpass($server);
                            $passserver= \Helpers::encrypt_userpass($passserver);
                            $db= \Helpers::encrypt_userpass($db);
                            $userver= \Helpers::encrypt_userpass($userver);
                            $subdb= \Helpers::encrypt_userpass($subdb);
                            $sys = \Helpers::encrypt_userpass("LEMONSYS");
                            Config::write('database.connections.sqlsrvLMS.host',"$server");
                            Config::write('database.connections.sqlsrv.host',"$server");
                            Config::write('database.connections.sqlsrvHR.host',"$server");
                            Config::write('database.connections.sqlsrv.host',"$server");
                            Config::write('database.connections.sqlsrvHR.host',"$server");
                            Config::write('database.connections.sqlsrv.database',"$db");
                            Config::write('database.connections.sqlsrvLMS.database',"$sys");
                            Config::write('database.connections.sqlsrvHR.database',"$subdb");
                            Config::write('database.connections.sqlsrv.username',"$userver");
                            Config::write('database.connections.sqlsrvHR.username',"$userver");
                            Config::write('database.connections.sqlsrvLMS.username',"$userver");
                            Config::write('database.connections.sqlsrvLMS.password',"$passserver");
                            Config::write('database.connections.sqlsrv.password',"$passserver");
                            Config::write('database.connections.sqlsrvHR.password',"$passserver");

                            Config::write('database.LWProduct',"$product");
                            //Nếu là FN Only thì ko cho hiện 2 menu này
                            if ($product==1){
                                Config::write('services.showModule.W75', 0);
                                Config::write('services.showModule.W76', 0);
                            }
                            Auth::user()->logout();
                        }
                        catch(Exception $e)
                        {
                            $typealert="danger";
                            $message="An unexpected error has occurred";
                        }
                    }

                }
            }
        }

        if($message=="Update success") {
            // lấy thông tin cấu hình đưa ra view
            $server= Config::get('database.connections.sqlsrv.host');
            $db= Config::get('database.connections.sqlsrv.database');
            $subdb= Config::get('database.connections.sqlsrvHR.database');
            $userver= Config::get('database.connections.sqlsrv.username');
            $product= Config::get('database.LWProduct','0');
            $server=  \Helpers::encryptData(\Helpers::decrypt_userpass($server));
            $db= \Helpers::encryptData(\Helpers::decrypt_userpass($db));
            $userver= \Helpers::encryptData(\Helpers::decrypt_userpass($userver));
            $subdb= \Helpers::encryptData(\Helpers::decrypt_userpass($subdb));
        }else{
            $server=  \Helpers::encryptData($server);
            $db= \Helpers::encryptData($db);
            $userver= \Helpers::encryptData($userver);
            $subdb= \Helpers::encryptData($subdb);
        }

        return View::make('W0X.W00.W00F7130',compact('typealert','show','message','server','db','userver','subdb','product'));
    }
}
