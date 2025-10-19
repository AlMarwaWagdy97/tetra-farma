@extends('admin.app')
@section('content')
<div class="container-fluid">
    <div class="card p-4">
        {{-- <h3>{{ $partner->translate(app()->getLocale())->title ?? '' }}</h3> --}}
        <img src="{{ asset('storage/attachments/partners/' . $partner->image) }}" style="max-width:300px">
        <p>@lang(key: 'partners.url'): {{ $partner->url }}</p>
        <p>@lang(key: 'partners.status'): {{ $partner->status ? 'Active' : 'Inactive' }}</p>
    </div>
</div>
@endsection
