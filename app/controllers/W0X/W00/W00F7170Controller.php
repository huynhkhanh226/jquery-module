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

class W00F7170Controller extends W0XController {

    public function index() {
        $show='hide';
        $message='';
        //var_dump('da chay');die;
        if (Request::isMethod('post')) {

            \Debugbar::info(Input::all());
            $doc = Input::get('doc', "off") == "on" ? true : false;
            $docx = Input::get('docx', "off") == "on" ? true : false;
            $xls = Input::get('xls', "off") == "on" ? true : false;
            $xlsx = Input::get('xlsx', "off") == "on" ? true : false;
            $jpeg = Input::get('jpeg', "off") == "on" ? true : false;
            $png = Input::get('png', "off") == "on" ? true : false;
            //$jpg = Input::get('jpg', "off") == "on" ? true : false;
            $pdf = Input::get('pdf', "off") == "on" ? true : false;
            $txt = Input::get('txt', "off") == "on" ? true : false;
            $rar = Input::get('rar', "off") == "on" ? true : false;
            $zip = Input::get('zip', "off") == "on" ? true : false;
            $fileSize = Input::get('FileSize', 0);

            try {
                Config::write('attachment.fileExtension.doc.val',$doc);
                Config::write('attachment.fileExtension.docx.val',$docx);
                Config::write('attachment.fileExtension.xls.val',$xls);
                Config::write('attachment.fileExtension.xlsx.val',$xlsx);
                Config::write('attachment.fileExtension.jpeg.val',$jpeg);
                Config::write('attachment.fileExtension.png.val',$png);
                Config::write('attachment.fileExtension.jpg.val',$jpeg);
                Config::write('attachment.fileExtension.pdf.val',$pdf);
                Config::write('attachment.fileExtension.txt.val',$txt);
                Config::write('attachment.fileExtension.rar.val',$rar);
                Config::write('attachment.fileExtension.zip.val',$zip);
                Config::write('attachment.fileExtension.zip1.val',$zip);
                Config::write('attachment.fileSize', $fileSize);
                $message='Update Success';
            }
            catch(Exception $e){
                $message='An error occurred';
            }


            return $message;
        } else
        return View::make('W0X.W00.W00F7170',compact('show','message'));
    }
}
