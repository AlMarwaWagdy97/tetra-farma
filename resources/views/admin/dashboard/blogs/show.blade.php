@extends('admin.app')

@section('content')
    <div class="container">
        <h1>{{ __('admin.show_blog') }} #{{ @$blog->id }}</h1>
        <div class="mb-3">
            <strong>{{ __('admin.title_en') }}:</strong> {{ @$blog->translate('en')->title }}
        </div>
        <div class="mb-3">
            <strong>{{ __('admin.description_en') }}:</strong><br>
            {!! nl2br(e(@$blog->translate('en')->description)) !!}
        </div>
        <div class="mb-3">
            <strong>{{ __('admin.title_ar') }}:</strong> {{ @$blog->translate('ar')->title }}
        </div>
        <div class="mb-3">
            <strong>{{ __('admin.description_ar') }}:</strong><br>
            {!! nl2br(e(@$blog->translate('ar')->description)) !!}
        </div>
        <div class="mb-3">
            <strong>{{ __('admin.image') }}:</strong><br>
            @if ($blog->image)
                <img src="{{ asset(@$blog->pathInView()) }}" width="80" alt="">
            @endif
        </div>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">{{ __('admin.back') }}</a>
    </div>
@endsection
