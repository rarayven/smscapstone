$(document).ready(function(){
	$('#btn-add').click(function(){
		$('#txt').text('Add Achivement');
		$('#btn-save').val("add");
		$('#frmAchievement').trigger("reset");
		$('#add_achievement').modal('show');
	});
	var url = "/student/achievements";
	var dt = new Date();
	dt.setFullYear(new Date().getFullYear());
	$('#datepicker').datepicker({
		viewMode: "years",
		endDate : dt,
		autoclose: true,
		format : 'yyyy-mm-dd'
	});
	var table = $('#achievement-table').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: dataurl,
		"columnDefs": [
		{ "width": "180px", "targets": 5 },
		{ "width": "70px", "targets": 4 },
		{ "width": "70px", "targets": 3 },
		{ "width": "150px", "targets": 2 }
		],
		columns: [
		{data: 'description', name: 'description'},
		{data: 'place_held', name: 'place_held'},
		{data: 'date_held', name: 'date_held'},
		{data: 'status', name: 'status', searchable: false},
		{data: 'token_process', name: 'token_process', searchable: false},
		{data: 'action', name: 'action', orderable: false, searchable: false}
		]
	});
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	})	
	$('#add_achievement').on('hidden.bs.modal', function(){
		$('#frmAchivement').trigger("reset");
		$('#frmAchivement').parsley().destroy();
	});
	//create new task / update existing task
	xhrPool = [];
	$("#btn-save").click(function () {
		$('#frmAchivement').parsley().destroy();
		if($('#frmAchivement').parsley().isValid())
		{
			$("#btn-save").attr('disabled','disabled');
			setTimeout(function(){
				$("#btn-save").removeAttr('disabled');
			}, 1000);
			// var formData = {
			// 	description: $('#description').parsley('data-parsley-whitespace','squish').getValue(),
			// 	place_held: $('#place_held').parsley('data-parsley-whitespace','squish').getValue(),
			// 	date_held: $('#datepicker').val(),
			// 	pdf: $('input[type=file]').val()
			// }
			var formData = new FormData($('#frmAchivement')[0]);

			var state = $('#btn-save').val();
			var type = "POST"; 
			var my_url = url;
			if (state == "update"){
				type = "PUT";
				my_url += '/' + id;
			}
			$.ajax({
				beforeSend: function (jqXHR, settings) {
					xhrPool.push(jqXHR);
				},
				type: type,
				url: my_url,
				data: formData,
				processData: false,
				dataType: 'json',
				contentType: false,
				success: function (data) {
					$('#add_achievement').modal('hide');
					table.draw();
					swal({
						title: "Success!",
						text: "<center>"+data.description+" is Stored</center>",
						type: "success",
						timer: 1000,
						showConfirmButton: false,
						html: true
					});
				},
				error: function (data) {
					console.log('Error:', data.responseText);
					try{
						$('#description').parsley().removeError('ferror', {updateClass: false});
						$('#description').parsley().addError('ferror', {message: data.responseText, updateClass: false});
					}catch(err){}
					finally{
						$.each(xhrPool, function(idx, jqXHR) {
							jqXHR.abort();
						});
					}
				}
			});
		}
	});
});
