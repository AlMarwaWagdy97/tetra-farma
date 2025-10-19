@extends('site.app')
@section('content')
    <!-- ===== HERO ===== -->
    <section class="hero" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container">
            <h1 class="color_blue">@lang('home.faq-index')</h1>
            <p class="breadcrumb"><a href="../index.html" target="_blank">@lang('home.home')</a> / @lang('home.faq')</p>
            <p class="lead">@lang('home.faq-index_p')</p>
        </div>
    </section>

    <!-- ===== FAQ CONTENT ===== -->
    <section dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container faq-wrap">
            <!-- Sidebar -->
            <aside class="faq-side">
                <h3>@lang('home.faq-index_h3')</h3>
                <p class="mini">@lang('home.faq-index_pp')</p>
                <div class="faq-cta">
                    <a class="btn primary blue_btn" href="{{ route('site.contact-us')}}">@lang('home.contact')</a>
                    <a class="btn light blue_btn" href="{{ route('site.site.blogs.index')}}">@lang('home.read')</a>
                </div>
            </aside>

            <!-- Main -->
            <div>
                {{-- <div class="faq-controls">
        <div class="search searchstyle">
          <span class="sfx">🔎</span>
          <input id="faqSearch" type="search" placeholder="Search in questions..." />
        </div>

        <div class="tools">
          <button id="expandAll" class="btn light color_blue" type="button">Expand all</button>
          <button id="collapseAll" class="btn light color_blue" type="button">Collapse all</button>
        </div>
      </div> --}}

                <div class="faq">

                    @forelse ($faq_questions as $question)
                        <details data-tags="science,quality" open>
                            <summary><span class="dot"></span> {{ $question->question }}</summary>
                            <div class="content">
                                <p> {!! $question->answer !!}
                                </p>
                            </div>
                        </details>
                    @empty
                        <p>@lang('home.no_faq')</p>
                    @endforelse



                </div>

                <!-- Filter chips -->
                <div class="faq-controls controls">
                    @forelse ($categories as $category)
                    <span class="chip" data-tag="science">{{ $category->title }}</span>
                        
                    @empty
                    <p>@lang('home.no_faq')</p>
                    @endforelse
              
                    
                </div>
            </div>
        </div>
    </section>
@endsection
<style>
    .hero{
        margin-top: 70px !important;
    }
</style>
