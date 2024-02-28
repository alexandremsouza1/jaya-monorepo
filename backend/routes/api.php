<?php

use App\Http\Controllers\PaymentsController;
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

Route::group(['prefix' => 'rest'], function () {
    Route::post('/payments', [PaymentsController::class, 'createPayment']);
    Route::get('/payments', [PaymentsController::class, 'getPayments']);
    Route::get('/payments/{id}', [PaymentsController::class, 'getPayment']);
    Route::patch('/payments/{id}', [PaymentsController::class, 'confirmPayment']);
    Route::delete('/payments/{id}', [PaymentsController::class, 'cancelPayment']);
});


