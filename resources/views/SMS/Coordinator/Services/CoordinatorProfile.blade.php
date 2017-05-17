@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Profile
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/index') }}"><i class="fa fa-dashboard"></i> Coordinator</a></li>
      <li class="active">Profile</li>
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
            <img class="profile-user-img img-responsive img-circle" src="../../LTE/dist/img/user2-160x160.jpg" alt="User profile picture">
            <h3 class="profile-username text-center">Alexander Pierce</h3>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Slots Accommodated</b> <a class="pull-right">95</a>
              </li>
              <li class="list-group-item">
                <b>Total Number of Slots</b> <a class="pull-right">100</a>
              </li>
            </ul>
            <a href="coordinator-settings.html" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-md-8">
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">User Information</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form role="form">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" placeholder="PIERCE, Alexander" disabled>
              </div>
              <div class="form-group">
                <label>Birthdate</label>
                <input type="text" class="form-control" placeholder="January 16 1989" disabled>
              </div>
              <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" class="form-control" placeholder="+63 927 xxx xxx" disabled>
              </div>
              <div class="form-group">
                <label>Contact E-mail</label>
                <input type="text" class="form-control" placeholder="alex.pierce@gmail.com" disabled>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" placeholder="Updated about a month ago" disabled>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @endsection