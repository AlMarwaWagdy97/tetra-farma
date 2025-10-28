<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\JobController;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\ContactUsController;
use App\Http\Controllers\Site\FaqController;
use App\Http\Controllers\Site\NewController;
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

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'home')->name('home');
    });

    Route::controller(PageController::class)->group(function () {
        Route::get('pages/{slug}', 'show')->name('pages.show');
    });

    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us');
    Route::post('contact-us', [ContactUsController::class, 'store'])->name('contact.store');

    Route::get('faq-questions', [FaqController::class, 'index'])->name('faq-questions');
    Route::get('about-us', [AboutController::class, 'index'])->name('about-us');

    Route::get('/blogs', [BlogController::class, 'index'])->name('site.blogs.index');
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('site.blogs.show');

    Route::get('/news', [NewController::class, 'index'])->name('news.index');
    Route::get('/news/{news}', [NewController::class, 'show'])->name('news.show');

    Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{slug}', [JobController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{slug}/apply', [JobController::class, 'apply'])->name('jobs.apply');
});
