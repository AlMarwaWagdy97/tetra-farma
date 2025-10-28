<?php
// app/Http/Controllers/Admin/BlogController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query  = Blog::with('translations')
            ->orderBy('id', 'DESC');
     

     if ($request->filled('title')) {
    $query->whereTranslationLike('title', '%' . $request->title . '%');
}
        $blogs = $query->paginate(20)->appends($request->only(['title']));
        

        return view('admin.dashboard.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.dashboard.blogs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ar.title'       => 'nullable|string',
            'ar.description' => 'nullable|string',
            'en.title'       => 'nullable|string',
            'en.description' => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(Blog::diskPath(), $filename);
            $data['image'] = $filename;
        }

        Blog::create($data);
        return redirect()->route('admin.blogs.index')
                         ->with('success','Blog created');
    }

    public function show(Blog $blog)
    {
        return view('admin.dashboard.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('admin.dashboard.blogs.edit', compact('blog'));
    }

  public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'ar.title'       => 'required|string',
            'ar.description' => 'required|string',
            'en.title'       => 'required|string',
            'en.description' => 'required|string',
            'image'          => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            @unlink(Blog::diskPath() . $blog->image);

            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(Blog::diskPath(), $filename);
            $data['image'] = $filename;
        }

        $blog->update($data);
        return redirect()->route('admin.blogs.index')
                         ->with('success','Blog updated');
    }

    public function destroy(Blog $blog)
{
    $file = Blog::diskPath() . $blog->image;
    if ($blog->image && file_exists($file)) {
        @unlink($file);
    }

    $blog->delete();

    return back()->with('success','Blog deleted');
}
}
