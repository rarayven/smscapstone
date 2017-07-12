<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Scholarship MS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {!! Html::style("plugins/pace/pace.min.css") !!}
  {!! Html::style("css/bootstrap.min.css") !!}
  {!! Html::style("css/font-awesome.css") !!}
  {!! Html::style("css/bootstrap-toggle.min.css") !!}
  {!! Html::style("plugins/sweetalert/sweetalert.min.css") !!}
  {!! Html::style("css/stylesheet.css") !!}
  {!! Html::style("css/parsley.css") !!}
  @yield('override')
  {!! Html::style("css/AdminLTE.min.css") !!}
  {!! Html::style("css/_all-skins.min.css") !!}
  {!! Html::script("plugins/jQuery/jquery-3.2.1.min.js") !!}
  {!! Html::script("js/bootstrap.min.js") !!}
  {!! Html::script("js/camelcase.min.js") !!} 
  {!! Html::script("plugins/pace/pace.min.js") !!}
  <style type="text/css">
    [data-notify="container"] {
      width: 25%;
    }
  </style>
  <link rel="icon" href="{{ asset('img/logo.ico') }}">
</head>
<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="{{ url('student/dashboard') }}" class="logo">
        <span class="logo-mini"><img src="{{ asset('img/logo.png') }}" width="35" height="35"></span>
        <span class="logo-lg"><b>Scholar</b>MS</span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('images/'.Auth::user()->picture) }}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="{{ asset('images/'.Auth::user()->picture) }}" class="img-circle" alt="User Image">
                  <p style="text-align: center;">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    <small>{{ Auth::user()->type }}</small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ url('student/profile') }}" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> 
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
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('images/'.Auth::user()->picture) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
          <small>Coun. {{ $councilor->first_name }} {{ $councilor->last_name }}</small>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">NAVIGATION</li>
        <li class="{{Request::path() == 'student/dashboard' ? 'active' : ''}}"><a href="{{ url('student/dashboard') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        <li class="{{Request::path() == 'student/announcements' ? 'active' : ''}}"><a href="{{ url('student/announcements') }}"><i class="fa fa-bullhorn"></i><span>Announcements</span><small class="label pull-right bg-green panelanno"></small></a></li>
        <li class="{{Request::path() == 'student/messages' ? 'active' : ''}} {{Request::path() == 'student/messages/create' ? 'active' : ''}} {{Request::path() == 'student/messages/sent' ? 'active' : ''}}"><a href="{{ url('student/messages') }}"><i class="fa fa-envelope"></i><span>Messages</span><small class="label pull-right bg-green panelnotif"></small></a></li>
        <li class="{{Request::path() == 'student/events' ? 'active' : ''}}"><a href="{{ url('student/events') }}"><i class="fa fa-flag"></i><span>Events</span><small class="label pull-right bg-yellow panelevent"></small></a></li>
        <li class="{{Request::path() == 'student/renewal' ? 'active' : ''}}"><a href="{{ url('student/renewal') }}"><i class="fa fa-refresh"></i><span>Renewal</span></a></li>
      </ul>
    </section>
  </aside>
  @yield('content')
</div>
{!! Html::script("js/bootstrap-toggle.min.js") !!}
{!! Html::script("js/bootstrap-notify.min.js") !!} 
{!! Html::script("plugins/sweetalert/sweetalert.min.js") !!}
{!! Html::script("js/script.js") !!}
{!! Html::script("plugins/fastclick/fastclick.min.js") !!}
{!! Html::script("js/parsley.min.js") !!}
@yield('script')
{!! Html::script("js/adminlte.min.js") !!}
<script type="text/javascript">
  var notif = "{!! route('studentmessage.unreadmessage') !!}";
  var anno = "{!! route('studentannouncements.unread') !!}";
  var event = "{!! route('studentevents.upcome') !!}";
</script>
{!! Html::script("custom/NotificationAjax.min.js") !!}
{!! Html::script("custom/NotificationAEAjax.min.js") !!}
{!! Html::script("js/ajax-expired-session.js") !!} 
</body>
</html>
