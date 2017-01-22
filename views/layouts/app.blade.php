<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>YBTA</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="_asset/css/app.css" rel="stylesheet">
    @yield('css')
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/_asset/images/header-logo.png" alt="You be the agent" title="Home - You be the agent" />
                    <p><span class="b">you</span><span class="y">be</span><span class="b">the</span><span class="y">agent</span><span class="b">.com</span></p>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{{ url('/about')}}">About</a></li>
                    <li><a href="{{ url('/blog')}}">Blog</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Sign in</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/my-houses') }}">Houses</a></li>
                              <li><a href="{{ url('/messages') }}">Messages</a></li>
                              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                    <li><a href="{{ url('/partners') }}">Partners</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
      <div class="container">
        <div class="col-md-offset-1 col-md-10">
          <div class="row">
            <div class="col-md-12 scroll-bottom">
              <i class="fa fa-angle-down"></i>
            </div>
          </div>
          <div class="row bottom-links">
            <div class="col-md-4">
              <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Partners</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <ul>
                <li><a href="#">Register</a></li>
                <li><a href="#">Sign in</a></li>
                <li><a href="#">Help</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <ul>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">Automated Valuations</a></li>
                <li><a href="#">Terms & Conditions</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ url('_asset/fullcalendar') }}/lib/moment.min.js"></script>
    <script src="{{ url('_asset/fullcalendar') }}/fullcalendar.min.js"></script>
    <script src="{{ url('_asset/js') }}/scripts.js"></script>
    @yield('js')
</body>
</html>
