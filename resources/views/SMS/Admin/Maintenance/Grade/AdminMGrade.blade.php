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
			<div class="container col-sm-12">
				<div class="box box-danger">
					<div class="box-body table-responsive">
						<a href="{{ route('grade.create') }}">{{ Form::button("<i class='fa fa-plus'></i> Add Grading", [
							'id' => 'btn-add',
							'class' => 'btn btn-primary btn-sm',
							'value' => 'add',
							'type' => '',
							'style' => 'margin-bottom: 10px;'
							]) 
						}}</a>
						<table id="grade-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
							<thead>
								<th>Description</th>
								<th>Status</th>
								<th>Action</th>
							</thead>
							<tbody id="grade-list">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
	@section('script')
	{!! Html::script("js/bootbox.min.js") !!} 
	{!! Html::script("custom/GradeAjax.min.js") !!}
	<script type="text/javascript">
		var dataurl = "{!! route('grade.data') !!}";
	</script>
	@endsection
