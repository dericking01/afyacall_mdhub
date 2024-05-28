<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('user', 'Admin\UsersController@user')->name('api.jwt.user');
});

Route::group(['middleware' => 'checkHeader', 'namespace' => 'API'], function () {
    
    Route::namespace('Doctor')->group(function () {
	    Route::get('/doctors', 'ActiveDoctorsController@index');
	        Route::get('/getdoctorlists', 'ActiveDoctorsController@getdoctorlists');
    });

    Route::namespace('Schedule')->group(function () {
        Route::get('/schedules', 'DoctorSchedulesController@index');
    });

    //Calls
    Route::namespace('Call')->group(function () {
        Route::post('calls/ongoing_call', 'CallsController@active_call')->name('call.active_call');
        Route::post('calls/finished_call', 'CallsController@finished_call')->name('call.finished_call');
        Route::post('calls/all/cdr', 'CallsController@cdr')->name('call.cdr');
    });
});
