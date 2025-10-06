@extends('site.app')

@section('content')
    <!-- Slider -->
    <x-slider />
    <!-- End Slider -->

    @include('site.pages.annual-occasion')

    <!-- Categories Swiper -->

    @include('site.pages.categories.index')
    <!-- End Categories Swiper -->

       <!-- copoun -->
    @include('site.pages.copoun')
    <!-- End copoun -->


    
    <!-- Occasions Swiper -->
    <x-occasion-slider />
    <!-- End Occasions Swiper -->
    
    <!-- categories Swiper -->
    <x-Categories/>
    <!-- End categories Swiper -->

    <!-- Most Selling -->
    <x-most-selling />
    <!-- End Most Selling -->

    <!-- Offers -->
    <x-offers/>
    <!-- End Offers -->

    <!-- Plants -->
    @include('site.pages.categories.featured')
     <!-- End Plants -->

    <!-- Reviews -->
    <x-reviews :limit="10" />
    <!-- End Reviews -->
    
@endsection
