<?php


use Jenssegers\Agent\Agent;


class AuthController extends BaseController
{

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        parent::__construct(0);
    }

    function checkLogin($task)
    {
        $username = Input::get('username', '');
        $password = Input::get('password', '');
        switch ($task) {
            case 'invalid':
                $user = D00T0030::where("UserID", $username)->first();
                //return (string)(count($user)> 0);
                if (count($user) > 0) {
                    $urlService = Config::get('services.diginet.url');
                    $gsTYPEENCRYPT = "DED0104";
                    $gsCodeString = "CCuL40";

                    try {
                        $objectDLL = new DOTNET("D00D9010,Version=1.0.5911.28757,Culture=neutral,PublicKeyToken=3072ac21984585ef", "D00D9010.D00C9010");
                        $sXCode = $objectDLL->ChangeValue($gsCodeString, 1, $gsTYPEENCRYPT);
                        $sUser = $objectDLL->CodeInformation($username, $gsTYPEENCRYPT);
                        $client = new SoapClient($urlService, array('soap_version' => SOAP_1_1));
                        $params = ['sText' => $sUser, 'sXCode' => $sXCode];
                        $value1 = $client->CheckInvalidUser($params)->CheckInvalidUserResult;
                        $value1 = $objectDLL->EncodeInformation($value1, $gsTYPEENCRYPT);
                        $value2 = $objectDLL->ChangeValue($username, 1, $gsTYPEENCRYPT);
                        \Debugbar::info($value1);
                        \Debugbar::info($value2);
                        \Debugbar::info(htmlentities($value1) === htmlentities($value2));
                        if (htmlentities($value1) === htmlentities($value2))
                            return json_encode(['CODE' => 'LOGIN', 'message' => Lang::get("message.Nguoi_dung_nay_da_dang_nhap_truoc_do") . '</br>' . Lang::get("message.Ban_co_muon_xoa_phien_lam_viec_truoc_khong")]);
                        return json_encode(['CODE' => 'LOGOUT', 'message' => '']);
                    } catch (Exception $e) {
                        return json_encode(['CODE' => 'ERROR', 'message' => $e->getMessage()]);
                    }
                } else {
                    return json_encode(['CODE' => 'NOT-EXIST', 'message' => Lang::get('message.Ten_va_mat_khau_khong_dung')]);
                }
                break;
            case 'removeuser':
                $urlService = Config::get('services.diginet.url');
                $gsTYPEENCRYPT = "DED0104";
                $gsCodeString = "CCuL40";
                try {
                    $objectDLL = new DOTNET("D00D9010,Version=1.0.5911.28757,Culture=neutral,PublicKeyToken=3072ac21984585ef", "D00D9010.D00C9010");
                    $sXCode = $objectDLL->ChangeValue($gsCodeString, 1, $gsTYPEENCRYPT);
                    $sUser = $objectDLL->CodeInformation($username, $gsTYPEENCRYPT);
                    $client = new SoapClient($urlService, array('soap_version' => SOAP_1_1));
                    $params = ['sText' => $sUser, 'sXCode' => $sXCode];
                    $value1 = $client->RemoveInvalidUser($params)->CheckInvalidUserResult;
                    //$value1 = $objectDLL->EncodeInformation($value1, $gsTYPEENCRYPT);
                    $value2 = $objectDLL->ChangeValue($username, 1, $gsTYPEENCRYPT);
                    \Debugbar::info($value1);
                    \Debugbar::info($value2);
                    \Debugbar::info(htmlentities($value1) === htmlentities($value2));
                    //if (htmlentities($value1)  === htmlentities($value2))
                    //	return 1;
                    return $value1;
                } catch (Exception $e) {
                    //return 0;
                }
                break;
        }
    }

    function login()
    {
        //Kiem tra neu chua thiet lap database
        if (\Config::get('database.connections.sqlsrv.database') == "") {
            return Redirect::guest('/adminlogin');
        }
        Session::set('modlogin', 0);
        $g = 0;
        // kiểm tra trình duyệt có thỏa mãn hay ko
        $BrowserOK = Helpers::getUserAgent();
        if ($BrowserOK) {
            if (Session::get("Lang") == null) {
                Session::set('Lang', 84);
                Session::set('i18n', 'vi_VI');
                Session::set("locate", "vi");
            }

            if (Auth::user()->check() || Auth::user()->viaRemember()) return Redirect::to("/");

            $hide = "hide";
            $err_text = "";
            $db = Helpers::decryptData(Input::get("p3",""));
            if ($db == "")
                $db = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.database'));
            $server = Config::get('database.connections.sqlsrv.host');
            $userver = Config::get('database.connections.sqlsrv.username');
            $passserver = Config::get('database.connections.sqlsrv.password');
            $conn = array(
                'driver' => Config::get('database.connections.sqlsrv.driver'),
                'host' => $server,
                'database' => Helpers::encrypt_userpass($db),
                'username' => $userver,
                'password' => $passserver,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            );
            Session::set('CONDEFAULT', $conn);
            if (Request::isMethod("post")) {
                $connectionInfo = array("Database" => "$db", "UID" => Helpers::decrypt_userpass($userver), "PWD" => Helpers::decrypt_userpass($passserver));

                if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
                    $conn = sqlsrv_connect(Helpers::decrypt_userpass($server), $connectionInfo);
                } else {
                    $conn = new PDO("dblib:host=".Helpers::decrypt_userpass($server).";dbname=$db", Helpers::decrypt_userpass($userver), Helpers::decrypt_userpass($passserver));
                }


                if ($conn === false) {
                    $hide = "";
                    $err_text = Lang::get('message.Ket_noi_server_khong_thanh_cong');
                } else {
                    $this->createConnect();
                    //-----------------

                    $userid = Helpers::decryptData(Input::get("p1"));
                    $password = Helpers::decryptData(Input::get("p2"));
                    \Debugbar::info($password);
                    //----------------------------

                    $product = intval(Config::get('database.LWProduct', '0'));
                    // kiểm tra user đăng nhập
                    $sql = "-- Kiem tra user dang nhap" . PHP_EOL;
                    $sql .= "EXEC W00P0120 '" . $userid . "','0', N'$db',N'" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database')) . "','" . Session::get('Lang') . "', $product";
                    $result = $this->connectionLMS->selectOne($sql);
                    $remember = Input::get("remember") == 'on' ? true : false;
                    if ($result['Status'] == 0) {
                        if ($result['Password'] == Helpers::encrypt_userpass($password)) {

                            $user = D00T0030::where("UserID", $userid)->first();
                            $ccul = Helpers::checkLoginWeb($userid);

                            if (!is_null($ccul) && $ccul[0] == 'OFF') {
                                $hide = "";
                                $err_text = Lang::get('message.Da_vuot_qua_so_luong_ket_noi_cho_phep_diong_thoi_Khong_the_ket_noi_vao_thoi_diem_nay');
                            } else if ((!is_null($ccul) && $ccul[0] == 'ERROR') || is_null($ccul)) {
                                $hide = "";
                                $err_text = Lang::get('message.Ket_noi_toi_he_thong_du_lieu_bi_loi._Vui_long_lien_he_voi_nha_cung_cap_de_duoc_ho_troU');
                            } else {
                                Session::set('sText', $ccul[1]);
                                Auth::user()->login($user, $remember);
                                if ($remember) {
                                    setcookie('hisDB', $db);
                                } else {
                                    setcookie("hisDB", "", time() - 3600);
                                }
                                Session::set('companyID', $db);
                                //\Debugbar::info("test");
                                //\Debugbar::info(DB::connection("CONDEFAULT"));
                                Session::set("W91P0000", DB::connection("CONDEFAULT")->selectOne("EXEC W91P0000 '" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.database')) . "','" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database')) . "', '$userid', $product"));
                                return Redirect::intended();
                            }

                        } else {
                            $hide = "";
                            $err_text = Lang::get('message.Ten_va_mat_khau_khong_dung');
                        }
                    } else {
                        $hide = "";
                        $err_text = $result['Message'];
                    }

                }
            }
            $DBCOM = isset($_COOKIE['hisDB']) ? $_COOKIE['hisDB'] : $db;
            return View::make("auth.login" . Helpers::checkMobile(), compact("hide", 'err_text', 'DBCOM', 'g'));

        } else return "<center><h3>" . Lang::get("message.Trinh_duyet_cua_ban_qua_cu_vui_long_nang_cap_trinh_duyet") . " (Chrome 39+, Firefox 39+, IE 10+)</h3></center>";
    }

    function logout()
    {
        if (!is_null(Session::get("sText")))
            Helpers::checkLogOut(Session::get('sText'));
        Auth::user()->logout();
        Session::flush();
        return Redirect::to("/");
    }

    function esslogout()
    {
        Auth::ess()->logout();
        return Redirect::to("/esshome");
    }

    function adminlogin()
    {
        $err_text = "";
        if (Request::isMethod("post")) {
            $password = md5( Helpers::decryptData(Input::get("p1")));
            $p = Config::get('database.PassAdmin');
            if ($password != $p) {
                return 0;
            } else {
                Session::set('AdminAuth', true);
                return 1;
            }
        }
        return View::make("auth.adminlogin", compact("err_text"));
    }

    function esslogin()
    {
        $g = 4;
        Session::set('modlogin', 1);
        if (Session::get("Lang") == null) {
            Session::set('Lang', 84);
            Session::set('i18n', 'vi_VI');
            Session::set("locate", "vi");
        }

        if (Auth::ess()->check() || Auth::ess()->viaRemember()) return Redirect::to("/esshome");
        $hide = "hide";
        $err_text = "";
        $db = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.database'));
        $server = Config::get('database.connections.sqlsrv.host');
        $userver = Config::get('database.connections.sqlsrv.username');
        $passserver = Config::get('database.connections.sqlsrv.password');
        $conn = array(
            'driver' => Config::get('database.connections.sqlsrv.driver'),
            'host' => $server,
            'database' => Config::get('database.connections.sqlsrv.database'),
            'username' => $userver,
            'password' => $passserver,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        );
        Session::set('CONDEFAULT', $conn);
        if (Request::isMethod("post")) {
            $userid = Input::get("p1");
            $password = Input::get("p2");
            // GET DEFAULT DB COMPANY
            $user = D00T0030::where("UserID", $userid)->first();
            $remember = Input::get("remember") == 'on' ? true : false;
            $product = intval(Config::get('database.LWProduct', '0'));
            $sql = "--Kiem tra user" . PHP_EOL;
            $sql .= "EXEC W00P0120 '" . $userid . "','1', N'$db',N'" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database')) . "','" . Session::get('Lang') . "', $product";
            $result = $this->connectionLMS->selectOne($sql);
            if ($result['Status'] == 0) {
                if ($result['Password'] == Helpers::encrypt_userpass($password)) {
                    Auth::ess()->login($user, $remember);
                    Auth::user()->logout();
                    Session::set("W91P0000", DB::connection("CONDEFAULT")->selectOne("EXEC W91P0000 '" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.database')) . "','" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database')) . "', '$userid'"));
                    return Redirect::to("/esshome");
                } else {
                    $hide = "";
                    $err_text = Helpers::getRS($g, "Ten_va_mat_khau_khong_dung");
                    return View::make("auth.esslogin", compact("hide", 'err_text', 'g'));
                }
            } else {
                $hide = "";
                $err_text = $result['Message'];
                return View::make("auth.esslogin", compact("hide", 'err_text', 'g'));
            }

        } else {
            $g = 0;
            // kiểm tra trình duyệt có thỏa mãn hay ko
            $BrowserOK = Helpers::getUserAgent();
            if ($BrowserOK) {
                $hide = "hide";
                $err_text = "";
                return View::make("auth.esslogin", compact("hide", 'err_text', 'g'));
            } else return "<center><h3>" . Helpers::getRS($g, "Trinh_duyet_cua_ban_qua_cu_vui_long_nang_cap_trinh_duyet") . " (Chrome 39+, Firefox 39+, IE 10+)</h3></center>";
        }
    }

    function returnLogout()
    {
        if (!is_null(Session::get("sText")))
            Helpers::checkLogOut(Session::get('sText'));
        Auth::user()->logout();
        return View::make("layout.logout");
    }

}
