$(document).ready(function(){
	loadDepartment();
	loadPosition();
	var show = $('#show_pass');
	var hide = $('#hide_pass');
	var cancel = $('#cancel_pass');
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
				} else {
					$.simplyToast('Something wen\'t wrong. You have either edited the DOM.', 'warning');
				}
			}
		})
	});
});