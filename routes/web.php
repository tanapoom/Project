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

Route::view('/','search');
Route::get('/search','getplace@getdata')->name('getplace.getdata');
Route::get('/selectview','addplace@showselect');
Route::get('/detail_/{attractions_id}','detail@showdetail');
Route::get('/add','addplace@add')->name('addplace.add');
Route::get('/delAllSelect','addplace@delAllSelect');
Route::get('/del','addplace@del')->name('addplace.del');
Route::post('/result','ResultController@getresult')->name('ResultController.getresult');

//login
Route::get('/adminlogin','loginController@checkLogin')->name('loginController.checkLogin');
Route::post('/login','loginController@login')->name('loginController.login');
Route::view('/admin','admin');
Route::get('/admin/logout','loginController@logout');

/**admin */
Route::view('/admin/insert','insert');
Route::post('/admin/insertAttraction','adminController@insertAttraction')->name('adminController.insertAttraction');
Route::post('/admin/insertProvince','adminController@insertProvince')->name('adminController.insertProvince');
Route::post('/admin/deleteProvince','adminController@deleteProvince')->name('adminController.deleteProvince');
Route::post('/admin/deleteAttraction','adminController@deleteAttraction')->name('adminController.deleteAttraction');
Route::view('admin/delete','delete');
Route::get('/admin/search','adminController@search')->name('adminController.search');
Route::get('/admin/edit','adminController@edit')->name('adminController.edit');
Route::post('/admin/update','adminController@update')->name('adminController.update');

Route::view('/test','test');
Route::get('/show','addplace@show');
