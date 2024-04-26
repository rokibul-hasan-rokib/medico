<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <h1><a href="/dashboard" class="logo">Project Name</a></h1>
            <ul class="list-unstyled components mb-5">

                <li>
                    <a href=""><span class="fa fa-user mr-3"></span> Dashboard</a>
                </li>
                <li>
                    <a href="{{route('role.index')}}"><span class="fa fa-sticky-note mr-3"></span>Role Mangement</a>
                </li>
                <li>
                    <a href="#"><span class="fa fa-paper-plane mr-3"></span> Settings</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"><span class="fa fa-paper-plane mr-3"></span>Log Out</a>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/main.js') }}"></script>

</body>

</html>
