<?php

namespace App\Http\Controllers\Site;

use App\Models\Blog;
use App\Models\News;
use App\Models\About;
use App\Models\Menue;
use App\Models\Partner;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\PaymentMethod;
use App\Models\ProductCategory;
use App\Models\AboutTranslation;
use App\Settings\SettingSingleton;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCategoryTranslation;

class HomeController extends Controller
{
    public function home()
    {

        $current_lang       = app()->getLocale();
        $settings   = SettingSingleton::getInstance();
        $showPopup  = (int) $settings->getCoupon('coupon_show_popup');
        $about_us = About::with('transNow')->first();
        if (!$about_us) {
            $about_us = new About();
            $about_us->transNow = new AboutTranslation();
        }
        $blogs = Blog::with('translations')->take(3)->get();
        $partners = Partner::with('translations')->where('status', 1)->get();
        $news = News::with('translations')->where('status', 1)->get();
        $faq_questions = Faq::with('translations')->where('status', 1)->get();


        $welcomeCouponId = $settings->getCoupon('welcome_coupon_id');
        $welcomePromo    = null;
        if ($showPopup && $welcomeCouponId) {
            $welcomePromo = PromoCode::with('transNow')
                ->where('id', $welcomeCouponId)
                ->where('status', 1)
                ->where('start_at', '<=', now())
                ->where('end_at', '>=', now())
                ->first();
        }


        $page_name          = 'home';
        $products           = Product::with('transNow')->active()->take(3)->get();

        $productCategories = ProductCategory::with(['transNow', 'products.rates', 'products' => fn($q) => $q->active()->with('transNow')->where('show_in_cart', 0)])->active();

        $featuredCategories = (clone $productCategories)->show_in_bottom()->get();
        $annualCategories   = (clone $productCategories)->annual_occasion()->get();

        $paymentMethods     = PaymentMethod::with('transNow')->where('status', 'active')->get();

        return view('site.pages.index', compact(
            'settings',
            'current_lang',
            'page_name',
            'products',
            'featuredCategories',
            'annualCategories',
            'paymentMethods',
            'welcomePromo',
            'showPopup',
            'about_us',
            'blogs',
            'partners',
            'news',
            'faq_questions'
        ));
    }
}
