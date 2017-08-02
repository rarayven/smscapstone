@extends('SMS.SMSMain')
@section('title')
<title>ScholarMS|Apply Now</title>
@endsection
@section('override')
{!! Html::style("plugins/datepicker/datepicker3.css") !!}
{!! Html::style("plugins/iCheck/flat/red.css") !!}
{!! Html::style("css/parsley.css") !!}
{!! Html::style("plugins/sweetalert/sweetalert.min.css") !!}
{!! Html::style("plugins/select2/select2.min.css") !!}
{!! Html::style("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css") !!}
<style type="text/css">
    .slot {
        opacity: 0.0;
        font-size: 20px;
    }
    .widget-user-header:hover>.slot {
        opacity: 1.0;
    }
    #questionappear, #college { 
        display: none; 
    }
    .text-widget {
        color: white;
    }
    .vertical-line {
        border-right: 1px solid #DDDDDD;
    }
</style>
@endsection
@section('style')
{!! Html::style("css/style.css") !!}
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
                <div class="f1-progress-line" data-now-value="8.33" data-number-of-steps="6" style="width: 8.33%;"></div>
            </div>
            <div class="f1-step active">
                <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                <p>Personal Data</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-black-tie"></i></div>
                <p>Councilor</p>
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
            {{ Form::select('intBaraID', $barangay->pluck('description','id'), null, [
                'id' => 'intBaraID',
                'class' => 'form-control barangay',
                'style' => 'width: 100%'])
            }}
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
                <i class="fa fa-photo"></i> 2x2 Image
                {{ Form::file('strApplPicture', [
                    'required' => 'required'
                    ]) 
                }}
            </div>
        </div>
    </div>
</div>
<div class="form-section">
    <h3>Select Councilor:</h3>
    <div class="form-group row">
        <div id="councilor"></div>
        {{ Form::hidden('intCounID', null, [
            'id' => 'intCounID'
            ])
        }}
    </div>
    {{ Form::hidden('intDistID', null, [
        'id' => 'intDistID'
        ])
    }}
</div>
<div class="form-section">
    <h3>Input Family Info:</h3>
    <div class="row">
        <div class="container col-md-6 col-sm-12 vertical-line">
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
            <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                    {{ Form::label('name', "First Name", [
                        'class' => 'control-label'
                        ]) 
                    }}
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
                    {{ Form::label('name', "Last Name", [
                        'class' => 'control-label'
                        ]) 
                    }}
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
            <div class="row">
                <div class="form-group col-md-6 col-sm-12">
                    {{ Form::label('name', "From", [
                        'class' => 'control-label'
                        ]) 
                    }}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {{ Form::selectYear('strSiblDateFrom', $low->year, $now->year, null, [
                            'id' => 'strSiblDateFrom',
                            'class' => 'form-control',
                            ])
                        }}
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-12">
                    {{ Form::label('name', "To", [
                        'class' => 'control-label'
                        ]) 
                    }}
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {{ Form::selectYear('strSiblDateTo', $low->year, $now->year, null, [
                            'id' => 'strSiblDateTo',
                            'class' => 'form-control',
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
                {{ Form::selectYear('elemenrolled', $low->year, $now->year, null, [
                    'id' => 'elemenrolled',
                    'class' => 'form-control',
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
                {{ Form::selectYear('elemgrad', $low->year, $now->year, null, [
                    'id' => 'elemgrad',
                    'class' => 'form-control',
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
                {{ Form::selectYear('hsenrolled', $low->year, $now->year, null, [
                    'id' => 'hsenrolled',
                    'class' => 'form-control',
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
                {{ Form::selectYear('hsgrad', $low->year, $now->year, null, [
                    'id' => 'hsgrad',
                    'class' => 'form-control',
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
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('name', "School/University Currently Enrolled In", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('intPersCurrentSchool', $school->pluck('description','id'), null, [
                'id' => 'intPersCurrentSchool',
                'class' => 'form-control dropdownbox',
                'style' => 'width: 100%'])
            }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('name', "Current Course", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('intPersCurrentCourse', $course->pluck('description','id'), null, [
                'id' => 'intPersCurrentCourse',
                'class' => 'form-control dropdownbox',
                'style' => 'width: 100%'])
            }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 row" id="college">
            <div class="form-group col-md-6">
                {{ Form::label('name', "Year Level", [
                    'class' => 'control-label'
                    ]) 
                }}
                {{ Form::selectRange('year', 1, $setting->year_count, null, [
                    'id' => 'year',
                    'class' => 'form-control',
                    ])
                }}
            </div>
            <div class="form-group col-md-6">
                {{ Form::label('name', "Semester", [
                    'class' => 'control-label'
                    ]) 
                }}
                {{ Form::selectRange('semester', 1, $setting->semester_count, null, [
                    'id' => 'semester',
                    'class' => 'form-control',
                    ])
                }}
            </div>
        </div>
        <div class="form-group col-md-2">
            <div class="col-sm-12 row">
                {{ Form::label('strApplGrades', 'Upload Grade*', [
                    'class' => 'control-label'
                    ]) 
                }}
            </div>
            <div class="btn btn-default btn-file pdf col-md-12 col-sm-2">
                <i class="fa fa-file-pdf-o"></i> PDF
                {{ Form::file('strApplGrades', [
                    'required' => 'required'
                    ]) 
                }}
            </div>
        </div>
    </div>
    <div id="academic">
        <label class="col-sm-12 row">Input Grade</label>
        <div id="grade" class="row"></div>
        <button type="button" class="btn btn-primary grade"><i class='fa fa-plus'></i> Add</button>
    </div>
    <h5>Name three(3) courses you wish to enroll in and the respective school (in order of your preference)</h5>
    <div class="row">
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('school1', "School 1", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('school[]', $school->pluck('description','id'), null, [
                'id' => 'school1',
                'class' => 'form-control dropdownbox',
                'style' => 'width: 100%'])
            }}
        </div>
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('course1', "Course 1", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('course[]', $course->pluck('description','id'), null, [
                'id' => 'course1',
                'class' => 'form-control dropdownbox',
                'style' => 'width: 100%'])
            }}
        </div>
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('school2', "School 2", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('school[]', $school->pluck('description','id'), null, [
                'id' => 'school2',
                'class' => 'form-control dropdownbox',
                'style' => 'width: 100%'])
            }}
        </div>
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('course2', "Course 2", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('course[]', $course->pluck('description','id'), null, [
                'id' => 'course2',
                'class' => 'form-control dropdownbox',
                'style' => 'width: 100%'])
            }}
        </div>
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('school3', "School 3", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('school[]', $school->pluck('description','id'), null, [
                'id' => 'school3',
                'class' => 'form-control dropdownbox',
                'style' => 'width: 100%'])
            }}
        </div>
        <div class="form-group col-md-6 col-sm-6">
            {{ Form::label('course3', "Course 3", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::select('course[]', $course->pluck('description','id'), null, [
                'id' => 'course3',
                'class' => 'form-control dropdownbox',
                'style' => 'width: 100%'])
            }}
        </div>
    </div>
    <hr>
    <h3>Community Involvement/Affiliation</h3>
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('organization', "Organization", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('strPersOrganization[]', null, [
                'id' => 'organization[]',
                'class' => 'form-control organization',
                'maxlength' => '50',
                'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('position', "Position", [
                'class' => 'control-label'
                ]) 
            }}
            {{ Form::text('strPersPosition[]', null, [
                'id' => 'position[]',
                'class' => 'form-control position',
                'maxlength' => '25',
                'data-parsley-pattern' => '^[a-zA-Z0-9. ]+$'
                ]) 
            }}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('dateofparticipation', "Year of Participation", [
                'class' => 'control-label'
                ]) 
            }}
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{ Form::selectYear('strPersDateParticipation[]', $low->year, $now->year, null, [
                    'id' => 'strPersDateParticipation[]',
                    'class' => 'form-control year',
                    ])
                }}
            </div>
        </div>
    </div>
    <div id="affiliation" class="row"></div>
    <button type="button" class="btn btn-primary affiliation"><i class='fa fa-plus'></i> Add</button>
</div>
<div class="form-section">
    <h3>Sumulat ng sanaysay ayon sa mga sumusunod:</h3>
    <div class="form-group">
        <div class="question"></div>
        {{ Form::textarea('essay', null, [
          'class' => 'form-control textarea',
          'id' => 'essay',
          'style' => 'resize: none; height: 400px; width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;',
          'required' => 'required'
          ]) 
      }}
  </div>
</div>
<div class="form-section">
    <div id="summary"></div>
    {{ Form::button("<i class='fa fa-paper-plane'></i> Submit", ['type' => 'submit' ,'class' => 'btn btn-success pull-right btn-submit']) }}
</div>
<div class="form-navigation">
    {{ Form::button('&lt; Previous', ['class' => 'previous navigation btn btn-info pull-left', 'style' => 'whitespace: nowrap;']) }}
    {{ Form::button('Next &gt;', ['class' => 'next navigation btn btn-info pull-right', 'id' => 'btn-next']) }}
    <span class="clearfix"></span>
</div>
{{ Form::close() }}
</div>
</div>        
</div>
@endsection
@section('endscript')
{!! Html::script("js/jquery.backstretch.min.js") !!} 
{!! Html::script("js/retina-1.1.0.min.js") !!} 
{!! Html::script("plugins/datepicker/bootstrap-datepicker.js") !!}
{!! Html::script("plugins/iCheck/icheck.min.js") !!}
{!! Html::script("js/parsley.min.js") !!}  
{!! Html::script("plugins/sweetalert/sweetalert.min.js") !!}
{!! Html::script("plugins/select2/select2.min.js") !!}
{!! Html::script("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") !!}
{!! Html::script("custom/ApplyAjax.min.js") !!}
<script type="text/javascript">
    $('.textarea').wysihtml5();
    var asset = "{{ asset('images') }}";
</script>
@endsection
