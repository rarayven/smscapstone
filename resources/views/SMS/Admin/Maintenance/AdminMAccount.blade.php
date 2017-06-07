@extends('SMS.Admin.AdminMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			User Accounts
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><i class="fa fa-fw fa-users"></i> User Accounts</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="container col-sm-12">
				<div class="box box-danger">
					<div class="box-body table-responsive">
						<table id="users-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>User</th>
								<th>Email</th>
								<th>Last Login</th>
								<th>Role</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							<tbody id="users-list">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
	@section('script')
	{!! Html::script("custom/UserAjax.min.js") !!}
	<script type="text/javascript">
		var dataurl = "{!! route('users.data') !!}";
	</script>
	@endsection
