@extends('frontend.master.master')
@section('title')
    home
@endsection

@section('content')

   <!-- ======= Doctors Section ======= -->
   <section id="doctors" class="doctors section-bg" style="margin-top: 5rem">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Doctors</h2>
        <p>Doctors, or physicians, are medical professionals who diagnose, treat, and manage illnesses and injuries. They play a critical role in maintaining and improving patient health through various means, including medical examinations, prescribing medications, performing surgeries, and offering lifestyle advice.

          There are different types of doctors, each specializing in particular areas of medicine:</p>
      </div>

      <div class="row">
        @foreach ($doctors as $doctor)
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member" data-aos="fade-up" data-aos-delay="100">
            <div class="member-img">
            @if ($doctor->image)
              <img src="{{ asset($doctor->image) }}" class="img-fluid" alt="">
            @endif

              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info">
              <h4>{{ $doctor->name }}</h4>
              <span>{{ $doctor->department }}</span>
            </div>
          </div>
        </div>
        @endforeach

      </div>

    </div>
  </section><!-- End Doctors Section -->

@endsection
