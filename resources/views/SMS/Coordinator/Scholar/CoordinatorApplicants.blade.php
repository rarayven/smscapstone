@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Applicants
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/index') }}"><i class="fa fa-dashboard"></i> Coordinator</a></li>
      <li class="active">Applicants</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Your Page Content Here -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Filtered</a></li>
        <li><a href="#tab_2" data-toggle="tab">Unfiltered</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active row" id="tab_1">
          <div id="events">
            @foreach ($users as $users)
            <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2" id="{{$users->id}}">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header" style="height: 150px;">
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('images/'.$users->picture) }}" alt="User Avatar">
                  </div>
                  <!-- /.widget-user-image -->
                  <h3 class="widget-user-username">{{$users->last_name}}, {{$users->first_name}} {{$users->middle_name}}</h3>
                </div>
                <div class="small-box bg-green">
                  <a href="{{route('details.show',$users->id)}}" class="small-box-footer btn-detail">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <div class="tab-pane row" id="tab_2">
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('meta')
<meta name="_token" content="{!! csrf_token() !!}" />
@endsection
@section('script')
{!! Html::script("custom/ApplicantsAjax.js") !!}
@endsection