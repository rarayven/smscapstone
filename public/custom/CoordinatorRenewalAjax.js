$(document).ready(function() {
	var table = $('#table').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: dataurl,
		columns: [
		{ data: 'strStudName', name: 'strStudName' },
		{ data: 'failed', name: 'failed', orderable: false, searchable: false },
		{ data: 'action', name: 'action', orderable: false, searchable: false }
		]
	});
	$('#isActive').change(function(){
		alert($(this).prop('checked'));
		if(!$(this).prop('checked')) {
			$('.callout').removeClass().addClass('callout callout-success');
			$(this).val('off');
		}else {
			$('.callout').removeClass().addClass('callout callout-danger');
			$(this).val('on');
		}
		alert($(this).val());
		console.log($(this));
	});
});