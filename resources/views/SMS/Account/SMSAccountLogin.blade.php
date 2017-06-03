@extends('SMS.SMSMain')
@section('title')
<title>ScholarMS|Login</title>
@endsection
@section('override')
{!! Html::style("css/form-elementslogin.css") !!}
{!! Html::style("css/stylelogin.css") !!}
@endsection
@section('login')
<ul class="nav navbar-nav navbar-right">
  <li class="{{Request::path() == 'login' ? 'active' : ''}}"><a href="{{ url('/login') }}">Login</a></li>
</ul>
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
            <form class="login-form" role="form" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="sr-only">E-Mail Address</label>
                <input id="email" type="text" placeholder="Email..." class="form-username form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="sr-only">Password</label>
                <input id="password" type="password" placeholder="Password..." class="form-control form-password" name="password" required>
                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
              <div class="row">
                <div class="col-md-9">
                  <button type="submit" class="btn">
                    Sign in!
                  </button>
                </div>
                <div class="col-md-3" style="padding: 0px;">
                  <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    <a class="btn btn-link" style="margin-left: -10px; margin-top: -10px;" href="{{ route('password.request') }}">
                      Forgot Password?
                    </a>
                  </label>

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
@endsection