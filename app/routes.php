<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::any('/configdb', array( 'as' => 'login',  'uses' => 'AuthController@configdb'));
Route::any('/login', array( 'as' => 'login',  'uses' => 'AuthController@login'));
Route::any('/checklogin/{task}', array( 'as' => 'checklogin',  'uses' => 'AuthController@checkLogin'));

Route::any('/esslogin', array( 'as' => 'esslogin',  'uses' => 'AuthController@esslogin'));
Route::any('/logout', array('as' => 'logout', 'uses' => 'AuthController@logout'));
Route::any('/logoutpage', array('as' => 'logout', 'uses' => 'AuthController@returnLogout'));
Route::any('/esslogout', array('as' => 'esslogout', 'uses' => 'AuthController@esslogout'));
Route::any('/', array('before' => 'auth', 'as' => 'indexhomepage', 'uses' => 'HomeController@index'));
Route::any('/checklicence', array('before' => 'auth', 'as' => 'indexhomepage', 'uses' => 'HomeController@checkLicense'));

Route::get('/esshome', array('before' => 'auth', 'as' => 'esshome', 'uses' => 'HomeController@indexESS'));
// thiết lập ngôn ngữ
Route::get('/setLang/{lang}', array( 'as' => 'home', 'uses' => 'HomeController@setLang'));

Route::get('/alert', array( 'as' => 'home.alert', 'uses' => 'HomeController@alert'));

//Load popup Đơn vị và load lại combo Kỳ
Route::get('/changedivision', array( 'as' => 'home', 'uses' => 'HomeController@indexDivision'));
Route::post('/loadperiod', array( 'as' => 'home', 'uses' => 'HomeController@loadperiod'));

//SEND MAIL
Route::any('/SendMail', array('before' => 'auth', 'as' => 'sendmail', 'uses' => 'BaseController@SendMail'));

Route::any('/Export', array('before' => 'auth', 'as' => 'export', 'uses' => 'BaseController@ExportFile'));

Route::any('/templateexcel', array('before' => 'auth', 'as' => 'export', 'uses' => 'BaseController@TemplateExcel'));

//Xem file excel online
Route::any('/unzip/{mod}/{g}/{tablename}/{attid}' , array( 'before' => 'auth', 'as' => 'login',  'uses' => 'BaseController@unzip'));
//Xem file excel online
Route::any('/attachment/{mod}/{g}/{tablename}/{attid}' , array( 'before' => 'auth', 'as' => 'login',  'uses' => 'BaseController@viewAttachment'));


//Delete temp file
Route::any('/audit' , array( 'before' => 'auth', 'as' => 'login',  'uses' => 'BaseController@audit'));

Route::any('/viewmail/{formCall}/{pForm}/{g}/{isApproval}/{id}/{iddt?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'HomeController@viewMail'));
//Vì router viewmail ko chạy được trường hợp formcall khác form phân quyền, nên sinh ra router newmail
Route::any('/maillink/{formType}/{formCall}/{pForm}/{g}/{isApproval}/{id}/{iddt?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'HomeController@mailLink'));

//Form thông tin màn hình
Route::any('/info/{fcall}', array('before' => 'auth', 'uses' => 'HomeController@infoForm'));
Route::any('/bookmark', array('before' => 'auth', 'uses' => 'HomeController@bookmark'));
Route::post('/editbook', array('before' => 'auth', 'uses' => 'HomeController@editBookmark'));
Route::get('/showFolder/{mode}', array('before' => 'auth', 'uses' => 'HomeController@showFolder'));
Route::post('/getDirectory', array('before' => 'auth', 'uses' => 'HomeController@getDirectory'));

//Admin
Route::any('/adminlogin', array( 'as' => 'login',  'uses' => 'AuthController@adminlogin'));

//Load combo Kỳ theo Đơn vị
Route::any('/loadperiod/{mod}/{division}', array( 'as' => 'login',  'uses' => 'BaseController@LoadComboPeriod'));


$routePartials = ['W0X','W1X', 'W2X', 'W3X', 'W4X', 'W5X', 'W6X', 'W7X', 'W8X', 'W9X', 'ZXX'];

/** Route Partial Loadup
=================================================== */

foreach ($routePartials as $route) {

    $file = __DIR__.'/routes/'.$route.'.php';

    if ( ! file_exists($file))
    {
        $msg = "Route partial [{$route}] not found.";
        throw new \Illuminate\Filesystem\FileNotFoundException($msg);
    }

    require_once $file;
}

//lemonweb link
Route::any('/updatesetting/{data?}', array( 'as' => 'login',  'uses' => 'WebLinkController@updateSettings'));
Route::any('/callback', array('as' => 'callback',  'uses' => 'WebLinkController@callback'));
Route::any('/weblink', array('before' => 'auth', 'as' => 'weblink',  'uses' => 'WebLinkController@index'));


