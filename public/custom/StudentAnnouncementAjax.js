$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var url2 = '/student/announcements/checkbox';
	$('.timeline-item').on('click','.btn-box-tool', function(){
		Pace.restart();
		var link_id = $(this).val();
		$.ajax({
			url: url2 + '/' + link_id,
			type: "PUT",
			success: function(data) {
				if (data.is_read == 0) {
					$('.btn-box-tool').attr('title', 'Mark as Read').tooltip('fixTitle').tooltip('show');
				} else {
					$('.btn-box-tool').attr('title', 'Mark as Unread').tooltip('fixTitle').tooltip('show');
				}
				$('.btn-box-tool').blur();
			},
			error: function(data) {
				console.log(url + '/' + link_id);
				console.log('Error:', data);
			}
		});
	});
});