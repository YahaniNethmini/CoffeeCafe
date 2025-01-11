<?php

use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Middleware\CheckForPrice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Route::group(['prefix' => 'products'], function (){
    //products
    Route::get('/product-single/{id}', [ProductsController::class, 'singleProduct'])
        ->name('product.single');
    Route::post('/product-single/{id}', [ProductsController::class, 'addCart'])
        ->name('add.cart');
    Route::get('/cart', [ProductsController::class, 'cart'])
        ->name('cart')
        ->middleware("auth:web");
    Route::get('/cart-delete/{id}', [ProductsController::class, 'deleteProductCart'])
        ->name('cart.product.delete');

//checkout
    Route::post('/prepare-checkout', [ProductsController::class, 'prepareCheckout'])
        ->name('prepare.checkout');
    Route::get('/checkout', [ProductsController::class, 'checkout'])
        ->name('checkout')
        ->middleware(['auth', CheckForPrice::class]);
    Route::post('/checkout', [ProductsController::class, 'storeCheckout'])
        ->name('process.checkout')
        ->middleware(['auth', CheckForPrice::class]);

//pay and success
    Route::get('/pay', [ProductsController::class, 'payWithPaypal'])
        ->name('products.pay')
        ->middleware(['auth', CheckForPrice::class]);
    Route::get('/success', [ProductsController::class, 'success'])
        ->name('products.pay.success')
        ->middleware(['auth', CheckForPrice::class]);

    //booking
    Route::post('/booking/tables', [ProductsController::class, 'BookTables'])
        ->name('booking.tables');

    //menu
    Route::get('/menu', [ProductsController::class, 'menu'])
        ->name('products.menu');
});

Route::group(['prefix' => 'users'], function (){
    //users pages
    Route::get('/orders', [UsersController::class, 'displayOrders'])
        ->name('users.orders')
        ->middleware('auth:web');
    Route::get('/bookings', [UsersController::class, 'displayBookings'])
        ->name('users.bookings')
        ->middleware('auth:web');

    //write reviews
    Route::get('/write-reviews', [UsersController::class, 'writeReview'])
        ->name('write.reviews')
        ->middleware('auth:web');
    Route::post('/write-reviews', [UsersController::class, 'processWriteReview'])
        ->name('process.write.review')
        ->middleware('auth:web');
});
