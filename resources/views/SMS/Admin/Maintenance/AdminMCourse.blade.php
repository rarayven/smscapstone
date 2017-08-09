@extends('SMS.Admin.AdminMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Course
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><i class="fa fa-pencil-square-o"></i> Education</li>
			<li class="active"><i class="fa fa-fw fa-book"></i> Course</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="container col-sm-12">
				<div class="box box-danger">
					<div class="modal fade" id="add_course">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{ Form::button('&times;', [
										'class' => 'close',
										'type' => '',
										'data-dismiss' => 'modal'
										]) 
									}}
									<h4>Add Course</h4>
								</div>
								<div class="modal-body">
									{{ Form::open([
										'id' => 'frmCourse', 'data-parsley-whitespace' => 'squish'
										])
									}}
									<div class="form-group">
										{{ Form::label('name', 'Abbreviation') }}
										{{ Form::text('abbreviation', null, [
											'id' => 'abbreviation',
											'class' => 'form-control',
											'maxlength' => '10',
											'required' => 'required',
											'data-parsley-pattern' => '^[a-zA-Z]+$',
											'autocomplete' => 'off'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Course Name') }}
										{{ Form::text('strCourDesc', null, [
											'id' => 'strCourDesc',
											'class' => 'form-control',
											'maxlength' => '50',
											'required' => 'required',
											'data-parsley-pattern' => '^[a-zA-Z. ]+$',
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
						{{ Form::button("<i class='fa fa-plus'></i> Add Course", [
							'id' => 'btn-add',
							'class' => 'btn btn-primary btn-sm',
							'value' => 'add',
							'type' => '',
							'style' => 'margin-bottom: 10px;'
							]) 
						}}
						<table id="course-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>Abbreviation</th>
								<th>Course Name</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							<tbody id="course-list">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
	@section('script')
	{!! Html::script("custom/CourseAjax.min.js") !!}
	<script type="text/javascript">
		var dataurl = "{!! route('course.data') !!}";
	</script>
	@endsection