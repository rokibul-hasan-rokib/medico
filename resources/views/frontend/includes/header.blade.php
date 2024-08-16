 <!-- ======= Top Bar ======= -->
 <div id="topbar" class="d-flex align-items-center fixed-top">
     <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
         <div class="align-items-center d-none d-md-flex">
             <i class="bi bi-clock"></i> Monday - Saturday, 8AM to 10PM
         </div>
         <div class="d-flex align-items-center ">
             <li><i class="fas fa-sign-in-alt"></i> <a href="{{route('login.page')}}" class="auth">Login</a></li>
             <li><i class="fas fa-user-plus"></i> <a href="{{route('register')}}" class="auth">Register</a>
         </div>
     </div>
 </div>

 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top">
     <div class="container d-flex align-items-center">

         <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt=""></a>
         <!-- Uncomment below if you prefer to use an image logo -->
         <!-- <h1 class="logo me-auto"><a href="index.html">Medicio</a></h1> -->

         <nav id="navbar" class="navbar order-last order-lg-0 ">
             <ul>
                 <li><a class="nav-link scrollto " href="{{route('home')}}">Home</a></li>
                 <li><a class="nav-link scrollto" href="{{route('about')}}">About</a></li>
                 <li><a class="nav-link scrollto" href="{{route('service')}}">Services</a></li>
                 <li><a class="nav-link scrollto" href="{{route('department')}}">Departments</a></li>
                 <li><a class="nav-link scrollto" href="{{route('doctor')}}">Doctors</a></li>
                 <li><a class="nav-link scrollto" href="{{ route('chat') }}">Chating</a></li>
                 <li><a class="nav-link scrollto" href="{{route('contact')}}">Contact</a></li>
                 {{-- <li><a class="nav-link scrollto" href="{{route('ticket')}}">Ticket</a></li> --}}
             </ul>
             <i class="bi bi-list mobile-nav-toggle"></i>
         </nav><!-- .navbar -->

         <a href="{{'appointment'}}" class="appointment-btn scrollto"><span class="d-none d-md-inline">Make an</span>
             Appointment</a>

     </div>
 </header><!-- End Header -->
