<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    //
    public function index(){
        $services = Service::all();
        return view('frontend.service.service', compact('services'));
    }

    public function index1(){
        $services = Service::all();
        return view('backend.service.service', compact('services'));
    }

    public function show()
    {
        $services = Service::all();
        return view('backend.service.store', compact('services'));
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image upload
            'description' => 'nullable|string',
        ]);

        // Upload image and get path
        $imagePath = $request->file('image')->store('public/images');

        $services = Service::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'description' => $validatedData['description'],
        ]);

        //return response('/department/show')->json($departments, 201);
        return redirect()->route('service.show',['service' => $services]);
    }
    
}