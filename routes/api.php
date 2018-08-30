<?php

Route::get('password/reset/{token}', 'Api\Auth\User\ForgotPasswordUserApiController@showResetForm')->name('password.reset');

Route::prefix('auth')->group(function (){

    //Customer
    Route::prefix('customer')->namespace('Api\Auth\Customer')->group(function (){
        Route::post('/', 'LoginCustomerApiController@login');
        Route::post('register', 'RegisterCustomerApiController@register');
        Route::post('password-recovery', 'ForgotPasswordCustomerApiController@sendResetLinkEmail');
        Route::post('password-reset', 'ResetPasswordCustomerApiController@reset');

    });

    //User
    Route::prefix('user')->namespace('Api\Auth\User')->group(function (){
        Route::post('/', 'LoginUserApiController@login');
        Route::post('register', 'RegisterUserApiController@register');
        Route::post('password-recovery', 'ForgotPasswordUserApiController@sendResetLinkEmail');
        Route::post('password-reset', 'ResetPasswordUserApiController@reset');
    });

});

Route::middleware('auth:customer')->group( function() {

    //Customer
    Route::prefix('customer')->namespace('Api\Auth\Customer')->group(function (){
        Route::get('/',  'CustomerApiController@details');
    });

});

Route::middleware('auth:cms')->group( function() {

    //User
    Route::prefix('user')->namespace('Api\Auth\User')->group(function (){
        Route::get('/', 'UserApiController@details');
    });

});