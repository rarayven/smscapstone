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
		{ "width": "130px", "targets": 4 },
		{ "width": "150px", "targets": 3 }
		],
		columns: [
		{data: 'strStudName', name: 'strStudName'},
		{data: 'title', name: 'messages.title'},
		{data: 'description', name: 'messages.description'},
		{data: 'date_created', name: 'messages.date_created'},
		{data: 'action', name: 'action', orderable: false, searchable: false}
		]
	});
});