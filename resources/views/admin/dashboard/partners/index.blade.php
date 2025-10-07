@extends('admin.app')
@section('title', __('partners.index'))
@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <a href="{{ route('admin.partners.create') }}" class="btn btn-success">@lang('partners.create_new')</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('partners.image')</th>
                            <th>@lang('partners.title')</th>
                            <th>@lang('partners.status')</th>
                            <th class="text-end">@lang('admin.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partners as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/attachments/partners/' . $p->image) }} " style="height:60px"
                                        alt="" />
                                </td>
                                <td>{{ $p->translate(app()->getLocale())->title ?? $p->translate(config('app.fallback_locale'))->title }}
                                </td>
                                <td>
                                    @if ($p->status)
                                        <span class="badge bg-success">@lang('admin.active')</span>
                                    @else
                                        <span class="badge bg-warning">@lang('admin.dis_active')</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    <a href="{{ route('admin.partners.edit', $p->id) }}"
                                        class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('admin.partners.destroy', $p->id) }}" method="POST"
                                        style="display:inline-block">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete?')">Delete</button>
                                    </form>
                                    <a href="{{ route('admin.partners.toggle-status', $p->id) }}"
                                        class="btn btn-sm btn-warning">Toggle</a>
                                </td> --}}

                                <td class="text-end">

                                    <a href="{{ route('admin.partners.show', $p->id) }}" title="@lang('admin.show')"
                                        class="btn btn-xs btn-outline-info btn-sm m-1"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.partners.edit', $p->id) }}" title="@lang('admin.edit')"
                                        class="btn btn-outline-primary btn-sm m-1"><i class="fas fa-pencil-alt"></i></a>

                                    @if ($p->status == 1)
                                        <a href="{{ route('admin.partners.toggle-status', $p->id) }}"
                                            title="@lang('admin.active')" class="btn btn-xs btn-success btn-sm m-1"><i
                                                class="fa fa-check"></i></a>
                                    @else
                                        <a href="{{ route('admin.partners.toggle-status', $p->id) }}"
                                            title="@lang('admin.dis_active')"
                                            class="btn btn-xs btn-outline-secondary btn-sm m-1"><i
                                                class="fa fa-ban"></i></a>
                                    @endif

                                    <form action="{{ route('admin.partners.destroy', $p->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $partners->links() }}
            </div>
        </div>
    </div>
@endsection
