<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function faq()
    {
        return view('frontend.faq');
    }

    public function aboutUs()
    {
        return view('frontend.about_us');
    }
}
