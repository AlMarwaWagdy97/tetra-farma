<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminCvController extends Controller
{
    public function index()
    {
        $cvs = Cv::with('job')->get(); 
        return view('admin.dashboard.cvs.index', compact('cvs'));
    }
}