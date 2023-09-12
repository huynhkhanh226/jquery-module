<?php
/**
 * Created by PhpStorm.
 * User: THANHLUAN
 * Date: 9/10/2015
 * Time: 12:04 PM
 */

Route::group(['namespace' => 'W4X\W49'], function() {
    //Duyệt chấp thuận phát sinh
    Route::any('/W49F2009/detail/{vou}/{g}/{isApproval}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W49F2009Controller@detail'));
    Route::any('/W49F2009/{pForm}/{g}/{isApproval?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W49F2009Controller@index'));

    //Duyệt chấp thuận phát sinh
    Route::any('/W49F2222/detail/{vou}/{g}/{isApproval}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W49F2222Controller@detail'));
    Route::any('/W49F2222/{pForm}/{g}/{isApproval?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W49F2222Controller@index'));
});

Route::group(['namespace' => 'W4X\W47'], function() {
    //Báo cáo dòng tiền theo ngày
    Route::any('/W47F3000/showRows', array('before' => 'auth', 'as' => 'W47F3000',  'uses' => 'W47F3000Controller@showRows'));
    Route::any('/W47F3000/view/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W47F3000',  'uses' => 'W47F3000Controller@index'));
    Route::post('/W47F3001/{task}', array('before' => 'auth', 'as' => 'W47F3001',  'uses' => 'W47F3001Controller@index'));
    Route::any('/W47F3002/{mode?}', array('before' => 'auth', 'as' => 'W47F3002',  'uses' => 'W47F3002Controller@index'));
	//Báo cáo dòng tiền theo tháng
    Route::get('/W47F3010/loadProject', array('before' => 'auth', 'as' => 'W47F3010',  'uses' => 'W47F3010Controller@reLoadProject'));
    Route::any('/W47F3010/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'W47F3010',  'uses' => 'W47F3010Controller@index'));
});