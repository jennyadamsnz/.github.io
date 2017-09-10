<?php
function acp_front_assets() {

	$set		= get_option( 'accessible_poetry' );
	$manual		= isset($set['enable_manual_toolbar']);
	$ajax		= isset($set['enable_ajax_toolbar']);
	$style		= ( isset($set['toolbar_skin']) ) ? $set['toolbar_skin'] : '1';
	$css_dir	= 'accessible-poetry/assets/css/';
	
	wp_enqueue_style( 'acp-front', plugins_url($css_dir . 'acp-front.css') );

	if( $manual || $ajax ) {
		wp_enqueue_style( 'acp-toolbar', plugins_url($css_dir . 'acp-toolbar.css') );
		wp_enqueue_style( 'acp-toolbar-skin', plugins_url($css_dir . 'acp-toolbar-skin-' . $style . '.css') );
	}

    wp_enqueue_script( 'acp-scripts', plugins_url( 'accessible-poetry/assets/js/accessible-poetry.js' ), array('jquery'), false, false );
}
add_action( 'wp_enqueue_scripts', 'acp_front_assets' );

class acp_Front {
	
	private $options;
	
	public function __construct() {
		
		$this->options = get_option( 'accessible_poetry' );

		// HTML Lang Attribute
		if( isset($this->options['html_lang']) )
			add_filter( 'wp_footer', array( $this, 'html_lang' ) );

		// Logo Aria
		if( isset($this->options['logo_identifier']) && isset($this->options['logo_directive']) )
			add_filter( 'wp_footer', array( $this, 'logo_aria' ) );

		// Remove Tabindex
		if( isset($this->options['remove_tabindex']) )
			add_filter( 'wp_footer', array( $this, 'remove_tabindex' ) );

		// Logo Directive
		if( isset($this->options['logo_directive']) && isset($this->options['logo_identifier']) )
			add_filter( 'wp_footer', array( $this, 'logo_directive' ) );

		// Title Attribute
		if( isset($this->options['title_attr']) )
			add_filter( 'wp_footer', array( $this, 'title_attr' ) );

		// Alt Atribute
		if( isset($this->options['image_alt']) )
			add_filter( 'wp_footer', array( $this, 'image_alt' ) );

		// Link Underline
		if( isset($this->options['link_underline']) ) {
			add_filter( 'body_class', function ( $classes ) {
				$classes[] = 'acp-underline';
				return $classes;
			} );
		}

		// Link Outline
		if( isset($this->options['link_outline']) ) {

			$outline = $this->options['link_outline'];

			if( $outline ) {
				if( 'none' != $outline && 'custom' != $outline ) {
					add_filter( 'body_class', function ( $classes ) {
						$classes[] = 'acp-focus-' . $this->options['link_outline'];
						return $classes;
					} );
				}

				// PRO ONLY
				elseif( 'custom' == $outline ) {
					add_filter( 'wp_head', array( $this, 'link_custom_outline' ) );
				}

			}
		}

		// Replacement Tag 1
		if( isset($this->options['tag_replacement1']) && isset($this->options['tag_replacement1_tag']) )
			add_filter( 'wp_footer', array( $this, 'tag_replacement1' ) );

		// Replacement Tag 2
		if( isset($this->options['tag_replacement2']) && isset($this->options['tag_replacement2_tag']) )
			add_filter( 'wp_footer', array( $this, 'tag_replacement2' ) );

		// Replacement Tag 3
		if( isset($this->options['tag_replacement3']) && isset($this->options['tag_replacement3_tag']) )
			add_filter( 'wp_footer', array( $this, 'tag_replacement3' ) );
	}

	// logo additional aria label
	public function logo_aria() {
		$logo_id	= $this->options['logo_identifier'];
		$logo_aria	= $this->options['logo_directive'];

		if( $logo_id && $logo_aria ) {
			?>
			<script>
				acp_addLogoAria('<?php echo $logo_id; ?>', '<?php echo $logo_aria; ?>');
			</script>
			<?php
		}

	}

	// logo directive
	public function logo_directive() {
		$this->options = get_option( 'accessible_poetry' );
		$directive = $this->options['logo_directive'];
		$logo = $this->options['logo_identifier'];

		if( $directive && $logo ) :
			?>
			<script>
				jQuery(document).ready(function($){
					$('<?php echo $logo; ?>').attr("aria-label", "<?php echo $directive; ?>");
				});
			</script>
			<?php
		endif;
	}

	// HTML Lang Attribute
	public function html_lang() {
		$curLang = substr(get_bloginfo( 'language' ), 0, 2);
		?>
		<script>
		jQuery(window).load(function(){
			jQuery("html").attr("lang","<?php echo $curLang; ?>")});
		</script>
		<?php
	}

	// remove tabindex
	public function remove_tabindex() {
		?>
		<script>
			jQuery(document).ready(function($){
				$('h1,h2,h3,h4,h5,h6,input,p').each(function(){
					var tabindex = $(this).attr("tabindex");
					if( '0' === tabindex ) $(this).removeAttr("tabindex");
				});
			});
		</script>
		<?php
	}

	// manage title attr
	public function title_attr() {
		$this->options = get_option( 'accessible_poetry' );
		$title_attr = $this->options['title_attr'];

		if( 'replace' == $title_attr || 'add' == $title_attr) :
		?>
		<script>
		jQuery(document).ready(function($){
			$("*[title]").each(function(){
				var e = $(this);
				if( !e.attr("aria-label") ) {
					<?php if( 'replace' == $title_attr ) : ?>
					e.attr("aria-label", e.attr("title")).removeAttr("title");
					<?php elseif( 'add' == $title_attr ) : ?>
					e.attr("aria-label", e.attr("title"));
					<?php endif; ?>
				}
			});
		});</script><?php
		endif;
	}

	// empty image alt
	public function image_alt() {
		?>
		<script>
		jQuery(document).ready(function($){
			$("img").each(function(){
				if(!$(this).attr("alt")){
					$(this).attr("alt", "");
				}
			});
		});
		</script>
		<?php
	}

	// replacement tags
	public function tag_replacement1() {
		$this->options = get_option( 'accessible_poetry' );
		$replacements = $this->options['tag_replacement1'];
		$tag = $this->options['tag_replacement1_tag'];

		if( $replacements && $tag ) :
		?>
		<script>
			jQuery(document).ready(function($){
				$("<?php echo $replacements; ?>").each(function(){
					var outer = this.outerHTML;

					// Replace opening tag
					var regex = new RegExp('<' + this.tagName, 'i');
					var newTag = outer.replace(regex, '<<?php echo $tag; ?>');

					// Replace closing tag
					regex = new RegExp('</' + this.tagName, 'i');
					newTag = newTag.replace(regex, '</<?php echo $tag; ?>');

					$(this).replaceWith(newTag);
				});
			});
		</script>
		<?php
		endif;
	}
	public function tag_replacement2() {
		$this->options = get_option( 'accessible_poetry' );
		$replacements = $this->options['tag_replacement2'];
		$tag = $this->options['tag_replacement2_tag'];

		if( $replacements && $tag ) :
		?>
		<script>
			jQuery(document).ready(function($){
				$("<?php echo $replacements; ?>").each(function(){
					var outer = this.outerHTML;

					// Replace opening tag
					var regex = new RegExp('<' + this.tagName, 'i');
					var newTag = outer.replace(regex, '<<?php echo $tag; ?>');

					// Replace closing tag
					regex = new RegExp('</' + this.tagName, 'i');
					newTag = newTag.replace(regex, '</<?php echo $tag; ?>');

					$(this).replaceWith(newTag);
				});
			});
		</script>
		<?php
		endif;
	}
	public function tag_replacement3() {
		$this->options = get_option( 'accessible_poetry' );
		$replacements = $this->options['tag_replacement3'];
		$tag = $this->options['tag_replacement3_tag'];

		if( $replacements && $tag ) :
		?>
		<script>
			jQuery(document).ready(function($){
				$("<?php echo $replacements; ?>").each(function(){
					var outer = this.outerHTML;

					// Replace opening tag
					var regex = new RegExp('<' + this.tagName, 'i');
					var newTag = outer.replace(regex, '<<?php echo $tag; ?>');

					// Replace closing tag
					regex = new RegExp('</' + this.tagName, 'i');
					newTag = newTag.replace(regex, '</<?php echo $tag; ?>');

					$(this).replaceWith(newTag);
				});
			});
		</script>
		<?php
		endif;
	}
}
new acp_Front();
