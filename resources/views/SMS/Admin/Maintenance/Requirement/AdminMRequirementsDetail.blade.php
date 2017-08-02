@extends('SMS.Admin.AdminMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Requirements
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><i class="fa fa-sticky-note-o"></i> Scholarship</li>
			<li class="active"><i class="fa fa-fw fa-files-o"></i> Requirements</li>
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
									<h4>Add Requirement</h4>
								</div>
								<div class="modal-body">
									{{ Form::open([
										'id' => 'frmSteps', 'data-parsley-whitespace' => 'squish'
										])
									}}
									<div class="form-group">
										{{ Form::label('name', 'Select Type') }}
										{{ Form::select('type', [
											'0' => 'Application',
											'1' => 'Renewal'
											], null, [
											'id' => 'type',
											'class' => 'form-control'])
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Description') }}
										{{ Form::text('strStepDesc', null, [
											'id' => 'strStepDesc',
											'class' => 'form-control',
											'maxlength' => '100',
											'required' => 'required',
											'data-parsley-pattern' => '^[a-zA-Z0-9. ,]+$',
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
						<div class="form-group row col-sm-12">
							<img src="{{ asset('images/'.$councilor->picture) }}" style="height: 50px; width: 50px;" class="img-circle" alt="User Image">
							<b>Coun.</b> {{ $councilor->first_name }} {{ $councilor->middle_name }} {{ $councilor->last_name }}
						</div>
						<table id="steps-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>Description</th>
								<th>Type</th>
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
	{!! Html::script("custom/RequirementsDetailsAjax.min.js") !!}
	<script type="text/javascript">
		var dataurl = "{!! route('requirementsdetails.data',$connection->id) !!}";
	</script>
	@endsection