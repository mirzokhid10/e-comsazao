<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

///////////////////////////////////////////
////    Admin Controller Route
///////////////////////////////////////////

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');

///////////////////////////////////////////
////    Flash Sale Controller Route
///////////////////////////////////////////

Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

///////////////////////////////////////////
////    FrontEnd Product Controller Route
///////////////////////////////////////////

Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');

///////////////////////////////////////////
////    Add To Cart Routes
///////////////////////////////////////////

Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQty'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');
Route::post('cart/remove-sidebar-product', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
Route::get('cart/sidebar-product-total', [CartController::class, 'cartTotal'])->name('cart.sidebar-product-total');

Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');
///////////////////////////////////////////
////    User Controller Route
///////////////////////////////////////////

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile'); // user.profile
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update'); // user.profile.update
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password'); // user.profile.password

    ///////////////////////////////////////////
    ////    User Address Controller Route
    ///////////////////////////////////////////

    Route::resource('address', UserAddressController::class);

    ///////////////////////////////////////////
    ////    CheckOut Controller Routes
    ///////////////////////////////////////////

    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('checkout/address-create', [CheckOutController::class, 'createAddress'])->name('checkout.address.create');
    Route::post('checkout/form-submit', [CheckOutController::class, 'checkOutFormSubmit'])->name('checkout.form-submit');

    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    ///////////////////////////////////////////
    ////    Paypal Routes Controller Routes
    ///////////////////////////////////////////

    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    ///////////////////////////////////////////
    ////    Stripe Routes Controller Routes
    ///////////////////////////////////////////

    Route::post('stripe/payment', [PaymentController::class,'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
});
