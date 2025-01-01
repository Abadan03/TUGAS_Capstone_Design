<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductsController,
    CartController,
    BarangController,
    CheckoutController,
    // AuthController,
    AdminController,
    PaymentController,
    OrderController
};

use App\Http\Controllers\Auth\LoginController;




// Authentication Routes
Auth::routes();
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Home Route
Route::get('/home', [ProductsController::class, 'index']);

// Logout Route
// Route::post('/logout', function (Request $request) {
//     Auth::logout();
//     $request->session()->invalidate();
//     $request->session()->regenerateToken();
    
//     return redirect('/login');
// })->name('logout');

// Products Routes
Route::resource('products', ProductsController::class);

// Cart and Checkout Routes
Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::post('/increase', [CartController::class, 'increase'])->name('increase');
    Route::post('/decrease', [CartController::class, 'decrease'])->name('decrease');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
});

// payments
// Route:: 

// Process Orders
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/applyletters', [OrderController::class, 'applyletters'])->name('orders.applyletters');
Route::post('/createletters', [OrderController::class, 'createletters'])->name('orders.createletters');
Route::post('/payments', [PaymentController::class, 'payments'])->name('payments');
Route::post('/payments-create', [PaymentController::class, 'createPayment'])->name('payments.create');


// Admin Routes
Route::get('/admin', [ProductsController::class, 'index'])->name('admin');
Route::get('/pesanan_pengguna', [AdminController::class, 'pesanan'])->name('pesanan_pengguna');
Route::post('/checkletter', [AdminController::class, 'checkletter'])->name('checkletter');
Route::get('/getpdf', [AdminController::class, 'getpdf'])->name('getpdf');
Route::post('/approve', [AdminController::class, 'approve'])->name('approve');
Route::post('/decline', [AdminController::class, 'decline'])->name('decline');
Route::post('/payment-check', [AdminController::class, 'checkApprove'])->name('payments.check');
Route::post('/payment-approve', [AdminController::class, 'paymentApprove'])->name('payments.approve');
Route::get('/list-payment', [AdminController::class, 'listPayment'])->name('payments.list');
Route::post('/history-check', [AdminController::class, 'historyCheck'])->name('history.check');




// Barang Routes
Route::resource('barang', BarangController::class);

// Info Route
Route::get('/info', function () {
    return view('info');
});

// Home Route (Welcome Page)
Route::get('/', function () {
    return redirect()->route('login');
});
