@extends('admin.app')

@section('content')
    <div class="container">
        <h1>{{ __('admin.edit_blog') }} #{{ $blog->id }}</h1>
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- ENGLISH TITLE -->
            <div class="mb-3">
                <label>{{ __('admin.title_en') }}</label>
                <input type="text"
                       name="en[title]"
                       class="form-control"
                       value="{{ old('en.title', $blog->translate('en')->title) }}">
            </div>

            <!-- ENGLISH DESCRIPTION with CKEditor -->
            <div class="mb-3">
                <label>{{ __('admin.description_en') }}</label>
                <textarea name="en[description]"
                          id="description_en"
                          class="form-control">{{ old('en.description', $blog->translate('en')->description) }}</textarea>
            </div>

            <!-- ARABIC TITLE -->
            <div class="mb-3">
                <label>{{ __('admin.title_ar') }}</label>
                <input type="text"
                       name="ar[title]"
                       class="form-control"
                       value="{{ old('ar.title', $blog->translate('ar')->title) }}">
            </div>

            <!-- ARABIC DESCRIPTION with CKEditor -->
            <div class="mb-3">
                <label>{{ __('admin.description_ar') }}</label>
                <textarea name="ar[description]"
                          id="description_ar"
                          class="form-control">{{ old('ar.description', $blog->translate('ar')->description) }}</textarea>
            </div>

            <!-- CURRENT IMAGE PREVIEW -->
            <div class="mb-3">
                <label>{{ __('admin.image') }}</label><br>
                @if ($blog->image)
                    <img src="{{ asset($blog->pathInView()) }}" width="80" alt="Current image">
                @endif
            </div>

            <!-- IMAGE UPLOAD -->
            <div class="mb-3">
                <label>{{ __('admin.image') }}</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('description_en', {
            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('description_ar', {
            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endpush
