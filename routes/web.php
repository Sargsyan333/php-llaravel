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


Route::middleware('web')->group(function() {
    Route::group(['prefix' => 'administration'], function () {
        Route::get('/', function () {
            return view('welcome');
        });

        Auth::routes();

        Route::get('/home', 'HomeController@index')->name('home');

        //Route::get('pakkelabels', 'PakkelabelsController@index');
        //Route::get('pakkelabels/shipments', 'PakkelabelsController@shipmentsCreate');

        Route::get('economic', 'EconomicController@index');
        Route::get('economic/customers', 'EconomicController@getAllCustomers');

        //change to post
        Route::get('economic/customers/create', 'EconomicController@createCustomer');

        Route::get('economic/customers/{customerNumber}', 'EconomicController@getCustomer');

        Route::get('economic/orders/{order}', 'EconomicController@createEconomic');

        Route::get('dawa', 'DawaController@index');
        Route::view('test', 'test');
    });
});



Route::middleware('web','auth','admin')->group(function() {

    Route::group(['prefix' => 'administration'], function() {
        Route::get('/', 'WEB\AdminWebController@index');
        Route::get('/dashboard', 'WEB\AdminWebController@index');

        /**
         * Users
         */
        Route::resource('users', 'WEB\UserWebController');
        Route::get('users/economic/import', 'WEB\UserWebController@importEconomic');
        Route::get('users/economic/{user}', 'WEB\UserWebController@addToEconomic');
        Route::get('users/economic/delete/{user}', 'WEB\UserWebController@deleteEconomic');

        /**
         * Deliveries
         */
        Route::resource('deliveries', 'WEB\DeliveryWebController');

        /**
         * Products
         */
        Route::resource('products', 'WEB\ProductWebController');

        /**
         * Faqs
         */
        Route::resource('faqs', 'WEB\FAQWebController');

        /**
         * Orders
         */
        Route::resource('orders', 'WEB\OrderWebController');
        Route::get('orders/economic/orders/create', 'WEB\OrderWebController@createEconomicOrderPage');
        Route::get('orders/economic/orders', 'WEB\OrderWebController@economicOrders');
        Route::get('orders/economic/orders/{orderNumber}', 'WEB\OrderWebController@getOrder');
        Route::post('orders/economic/orders', 'WEB\OrderWebController@createEconomicOrder')->name('orders.economic');

        Route::resource('pakkelabels', 'WEB\PakkelabelsWebController');

        Route::get('pakkelabels/shipments/list', 'WEB\PakkelabelsWebController@shipmentsList');
        Route::get('pakkelabels/sales/orders', 'WEB\PakkelabelsWebController@salesOrders');
        Route::get('pakkelabels/shipments/{id}', 'WEB\PakkelabelsWebController@shipmentDetails');

        Route::get('e-conomics', 'WEB\EconomicWebController@exportOrdersToInvoice');
        Route::post('e-conomics', 'WEB\EconomicWebController@exportOrdersToInvoiceStore')->name('exportOrdersToInvoice');

        Route::get('economics/customers', 'WEB\EconomicWebController@index');
        Route::get('economics/customers/import/{customerNumber}', 'WEB\EconomicWebController@import');

        Route::get('invoices', 'WEB\EconomicWebController@invoiceList');
        Route::get('invoices/create', 'WEB\EconomicWebController@invoiceCreate');
        Route::post('invoices/create', 'WEB\EconomicWebController@invoiceStore')->name('invoice.store');
        Route::get('invoices/{id}', 'WEB\EconomicWebController@showInvoice');

        /**
         * Package
         */
        Route::resource('packages', 'WEB\PackageWebController');
    });
});

Route::middleware(['web'])->group(function(){
    Route::get('/{react_capture?}', 'ViewController@index')->where('react_capture', '[\/\w\.-]*');
});
