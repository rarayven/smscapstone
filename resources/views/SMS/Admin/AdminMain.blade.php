<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Scholarship MS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @yield('meta')
  {!! Html::style("css/bootstrap.min.css") !!}
  {!! Html::style("css/font-awesome.css") !!}
  {!! Html::style("css/AdminLTE.min.css") !!}
  {!! Html::style("css/_all-skins.min.css") !!}
  {!! Html::style("css/bootstrap-toggle.min.css") !!}
  {!! Html::style("css/stylesheet.css") !!}
  {!! Html::style("css/parsley.css") !!}
  {!! Html::style("plugins/datatables/dataTables.bootstrap.min.css") !!}
  {!! Html::style("plugins/sweetalert/sweetalert.min.css") !!}
  <link rel="icon" href="{{ asset('img/logo.ico') }}">
  @yield('head')
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <a href="{{ url('admin/index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>MS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Scholar</b>MS</span>
      </a>
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="../../img/avatar5.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="../../img/avatar5.png" class="img-circle" alt="User Image">
                  <p>
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} - {{ Auth::user()->type }}
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Sign out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="../../img/avatar5.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">MAINTENANCE</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="{{Request::path() == 'admin/maintenance/district' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/district') }}"><i class="fa fa-bank"></i> <span>District</span></a></li>
      <li class="{{Request::path() == 'admin/maintenance/barangay' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/barangay') }}"><i class="fa fa-fw fa-map"></i> <span>Barangay</span></a></li>
      <li class="{{Request::path() == 'admin/maintenance/councilor' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/councilor') }}"><i class="fa fa-fw fa-gavel"></i> <span>Councilor</span></a></li>
      <li class="{{Request::path() == 'admin/maintenance/grade' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/grade') }}"><i class="fa fa-fw fa-level-up"></i> <span>Academic Grading</span></a></li>
      <li class="{{Request::path() == 'admin/maintenance/school' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/school') }}"><i class="fa fa-fw fa-graduation-cap"></i> <span>School</span></a></li>
      <li class="{{Request::path() == 'admin/maintenance/course' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/course') }}"><i class="fa fa-fw fa-book"></i> <span>Courses</span></a></li>
      <li class="{{Request::path() == 'admin/maintenance/sem' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/sem') }}"><i class="fa fa-fw fa-slack"></i> <span>Semester</span></a></li>
      <li class="{{Request::path() == 'admin/maintenance/year' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/year') }}"><i class="fa fa-fw fa-table"></i> <span>Year</span></a></li>
      <li class="{{Request::path() == 'admin/maintenance/batch' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/batch') }}"><i class="fa fa-fw fa-stack-overflow"></i> <span>Batch</span></a></li>
      <li class="{{Request::path() == 'admin/maintenance/steps' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/steps') }}"><i class="fa fa-fw fa-line-chart"></i> <span>Steps</span></a></li>
      <li class="{{Request::path() == 'admin/maintenance/budgtype' ? 'active' : ''}}"><a href="{{ url('admin/maintenance/budgtype') }}"><i class="fa fa-fw fa-money"></i> <span>Budget Type</span></a></li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
@yield('content')

</div>
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
{!! Html::script("plugins/jQuery/jquery-3.1.1.min.js") !!}
{!! Html::script("plugins/jQueryUI/jquery-ui.min.js") !!}
{!! Html::script("js/bootstrap.min.js") !!} 
{!! Html::script("js/bootstrap-toggle.min.js") !!} 
{!! Html::script("js/script.js") !!}
{!! Html::script("js/app.min.js") !!} 
{!! Html::script("plugins/fastclick/fastclick.min.js") !!} 
{!! Html::script("plugins/slimScroll/jquery.slimscroll.min.js") !!}
{!! Html::script("js/parsley.min.js") !!}
{!! Html::script("plugins/datatables/jquery.dataTables.min.js") !!}
{!! Html::script("plugins/datatables/dataTables.bootstrap.min.js") !!}
{!! Html::script("plugins/sweetalert/sweetalert.min.js") !!}
@yield('script')
</body>
</html>