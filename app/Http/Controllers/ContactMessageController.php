<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;

class ContactMessageController extends Controller
{
    public function create()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Insert the data into the database
        ContactMessage::create([
            'user_id' => auth()->guard('customer')->check() ? auth()->guard('customer')->user()->id : null,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'received_at' => Carbon::parse($request->received_at)->format('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
