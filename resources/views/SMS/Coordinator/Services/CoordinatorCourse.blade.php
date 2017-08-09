@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Course
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-book"></i> Course</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="container col-sm-12">
        <div class="box box-danger">
          <div class="box-body table-responsive">
            <table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
              <thead>
                <th>Abbreviation</th>
                <th>Course Name</th>
                <th>Status</th>
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
  {!! Html::script("custom/CoordinatorEducationAjax.min.js") !!}
  <script type="text/javascript">
    var url = "/coordinator/course/checkbox";
    var dataurl = "{!! route('coordinatorcourse.data') !!}";
  </script>
  @endsection