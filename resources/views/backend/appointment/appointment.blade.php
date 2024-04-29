@extends('backend.layouts.layout')

@section('content')
<h1>Appointment List</h1>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Department</th>
            <th>Doctor</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($appointments as $appointment)
            <tr>
                <td>{{ $appointment->name }}</td>
                <td>{{ $appointment->email }}</td>
                <td>{{ $appointment->phone }}</td>
                <td>{{ $appointment->date }}</td>
                <td>{{ $appointment->department }}</td>
                <td>{{ $appointment->doctor }}</td>
                <td>{{ $appointment->description }}</td>
                <td>
                    {{-- <a class="btn-small btn-success" href="{{ route('user.edit', $user->id) }}">Update</a>
                    <a class="btn-small btn-danger" href="{{ route('user.destroy', $user->id) }}">Delete</a> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection