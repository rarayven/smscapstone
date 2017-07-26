@extends('SMS.SMSMain')
@section('title')
<title>ScholarMS|Login</title>
@endsection
@section('override')
{!! Html::style("css/form-elementslogin.css") !!}
{!! Html::style("css/stylelogin.css") !!}
{!! Html::style("css/style.css") !!}
{!! Html::style("css/parsley.css") !!}
<style type="text/css">
  .navbar-toggle {
    margin-top: -4px;
  }
</style>
@endsection
@section('login')
<div class="navbar-custom-menu">
  <ul class="nav navbar-nav">
    <li class="{{Request::path() == 'login' ? 'active' : ''}}"><a href="{{ url('/login') }}">Login</a></li>
  </ul>
</div>
@endsection
@section('middlecontent')
<div class="top-content">
  <div class="inner-bg">
    <div class="container col-md-6 col-md-offset-3">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form-box">
          <div class="form-top">
            <div class="form-top-left">
              <h3>Login to our site</h3>
              <p>Enter your email and password to log on:</p>
            </div>
            <div class="form-top-right">
              <i class="fa fa-lock"></i>
            </div>
          </div>
          <div class="form-bottom">
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class='fa fa-check'></i> {{Session::get('success')}}
            </div>
            @endif
            <form class="login-form" role="form" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="sr-only">E-Mail Address</label>
                <input id="email" type="email" placeholder="Email..." class="form-username form-control" name="email" value="{{ old('email') }}" required autofocus tabindex="1">
                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="sr-only">Password</label>
                <input id="password" type="password" placeholder="Password..." class="form-control form-password" name="password" required tabindex="2">
                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
              <div class="row">
                <div class="col-xs-3">
                  <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} tabindex="3"> Remember Me
                    <a class="btn btn-link" style="margin-left: -10px; margin-top: -10px;" href="{{ route('password.request') }}" tabindex="5">
                      Forgot Your Password?
                    </a>
                  </label>
                </div>
                <div class="col-xs-9">
                  <button type="submit" class="btn" tabindex="4">
                    Login!
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('endscript')
{!! Html::script("js/jquery.backstretch.min.js") !!}
{!! Html::script("js/scriptslogin.js") !!}
{!! Html::script("js/parsley.min.js") !!} 
@endsection