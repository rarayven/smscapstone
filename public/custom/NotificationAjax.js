$(document).ready(function(){
	var interval = setInterval(getUnread, 1000);
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
});
