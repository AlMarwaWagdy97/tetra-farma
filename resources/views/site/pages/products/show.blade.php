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
<section class="shell grid" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

    @livewire('site.gallery', ['galleryGroup' => optional($product->galleryGroup)->id])
    <!-- Details -->
    <aside class="panel">
        <div class="price">
            @if ($product->price_after_sale !== $product->price)
            <div class="main">{{ $product->price_after_sale }} EGP </div>
            <div class="pricediv text-decoration-line-through">{{ $product->price }} EGP</div>
            @else
            <div class="main">{{ $product->price }} EGP </div>
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

        {{-- start payment Lines  --}}
        <div class="btns">
            @forelse (@$product->paymentLineActive as $lines)
            <a class="btn primary" href="{{ $lines->links }}" target="_blank" rel="noopener" style="background-color:{{ $lines->color }} !important">{{ $lines->transNow?->title }}</a>
            @empty

            @endforelse
        </div>
        {{-- end payment Lines  --}}


        <div class="meta">
            @forelse (@$product->tipsActive as $tip)
            <div class="card">
                <div class="title"> {{ $tip->transNow?->title }}</div>
                {{ $tip->transNow?->description }}
            </div>
            @empty

            @endforelse
        </div>

    </aside>
</section>


<!-- ================== INFO CARDS ================== -->
<section class="shell info">
    @forelse (@$product->infoActive as $info)
    <article class="ibox">
        <h3 class="text-danger">{{ $info->transNow?->title }}</h3>
        {!! $info->transNow?->description !!}
    </article>
    @empty

    @endforelse
</section>

@endsection
<style>
    .title {
        font-weight: 600;
        font-size: 1.5rem !important;

    }

    .pricediv {
        font-size: 1.5rem !important;
    }

    .hero {
        margin-top: 60px !important;
    }

</style>
