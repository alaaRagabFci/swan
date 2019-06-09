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

//Adminpanel
Route::group(['middleware' => ['web']], function () {
    Route::group(['namespace' => 'Admin'], function () {

        //set personal info & Avatar & Password
        Route::get('/profile/{name}' , 'AdminController@profile');
        Route::post('/updateUser' ,'AdminController@updateUser');
        Route::post('/setAvatar' , 'AdminController@updateAdminImage');
        Route::post('/set_password' , 'AdminController@set_password');

        //Dashboard
        Route::GET('/adminpanel', 'AdminController@dashboard');

        //companies
        Route::POST('/companies/change-password/{id}', 'UserController@changePassword');
        Route::Resource('/companies', 'UserController');

        //team-works
        Route::POST('/team-works/change-password/{id}', 'TeamWorkController@changePassword');
        Route::Resource('/team-works', 'TeamWorkController');

        //air-types
        Route::Resource('/air-types', 'AirTypeController');

        //services
        Route::Resource('/services', 'ServiceController');
        //drivers
        Route::Post('/services/store', 'ServiceController@store');
        Route::Post('/services/update', 'ServiceController@update');
        Route::Resource('/services', 'ServiceController');

        //countries
        Route::Resource('/countries', 'CountryController');

        //settings
        Route::Resource('/settings', 'SettingController');

        //regions
        Route::Resource('/regions', 'RegionController');

        //hours
        Route::Resource('/hours', 'HourController');

        //invoices
        Route::Resource('/invoices', 'InvoiceController');

        //emails
        Route::Resource('/contacts', 'ContactController');

        //services prices
        Route::Resource('/air-type-service-prices', 'AirTypeServiceController');

        //categories
        Route::Post('/categories/sort', 'CategoryController@sortCategories');
        Route::Resource('/categories', 'CategoryController');

        //team work
        Route::GET('/team-completed-orders', 'OrderController@teamCompletedOrders');
        Route::GET('/team-accepted-orders', 'OrderController@teamAcceptOrders');

        //company
        Route::GET('/company-new-orders', 'OrderController@companyNewOrders');
        Route::GET('/company-accepted-orders', 'OrderController@companyAcceptOrders');
        Route::GET('/company-completed-orders', 'OrderController@companyCompletedOrders');

        //rates
        Route::GET('/opened-not-rated', 'OrderController@openedNotRated');
        Route::GET('/rated', 'OrderController@ordersRated');
        Route::GET('/rate-not-opened', 'OrderController@linkNotOpened');


        Route::GET('/update-notifications-seen/{id}', 'OrderController@updateNotificationsSeen');

        //Orders
        Route::GET('/new-orders', 'OrderController@newOrders');
        Route::GET('/sms_not_confirmed', 'OrderController@smsNotConfirmedOrders');
        Route::GET('/not-assign-orders', 'OrderController@notAssignedOrders');
        Route::GET('/accepted-orders', 'OrderController@acceptOrders');
        Route::GET('/completed-orders', 'OrderController@completedOrders');
        Route::GET('/cancelled-orders', 'OrderController@cancelledOrders');
        Route::GET('/hanging-orders', 'OrderController@hangingOrders');
        Route::GET('/under-appraisal-orders', 'OrderController@underAppraisalOrders');
        Route::GET('/chnage-order-status/{id}/{status}/{reason?}', 'OrderController@changeOrderStatus');
        Route::GET('/get-order-details/{id}', 'OrderController@getInvoiceDetails');
        Route::GET('/agree-order/{id}', 'OrderController@agreeOrder');
        Route::POST('/assign-company-orders', 'OrderController@assignCompanyOrder');
        Route::POST('/add-service/{id}', 'AirTypeServiceController@addService');
        Route::POST('/add-invoice/{id}', 'InvoiceController@addInvoice');
        Route::GET('/rate-details/{id}', 'OrderController@getOrderDetails');
        Route::Resource('/orders', 'OrderController');

    });

    Auth::routes();
});

Route::group(['middleware' => ['web']], function () {
    Route::group(['namespace' => 'Front'], function () {
        Route::get('/' , 'FrontController@home');
        Route::get('/contact-us' , 'FrontController@contactUs');
        Route::Post('/send-message', 'FrontController@sendMessage');
        Route::get('/check-order-status' , 'FrontController@checkOrderStatus');
        Route::GET('/check-phone' , 'FrontController@checkPhone');
        Route::get('/order-now' , 'FrontController@orderNow');
        Route::get('/rate-your-order/{id}' , 'FrontController@getRatePage');
        Route::post('/order-now' , 'FrontController@makeOrder');
        Route::post('/verify-number' , 'FrontController@verifyNumber');
        Route::post('/rateApplication' , 'FrontController@rateApplication');
        Route::GET('/cancel-order/{id}/{status}/{reason}', 'FrontController@cancelOrder');
        Route::GET('/get-price-range/{totalNumers}/{serviceId}/{airTypeId}', 'FrontController@getPriceRange');
    });
});


