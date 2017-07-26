@extends('SMS.Student.StudentMain')
@section('override')
{!! Html::style("plugins/iCheck/flat/red.css") !!}
{!! Html::script("plugins/jQueryUI/jquery-ui.min.js") !!}
{!! Html::style("plugins/select2/select2.min.css") !!}
<style type="text/css">
	#shift { 
		display: none; 
	}
</style>
@endsection
@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Renewal
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('student/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><i class="fa fa-refresh"></i> Renewal</li>
		</ol>
	</section>
	<section class="content">
		<div class="alert alert-info alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-info"></i> Info</h4>
			You are free to edit your personal and family data in the Account Settings.
		</div>
		@if ($application->is_renewal == 0)
		<div class="callout callout-success">
			<h4><i class="icon fa fa-info"></i> Renewal Status</h4>
			Renewal Phase Ongoing.
		</div>
		<div class="box box-danger">
			<div class="box-header with-border">
				<h4><b>Subjects</b></h4>
			</div>
			<div class="box-body">
				{{ Form::open([
					'id' => 'frm', 
					'data-parsley-validate' => '',
					'enctype' => 'multipart/form-data'
					])
				}}
				<div class="form-group">
					<div class="col-md-6 row">
						<div class="col-md-3">
							<label class="control-label">School: </label> {{ $application->school_description }}
						</div>
						<div class="col-md-3">
							<label class="control-label">Course: </label> {{ $application->course_description }}
						</div>
						<div class="col-md-3">
							<label class="control-label">Year: </label> {{ $grade->year }}
						</div>
						<div class="col-md-3">
							<label class="control-label">Semester: </label> {{ $grade->semester }}
						</div>
					</div>
					<div class="col-md-6">
						{{ Form::label('strApplPicture', 'Upload Grade*', [
							'class' => 'control-label'
							]) 
						}}
						<div class="btn btn-default btn-file">
							<i class="fa fa-paperclip"></i> Grades
							{{ Form::file('strApplGrades', [
								'required' => 'required'
								]) 
							}}
						</div>
					</div>
				</div>
				<label class="col-sm-12">Input Grade</label>
				<div class='form-group col-md-6'>
					<label class='control-label'>Description</label>
					<input id='subject_description' class='form-control subject_description' maxlength='45' autocomplete='off' data-parsley-pattern='^[a-zA-Z0-9 ]+$' name='subject_description[]' type='text' required="required">
				</div>
				<div class='form-group col-md-2'>
					<label class='control-label'>Units</label>
					<input id='units' class='form-control units' maxlength='1' autocomplete='off' data-parsley-pattern='^[0-9 ]+$' name='units[]' type='text' required="required">
				</div>
				<div class='form-group col-md-4'>
					<label class='control-label'>Grade</label>
					<select id='subject_grade' class='form-control subject_grade' name='subject_grade[]'>
						@foreach ($grading as $gradings)
						<option value="{{ $gradings->grade }}">{{ $gradings->grade }}</option>
						@endforeach
					</select>
				</div>
				<div id="grade"></div>
				<div class="form-group col-sm-12">
					<button type="button" class="btn btn-primary grade"><i class='fa fa-plus'></i> Add</button>
				</div>
				<div class="form-group">
					{{ Form::label('name', "Shiftee?", [
						'class' => 'control-label col-sm-12'
						]) 
					}}
					<div class="col-sm-12">
						<div class="form-group">
							<label class="radio-inline">{{ Form::radio('rad', 'yes', false, ['id' => 'yes']) }} Yes</label>
							<label class="radio-inline">{{ Form::radio('rad', 'no', true, ['id' => 'no']) }} No</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12" id="shift">
						<div class="col-sm-12">
							<h4><b>For Shiftee/Transferee</b></h4>
						</div>
						<div class="form-group col-sm-6">
							<label class="control-label">School Transferred To</label>
							<select id="school_transfer" name="school_transfer" style="width: 100%;" class="form-control dropdownbox">
								@foreach ($school as $schools)
								<option value="{{ $schools->id }}">{{ $schools->description }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-sm-6">
							<label class="control-label">Course Shifted To</label> 
							<select id="course_transfer" name="course_transfer" style="width: 100%;" class="form-control dropdownbox">
								@foreach ($course as $courses)
								<option value="{{ $courses->id }}">{{ $courses->description }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<button class="btn btn-success pull-right"><i class="fa fa-check"></i>  Submit</button>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	@else
	<div>
		Renewal Currently Not Available
	</div>
	@endif
</section>
</div>
@endsection
@section('script')
{!! Html::script("plugins/iCheck/icheck.min.js") !!}
{!! Html::script("plugins/select2/select2.min.js") !!}
{!! Html::script("custom/StudentRenewal.min.js") !!}
@endsection