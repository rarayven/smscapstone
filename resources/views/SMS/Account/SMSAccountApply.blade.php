@extends('SMS.SMSMain')
@section('title')
<title>ScholarMS|Apply Now</title>
@endsection
@section('override')
{!! Html::style("plugins/datepicker/datepicker3.css") !!}
{!! Html::style("plugins/datatables/dataTables.bootstrap.min.css") !!}
{!! Html::style("css/bootstrap-toggle.min.css") !!}
{!! Html::style("css/style.css") !!}
{!! Html::style("plugins/iCheck/flat/red.css") !!}
{!! Html::style("css/parsley.css") !!}
{!! Html::style("plugins/sweetalert/sweetalert.min.css") !!}
<style type="text/css">
    [data-notify="container"] {
        width: 20%;
    }
</style>
<style type="text/css">
    #questionappear, #college { display: none; }
</style>
@endsection
@section('login')
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <li class="{{Request::path() == 'login' ? 'active' : ''}}"><a href="{{ url('/login') }}">Login</a></li>
    </ul>
</div>
@endsection
@section('middlecontent')
<div class="container">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
        {{ Form::open([
            'id' => 'frmApply',
            'class' => 'f1',
            'data-parsley-errors-messages-disabled' => '',
            'enctype' => 'multipart/form-data',
            ])
        }}
        @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <strong>Errors:</strong>
          <ul>
              @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
      @endif
      <div id="top">
        <h3>Apply Now</h3>
        <p>Fill up the forms to apply for scholarship</p>
        <div class="f1-steps">
            <div class="f1-progress">
                <div class="f1-progress-line" data-now-value="7.14" data-number-of-steps="6" style="width: 7.14%;"></div>
            </div>
            <div class="f1-step active">
                <div class="f1-step-icon"><i class="fa fa-map"></i></div>
                <p>District</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-black-tie"></i></div>
                <p>Councilor</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                <p>Personal Data</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-users"></i></div>
                <p>Family Data</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-graduation-cap"></i></div>
                <p>Educational Background</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-pencil"></i></div>
                <p>Essay</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-fw fa-file-text"></i></div>
                <p>Summary</p>
            </div>
        </div>
    </div>
    <div class="form-section">
        <h3>Select District:</h3>
        <div class="form-group row">
            @foreach ($district as $districts)
            <div class="col-md-4">
                <div class="box box-widget district widget-user-2 text-center" style="cursor: pointer; background-color: #FF9376; border-style: solid;" value={{$districts->id}}>
                    <div class="widget-user-header">
                        <h1 id="txt{{$districts->id}}">{{$districts->description}}</h1>
                    </div>
                </div>
            </div>
            @endforeach
            {{ Form::hidden('intDistID', null, [
              'id' => 'intDistID'
              ])
          }}
      </div>
  </div>
  <div class="form-section">
    <h3>Select Councilor:</h3>
    <div class="form-group col-md-12 row">
        <div id="councilor" class="row"></div>
        {{ Form::hidden('intCounID', null, [
          'id' => 'intCounID'
          ])
      }}
  </div>
</div>
<div class="form-section">
    <h3>Input Personal Info:</h3>
    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::label('fname', 'First Name*', [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('strUserFirstName', null, [
                'id' => 'fname',
                'class' => 'form-control',
                'maxlength' => '25',
                'required' => 'required',
                'data-parsley-pattern' => '^[a-zA-Z. ]+$',
                'autocomplete' => 'off'
                ]) 
            }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('mname', 'Middle Name', [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('strUserMiddleName', null, [
                'id' => 'mname',
                'class' => 'form-control',
                'maxlength' => '25',
                'data-parsley-pattern' => '^[a-zA-Z. ]+$',
                'autocomplete' => 'off'
                ]) 
            }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('lname', 'Last Name*', [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('strUserLastName', null, [
                'id' => 'lname',
                'class' => 'form-control',
                'maxlength' => '25',
                'required' => 'required',
                'data-parsley-pattern' => '^[a-zA-Z. ]+$',
                'autocomplete' => 'off'
                ]) 
            }}
        </div>
        <div class="form-group col-md-2">
            {{ Form::label('gender', 'Gender', [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('PersGender', [
                0 => 'Male',
                1 => 'Female'
                ], null, [
                'class' => 'form-control'])
            }}
        </div>
        <div class="form-group col-md-2">
            {{ Form::label('bday', 'Birth Date*', [
                'class' => 'control-label'
                ]) 
            }}
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            {{ Form::text('datPersDOB', null, [
                'id' => 'datepicker',
                'class' => 'form-control pull-right',
                'required' => 'required'
                ]) 
            }}
        </div>
    </div>
    <div class="form-group col-md-3">
        {{ Form::label('pob', 'Place of Birth*', [
            'class' => 'control-label'
            ]) 
        }}
        {{ Form::text('strPersPOB', null, [
            'id' => 'pob',
            'class' => 'form-control',
            'maxlength' => '25',
            'required' => 'required',
            'data-parsley-pattern' => '^[a-zA-Z. ]+$',
            'autocomplete' => 'off'
            ]) 
        }}
    </div>
    <div class="form-group col-md-2">
        {{ Form::label('religion', 'Religion*', [
            'class' => 'control-label'
            ]) 
        }}
        {{ Form::text('strPersReligion', null, [
            'id' => 'strPersReligion',
            'class' => 'form-control',
            'maxlength' => '50',
            'required' => 'required',
            'data-parsley-pattern' => '^[a-zA-Z. ]+$',
            'autocomplete' => 'off'
            ]) 
        }}
    </div>
    <div class="form-group col-md-3">
        {{ Form::label('mobileno', 'Mobile Number*', [
            'class' => 'control-label'
            ]) 
        }}
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-phone"></i>
            </div>
            {{ Form::text('strUserCell', null, [
                'id' => 'strUserCell',
                'class' => 'form-control',
                'maxlength' => '3',
                'maxlength' => '15',
                'required' => 'required',
                'data-parsley-type' => 'number',
                'autocomplete' => 'off'
                ]) 
            }}
        </div>
    </div>
    <div class="form-group col-md-2">
        {{ Form::label('stname', 'House Number*', [
            'class' => 'control-label'
            ]) 
        }}
        {{ Form::text('strApplHouseNo', null, [
            'id' => 'strApplHouseNo',
            'class' => 'form-control',
            'maxlength' => '4',
            'required' => 'required',
            'autocomplete' => 'off',
            'data-parsley-type' => 'number'
            ]) 
        }}
    </div>
    <div class="form-group col-md-3">
        {{ Form::label('stname', 'Street Name*', [
            'class' => 'control-label'
            ]) 
        }}
        {{ Form::text('strPersStreet', null, [
            'id' => 'stname',
            'class' => 'form-control',
            'maxlength' => '25',
            'required' => 'required',
            'autocomplete' => 'off',
            'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
            ]) 
        }}
    </div>
    <div class="form-group col-md-2">
        {{ Form::label('bgy', 'Barangay', [
            'class' => 'control-label'
            ]) 
        }}
        <select id="intBaraID" class="form-control" name="intBaraID">
            @foreach($barangay as $barangay)
            <option value={{$barangay->intBaraID}}>{{$barangay->strBaraDesc}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        {{ Form::label('email', 'Email Address*', [
            'class' => 'control-label'
            ]) 
        }}
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-at"></i>
            </div>
            {{ Form::email('strUserEmail', null, [
                'id' => 'email',
                'class' => 'form-control',
                'maxlength' => '30',
                'required' => 'required',
                'autocomplete' => 'off',
                'data-parsley-trigger-after-failure' => "focusout"
                ]) 
            }}
        </div>
    </div>
    <div class="form-group col-md-2">
        <div class="col-sm-12 row">
            {{ Form::label('strApplPicture', 'Upload Image*', [
                'class' => 'control-label'
                ]) 
            }}
        </div>
        <div class="btn btn-default btn-file images col-md-12 col-sm-2">
            <i class="fa fa-paperclip"></i> Image
            {{ Form::file('strApplPicture', [
                'required' => 'required'
                ]) 
            }}
        </div>
    </div>
</div>
</div>
<div class="form-section">
    <h3>Input Family Info:</h3>
    <div class="container col-md-6 col-sm-12">
        {{ Form::label('name', "Mother's Name*", [
            'class' => 'control-label'
            ]) 
        }}
        <div class="row">
            <div class="form-group col-md-6 col-sm-12">
                {{ Form::text('motherfname', null, [
                    'id' => 'motherfname',
                    'placeholder' => 'First Name',
                    'class' => 'form-control',
                    'maxlength' => '25',
                    'required' => 'required',
                    'autocomplete' => 'off',
                    'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                    ]) 
                }}
            </div>
            <div class="form-group col-md-6 col-sm-12">
                {{ Form::text('motherlname', null, [
                    'id' => 'motherlname',
                    'placeholder' => 'Last Name',
                    'class' => 'form-control',
                    'maxlength' => '25',
                    'required' => 'required',
                    'autocomplete' => 'off',
                    'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                    ]) 
                }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('name', "Citizenship*", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('mothercitizen', null, [
                'id' => 'mothercitizen',
                'placeholder' => "Mother's Citizenship",
                'class' => 'form-control',
                'maxlength' => '25',
                'required' => 'required',
                'autocomplete' => 'off',
                'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group">
            {{ Form::label('name', "Highest Attainment*", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('motherhea', null, [
                'id' => 'motherhea',
                'placeholder' => "Mother's Highest Educational Attainment",
                'class' => 'form-control',
                'maxlength' => '25',
                'required' => 'required',
                'autocomplete' => 'off',
                'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group">
            {{ Form::label('name', "Occupation*", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('motheroccupation', null, [
                'id' => 'motheroccupation',
                'placeholder' => "Mother's Occupation",
                'class' => 'form-control',
                'maxlength' => '25',
                'required' => 'required',
                'autocomplete' => 'off',
                'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group">
            {{ Form::label('name', "Monthly Income*", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('motherincome', [
                'None' => 'None',
                '10,000 and Below' => '10,000 and Below',
                '10,000 - 15,000' => '10,000 - 15,000',
                '15,000 - 20,000' => '15,000 - 20,000',
                '20,000 - 25,000' => '20,000 - 25,000',
                '25,000 - 30,000' => '25,000 - 30,000',
                '30,000 - 35,000' => '30,000 - 35,000',
                '35,000 and Above' => '35,000 and Above'
                ], null, [
                'id' => 'motherincome',
                'class' => 'form-control'])
            }}
        </div>
    </div>
    <div class="container col-md-6 col-sm-12">
        {{ Form::label('name', "Father's Name*", [
            'class' => 'control-label'
            ]) 
        }}
        <div class="row">
            <div class="form-group col-md-6 col-sm-12">
                {{ Form::text('fatherfname', null, [
                    'id' => 'fatherfname',
                    'placeholder' => 'First Name',
                    'class' => 'form-control',
                    'maxlength' => '25',
                    'required' => 'required',
                    'autocomplete' => 'off',
                    'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                    ]) 
                }}
            </div>
            <div class="form-group col-md-6 col-sm-12">
                {{ Form::text('fatherlname', null, [
                    'id' => 'fatherlname',
                    'placeholder' => 'Last Name',
                    'class' => 'form-control',
                    'maxlength' => '25',
                    'required' => 'required',
                    'autocomplete' => 'off',
                    'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                    ]) 
                }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('name', "Citizenship*", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('fathercitizen', null, [
                'id' => 'fathercitizen',
                'placeholder' => "Father's Citizenship",
                'class' => 'form-control',
                'maxlength' => '25',
                'required' => 'required',
                'autocomplete' => 'off',
                'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group">
            {{ Form::label('name', "Highest Attainment*", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('fatherhea', null, [
                'id' => 'fatherhea',
                'placeholder' => "Father's Highest Educational Attainment",
                'class' => 'form-control',
                'maxlength' => '25',
                'required' => 'required',
                'autocomplete' => 'off',
                'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group">
            {{ Form::label('name', "Occupation*", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('fatheroccupation', null, [
                'id' => 'fatheroccupation',
                'placeholder' => "Father's Occupation",
                'class' => 'form-control',
                'maxlength' => '25',
                'required' => 'required',
                'autocomplete' => 'off',
                'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group">
            {{ Form::label('name', "Monthly Income*", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('fatherincome', [
                'None' => 'None',
                '10,000 and Below' => '10,000 and Below',
                '10,000 - 15,000' => '10,000 - 15,000',
                '15,000 - 20,000' => '15,000 - 20,000',
                '20,000 - 25,000' => '20,000 - 25,000',
                '25,000 - 30,000' => '25,000 - 30,000',
                '30,000 - 35,000' => '30,000 - 35,000',
                '35,000 and Above' => '35,000 and Above'
                ], null, [
                'id' => 'fatherincome',
                'class' => 'form-control'])
            }}
        </div>
    </div>
    <div class="form-group col-md-6 col-sm-12">
        {{ Form::label('name', "Number of Brother/s*", [
            'class' => 'control-label'
            ]) 
        }}
        {{ Form::text('intPersBrothers', null, [
            'id' => 'brono',
            'placeholder' => "Type 0 if None",
            'class' => 'form-control',
            'minlength' => '1',
            'maxlength' => '2',
            'required' => 'required',
            'autocomplete' => 'off',
            'data-parsley-type' => 'number'
            ]) 
        }}
    </div>
    <div class="form-group col-md-6 col-sm-12">
        {{ Form::label('name', "Number of Sister/s*", [
            'class' => 'control-label'
            ]) 
        }}
        {{ Form::text('intPersSisters', null, [
            'id' => 'sisno',
            'placeholder' => "Type 0 if None",
            'class' => 'form-control',
            'minlength' => '1',
            'maxlength' => '2',
            'required' => 'required',
            'autocomplete' => 'off',
            'data-parsley-type' => 'number'
            ]) 
        }}
    </div>
    {{ Form::label('name', "Do you have a sibling/s who is currently or formerly a beneficiary of the SYDP?", [
        'class' => 'control-label'
        ]) 
    }}
    <div class="form-group">
        <label class="radio-inline">{{ Form::radio('rad', 'yes', false, ['id' => 'yes']) }} Yes</label>
        <label class="radio-inline">{{ Form::radio('rad', 'no', true, ['id' => 'no']) }} No</label>
    </div>
    <div id="questionappear">
       <div class="row">
        <div class="container col-md-6 col-sm-12">
            <div class="form-group">
                {{ Form::label('name', "Name", [
                    'class' => 'control-label'
                    ]) 
                }}
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                    {{ Form::text('strSiblFirstName', null, [
                        'id' => 'strSiblFirstName',
                        'placeholder' => "Sibling's First Name",
                        'class' => 'form-control',
                        'maxlength' => '25',
                        'autocomplete' => 'off',
                        'placeholder' => 'First Name',
                        'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                        ]) 
                    }}
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    {{ Form::text('strSiblLastName', null, [
                        'id' => 'strSiblLastName',
                        'placeholder' => "Sibling's Last Name",
                        'class' => 'form-control',
                        'maxlength' => '25',
                        'autocomplete' => 'off',
                        'placeholder' => 'Last Name',
                        'data-parsley-pattern' => '^[a-zA-Z. ]+$'
                        ]) 
                    }}
                </div>
            </div>
        </div>
        <div class="container col-md-6 col-sm-12">
            <div class="form-group">
                {{ Form::label('name', "Date Joined", [
                    'class' => 'control-label'
                    ]) 
                }}
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {{ Form::text('strSiblDateFrom', null, [
                            'id' => 'strSiblDateFrom',
                            'placeholder' => "From (YYYY)",
                            'class' => 'form-control',
                            'minlength' => '4',
                            'maxlength' => '4',
                            'autocomplete' => 'off',
                            'data-parsley-type' => 'number',
                            'data-parsley-trigger-after-failure' => "focusout"
                            ]) 
                        }}
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {{ Form::text('strSiblDateTo', null, [
                            'id' => 'strSiblDateTo',
                            'placeholder' => "To (YYYY)",
                            'class' => 'form-control',
                            'minlength' => '4',
                            'maxlength' => '4',
                            'autocomplete' => 'off',
                            'data-parsley-type' => 'number',
                            'data-parsley-trigger-after-failure' => "focusout"
                            ]) 
                        }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="form-section">
    <h3>Educational Background:</h3><hr>
    <h3>Elementary</h3>
    <div class="row">
        <div class="form-group col-md-6 col-sm-12">
            {{ Form::label('elemschool', "School Name*", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('elemschool', null, [
                'id' => 'elemschool',
                'class' => 'form-control',
                'maxlength' => '50',
                'autocomplete' => 'off',
                'required' => 'required',
                'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group col-md-3 col-sm-6">
            {{ Form::label('elemenrolled', "Year Enrolled*", [
                'class' => 'control-label'
                ]) 
            }}
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{ Form::text('elemenrolled', null, [
                    'id' => 'elemenrolled',
                    'placeholder' => "YYYY",
                    'class' => 'form-control',
                    'minlength' => '4',
                    'maxlength' => '4',
                    'autocomplete' => 'off',
                    'data-parsley-type' => 'number',
                    'required' => 'required',
                    'data-parsley-trigger-after-failure' => "focusout"
                    ]) 
                }}
            </div>
        </div>
        <div class="form-group col-md-3 col-sm-6">
            {{ Form::label('elemgrad', "Year Graduated*", [
                'class' => 'control-label',
                ]) 
            }}
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{ Form::text('elemgrad', null, [
                    'id' => 'elemgrad',
                    'placeholder' => "YYYY",
                    'class' => 'form-control',
                    'minlength' => '4',
                    'maxlength' => '4',
                    'autocomplete' => 'off',
                    'data-parsley-type' => 'number',
                    'required' => 'required',
                    'data-parsley-trigger-after-failure' => "focusout"
                    ]) 
                }}
            </div>
        </div>
        <div class="form-group col-md-12 col-sm-12">
            {{ Form::label('elemshonors', "Achievements/Honors", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('elemhonors', null, [
                'id' => 'elemhonors',
                'class' => 'form-control',
                'maxlength' => '50',
                'autocomplete' => 'off'
                ]) 
            }}
        </div>
    </div>
    <hr>
    <h3>High School</h3>
    <div class="row">
        <div class="form-group col-md-6 col-sm-12">
            {{ Form::label('hschool', "School Name*", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('hschool', null, [
                'id' => 'hschool',
                'class' => 'form-control',
                'maxlength' => '50',
                'autocomplete' => 'off',
                'required' => 'required',
                'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group col-md-3 col-sm-6">
            {{ Form::label('hsenrolled', "Year Enrolled*", [
                'class' => 'control-label'
                ]) 
            }}
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{ Form::text('hsenrolled', null, [
                    'id' => 'hsenrolled',
                    'placeholder' => "YYYY",
                    'class' => 'form-control',
                    'minlength' => '4',
                    'maxlength' => '4',
                    'autocomplete' => 'off',
                    'data-parsley-type' => 'number',
                    'required' => 'required',
                    'data-parsley-trigger-after-failure' => "focusout"
                    ]) 
                }}
            </div>
        </div>
        <div class="form-group col-md-3 col-sm-6">
            {{ Form::label('hsgrad', "Year Graduated*", [
                'class' => 'control-label'
                ]) 
            }}
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{ Form::text('hsgrad', null, [
                    'id' => 'hsgrad',
                    'placeholder' => "YYYY",
                    'class' => 'form-control',
                    'minlength' => '4',
                    'maxlength' => '4',
                    'autocomplete' => 'off',
                    'data-parsley-type' => 'number',
                    'required' => 'required',
                    'data-parsley-trigger-after-failure' => "focusout"
                    ]) 
                }}
            </div>
        </div>
        <div class="form-group col-md-12 col-sm-12">
            {{ Form::label('hshonor', "Achievements/Honors", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('hshonor', null, [
                'id' => 'hshonor',
                'class' => 'form-control',
                'maxlength' => '50',
                'autocomplete' => 'off',
                'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
                ]) 
            }}
        </div>
    </div>
    <hr>
    {{ Form::label('name', "Are you a Fresh Graduate?", [
        'class' => 'control-label'
        ]) 
    }}
    <div class="form-group">
        <label class="radio-inline">{{ Form::radio('col', 'yes', true, ['id' => 'yes']) }} Yes</label>
        <label class="radio-inline">{{ Form::radio('col', 'no', false, ['id' => 'no']) }} No</label>
    </div>
    <div id="college">
        <h3>College</h3>
        <div class="row">
            <div class="form-group col-md-6">
                {{ Form::label('name', "School/University Currently Enrolled In", [
                    'class' => 'control-label'
                    ]) 
                }}
                <select id="intPersCurrentSchool" name="intPersCurrentSchool" class="form-control">
                    <option value="">None</option>
                    @foreach($school as $schools)
                    <option value={{$schools->id}}>{{$schools->description}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="control-label">Current Course</label>
                <select id="intPersCurrentCourse" name="intPersCurrentCourse" class="form-control">
                    <option value="">None</option>
                    @foreach($course as $courses)
                    <option value={{$courses->id}}>{{$courses->description}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                {{ Form::label('name', "Year", [
                    'class' => 'control-label'
                    ]) 
                }}
                <select id="intYearID" name="intYearID" class="form-control">
                    <option value="">None</option>
                    @foreach($year as $years)
                    <option value={{$years->id}}>{{$years->description}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                {{ Form::label('name', "Semester", [
                    'class' => 'control-label'
                    ]) 
                }}
                <select id="intSemID" name="intSemID" class="form-control">
                    <option value="">None</option>
                    @foreach($sem as $sems)
                    <option value={{$sems->id}}>{{$sems->description}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                {{ Form::label('name', "GWA", [
                    'class' => 'control-label'
                    ]) 
                }}
                {{ Form::text('strPersGwa', null, [
                    'id' => 'strPersGwa',
                    'class' => 'form-control',
                    'maxlength' => '4',
                    'autocomplete' => 'off',
                    'data-parsley-pattern' => '^[a-zA-Z0-9+-. ]+$'
                    ]) 
                }}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12 row">
            {{ Form::label('strApplPicture', 'Upload Image*', [
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
    <h5>Name three(3) courses you wish to enroll in and the respective school (in order of your preference)</h5>
    <div class="row">
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('school1', "School 1", [
                'class' => 'control-label'
                ]) 
            }}
            <select id="school1" name="school1" class="form-control">
                @foreach($school as $school1)
                <option value={{$school1->id}}>{{$school1->description}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('course1', "Course 1", [
                'class' => 'control-label'
                ]) 
            }}
            <select id="course1" name="course1" class="form-control">
                @foreach ($course as $course1)
                <option value={{$course1->id}}>{{$course1->description}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('school2', "School 2", [
                'class' => 'control-label'
                ]) 
            }}
            <select id="school2" name="school2" class="form-control">
                @foreach($school as $school2)
                <option value={{$school2->id}}>{{$school2->description}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('course2', "Course 2", [
                'class' => 'control-label'
                ]) 
            }}
            <select id="course2" name="course2" class="form-control">
                @foreach ($course as $course2)
                <option value={{$course2->id}}>{{$course2->description}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('school3', "School 3", [
                'class' => 'control-label'
                ]) 
            }}
            <select id="school3" name="school3" class="form-control">
                @foreach($school as $school3)
                <option value={{$school3->id}}>{{$school3->description}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('course3', "Course 3", [
                'class' => 'control-label'
                ]) 
            }}
            <select id="course3" name="course3" class="form-control">
                @foreach ($course as $course3)
                <option value={{$course3->id}}>{{$course3->description}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <hr>
    <h3>Community Involvement/Affiliation</h3>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12">
            {{ Form::label('organization', "Organization", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('strPersOrganization', null, [
                'id' => 'organization',
                'class' => 'form-control',
                'maxlength' => '50',
                'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group col-md-8 col-sm-6">
            {{ Form::label('position', "Position", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('strPersPosition', null, [
                'id' => 'position',
                'class' => 'form-control',
                'maxlength' => '25',
                'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group col-md-4 col-sm-6">
            {{ Form::label('dateofparticipation', "Year of Participation", [
                'class' => 'control-label'
                ]) 
            }}
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{ Form::text('strPersDateParticipation', null, [
                    'id' => 'dateofparticipation',
                    'class' => 'form-control',
                    'minlength' => '4',
                    'maxlength' => '4',
                    'placeholder' => 'YYYY',
                    'data-parsley-type' => 'number',
                    'data-parsley-trigger-after-failure' => "focusout"
                    ]) 
                }}
            </div>
        </div>
    </div>
</div>
<div class="form-section">
    <h3>Short biography: (Answer questions in the form of essay)*</h3>
    <div class="form-group">
      <p>1.  Pangalan, edad, kasarian at pinakahuling paraaralang pinanggalingan, pinagtapusan o kasalukuyang kinabibilangan.</p>
      <p>2.  Ilagay ang kasalukuyang tirahan at mga lugar na tinitirahan sa loob ng 3 taon.</p>
      <p>3.  Pangalan ng magulang o tagapangalaga at kanilang hanapbuhay. Ilagay din ang buwanang kita kung maaari.</p>
      <p>4. Ilang ang mga kapatid na nag- aaral o naghahanapbuhay> pang-ilan ka sa magkakapatid?</p>
      <p>5. Ilahad ang mga kamag-anak na naninilbihan sa pamahalaan. May mga malalapit ka bas a mga kasapi sa mga organisasyon na pang komunidad?</p>
      <p>6. Nakikilahok ka bas a mga usapin at proyekto ng inyong pamayanan? Sa papaanong pamamaraan? Kung hinidi, isalaysay kung bakit.</p>
      <p>7. Isalaysay aang mga suliranin na dinadanas att kasalukuyan hinahanap sa pag-aaral. Papaano mo ito hinaharap?</p>
      <p>8. Ilahad kung paano mo nalaman ang programa ng SYDP. Ano ang mga inaasahan mo hinggil sa programang ito?</p>
      <p>9. Ano ang katangian at kakayahan mo upang maging karapat dapat na mapabilang sa mga “SKOLAR NG BAYAN”?</p>
      <p>10.  Kung sakaling maging benepisyaryo, ano sa palagay moa ng maaari mongmagagawa o maitutulong sa kapwa iskolar at pamahalaang local upang matagumpay ang programa?</p>
      {{ Form::textarea('strPersEssay', null, [
          'class' => 'form-control',
          'id' => 'strPersEssay',
          'style' => 'resize: none; height: 400px;',
          'data-parsley-pattern' => "^[a-zA-Z0-9.,' ]+$",
          'required' => 'required'
          ]) 
      }}
  </div>
  <div class="form-group">
      <p>11.  Katulong ang iyong pamilya, paano mo matitiyan na ikaw ay makakatapos ng iyong pag-aaral?</p>
      <p>12.  Ilarawan sa iyong kaalaman ang kalagayan ng ating lungson sa ngayon</p>
      {{ Form::textarea('strPersEssay2', null, [
          'class' => 'form-control',
          'id' => 'strPersEssay2',
          'style' => 'resize: none; height: 200px;',
          'data-parsley-pattern' => "^[a-zA-Z0-9.,' ]+$",
          'required' => 'required'
          ]) 
      }}
  </div>
</div>
<div class="form-section">
    <div id="summary">
    </div>
    {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['type' => 'submit' ,'class' => 'btn btn-success pull-right btn-submit']) }}
</div>
<div class="form-navigation">
    {{ Form::button('&lt; Previous', ['class' => 'previous navigation btn btn-info pull-left', 'style' => 'whitespace: nowrap;']) }}
    {{ Form::button('Next &gt;', ['class' => 'next navigation btn btn-info pull-right', 'id' => 'btn-next']) }}
    <span class="clearfix"></span>
</div>
{{ Form::close() }}
<div class="modal fade" id="details_grade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{ Form::button('&times;', [
                    'class' => 'close',
                    'type' => '',
                    'data-dismiss' => 'modal'
                    ]) 
                }}
                <h4>Grade Details</h4>
            </div>
            <div class="modal-body">
                <div id="details_system">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="grade_input">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{ Form::button('&times;', [
                    'class' => 'close',
                    'type' => '',
                    'data-dismiss' => 'modal'
                    ]) 
                }}
                <h4>Grade Input</h4>
            </div>
            <div class="modal-body" id="details">
                {{ Form::open([
                    'id' => 'frmGrade',
                    'data-parsley-errors-messages-disabled' => '',
                    'data-parsley-whitespace' => 'squish'])
                }}
                <div class="form-group">
                    {{ Form::label('name', 'Subject Code') }}
                    {{ Form::text('strStudSubjCode', null, [
                        'id' => 'strStudSubjCode',
                        'class' => 'form-control',
                        'maxlength' => '10',
                        'required' => 'required',
                        'data-parsley-pattern' => '^[a-zA-Z0-9 ]+$',
                        'autocomplete' => 'off'
                        ]) 
                    }}
                </div>
                <div class="form-group">
                    {{ Form::label('name', 'Subject Description') }}
                    {{ Form::text('strStudSubjDesc', null, [
                        'id' => 'strStudSubjDesc',
                        'class' => 'form-control',
                        'maxlength' => '50',
                        'required' => 'required',
                        'data-parsley-pattern' => '^[a-zA-Z0-9 ]+$',
                        'autocomplete' => 'off'
                        ]) 
                    }}
                </div>
                <div class="form-group">
                    {{ Form::label('name', 'Units') }}
                    {{ Form::text('intStudSubjUnit', null, [
                        'id' => 'intStudSubjUnit',
                        'class' => 'form-control',
                        'maxlength' => '1',
                        'required' => 'required',
                        'data-parsley-pattern' => '^[0-9]+$',
                        'autocomplete' => 'off'
                        ]) 
                    }}
                </div>
                <div class="form-group">
                    {{ Form::label('name', 'Grade') }}
                    {{ Form::text('strStudGrade', null, [
                        'id' => 'strStudGrade',
                        'class' => 'form-control',
                        'maxlength' => '4',
                        'required' => 'required',
                        'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$',
                        'autocomplete' => 'off'
                        ]) 
                    }}
                </div>
                <div class="form-group">
                    {{ Form::button('Submit', [
                        'id' => 'btn-grade',
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
</div>
</div>        
</div>
@endsection
@section('endscript')
{!! Html::script("js/jquery.backstretch.min.js") !!} 
{!! Html::script("js/retina-1.1.0.min.js") !!} 
{!! Html::script("plugins/datepicker/bootstrap-datepicker.js") !!}
{!! Html::script("plugins/datatables/jquery.dataTables.min.js") !!}
{!! Html::script("plugins/datatables/dataTables.bootstrap.min.js") !!}
{!! Html::script("plugins/iCheck/icheck.min.js") !!}
{!! Html::script("js/parsley.min.js") !!}  
{!! Html::script("js/bootstrap-notify.min.js") !!} 
{!! Html::script("plugins/sweetalert/sweetalert.min.js") !!}
{!! Html::script("custom/ApplyAjax.min.js") !!}
@endsection
