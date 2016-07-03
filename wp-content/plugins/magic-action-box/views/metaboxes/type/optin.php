<?php
	$meta = $data['meta'];
	$assets_url = $data['assets-url'];
	
	//check if settings key from optin form settings is available 
	//and hasn't been converted to new key.
	if( !empty( $meta['optin-heading'] ) && empty( $meta['main-heading'] ) ){
		$meta['main-heading'] = $meta['optin-heading'];
	}
	if( !empty( $meta['optin-subheading'] ) && empty( $meta['subheading'] ) ){
		$meta['subheading'] = $meta['optin-subheading'];
	}
	if( !empty( $meta['optin-main-copy'] ) && empty( $meta['main-copy'] ) ){
		$meta['main-copy'] = $meta['optin-main-copy'];
	}
	if( !empty( $meta['optin-secondary-copy'] ) && empty( $meta['secondary-copy'] ) ){
		$meta['secondary-copy'] = $meta['optin-secondary-copy'];
	}
?>

<div class="mab-option-box">
	<h4><label for="mab-optin-form-heading"><?php _e('Main Heading','mab' ); ?></label></h4>
	<p><?php _e('Main headline of your opt in form.','mab' ); ?></p>
	<input type="text" class="large-text" id="mab-optin-form-heading" name="mab[main-heading]" value="<?php echo isset( $meta['main-heading'] ) ? $meta['main-heading'] : ''; ?>" />
</div>

<div class="mab-option-box">
	<h4><label for="mab-optin-form-subheading"><?php _e('Sub Heading','mab' ); ?></label></h4>
	<p><?php _e('Sub-heading of your opt in form. Will appear below the main heading.','mab' ); ?></p>
	<input type="text" class="large-text" id="mab-optin-form-subheading" name="mab[subheading]" value="<?php echo isset( $meta['subheading'] ) ? $meta['subheading'] : ''; ?>" />
</div>

<div class="mab-option-box">
	<h4><label for="mab-optin-form-copy"><?php _e('Main Opt In Copy','mab' ); ?></label></h4>
	<p><?php _e('Copy that is displayed before the opt in form.','mab' ); ?></p>
	<!--textarea id="mab-optin-form-copy" class="large-text" id="mab-optin-form-copy" name="mab[main-copy]" rows="6" cols="60"><?php echo isset( $meta['main-copy'] ) ? $meta['main-copy'] : ''; ?></textarea-->

	<?php 
	$settings = array(
		'wpautop' => true,
		'textarea_name' => 'mab[main-copy]'
	);
	$main_copy = isset( $meta['main-copy'] ) ? $meta['main-copy'] : '';
	wp_editor( $main_copy, 'mab-optin-form-copy', $settings ); ?>
</div>

<div class="mab-option-box">
	<h4><label for="mab-optin-form-secondary-copy"><?php _e('Secondary Opt In Copy','mab' ); ?></label></h4>
	<p><?php _e('Copy that is displayed after the opt in form.','mab' ); ?></p>
	<!--textarea id="mab-optin-form-secondary-copy" class="large-text" id="mab-optin-form-secondary-copy" name="mab[secondary-copy]" rows="6" cols="60"><?php echo isset( $meta['secondary-copy'] ) ? $meta['secondary-copy'] : ''; ?></textarea-->
	
	<?php 
	$settings = array(
		'wpautop' => true,
		'textarea_name' => 'mab[secondary-copy]'
	);
	$secondary_copy = isset( $meta['secondary-copy'] ) ? $meta['secondary-copy'] : '';
	wp_editor( $secondary_copy, 'mab-optin-form-secondary-copy', $settings ); ?>
</div>
