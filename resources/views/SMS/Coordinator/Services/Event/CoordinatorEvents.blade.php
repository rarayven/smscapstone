@extends('SMS.Coordinator.CoordinatorMain')
@section('override')
{!! Html::style("plugins/datepicker/datepicker3.css") !!}
{!! Html::style("plugins/timepicker/bootstrap-timepicker.min.css") !!}
<style type="text/css">
  .toggle {
    width: 100px;
  }
</style>
@endsection
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Events
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-flag"></i> Events</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="container col-sm-12">
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
                <div class="row">
                  <div class="form-group col-md-6">
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
                  <div class="form-group col-md-6">
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
                  <div class="form-group col-md-4">
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
                    <div class="col-sm-4"> 
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
                  <div class="col-sm-4">
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
            </div>
            <div class="form-group">
              {{ Form::label('name', 'Event Description') }}
              {{ Form::textarea('description', null, [
                'id' => 'description',
                'class' => 'form-control',
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
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Upcoming</a></li>
        <li><a href="#tab_2" data-toggle="tab">Finished</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active row" id="tab_1">
          <div class="box-body table-responsive">
            {{ Form::button("<i class='fa fa-plus'></i> Add Event", [
              'id' => 'btn-add',
              'class' => 'btn btn-primary btn-sm',
              'value' => 'add',
              'type' => '',
              'style' => 'margin-bottom: 10px;'
              ]) 
            }}
            <table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
              <thead>
                <th>Title</th>
                <th>Date</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
              <tbody id="list">
              </tbody>
            </table>
          </div>
        </div>
        <div class="tab-pane row" id="tab_2">
          <div class="box-body table-responsive">
            <table id="table-done" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
              <thead>
                <th>Title</th>
                <th>Date</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
              <tbody id="list-done">
                @foreach ($done as $done)
                <tr>
                  <td>{{ $done->title }}</td>
                  <td>{{ $done->date_held }}</td>
                  <td>{{ $done->time_from }}</td>
                  <td>{{ $done->time_to }}</td>
                  @if ($done->status=='Done')
                  <td><span class='label label-success'>{{$done->status}}</span></td>
                  @else
                  <td><span class='label label-danger'>{{$done->status}}</span></td>
                  @endif
                  <td><a href="{{ route('coordinatorevents.show',$done->id) }}"><button class='btn btn-info btn-xs btn-view' value='$data->id'><i class='fa fa-eye'></i> View</button></a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
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
  <script type="text/javascript">
    var dataurl = "{!! route('coordinatorevents.data') !!}";
  </script>
  @endsection