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

class W00F7150Controller extends W0XController {

    public function index() {
        $message='';
        if(Request::isMethod('post')) {
            $input =  Input::all();
            try {
                Config::write('birt.BIRTCallingMode',$input['optBIRTCallingMode']);
                Config::write('birt.TomcatServer',$input['idTomcatServer']);
                if ($input['optBIRTCallingMode'] == "VP" || $input['optBIRTCallingMode'] == "VT"){
                    Config::write('birt.BIRTServerURL',$input['idTomcatServer'].'/birt-viewer/');
                }else{
                    Config::write('birt.BIRTServerURL',$input['idTomcatServer']);
                }
                Config::write('birt.ViewMode',$input['optViewMode']);
                $message='Update Success';
            }catch(Exception $e){
                    $message='An error occurred';
            }
            return $message;
        }
        else
            return View::make('W0X.W00.W00F7150',compact('message'));



    }
}
