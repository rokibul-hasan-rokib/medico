@extends('backend.layouts.layout')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<h1>Appointment List</h1>

<table id="sales-table" class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Department</th>
            <th>Doctor</th>
            <th>Description</th>
            <th>Status</th>
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
                <td>{{ $appointment->status }}</td>
                    <td>
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Active</button>
                        </form>

                    </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('script')
    $(document).ready(function() {
        $('#appointmentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("appointments.index") }}',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'user_name', name: 'user_name' },
                { data: 'appointment_date', name: 'appointment_date' },
                { data: 'status', name: 'status' },
                // Add more columns as needed
            ],
            dom: 'Bfrtip', 
            buttons: [
                {
                    extend: 'pdfHtml5',
                    text: 'Download PDF',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });
    });
@endsection
