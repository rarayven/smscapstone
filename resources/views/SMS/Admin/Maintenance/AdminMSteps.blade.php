@extends('SMS.Admin.AdminMain')
@section('content')
<!-- CENTER -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Maintenance
			<small>Steps</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Steps</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Your Page Content Here -->
		<div class="row">
			<div class="container col-sm-12">
				<div class="box box-danger">
					<div class="modal fade" id="add_steps">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{ Form::button('&times;', [
										'class' => 'close',
										'type' => '',
										'data-dismiss' => 'modal'
										]) 
									}}
									<h4>Add Steps</h4>
								</div>
								<div class="modal-body">
									{{ Form::open([
										'id' => 'frmSteps', 'data-parsley-whitespace' => 'squish'
										])
									}}
									<div class="form-group">
										{{ Form::label('name', 'Order No.') }}
										{{ Form::text('intStepOrder', null, [
											'id' => 'intStepOrder',
											'class' => 'form-control',
											'maxlength' => '3',
											'required' => 'required',
											'data-parsley-pattern' => '^[0-9]+$',
											'autocomplete' => 'off',
											'data-parsley-type' => 'digits',
											'data-parsley-max' => '255'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Step Description') }}
										{{ Form::text('strStepDesc', null, [
											'id' => 'strStepDesc',
											'class' => 'form-control',
											'maxlength' => '100',
											'required' => 'required',
											'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
											'autocomplete' => 'off'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Days of Completion (max of 30 days)') }}
										{{ Form::text('intStepDeadline', null, [
											'id' => 'intStepDeadline',
											'class' => 'form-control',
											'maxlength' => '2',
											'required' => 'required',
											'data-parsley-pattern' => '^[0-9]+$',
											'autocomplete' => 'off',
											'data-parsley-type' => 'digits',
											'data-parsley-lte' => '30'
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
					<div class="modal fade" id="order_steps">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{ Form::button('&times;', [
										'class' => 'close',
										'type' => '',
										'data-dismiss' => 'modal'
										]) 
									}}
									<h4>Order Steps</h4>
								</div>
								<div class="modal-body">
									{{ Form::open([
										'id' => 'frmOrder'
										])
									}}
									<div class="form-group">
										<div class="col-xs-1" >
											<ul id="count" class="list-unstyled">
											</ul>
										</div>
										<div class="cols-xs-11">
											<ul class="todo-list">
											</ul>
										</div>
									</div>
									<div class="form-group">
										{{ Form::button('Submit', [
											'id' => 'btn-submit',
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
						{{ Form::button("<i class='fa fa-plus'></i> Add Steps", [
							'id' => 'btn-add',
							'class' => 'btn btn-primary btn-sm',
							'value' => 'add',
							'type' => '',
							'style' => 'margin-bottom: 10px;'
							]) 
						}}
						{{ Form::button("<i class='fa fa-sort'></i> Order Steps", [
							'id' => 'btn-order',
							'class' => 'btn btn-info btn-sm',
							'type' => '',
							'style' => 'margin-bottom: 10px;'
							]) 
						}}
						<table id="steps-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>Steps Description</th>
								<th>Days of Completion</th>
								<th>Order No.</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							<tbody id="steps-list">
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
	@section('script')
	{!! Html::script("custom/StepsAjax.js") !!}
	<script type="text/javascript">
		var dataurl = "{!! route('steps.data') !!}";
		$(".todo-list").sortable({
			placeholder: "sort-highlight",
			handle: ".handle",
			forcePlaceholderSize: true,
			zIndex: 999999
		});
	</script>
	{!! Html::script("js/comparison.js") !!}
	@endsection