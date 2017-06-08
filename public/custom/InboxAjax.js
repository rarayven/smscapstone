$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var table = $('#table').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: dataurl,
		"order": [2, 'desc'],
		"columnDefs": [
		{ "width": "200px", "targets": 5 },
		{ "width": "70px", "targets": 4 },
		{ "width": "150px", "targets": 2 }
		],
		columns: [
		{ data: 'strStudName', name: 'strStudName' },
		{ data: 'title', name: 'messages.title' },
		{ data: 'date_created', name: 'messages.date_created' },
		{ data: 'type', name: 'users.type' },
		{ data: 'is_read', name: 'receivers.is_read', searchable: false },
		{ data: 'action', name: 'action', orderable: false, searchable: false }
		]
	});
	$('#list').on('change', '#isActive', function() {
		var link_id = $(this).val();
		$.ajax({
			url: url2 + '/' + link_id,
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
	$('#list').on('click', '.btn-delete', function() {
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
			setTimeout(function() {
				if (isConfirm) {
					$.ajax({
						url: urldelete + '/' + link_id,
						type: "DELETE",
						success: function(data) {
							if (data == "Deleted") {
								refresh();
							} else {
								if (data[0] == "true") {
									swal({
										title: "Failed!",
										text: "<center>" + data[1].title + " is in use</center>",
										type: "error",
										showConfirmButton: false,
										allowOutsideClick: true,
										html: true
									});
								} else {
									table.draw();
									swal({
										title: "Deleted!",
										text: "<center>" + data.title + " is Deleted</center>",
										type: "success",
										timer: 1000,
										showConfirmButton: false,
										html: true
									});
								}
							}
						},
						error: function(data) {
						}
					});
				}
			}, 500);
		});
	});
});
