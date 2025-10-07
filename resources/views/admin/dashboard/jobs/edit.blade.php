@extends('admin.app')

@section('title', __('job.edit'))
@section('title_page', __('job.edit'))

@section('content')
<div class="container-fluid">
    <div class="row mb-3 text-end">
        <div class="col-12">
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-secondary btn-sm">@lang('button.cancel')</a>
        </div>
    </div>

    <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-9">
                @foreach($languages as $key => $locale)
                    <div class="accordion mb-3" id="accordionLang{{ $key }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseLang{{ $key }}">
                                  @lang('lang.' . \Locale::getDisplayName($locale))  
                                </button>
                            </h2>

                            <div id="collapseLang{{ $key }}" class="accordion-collapse collapse show" data-bs-parent="#accordionLang{{ $key }}">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('job.title')</label>
                                        <input type="text" name="{{ $locale }}[title]" class="form-control" value="{{ old($locale . '.title', optional($job->translate($locale))->title) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">@lang('job.short_description')</label>
                                        <textarea name="{{ $locale }}[short_description]" class="form-control" rows="3">{{ old($locale . '.short_description', optional($job->translate($locale))->short_description) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">@lang('job.description')</label>
                                        <textarea id="description{{ $key }}" name="{{ $locale }}[description]" class="form-control" rows="6">{{ old($locale . '.description', optional($job->translate($locale))->description) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">@lang('job.requirements')</label>
                                        <textarea name="{{ $locale }}[requirements]" class="form-control" rows="4">{{ old($locale . '.requirements', optional($job->translate($locale))->requirements) }}</textarea>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label class="form-label">@lang('job.seo_title')</label>
                                        <input type="text" name="{{ $locale }}[seo_title]" class="form-control" value="{{ old($locale . '.seo_title', optional($job->translate($locale))->seo_title) }}">
                                    </div> --}}
                                    {{-- <div class="mb-3">
                                        <label class="form-label">@lang('job.seo_description')</label>
                                        <textarea name="{{ $locale }}[seo_description]" class="form-control" rows="2">{{ old($locale . '.seo_description', optional($job->translate($locale))->seo_description) }}</textarea>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header">@lang('admin.settings')</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">@lang('job.slug')</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $job->slug) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">@lang('job.employment_type')</label>
                            <input type="text" name="employment_type" class="form-control" value="{{ old('employment_type', $job->employment_type) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">@lang('job.location')</label>
                            <input type="text" name="location" class="form-control" value="{{ old('location', $job->location) }}">
                        </div>

                        {{-- @if($job->image)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label><br>
                                <img src="{{ asset('storage/' . $job->image) }}" style="max-width:100%" alt="">
                            </div>
                        @endif
  
                        <div class="mb-3">
                            <label class="form-label">@lang('admin.image') (Replace)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div> --}}

                        <div class="mb-3">
                            <label class="form-label">@lang('admin.sort')</label>
                            <input type="number" name="sort" class="form-control" value="{{ old('sort', $job->sort) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-check-label">@lang('admin.status')</label><br>
                            <input type="checkbox" name="status" value="1" {{ $job->status ? 'checked' : '' }}>
                        </div>

                      
                    </div>
                </div>
            </div>
              <div class="row mb-3 text-end">
                    <div>
                        <a href="{{ route('admin.jobs.index') }}"
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
    $(function(){
        @foreach($languages as $key => $locale)
            CKEDITOR.replace('description{{ $key }}', {
                filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) ?? '#' }}",
                filebrowserUploadMethod: 'form'
            });
        @endforeach
    });
</script>
@endsection
