<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Auth\CustomRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\UserController as FrontendUserController;
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
// Auth::routes();
    // User auth routes
    Route::get('/signup', [CustomRegisterController::class, 'showRegistrationForm'])->name('signup');
    Route::post('/signup', [CustomRegisterController::class, 'register'])->name('register');
    Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CustomLoginController::class, 'login'])->name('user-login');
    Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('/', [HomePageController::class, 'home'])->name('home')->middleware("traffic");
    Route::get('/about', [HomePageController::class, 'about'])->name('about')->middleware("traffic");
    Route::get('/contact-us', [HomePageController::class, 'contactUs'])->name('contact-us')->middleware("traffic");
    Route::post('/contact-us', [HomePageController::class, 'storeContactUs'])->name('contact-us-store');
    Route::get('/search', [FrontendProductController::class, 'search'])->name('search')->middleware("traffic");
    Route::get('/product/{productId}', [FrontendProductController::class, 'singleProduct'])->name('single-product')->middleware("traffic");
    Route::post('/product/review', [FrontendProductController::class, 'storeProductReview'])->name('store-review');
    Route::get('/category/{catId}', [FrontendProductController::class, 'porductsByCategory'])->name('category-product')->middleware("traffic");

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.items');
    Route::get('/cart/page', [CartController::class, 'viewCart'])->name('cart.page')->middleware("traffic");

    Route::group(['middleware' => ['auth', 'role:user']], function() {
        Route::get('/dashboard', [FrontendUserController::class, 'dashboard'])->name('dashboard');
        Route::get('/orders', [FrontendUserController::class, 'orders'])->name('user.orders');
        Route::get('/orders/details/{id}', [FrontendUserController::class, 'orderDetails'])->name('user.order.details');
        Route::post('/review', [FrontendUserController::class, 'review'])->name('user.review');
        Route::post('/cart/checkout', [CartController::class, 'checkoutOrder'])->name('orders');
        Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });

    // Admin auth routes
    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.check');
    Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:superadmin|admin']], function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/optimize', [DashboardController::class, 'optimize'])->name('optimize');
        Route::get('/cache-clear', [DashboardController::class, 'cacheClear'])->name('cache-clear');
        Route::resources([
            'users' => UserController::class,
            'products' => ProductController::class,
            'orders' => OrderController::class,
            'roles' => RoleController::class,
        ]);
        Route::put('/users/status/{user}', [UserController::class, 'statusChange'])->name('users.status.change');
        Route::post('/orders/status', [OrderController::class, 'statusChange'])->name('orders.status.change');
        Route::post('/orders/update-order-product', [OrderController::class, 'updateOrderProduct'])->name('orders.update.product');
        Route::delete('/orders/delete-order-product/{orderedProductId}', [OrderController::class, 'destroyOrderProducts'])->name('orders.delete.product');
        Route::post('/users/assign-role', [UserController::class, 'assignRole'])->name('users.assign.role');
        Route::post('/orders/pathao', [UserController::class, 'pathao'])->name('orders.pathao');
    });


