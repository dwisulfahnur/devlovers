<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('home');
})->name('welocome');

Route::group(['middleware' => 'checkuser'], function(){
    Route::get('/home', 'UserController@home')->name('home');
});

Route::group(['middleware' => 'foruser'], function(){
    Route::get('/register', 'UserController@register')->name('register');
    Route::post('/register', 'UserController@postRegister');

    Route::get('/login', 'UserController@login')->name('login');
    Route::post('/login', 'UserController@postlogin');
});

Route::get('/logout', 'UserController@logout')->name('logout');
