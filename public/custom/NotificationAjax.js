$(document).ready(function(){
	// var interval = setInterval(getUnread, 5000);
	function getUnread(){
		$.get(notif, function (data) {
			if (data!=0) {
				$('.notif').text(data);
				$('.panelnotif').text('New');
			}
			else {
				$('.notif').text('');
				$('.panelnotif').text('');
			}
		})
	}
	Pace.on('done', function() {
		$("link[rel=stylesheet][href='"+url+"/plugins/pace/pace.min.css']").remove();
		$("script[src='"+url+"/plugins/pace/pace.min.js']").remove();
		getUnread();
	});
});
