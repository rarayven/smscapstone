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
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Personal Data</a></li>
        <li><a href="#tab_2" data-toggle="tab">Family Data</a></li>
        <li><a href="#tab_3" data-toggle="tab">Education</a></li>
        <li><a href="#tab_4" data-toggle="tab">Community Involvement</a></li>
        <li><a href="#tab_5" data-toggle="tab">Maikling Talambuhay</a></li>
        <li class="pull-right header"><span class="mailbox-read-time"><i class="fa fa-clock-o"></i> {{$application->application_date->format('M d, Y - h:i A')}}</span></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active row" id="tab_1">
          <div class="col-md-10">
            Last Name: {{$application->last_name}} <br>
            First Name: {{$application->first_name}} <br>
            Middle Name: {{$application->middle_name}} <br>
            House No: {{$application->house_no}} <br>
            Street: {{$application->street}} <br>
            Brgy: {{$application->barangay_description}} <br>
            District: {{$application->districts_description}} <br>
            Age: {{$application->birthday->diffInYears()}} <br>
            Date of Birth: {{$application->birthday->format('M d, Y')}} <br>
            Place of Birth: {{$application->birthplace}} <br>
            Religion: {{$application->religion}} <br>
            @if ($application->gender == 0)
            Sex: Male <br>
            @else
            Sex: Female <br>
            @endif
            E-mail Address: {{$application->email}} <br>
            Contact No: {{$application->cell_no}} <br>
          </div>
          <div class="col-md-2">
            <img class="profile-user-img img-responsive img-square" style="width: 150px; height: 150px;" src="{{ asset('images/'.$application->picture) }}">
          </div>
        </div>
        <div class="tab-pane row" id="tab_2">
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
            No. of brother/s {{$application->brothers}} sister/s {{$application->sisters}}&nbsp;<br><br>
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
          </div>
        </div>
        <div class="tab-pane row" id="tab_3">
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
            <div class="col-md-5">
              School/University Currently Enrolled In: {{ $application->schools_description }}
            </div>
            <div class="col-md-5">
              Current Course: {{ $application->courses_description }}
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
            <embed src="{{ asset('docs/tms.pdf') }}" width="100%" height="700px" type='application/pdf'>
            </div>
          </div>
          <div class="tab-pane row" id="tab_4">
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
                  @if ($count!=0)
                  @foreach ($affiliation as $affiliations)
                  <tr>
                    <td>{{$affiliations->organization}}</td>
                    <td>{{$affiliations->position}}</td>
                    <td>{{$affiliations->participation_date}}</td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane row" id="tab_5">
            <div class="col-md-12">
              <div class="col-md-12">
                <strong>Essay:</strong>
              </div>
              <div class="col-md-12">
                {{$application->essay}}
              </div>
              <div class="pull-right">
                <a class="btn btn-success btn-accept"><i class="fa fa-check"></i> Accept</a>
                <a class="btn btn-danger"><i class="fa fa-remove"></i> Decline</a>
              </div>
            </div>
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
