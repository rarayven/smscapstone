@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div id="overlay">
  <div class="loader"></div>
</div>
<div class="content-wrapper">
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
  <section class="content">
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
      <br>
      <div class="box-header">
        <div class="col-md-2">
          <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/'.$councilor->picture) }}">
        </div>
        <div class="col-md-8">
          <center><strong>QUEZON CITY</strong><br>
            <i>Office of the City Mayor</i><br>
            <strong>Scholarship and Youth Development Program</strong></center>
          </div>
          <div class="col-md-2">
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/logo.png') }}">
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-12">
            <div class="col-md-10">
              <br>
              <div class="col-md-offset-4">
                <h3><strong>&nbsp;&nbsp;<u>COUNCILOR {{ $councilor->first_name }} {{ $councilor->middle_name }} {{ $councilor->last_name }}</u></strong></h3>
              </div>
            </div>
            <div class="col-md-2">
              <img class="profile-user-img img-responsive img-square" style="width: 150px; height: 150px;" src="{{ asset('images/'.$application->picture) }}">
            </div>
          </div>
          <div class="col-md-12">
            <center><h2>APPLICATION FORM</h2></center><br><br>
          </div>
          <span class="mailbox-read-time pull-right"><i class="fa fa-clock-o"></i> {{$application->application_date->format('M d, Y - h:i A ')}}</span>
          <div class="col-md-12 well">
            <div class="col-md-12">
              <h4>A. PERSONAL DATA</h4>
            </div>
            <div class="col-md-12">
              <center>
                <h3>
                  <div class="col-md-4 col-sm-4">
                    {{$application->last_name}} 
                  </div>
                  <div class="col-md-4 col-sm-4">
                    {{$application->first_name}}
                  </div>
                  <div class="col-md-4 col-sm-4">
                    {{$application->middle_name}}
                  </div>
                </h3>
              </center>
            </div>
            <div class="col-md-12">
              <hr style="border-top: 1px solid #8c8b8b; margin-top: -1px; margin-bottom: -1px;">
              <center>
                <div class="col-md-4 col-sm-4">
                  Last Name 
                </div>
                <div class="col-md-4 col-sm-4">
                  First Name
                </div>
                <div class="col-md-4 col-sm-4">
                  Middle Name
                </div>
              </center>
              <br><br>
            </div>
            <div class="col-md-12">
              <div class="col-md-2">
                House No: <u>{{$application->house_no}}</u>
              </div>
              <div class="col-md-4">
                Street: <u>{{$application->street}}</u>
              </div>
              <div class="col-md-4">
                Brgy: <u>{{$application->barangay_description}}</u>
              </div>
              <div class="col-md-2">
                District: <u>{{$application->districts_description}}</u>
              </div><br><br>
            </div>
            <div class="col-md-12">
              <div class="col-md-2">
                Age: <u>{{$application->birthday->diffInYears()}}</u>
              </div>
              <div class="col-md-3">
                Date of Birth: <u>{{$application->birthday->format('M d, Y')}}</u>
              </div>
              <div class="col-md-3">
                Place of Birth: <u>{{$application->birthplace}}</u>
              </div>
              <div class="col-md-4">
                Religion: <u>{{$application->religion}}</u>
              </div><br><br>
            </div>
            <div class="col-md-12">
              <div class="col-md-3">
                @if ($application->gender == 0)
                Sex: <u>Male</u>
                @else
                Sex: <u>Female</u>
                @endif
              </div>
              <div class="col-md-5">
                E-mail Address: <u>{{$application->email}}</u>
              </div>
              <div class="col-md-4">
                Contact No: <u>{{$application->cell_no}}</u>
              </div>
            </div>
          </div>
          <div class="col-md-12 well">
            <div class="col-md-12">
              <h4>B. FAMILY DATA</h4>
            </div>
            <div class="col-md-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Father's Name: {{$father->first_name}} {{$father->last_name}}</th>
                    <th>Mother's Name: {{$mother->first_name}} {{$mother->last_name}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Citizenship: {{$father->citizenship}}</td>
                    <td>Citizenship: {{$mother->citizenship}}</td>
                  </tr>
                  <tr>
                    <td>Highest Educ. Attainment: {{$father->citizenship}}</td>
                    <td>Highest Educ. Attainment: {{$mother->citizenship}}</td>
                  </tr>
                  <tr>
                    <td>Occupation: {{$father->occupation}}</td>
                    <td>Occupation: {{$mother->occupation}}</td>
                  </tr>
                  <tr>
                    <td>Mothly Income: {{$father->monthly_income}}</td>
                    <td>Mothly Income: {{$mother->monthly_income}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              No. of brother/s<u> {{$application->brothers}} </u>sister/s<u> {{$application->sisters}}&nbsp;</u><br><br>
            </div>
            <div class="col-md-12">
              <div class="col-md-12">
                Sibling/s who is currently or formerly a beneficiary of SYDP:<br><br>
              </div>
              @if ($exist != 0)
              <div class="col-md-6">
                Name: {{ $siblings->first_name }} {{ $siblings->last_name }}
              </div>
              <div class="col-md-4">
                From: {{ $siblings->date_from }} To: {{ $siblings->date_to }}
              </div>
              @else
              <div class="col-md-6">
                Name: --------
              </div>
              <div class="col-md-4">
                From: -------- To: --------
              </div>
              @endif
              <div class="col-md-2">
                <h4>C. GWA: </h4>&emsp;&emsp;&emsp;
                @if ($currschool != 0)
                {{ $getschool->gwa }}
                @else
                N/A
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-12 well">
            <div class="col-md-12">
              <h4>D. EDUCATIONAL BACKGROUND</h4>
            </div>
            <div class="col-md-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Level</th>
                    <th>School</th>
                    <th>Date Enrolled</th>
                    <th>Date Graduated</th>
                    <th>Award/Honors received</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Elementary</td>
                    <td>{{$elem->school_name}}</td>
                    <td>{{$elem->date_enrolled}}</td>
                    <td>{{$elem->date_graduated}}</td>
                    @if ($elem->awards != '')
                    <td>{{$elem->awards}}</td>
                    @else
                    <td>N/A</td>
                    @endif
                  </tr>
                  <tr>
                    <td>Highschool</td>
                    <td>{{$hs->school_name}}</td>
                    <td>{{$hs->date_enrolled}}</td>
                    <td>{{$hs->date_graduated}}</td>
                    @if ($hs->awards != '')
                    <td>{{$hs->awards}}</td>
                    @else
                    <td>N/A</td>
                    @endif
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              College
            </div>
            <div class="col-md-12">
              @if ($currschool != 0)
              <div class="col-md-5">
                School/University Currently Enrolled In: {{ $getschool->schools_description }}
              </div>
              <div class="col-md-5">
                Current Course: {{ $getschool->courses_description }}
              </div> 
              @else
              <div class="col-md-5">
                School/University Currently Enrolled In: N/A
              </div>
              <div class="col-md-5">
                Current Course: N/A
              </div> 
              @endif
              <div class="col-md-2">
                <a href="#" target="_blank"><div class="btn btn-default btn-file">
                  <i class="fa fa-external-link"></i> View Grades
                </div></a>
              </div>
            </div>
          </div>
          <div class="col-md-12 well">
            <div class="col-md-12">
              <h4>E. Name three (3) courses you wish to enroll in and the respective school (In order of your preference)</h4>
            </div>
            <div class="col-md-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Course</th>
                    <th>School</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($desiredcourses as $desiredcourses)
                  <tr>
                    <td>{{$desiredcourses->courses_description}}</td>
                    <td>{{$desiredcourses->schools_description}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-12 well">
            <div class="col-md-12">
              <h4>F. COMMUNITY INVOLVEMENT/AFFILIATION</h4>
            </div>
            <div class="col-md-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Organization</th>
                    <th>Position</th>
                    <th>Date of Participation</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{$application->organization}}</td>
                    <td>{{$application->position}}</td>
                    <td>{{$application->participation_date}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-12 well">
            <div class="col-md-12">
              <h4>G. Maikling Talambuhay</h4>
            </div>
            <div class="col-md-12">
              <div class="col-md-12">
                <strong>First Essay:</strong>
              </div>
              <div class="col-md-12">
                {{$application->first_essay}}
                <br><br>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-12">
                <strong>Second Essay:</strong>
              </div>
              <div class="col-md-12">
                {{$application->second_essay}}
              </div>
            </div>
          </div>
          <div class="pull-right">
            <a class="btn btn-success btn-accept"><i class="fa fa-check"></i> Accept</a>
            <a class="btn btn-danger"><i class="fa fa-remove"></i> Decline</a>
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection
  @section('script')
  <script type="text/javascript">
    $('.btn-danger').click(function(){
      $('#frmRemarks').trigger("reset");
      $('#remarks').modal('show');
    });
    $('.btn-accept').on('click',function(e){  
      e.preventDefault();
      swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Accept",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        allowOutsideClick: true,
        showLoaderOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm) {
        setTimeout(function() {
          if (isConfirm) {
            window.location.href = "{{route('details.edit',$application->user_id)}}"
          }
        }, 500);
      });
    });
  </script>
  @endsection
