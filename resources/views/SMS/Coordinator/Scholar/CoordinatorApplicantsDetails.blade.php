@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div id="overlay">
  <div class="loader"></div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Applicant's Details
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i> Coordinator</a></li>
      <li><a href="{{ url('coordinator/scholar/applicants') }}"> Applicants</a></li>
      <li class="active">Applicant's Details</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
    <div class="box box-danger">
      <div class="modal fade" id="remarks">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button class="close" data-dismiss="modal">&times;</button>
              <h4>Reason for declining the application of the student.</h4>
            </div>
            <div class="modal-body">
              <form id="frmRemarks" method="POST" data-parsley-validate>
                <div class="form-group">
                  <label>Remarks</label>
                  <textarea id="strApplRemarks" name="strApplRemarks" class="form-control" minlength="3" required style="resize: none; height: 400px;"></textarea>
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="_method" value="PUT">
                </div>
                <div class="form-group">
                  <input href="{{route('details.update',$application->user_id)}}" type="submit" class="btn btn-success btn-block" value="Submit">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="box-header with-border">
        <h4>A. Personal Data</h4>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="form-group col-md-4">
            <label class="control-label" for="" >First Name</label>
            <input id="fname" name="strUserFirstName" value="{{$application->first_name}}" type="text" class="form-control" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="" class="control-label">Middle Name</label>
            <input id="mname" name="strUserMiddleName" value="{{$application->middle_name}}" type="text" class="form-control" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="" class="control-label">Last Name</label>
            <input id="lname" name="strUserLastName" value="{{$application->last_name}}" type="text" class="form-control" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="" class="control-label">Gender</label>
            <input id="gender" name="" value="{{$application->gender}}" type="text" class="form-control" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="" class="control-label">Birth Date</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input id="elemgrad" name="elemgrad" type="text" class="form-control" value="{{$application->birthday}}" disabled>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="" class="control-label">Birth Place</label>
            <input id="bday" name="" type="text" value="{{$application->birthplace}}" class="form-control" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="" class="control-label">Religion</label>
            <input id="religion" type="text" value="{{$application->religion}}" name="strPersReligion" class="form-control" disabled>
          </div>
          <div class="form-group col-md-12">
            <label for="" class="control-label">Address</label>
            <input id="address" name="" type="text" class="form-control" value="{{$application->house_no}} {{$application->street}} {{$application->barangay_description}} {{$application->districts_description}}" disabled>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-danger">
      <div class="box-header with-border">
        <h4>B. Family Background</h4>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="form-group col-md-6">
            <label class="control-label" for="" >Mother's Name</label>
            <input name="" type="text" class="form-control" value="{{$mother->first_name}} {{$mother->last_name}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="" class="control-label">Father's Name</label>
            <input name="" type="text" class="form-control" value="{{$father->first_name}} {{$father->last_name}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="" class="control-label">Mother's Citizenship</label>
            <input name="" type="text" class="form-control" value="{{$mother->citizenship}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="" class="control-label">Father's Citizenship</label>
            <input name="" type="text" class="form-control" value="{{$father->citizenship}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="" class="control-label">Mother's Highest Attainment</label>
            <input name="" type="text" class="form-control" value="{{$mother->highest_ed}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="" class="control-label">Father's Highest Attainment</label>
            <input name="" type="text" class="form-control" value="{{$father->highest_ed}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="" class="control-label">Mother's Occupation</label>
            <input name="" type="text" class="form-control" value="{{$mother->occupation}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="" class="control-label">Father's Occupation</label>
            <input name="" type="text" class="form-control" value="{{$father->occupation}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="" class="control-label">Mother's Monthly Income</label>
            <input name="" type="text" class="form-control" value="{{$mother->monthly_income}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="" class="control-label">Mother's Monthly Income</label>
            <input name="" type="text" class="form-control" value="{{$father->monthly_income}}" disabled>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="col-md-12">
          <div class="form-group">
            <h4><b>Formerly or Currently Beneficiary of SYDP</b></h4>
          </div>
          <?php
          if($exist==0){
            $sibname = 'N/A';
            $datefrom = 'N/A';
            $dateto = 'N/A';
          }else{
            $sibname = $siblings->first_name." ".$siblings->last_name;
            $datefrom = $siblings->date_from;
            $dateto = $siblings->date_to;
          }
          ?>
          <div class="form-group col-md-4">
            <label for="" class="control-label">Sibling's Name</label>
            <input name="" type="text" class="form-control" value="{{$sibname}}" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="" class="control-label">Year Joined</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input id="elemgrad" name="elemgrad" type="text" class="form-control" value="{{$datefrom}}" disabled>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="" class="control-label">Year Ended</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input id="elemgrad" name="elemgrad" type="text" class="form-control" value="{{$dateto}}" disabled>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-danger">
      <div class="box-header with-border">
        <h4>C. Educational Background</h4>
      </div>
      <div class="box-footer">
        <div class="col-md-12">
          <h4><b>Elementary</b></h4>
          <div class="form-group col-md-6">
            <label for="" class="control-label">School Name</label>
            <input name="" type="text" class="form-control" value="{{$elem->school_name}}" disabled>
          </div>
          <div class="form-group col-md-3">
            <label for="" class="control-label">Year Enrolled</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input id="elemgrad" name="elemgrad" type="text" class="form-control" value="{{$elem->date_enrolled}}" disabled>
            </div>
          </div>
          <div class="form-group col-md-3">
            <label for="" class="control-label">Year Graduated</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input id="elemgrad" name="elemgrad" type="text" class="form-control" value="{{$elem->date_graduated}}" disabled>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="" class="control-label">Achievements/Honors</label>
            <input name="" type="text" class="form-control" value="{{$elem->awards}}" disabled>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="col-md-12">
          <h4><b>High School</b></h4>
          <div class="form-group col-md-6">
            <label for="" class="control-label">School Name</label>
            <input name="" type="text" class="form-control" value="{{$hs->school_name}}" disabled>
          </div>
          <div class="form-group col-md-3">
            <label for="" class="control-label">Year Enrolled</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input id="elemgrad" name="elemgrad" type="text" class="form-control" value="{{$hs->date_enrolled}}" disabled>
            </div>
          </div>
          <div class="form-group col-md-3">
            <label for="" class="control-label">Year Graduated</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input id="elemgrad" name="elemgrad" type="text" class="form-control" value="{{$hs->date_graduated}}" disabled>
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="" class="control-label">Achievements/Honors</label>
            <input name="" type="text" class="form-control" value="{{$hs->awards}}" disabled>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="col-md-12">
          <h4><b>College</b></h4>
          <?php
          if($currschool==0){
            $schoname = 'N/A';
            $gwaval = 'N/A';
            $courname = 'N/A';
          }else{
            $schoname = $getschool->schools_description;
            $gwaval = $getschool->gwa;
            $courname = $getschool->courses_description;
          }
          ?>
          <div class="form-group col-md-6">
            <label for="" class="control-label">School/University Currently Enrolled In</label>
            <input name="" value="{{$schoname}}" type="text" class="form-control" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="" class="control-label">Current Course</label>
            <input name="" type="text" class="form-control" value="{{$courname}}" disabled>
          </div>
          <div class="form-group col-md-6 col-sm-11">
            <label for="" class="control-label">GWA</label>
            <input name="" type="text" class="form-control" value="{{$gwaval}}" disabled>
          </div>
          <div class="form-group col-md-2 col-sm-1">
            <br>
            <div class="btn btn-default btn-file">
              <i class="fa fa-external-link"></i> View Grades <!-- tapos mapupunta sa ibang tab kapag kinlick to, nandun sa tab nayun yung pdf ng grade -->
              <button type="button"></button>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <?php $ctr=1; ?>
          @foreach ($desiredcourses as $desiredcourses)
          <div class="form-group col-md-6">
            <label for="school1">School {{$ctr}}</label>
            <input type="text" id="school1" name="school1" class="form-control" value="{{$desiredcourses->schools_description}}" disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="course1">Course {{$ctr}}</label>
            <input type="text" id="course1" name="course1" class="form-control" value="{{$desiredcourses->courses_description}}" disabled>
          </div>
          <?php $ctr++; ?>
          @endforeach
        </div>
      </div>
      <div class="box-footer">
        <div class="col-md-12">
          <h4><b>Community Involvement or Affiliation</b></h4>
          <div class="form-group col-md-12">
            <label for="" class="control-label">Organization Name</label>
            <input name="" type="text" class="form-control" value="{{$application->organization}}" disabled>
          </div>
          <div class="form-group col-md-8">
            <label for="" class="control-label">Position</label>
            <input name="" type="text" class="form-control" value="{{$application->position}}" disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="" class="control-label">Year of Participation</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input id="elemgrad" name="elemgrad" type="text" class="form-control" value="{{$application->participation_date}}" disabled>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-danger">
      <div class="box-header with-border">
        <h4>D. Essay</h4>
      </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group col-md-6">
            <textarea class="form-control" name="strPersEssay" style="resize: none; height: 400px;" disabled>{{$application->first_essay}}</textarea>
          </div>
          <div class="form-group col-md-6">
            <textarea class="form-control" name="strPersEssay" style="resize: none; height: 400px;" disabled>{{$application->second_essay}}</textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-7 col-md-offset-5">
            <a class="btn btn-success btn-accept"><i class="fa fa-check"></i> Accept</a>
            <a class="btn btn-danger"><i class="fa fa-remove"></i> Decline</a>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content -->
  <!-- /.content-wrapper -->
  @endsection
  @section('meta')
  <meta name="_token" content="{!! csrf_token() !!}" />
  @endsection
  @section('script')
  <script type="text/javascript">
    $('.btn-accept').click(function(){
      if(confirm('Are you sure you want to accept? '))
      {
        window.location.href = "{{route('details.edit',$application->user_id)}}"
      }
    });
    $('.btn-danger').click(function(){
      $('#frmRemarks').trigger("reset");
      $('#remarks').modal('show');
    });
  </script>
  @endsection
