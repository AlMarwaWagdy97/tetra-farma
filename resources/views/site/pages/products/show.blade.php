@extends('site.app')

@section('content')
    <!-- ================== HEADER / BREADCRUMB ================== -->
    <section class="hero" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="shell">
            <div class="crumb">
                <a class=" color: #d6103d !important" href="../index.html">Home</a> › <a href="./product.html">Products</a>
            </div>
            <h1 class="p-title">{{ $product->transNow->title }}</h1>
            {{-- <div class="p-sub">{!! $product->transNow->description !!}</div> --}}
            <div class="under"></div>
        </div>
    </section>

    <!-- ================== PRODUCT BODY ================== -->
    <section class="shell grid"dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
@livewire('site.gallery', ['galleryGroup' => optional($product->galleryGroup)->id])
        <!-- Details -->
        <aside class="panel">
            <div class="price">
                @if ($product->price_after_sale !== $product->price)
                    <div class="main">{{ $product->price_after_sale }}</div>
                    <div class="pricediv text-decoration-line-through">{{ $product->price }}</div>
                @else
                    <div class="main">{{ $product->price }}</div>
                @endif
            </div>
            @if ($product->has_pockets && $product->pockets->count())
                <div class="chips">
                    @foreach ($product->pockets as $pocket)
                        <span class="chip">{{ $pocket->pocket_name }}</span>
                    @endforeach
                </div>
            @endif
            <p class="lead">
                {!! $product->transNow->description !!}
            </p>

            <div class="btns">
                <a class="btn primary" href="{{ $product->url }}" target="_blank" rel="noopener">@lang('products.buy_now')</a>
            </div>
            <div class="meta">
                <div class="card">
                    <div class="title">@lang('products.form')</div>
                    {{ $product->transNow->form }}
                </div>
                <div class="card">
                    <div class="title">@lang('products.servings')</div>
                    {{ $product->transNow->servings }}
                </div>
                <div class="card">
                    <div class="title">@lang('products.category')</div>
                    {{ $product->transNow->category }}
                </div>
                <div class="card">
                    <div class="title">@lang('products.dispatch')</div>
                    {{ $product->transNow->dispatch }}
                </div>
            </div>
        </aside>
    </section>
@endsection
<style>
    .title {
        font-weight: 600;
        font-size: 1.5rem !important;
        
    }
    .pricediv{
        font-size: 1.5rem !important;
    }
    .hero{
        margin-top: 60px !important;
    }
</style>