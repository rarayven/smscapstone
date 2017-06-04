$(document).ajaxError(function(event, jqxhr, settings, exception) {
	if (exception == 'Unauthorized') {
		swal({
			title: "Session Expired!",
			type: "warning",
			text: "<center>Please login again.</center>",
			html: true,
			confirmButtonClass: "btn-success",
			confirmButtonText: "Login",
			closeOnConfirm: true,
			allowOutsideClick: false
		},
		function(isConfirm) {
			if (isConfirm) {
				location.reload();
			}
		});
	}
});