<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileManagmentController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
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

///////////////////////////////////////////
////    Admin Product Variant Item Route
///////////////////////////////////////////

Route::get('products-variant-item/{productId}/{productVariantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{productVariantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{productVariantId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{productVariantId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{productVariantId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
Route::put('products-variant-item-status', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');

///////////////////////////////////////////
////    Seller product routes
///////////////////////////////////////////

Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])->name('seller-pending-products.index');
Route::put('change-approve-status', [SellerProductController::class, 'changeApproveStatus'])->name('change-approve-status');

///////////////////////////////////////////
////    Flash Sale Routes
///////////////////////////////////////////

Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
Route::put('flash-sale/show-at-home/status-change', [FlashSaleController::class, 'changeShowAtHomeStatus'])->name('flash-sale.show-at-home.change-status');
Route::put('flash-sale-status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale-status');
Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destroy'])->name('flash-sale.destroy');

///////////////////////////////////////////
////    Main Page Settings Route
///////////////////////////////////////////

Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
Route::put('generale-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('generale-setting-update');

///////////////////////////////////////////
////    Coupons Controller Route
///////////////////////////////////////////

Route::put('coupon/change-status', [CouponController::class, 'changeStatus'])->name('coupon.change-status');
Route::resource('coupon', CouponController::class);

///////////////////////////////////////////
////    Shiping Rule Controller Route
///////////////////////////////////////////

Route::put('shipping-rule/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
Route::resource('shipping-rule', ShippingRuleController::class);

///////////////////////////////////////////
////    Paypal Setting Controller
///////////////////////////////////////////

Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
Route::resource('paypal-setting', PaypalSettingController::class);
