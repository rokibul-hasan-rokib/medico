<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    //
    public function index()
    {
        $departments = Department::all();
        return view('frontend.department.department', compact('departments'));
    }
    public function index1()
    {
        $departments = Department::all();
        return view('backend.department.department', compact('departments'));
    }

    public function show()
    {
        $departments = Department::all();
        return view('backend.department.store', compact('departments'));
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

        $departments = Department::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'description' => $validatedData['description'],
        ]);

        //return response('/department/show')->json($departments, 201);
        return redirect()->route('department.show',['department' => $departments]);
    }
}