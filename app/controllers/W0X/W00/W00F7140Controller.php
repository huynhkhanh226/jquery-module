<?php
namespace W0X\W00;

use Config;
use Exception;
use File;
use Input;
use Redirect;
use Request;
use Session;
use View;
use W0X\W0XController;

class W00F7140Controller extends W0XController
{

    public function index()
    {
        $show = 'hide';
        $message = '';
        if (Request::isMethod('post')) {
            try {
                //Luu session.php, service.php
                $sto = floatval(Input::get('session_timeout'));
                $connect_interval = floatval(Input::get('connect_interval'));
                $wcf_url = Input::get('wcf_url');
                $pathaudio = str_replace("/", "\\", Input::get('txtPathAudio'));
                $pathvideo = str_replace("/", "\\", Input::get('txtPathVideo'));
                if (substr($pathvideo, -1) != "\\")
                    $pathvideo .= "\\";
                if (substr($pathaudio, -1) != "\\")
                    $pathaudio .= "\\";
                $pathvideo = str_replace("\\", "%5C", $pathvideo);
                $pathaudio = str_replace("\\", "%5C", $pathaudio);
                $lgJpan = Input::get('chkJapanese', "off") == "on" ? true : false;
                $lgChna = Input::get('chkChinese', "off") == "on" ? true : false;
                $showW75 = Input::get('chkShowW75', "off") == "on" ? true : false;
                $showW76 = Input::get('chkShowW76', "off") == "on" ? true : false;
                Config::write('session.lifetime', "$sto");
                Config::write('services.path_video', $pathvideo);
                Config::write('services.path_audio', $pathaudio);
                Config::write('services.diginet.url', "$wcf_url");
                Config::write('services.diginet.connect_interval', "$connect_interval");
                Config::write('services.enableLanguage.showJapanese', $lgJpan);
                Config::write('services.enableLanguage.showChinese', $lgChna);
                Config::write('services.showModule.W75', $showW75);
                Config::write('services.showModule.W76', $showW76);
                $file = Input::file('logo');
                //save birt setting
    //                Config::write('birt.method',$mail["cboBirtMethod"]);
                if (Input::hasFile('logo')) {
                    $file->move(public_path('/packages/default/L3/images'), "companylogo-large.png");
                }

                //Luu display config...
                $header_color = Input::get('txtHeaderColor', '#FFFFFF'); //'#FFFFFF'
                $header_color_h = Input::get('txtHeaderColorFocus', '#FFFFFF'); //'#FFFFFF'
                $header_bgcolor = Input::get('txtHeaderBgColor', '#3C8DBC'); //#3C8DBC
                $header_bgcolor_h = Input::get('txtHeaderBgColorFocus', '#2C3B41'); //#2C3B41

                $sidebar_fcolor = Input::get('txtMenuLeftColor', '#B8C7CE'); //#B8C7CE
                $sidebar_fcolor_h = Input::get('txtMenuLeftColorFocus', '#FFFFFF'); //#FFFFFF

                $sidebar_fbgcolor = Input::get('txtMenuLeftBgColor', '#222D32'); //#222D32
                $sidebar_fbgcolor_h = Input::get('txtMenuLeftBgColorFocus', '#1E282C'); //#1E282C

                $sidebar_lcolor = Input::get('txtMenuLeftColorChild', '#8AA4AF'); //#8AA4AF
                $sidebar_lcolor_h = Input::get('txtMenuLeftColorChildFocus', '#FFFFFF'); //#FFFFFF

                $sidebar_lbgcolor = Input::get('txtMenuLeftBgColorChild', '#2C3B41'); //#2C3B41
                $sidebar_lbgcolor_h = Input::get('txtMenuLeftBgColorChildFocus', ''); //''

                $sidebar_iconcolor = Input::get('txtMenuLeftIconColor', ''); //''
                $sidebar_iconcolorchild = Input::get('txtMenuLeftIconColorChild', ''); //''

                Config::write('display.header_color', "$header_color");
                Config::write('display.header_color_h', "$header_color_h");

                Config::write('display.header_bgcolor', "$header_bgcolor");
                Config::write('display.header_bgcolor_h', "$header_bgcolor_h");

                Config::write('display.sidebar_fcolor', "$sidebar_fcolor");
                Config::write('display.sidebar_fcolor_h', "$sidebar_fcolor_h");

                Config::write('display.sidebar_fbgcolor', "$sidebar_fbgcolor");
                Config::write('display.sidebar_fbgcolor_h', "$sidebar_fbgcolor_h");

                Config::write('display.sidebar_lcolor', "$sidebar_lcolor");
                Config::write('display.sidebar_lcolor_h', "$sidebar_lcolor_h");

                Config::write('display.sidebar_lbgcolor', "$sidebar_lbgcolor");
                Config::write('display.sidebar_lbgcolor_h', "$sidebar_lbgcolor_h");

                Config::write('display.sidebar_iconcolor', "$sidebar_iconcolor");
                Config::write('display.sidebar_iconcolor_h', Input::get('txtMenuLeftIconColorFocus', ''));

                Config::write('display.sidebar_iconcolorchild', "$sidebar_iconcolorchild");
                Config::write('display.sidebar_iconcolorchild_h', Input::get('txtMenuLeftIconColorChildFocus', ''));

                $message = 'Update Success';
            } catch (Exception $e) {
                $message = '';
            }

            return $message;
        } else
            return View::make('W0X.W00.W00F7140', compact('show', 'message'));
    }
}
