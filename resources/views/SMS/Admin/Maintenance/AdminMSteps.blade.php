@extends('SMS.Admin.AdminMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Steps
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><i class="fa fa-sticky-note-o"></i> Scholarship</li>
			<li class="active"><i class="fa fa-fw fa-line-chart"></i> Steps</li>
		</ol>
	</section>
	<section class="content">
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
								<th>Order No.</th>
								<th>Steps Description</th>
								<th>Days of Completion</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							<tbody id="steps-list">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
	@section('script')
	{!! Html::script("plugins/jQueryUI/jquery-ui.min.js") !!}
	{!! Html::script("custom/StepsAjax.min.js") !!}
	<script type="text/javascript">
		var dataurl = "{!! route('steps.data') !!}";
	</script>
	{!! Html::script("js/comparison.js") !!}
	@endsection