<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Storage;


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
        $departments = Department::all();
        return view('backend.doctor.store',compact('doctors','departments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image upload
            'department' => 'nullable|string',
        ]);

         // Manually handle image upload and define the path
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '-' . $file->getClientOriginalName(); // Generate a unique name
        $destinationPath = public_path('images'); // Public directory 'public/images'
        $file->move($destinationPath, $filename); // Move file to the desired location
        $imagePath = 'images/' . $filename; // Relative path to store in DB
    }

        $doctors = Doctor::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'department' => $validatedData['department'],
        ]);

        //return response('/department/show')->json($departments, 201);
        return redirect()->route('doctor.show',['doctor' => $doctors]);
    }

}
