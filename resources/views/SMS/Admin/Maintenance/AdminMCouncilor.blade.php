@extends('SMS.Admin.AdminMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Maintenance
			<small>Councilor</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Councilor</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="container col-sm-12">
				<div class="box box-danger">
					<div class="modal fade" id="add_councilor">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{ Form::button('&times;', [
										'class' => 'close',
										'type' => '',
										'data-dismiss' => 'modal'
										])
									}}
									<h4>Add Councilor</h4>
								</div>
								<div class="modal-body">
									{{ Form::open([
										'id' => 'frmCouncilor', 
										'data-parsley-whitespace' => 'squish'
										])
									}}
									<div class="form-group">
										{{ Form::label('name', 'Select District') }}
										{{ Form::select('intCounDistID', $district, null, [
											'id' => 'intCounDistID',
											'class' => 'form-control'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'First Name') }}
										{{ Form::text('strCounFirstName', null, [
											'id' => 'strCounFirstName',
											'class' => 'form-control',
											'maxlength' => '25',
											'required' => 'required',
											'data-parsley-pattern' => '^[a-zA-Z. ]+$',
											'autocomplete' => 'off'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Middle Name') }}
										{{ Form::text('strCounMiddleName', null, [
											'id' => 'strCounMiddleName',
											'class' => 'form-control',
											'maxlength' => '25',
											'data-parsley-pattern' => '^[a-zA-Z. ]+$',
											'autocomplete' => 'off'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Last Name') }}
										{{ Form::text('strCounLastName', null, [
											'id' => 'strCounLastName',
											'class' => 'form-control',
											'maxlength' => '25',
											'required' => 'required',
											'data-parsley-pattern' => '^[a-zA-Z. ]+$',
											'autocomplete' => 'off'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Contact Number') }}
										{{ Form::text('strCounCell', null, [
											'id' => 'strCounCell',
											'class' => 'form-control',
											'minlength' => '11',
											'maxlength' => '11',
											'required' => 'required',
											'autocomplete' => 'off',
											'data-parsley-type' => 'number'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Email Address') }}
										{{ Form::text('strCounEmail', null, [
											'id' => 'strCounEmail',
											'class' => 'form-control',
											'maxlength' => '30',
											'required' => 'required',
											'autocomplete' => 'off',
											'data-parsley-type' => 'email'
											]) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('name', 'Email Address of Coordinator') }}
										{{ Form::text('strUserEmail', null, [
											'id' => 'strUserEmail',
											'class' => 'form-control',
											'maxlength' => '30',
											'required' => 'required',
											'autocomplete' => 'off',
											'data-parsley-type' => 'email',
											'data-parsley-notequalto' => '#strCounEmail'
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
					<div class="modal fade" id="details_councilor">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{ Form::button('&times;', [
										'class' => 'close',
										'type' => '',
										'data-dismiss' => 'modal'
										]) 
									}}
									<h4>Councilor Details</h4>
								</div>
								<div class="modal-body" id="details">
								</div>
							</div>
						</div>
					</div>
					<div class="box-body table-responsive">
						{{ Form::button("<i class='fa fa-plus'></i> Add Councilor", [
							'id' => 'btn-add',
							'class' => 'btn btn-primary btn-sm',
							'value' => 'add',
							'type' => '',
							'style' => 'margin-bottom: 10px;'
							]) 
						}}
						<table id="councilor-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>Councilor Name</th>
								<th>District Name</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							<tbody id="councilor-list">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
	@section('script')
	{!! Html::script("custom/CouncilorAjax.js") !!}
	<script type="text/javascript">
		var dataurl = "{!! route('councilor.data') !!}";
	</script>
	{!! Html::script("js/comparison.js") !!}
	@endsection