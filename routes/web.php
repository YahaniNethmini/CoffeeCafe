<?php

use App\Http\Controllers\Products\ProductsController;
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
    ->name('checkout');
Route::post('/products/checkout', [ProductsController::class, 'storeCheckout'])
    ->name('process.checkout');

Route::get('/products/pay', [ProductsController::class, 'payWithPaypal'])
    ->name('products.pay');
Route::get('/products/success', [ProductsController::class, 'success'])
    ->name('products.pay.success');
