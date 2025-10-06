<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<x-site.layouts.head />


<body>


    <!-- nav bar -->
    <x-site.layouts.navbar />
    <!-- End nav bar -->


    @yield('content')

    <!-- Upper Notify -->
    @include('site.pages.upper_notify')
    <!-- End Upper Notify -->
    @php
        $settings = \App\Settings\SettingSingleton::getInstance();
        $showPopup = (int) $settings->getCoupon('coupon_show_popup');
        $welcomeCouponId = $settings->getCoupon('welcome_coupon_id');
        $welcomePromo = null;
        if ($showPopup && $welcomeCouponId) {
            $welcomePromo = \App\Models\PromoCode::with('transNow')
                ->where('id', $welcomeCouponId)
                ->where('status', 1)
                ->where('start_at', '<=', now())
                ->where('end_at', '>=', now())
                ->first();
        }
    @endphp

    @include('site.pages.copoun')

    <!--Whatsapp-->
    @include('site.pages.whatsapp')

    <!--Whatsapp-->

    <!-- Footer -->
    <x-footer />
    <!---End Footer-->


    <!-- script  -->
    @include('site.layouts.script')
    <!-- End script  -->

    
{!!    \App\Settings\SettingSingleton::getInstance()->getScript('footer_script') !!}

</body>

</html>
