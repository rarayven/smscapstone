$(document).ready(function() {
	$('.btn-detail').click(function() {
		$('#frmApplicants').trigger("reset");
		$('#show_detail').modal('show');
	});
	$('.btn-block').click(function() {
		$('#1').remove();
		$('#show_detail').modal('show');
	});
});
