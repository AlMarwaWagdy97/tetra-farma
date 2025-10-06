@extends('site.app')

@section('content')
    <div class="container single-product py-4 pt-5">
        @livewire('site.product-show', ['product' => $product])
        
    </div>
@endsection











