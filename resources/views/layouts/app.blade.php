<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{!! asset('css/style.css') !!}" media="all" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <link rel="stylesheet" href="/css/sidebar/css/lib/fontello.css" />
    <link rel="stylesheet" href="/css/sidebar/css/lib/normalize.css" />

    <link rel="stylesheet" href="/css/sidebar/css/index.css" />

    <link rel="stylesheet" href="/css/sidebar/css/sidebar.css" />


    <style>


        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>


<body id="app-layout">



<nav class="sidebar jsc-sidebar" id="jsi-nav" data-sidebar-options="">
<ul class="sidebar-list">
  <!-- Collapsed Hamburger -->
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
      <span class="sr-only">Toggle Navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
  </button>

  <!-- Branding Image -->

</div>

<div class="collapse navbar-collapse" id="app-navbar-collapse">
  <!-- Left Side Of Navbar -->
  <ul class="nav navbar-nav">
    <p></p>
    <li><a class="navbar-brand home" style="width:70px;height:63px" href="{{ url('/') }}">
    </a></li><br>
      <li><a class="collect" style="width:70px;height:63px" href="{{ url('deliveries') }}"></a></li><br>
      @if (!Auth::guest())

          @if (Auth::user()->isStaff())
              <li><a class="add" style="width:76px;height:69px" href="{{ url('create') }}"></a></li><br>
              <li><a class="delete" style="width:76px;height:69px" href="{{ url('deliveries-all') }}"></a></li><br>
          @endif

          <li><a class="logout" style="width:70px;height:63px" href="{{ url('/logout') }}"></a></li><br>
      @endif
  </ul>

</ul>
</nav>

<div class="wrapper jsc-sidebar-content jsc-sidebar-pulled">

    <nav class="navbar navbar-default" style="height:40px">
        <div class="container">
            <div class="navbar-header">

              <a href="#" class="icon-menu link-menu jsc-sidebar-trigger"></a>


                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">

                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->getFullName() }} <span class="caret"></span>
                            </a>


                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>

                        </li>

                        <li><center>Dashboard</center></li>

                    @endif
                </ul>
            </div>
        </div>
    </nav>




    @yield('content')

</div>

    		<script src="/css/sidebar/js/lib/jquery.min.js"></script>

    		<script src="/css/sidebar/js/sidebar.js"></script>

    		<script>
    			$('#jsi-nav').sidebar({
    				trigger: '.jsc-sidebar-trigger',
    				scrollbarDisplay: false,
    				pullCb: function () { console.log('pull'); },
    				pushCb: function () { console.log('push'); }
    			});

    			$('#api-push').on('click', function (e) {
    				e.preventDefault();
    				$('#jsi-nav').data('sidebar').push();
    			});
    			$('#api-pull').on('click', function (e) {
    				e.preventDefault();
    				$('#jsi-nav').data('sidebar').pull();
    			});
    		</script>

</body>
</html>
