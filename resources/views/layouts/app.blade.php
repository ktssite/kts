<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Kraite Trading School') }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"> -->
    <!-- NProgress -->
    <link href="{{ asset('css/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('css/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('css/bootstrap/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('css/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('css/bootstrap/daterangepicker.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css"> -->
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>



<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @guest
                @yield('content')
            @else
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="/home" class="site_title">
                                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" height="50"> 
                                <span class="logotext">KRAITE TRADING SCHOOL</span>
                                <i class="fas fa-chart-line"></i> <span>{{ config('app.name', 'Laravel') }}</span>
                                <!-- <span><img src="{{ asset('images/text.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="logo"></span> -->
                            </a>
                        </div>
                        <div class="clearfix"></div>
                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                          <div class="profile_pic">
                            <img src="{{ asset('images/default.jpg') }}" alt="..." class="img-circle profile_img">
                          </div>
                          <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ Auth::user()->name }}</h2>
                          </div>
                        </div>
                        <!-- /menu profile quick info -->
                        <br />
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <ul class="nav side-menu">
                                    <li><a href="{{ url('/home') }}"><i class="fas fa-tachometer-alt"></i> Dashboard </a></li>
                                    <li><a href="{{ url('/performance') }}"><i class="fas fa-chart-line"></i> Peformance </a></li>
                                    <li><a href="{{ url('/fund') }}"><i class="fas fa-hand-holding-usd"></i> Funds </a></li>
                                    @can('user-list')
                                        <li><a href="{{ route('users.index') }}"><i class="fas fa-user"></i> Users </a></li>
                                    @endcan
                                    @can('role-list')
                                        <li><a href="{{ route('roles.index') }}"><i class="fas fa-users"></i> Roles </a></li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                        <!-- /sidebar menu -->
                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                          <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                          </a>
                          <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                          </a>
                          <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                          </a>
                          <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                          </a> -->
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>
                <!-- col-md-3 left_col -->
                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('images/default.jpg') }}" alt="">{{ Auth::user()->username }}&nbsp; 
                                    <span class=" fa fa-angle-down"></span>
                                  </a>
                                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="{{ route('users.show',app('auth')->user()->id) }}"> Profile</a></li>
                                    <!-- <li>
                                      <a href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                      </a>
                                    </li> 
                                    <li><a href="javascript:;">Help</a></li>-->
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            <i class="fas pull-right fa-sign-out-alt"></i>{{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                    <!-- <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li> -->
                                  </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- top navigation -->
                <!-- page content -->
                <div class="right_col" role="main">
                    @yield('content')
                </div>
                <!-- page content -->

                <!-- footer content -->
                <footer>
                  <div class="pull-right">
                    Kaite Trading School System
                  </div>
                  <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            @endguest
            
        </div> <!-- main_container -->
    </div>
</body>

<!-- jQuery -->
<script src="{{ asset('js/jQuery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('js/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('js/nprogress.js') }}"></script>
<!-- Chart.js -->
<script src="{{ asset('js/Chart.min.js') }}"></script>
<!-- gauge.js -->
<script src="{{ asset('js/gauge.min.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('js/bootstrap/bootstrap-progressbar.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('js/icheck.min.js') }}"></script>
<!-- Skycons -->
<script src="{{ asset('js/skycons.js') }}"></script>
<!-- Flot -->
<script src="{{ asset('js/jQuery/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('js/jQuery/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('js/jQuery/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ asset('js/jQuery/Flot/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('js/jQuery/Flot/jquery.flot.resize.js') }}"></script>
<!-- Flot plugins -->
<script src="{{ asset('js/jQuery/Flot/jquery.flot.orderBars.js') }}"></script>
<script src="{{ asset('js/jQuery/Flot/jquery.flot.spline.min.js') }}"></script>
<script src="{{ asset('js/jQuery/Flot/curvedLines.js') }}"></script>
<!-- DateJS -->
<script src="{{ asset('js/date.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('js/jqvmap/jquery.vmap.js') }}"></script>
<script src="{{ asset('js/jqvmap/jquery.vmap.world.js') }}"></script>
<!-- <script src="{{ asset('js/jqvmap/jquery.vmap.sampledata.js') }}"></script> -->
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker.js') }}"></script>
@stack('scripts')
</html>