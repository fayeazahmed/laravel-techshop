<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [ProductController::class, 'welcome']);
Route::get('/about', [ProductController::class, 'about']);

Route::group(['prefix' => 'products'], function () {
    Route::get('/{category}', [ProductController::class, 'index']);
    Route::post('/{category}', [ProductController::class, 'index']);
    Route::get('/details/{id}', [ProductController::class, 'details']);
    Route::get('/search/{query}', [ProductController::class, 'search']);
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/add/{id}', [OrderController::class, 'add']);
    Route::get('/remove/{id}/{all}', [OrderController::class, 'remove']);
    Route::get('/checkout', [OrderController::class, 'checkout'])->middleware('auth');
    Route::post('/checkout', [OrderController::class, 'store'])->middleware('auth');
});

Route::group(['prefix' => 'account', 'middleware' => 'auth'], function () {
    Route::get('/', [AccountController::class, 'index']);
    Route::get('/edit', [AccountController::class, 'edit']);
    Route::post('/edit', [AccountController::class, 'edit']);
    Route::get('/orders/{id}', [AccountController::class, 'orders']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::post('/', [AdminController::class, 'index']);
    Route::get('/users/{id}', [AdminController::class, 'users']);
    Route::delete('/users/{id}', [AdminController::class, 'users']);

    Route::post('/categories/{id}', [AdminController::class, 'categories']);
    Route::patch('/categories/{id}', [AdminController::class, 'categories']);
    Route::delete('/categories/{id}', [AdminController::class, 'categories']);

    Route::post('/featureds', [AdminController::class, 'featureds']);
    Route::delete('/featureds', [AdminController::class, 'featureds']);

    Route::get('/products/create', [AdminController::class, 'create']);
    Route::post('/products/create', [AdminController::class, 'create']);
    Route::get('/products/{id}', [AdminController::class, 'products']);
    Route::patch('/products/{id}', [AdminController::class, 'products']);
    Route::delete('/products/{id}', [AdminController::class, 'products']);

    Route::get('/orders', [AdminController::class, 'orders']);
    Route::post('/orders', [AdminController::class, 'orders']);
    Route::get('/orders/{id}', [AdminController::class, 'orderDetails']);
});


require __DIR__ . '/auth.php';
