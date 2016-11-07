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
Route::get('', function(){
    return redirect()->route('browse_user')->name('home');
});

Route::group(['middleware' => 'auth'], function(){
    //Register Controller
    Route::get('register', 'Auth\RegisterController@register')->name('register');
    Route::post('register', 'Auth\RegisterController@postRegister');

    //Login Routes
    Route::get('login', 'Auth\LoginController@login')->name('login');
    Route::post('login', 'Auth\LoginController@postlogin');

});

Route::group(['middleware' => 'unauth'], function(){
    //browse User
    Route::get('browse_user', 'DevLovers\BrowseUserController@browse_user')->name('browse_user');
    Route::get('filter_user', 'DevLovers\BrowseUserController@filter_user')->name('filter_user');

    // edit_profile route
    Route::get('edit_profile', 'DevLovers\UserController@edit_profile')->name('edit_profile');
    Route::put('edit_profile', 'DevLovers\UserController@put_edit_profile');

    // Password Change Route
    Route::get('change_password', 'Auth\ChangePasswordController@change')->name('change_password');
    Route::put('change_password', 'Auth\ChangePasswordController@put_change');

    //Image Route
    Route::get('images/{profile_picture}', 'DevLovers\FileController@getImage')->name('image');

    //like route
    Route::get('like', 'DevLovers\LikeController@like')->name('like');

    // Logout Route
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    //detail user route
    Route::get('{username}', 'DevLovers\UserController@detail_user')->name('detail_user');

});
