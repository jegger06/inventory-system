$(document).ready(function() {
	// Statis per page
	// var per_page = 5;
	// var total_data = 23;

	// var counter = Math.ceil(total_data / per_page);
	// var insert_pagination = '';
	// var active;
	// pagination();
	// var list_count = $('#paginate li').length;
	// if (list_count > 1) {
	// 	$('#paginate').append('<li class="next"><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>');
	// }

	// function pagination() {
	// 	for (i = 1; i <= counter; i++) {
	// 		if (i == 1) {
	// 			active = ' class="active"';
	// 		} else {
	// 			active = '';
	// 		}
	// 		insert_pagination += '<li' + active + '><a href="#">' + i + '</a></li>';
	// 	}
	// 	$('#paginate').append(insert_pagination);
	// }

	// $('body').delegate('.pagination li a', 'click', function(e) {
	// 	e.preventDefault();
		
	// 	alert(isNumeric($(this).parent('li').text()));
		

	// });


	// Statis per page
		var per_page = 5;
		var total_data = 26;
		var pagination_num = 5;
	
		var counter = Math.ceil(total_data / per_page);
	
		var insert_pagination = '';
		var active;
		pagination(page=1);
	
		if(counter > 1 ){
			$('.next').show();
		}

		function pagination(page=1) {
			
			insert_pagination="";
			
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
		$('body').delegate('.pagination li a', 'click', function(e) {
			e.preventDefault();
			if (!$(this).parent('li').hasClass('next') && !$(this).parent('li').hasClass('previous') && !$(this).parent('li').hasClass('active')) {
				$(this).parent().parent().children('li.num').remove();
				var page_num = $(this).text()
				pagination(page_num);
				// alert(page_num);
			} else if ($(this).parent('li').hasClass('next')) {
				page_num = parseInt($('.pagination li.active').text()) + 1;
				$(this).parent().parent().children('li.num').remove();
				pagination(page_num);
				// alert(page_num);
			} else if ($(this).parent('li').hasClass('previous')) {
				page_num = parseInt($('.pagination li.active').text()) - 1;
				$(this).parent().parent().children('li.num').remove();
				pagination(page_num);
				// alert(page_num);
			}
		});
});