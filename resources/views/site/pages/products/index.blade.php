@extends('site.app')

@section('content')

<!-- OUR PRODUCTS -->
<section class="products-section hero" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        
        <div class="text-center mb-4">
            <h2 class="section-title">@lang('messages.Our Products')</h2>
            <p class="section-sub">@lang('messages.our_products')</p>
        </div>

        @livewire('site.products.index', ['categories' => $categories])

       

    </div>
</section>


@endsection
<style>
    .hero {
        margin-top: 60px !important;
    }

</style>
