@extends('SMS.SMSMain')
@section('title')
<title>ScholarMS|Login</title>
@endsection
@section('override')
{!! Html::style("css/form-elementslogin.css") !!}
{!! Html::style("css/stylelogin.css") !!}
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
            {{ Form::open([
              'role' => 'form',
              'class' => 'login-form'])
            }}
            <div class="form-group">
              {{ Form::label('email', 'Email',[
                'class' => 'sr-only'
                ]) }}
              {{ Form::text('email', null, [
                'id' => 'form-username',
                'class' => 'form-username form-control',
                'placeholder' => 'Email...',
                'autocomplete' => 'off'
                ]) 
              }}
            </div>
            <div class="form-group">
              {{ Form::label('password', 'Password',[
                'class' => 'sr-only'
                ]) }}
                <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                {{-- {{ Form::password('password', null, [
                  'id' => 'form-password',
                  'class' => 'form-password form-control',
                  'placeholder' => 'Password...',
                  'autocomplete' => 'off'
                  ]) 
                }} --}}
              </div>
              <div class="form-group">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                  </label>
                </div>
              </div>
              {{ Form::button('Sign in!', [
                'class' => 'btn',
                'type' => 'submit'
                ]) 
              }}
              {{-- <button type="submit" class="btn">Sign in!</button> --}}
              {{ Form::close() }}
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