@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Sent
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-envelope"></i> Sent</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-2">
        <a href="{{ url('coordinator/messages/create') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>
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
                <li class="active"><a href="{{ url('coordinator/messages/sent') }}"><i class="fa fa-envelope-o"></i> Sent</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-10">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Sent</h3>
            </div>
            <div class="box-body">
              <div class="table-responsive mailbox-messages">
                <table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                  <thead>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
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
  {!! Html::script("custom/SentAjax.min.js") !!}
  <script type="text/javascript">
    var dataurl = "{!! route('coordinatorsent.data') !!}";
    var urldelete = "/coordinator/messages/sent/delete";
  </script>
  @endsection