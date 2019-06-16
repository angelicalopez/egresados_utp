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
Route::get('/changepassword', 'HomeController@changePasswordView')->name('changepasswordview');
Route::post('/password', 'HomeController@changePassword')->name('changepassword');

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
    Route::get('/admin/noticia/edit/{id}', 'NoticiaController@edit')->name('admin.noticia.edit');
    Route::put('/admin/noticia/update/{id}', 'NoticiaController@update')->name('admin.noticia.update');
    Route::put('/admin/noticia/updatemultimedia/{id}', 'NoticiaController@updatemultimedia')->name('admin.noticia.updatemultimedia');
    Route::delete('/admin/noticia/delete/{id}', 'NoticiaController@destroy')->name('admin.noticia.delete');
});

route::group(['middleware' => 'auth'], function() {
    Route::post('/egresado/store', 'EgresadoController@store')->name('egresado.store');
    Route::put('/egresado/update/{id}', 'EgresadoController@update')->name('egresado.update');
    Route::get('/egresados/profile/{id}', 'EgresadoController@show')->name('egresado.profile');
    Route::get('/egresados/profile/edit/{id}', 'EgresadoController@editEgresado')->name('egresado.edit');
    Route::get('/egresados/noticias/{interes?}', 'EgresadoController@noticias')->name('egresado.noticias');
    Route::get('/egresados/amigos/{nombre?}', 'EgresadoController@amigos')->name('egresado.amigos');
    Route::post('/egresados/addfriend', 'EgresadoController@addfriend')->name('egresado.addfriend');
    Route::put('/egresados/updatepicture/{id}', 'EgresadoController@editpicture')->name('egresado.picture');
    Route::put('/egresados/updateintereses/{id}', 'EgresadoController@editIntereses')->name('egresado.intereses');
    Route::put('/egresados/profile/update/{id}', 'EgresadoController@updateEgresado')->name('egresado.updateegresado');
    Route::delete('/egresados/deletefriend', 'EgresadoController@deletefriend')->name('egresado.deletefriend');
});

