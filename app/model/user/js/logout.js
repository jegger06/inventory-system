$(document).ready(function(){	
	$('#logout').click(function(e){
		e.preventDefault();
		var id = $('.userID').attr('data-id');
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/logout.php',
			dataType: 'json',
			data: {'userID' : id},
			success: function(data) {
				if (data.result == 1) {
					window.location.href = '/app/views/login#logout';
				} else {
					$.simplyToast('Something wen\'t wrong', 'warning');
				}
			}
		});
	});
});