$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var url = "/admin/users";
	var url2 = "/admin/users/checkbox";
	var table = $('#users-table').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: dataurl,
		"columnDefs": [
		{ "width": "70px", "targets": 4 },
		{ "width": "70px", "targets": 3 }
		],
		columns: [
		{data: 'strUserName', name: 'strUserName'},
		{data: 'email', name: 'email'},
		{data: 'last_login', name: 'last_login'},
		{data: 'type', name: 'type'},
		{data: 'is_active', name: 'is_active', searchable: false},
		{data: 'action', name: 'action', orderable: false, searchable: false}
		]
	});
	$('#users-list').on('change', '#isActive',function(){ 
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
	//delete task and remove it from list
	$('#users-list').on('click', '.btn-delete',function(){  
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
										text: "<center>"+data[1].last_name+" is in use</center>",
										type: "error",
										showConfirmButton: false,
										allowOutsideClick: true,
										html: true
									});
								}else{
									table.draw();
									swal({
										title: "Deleted!",
										text: "<center>"+data.last_name+" is Deleted</center>",
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
});