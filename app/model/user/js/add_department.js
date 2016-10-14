$(document).ready(function() {
	var checker = 0;
	var str = '';
	$('.department_name').keyup(validate);
	$('.departmentForm').submit(function(e) {
		e.preventDefault();
		validate();
		if (checker == 1) {
			$.ajax({
				type: 'POST',
				url: '/app/model/user/php/add_department.php',
				data: { 'department' : str},
				success: function(data) {
					if (data.success == 1) {
						$.simplyToast('The ' + data.department + ' department has been added.', 'info');
						$('.departmentForm').trigger("reset");
					}
				}
			});
		}
	});


function validate() {
	str = $('.department_name').val()
	if (/^[a-zA-Z ]*$/.test(str) == true) {
		$('.department_name').removeClass('parsley-error');
		$('.error').remove();
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/check_department.php',
			data: {'department' : str},
			success: function(data) {
				if (data.result == 1) {
					$('.department_name').addClass('parsley-error');
					$('.department_name').after('<span class="error">The Department name already exists on database.</span>');
					checker = 0;
				} else {
					$('.department_name').removeClass('parsley-error');
					$('.error').remove();
					checker = 1;
				}
			}
		});
	} else {
		if ($('.error').length == 0) {
			$('.department_name').addClass('parsley-error');
			$('.department_name').after('<span class="error">No numbers and special characters allowed</span>');
		}
	}
}
});