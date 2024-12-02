@extends('frontend.master.master')
@section('title')
    user appointment list
@endsection

@section('content')

<section id="appointment" class="appointment section-bg" style="margin-top: 5rem">
    <div class="container" data-aos="fade-up">
    <h1>Your Approved Appointments</h1>

    @if($appointments->isEmpty())
        <p>You have no approved appointments.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Department</th>
                    <th>Doctor</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</td>                        <td>{{ $appointment->department }}</td>
                        <td>{{ $appointment->doctor }}</td>
                        <td>
                            @if(is_null($appointment->canceled_at))
                            <form action="{{ route('appointments.cancel', $appointment) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?');">
                                    Cancel Appointment
                                </button>
                            </form>
                        @else
                            <p class="text-danger">This appointment was canceled on {{ $appointment->canceled_at->format('F j, Y') }}.</p>
                        @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</section>

@endsection
