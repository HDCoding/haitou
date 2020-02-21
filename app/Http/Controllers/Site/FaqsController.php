<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;

class FaqsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::where('is_faq', '=', true)
            ->select('id', 'name')
            ->get();

        $faqs = Faq::where('is_enabled', '=', true)
            ->select('id', 'category_id', 'question', 'answer')
            ->get();

        return view('site.faqs.index', compact('categories', 'faqs'));
    }
}
