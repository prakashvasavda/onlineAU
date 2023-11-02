<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Payfast api response route*/
Route::any('/payment/notify', 'PaymentController@payment_notify')->name('payment-notify');
Route::any('/payment/success', 'PaymentController@payment_success')->name('payment-success');
Route::any('/payment/cancel', 'PaymentController@payment_cancel')->name('payment-cancel');

