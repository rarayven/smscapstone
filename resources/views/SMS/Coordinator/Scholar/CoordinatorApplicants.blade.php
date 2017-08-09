  @extends('SMS.Coordinator.CoordinatorMain')
  @section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Applications
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-users"></i> Applications</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="container col-sm-12">
          <div class="box box-danger">
            <div class="box-body table-responsive">
              <table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                <thead>
                  <th>ID</th>
                  <th>Student</th>
                  <th>School</th>
                  <th>Course</th>
                  <th>Date Applied</th>
                  <th>Action</th>
                </thead>
                <tbody id="list">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
    @endsection
    @section('script')
    <script type="text/javascript">
      var dataurl = "{!! route('applications.data') !!}";
      @if (Session::has('success'))
      swal({
        title: "Success!",
        text: "<center>{{Session::get('success')}}</center>",
        type: "success",
        timer: 1000,
        showConfirmButton: false,
        html: true
      });
      @elseif (Session::has('fail'))
      swal({
        title: "Failed!",
        text: "<center>{{Session::get('fail')}}</center>",
        type: "error",
        confirmButtonClass: "btn-success",
        showConfirmButton: true,
        html: true
      });
      @endif
      var table = $('#table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: dataurl,
        "order": [4, 'asc'],
        "columnDefs": [
        { "width": "70px", "targets": 5 }
        ],
        columns: [
        { data: 'id', name: 'users.id' },
        { data: 'strUserName', name: 'strUserName' },
        { data: 'description', name: 'schools.description' },
        { data: 'courses_description', name: 'courses.description' },
        { data: 'application_date', name: 'student_details.application_date', searchable: false },
        { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
      });
    </script>
    @endsection