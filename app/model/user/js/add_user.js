$(document).ready(function(){
	loadDepartment();
	loadPosition();
	var show = $('#show_pass');
	var hide = $('#hide_pass');
	var cancel = $('#cancel_pass');
	if ($('.username').val() == '') {
		$('.username').focus();
	} else {
		$('.email').focus();
	}
	$(show).click(function(e){
		e.preventDefault();
		$(this).next('div').slideDown();
	});
	$(hide).click(function(e){
		e.preventDefault();
		var emClass = $(this).find('em').attr('class');
		if (emClass == 'fa fa-eye') {
			$(this).find('em').attr('class', 'fa fa-eye-slash');
			$('#password').attr('type', 'password');
		} else {
			$(this).find('em').attr('class', 'fa fa-eye');
			$('#password').attr('type', 'text');
		}
	});
	$(cancel).click(function(e){
		e.preventDefault();
		$(this).parents('.password_holder').slideUp();
		setTimeout(function(){
			$('#password').attr('type', 'text');
		}, 500);
	});
	
	function loadDepartment() {
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/department.php',
			success: function(data) {
				var result = data.result;
				if (data.success == 1) {
					$.each(result, function(key, val){
						var dep = val.split('#');
						$('#department').append($('<option></option>').attr('value', dep[0]).text(dep[1]));
					});

				}
			}
		});
	}
	function loadPosition() {
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/position.php',
			success: function(data) {
				var result = data.result;
				if (data.success == 1) {
					$.each(result, function(key, val){
						var dep = val.split('#');
						$('#position').append($('<option></option>').attr('value', dep[0]).text(dep[1]));
					});

				}
			}
		});
	}
	$('.validate').keypress(function() {
		$(this).css('border-color', '#66afe9');
	});
	$('.validate').blur(function() {
		var getLength = $.trim($(this).text().length);

		$(this).css('border-color', '#dde6e9');
	})
	$('#registration_form').submit(function(e) {
		e.preventDefault();
		var depName = $('#department option:selected').text();
		var posName = $('#position option:selected').text();
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/admin_register.php',
			data: {data: $(this).serializeArray(), 'dep_name' : depName, 'pos_name' : posName},
			success: function(data) {
				if (data.success == 1) {
					$.simplyToast('The employee is now registered into the system.', 'success');
					$('#registration_form').trigger("reset");
					setTimeout(function() {
						location.reload();
					}, 2000)
				} else {
					if (data.dep_result == 0) {
						$.simplyToast('You have edited the Department field values', 'danger');
					}
					if (data.pos_result == 0) {
						$.simplyToast('You have edited the Position field values.', 'danger');
					}
					data.result.forEach( function(response) {
						var error = response.split('#');
						$.simplyToast(error[0], 'danger');
						$('.'+ error[1]).css('border-color', 'red');
					});
				}
			}
		})
	});
});