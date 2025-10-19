@extends('site.app')

@section('content')
    <!-- Slider -->
    <x-slider />
    <!-- End Slider -->


   <!-- About -->
    @include('site.pages.about')

    <!-- Products -->
    @include('site.pages.products')

    
    <!-- Jobs -->
    @include('site.pages.careere')


        <!-- Blogs -->
    @include('site.pages.blogs')

        <!-- our-partner -->
    @include('site.pages.our-partner')
        <!-- news -->
    @include('site.pages.news')
        <!-- contact us -->
    @include('site.pages.contact-us.home')

        <!-- Reviews -->
    <x-reviews :limit="10" />
    <!-- End Reviews -->
        <!-- FAQ -->
    @include('site.pages.faq_questions')







    
@endsection
