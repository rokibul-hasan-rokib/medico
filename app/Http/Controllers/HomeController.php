<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;

class HomeController extends Controller
{

    public function index(){
        $appointments = Appointment::all();
        $departments = Department::all();
        $doctors = Doctor::all();
        return view('frontend.home.home', compact('appointments', 'departments', 'doctors'));
    }
    public function about(){
        return view('frontend.about.about');
    }
}