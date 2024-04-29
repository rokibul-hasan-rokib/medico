@extends('backend.layouts.layout')

@section('content')
<h1>Slider</h1>
<a href="{{route('slider.show')}}" class="btn btn-primary float-right mr-3 mb-2">Add Department</a>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sliders as $slider)
            <tr>
                <td>{{ $slider->name }}</td>
                <td><img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->name }}" style="max-width: 100px;"></td>
                <td>{{ $slider->description }}</td>
                {{-- <td>
                    <a class="btn-small btn-success" href="{{ route('user.edit', $user->id) }}">Update</a>
                    <a class="btn-small btn-danger" href="{{ route('user.destroy', $user->id) }}">Delete</a>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
@endsection