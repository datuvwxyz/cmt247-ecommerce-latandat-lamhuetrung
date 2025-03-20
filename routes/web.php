<?php

namespace App\Http;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;



Route::get('/dashboard', [HomeController::class, 'dashboard'])->name(name: 'dashboard');
// ->middleware(['auth', 'verified'])->name('dashboard')

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/store', [StoreController::class, 'index'])->name('store');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::get('/cart', [WishlistController::class, 'index'])->name('cart');
Route::get('/', [HomeController::class, 'index'])->name('home') ;
