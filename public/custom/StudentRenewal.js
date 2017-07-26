$(document).ready(function() {
	$('.grade').click(function(){
		var show = "<div class='form-group col-md-6'>" +
		$('.subject_description')[0].outerHTML + "</div>" +
		"<div class='form-group col-md-2'>" +
		$('.units')[0].outerHTML + "</div>" +
		"<div class='form-group col-md-4'>" +
		$('.subject_grade')[0].outerHTML + "</div>";
		$('#grade').append(show);
	});
	$('input').iCheck({
		radioClass: 'iradio_flat-red'
	});
	$('input[name="rad"]').on('ifClicked', function(event) {
		if (this.value == "yes") {
			$("#shift").show("slide", { direction: "up" }, 1000);
		} else {
			$("#shift").hide();
		}
	});
	$('.dropdownbox').select2();
	$('.btn-success').on('click', function(e) {
		e.preventDefault();
		swal({
			title: "Are you sure?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-success",
			confirmButtonText: "Apply",
			cancelButtonText: "Cancel",
			closeOnConfirm: false,
			allowOutsideClick: true,
			showLoaderOnConfirm: true,
			closeOnCancel: true
		},
		function(isConfirm) {
			setTimeout(function() {
				if (isConfirm) {
					$('#frm').submit();
				}
			}, 500);
		});
	});
});