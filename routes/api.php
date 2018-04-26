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
Route::middleware('auth:api')->post('/charge','StripeController@charge');
Route::middleware('auth:api')->resource('/invoice','InvoiceController');
Route::post('/invoice/pay/{id}','InvoiceController@payInvoice');

//Customer routes
Route::middleware('auth:api')->resource('/customer','CustomerController');
Route::middleware('auth:api')->resource('/plan','PlanController');
Route::middleware('auth:api')->resource('/subscription','SubscriptionController');
Route::post('/subscription-activation','SubscriptionController@sendActivationEmail');
