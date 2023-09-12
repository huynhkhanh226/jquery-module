<?php
namespace W0X\W00;

use Auth;
use D00T0000;
use D00T0030;
use Helpers;
use Input;
use Lang;
use Request;
use View;
use W0X\W0XController;

class W00F0253Controller extends W0XController
{


    // THAY ĐỔI MẬT KHẨU
    public function index($action, $id)
    {
        $pconfig = D00T0000::first();
        \Debugbar::info($pconfig);
        $required = "";
        $g = 0;
        if ($pconfig['PMinLength'] > 0) {
            $required .= Lang::get('message.Do_dai_mat_khau_toi_thieu_phai_bang') . " " . $pconfig['PMinLength'] . ".";
        }
        if ($pconfig['UseSpecialChar'] > 0) {
            $required .= Lang::get('message.Mat_khau_phai_chua_ki_tu_dac_biet') . ".";
        }

        if (Request::isMethod("post")) {
            $us = D00T0030::where("UserID", $id)->first();
            $us['UserPassword'] = Helpers::encrypt_userpass(Input::get('password'));
            $us->save();
            return 1;
        }
        return View::make("W0X.W00.W00F0253", compact("pconfig", "action", "id", "required", 'g'));

    }

    public function checkOldPass()
    {
        $oldpassword = Input::get("oldpassword");
        $user = Input::get('user','');
        $pass =  $us = D00T0030::where("UserID", $user)->select("UserPassword")->first()['UserPassword'];
        if (Helpers::encrypt_userpass($oldpassword) != $pass) return 0;
        else return 1;
    }
}
