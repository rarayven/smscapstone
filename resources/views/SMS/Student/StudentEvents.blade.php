@extends('SMS.Student.StudentMain')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Upcoming Events
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/index') }}"><i class="fa fa-dashboard"></i> Student</a></li>
      <li class="active">Events</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
    <div class="form-group">
      @foreach ($events as $event)
      <div class="col-md-4">
        <div class="small-box bg-red">
          <div class="box-body">
            <h4><b>{{$event->title}}</b></h4>
            <p>Saturday</p>
            <p>{{$event->date_held}}</p>
            <p>{{$event->time_from}} - {{$event->time_to}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">
            View Event Details <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </section>
  <!-- /.content -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
