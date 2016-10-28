$(document).ready(function() {
	var url = window.location.href;
	var nav = url.split('/').pop();
	$('.nav li a[href="'+ nav + '"]').each(function() {
		if ($(this).parents('ul').hasClass('sidebar-subnav')) {
			$(this).parents('ul').addClass('in');
			$(this).parents('ul').parent('li').addClass('active');
		}
		$(this).parent('li').addClass('active');
	});
});