$(document).ready(function() {
	$('.editminfo').on('click', '.btn-default', function(e) {
		e.preventDefault();
		$('#motherfname').removeAttr('readonly').val(null);
		$('#motherlname').removeAttr('readonly').val(null);
		$('#mothercitizen').removeAttr('readonly').val(null);
		$('#motherhea').removeAttr('readonly').val(null);
		$('.editminfo').empty().append("<button class='btn btn-success btn-xs pull-right' value='frmminfo'><i class='fa fa-save'></i></button>");
	});
	$('.editmoccu').on('click', '.btn-default', function(e) {
		e.preventDefault();
		$('#motheroccupation').removeAttr('readonly').val(null);
		$('#motherincome').removeAttr('disabled');
		$('.editmoccu').empty().append("<button class='btn btn-success btn-xs pull-right' value='frmmoccu'><i class='fa fa-save'></i></button>");
	});
	$('.editfinfo').on('click', '.btn-default', function(e) {
		e.preventDefault();
		$('#fatherfname').removeAttr('readonly').val(null);
		$('#fatherlname').removeAttr('readonly').val(null);
		$('#fathercitizen').removeAttr('readonly').val(null);
		$('#fatherhea').removeAttr('readonly').val(null);
		$('.editfinfo').empty().append("<button class='btn btn-success btn-xs pull-right' value='frmfinfo'><i class='fa fa-save'></i></button>");
	});
	$('.editfoccu').on('click', '.btn-default', function(e) {
		e.preventDefault();
		$('#fatheroccupation').removeAttr('readonly').val(null);
		$('#fatherincome').removeAttr('disabled');
		$('.editfoccu').empty().append("<button class='btn btn-success btn-xs pull-right' value='frmfoccu'><i class='fa fa-save'></i></button>");
	});
	$('.editno').on('click', '.btn-default', function(e) {
		e.preventDefault();
		$('#brono').removeAttr('readonly').val(null);
		$('#sisno').removeAttr('readonly').val(null);
		$('.editno').empty().append("<button class='btn btn-success btn-xs pull-right' value='frmno'><i class='fa fa-save'></i></button>");
	});
	$('.editbday').on('click', '.btn-default', function(e) {
		e.preventDefault();
		$('#birthday').removeAttr('readonly').val(null);
		$('.editbday').empty().append("<button class='btn btn-success btn-xs pull-right' value='frmbday'><i class='fa fa-save'></i></button>");
	});
	$(".editbday").on('click', '.btn-success', function(e) {
		formData = $('#' + $(this).val()).serialize();
		if ($('#' + $(this).val()).parsley().isValid()) {
			e.preventDefault();
			call(urlbirthday, formData);
		}
	});
	$(".editminfo").on('click', '.btn-success', function(e) {
		formData = $('#' + $(this).val()).serialize();
		if ($('#' + $(this).val()).parsley().isValid()) {
			e.preventDefault();
			call(urlminfo, formData);
		}
	});
	$(".editmoccu").on('click', '.btn-success', function(e) {
		formData = $('#' + $(this).val()).serialize();
		if ($('#' + $(this).val()).parsley().isValid()) {
			e.preventDefault();
			call(urlmoccu, formData);
		}
	});
	$(".editfinfo").on('click', '.btn-success', function(e) {
		formData = $('#' + $(this).val()).serialize();
		if ($('#' + $(this).val()).parsley().isValid()) {
			e.preventDefault();
			call(urlfinfo, formData);
		}
	});
	$(".editfoccu").on('click', '.btn-success', function(e) {
		formData = $('#' + $(this).val()).serialize();
		if ($('#' + $(this).val()).parsley().isValid()) {
			e.preventDefault();
			call(urlfoccu, formData);
		}
	});
	$(".editno").on('click', '.btn-success', function(e) {
		formData = $('#' + $(this).val()).serialize();
		if ($('#' + $(this).val()).parsley().isValid()) {
			e.preventDefault();
			call(urlsiblings, formData);
		}
	});
	function refresh(){
		swal({
			title: "Success!",
			text: "<center>Data Save</center>",
			type: "success",
			timer: 1000,
			showConfirmButton: false,
			html: true
		});
		location.reload();
	}
	function error(data){
		$.notify({
			icon: 'fa fa-warning',
			message: data.responseText.replace(/['"]+/g, '')
		}, {
			type: 'warning',
			z_index: 2000,
			delay: 5000,
		});
	}
	function call(my_url, formData) {
		$.ajax({
			type: "POST",
			url: my_url,
			data: formData,
			dataType: 'json',
			success: function(data) {
				refresh();
			},
			error: function(data) {
				error(data);
			}
		});
	}
	var dt = new Date();
	dt.setFullYear(new Date().getFullYear() - 18);
	$('#birthday').datepicker({
		viewMode: "years",
		endDate: dt,
		autoclose: true,
		format: 'yyyy-mm-dd'
	});
});