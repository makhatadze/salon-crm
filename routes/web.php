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
        Route::get('/profile/turn/{status}', 'UserController@turnprofile');
        Route::get('/profile/accountsettings', 'UserController@accountsetting');
        Route::get('/profile/changepassword', 'UserController@changepassword');
        Route::post('/profile/storenewpassword', 'UserController@storenewpassword')->name('ChangePassword');
        Route::post('/profile/filter', 'UserController@profilefilter')->name('ProfileFilter');
        Route::any('/user/add', ['uses' => 'UserController@ActionUserAdd', 'as' => 'ActionUserAdd']);
        Route::any('/user/data', ['uses' => 'UserController@ActionUserData', 'as' => 'ActionUserData']);
        Route::get('/user/showprofile/{id}', 'UserController@showprofile')->name('ShowUserProfile');
        Route::get('/show/accountsettings/{id}', 'UserController@showprofilesettings')->name('ShowProfileSettings');
        Route::post('/updateuserprofile/{id}', 'UserController@updateuserprofile')->name('UpdateUserProfile');

        //Service COntroller
        Route::get('/services/turn/{service}/{status}', 'ServiceController@turn');
        Route::get('/categories', 'ServiceController@categories');
        Route::get('/getcategories', ['uses'=> 'ServiceController@getcategory', 'as' => 'GetCategory']);
        Route::delete('/servicescategory/{id}', 'ServiceController@removecategory');
        Route::resource('/services', 'ServiceController')->except('show', 'update');
        Route::delete('/services/{id}', 'ServiceController@destroy')->name('RemoveService');
        Route::put('/services/update/{id}', 'ServiceController@update')->name('UpdateService');
        Route::post('/services/store', 'ServiceController@store')->name('StoreService');
        Route::get('/services/unitname/{id}', 'ServiceController@getunitname')->name('GetUnitName');
        Route::post('/services/removeinventory', 'ServiceController@removeinventory')->name('RemoveInventory');
        Route::post('/services/removeimage', 'ServiceController@removeimage')->name('RemoveServiceImage');
        //Product Controller
        Route::get('/products/turn/{product}/{status}', 'ProductController@turn');
        Route::post('/products/removeimg', 'ProductController@removeimg')->name('RemoveImage');
        Route::get('/products/delete/{product}', 'ProductController@destroy')->name('DeleteProduct');
        Route::resource('/products', 'ProductController')->except('show', 'store', 'update', 'delete');
        Route::get('/products/edit/{product}', 'ProductController@edit')->name('ProductEdit');
        Route::post('/products/store', 'ProductController@store')->name('AddProduct');
        Route::put('/products/update/{id}', 'ProductController@update')->name('UpdateProduct');
        Route::post('/products/getproductsajax', 'ProductController@getproductsajax')->name('GetProductsAjax');
        //Company Controller
          //Distribution
            Route::get('/companies/distcompany', 'CompanyController@distcompany'); 
            Route::get('/companies/dist/create', 'CompanyController@distcreate'); 
            Route::get('/companies/dist/edit/{id}', 'CompanyController@distedit'); 
            Route::get('/companies/dist/remove/{id}', 'CompanyController@distdelete'); 
            Route::post('/companies/dist/store', 'CompanyController@diststore')->name('addDistCompany'); 
            Route::put('/companies/dist/update/{id}', 'CompanyController@distupdate')->name('UpdateDistCompany'); 
        Route::get('/companies/offices', 'CompanyController@getoffices');
        Route::resource('/companies', 'CompanyController')->except('show');
        Route::get('/companies/addoffice/{id}', 'CompanyController@createoffice')->name('CreateOffice');
        Route::delete('/companies/removeoffice/{id}', 'CompanyController@removeoffice')->name('RemoveOffice');
        Route::post('/companies/add', 'CompanyController@store')->name('AddCompany');
        Route::any('/companies/update/{id}', 'CompanyController@update')->name('EditCompany');
        Route::post('/companies/addoffice/store/{id}', 'CompanyController@storeoffice')->name('AddOffice');
        // Company Department Controllers
        Route::get('/companies/departments', 'DepartmentController@index')->name('Departments');
        Route::delete('/companies/departments/{department}', 'DepartmentController@destroy')->name('RemoveDepartment');
        Route::get('/companies/departments/create', 'DepartmentController@create')->name('CreateDepartment');
        Route::post('/companies/departments/store', 'DepartmentController@store')->name('AddDepartment');
        //Purchase Controller
        Route::get('/purchases', 'PurchaseController@index');
        Route::get('/purchases/edit/{id}', 'PurchaseController@edit');
        Route::get('/purchases/create', 'PurchaseController@create');
        Route::get('/purchases/delete/{purchase}', 'PurchaseController@destroy')->name('RemovePurchase');
        Route::post('/purchases/store', 'PurchaseController@store')->name('StorePurchase'); 
        Route::put('/purchases/update/{purchase}', 'PurchaseController@update')->name('UpdatePurchase'); 
        Route::post('/purchases/getdepartment', 'PurchaseController@getdepartments')->name('GetDepartmentsByOffice');
        Route::post('/purchases/getdistributors', 'PurchaseController@getdistributors')->name('GetDistributors');
        Route::post('/purchases/getprofiles', 'PurchaseController@getprofiles')->name('GetProfilesForPurchase');
        //Client Controller
        Route::get('/clients', 'ClientController@index');
        Route::get('/clients/create', 'ClientController@create');
        Route::get('/clients/turnon/{id}', 'ClientController@turnon');
        Route::get('/clients/delete/{id}', 'ClientController@destroy');
        Route::get('/clients/deleteclient/{id}', 'ClientController@destroyclient')->name('DeleteClient');
        Route::get('/clients/edit/{id}', 'ClientController@edit')->name('EditClient');
        Route::post('/client/ajaxdelete', 'ClientController@removeservice')->name('AjaxServiceRemove');
        Route::post('/clients/update/{id}', 'ClientController@update')->name('UpdateClient');
        Route::post('/clients/store', 'ClientController@store')->name('StoreClient');
        Route::post('/clinets/getbydate', 'ClientController@getbydate')->name('GetServiceByDate');

        //Export Controller
        Route::get('/clients/export', 'ClientController@export')->name('ClientExcel');
    });
    Auth::routes();
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
});

