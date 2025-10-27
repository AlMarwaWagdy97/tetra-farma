@extends('admin.app')

@section('title', __('admin.cvs'))
@section('title_page', __('admin.cvs'))

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 text-end">

            </div>
        </div>

        <div class="card">
            <div class="card-body  search-group">
                <form action="{{ route('admin.cvs.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input type="text" value="{{ request('name') }}" name="name"
                                placeholder="{{ trans('pages.search_title') }}" class="form-control">
                        </div>

                        <div class="col-md-3 mb-2">
                            <input type="text" value="{{ request('email') }}" name="email" placeholder="Email"
                                class="form-control">
                        </div>

                        <div class="col-md-3 mb-2">
                            <input type="text" value="{{ request('phone') }}" name="phone" placeholder="Phone"
                                class="form-control">
                        </div>

                        <div class="search-input col-md-2">
                            <button class="btn btn-primary btn-sm" type="submit" title="{{ trans('button.search') }}"><i
                                    class="fas fa-search"> </i></button>
                            <a class="btn btn-warning btn-sm" href="{{ route('admin.cvs.index') }}"
                                title="{{ trans('button.reset') }}"><i class="refresh ion ion-md-refresh"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                @if ($cvs->count())
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
                                @foreach ($cvs as $cv)
                                    <tr>
                                        <td>{{ $cv->id }}</td>
                                        <td>{{ $cv->name }}</td>
                                        <td>
                                            @if ($cv->job && $cv->job->translate(app()->getLocale()))
                                                {{ $cv->job->translate(app()->getLocale())->title }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ $cv->email }}</td>
                                        <td>{{ $cv->phone ?? '—' }}</td>
                                        <td class="text-end">
                                            <a href="{{ asset('storage/' . $cv->cv_file) }}" class="btn btn-info btn-sm"
                                                target="_blank"><i class="fas fa-download"></i></a>
                                        </td>

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
