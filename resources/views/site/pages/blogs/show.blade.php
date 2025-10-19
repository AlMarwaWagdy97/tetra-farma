@extends('site.app')
@section('content')
<div class="container hero blog-page pt-5 py-5" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="row">
        <div class="col-md-12 d-flex flex-column align-items-center">
            @if($blog->image)
                <img src="{{ asset(@$blog->pathInView()) }}"
                     class="img-thumbnail w-50" alt="{{ @$blog->transNow->title }}">
            @endif 
        </div>
        <div class="col-md-12 mt-5 fs-5 d-flex flex-column align-items-center">
               <h1 class="mb-3">{{ @$blog->transNow->title }}</h1>
            <div class="blog-description">
                {!! @$blog->transNow->description !!}
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    .blog-page{
        margin-top: 140px;
    }
</style>
<style>
    .hero{
        margin-top: 70px !important;
    }
</style>