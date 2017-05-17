@extends('SMS.Coordinator.CoordinatorMain')
@section('override')
{!! Html::style("plugins/datepicker/datepicker3.css") !!}
{!! Html::style("plugins/timepicker/bootstrap-timepicker.min.css") !!}
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
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
      <li><a href="{{ url('coordinator/index') }}"><i class="fa fa-dashboard"></i> Coordinator</a></li>
      <li class="active">Events</li>
    </ol>
  </section>
  <!-- Main content -->
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
<div class="row">
  <div id="events">
    @foreach ($events as $event)
    <div class="col-md-4">
      <div class="small-box bg-red">
        <div class="box-body">
          <h4><b>{{$event->title}}</b></h4>
          <p>Saturday</p>
          <p>{{$event->date_held}}</p>
          <p>{{$event->time_from}} - {{$event->time_to}}</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">
          View Event Details <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    @endforeach
  </div>
</div>
</section>
</div>
@endsection
@section('script')
{!! Html::script("plugins/datepicker/bootstrap-datepicker.js") !!}
{!! Html::script("plugins/timepicker/bootstrap-timepicker.min.js") !!}
{!! Html::script("custom/EventsAjax.js") !!}
@endsection