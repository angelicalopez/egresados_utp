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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/superuser/admin', 'RootController@administradores')->name('superuser.admin');
    Route::get('/superuser/admin/create', 'RootController@crearadmin')->name('superuser.admin.crear');
   // Route::post('/superuser/admin/store', 'RootController@storeadmin')->name('superuser.admin.store');
});

route::group(['middleware' => 'auth'], function() {
    Route::post('/admin/store', 'AdminController@store')->name('admin.store');
});