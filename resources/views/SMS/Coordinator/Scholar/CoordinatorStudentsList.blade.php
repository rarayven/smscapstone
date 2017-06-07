@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Students
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('coordinator/index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><i class="fa fa-graduation-cap"></i> Scholar</li>
			<li class="active"><i class="fa fa-list-ul"></i> List</li>
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
											<label>School</label>
											<select id="intSchoID" class="form-control" name="intSchoID">
												<option value="">--Select School--</option>
												@foreach($school as $schools)
												<option value={{$schools->id}}>{{$schools->description}}</option>
												@endforeach
											</select>
										</div>
										<div class="form-group">
											<label>Course</label>
											<select id="intCourID" class="form-control" name="intCourID">
												<option value="">--Select Course--</option>
												@foreach($course as $courses)
												<option value={{$courses->id}}>{{$courses->description}}</option>
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
					<div class="modal fade" id="view_details">
						<div class="modal-dialog">
							<div class="modal-content" style="width: 200%; top:5%; right:50%;">
								<div class="modal-header">
									<button class="close" data-dismiss="modal">&times;</button>
									<h4>User Information</h4>
								</div>
								<div class="modal-body">
									<form role="form">
										<div class="col-md-3">
											<div class="box box-danger">
												<div class="box-body box-profile">
													<img class="profile-user-img img-responsive img-circle" src="{{ asset('images/Default.png') }}" alt="User profile picture">
													<h3 class="profile-username text-center">Sample Student One</h3>
													<a href="#" class="btn btn-default btn-block"><b>Change Profile Photo</b></a>
												</div>
											</div>
										</div>
										<div class="form-group col-md-3">
											<label>First Name</label>
											<input type="text" class="form-control" placeholder="Sample">
										</div>
										<div class="form-group col-md-3">
											<label>Middle Name</label>
											<input type="text" class="form-control" placeholder="Student">
										</div>
										<div class="form-group col-md-3">
											<label>Last Name</label>
											<input type="text" class="form-control" placeholder="One">
										</div>
										<div class="form-group col-md-3">
											<label>Gender</label>
											<select id="gender" class="form-control" name="gender">
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label>School</label>
											<input type="text" class="form-control" placeholder="University of Da Phils">
										</div>
										<div class="form-group col-md-3">
											<label>Birthdate</label>
											<input type="text" class="form-control" placeholder="December 31 1989">
										</div>
										<div class="form-group col-md-6">
											<label>Address</label>
											<input type="text" class="form-control" placeholder="13 Riosa Pasong Tamo District 6">
										</div>
										<div class="form-group col-md-3">
											<label>Religion</label>
											<input type="text" class="form-control" placeholder="Hinduism">
										</div>
										<div class="form-group col-md-3">
											<label>Mobile Number</label>
											<input type="text" class="form-control" placeholder="+63 927 234 3332">
										</div>
										<div class="form-group col-md-3">
											<label>Contact E-mail</label>
											<input type="text" class="form-control" placeholder="sample.one@gmail.com">
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i> Forfeit</button>
											<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-graduation-cap"></i> Graduated</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="box-body table-responsive">
						<strong class="pull-right" id="advsearch" style="cursor: pointer; cursor: hand;">Advanced Search</strong>
						<table id="student-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>Student</th>
								<th>Condition</th>			
								<th>Status</th>
								<th >Action</th>
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
{!! Html::script("custom/ListAjax.js") !!}
<script type="text/javascript">
	var dataurl = "{!! route('list.store') !!}";
</script>
@endsection
