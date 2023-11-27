<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PaymentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*Payfast api routes*/
Route::any('/payment/notify', [PaymentController::class, 'payment_notify'])->name('payment-notify');
Route::any('/payment/success', [PaymentController::class, 'payment_success'])->name('payment-success');
Route::any('/payment/cancel', [PaymentController::class, 'payment_cancel'])->name('payment-cancel');
