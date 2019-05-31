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
    return view('about');
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::view('/about', 'about')->name('about');
//Route::view('/test', 'test')->name('test');

Route::get('/dances', 'DanceController@index')->name('dances');
Route::get('/datatable/dances', 'DataTable\DanceController@index')->name('dances.index');

Route::get('/uploadfile','UploadFileController@index')->name('uploadfile');
Route::post('/uploadfile','UploadFileController@showUploadFile');

Route::get('/directions/{name?}', 'DirectionsController@show')->where('name', '(.*)')->name('directions');

