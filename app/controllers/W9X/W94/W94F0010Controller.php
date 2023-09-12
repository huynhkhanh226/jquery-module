<?php
namespace W9X\W94;

use DB;
use Exception;
use Request;
use View;
use W9X\W9XController;

class W94F0010Controller extends W9XController {
    public  function index($pFrom,$g)
    {

       if(Request::isMethod('post')) {
            try {
                $count=\D94T0000::count();
                if($count==1) {
                    DB::statement("UPDATE D94T0000 set ReportViewerURL='".\Input::get("ReportViewerURL")."'");
                }
                else {
                    DB::statement("INSET INTO D94T0000(ReportViewerURL) VALUES ('".\Input::get("ReportViewerURL")."')");
                }

                return 1;
            }
            catch (Exception $ex) {
                \Debugbar::info($ex);
                return 0;
            }
        }
        return View::make("W9X.W94.W94F0010",compact('pFrom','g'));
    }
}
