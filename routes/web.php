<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/register', 'HomeController@register')->name('register');
Route::group(['prefix' => 'login'], function(){
    Route::get('/', 'HomeController@login')->name('login');
    Route::get('/facebook', 'HomeController@loginFacebook')->name('login.facebook');
});

