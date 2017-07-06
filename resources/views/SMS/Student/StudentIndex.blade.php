@extends('SMS.Student.StudentMain')
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Claimed Stipend</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table no-margin">
								<thead>
									<tr>
										<th>Name</th>
										<th>Status</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($allocation as $allocations)
									<tr>
										<td>{{ $allocations->description }}</td>
										<td><span id="claim{{ $allocations->id }}" class="label label-warning"></span></td>
										<td>{{ $allocations->amount }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection