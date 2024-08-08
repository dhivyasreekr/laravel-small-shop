<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'login'])->name('home.login');

Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/profile',[AuthController::class, 'profile'])->name('home.profile');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('home.register');

Route::get('/forget_password', [AuthController::class, 'forget_password'])->name('home.forget_password');

Route::post('/store', [AuthController::class, 'store'])->name('home.store');

Route::get('/order', [AuthController::class, 'order'])->name('home.order');

Route::get('/role', [AuthController::class, 'role'])->name('home.role');

Route::get('/category', [AuthController::class, 'category'])->name('home.category');


use App\Http\Controllers\HomeController;
Route::get('/',[HomeController::class, 'index'])->name('home.index');

//Product detail page
Route::get('/products', [HomeController::class, 'index'])->name('product.index');
Route::get('/products/{id}', [HomeController::class, 'show'])->name('product.show');

Route::get('/sendEmailManually',[HomeController::class, 'sendEmailManually'])->name('home.sendEmailManually');

use App\Http\Controllers\CartController;
// Cart listing page
Route::get('/cart',[CartController::class,'index'])->name('cart.index');

// Add to Cart
Route::post('/cart/add_to_cart', [CartController::class, 'add_to_cart'])->name('cart.add_to_cart');

// Increase quantity route
Route::post('/cart/increase/{id}', [CartController::class, 'increaseQuantity'])->name('cart.increase');

// Decrease quantity route
Route::post('/cart/decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');

// Remove item from cart
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Checkout route (if you have a checkout process)
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

// Clear cart route
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

// Route::get('/sendEmailManually',[HomeController::class, 'sendEmailManually'])->name('home.sendEmailManually');

use App\Http\Controllers\OrderController;

Route::get('/orders', [OrderController::class, 'index'])->name('order.index');

// Checkout Route
Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout');

// Order Confirmation Route
Route::get('order/confirmation/{order}', [OrderController::class, 'confirmation'])->name('order.confirmation');

// Order history Route
Route::get('order/history/{id}', [OrderController::class, 'order_history'])->name('order.history');

// Order show Route
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');

use App\Http\Controllers\InvoiceController;

Route::get('/invoice/generate-pdf/{id}', [InvoiceController::class, 'generateInvoicePdf'])->name('invoice.generate-pdf');
Route::get('/invoice/download-pdf/{id}', [InvoiceController::class, 'downloadInvoicePdf'])->name('invoice.download-pdf');
Route::get('/invoice/stream-pdf/{id}', [InvoiceController::class, 'streamInvoicePdf'])->name('invoice.stream-pdf');
Route::get('/invoice/send-email/{id}', [InvoiceController::class, 'sendInvoiceEmail'])->name('invoice.send-email');

