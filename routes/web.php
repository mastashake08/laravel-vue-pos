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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/invoice/pay/{id}','InvoiceController@getPayInvoice');
Route::get('/subscription-activate','SubscriptionController@showActivation');
Route::get('/${name}','StripeController@sendPay');
Route::get('login/stripe', 'Auth\LoginController@redirectToProvider');
Route::get('login/stripe/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/about',function(){
  return view('about');
});
Route::get('/pricing',function(){
  return view('price');
});
Route::get('/stripe-tos',function(){
  return view('stripe');
});
