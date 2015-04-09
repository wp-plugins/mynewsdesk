jQuery(document).ready(function($){	
	var dataString = 'action=mnd_news&view_id='+ $('#view_id_').text()+'&media_type='+ $('#media_type_').text();
	$.ajax({
			type: "POST",
			url: mndAjax.ajaxurl,
			data: dataString,
			cache: false,
			success: function(response){
				if(response != 'error') {
					$('#ajax_response').removeClass('loading').append(response);
					$(".page_href").click(function(e) {
						if(!$(this).hasClass('active_page')){
							var currentId = $(this).attr('id');
							$('.news_block').hide();
							$('.page_href').removeClass('active_page');
							$('#bloc'+currentId).slideDown('fast');
							$(this).addClass('active_page');
							$('html, body').animate({scrollTop:0}, 'slow');
						}
						e.preventDefault();
					});						
				}
	  		}
	 });
});