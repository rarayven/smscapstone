$(document).ready(function(){
	var url = "/student/events";
	$('.details').click(function(){ 
		var link_id = $(this).attr('value');
		getDetails(link_id);
	});
	function getDetails(link_id){
		$.get(url + '/' + link_id, function (data) {
			if(data=="Deleted"){
				refresh();
			}else{
				console.log(data);
				$('#details').empty();
				var modalbody = 
				"<label>Event Name</label><br>"+ data.title +
				"<br><label>Event Place</label><br>"+ data.place_held +
				"<br><label>From</label><br>"+ data.time_from +
				"<br><label>To</label><br>"+ data.time_to +
				"<br><label>Event Date</label><br>"+ data.date_held +
				"<br><label>Description</label><br>"+ data.description;
				$('#details').append(modalbody);
				$('#details_events').modal('show');
			}
		})
	}
});