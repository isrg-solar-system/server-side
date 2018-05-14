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
Route::get('/user/logout', 'AuthController@logout')->name('UserLogout');


Route::get('power', 'DataApiController@getPower');

Route::get('/', 'FrontController@index')->name('FrontIndex');
Route::get('/inverter', 'FrontController@inverter')->name('FrontInverter');
Route::get('/ipcam', 'FrontController@ipcam')->name('FrontIpcam');
Route::get('/log', 'FrontController@log')->name('FrontLog');
Route::get('/chart/{dataname}', 'FrontController@chart')->name('FrontChart');


Route::get('/back', 'Back\HomeController@index')->name('BackIndex');
Route::get('/api/server/data', 'Back\HomeController@getServer')->name('getServerData');

Route::get('/back/setting', 'Back\SettingController@index')->name('SettingIndex');
Route::post('/back/setting/update', 'Back\SettingController@update')->name('SettingUpdate');

Route::get('/back/member', 'Back\MemberController@index')->name('MemberIndex');
Route::get('/api/member/lists', 'Back\MemberController@lists')->name('MemberList');
Route::post('/api/member/add', 'Back\MemberController@add')->name('MemberAdd');
Route::post('/api/member/update', 'Back\MemberController@update')->name('MemberUpdate');
Route::post('/api/member/delete', 'Back\MemberController@delete')->name('MemberDelete');



Route::get('/back/download', 'Back\DownloadController@index')->name('DownloadIndex');
Route::get('/back/download/get/', 'Back\DownloadController@getDownloadFile')->name('getDownloadFile');
//post to make download data
Route::post('/api/download/file/', 'Back\DownloadController@makedownload')->name('DownloadmakeFile');
Route::get('/api/download/status', 'Back\DownloadController@downloadstatus')->name('DownloStatus');


Route::get('/back/log', 'Back\LogController@index')->name('LogList');
Route::get('/back/log/search/', 'Back\LogController@search')->name('LogSearch');




Route::get('/back/warning', 'Back\WarningController@index')->name('WarningIndex');
Route::get('/api/warning/lists', 'Back\WarningController@lists')->name('WarningLists');
//warning setting
Route::post('/api/warning/update', 'Back\WarningController@update')->name('WarningUpdate');
Route::post('/api/warning/create', 'Back\WarningController@create')->name('WarningCreate');
Route::post('/api/warning/delete', 'Back\WarningController@delete')->name('WarningDelete');





Route::get('/back/report', 'Back\ReportController@index')->name('ReportIndex');
Route::get('/api/report/lists', 'Back\ReportController@lists')->name('ReportLists');
Route::post('/api/report/create', 'Back\ReportController@create')->name('ReportCreate');
Route::post('/api/report/update', 'Back\ReportController@update')->name('ReportUpdate');
Route::post('/api/report/delete', 'Back\ReportController@delete')->name('ReportDelete');

//input data this api
Route::post('/api/input/data', 'DataApiController@input')->name('InputData');
//update camera toeken
Route::post('/api/camera/update', 'DataApiController@camera')->name('CameraUpdate');

// SHOW MEASUREMENTS
Route::get('/api/db/measurement', 'DataApiController@getMeasurement')->name('getMeasurement');
// show first data time and last data time (for select)
Route::get('/api/db/datatime', 'DataApiController@getDataTime')->name('getDataTime');
Route::post('/api/get/data', 'DataApiController@getData')->name('getData');
Route::get('/api/get/status', 'DataApiController@getDataStatus')->name('getDataStatus');
//
Auth::routes();
//

