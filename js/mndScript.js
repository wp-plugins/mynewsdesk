jQuery(document).ready(function($){	
	$(".page_href").click(function() {
		if(!$(this).hasClass('active_page')){
			var currentId = $(this).attr('id');
			$('.news_block').hide();
			$('.page_href').removeClass('active_page');
			$('#bloc'+currentId).slideDown('fast');
			$(this).addClass('active_page');
			$('html, body').animate({scrollTop:0}, 'slow');
		}
		return false;
	});	
});