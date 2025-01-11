<?php

use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Middleware\CheckForPrice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//products
Route::get('/products/product-single/{id}', [ProductsController::class, 'singleProduct'])
    ->name('product.single');
Route::post('/products/product-single/{id}', [ProductsController::class, 'addCart'])
    ->name('add.cart');
Route::get('/products/cart', [ProductsController::class, 'cart'])
    ->name('cart')
    ->middleware('auth');
Route::get('/products/cart-delete/{id}', [ProductsController::class, 'deleteProductCart'])
    ->name('cart.product.delete');

//checkout
Route::post('/products/prepare-checkout', [ProductsController::class, 'prepareCheckout'])
    ->name('prepare.checkout');
Route::get('/products/checkout', [ProductsController::class, 'checkout'])
    ->name('checkout')
    ->middleware(['auth', CheckForPrice::class]);
Route::post('/products/checkout', [ProductsController::class, 'storeCheckout'])
    ->name('process.checkout')
    ->middleware(['auth', CheckForPrice::class]);

//pay and success
Route::get('/products/pay', [ProductsController::class, 'payWithPaypal'])
    ->name('products.pay')
    ->middleware(['auth', CheckForPrice::class]);
Route::get('/products/success', [ProductsController::class, 'success'])
    ->name('products.pay.success')
    ->middleware(['auth', CheckForPrice::class]);

//booking
Route::post('/booking/tables', [ProductsController::class, 'BookTables'])
    ->name('booking.tables');

//menu
Route::get('products/menu', [ProductsController::class, 'menu'])
    ->name('products.menu');

//users pages
Route::get('users/orders', [UsersController::class, 'displayOrders'])
    ->name('users.orders');
Route::get('users/bookings', [UsersController::class, 'displayBookings'])
    ->name('users.bookings');
