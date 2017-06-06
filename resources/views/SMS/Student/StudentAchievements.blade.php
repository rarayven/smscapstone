@extends('SMS.Student.StudentMain')
@section('override')
{!! Html::style("plugins/datatables/dataTables.bootstrap.min.css") !!}
{!! Html::style("plugins/datepicker/datepicker3.css") !!}
{!! Html::style("plugins/sweetalert/sweetalert.min.css") !!}
@endsection
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
                <input type="file" name="pdf">
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
      <div class="box-body table-responsive">
        {{ Form::button("<i class='fa fa-plus'></i> Add Achievement", [
          'id' => 'btn-add',
          'class' => 'btn btn-primary btn-sm',
          'value' => 'add',
          'type' => '',
          'style' => 'margin-bottom: 10px;'
          ]) 
        }}
        <table id="achievement-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
          <thead>
            <th>Description</th>
            <th>Place Held</th>
            <th>Date Held</th>
            <th>Status</th>
            <th>Token</th>
            <th>Action</th>
          </thead>
          <tbody id="district-list">
          </tbody>
        </table>
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
{!! Html::script("plugins/datatables/jquery.dataTables.min.js") !!}
{!! Html::script("plugins/datatables/dataTables.bootstrap.min.js") !!}
{!! Html::script("plugins/sweetalert/sweetalert.min.js") !!}
{!! Html::script("plugins/datepicker/bootstrap-datepicker.js") !!}
{!! Html::script("custom/StudentAchievementAjax.js") !!}
<script type="text/javascript">
  var dataurl = "{!! route('studentachievement.data') !!}";
</script>
@endsection
