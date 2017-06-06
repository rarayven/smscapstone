<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {!! Html::style("css/bootstrap.min.css") !!}
  {!! Html::style("css/font-awesome.css") !!}
  {!! Html::style("css/AdminLTE.min.css") !!}
  {!! Html::style("css/_all-skins.min.css") !!}
  {!! Html::style("css/parsley.css") !!}
  <link rel="icon" href="{{ asset('img/logo.ico') }}">
  {!! Html::style("plugins/pace/pace.min.css") !!}
  <style type="text/css">
    .navbar-toggle {
      background:#DD4B39 !important;
      height: 20px;
      margin-top: -5px;
    }
    body { 
      background-color: #333333;
    }
  </style>
</head>
<body class="hold-transition skin-red layout-top-nav">
  <header class="main-header">
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ url('/') }}" style="background-color: #DD4B39; margin-top: -5px;">
            <img src="{{ asset('img/logo.png') }}" width="35" height="35" style="display: inline-block;">
            <span style="display: inline-block;"><b>Scholar</b>MS</span>
          </a>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<section class="content col-md-8 col-md-push-2">
  <div class="box box-danger">
    <div class="box-header with-border">
     @if (count($errors) > 0)
     <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong>Errors:</strong>
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <div class="box-header">
      <h3>Input User Information</h3>
    </div>
    {{Form::open([
      'data-parsley-whitespace' => 'squish',
      'data-parsley-validate' => '',
      'enctype' => 'multipart/form-data',
      ])
    }}
    <div class="box-body">
      <div class="col-md-3">
        <div class="box-body box-profile">
          <div class="form-group">
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/'.Auth::user()->picture) }}" alt="User profile picture">
          </div>
          <div class="form-group row">
            <div class="btn btn-default btn-file btn-block">
              <i class="fa fa-image"></i> Change Photo..
              <input type="file" name="image" value="{{ old('image') }}">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="form-group">
          <label for="firstName" class="control-label">First Name*</label>
          <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required="required" maxlength="25" autofocus="autofocus">
        </div>
        <div class="form-group">
          <label for="firstName" class="control-label">Middle Name</label>
          <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}" placeholder="Middle Name" maxlength="25">
        </div>
        <div class="form-group">
          <label for="lastName" class="control-label">Last Name*</label>
          <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required="required" maxlength="25">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="control-label">Contact Number*</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-phone"></i>
            </div>
            <input type="text" class="form-control" name="cell_no" value="{{ old('cell_no') }}" placeholder="+63 9xx xxx xxxx" required="required" maxlength="15">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Password*</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-asterisk"></i>
            </div>
            <input type="password" class="form-control" name="password" placeholder="password" required="required" maxlength="61">
          </div> 
        </div>
        <div class="form-group">
          <label class="control-label">Confirm Password*</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-asterisk"></i>
            </div>
            <input type="password" class="form-control" name="password_confirmation" id="password" placeholder="password" required="required" maxlength="61">
          </div> 
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success btn-block">Save changes</button>
        </div>
      </div>
    </div>
    {{Form::close()}}
  </div>
</div>
</section>
{!! Html::script("plugins/jQuery/jquery-3.1.1.min.js") !!}
{!! Html::script("js/bootstrap.min.js") !!}  
{!! Html::script("plugins/fastclick/fastclick.min.js") !!} 
{!! Html::script("plugins/slimScroll/jquery.slimscroll.min.js") !!}
{!! Html::script("js/parsley.min.js") !!}
{!! Html::script("plugins/pace/pace.min.js") !!}
</script>
</body>
</html>