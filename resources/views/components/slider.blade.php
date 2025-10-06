@php
    $firstVideoSlide = $slides->firstWhere('video', '!=', null);
@endphp
@if ($firstVideoSlide)

    <div class="heroVideo">

        <video class="video" autoplay muted loop playsinline>
            <source src="{{ asset($firstVideoSlide->videoInView()) }}" type="video/mp4">
        </video>
        <div class="filter"></div>
        <div class="videocontent">
            <h1 class="headerh1">
                {{ optional($firstVideoSlide->transNow)->title ??
                    ($firstVideoSlide->trans->where('locale', app()->getLocale())->first()->title ?? '') }}
            </h1>
            <p class="headerP">
                {!! $firstVideoSlide->transNow?->description ??
                    (optional($firstVideoSlide->trans->where('locale', app()->getLocale())->first())->description ?? '') !!}
            </p>
            <a href="./ProductPage/product.html"><button class="btn">Explore Our Products</button></a>
        </div>
    </div>
@else
    <div class="swiper banner">
        <div class="swiper-wrapper">
            @forelse ($slides as $slide)
                <div class="swiper-slide">
                    <a href="{{ $slide->url }}">
                        <img src="{{ asset($slide->pathInView()) }}" alt="Slide {{ $loop->index + 1 }}">
                    </a>
                </div>
            @empty
                <div class="swiper-slide">
                    <img src="{{ asset('site/img/default-slide.jpg') }}" class="img-fluid" alt="Default Slide" />
                </div>
            @endforelse
        </div>
        <div class="swiper-pagination"></div>
    </div>
@endif


<style>
    .heroVideo {
        position: relative !important;
        height: 100vh !important;
        overflow: hidden !important;
    }
</style>
