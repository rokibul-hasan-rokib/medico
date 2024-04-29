<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    //
    public function index(){
        $sliders = Slider::all();
        return view('backend.slider.slider', compact('sliders'));
    }
    public function show()
    {
        $sliders = Slider::all();
        return view('backend.slider.store', compact('sliders'));
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

        $sliders = Slider::create([
            'name' => $validatedData['name'],
            'image' => $imagePath,
            'description' => $validatedData['description'],
        ]);

        //return response('/department/show')->json($departments, 201);
        return redirect()->route('slider',['slider' => $sliders]);
    }
}