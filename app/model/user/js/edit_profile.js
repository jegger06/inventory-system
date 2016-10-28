$(document).ready(function() {
	var user_id = $('.user_id').text();
	var checker = 0;
	var fname;
	var mname;
	var lname;
	var gender;
	profile(user_id);

	$('.tabs a').click(function() {
		$(this).addClass('act').siblings('a').removeClass('act');
	});

	$('#first_name').keyup(function() {
		validate($(this));
	});

	$('#middle_name').keyup(function() {
		validate($(this));
	});

	$('#last_name').keyup(function() {
		validate($(this));
	});

	$('.profile_form').submit(function(e) {
		var prof_pic = $('#profile_pic').val();
		var first_name = $.trim($('#first_name').val().toLowerCase());
		var middle_name = $.trim($('#middle_name').val().toLowerCase());
		var last_name = $.trim($('#last_name').val().toLowerCase());
		var current_gender = $.trim($('#gender').val().toLowerCase());
		if (($('.error').length == 0) && ((prof_pic != '') || (fname != first_name) || (mname != middle_name) || (lname != last_name) || (gender != current_gender))) {
			var fd = new FormData(this);
			fd.append('userID', user_id);
			fd.append('fname', fname);
			fd.append('mname', mname);
			fd.append('lname', lname);
			fd.append('pgender', gender);
			$.ajax({
				type: 'POST',
				url: '/app/model/user/php/update_profile.php',
				data: fd,
				contentType: false, // The content type used when sending data to the server.
				cache: false, // To disable request pages to be cached
				processData: false, // To send DOMDocument or non processed data file it is set to false
				success: function(data) {
					if (data.success == 1) {
						swal({
							title: "Good Job!",
							text: "You have updated your account, " + data.name + ".",
							type: "success"
						});
						$('.user-block-status').find('img').attr('src', data.image);
						profile(user_id);
						$('#profile_pic').filestyle('clear');
					} else {
						swal({
							title: "Something wen't wrong!",
							text: "Opps! " + data.message + " Try again.",
							type: "error"
						});
					}
				}
			});
		} else {
			$('.error').prev('input').focus();
		}
		return false;
	});

	$('.accountForm').submit(function(e) {
		e.preventDefault();
		var new_password = $('#new_password').val();
		var confirm_password = $('#confirm_password').val();
		if (new_password != confirm_password) {

			$('#new_password').focus();
		}
		
	});

	function validate(typed) {
		var input = typed.val();
		if (/^[a-zA-Z ]*$/.test(input) == true) {
			$(typed).removeClass('parsley-error');
			$(typed).next('.error').remove();
			checker = 1;
		} else {
			if ($(typed).next('.error').length == 0) {
				$(typed).addClass('parsley-error');
				$(typed).after('<span class="error">No numbers and special characters allowed</span>');
				checker = 0;
			}
		}
	}

	function profile(user_id) {
		jQuery.ajax({
			type: 'POST',
			url: '/app/model/user/php/show_profile.php',
			data: { 'userID' : user_id },
			success: function(data) {
				var result = data.result;
				if (data.success == 1) {
					$.each(result, function(key, val) {
						var profile = val.split('#');
						firstname = profile[0];
						middlename = profile[1];
						lastname = profile[2];
						gender = profile[3];
						$('#first_name').val(firstname);
						$('#middle_name').val(middlename);
						$('#last_name').val(lastname);
						if (gender != 0) {
							$('#gender option[value="'+ gender +'"]').attr('selected', true);
						}
					});
					details(firstname, middlename, lastname, gender);
				}
			}
		});
	}

	function details(f, m, l, g) {
		fname = f.toLowerCase();
		mname = m.toLowerCase();
		lname = l.toLowerCase();
		gender = g.toLowerCase();
	}



});
