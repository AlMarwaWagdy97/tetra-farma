<?php

namespace App\Http\Controllers\Site;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {


        $faq_questions = Faq::with('translations', 'category.translations')->where('status', 1)->get();
        $categories = FaqCategory::with('translations')->where('status', 1)->get();

     


        return view('site.pages.faq-questions.index', compact('faq_questions', 'categories'));
    }
}
