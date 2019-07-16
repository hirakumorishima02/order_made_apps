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

// ユーザー画面・プロフィール画面
Route::get('/','HomeController@user');
Route::get('/profile/{user_id}','HomeController@profile');
Route::get('/editProfile','HomeController@editProfile');
Route::post('/addProfile','HomeController@addProfile');
Route::post('/updateProfile','HomeController@updateProfile');
Route::post('/serch', 'HomeController@serch');

// 仕事画面
Route::get('/job/{job_id}/{user_id}','JobController@job');
Route::get('/jobRequest','JobController@jobRequest');
Route::post('/confirmRequest','JobController@confirmRequest');
Route::post('/completeRequest','JobController@completeRequest');
Route::post('/editRequest/{job_id}','JobController@editRequest');
Route::post('/deleteRequest/{job_id}','JobController@deleteRequest');


// 応募画面
Route::post('/completeSubscribe','SubscribeController@completeSubscribe');
Route::post('/confirmSubscribe/{job_id}','SubscribeController@confirmSubscribe');
Route::post('/backSubscribe','SubscribeController@backSubscribe');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
