@extends('SMS.Student.StudentMain')
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
				<div class="form-group">
					<div class="col-md-4">
						{{ Form::label('strApplPicture', 'Upload Grade*', [
							'class' => 'control-label'
							]) 
						}}
					</div> 
					<div class="col-md-4">
						<input id="renew_grades" type="text" name="renew_grades" value="Grades.pdf" required="required" readonly="readonly" autofocus="autofocus" class="form-control">
					</div>
					<div class="col-md-4">
						<div class="btn btn-default btn-file pdf col-md-6">
							<i class="fa fa-paperclip"></i> Grades
							{{ Form::file('strApplGrades', [
								'required' => 'required'
								]) 
							}}
						</div>
					</div>
				</div>
				<div class="form-group">
				</div>
			</div>
		</div>
		<div class="box box-danger">
			<div class="box-header with-border">
				<h4><b>For Shiftees and Transferees</b></h4>
			</div>
			<div class="box-body">
				<div class="form-group">
					<label class="col-md-4 control-label">School Transferred From</label> 
					<div class="col-md-8">
						<input type="text" value="" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">School Transferred To</label> 
					<div class="col-md-8">
						<input type="text" value="" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Course Shifted From</label> 
					<div class="col-md-8">
						<input type="text" value="" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Course Shifted To</label> 
					<div class="col-md-8">
						<input type="text" value="" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Subject Deficiency</label> 
					<div class="col-md-8">
						<input type="text" value="" class="form-control">
					</div>
				</div>
			</div>
			<div class="box-footer with-border">
				<button class="btn btn-success pull-right"><i class="fa fa-check"></i>  Submit</button>
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