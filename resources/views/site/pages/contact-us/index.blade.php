@extends('site.app')
@section('title', 'Tetra Pharma' . ' | ' . 'Contact Us')
@section('content')
 <section class="page-hero wow bounceInRight" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
      <div class="kicker">@lang('home.contact')</div>
      <h1 class="title">@lang('home.contact-us')</h1>
      <p class="subtitle">@lang('home.contact-us_p')</p>
    </div>
  </section>
    @include('site.pages.contact-us.home')
@endsection
<style>
    .page-hero{
      margin-top: 80px !important; 
    }
    .subtitle{
      color: #000 !important;
    }
</style>