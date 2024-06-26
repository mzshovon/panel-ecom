<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomePageController::class, 'home'])->name('home');
Route::get('/about', [HomePageController::class, 'about'])->name('about');
Route::get('/search', [FrontendProductController::class, 'search'])->name('search');
Route::get('/product/{productId}', [FrontendProductController::class, 'singleProduct'])->name('single-product');
Route::get('/category/{catId}', [FrontendProductController::class, 'porductsByCategory'])->name('category-product');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        'users' => UserController::class,
        'products' => ProductController::class,
    ]);

    Route::put('/users/status/{user}', [UserController::class, 'statusChange'])->name('users.status.change');
});

