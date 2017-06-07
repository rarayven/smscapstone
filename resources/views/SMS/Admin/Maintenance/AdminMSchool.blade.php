@extends('SMS.Admin.AdminMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			School
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><i class="fa fa-pencil-square-o"></i> Education</li>
			<li class="active"><i class="fa fa-fw fa-graduation-cap"></i> School</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="container col-sm-12">
				<div class="box box-danger">
					<div class="modal fade" id="add_school">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{ Form::button('&times;', [
										'class' => 'close',
										'type' => '',
										'data-dismiss' => 'modal'
										]) 
									}}
									<h4>Add School</h4>
								</div>
								<div class="modal-body">
									{{ Form::open([
										'id' => 'frmSchool', 'data-parsley-whitespace' => 'squish'
										])
									}}
									<div class="form-group">
										{{ Form::label('name', 'Select Academic Grading') }}
										{{ Form::select('intSystID', $grade, null, [
											'id' => 'intSystID',
											'class' => 'form-control'])
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'School Name') }}
										{{ Form::text('strSchoDesc', null, [
											'id' => 'strSchoDesc',
											'class' => 'form-control',
											'maxlength' => '50',
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
					<div class="box-body table-responsive">
						{{ Form::button("<i class='fa fa-plus'></i> Add School", [
							'id' => 'btn-add',
							'class' => 'btn btn-primary btn-sm',
							'value' => 'add',
							'type' => '',
							'style' => 'margin-bottom: 10px;'
							]) 
						}}
						<table id="school-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>School Name</th>
								<th>Academic Grading</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							<tbody id="school-list">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
	@section('script')
	{!! Html::script("custom/SchoolAjax.min.js") !!}
	<script type="text/javascript">
		var dataurl = "{!! route('school.data') !!}";
	</script>
	@endsection