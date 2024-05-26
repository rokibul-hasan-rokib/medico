<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    //
    public function index(){
        $doctors = Doctor::all();
        return view('frontend.doctor.doctor',compact('doctors'));
    }
    public function index4(){
        $doctors = Doctor::all();
        return response()->json($doctors, 200);
    }
    
    public function index1(){
        $doctors = Doctor::all();
        return view('backend.doctor.doctor',compact('doctors'));
    }
    public function show(){
        $doctors = Doctor::all();
        return view('backend.doctor.store',compact('doctors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image upload
            'department' => 'nullable|string',
        ]);

        // Upload image and get path
        $imagePath = $request->file('image')->store('public/images');

        $doctors = Doctor::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'department' => $validatedData['department'],
        ]);

        //return response('/department/show')->json($departments, 201);
        return redirect()->route('doctor.show',['doctor' => $doctors]);
    }
    
}