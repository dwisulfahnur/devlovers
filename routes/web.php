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
    return redirect('browse_user');
})->name('welocome');

Route::group(['middleware' => 'checkuser'], function(){
    //browse User
    Route::get('/browse_user', 'DevLovers\BrowseUserController@browse_user')->name('browse_user');
    Route::get('/filter_user', 'DevLovers\BrowseUserController@filter_user');

    //detail user route
    Route::get('/user/{username}', 'DevLovers\UserController@detail_user');

    //like route
    Route::get('/like', 'DevLovers\LikeController@like');

    // Logout Route
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});

Route::group(['middleware' => 'foruser'], function(){
    //Register Controller
    Route::get('/register', 'Auth\RegisterController@register')->name('register');
    Route::post('/register', 'Auth\RegisterController@postRegister');

    //Login Routes
    Route::get('/login', 'Auth\LoginController@login')->name('login');
    Route::post('/login', 'Auth\LoginController@postlogin');


});
