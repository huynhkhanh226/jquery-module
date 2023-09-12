<?php
namespace W3X;

class W3XController extends \BaseController {
    public function sqlstring($str)
    {
        $str = str_replace("'", "''", $str);
        return $str;
    }
}
