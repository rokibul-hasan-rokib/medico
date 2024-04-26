@extends('layouts.layout')

@section('content')
    <h1>User Updated</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        User Edit
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value={{ $user['name'] }} required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value={{ $user['email'] }} required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" type="role" id="role" class="form-control"
                                    value={{ $user['role'] }} required>
                                    <option value="">{{ $user['role'] }}</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'admin' : 'user' }}>admin</option>
                                    <option value="user" {{ $user->role == 'user' ? 'user' : 'admin' }}>user</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
