<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function index()
    {
        $contacts = Contact::all();
        return view('frontend.contact.contact', compact('contacts'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'description' => 'nullable|string',
        ]);

         Contact::create($validatedData);
         return redirect('/contact')->with('success', 'Contact created successfully!');

    }
}