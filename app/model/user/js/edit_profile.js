$(document).ready(function() {
	var user_id = $('.user_id').text();
	var checker = 0;
	var fname;
	var mname;
	var lname;
	var gender;
	profile(user_id);
	contactDetails(user_id);
	

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
	$('#new_password').keyup(function(e) {
		e.preventDefault();
		if (($(this).next('.error').is(':visible') && $(this).val() == '') || $(this).val() == $('#confirm_password').val()) {
			$(this).removeClass('parsley-error')
			$(this).next('.error').remove();
			$('#confirm_password').removeClass('parsley-error').next('.error').remove();
		}
	});

	$('#confirm_password').keyup(function(e) {
		e.preventDefault();
		if ($(this).val() == $('#new_password').val()) {
			$(this).removeClass('parsley-error').next('.error').remove();
			$('#new_password').removeClass('parsley-error').next('.error').remove();
		} else {
			if ($(this).next('.error').length == 0) {
				$(this).addClass('parsley-error');
				$(this).after('<span class="error">The new password and confirm password didn\'t match.</span>');
			}
		}

	});

	$('.accountForm').submit(function(e) {
		e.preventDefault();
		var current_password = $('#current_password').val();
		var new_password = $('#new_password').val();
		var confirm_password = $('#confirm_password').val();
		if (new_password != confirm_password) {
			if ($('.error').length == 0) {
				$('#new_password').focus().addClass('parsley-error');
				$('#new_password').after('<span class="error">The new password and confirm password didn\'t match.</span>');
				$('#confirm_password').addClass('parsley-error');
				$('#confirm_password').after('<span class="error">The new password and confirm password didn\'t match.</span>');
			}
		} else {
			if ($('.error').length == 0) {
				$.ajax({
					type: 'POST',
					url: '/app/model/user/php/update_account.php',
					data: {'userID' : user_id, 'c_password' : current_password, 'n_password' : new_password, 'cf_password' : confirm_password},
					success: function(data) {
						if (data.success == 1) {
							swal({
								title: "Good Job!",
								text:  data.message,
								type: "success"
							});
							$('#current_password').focus();
							document.getElementById("accountForm").reset();
						} else {
							swal({
								title: "Something wen't wrong!",
								text: "Opps! " + data.message,
								type: "error"
							});
							$('#current_password').focus();
						}
					}
				});
			}
		}
	});

	// Contact Details tab

	$('body').delegate('.contact_type', 'change', function() {
		if ($(this).val() == '') {
			$(this).parent().parent().next('div').find('.contact_prefix').html('<option value="">Select One</option>')
		} else {
			loadContactPrefix($(this).val(), $(this));
		}
	});

	$('body').delegate('.contact_type', 'click', function() {
		var selected_type = $(this).val() + '#' + $(this).text();

		
		loadContactType($(this), selected_type);
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

	function contactDetails(user_id) {
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/show_contact_details.php',
			data: { 'userID' : user_id },
			success: function(data) {
				if (data.success == 1) {
					var result = data.result;
					var contact;
					var user_contact_id;
					var contact_id;
					var contact_type;
					var contact_form = '';
					var contact_id_arr = [];
					$.each(result, function(key, val) {
						contact = val.split('#');
						user_contact_id = contact[0];
						contact_id = contact[1];
						contact_type = contact[2];
						contact_prefix = contact[3];
						contact_number = contact[4];
						contact_id_arr.push(contact_id + '#' + contact_type);
						contact_form += '<div class="contact clearfix"><div class="col-sm-3"><div class="form-group"><label for="contact_type">Contact Type</label>';
						contact_form += '<select class="form-control contact_type" id="contact_type"><option value="' + contact_id + '">' + contact_type + '</option></select></div></div>';
						contact_form += '<div class="col-sm-3"><div class="form-group"><label for="contact_prefix">Contact Number</label>';
						contact_form += '<select class="form-control contact_prefix" id="contact_prefix"><option value="">Select One</option></select></div></div>';
						contact_form += '<div class="col-sm-5 text-right"><label></label><input type="text" name="number" class="form-control"></div>';
						contact_form += '<div class="col-sm-1 text-right"><label>&nbsp;</label><p>';
						contact_form += '<a href="#" class="btn btn-danger btn-xs" title="Delete Contact"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a>';
						contact_form += '</p></div></div>';

					});
					$('#contactForm .row').html(contact_form);
				}
			}
		})
	}
	/*
	Still buggy.. Kailangan ko ilagay nalang ang function ng loadContactType sa contactDetails 
	para sabay sila sa pag generate ng contactDetails at may selected option na kaya lang 
	hindi yun maganda kasi dalawang beses tatawagin ang function
	*/

	function loadContactType(element, val) {
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/load_contact_type.php',
			data: {},
			success: function(data) {
				if (data.success == 1) {
					var result = data.result;
					var selected = val.split('#');
					var type_list = '';
					type_list += '<option value="">Select One</option>';
					$.each(result, function(key, val) {
						var c_type = val.split('#');
						if (c_type[0] == selected[0] && c_type[1] == selected[1]) {
							type_list += '<option value=" ' + c_type[0] + ' " selected> ' + c_type[1] + ' </option>';
						} else {
							type_list += '<option value=" ' + c_type[0] + ' "> ' + c_type[1] + ' </option>';							
						}
						
					});
					element.html(type_list);
					
				}
			}
		})
	}

	function loadContactPrefix(c_type_id, parent) {
		// console.log(parent.parent().parent().next('div').find('.contact_prefix').html());
		if (c_type_id != '') {
			$.ajax({
				type: 'POST',
				url: '/app/model/user/php/load_contact_prefix.php',
				data: { 'type_id' : c_type_id },
				success: function(data) {
					if (data.success == 1) {
						var result = data.result;
						var c_prefix;
						var option_prefix;
						option_prefix += '<option value="">Select One</option>';
						$.each(result, function(key, val) {
							c_prefix = val.split('#');
							option_prefix += '<option value="' + c_prefix[0] + '">' + c_prefix[1] + '</option>';
						});
						parent.parent().parent().next('div').find('.contact_prefix').html(option_prefix)
					}
				}
			});
		}
	}

});
