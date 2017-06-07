@extends('SMS.Student.StudentMain')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Renewal
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('student/index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-refresh"></i> Renewal</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-info"></i> Info</h4>
      You are free to edit your personal and family data in the Account Settings before submitting your renewal form.
    </div>
    <!-- Your Page Content Here -->
    <div class="row">
    <!-------------------profile --------------------------------->    
    <div class="col-md-3">
      <!--YOU CAN EDIT SHIT IN YOUR ACCOUNT SETTINGS -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <!--year accomodated, 4.5 year course, batch, year level, course school -->
          <form role="form" action="" method="post" class="f1">
            <fieldset>
              <div class="form-group">
                <div class="radio">
                  <p>
                    <label>
                      <input type="radio" name="courseYear" id="fourYears" value="fourYears" checked>
                      <strong>Four-Year Course</strong>
                    </label>
                  </p>
                </div>
                <div class="radio">
                  <p>
                    <label>
                      <input type="radio" name="courseYear" id="fiveYears" value="fiveYears">
                      <strong>Five-Year Course</strong>
                    </label>
                  </p>
                </div>
              </div>
              <div class="form-group">
                <label for="firstName" class="col-sm-10">Year Accommodated</label>
                <div class="col-xs-12">
                  <input type="name" class="form-control" id="firstName" placeholder="">
                </div>
              </div>
      <!----4/5 YEAR COURSE--->
      <div class="form-group">
                  <label for="firstName" class="col-sm-10">Batch</label>
                  <div class="col-xs-12">
                    <input type="name" class="form-control" id="firstName" placeholder="">
                  </div>
            </div>
      <div class="form-group">
                  <label for="firstName" class="col-sm-10">Year Level</label>
                  <div class="col-xs-12">
                    <input type="name" class="form-control" id="firstName" placeholder="">
                  </div>
            </div>
      <div class="form-group">
                  <label for="firstName" class="col-sm-10">Course</label>
                  <div class="col-xs-12">
                    <input type="name" class="form-control" id="firstName" placeholder="">
                  </div>
            </div>
      <div class="form-group">
                  <label for="firstName" class="col-sm-10">School</label>
                  <div class="col-xs-12">
                    <input type="name" class="form-control" id="firstName" placeholder="">
                  </div>
            </div>
      </fieldset>
      </form>
        <div class="modal-footer">
        <button type="button" class="btn btn-default btn-block"><strong>Save changes</strong></button>
        </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    <!------------------START TABLE HERE --------------------->
    <!------- SUBJECTS, UNITS, GRADES, TOTAL----------->
    <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Subjects</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Subject Name</th>
                    <th>Units</th>
                    <th>Grades</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>System Analysis and Design</td>
                    <td>3</td>
                    <td>2.25</td>
                    <td>  </td>
                  </tr>
                  <tr>
                    <td>BSIT Elective 1</td>
                    <td>3</td>
                    <td>1.75</td>
                    <td>  </td>
                  </tr>
                  <tr>
                    <td>Introduction to Humanities</td>
                    <td>3</td>
                    <td>1.25</td>
                    <td>  </td>
                  </tr>
                  <tr>
                    <td>Sofware Engineering</td>
                    <td>3</td>
                    <td>2.00</td>
                    <td>  </td>
                  </tr>
                  <tr>
                    <td>Total Quality Management</td>
                    <td>3</td>
                    <td>1.25</td>
                    <td>  </td>
                  </tr>
                  <tr>
                    <td>Web Development</td>
                    <td>3</td>
                    <td>1.00</td>
                    <td>  </td>
                  </tr>
                  <tr>
                    <td>Ecology</td>
                    <td>3</td>
                    <td>1.25</td>
                    <td>  </td>
                  </tr>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>GWA</th>
                      <th>1.35</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.col -->
            <div class="box box-warning">
              <div class="box-header">
                <h3 class="box-title">For Shiftee</h3>
              </div>
              <div class="box-body">
                <form>
                  <fieldset>
                    <div class="form-group">
                      <label for="lastName" class="col-sm-10 control-label">School transferred from</label>
                      <div class="col-sm-12">
                        <input type="name" class="form-control" id="lastName" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lastName" class="col-sm-10 control-label">School transferred to</label>
                      <div class="col-sm-12">
                        <input type="name" class="form-control" id="lastName" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lastName" class="col-sm-10 control-label">Course shifted from</label>
                      <div class="col-sm-12">
                        <input type="name" class="form-control" id="lastName" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lastName" class="col-sm-10 control-label">Course shifted to</label>
                      <div class="col-sm-12">
                        <input type="name" class="form-control" id="lastName" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lastName" class="col-sm-10 control-label">Subject deficiency</label>
                      <div class="col-sm-12">
                        <input type="name" class="form-control" id="lastName" placeholder="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="lastName" class="col-sm-10 control-label">Remaining classcard/s</label>
                      <div class="col-sm-12">
                        <input type="name" class="form-control" id="lastName" placeholder="">
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success">Submit</button>
            </div>
          </div>   
        </div>
      </div>
    </section>
  </div>
  @endsection