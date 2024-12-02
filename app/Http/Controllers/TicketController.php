<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Ticket;
use Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AppointmentDeleted;
use App\Notifications\AppointmentStatusUpdated;

class TicketController extends Controller
{
    //
    public function index(){
        $tickets = Ticket::all();
        $departments = Department::all();
        $doctors = Doctor::all();
        return view('frontend.ticket', compact('tickets', 'departments', 'doctors'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'date' => 'required|date|after_or_equal:today|before_or_equal:' . now()->addDays(30)->format('Y-m-d'),
            'department' => 'required|string|max:255',
            'doctor' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'gender' => 'required|string|in:male,female,other',
            'description' => 'nullable|string|max:1000',
        ]);

        $validatedData['user_id'] = Auth::id();
        $validatedData['date'] = Carbon::createFromFormat('m-d-Y', $request->date)->format('Y-m-d');
        try {
            Ticket::create($validatedData);
            return redirect('/appointment ')->with('success', 'Appointment created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create appointment. Error: ' . $e->getMessage());
        }
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

        if ($appointment) {
            // Notify the user
            $user = $appointment->user; // Assuming the Appointment model has a user relationship
            $user->notify(new AppointmentDeleted($appointment));

            // Delete the appointment
            $appointment->delete();

            return redirect()->route('appointment.show')->with('success', 'Appointment deleted and user notified.');
        }

        return redirect()->route('appointment.show')->with('error', 'Appointment not found.');
    }

    public function index1(){
        $appointments = Appointment::all();
        return view('backend.appointment.appointment', compact('appointments'));
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::with('user')->findOrFail($id);

        $appointment->status = 'active';
        $appointment->save();

        $user = $appointment->user; // Assuming the appointment has a user relationship

        if ($user) {
            // Send notification
            $user->notify(new AppointmentStatusUpdated($appointment));
            return redirect()->back()->with('success', 'Appointment status updated and user notified.');
        } else {
            return redirect()->back()->with('error', 'User not found for this appointment.');
        }
    }

}