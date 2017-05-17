@extends('SMS.SMSMain')
@section('title')
<title>Fill Up Registration</title>
{!! Html::style("LTE/assets/css/style2.css") !!}
@endsection
@section('topcontent')
<li><a href="#">Home</a></li>
<li><a href="#">About Us</a></li>
<li><a href="#">Requirements</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li><a href="#">Log-In</a></li>
    @endsection
    @section('middlecontent')
    <!-- Top content -->
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-10 col-lg-offset-1 form-box">
                <fieldset>
                    <form role="form" action="" method="post" class="f1">
                        <div id="top">
                            <h3>Register Now</h3>
                            <p>Coordinator's Registration</p>
                        </div>
                        <hr>
                        <div class="container col-sm-12">
                            <div id="mid" class="form-group">
                                <label for="Councilor" class="control-label">Select Councilor</label>
                                <select id="coordinator" name="intUserCounID" class="form-control">
                                    @foreach($councilor as $councilor)
                                    <option value={{$councilor->intCounID}}>{{$councilor->strCounLastName }},
                                        {{$councilor->strCounFirstName }}
                                        {{$councilor->strCounMiddleName }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="mid" class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label" for="fname" >First Name</label>
                                    <input id="fname" type="text" name="strUserFirstName" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="mname" class="control-label">Middle Name</label>
                                    <input id="lname" type="text" name="strUserMiddleName" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lname" class="control-label">Last Name</label>
                                    <input id="lname" type="text" name="strUserLastName" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email" class="control-label">Email Address</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <input id="email" type="text" name="strUserEmail" class="form-control" data-toggle="tooltip" title="Important" data-placement="right">
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="mobileno" class="control-label">Mobile Number</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" name="strUserCell" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="Username" class="control-label">Username</label>
                                    <input id="Username" name="strUserUserName" type="text" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="Password" class="control-label">Password</label>
                                    <input id="Password" name="strUserPassword" type="password" class="form-control">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                </div>
                            </div>
                        </div>
                        <div class="f1-buttons">
                            <button type="submit" class="btn btn-submit">Submit</button>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>        
    </div>
    @endsection
    @section('endscript')
    <script src="../../LTE/assets/js/scripts.js"></script>
    @endsection