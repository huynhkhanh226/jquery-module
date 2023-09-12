<?php
/**
 * Created by PhpStorm.
 * User: THANHLUAN
 * Date: 9/10/2015
 * Time: 12:04 PM
 */

Route::group(['namespace' => 'W7X\W75'], function () {

    //SELF SERVICE
    Route::get("/W75F0000/view/{pForm}/{g}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F0000Controller@index'));
    //Route::get("/W75F0000/{pForm}/{g}",array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F0000Controller@index'));
    Route::get("/W75F0001/view/{pForm}/{g}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F0000Controller@index'));
    Route::get("/W75F0000/loadtable/{emp}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F0000Controller@loadTable'));

    //Thông tin cá nhân
    //Route::get("/W75F3010",array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3010Controller@index'));
    Route::get("/W75F3010/{pForm}/{g}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3010Controller@index'));

    //Hợp đồng lao động
    //Route::get("/W75F3020",array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3020Controller@index'));
    Route::get("/W75F3020/{pForm}/{g}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3020Controller@index'));

    //Bảo hiểm
    //Route::get("/W75F3030",array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3030Controller@index'));
    Route::get("/W75F3030/{pForm}/{g}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3030Controller@index'));
    Route::any("/W75F1010/{action}/{pro?}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F1010Controller@index'));

    //Thông tin công tác
    Route::any("/W75F1066/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75F1066', 'uses' => 'W75F1066Controller@index'));

    //Đăng ký nghỉ phép
    //Route::get("/W75F1065/view/{pForm}/{g}",array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F1065Controller@W75F1065'));
    Route::get("/W75F1065/{pForm}/{g}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F1065Controller@W75F1065'));
    Route::post("/W75F1065/view/{pForm}/{g}/{mod}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F1065Controller@ajaxW75F1065'));
    Route::any('/W75F1065/{pForm}/{g}/{isApproval?}/{id?}/{iddt?}', array('before' => 'auth', 'as' => 'w75f1035Mail', 'uses' => 'W75F1065Controller@viewFromMail'));

    //Route::get("/W75F3801/view/{pForm}/{g}",array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3801Controller@index'));
    Route::get("/W75F3801/{pForm}/{g}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3801Controller@index'));
    Route::any("/W75F3801/{pForm}/{g}/loadgrid/{name}", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3801Controller@loadTDBC'));
    Route::any("/W75F3801/{pForm}/{g}/save", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3801Controller@saveData'));
    Route::any("/W75F3801/{pForm}/{g}/delete", array('before' => 'auth', 'as' => 'home', 'uses' => 'W75F3801Controller@deleteData'));


    //Đăng ký tăng ca
    Route::any("/W75F4071/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75f4071', 'uses' => 'W75F4071Controller@index'));
    Route::any("/W75F4081/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75f4081', 'uses' => 'W75F4081Controller@index'));
    Route::any('/W75F4071/{pForm}/{g}/{isApproval?}/{id?}/{iddt?}', array('before' => 'auth', 'as' => 'w75f4071Mail', 'uses' => 'W75F4071Controller@viewFromMail'));
    Route::any('/W75F4081/{pForm}/{g}/{isApproval?}/{id?}/{iddt?}', array('before' => 'auth', 'as' => 'w75f4081Mail', 'uses' => 'W75F4081Controller@viewFromMail'));

    //Duyet dang ky di tre ve som
    Route::any("/W75F4080/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75f4080', 'uses' => 'W75F4080Controller@index'));
    Route::any('/W75F4080/{pForm}/{g}/{isApproval?}/{id?}/{iddt?}', array('before' => 'auth', 'as' => 'w75f4080Mail', 'uses' => 'W75F4080Controller@viewFromMail'));
    //Duyet dang ky di tre ve som
    Route::any("/W75F4070/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75f4070', 'uses' => 'W75F4070Controller@index'));
    Route::any('/W75F4070/{pForm}/{g}/{isApproval?}/{id?}/{iddt?}', array('before' => 'auth', 'as' => 'w75f4070Mail', 'uses' => 'W75F4070Controller@viewFromMail'));

    //Duyet de xuat tuyen dung
    //form phan quyen: D75F2110
    Route::any("/W75F2100/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75f2100', 'uses' => 'W75F2100Controller@index'));

    //duyet de xuat khen thuong
    Route::any("/W75F2130/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75F2130', 'uses' => 'W75F2130Controller@index'));

    //chinh sach phuc lơi
    Route::any("/W75F2040/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75F2040', 'uses' => 'W75F2040Controller@index'));

    //dang ky chinh sach phuc loi
    Route::any("/W75F2041/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75F2041', 'uses' => 'W75F2041Controller@index'));

    //tieu chi thong ke
    Route::any("/W75F3006/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75F3006', 'uses' => 'W75F3006Controller@index'));

    //truy van du lieu bat thuong
    Route::any("/W75F3005/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75F3005', 'uses' => 'W75F3005Controller@index'));

    //Truy van thong tin
    Route::any("/W75F4100/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75f2100', 'uses' => 'W75F4100Controller@index'));

    //Thông tin công/phép
    Route::any("/W75F4090/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75f4090', 'uses' => 'W75F4090Controller@index'));

    //Bảng lương công ty
    Route::any("/W75F3040/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75F3040', 'uses' => 'W75F3040Controller@index'));

    //Tách giờ tăng ca
    Route::any("/W75F2030/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w75F2030', 'uses' => 'W75F2030Controller@index'));
});

Route::group(['namespace' => 'W7X\W76'], function () {
    // eoffice
    Route::get("/W76F0000/view/{pForm}/{g}", array('before' => 'auth', 'as' => 'W76F0000', 'uses' => 'W76F0000Controller@index'));
    //Thiết lập hệ thống
    Route::any('/W76F0001/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W76F0001Controller@index'));

    //Danh bạ điện thoại
    Route::any("/W76F4010/{pForm}/{g}", array('before' => 'auth', 'as' => 'W76F4010', 'uses' => 'W76F4010Controller@index'));
    //Danh sach Album/Video
    Route::any("/W76F2010/{pForm}/{g}", array('before' => 'auth', 'as' => 'W76F2010', 'uses' => 'W76F2010Controller@listAlbum'));
    Route::any("/W76F2010/{pForm}/{g}/removealbum/{id}", array('before' => 'auth', 'as' => 'W76F2010', 'uses' => 'W76F2010Controller@removeAlbum'));
    //Nghiệp vụ thêm ảnh
    Route::any("/W76F2011/{pForm}/{g}/detail/{id}", array('before' => 'auth', 'as' => 'W76F2011', 'uses' => 'W76F2011Controller@detailAlbum'));
    Route::any("/W76F2011/{pForm}/{g}/imagelist/{id}", array('before' => 'auth', 'as' => 'W76F2011', 'uses' => 'W76F2011Controller@imageList'));
    Route::any("/W76F2011/{pForm}/{g}/save/{id}", array('before' => 'auth', 'as' => 'W76F2011', 'uses' => 'W76F2011Controller@saveAlbum'));
    Route::any("/W76F2011/{pForm}/{g}/addImage", array('before' => 'auth', 'as' => 'W76F2011', 'uses' => 'W76F2011Controller@addImage'));
    Route::any("/W76F2011/{pForm}/{g}/saveimage/{id}", array('before' => 'auth', 'as' => 'W76F2011', 'uses' => 'W76F2011Controller@saveImage'));
    Route::any("/W76F2011/{pForm}/{g}/removeimage", array('before' => 'auth', 'as' => 'W76F2011', 'uses' => 'W76F2011Controller@removeImage'));
    Route::any("/W76F2011/{pForm}/{g}/updatecaption", array('before' => 'auth', 'as' => 'W76F2011', 'uses' => 'W76F2011Controller@updateImage'));

    //Nghiệp vụ thêm ảnh
    //Route::get("/W76F2021/",array('before' => 'auth', 'as' => 'W76F2021', 'uses' => 'W76F2021Controller@loadCombo'));
    Route::any("/W76F2021/savevideo", array('before' => 'auth', 'as' => 'W76F2021', 'uses' => 'W76F2021Controller@saveVideo'));
    Route::any("/W76F2021/{pForm}/{g}/detailalbumvideo/{id}", array('before' => 'auth', 'as' => 'W76F2021', 'uses' => 'W76F2021Controller@DetailAlbumVideo'));
    Route::any("/W76F2021/{pForm}/{g}/savealbumvideo/{id}", array('before' => 'auth', 'as' => 'W76F2021', 'uses' => 'W76F2021Controller@SaveAlbumVideo'));
    Route::any("/W76F2021/{pForm}/{g}/videolist/{id}", array('before' => 'auth', 'as' => 'W76F2021', 'uses' => 'W76F2021Controller@VideoList'));
    Route::any("/W76F2021/{pForm}/{g}/detailvideo/{itemid}", array('before' => 'auth', 'as' => 'W76F2021', 'uses' => 'W76F2021Controller@DetailVideo'));
    Route::any("/W76F2021/removevideo/{itemid}", array('before' => 'auth', 'as' => 'W76F2021', 'uses' => 'W76F2021Controller@RemoveVideo'));

    //Danh mục album audio
    Route::any("/W76F2040/{pForm}/{g}", array('before' => 'auth', 'as' => 'W76F2010', 'uses' => 'W76F2040Controller@index'));
    Route::post("/W76F2041/saveAudio", array('before' => 'auth', 'as' => 'W76F2010', 'uses' => 'W76F2041Controller@saveAudio'));
    Route::any("/W76F2041/action", array('before' => 'auth', 'as' => 'W76F2010', 'uses' => 'W76F2041Controller@actionDetail'));
    Route::any("/W76F2041/{id?}", array('before' => 'auth', 'as' => 'W76F2010', 'uses' => 'W76F2041Controller@action'));
    Route::get("/W76F2041/grid/{id}", array('before' => 'auth', 'as' => 'W76F2010', 'uses' => 'W76F2041Controller@loadGrid'));
    Route::get("/W76F2041/{pForm}/{g}/{id?}", array('before' => 'auth', 'as' => 'W76F2010', 'uses' => 'W76F2041Controller@index'));

    //Danh mục phòng họp
    Route::any('/W76F2050/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W76F2050Controller@index'));
    Route::any('/W76F2050/{id}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W76F2050Controller@action'));
    Route::any('/W76F2051/{pForm}/{g}/{mode?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W76F2051Controller@index'));

    //Album ảnh
    Route::any("/W76F4020/{pForm}/{g}", array('before' => 'auth', 'as' => 'W76F4020', 'uses' => 'W76F4020Controller@ListAlbum'));
    Route::post("/W76F4021", array('before' => 'auth', 'as' => 'W76F4020', 'uses' => 'W76F4020Controller@ListImage'));
    Route::post("/W76F4021/show", array('before' => 'auth', 'as' => 'W76F4020', 'uses' => 'W76F4020Controller@GetImage'));

    //Album Video
    Route::any("/W76F4030/{pForm}/{g}", array('before' => 'auth', 'as' => 'W76F4030', 'uses' => 'W76F4030Controller@ListAlbum'));
    Route::any("/W76F4031", array('before' => 'auth', 'as' => 'W76F4030', 'uses' => 'W76F4030Controller@ListVideo'));

    //Thư viện Audio
    Route::any("/W76F4040/{pForm}/{g}", array('before' => 'auth', 'as' => 'W76F4040', 'uses' => 'W76F4040Controller@listAlbum'));
    Route::any("/W76F4041", array('before' => 'auth', 'as' => 'W76F4041', 'uses' => 'W76F4040Controller@listVideo'));

    //Booking phòng họp
    Route::any("/W76F4050/add", array('before' => 'auth', 'as' => 'W76F4051', 'uses' => 'W76F4050Controller@bookingRequest'));
    Route::any("/W76F4050/calendar", array('before' => 'auth', 'as' => 'W76F4051', 'uses' => 'W76F4050Controller@loadCalendar'));
    Route::any("/W76F4050/{g}", array('before' => 'auth', 'as' => 'W76F4050', 'uses' => 'W76F4050Controller@index'));

    //Hệ thống tài liệu
    Route::post("/W76F4060/getfile", array('before' => 'auth', 'as' => 'W76F4060', 'uses' => 'W76F4060Controller@getFile'));
    Route::any("/W76F4060/{pForm}/{g}", array('before' => 'auth', 'as' => 'W76F2010', 'uses' => 'W76F4060Controller@index'));
//    Route::any("/W76F4060/{g}",array('before' => 'auth', 'as' => 'W76F4060', 'uses' => 'W76F4060Controller@index'));
    Route::any("/W76F4061/{id?}", array('before' => 'auth', 'as' => 'W76F4060', 'uses' => 'W76F4061Controller@index'));

    //Quản lý công việc
    Route::any("/W76F4070/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'W76F4070', 'uses' => 'W76F4070Controller@index'));
    Route::any("/W76F4071/{g}/{id?}", array('before' => 'auth', 'as' => 'W76F4071', 'uses' => 'W76F4071Controller@index'));
    Route::any("/W76F4072/getfile/{id}", array('before' => 'auth', 'as' => 'W76F4072', 'uses' => 'W76F4072Controller@getfile'));
    Route::any("/W76F4072/action", array('before' => 'auth', 'as' => 'W76F4072', 'uses' => 'W76F4072Controller@action'));
    Route::any("/W76F4072/{g}", array('before' => 'auth', 'as' => 'W76F4072', 'uses' => 'W76F4072Controller@index'));

    //Duyệt phòng họp
    Route::post('/W76F2080/changeStatus', array('before' => 'auth', 'as' => 'home', 'uses' => 'W76F2080Controller@changeStatus'));
    Route::any('/W76F2080/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W76F2080Controller@index'));

    //Duyệt phòng họp
    Route::any('/W76F2070/view/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W76F2070Controller@index'));
    Route::any('/W76F2070/{id?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W76F2070Controller@action'));

    Route::any("/W76F2110/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w76F2110', 'uses' => 'W76F2110Controller@index'));
    Route::any("/W76F2111/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'w76F2111', 'uses' => 'W76F2111Controller@index'));

    //Nhóm văn bản
    Route::any('/W76F1000/view/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W09F1000', 'uses' => 'W76F1000Controller@index'));

    Route::any('/W76F2090/view/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W76F2090', 'uses' => 'W76F2090Controller@index'));
    Route::any('/W76F2100/view/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'W76F2100', 'uses' => 'W76F2100Controller@index'));

    Route::any("/W76F2091/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'W76F2091', 'uses' => 'W76F2091Controller@index'));
    Route::any("/W76F2101/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'W76F2101', 'uses' => 'W76F2101Controller@index'));
    Route::any("/W76F2120/view/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'W76F2120', 'uses' => 'W76F2120Controller@index'));
    Route::any("/W76F2121/{pForm}/{g}/{task?}", array('before' => 'auth', 'as' => 'W76F2121', 'uses' => 'W76F2121Controller@index'));

    Route::any('/W76F1555/view/{pForm}/{g}/{task?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W76F1555Controller@index'));





});