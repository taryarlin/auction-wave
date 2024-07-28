<?php

namespace App\Http\Controllers;

class BIDController extends Controller
{
    public function makeBid()
    {
        if(!auth()->check()) {
            return back()->with('error', 'Please sign in to make a bid');
        }

        return back()->with('success', 'Your BID is successfully placed');
    }
}
