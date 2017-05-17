@extends('SMS.SMSMain')
@section('title')
<title>404 Page Not Found!</title>
@endsection
@section('override')
{!! Html::style("css/stylesheet.css") !!}
{!! Html::style("css/style.css") !!}
@endsection
@section('topcontent')
</ul>
<ul class="nav navbar-nav navbar-right">
  @endsection
  @section('middlecontent')
  <!-- Main content -->
  <section class="content" style="margin-top: 150px">
    <div class="error-page">
      <h2 class="headline text-yellow"> 404</h2>
      <div class="error-content">
        <h3 style="color:white"><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
        <p style="color:white">
          We could not find the page you were looking for.
          Meanwhile, you may <a href="../../index.html">return to dashboard</a> or try using the search form.
        </p>
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
  </section>
  <!-- /.content -->
  @endsection
  @section('endscript')
  <script type="text/javascript">
    $.backstretch("../../img/backgrounds/1apply.jpg");
  </script>
  @endsection