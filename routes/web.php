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




Route::view('/test','test');
Route::get('/show','addplace@show');
