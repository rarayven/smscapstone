@extends('SMS.Student.StudentMain')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Messages
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Here</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
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
              <li><a href="{{ url('student/messages') }}"><i class="fa fa-inbox"></i> Inbox
               <span class="label label-warning pull-right notif"></span></a></li>
               <li><a href="{{ url('student/messages/sent') }}"><i class="fa fa-envelope-o"></i> Sent</a></li>
             </ul>
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /. box -->
       </div>
       <!-- /.col -->
       <div class="col-md-10">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Read Mail</h3>
            <span class="mailbox-read-time pull-right">{{$message->date_created->format('M d, Y - h:i A ')}}</span>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <div class="mailbox-read-info">
              <h3>Subject: {{$message->title}}</h3>
              <br>
              <h5>From: <strong>{{$message->last_name}}, {{$message->first_name}} {{$message->middle_name}} ({{$message->email}})</strong>
              </h5>
            </div>
            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">

              <textarea style="resize: none; width: 100%; height:50vh;" readonly="readonly">{{$message->description}}</textarea>
              @if ($message->pdf != '')
              <div class="form-control">
                <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{$message->pdf}}</a>
              </div>
              @endif
            </div>
            <!-- /.mailbox-read-message -->
          </div>
          <div class="box-footer">
            <a href="{{ route('studentmessage.reply',$message->sender) }}"><button type="button" class="btn btn-success btn-block"><i class="fa fa-reply"></i> Reply</button></a>
          </div>
          <!-- /.box-footer -->
        </div>
        <!-- /. box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
</div>
@endsection