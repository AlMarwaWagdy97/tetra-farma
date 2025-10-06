<?php

namespace App\Http\Controllers\Site;

use App\Models\Menue;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\PaymentMethod;
use App\Models\ProductCategory;
use App\Settings\SettingSingleton;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCategoryTranslation;

class HomeController extends Controller
{
    public function home()
    {
        $settings   = SettingSingleton::getInstance();
        $showPopup  = (int) $settings->getCoupon('coupon_show_popup');

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

        $current_lang       = app()->getLocale();
        $page_name          = 'home';
        $products           = Product::with('transNow')->active()->feature()->show_in_slider()->where('show_in_cart', 0)->get();

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
            'showPopup'
        ));
    }
}
