<?php
/**
 * Created by PhpStorm.
 * User: THANHLUAN
 * Date: 9/10/2015
 * Time: 12:04 PM
 */

//Duyệt cung ứng
Route::group(['namespace' => 'W1X\W12'], function() {
    Route::any('/W12F3003/detail/{vou}/{g}/{isApproval}', array('before' => 'auth', 'as' => 'W12F3003detail', 'uses' => 'W12F3003Controller@detail'));
    Route::any('/W12F3003/{pForm}/{g}/{isApproval?}', array('before' => 'auth', 'as' => 'W12F3003', 'uses' => 'W12F3003Controller@index'));
    //Duyệt phiếu yêu cầu hàng hóa - Dịch vụ
    Route::any('/W12F3004/detail/{id}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W12F3004Controller@detail'));
    Route::any('/W12F3004/detail/{id}/{ostatus}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W12F3004Controller@savedata'));
    Route::any('/W12F3004/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W12F3004Controller@index'));
    //Duyệt chọn thầu
    Route::any('/W12F3404/detail/{vou}/{g}/{isApproval}', array('before' => 'auth', 'as' => 'W12F3404detail', 'uses' => 'W12F3404Controller@W12F3404DT'));
    Route::any('/W12F3404/{pForm}/{isApproval?}', array('before' => 'auth', 'as' => 'W12F3404', 'uses' => 'W12F3404Controller@W12F3404'));
});

Route::group(['namespace' => 'W1X\W15'], function() {
    Route::get('/W15F2170/employInfo/{eid}/{asid}/{tid}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W15F2170Controller@employInfo'));
    Route::any('/W15F2170/listApproval/{eid}/{asid}/{tid}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W15F2170Controller@listApproval'));
    Route::any('/W15F2170/detail/{eid}/{asid}/{tid}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W15F2170Controller@detail'));

    Route::any('/W15F2170/{pForm}/{g}/{isApproval?}/{id?}/{iddt?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W15F2170Controller@index'));
    Route::any('/W15F2170/saveapprove', array('before' => 'auth', 'as' => 'home', 'uses' => 'W15F2170Controller@saveApprove'));
    //xuat excel
    Route::any('/W15F2170/{task}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W15F2170Controller@common'));
    //Thong ke phep
    Route::get('/W15F3030/view/{pForm}/{g}', array( 'as' => 'login',  'uses' => 'W15F3030Controller@Index'));
    Route::any('/W15F3030/view/{pForm}/{g}/filter', array('before' => 'auth', 'as' => 'home', 'uses' => 'W15F3030Controller@Filter'));
    Route::any('/W15F3030/view/{pForm}/{g}/loadcombo/{name}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W15F3030Controller@LoadTdbc'));
    Route::any('/W15F3031/view/{pForm}/{g}/detail/{id}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W15F3031Controller@Index'));
    Route::any('/W15F3031/view/{pForm}/{g}/loadtdbg/{id}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W15F3031Controller@Loadtdbg'));

    //danh muc loai chi phi
    Route::any('/W15F1020/{pForm}/{g}/{task?}', array( 'before' => 'auth', 'as' => 'W15F1020',  'uses' => 'W15F1020Controller@index'));
});

Route::group(['namespace' => 'W1X\W17'], function() {
    Route::any('/W17F2040/view/{pForm}/{g}', array( 'before' => 'auth', 'as' => 'W17F2040',  'uses' => 'W17F2040Controller@index'));
    Route::any('/W17F2041/{pForm}/{g}', array( 'before' => 'auth', 'as' => 'W17F2041',  'uses' => 'W17F2041Controller@index'));

    Route::any('/W17F1010/{pForm}/{g}/{task?}', array( 'before' => 'auth', 'as' => 'W17F1010',  'uses' => 'W17F1010Controller@index'));
    Route::any('/W17F1011/{pForm}/{g}/{task?}', array( 'before' => 'auth', 'as' => 'W17F1011',  'uses' => 'W17F1011Controller@index'));
    Route::any('/W17F4030/view/{pForm}/{g}/{task?}', array( 'before' => 'auth', 'as' => 'W17F4030',  'uses' => 'W17F4030Controller@index'));
});