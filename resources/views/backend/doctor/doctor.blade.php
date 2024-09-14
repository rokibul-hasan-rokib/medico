@extends('backend.layouts.layout')

@section('content')
    <h1>Doctor List</h1>
    <a href="{{ route('doctor.show.show') }}" class="btn btn-primary float-right mr-3 mb-2">Add Department</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->name }}</td>
                    {{-- <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" width="200"> --}}
                    {{-- <img src="{{ asset($imagePath) }}" alt="Image"> --}}
                    {{-- <td><img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" style="max-width: 100px;"></td> --}}

                    @if ($doctor->image)
                    <td>
                    <img src="{{ asset($doctor->image) }}" alt="{{ $doctor->name }}" style="max-width: 100px;">
                    </td>
                    @endif
                    <td>Error</td>
                    {{-- <td>
                    <a class="btn-small btn-success" href="{{ route('user.edit', $user->id) }}">Update</a>
                    <a class="btn-small btn-danger" href="{{ route('user.destroy', $user->id) }}">Delete</a>
                </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
