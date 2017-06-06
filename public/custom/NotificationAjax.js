$(document).ready(function() {
	Pace.on('done', function() {
		$("link[rel=stylesheet][href='" + url + "/plugins/pace/pace.min.css']").remove();
		$("script[src='" + url + "/plugins/pace/pace.min.js']").remove();
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
