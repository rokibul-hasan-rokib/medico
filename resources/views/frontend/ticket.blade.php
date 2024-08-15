@extends('frontend.master.master')
@section('title')
    home
@endsection

@section('content')

<div class="container mx-auto p-6 bg-gray-100 rounded-lg">
    <h2 class="text-2xl font-bold mb-6">Create Appointment</h2>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 mb-6 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ticket.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-semibold">Name:</label>
            <input type="text" name="name" id="name" class="w-full p-2 border rounded" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="email" class="block font-semibold">Email:</label>
            <input type="email" name="email" id="email" class="w-full p-2 border rounded" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="phone" class="block font-semibold">Phone:</label>
            <input type="text" name="phone" id="phone" class="w-full p-2 border rounded" value="{{ old('phone') }}" required>
        </div>

        <div>
            <label for="date" class="block font-semibold">Date:</label>
            <input type="text" name="date" id="date" class="w-full p-2 border rounded" value="{{ old('date') }}" required>
        </div>

        <div>
            <label for="department" class="block font-semibold">Department:</label>
            <input type="text" name="department" id="department" class="w-full p-2 border rounded" value="{{ old('department') }}" required>
        </div>

        <div>
            <label for="doctor" class="block font-semibold">Doctor:</label>
            <input type="text" name="doctor" id="doctor" class="w-full p-2 border rounded" value="{{ old('doctor') }}" required>
        </div>

        <div>
            <label for="age" class="block font-semibold">Age:</label>
            <input type="number" name="age" id="age" class="w-full p-2 border rounded" value="{{ old('age') }}" required>
        </div>

        <div>
            <label for="gender" class="block font-semibold">Gender:</label>
            <select name="gender" id="gender" class="w-full p-2 border rounded" required>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div>
            <label for="description" class="block font-semibold">Description:</label>
            <textarea name="description" id="description" class="w-full p-2 border rounded">{{ old('description') }}</textarea>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Create Appointment</button>
        </div>
    </form>
</div>


@endsection

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif