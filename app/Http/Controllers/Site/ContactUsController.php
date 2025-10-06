<?php
// Artisan command to generate controller:
// php artisan make:controller Site/ContactUsController

// File: app/Http/Controllers/Site/ContactUsController.php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactus;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    /**
     * Show the contact us form.
     */
    public function index()
    {
        return view('site.pages.contactus');
    }

    /**
     * Handle form submission and save message.
     */

}