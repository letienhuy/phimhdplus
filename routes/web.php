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
Route::match(['GET', 'POST'], '/register', 'HomeController@register')->name('register')->middleware('guest');
Route::group(['prefix' => 'login', 'middleware' => 'guest'], function(){
    Route::match(['GET', 'POST'], '/', 'HomeController@login')->name('login');
    Route::get('/facebook', 'HomeController@loginFacebook')->name('login.facebook');
});
Route::get('/logout', function(){
    Auth::logout();
    return redirect()->route('home');
})->name('logout')->middleware('auth');
Route::get('/the-loai/{id}-{uri}', 'DetailController@category')->name('category');
Route::get('/phim/{id}-{uri}', 'DetailController@detail')->name('film');
Route::get('/phim/{id}-{uri}/view', 'DetailController@viewFilm')->name('film.view');
Route::group(['prefix' => 'ajax'], function(){
    Route::get('/source/{id}', 'DetailController@getSource');
});