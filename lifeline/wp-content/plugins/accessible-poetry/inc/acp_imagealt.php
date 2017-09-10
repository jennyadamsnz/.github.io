<?php

function acp_missing_alt_submenu() {
	add_submenu_page(
		'accessible-poetry',
		'Missing ALT\'s',
		'Missing ALT\'s',
		'manage_options',
		'acp-missing-alts',
		'acp_missing_alt_platform'
	);
}
add_action('admin_menu', 'acp_missing_alt_submenu');

function acp_missing_alt_platform() {

$query_args = array(
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'post_status' => 'inherit',
	'posts_per_page' => -1,
);
$images_query = new WP_Query($query_args);

$images = array();

foreach ($images_query->posts as $img) {
	$alt = get_post_meta($img->ID, '_wp_attachment_image_alt', true);
			
	if(strlen($alt) === 0) {
		$img_object = array(
			'id' => $img->ID,
			'name' => $img->post_title,
			'url' => wp_get_attachment_thumb_url($img->ID)
		);
		$images[] = $img_object;
	}
}
?>
<div id="acp_missing_alts_platform" class="wrap">
	<h2><?php _e('Missing ALT\'s', 'acp'); ?></h2>
	<table class="widefat">
		<thead>
			<tr>
				<th><?php _e('ID', 'acp');?></th>
				<th><?php _e('Thumbnail', 'acp'); ?></th>
				<th><?php _e('Image Name', 'acp');?></th>
				<th><?php _e('Actions', 'acp');?></th>
			</tr>
		</thead>
		<tbody>
		<?php if( $images != null ) : ?>
		<?php foreach($images as $key => $value) : ?>
			<tr class="alternate">
				<td><?php echo $value['id']; ?></td>
				<td>
					<img src="<?php echo $value['url']; ?>" class="acp-thumb" alt="<?php _e('Thumbnail of', 'acp');?> <?php echo $value['name']; ?>" />
				</td>
				<td><?php echo $value['name']; ?></td>
				<td>
					<a href="<?php echo admin_url(); ?>upload.php?item=<?php echo $value['id']; ?>" class="button button-primary"><?php _e('Add Alt', 'acp');?></a>
				</td>
			</tr>
		<?php endforeach; ?>
		<?php else : ?>
			<tr class="alternate">
				<td colspan="4">
					<h3 style="font-weight:400;"><i class="dashicons-before dashicons-yes"></i><?php echo __('Congratulation! You don\'t have images without ALT text.', 'acp');?></h3>
				</td>
			</tr>
		<?php endif;?>
		</tbody>
	</table>
</div>
<?php
}