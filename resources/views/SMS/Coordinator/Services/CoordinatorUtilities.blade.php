@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Utilities
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><i class="fa fa-fw fa-gear"></i> Utilities</li>
		</ol>
	</section>
	<section class="content">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">Settings</a></li>
				<li><a href="#tab_2" data-toggle="tab">Backup</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active row" id="tab_1">
					<div class="col-xs-12">
						<div class="form-group">
							<label for="year_count" class="control-label">No. year level:</label>
							<select class="form-control" name="year_count">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
						<div class="form-group">
							<label for="semester_count" class="control-label">No. semesters:</label>
							<select class="form-control" name="semester_count">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-success pull-right"><i class="fa fa-save"></i> Save</button>
						</div>
					</div>
				</div>
				<div class="tab-pane row" id="tab_2">
				</div>
			</div>
		</div>
	</section>
</div>
@endsection