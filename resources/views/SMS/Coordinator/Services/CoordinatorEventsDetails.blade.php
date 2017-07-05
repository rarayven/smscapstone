@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Event Details
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><a href="{{ url('coordinator/events') }}"><i class="fa fa-flag"></i> Events</a></li>
			<li class="active"><i class="fa fa-list"></i> Details</li>
		</ol>
	</section>
	<section class="content">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">Details</a></li>
				<li><a href="#tab_2" data-toggle="tab">Attendance</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active row" id="tab_1">
					<div class='col-md-6'>
						<div class='form-group'>
							<label>Event Name: </label><br> {{ $events->title }}
						</div>
					</div>
					<div class='col-md-6'>
						<div class='form-group'>
							<label>Event Place: </label><br>{{ $events->place_held }}
						</div>
					</div>
					<div class='col-md-6'>
						<div class='form-group'>
							<label>From: </label><br>{{date('h:i A',strtotime($events->time_from))}}
						</div>
					</div>
					<div class='col-md-6'>
						<div class='form-group'>
							<label>To: </label><br>{{date('h:i A',strtotime($events->time_to))}}
						</div>
					</div>
					<div class='col-md-12'>
						<div class='form-group'>
							<label>Event Date: </label><br>{{ $events->date_held }}
						</div>
					</div>
					<div class='col-md-12'>
						<div class='form-group'>
							<label>Description:</label><br>{{ $events->description }}
						</div>
					</div>
				</div>
				<div class="tab-pane row" id="tab_2">
					<div class="box-body table-responsive">
						<table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>Student</th>
								@if ($events->status == 'Ongoing')
								<th>Action</th>
								@endif
							</thead>
							<tbody id="list">
								@foreach ($attendance as $attendances)
								<tr>
									<td>
										<table><tr><td><div class='col-md-2'><img src='{{ asset('images/'.$attendances->picture) }}' class='img-circle' alt='User Image' height='40'></div></td><td>{{ $attendances->last_name }}, {{ $attendances->first_name  }} {{ $attendances->middle_name }}</td></tr></table>
									</td>
									@if ($events->status == 'Ongoing')
									<?php 
									$checked = 'checked';
									if(!$attendances->is_attending)
										$checked = '';
									?>
									<td>
										<input type='checkbox' id='isActive' name='isActive' value='{{ $attendances->user_event_id }}' data-toggle='toggle' data-style='android' data-onstyle='success' data-offstyle='danger' data-on="<i class='fa fa-check-circle'></i> Present" data-off="<i class='fa fa-times-circle'></i> Absent" data-size='mini' {{ $checked }}>
									</td>
								</tr>
								@endif
								@endforeach
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
{!! Html::script("custom/CoordinatorEventsDetailsAjax.min.js") !!}
@endsection