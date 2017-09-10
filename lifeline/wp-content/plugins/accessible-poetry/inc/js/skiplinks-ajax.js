
jQuery(document).ready(function($){

	$.ajax({
		url: acptAjax.ajax_url,
		type: 'post',
		data: {
			action: 'acp_skiplinks',
		},
		success: function( response ) {


			if( $("#acp-skiplinks-wrap").length === 0 ) {
				$("body").prepend(response);
				console.log(response);
			}

			$(".skiplinks").each(function(){
				var addTabindexTo = $(this).attr('href');
				$(addTabindexTo).attr('tabindex', '0');
			});
			$(".skiplinks").click(function(event){
				var skipTo="#"+this.href.split('#')[1];
				$(skipTo).attr('tabindex', -1).on('blur focusout', function () {
					$(this).removeAttr('tabindex');
				}).focus();
			});

		}
	});
	//die();
});