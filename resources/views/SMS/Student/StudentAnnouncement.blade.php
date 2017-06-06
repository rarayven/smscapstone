@extends('SMS.Student.StudentMain')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Announcement
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/dashboard') }}"><i class="fa fa-dashboard"></i> Student</a></li>
      <li class="active">Announcement</li>
    </ol>
  </section>
  <section class="content">
    <ul class="timeline">
      @foreach ($announcement as $announcements)
      <li class="time-label">
        <span class="bg-red">
          {{$announcements->date_post->format('l M d, Y')}}
        </span>
      </li>
      <li>
        <i class="fa fa-bullhorn bg-blue"></i>
        <div class="timeline-item">
          <?php
          $circle = '-o';
          if(!$announcements->is_read)
            $circle = '';
          ?>
          <span class="time"><i class="fa fa-clock-o"></i> {{$announcements->date_post->diffForHumans()}} <button type="button" class="btn btn-box-tool" value="{{$announcements->user_announcement_id}}" data-toggle="tooltip" title="Mark as read">
            <i id="btn-circle{{$announcements->user_announcement_id}}" class="fa fa-circle{{$circle}}"></i></button></span>
            <h4 class="timeline-header">Subject: <strong>{{$announcements->title}}</strong></h4>
            <div class="timeline-body">
              {{$announcements->description}}
            </div>
            @if ($announcements->pdf != '')
            <div class="timeline-footer">
              <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{$announcements->pdf}}</a>
            </div>
            @endif
          </div>
        </li>
        @endforeach
      </ul>
      <div class="pull-right">
        {!!$announcement->links();!!}
      </div>
    </section>
  </div>
  @endsection
  @section('script')
  {!! Html::script("custom/StudentAnnouncementAjax.js") !!}
  @endsection