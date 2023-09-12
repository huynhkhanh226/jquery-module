<?php
namespace W7X\W76;

use Debugbar;
use Helpers;
use Request;
use Session;
use View;
use Input;
use Auth;
use W7X\W7XController;

class W76F4060Controller extends W7XController
{
    public function index($pForm,$g)
    {
        $per = Session::get($pForm,-1);
        if (Request::isMethod('post')) {
            $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
            $category = Input::get("slDocCategoryID", "%");
            $find = $this->sqlstring(Input::get("txtStrFind", ""));
            $sql = "--Do nguon luoi" . PHP_EOL;
            $sql .= "EXEC W76P4060  N'$category', '$user', N'$find'";
            $rsData = $this->connectionHR->select($sql);
            return View::make("W7X.W76.W76F4060_Ajax", compact('g', "rsData", 'per'));
        }
        $caption = $this->getModalTitle("D76F4060");
        $rsCategory = [];
        if ($per==-1){
            $sql = "SELECT DocCatID, DocCategoryName FROM D76T2070 WITH(NOLOCK) Where Disabled=0";
            $rsCategory = $this->connectionHR->select($sql);
        }
        return View::make("W7X.W76.W76F4060", compact('g', 'caption', 'rsCategory', 'per'));
    }

    public function getFile()
    {
        $id = Input::get("id");
        $user = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;
        $query = "Select Content, FileName From D76T2060 With(Nolock) Where DocID = $id";
        $rs = $this->connectionHR->select($query);
        if ($rs[0]['Content'] != '') {
            $content = pack('H' . strlen($rs[0]['Content']), $rs[0]['Content']);
            $filename = $user."_".date("Ymdhis", time()) ."_". $rs[0]['FileName'];
            $filePath = public_path() . "\\Temp\\" . $filename;
            $handle = fopen($filePath, "a+");
            fwrite($handle, $content);
            return "Temp/$filename";
        }
    }
}
