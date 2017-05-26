$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	})
	var table = $('#table').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: dataurl,
		"columnDefs": [
		{ "width": "130px", "targets": 3 },
		{ "width": "150px", "targets": 2 }
		],
		columns: [
		{data: 'title', name: 'messages.title'},
		{data: 'description', name: 'messages.description'},
		{data: 'date_created', name: 'messages.date_created'},
		{data: 'action', name: 'action', orderable: false, searchable: false}
		]
	});
	$('#list').on('click', '.btn-delete',function(){  
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
										text: "<center>"+data[1].title+" is in use</center>",
										type: "error",
										showConfirmButton: false,
										allowOutsideClick: true,
										html: true
									});
								}else{
									table.draw();
									swal({
										title: "Deleted!",
										text: "<center>"+data.title+" is Deleted</center>",
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