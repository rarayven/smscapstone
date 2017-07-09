@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Renewal
		</h1>
		<ol class="breadcrumb">
			<li><a href={{ url('coordinatr/dashboard') }}> <i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><i class="fa fa-refresh"></i> Renewal</a></li>
		</ol>
	</section>
	<section class="content">
		<div class="callout callout-success">
			<h4><i class="icon fa fa-info"></i> Renewal Status</h4>
			<h5>Renewal Phase Ongoing</h5>
			<input type='checkbox' id='isActive' name='isActive' value='$data->id' data-toggle='toggle' data-style='android' data-onstyle='success' data-offstyle='danger' data-on="<i class='fa fa-refresh'></i> Active" data-off="<i class='fa fa-remove'></i> End" data-size='large'>
		</div>
		<div class="box box-danger">
			<div class="box-body">
				<h4><b>Renewing Students</b></h4>
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<th></th>
						<th>Student Name</th>
						<th>Status</th>	
						<th>Action</th>
					</thead>
					<tbody>
						<tr>
							<td>
								<img class="profile-user-img img-sm img-circle" src="{{ asset('images/Default.png') }}" alt="User profile picture">
							</td>
							<td>
								Rayven Lorenzana
							</td>
							<td>
								Continuing
							</td>
							<td>
								<button type="button" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</button>
								<button type="button" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accept</button>
								<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Decline</button>
							</td>
						</tr>
						<tr>
							<td>
								<img class="profile-user-img img-sm img-circle" src="{{ asset('images/Default.jpg') }}" alt="User profile picture">
							</td>
							<td>
								Rety Saints
							</td>
							<td>
								Continuing
							</td>
							<td>
								<button type="button" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</button>
								<button type="button" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accept</button>
								<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Decline</button>
							</td>
						</tr>
						<tr>
							<td>
								<img class="profile-user-img img-sm img-circle" src="{{ asset('images/Default.jpg') }}" alt="User profile picture">
							</td>
							<td>
								Riven Lowrence
							</td>
							<td>
								Inactive
							</td>
							<td>
								<button type="button" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</button>
								<button type="button" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accept</button>
								<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Decline</button>
							</td>
						</tr>
						<tr>
							<td>
								<img class="profile-user-img img-sm img-circle" src="{{ asset('images/Default.jpg') }}" alt="User profile picture">
							</td>
							<td>
								Remblogen Sembrano
							</td>
							<td>
								Continuing
							</td>
							<td>
								<button type="button" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</button>
								<button type="button" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accept</button>
								<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Decline</button>
							</td>
						</tr>
						<tr>
							<td>
								<img class="profile-user-img img-sm img-circle" src="{{ asset('images/Default.jpg') }}" alt="User profile picture">
							</td>
							<td>
								Rasta Leighstlovski
							</td>
							<td>
								Continuing
							</td>
							<td>
								<button type="button" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</button>
								<button type="button" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accept</button>
								<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Decline</button>
							</td>
						</tr>
						<tr>
							<td>
								<img class="profile-user-img img-sm img-circle" src="{{ asset('images/Default.png') }}" alt="User profile picture">
							</td>
							<td>
								Wracks Ceiling
							</td>
							<td>
								Continuing
							</td>
							<td>
								<button type="button" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</button>
								<button type="button" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Accept</button>
								<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-remove"></i> Decline</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
@endsection