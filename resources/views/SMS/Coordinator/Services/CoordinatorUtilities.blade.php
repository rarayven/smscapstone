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
				<li class="active"><a href="#tab_1" data-toggle="tab">Undo Checklist</a></li>
				<li><a href="#tab_2" data-toggle="tab">Backup</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active row" id="tab_1">
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
						<table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>Student</th>
								<th>Action</th>
							</thead>
							<tbody id="list">
								@foreach ($application as $applications)
								<tr>
									<td>
										<table><tr><td><div class='col-md-2'><img src='{{ asset('images/'.$applications->picture) }}' class='img-circle' alt='data Image' height='40'></div></td><td>{{ $applications->last_name }}, {{ $applications->first_name }} {{ $applications->middle_name }}</td></tr></table>
									</td>
									<td>
										<button class='btn btn-primary btn-xs btn-progress' value='{{ $applications->id }}'><i class='fa fa-files-o'></i> List</button> <button class='btn btn-success btn-xs open-modal' value='{{ $applications->id }}'><i class='fa fa-money'></i> Claim</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane row" id="tab_2">
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('script')
{!! Html::script("custom/CoordinatorUtilities.min.js") !!}
@endsection