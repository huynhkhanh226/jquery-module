<?php
namespace W9X\W93;

use Config;
use Input;
use Excel;
use Request;
use View;

use Debugbar;

class W93F2310Controller extends \BaseController
{
    /**
     * @param $pFrom
     * @param $g
     * @return \Illuminate\View\View
     */

    public function index($pFrom, $g)
    {
        if(Request::isMethod('post')) {

            if (Input::hasFile('FileW93F3210'))
            {
                $filename = Input::file('FileW93F3210')->getClientOriginalName();
                Input::file('FileW93F3210')->move(Config::get('app.path_import'), $filename);
                $filepath= Config::get('app.path_import') . "/" .  $filename;

                $rs=Excel::load($filepath, function($reader)  {

                })->toArray();

                $result=[];
                foreach($rs as $r) {
                    $result[]= array_values($r);
                }

                return $result;
            }
            else return [];

        }

        return View::make('W9X.W93.W93F2310');
    }

}
