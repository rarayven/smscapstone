$(document).ready(function(){
	$(".timepicker").timepicker({
		showInputs: false
	});
	var dt = new Date();
	dt.setDate(dt.getDate());
	$('#datepicker').datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 3,
		autoclose: true,
		format : 'yyyy-mm-dd',
		startDate: dt
	});
	//display modal form for creating new task
	$('#btn-add').click(function(){
		$('#txt').text('Add Event');
		$('#btn-save').val("add");
		$('#frmEvent').trigger("reset");
		$('#add_event').modal('show');
	});
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	})
	var url = "/coordinator/services/events";
	$("#btn-save").click(function () {
		if($('#frmEvent').parsley().isValid())
		{
			var formData = {
				title: $('#title').val(),
				place_held: $('#place_held').val(),
				time_from: $('#time_from').val(),
				time_to: $('#time_to').val(),
				date_held: $('#datepicker').val(),
				description: $('#description').val()
			}
			var type = "POST";
			var my_url = url;
			$.ajax({
				type: type,
				url: my_url,
				data: formData,
				dataType: 'json',
				success: function (data) {
					console.log(data);
					$.each(data, function(index, value) {
						var show = "<div class='col-md-4'>"+
						"<div class='small-box bg-red'>"+
						"<div class='box-body'>"+
						"<h4><b>"+value.title+"</b></h4>"+
						"<p>Monday</p>"+
						"<p>"+value.date_held+"</p>"+
						"<p>"+value.time_from+" - "+value.time_to+"</p>"+
						"</div>"+
						"<div class='icon'>"+
						"<i class='ion ion-person-add'></i>"+
						"</div>"+
						"<a href='#' class='small-box-footer'>"+
						"View Event Details <i class='fa fa-arrow-circle-right'></i>"+
						"</a>"+
						"</div>"+
						"</div>";
						$('#events').append(show);
					});
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		}
	});
});