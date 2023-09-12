<?php

use Artisaninweb\SoapWrapper\Facades\SoapWrapper;


class WebLinkController extends Controller
{

    public function updateSettings($action = '')
    {
        \Debugbar::disable();
        header('Access-Control-Allow-Origin: *');

        //return 'test';
        $array = json_decode((Helpers::decryptData(Input::get('data', '')))) ;

        $server = Helpers::encrypt_userpass($array->server);
        $userver = Helpers::encrypt_userpass($array->user);
        $passserver = Helpers::encrypt_userpass($array->pass);
        $db = Helpers::encrypt_userpass($array->database);

        $mailServer = $array->mailServer;
        $mailPort = $array->mailPort;
        $mailUsername = Helpers::encrypt_userpass($array->mailUsername);
        $mailPassword = Helpers::encrypt_userpass($array->mailPassword);
        $mailEncrypt = $array->mailEncrypt;
        $logo = $array->logo;
        $session = $array->session;


        $authPass = $array->authPass;
        if ($authPass != "abc123") {
            Helpers::log($authPass);
            return json_encode(['status' => 'ERROR', 'message' => $authPass]);
        }
        $sys = \Helpers::encrypt_userpass("LEMONSYS");
        header('Access-Control-Allow-Origin: *');
        //header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        //header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        try {
            Config::write('database.connections.sqlsrvLMS.host', "$server");
            Config::write('database.connections.sqlsrv.host', "$server");
            Config::write('database.connections.sqlsrvHR.host', "$server");
            Config::write('database.connections.sqlsrv.host', "$server");
            Config::write('database.connections.sqlsrvHR.host', "$server");
            Config::write('database.connections.sqlsrv.database', "$db");
            Config::write('database.connections.sqlsrvLMS.database', "$sys");
            Config::write('database.connections.sqlsrvHR.database', "$db");
            Config::write('database.connections.sqlsrv.username', "$userver");
            Config::write('database.connections.sqlsrvHR.username', "$userver");
            Config::write('database.connections.sqlsrvLMS.username', "$userver");
            Config::write('database.connections.sqlsrvLMS.password', "$passserver");
            Config::write('database.connections.sqlsrv.password', "$passserver");
            Config::write('database.connections.sqlsrvHR.password', "$passserver");


            Config::write('mail.host', "$mailServer");
            Config::write('mail.port', "$mailPort");
            Config::write('mail.encryption', "$mailEncrypt");
            Config::write('mail.username', "$mailUsername");
            Config::write('mail.password', "$mailPassword");
            Config::write('session.lifetime', "$session");

            //$logo = str_replace('data:image/png;base64,', '', $logo);
            //$logo = str_replace(' ', '+', $logo);
            //$logo = base64_decode($logo);
            //file_put_contents(public_path('/packages/default/L3/images')."/companylogo-large.png",file_get_contents($logo));

            Auth::user()->logout();
            Session::flush();
            Artisan::call('cache:clear');

            return json_encode(['status' => 'SUCC']);
        } catch (\Exception $ex) {
            Helpers::log($ex->getMessage());
            return json_encode(['status' => 'ERROR', 'message' => $ex->getMessage()]);
        }

    }

    public function getModalTitleG4($pForm)
    {
        $userID = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $sql = "--Lấy caption cho màn hình thuộc ESS va MSS" . PHP_EOL;
        $sql .= "EXEC W00P1011 '" . \Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]) . "','" . $userID . "','%','" . Session::get('Lang') . "','" . \Helpers::decrypt_userpass(\Config::get('database.connections.sqlsrvHR.database')) . "'";
        $temList = DB::connection('sqlsrvLMS')->select($sql);
        //\Debugbar::info($temList);
        $result = array_filter($temList, function ($row) use ($pForm) {
            //return $row["FormActive"] == str_replace('D','W', $pForm) ; //PHan quyeen theo form active
            return $row["FormID"] == str_replace('W', 'D', $pForm);
        });
        $captionRow = array();
        foreach ($result as $row) {
            $captionRow = $row;
        }

        return count($captionRow) > 0 ? $captionRow["FormDesc"] : "";
    }
    public function callback()
    {

        header('Access-Control-Allow-Origin: *');
        \Debugbar::disable();
        $data = Input::get("p", '');



        $data = (Helpers::decryptData($data));
        $array = explode("&", $data);

        $userName = $array[0];
        $password = $array[1];
        $urlCallBack = Helpers::decryptData($array[2]);

        try{
            $server = Config::get('database.connections.sqlsrv.host');
            $userver = Config::get('database.connections.sqlsrv.username');
            $passserver = Config::get('database.connections.sqlsrv.password');
            $database = Config::get('database.connections.sqlsrv.database');
            $db = Helpers::decrypt_userpass($database);

            $conn = array(
                'driver' => Config::get('database.connections.sqlsrv.driver'),
                'host' => $server,
                'database' => $database,
                'username' => $userver,
                'password' => $passserver,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            );


            $db = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrv.database'));
            $user = D00T0030::where("UserID", $userName)->first();
            //setcookie("hisDB", "", time() - 3600);
            $remember = false;
            Auth::user()->logout();
            Session::flush();

            Auth::user()->login($user, $remember);
            Session::set('companyID', $db);
            Session::set('CONDEFAULT', $conn);
            if (Session::get("Lang") == null) {
                Session::set('Lang', 84);
                Session::set('i18n', 'vi_VI');
                Session::set("locate", "vi");
            }
            $W91P0000 = DB::connection('CONDEFAULT')->selectOne("EXEC W91P0000 '$db','$db', '$userName', 2");

            Session::set("W91P0000", $W91P0000);

            return Redirect::to($urlCallBack);
        }catch (\Exception $ex){
            Helpers::log($ex->getMessage());
        }

    }

    public function index()
    {

        \Debugbar::disable();

        header('Access-Control-Allow-Origin: *');
        $formType = Input::get('formType', 'tab');
        $formActive = Input::get('formActive', 'W75F1065'); //form cha
        $formID = Input::get('formID', 'D75F1065');
        $formCall = str_replace("D", "W", $formID); //form call
        $formCall = Input::get('formCall', $formCall);
        $moduleGroup = Input::get('moduleGroup', '4');
        $g = $moduleGroup;
        $mod = Input::get('mod', '0');
        $masterID = Input::get('masterID', '');
        $detailID = Input::get('detailID', '');
        $moduleID = substr($formID, 0, 3);

        $caption = $this->getModalTitleG4($formID);

        if ($caption == ''){
            $database = Config::get('database.connections.sqlsrv.database');
            $db = Helpers::decrypt_userpass($database);
            $userID = Auth::user()->user()->UserID;
            $sql = "--Lay cap tion tu menu trai".PHP_EOL;
            $sql .= "EXEC W00P1010 '$db', '$userID', '%', '84', '$db','', 0, 'D', 2";

            $rsData = DB::connection('sqlsrvLMS')->select($sql);

            //Luu session phan quyen
            Helpers::LeftMenu($rsData,'ModuleName','ModuleIcon','FormID','Permission');


            array_filter($rsData, function($row) use($formID, &$caption){
                if ($row["FormID"] == $formID){
                    $caption = $row["FormDesc"];
                }
                return $row["FormID"] == $formID;
            });
        }


        switch ($formType) {
            case "tab": //Open form dạng tab
                $script = url("/$formActive/view/$formID/$moduleGroup");
                break;
            case "modal": //Open form dạng modal
                $script = "showFormDialog('" . url("/$formActive/$formID/$moduleGroup") . "','modal$formActive')";

                break;
            case "approval": //open những form duyệt nhiều cấp
                if ($formActive == "W84F2020"){
                    $formCall = Input::get("formCall", "");
                    $formCall = str_replace("D", "W", $formCall); //form call
                }
                $script = "showFormDialog('" . url("/$formActive/$formID/$formCall/$moduleGroup/$moduleID/$mod/$masterID/$detailID") . "','modalW84F2020')";
                //\Debugbar::info($script);

                break;
        }

        return View::make('weblink.index', compact('script', 'formType', 'formID', 'moduleGroup', 'g', 'formActive', 'caption'));
    }
}
