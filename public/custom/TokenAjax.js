$(document).ready(function(){
	var table = $('#achievement-table').DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: dataurl,
		"columnDefs": [
		{ "width": "200px", "targets": 3 },
		{ "width": "70px", "targets": 2 }
		],
		columns: [
		{data: 'strStudName', name: 'strStudName'},
		{data: 'description', name: 'achievements.description'},
		{data: 'date_held', name: 'achievements.date_held'},
		{data: 'action', name: 'action', orderable: false, searchable: false}
		]
	});
});