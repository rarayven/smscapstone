@extends('SMS.Coordinator.CoordinatorMain')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Budget
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('coordinator/index') }}"><i class="fa fa-dashboard"></i> Coordinator</a></li>
      <li class="active">Budget</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="container col-sm-12">
        <div class="box box-danger">
          <div class="modal fade" id="add_budget">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" data-dismiss="modal">&times;</button>
                  <h4>Add Budget</h4>
                </div>
                <div class="modal-body">
                  <form id="frmBudget" method="POST" data-parsley-validate>
                    <div class="form-group">
                      <label>Coordinator ID (Temporary lang muna to)</label>
                      <input type="number" class="form-control" id="intAlloCoorID" name="intAlloCoorID" required>
                    </div>
                    <div class="form-group">
                      <label>Budget This Semester</label>
                      <input type="number" class="form-control" id="dblAlloBudgetAmount" name="dblAlloBudgetAmount" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label>Budget Per Student</label>
                      <input type="number" class="form-control" id="txtPerStudent" name="" required>
                    </div>
                    <div class="form-group">
                      <label>Slots</label>
                      <input type="number" class="form-control" id="result" name="intAlloSlotsNumber" value="0" placeholder="0" readonly>
                    </div>
                    <div class="form-group">
                      <label>Budget for Stipend (Per Student)</label>
                      <input type="number" class="form-control" id="dblAlloStudAllowance" name="dblAlloStudAllowance" required>
                    </div>
                    <div class="form-group">
                      <label>Budget for Tuition Fee (Per Student)</label>
                      <input type="number" class="form-control" id="dblAlloStudTuition" name="dblAlloStudTuition" readonly required>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <button id="btn-save" class="btn btn-success btn-block">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="box-body table-responsive">
            <button id="btn-add" class="btn btn-primary btn-sm pull-right">Add Budget</button>
            <table class="table table-hover">
              <thead>
                <th>ID</th>
                <th>Budget This Semester</th>
                <th>Slots</th>
                <th>Budget for Stipend</th>
                <th>Budget for Tuition Fee</th>
                <th>Date Inputted</th>
              </thead>
              <tbody id="budget-list">
                @foreach ($allocation as $allocations)
                <tr id="id{{$allocations->intAlloID}}">
                  <td>{{$allocations->intAlloID}}</td>
                  <td>{{$allocations->dblAlloBudgetAmount}}</td>
                  <td>{{$allocations->intAlloSlotsNumber}}</td>
                  <td>{{$allocations->dblAlloStudTuition}}</td>
                  <td>{{$allocations->dblAlloStudAllowance}}</td>
                  <td>{{$allocations->dtmAlloBudgDate}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="text-right">
              {{ $allocation->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@section('script')
{!! Html::script("custom/BudgetAjax.min.js") !!}
@endsection
