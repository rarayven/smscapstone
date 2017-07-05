@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Applicants
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-fw fa-users"></i> Applicants</li>
    </ol>
  </section>
  <section class="content">
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
              <div class="box box-widget widget-user-2" id="{{$users->id}}">
                <div class="widget-user-header bg-green" style="height: 150px;">
                  <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('images/'.$users->picture) }}" alt="User Avatar">
                  </div>
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
</div>
@endsection
@section('script')
{!! Html::script("custom/ApplicantsAjax.min.js") !!}
<script type="text/javascript">
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
</script>
@endsection