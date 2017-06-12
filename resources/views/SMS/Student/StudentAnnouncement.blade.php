@extends('SMS.Student.StudentMain')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Announcement
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-bullhorn"></i> Announcement</li>
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
          $checked = '';
          $title = 'Mark as Unread';
          if(!$announcements->is_read){
            $checked = 'checked';
            $title = 'Mark as Read';
          }
          ?>
          <span class="time"><i class="fa fa-clock-o"></i> {{$announcements->date_post->diffForHumans()}} &emsp;<input type="checkbox" id="title{{$announcements->user_announcement_id}}" value="{{$announcements->user_announcement_id}}" class="btn btn-box-tool" style="margin-top: -2px;" data-toggle="tooltip" title="{{$title}}" {{$checked}}></span>
          <h4 class="timeline-header">Subject: <strong>{{$announcements->title}}</strong></h4>
          <div class="timeline-body">
            {{$announcements->description}}
          </div>
          @if ($announcements->pdf != '')
          <div class="timeline-footer">
            <a href="{{ asset('docs/'.$announcements->pdf) }}" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> {{$announcements->pdf}}</a>
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
{!! Html::script("custom/StudentAnnouncementAjax.min.js") !!}
@endsection