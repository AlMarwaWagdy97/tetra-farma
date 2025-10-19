<?php

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\JobController;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\CardController;

use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\HomeController;


use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\ShopController;
use App\Http\Controllers\Site\LoginController;
use App\Http\Controllers\Site\AboutController;

use App\Http\Controllers\Site\ReviewController;

use App\Http\Controllers\Site\SearchController;

use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\RegisterController;
use App\Http\Controllers\Site\ServicesController;
use App\Http\Controllers\Site\ContactUsController;
use App\Http\Controllers\Site\FaqController;
use App\Http\Controllers\Site\NewController;
use App\Http\Controllers\Site\SubscribeController;
use App\Http\Controllers\Site\ServiceCategoryController;
use App\Http\Controllers\Site\WhatsAppContactController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'], // Route translate middleware
    'as' => 'site.'
], function () {


    Route::controller(RegisterController::class)->group(function () {
        Route::get('register',                 'showRegistrationForm')->name('register');
        Route::post('register',                 'register');
        Route::get('verify-otp/{user}',        'showOtpForm')->name('verify.otp');
        Route::post('verify-otp/{user}',        'verifyOtp');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('login',                    'showLoginForm')->name('login');
        Route::post('login',                    'login');
        Route::get('verify-otp-login/{user}',  'showOtpLoginForm')->name('verify.otp.login');
        Route::post('verify-otp-login/{user}',  'verifyOtpLogin');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile',       'show')->name('profile.show');
        Route::get('profile/edit', 'edit')->name('profile.edit');
        Route::post('profile',       'update')->name('profile.update');
        Route::get('profile/orders', 'orders')->name('profile.orders');
    });


    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'home')->name('home');
    });
    Route::get('/card/{id}', [CardController::class, 'show'])->name('card.show');

    Route::controller(PageController::class)->group(function () {
        Route::get('pages/{slug}', 'show')->name('pages.show');

    });
    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us');
    Route::post('contact-us', [ContactUsController::class, 'store'])->name('contact.store');

    Route::get('faq-questions', [FaqController::class, 'index'])->name('faq-questions');
    Route::get('about-us', [AboutController::class, 'index'])->name('about-us');



    Route::get('/blogs', [BlogController::class, 'index'])
        ->name('site.blogs.index');
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])
        ->name('site.blogs.show');

    Route::get('/news', [NewController::class, 'index'])
        ->name('news.index');
    Route::get('/news/{news}', [NewController::class, 'show'])
        ->name('news.show');


    Route::controller(ServicesController::class)->group(function () {
        Route::get('services', 'index')->name('services.index');
        Route::get('services/{slug}', 'show')->name('services.show');
        Route::get('services/by-occasion', 'byOccasion')->name('services.by-occasion');
        Route::get('services/by-product', 'byProduct')->name('services.by-product');
        Route::get('services/custom-bouquet', 'customBouquet')->name('services.custom-bouquet');
        Route::get('services/weddings', 'show')->defaults('slug', 'weddings');
        Route::get('services/birthdays', 'show')->defaults('slug', 'birthdays');
    });

    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe.store');

    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/Products', [ProductController::class, 'index'])->name('products.index');

    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/whatsapp', [WhatsAppContactController::class, 'index'])->name('site.whatsapp');


    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart');

        Route::post('/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');

        Route::delete('/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    });

    Route::get('search', [SearchController::class, 'index'])->name('search.index');

    Route::get('search/results', [SearchController::class, 'results'])->name('search.results');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');  
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/orders/{order}', function (App\Models\Order $order) {
        $order->load('orderDetails.product');
        return view('site.pages.order_details', compact('order'));
    })->name('orders.show');


    Route::get('/landscape', [ServiceCategoryController::class, 'showLandscapePage'])->name('landscape');
    Route::get('events', [ServiceCategoryController::class, 'showEventPage'])->name('events');

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{slug}', [JobController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{slug}/apply', [JobController::class, 'apply'])->name('jobs.apply');
});
