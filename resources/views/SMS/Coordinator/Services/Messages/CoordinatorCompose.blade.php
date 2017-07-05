@extends('SMS.Coordinator.CoordinatorMain')
@section('override')
{!! Html::style("plugins/select2/select2.min.css") !!}
@endsection
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Compose
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><i class="fa fa-envelope"></i> Compose</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-2">
				<a href="{{ url('coordinator/messages') }}" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
				<div class="box box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Folders</h3>
						<div class="box-tools">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body no-padding">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="{{ url('coordinator/messages') }}"><i class="fa fa-inbox"></i> Inbox
								<span class="label label-warning pull-right notif"></span></a></li>
								<li><a href="{{ url('coordinator/messages/sent') }}"><i class="fa fa-envelope-o"></i> Sent</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-10">
					<div class="box box-danger">
						<div class="box-header with-border">
							@if (count($errors) > 0)
							<div class="alert alert-danger alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Errors:</strong>
								<ul>
									@foreach ($errors->all() as $error)
									<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
							@endif
							<h3 class="box-title">Compose New Message</h3>
						</div>
						<div class="box-body">
							{{ Form::open([
								'method' => 'Post',
								'enctype' => 'multipart/form-data',
								'data-parsley-whitespace' => 'squish',
								'data-parsley-validate' => '',
								'route' => 'coordinatormessage.store'])
							}}
							<div class="form-group">
								<label>Send To:</label>
								<select class="form-control select2" name="receiver[]" multiple="multiple" data-placeholder="Send To:" style="width: 100%;">
									@foreach ($users as $user)
									<option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Subject:</label>
								<input class="form-control" type="text" name="title" placeholder="Subject:" required="required">
							</div>
							<div class="form-group">
								<label>Message:</label>
								<textarea id="compose-textarea" name="description" class="form-control" style="height: 300px; resize: none;" required="required"></textarea>
							</div>
							<div class="form-group">
								<div class="btn btn-default btn-file">
									<i class="fa fa-paperclip"></i> Attachment
									<input type="file" name="pdf">
								</div>
								<p class="help-block">Max. 2MB</p>
							</div>
							<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-envelope-o"></i> Send</button>
							{{Form::close()}}
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
	@section('script')
	{!! Html::script("plugins/select2/select2.min.js") !!}
	<script type="text/javascript">
		$(".select2").select2();
	</script>
	@endsection