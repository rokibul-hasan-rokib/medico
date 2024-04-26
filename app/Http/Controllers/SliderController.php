<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    //
    public function index(){
        $sliders = Slider::all();
        return view('', compact('sliders'));
    }
}