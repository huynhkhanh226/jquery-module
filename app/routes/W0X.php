<?php
/**
 * Created by PhpStorm.
 * User: THANHLUAN
 * Date: 9/10/2015
 * Time: 12:04 PM
 */

Route::group(['namespace' => 'W0X\W00'], function () {
    // USER
    Route::get('/W00F0253/{action}/{id?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W00F0253Controller@index'));
    Route::post('/W00F0253/{action}/{id?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W00F0253Controller@index'));
    Route::post("/checkoldpass", array('before' => 'auth', 'as' => 'home', 'uses' => 'W00F0253Controller@checkOldPass'));

    //Admin
    //Admin
    Route::any('/W00F7111', array('as' => 'adminW00F7111', 'uses' => 'W00F7111Controller@index'));
    Route::any('/W00F7111/logout', array('as' => 'adminW00F7111', 'uses' => 'W00F7111Controller@logout'));
    Route::any('/W00F7111/config', array('as' => 'adminW00F7111', 'uses' => 'W00F7111Controller@config'));
    Route::any('/W00F7120', array('as' => 'W00F7120', 'uses' => 'W00F7120Controller@index'));
    Route::any('/W00F7130', array('as' => 'W00F7130', 'uses' => 'W00F7130Controller@index'));
    Route::any('/W00F7140', array('as' => 'W00F7140', 'uses' => 'W00F7140Controller@index'));
    Route::any('/W00F7150', array('as' => 'W00F7150', 'uses' => 'W00F7150Controller@index'));
    Route::any('/W00F7160', array('as' => 'W00F7160', 'uses' => 'W00F7160Controller@index'));
    Route::any('/W00F7170', array('as' => 'W00F7170', 'uses' => 'W00F7170Controller@index'));// setup đính kèm

});

Route::group(['namespace' => 'W0X\W01'], function () {
    //Duyệt yêu cầu thu chi
    Route::any('/W01F9136/detail/{id}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W01F9136Controller@detail'));
    Route::put('/W01F9136/save/{id}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W01F9136Controller@savedata'));
    Route::any('/W01F9136/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W01F9136Controller@index'));

    // Tình hình thu chi của dự án theo tháng
    /*    Route::any('/W01F3040/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W01F3040Controller@index'));
        Route::any('/W01F3040/loadCombo', array('before' => 'auth', 'as' => 'home', 'uses' => 'W01F3040Controller@loadCombo'));
    */
    Route::any('/W01F3050/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'w01F3050', 'uses' => 'W01F3050Controller@index'));
    Route::any('/W01F3050/{pForm}/{g}/action/{task?}', array('before' => 'auth', 'as' => 'w01F3050Action', 'uses' => 'W01F3050Controller@action'));

    Route::any('/W01F3040/view/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W01F3040', 'uses' => 'W01F3040Controller@index'));
    Route::any('/W01F3041/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W01F3041', 'uses' => 'W01F3041Controller@index'));
    // Tình hình thu chi của dự án theo ngân sách
    Route::any('/W01F3045/view/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W01F3045', 'uses' => 'W01F3045Controller@index'));
});

Route::group(['namespace' => 'W0X\W05'], function () {
    //Truy vấn Đơn hàng
    Route::any('/W05F1621/view/{pForm}/{g}', array('as' => 'login', 'uses' => 'W05F1621Controller@index'));
    //lap don hang va xem chi tiet
    Route::any('/W05F1602/view/{pForm}/{g}/{qid?}', array('as' => 'login', 'uses' => 'W05F1602Controller@index'));
    Route::any('/W05F1602/view/{pForm}/{g}/delete/{qid?}', array('as' => 'login', 'uses' => 'W05F1602Controller@Delete'));

    //Duyệt Đơn hàng
    Route::any('/W05F1631/detail/{id}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W05F1631Controller@detail'));
    Route::put('/W05F1631/save/{id}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W05F1631Controller@savedata'));
    Route::any('/W05F1631/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W05F1631Controller@index'));
});

Route::group(['namespace' => 'W0X\W09'], function () {
    //Duyệt đề xuất thay đổi thông tin cá nhân
    Route::get('/W09F2510/employInfo/{tranid}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F2510Controller@employInfo'));
    Route::post('/W09F2510/history/{tranid}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F2510Controller@showHistory'));
    Route::post('/W09F2510/checkstore/{tranid}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F2510Controller@checkstore'));
    Route::post('/W09F2510/approval/{tranid}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F2510Controller@approval'));
    Route::any('/W09F2510/{pForm}/{g}/{isApproval?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F2510Controller@index'));

    //Danh sách nhân viên
    // Route::post('/W09F1500/getEmpPic', array('as' => 'home', 'uses' => 'W09F1500Controller@loadImage'));
    Route::any('/W09F1500/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F1500Controller@index'));
    Route::any('/W09F1500/detail/{field}/{data}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F1500Controller@listEmployee'));

    //Danh sách nhân viên có sinh nhật
    Route::post('/W09F4550/getEmpPic', array('as' => 'home', 'uses' => 'W09F4550Controller@loadImage'));
    Route::any('/W09F4550/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F4550Controller@index'));
    Route::any('/W09F4550/detail/{dep}/{field}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F4550Controller@listEmployee'));
    //Danh sach hop dong lao dong
    Route::any('/W09F5888/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F5888Controller@Index'));
    Route::any('/W09F5888/view/{pForm}/{g}/filter', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F5888Controller@Filter'));

    Route::any("/W09F5889/{pForm}/{g}/{id}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F5889Controller@Index'));

    //Route for Employee list
    Route::any("/W09F5605/{pForm}/{g}/", array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F5605Controller@Index'));
    Route::any('/W09F5605/{pForm}/{g}/combo/{name}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F5605Controller@ReloadCombo'));
    Route::any("/W09F5605/{pForm}/{g}/filter", array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F5605Controller@Filter'));
    Route::any("/W09F5605/{pForm}/{g}/save", array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F5605Controller@Save'));

    //Thông tin cơ bản của nhân viên
    Route::any("/W09F4444/{g}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W09F4444Controller@Index'));

    //Lịch sử duyệt
    Route::any("/W09F3030/{pForm}/{g}/", array('before' => 'auth', 'as' => 'w09F3030', 'uses' => 'W09F3030Controller@Index'));

    //upload file đính kèm
    Route::any("/W09F4011/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'W09F4011', 'uses' => 'W09F4011Controller@Index'));

    //Các file đính kèm
    Route::any("/W09F4010/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w09F4010', 'uses' => 'W09F4010Controller@Index'));
    Route::any('/W09F4010/download/attachment/{g}/{tableName}/{attID}/{posID}', array('before' => 'auth', 'as' => 'W09F4010', 'uses' => 'W09F4010Controller@viewAttachmentW09F4010'));

    //Đăng ký nghỉ việc
    Route::any("/W09F2020/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w09F2020', 'uses' => 'W09F2020Controller@Index'));

    //Lập đề xuất điều chuyển lao động
    Route::any("/W09F2150/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w09F2150', 'uses' => 'W09F2150Controller@Index'));
    Route::any("/W09F2151/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w09F2151', 'uses' => 'W09F2151Controller@Index'));

    // Duyệt de xuat dieu chuyen lao dong
    Route::any("/W09F2152/action/{task?}", array('before' => 'auth', 'as' => 'w09F2152Action', 'uses' => 'W09F2152Controller@action'));
    Route::any('/W09F2152/detail/{vou}/{g}/{isApproval}', array('before' => 'auth', 'as' => 'W09F2152', 'uses' => 'W09F2152Controller@detail'));

    //Route::any('/W27F2245/Report/{vou}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W27F2245Controller@report'));

    //Xác định bàn giao nghỉ việc
    Route::any("/W09F2022/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w09F2022', 'uses' => 'W09F2022Controller@index'));
    Route::any('/W09F2022/{pForm}/{g}/{isApproval?}/{id?}/{iddt?}', array('before' => 'auth', 'as' => 'w09F2022Mail', 'uses' => 'W09F2022Controller@viewFromMail'));

    // Duyệt danh gia hop dong lao dong
    Route::any("/W09F2190/action/{task?}", array('before' => 'auth', 'as' => 'w09F2190Action', 'uses' => 'W09F2190Controller@action'));
    Route::any('/W09F2190/detail/{vou}/{g}/{isApproval}', array('before' => 'auth', 'as' => 'w09F2190', 'uses' => 'W09F2190Controller@detail'));

    //Duyet de xuat dieu chinh luong
    Route::any('/W09F2002/detail/{vou}/{g}/{isApproval}', array('before' => 'auth', 'as' => 'w09F2002', 'uses' => 'W09F2002Controller@detail'));
    Route::any("/W09F2002/action/{task?}", array('before' => 'auth', 'as' => 'w09F2002Action', 'uses' => 'W09F2002Controller@action'));

    //Duyet de xuat nghi viec
    Route::any('/W09F2021/detail/{vou}/{g}/{isApproval}', array('before' => 'auth', 'as' => 'w09F2021', 'uses' => 'W09F2021Controller@detail'));

    //De xuat dieu chinh luong
    Route::any('/W09F2000/view/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'w09F2000', 'uses' => 'W09F2000Controller@index'));
    Route::any('/W09F2001/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W09F2001', 'uses' => 'W09F2001Controller@index'));

    //Cơ cấu tổ chức W09F1010
    Route::any('/W09F1010/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W09F1010', 'uses' => 'W09F1010Controller@index'));

    //Thêm mới cơ cấu tổ chức W09F1005
    Route::any('/W09F1005/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W09F1005', 'uses' => 'W09F1005Controller@index'));
    //Cap to chuc
    Route::any('/W09F1001/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W09F1001', 'uses' => 'W09F1001Controller@index'));

    //sơ đồ tổ chức theo chức danh công việc
    Route::any('/W09F1020/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W09F1020', 'uses' => 'W09F1020Controller@index'));

    //Chức danh công việc
    Route::any('/W09F1100/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W09F1100', 'uses' => 'W09F1100Controller@index'));
    Route::any('/W09F1101/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W09F1101', 'uses' => 'W09F1101Controller@index'));
    Route::any('/W09F1102/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W09F1102', 'uses' => 'W09F1102Controller@index'));


    //thiết lập sơ đồ cơ cấu tổ chức
    Route::any('/W09F1021/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W09F1021', 'uses' => 'W09F1021Controller@index'));
});