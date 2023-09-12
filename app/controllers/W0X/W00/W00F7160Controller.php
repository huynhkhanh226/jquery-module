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

class W00F7160Controller extends W0XController {

    public function index() {

        $show='hide';
        $message='';
        $sql = "select * from D91T2600";//select DL mail để gán giá trị lên form
        $rs = $this->connection->select($sql);
        $mailURL = '';
        if(count($rs) > 0){
            $mailURL = $rs[0]['LemonWebLink'];
        }
        if(Request::isMethod('post')) {
            $do= Input::get('do',"");
            $mail =  Input::all();
            \Debugbar::info(Input::all());
            if($do=='systemsetup') {

                //NGUYEN TUAN ANH update mail server 15/04/2016
                //luu mail.php
                Config::write('mail.host',$mail['txtAddress']);
                Config::write('mail.username',\Helpers::encrypt_userpass($mail['txtEmail']));
                Config::write('mail.password',\Helpers::encrypt_userpass($mail['txtPasswordEmail']));
                //Config::write('mail.url',$mail['txtURLEmail']);

                $rdW00F7160 = Input::get('rdW00F7160',"");
                if($rdW00F7160=='ssl')
                {
                    config::write('mail.encryption', $mail['rdW00F7160']);
                    Config::write('mail.port',$mail['txtSSL']);
                }
                else if($rdW00F7160=='tls')
                {
                    config::write('mail.encryption', $mail['rdW00F7160']);
                    Config::write('mail.port', $mail['txtTLS']);
                }
                else {
                    config::write('mail.encryption', $mail['rdW00F7160']);
                    Config::write('mail.port', $mail['txtNoneSSL']);
                }
                $sql = "select * from D91T2600";
                $rsCheck = $this->connection->select($sql);// kiểm tra xem có tồn tại URL hay chưa
                \Debugbar::info($rsCheck);
                if(count($rsCheck) > 0){//có tồn tại thì update
                    $sql = "UPDATE D91T2600 SET LemonWebLink = '".$mail['txtURLEmail']."'";
                    $this->connection->statement($sql);
                }else{// ko thì insert
                    $sql = "insert into D91T2600 (LemonWebLink) values('".$mail['txtURLEmail']."')";
                    $this->connection->statement($sql);
                }
//                //Luu session.php, service.php
//                $sto= floatval(Input::get('session_timeout'));
//                $wcf_url= Input::get('wcf_url');
//                Config::write('session.lifetime',"$sto");
//                Config::write('services.diginet.url',"$wcf_url");
//                $file = Input::file('logo');
//                //save birt setting
//                Config::write('birt.method',$mail["cboBirtMethod"]);
                try {
//                    if (Input::hasFile('logo'))
//                    {
//
//                        $file->move(public_path('/packages/default/L3/images'),"companylogo-large.png");
//                    }
                    $message='Update Success';
                }
                catch(Exception $e){
                    $message='';
                }


                return $message;
            }
            else
              return  $show='An error occurred';

        }
        else

            $mailServer = Config::get('mail.host');
            return View::make('W0X.W00.W00F7160',compact('mailServer','show','message', 'mailURL'));



    }
}
