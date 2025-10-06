<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\LandscapeController;
use App\Http\Controllers\Api\MenueController;
use App\Http\Controllers\Api\OccasionController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\Pages\MainPageController;
use App\Http\Controllers\Api\PagesController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ServiceCategoryController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\WhatsAppContactsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('products', ProductController::class);
Route::get('low_to_high', [ProductController::class, 'priceLowToHigh']);
Route::get('high_to_low', [ProductController::class, 'priceHighToLow']);
Route::get('products_search', [ProductController::class, 'search']);


Route::apiResource('occasions', OccasionController::class);
Route::apiResource('categories', ProductCategoryController::class);
Route::apiResource('service_categories', ServiceCategoryController::class);
Route::get('service_categories_search', [ServiceCategoryController::class, 'search']);


Route::get('menu', [MenueController::class, 'index']);
Route::get('main_page', [MainPageController::class, 'index']);
Route::get('pages', [PagesController::class, 'show']);
Route::post('contact_us', [\App\Http\Controllers\Api\ContactUsController::class, 'store']);
Route::get('service/{id}', [ServiceController::class, 'show']);
Route::get('events', [ServiceController::class, 'showEventsService']);


///*****************test********************/
//Route::post('order-details', [OrderController::class, 'subOrderStore']);
//Route::post('order', [OrderController::class, 'store']);
//Route::post('set_cookie', [OrderController::class, 'setCookies']);
//Route::get('get_cookie', [OrderController::class, 'getCookieIndex']);
////Route::post('delete-cart', [OrderController::class, 'deleteCart']);
///***************test*******************/


/******cart*********/
Route::get('cart', [CartController::class, 'index']);
Route::post('add-to-cart', [CartController::class, 'store']);
Route::post('cart-empty', [CartController::class, 'deleteCart']);
Route::post('update-quantity', [CartController::class, 'updateQty']);
Route::post('plus-quantity', [CartController::class, 'plusQtyFunc']);
Route::post('minus-quantity', [CartController::class, 'minusQtyFunc']);
Route::post('empty-cart', [CartController::class, 'deleteCart']);
Route::post('delete-item', [CartController::class, 'deleteItemFromCart']);
Route::get('show-cart', [CartController::class, 'showCartFunc']); //by cookie
Route::get('show-recent-cart', [CartController::class, 'showCartFuncByParam']); //by params
Route::get('cart-items', [CartController::class, 'cartIems']); //by params


/*******end cart**********/

/*****************test********************/
//Route::post('checkout', [OrderController::class, 'checkout']); //old checkout
/**********orders********/
Route::post('order-checkout', [CheckoutController::class, 'newCheckout']);   //the newest  and the used route for checkout
Route::get('show-order', [OrderController::class, 'showByCookie']);
Route::get('order/{id}', [OrderController::class, 'show']);
Route::post('delete-order/{id}', [OrderController::class, 'deleteOrderById']);
Route::post('delete-order-cookie', [OrderController::class, 'deleteOrderByCookie']);
Route::get('get-customer-cookies', [OrderController::class, 'getCustomerCookies']);


Route::get('order-shipping-status', [OrderController::class, 'showShippingStatusById']); // by id
Route::get('order-shipping-status-cookie', [OrderController::class, 'showShippingStatusByCookie']); // by cookie
Route::get('show-order-shipping-status/{identifier}', [OrderController::class, 'showShippingStatusByIdentifier']); // identifier
/*********end orders ******/



/*****promo codes ******/
Route::get('promo-codes', [OrderController::class, 'ShoWPromoCodes']);




Route::prefix('reviews')->group(function () {
    Route::controller(ReviewController::class)->group(function () {
        Route::post('add', 'store');
        Route::get('list', 'index');
    });
});

Route::prefix('rating')->group(function () {
    Route::controller(RatingController::class)->group(function () {
        Route::post('add', 'store');
    });
});

Route::prefix('whatsapp-contacts')->group(function (){

        Route::controller(WhatsAppContactsController::class)->group(function () {
            Route::get('list', 'index');
        });

});


Route::prefix('payment-methods')->group(function (){
    Route::controller( PaymentMethodController::class)->group(function () {
        Route::get('list', 'index');
    });
});
/***************test*******************/


/******end cart*********/


// AlMarwa
Route::get('/home', [MainPageController::class, 'show']);


