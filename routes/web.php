<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/publishing-partners', [HomeController::class, 'publishingPartners'])->name('publishing.partners');
Route::get('/distributorship', [DistributorController::class, 'index'])->name('distributorship');
Route::get('/load-more-categories', [HomeController::class, 'loadMoreCategories'])->name('load.more.categories');
Route::get('/category/{id}', [HomeController::class, 'categoryProducts'])->name('category.products');
Route::get('/product/{id}', [HomeController::class, 'productDetail'])->name('product.detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Categories
    Route::resource('categories', AdminCategoryController::class);
    
    // Products  
    Route::resource('products', AdminProductController::class);
    
    // Banners
    Route::resource('banners', AdminBannerController::class);
    
    // Distributors
    Route::get('distributors', [DistributorController::class, 'adminIndex'])->name('distributors.index');
    Route::get('distributors/create', [DistributorController::class, 'create'])->name('distributors.create');
    Route::post('distributors', [DistributorController::class, 'store'])->name('distributors.store');
    Route::get('distributors/{distributor}', [DistributorController::class, 'show'])->name('distributors.show');
    Route::get('distributors/{distributor}/edit', [DistributorController::class, 'edit'])->name('distributors.edit');
    Route::put('distributors/{distributor}', [DistributorController::class, 'update'])->name('distributors.update');
    Route::delete('distributors/{distributor}', [DistributorController::class, 'destroy'])->name('distributors.destroy');
});
