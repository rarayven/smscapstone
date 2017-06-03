$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var url = "/admin/district";
	var id='';
	var url2 = "/admin/district/checkbox";
	var table = $('#district-table').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: dataurl,
		"columnDefs": [
		{ "width": "130px", "targets": 2 },
		{ "width": "70px", "targets": 1 }
		],
		columns: [
		{data: 'description', name: 'description'},
		{data: 'is_active', name: 'is_active', searchable: false},
		{data: 'action', name: 'action', orderable: false, searchable: false}
		]
	});
	$('#add_district').on('hide.bs.modal', function(){
		$('#frmDistrict').trigger("reset");
		$('#frmDistrict').parsley().destroy();
	});
	$('#district-list').on('change', '#isActive',function(){ 
		var link_id = $(this).val();
		$.ajax({
			url: url2 + '/' + link_id,
			type: "PUT",
			success: function (data) {
				console.log(data);
				if(data=="Deleted"){
					refresh();
				}
			},
			error: function (data) {
				console.log(url + '/' + link_id);
				console.log('Error:', data);
			}
		});
	});
	function refresh(){
		swal({
			title: "Record Deleted!",
			type: "warning",
			text: "<center>Refresh Records?</center>",
			html: true,
			showCancelButton: true,
			confirmButtonClass: "btn-success",
			confirmButtonText: "Refresh",
			cancelButtonText: "Cancel",
			closeOnConfirm: true,
			allowOutsideClick: true,
			closeOnCancel: true
		},
		function(isConfirm) {
			if (isConfirm) {
				table.draw();
			}
		});
	}
 //display modal form for task editing
 $('#district-list').on('click', '.open-modal',function(){ 
 	var link_id = $(this).val();
 	id = link_id;
 	$.get(url + '/' + link_id + '/edit', function (data) {
 		console.log(data);
 		if(data=="Deleted"){
 			refresh();
 		}else{
 			$('h4').text('Edit District');
 			$('#strDistDesc').val(data.description);
 			$('#btn-save').val("update");
 			$('#add_district').modal('show');
 		}
 	})
 });
//display modal form for creating new task
$('#btn-add').click(function(){
	$('h4').text('Add District');
	$('#btn-save').val("add");
	$('#frmDistrict').trigger("reset");
	$('#add_district').modal('show');
});
//delete task and remove it from list
$('#district-list').on('click', '.btn-delete',function(){  
	var link_id = $(this).val();
	swal({
		title: "Are you sure?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Delete",
		cancelButtonText: "Cancel",
		closeOnConfirm: false,
		allowOutsideClick: true,
		showLoaderOnConfirm: true,
		closeOnCancel: true
	},
	function(isConfirm) {
		setTimeout(function () {
			if (isConfirm) {
				$.ajax({
					url: url + '/' + link_id,
					type: "DELETE",
					success: function (data) {
						console.log(data);
						if(data=="Deleted"){
							refresh();
						}else{
							if(data[0]=="true"){
								swal({
									title: "Failed!",
									text: "<center>"+data[1].description+" is in use</center>",
									type: "error",
									showConfirmButton: false,
									allowOutsideClick: true,
									html: true
								});
							}else{
								table.draw();
								swal({
									title: "Deleted!",
									text: "<center>"+data.description+" is Deleted</center>",
									type: "success",
									timer: 1000,
									showConfirmButton: false,
									html: true
								});
							}
						}
					},
					error: function (data) {
						console.log(data);
					}
				});
			}
		}, 500);
	});
});
$("#btn-save").click(function () {
	$('#frmDistrict').parsley().destroy();
	if($('#frmDistrict').parsley().isValid())
	{
		$("#btn-save").attr('disabled','disabled');
		setTimeout(function(){
			$("#btn-save").removeAttr('disabled');
		}, 1000);
		var formData = {
			strDistDesc: $('#strDistDesc').parsley('data-parsley-whitespace','squish').getValue()
		}
		var state = $('#btn-save').val();
		var type = "POST"; 
		var my_url = url;
		if (state == "update"){
			type = "PUT";
			my_url += '/' + id;
		}
		$.ajax({
			type: type,
			url: my_url,
			data: formData,
			dataType: 'json',
			success: function (data) {
				$('#add_district').modal('hide');
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
				$.notify({
					message: data.responseText 
				},{
					type: 'warning',
					z_index: 2000,
					delay: 5000,
				});
			}
		});
	}
});
});
