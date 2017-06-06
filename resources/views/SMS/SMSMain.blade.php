<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @yield('meta')
  @yield('title')
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {!! Html::style("plugins/pace/pace.min.css") !!}
  {!! Html::style("css/bootstrap.min.css") !!}
  {!! Html::style("css/font-awesome.css") !!}
  {!! Html::style("css/AdminLTE.min.css") !!}
  {!! Html::style("css/_all-skins.min.css") !!}
  <link rel="icon" href="{{ asset('img/logo.ico') }}">
  @yield('override')
  <style type="text/css">
    .navbar-toggle {
      background:#DD4B39 !important;
      height: 20px;
      margin-top: -5px;
    }
    body { 
      padding-top: 50px; 
    }
  </style>
</head>
<body class="hold-transition skin-red layout-top-nav">
  <header class="main-header">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ url('/') }}" style="background-color: #DD4B39; margin-top: -5px;">
            <img src="{{ asset('img/logo.png') }}" width="35" height="35" style="display: inline-block;">
            <span style="display: inline-block;"><b>Scholar</b>MS</span>
          </a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="{{Request::path() == '/' ? 'active' : ''}}"><a href="{{ url('/') }}">Home</a></li>
            <li {{-- class="{{Request::path() == '/' ? 'active' : ''}} --}}"><a href="{{ url('/') }}">About Us</a></li>
            <li class="{{Request::path() == 'how-to-apply' ? 'active' : ''}}"><a href="{{ url('how-to-apply') }}">How to Apply</a></li>
          </ul>
        </div>
        @yield('login')
      </div>
    </nav>
  </header>
  @yield('middlecontent')
  {!! Html::script("plugins/pace/pace.min.js") !!}
  {!! Html::script("plugins/jQuery/jquery-3.1.1.min.js") !!}
  {!! Html::script("js/bootstrap.min.js") !!} 
  {!! Html::script("plugins/fastclick/fastclick.min.js") !!} 
  {!! Html::script("plugins/slimScroll/jquery.slimscroll.min.js") !!} 
  @yield('endscript')
</body>
</html>