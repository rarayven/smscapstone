$(document).ready(function() {
	var url = "/student/events";
	$('.details').click(function() {
		var link_id = $(this).attr('value');
		$.get(url + '/' + link_id, function(data) {
			if (data == "Deleted") {
				refresh();
			} else {
				var date = new Date(data.date_held);
				var date_held = date.toLocaleString('en-us', { year: 'numeric', month: 'short', day: '2-digit' });
				var time_from = new Date("October 13, 2014 " + data.time_from);
				var time_to = new Date("October 13, 2014 " + data.time_to);
				var modalbody =
				"<div class='col-md-6'><div class='form-group'><label>Event Name:</label><br>" + data.title +
				"</div></div><div class='col-md-6'><div class='form-group'><label>Event Place:</label><br>" + data.place_held +
				"</div></div><div class='col-md-6'><div class='form-group'><label>From:</label><br>" +time_from.toLocaleString('en-us', { hour: '2-digit', minute: '2-digit' }) +
				"</div></div><div class='col-md-6'><div class='form-group'><label>To:</label><br>" +time_to.toLocaleString('en-us', { hour: '2-digit', minute: '2-digit' }) +
				"</div></div><div class='col-md-12'><div class='form-group'><label>Event Date:</label><br>" + date_held +
				"</div></div><div class='col-md-12'><div class='form-group'><label>Description:</label><br>" + data.description+"</div></div>";
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
