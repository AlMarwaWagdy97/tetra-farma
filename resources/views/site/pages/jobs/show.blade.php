@extends('site.app')

@section('content')
    <section class="job-section hero py-5" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container">
            <h2 class="section-title">{{ optional($job->translate(app()->getLocale()))->title ?? '—' }}</h2>
            {{-- <p>{{ optional($job->translate(app()->getLocale()))->short_description ?? '—' }}</p> --}}
            <p>{!!  optional($job->translate(app()->getLocale()))->description ?? '—' !!}</p>
            <h3>@lang('job.requirements')</h3>
            <p>{{ optional($job->translate(app()->getLocale()))->requirements ?? '—' }}</p>

            <h4>@lang('job.apply')</h4>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('site.jobs.apply', $job->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">@lang('job.name')</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">@lang('job.email')</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">@lang('job.phone')</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="cv_file">@lang('job.cv_file')</label>
                    <input type="file" name="cv_file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">@lang('job.send')</button>
            </form>
        </div>
    </section>
@endsection
<style>
    .hero{
        margin-top: 70px !important;
    }    
</style>    