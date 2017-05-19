$(document).ready(function(){
	var table = $('#achievement-table').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: dataurl,
		"columnDefs": [
		{ "width": "200px", "targets": 5 },
		{ "width": "70px", "targets": 4 },
		{ "width": "70px", "targets": 3 }
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
});