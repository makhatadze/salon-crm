<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//HOME CONTROLLER
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function(){
    Route::group(['prefix' => '/'], function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/home', 'HomeController@index')->name('home');

//        Route::any('/home',['uses'=>'MainController@index', 'as' => 'ActionMain']);
        Route::get('/user', ['uses'=>'UserController@index', 'as' => 'ActionUser']);
        Route::get('/services', ['uses'=>'ServiceController@index', 'as' => 'ActionService']);
        Route::get('/products', ['uses'=>'ProductController@index', 'as' => 'ActionProduct']);
        Route::get('/clients', ['uses'=>'ClientController@index', 'as' => 'ActionClient']);
    });
    Auth::routes();
});

