@extends('backend.layouts.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">
                    <h1>Edit Appointment</h1>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $appointment->name }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $appointment->email }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $appointment->phone }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ $appointment->date }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" name="department" class="form-control" value="{{ $appointment->department }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="doctor">Doctor</label>
                            <input type="text" name="doctor" class="form-control" value="{{ $appointment->doctor }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control">{{ $appointment->description }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="active" {{ $appointment->status == 'active' ? 'selected' : '' }}>Active</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block mt-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection