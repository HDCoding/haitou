<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::where('is_faq', '=', true)->get();
        $faqs = Faq::where('is_enable', '=', true)->get();
        return view('site.faqs.index', compact('categories', 'faqs'));
    }
}
