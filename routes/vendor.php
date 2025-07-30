<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorMessageController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductReviewController;
use Illuminate\Support\Facades\Route;


///////////////////////////////////////////
////    Vendor Profile Route
///////////////////////////////////////////
Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update'); // vendor.profile.update
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password'); // vendor.profile.update.password

///////////////////////////////////////////
////    Vendor Message Route
///////////////////////////////////////////

Route::get('messages', [VendorMessageController::class, 'index'])->name('messages.index');
Route::post('send-message', [VendorMessageController::class, 'sendMessage'])->name('send-message');
Route::get('get-messages', [VendorMessageController::class, 'getMessages'])->name('get-messages');
Route::post('mark-message-seen', [VendorMessageController::class, 'markMessageSeen'])->name('mark-message-seen');

///////////////////////////////////////////
////    Vendor Shop Profile Route
///////////////////////////////////////////

Route::resource('shop-profile', VendorShopProfileController::class);

///////////////////////////////////////////
////    Vendor Products Route
///////////////////////////////////////////

Route::get('products/get-subcategories', [VendorProductController::class, 'getSubCategories'])->name('products.get-subcategories');
Route::get('products/get-child-categories', [VendorProductController::class, 'getChildCategories'])->name('products.get-child-categories');
Route::put('products/change-status', [VendorProductController::class, 'changeStatus'])->name('products.change-status');
Route::resource('products', VendorProductController::class);

///////////////////////////////////////////
////    Vendor Product Gallery Images Route
///////////////////////////////////////////

Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

///////////////////////////////////////////
////    Vendor Product Variant Items Route
///////////////////////////////////////////

Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', VendorProductVariantController::class);

///////////////////////////////////////////
////    Vendor Product Variant Items Route
///////////////////////////////////////////

Route::get('products-variant-item/{productId}/{productVariantId}', [VendorProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{productVariantId}', [VendorProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item', [VendorProductVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{productVariantId}', [VendorProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{productVariantId}', [VendorProductVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{productVariantId}', [VendorProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
Route::put('products-variant-item-status', [VendorProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');

///////////////////////////////////////////
////	Vendor Orders Controller Route
///////////////////////////////////////////

Route::get('orders', [VendorOrderController::class, 'index'])->name('orders.index');
Route::get('orders/show/{id}', [VendorOrderController::class, 'show'])->name('orders.show');
Route::get('orders/status/{id}', [VendorOrderController::class, 'orderStatus'])->name('orders.status');

///////////////////////////////////////////
////	Vendor Reviews Controller Route
///////////////////////////////////////////

Route::get('reviews', [VendorProductReviewController::class, 'index'])->name('reviews.index');
