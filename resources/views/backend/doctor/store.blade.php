@extends('backend.layouts.layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Create New Doctor</div>

              <div class="card-body">
                  <form method="POST" action="{{route('doctor.store')}}" enctype="multipart/form-data">
                      @csrf

                      <div class="form-group">
                          <label for="name">Name:</label>
                          <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                      </div>

                      <div class="form-group">
                          <label for="image">Image:</label>
                          <input type="file" id="image" name="image" class="form-control-file" accept="image/*" required>
                      </div>

                      <div class="form-group">
                          <label for="department">Department:</label>
                          <select name="department" id="department" class="form-select">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>

                      <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
