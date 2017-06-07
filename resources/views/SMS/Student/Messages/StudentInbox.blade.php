@extends('SMS.Student.StudentMain')
@section('override')
{!! Html::style("plugins/datatables/dataTables.bootstrap.min.css") !!}
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Inbox
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-envelope"></i> Inbox</li>
    </ol>
  </section>
  <section class="content">
   @if (Session::has('success'))
   <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success:</strong> {{Session::get('success')}}
  </div>
  @endif
  <div class="row">
    <div class="col-md-2">
      <a href="{{ url('student/messages/create') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>
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
            <li class="active"><a href="{{ url('student/messages') }}"><i class="fa fa-inbox"></i> Inbox
              <span class="label label-warning pull-right notif"></span></a></li>
              <li><a href="{{ url('student/messages/sent') }}"><i class="fa fa-envelope-o"></i> Sent</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-10">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Inbox</h3>
          </div>
          <div class="box-body">
            <div class="table-responsive mailbox-messages">
              <table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                <thead>
                  <th>Sender</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Action</th>
                </thead>
                <tbody id="list">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@section('script')
{!! Html::script("plugins/datatables/dataTables.bootstrap.min.js") !!}
{!! Html::script("custom/InboxAjax.js") !!}
<script type="text/javascript">
  var dataurl = "{!! route('studentinbox.data') !!}";
  var urldelete = "/student/messages/delete";
  var url2 = "/student/messages/checkbox";
</script>
@endsection
