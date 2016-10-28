$(document).ready(function() {
	var userID = parseInt($('.userID').attr('data-id'));
	userDetails(userID);
});

function userDetails(id) {
	$.ajax({
		type: 'POST',
		url: '/app/model/user/php/sidebar_details.php',
		data: { 'userID' : id },
		success: function(data) {
			if (data.success == 1) {

				if (data.image != 0) {
					$('.user-block-status').find('img').attr('src', data.image);
				}

				$('.user-block-role').text(data.position);
			}
		}
	})
}