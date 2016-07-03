<?php
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
?><h4><label for="mab-optin-submit-value"><?php _e( 'Text for submit button','mab' ); ?></label></h4>
<p><?php _e('You can specify the text for your submit button (ex: "Subscribe" or "Get it now") Leave this blank to use default value. <strong>Default value:</strong> Submit.', 'mab'); ?>
</p>
<input id="mab-optin-submit-value" type="text" name="mab[optin][submit-value]" value="<?php echo isset( $meta['optin']['submit-value'] ) ? esc_attr($meta['optin']['submit-value']) : 'Submit'; ?>" />
<br>
<br>
<h4><?php _e('Use image for submit button', 'mab'); ?></h4>
<?php
$submit_image = isset( $meta['optin']['submit-image'] ) ? esc_url($meta['optin']['submit-image']) : '';
?>
<div class="mab-image-select">
	<input id="mab-optin-submit-image" class="mab-image-select-target" type="text" name="mab[optin][submit-image]" value="<?php echo $submit_image; ?>" ><a id="mab-optin-submit-image-upload" class="button mab-image-select-trigger" href="<?php echo admin_url("media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=1"); ?>">Upload image</a>
	<br>
	<img class="mab-image-select-preview" src="<?php echo $submit_image; ?>" alt="" />
</div>