<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WatchController;
use App\Http\Controllers\FindController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', [WatchController::class, 'landing'])->name('home');
Route::get('/findwatch', [FindController::class, 'index']);
Route::get('/find', [WatchController::class, 'index'])->name('watches.find');

Route::get('/watches/{watch}', [WatchController::class, 'show'])->name('detailwatch');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/register', [RegisterController::class, 'show'])
    ->name('register')
    ->middleware('guest');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store')
    ->middleware('guest');
    

use App\Http\Controllers\CartController;

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/increase', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease', [CartController::class, 'decrease'])->name('cart.decrease');

use App\Http\Controllers\PaymentController;

Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/payment', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');