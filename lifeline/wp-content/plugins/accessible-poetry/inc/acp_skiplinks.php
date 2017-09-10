<?php

// Register Skiplinks Navigations
function acp_register_skiplinks_menu() {
	
	$options = get_option( 'accessible_poetry' );
	
	register_nav_menu( 'skiplinks', __( 'Skiplinks', 'acp' ) );
	if( isset($options['skiplinks_home']) ) {
		register_nav_menu( 'skiplinks-home', __( 'Homepage Skiplinks', 'acp' ) );
	}
}
add_action( 'after_setup_theme', 'acp_register_skiplinks_menu' );

// Skiplinks output
function acp_skiplinks() {

    $menu_list = '';
	$options = get_option( 'accessible_poetry' );
		
	if( $options['skiplinks_home'] == 1 ) {
		$menu_name = 'skiplinks-home';
	}
	else {
		$menu_name = 'skiplinks';
	}

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_list = '<nav id="acp-skiplinks-wrap"><ul id="acp_skiplinks" role="navigation" class="' . $options['skiplinks_side'] . '">';

		foreach ( (array) $menu_items as $key => $menu_item ) {
	    	$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= '<li><a href="' . $url . '" class="skiplinks">' . $title . '</a></li>';
		}
		$menu_list .= '</ul></nav>';
    }
    if( isset($options['enable_manual_skiplinks']) || isset($options['enable_ajax_skiplinks']) ) {
    	echo $menu_list;
    }
    wp_die();
}
add_action('wp_ajax_acp_skiplinks', 'acp_skiplinks');
add_action('wp_ajax_nopriv_acp_skiplinks', 'acp_skiplinks');

// skiplinks essets
function acp_skiplinks_assets() {

    $accessible_poetry = get_option('accessible_poetry');

    // style 1

    if ( isset($accessible_poetry['enable_manual_skiplinks']) ) {
        wp_register_style('skiplinks', plugins_url('accessible-poetry/assets/css/acp-skiplinks.css'));
        wp_enqueue_style('skiplinks');

        wp_enqueue_script('skiplinks-js', plugins_url(
            'accessible-poetry/inc/js/skiplinks.js'),
            array('jquery')
        );

    }
    elseif( isset($accessible_poetry['enable_ajax_skiplinks']) ) {
        wp_register_style('skiplinks', plugins_url('accessible-poetry/assets/css/acp-skiplinks.css'));
        wp_enqueue_style('skiplinks');

        wp_enqueue_script('skiplinks-ajax',
            plugins_url('accessible-poetry/inc/js/skiplinks-ajax.js'),
            array('jquery')
        );
        wp_localize_script('skiplinks-ajax', 'acptAjax', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }
}
add_action( 'wp_enqueue_scripts', 'acp_skiplinks_assets' );
