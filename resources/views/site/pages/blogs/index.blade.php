@extends('site.app')

@section('title', 'Dalia El Haggar' . ' | ' . 'Blogs');


@section('content')
    @php
        $isRtl = app()->getLocale() === 'ar';
    @endphp

    <div class="container blogs py-5">

        @if ($blogs->count())
            @php
                $first = $blogs->last();
                $t0 = $first->transNow;
            @endphp
            <div class="featured-blog mb-5">
                <h1 class="fw-bold">{{ @$t0->title }}</h1>
                {!! @$t0->description !!}

                <hr class="w-100 m-5 mx-auto" style="border-top: 3px solid #aaa9a9;">


            </div>
        @endif

        <div class="row mt-5  content-blog g-4">
            @foreach($blogs as $blog)
            @if($blog->id === $first->id)
                @continue
            @endif

             @php
                $t = $blog->transNow;
                $index = $loop->index + 1; 
                $flexDirection = ($index % 2 === 0)
                    ? ($isRtl ? 'flex-md-row-reverse' : 'flex-md-row')
                    : ($isRtl ? 'flex-md-row' : 'flex-md-row-reverse');
            @endphp

                <div class="col-12">
                    <div
                        class="card mb-5 border-0 d-flex justify-content-center align-items-center gap-4 flex-column {{ $flexDirection }}">
                        @if ($blog->image)
                            <div style="flex: 0 0 40%;">
                                <img src="{{ asset($blog->pathInView()) }}"
                                    class="img-fluid img-blog object-fit-cover rounded-start" alt="no blog">
                            </div>
                        @endif

                        <div class="card-bodyy d-flex flex-column">
                            <a class="text-decoration-none link-blog  " href="{{ route('site.site.blogs.show', $blog) }}">
                            <h2 class="card-title title-blog text-dark fw-bold">{{ $t?->title }}</h2>

                            </a>
                            <p class="card-text fs-5 desc-blog text-muted flex-grow-1">
                                {!! \Illuminate\Support\Str::limit(@$t->description, 270, '...') !!} </p>
                            <a href="{{ route('site.site.blogs.show', $blog) }}"
                                class=" text-decoration-none see-blog fw-bold main-color text-primary align-self-start">
                                {{ __('messages.see_more') }} &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                      {{-- @empty
                <div class="col-12">
                    <p class="text-center text-muted">{{ __('messages.no_blogs_found') }}</p>
                </div>
            @endforelse --}}
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection

<style>
    .link-blog:hover {
        text-decoration-line: underline   !important;
       color: #000000 !important;
    }
    .see-blog:hover {
        /* color: #d3f745 !important; */
    }
</style>
