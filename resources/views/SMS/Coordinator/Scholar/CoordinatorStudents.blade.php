@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Checklist
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><i class="fa fa-graduation-cap"></i> Scholar</li>
			<li class="active"><i class="fa fa-tasks"></i> Checklist</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-danger">
					<div class="modal fade" id="advanced_search">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button class="close" data-dismiss="modal">&times;</button>
									<h4>Advanced Search</h4>
								</div>
								<div class="modal-body">
									<form id="frmAdv" data-parsley-validate>
										<div class="form-group">
											<label>First Name</label>
											<input type="text" id="strUserFirstName" name="strUserFirstName" class="form-control" minlength="3" maxlength="25">
										</div>
										<div class="form-group">
											<label>Middle Name</label>
											<input type="text" id="strUserMiddleName" name="strUserMiddleName" class="form-control" minlength="3" maxlength="25">
										</div>
										<div class="form-group">
											<label>Last Name</label>
											<input type="text" id="strUserLastName" name="strUserLastName" class="form-control" minlength="3" maxlength="25">
										</div>
										<div class="form-group">
											<label>District</label>
											<select id="intDistID" class="form-control" name="intDistID">
												<option value="">--Select District--</option>
												@foreach($district as $districts)
												<option value={{$districts->id}}>{{$districts->description}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label>Barangay</label>
											<select id="intBaraID" class="form-control" name="intBaraID">
												<option value="">--Select Barangay--</option>
												@foreach($barangay as $barangays)
												<option value={{$barangays->id}}>{{$barangays->description}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label>Batch</label>
											<select id="intBatcID" class="form-control" name="intBatcID">
												<option value="">--Select Batch--</option>
												@foreach($batch as $batchs)
												<option value={{$batchs->id}}>{{$batchs->description}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label>Steps</label>
											<select id="intStepID" class="form-control" name="intStepID">
												<option value="">--Select Steps--</option>
												@foreach($steps as $stepss)
												<option value={{$stepss->id}}>{{$stepss->description}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label>Street Name</label>
											<input id="strPersStreet" name="strPersStreet" type="text" class="form-control" minlength="3" maxlength="25">
										</div>
										<div class="form-group">
											<label>Religion</label>
											<input id="strPersReligion" type="text" name="strPersReligion" class="form-control" minlength="3" maxlength="50">
										</div>
										<div class="form-group">
											<button id="btn-advSearch" class="btn btn-success btn-block">Submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="view_step">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{ Form::button('&times;', [
										'class' => 'close',
										'type' => '',
										'data-dismiss' => 'modal'
										]) 
									}}
									<h4>Checklist</h4>
								</div>
								<div class="modal-body">
									{{ Form::open([
										'id' => 'frmStep'
										])
									}}
									<div class="form-group">
										<ul class="todo-list steps">
										</ul>
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
					<div class="modal fade" id="view_claim">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									{{ Form::button('&times;', [
										'class' => 'close',
										'type' => '',
										'data-dismiss' => 'modal'
										]) 
									}}
									<h4>Claim Stipend</h4>
								</div>
								<div class="modal-body">
									{{ Form::open([
										'id' => 'frmClaim'
										])
									}}
									<div class="form-group">
										<ul class="todo-list stipend">
										</ul>
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
						<strong class="pull-right" id="advsearch" style="cursor: pointer; cursor: hand;">Advanced Search</strong>
						<table id="student-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>ID</th>
								<th>Student</th>
								<th>Requirements</th>
								<th>Claiming</th>
								<th>Action</th>
							</thead>
							<tbody id="student-list">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('script')
{!! Html::script("custom/ChecklistAjax.min.js") !!}
<script type="text/javascript">
	var dataurl = "{!! route('checklist.store') !!}";
</script>
@endsection