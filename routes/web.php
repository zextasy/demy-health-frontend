<?php

use Illuminate\Support\Facades\Route;

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
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::name('paystack.')->prefix('paystack')->group(function () {
    Route::post('/pay', [App\Http\Controllers\Payment\PayStackController::class, 'redirectToGateway'])->name('pay');
    Route::get('/payment/callback', [App\Http\Controllers\Payment\PayStackController::class, 'handleGatewayCallback'])
        ->name('payment-callback');
});

require_once __DIR__.'/auth.php';
require_once __DIR__.'/frontend.php';
require_once __DIR__.'/backend.php';
require_once __DIR__.'/backend-admin.php';
