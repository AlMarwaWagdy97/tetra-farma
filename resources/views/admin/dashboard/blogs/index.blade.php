@extends('admin.app')

@section('content')
    <div class="container">
        <h1>{{ __('admin.blogs') }}</h1>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-3">{{ __('admin.create_blog') }}</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('admin.id') }}</th>
                    <th>{{ __('admin.title_en') }}</th>
                    <th>{{ __('admin.title_ar') }}</th>
                    <th>{{ __('admin.image') }}</th>
                    <th>{{ __('admin.actions') }}</th>
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
                        <td>
                            <a href="{{ route('admin.blogs.show', $blog) }}" class="btn btn-info btn-sm">{{ __('admin.show') }}</a>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-warning btn-sm">{{ __('admin.edit') }}</a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">{{ __('admin.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
        {{ $blogs->links() }}
    </div>
@endsection
