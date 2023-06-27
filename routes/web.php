<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
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

// frontend routes
Route:: as ('front.')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('shop', [PageController::class, 'shop'])->name('shop');
    Route::get('product/{slug}', [PageController::class, 'singleProduct'])->name('shop.single');

    // add to cart
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::get('load-cookie-data', [CartController::class, 'loadCookieData'])->name('cart.load');

    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
});

// backend routes
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    //Slider
    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::match (['get', 'post'], 'slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::match (['get', 'put'], 'slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::delete('slider/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');

    //Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::match (['get', 'post'], 'category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::match (['get', 'put'], 'category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    //Product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::match (['get', 'post'], 'product/create', [ProductController::class, 'create'])->name('product.create');
    Route::match (['get', 'put'], 'product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
