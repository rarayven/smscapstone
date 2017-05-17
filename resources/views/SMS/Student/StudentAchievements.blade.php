@extends('SMS.Student.StudentMain')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Achievements
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/index') }}"><i class="fa fa-dashboard"></i> Student</a></li>
      <li class="active">Achievements</li>
    </ol>
  </section>
  <section class="content">
    <div class="modal fade" id="add_achievement">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            {{ Form::button('&times;', [
              'class' => 'close',
              'type' => '',
              'data-dismiss' => 'modal'
              ]) 
            }}
            <h4 id="txt">Add Achievement</h4>
          </div>
          <div class="modal-body">
            {{ Form::open([
              'id' => 'frmAchivement', 'data-parsley-whitespace' => 'squish'])
            }}
            <div class="form-group">
              {{ Form::label('description', 'Achievement Description') }}
              {{ Form::text('description', null, [
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
              {{ Form::label('place_held', 'Place Held') }}
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
            <div class="form-group">
              {{ Form::label('date_held', 'Event Date') }}
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
              <label class="control-label">Upload Image of Certificate/Proof</label>
            </div>
            <div class="form-group">
              <div class="btn btn-default btn-file">
                <i class="fa fa-image"></i> Choose File..
                <input type="file" name="strApplPicture">
              </div>
              <p class="help-block">Max. 2MB</p>
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
    <div class="box box-danger">
      <div class="box-header with-border">
        <button id="btn-add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Achievement</button>
      </div>
      <div class="row">
        <div class="box-body table-responsive">
          <table class="table table-hover">
            <thead>
              <th>Achievement Description</th>
              <th>Place</th>
              <th>Date</th>
              <th>Action</th>
            </thead>
            <tr>
              <td>First Place sa Puso ko</td>
              <td>xsA Pus0 cKoh ngA ihHh</td>
              <td>213 AD</td>
              <td style="">
                <button class="btn btn-warning btn-xs btn-detail open-modal" value=""><i class="fa fa-edit"></i> Edit</button>
                <button class="btn btn-danger btn-xs btn-delete" value=""><i class="fa fa-trash"></i> Delete</button>
              </td>
            </tr>
            <tr>
              <td>48th Oscar's Best Actor</td>
              <td>Ermita, Manila</td>
              <td>March 7, 2017</td>
              <td style="">
                <button class="btn btn-warning btn-xs btn-detail open-modal" value=""><i class="fa fa-edit"></i> Edit</button>
                <button class="btn btn-danger btn-xs btn-delete" value=""><i class="fa fa-trash"></i> Delete</button>
              </td>
            </tr>
            <tr>
              <td>Spelling Quiz Bee Participant</td>
              <td>University of the Philippines Diliman</td>
              <td>March 8, 2017</td>
              <td style="">
                <button class="btn btn-warning btn-xs btn-detail open-modal" value=""><i class="fa fa-edit"></i> Edit</button>
                <button class="btn btn-danger btn-xs btn-delete" value=""><i class="fa fa-trash"></i> Delete</button>
              </td>
            </tr>
            <tr>
              <td>IT Research Forum Speaker</td>
              <td>Claro M. Recto Hall</td>
              <td>March 6, 2017</td>
              <td style="">
                <button class="btn btn-warning btn-xs btn-detail open-modal" value=""><i class="fa fa-edit"></i> Edit</button>
                <button class="btn btn-danger btn-xs btn-delete" value=""><i class="fa fa-trash"></i> Delete</button>
              </td>
            </tr>
            <tr>
              <td>President's Lister</td>
              <td>Polytechnic University of the Philippines</td>
              <td>December 31, 2016</td>
              <td style="">
                <button class="btn btn-warning btn-xs btn-detail open-modal" value=""><i class="fa fa-edit"></i> Edit</button>
                <button class="btn btn-danger btn-xs btn-delete" value=""><i class="fa fa-trash"></i> Delete</button>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('script')
{!! Html::script("custom/StudentAchievementAjax.js") !!}
@endsection
