<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

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

    // public function customersRegisteredToday()
    // {
    //     $today = Carbon::today();
        
    //     $customers = Customer::whereDate('created_at', $today)->get();

    //     return view('AdminPanelProvider.dashboard');
    // }
}
