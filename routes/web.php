<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductTrackController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserVendorRequestController;
use App\Http\Controllers\Frontend\WishListController;
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

Route::get('products', [FrontendProductController::class, 'productsIndex'])->name('products.index');
Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');
Route::get('change-product-list-view', [FrontendProductController::class, 'chageListView'])->name('change-product-list-view');

Route::get('show-product-modal/{id}', [HomeController::class, 'ShowProductModal'])->name('show-product-modal');

///////////////////////////////////////////
////    About Page Routes
///////////////////////////////////////////

Route::get('about', [PageController::class, 'about'])->name('about');
Route::get('terms-and-conditions', [PageController::class, 'termsAndCondition'])->name('terms-and-conditions');

///////////////////////////////////////////
////    Contact Page Routes
///////////////////////////////////////////

Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact', [PageController::class, 'handleContactForm'])->name('handle-contact-form');

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
////    Vendor Page Routes
///////////////////////////////////////////

Route::get('vendors', [HomeController::class, 'vendorPage'])->name('vendor.index');
Route::get('vendor-product/{id}', [HomeController::class, 'vendorProductsPage'])->name('vendor.products');

///////////////////////////////////////////
////    Product Tracking Routes
///////////////////////////////////////////

Route::get('product-tracking', [ProductTrackController::class, 'index'])->name('product-tracking.index');

///////////////////////////////////////////
////    Blog Routes
///////////////////////////////////////////

Route::get('blog-details/{slug}', [BlogController::class, 'blogDetails'])->name('blog-details');
Route::get('blog', [BlogController::class, 'blog'])->name('blog');


///////////////////////////////////////////
////    Add Product To Wishlist
///////////////////////////////////////////

Route::get('wishlist/add-product', [WishListController::class, 'addToWishlist'])->name('wishlist.store');

///////////////////////////////////////////
////    Newsletter Request
///////////////////////////////////////////

Route::post('newsletter-request', [NewsletterController::class, 'newsLetterRequset'])->name('newsletter-request');
Route::get('newsletter-verify/{token}', [NewsletterController::class, 'newsLetterEmailVarify'])->name('newsletter-verify');

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

    Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');

    ///////////////////////////////////////////
    ////    User Order Controller Routes
    ///////////////////////////////////////////

    Route::get('order', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('order/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');

    ///////////////////////////////////////////
    ////    Wish List Controller Routes
    ///////////////////////////////////////////
    Route::get('wishlist', [WishListController::class, 'index'])->name('wishlist.index');
    Route::get('wishlist/remove-product/{id}', [WishListController::class, 'destroy'])->name('wishlist.destroy');


    ///////////////////////////////////////////
    ////    Review Controller Routes
    ///////////////////////////////////////////

    Route::get('review', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('review', [ReviewController::class, 'create'])->name('reviews.create');

    ///////////////////////////////////////////
    ////    Blog Comment Controller Routes
    ///////////////////////////////////////////

    Route::post('blog-comment', [BlogController::class, 'comment'])->name('blog-comment');

    ///////////////////////////////////////////
    ////    User Vendor Request Controller Routes
    ///////////////////////////////////////////

    Route::get('vendor-request', [UserVendorRequestController::class, 'index'])->name('vendor-request.index');
    Route::post('vendor-request', [UserVendorRequestController::class, 'create'])->name('vendor-request.create');
});