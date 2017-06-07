@extends('SMS.Coordinator.CoordinatorMain')
@section('override')
{!! Html::style("plugins/datepicker/datepicker3.css") !!}
{!! Html::style("plugins/timepicker/bootstrap-timepicker.min.css") !!}
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Events
      {{ Form::button("<i class='fa fa-plus'></i> Add Event", [
        'id' => 'btn-add',
        'class' => 'btn btn-primary btn-sm',
        'value' => 'add',
        'type' => '',
        'style' => 'margin-bottom: 10px;'
        ]) 
      }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-flag"></i> Events</li>
    </ol>
  </section>
  <section class="content">
    <div class="modal fade" id="add_event">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            {{ Form::button('&times;', [
              'class' => 'close',
              'type' => '',
              'data-dismiss' => 'modal'
              ]) 
            }}
            <h4 id="txt">Add Event</h4>
          </div>
          <div class="modal-body">
            {{ Form::open([
              'id' => 'frmEvent', 'data-parsley-whitespace' => 'squish'])
            }}
            <div class="form-group">
              {{ Form::label('name', 'Event Name') }}
              {{ Form::text('title', null, [
                'id' => 'title',
                'class' => 'form-control',
                'maxlength' => '15',
                'required' => 'required',
                'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
                'autocomplete' => 'off'
                ]) 
              }}
            </div>
            <div class="form-group">
              {{ Form::label('name', 'Event Place') }}
              {{ Form::text('place_held', null, [
                'id' => 'place_held',
                'class' => 'form-control',
                'maxlength' => '15',
                'required' => 'required',
                'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
                'autocomplete' => 'off'
                ]) 
              }}
            </div>
            <div class="form-group row">
              <div class="col-sm-6"> 
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                   {{ Form::label('name', 'From') }}
                   <div class="input-group">
                     <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    {{ Form::text('time_from', null, [
                      'id' => 'time_from',
                      'class' => 'form-control timepicker',
                      'required' => 'required'
                      ]) 
                    }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="bootstrap-timepicker">
                <div class="form-group">
                 {{ Form::label('name', 'To') }}
                 <div class="input-group">
                   <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  {{ Form::text('time_to', null, [
                    'id' => 'time_to',
                    'class' => 'form-control timepicker',
                    'required' => 'required'
                    ]) 
                  }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('name', 'Event Date') }}
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            {{ Form::text('date_held', null, [
              'id' => 'datepicker',
              'class' => 'form-control',
              'required' => 'required'
              ]) 
            }}
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('name', 'Event Description') }}
          {{ Form::textarea('description', null, [
            'id' => 'description',
            'class' => 'form-control',
            'maxlength' => '15',
            'required' => 'required',
            'style' => 'resize: none;',
            'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
            'autocomplete' => 'off'
            ]) 
          }}
        </div>
        <div class="form-group">
          {{ Form::button('Submit', [
            'id' => 'btn-save',
            'class' => 'btn btn-success btn-block',
            'value' => 'add',
            'type' => ''
            ]) 
          }}
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
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
      <div id="events">
        @foreach ($events as $event)
        <div class="col-md-4">
          <div class="small-box bg-purple">
            <div class="box-body">
              <div class="pull-right">
                <?php
                $checked = '';
                if($event->status=='Ongoing'){
                  $checked = 'checked';
                }
                ?>
                <input type='checkbox' id='isActive' name='isActive' value='{{$event->id}}' data-toggle='toggle' data-style='android' data-onstyle='success' data-offstyle='danger' data-on="Ongoing" data-off="Cancelled" {{$checked}} data-size='mini'>
                <button class='btn btn-warning btn-xs btn-detail open-modal' value='{{$event->id}}'><i class='fa fa-edit'></i></button> <button class='btn btn-danger btn-xs btn-delete' value='{{$event->id}}'><i class='fa fa-times'></i></button>
              </div>
              <h4><b>{{$event->title}}</b></h4>
              <p>{{$event->date_held->format('l')}}</p>
              <p>{{$event->date_held->format('M d, Y')}}</p>
              <p>{{date('h:i A',strtotime($event->time_from))}} - {{date('h:i A',strtotime($event->time_to))}}</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a value="{{$event->id}}" class="btn small-box-footer">
              View Event Details <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        @endforeach
      </div>
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
      <div class="small-box bg-orange">
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
      </a>
    </div>
  </div>
  @endforeach
</div>
</div>
</div>
</section>
</div>
@endsection
@section('script')
{!! Html::script("plugins/datepicker/bootstrap-datepicker.js") !!}
{!! Html::script("plugins/timepicker/bootstrap-timepicker.min.js") !!}
{!! Html::script("custom/CoordinatorEventsAjax.min.js") !!}
@endsection