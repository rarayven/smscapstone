$(document).ready(function(){
	$('#btn-add').click(function(){
		$('#txt').text('Add Achivement');
		$('#btn-save').val("add");
		$('#frmAchievement').trigger("reset");
		$('#add_achievement').modal('show');
	});
});