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
      <div class="box-body table-responsive">
        <table id="achievement-table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
          <thead>
            <th>Student</th>
            <th>Achievement</th>
            <th>Date Held</th>
            <th>Action</th>
          </thead>
          <tbody id="district-list">
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
@section('script')
{!! Html::script("custom/TokenAjax.js") !!}
<script type="text/javascript">
  var dataurl = "{!! route('token.data') !!}";
</script>
@endsection
