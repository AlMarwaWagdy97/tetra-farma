{{-- Reviews --}}


<!--Testimonials Carousel -->
<section id="testimonials" class="testimonial" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <h2 class="testimonialh2">@lang('reviews.reviews')</h2>

    <div id="tsl" class="testimonialslider">
        <!-- Slides -->
        @forelse ($reviews as $review)
            <div class="slide slider">
                <blockquote class="slidercontent">
                    <p>"{{ $review->description }}"</p>
                </blockquote>
                <div class="sliderbyname">{{ $review->customer_name }}</div>

            </div>
        @empty
        @endforelse






        <!-- Dots -->
        <div id="dots" aria-label="Testimonial navigation" class="Dotss">
            @for ($i = 0; $i < $reviews->count(); $i++)
                <button class="dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"
                    aria-label="Slide {{ $i + 1 }}" aria-pressed="{{ $i === 0 ? 'true' : 'false' }}"></button>
            @endfor
        </div>
    </div>
</section>
<!-- Testimonials end -->
<style>
    .Dotss { display:flex; gap:8px; justify-content:center; margin-top:16px; }
.dot {
    width:12px; height:12px; border-radius:50%; border:0; background:#0a0a0a; cursor:pointer;
    transition: transform .15s, background .15s;
}
.dot.active { background:#d6103d; transform:scale(1.15); }

</style>