<?php
/**
 * Created by PhpStorm.
 * User: THANHLUAN
 * Date: 9/10/2015
 * Time: 12:04 PM
 */

Route::group(['namespace' => 'W9X\W90'], function () {
    Route::any('/W90F0110/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W90F0110Controller@index'));
    Route::any('/W90F0120/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W90F0120Controller@index'));
    Route::any('/W90F1300/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W90F1300Controller@index'));
    Route::any('/W90F1301/{mode}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W90F1301Controller@index'));
    Route::any('/W90F1302/', array('before' => 'auth', 'as' => 'home', 'uses' => 'W90F1302Controller@index'));

    //PHân tích chỉ số tài chính
    Route::any('/W90F4718/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W90F4718', 'uses' => 'W90F4718Controller@index'));
});

Route::group(['namespace' => 'W9X\W94'], function () {
    // THIẾT LẬP MODULE HỆ THÔNG THÔNG TIN QUẢN TRỊ
    Route::get("/W94F0010/view/{pForm}/{g}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F0010Controller@index'));
    Route::post("/W94F0010/Save/{pForm}/{g}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F0010Controller@index'));

    // HE THONG THON TIN QUAN TRI
    Route::get('/W94F1200/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F1200Controller@index'));
    Route::get('/W94F1200/view/{pForm}/{g}/ajax', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F1200Controller@indexAjax'));
    Route::get('/W94F1200/{pForm}/{action}/{id?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F1200Controller@Action'));
    Route::post('/W94F1200/{pForm}/{action}/{id?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F1200Controller@postAction'));


    Route::any('/W94F3000/{pForm}/{g}/reporttype', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F3000Controller@loadReportType'));
    Route::any('/W94F3000/{pForm}/{g}/getticket', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F3000Controller@getTicket'));
    Route::any('/W94F3000/{pForm}/{g}/birt/callservice', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F3000Controller@restClient'));
    Route::any('/W94F3000/{pForm}/{g}/birt/exportservice', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F3000Controller@exportService'));
    Route::any('/W94F3000/{pForm}/{g}/{id?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F3000Controller@index'));
    Route::any('/W94F4050/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F4050Controller@index'));
    Route::any('/W94F4002/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F4002Controller@index'));
    Route::any('/W94F4001/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F4001Controller@index'));

    Route::any('/W94F1000/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F1000Controller@index'));
    Route::any('/W94F1000/view/{pForm}/{g}/ajax', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F1000Controller@indexAjax'));
    Route::get('/W94F1000/{pForm}/{action}/{id?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F1000Controller@Action'));
    Route::post('/W94F1000/{pForm}/{action}/{id?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W94F1000Controller@postAction'));

});
Route::group(['namespace' => 'W9X\W93'], function () {
    Route::any('/W93F2310/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W93F2310Controller@index'));
});
//Đính kèm
//Route::any("/W91F4010", array('before' => 'auth', 'as' => 'home', 'uses' => 'BaseController@getAttachFile'));

//Get file attachment
Route::get('/W91F4010/attachment/{mod}/{g}/{tablename}/{attid}', function ($mod,$g,$tablename, $attid ) {
    if ($g == 4) {
        $query = "EXEC W91P1014 '" . Session::get("W91P0000")['DivisionID'] . "', '$mod', '$tablename', '" . Helpers::decrypt_userpass(Config::get('database.connections.sqlsrvHR.database')) . "', '$attid', '', '', '', ''";
		$rs = DB::connection("sqlsrvHR")->selectOne($query);
    } else {
        $query = "EXEC W91P1014 '" . Session::get("W91P0000")['DivisionID'] . "', '$mod', '$tablename', '" . Helpers::decrypt_userpass(Session::get("CONDEFAULT")["database"]) . "', '$attid', '', '', '', ''";
        \Debugbar::info($query);
        $rs = DB::connection("CONDEFAULT")->selectOne($query);
    }

    if ($rs['Content'] == '') return '';
    $filename = $rs['FileName'];
    $content = pack('H' . strlen($rs['Content']), $rs['Content']);
    header("Cache-Control: no-cache private");
    header("Content-Description: File Transfer");
    header('Content-disposition: attachment; filename=' . $filename);
    header("Content-Type: " . Helpers::get_content_type($filename));
    header("Content-Transfer-Encoding: binary");
    header('Content-Length: ' . strlen($content));
    echo $content;
    exit;

});

