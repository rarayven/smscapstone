$(document).ready(function() {
	Pace.on('done', function() {
		$.get(anno, function(data) {
			if (data != 0) {
				$('.panelanno').text('New');
			} else {
				$('.panelanno').text('');
			}
		})
		$.get(event, function(data) {
			if (data != 0) {
				$('.panelevent').text(data);
			} else {
				$('.panelevent').text('');
			}
		})
	});
});
