@extends('admin.app')

@section('content')
    <div class="container">
        <h1>{{ __('admin.blogs') }}</h1>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-success mb-3">{{ __('admin.create_blog') }}</a>
      
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('admin.id') }}</th>
                    <th>{{ __('admin.title_en') }}</th>
                    <th>{{ __('admin.title_ar') }}</th>
                    <th>{{ __('admin.image') }}</th>
                    <th class="text-end">{{ __('admin.actions') }}</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ @$blog->translate('en')->title }}</td>
                        <td>{{ @$blog->translate('ar')->title }}</td>
                        <td>
                            @if ($blog->image)
                                <img src="{{ asset($blog->pathInView()) }}" width="80" alt="">
                            @endif
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.blogs.show', $blog->id) }}" title="@lang('admin.show')"
                                class="btn btn-xs btn-outline-info btn-sm m-1"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" title="@lang('admin.edit')"
                                class="btn btn-outline-primary btn-sm m-1"><i class="fas fa-pencil-alt"></i></a>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
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
        {{ $blogs->links() }}
    </div>
@endsection
