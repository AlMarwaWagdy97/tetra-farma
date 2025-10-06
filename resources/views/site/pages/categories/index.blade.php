<div class="MainSwiper  my-4">
    <div class="container">
        <div class="swiper categories">
            <div class="swiper-wrapper">
                @forelse ($products as $product)
                    <div class="swiper-slide cart-category rounded-3 p-0">

                        <a href="{{ route('site.products.show', $product->id) }}" class="text-decoration-none">
                            <div class="swiper-slide-category-item-icon text-center">
                                <div class="ImgBox">

                                    <img src="{{ asset($product->pathInView()) }}" class="img-fluid rounded-top"
                                        alt="{{ $product->transNow->title ?? 'No Title' }}">


                                </div>
                            </div>
                            <div
                                class="swiper-slide-product-item-text text-white cat-title d-flex flex-column justify-content-center fs-5   text-center">
                            
                             <p>{{ $product->transNow->title ?? 'No Title' }}</p>   
                            </div>
                        </a>


                    </div>
                @empty
                    <div class="swiper-slide">
                        <p>{{ __('messages.no_products') }}</p>
                    </div>
                @endforelse
            </div>

            <div class="swiper-pagination"></div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div> 
</div>
