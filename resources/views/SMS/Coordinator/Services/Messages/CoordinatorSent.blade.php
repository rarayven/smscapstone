@extends('SMS.Coordinator.CoordinatorMain')
@section('override')
{!! Html::style("plugins/datatables/dataTables.bootstrap.min.css") !!}
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Messages
      <small>"No. of unread here"</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <!-- Main content -->
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
                <span class="label label-danger pull-right">4</span></a></li>
                <li class="active"><a href="{{ url('coordinator/messages/sent') }}"><i class="fa fa-envelope-o"></i> Sent</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-10">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Sent</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive mailbox-messages">
                <table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                  <thead>
                    <th>Sender</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Action</th>
                  </thead>
                  <tbody id="district-list">
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  @section('meta')
  <meta name="_token" content="{!! csrf_token() !!}" />
  @endsection
  @section('script')
  {!! Html::script("plugins/datatables/jquery.dataTables.min.js") !!}
  {!! Html::script("plugins/datatables/dataTables.bootstrap.min.js") !!}
  {!! Html::script("custom/MessageAjax.js") !!}
  <script type="text/javascript">
    var dataurl = "{!! route('coordinatorsent.data') !!}";
  </script>
  @endsection