@extends('admin.app')

@section('title', __('admin.create_blog'))
@section('title_page', __('admin.create_blog'))

@section('content')
    <div class="container-fluid">
        <div class="row mb-3 text-end">
            <div class="col-12">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-success btn-sm">@lang('button.cancel')</a>
            </div>
        </div>

        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    @foreach ($languages as $key => $locale)
                        <div class="accordion mb-3" id="accordionLang{{ $key }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseLang{{ $key }}">
                                        @lang('lang.' . \Locale::getDisplayName($locale))
                                    </button>
                                </h2>

                                <div id="collapseLang{{ $key }}" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionLang{{ $key }}">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <label class="form-label">@lang('blogs.title')</label>
                                            <input type="text" name="{{ $locale }}[title]" class="form-control"
                                                value="{{ old($locale . '.title') }}">

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">@lang('job.description')</label>
                                            <textarea id="description{{ $key }}" name="{{ $locale }}[description]" class="form-control"
                                                rows="6">{{ old($locale . '.description') }}</textarea>
                                        </div>


                              

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mb-3">
                        <label class="form-label">{{ __('admin.image') }}</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>


                <div class="row mb-3 text-end">
                    <div>
                        <a href="{{ route('admin.blogs.index') }}"
                            class="btn btn-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a>
                        <button type="submit"
                            class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">@lang('button.save')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function() {
            @foreach ($languages as $key => $locale)
                CKEDITOR.replace('description{{ $key }}', {
                    filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) ?? '#' }}",
                    filebrowserUploadMethod: 'form'
                });
            @endforeach
        });
    </script>
@endsection
