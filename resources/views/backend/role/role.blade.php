@extends('backend.layouts.layout')

@section('content')
    <h1>All Users</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a class="btn-small btn-success" href="{{ route('user.edit', $user->id) }}">Update</a>
                        <a class="btn-small btn-danger" href="{{ route('user.destroy', $user->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
