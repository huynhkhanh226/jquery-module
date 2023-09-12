<?php

use Artisaninweb\SoapWrapper\Facades\SoapWrapper;


class HomeController extends BaseController
{

    // home page
    public function index()
    {
        //var_dump(Session::get("W91P0000"));die;
        $g = 0;
        $user = Auth::user()->user()->UserID;
        if (!Session::has("W91P0000"))
            Auth::user()->logout();//Nếu mất session DivisionID, TranMonth, TranYear thì kết thúc phiên làm việc - THANHHUYEN
        if (Helpers::checkMobile() == "") {
            $database = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
            $subdatabase = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
            if (Request::isMethod("post")) {
                $period = Input::get('slChangePeriod');
                if ($period != "") {
                    $arr = Session::get("W91P0000");
                    $arr['DivisionID'] = Input::get('slFNDivisionID','');
                    $arr['HRDivisionID'] = Input::get('slHRDivisionID','');
                    if ($arr['DivisionID']=='')$arr['DivisionID']= $arr['HRDivisionID'];
                    $arr['TranMonth'] = str_pad(substr($period, 4), 2, '0', 0);
                    $arr['TranYear'] = substr($period, 0, 4);
                    $arr['HRTranMonth'] = $arr['TranMonth'];
                    $arr['HRTranYear'] = $arr['TranYear'];
                    Session::set("W91P0000", $arr);
                }
            } else {
                $sql = "Select IsCustomResource From D09T0000 WITH(NOLOCK) where IsCustomResource =1";
                $rs = $this->connectionHR->selectOne($sql);
                if (count($rs) > 0)
                    Session::set('IsCustomResource', 1);
                else Session::set('IsCustomResource', 0);
            }
            $product= intval(Config::get('database.LWProduct','0'));
            $countAlert = $this->connection->selectOne("EXEC W84P0010 '" . Session::get("W91P0000")['DivisionID'] . "', " . Session::get("W91P0000")['TranMonth'] . "," . Session::get("W91P0000")['TranYear'] . ",'$user', 0, '" . Session::get('Lang') . "','','$database','$subdatabase', $product")['NotificationNum'];
            $rData = $this->connection->select("EXEC W84P0010 '" . Session::get("W91P0000")['DivisionID'] . "', " . Session::get("W91P0000")['TranMonth'] . "," . Session::get("W91P0000")['TranYear'] . ",'$user', 1, '" . Session::get('Lang') . "','','$database','$subdatabase', $product");
            \Debugbar::info(isset($rData[0]["Param"]));
            $sql = "--Do nguon bookmark" . PHP_EOL;
            $sql .= "EXEC W91P8880  '$database', '$subdatabase','" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "','', $product";
            $rsBookmark = $this->connection->select($sql);
            $this->generalBookmark($rsBookmark, $ls1);
            $countBookmark = count($rsBookmark);
            \Debugbar::info(count($rsBookmark));
            View::share('countAlert', $countAlert);
            return View::make('home.index', compact("rData", "g", "ls1", "count", 'countBookmark'));
        } else {
            $level = 1;
            $logoM = "";
            $home_backM = "hide";
            return View::make('home.indexM', compact("g", "logoM", "home_backM", "level"));
        }
    }

    //tạo các bookmark
    private function generalBookmark($rsBookmark, &$ls1)
    {
        foreach ($rsBookmark as $row) {
            $fcall = $row["FormCall"];
            $factive = $row["FormActive"];
            $fid = $row["FormID"];
            $gMod = $row["ModuleGroup"];
            $mod = $row["ModuleID"];
            $fname = $row["FormName"];
            $ls1 .= '<li id="li' . $fid . '">';
            if ($row['IsTab'] == 1) {
                $ls1 .= "<a class='menuitem item-book' modulegroup='$gMod' formid='$fid' formactive='$factive' formcall='$fcall'>";
            } else {
                if ($factive == $fcall) {
                    $ls1 .= "<a class='item-book' formid='$fid' formactive='$factive' onclick='showFormDialog(\"" . asset("$fcall/$fid/$gMod") . "\",\"modal$fcall\")'>";
                } else {
                    $ls1 .= "<a class='item-book' formid='$fid' formactive='$factive' onclick='showFormDialog(\"" . asset("$factive/$fid/$fcall/$gMod/$mod") . "\",\"modalW84F2020\")'>";
                }
            }
            $ls1 .= '<i class="fa fa-star text-yellow hide"></i>';
            $ls1 .= "$fname</a>";
            $ls1 .= '</li>';
        }
    }

    public function checkLicense()
    {
        $rs = Helpers::checkLicensingTimer();
        if ($rs != 0) Auth::user()->logout();
        return $rs;

    }

    public function indexESS()
    {
        Session::set('modlogin', 1);
        if (Auth::ess()->check()) {
            $g = 4;
            $ls1 = "";
            return View::make('home.index', compact("g", "ls1"));
        } else {
            return Redirect::to("/esslogin");
        }

    }

    /*
     * $isApproval : trạng thái duyệt
     * $id: mã từng phiếu duyệt, mã master
     * $iddt: chưa sử dụng , mã detail
     * */
    public function viewMail($Form, $pForm, $g, $isApproval, $id = 'noID', $iddt = '')
    {
        //Get Alert
        $user = Auth::user()->user()->UserID;
        $product= intval(Config::get('database.LWProduct','0'));
        $database = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $subdatabase = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
        $countAlert = $this->connection->selectOne("EXEC W84P0010 '" . Session::get("W91P0000")['DivisionID'] . "', " . Session::get("W91P0000")['TranMonth'] . "," . Session::get("W91P0000")['TranYear'] . ",'$user', 0, '" . Session::get('Lang') . "','','$database','$subdatabase', $product")['NotificationNum'];
        View::share('countAlert', $countAlert);

        $FormCall = str_replace("D", "W", $pForm);
        $ModuleID = substr($pForm, 0, 3);
        if ($FormCall == $Form)
            $script = "showFormDialog('" . url("/$Form/$pForm/$g/$isApproval/$id/$iddt") . "','modal$Form');";
        else // trường hợp này dành cho quy trình duyệt nhiều cấp
			$script = "showFormDialog('" . url("/$Form/$pForm/$FormCall/$g/$ModuleID/$isApproval/$id/$iddt") . "','modalW84F2020');";
        $rData = $this->connection->select("EXEC W84P0010 '" . Session::get("W91P0000")['DivisionID'] . "', " . Session::get("W91P0000")['TranMonth'] . "," . Session::get("W91P0000")['TranYear'] . ",'$user', 1, '" . Session::get('Lang') . "','','$database','$subdatabase',$product");
        //BookMark
        $sql = "--Do nguon bookmark" . PHP_EOL;
        $sql .= "EXEC W91P8880  '$database', '$subdatabase','" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "', '', $product";
        $rsBookmark = $this->connection->select($sql);
        $this->generalBookmark($rsBookmark, $ls1);
        \Debugbar::info($script);
        //Return

        $countBookmark = count($rsBookmark);
        return View::make('home.index', compact('countBookmark','Form', 'pForm', 'g', "id", 'isApproval', 'iddt', 'script', 'rData', 'ls1'));

    }

    //Đây là làm mới của hàm viewMail
    public function mailLink($formType,$Form, $pForm, $g, $isApproval, $id = 'noID', $iddt = '')
    {
        //Get Alert
        $user = Auth::user()->user()->UserID;
        $product= intval(Config::get('database.LWProduct','0'));
        $database = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $subdatabase = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
        $countAlert = $this->connection->selectOne("EXEC W84P0010 '" . Session::get("W91P0000")['DivisionID'] . "', " . Session::get("W91P0000")['TranMonth'] . "," . Session::get("W91P0000")['TranYear'] . ",'$user', 0, '" . Session::get('Lang') . "','','$database','$subdatabase', $product")['NotificationNum'];
        View::share('countAlert', $countAlert);

        $FormCall = str_replace("D", "W", $pForm);
        $ModuleID = substr($pForm, 0, 3);
        switch ($formType){
            case "tab": //Open form dạng tab
                break;
            case "modal": //Open form dạng modal
                $script = "showFormDialog('" . url("/$Form/$pForm/$g/$isApproval/$id/$iddt") . "','modal$Form');";
                break;
            case "approval": //open những form duyệt nhiều cấp
                $script = "showFormDialog('" . url("/$Form/$pForm/$FormCall/$g/$ModuleID/$isApproval/$id/$iddt") . "','modalW84F2020');";
                \Debugbar::info($script);
                break;
        }
        $rData = $this->connection->select("EXEC W84P0010 '" . Session::get("W91P0000")['DivisionID'] . "', " . Session::get("W91P0000")['TranMonth'] . "," . Session::get("W91P0000")['TranYear'] . ",'$user', 1, '" . Session::get('Lang') . "','','$database','$subdatabase',$product");
        //BookMark
        $sql = "--Do nguon bookmark" . PHP_EOL;
        $sql .= "EXEC W91P8880  '$database', '$subdatabase','" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "', '', $product";
        $rsBookmark = $this->connection->select($sql);
        $this->generalBookmark($rsBookmark, $ls1);
        \Debugbar::info($script);
        //Return
        return View::make('home.index', compact('Form', 'pForm', 'g', "id", 'isApproval', 'iddt', 'script', 'rData', 'ls1'));

    }

    public function setLang($lang)
    {
        switch ($lang) {
            case 'en' :
                Session::set('Lang', '01');
                Session::set('i18n', 'en_US');
                Session::set('locate', 'en');
                break;
            case 'ja' :
                Session::set('Lang', '81');
                Session::set('i18n', 'jp_JP');
                Session::set('locate', 'ja');
                break;
            case 'zh' :
                Session::set('Lang', '86');
                Session::set('i18n', 'ch_CH');
                Session::set('locate', 'zh');
                break;
            default :
                Session::set('Lang', '84');
                Session::set('i18n', 'vi_VI');
                Session::set('locate', 'vi');
                break;
        }
        return 1;
    }

    public function alert()
    {
        $product= intval(Config::get('database.LWProduct','0'));
        $database = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $subdatabase = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
        $countAlert = $this->connection->selectOne("EXEC W84P0010 '" . Session::get("W91P0000")['DivisionID'] . "', " . Session::get("W91P0000")['TranMonth'] . "," . Session::get("W91P0000")['TranYear'] . ",'" . Auth::user()->user()->UserID . "', 0, '" . Session::get('Lang') . "', '', '$database', '$subdatabase', $product")['NotificationNum'];
        \Debugbar::info($countAlert);
        View::share('countAlert', $countAlert);
        return View::make('home.alert');
    }

    public function indexDivision()
    {
        $g = 0;
        $product= intval(Config::get('database.LWProduct','0'));
        return View::make('layout.component.changedivision', compact("g",'product'));
    }

    public function loadperiod()
    {
        $division = Input::get("div");
        $hrdivision = Input::get("hrdiv");
        $database = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $subdatabase = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
        $product= intval(Config::get('database.LWProduct','0'));
        $rs = $this->connection->select("EXEC W91P0001 '$database', '$subdatabase','" . Auth::user()->User()->UserID . "','$division', '$hrdivision', 2, $product");
        $data = "";
        foreach ($rs as $row) {
            $data .= "<option value='" . $row["TranYear"] . $row["TranMonth"] . "'>" . $row["Period"] . "</option>";
        }
        return $data;
    }

    public function infoForm($fcall)
    {
        $g = 0;
        $fname = Input::get("name");
        $pform = Input::get("pform", "");
        $factive = Input::get("factive", "");
        return View::make('layout.component.forminfo', compact("g", "factive", "fname", "pform", "fcall"));
    }

    public function bookmark()
    {
        $pform = Input::get("pform", "");
        $factive = Input::get("factive", "");
        $fcall = Input::get("fcall", "");
        $li = "";
        if (Request::isMethod("post")) {
            $product= intval(Config::get('database.LWProduct','0'));
            $sql = "--Add bookmark" . PHP_EOL;
            $sql .= "Insert Into D91T8880(";
            $sql .= "FormCall, UserID, FormID, FormActive, CreateDate";
            $sql .= ") Values (";
            $sql .= " N'$fcall', '" . Auth::user()->User()->UserID . "',  N'$pform',  N'$factive', getdate()) ";
            $this->connection->statement($sql);
            $database = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
            $subdatabase = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
            $sql = "--Do nguon bookmark" . PHP_EOL;
            $sql .= "EXEC W91P8880  '$database', '$subdatabase','" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "', '$pform', $product";
            $rsBookmark = $this->connection->select($sql);
            $this->generalBookmark($rsBookmark, $li);
        } else if (Request::isMethod("delete")) {
            $sql = "--Delete bookmark" . PHP_EOL;
            $sql .= "Delete From D91T8880 Where FormID = '$pform' And FormActive = '$fcall' And UserID = '" . Auth::user()->User()->UserID . "'";
            $this->connection->statement($sql);
        }
        return $li;
    }

    //Order display bookmark
    public function editBookmark()
    {
        $arr = Input::get("arr");
        $arrRemove = Input::get("arrRemove");
        $sql = "";
        $i = 1;
        if (is_array($arr) || is_object($arr)) {
            foreach ($arr as $row) {
                $sql .= "Update D91T8880 set DisplayOrder=$i Where FormID='" . $row[0] . "' and FormActive='" . $row[1] . "'" . PHP_EOL;
                $i++;
            }
        }
        if (is_array($arrRemove) || is_object($arrRemove)) {
            foreach ($arrRemove as $row) {
                $sql .= "Delete From D91T8880 Where FormID = '" . $row[0] . "' And FormActive = '" . $row[1] . "' And UserID = '" . Auth::user()->User()->UserID . "'" . PHP_EOL;
            }
        }

        if ($sql != "") $this->connection->statement($sql);
        $database = Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]);
        $subdatabase = Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database'));
        $product= intval(Config::get('database.LWProduct','0'));
        $sql = "--Do nguon bookmark" . PHP_EOL;
        $sql .= "EXEC W91P8880  '$database', '$subdatabase','" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "', '', $product";
        $rsBookmark = $this->connection->select($sql);

        \Debugbar::info(count($rsBookmark));

        return count($rsBookmark);
    }

    public function showFolder($mode)
    {
        return View::make('layout.component.foldertree', compact("mode"));
    }

    public function getDirectory()
    {
        $path = Input::get("dir");
        $mode = Input::get("mode");
        if ($mode == 0) {
            $extension = ["mp4","avi"];
            $reppath = urldecode(Config::get("services.path_video"));
            $path = urldecode(Config::get("services.path_video") . $path);
            $str = scanDir::create_tree($path, $reppath, $extension);
        } else {
            $extension = ["mp3"];
            $reppath = urldecode(Config::get("services.path_audio"));
            $path = urldecode(Config::get("services.path_audio") . $path);
            $str = scanDir::create_tree($path, $reppath, $extension);
        }
        return $str;
    }

}
