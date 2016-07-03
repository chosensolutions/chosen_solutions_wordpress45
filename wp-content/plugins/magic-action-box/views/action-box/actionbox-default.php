<?php
$meta = $data['meta'];
$id = $meta['ID'];

$the_content = $data['the_content'];

//$placement_class = empty( $meta['aside-image-placement'] ) ? '' : 'mab-aside-' . $meta['aside-image-placement'];

$placement_class = '';
if( !empty( $meta['aside-image-placement'] ) || !empty( $meta['aside']['placement'] ) ){
	$placement_class = 'mab-aside-';
	$placement_class .= empty( $meta['aside']['placement'] ) ? $meta['aside-image-placement'] : $meta['aside']['placement'];
}

/*$image_width = empty( $meta['aside-image-width'] ) ? '' : 'width="' . $meta['aside-image-width'] . '"';
$image_height = empty( $meta['aside-image-height'] ) ? '' : 'height="' . $meta['aside-image-height'] . '"';*/
if( isset( $meta['aside']['type'] ) ){
	$placement_class .= ' mab-aside-type-' . $meta['aside']['type'];
} else {
	$placement_class .= !empty( $meta['aside-image-url'] ) ? ' mab-aside-type-image' : ' mab-aside-type-none';
}

//this to have unique ID of the main containing div in case there is more than action box with the same id
$html_id = $data['mab-html-id'];

$mab_classes = $data['class'];

$html_data = $data['html-data'];

$inline_style = $data['inline-style'];

?><div id="mab-<?php echo $html_id; ?>" <?php echo $mab_classes; ?> <?php echo $html_data; ?> <?php echo $inline_style; ?>>
	<div class="mab-pad mab-wrap <?php echo $placement_class; ?>">
		<?php include 'aside.php'; ?>
		<div class="mab-content">
			<?php if( !empty( $meta['main-heading'] ) ) : //HEADING ?>
			<div class="mab-heading"><?php echo do_shortcode($meta['main-heading']); ?></div>
			<?php endif; ?>
			<?php if( !empty( $meta['subheading'] ) ) : ?>
			<div class="mab-subheading"><?php echo do_shortcode($meta['subheading']); //SUBHEADING ?></div>
			<?php endif; ?>
			<?php if( !empty( $meta['main-copy'] ) ) : //MAIN COPY ?>
			<div class="mab-main-copy"><?php echo do_shortcode(wpautop($meta['main-copy'])); ?></div>
			<?php endif; ?>
			<div class="mab-main-action-wrap ">
				<?php echo $the_content; ?>
			</div>
			<?php if( !empty( $meta['secondary-copy'] ) ) : //SECONDARY COPY?>
			<div class="mab-secondary-copy"><?php echo do_shortcode(wpautop($meta['secondary-copy'])); ?></div>
			<?php endif; ?>
		</div>
		<?php 
		$clearing_div = '<div class="clear" style="clear:both;"></div>'; 
		echo apply_filters( 'mab_clearing_div', $clearing_div ); ?>
	</div>

	<?php if(current_user_can('manage_options')): ?>
	<a class="mab-edit" href="<?php echo get_edit_post_link($id); ?>" target="_blank">edit</a>
	<?php endif; ?>
</div>