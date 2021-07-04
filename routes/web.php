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

        ## setting
        Route::get('/settings','AdminController@settings');
        Route::post('/check-current-pwd','AdminController@chkCurrentPassword');
        Route::post('/update-pwd','AdminController@updatePassword');
        Route::match(['get', 'post'], '/update-admin-details','AdminController@updateAdminDetails');

        ## section
        Route::get('/sections','SectionController@sections');
        Route::post('/update-section-status','SectionController@updateSectionStatus');

        ## category
        Route::get('categories','CategoryController@categories');
        Route::post('/update-categories-status','CategoryController@updateCategoryStatus');
        Route::match(['get','post'],'/add-edit-category/{id?}','CategoryController@addEditCategory');
        Route::post('/append-categories-level','CategoryController@appendCategoriesLevel');

        Route::get('/logout','AdminController@logout');
    });
});
