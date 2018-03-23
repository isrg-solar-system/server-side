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

Route::post('/api/data', 'DataApiController@input')->name('InputData');

Route::get('/api/server/data', 'DataApiController@getServer')->name('getServerData');




Route::get('/back', 'Back\HomeController@index')->name('BackIndex');

Route::get('/back/member', 'Back\MemberController@index')->name('MemberList');
Route::get('/back/member/add', 'Back\MemberController@add')->name('MemberAdd');

Route::get('/back/download', 'Back\DownloadController@index')->name('DownloadIndex');

Route::get('/back/log', 'Back\LogController@index')->name('LogList');

Route::get('/back/warning', 'Back\WarningController@index')->name('WarningIndex');
Route::post('/back/member/add', 'Back\MemberController@store')->name('MemberStore');

//
Auth::routes();
//

