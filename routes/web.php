<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::group(['prefix' => '/'], function () {


        // Admin Controller
        
        Route::group(['middleware' => ['permission:admin']], function () {
            // Admin
            
            Route::get('/roles', 'RoleController@index')->name('Role');
            Route::post('/role/add', 'RoleController@store')->name('AddRole');
            Route::get('/roles/{role}/edit', 'RoleController@edit');
            Route::post('/role/update/{role}', 'RoleController@update')->name('UpdateRole');
            Route::get('/removerole/{role}', 'RoleController@destroy')->name('RemoveRole');

        });

        // User Controller
        Route::group(['middleware' => ['permission:user|admin']], function () {
            // User and Admin
            
            Route::get('/showclients', 'ClientController@showclients')->name('ShowClients');
            Route::post('/profile/filter', 'UserController@profilefilter')->name('ProfileFilter');
            Route::get('/', 'HomeController@ActionHome')->name('ActionHome');
            Route::get('/profile/accountsettings', 'UserController@accountsetting');
            Route::post('/clients/turnon', 'ClientController@turnon')->name('turnonawqa');
            Route::post('/clients/checktime', 'ClientController@checktime')->name('checkTime');
            Route::get('/profile/changepassword', 'UserController@changepassword');
            Route::post('/clients/addservice', 'ClientController@addservice')->name('AddClientService');
            Route::post('/profile/storenewpassword', 'UserController@storenewpassword')->name('ChangePassword');

        });
        

        Route::group(['middleware' => ['permission:see_users|add_user|delete_user|admin']], function () {
            Route::get('/user', ['uses' => 'UserController@ActionUser', 'as' => 'ActionUser']);
            Route::get('/user/showprofile/{id}', 'UserController@showprofile')->name('ShowUserProfile');
        });
        
        Route::group(['middleware' => ['permission:add_user|delete_user|admin']], function () {
            // Delete, Add and Update
            Route::any('/user/add', ['uses' => 'UserController@ActionUserAdd', 'as' => 'ActionUserAdd']);
            Route::get('/show/accountsettings/{id}', 'UserController@showprofilesettings')->name('ShowProfileSettings');
            Route::any('/user/data', ['uses' => 'UserController@ActionUserData', 'as' => 'ActionUserData']);
            Route::post('/user/updateuserprofile/{id}', 'UserController@updateuserprofile')->name('UpdateUserProfile');
            Route::get('/profile/turn/{user}/{status}', 'UserController@turnprofile');
        
        });
        Route::group(['middleware' => ['permission:delete_user|admin']], function () {
        // Delete
        
        });

        // Service Controller
        
        Route::group(['middleware' => ['permission:see_service|delete_service|add_service|admin']], function () {
            // Delete, Add, Update and View

            Route::get('/services', 'ServiceController@index');
        
        });
        Route::group(['middleware' => ['permission:add_service|delete_service|admin']], function () {
            // Delete, Add, adn Update
            Route::get('/services/create', 'ServiceController@create');
            Route::get('/services/{service}/edit', 'ServiceController@edit');
            Route::get('/services/turn/{service}/{status}', 'ServiceController@turn');
            Route::put('/services/update/{id}', 'ServiceController@update')->name('UpdateService');
            Route::post('/services/store', 'ServiceController@store')->name('StoreService');
            Route::get('/services/unitname/{id}', 'ServiceController@getunitname')->name('GetUnitName');
            Route::post('/services/removeinventory', 'ServiceController@removeinventory')->name('RemoveInventory');
            Route::post('/services/removeimage', 'ServiceController@removeimage')->name('RemoveServiceImage');
        
        });
        Route::group(['middleware' => ['permission:delete_service|admin']], function () {
            // Delete

            Route::delete('/services/{id}', 'ServiceController@destroy')->name('RemoveService');
        
        });

        // Product Controller
        
        Route::group(['middleware' => ['permission:see_products|add_product|delete_product|admin']], function () {
            Route::view('/warehouse', 'theme.template.warehouse.index')->name('Warehouse');
            Route::get('/products', 'ProductController@index');
            Route::post('/products/getproductsajax', 'ProductController@getproductsajax')->name('GetProductsAjax');
            Route::view('/brands', 'theme.template.brand.index');
            Route::get('/sales', 'SaleController@index')->name('Sales');
        
        });

        Route::group(['middleware' => ['permission:add_product|delete_product|admin']], function () {
            Route::get('/units', 'ProductController@units');
            Route::post('/storeunits', 'ProductController@storeunits')->name('AddUnitReq');
            Route::post('/chooseforcart', 'ProductController@chooseforcart')->name('ChooseForCart');
            Route::post('/addtosales', 'ProductController@addtosales')->name('addToSales');
            Route::post('/warehouse/adddepartment/{id}', 'WarehouseController@departmentToHouse')->name('DepartmentToProduct');
            Route::put('/addtocart/{id}', 'ProductController@addtocartupdate')->name('UpdateCart');
            Route::post('/addtocart', 'ProductController@addtocart')->name('AddToCart');
            Route::get('/addtocart', 'ProductController@addtocartget')->name('AddToCart');
            Route::get('/products/turn/{product}/{status}', 'ProductController@turn');
            Route::post('/products/removeimg', 'ProductController@removeimg')->name('RemoveImage');
            Route::get('/products/edit/{product}', 'ProductController@edit')->name('ProductEdit');
            Route::get('/removefromcart/{product}', 'ProductController@removefromCart')->name('RemoveFromCart');
            Route::put('/products/update/{id}', 'ProductController@update')->name('UpdateProduct');
            Route::get('/products/removefield/{field}', 'ProductController@removefield')->name('RemoveFieldAjax');
            Route::get('/removesale/{id}', 'SaleController@destroy');
             // Category Controller
            Route::resource('/category', 'CategoryController')->except('destroy', 'update');
            Route::delete('/category/destroy/{id}', 'CategoryController@destroy')->name('CategoryDelete');
            Route::put('/category/update/{id}', 'CategoryController@update')->name('CategoryUpdate');
        
        });

        Route::group(['middleware' => ['permission:delete_product|admin']], function () {
            Route::get('/products/delete/{product}', 'ProductController@destroy')->name('DeleteProduct');
            Route::get('/product/removeproduct/{id}', 'ProductController@removeproductajax')->name('RemoveProductAjax');
        
        });

        // Purchase Controller
        
        Route::group(['middleware' => ['permission:see_purchases|add_purchase|delete_purchase|admin']], function () {
            Route::get('/purchases', 'PurchaseController@index');
        });
        Route::group(['middleware' => ['permission:add_purchase|delete_purchase|admin']], function () {
            Route::get('/purchases/edit/{id}', 'PurchaseController@edit');
            Route::get('/purchases/create', 'PurchaseController@create');
            Route::view('/paymethods', 'theme.template.pay.index');
            Route::post('/purchases/store', 'PurchaseController@store')->name('StorePurchase');
            Route::put('/purchases/update/{purchase}', 'PurchaseController@update')->name('UpdatePurchase');
            Route::post('/purchases/getdepartment', 'PurchaseController@getdepartments')->name('GetDepartmentsByOffice');
            Route::post('/purchases/getdistributors', 'PurchaseController@getdistributors')->name('GetDistributors');
            Route::post('/purchases/getprofiles', 'PurchaseController@getprofiles')->name('GetProfilesForPurchase');
        
        });
        Route::group(['middleware' => ['permission:delete_purchase|admin']], function () {
            Route::get('/purchases/delete/{purchase}', 'PurchaseController@destroy')->name('RemovePurchase');
        });

        // Clients
        
        Route::group(['middleware' => ['permission:see_clients|add_client|delete_client|admin']], function () {
            Route::get('/clients', 'ClientController@index');
            Route::post('/clinets/getbydate', 'ClientController@getbydate')->name('GetServiceByDate');
        
        });
        Route::group(['middleware' => ['permission:add_client|delete_client|admin']], function () {
            Route::post('/clients/getUserServices', 'ClientController@getUserServices')->name('getUserServices');
            Route::get('/clients/create', 'ClientController@create')->name('CreateClient');
            Route::post('/clients/serviceselect', 'ClientController@serviceselect')->name('selectService');
            Route::post('/clients/addconsignation/{ClientService}', 'ClientController@addconsignation')->name('addconsignation');
            Route::get('/clients/edit/{id}', 'ClientController@edit')->name('EditClient');
            Route::post('/client/ajaxdelete', 'ClientController@removeservice')->name('AjaxServiceRemove');
            Route::post('/clients/update/{id}', 'ClientController@update')->name('UpdateClient');
            Route::post('/clients/store', 'ClientController@store')->name('StoreClient');
            
        
        });
        Route::group(['middleware' => ['permission:delete_client|admin']], function () {
            Route::get('/clients/delete/{id}', 'ClientController@destroy');
            Route::get('/clients/deleteclient/{id}', 'ClientController@destroyclient')->name('DeleteClient');
        });

        // Export
        Route::group(['middleware' => ['permission:export_finances|admin']], function () {
        
            Route::any('/clients/finances', 'ClientController@services')->name('Finances');
            Route::get('/statistics', 'StatisticController@index')->name('StatisticController');
            Route::get('/clients/export', 'ClientController@export')->name('ClientExcel');
            Route::get('/clients/financeExport', 'ClientController@financeExport')->name('FinanceExport');
            Route::get('/company/money', 'MoneyController@index')->name('MoneyController');
            Route::get('/user/export/{user}', 'UserController@oneuserexport');
            Route::get('/user/userexport', 'UserController@userexport')->name('UserExport');
            Route::get('/services/export/{id}', 'ServiceController@exportservice');
            Route::get('/products/productexport', 'ProductController@productexport')->name('ProductExport');
            Route::get('/sale/export/{sale}', 'ProductController@saleexport');
            Route::get('/purchases/purchaseexport', 'PurchaseController@purchaseexport')->name('PurchaseExport');
            Route::get('/companies/departments/exportuser/{department}', 'DepartmentController@exportdepartment');
            Route::get('/companies/departments/exportservices/{department}', 'DepartmentController@exportservices');
            Route::any('/clients/export/{client}', 'ClientController@clientserviceexport')->name('ClientExport');
        
        });


        // Company
        Route::group(['middleware' => ['permission:see_company|add_company|delete_company|admin']], function () {
            Route::get('/companies/distcompany', 'CompanyController@distcompany');
            Route::get('/companies/offices', 'CompanyController@getoffices');
            Route::resource('/companies', 'CompanyController')->except('show');
            Route::get('/companies/departments', 'DepartmentController@index')->name('Departments');
        });
        
        Route::group(['middleware' => ['permission:add_company|delete_company|admin']], function () {
            Route::get('/companies/dist/create', 'CompanyController@distcreate');
            Route::get('/companies/dist/edit/{id}', 'CompanyController@distedit');
            Route::post('/companies/dist/store', 'CompanyController@diststore')->name('addDistCompany');
            Route::get('/companies/addoffice/{id}', 'CompanyController@createoffice')->name('CreateOffice');
            Route::any('/companies/update/{id}', 'CompanyController@update')->name('EditCompany');
            Route::post('/companies/addoffice/store/{id}', 'CompanyController@storeoffice')->name('AddOffice');
            Route::put('/companies/dist/update/{id}', 'CompanyController@distupdate')->name('UpdateDistCompany');
            Route::get('/companies/departments/create', 'DepartmentController@create')->name('CreateDepartment');
            Route::post('/companies/departments/store', 'DepartmentController@store')->name('AddDepartment');
        
        });
        Route::group(['middleware' => ['permission:delete_company|admin']], function () {
            Route::get('/companies/dist/remove/{id}', 'CompanyController@distdelete');
            Route::delete('/companies/removeoffice/{id}', 'CompanyController@removeoffice')->name('RemoveOffice');
            Route::delete('/companies/departments/{department}', 'DepartmentController@destroy')->name('RemoveDepartment');
        
        });

        // SMS
        Route::group(['middleware' => ['permission:see_sms|send_sms|delete_sms|admin']], function () {
            // Delete, Add, Update and View
        
        });
        Route::group(['middleware' => ['permission:send_sms|delete_sms|admin']], function () {
            // Delete, Add and Update
        
        
        });
        Route::group(['middleware' => ['permission:delete_sms|admin']], function () {
            // Delete
        
        
        });
        

        
    });
    Auth::routes();
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

});