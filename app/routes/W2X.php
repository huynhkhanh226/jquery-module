<?php
/**
 * Created by PhpStorm.
 * User: THANHLUAN
 * Date: 9/10/2015
 * Time: 12:04 PM
 */


Route::group(['namespace' => 'W2X\W27'], function() {

    // Duyệt phiếu bán hàng
    Route::any('/W27F2245/detail/{vou}/{g}/{isApproval}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W27F2245Controller@detail'));
    Route::any('/W27F2245/Report/{vou}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W27F2245Controller@report'));

    // thong tin khách hàng
    Route::get('/W27F0100/{vou}/{g}/{ObjectID}/{ObjectTypeID}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W27F2245Controller@customer'));
    Route::get('/W27P2260/{vou}/{g}/{ObjectID}/{ObjectTypeID}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W27F2245Controller@customer'));
    Route::post('W27P2258/update/{vou}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W27F2245Controller@updateSalary'));

    //Sơ đồ căn hộ
    Route::any('/W27F3000/status/{div}', array('before' => 'auth', 'as' => 'W27F3000status', 'uses' => 'W27F3000Controller@getColorStatus'));
    Route::any('/W27F3000/diagram/{div}', array('before' => 'auth', 'as' => 'W27F3000diagram', 'uses' => 'W27F3000Controller@drawDiagram'));
    Route::any('/W27F3000/show/{mode}', array('before' => 'auth', 'as' => 'show', 'uses' => 'W27F3000Controller@ShowDetail'));
    Route::any('/W27F3000/update', array('before' => 'auth', 'as' => 'W27F3000update', 'uses' => 'W27F3000Controller@SaveData'));
    Route::any('/W27F3000/{pForm}/{g}', array('before' => 'auth', 'as' => 'W27F3000', 'uses' => 'W27F3000Controller@index'));

    //Truy van phieu ban hang
    Route::any('/W27F2240/view/{pForm}/{g}', array( 'as' => 'login',  'uses' => 'W27F2240Controller@Index'));
    //Báo cáo tình hình thu tiền dự án
    Route::post('/W27F3400/loadCombo', array( 'before' => 'auth','as' => 'W27F3400loadCombo',  'uses' => 'W27F3400Controller@loadCombo'));
    Route::post('/W27F3400/showDetail', array('before' => 'auth', 'as' => 'W27F3400showDetail',  'uses' => 'W27F3400Controller@showDetail'));
    Route::post('/W27F3400/showRow', array('before' => 'auth', 'as' => 'W27F3400showRow',  'uses' => 'W27F3400Controller@showRow'));
    Route::any('/W27F3400/{pForm}/{g}', array('before' => 'auth', 'as' => 'W27F3400',  'uses' => 'W27F3400Controller@index'));
});

//Tuyển dụng
Route::group(['namespace' => 'W2X\W25'], function() {
    //Truy vấn Đề xuất tuyển dụng
    Route::get('/W25F2000/view/{pForm}/{g}', array( 'as' => 'login',  'uses' => 'W25F2000Controller@index'));
    Route::any('/W25F2000/view/{pForm}/{g}/filter', array('before' => 'auth', 'as' => 'home', 'uses' => 'W25F2000Controller@filterData'));

    //Truy vấn lịch phỏng vấn
    Route::any('/W25F3020/{pForm}/{g}/{task?}', array( 'as' => 'login',  'uses' => 'W25F3020Controller@index'));
    //Route::any('/W25F3020/view/{pForm}/{g}/filter', array('before' => 'auth', 'as' => 'home', 'uses' => 'W25F3020Controller@filterData'));
    Route::any('/W25F3020/{pForm}/{cForm}/{g}/{module}/{isApproval?}/{key1?}/{key2?}', array('before' => 'auth', 'as' => 'w25F3020Mail', 'uses' => 'W25F3020Controller@viewFromMail'));
    //Lập Đề xuất tuyển dụng
    Route::any('/W25F2010/{pForm}/action/{mode}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W25F2010Controller@actionData'));
    Route::any('/W25F2010/{pForm}/{action}/{tranid}/{statusid}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W25F2010Controller@index'));

    //Duyệt đề xuất tuyển dụng
    Route::any('/W25F2020/detail/{vou}/{g}/{isApproval}/{applevel?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W25F2020Controller@detail'));
    //Route::any('/W25F2020/{pForm}/{g}/{isApproval?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W25F2020Controller@index'));
    Route::any('/W25F2020/{pForm}/{g}/action/{task?}', array('before' => 'auth', 'as' => 'W25F2020', 'uses' => 'W25F2020Controller@index'));


    //Truy vấn kế hoạch tổng thể
    Route::any('/W25F2080/view/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W25F2080',  'uses' => 'W25F2080Controller@index'));
    Route::any('/W25F2081/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W25F2081',  'uses' => 'W25F2081Controller@index'));
    Route::any('/W25F2085/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W25F2085',  'uses' => 'W25F2085Controller@index'));
    Route::any('/W25F2085/{pForm}/{g}/{isApproval?}/{id?}/{iddt?}', array('before' => 'auth', 'as' => 'w25F2085Mail', 'uses' => 'W25F2085Controller@viewFromMail'));
});
