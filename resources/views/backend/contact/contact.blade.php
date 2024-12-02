@extends('backend.layouts.layout')

@section('content')
<h1>Contact List</h1>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->subject }}</td>
                <td>{{ $contact->description }}</td>
                <td>
                    {{-- <a class="btn-small btn-success" href="{{ route('user.edit', $user->id) }}">Update</a>
                    <a class="btn-small btn-danger" href="{{ route('user.destroy', $user->id) }}">Delete</a> --}}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection