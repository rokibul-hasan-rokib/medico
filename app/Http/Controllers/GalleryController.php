<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
class GalleryController extends Controller
{
    //
    public function index(){
        $galleries = Gallery::all();
        return view('backend.gallery.gallery', compact('galleries'));
    }

    
}