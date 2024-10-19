<?php

use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/home', [ProductsController::class, 'index']);
Route::get('/product/{id}', [ProductsController::class, 'show']);
// Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increase', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease', [CartController::class, 'decrease'])->name('cart.decrease');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
// Route untuk memproses checkout
Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('processCheckout');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
