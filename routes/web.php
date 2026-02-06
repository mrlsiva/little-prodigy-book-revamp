<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/load-more-categories', [HomeController::class, 'loadMoreCategories'])->name('load.more.categories');
Route::get('/category/{id}', [HomeController::class, 'categoryProducts'])->name('category.products');
Route::get('/product/{id}', [HomeController::class, 'productDetail'])->name('product.detail');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Categories
    Route::resource('categories', AdminCategoryController::class);
    
    // Products  
    Route::resource('products', AdminProductController::class);
});
