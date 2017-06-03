@extends('SMS.SMSMain')
@section('title')
<title>Quezon City Council Scholarship Management System</title>
@endsection
@section('override')
{!! Html::style("css/stylesheet.css") !!}
{!! Html::style("css/style.css") !!}
@endsection
@section('login')
<ul class="nav navbar-nav navbar-right">
	<li class="{{Request::path() == 'login' ? 'active' : ''}}"><a href="{{ url('/login') }}">Login</a></li>
</ul>
@endsection
@section('middlecontent')
<!--contents here-->
@endsection
@section('endscript')
<script type="text/javascript">
	$.backstretch("../../img/backgrounds/1apply.jpg");
</script>
@endsection