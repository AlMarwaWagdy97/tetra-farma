@extends('admin.app')

@section('title', __('CVs'))
@section('title_page', __('CVs'))

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12 text-end">
          
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($cvs->count())
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.applicant_name')</th>
                                <th>@lang('admin.job_title')</th>
                                <th>@lang('admin.email')</th>
                                <th>@lang('admin.phone')</th>
                                <th class="text-end">@lang('admin.cv')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cvs as $cv)
                                <tr>
                                    <td>{{ $cv->id }}</td>
                                    <td>{{ $cv->name }}</td>
                                    <td>{{ optional($cv->job->translate(app()->getLocale()))->title ?? '—' }}</td>
                                    <td>{{ $cv->email }}</td>
                                    <td>{{ $cv->phone ?? '—' }}</td>
                                    <td class="text-end">
                                        <a href="{{ asset('storage/cvs/' . $cv->cv) }}" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-download"></i></a>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">@lang('admin.no_data')</div>
            @endif
        </div>
    </div>
</div>
@endsection