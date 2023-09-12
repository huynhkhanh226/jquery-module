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

class W76F4070Controller extends W7XController
{
    public function index($pForm,$g, $task="")
    {

        $userid = (Auth::user()->check()) ? Auth::user()->user()->UserID : Auth::ess()->user()->UserID;

        switch ($task){
            case "":
                $caption = $this->getModalTitle("D76F4070");
                $sql = "--Do nguon trang thai" . PHP_EOL;
                $sql .= "EXEC W76P2021 '" . Auth::user()->User()->UserID . "','" . Session::get('Lang') . "', 'TaskStatus', 1";
                $status = $this->connectionHR->select($sql);
                return View::make("W7X.W76.W76F4070", compact('g','pForm' ,'caption', 'status'));
                break;
            case "post":
                $status = Input::get('slTaskStatus', '');
                $view = intval(Input::get('optViewMode', 0));
                $datefrom = Helpers::convertDate(Input::get('datef', ''));
                $dateto = Helpers::convertDate(Input::get('datet', ''));
                $sql = "--Do nguon luoi" . PHP_EOL;
                $sql .= "EXEC W76P2020 '$userid','" . Session::get('Lang') . "', '$status', $datefrom, $dateto, $view, 0";
                $rs = $this->connectionHR->select($sql);
                return json_encode($rs);
                break;
            case "delete":
                \Debugbar::info('vinh');
                $id = Input::get('id','');
                $rsCheck = $this->checkW76P5555('D','W76F4070','',$id);
                if ($rsCheck['Status'] == 1){
                    return json_encode($rsCheck);
                }
                $sql ="--Xoa du lieu".PHP_EOL;
                $sql .="Delete From D76T2050 Where TaskID = $id";
                $this->connectionHR->statement($sql);
                return json_encode($rsCheck);
                break;
        }
        if (Request::isMethod('post')) {

        } elseif (Request::isMethod('delete')) {

        }

    }
}
