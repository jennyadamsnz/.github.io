<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package new
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area hide" role="complementary">

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

		<script type="text/javascript">

			if (jQuery('article').hasClass('post')) {

				jQuery('aside').toggleClass('hide');

				jQuery(window).scroll(function() {

				   if(jQuery(window).scrollTop() + jQuery(window).height() > jQuery(document).height() - 400 && jQuery(window).width() < 1200)  {
		 				jQuery('#recent-posts-2').addClass('hide');			   		
				   } 					
			   		else {
			   			jQuery('#recent-posts-2').removeClass('hide');
			   		}
				   if(jQuery(window).scrollTop() + jQuery(window).height() > jQuery(document).height() - 250 && jQuery(window).width() > 1200)  {
						jQuery('#recent-posts-2').addClass('hide');	
				   }
				   else{
				       jQuery('#recent-posts-2').removeClass('hide');  
				   }
				});	
			};
		</script> 

</aside><!-- #secondary -->
