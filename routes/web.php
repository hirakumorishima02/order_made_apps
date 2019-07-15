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
Route::get('/profile','HomeController@profile');

// 仕事画面
Route::get('/job','JobController@job');
Route::get('/job_request','JobController@job_request');


// 応募画面
Route::get('/completeSubscrib','SubscribeController@completeSubscrib');
Route::get('/confirmSubscribe','SubscribeController@confirmSubscribe');
