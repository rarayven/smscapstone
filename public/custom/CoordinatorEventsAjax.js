$(document).ready(function() {
	$(".timepicker").timepicker({
		showInputs: false
	});
	var id = '';
	var url = "/coordinator/events";
	var url2 = "/coordinator/events/checkbox";
	var dt = new Date();
	dt.setDate(dt.getDate());
	$('#datepicker').datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 3,
		autoclose: true,
		format: 'yyyy-mm-dd',
		startDate: dt
	});
    //display modal form for creating new task
    $('#btn-add').click(function() {
    	$('#txt').text('Add Event');
    	$('#btn-save').val("add");
    	$('#frmEvent').trigger("reset");
    	$('#add_event').modal('show');
    });
    $('#events').on('click', '.open-modal', function() {
    	var link_id = $(this).val();
    	id = link_id;
    	$.get(url + '/' + link_id + '/edit', function(data) {
    		console.log(data);
    		if (data == "Deleted") {
    			refresh();
    		} else {
    			$('#txt').text('Edit Event');
    			$('#frmEvent').trigger("reset");
    			$('#title').val(data.title),
    			$('#place_held').val(data.place_held),
    			$('#time_from').val(data.time_from),
    			$('#time_to').val(data.time_to),
    			$('#datepicker').val(data.date_held),
    			$('#description').val(data.description)
    			$('#btn-save').val("update");
    			$('#add_event').modal('show');
    		}
    	})
    });
    $('#events').on('click', '.small-box-footer', function() {
    	var link_id = $(this).attr('value');
    	getDetails(link_id);
    });
    $('.details').on('click', function() {
    	var link_id = $(this).attr('value');
    	getDetails(link_id);
    });

    function getDetails(link_id) {
    	$.get(url + '/' + link_id, function(data) {
    		if (data == "Deleted") {
    			refresh();
    		} else {
    			console.log(data);
    			$('#details').empty();
    			var modalbody =
    			"<label>Event Name</label><br>" + data.title +
    			"<br><label>Event Place</label><br>" + data.place_held +
    			"<br><label>From</label><br>" + data.time_from +
    			"<br><label>To</label><br>" + data.time_to +
    			"<br><label>Event Date</label><br>" + data.date_held +
    			"<br><label>Description</label><br>" + data.description;
    			$('#details').append(modalbody);
    			$('#details_events').modal('show');
    		}
    	})
    }

    function refresh() {
    	swal({
    		title: "Record Deleted!",
    		type: "warning",
    		text: "<center>Refresh Records?</center>",
    		html: true,
    		showCancelButton: true,
    		confirmButtonClass: "btn-success",
    		confirmButtonText: "Refresh",
    		cancelButtonText: "Cancel",
    		closeOnConfirm: true,
    		allowOutsideClick: true,
    		closeOnCancel: true
    	},
    	function(isConfirm) {
    		if (isConfirm) {
    			getEvent()
    		}
    	});
    }
    $.ajaxSetup({
    	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	}
    });
    $("#btn-save").click(function() {
    	$('#frmEvent').parsley().destroy();
    	if ($('#frmEvent').parsley().isValid()) {
    		$("#btn-save").attr('disabled', 'disabled');
    		setTimeout(function() {
    			$("#btn-save").removeAttr('disabled');
    		}, 1000);
    		var formData = {
    			title: $('#title').val(),
    			place_held: $('#place_held').val(),
    			time_from: $('#time_from').val(),
    			time_to: $('#time_to').val(),
    			date_held: $('#datepicker').val(),
    			description: $('#description').val()
    		}
    		var state = $('#btn-save').val();
    		var type = "POST";
    		var my_url = url;
    		if (state == "update") {
                type = "PUT"; //for updating existing resource
                my_url += '/' + id;
            }
            $.ajax({
            	type: type,
            	url: my_url,
            	data: formData,
            	dataType: 'json',
            	success: function(data) {
            		console.log(data);
            		getEvent();
            	},
            	error: function(data) {
            		console.log('Error:', data.responseText);
                    $.notify({
                        message: data.responseText
                    }, {
                        type: 'warning',
                        z_index: 2000,
                        delay: 5000,
                    });
                }
            });
        }
    });

    function getEvent() {
    	$.get(url + '/create', function(data) {
    		console.log(data);
    		var checked = '';
    		$('#add_event').modal('hide');
    		$('#events').empty();
    		$.each(data, function(index, value) {
    			var day = new Date(value.date_held);
    			var time_from = new Date("October 13, 2014 " + value.time_from);
    			var time_to = new Date("October 13, 2014 " + value.time_to);
    			if (value.status == 'Ongoing') {
    				checked = 'checked';
    			} else {
    				checked = '';
    			}
    			var show = "<div class='col-md-4'>" +
    			"<div class='small-box bg-purple'>" +
    			"<div class='box-body'>" +
    			"<div class='pull-right'>" +
    			"<input type='checkbox' id='isActive' name='isActive' value=" + value.id + " data-toggle='toggle' data-style='android' data-onstyle='success' data-offstyle='danger' data-on='Ongoing' data-off='Cancelled' " + checked + " data-size='mini'> " +
    			"<button class='btn btn-warning btn-xs btn-detail open-modal' value=" + value.id + "><i class='fa fa-edit'></i></button> <button class='btn btn-danger btn-xs btn-delete' value=" + value.id + "><i class='fa fa-times'></i></button>" +
    			"</div>" +
    			"<h4><b>" + value.title + "</b></h4>" +
    			"<p>" + day.toLocaleString('en-us', { weekday: 'long' }) + "</p>" +
    			"<p>" + day.toLocaleString('en-us', { year: 'numeric', month: 'short', day: '2-digit' }) + "</p>" +
    			"<p>" + time_from.toLocaleString('en-us', { hour: '2-digit', minute: '2-digit' }) + " - " + time_to.toLocaleString('en-us', { hour: '2-digit', minute: '2-digit' }) + "</p>" +
    			"</div>" +
    			"<div class='icon'>" +
    			"<i class='ion ion-person-add'></i>" +
    			"</div>" +
    			"<a value=" + value.id + " class='btn small-box-footer'>" +
    			"View Event Details <i class='fa fa-arrow-circle-right'></i>" +
    			"</a>" +
    			"</div>" +
    			"</div>";
    			$('#events').append(show);
    		});

    		$("[data-toggle='toggle']").bootstrapToggle('destroy');
    		$("[data-toggle='toggle']").bootstrapToggle();
    	})
    }
    $('#events').on('click', '.btn-delete', function() {
    	var link_id = $(this).val();
    	swal({
    		title: "Are you sure?",
    		type: "warning",
    		showCancelButton: true,
    		confirmButtonClass: "btn-danger",
    		confirmButtonText: "Delete",
    		cancelButtonText: "Cancel",
    		closeOnConfirm: false,
    		allowOutsideClick: true,
    		showLoaderOnConfirm: true,
    		closeOnCancel: true
    	},
    	function(isConfirm) {
    		setTimeout(function() {
    			if (isConfirm) {
    				$.ajax({
    					url: url + '/' + link_id,
    					type: "DELETE",
    					success: function(data) {
    						console.log(data);
    						if (data == "Deleted") {
    							refresh();
    						} else {
    							if (data[0] == "true") {
    								swal({
    									title: "Failed!",
    									text: "<center>" + data[1].title + " is in use</center>",
    									type: "error",
    									showConfirmButton: false,
    									allowOutsideClick: true,
    									html: true
    								});
    							} else {
    								getEvent();
    								swal({
    									title: "Deleted!",
    									text: "<center>" + data.title + " is Deleted</center>",
    									type: "success",
    									timer: 1000,
    									showConfirmButton: false,
    									html: true
    								});
    							}
    						}
    					},
    					error: function(data) {
    						console.log(data);
    					}
    				});
    			}
    		}, 500);
    	});
    });
    $('#events').on('change', '#isActive', function() {
    	var link_id = $(this).val();
    	$.ajax({
    		url: url2 + '/' + link_id,
    		type: "PUT",
    		success: function(data) {
    			console.log(data);
    			if (data == "Deleted") {
    				refresh();
    			}
    		},
    		error: function(data) {
    			console.log('Error:', data);
    		}
    	});
    });
});
