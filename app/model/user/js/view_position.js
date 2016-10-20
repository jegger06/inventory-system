$(document).ready(function() {
	$('.list_position').hide();
	$('.loader_holder').show();
	var position = $('.list_position');
	var str = '';
	var total_data = 0;
	var page_num = 1;
	var pagination_num = 5;
	var dataName = '';
	var checker = 0;
	loadPosition(total_data, page_num);
	setTimeout(function() {
		$('.loader_holder').hide();
		$('.list_position').show();
		loadPagination(page = 1, total_data);
	}, 500);
	
	$('body').delegate('.pagination li a', 'click', function(e) {
		e.preventDefault();
		if (!$(this).parent('li').hasClass('next') && !$(this).parent('li').hasClass('previous') && !$(this).parent('li').hasClass('active')) {
			$(this).parent().parent().children('li.num').remove();
			var page_num = $(this).text();
			loadPosition(total_data, page_num);
			loadPagination(page_num, total_data);
			// alert(page_num);
		} else if ($(this).parent('li').hasClass('next')) {
			page_num = parseInt($('.pagination li.active').text()) + 1;
			$(this).parent().parent().children('li.num').remove();
			loadPosition(total_data, page_num);
			loadPagination(page_num, total_data);
			// alert(page_num);
		} else if ($(this).parent('li').hasClass('previous')) {
			page_num = parseInt($('.pagination li.active').text()) - 1;
			$(this).parent().parent().children('li.num').remove();
			loadPosition(total_data, page_num);
			loadPagination(page_num, total_data);
			// alert(page_num);
		}
	});
	
	$('#modal').on('shown.bs.modal', function () {
		$('#pos_name').focus();
	});

	$('#per_page').on('change', function() {
		loadPosition(total_data, page_num);
		setTimeout(function() {
			loadPagination(page_num, total_data);
		}, 100);
	});

	$('#search').keyup(function() {
		loadPosition(total_data, page_num);
		setTimeout(function() {
			loadPagination(page_num, total_data);
		}, 100);
	});

	$('body').delegate('.btn_update', 'click', function(e) {
		e.preventDefault();
		var dataID = $(this).parents('tr').attr('data-id');
		dataName = $(this).parents('tr').find('td:nth-child(2)').html();
		$('#pos_id').val(dataID);
		$('#pos_name').val(dataName);
		$('.position_holder').find('.error').remove();
		$('.position_holder').find('input').removeClass('parsley-error');
	});

	$('#pos_name').keyup(function(e) {
		var current_name = $(this).val().trim();
		if (e.which != 13 && dataName != current_name) {
			validate();
		} else {
			return;
			$('#pos_name').removeClass('parsley-error');
			$('.error').remove();
		}
	});

	$('.update_position').submit(function(e) {
		e.preventDefault();
		$('#pos_name').removeClass('parsley-error');
		$('.error').remove();
		var id = $('#pos_id').val().trim();
		var pos = $('#pos_name').val().trim();
		if (dataName != pos) {
			$('#pos_name').removeClass('parsley-error');
			$('.error').remove();
			if (checker == 1) {
				$('#pos_name').removeClass('parsley-error');
				$('.error').remove();
				$.ajax({
					type: 'POST',
					url: '/app/model/user/php/update_position.php',
					data: { 'id' : id, 'pos_name' : pos},
					success: function(data) {
						if (data.success == 1) {							
							$('#modal').modal('hide');
							setTimeout(function() {
								swal("Success!", "The position name has been updated.", "success");
								loadPosition(total_data, page_num);
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

	function loadPosition(total_data, page_num) {
		var per_page = $('#per_page').val();
		var search = $('#search').val();
		$.ajax({
			type: 'POST',
			url: '/app/model/user/php/load_position.php',
			data: { 'per_page' : per_page, 'search' : search, 'page_num' : page_num },
			success: function(data) {
				var result = data.result;
				var show_result = per_page * page_num - per_page + result.length;
				// alert(result.length)
				total_data = parseInt(data.total_position);
				if (data.success == 1 ) {
					perPage = data.perPage;
					var tbl_pos;
					var start_count = (perPage * page_num) - perPage + 1;
					$.each(result, function(key, val) {
						var pos = val.split('#');

						tbl_pos += '<tr data-id="' + pos[0] + '"><td>' + start_count + '</td><td>' + pos[1] + '</td><td>' + pos[2] + '</td><td><a id="swal-demo1" class="btn btn-xs btn-info btn-outline btn_update" data-toggle="modal" data-target="#modal">Update</a></td></tr>';
						start_count++;
					});
					$('.list_position tbody').html(tbl_pos);
					$('.tfoot').show();
					$('.num_result').html('<td colspan="2" class="text-left" align="left">Showing <strong>' + show_result + '</strong> of <strong>' + total_data + '</strong></td>');
				} else {
					tbl_pos = '<tr><td colspan="4"><strong>' + data.result  + '</strong></td></tr>';
					$('.list_position tbody').html(tbl_pos);
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
		str = $('.pos_name').val();
		if (/^[a-zA-Z ]*$/.test(str) == true) {
			$('.pos_name').removeClass('parsley-error');
			$('.error').remove();
			$.ajax({
				type: 'POST',
				url: '/app/model/user/php/check_position.php',
				data: {'position' : str},
				success: function(data) {
					if (data.result == 1) {
						$('.pos_name').addClass('parsley-error');
						$('.pos_name').after('<span class="error">The Position name already exists on database.</span>');
						checker = 0;
					} else {
						$('.pos_name').removeClass('parsley-error');
						$('.error').remove();
						checker = 1;
					}
				}
			});
		} else {
			if ($('.error').length == 0) {
				$('.pos_name').addClass('parsley-error');
				$('.pos_name').after('<span class="error">No numbers and special characters allowed</span>');
				checker = 0;
			}
		}
	}
});

