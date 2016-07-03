<div class="mab-option-box">
	<h4><label for="mab-aside-image-url">Action Box Image</label></h4>
	<p>You can show an image to the side of the action box. Just enter a URL that points to the image you wish to show. You can upload one via the <a id="mab-aside-image-url-upload" href="<?php echo admin_url("media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=1&width=640&amp;height=516"); ?>">WordPress uploader</a>.</p>

	<?php
	if( isset( $meta['aside-image-url'] ) ){
		$image_url = $meta['aside-image-url'];
	} else {
		$image_url = isset($aside_meta['image']['url']) ? $aside_meta['image']['url'] : '';
	}
	?>
	<input type="text" class="large-text" id="mab-aside-image-url" name="mab[aside][image][url]" value="<?php echo $image_url; ?>" />
</div>

<div class="mab-option-box">
	<h4>Image Size</h4>
	<p>You can optionally specify the image dimensions in the format <code><label for="mab-aside-width">width</label></code> x <code><label for="mab-aside-height">height</label></code>. <strong>Example:</strong> <code>200</code> x <code>150</code>.</p>
	<p><strong>Tip:</strong> When using image, specify only the <code><label for="mab-aside-width">width</label></code> to set height automatically.</p>

	<?php
	if( isset( $meta['aside-image-height']) ){
		$aside_height = $meta['aside-image-height'];
	} else {
		$aside_height = isset( $aside_meta['height'] ) ? $aside_meta['height'] : '';
	}

	if( isset( $meta['aside-image-width']) ){
		$aside_width = $meta['aside-image-width'];
	} else {
		$aside_width = isset( $aside_meta['width'] ) ? $aside_meta['width'] : '';
	}
	?>
	<input type="text" class="small-text mab-aside-size code" id="mab-aside-width" value="<?php echo $aside_width; ?>" name="mab[aside][width]" /> x <input type="text" class="small-text mab-aside-size code" id="mab-aside-height" value="<?php echo $aside_height; ?>" name="mab[aside][height]" />
</div>