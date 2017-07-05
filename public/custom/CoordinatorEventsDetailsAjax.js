$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#table').DataTable();
	$('.toggle').css({
		width: '72px',
		height: '22px'
	});
	var url = '/coordinator/events/attendance/checkbox';
	$('#list').on('change', '#isActive', function() {
		var link_id = $(this).val();
		$.ajax({
			url: url + '/' + link_id,
			type: "PUT",
			success: function(data) {
				Pace.restart();
				if (data == "Deleted") {
					refresh();
				}
			},
			error: function(data) {
			}
		});
	});
});