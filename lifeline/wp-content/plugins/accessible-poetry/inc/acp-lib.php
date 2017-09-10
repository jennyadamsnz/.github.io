<?php

/*
 * Do settings fields
 *
 * Accessible Poetry Version of
 * WP core function: do_settings_fields
 *
 * @since 2.1.1
 */

function acp_proAvailable() {
	return false;
}

function acp_do_settings_fields($page, $section) {
    global $wp_settings_fields;

    if ( ! isset( $wp_settings_fields[$page][$section] ) )
        return;

    foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
        $class = '';

        if ( ! empty( $field['args']['class'] ) ) {
            $class = ' class="' . esc_attr( $field['args']['class'] ) . '"';
        }

        echo "<div{$class}>";

        if ( ! empty( $field['args']['label_for'] ) ) {
            echo '<div scope="row"><label for="' . esc_attr( $field['args']['label_for'] ) . '">' . $field['title'] . '</label></div>';
        } else {
            echo '<div scope="row">' . $field['title'] . '</div>';
        }

        echo '<div>';
        call_user_func($field['callback'], $field['args']);
        echo '</div>';
        echo '</div>';
    }
}

/*
 * Do settings sections
 *
 * Accessible Poetry Version of
 * WP core function: do_settings_sections
 *
 * @since 2.1.1
 */
function acp_do_settings_sections( $page ) {
    global $wp_settings_sections, $wp_settings_fields;

    if ( ! isset( $wp_settings_sections[$page] ) )
        return;

    foreach ( (array) $wp_settings_sections[$page] as $section ) {

        if ( $section['callback'] )
            call_user_func( $section['callback'], $section );

        if ( ! isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || !isset( $wp_settings_fields[$page][$section['id']] ) )
            continue;

        echo '<div class="tab"><div id="' . $section['id'] . '" class="tab-content">';
        do_settings_fields( $page, $section['id'] );
        echo '</div></div>';
    }
}

function acp_panel_menu() {
    echo '<ul class="tabs-menu">';
    echo '    <li class="current">';
    echo '        <a href="#acp_semantics">' . __('Semantics', 'acp') . '</a>';
    echo '     </li>';
    echo '     <li>';
    echo '        <a href="#acp_visual">' . __('Visual', 'acp') . '</a>';
    echo '     </li>';
    echo '     <li>';
    echo '        <a href="#acp_toolbar">' . __('Toolbar', 'acp') . '</a>';
    echo '     </li>';
    echo '     <li>';
    echo '        <a href="#acp_skiplinks">' . __('Skiplinks', 'acp'). '</a>';
    echo '     </li>';
    echo '</ul>';
}
function acp_panel_header() {
    echo '<header id="acp-panel-header">';
    echo '    <h1>Accessible Poetry</h1>';
    echo '     <p>' . __('Opening WordPress sites to people with disabilites', 'acp') . '</p>';
    echo '</header>';
}
function acp_panel_sidebar() {
    echo '<div id="acp-panel-sidebar">';
    echo '    <div class="acp-panel-widgets">';
    echo '      <div class="acp-widget">';
    echo '          <h2>' . __("Upgrade to PRO for only", "acp") . ' $' . acp_get_pro_price() . '</h2>';
    echo '          <div class="acp-ad-content">';
    echo '          <p>' . __('And enjoy the following extra options:', 'acp') . '</p>';
    echo '          <ul>';
    echo '            <li>' . __('5 Different Toolbar Skins!', 'acp') . '</li>';
    echo '            <li>' . __('3 Different Icons for the Toolbar Main Icon', 'acp') . '</li>';
    echo '            <li>' . __('No Author Link', 'acp') . '</li>';

    echo '            <li>' . __('3 Different Skiplinks skins!', 'acp') . '</li>';

    echo '            <li>' . __('Unlimited Replacement Tags', 'acp') . '</li>';
    echo '            <li>' . __('Full Customization of Contrast Colors', 'acp') . '</li>';
    echo '            <li>' . __('Custom Color for the Focus Outline', 'acp') . '</li>';
    echo '            <li>' . __('Full Control on which  objects get Tabindex', 'acp') . '</li>';
    echo '            <li>' . __('Accessibility Checker Tool (beta)', 'acp') . '</li>';
    echo '          </ul>';
    echo '      </div>';
    echo '    </div>';
    echo '</div>';
}
function acp_get_pro_price() {
    return '16';
}
function acp_upgrade_link() {
    return 'http://www.accessible-poetry.com/';
}
function acp_upgrade_promote($text = null) {
    $output  = '<span class="acp-promote">';
    if( !$text )
        $output .= __('Want more?', 'acp');
    else $output .= $text;
    $output .= ' <a href="' . acp_upgrade_link() . '">' . __('Upgrade to PRO', 'acp') . '</a>';
    $output .= '</span>';
    return $output;
}


