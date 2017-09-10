<?php

function acp_toolbar_assets() {

    $accessible_poetry = get_option( 'accessible_poetry' );

    if( isset($accessible_poetry['enable_manual_toolbar']) ) {
        wp_enqueue_script(
            'acp-toolbar',
            plugins_url('accessible-poetry/assets/js/acp-toolbar.js'),
            array( 'jquery')
        );
    }
    elseif( isset($accessible_poetry['enable_ajax_toolbar']) ) {
        wp_enqueue_script(
            'acp-toolbar-ajax',
            plugins_url('accessible-poetry/assets/js/acp-toolbar-ajax.js'),
            array( 'jquery' )
        );
        wp_localize_script( 'acp-toolbar-ajax', 'acptAjax', array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ));
    }
}
add_action( 'wp_enqueue_scripts', 'acp_toolbar_assets' );

function get_acp_toolbar_toggle() {

    $options = get_option('accessible_poetry');

    $ariaLabel = __('Toggle accessibility toolbar', 'acp');

    $output = '<button id="acp-toggle-toolbar" class="acp-toggle-toolbar ' . $options['icon_size'] . '" aria-label="' . $ariaLabel . '">';
    $output .= '	<i class="material-icons md-32" aria-hidden="true">accessibility</i>';
    $output .= '</button>';

    return $output;
}
function get_acp_close_toolbar() {
    $ariaLabel = __('Close the accessibility toolbar', 'acp');

    $output  = '<button id="acp-toolbar-close" class="acp-toolbar-close" aria-label="' . $ariaLabel . '">';
    $output .= '	<i class="material-icons" aria-hidden="true">clear</i>';
    $output .= '</button>';

    return $output;
}

/*
 * Creates the button sets
 * of the toolbar
 */
function get_acp_toolbar_set($label, $id) {

    // Get our setting values
	$options = get_option('accessible_poetry');

    // Font Sizer & Contrast Sets
	if( 'acp-toolbar-textsize' == $id || 'acp-toolbar-contrast' == $id ) {
        $type = ( 'acp-toolbar-textsize' == $id ) ? 'text' : 'contrast';

		if( 'acp-toolbar-textsize' == $id ) {
			$st1_btn_id		= 'acp-text-down';
			$st1_btn_icon	= 'zoom_out';
			$st1_btn_label	= __('Decrease font size', 'acp');

			$st2_btn_id		= 'acp-text-up';
			$st2_btn_icon	= 'zoom_in';
			$st2_btn_label	= __('Increase font size', 'acp');

			$st3_btn_id		= 'acp-text-reset';
			$st3_btn_label	= __('Back to original', 'acp');
		}
		elseif( 'acp-toolbar-contrast' == $id ) {
			$st1_btn_id		= 'acp-contrast-dark';
			$st1_btn_icon	= 'brightness_low';
			$st1_btn_label	= __('Dark contrast', 'acp');

			$st2_btn_id		= 'acp-contrast-bright';
			$st2_btn_icon	= 'brightness_high';
			$st2_btn_label	= __('Bright contrast', 'acp');

			$st3_btn_id		= 'acp-contrast-reset';
			$st3_btn_label	= __('Back to original', 'acp');
		}

		$output  = '<span class="acp-toolbar-label">' .$label . '</span>';
		$output .= '<ul id="' . $id . '" class="acp-toolbar-btn-group">';

        $output .= '	<li>';
        $output .= '        <button id="' . $st1_btn_id . '" class="acp-toolbar-btn" type="button">';
        $output .= '            <i class="material-icons" aria-hidden="true">' . $st1_btn_icon . '</i>' . $st1_btn_label;
        $output .= '        </button>';
        $output .= '    </li>';


        $output .= '	<li>';
        $output .= '        <button id="' . $st2_btn_id . '" class="acp-toolbar-btn" type="button">';
        $output .= '            <i class="material-icons" aria-hidden="true">' . $st2_btn_icon . '</i>' . $st2_btn_label;
        $output .= '        </button>';
        $output .= '    </li>';


        $output .= '	<li id="acp-' . $type . '-reset" class="acp-btn-reset">';
        $output .= '        <button id="' . $st3_btn_id . '" class="acp-toolbar-btn" type="button">';
        $output .= '            <i class="material-icons" aria-hidden="true">autorenew</i>' . $st3_btn_label;
        $output .= '        </button>';
        $output .= '    </li>';

		$output .= '</ul>';
	}

	// Links Set
	elseif( 'acp-toolbar-links' == $id ) {
		$output  = '<span class="acp-toolbar-label">' . $label . '</span>';
		$output .= '<ul id="' . $id . '" class="acp-toolbar-btn-group" class="acp-toolbar-btn-group">';

		if( isset($options['hide_underline']) != 1 ) {
		    $output .= '<li>';
			$output .= '    <button id="acp-links-marklinks" class="acp-toolbar-btn">';
            $output .= '        <span aria-hidden="true"><i class="material-icons">format_paint</i></span>';
            $output .=          __('Highlight Links', 'acp');
            $output .= '    </button>';
            $output .= '</li>';

		}
		if( isset($options['hide_linkmark']) != 1 ) {
            $output .= '<li>';
            $output .= '    <button id="acp-links-underline" class="acp-toolbar-btn">';
            $output .= '        <span aria-hidden="true"><i class="material-icons">format_underlined</i></span>';
            $output .=          __('Links Underline', 'acp');
            $output .= '    </button>';
            $output .= '</li>';
		}
		$output .= '</ul>';
	}

	// Fonts & Animations Sets
	elseif( 'acp-toolbar-font' == $id || 'acp-toolbar-animation' == $id ) {
		if( 'acp-toolbar-font' == $id ) {
			$btn_id = 'acp-font-readable';
			$icon	= 'text_format';
			$label	= __('Fonts', 'acp');
			$label2	= __('Readable Font', 'acp');
		}
		elseif( 'acp-toolbar-animation' == $id ) {
			$btn_id = 'acp-animation';
			$icon	= 'local_movies';
			$label	= __('Animations', 'acp');
			$label2	= __('Disable Animations', 'acp');
		}
		$output  = '<span class="acp-toolbar-label">' . $label . '</span>';
		$output .= '<ul id="' . $id . '" class="acp-toolbar-btn-group">';
        $output .= '    <li>';
        $output .= '        <button id="' . $btn_id . '" class="acp-toolbar-btn">';
        $output .= '            <i class="material-icons" aria-hidden="true">' . $icon . '</i>';
        $output .=              $label2;
        $output .= '        </button>';
		$output .= '    </li>';
		$output .= '</ul>';
	}

	// Declaration & Contact Set
	elseif( 'declaration' == $id ) {

		$output  = '<ul id="acp-toolbar-extra" class="acp-toolbar-extra">';
        if( $options['declaration_link'] ) {
            $output .= '<li>';
            $output .= '    <a href="' . $options['declaration_link'] . '">';
            $output .= '        <span aria-hidden="true"><i class="material-icons">accessibility</i></span>';
            $output .=          __('Accessibility Declaration', 'acp');
            $output .= '    </a>';
            $output .= '</li>';
        }
        if( $options['contact_link'] ) {

            $output .= '<li>';
            $output .= '    <a href="' . $options['contact_link'] . '">';
            $output .= '        <span aria-hidden="true"><i class="material-icons">mail_outline</i></span>';
            $output .=          __('Contact Us', 'acp');
            $output .= '    </a>';
            $output .= '</li>';
        }

		$output .= '</ul>';
	}

	return $output;
}

/*
 * Creates the Toolbar
 */
function acp_get_toolbar() {

	$options    = get_option('accessible_poetry');

	$include    = 'data-fontsizer-include="' . $options['fontsizer_include'] . '"';
    $exclude    = 'data-fontsizer-exclude="' . $options['fontsizer_exclude'] . '"';
    $fromTop    = ( 15 < $options['icon_position'] ) ? intval($options['icon_position']) : 30;
    $skin_class = 'style-' . $options['toolbar_skin'];

	echo '<nav id="acp-toolbar-wrap" class="' . $skin_class . ' ' . $options['toolbar_side'] . '" data-from-top="' . $fromTop . '" ' . $include . ' ' . $exclude . '>';
	echo    get_acp_toolbar_toggle();
	echo '	<div id="acp-toolbar" class="acp-toolbar">';
	echo '      <div id="acp-toolbar-header">';
    echo            get_acp_close_toolbar();
    echo '		    <div role="heading" id="acp-toolbar-title" class="acp-toolbar-title">' . __('Accessibilily Toolbar', 'acp') . '</div>';
    echo '      </div>';
    echo '      <ul class="acp-ul">';

    // Font Sizer
	if (isset($options['hide_fontsizer']) != 1)
		echo '<li>' . get_acp_toolbar_set(__('Font Size', 'acp'), 'acp-toolbar-textsize') . '</li>';

	// Contrast
	if (isset($options['hide_contrast']) != 1)
		echo '<li>' . get_acp_toolbar_set(__('Color contrast', 'acp'), 'acp-toolbar-contrast') . '</li>';

	// Links
	if( isset($options['hide_underline']) != 1 || isset($options['hide_linkmark']) != 1 )
		echo '<li>' . get_acp_toolbar_set(__('Links', 'acp'), 'acp-toolbar-links') . '</li>';

	// Fonts
	if( isset($options['hide_readable']) != 1 )
		echo '<li>' . get_acp_toolbar_set(__('Fonts', 'acp'), 'acp-toolbar-font') . '</li>';

	// Animation
	if( isset($options['hide_animation']) != 1 )
		echo '<li>' . get_acp_toolbar_set(__('Animations', 'acp'), 'acp-toolbar-animation') . '</li>';

	// Declaration & Contact
	if( isset($options['declaration_link']) || isset($options['contact_link']) )
		echo '<li>' . get_acp_toolbar_set('', 'declaration'). '</li>';

	/*
	 * Author Link
	 */
    echo '</ul>';
	// PRO ONLY
	if( !isset($options['disable_author']) ) :

        echo '	<div class="acp-author">';
        echo '		<a href="http://www.amitmoreno.com/" aria-label="Go to the accessibility plugin author website - this link will open in a new window" target="_blank">Accessibe Poetry by Amit Moreno</a>';
        echo '	</div>';

    // PRO ONLY
    endif;

    echo '</div>';
    echo '</nav>';
}

/*
 * Toolbar validation for mobile visibility
 *
 * this function is the one that needed
 * to be executed.
 */
function acp_toolbar() {

    // Get our setting values
	$options = get_option( 'accessible_poetry' );

	if( isset($options['enable_manual_toolbar']) || isset($options['enable_ajax_toolbar']) ) {

        if( isset($options['disable_mobile_toolbar']) && wp_is_mobile() )
            exit();

        if( isset($options['enable_ajax_toolbar']) ) {
            acp_get_toolbar();
            die();
        }
        else {
            acp_get_toolbar();
        }
    }
}
add_action('wp_ajax_acp_toolbar', 'acp_toolbar');
add_action('wp_ajax_nopriv_acp_toolbar', 'acp_toolbar');
