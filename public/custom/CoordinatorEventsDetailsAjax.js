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
		var is_active = 0;
		if ($(this).prop('checked')) {
			var is_active = 1;
		}
		var formData = {
			is_attending: is_active
		}
		$.ajax({
			url: url + '/' + link_id,
			type: "PUT",
			data: formData,
			success: function(data) {
				Pace.restart();
			},
			error: function(data) {
			}
		});
	});
});