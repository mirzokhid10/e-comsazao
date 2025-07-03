<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileManagmentController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

///////////////////////////////////////////
////    Slider Controller Route
///////////////////////////////////////////

Route::resource('slider', SliderController::class);

///////////////////////////////////////////
////    Categories Controller Route
///////////////////////////////////////////

Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

Route::put('childcategory/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

///////////////////////////////////////////
////    Brand Controller Route
///////////////////////////////////////////

Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

///////////////////////////////////////////
////    Admin Vendor Profile Managment Route
///////////////////////////////////////////

Route::put('vendor-profile/change-status', [AdminVendorProfileManagmentController::class, 'changeStatus'])->name('vendor-profile.change-status');
Route::resource('vendor-profile', AdminVendorProfileManagmentController::class);

///////////////////////////////////////////
////    Admin Product Routes
///////////////////////////////////////////

Route::get('products/get-subcategories', [ProductController::class, 'getSubCategories'])->name('products.get-subcategories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('products.get-child-categories');
Route::put('products/change-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
Route::resource('products', ProductController::class);

///////////////////////////////////////////
////    Admin Product Image Gallery Route
///////////////////////////////////////////

Route::resource('products-image-gallery', ProductImageGalleryController::class);

///////////////////////////////////////////
////    Admin Product Variant Route
///////////////////////////////////////////

Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);
