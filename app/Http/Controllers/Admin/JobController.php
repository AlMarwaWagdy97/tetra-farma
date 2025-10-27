<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    // Index: list jobs
    public function index(Request $request)
{
    $query = Job::with('translations')->orderBy('created_at', 'desc');

    if ($request->filled('title')) {
        $title = trim($request->input('title'));
        $query->whereTranslation('title', 'like', "%{$title}%");
    }

    $jobs = $query->paginate(20)->appends($request->only(['title']));
    return view('admin.dashboard.jobs.index', compact('jobs'));
}

    // Show create form
    public function create()
    {
        $languages = config('translatable.locales', ['en']);
        return view('admin.dashboard.jobs.create', compact('languages'));
    }

    // Store new job
    public function store(JobRequest $request)
    {
        $data = $request->validated();

        $job = new Job();
        $job->slug = $request->input('slug') ?? null;
        $job->employment_type = $request->input('employment_type') ?? null;
        $job->location = $request->input('location') ?? null;
        $job->status = $request->has('status') ? 1 : 0;
        $job->sort = $request->input('sort', 0);
        $job->created_by = Auth::id();

        if ($request->hasFile('image')) {
            $job->image = $request->file('image')->store('attachments/jobs', 'public');
        }

        $job->save();

        // translations
        foreach (config('translatable.locales', ['en']) as $locale) {
            $trans = $request->input($locale, []);
            if (!empty($trans)) {
                $job->translateOrNew($locale)->title = $trans['title'] ?? null;
                $job->translateOrNew($locale)->short_description = $trans['short_description'] ?? null;
                $job->translateOrNew($locale)->description = $trans['description'] ?? null;
                $job->translateOrNew($locale)->requirements = $trans['requirements'] ?? null;
                // seo fields if exist
                $job->translateOrNew($locale)->seo_title = $trans['seo_title'] ?? null;
                $job->translateOrNew($locale)->seo_description = $trans['seo_description'] ?? null;
            }
        }
        $job->save();

        session()->flash('success', __('Created successfully'));
        return redirect()->route('admin.jobs.index');
    }

    // Edit form
    public function edit(Job $job)
    {
        $languages = config('translatable.locales', ['en']);
        return view('admin.dashboard.jobs.edit', compact('job', 'languages'));
    }

    // Update
    public function update(JobRequest $request, Job $job)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($job->image) {
                Storage::disk('public')->delete($job->image);
            }
            $job->image = $request->file('image')->store('attachments/jobs', 'public');
        }

        $job->slug = $request->input('slug') ?? $job->slug;
        $job->employment_type = $request->input('employment_type') ?? $job->employment_type;
        $job->location = $request->input('location') ?? $job->location;
        $job->status = $request->has('status') ? 1 : 0;
        $job->sort = $request->input('sort', $job->sort);
        $job->updated_by = Auth::id();
        $job->save();

        // update translations
        foreach (config('translatable.locales', ['en']) as $locale) {
            $trans = $request->input($locale, []);
            $job->translateOrNew($locale)->title = $trans['title'] ?? $job->translate($locale)->title ?? null;
            $job->translateOrNew($locale)->short_description = $trans['short_description'] ?? $job->translate($locale)->short_description ?? null;
            $job->translateOrNew($locale)->description = $trans['description'] ?? $job->translate($locale)->description ?? null;
            $job->translateOrNew($locale)->requirements = $trans['requirements'] ?? $job->translate($locale)->requirements ?? null;
            $job->translateOrNew($locale)->seo_title = $trans['seo_title'] ?? $job->translate($locale)->seo_title ?? null;
            $job->translateOrNew($locale)->seo_description = $trans['seo_description'] ?? $job->translate($locale)->seo_description ?? null;
        }
        $job->save();

        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.jobs.index');
    }

    // Show single
    public function show(Job $job)
    {
        return view('admin.dashboard.jobs.show', compact('job'));
    }

    // Delete
    public function destroy(Job $job)
    {
        if ($job->image) {
            Storage::disk('public')->delete($job->image);
        }
        $job->delete();

        session()->flash('success', __('Deleted successfully'));
        return redirect()->route('admin.jobs.index');
    }

    // Toggle status (active / inactive)
    public function toggleStatus(Job $job)
    {
        $job->status = !$job->status;
        $job->save();
        session()->flash('success', __('Status updated'));
        return redirect()->back();
    }
}
