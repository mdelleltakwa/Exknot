<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string|min:20|max:2000',
        ]);

        \Log::info('Contact form submission', $request->only(['name', 'email', 'subject', 'message']));

        return redirect()->route('pages.contact')
            ->with('success', 'Message received. We\'ll get back to you within 24 hours.');
    }
}
