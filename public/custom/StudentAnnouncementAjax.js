$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var url2 = '/student/announcements/checkbox';
	$('.btn-box-tool').click(function(){
		Pace.restart();
		var link_id = $(this).val();
		$.ajax({
			url: url2 + '/' + link_id,
			type: "PUT",
			success: function(data) {
				$('#btn-circle'+data.id).removeAttr('class');
				if (data.is_read == 0) {
					$('#btn-circle'+data.id).attr('class', 'fa fa-circle');
				} else {
					$('#btn-circle'+data.id).attr('class', 'fa fa-circle-o');
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