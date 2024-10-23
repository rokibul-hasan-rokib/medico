<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AppointmentDeleted;
use App\Notifications\AppointmentStatusUpdated;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class AppointmentController extends Controller
{

    public function index(){
        $appointments = Appointment::all();
        $departments = Department::all();
        $doctors = Doctor::all();
        return view('frontend.appointment.appointment', compact('appointments', 'departments', 'doctors'));
    }

    public function userAppointments()
{
    $appointments = Appointment::where('user_id', auth()->id())
    ->where('status', 'active')
    // ->whereNull('canceled_at')
    ->get();

    return view('frontend.appointment.userAppointmentList', compact('appointments'));
}


    public function store(Request $request)
    {
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
        // $validatedData['date'] = Carbon::createFromFormat('m-d-Y', $request->date)->format('Y-m-d');
        try {
            $appointments=Appointment::create($validatedData);
            Alert::success('Success', 'Appointment created successfully!');
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

    public function cancel(Appointment $appointment)
    {
        // Check if the user is authorized to cancel the appointment
        if (auth()->id() !== $appointment->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Update the appointment as canceled
        $appointment->update([
            'canceled_at' => now(),
            'status' => 'pending', // Optional: if you use status field
        ]);

        // Send email to the admin notifying about the cancellation
        $this->notifyAdminOfCancellation($appointment);

        return redirect()->back()->with('status', 'Appointment canceled successfully.');
    }

    protected function notifyAdminOfCancellation(Appointment $appointment)
    {
        $adminEmail = 'rokibulhasan018722@gmail.com'; // Replace with the admin's email address

        Mail::send('emails.appointment_canceled', ['appointment' => $appointment], function ($message) use ($adminEmail) {
            $message->to($adminEmail)
                ->subject('Appointment Cancellation Notification');
        });
    }

    public function downloadPdf()
    {
    $appointments = Appointment::all(); // Fetch your appointment data

    $pdf = Pdf::loadView('appointments.pdf', compact('appointments'));

    return $pdf->download('appointments.pdf');
    }

}