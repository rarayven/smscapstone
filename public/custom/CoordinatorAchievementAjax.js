$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	})
	$('#district-list').on('click', '.open-modal',function(){ 
		if (confirm("Are you sure?")) {
			var link_id = $(this).val();
			$.ajax({
				url: dataurl + '/' + link_id,
				type: "PUT",
				success: function (data) {
					console.log(data);
					if(data=="Deleted"){
						refresh();
					}else{
						var btn = "<div id=dp"+data.id+"><button class='btn btn-warning btn-xs back' value="+
						data.id+"><i class='fa fa-undo'></i> Undo</button></div>";
						$('#dp'+data.id).replaceWith(btn);
					}
				},
				error: function (data) {
					console.log(url + '/' + link_id);
					console.log('Error:', data);
				}
			});
		}
	});
	$('#district-list').on('click', '.btn-delete',function(){  
		var link_id = $(this).val();
		if (confirm("Are you Sure?")) {
			$.ajax({
				url: dataurl + '/' + link_id,
				type: "DELETE",
				success: function (data) {
					console.log(data);
					if(data=="Deleted"){
						refresh();
					}else{
						var btn = "<div id=dp"+data.id+"><button class='btn btn-warning btn-xs back' value="+
						data.id+"><i class='fa fa-undo'></i> Undo</button></div>";
						$('#dp'+data.id).replaceWith(btn);
					}
				},
				error: function (data) {
					console.log(data);
				}
			});
		}
	});
	$('#district-list').on('click', '.back',function(){
		var link_id = $(this).val();
		var id = $(this).attr('id');
		if(confirm("Are you sure you want to proceed?")){
			$.get(dataurl + '/' + link_id + '/edit' , function (data) {
				console.log(data);
				var btn = "<div id=dp"+data.id+"><button class='btn btn-info btn-xs btn-view' value="+data.id+"><i class='fa fa-eye'></i> View</button> <button class='btn btn-success btn-xs btn-detail open-modal' value="+data.id+"><i class='fa fa-check'></i> Accept</button> <button class='btn btn-danger btn-xs btn-delete' value="+data.id+"><i class='fa fa-trash-o'></i> Decline</button></div>";
				$('#dp'+data.id).replaceWith(btn);
			})
		}
	});
	var dataurl = "/coordinator/scholar/achievements";
	var table = $('#achievement-table').DataTable({
		processing: true,
		serverSide: true,
		"columnDefs": [
		{ "width": "200px", "targets": 3 },
		{ "width": "70px", "targets": 2 }
		],
		ajax: {
			type: 'POST',
			url: dataurl,
			data: function (d) {
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
		{data: 'strStudName', name: 'strStudName'},
		{data: 'description', name: 'achievements.description'},
		{data: 'date_held', name: 'achievements.date_held'},
		{data: 'action', name: 'action', orderable: false, searchable: false}
		]
	});
	$('#btn-advSearch').on('click', function(e) {
		table.draw();
		e.preventDefault();
		$('#frmAdv').trigger("reset");
		$('#advanced_search').modal('hide')
	});
	$('#advanced_search').on('hide.bs.modal', function(){
		$('#frmAdv').trigger("reset");
	});
	$('#advsearch').click(function(){
		$('#advanced_search').modal('show');
	});
});