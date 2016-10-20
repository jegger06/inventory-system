$(document).ready(function() {
	var checker = 0;
	var str = '';

	$('.position_name').keyup(function(e) {
		if (e.which != 13) {
			validate();
		} else {
			return;
		}
	});
	$('.positionForm').submit(function(e) {
		e.preventDefault();
		validate();
		if (checker == 1) {
			$.ajax({
				type: 'POST',
				url: '/app/model/user/php/add_position.php',
				data: { 'position' : str},
				success: function(data) {
					if (data.success == 1) {
						swal('Success!', 'You have added the ' + data.position + ' position into the database.', 'success');
						$('.positionForm').trigger("reset");
					}
				}
			});
		}
	});

	function validate() {
		str = $('.position_name').val();
		if (/^[a-zA-Z ]*$/.test(str) == true) {
			$('.position_name').removeClass('parsley-error');
			$('.error').remove();
			$.ajax({
				type: 'POST',
				url: '/app/model/user/php/check_position.php',
				data: {'position' : str},
				success: function(data) {
					if (data.result == 1) {
						$('.position_name').addClass('parsley-error');
						$('.position_name').after('<span class="error">The Position name already exists on database.</span>');
						checker = 0;
					} else {
						$('.position_name').removeClass('parsley-error');
						$('.error').remove();
						checker = 1;
					}
				}
			});
		} else {
			if ($('.error').length == 0) {
				$('.position_name').addClass('parsley-error');
				$('.position_name').after('<span class="error">No numbers and special characters allowed</span>');
				checker = 0;
			}
		}
	}
});