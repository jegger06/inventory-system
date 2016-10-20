$(document).ready(function() {
	$('.list_department').hide();
	$('.loader_holder').show();
	var department = $('.list_department');
	var str = '';
	var total_data = 0;
	var page_num = 1;
	var pagination_num = 5;
	var dataName = '';
	var checker = 0;
	loadDepartment(total_data, page_num);
	setTimeout(function() {
		$('.loader_holder').hide();
		$('.list_department').show();
		loadPagination(page = 1, total_data);
	}, 500);
	
	$('body').delegate('.pagination li a', 'click', function(e) {
		e.preventDefault();
		if (!$(this).parent('li').hasClass('next') && !$(this).parent('li').hasClass('previous') && !$(this).parent('li').hasClass('active')) {
			$(this).parent().parent().children('li.num').remove();
			var page_num = $(this).text();
			loadDepartment(total_data, page_num);
			loadPagination(page_num, total_data);
			// alert(page_num);
		} else if ($(this).parent('li').hasClass('next')) {
			page_num = parseInt($('.pagination li.active').text()) + 1;
			$(this).parent().parent().children('li.num').remove();
			loadDepartment(total_data, page_num);
			loadPagination(page_num, total_data);
			// alert(page_num);
		} else if ($(this).parent('li').hasClass('previous')) {
			page_num = parseInt($('.pagination li.active').text()) - 1;
			$(this).parent().parent().children('li.num').remove();
			loadDepartment(total_data, page_num);
			loadPagination(page_num, total_data);
			// alert(page_num);
		}
	});
	
	$('#modal').on('shown.bs.modal', function () {
		$('#dep_name').focus();
	});

	$('#per_page').on('change', function() {
		loadDepartment(total_data, page_num);
		setTimeout(function() {
			loadPagination(page_num, total_data);
		}, 100);
	});

	$('#search').keyup(function() {
		loadDepartment(total_data, page_num);
		setTimeout(function() {
			loadPagination(page_num, total_data);
		}, 100);
	});

	$('body').delegate('.btn_update', 'click', function(e) {
		e.preventDefault();
		var dataID = $(this).parents('tr').attr('data-id');
		dataName = $(this).parents('tr').find('td:nth-child(2)').html();
		$('#dep_id').val(dataID);
		$('#dep_name').val(dataName);
		$('.department_holder').find('.error').remove();
		$('.department_holder').find('input').removeClass('parsley-error');
	});

	$('#dep_name').keyup(function(e) {
		var current_name = $(this).val().trim();
		if (e.which != 13 && dataName != current_name) {
			validate();
		} else {
			return;
			$('#dep_name').removeClass('parsley-error');
			$('.error').remove();
		}
	});

	$('.update_department').submit(function(e) {
		e.preventDefault();
		$('#dep_name').removeClass('parsley-error');
		$('.error').remove();
		var id = $('#dep_id').val().trim();
		var dep = $('#dep_name').val().trim();
		if (dataName != dep) {
			$('#dep_name').removeClass('parsley-error');
			$('.error').remove();
			if (checker == 1) {
				$('#dep_name').removeClass('parsley-error');
				$('.error').remove();
				$.ajax({
					type: 'POST',
					url: '/app/model/user/php/update_department.php',
					data: { 'id' : id, 'dep_name' : dep},
					success: function(data) {
						if (data.success == 1) {							
							$('#modal').modal('hide');
							setTimeout(function() {
								swal("Success!", "The department name has been updated.", "success");
								loadDepartment(total_data, page_num);
								loadPagination(page_num, total_data);
							}, 500);
						}
					}
				});
			}	
		} else {
			checker = 0;
		}			
	});

	function loadDepartment(total_data, page_num) {
		var per_page = $('#per_page').val();
		var search = $('#search').val();
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/load_department.php',
			data: { 'per_page' : per_page, 'search' : search, 'page_num' : page_num },
			success: function(data) {
				var result = data.result;
				var show_result = per_page * page_num - per_page + result.length;
				total_data = parseInt(data.total_department);
				if (data.success == 1 ) {
					perPage = data.perPage;
					var tbl_dep;
					var start_count = (perPage * page_num) - perPage + 1;
					console.log(start_count);
					$.each(result, function(key, val) {
						var dep = val.split('#');

						tbl_dep += '<tr data-id="' + dep[0] + '"><td>' + start_count + '</td><td>' + dep[1] + '</td><td>' + dep[2] + '</td><td><a id="swal-demo1" class="btn btn-xs btn-info btn-outline btn_update" data-toggle="modal" data-target="#modal">Update</a></td></tr>';
						start_count++;
					});
					$('.list_department tbody').html(tbl_dep);
					$('.tfoot').show();
					$('.num_result').html('<td colspan="2" class="text-left" align="left">Showing <strong>' + show_result + '</strong> of <strong>' + total_data + '</strong></td>');
				} else {
					tbl_dep = '<tr><td colspan="4"><strong>' + data.result  + '</strong></td></tr>';
					$('.list_department tbody').html(tbl_dep);
					$('.tfoot').hide();
				}
				totalData(total_data, perPage);
			}
		});
	}

	function totalData(total, perPage) {
		total_data = total;
	}

	function loadPagination(page = 1, total_data) {
		$('.pagination li.num').remove();
		if (total_data != 0) {
			insert_pagination = '';
			var per_page = perPage;
			var counter = Math.ceil(total_data / per_page);
			if(counter > 1 ){
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
				insert_pagination += '<li' + active + '><a href="#">' + i + '</a></li>';
				
				if (a == pagination_num) {
					break;
				}
			}
			$('#paginate li:first-child').after(insert_pagination);
		}
	}

	function validate() {
		str = $('#dep_name').val();
		if (/^[a-zA-Z ]*$/.test(str) == true) {
			$('#dep_name').removeClass('parsley-error');
			$('.error').remove();
			$.ajax({
				type: 'POST',
				url: '/app/model/user/php/check_department.php',
				data: {'department' : str},
				success: function(data) {
					if (data.result == 1) {
						$('#dep_name').addClass('parsley-error');
						$('#dep_name').after('<span class="error">The Department name already exists on database.</span>');
						checker = 0;
					} else {
						$('#dep_name').removeClass('parsley-error');
						$('.error').remove();
						checker = 1;
					}
				}
			});
		} else {
			if ($('.error').length == 0) {
				$('#dep_name').addClass('parsley-error');
				$('#dep_name').after('<span class="error">No numbers and special characters allowed</span>');
				checker = 0;
			}
		}
	}
});

