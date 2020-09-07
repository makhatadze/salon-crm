<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//HOME CONTROLLER
// removed
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function(){
    Route::group(['prefix' => '/'], function () {
    	//HOME CONTROLLER
        Route::get('/', 'HomeController@ActionHome')->name('ActionHome');
        //USERS CONTROLLER
        Route::get('/user', ['uses'=>'UserController@ActionUser', 'as' => 'ActionUser']);
        Route::any('/user/add', ['uses'=>'UserController@ActionUserAdd', 'as' => 'ActionUserAdd']);
        //Service COntroller
            Route::post('/getcategories', ['uses'=> 'ServiceController@getcategory', 'as' => 'GetCategory']);
        Route::resource('/services', 'ServiceController');

        Route::get('/products', ['uses'=>'ProductController@index', 'as' => 'ActionProduct']);
        Route::get('/clients', ['uses'=>'ClientController@index', 'as' => 'ActionClient']);
    });
    Auth::routes();
});

