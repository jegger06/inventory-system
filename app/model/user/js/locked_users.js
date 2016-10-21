$(document).ready(function() {
	var total_data = 0;
	var page_num = 1;
	var pagination_num = 5;
	loadDepartment();
	loadPosition();
	loadLockedUsers();
	setTimeout(function() {
		$('.loader_holder').hide();
		$('.list_user').show();
		loadPagination(page = 1, total_data);
	}, 200);

	$('#per_page').on('change', function() {
		page_num = 1;
		loadLockedUsers(total_data, page_num);
		setTimeout(function(){
			loadPagination(page = 1, total_data);
		}, 300);
	});

	$('#department').on('change', function() {
		page_num = 1;
		loadLockedUsers(total_data, page_num);
		setTimeout(function(){
			loadPagination(page = 1, total_data);
		}, 300);
	});

	$('#position').on('change', function() {
		page_num = 1;
		loadLockedUsers(total_data, page_num);
		setTimeout(function(){
			loadPagination(page = 1, total_data);
		}, 300);
	});

	$('#search').keyup(function() {
		page_num = 1;
		loadLockedUsers(total_data, page_num);
		setTimeout(function(){
			loadPagination(page = 1, total_data);
		}, 300);
	});

	$('body').delegate('.status', 'click', function(e) {
		e.preventDefault();
		var status = true;
		var name = $(this).parents('tr').find('td:first-child').text() + ' ' + $(this).parents('tr').find('td:nth-child(2)').text();
		var userID = $(this).parents('tr').attr('data-id');
		var waiting = 0;
		var unlocked = true;
		swal({
			title: 'Unlocked?',
			text: 'The account of ' + name + ' will be unlocked.',
			type: 'info',
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		},
		function() {
			setTimeout(function() {
				$.ajax({
					type: 'POST',
					url: '/app/model/user/php/update_status.php',
					data: {'userID' : userID, 'status' : status, 'waiting' : waiting, 'unlocked' : unlocked},
					success: function(data) {
						if (data.success == 1) {
							swal("Success!", "The account has been unlocked!", "success");
							loadLockedUsers(total_data, page_num = 1);
							loadPagination(page = 1, total_data);
						}
					}
				});
			}, 1000);
		});
	});

	$('body').delegate('.pagination li a', 'click', function(e) {
		e.preventDefault();
		if (!$(this).parent('li').hasClass('next') && !$(this).parent('li').hasClass('previous') && !$(this).parent('li').hasClass('active')) {
			// $(this).parent().parent().children('li.num').remove();
			page_num = $(this).text()
			loadLockedUsers(total_data, page_num);
			loadPagination(page_num, total_data);
			// alert(page_num);
		} else if ($(this).parent('li').hasClass('next')) {
			page_num = parseInt($('.pagination li.active').text()) + 1;
			// $(this).parent().parent().children('li.num').remove();
			loadLockedUsers(total_data, page_num);
			loadPagination(page_num, total_data);
		} else if ($(this).parent('li').hasClass('previous')) {
			page_num = parseInt($('.pagination li.active').text()) - 1;
			// $(this).parent().parent().children('li.num').remove();
			loadLockedUsers(total_data, page_num);
			loadPagination(page_num, total_data);
			// alert(page_num);
		}
	});

	function loadDepartment() {
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/department.php',
			success: function(data) {
				var result = data.result;
				if (data.success == 1) {
					$.each(result, function(key, val) {
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
					$.each(result, function(key, val) {
						var pos = val.split('#');
						$('#position').append($('<option></option>').attr('value', pos[0]).text(pos[1]));
					});

				}
			}
		});
	}

	function loadLockedUsers() {
		var depID = $('#department').val();
		var posID = $('#position').val();
		var search = $('#search').val();
		var per_page = $('#per_page').val();
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/load_locked_users.php',
			data: {'depID': depID, 'posID': posID, 'search': search, 'per_page': per_page, 'page_num' : page_num},
			success: function(data) {
				if (data.success == 1) {
					var tbl_row;
					var result = data.result;
					var show_result = per_page * page_num - per_page + result.length;	
					$.each(result, function(key, val) {
						user = val.split('#');
						tbl_row += '<tr data-id="' + user[0] + '"><td>' + user[1] + '</td><td>' + user[2] + '</td><td>' + user[3] + '</td><td>' + user[4] + '</td><td>' + user[5] + '</td><td>' + user[6] + '</td><td><label class="switch switch-sm" title="Inactive"><input type="checkbox" class="status"><span></span></label></td></tr>'
					});
					$('.locked_users tbody').html(tbl_row);
					$('.total_result').attr('colspan', 4).removeClass('text-center').html('Showing: <strong>' + show_result + '</strong> of <strong>' + data.total_users +'</strong>');
					$('#paginate').show();
				} else {
					$('.locked_users tbody').html('');
					$('.total_result').attr('colspan', 7).addClass('text-center').html('<strong>' + data.result + '</strong>');
					$('#paginate').hide();
				}
				total_data = parseInt(data.total_users);
				totalData(total_data);
			}
		})
	}

	function totalData(total) {
		total_data = total;
	}

	function loadPagination(page = 1, total_data) {
		// alert(total_data)
		$('.pagination li.num').remove();
		if (total_data != 0) {
			var insertPagination = '';
			var per_page = $('#per_page').val();
			// alert(total_data);
			var counter = Math.ceil(total_data / per_page );
			if (counter > 1 ) {
				$('.next').show();
			}
			var active;
			if (page <= (Math.ceil(pagination_num/2))) {

				start_page = 1;
				
				if (page == 1) {
					$('.previous').hide();
				} else {
					$('.previous').show();
				}
				if (counter == page) {
					$('.next').hide();
				} else{
					$('.next').show();
				}
			} else if ((counter - parseInt(pagination_num/2)) <= page ) {
				if (counter<=pagination_num) {
					start_page = 1;
				} else {
					if (pagination_num % 2 === 0) {
						start_page = (counter - parseInt(pagination_num/2)) - parseInt(pagination_num/2) + 1;
					} else {
						start_page = (counter - parseInt(pagination_num/2)) - parseInt(pagination_num/2);
					}
				}
				
				if (counter == page) {
					$('.next').hide();
				} else {
					$('.next').show();
				}
			} else {
				if (counter<=pagination_num) {
					start_page = 1;
				} else {
					start_page = page - parseInt(pagination_num/2);
				}
				$('.previous').show();
				$('.next').show();
			}
			
			for (i = start_page, a=1; i <= counter; i++,a++) {
				if (i == page) {
					active = ' class="active num"';
				} else {
					active = ' class="num"';
				}
				insertPagination += '<li' + active + '><a href="#">' + i + '</a></li>';

				
				if (a == pagination_num) {
					break;
				}
			}
			$('#paginate li:first-child').after(insertPagination);
		}
	}





});