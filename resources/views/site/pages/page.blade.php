@extends('site.app')

@php
$settings = \App\Settings\SettingSingleton::getInstance();
$pages = \App\Models\PagesTranslation::where('title', 'about-us')->first();
@endphp

@section('title', 'Dalia El Haggar' . ' | ' .  'About Us')

@section('title', $settings->getMeta('page_meta_title_' . $current_lang) ?? 'Default Title ')
@section('meta_key', $settings->getMeta('page_meta_key_' . $current_lang) ?? 'Default Keywords')
@section('meta_description', $settings->getMeta('page_meta_description_' . $current_lang) ?? 'Default Description')

@section('content')


<div class="container page my-5 pt-5 rounded" @if(app()->getLocale() =="ar") dir="rtl" @else dir="ltr" @endif>
    <div class="row py-5">
        <div class="col-lg-6 col-12 text-center  wow bounceInLeft">
            <h1 class="text-main main-color"> {{ @$page->trans->where('locale', $current_lang)->first()->title }}</h1>
            <h5 class="my-5 px-5 text-muted">
                {!! @$page->trans->where('locale', $current_lang)->first()->content !!}
            </h5>
        </div>
        <div class="col-lg-6 col-12 text-center wow bounceInRight">
            <img src="{{ asset(@$page->image) }}" class="img-fluid rounded" alt="">
        </div>
    </div>
</div>




@endsection
