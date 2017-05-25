@extends('SMS.Coordinator.CoordinatorMain')
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
      <li><a href="{{ url('coordinator/index') }}"><i class="fa fa-dashboard"></i> Coordinator</a></li>
      <li class="active">Account Settings</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-danger">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/'.Auth::user()->picture) }}" alt="User profile picture">
            <h3 class="profile-username text-center">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
            <a href="#" class="btn btn-default btn-block"><b>Change Profile Photo</b></a>
          </div>
          <!-- /.box-body -->
        </div>
        <div class="box box-danger">
          <div class="box-body box-profile">
            <h4>Edit Slots</h4>
            <input type="text" class="form-control" placeholder="Total Number of Slots">
            <!-- /.box-body -->
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Edit User Information</h3>
          </div>
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="firstName" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="firstName" placeholder="First Name">
                </div>
              </div>
              <div class="form-group">
                <label for="firstName" class="col-sm-2 control-label">Middle Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="firstName" placeholder="First Name">
                </div>
              </div>
              <div class="form-group">
                <label for="lastName" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Mobile</label>
                <div class="col-sm-10">
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
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection