$(document).ready(function() {
	Pace.on('done', function() {
		$.get(notif, function(data) {
			if (data != 0) {
				$('.notif').text(data);
				$('.panelnotif').text('New');
			} else {
				$('.notif').text('');
				$('.panelnotif').text('');
			}
		})
	});
});
