<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexesController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
