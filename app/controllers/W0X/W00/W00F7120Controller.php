<?php
namespace W0X\W00;

use Config;
use Input;
use Lang;
use Redirect;
use Request;
use Session;
use View;
use W0X\W0XController;

class W00F7120Controller extends W0XController {
    public function __construct()
    {
        parent::__construct(0);
    }
    public function index(){
        $err_text="";
        $hide="hide";
        if (Session::get("AdminAuth")!=true)
            return Redirect::to("/adminlogin");
        if(Request::isMethod("post")) {
            $password = md5(Input::get("oldpassword"));
            $p=Config::get('database.PassAdmin');
            if ($password!=$p)
            {
                $hide="";
                $err_text=Lang::get('message.Mat_khau_cu_khong_dung');
            }
            else
            {
                $newpass = md5(Input::get("newpassword"));
                $confpass = md5(Input::get("confirmpassword"));
                if ($newpass!=$confpass)
                {
                    $hide="";
                    $err_text=Lang::get('message.Mat_khau_moi_va_lap_lai_khong_giong_nhau');
                }
                else
                {
                    Config::write('database.PassAdmin',"$newpass");
                    return Redirect::route("adminW00F7111");

                }
            }
        }
        return View::make("W0X.W00.W00F7120",compact("err_text","hide"));
    }
}
