<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @yield('meta')
  <title>Scholarship MS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {!! Html::style("css/bootstrap.min.css") !!}
  {!! Html::style("css/font-awesome.css") !!}
  {!! Html::style("css/bootstrap-toggle.min.css") !!}
  {!! Html::style("css/stylesheet.css") !!}
  {!! Html::style("css/parsley.css") !!}
  {!! Html::style("plugins/datatables/dataTables.bootstrap.min.css") !!}
  {!! Html::style("plugins/sweetalert/sweetalert.min.css") !!}
  @yield('override')
  {!! Html::style("css/AdminLTE.min.css") !!}
  {!! Html::style("css/_all-skins.min.css") !!}
  <link rel="icon" href="{{ asset('img/logo.ico') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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
      <a href="{{ url('coordinator/dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>MS</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Scholar</b>MS</span>
      </a>
      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a class="sidebar-toggle" data-toggle="offcanvas" role="button">
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
                <img src="{{ asset('images/'.Auth::user()->picture) }}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{ asset('images/'.Auth::user()->picture) }}" class="img-circle" alt="User Image">
                  <p>
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} - {{ Auth::user()->type }}
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ url('coordinator/profile') }}" class="btn btn-default btn-flat">Profile</a>
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
          <img src="{{ asset('images/'.Auth::user()->picture) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="{{Request::path() == 'coordinator/dashboard' ? 'active' : ''}}"><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        <li class="{{Request::path() == 'coordinator/applicants' ? 'active' : ''}}"><a href="{{ url('coordinator/applicants') }}"><i class="fa fa-fw fa-users"></i> <span>Applicants</span></a></li>
        <li class="treeview {{Request::path() == 'coordinator/list' ? 'active' : ''}} {{Request::path() == 'coordinator/progress' ? 'active' : ''}}">
          <a href="#"><i class="fa  fa-graduation-cap"></i> <span>Students</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::path() == 'coordinator/list' ? 'active' : ''}}"><a href="{{ url('coordinator/list') }}"><i class="fa fa-list-ul"></i>Student List</a></li>
            <li class="{{Request::path() == 'coordinator/progress' ? 'active' : ''}}"><a href="{{ url('coordinator/progress') }}"><i class="fa fa-tasks"></i>Step Progress</a></li>
          </ul>
        </li>
        <li class="treeview {{Request::path() == 'coordinator/achievements' ? 'active' : ''}} {{Request::path() == 'coordinator/token' ? 'active' : ''}}">
          <a href="#"><i class="fa  fa-trophy"></i> <span>Achievements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::path() == 'coordinator/achievements' ? 'active' : ''}}"><a href="{{ url('coordinator/achievements') }}"><i class="fa fa-star"></i>Student Achievements</a></li>
            <li class="{{Request::path() == 'coordinator/token' ? 'active' : ''}}"><a href="{{ url('coordinator/token') }}"><i class="fa fa-gift"></i>Token Processing</a></li>
          </ul>
        </li>
        <li class="{{Request::path() == 'coordinator/messages' ? 'active' : ''}}{{Request::path() == 'coordinator/messages/create' ? 'active' : ''}} {{Request::path() == 'coordinator/messages/sent' ? 'active' : ''}}"><a href="{{ url('coordinator/messages') }}"><i class="fa fa-envelope"></i> <span>Messages</span><small class="label pull-right bg-green panelnotif"></small></a></li>
        <li class="{{Request::path() == 'coordinator/announcements' ? 'active' : ''}}"><a href="{{ url('coordinator/announcements') }}"><i class="fa fa-bullhorn"></i> <span>Announcements</span></a></li>
        <li class="{{Request::path() == 'coordinator/events' ? 'active' : ''}}"><a href="{{ url('coordinator/events') }}"><i class="fa fa-flag"></i> <span>Events</span></a></li>
        <li class="{{Request::path() == 'coordinator/budget' ? 'active' : ''}}"><a href="{{ url('coordinator/budget') }}"><i class="fa fa-fw fa-money"></i> <span>Budget</span></a></li>
        <li class="treeview {{Request::path() == 'coordinator/reports' ? 'active' : ''}} {{Request::path() == 'coordinator/reports' ? 'active' : ''}}">
          <a href="#"><i class="fa  fa-trophy"></i> <span>Reports</span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::path() == 'coordinator/reports' ? 'active' : ''}}"><a href="{{ url('coordinator/reports') }}"><i class="fa fa-star"></i>Students</a></li>
          </ul>
        </li>
        <li class="{{Request::path() == 'coordinator/queries' ? 'active' : ''}}"><a href="{{ url('coordinator/queries') }}"><i class="fa fa-fw fa-list"></i> <span>Queries</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  @yield('content')
  <!-- Main Footer -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
{!! Html::script("plugins/jQuery/jquery-3.1.1.min.js") !!}
{!! Html::script("plugins/jQueryUI/jquery-ui.min.js") !!}
{!! Html::script("js/bootstrap.min.js") !!}
{!! Html::script("js/bootstrap-toggle.min.js") !!}
{!! Html::script("js/script.js") !!}
{!! Html::script("plugins/fastclick/fastclick.min.js") !!}
{!! Html::script("plugins/slimScroll/jquery.slimscroll.min.js") !!}
{!! Html::script("js/parsley.min.js") !!}
{!! Html::script("plugins/datatables/jquery.dataTables.min.js") !!}
{!! Html::script("plugins/datatables/dataTables.bootstrap.min.js") !!}
{!! Html::script("plugins/sweetalert/sweetalert.min.js") !!}
{!! Html::script("custom/NotificationAjax.js") !!}
@yield('script')
{!! Html::script("js/app.min.js") !!}
<script type="text/javascript">
  var notif = "{!! route('coordinatormessage.unreadmessage') !!}";
</script>
</body>
</html>
