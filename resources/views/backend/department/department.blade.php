@extends('backend.layouts.layout')

@section('content')
<h1>Department List</h1>

<a href="{{route('department.show.show')}}" class="btn btn-primary float-right mr-3 mb-2">Add Department</a>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $department)
            <tr>
                <td>{{ $department->name }}</td>
                <td><img src="{{ asset($department->image) }}" alt="{{ $department->name }}" style="max-width: 100px;"></td>
                <td>{{ $department->description }}</td>
                {{-- <td>
                    <a class="btn-small btn-success" href="{{ route('user.edit', $user->id) }}">Update</a>
                    <a class="btn-small btn-danger" href="{{ route('user.destroy', $user->id) }}">Delete</a>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
