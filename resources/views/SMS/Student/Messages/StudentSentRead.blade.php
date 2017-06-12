@extends('SMS.Student.StudentMain')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Reply
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-envelope"></i> Reply</li>
    </ol>
  </section>
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
         </div>
       </div>
       <div class="col-md-10">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Read Sent</h3>
            <span class="mailbox-read-time pull-right"><i class="fa fa-clock-o"></i> {{$message->date_created->format('M d, Y - h:i A ')}}</span>
          </div>
          <div class="box-body no-padding">
            <div class="mailbox-read-info">
              <h3>Subject: {{$message->title}}</h3>
              <br>
              <h5>Sent To: 
                @foreach ($users as $users)
                <strong>{{$users->last_name}}, {{$users->first_name}} {{$users->middle_name}} ({{$users->email}}) // </strong>
                @endforeach
              </h5>
            </div>
            <div class="mailbox-read-message">
              <textarea style="resize: none; width: 100%; height:50vh;" readonly="readonly">{{$message->description}}</textarea>
              @if ($message->pdf != '')
              <div class="form-control">
                <a href="{{ asset('docs/'.$message->pdf) }}" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{$message->pdf}}</a>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection