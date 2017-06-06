@extends('SMS.Student.StudentMain')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Messages
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Here</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-2">
        <a href="{{ url('student/messages') }}" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
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
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <div class="box-body">
              {{ Form::open([
                'method' => 'Post',
                'enctype' => 'multipart/form-data',
                'route' => 'studentmessage.store'])
              }}
              <div class="form-group">
                <label>Send To: </label> {{$user->last_name}}, {{$user->first_name}} {{$user->middle_name}} ({{$user->email}})
                <input type="hidden" name="receiver[]" value="{{$user->id}}">
              </div>
              <div class="form-group">
                <label>Subject:</label>
                <input class="form-control" type="text" name="title" placeholder="Subject:">
              </div>
              <div class="form-group">
                <label>Message:</label>
                <textarea id="compose-textarea" name="description" class="form-control" style="height: 300px; resize: none;"></textarea>
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