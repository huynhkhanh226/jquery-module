<?php
namespace W7X\W76;
use Auth;
use DB;
use Session;
use View;
use W7X\W7XController;

class W76F0000Controller extends W7XController {

    public function index($pFrom,$g) {

        return View::make("W7X.W76.W76F0000",compact('pFrom','g'));
    }
}
