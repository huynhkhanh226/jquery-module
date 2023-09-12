<?php
/**
 * Created by PhpStorm.
 * User: THANHLUAN
 * Date: 9/10/2015
 * Time: 12:04 PM
 */

Route::group(['namespace' => 'W5X\W54'], function() {
	Route::any('/W54F4700/view/{pForm}/{g}', array('as' => 'login', 'uses' => 'W54F4700Controller@index'));
	Route::any('/W54F4700/{pForm}/{g}/{task}', array('as' => 'login', 'uses' => 'W54F4700Controller@action'));



    Route::any('/W54F2320/view/{pForm}/{g}', array('as' => 'login', 'uses' => 'W54F2320Controller@index'));
    Route::any('/W54F2320/{pForm}/{g}/{task}', array('as' => 'login', 'uses' => 'W54F2320Controller@action'));
});