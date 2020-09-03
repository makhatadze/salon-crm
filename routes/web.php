<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//HOME CONTROLLER
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function(){
    Route::group(['prefix' => '/'], function () {
    	//HOME CONTROLLER
        Route::get('/', 'HomeController@ActionHome')->name('ActionHome');
        //USERS CONTROLLER
        Route::get('/user', ['uses'=>'UserController@ActionUser', 'as' => 'ActionUser']);
        Route::get('/user/add', ['uses'=>'UserController@ActionUserAdd', 'as' => 'ActionUserAdd']);
        //
        Route::get('/services', ['uses'=>'ServiceController@index', 'as' => 'ActionService']);
        Route::get('/products', ['uses'=>'ProductController@index', 'as' => 'ActionProduct']);
        Route::get('/clients', ['uses'=>'ClientController@index', 'as' => 'ActionClient']);
    });
    Auth::routes();
});

