<?php 
$aside_content = '';

if( isset( $meta['aside'] )){
	//new system
	$aside = $meta['aside'];
	$type = $aside['type'];

	if( 'image' == $type ) {

		$image_url = !empty( $aside['image']['url'] ) ? $aside['image']['url'] : '';
		$width = !empty( $aside['width'] ) ? 'width="' . $aside['width'] . '"' : '';
		$height = !empty( $aside['height'] ) ? 'height="' . $aside['height'] . '"' : '';
		$inline_width = !empty($aside['width']) ? 'width: ' . $aside['width'] . 'px;' : '';
		$inline_height = !empty($aside['height']) ? 'height: ' . $aside['height'] . 'px;' : '';

		$image_inline_style = sprintf('style="%s %s"', $inline_height, $inline_width);

		$aside_content = !empty( $image_url ) ? sprintf( '<img src="%s" alt="Opt In Image" %s %s %s />', $image_url, $width, $height, $image_inline_style ) : '';

	}
} else {
	//old system
	if( !empty( $meta['aside-image-url'] ) ){
		$type = 'image';

		$image_url = $meta['aside-image-url'];
		$width = empty( $meta['aside-image-width'] ) ? '' : 'width="' . $meta['aside-image-width'] . '"';
		$height = empty( $meta['aside-image-height'] ) ? '' : 'height="' . $meta['aside-image-height'] . '"';

		$aside_content = sprintf( '<img src="%s" alt="Opt In Image" %s %s />', $image_url, $width, $height );
	}
}


if( !empty( $aside_content ) ) : ?>
	<div class="mab-aside"><?php echo $aside_content; ?></div>
<?php endif; ?>