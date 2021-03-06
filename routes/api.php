<?php

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

Route::post('/login', [
    \App\Http\Controllers\APILoginController::class,
    'index',
])->name('login');

Route::middleware('auth:api')->group(function() {
    Route::resource('buyers', \App\Http\Controllers\Buyer\BuyerController::class)->only([
        'index',
        'show',
    ]);

    Route::resource('buyers.transactions', \App\Http\Controllers\Buyer\BuyerTransactionController::class)->only([
        'index',
    ]);

    Route::resource('buyers.products', \App\Http\Controllers\Buyer\BuyerProductController::class)->only([
        'index',
    ]);

    Route::resource('buyers.sellers', \App\Http\Controllers\Buyer\BuyerSellerController::class)->only([
        'index',
    ]);

    Route::resource('buyers.categories', \App\Http\Controllers\Buyer\BuyerCategoryController::class)->only([
        'index',
    ]);

    Route::resource('categories', \App\Http\Controllers\Category\CategoryController::class)->except([
        'create',
        'edit',
    ]);

    Route::resource('categories.products', \App\Http\Controllers\Category\CategoryProductController::class)->except([
        'create',
        'edit',
    ]);

    Route::resource('categories.sellers', \App\Http\Controllers\Category\CategorySellerController::class)->except([
        'create',
        'edit',
    ]);

    Route::resource('categories.transactions', \App\Http\Controllers\Category\CategoryTransactionController::class)->except([
        'create',
        'edit',
    ]);

    Route::resource('categories.buyers', \App\Http\Controllers\Category\CategoryBuyerController::class)->except([
        'create',
        'edit',
    ]);

    Route::resource('products', \App\Http\Controllers\Product\ProductController::class)->only([
        'index',
        'show',
    ]);

    Route::resource('products.transactions', \App\Http\Controllers\Product\ProductTransactionController::class)->only([
        'index',
    ]);

    Route::resource('products.buyers', \App\Http\Controllers\Product\ProductBuyerController::class)->only([
        'index',
    ]);

    Route::resource('products.categories', \App\Http\Controllers\Product\ProductCategoryController::class)->except([
        'create',
        'edit',
    ]);

    Route::resource('products.buyers.transactions', \App\Http\Controllers\Product\ProductBuyerTransactionController::class)->only([
        'store',
    ]);

    Route::resource('sellers', \App\Http\Controllers\Seller\SellerController::class)->only([
        'index',
        'show',
    ]);

    Route::resource('sellers.transactions', \App\Http\Controllers\Seller\SellerTransactionController::class)->only([
        'index',
    ]);

    Route::resource('sellers.buyers', \App\Http\Controllers\Seller\SellerBuyerController::class)->only([
        'index',
    ]);

    Route::resource('sellers.products', \App\Http\Controllers\Seller\SellerProductController::class)->except([
        'create',
        'edit',
    ]);

    Route::resource('transactions', \App\Http\Controllers\Transaction\TransactionController::class)->only([
        'index',
        'show',
    ]);

    Route::resource('transactions.categories', \App\Http\Controllers\Transaction\TransactionCategoryController::class)->only([
        'index',
    ]);

    Route::resource('transactions.sellers', \App\Http\Controllers\Transaction\TransactionSellerController::class)->only([
        'index',
    ]);

    Route::resource('users', \App\Http\Controllers\User\UserController::class)->except([
        'create',
        'edit',
    ]);
});

