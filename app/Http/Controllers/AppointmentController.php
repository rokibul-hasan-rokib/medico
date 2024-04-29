<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    //
    public function index(){
        $appointments = Appointment::all();
        return view('frontend.appointment.appointment', compact('appointments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date' => 'required|date',
            'department' => 'required|string',
            'doctor' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Appointment::create($validatedData);
        return redirect('/appointment')->with('success', 'Appointment created successfully!');
    }

    public function update(Request $request, Appointment $appointment)
    {

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date' => 'required|date',
            'department' => 'required|string',
            'doctor' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $appointment->update($validatedData);
        return route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    // public function destroy(Appointment $appointment)
    // {
    //     $appointment->delete();
    //     return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
    // }

    public function index1(){
        $appointments = Appointment::all();
        return view('backend.appointment.appointment', compact('appointments'));
    }

    
}