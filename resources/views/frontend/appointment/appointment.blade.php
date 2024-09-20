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
                <p>From here you will register. Select your Name, Email, Phone, Appointment Date, Department and Doctor and
                    make your comments. Our representative will contact you.</p>
            </div>
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 mb-6 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('appointment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                            required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                            required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Your Phone"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group mt-3">
                        <input type="date" name="date" class="form-control" id="date"
                            placeholder="Appointment Date" required>
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
                <div class="row">
                    <div class="col-md-4 form-group mt-3">
                        <input type="number" name="age" class="form-control" id="age" placeholder="Your Age"
                            required>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <select name="gender" id="gender" class="form-select" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
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

    <script>
        $(function() {
            var today = new Date();
            var maxDate = new Date(today);
            maxDate.setDate(today.getDate() + 30);

            $("#date").datepicker({
                minDate: 0, // today
                maxDate: maxDate, // 30 days from today
                dateFormat: "yy-mm-dd" // use the desired date format
            });
        });
    </script>

@endsection

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
