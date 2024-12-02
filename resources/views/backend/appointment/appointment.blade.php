@extends('backend.layouts.layout')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<h1>Appointment List</h1>

<div class="row mt-5">
    <div class="col-md-12">
        <button onclick="window.history.back()" class="btn btn-primary">Back</button>
        <button onclick="myFunction('printarea')" class="btn btn-success float-right">Print</button>
    </div>
</div>
<div id="printarea">


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
</div>
<script>
    function myFunction(el) {
        var getFullContent = document.body.innerHTML;
        var printsection = document.getElementById(el).innerHTML;
        document.body.innerHTML = printsection;
        window.print();
        document.body.innerHTML = getFullContent;
    }
</script>
@endsection
@section('script')
@endsection

