$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#message').on('hide.bs.modal', function() {
		$('#frmMessage').trigger("reset");
	});
	var messageId = '';
	var a = '';
	$('#list').on('click', '.open-modal', function() {
		var link_id = $(this).val();
		var id = $(this).attr('id');
		a = id;
		messageId = link_id;
		$('#message').modal('show');
	});
	$('#list').on('click', '.btn-delete', function() {
		var link_id = $(this).val();
		if (confirm("Are you Sure?")) {
			$.ajax({
				url: dataurl + '/' + link_id,
				type: "DELETE",
				success: function(data) {
					console.log(data);
					if (data == "Deleted") {
						refresh();
					} else {
						var btn = "<div id=dp" + data.id + "><button class='btn btn-warning btn-xs back' value=" +
						data.id + "><i class='fa fa-undo'></i> Undo</button></div>";
						$('#dp' + data.id).replaceWith(btn);
					}
				},
				error: function(data) {
					console.log(data);
				}
			});
		}
	});
	$('#list').on('click', '.back', function() {
		var link_id = $(this).val();
		var id = $(this).attr('id');
		if (confirm("Are you sure you want to proceed?")) {
			$.get(dataurl + '/' + link_id + '/edit', function(data) {
				console.log(data);
				var btn = "<div id=dp" + data.id + "><button class='btn btn-primary btn-xs btn-view' value=" + data.id + "><i class='fa fa-envelope'></i> Message</button> <button class='btn btn-success btn-xs btn-detail open-modal' value=" + data.id + "><i class='fa fa-share'></i> Receive</button> <button class='btn btn-danger btn-xs btn-delete' value=" + data.id + "><i class='fa fa-remove'></i> Cancel</button></div>";
				$('#dp' + data.id).replaceWith(btn);
			})
		}
	});
	var dataurl = "/coordinator/token";
	var table = $('#achievement-table').DataTable({
		processing: true,
		serverSide: true,
		"columnDefs": [
		{ "width": "270px", "targets": 4 },
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
	$("#btn-message").click(function() {
		$('#frmMessage').parsley().destroy();
		if ($('#frmMessage').parsley().isValid()) {
			$("#btn-message").attr('disabled', 'disabled');
			setTimeout(function() {
				$("#btn-message").removeAttr('disabled');
			}, 1000);
			var formData = {
				title: $('#title').parsley('data-parsley-whitespace', 'squish').getValue(),
				description: $('#description').parsley('data-parsley-whitespace', 'squish').getValue(),
				id: a
			}
			var type = "PUT";
			var my_url = dataurl+'/'+messageId;
			$.ajax({
				type: type,
				url: my_url,
				data: formData,
				dataType: 'json',
				success: function(data) {
					$('#message').modal('hide');
					table.draw();
					swal({
						title: "Success!",
						text: "<center>" + data.title + " is Stored</center>",
						type: "success",
						timer: 1000,
						showConfirmButton: false,
						html: true
					});
				},
				error: function(data) {
					console.log('Error:', data.responseText);
					$.notify({
						message: data.responseText.replace(/['"]+/g, '')
					}, {
						type: 'warning',
						z_index: 2000,
						delay: 5000,
					});
				}
			});
		}
	});
});
