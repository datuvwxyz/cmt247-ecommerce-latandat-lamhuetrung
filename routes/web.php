<?php

namespace App\Http;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;

// chạy lệnh php artisan db:seed để tạo tài khoản admin
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name(name: 'dashboard')->middleware(AdminMiddleware::class);

Route::get('/welcome', [HomeController::class, 'index'])->name(name: 'welcome')->middleware(UserMiddleware::class);
// ->middleware(['auth', 'verified'])->name('welcome')


Route::get('/dashboard', [HomeController::class, 'dashboard'])->name(name: 'dashboard');
// ->middleware(['auth', 'verified'])->name('dashboard')

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::withoutMiddleware([AdminMiddleware::class])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(UserMiddleware::class);
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/store', [StoreController::class, 'index'])->name('store');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/', [HomeController::class, 'index'])->name('home') ;
});

Route::withoutMiddleware([UserMiddleware::class])->group(function () {
    Route::resource('categories', CategoryController::class);
});

// //ADMIN LÀM TRƯỚC CHỈNH SỬA SAU
// Route::get('/listCategory', [CategoryController::class, 'index'])->name('listCategory');
// Route::get('/addCategory', [CategoryController::class, 'add'])->name('addCategory');

// Route::get('/listBrand', [BrandController::class, 'index'])->name('listBrand');
// Route::get('/addBrand', [BrandController::class, 'add'])->name('addBrand');

// Route::get('/listProduct', [AdminProductController::class, 'index'])->name('listProduct');
// Route::get('/addProduct', [AdminProductController::class, 'add'])->name('addProduct');

// Route::get('/listOrder', [OrderController::class, 'index'])->name('listOrder');
// Route::get('/addOrder', [OrderController::class, 'add'])->name('addOrder');

// Route::get('/listReview', [ReviewController::class, 'index'])->name('listReview');
