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
    Route::get('/superuser/admin/edit/{id}', 'RootController@editadmin')->name('superuser.admin.edit');
   // Route::post('/superuser/admin/store', 'RootController@storeadmin')->name('superuser.admin.store');
});

route::group(['middleware' => 'auth'], function() {
    Route::post('/admin/store', 'AdminController@store')->name('admin.store');
    Route::put('/admin/update/{id}', 'AdminController@update')->name('admin.update');
    Route::get('/admin/egresados', 'EgresadoController@index')->name('admin.egresados');
    Route::get('/admin/egresados/create', 'EgresadoController@create')->name('admin.egresado.create');
    Route::get('/admin/egresados/edit/{id}', 'EgresadoController@edit')->name('admin.egresado.edit');
    Route::get('/admin/noticias', 'NoticiaController@index')->name('admin.noticias');
    Route::get('/admin/noticias/create', 'NoticiaController@create')->name('admin.noticia.create');
    Route::post('/admin/noticias/store', 'NoticiaController@store')->name('admin.noticia.store');
});

route::group(['middleware' => 'auth'], function() {
    Route::post('/egresado/store', 'EgresadoController@store')->name('egresado.store');
    Route::put('/egresado/update/{id}', 'EgresadoController@update')->name('egresado.update');
});

