@extends('SMS.Admin.AdminMain')
@section('content')
<!-- CENTER -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Maintenance
			<small>Semester</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Maintenance</li>
			<li class="active">Semester</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Your Page Content Here -->
		<div class="row">
			<div class="container col-sm-12">
				<div class="box box-danger">
					<div class="modal fade" id="add_sem">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{ Form::button('&times;', [
										'class' => 'close',
										'type' => '',
										'data-dismiss' => 'modal'
										]) 
									}}
									<h4>Add Semester</h4>
								</div>
								<div class="modal-body">{{ Form::open([
									'id' => 'frmSem', 'data-parsley-whitespace' => 'squish'
									])
								}}
								<div class="form-group">
									{{ Form::label('name', 'Semester Description') }}
									{{ Form::text('strSemDesc', null, [
										'id' => 'strSemDesc',
										'class' => 'form-control',
										'maxlength' => '20',
										'required' => 'required',
										'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
										'autocomplete' => 'off'
										]) 
									}}
								</div>
								<div class="form-group">
									{{ Form::button('Submit', [
										'id' => 'btn-save',
										'class' => 'btn btn-success btn-block',
										'value' => 'add',
										'type' => ''
										]) 
									}}
								</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive">
					{{ Form::button("<i class='fa fa-plus'></i> Add Semester", [
						'id' => 'btn-add',
						'class' => 'btn btn-primary btn-sm',
						'value' => 'add',
						'type' => '',
						'style' => 'margin-bottom: 10px;'
						]) 
					}}
					<table id="sem-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
						<thead>
							<th>Semester Description</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody id="sem-list">
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
		<!-- /.box -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('meta')
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('script')
{!! Html::script("custom/SemAjax.js") !!}
<script type="text/javascript">
	var dataurl = "{!! route('sem.data') !!}";
</script>
@endsection