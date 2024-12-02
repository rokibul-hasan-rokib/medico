<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Alert;

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
         Alert::success('Success', 'Contact created successfully!');
         return redirect('/contact')->with('success', 'Contact created successfully!');

    }
    public function index1(){
        $contacts = Contact::all();
        return view('backend.contact.contact', compact('contacts'));
    }
}