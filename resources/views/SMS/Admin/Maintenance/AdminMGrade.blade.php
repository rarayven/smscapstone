@extends('SMS.Admin.AdminMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Grade
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><i class="fa fa-pencil-square-o"></i> Education</li>
			<li class="active"><i class="fa fa-fw fa-level-up"></i> Grade</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="container col-sm-12">
				<div class="box box-danger">
					<div class="modal fade" id="add_grade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{ Form::button('&times;', [
										'class' => 'close',
										'type' => '',
										'data-dismiss' => 'modal'
										]) 
									}}
									<h4>Add Academic Grading</h4>
								</div>
								<div class="modal-body">
									{{ Form::open([
										'id' => 'frmGrade', 'data-parsley-whitespace' => 'squish'
										])
									}}
									<div class="form-group">
										{{ Form::label('name', 'Grade Description') }}
										{{ Form::text('strSystDesc', null, [
											'id' => 'strSystDesc',
											'class' => 'form-control',
											'maxlength' => '25',
											'required' => 'required',
											'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
											'autocomplete' => 'off'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Highest Grade') }}
										{{ Form::text('dblSystHighGrade', null, [
											'id' => 'dblSystHighGrade',
											'class' => 'form-control',
											'maxlength' => '4',
											'required' => 'required',
											'data-parsley-pattern' => '^[a-zA-Z0-9+-. ]+$',
											'autocomplete' => 'off'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Lowest Grade') }}
										{{ Form::text('dblSystLowGrade', null, [
											'id' => 'dblSystLowGrade',
											'class' => 'form-control',
											'maxlength' => '4',
											'required' => 'required',
											'autocomplete' => 'off',
											'data-parsley-pattern' => '^[a-zA-Z0-9+-. ]+$',
											'data-parsley-notequalto' => '#dblSystHighGrade'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Failing Grade') }}
										{{ Form::text('strSystFailGrade', null, [
											'id' => 'strSystFailGrade',
											'class' => 'form-control',
											'maxlength' => '4',
											'required' => 'required',
											'data-parsley-pattern' => '^[a-zA-Z0-9+-. ]+$',
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
						{{ Form::button("<i class='fa fa-plus'></i> Add Academic Grading", [
							'id' => 'btn-add',
							'class' => 'btn btn-primary btn-sm',
							'value' => 'add',
							'type' => '',
							'style' => 'margin-bottom: 10px;'
							]) 
						}}
						<table id="grade-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>Grade Description</th>
								<th>Highest Grade</th>
								<th>Lowest Grade</th>
								<th>Failing Grade</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							<tbody id="grade-list">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
	@section('script')
	{!! Html::script("custom/GradeAjax.min.js") !!}
	<script type="text/javascript">
		var dataurl = "{!! route('grade.data') !!}";
	</script>
	{!! Html::script("js/comparison.js") !!}
	@endsection
