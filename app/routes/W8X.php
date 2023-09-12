<?php
/**
 * Created by PhpStorm.
 * User: THANHLUAN
 * Date: 9/10/2015
 * Time: 12:04 PM
 */


Route::group(['namespace' => 'W8X\W84'], function() {
    //Form chung cho các form duy?t
    Route::any('/W84F2020/{pForm}/{cForm}/{g}/{module}/{ApprovalStatus?}/{key1?}/{key2?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F2020Controller@index'));
    Route::any('/W84F2021/{pForm}/{vou}/{g}/{isApproval}/{applevel?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F2021Controller@index'));

    Route::any('/W84F1200/{pForm}/listperson/{type}/{mod?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F1200Controller@p1201'));
    Route::any('/W84F1200/{pForm}/saveauthorize/{mod}/{vou?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F1200Controller@saveauthorize'));
    Route::any('/W84F1200/{pForm}/cancelauthorize/{mod}/{vou?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F1200Controller@cancelauthorize'));
    Route::any('/W84F1200/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F1200Controller@index'));
    Route::any('/W84F1200/{pForm}/{g}/{mod}/{vou?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F1200Controller@p1203'));

    Route::any('/W84F1201/{pForm}/listperson/{type}/{mod?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F1200Controller@p1201'));
    Route::any('/W84F1201/{pForm}/saveauthorize/{mod}/{vou?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F1200Controller@saveauthorize'));
    Route::any('/W84F1201/{pForm}/cancelauthorize/{mod}/{vou?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F1200Controller@cancelauthorize'));
    Route::any('/W84F1201/{pForm}/{g}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F1200Controller@index'));
    Route::any('/W84F1201/{pForm}/{g}/{mod}/{vou?}', array('before' => 'auth', 'as' => 'home', 'uses' => 'W84F1200Controller@p1203'));

});