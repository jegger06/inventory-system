$(document).ready(function() {
	var url = window.location.href;
	var nav = url.split('/').pop();
	$('.nav a[href*="'+ nav + '"]').each(function(i, value) {
		$(value).parent().addClass('active').siblings('li').removeClass('active');
	});
});