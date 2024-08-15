<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function create()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        Log::info($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->except('_token');

        // Insert the data into the database
        ContactMessage::create($data);

        return redirect()->back()->with('success', 'Message sent successfully!');;
    }
}
