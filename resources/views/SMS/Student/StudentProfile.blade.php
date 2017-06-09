@extends('SMS.Student.StudentMain')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Profile
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-user"></i> Profile</li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-danger">
      <div class="box-header with-border">
        <div class="box-header">
          <h3>User Information</h3>
        </div>
        <div class="box-body">
          <div class="col-md-3">
            <div class="well">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/'.Auth::user()->picture) }}" alt="User profile picture">
                {{ Form::open([
                  'id' => 'frmimage'])
                }}
                <div class="form-group" style="padding-top: 50px;">
                  <div class="btn btn-default btn-file btn-block">
                    <i class="fa fa-image"></i> Change Photo..
                    <input type="file" name="image" id='img' value="{{ old('image') }}">
                  </div>
                </div>
                {{ Form::close() }}
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="well">
              {{ Form::open([
                'id' => 'frmname', 'data-parsley-whitespace' => 'squish'])
              }}
              <div class="editname"><button class='btn btn-default btn-xs pull-right' value="frmname"><i class='fa fa-edit'></i></button></div>
              <div class="form-group">
                <label for="first_name" class="control-label">First Name*</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" required="required" maxlength="25" readonly="readonly">
              </div>
              <div class="form-group">
                <label for="middle_name" class="control-label">Middle Name</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ Auth::user()->middle_name }}" maxlength="25" readonly="readonly">
              </div>
              <div class="form-group">
                <label for="last_name" class="control-label">Last Name*</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" required="required" maxlength="25" readonly="readonly">
              </div>
              {{ Form::close() }}
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group well">
              {{ Form::open([
                'id' => 'frmcontact', 'data-parsley-whitespace' => 'squish'])
              }}
              <div class="editcontact"><button class='btn btn-default btn-xs pull-right' value="frmcontact"><i class='fa fa-edit'></i></button></div>
              <label class="control-label">Contact Number*</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-phone"></i>
                </div>
                <input type="text" class="form-control" id="cell_no" name="cell_no" value="{{ Auth::user()->cell_no }}"  required="required" maxlength="15" readonly="readonly">
              </div>
              {{ Form::close() }}
            </div>
            <div class="form-group well">
              {{ Form::open([
                'id' => 'frmbday', 'data-parsley-whitespace' => 'squish'])
              }}
              <div class="editbday"><button class='btn btn-default btn-xs pull-right' value="frmbday"><i class='fa fa-edit'></i></button></div>
              <label class="control-label">Birthdate*</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" id="cell_no" name="cell_no" value="{{ $application->birthday->format('M d, Y') }}"  required="required" maxlength="15" readonly="readonly">
              </div>
              {{ Form::close() }}
            </div>
            <div class="form-group well">
              {{ Form::open([
                'id' => 'frmemail', 'data-parsley-whitespace' => 'squish'])
              }}
              <div class="editemail"><button class='btn btn-default btn-xs pull-right' value="frmemail"><i class='fa fa-edit'></i></button></div>
              <label for="lastName" class="control-label">Email*</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-at"></i>
                </div>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}"  required="required" maxlength="25" readonly="readonly">
              </div>
              {{ Form::close() }}
            </div>
            <div class="well">
              {{ Form::open([
                'id' => 'frmpassword', 'data-parsley-whitespace' => 'squish'])
              }}
              <div class="editpassword"><button class='btn btn-default btn-xs pull-right' value="frmpassword"><i class='fa fa-edit'></i></button></div>
              <div class="form-group">
                <label class="control-label">Current Password*</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-asterisk"></i>
                  </div>
                  <input type="password" class="form-control" id="current" name="current_password" placeholder="password" required="required" maxlength="61" readonly="readonly">
                </div> 
              </div>
              <div class="form-group">
                <label class="control-label">New Password*</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-asterisk"></i>
                  </div>
                  <input type="password" class="form-control" id="new" name="password" placeholder="password" required="required" maxlength="61" readonly="readonly">
                </div> 
              </div>
              <div class="form-group">
                <label class="control-label">Confirm Password*</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-asterisk"></i>
                  </div>
                  <input type="password" class="form-control" id="confirm" name="password_confirmation" id="password" placeholder="password" required="required" maxlength="61" readonly="readonly">
                </div> 
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box box-danger">
      <div class="box-header with-border">
        <div class="box-header">
          <h3>Family Information</h3>
        </div>
        <div class="box-body">
          <div class="col-md-6 col-sm-12">
            <div class=" well">
              {{ Form::open([
                'id' => 'frmminfo', 'data-parsley-whitespace' => 'squish'])
              }}
              <div class="editminfo"><button class='btn btn-default btn-xs pull-right' value="frmminfo"><i class='fa fa-edit'></i></button></div>
              <label class="control-label">Mother's Name</label>
              <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                  <input type="text" id="motherfname" name="motherfname" class="form-control" value="{{ $mother->first_name }}" required="required" placeholder="First Name" readonly="readonly">
                </div>
                <div class="form-group col-md-6 col-sm-12">
                  <input type="text" id="motherlname" name="motherlname" class="form-control" value="{{ $mother->last_name }}" required="required" placeholder="Last Name" readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Citizenship</label>
                <input type="text" id="mothercitizen" name="mothercitizen" class="form-control" value="{{ $mother->citizenship }}" required="required" placeholder="Mother's Citizenship" readonly="readonly">
              </div>
              <div class="form-group">
                <label class="control-label">Highest Attainment</label>
                <input type="text" id="motherhea" name="motherhea" class="form-control" value="{{ $mother->highest_ed }}" required="required" placeholder="Mother's Highest Educational Attainment" readonly="readonly">
              </div>
            </div>
            <div class=" well">
              {{ Form::open([
                'id' => 'frmmoccu', 'data-parsley-whitespace' => 'squish'])
              }}
              <div class="editmoccu"><button class='btn btn-default btn-xs pull-right' value="frmmoccu"><i class='fa fa-edit'></i></button></div>
              <div class="form-group">
                <label class="control-label">Mother's Occupation</label>
                <input type="text" id="motheroccupation" name="motheroccupation" value="{{ $mother->occupation }}" class="form-control" required="required" placeholder="Mother's Occupation" readonly="readonly">
              </div>
              <div class="form-group">
                <label class="control-label">Monthly Income</label>
                <input type="text" name="motherincome" id="motherincome" class="form-control" value="{{ $mother->monthly_income }}" required="required" placeholder="" readonly="readonly">
              </div>
              {{ Form::close() }}
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class=" well">
              {{ Form::open([
                'id' => 'frmfinfo', 'data-parsley-whitespace' => 'squish'])
              }}
              <div class="editfinfo"><button class='btn btn-default btn-xs pull-right' value="frmfinfo"><i class='fa fa-edit'></i></button></div>
              <label class="control-label">Father's Name</label>
              <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                  <input type="text" id="fatherfname" name="fatherfname" class="form-control" value="{{ $father->first_name }}" required="required" placeholder="First Name" readonly="readonly">
                </div>
                <div class="form-group col-md-6 col-sm-12">
                  <input type="text" id="fatherlname" name="fatherlname" class="form-control" value="{{ $father->last_name }}" required="required" placeholder="Last Name" readonly="readonly">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Citizenship</label>
                <input type="text" id="fathercitizen" name="fathercitizen" class="form-control" value="{{ $father->citizenship }}" required="required" placeholder="Father's Citizenship" readonly="readonly">
              </div>
              <div class="form-group">
                <label class="control-label">Highest Attainment</label>
                <input type="text" id="fatherhea" name="fatherhea" class="form-control" value="{{ $father->highest_ed }}" required="required" placeholder="Father's Highest Educational Attainment" readonly="readonly">
              </div>
              {{ Form::close() }}
            </div>
            <div class=" well">
              {{ Form::open([
                'id' => 'frmfoccu', 'data-parsley-whitespace' => 'squish'])
              }}
              <div class="editfoccu"><button class='btn btn-default btn-xs pull-right' value="frmfoccu"><i class='fa fa-edit'></i></button></div>
              <div class="form-group">
                <label class="control-label">Father's Occupation</label>
                <input type="text" id="fatheroccupation" name="fatheroccupation" class="form-control" value="{{ $father->occupation }}" required="required" placeholder="Father's Occupation" readonly="readonly">
              </div>
              <div class="form-group">
                <label class="control-label">Monthly Income</label>
                <input type="text" name="fatherincome" id="fatherincome" class="form-control" value="{{ $father->monthly_income }}" placeholder="" required="required" readonly="readonly">
              </div>
              {{ Form::close() }}
            </div>
          </div>
          <div class="col-md-12">
            <div class="well">
              {{ Form::open([
                'id' => 'frmno', 'data-parsley-whitespace' => 'squish'])
              }}
              <div class="editno"><button class='btn btn-default btn-xs pull-right' value="frmno"><i class='fa fa-edit'></i></button></div>
              <div class="form-group">
                <label class="control-label">Number of Brother/s</label>
                <input type="text" name="intPersBrothers" id="brono" class="form-control" value="{{ $application->brothers }}" placeholder="Type 0 if None" readonly="readonly" required="required">
              </div>
              <div class="form-group">
                <label class="control-label">Number of Sister/s</label>
                <input type="text" name="intPersSisters" id="sisno" class="form-control" value="{{ $application->sisters }}"  placeholder="Type 0 if None" readonly="readonly" required="required">
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@section('script')
{!! Html::script("custom/ProfileAjax.min.js") !!}
{!! Html::script("custom/ProfileStudentAjax.min.js") !!}
<script type="text/javascript">
  var urlimage = "{!! route('studentimage.store') !!}";
  var urlname = "{!! route('studentname.store') !!}";
  var urlemail = "{!! route('studentemail.store') !!}";
  var urlcontact = "{!! route('studentcontact.store') !!}";
  var urlpassword = "{!! route('studentpassword.store') !!}";
  var urlminfo = "{!! route('studentminfo.store') !!}";
  var urlmoccu = "{!! route('studentmoccu.store') !!}";
  var urlfinfo = "{!! route('studentfinfo.store') !!}";
  var urlfoccu = "{!! route('studentfoccu.store') !!}";
  var urlsiblings = "{!! route('studentsiblings.store') !!}";
</script>
@endsection