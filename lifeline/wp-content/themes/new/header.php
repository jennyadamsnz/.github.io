<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package new
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0;">
<meta charset="UTF-8">
<meta name="description" content=" Lifeline is here for you to provide support and help">
<meta name="keywords" content="lifeline,help,volunteer,fundraise,donate,suicide crisis helpline,kidsline,face to face counselling">
<meta name="author" content="Jenny Adams and Kevin Xia">

<script src="https://use.fontawesome.com/ae1dccc8aa.js"></script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-41728141-1', 'lifeline.org.nz');
ga('send', 'pageview');
</script>
 

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'new' ); ?></a>

	<header id="masthead" class="green-background site-header" role="banner">
		<div class="site-branding">
			<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
			<div id="top_button">
				<a class="tb1" href="https://jenny.adams.yoobee.net.nz/lifeline/get-involved-links/">Get Involved</a><!--
				--><a class="tb2" href="https://secure.flo2cash.co.nz/donations/lifeline/donate.aspx">Donate</a>
			</div>
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div id="site-navigation-div">
				<div class="logo_div">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" alt="Lifeline - Home"><img class="logo" src="https://jenny.adams.yoobee.net.nz/lifeline/wp-content/uploads/2017/07/lifeline-logo.png" alt="Lifeline Logo"></a>
				</div><!--
				--><button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'new' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead 
	--><div id="content" class="site-content">    
