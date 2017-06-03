<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @yield('meta')
  @yield('title')
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {!! Html::style("css/bootstrap.min.css") !!}
  {!! Html::style("css/font-awesome.css") !!}
  {!! Html::style("css/AdminLTE.min.css") !!}
  {!! Html::style("css/_all-skins.min.css") !!}
  {!! Html::style("css/bootstrap-toggle.min.css") !!}
  {!! Html::style("css/style.css") !!}
  {!! Html::style("plugins/iCheck/flat/_all.css") !!}
  {!! Html::style("css/parsley.css") !!}
  <link rel="icon" href="{{ asset('img/logo.ico') }}">
  @yield('override')
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
<body class="skin-red">
  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo" style="background-color: #DD4B39">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>MS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-sm"><b>Scholar</b>MS</span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="{{Request::path() == '/' ? 'active' : ''}}"><a href="{{ url('/') }}">Home</a></li>
            <li {{-- class="{{Request::path() == '/' ? 'active' : ''}} --}}"><a href="{{ url('/') }}">About Us</a></li>
            <li class="{{Request::path() == 'how-to-apply' ? 'active' : ''}}"><a href="{{ url('how-to-apply') }}">How to Apply</a></li>
          </ul>
          @yield('login')
        </div>
      </div>
    </nav>
  </header>
  @yield('middlecontent')
  {!! Html::script("plugins/jQuery/jquery-3.1.1.min.js") !!}
  {!! Html::script("js/bootstrap.min.js") !!} 
  {!! Html::script("js/jquery.backstretch.min.js") !!} 
  {!! Html::script("js/retina-1.1.0.min.js") !!} 
  {!! Html::script("plugins/input-mask/jquery.inputmask.js") !!} 
  {!! Html::script("plugins/input-mask/jquery.inputmask.date.extensions.js") !!} 
  {!! Html::script("plugins/input-mask/jquery.inputmask.extensions.js") !!}
  {!! Html::script("plugins/jQueryUI/jquery-ui.min.js") !!} 
  {!! Html::script("plugins/iCheck/icheck.min.js") !!}
  {!! Html::script("plugins/fastclick/fastclick.min.js") !!} 
  {!! Html::script("plugins/slimScroll/jquery.slimscroll.min.js") !!} 
  {!! Html::script("js/parsley.min.js") !!}  
  @yield('endscript')
</body>
</html>