<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function (){
    return response()->json(['status' => 200,'message' => 'success']);
});

Route::post('register', 'UserController@registerApi');
Route::post('login', 'UserController@authenticate');

Route::post('recover', 'UserController@recover');
Route::get('user/verify/{verification_code}', 'UserController@verifyUser');
Route::post('password/recover', 'UserController@passwordRecover')->name('password.reset');

Route::group(['middleware' => 'jwt.verify'], function() {
    Route::group(['prefix' => 'admin' ,'middleware' => 'admin'], function() {

        /**
         * Users
         * Admin can create,update,read,delete users.
         */
        Route::get('users', 'AdminController@getUsersList');
        Route::get('users/{user}', 'AdminController@getUser');
        Route::post('users', 'AdminController@createUser');
        Route::put('users/{user}', 'AdminController@updateUser');
        Route::delete('users/{user}', 'AdminController@deleteUser');

        Route::get('/users/orders-products','AdminController@getUsersOrdersWithProducts');
        Route::get('/users/{user}/orders-products','AdminController@getUserOrdersWithProducts');
    });

    /**
     * Deliveries
     */
    Route::resource('deliveries', 'DeliveryController');

    /**
     * Frequently asked question
     */
    Route::resource('faqs', 'FAQController');

//    Route::get('orders','OrderController@index'); //old version
    Route::get('orders','OrderController@getAuthenticatedUserOrders');
    Route::get('orders/{order}','OrderController@getAuthenticatedUserOrder');

    Route::get('products','ProductController@index');
    Route::get('packages','ProductController@getPackages');


    Route::post('orders/find','OrderController@findOrderEconomic');
    Route::post('orders/create','OrderController@store');

    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::post('password/reset', 'UserController@resetPassword');

    Route::post('logout', 'UserController@logoutApi');

    /**
     * Invoices
     */
    Route::post('e-conomic/invoices', 'EconomicController@storeInvoice');
    Route::get('e-conomic/invoices', 'EconomicController@getInvoices');
});

//Route::get('e-conomic', 'OrderController@eConomic');

Route::get('pakkelabels', 'PakkelabelsController@index');
Route::get('pakkelabels/shipment-templates', 'PakkelabelsController@shipmentTemplates');
Route::get('pakkelabels/shipments', 'PakkelabelsController@shipments');
Route::post('pakkelabels/shipments', 'PakkelabelsController@shipmentsCreate');
Route::post('pakkelabels/shipments/{id}', 'PakkelabelsController@shipment');
Route::post('pakkelabels/shipments/{id}/labels', 'PakkelabelsController@shipmentLabels');
Route::get('pakkelabels/shipments/{id}/proforma_invoices', 'PakkelabelsController@proformaInvoices');


Route::post('pakkelabels/orders/create', 'PakkelabelsController@createOrder');
Route::get('pakkelabels/orders', 'PakkelabelsController@getOrders');
//Route::get('pakkelabels/shipment/create', 'PakkelabelsController@createShipment');