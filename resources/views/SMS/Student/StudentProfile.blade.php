@extends('SMS.Student.StudentMain')
@section('content') 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Account Settings
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
      <li class="active">Account Settings</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/'.Auth::user()->picture) }}" alt="User profile picture">
            <h3 class="profile-username text-center">Alexander Pierce</h3>
            <a href="#" class="btn btn-default btn-block"><b>Change Profile Photo</b></a>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit User Information</h3>
          </div>
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-xs-5">
                  <input type="name" class="form-control" id="lastName" placeholder="Last Name">
                </div>
                <div class="col-xs-5">
                  <input type="name" class="form-control" id="firstName" placeholder="First Name">
                </div>
              </div>
              <div class="form-group date">
                <label for="datepicker" class="col-sm-2 control-label">Birthdate</label>
                <div class="col-sm-4">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" placeholder="mm/dd/yyyy">
                  </div> 
                </div>
                <label class="col-sm-1 control-label">Mobile</label>
                <div class="col-sm-5">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control"  id="mobile" placeholder="+63 9xx xxx xxxx">
                  </div> 
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-at"></i>
                    </div>
                    <input type="text" class="form-control"  id="email" placeholder="name@email.com">
                  </div> 
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input type="text" class="form-control"  id="email" placeholder="">
                  </div> 
                </div>    
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-asterisk"></i>
                    </div>
                    <input type="password" class="form-control"  id="password" placeholder="password">
                  </div> 
                </div>
              </div>
            </div>
          </form>
        </div>
        <!------------FAMILEH ------------------------------>
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Family Information:</h4>
            </div>
            <form role="form" action="" method="post" class="f1">
              <fieldset>
                <div class="container col-sm-12">
                  <div class="container col-md-6 col-sm-12">
                    <label class="control-label">Mother's Name</label>
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12">
                        <input type="text" id="motherfname" class="form-control" placeholder="First Name">
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <input type="text" id="motherlname" class="form-control" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Citizenship</label>
                      <input type="text" id="mothercitizen" class="form-control" placeholder="Mother's Citizenship">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Highest Attainment</label>
                      <input type="text" id="motherhea" class="form-control" placeholder="Mother's Highest Educational Attainment">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Occupation</label>
                      <input type="text" id="motheroccupation" class="form-control" placeholder="Mother's Occupation">
                    </div>
                  </div>
                  <div class="container col-md-6 col-sm-12">
                    <label class="control-label">Father's Name</label>
                    <div class="row">
                      <div class="form-group col-md-6 col-sm-12">
                        <input type="text" id="fatherfname" class="form-control" placeholder="First Name">
                      </div>
                      <div class="form-group col-md-6 col-sm-12">
                        <input type="text" id="fatherlname" class="form-control" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Citizenship</label>
                      <input type="text" id="fathercitizen" class="form-control" placeholder="Father's Citizenship">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Highest Attainment</label>
                      <input type="text" id="fatherhea" class="form-control" placeholder="Father's Highest Educational Attainment">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Occupation</label>
                      <input type="text" id="fatheroccupation" class="form-control" placeholder="Father's Occupation">
                    </div>
                  </div>
                  <div class="form-group col-md-6 col-sm-12">
                    <label class="control-label">Number of Brother/s</label>
                    <input type="text" name="intPersBrothers" id="brono" class="form-control" placeholder="Type 0 if None">
                  </div>
                  <div class="form-group col-md-6 col-sm-12">
                    <label class="control-label">Number of Sister/s</label>
                    <input type="text" name="intPersSisters" id="sisno" class="form-control" placeholder="Type 0 if None">
                  </div>
                  <div class="form-group col-md-6 col-sm-12">
                    <label class="control-label">Monthly Income</label>
                    <input type="text" name="intPersSisters" id="sisno" class="form-control" placeholder="">
                  </div>
                  <div class="form-group col-md-6 col-sm-12">
                    <label class="control-label">Monthly Income</label>
                    <input type="text" name="intPersSisters" id="sisno" class="form-control" placeholder="">
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
          <!-----------------------------END OF FAMILEH ----------------> 
          <div class="modal-footer">
            <button type="button" class="btn btn-success">Save changes</button>
          </div>
        </div>
      </div>
      @endsection