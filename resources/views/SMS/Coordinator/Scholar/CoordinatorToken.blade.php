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
                  Riven Pogi
                </td>
                <td>Attended IT Research Forum</td>
                <td>March 6, 2016</td>
                <td>
                  <button class="btn btn-primary btn-sm btn-primary" value=""><i class="fa fa-envelope"></i> Message</button>
                  <button class="btn btn-success btn-sm btn-Success" value=""><i class="fa fa-share"></i> Received</button>
                  <button class="btn btn-danger btn-sm btn-delete" value=""><i class="fa fa-remove"></i> Cancel</button>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="col-md-2"><img src="{{ asset('img/user4-128x128.jpg') }}" class="img-circle" alt="User Image" height="20">
                  </div>
                  Mayellle Santos
                </td>
                <td>Kumain ng Apoy</td>
                <td>Last Night</td>
                <td>
                  <button class="btn btn-primary btn-sm btn-primary" value=""><i class="fa fa-envelope"></i> Message</button>
                  <button class="btn btn-success btn-sm btn-Success" value=""><i class="fa fa-share"></i> Received</button>
                  <button class="btn btn-danger btn-sm btn-delete" value=""><i class="fa fa-remove"></i> Cancel</button>
              </tr>

              <tr>
                <td>
                  <div class="col-md-2"><img src="{{ asset('img/user1-128x128.jpg') }}" class="img-circle" alt="User Image" height="20">
                  </div>
                  Hatjib Ismail
                </td>
                <td>Kumain ng Porky</td>
                <td>December 25, 2014</td>
                <td>
                    <button class="btn btn-primary btn-sm btn-primary" value=""><i class="fa fa-envelope"></i> Message</button>
                    <button class="btn btn-success btn-sm btn-Success" value=""><i class="fa fa-share"></i> Received</button>
                    <button class="btn btn-danger btn-sm btn-delete" value=""><i class="fa fa-remove"></i> Cancel</button>
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
