@extends('frontend.master.master')
@section('title')
    home
@endsection

@section('content')

  <!-- ======= Appointment Section ======= -->
  <section id="appointment" class="appointment section-bg" style="margin-top: 5rem">
    <div class="container" data-aos="fade-up">
      @include('sweetalert::alert')
      <div class="section-title">
        <h2>Make an Appointment</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
      </div>

      <form action="{{route('appointment.store')}}" method="post">
        @csrf
        <div class="row">
          <div class="col-md-4 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
          </div>
          <div class="col-md-4 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
          </div>
          <div class="col-md-4 form-group mt-3 mt-md-0">
            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" required>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 form-group mt-3">
            <input type="datetime" name="date" class="form-control datepicker" id="date" placeholder="Appointment Date" required>
          </div>

          <div class="col-md-4 form-group mt-3">
            <select name="department" id="department" class="form-select">
              <option value="">Select Department</option>
              @foreach ($departments as $department)
              <option value="{{ $department->id }}">{{ $department->name }}</option>
              @endforeach
            </select>
          </div>
         
         
          <div class="col-md-4 form-group mt-3">
            <select name="doctor" id="doctor" class="form-select">
              <option value="">Select Doctor</option>
              @foreach ($doctors as $doctor)
              <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
              @endforeach
            </select>
          </div>
         
        </div>

        <div class="form-group mt-3">
          <textarea class="form-control" name="description" id="description" rows="5" placeholder="Message (Optional)"></textarea>
        </div>
      
        <div class="text-center"><button type="submit">Make an Appointment</button></div>
      </form>

    </div>
  </section><!-- End Appointment Section -->

@endsection

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif