@extends('site.app')

@section('title', 'Tetra Pharma' . ' | ' . 'About Us')

@section('content')
    <!-- HERO -->
    <section class="hero" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container hero-grid">
            <div class="hero-copy">
                <span class="eyebrow color_red">{{ $about->subtitle }}</span>
                <h1 class="color_blue">{{ $about->title }}</h1>
                <p class="lead">
                    {{ $about->description }}
                </p>

                <ul class="quick-links">
                    <li><a class="color_blue">@lang('about.our_story')</a></li>
                    <li><a class="color_blue">@lang('about.vision') & @lang('about.mission')</a></li>
                    <li><a class="color_blue">@lang('about.core_values')</a></li>
                </ul>

                {{-- <div class="kpis">
          <span class="pill">20+ Years</span>
          <span class="pill">Science-First</span>
          <span class="pill">Trusted by HCPs</span>
        </div> --}}
            </div>

            <div class="hero-card">
                <img class="hero-cardImg" src="{{ asset('storage/' . $about->image_background) }}" alt="logo watermark" />

                <div class="quote">

                    {{ $about->sub_description }}
                </div>
                <div class="logo-line">
                    <span class="dot"></span>
                    <span class="rule"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- STORY + CEO -->
    <section class="section about-cards" id="story" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container ac-grid">
            <!-- Card 1: Our Story -->

            <article class="ac-card">
                <div class="ac-head">
                    <span class="ac-badge">@lang('about.ceo_message')</span>
                    <h3 class="ac-title">{{ $about->ceo_title }}</h3>
                </div>

                <div class="ac-body">
                    <p>
                        {{ $about->ceo_description }}
                    </p>


                </div>

                <button class="ac-toggle" aria-expanded="false" type="button">@lang('about.see_more')</button>
            </article>
            <!-- Card 2: CEO Message -->
            <article class="ac-card">
                <div>
                    <img src="{{ asset('storage/' . $about->ceo_image) }}" alt="ceo_image">
                </div>
            </article>

        </div>
    </section>

    <!-- VISION / MISSION / SNAPSHOT -->
    <section class="section muted" id="vision" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container grid-3">
            <div class="card">
                <span class="badge color_blue">@lang('about.vision')</span>
                <p class="color_black">
                    {{ $about->vision }}
                </p>
            </div>
            <div class="card">
                <span class="badge color_blue">@lang('about.mission')</span>
                <p class="color_black">
                    {{ $about->mission }}
                </p>
            </div>
            <div class="card mini-list">
                <span class="badge color_blue">@lang('about.at_a_glance')</span>
                <ul>
                    <p class="color_black">
                        {{ $about->at_a_glance }}
                    </p>
                </ul>
            </div>
        </div>
    </section>

    <!-- VALUES -->

    <!-- Core Values Section -->
    <section class="cv-section" id="core-values" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="cv-container">

            <div class="cv-head">
                <span class="cv-badge color_blue">@lang('about.core_values')</span>
                <h2 class="cv-title color_blue">@lang('about.core_values_title')</h2>
            </div>

            <div class="cv-grid">
                <!-- 1 -->
                @forelse ($coreValues as $item)
                    <article class="cv-item">
                        <div class="cv-icon" aria-hidden="true">
                            <!-- Star -->
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 3l2.7 5.5 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.8 1-6.1-4.4-4.3 6.1-.9L12 3z" />
                            </svg>
                        </div>
                        <div class="cv-text">
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['description'] }}</p>
                        </div>
                    </article>
                @empty
                    <p> @lang('No products available') </p>
                @endforelse
            </div>

            <div class="cv-actions">
                <a class="cv-btn primary blue_btn" href="{{ route('site.products.index') }}">@lang('about.our_products')</a>
                <a class="cv-btn light color_blue" href="{{ route('site.site.blogs.index') }}">@lang('about.our_blog')</a>
            </div>
        </div>
    </section>
@endsection

<style>
    .hero {
        margin-top: 70px !important;
    }
</style>
