@extends('SMS.Admin.AdminMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Utilities
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><i class="fa fa-fw fa-gear"></i> Utilities</li>
		</ol>
	</section>
	<section class="content">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">Settings</a></li>
				<li><a href="#tab_2" data-toggle="tab">Backup</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active row" id="tab_1">
				</div>
				<div class="tab-pane row" id="tab_2">
				</div>
			</div>
		</div>
	</section>
</div>
@endsection