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
			<div class="col-sm-12">
				<div class="box box-danger col-sm-12"><br>
					@if (count($errors) > 0)
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Errors:</strong>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
							@endforeach
						</ul>
					</div>
					@endif
					@if (Request::path() == 'admin/grade/create')
					<!--Create Form-->
					{{ Form::open([
						'id' => 'frmGrade', 'data-parsley-validate' => '',
						'route' => 'grade.store'
						])
					}}
					<div class="row">
						<div class="form-group col-xs-4">
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
						<div class="form-group col-xs-2">
							{{ Form::label('name', 'Grade') }}
							{{ Form::text('grading[]', null, [
								'id' => 'grading',
								'class' => 'form-control academic_grading',
								'maxlength' => '4',
								'required' => 'required',
								'data-parsley-pattern' => '^[a-zA-Z0-9.]+$',
								'autocomplete' => 'off'
								]) 
							}}
						</div>
						<div class="form-group col-xs-2">
							{{ Form::label('name', 'Status') }}
							{{ Form::select('status[]', [
								'1' => 'Passed',
								'0' => 'Failed'
								], null, [
								'id' => 'status',
								'class' => 'form-control academic_status'])
							}}
						</div>
						<div id="add_gradings"></div>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-primary gradings"><i class='fa fa-plus'></i> Add</button>
						{{ Form::button("<i class='fa fa-paper-plane'></i> Submit", [
							'id' => 'btn-save',
							'class' => 'btn btn-success pull-right',
							'value' => 'add',
							'type' => ''
							]) 
						}}
					</div>
					{{ Form::close() }}
					@else
					<!--Edit Form-->
					{{ Form::open([
						'id' => 'frmGrade', 'data-parsley-validate' => '',
						'route' => ['grade.update',$grading[0]->id],
						'method' => 'PUT'
						])
					}}
					<div class="row">
						<div class="form-group col-xs-4">
							{{ Form::label('name', 'Grade Description') }}
							{{ Form::text('strSystDesc', $grading[0]->description, [
								'id' => 'strSystDesc',
								'class' => 'form-control',
								'maxlength' => '25',
								'required' => 'required',
								'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
								'autocomplete' => 'off'
								]) 
							}}
						</div>
						@foreach ($grading as $gradings)
						<div class="form-group col-xs-2">
							{{ Form::label('name', 'Grade') }}
							{{ Form::text('grading[]', $gradings->grade, [
								'id' => 'grading',
								'class' => 'form-control academic_grading',
								'maxlength' => '4',
								'required' => 'required',
								'data-parsley-pattern' => '^[a-zA-Z0-9.]+$',
								'autocomplete' => 'off'
								]) 
							}}
						</div>
						<div class="form-group col-xs-2">
							{{ Form::label('name', 'Status') }}
							{{ Form::select('status[]', [
								'1' => 'Passed',
								'0' => 'Failed'
								], $gradings->is_passed, [
								'id' => 'status',
								'class' => 'form-control academic_status'])
							}}
						</div>
						@endforeach
					</div>
					<div class="form-group">
						{{ Form::button("<i class='fa fa-paper-plane'></i> Submit", [
							'id' => 'btn-save',
							'class' => 'btn btn-success pull-right',
							'value' => 'add',
							'type' => ''
							]) 
						}}
					</div>
					<br><br>
					{{ Form::close() }}
					@endif
				</div>
			</div>
		</section>
	</div>
	@endsection
	@section('script')
	@if (Request::path() == 'admin/grade/create')
	<script type="text/javascript">
		$('.gradings').click(function() {
			var show = "<div class='form-group col-xs-2'>" +
			"<label>Grade</label>" +
			$('.academic_grading')[0].outerHTML + "</div>" +
			"<div class='form-group col-xs-2'>" +
			"<label>Status</label>" +
			$('.academic_status')[0].outerHTML + "</div>";
			$('#add_gradings').append(show);
		});
	</script>
	@endif
	@endsection
