@extends('SMS.Student.StudentMain')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Events
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-flag"></i> Events</li>
    </ol>
  </section>
  <section class="content">
    <div class="modal fade" id="details_events">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            {{ Form::button('&times;', [
              'class' => 'close',
              'type' => '',
              'data-dismiss' => 'modal'
              ]) 
            }}
            <h4>Event Details</h4>
          </div>
          <div class="modal-body" id="details">
          </div>
        </div>
      </div>
    </div>
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Upcoming</a></li>
        <li><a href="#tab_2" data-toggle="tab">Finished</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active row" id="tab_1">
          @foreach ($events as $event)
          <?php
          if($event->status=='Ongoing'){
            $status = 'success';
          }else{
            $status = 'danger';
          }
          ?>
          <div class="col-md-4">
            <div class="small-box bg-orange">
              <div class="box-body">
                <div class="pull-right">
                  <span class='label label-{{$status}}'>{{$event->status}}</span>
                </div>
                <h4><b>{{$event->title}}</b></h4>
                <p>{{$event->date_held->format('l')}}</p>
                <p>{{$event->date_held->format('M d, Y')}}</p>
                <p>{{date('h:i A',strtotime($event->time_from))}} - {{date('h:i A',strtotime($event->time_to))}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a value="{{$event->id}}" class="btn small-box-footer details">
                View Event Details <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          @endforeach
        </div>
        <div class="tab-pane row" id="tab_2">
          @foreach ($done as $done)
          <?php
          if($done->status=='Done'){
            $changer = 'success';
          }else{
            $changer = 'danger';
          }
          ?>
          <div class="col-md-4">
            <div class="small-box bg-purple">
              <div class="box-body">
                <div class="pull-right">
                  <span class='label label-{{$changer}}'>{{$done->status}}</span>
                </div>
                <h4><b>{{$done->title}}</b></h4>
                <p>{{$done->date_held->format('l')}}</p>
                <p>{{$done->date_held->format('M d, Y')}}</p>
                <p>{{date('h:i A',strtotime($done->time_from))}} - {{date('h:i A',strtotime($done->time_to))}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a value="{{$done->id}}" class="btn small-box-footer details">
                View Event Details <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
</div>
</section>
</div>
@endsection
@section('script')
{!! Html::script("custom/StudentEventsAjax.js") !!}
@endsection
