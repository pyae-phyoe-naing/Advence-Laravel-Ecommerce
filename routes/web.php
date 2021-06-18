<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'/admin','namespace'=>'Admin'],function(){
    Route::match(['get','post'],'/','AdminController@login');
    Route::group(['middleware'=>['admin']],function(){
        Route::get('/dashboard','AdminController@dashboard');
        Route::get('/settings','AdminController@settings');
        Route::get('/logout','AdminController@logout');
    });
});
