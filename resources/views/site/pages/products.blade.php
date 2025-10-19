<!-- OUR PRODUCTS -->
<section class="products-section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">@lang('messages.Our Products')</h2>
            <p class="section-sub">@lang('messages.our_products')</p>
        </div>
        <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
            @forelse ($products as $product)
                <div class="col">
                    <a href="{{ route('site.products.show', $product->id) }}" class="text-decoration-none" aria-label="{{ $product->transNow->title }}">
                        <div class="product-card">
                            <div class="product-media">
                                <img src="{{ asset($product->path() . $product->image) }}" alt="{{ $product->transNow->title }}">
                            </div>
                            <div class="product-footer">
                                <div class="product-title">{{ $product->transNow->title }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col text-center">
                    <p>{{ __('messages.no_products') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>