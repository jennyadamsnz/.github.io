<?php
/*
 * Accessible Poetry Panel
 *
 * Creates the options panel
 * on the administration side.
 *
 * @since 2.0.1
 */

class Accessible_Poetry {

    private $options;

    public function __construct() {

        // register the panel page
        add_action( 'admin_menu', array( $this, 'register_panel_page' ) );

        // Initialize & Sanitize the panel page fields
        add_action( 'admin_init', array( $this, 'page_init' ) );

        // Register scripts & style on the administration side
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ) );
    }

    public function register_panel_page() {
	    add_menu_page(
		    'Accessible Poetry',
			__('Accessibility', 'acp'),
			'manage_options',
			'accessible-poetry',
			array( $this, 'create_panel_page' ),
			'dashicons-yes',
			72
	    );
    }

    public function create_panel_page() {

        // get the array with all our settings
        $this->options = get_option( 'accessible_poetry' );

        echo '<div id="accessible-poetry-panel">';
                  acp_panel_header();
        echo '    <div id="acp-admin-row">';
        echo '      <div id="acp-panel-content">';
        echo '          <form method="post" action="options.php">';
                            settings_fields( 'acp_group' );
        echo '              <div id="acp-tabs-container">';
                                acp_panel_menu();
                                acp_do_settings_sections( 'accessible-poetry' );
        echo '              </div>';
                            submit_button();
        echo '          </form>';
        echo '      </div>';
        if( acp_proAvailable() ) acp_panel_sidebar();
        echo '    </div>';
        echo '</div>';
    }

    /*
     *  Panel page fields initialization
     */
    public function page_init() {

        /*
         * Register the settings group and
         * call the Sanitize function
         */
        register_setting(
            'acp_group',
            'accessible_poetry',
            array( $this, 'sanitize' )
        );

		/*
		 * Add our Sections
		 */

		// Semantics section
        add_settings_section(
            'acp_semantics',
            __('Semantics', 'acp'),
            array( $this, 'empty_section_info' ),
            'accessible-poetry'
        );

        // Visual section
        add_settings_section(
            'acp_visual',
            __('Visual', 'acp'),
            array( $this, 'empty_section_info' ),
            'accessible-poetry'
        );

        // Toolbar section
        add_settings_section(
            'acp_toolbar',
            __('Toolbar', 'acp'),
            array( $this, 'empty_section_info' ),
            'accessible-poetry'
        );

        // Skiplinks section
        add_settings_section(
            'acp_skiplinks',
            __('Skiplinks', 'acp'),
            array( $this, 'empty_section_info' ),
            'accessible-poetry'
        );

		/*
		 * Add our Fields
		 */

		// language attribute
        add_settings_field(
            'html_lang', '',
            array( $this, 'html_lang_callback' ),
            'accessible-poetry',
            'acp_semantics'
        );

        // empty images alt
        add_settings_field(
            'image_alt', '',
            array( $this, 'image_alt_callback' ),
            'accessible-poetry',
            'acp_semantics'
        );

        // remove unnecessary tabindex
        add_settings_field(
            'remove_tabindex', '',
            array( $this, 'remove_tabindex_callback' ),
            'accessible-poetry',
            'acp_semantics'
        );

        // replace titles with aria-labels
        add_settings_field(
            'links_arialabel', '',
            array( $this, 'links_arialabel_callback' ),
            'accessible-poetry',
            'acp_semantics'
        );

        // logo identifier
        add_settings_field(
            'logo_identifier', '',
            array( $this, 'logo_identifier_callback' ),
            'accessible-poetry',
            'acp_semantics'
        );

        // logo directive
        add_settings_field(
            'logo_directive', '',
            array( $this, 'logo_directive_callback' ),
            'accessible-poetry',
            'acp_semantics'
        );

        // replacement tag 1
        add_settings_field(
            'tag_replacement1_callback', '',
            array( $this, 'tag_replacement1_callback' ),
            'accessible-poetry',
            'acp_semantics'
        );

        // replacement tag 2
        add_settings_field('tag_replacement2_callback', '',
            array( $this, 'tag_replacement2_callback' ),
            'accessible-poetry',
            'acp_semantics'
        );

        // replacement tag 3
        add_settings_field(
            'tag_replacement3_callback', '',
            array( $this, 'tag_replacement3_callback' ),
            'accessible-poetry',
            'acp_semantics'
        );

        // outline on focus mode
        add_settings_field(
            'link_outline', '',
            array( $this, 'link_outline_callback' ),
            'accessible-poetry',
            'acp_visual'
        );

        // add link underline
        add_settings_field(
            'link_underline', '',
            array( $this, 'link_underline_callback' ),
            'accessible-poetry',
            'acp_visual'
        );

        // enable manual toolbar
        add_settings_field(
            'enable_manual_toolbar', '',
            array( $this, 'enable_manual_toolbar_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // enable ajax toolbar
        add_settings_field(
            'enable_toolbar', '',
            array( $this, 'enable_ajax_toolbar_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // disable toolbar on mobile
        add_settings_field(
            'disable_mobile_toolbar', '',
            array( $this, 'disable_mobile_toolbar_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // declaration link
        add_settings_field(
            'declaration_link',
            '',
            array( $this, 'declaration_link_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // contact link
        add_settings_field(
            'contact_link', '',
            array( $this, 'contact_link_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // hide font size
        add_settings_field(
            'hide_fontsizer', '',
            array( $this, 'hide_fontsizer_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // hide contrast
        add_settings_field(
            'hide_contrast', '',
            array( $this, 'hide_contrast_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // hide underline
        add_settings_field(
            'hide_underline', '',
            array( $this, 'hide_underline_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // hide linkmark
        add_settings_field(
            'hide_linkmark', '',
            array( $this, 'hide_linkmark_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // hide readable
        add_settings_field(
            'hide_readable', '',
            array( $this, 'hide_readable_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // hide animation
        add_settings_field(
            'hide_animation', '',
            array( $this, 'hide_animation_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // Toolbar Style
        add_settings_field(
            'toolbar_skin', '',
            array( $this, 'toolbar_skin_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // toolbar side
        add_settings_field(
            'toolbar_side', '',
            array( $this, 'toolbar_side_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // Icon size
        add_settings_field(
            'icon_size', '',
            array( $this, 'icon_size_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        add_settings_field(
            'icon_position', '',
            array( $this, 'icon_position_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // include tags on font sizer
        add_settings_field(
            'fontsizer_include', '',
            array( $this, 'fontsizer_include_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // exclude tags on font sizer
        add_settings_field(
            'fontsizer_exclude', '',
            array( $this, 'fontsizer_exclude_callback' ),
            'accessible-poetry',
            'acp_toolbar'
        );

        // activate skiplinks manual
        add_settings_field(
            'enable_manual_skiplinks', '',
            array( $this, 'enable_manual_skiplinks_callback' ),
            'accessible-poetry',
            'acp_skiplinks'
        );

        // activate skiplinks with ajax
        add_settings_field(
            'enable_ajax_skiplinks', '',
            array( $this, 'enable_ajax_skiplinks_callback' ),
            'accessible-poetry',
            'acp_skiplinks'
        );

        // activate skiplinks for home
        add_settings_field(
            'skiplinks_home', '',
            array( $this, 'skiplinks_home_callback' ),
            'accessible-poetry',
            'acp_skiplinks'
        );

        // skiplinks side
        add_settings_field(
            'skiplinks_side', '',
            array( $this, 'skiplinks_side_callback' ),
            'accessible-poetry',
            'acp_skiplinks'
        );

    }

    /*
     * Sanitize the information
     */
    public function sanitize( $input ) {

        $new_input = array();

        foreach ($input as $key => $value) {
            $new_input[$key] = $value;
        }

        return $new_input;
    }

    /////////////// SECTIONS CALLBACKS

    public function empty_section_info() {}

    /////////////// FIELDS CALLBACKS

    /*
     * Add language attribute to html tag
     *
     * @type    checkbox
     * @id      html_lang
     * @since   2.0.1
     */
    public function html_lang_callback() {

        $field  = '<h2>' . __('Attributes', 'acp') . '</h2>';
        $field .= '<fieldset class="acp-fieldset">';
        $field .= '    <h3>' . __('LANG Attribute', 'acp') . '</h3>';
        $field .=      '<p>' . __('At the beginning of each HTML document there is an opening tag that looks like this: &lt;html&gt;, which surrounds the entire document. this tag need to have a language attribute with the document language code as a value. the option below will force the &lt;html&gt; tag to have the language attribute with the right value.', 'acp') . '</p>';
        $field .= '    <label>';
        $field .= '        <input type="checkbox" id="html_lang" name="accessible_poetry[html_lang]" value="1" ' . checked( '1', isset( $this->options['html_lang'] ), false ) . '>';
        $field .=           __('Add Language Attribute to the &lt;html&gt; tag', 'acp');
        $field .= '    </label>';
        $field  .= '</fieldset>';
        printf(
            $field,
            isset( $this->options['html_lang'] ) ? esc_attr( $this->options['html_lang']) : ''
        );
    }

    /*
     * Add alt attribute to images without alt
     *
     * @type    checkbox
     * @id      image_alt
     * @since   2.0.1
     */
    public function image_alt_callback() {

        $field  = '<fieldset class="acp-fieldset">';
        $field .= '    <h3>' . __('ALT Attribute', 'acp') . '</h3>';
        $field .= '    <label>';
        $field .= '        <input type="checkbox" id="image_alt" name="accessible_poetry[image_alt]" value="1" ' . checked( '1', isset( $this->options['image_alt'] ), false ) . '>';
        $field .=           __('Add empty Alt attribute to images without an Alt attribute', 'acp');
        $field .= '    </label>';
        $field  .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['image_alt'] ) ? esc_attr( $this->options['image_alt']) : ''
        );
    }

    /*
     * Add aria-label to links
     *
     * @type    radio
     * @id      links_arialabel
     * @since   2.1.1
     */
    public function links_arialabel_callback() {

        $none = ''; $replace = ''; $add = '';
		$title_attr = $this->options['title_attr'];
		
        if( $title_attr == 'none' )
            $none = ' selected';
        elseif( $title_attr == 'replace' )
            $replace = ' selected';

        elseif( $title_attr == 'add' )
            $add = ' selected';

        $linkTitle = 'read more about the title attribute';

        $field  = '<fieldset class="acp-fieldset select">';
        $field .= '<h3>' . __('TITLE Attribute', 'acp') . '</h3>';
        $field .= '<p>' . __('The \'title\' attribute specifies extra information about an element', 'acp') . ' ';
        $field .= ( acp_proAvailable() ) ? '(<a href=“http://www.w3schools.com/tags/att_global_title.asp” title=“'.$linkTitle.'” aria-label=“'.$linkTitle.'”>'.__('read more','acp').'</a>).':'';
        $field .= __('apparently, some popular screen readers ignore that attribute, so to pass the extra information that the \'title\' attribute holds we can use the \'aria-label\' attribute.', 'acp') . '</p>';
        $field .= __('At the option below you can determine weather to replace the \'title\' attribute with an \'aria-label\' attribute, or to add extra \'aria-label\' attribute with the value of the \'title\' attribute', 'acp') . '</p>';
        $field .= ' <label for="title_attr">' . __('Title Attribte Behavior', 'acp') . '</label>';
        $field .= ' <select name="accessible_poetry[title_attr]" id="title_attr">';
        $field .= '     <option value="none"' . $none . '>' . __('-- None --', 'acp') . '</option>';
        $field .= '     <option value="replace"' . $replace . '>' . __('Replace the \'title\' attribute with \'aria-label\' attribute (value will remain the same)', 'acp') . '</option>';
        $field .= '     <option value="add"' . $add . '>' . __('Add extra \'aria-label\' attribute to all objects that have \'title\' attribute', 'acp') . '</option>';
        $field .= ' </select>';
        $field .= ' </fieldset>';

        printf(
            $field,
            isset( $this->options['links_arialabel'] ) ? esc_attr( $this->options['links_arialabel']) : ''
        );
    }

    /*
     * Add outline to all links when
     * they're on focus mode
     *
     * @type    radio
     * @id      link_outline
     * @since   2.0.1
     */
    public function link_outline_callback() {

        $none = '';$red = '';$blue = '';

        // PRO ONLY
        $custom = '';

        // Check if and which option is selected
        if( $this->options['link_outline'] == 'none' )
            $none = ' selected';
        elseif( $this->options['link_outline'] == 'red' )
            $red = ' selected';
        elseif( $this->options['link_outline'] == 'blue' )
            $blue = ' selected';

        $field  = '<h2>' . __('Focus', 'acp') . '</h2>';
        $field .= '<fieldset class="acp-fieldset select">';
        $field .= '<label for="acp_link_outline">' .  __('Add outline to all necessary objects when they\'re in focus', 'acp') . '</label>';
        $field .= '<select name="accessible_poetry[link_outline]" id="acp_link_outline">';
        $field .= ' <option value="none"' . $none . '>' . __('-- None --', 'acp') . '</option>';
        $field .= ' <option value="red"' . $red . '>' . __('Red Outline', 'acp') . '</option>';
        $field .= ' <option value="blue"' . $blue . '>' . __('Blue Outline', 'acp') . '</option>';

        // PRO ONLY
        $field .= ' <option value="custom" disabled>' . __('Custom Color (PRO Only)', 'acp') . '</option>';

        $field .= '</select>';
        if( acp_proAvailable() ) {
	        acp_upgrade_promote();
	    }
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['link_outline'] ) ? esc_attr( $this->options['link_outline']) : ''
        );
    }

    /*
     * Add underline to all links
     *
     * @type    checkbox
     * @id      link_underline
     * @since   2.0.1
     */
    public function link_underline_callback() {
        $field  = '<h3>' . __('Links', 'acp') . '</h3>';
        $field .= '<fieldset class="acp-fieldset">';
        $field .= '<label>';
        $field .= '<input type="checkbox" id="link_underline" name="accessible_poetry[link_underline]" value="1" ' . checked( '1', isset( $this->options['link_underline'] ), false ) . '>';
        $field .= __('Add underline to all links in focus & hover mode', 'acp') . '</label>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['link_underline'] ) ? esc_attr( $this->options['link_underline']) : ''
        );
    }

    /*
     * Remove tabindex attribute
     *
     * @type    checkbox
     * @id      remove_tabindex
     * @since   2.0.1
     */
    public function remove_tabindex_callback() {
        $field  = '<h3>' . __('TABINDEX Attribute', 'acp') . '</h3>';
        $field .= '<fieldset class="acp-fieldset">';
        $field .= '<label>';
        $field .= '<input type="checkbox" id="remove_tabindex" name="accessible_poetry[remove_tabindex]" value="1" ' . checked( '1', isset( $this->options['remove_tabindex'] ), false ) . '>';
        $field .= __('Remove unnecessary tabindex attributes', 'acp') . '</label>';
        $field .= ( acp_proAvailable() ) ? acp_upgrade_promote( __('Want more control on the Tabindex?', 'acp') ) : '';
        $field .= '</fieldset>';
        printf(
            $field,
            isset( $this->options['remove_tabindex'] ) ? esc_attr( $this->options['remove_tabindex']) : ''
        );
    }

    /*
     * Enable Manual Toolbar
     *
     * @type    checkbox
     * @id      enable_manual_toolbar
     * @since   2.0.1
     */
    public function enable_manual_toolbar_callback() {

        $field  = '<fieldset id="acp-manual-activation" class="acp-fieldset toolbar-activation">';
        $field .= ' <h2>' . __('General', 'acp') . '</h2>';
        $field .= ' <p>' . __('To see the Toolbar on your WordPress site you must first activate it. there are two ways to activate the toolbar, the manual way & the auto way.', 'acp');
        $field .= '<h3>' . __('Toolbar Manual Activation', 'acp') . '</h3>';
        $field .= '<div class="acp-toggle">';
        $field .= '<p>' . __('This is the recommended way to activate the toolbar but it is also an advanced way so remember: Do not mess with it if you not familiar with WordPress theme files.', 'acp') . '</p>';
        $field .= '<p>' . __('To activate the toolbar manually please follow the instructions below:', 'acp') . '</p>';
        $field .= '<ol>';
        $field .= '    <li>' . __('Activate the Manual Toolbar checkbox', 'acp'). '</li>';
        $field .= '    <li>' . __('Open the file \'header.php\' from your theme folder', 'acp'). '</li>';
        $field .= '    <li>' . __('Locate the opening body tag (it need to look like this: <code>&lt;body&gt;</code>)', 'acp'). '</li>';
        $field .= '    <li>' . __('Insert the next code right after the opening body tag (if you using also the skiplinks please add this before the skiplinks):', 'acp');
        $field .= '        <pre><code>&lt;?php if(function_exists(\'acp_toolbar\') ) { acp_toolbar(); }?&gt;</code></pre>';
        $field .= '    </li>';
        $field .= '</ol>';
        $field .= '<label for="enable_manual_toolbar">';
        $field .= '<input type="checkbox" id="enable_manual_toolbar" name="accessible_poetry[enable_manual_toolbar]" value="1" ' . checked( '1', isset( $this->options['enable_manual_toolbar'] ), false ) . '>';
        $field .= __('Enable the Accessibility Toolbar Manually', 'acp') . '</label>';
        $field .= '</div>';
        $field .= '<div class="acp-not-activated">' . __('The Manual Activation is disabled because the auto activation is active.', 'acp') . '</div>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['enable_manual_toolbar'] ) ? esc_attr( $this->options['enable_manual_toolbar']) : ''
        );
    }

    /*
     * Enable Ajax Toolbar
     *
     * @type    checkbox
     * @id      enable_ajax_toolbar
     * @since   2.0.1
     */
    public function enable_ajax_toolbar_callback() {

        $field  = '<fieldset id="acp-ajax-activation" class="acp-fieldset toolbar-activation">';
        $field .= '<h3>' . __('Auto Activation', 'acp') . '</h3>';
        $field .= '<div class="acp-toggle">';
        $field .= '<p>' . __('In the Automatic Activation the toolbar will be loaded with Ajax calls. all you need to do is to check the next checkbox.', 'acp') . '</p>';
        $field .= '<label for="enable_ajax_toolbar">';
        $field .= '<input type="checkbox" id="enable_ajax_toolbar" name="accessible_poetry[enable_ajax_toolbar]" value="1" ' . checked( '1', isset( $this->options['enable_ajax_toolbar'] ), false ) . '>';
        $field .= __('Enable the Accessibility Toolbar with Ajax call', 'acp') . '</label>';
        $field .= '</div>';
        $field .= '<div class="acp-not-activated">' . __('The Auto Activation is disabled because the manual activation is active.', 'acp') . '</div>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['enable_ajax_toolbar'] ) ? esc_attr( $this->options['enable_ajax_toolbar']) : ''
        );
    }

    /*
     * Disable Toolbar on mobile devices
     *
     * @type    checkbox
     * @id      disable_mobile_toolbar
     * @since   2.0.1
     */
    public function disable_mobile_toolbar_callback() {

        $field  = '<h3>' . __('Additional Settings', 'acp') . '</h3>';
        $field .= '<fieldset class="acp-fieldset">';
        $field .= '<label for="disable_mobile_toolbar">';
        $field .= '<input type="checkbox" id="disable_mobile_toolbar" name="accessible_poetry[disable_mobile_toolbar]" value="1" ' . checked( '1', isset( $this->options['disable_mobile_toolbar'] ), false ) . '>';
        $field .= __('Disable toolbar for mobile users', 'acp') . '</label>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['disable_mobile_toolbar'] ) ? esc_attr( $this->options['disable_mobile_toolbar']) : ''
        );
    }

    /*
     * Toolbar Skins
     *
     * @type    checkbox
     * @id      toolbar_skin
     * @since   2.1.1
     */
    public function toolbar_skin_callback() {

        $skin_flat = '';
        $skin_solid = '';
        $skin = $this->options['toolbar_skin'];

        if( $skin == '1' ) {
            $skin_solid = ' selected';
        }
        elseif( $skin == '2' ) {
            $skin_flat = ' selected';
        }

        $field  = '<h2>' . __('Customization', 'acp') . '<span class="badge">' . __('NEW', 'acp') . '</span></h2>';
        $field .= '<fieldset class="acp-fieldset select">';
        $field .= '<label for="toolbar_skin">' . __('Toolbar style', 'acp') . '</label>';
        $field .= ' <select name="accessible_poetry[toolbar_skin]" id="toolbar_skin">';
        $field .= '     <option value="1"' . $skin_solid . '>' . __('Solid', 'acp') . '</option>';
        $field .= '     <option value="2"' . $skin_flat . '>' . __('Flat', 'acp') . '</option>';
        $field .= '     <option value="3" disabled>' . __('Minimal (PRO Only)', 'acp') . '</option>';
        $field .= '     <option value="4" disabled>' . __('Rounded (PRO Only)', 'acp') . '</option>';
        $field .= '     <option value="5" disabled>' . __('Fancy (PRO Only)', 'acp') . '</option>';

        $field .= ' </select>';
        if( acp_proAvailable() )
	        $field .= ' <p>' . acp_upgrade_promote() . '</p>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['toolbar_skin'] ) ? esc_attr( $this->options['toolbar_skin']) : ''
        );
    }

    /*
     * toolbar side
     *
     * @type    dropdown
     * @id      toolbar_side
     * @since   2.1.1
     */
    public function toolbar_side_callback() {
        $left = ''; $right = '';
        if( $this->options['toolbar_side'] == 'right' ) {
            $right = ' selected';

        }
        elseif( $this->options['toolbar_side'] == 'left' ) {

            $left = ' selected';
        }
        $field  = '<fieldset class="acp-fieldset select">';
        $field .= '<label for="toolbar_side">' . __('Toolbar Side', 'acp') . '</label>';
        $field .= ' <select name="accessible_poetry[toolbar_side]" id="toolbar_side">';
        $field .= '     <option value="left"' . $left . '>' . __('Left', 'acp') . '</option>';
        $field .= '     <option value="right"' . $right . '>' . __('Right', 'acp') . '</option>';
        $field .= ' </select>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['toolbar_side'] ) ? esc_attr( $this->options['toolbar_side']) : ''
        );
    }

    /*
     * Icon size
     *
     * @type    checkbox
     * @id      icon_size
     * @since   2.1.1
     */
    public function icon_size_callback() {
        $large = ''; $small = '';
        $icon_size = $this->options['icon_size'];
        
        if( $icon_size == 'large' ) {
            $large = ' selected';
        }
        elseif( $icon_size == 'small' ) {
            $small = ' selected';
        }
        $field  = '<fieldset class="acp-fieldset select">';
        $field .= '<label for="icon_size">' . __('Icon Size', 'acp') . '</label>';
        $field .= ' <select name="accessible_poetry[icon_size]" id="icon_size">';
        $field .= '     <option value="large"' . $large . '>' . __('Large', 'acp') . '</option>';
        $field .= '     <option value="small"' . $small . '>' . __('Small', 'acp') . '</option>';
        $field .= ' </select>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['icon_size'] ) ? esc_attr( $this->options['icon_size']) : ''
        );
    }

    /*
     * Icon position
     *
     * @type    checkbox
     * @id      icon_position
     * @since   2.1.1
     */
    public function icon_position_callback() {

        $field  = '<fieldset class="acp-fieldset">';
        $field .= '<label for="icon_position">' . __('Icon Position from top (in pixels, default is 30)', 'acp') . '</label>';
        
        if( acp_proAvailable() ) {
	        $afterField = '<p>' . __('Want to change the icon to something else?') . ' ' . '<a href="' . acp_upgrade_link() . '">' . __('Upgrade to PRO') . '</a> ' . __('and get the ability to choose from 3 different icons!') . '</p>';
        }

        printf(
            $field . '<input type="number" min="30" max="240" value="%s" name="accessible_poetry[icon_position]" id="icon_position"><span class="px">px</span></fieldset>' . $afterField,
            isset( $this->options['icon_position'] ) ? esc_attr( $this->options['icon_position']) : ''
        );
    }

    /*
     * Activate the declaration button
     * on the toolbar
     *
     * @type    checkbox
     * @id      declaration_link
     * @since   2.0.1
     */
    public function declaration_link_callback() {

        $field  = '<h3>' . __('Additional Buttons', 'acp') . '</h3>';
        $field .= '<fieldset class="acp-fieldset">';
        $field .= '<label for="declaration_link">' . __('Add additional button for Accessibility Declaration (leave blank to disable)', 'acp') . '</label>';

        printf(
            $field . '<input type="text" id="declaration_link" name="accessible_poetry[declaration_link]" placeholder="http://" value="%s" /></fieldset>',
            isset( $this->options['declaration_link'] ) ? esc_attr( $this->options['declaration_link']) : ''
        );
    }

    /*
     * Contact button url
     * on toolbar
     *
     * @type    checkbox
     * @id      contact_link
     * @since   2.0.1
     */
    public function contact_link_callback() {

        $field  = '<fieldset class="acp-fieldset">';
        $field .= '<label for="contact_link">' . __('Add additional button for Contact page (leave blank to disable)', 'acp') . '</label>';

        printf(
            $field . '<input type="text" id="contact_link" name="accessible_poetry[contact_link]" placeholder="http://" value="%s" /></fieldset>',
            isset( $this->options['contact_link'] ) ? esc_attr( $this->options['contact_link']) : ''
        );
    }

    /*
     * Hide the font size changing buttons
     * from the toolbar
     *
     * @type    checkbox
     * @id      hide_fontsizer
     * @since   2.0.1
     */
    public function hide_fontsizer_callback() {
        $field  = '<h3>' . __('Buttons Visibility', 'acp') . '</h3>';
        $field .= '<fieldset class="acp-fieldset">';
        $field .= '<label for="hide_fontsizer">';
        $field .= '<input type="checkbox" id="hide_fontsizer" name="accessible_poetry[hide_fontsizer]" value="1" ' . checked( '1', isset( $this->options['hide_fontsizer'] ), false ) . '>';
        $field .= __('Hide the buttons that change the font size', 'acp') . '</label>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['hide_fontsizer'] ) ? esc_attr( $this->options['hide_fontsizer']) : ''
        );
    }

    /*
     * Hide the contrast changing buttons
     * from the toolbar
     *
     * @type    checkbox
     * @id      hide_contrast
     * @since   2.0.1
     */
    public function hide_contrast_callback() {

        $field  = '<fieldset class="acp-fieldset">';
        $field .= '<label for="hide_contrast">';
        $field .= '<input type="checkbox" id="hide_contrast" name="accessible_poetry[hide_contrast]" value="1" ' . checked( '1', isset( $this->options['hide_contrast'] ), false ) . '>';
        $field .= __('Hide the buttons that change the contrast', 'acp') . '</label>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['hide_contrast'] ) ? esc_attr( $this->options['hide_contrast']) : ''
        );
    }

    /*
     * Hide the link underline button
     * from the toolbar
     *
     * @type    checkbox
     * @id      hide_underline
     * @since   2.0.1
     */
    public function hide_underline_callback() {

        $field  = '<fieldset class="acp-fieldset">';
        $field .= '<label for="hide_underline">';
        $field .= '<input type="checkbox" id="hide_underline" name="accessible_poetry[hide_underline]" value="1" ' . checked( '1', isset( $this->options['hide_underline'] ), false ) . '>';
        $field .= __('Hide the button that add underline to links', 'acp') . '</label>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['hide_underline'] ) ? esc_attr( $this->options['hide_underline']) : ''
        );
    }

    /*
     * Hide the link mark button
     * from the toolbar
     *
     * @type    checkbox
     * @id      hide_linkmark
     * @since   2.0.1
     */
    public function hide_linkmark_callback() {

        $field  = '<fieldset class="acp-fieldset">';
        $field .= '<label for="hide_linkmark">';
        $field .= '<input type="checkbox" id="hide_linkmark" name="accessible_poetry[hide_linkmark]" value="1" ' . checked( '1', isset( $this->options['hide_linkmark'] ), false ) . '>';
        $field .= __('Hide the button that mark the links', 'acp') . '</label>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['hide_linkmark'] ) ? esc_attr( $this->options['hide_linkmark']) : ''
        );
    }

    /*
     * Hide the readable font button
     * from the toolbar
     *
     * @type    checkbox
     * @id      hide_readable
     * @since   2.0.1
     */
    public function hide_readable_callback() {

        $field  = '<fieldset class="acp-fieldset">';
        $field .= '<label for="hide_readable">';
        $field .= '<input type="checkbox" id="hide_readable" name="accessible_poetry[hide_readable]" value="1" ' . checked( '1', isset( $this->options['hide_readable'] ), false ) . '>';
        $field .= __('Hide the button that change the font to readable', 'acp') . '</label>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['hide_readable'] ) ? esc_attr( $this->options['hide_readable']) : ''
        );
    }

    /*
     * Hide the disable animation button
     * from the toolbar
     *
     * @type    checkbox
     * @id      hide_animation
     * @since   2.0.1
     */
    public function hide_animation_callback() {

        $field  = '<fieldset class="acp-fieldset">';
        $field .= '<label for="hide_animation">';
        $field .= '<input type="checkbox" id="hide_animation" name="accessible_poetry[hide_animation]" value="1" ' . checked( '1', isset( $this->options['hide_animation'] ), false ) . '>';
        $field .= __('Hide the button that disable the animations', 'acp') . '</label>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['hide_animation'] ) ? esc_attr( $this->options['hide_animation']) : ''
        );
    }

    /*
     * Include objects on the font size changing
     * button on the toolbar
     *
     * @type    text
     * @id      fontsizer_include
     * @since   2.0.1
     */
    public function fontsizer_include_callback() {

        $field  = '<h2>' . __('Font Size Change Options', 'acp') . '</h2>';
        $field .= '<fieldset class="acp-fieldset code-editor">';
        $field .= '<label for="fontsizer_include">' . __('Include additional objects to affect with the font size change options at the toolbar by adding the object class or id (separate objects with a comma)', 'acp') . '</label>';
        $field .= '<textarea id="fontsizer_include"  class="acp-code-editor" name="accessible_poetry[fontsizer_include]" placeholder=".class-name, #id-name">';
        printf(
            $field . '%s</textarea></fieldset>',
            isset( $this->options['fontsizer_include'] ) ? esc_attr( $this->options['fontsizer_include']) : ''
        );
    }

    /*
     * Include objects from the font size changing
     * button on the toolbar
     *
     * @type    text
     * @id      fontsizer_exclude
     * @since   2.0.1
     */
    public function fontsizer_exclude_callback() {

        $field  = '<fieldset class="acp-fieldset code-editor">';
        $field .= '<label for="fontsizer_exclude code-editor">' . __('Exclude objects from the effect of the font size change options at the toolbar by adding the object class or id (separate objects with a comma)', 'acp') . '</label>';
        $field .= '<textarea id="fontsizer_exclude"  class="acp-code-editor" name="accessible_poetry[fontsizer_exclude]" placeholder=".class-name, #id-name">';
        printf(
            $field . '%s</textarea></fieldset>',
            isset( $this->options['fontsizer_exclude'] ) ? esc_attr( $this->options['fontsizer_exclude']) : ''
        );
    }

    /*
     * Activate the Skiplinks
     *
     * @type    checkbox
     * @id      enable_manual_skiplinks
     * @since   2.0.1
     */
    public function enable_manual_skiplinks_callback() {

        $field  = '<h2>' . __('General', 'acp') . '</h2>';
        $field .= '<p>' . __('Skiplinks are buttons that helps navigate through the central regions of the page using the Tab key.', 'acp') . '</p>';
        $field .= '<p>' . __('There are two ways to activate the Skiplinks, the manual way & the auto way.', 'acp') . '</p>';
        $field .= '<h3>' . __('Skiplinks Manual Activation', 'acp') . '</h3>';

        $field .= '<fieldset id="acp-manual-skiplinks" class="acp-fieldset skiplinks-activation">';
        $field .= '<div class="acp-toggle">';
        $field .= '<p>' . __('This is the recommended way to activate the Skiplinks but it is also an advanced way so remember: Do not mess with it if you not familiar with WordPress theme files.', 'acp') . '</p>';
        $field .= '<p>' . __('To activate the Skiplinks manually please follow the instructions below:', 'acp') . '</p>';
        $field .= '<ol>';
        $field .= '    <li>' . __('Activate the Manual Skiplinks checkbox', 'acp'). '</li>';
        $field .= '    <li>' . __('Open the file \'header.php\' from your theme folder', 'acp'). '</li>';
        $field .= '    <li>' . __('Locate the opening body tag (it need to look like this: <code>&lt;body&gt;</code>)', 'acp'). '</li>';
        $field .= '    <li>' . __('Insert the next code right after the opening body tag (if you using also the toolbar please add this after the toolbar):', 'acp');
        $field .= '        <pre><code>&lt;?php if(function_exists(\'acp_skiplinks\') ) { acp_skiplinks(); }?&gt;</code></pre>';
        $field .= '    </li>';
        $field .= '</ol>';
        $field .= '<label for="enable_manual_skiplinks">';
        $field .= '<input type="checkbox" id="enable_manual_skiplinks" name="accessible_poetry[enable_manual_skiplinks]" value="1" ' . checked( '1', isset( $this->options['enable_manual_skiplinks'] ), false ) . '>';
        $field .= __('Enable the Skiplinks Manually', 'acp') . '</label>';
        $field .= '</div>';
        $field .= '<div class="acp-not-activated">' . __('Skiplinks Manual Activation is not available because the Skiplink Auto Activation is active.', 'acp') . '</div>';
        $field .= '</fieldset>';

        printf(
            $field,
            isset( $this->options['enable_manual_skiplinks'] ) ? esc_attr( $this->options['enable_manual_skiplinks']) : ''
        );
    }

    /*
     * Activate the Skiplinks with ajax
     *
     * @type    checkbox
     * @id      enable_ajax_skiplinks
     * @since   2.1.1
     */
    public function enable_ajax_skiplinks_callback() {

        $field  = '<h3>' . __('Skiplinks Auto Activation', 'acp') . '</h3>';

        $field .= '<fieldset id="acp-ajax-skiplinks" class="acp-fieldset skiplinks-activation">';
        $field .= '<div class="acp-toggle">';
        $field .= '<p>' . __('To activate the skiplinks automatically using Ajax call simply check the checkbox below.', 'acp') . '</p>';
        $field .= '<label for="enable_ajax_skiplinks">';
        $field .= '<input type="checkbox" id="enable_ajax_skiplinks" name="accessible_poetry[enable_ajax_skiplinks]" value="1" ' . checked( '1', isset( $this->options['enable_ajax_skiplinks'] ), false ) . '>';
        $field .= __('Enable the Auto Skiplinks Activation', 'acp') . '</label></div>';
        $field .= '<div class="acp-not-activated">' . __('Skiplinks Auto Activation is not available because the Skiplink Manual Activation is active.', 'acp') . '</div>';

        $field .= '</fieldset>';
        printf(
            $field,
            isset( $this->options['enable_ajax_skiplinks'] ) ? esc_attr( $this->options['enable_ajax_skiplinks']) : ''
        );
    }

    /*
     * Skiplinks side
     *
     * @type    checkbox
     * @id      skiplinks_side
     * @since   2.1.1
     *
     * PRO ONLY
     */
    public function skiplinks_side_callback() {

        $left = ''; $right = '';

        if( $this->options['skiplinks_side'] == 'left' )
            $left = ' selected';
        elseif( $this->options['skiplinks_side'] == 'right' )
            $right = ' selected';

        $field  = '<h2>' . __('Customization', 'acp') . '</h2>';
        $field .= '<fieldset class="acp-fieldset select">';
        $field .= '<label for="skiplinks_side">' . __('Skiplinks Side', 'acp') . '</label>';
        $field .= ' <select name="accessible_poetry[skiplinks_side]" id="skiplinks_side">';
        $field .= '     <option value="left"' . $left . '>' . __('Left', 'acp') . '</option>';
        $field .= '     <option value="right"' . $right . '>' . __('Right', 'acp') . '</option>';
        $field .= ' </select>';
        $field .= '</fieldset>';
        if( acp_proAvailable() )
	        $field .= '<p>' . __('Want to change the style of the Skiplinks?') . ' ' . '<a href="' . acp_upgrade_link() . '">' . __('Upgrade to PRO') . '</a> ' . __('and get the ability to choose from 3 different skins!') . '</p>';


        printf(
            $field,
            isset( $this->options['skiplinks_side'] ) ? esc_attr( $this->options['skiplinks_side']) : ''
        );
    }

    /*
     * Activate the special Skiplinks for Home page
     *
     * @type    checkbox
     * @id      skiplinks_home
     * @since   2.0.1
     */
    public function skiplinks_home_callback() {

        $field  = '<h2>' . __('Activate Special Skiplinks for Home Page', 'acp') . '</h2>';
        $field .= '<p>' . __('Customize special Skiplinks for Home page.', 'acp') . '</p>';
        $field .= '<label>';
        $field .= '<input type="checkbox" id="skiplinks_home" name="accessible_poetry[skiplinks_home]" value="1" ' . checked( '1', isset( $this->options['skiplinks_home'] ), false ) . ' />';
        $field .= __('Activate Home Page Skiplinks', 'acp');
        $field .= '</label>';

        printf(
            $field,
            isset( $this->options['skiplinks_home'] ) ? esc_attr( $this->options['skiplinks_home']) : ''
        );
    }

    /*
     * Logo Identifer
     *
     * @type    text
     * @id      logo_identifier
     * @since   2.1.1
     */
    public function logo_identifier_callback() {

        $field  = '<h2>' . __('Logo Semantics', 'acp') . ' <span class="badge">' . __('NEW', 'acp') . '</span></h2>';
        $field .= '<p>' . __('If the logo of your website is clickable and leads to the Home page, you should inform the user to where this link will lead him.', 'acp') . '</p>';
        $field .= '<p>' . __('The fields below will help you to add extra information on the logo link with the aria-label attribute:', 'acp') . '</p>';
        $field .= '<div class="acp-fieldset">';
        $field .= '<label for="logo_identifier">' . __('Write the Logo Identifier. for examplt: <code>#site-logo .logo</code>', 'acp') . '</label>';

        printf(
            $field . '<input type="text" name="accessible_poetry[logo_identifier]" id="logo_identifier" value="%s"></fieldset>',
            isset( $this->options['logo_identifier'] ) ? esc_attr( $this->options['logo_identifier']) : ''
        );
    }

    /*
     * Logo Label
     *
     * @type    text
     * @id      logo_identifier
     * @since   2.1.1
     */
    public function logo_directive_callback() {

        $field = '<fieldset class="acp-fieldset">';
        $field .= '<label for="logo_directive">' . __('Write the text that will guide the user. for examplt: <code>This link leads to the home page</code>', 'acp') . '</label>';

        printf(
            $field . '<input type="text" name="accessible_poetry[logo_directive]" id="logo_directive" value="%s"></fieldset>',
            isset( $this->options['logo_directive'] ) ? esc_attr( $this->options['logo_directive']) : ''
        );
    }

    /*
     * Change the Html tag of the given object to time
     *
     * @type    text
     * @id      tag_replacement1
     * @since   2.1.1
     */
    public function tag_replacement1_callback() {
        $fieldsetClasses = ( '' != $this->options['tag_replacement1'] || '' != $this->options['tag_replacement1_tag'] ) ? 'open' : '';

        $field  = '<h2 id="tag-replace">' . __('Tag Replacement', 'acp') . ' <span class="badge">' . __('NEW', 'acp') . '</span></h2>';
        $field .= '<p>' . __('In this section you can replace Html tags with a new tag and keep the attributes.', 'acp') . '</p>';
        $field .= '<p>' . __('For example you can change this:', 'acp') . '</p>';
        $field .= '<pre><code>&lt;div class="page-title"&gt;...&lt;/div&gt;</code></pre>';
        $field .= '<p>' . __('to this:', 'acp') . '</p>';
        $field .= '<pre><code>&lt;h1 class="page-title"&gt;...&lt;/h1&gt;</code></pre>';
        $field .= '<p>' . __('To do this you need to declare the object(s) and than choose a new tag name from the dropdown list:', 'acp') . '</p>';
        $field .= '<button type="button" id="acp-new-replacement" class="acp-btn-default">' . __('Add New Replacement Tag', 'acp') . ' (<span>3</span>)</button>';
        $field .= '<fieldset id="acp-fieldset-tag-1" class="acp-fieldset tag ' . $fieldsetClasses . '">';
        $field .= '<button class="close-tag" type="button" aria-label="' . __('Close Replacement tag 1 area', 'acp') . '">X</button>';
        $field .= '<label for="tag_replacement1">' . __('Add the objects you want to affect with the Replacement Tag 1', 'acp') . '</label>';


        $h1 = ''; $h2 = ''; $h3 = ''; $h4 = ''; $h5 = ''; $h6 = ''; $time = '';

        if( 'h1' == $this->options['tag_replacement1_tag'] ) {
            $h1 = ' selected';
        }
        elseif( 'h2' == $this->options['tag_replacement1_tag'] ) {
            $h2 = ' selected';
        }
        elseif( 'h3' == $this->options['tag_replacement1_tag'] ) {
            $h3 = ' selected';
        }
        elseif( 'h4' == $this->options['tag_replacement1_tag'] ) {
            $h4 = ' selected';
        }
        elseif( 'h5' == $this->options['tag_replacement1_tag'] ) {
            $h5 = ' selected';
        }
        elseif( 'h6' == $this->options['tag_replacement1_tag'] ) {
            $h6 = ' selected';
        }
        elseif( 'time' == $this->options['tag_replacement1_tag'] ) {
            $time = ' selected';
        }

        $dd  = '<fieldset class="acp-fieldset select">';
        $dd .= '<label for="tag_replacement1_tag">' . __('Choose the Tag', 'acp') . '</label>';
        $dd .= '<select id="tag_replacement1_tag" name="accessible_poetry[tag_replacement1_tag]">';
        $dd .= '    <option value=""' . $h1 . '>' . __('-- None --', 'acp') . '</option>';
        $dd .= '    <option value="h1"' . $h1 . '>' . __('Heading 1 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h2"' . $h2 . '>' . __('Heading 2 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h3"' . $h3 . '>' . __('Heading 3 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h4"' . $h4 . '>' . __('Heading 4 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h5"' . $h5 . '>' . __('Heading 5 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h6"' . $h6 . '>' . __('Heading 6 Tag', 'acp') . '</option>';
        $dd .= '    <option value="time"' . $time . '>' . __('Time Tag', 'acp') . '</option>';
        $dd .= '</select>';
        $dd .= '</fieldset>';

        printf(
            $field . '<textarea id="tag_replacement1" class="acp-code-editor" name="accessible_poetry[tag_replacement1]" placeholder=".class-name, #id-name">%s</textarea>',
            isset( $this->options['tag_replacement1'] ) ? esc_attr( $this->options['tag_replacement1']) : ''
        );
        printf(
            $dd . '</fieldset>',
            isset( $this->options['tag_replacement1_tag'] ) ? esc_attr( $this->options['tag_replacement1_tag']) : ''
        );
    }

    /*
     * Change the Html tag of the given object to time
     *
     * @type    text
     * @id      tag_replacement2
     * @since   2.1.1
     */
    public function tag_replacement2_callback() {
        $fieldsetClasses = ( '' != $this->options['tag_replacement2'] || '' != $this->options['tag_replacement2_tag'] ) ? 'open' : '';

        $field  = '<fieldset id="acp-fieldset-tag-2" class="acp-fieldset tag ' . $fieldsetClasses . '">';
        $field .= '<button class="close-tag" type="button" aria-label="' . __('Close Replacement tag 2 area', 'acp') . '">X</button>';
        $field .= '<label for="tag_replacement2">' . __('Replacement Tag 2', 'acp') . '</label>';

        $h1 = ''; $h2 = ''; $h3 = ''; $h4 = ''; $h5 = ''; $h6 = ''; $time = '';

        if( 'h1' == $this->options['tag_replacement2_tag'] ) {
            $h1 = ' selected';
        }
        elseif( 'h2' == $this->options['tag_replacement2_tag'] ) {
            $h2 = ' selected';
        }
        elseif( 'h3' == $this->options['tag_replacement2_tag'] ) {
            $h3 = ' selected';
        }
        elseif( 'h4' == $this->options['tag_replacement2_tag'] ) {
            $h4 = ' selected';
        }
        elseif( 'h5' == $this->options['tag_replacement2_tag'] ) {
            $h5 = ' selected';
        }
        elseif( 'h6' == $this->options['tag_replacement2_tag'] ) {
            $h6 = ' selected';
        }
        elseif( 'time' == $this->options['tag_replacement2_tag'] ) {
            $time = ' selected';
        }

        $dd  = '<fieldset class="acp-fieldset select">';
        $dd .= '<label for="tag_replacement2_tag">' . __('Choose the Tag', 'acp') . '</label>';
        $dd .= '<select id="tag_replacement2_tag" name="accessible_poetry[tag_replacement2_tag]">';
        $dd .= '    <option value="">' . __('-- None --', 'acp') . '</option>';
        $dd .= '    <option value="h1" ' . $h1 . '>' . __('Heading 1 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h2" ' . $h2 . '>' . __('Heading 2 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h3" ' . $h3 . '>' . __('Heading 3 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h4" ' . $h4 . '>' . __('Heading 4 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h5" ' . $h5 . '>' . __('Heading 5 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h6" ' . $h6 . '>' . __('Heading 6 Tag', 'acp') . '</option>';
        $dd .= '    <option value="time" ' . $time . '>' . __('Time Tag', 'acp') . '</option>';
        $dd .= '</select>';
        $dd .= '</fieldset>';

        printf(
            $field . '<textarea id="tag_replacement2" class="acp-code-editor" name="accessible_poetry[tag_replacement2]" placeholder=".class-name, #id-name">%s</textarea>',
            isset( $this->options['tag_replacement2'] ) ? esc_attr( $this->options['tag_replacement2']) : ''
        );
        printf(
            $dd . '</fieldset>',
            isset( $this->options['tag_replacement2_tag'] ) ? esc_attr( $this->options['tag_replacement2_tag']) : ''
        );
    }

    /*
     * Change the Html tag of the given object to time
     *
     * @type    text
     * @id      tag_replacement3
     * @since   2.1.1
     */
    public function tag_replacement3_callback() {
        $fieldsetClasses = ( '' != $this->options['tag_replacement3'] || '' != $this->options['tag_replacement3_tag'] ) ? 'open' : '';

        $field  = '<fieldset id="acp-fieldset-tag-3" class="acp-fieldset tag ' . $fieldsetClasses . '">';
        $field .= '<button class="close-tag" type="button" aria-label="' . __('Close Replacement tag 1 area', 'acp') . '">X</button>';
        $field .= '<label for="tag_replacement3">' . __('Replacement Tag 3', 'acp') . '</label>';

        $h1 = ''; $h2 = ''; $h3 = ''; $h4 = ''; $h5 = ''; $h6 = ''; $time = '';

        if( 'h1' == $this->options['tag_replacement3_tag'] ) {
            $h1 = ' selected';
        }
        elseif( 'h2' == $this->options['tag_replacement3_tag'] ) {
            $h2 = ' selected';
        }
        elseif( 'h3' == $this->options['tag_replacement3_tag'] ) {
            $h3 = ' selected';
        }
        elseif( 'h4' == $this->options['tag_replacement3_tag'] ) {
            $h4 = ' selected';
        }
        elseif( 'h5' == $this->options['tag_replacement3_tag'] ) {
            $h5 = ' selected';
        }
        elseif( 'h6' == $this->options['tag_replacement3_tag'] ) {
            $h6 = ' selected';
        }
        elseif( 'time' == $this->options['tag_replacement3_tag'] ) {
            $time = ' selected';
        }

        $dd  = '<fieldset class="acp-fieldset select">';
        $dd .= '<label for="tag_replacement3_tag">' . __('Choose the Tag', 'acp') . '</label>';
        $dd .= '<select id="tag_replacement3_tag" name="accessible_poetry[tag_replacement3_tag]">';
        $dd .= '    <option value="">' . __('-- None --', 'acp') . '</option>';
        $dd .= '    <option value="h1" ' . $h1 . '>' . __('Heading 1 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h2" ' . $h2 . '>' . __('Heading 2 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h3" ' . $h3 . '>' . __('Heading 3 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h4" ' . $h4 . '>' . __('Heading 4 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h5" ' . $h5 . '>' . __('Heading 5 Tag', 'acp') . '</option>';
        $dd .= '    <option value="h6" ' . $h6 . '>' . __('Heading 6 Tag', 'acp') . '</option>';
        $dd .= '    <option value="time" ' . $time . '>' . __('Time Tag', 'acp') . '</option>';
        $dd .= '</select>';
        $dd .= '</fieldset>';
		
		if( acp_proAvailable() ) {
			$afterField  = '<h3>' . __('Need More than 3 replacement tags?', 'acp') . '</h3>';
			$afterField .= '<p class="acp-marg-bottom">' . __('Want to have the ability to replace with any tag you want and with unlimited replacements?', 'acp') . ' <a href="' . acp_upgrade_link() . '">' . __('Upgrade to PRO', 'acp') . '</a></p>';
		}
        printf(
            $field . '<textarea id="tag_replacement3"  class="acp-code-editor" name="accessible_poetry[tag_replacement3]" placeholder=".class-name, #id-name">%s</textarea>',
            isset( $this->options['tag_replacement3'] ) ? esc_attr( $this->options['tag_replacement3']) : ''
        );
        printf(
            $dd . '</fieldset>' . $afterField,
            isset( $this->options['tag_replacement3_tag'] ) ? esc_attr( $this->options['tag_replacement3_tag']) : ''
        );
    }

    /*
     * Register administration scripts & styles
     */
	function admin_assets($hook) {
		wp_register_style( 'acp-admin-style', plugins_url('accessible-poetry/assets/css/acp-admin-style.css') );
		wp_enqueue_style( 'acp-admin-style' );
		wp_enqueue_script( 'acp-admin', plugins_url('accessible-poetry/assets/js/acp-admin.js') );
	}
}

new Accessible_Poetry();
