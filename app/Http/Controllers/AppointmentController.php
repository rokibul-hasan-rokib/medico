<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Alert;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AppointmentStatusUpdated;

class AppointmentController extends Controller
{
    //
    public function index(){
        $appointments = Appointment::all();
        $departments = Department::all();
        $doctors = Doctor::all();
        return view('frontend.appointment.appointment', compact('appointments', 'departments', 'doctors'));
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
        Alert::success('Success', 'Appointment created successfully!');
        return redirect('/appointment')->with('success', 'Appointment created successfully!');
    }
    
    public function edit($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('appointment.show')->with('error', 'Appointment not found.');
        }

        return view('backend.appointment.update', compact('appointment'));
    }


    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('appointment.show')->with('error', 'Appointment not found.');
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date' => 'required|date',
            'department' => 'required|string',
            'doctor' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,active',
        ]);

        $appointment->update($request->all());

        // Send notification to the user if status is updated to active
        if ($appointment->status == 'active') {
            // Ensure the appointment has a user associated with it
            if ($appointment->user) {
                $appointment->user->notify(new AppointmentStatusUpdated($appointment));
            }
        }

        return redirect()->route('appointment.show')->with('success', 'Appointment updated successfully.');
    }


        public function destroy($id)
        {
            $appointment = Appointment::find($id);
    
            if (!$appointment) {
                return redirect()->route('appointment.show')->with('error', 'Appointment not found.');
            }
    
            $appointment->delete();
    
            return redirect()->route('appointment.show')->with('success', 'Appointment deleted successfully.');
        }

    public function index1(){
        $appointments = Appointment::all();
        return view('backend.appointment.appointment', compact('appointments'));
    }

    
}