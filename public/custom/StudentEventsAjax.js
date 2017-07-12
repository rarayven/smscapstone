$(document).ready(function() {
	var url = "/student/events";
	$('.details').click(function() {
		var link_id = $(this).attr('value');
		$.get(url + '/' + link_id, function(data) {
			if (data == "Deleted") {
				refresh();
			} else {
				var modalbody =
				"<div class='row'><div class='col-md-6'><div class='form-group'><label>Event Name:</label><br>" + data.title +
				"</div></div><div class='col-md-6'><div class='form-group'><label>Event Place:</label><br>" + data.place_held +
				"</div></div><div class='col-md-12'><div class='form-group'><label>Event Date:</label><br>" + data.date +
				"</div></div><div class='col-md-6'><div class='form-group'><label>From:</label><br>" +data.time_f+
				"</div></div><div class='col-md-6'><div class='form-group'><label>To:</label><br>" +data.time_t +
				"</div></div><div class='col-md-12'><div class='form-group'><label>Description:</label><br>" + data.description+"</div></div></div>";
				bootbox.alert({
					title: 'View Event',
					message: modalbody,
					backdrop: true,
					buttons: {
						ok: {
							label: 'Ok',
							className: 'btn-success btn-md'
						}
					}
				});
			}
		})
	});
});
