$(document).ready(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('.editname').on('click', '.btn-default', function(e) {
		e.preventDefault();
		$('#first_name').removeAttr('readonly').val(null);
		$('#middle_name').removeAttr('readonly').val(null);
		$('#last_name').removeAttr('readonly').val(null);
		$('.editname').empty().append("<button class='btn btn-success btn-xs pull-right' value='frmname'><i class='fa fa-save'></i></button>");
	});
	$('.editcontact').on('click', '.btn-default', function(e) {
		e.preventDefault();
		$('#cell_no').removeAttr('readonly').val(null);
		$('.editcontact').empty().append("<button class='btn btn-success btn-xs pull-right' value='frmcontact'><i class='fa fa-save'></i></button>");
	});
	$('.editemail').on('click', '.btn-default', function(e) {
		e.preventDefault();
		$('#email').removeAttr('readonly').val(null);
		$('.editemail').empty().append("<button class='btn btn-success btn-xs pull-right' value='frmemail'><i class='fa fa-save'></i></button>");
	});
	$('.editpassword').on('click', '.btn-default', function(e) {
		e.preventDefault();
		$('#current').removeAttr('readonly');
		$('#new').removeAttr('readonly');
		$('#confirm').removeAttr('readonly');
		$('.editpassword').empty().append("<button class='btn btn-success btn-xs pull-right' value='frmpasswword'><i class='fa fa-save'></i></button>");
	});
	$("#img").change(function(e){
		e.preventDefault();
		var formData = new FormData($('#frmimage')[0]);
		$.ajax({
			type: 'POST',
			url: urlimage,
			data: formData,
			processData: false,
			dataType: 'json',
			contentType: false,
			success: function(data) {
				refresh();
			},
			error: function(data) {
				error(data);
			}
		});
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
	$(".editname").on('click', '.btn-success', function(e) {
		e.preventDefault();
		formData = $('#' + $(this).val()).serialize();
		if ($('#' + $(this).val()).parsley().isValid()) {
			call(urlname, formData);
		}
	});
	$(".editcontact").on('click', '.btn-success', function(e) {
		e.preventDefault();
		formData = $('#' + $(this).val()).serialize();
		if ($('#' + $(this).val()).parsley().isValid()) {
			call(urlcontact, formData);
		}
	});
	$(".editemail").on('click', '.btn-success', function(e) {
		e.preventDefault();
		formData = $('#' + $(this).val()).serialize();
		if ($('#' + $(this).val()).parsley().isValid()) {
			call(urlemail, formData);
		}
	});
	$(".editpassword").on('click', '.btn-success', function(e) {
		e.preventDefault();
		formData = $('#frmpassword').serialize();
		if ($('#frmpassword').parsley().isValid()) {
			call(urlpassword, formData);
		}
	});
});
