<?php
/**
 * Created by PhpStorm.
 * User: THANHHUYEN
 * Date: 22/11/2016
 * Time: 14:04 PM
 */

//Các màn hình Phượng Hoàng
Route::group(['namespace' => 'ZXX\PH'], function () {
    //Hồ sơ nhân viên
    Route::any('/W09F1920/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'W09F1920', 'uses' => 'W09F1920Controller@index'));
    Route::any('/W09F1921/{pForm}/{action}', array('before' => 'auth', 'as' => 'W09F1921', 'uses' => 'W09F1921Controller@index'));
    //Báo cáo thời gian biểu theo nhân viên
    Route::any('/W09F4290/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'W09F4290', 'uses' => 'W09F4290Controller@index'));
    //Báo cáo thời gian biểu theo dự án
    Route::any('/W09F4291/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'W09F4291', 'uses' => 'W09F4291Controller@index'));
    //Báo cáo thời gian biểu theo khách hàng và dự án
    Route::any('/W09F4292/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'W09F4292', 'uses' => 'W09F4292Controller@index'));

    //Đang ky timesheet
    Route::any("/W09F2920/{pForm}/{g}/{task?}",array('before' => 'auth', 'as' => 'W09F2920', 'uses' => 'W09F2920Controller@index'));
    //Duyet timesheet
    Route::any("/W09F2921/{pForm}/{g}/{task?}",array('before' => 'auth', 'as' => 'W09F2921', 'uses' => 'W09F2921Controller@index'));
});
