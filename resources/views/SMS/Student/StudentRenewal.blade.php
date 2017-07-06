@extends('SMS.Student.StudentMain')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Renewal
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-refresh"></i> Renewal</li>
    </ol>
  </section>
  <section class="content">
    @if ($application->is_renewal == 0)
    <div class="box box-danger">
      <div class="box-header with-border">
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-info"></i> Info</h4>
          You are free to edit your personal and family data in the Account Settings before submitting your renewal form.
        </div>
        <div class="box-header">
          <h3>Renewal Form</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <div class="col-sm-12 row">
              {{ Form::label('strApplPicture', 'Upload Grade*', [
                'class' => 'control-label'
                ]) 
              }}
            </div>
            <div class="btn btn-default btn-file pdf">
              <i class="fa fa-paperclip"></i> PDF
              {{ Form::file('strApplGrades', [
                'required' => 'required'
                ]) 
              }}
            </div>
          </div>
          <div class="form-group">
            <div class="radio">
              <p>
                <label>
                  <input type="radio" name="courseYear" id="fourYears" value="fourYears" checked>
                  <strong>Four-Year Course</strong>
                </label>
              </p>
            </div>
            <div class="radio">
              <p>
                <label>
                  <input type="radio" name="courseYear" id="fiveYears" value="fiveYears">
                  <strong>Five-Year Course</strong>
                </label>
              </p>
            </div>
          </div>
          <div class="form-group">
            <label for="firstName" class="col-sm-10">Year Accommodated</label>
            <div class="col-xs-12">
              <input type="name" class="form-control" id="firstName" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="firstName" class="col-sm-10">Batch</label>
            <div class="col-xs-12">
              <input type="name" class="form-control" id="firstName" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="firstName" class="col-sm-10">Year Level</label>
            <div class="col-xs-12">
              <input type="name" class="form-control" id="firstName" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="firstName" class="col-sm-10">Course</label>
            <div class="col-xs-12">
              <input type="name" class="form-control" id="firstName" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="firstName" class="col-sm-10">School</label>
            <div class="col-xs-12">
              <input type="name" class="form-control" id="firstName" placeholder="">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-danger">
      <div class="box-header with-border">
        <div class="box-header">
          <h3>For Shiftee</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label for="lastName" class="col-sm-10 control-label">School transferred from</label>
            <div class="col-sm-12">
              <input type="name" class="form-control" id="lastName" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="lastName" class="col-sm-10 control-label">School transferred to</label>
            <div class="col-sm-12">
              <input type="name" class="form-control" id="lastName" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="lastName" class="col-sm-10 control-label">Course shifted from</label>
            <div class="col-sm-12">
              <input type="name" class="form-control" id="lastName" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="lastName" class="col-sm-10 control-label">Course shifted to</label>
            <div class="col-sm-12">
              <input type="name" class="form-control" id="lastName" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="lastName" class="col-sm-10 control-label">Subject deficiency</label>
            <div class="col-sm-12">
              <input type="name" class="form-control" id="lastName" placeholder="">
            </div>
          </div>
          <div class="form-group">
            <label for="lastName" class="col-sm-10 control-label">Remaining classcard/s</label>
            <div class="col-sm-12">
              <input type="name" class="form-control" id="lastName" placeholder="">
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <div>
      Renewal Currently Not Available
    </div>
    @endif
  </section>
</div>
@endsection