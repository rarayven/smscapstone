@extends('SMS.SMSMain')
@section('title')
<title>Quezon City Council Scholarship Management System</title>
@endsection
@section('override')
<style type="text/css">
	.carousel-inner > .item > img,
	.carousel-inner > .item > a > img {
		height: 500px;
		width: 100%;
	}
	.main-footer {
		width: 100%;
		margin-left: 0px;
		background: #333333;
		color: white;
		border-top: 0px;
	}
	.jumbo {
		background-image: url('../../img/carousel/3.jpg');
		background-size: cover;
		background-repeat: no-repeat;
		color: white;
		margin-top: -30px;
		text-shadow: black 0.3em 0.3em 0.3em;
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
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
	</ol>
	<div class="carousel-inner">
		<div class="item active">
			<img src="{{ asset('img/carousel/1.jpg') }}" alt="First slide">
		</div>
		<div class="item">
			<img src="{{ asset('img/carousel/2.jpg') }}" alt="Second slide">
		</div>
		<div class="item">
			<img src="{{ asset('img/carousel/3.jpg') }}" alt="Third slide">
		</div>
	</div>
	<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		<span class="fa fa-angle-left"></span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		<span class="fa fa-angle-right"></span>
	</a>
</div>
<div class="jumbotron">
	<div class="container">
		<h1 class="display-3">Hello, world!</h1>
		<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
		<hr class="m-y-md">
		<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
		<p class="lead">
			<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
		</p>
	</div>
</div>
<div class="jumbotron jumbo">
	<div class="container">
		<h1 class="display-3">Hello, world!</h1>
		<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
		<hr class="m-y-md">
		<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
		<p class="lead">
			<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
		</p>
	</div>
</div>
<div class="content-section" style="margin-top: -30px;">
	<div class="col-xs-6">
		<div class="container">
			<h2 class="section-heading">Title<br></h2>
			<p class="lead">Description.</p>
		</div>
	</div>
	<div class="col-xs-6" style="padding: 0px;">
		<img class="img-responsive" src="{{ asset('img/carousel/1.jpg') }}" alt="">
	</div>
</div>
<div class="content-section">
	<div class="col-xs-6" style="padding: 0px;">
		<img class="img-responsive" src="{{ asset('img/carousel/2.jpg') }}" alt="">
	</div>
	<div class="col-xs-6">
		<div class="container">
			<h2 class="section-heading">Title<br></h2>
			<p class="lead">Description.</p>
		</div>
	</div>
</div>
<br>
<footer class="main-footer col-xs-12">
	<strong>Copyright &copy; 2017 <a href="{{ route('sms.index') }}">Scholarship Management System</a>.</strong> All rights
	reserved.
</footer>
@endsection
@section('endscript')
{!! Html::script("js/bootbox.min.js") !!} 
<script type="text/javascript">
	@if (Session::has('success'))
	bootbox.alert({
		message: "<br><h1><center>{{Session::get('success')}}</h1></center>",
		backdrop: true,
		buttons: {
			ok: {
				label: 'Ok',
				className: 'btn-success btn-lg'
			}
		}
	});
	@endif
</script>
@endsection