<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
  

public function send(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string|max:2000',
    ]);

    Mail::raw("Message from: {$validated['name']} ({$validated['email']})\n\n{$validated['message']}", function ($msg) use ($validated) {
        $msg->to('milestartrade@gmail.com')
            ->subject('New Contact Message from Mercatia');
    });

    return back()->with('success', 'Your message has been sent successfully, We will get back to you shortly!');
}

}
