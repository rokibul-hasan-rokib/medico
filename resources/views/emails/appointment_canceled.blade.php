<p>Dear Admin,</p>

<p>The following appointment has been canceled by the user:</p>

<ul>
    <li><strong>Name:</strong> {{ $appointment->name }}</li>
    <li><strong>Email:</strong> {{ $appointment->email }}</li>
    <li><strong>Phone:</strong> {{ $appointment->phone }}</li>
    <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</li>
    <li><strong>Department:</strong> {{ $appointment->department }}</li>
    <li><strong>Doctor:</strong> {{ $appointment->doctor }}</li>
</ul>

<p>Please note that this appointment was canceled on {{ \Carbon\Carbon::parse($appointment->canceled_at)->format('F j, Y, g:i a') }}.</p>

<p>Thank you,</p>
<p>Your Appointment System</p>
