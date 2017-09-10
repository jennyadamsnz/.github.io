jQuery(document).ready(function($){

	$.ajax({
		url: acptAjax.ajax_url,
		type: 'post',
		data: {
			action: 'acp_toolbar',
		},
		success: function( response ) {


			if( $("#acp-toolbar-wrap").length === 0 ) {
				$("body").prepend(response);
			}
			 // toolbar
			 acp_toolbar();

			 // font size changer
			 acp_fontsize();

			 // contrast
			 acp_contrast();

			 // links underline
			 acp_underline();

			 // links highlight
			 acp_highlight();

			 // readable font
			 acp_readable();

			 // animation
			 acp_animation();

		}
	});
});