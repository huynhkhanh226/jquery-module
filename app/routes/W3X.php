<?php
/**
 * Created by PhpStorm.
 * User: THANHLUAN
 * Date: 9/10/2015
 * Time: 12:04 PM
 */
Route::group(['namespace' => 'W3X\W38'], function() {
    //Truy v?n ?? xu?t ?ào t?o
    Route::get('/W38F3000/view/{pForm}/{g}', array( 'as' => 'login',  'uses' => 'W38F3000Controller@index'));
    Route::any('/W38F3000/view/{pForm}/{g}/filter', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F3000Controller@filterData'));
    Route::any('/W38F3000/view/{pForm}/{g}/checkstatus/', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F3000Controller@CheckStatus'));

    //L?p ?? xu?t ?ào t?o
    //Route::any('/W38F2000/{pForm}/action/{mode}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F2000Controller@actionData'));
    //Route::get('/W38F2000/{pForm}/{action}/{tranid}/{statusid}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F2000Controller@index'));

    Route::any('/W38F2000/{pForm}/{g}/master/{probathid?}/{proposalid?}/{approved?}/{status?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F2000Controller@Index'));
    Route::any('/W38F2000/{pForm}/{g}/combo/{name}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F2000Controller@ReloadCombo'));
    Route::any('/W38F2000/{pForm}/{g}/tdbg/', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F2000Controller@Loadtdbg'));
    Route::any('/W38F2000/{pForm}/{g}/savemaster/{probathid}/{proposalid}/{status}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F2000Controller@SaveMaster'));
    Route::any('/W38F2000/{pForm}/{g}/savedetail/{mode}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F2000Controller@SaveDetail'));
    Route::any('/W38F2000/{pForm}/{g}/close/', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F2000Controller@Close'));


    //Duyệt đề xuất đào tạo
    Route::any('/W38F2010/detail/{vou}/{g}/{isApproval}/{applevel?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F2010Controller@detail'));
    Route::any('/W38F2010/{pForm}/{g}/{isApproval?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W38F2010Controller@index'));

    //ke hoach dao tao tong the
    Route::any('/W38F2040/view/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W38F2040',  'uses' => 'W38F2040Controller@index'));
    Route::any('/W38F2041/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W38F2041',  'uses' => 'W38F2041Controller@index'));

    //duyet ke hoach dao tao tong the
    Route::any('/W38F2050/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W38F2050',  'uses' => 'W38F2050Controller@index'));
    Route::any('/W38F2050/{pForm}/{g}/{isApproval?}/{id?}/{iddt?}', array('before' => 'auth', 'as' => 'w38F2050Mail', 'uses' => 'W38F2050Controller@viewFromMail'));
    //truy van ke hoach dao tao
    Route::any('/W38F3010/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W38F3010',  'uses' => 'W38F3010Controller@index'));
    Route::any('/W38F2021/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W38F2021',  'uses' => 'W38F2021Controller@index'));
});


Route::group(['namespace' => 'W3X\W39'], function() {
    //Đăng ký chỉ tiêu đánh giá
    Route::any('/W39F2000/{pForm}/{g}/{task?}', array( 'before' => 'auth','as' => 'W39F2000',  'uses' => 'W39F2000Controller@index'));
    Route::any('/W39F2021/{pForm}/{g}/{task?}', array( 'before' => 'auth','as' => 'W39F2021',  'uses' => 'W39F2021Controller@index'));
    Route::any('/W39F2000/{pForm}/{g}/{isApproval?}/{id?}/{iddt?}', array('before' => 'auth', 'as' => 'W39F2000Mail', 'uses' => 'W39F2000Controller@viewFromMail'));
    //Duyet de xuat dieu chinh luong
    Route::any('/W39F2022/detail/{vou}/{g}/{isApproval}', array('before' => 'auth', 'as' => 'W39F2022', 'uses' => 'W39F2022Controller@detail'));
    Route::any("/W39F2022/{pForm}/{g}/{task?}",array('before' => 'auth', 'as' => 'W39F2022Action', 'uses' => 'W39F2022Controller@action'));

    //truy vấn đánh giá kết quả
    Route::any('/W39F2030/{pForm}/{g}/{task?}', array( 'before' => 'auth','as' => 'W39F2030',  'uses' => 'W39F2030Controller@index'));

    //Kế thừa chỉ tiêu
    Route::any('/W39F2041/{pForm}/{g}/{task?}', array( 'before' => 'auth','as' => 'W39F2041',  'uses' => 'W39F2041Controller@index'));

    //Đánh giá kết quả
    Route::any('/W39F2031/{pForm}/{g}/{task?}', array( 'before' => 'auth','as' => 'W39F2031',  'uses' => 'W39F2031Controller@index'));
});