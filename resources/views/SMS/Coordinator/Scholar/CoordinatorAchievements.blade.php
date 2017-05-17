@extends('SMS.Coordinator.CoordinatorMain')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Student Achievements
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/index') }}"><i class="fa fa-dashboard"></i> Coordinator</a></li>
      <li class="active">Student Achievements</li>
    </ol>
  </section>
  <section class="content">
    <div class="box box-danger">
      <div class="row">
        <div class="box-body table-responsive">
          <table class="table table-hover">
            <thead>
              <th> Student</th>
              <th>Achievement</th>
              <th>Date</th>
              <th>Action</th>
            </thead>

            <div class="row">
              <tr>
                <td>
                  <div class="col-md-2"><img src="{{ asset('img/user3-128x128.jpg') }}" class="img-circle" alt="User Image" height="20">
                  </div>
                  Rayven Lorenzana
                </td>
                <td>Dean's Lister</td>
                <td>March 23, 2016</td>
                <td>
                  <button class="btn btn-primary btn-sm btn-primary" value=""><i class="fa fa-eye"></i> View Details</button>
                  <button class="btn btn-success btn-sm btn-Success" value=""><i class="fa fa-check"></i> Accept</button>
                  <button class="btn btn-danger btn-sm btn-delete" value=""><i class="fa fa-remove"></i> Remove</button>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="col-md-2"><img src="{{ asset('img/user4-128x128.jpg') }}" class="img-circle" alt="User Image" height="20">
                  </div>
                  Juan Santos
                </td>
                <td>First Place sa Puso ko</td>
                <td>Always</td>
                <td>
                    <button class="btn btn-primary btn-sm btn-primary" value=""><i class="fa fa-eye"></i> View Details</button>
                    <button class="btn btn-success btn-sm btn-Success" value=""><i class="fa fa-check"></i> Accept</button>
                    <button class="btn btn-danger btn-sm btn-delete" value=""><i class="fa fa-remove"></i> Remove</button>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="col-md-2"><img src="{{ asset('img/user1-128x128.jpg') }}" class="img-circle" alt="User Image" height="20">
                  </div>
                  Rekayne Frahght
                </td>
                <td>Kumain ng Bubog</td>
                <td>December 31, 2014</td>
                <td>
                    <button class="btn btn-primary btn-sm btn-primary" value=""><i class="fa fa-eye"></i> View Details</button>
                    <button class="btn btn-success btn-sm btn-Success" value=""><i class="fa fa-check"></i> Accept</button>
                    <button class="btn btn-danger btn-sm btn-delete" value=""><i class="fa fa-remove"></i> Remove</button>
                </td>
              </tr>
            </div>


          </table>
        </div>
      </div>
    </div>
  </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
