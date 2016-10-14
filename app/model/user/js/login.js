$(document).ready(function(){

	$('#login_form').submit(function(e){
		// $.simplyToast('This is a danger message!', 'danger');
		e.preventDefault();
		if (!$('input').hasClass('parsley-error') || $('input:not([type="checkbox"])').val() != '') {
			var user = $('#username').val();
			var password = $('#password').val();
			var remember = $('#remember').is(':checked');
			$.ajax({
				type: 'POST',
				url: '/app/model/user/php/login_connect.php',
				data: {'user' : user, 'password' : password, 'remember' : remember},
				dataType: 'json',
				success: function(data) {
					if (data.success == 1) {
						window.location.href = '/app/views/admin';
					} else {
						$.simplyToast('The username and password doesn\'t match. Please try again.', 'danger');
						$('#password').val('');
					}
				}
			});
		}
	});
	var logout = location.hash;
	setTimeout(function(){
		if (logout == '#logout') {
			$.simplyToast('You have been successfully log out.', 'success');
		}
	},500);	
	if ($('#username').val() == '') {
		$('#username').focus();
	} else {
		$('#password').focus();
	}
});