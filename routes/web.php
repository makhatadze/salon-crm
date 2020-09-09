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
        Route::get('/services/turn/{service}/{status}', 'ServiceController@turn');
        Route::get('/categories', 'ServiceController@categories');
        Route::get('/getcategories', ['uses'=> 'ServiceController@getcategory', 'as' => 'GetCategory']);
        Route::delete('/servicescategory/{id}', 'ServiceController@removecategory');
        Route::resource('/services', 'ServiceController')->except('show', 'update');
        Route::put('/services/update/{id}', 'ServiceController@update')->name('UpdateService');
        //Product Controller
        Route::resource('/products', 'ProductController')->except('show');
        //Company Controller
        Route::get('/companies/offices', 'CompanyController@getoffices');
        Route::resource('/companies', 'CompanyController')->except('show');
        Route::get('/companies/addoffice/{company}', 'CompanyController@createoffice')->name('CreateOffice');
        Route::delete('/companies/removeoffice/{id}', 'CompanyController@removeoffice')->name('RemoveOffice');
        Route::post('/companies/add', 'CompanyController@store')->name('AddCompany');
        Route::any('/companies/update/{company}', 'CompanyController@update')->name('EditCompany');
        Route::post('/companies/addoffice/store/{id}', 'CompanyController@storeoffice')->name('AddOffice');
        // Company Department Controller
        Route::get('/companies/departments', 'DepartmentController@index')->name('Departments');
        Route::get('/companies/departments/create', 'DepartmentController@create')->name('CreateDepartment');
        Route::post('/companies/departments/store', 'DepartmentController@store')->name('AddDepartment');

        Route::get('/products', ['uses'=>'ProductController@index', 'as' => 'ActionProduct']);
        Route::get('/clients', ['uses'=>'ClientController@index', 'as' => 'ActionClient']);
    });
    Auth::routes();
});

