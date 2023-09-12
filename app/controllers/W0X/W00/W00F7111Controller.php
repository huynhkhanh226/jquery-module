<?php
namespace W0X\W00;

use File;
use Input;
use Request;
use Session;
use View;
use W0X\W0XController;
use Redirect;
use Config;
//use Config_new;

class W00F7111Controller extends W0XController {

    function index()
    {
        $err_text="";
        if (Session::get("AdminAuth")===true) {

            //cap nhat Resource file Lang
            $show = 'hide';
            if (Request::isMethod('POST')) {

                    $sql = 'SELECT * FROM D09T1000 WITH(NOLOCK) WHERE CodeTable =1';
                    $rs = $this->connectionHR->select($sql);
                    $vi_cont = File::get(app_path() . "/lang/vi/message.php");
                    $en_cont = File::get(app_path() . "/lang/en/message.php");
                    $ja_cont = File::get(app_path() . "/lang/ja/message.php");
                    $zh_cont = File::get(app_path() . "/lang/zh/message.php");
                    foreach ($rs as $row) {
                        $vi_cont = str_replace($row['Lemon3Name'], $row['CustomName'], $vi_cont);
                        $vi_cont = str_replace(mb_strtolower($row['Lemon3Name']), mb_strtolower($row['CustomName']), $vi_cont);
                        $vi_cont = str_replace(mb_strtoupper($row['Lemon3Name']), mb_strtoupper($row['CustomName']), $vi_cont);

                        $en_cont = str_replace($row['Lemon3Name01'], $row['CustomName01'], $en_cont);
                        $en_cont = str_replace(mb_strtolower($row['Lemon3Name01']), mb_strtolower($row['CustomName01']), $en_cont);
                        $en_cont = str_replace(mb_strtoupper($row['Lemon3Name01']), mb_strtoupper($row['CustomName01']), $en_cont);

                        $ja_cont = str_replace($row['Lemon3Name81'], $row['CustomName81'], $ja_cont);
                        $ja_cont = str_replace(mb_strtolower($row['Lemon3Name81']), mb_strtolower($row['CustomName81']), $ja_cont);
                        $ja_cont = str_replace(mb_strtoupper($row['Lemon3Name81']), mb_strtoupper($row['CustomName81']), $ja_cont);

                        $zh_cont = str_replace($row['Lemon3Name86'], $row['CustomName86'], $zh_cont);
                        $zh_cont = str_replace(mb_strtolower($row['Lemon3Name86']), mb_strtolower($row['CustomName86']), $zh_cont);
                        $zh_cont = str_replace(mb_strtoupper($row['Lemon3Name86']), mb_strtoupper($row['CustomName86']), $zh_cont);
                    }
                    File::put(app_path() . "/lang/vi/custom.php", $vi_cont);
                    File::put(app_path() . "/lang/en/custom.php", $en_cont);
                    File::put(app_path() . "/lang/ja/custom.php", $ja_cont);
                    File::put(app_path() . "/lang/zh/custom.php", $zh_cont);

                    return $err_text = 'Update Success';

            }
            else
                return View::make("W0X.W00.W00F7111", compact("err_text", 'show'));
        }
        else
            return Redirect::to("/adminlogin");
    }
	
	function logout()
    {
		Session::forget('AdminAuth');
		return Redirect::to("/adminlogin");
    }

    function config(){
        \Debugbar::info('da chay config');
        \Debugbar::info(Config::get('services'));
        //Config::write('services.ab', 'test');
        //$this->config('custom.config');
    }
}
