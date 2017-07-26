@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Renewal
		</h1>
		<ol class="breadcrumb">
			<li><a href={{ url('coordinatr/dashboard') }}> <i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><i class="fa fa-refresh"></i> Renewal</a></li>
		</ol>
	</section>
	<section class="content">
		<div class="callout callout-danger">
			<h4><i class="icon fa fa-info"></i> Renewal Status</h4>
			<h5>Renewal Phase Ongoing</h5>
			<input type='checkbox' id='isActive' name='isActive' data-toggle='toggle' data-style='android' data-onstyle='success' data-offstyle='danger' data-on="<i class='fa fa-refresh'></i> Start" data-off="<i class='fa fa-remove'></i> End" data-size='large' checked='checked'>
		</div>
		<div class="box box-danger">
			<div class="box-body">
				<h4><b>Renewing Students</b></h4>
				<table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
					<thead>
						<th>Student Name</th>
						<th>No of Failed</th>
						<th>Action</th>
					</thead>
					<tbody id="list">
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
@endsection
@section('script')
{!! Html::script("custom/CoordinatorRenewalAjax.min.js") !!}
<script type="text/javascript">
	var dataurl = "{!! route('coordinatorrenewal.data') !!}";
</script>
@endsection