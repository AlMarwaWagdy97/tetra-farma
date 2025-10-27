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

    @livewire('site.faq.index', ['categories' => $categories], key($user->id))


@endsection
<style>
    .hero{
        margin-top: 70px !important;
    }
</style>
