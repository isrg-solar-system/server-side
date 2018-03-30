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
//Route::get('/', 'HomeController@index')->name('home');
//Route::get('/{blade}', function ($blade) {
//    return view('front.'.$blade);
//});
Route::get('/', 'FrontController@index')->name('FrontIndex');
Route::get('/inverter', 'FrontController@inverter')->name('FrontInverter');
Route::get('/log', 'FrontController@log')->name('FrontLog');


Route::get('/back', 'Back\HomeController@index')->name('BackIndex');

Route::get('/back/member', 'Back\MemberController@index')->name('MemberList');
Route::get('/back/member/add', 'Back\MemberController@add')->name('MemberAdd');

Route::get('/back/download', 'Back\DownloadController@index')->name('DownloadIndex');
Route::get('/back/download/get', 'Back\DownloadController@getDownloadFile')->name('getDownloadFile');
//post to make download data
Route::post('/api/download/file', 'Back\DownloadController@makedownload')->name('DownloadmakeFile');
Route::get('/api/download/status', 'Back\DownloadController@downloadstatus')->name('DownloStatus');


Route::get('/back/log', 'Back\LogController@index')->name('LogList');

Route::get('/back/warning', 'Back\WarningController@index')->name('WarningIndex');
Route::get('/api/warning/lists', 'Back\WarningController@lists')->name('WarningLists');
//warning setting
Route::post('/api/warning/update', 'Back\WarningController@update')->name('WarningUpdate');
Route::post('/api/warning/create', 'Back\WarningController@create')->name('WarningCreate');
Route::post('/api/warning/delete', 'Back\WarningController@delete')->name('WarningDelete');

Route::post('/back/member/add', 'Back\MemberController@store')->name('MemberStore');

Route::get('/back/report', 'Back\ReportController@index')->name('ReportIndex');

//input data this api
Route::post('/api/data', 'DataApiController@input')->name('InputData');

Route::get('/api/server/data', 'DataApiController@getServer')->name('getServerData');
// SHOW MEASUREMENTS
Route::get('/api/db/measurement', 'DataApiController@getMeasurement')->name('getMeasurement');
// show first data time and last data time (for select)
Route::get('/api/db/datatime', 'DataApiController@getDataTime')->name('getDataTime');

//
Auth::routes();
//

