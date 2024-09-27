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

         // Manually handle image upload and define the path
         if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName(); // Generate a unique name
            $destinationPath = public_path('images'); // Public directory 'public/images'
            $file->move($destinationPath, $filename); // Move file to the desired location
            $imagePath = 'images/' . $filename; // Relative path to store in DB
        }


        $departments = Department::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'description' => $validatedData['description'],
        ]);

        //return response('/department/show')->json($departments, 201);
        return redirect()->route('department.show',['department' => $departments]);
    }
    public function destroy($id){
        try{
            $department= Department::find($id);
            if ($department->delete()) {
                return redirect()->route('department.show');
        } else {
                return redirect('/department/show');
        }
           }catch(\Exception $exception){
            return $exception->getMessage();
           }
    }
}