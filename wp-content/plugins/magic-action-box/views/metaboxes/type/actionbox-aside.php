<?php
	$meta = $data['meta'];
	$assets_url = $data['assets-url'];
	
	/** @deprecate: Remove this block on next version **/
	//check if settings key from optin form settings is available 
	//and hasn't been imported to new key.
	//This block should only fire on optin type action box
	if( !empty( $meta['optin-image-url'] ) && empty( $meta['aside-image-url'] ) ){
		$meta['aside-image-url'] = $meta['optin-image-url'];
	}
	if( !empty( $meta['optin-image-width'] ) && empty( $meta['aside-image-width'] ) ){
		$meta['aside-image-width'] = $meta['optin-image-width'];
	}
	if( !empty( $meta['optin-image-height'] ) && empty( $meta['aside-image-height'] ) ){
		$meta['aside-image-height'] = $meta['optin-image-height'];
	}
	if( !empty( $meta['optin-image-placement'] ) && empty( $meta['aside-image-placement'] ) ){
		$meta['aside-image-placement'] = $meta['optin-image-placement'];
	}
?>

<?php 
/* If *old* image url field is specified, then set aside type to image, otherwise set to none since no aside has been set */
$compat_aside_type = !empty( $meta['aside-image-url'] ) ? 'image' : 'none';
$compat_aside_width = !empty( $meta['aside-image-width'] ) ? $meta['aside-image-width'] : '';
$compat_aside_height = !empty( $meta['aside-image-height'] ) ? $meta['aside-image-height'] : '';
$compat_aside_placement = !empty( $meta['aside-image-placement'] ) ? $meta['aside-image-placement'] : '';

$default_aside_meta = array( 'type' => $compat_aside_type, 'placement' => $compat_aside_placement, 'width' => $compat_aside_width, 'height' => $compat_aside_height );

$aside_meta = isset( $meta['aside'] ) ? $meta['aside'] : $default_aside_meta; 
$aside_type = in_array( $aside_meta['type'], array('image','video','none')) ? $aside_meta['type'] : $compat_aside_type;
?>
<div class="mab-option-box mab-side-item-type-control">
	<h4><?php _e('Side Item Type', MAB_DOMAIN ); ?></h4>
	<p><?php _e('Choose whether you want to show an image or video.', MAB_DOMAIN ); ?></p>

	<label for="mab-aside-type-image">
		<input id="mab-aside-type-image" value="image" type="radio" <?php checked( $aside_type, 'image' ); ?> name="mab[aside][type]" />
		<?php _e('Image', MAB_DOMAIN); ?>
	</label>
	<label for="mab-aside-type-video">
		<input id="mab-aside-type-video" value="video" type="radio" <?php checked( $aside_type, 'video' ); ?> name="mab[aside][type]" />
		<?php _e('Video', MAB_DOMAIN); ?>
	</label>
	<label for="mab-aside-type-none">
		<input id="mab-aside-type-none" value="none" type="radio" <?php checked( $aside_type, 'none' ); ?> name="mab[aside][type]" />
		<?php _e('None', MAB_DOMAIN); ?>
	</label>
</div>

<div class="mab-aside-settings-image mab-aside-settings">
<?php include_once "template-aside-image-settings.php"; ?>
</div>

<div class="mab-aside-settings-video mab-aside-settings">
<?php include_once "template-aside-video-settings.php"; ?>
</div>


<div class="mab-option-box mab-aside-settings-general">
	<?php
	/*
	<h4>Side Content Size</h4>
	<p>Size of your side content. This will generally be the same size as your image or video. Format is <code>width</code> x <code>height</code>.</p>
	<p><strong>Tip:</strong> When using image, specify only the <code><label for="mab-aside-width">width</label></code> to set height automatically.</p>

	<?php
	$aside_width = isset( $aside_meta['width'] ) ? $aside_meta['width'] : '';
	$aside_height = isset( $aside_meta['height'] ) ? $aside_meta['height'] : '';
	?>
	<input type="text" class="small-text mab-aside-size code" id="mab-aside-width" value="<?php echo $aside_width; ?>" name="mab[aside][width]" /> x <input type="text" class="small-text mab-aside-size code" id="mab-aside-height" value="<?php echo $aside_height; ?>" name="mab[aside][height]" />
	<br />
	<br />
	*/ ?>
	<h4>Placement</h4>
	<p>Where do you want the side item in relation to the other elements in the action box?</p>

	<?php $placement = isset($aside_meta['placement']) ? $aside_meta['placement'] : 'left'; ?>
	<ul id="mab-aside-placement-choices" class="mab-placement-choices">
		<li>
			<label for="mab-aside-placement-left">
				<img alt="Left Placement" src="<?php echo $assets_url; ?>images/optin-image-left.png" />
				<br />
				<input id="mab-aside-placement-left" value="left" type="radio" <?php checked( $placement, 'left' ); ?> name="mab[aside][placement]" />
				Left Placement
			</label>
		</li>
		<li>
			<label for="mab-aside-placement-right">
				<img alt="Right Placement" src="<?php echo $assets_url; ?>images/optin-image-right.png" />
				<br />
				<input id="mab-aside-placement-right" type="radio" value="right" <?php checked( $placement, 'right'); ?> name="mab[aside][placement]"/>
				Right Placement
			</label>
		</li>
		<li>
			<label for="mab-aside-placement-top">
				<img alt="Top Placement" src="<?php echo $assets_url; ?>images/optin-image-top.png" />
				<br />
				<input id="mab-aside-placement-top" value="top" type="radio" <?php checked( $placement, 'top' ); ?> name="mab[aside][placement]" />
				Top Placement
			</label>
		</li>
	</ul>
</div>
