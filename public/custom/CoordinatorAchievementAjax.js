$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#district-list').on('click', '.open-modal', function() {
		var link_id = $(this).val();
		swal({
			title: "Are you sure?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-success",
			confirmButtonText: "Accept",
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
						url: dataurl + '/' + link_id,
						type: "PUT",
						success: function(data) {
							if (data == "Deleted") {
								refresh();
							} else {
								var btn = "<div id=dp" + data.id + "><button class='btn btn-warning btn-xs back' value=" +
								data.id + "><i class='fa fa-undo'></i> Undo</button></div>";
								$('#dp' + data.id).replaceWith(btn);
								swal({
									title: "Accepted!",
									text: "<center>" + data.description + " is Accepted</center>",
									type: "success",
									timer: 1000,
									showConfirmButton: false,
									html: true
								});
							}
						},
						error: function(data) {
						}
					});
				}
			}, 500);
		});
	});
	$('#district-list').on('click', '.btn-delete', function() {
		var link_id = $(this).val();
		swal({
			title: "Are you sure?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Decline",
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
						url: dataurl + '/' + link_id,
						type: "DELETE",
						success: function(data) {
							if (data == "Deleted") {
								refresh();
							} else {
								var btn = "<div id=dp" + data.id + "><button class='btn btn-warning btn-xs back' value=" +
								data.id + "><i class='fa fa-undo'></i> Undo</button></div>";
								$('#dp' + data.id).replaceWith(btn);
								swal({
									title: "Declined!",
									text: "<center>" + data.description + " is Declined</center>",
									type: "success",
									timer: 1000,
									showConfirmButton: false,
									html: true
								});
							}
						},
						error: function(data) {
						}
					});
				}
			}, 500);
		});
	});
	$('#district-list').on('click', '.back', function() {
		var link_id = $(this).val();
		var id = $(this).attr('id');
		swal({
			title: "Are you sure?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Undo",
			cancelButtonText: "Cancel",
			closeOnConfirm: false,
			allowOutsideClick: true,
			showLoaderOnConfirm: true,
			closeOnCancel: true
		},
		function(isConfirm) {
			setTimeout(function() {
				if (isConfirm) {
					$.get(dataurl + '/' + link_id + '/edit', function(data) {
						var btn = "<div id=dp" + data.id + "><button class='btn btn-info btn-xs btn-view' value=" + data.id + "><i class='fa fa-eye'></i> View</button> <button class='btn btn-success btn-xs btn-detail open-modal' value=" + data.id + "><i class='fa fa-check'></i> Accept</button> <button class='btn btn-danger btn-xs btn-delete' value=" + data.id + "><i class='fa fa-trash-o'></i> Decline</button></div>";
						$('#dp' + data.id).replaceWith(btn);
						swal({
							title: "Undo!",
							text: "<center>" + data.description + " is Undo</center>",
							type: "success",
							timer: 1000,
							showConfirmButton: false,
							html: true
						});
					})
				}
			}, 500);
		});
	});
	var dataurl = "/coordinator/achievements";
	var table = $('#achievement-table').DataTable({
		processing: true,
		serverSide: true,
		"columnDefs": [
		{ "width": "200px", "targets": 4 },
		{ "width": "150px", "targets": 3 }
		],
		ajax: {
			type: 'POST',
			url: dataurl,
			data: function(d) {
				d.strUserFirstName = $('#strUserFirstName').val(),
				d.strUserMiddleName = $('#strUserMiddleName').val(),
				d.strUserLastName = $('#strUserLastName').val(),
				d.intDistID = $('#intDistID').val(),
				d.intCounID = $('#intCounID').val(),
				d.intBaraID = $('#intBaraID').val(),
				d.intBatcID = $('#intBatcID').val(),
				d.strPersStreet = $('#strPersStreet').val(),
				d.strPersReligion = $('#strPersReligion').val()
			}
		},
		columns: [
		{ data: 'strStudName', name: 'strStudName' },
		{ data: 'description', name: 'achievements.description' },
		{ data: 'place_held', name: 'achievements.place_held' },
		{ data: 'date_held', name: 'achievements.date_held' },
		{ data: 'action', name: 'action', orderable: false, searchable: false }
		]
	});
	$('#btn-advSearch').on('click', function(e) {
		table.draw();
		e.preventDefault();
		$('#frmAdv').trigger("reset");
		$('#advanced_search').modal('hide')
	});
	$('#advanced_search').on('hide.bs.modal', function() {
		$('#frmAdv').trigger("reset");
	});
	$('#advsearch').click(function() {
		$('#advanced_search').modal('show');
	});
});
