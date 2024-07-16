<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\CartController;
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

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::get('/signup', [CustomLoginController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [CustomLoginController::class, 'showSignupForm'])->name('signup');
Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomLoginController::class, 'login'])->name('login');
Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');

Route::get('/', [HomePageController::class, 'home'])->name('home');

Route::get('/about', [HomePageController::class, 'about'])->name('about');
Route::get('/search', [FrontendProductController::class, 'search'])->name('search');
Route::get('/product/{productId}', [FrontendProductController::class, 'singleProduct'])->name('single-product');
Route::post('/product/review', [FrontendProductController::class, 'storeProductReview'])->name('store-review');
Route::get('/category/{catId}', [FrontendProductController::class, 'porductsByCategory'])->name('category-product');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'index'])->name('cart.items');
Route::get('/cart/page', [CartController::class, 'viewCart'])->name('cart.page');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        'users' => UserController::class,
        'products' => ProductController::class,
    ]);

    Route::put('/users/status/{user}', [UserController::class, 'statusChange'])->name('users.status.change');
});

