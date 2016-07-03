<?php
$meta = $data['meta'];
$cf7_list = $data['cf7-list'];
?>

<div class="mab-option-box">
	<h4><label for="mab-cf7-select">Select Contact Form</label></h4>
	<p>Select the contact form that you would like to display in this action box.</a>.</p>

	<?php
	if( !empty( $cf7_list ) ):
	$selected_form_id = !empty( $meta['cf7']['selected-form-id'] ) ? absint($meta['cf7']['selected-form-id']) : '';
	?>
	<select name="mab[cf7][selected-form-id]">
		<?php foreach( $cf7_list as $item ): ?>
		<option value="<?php echo $item->id; ?>" <?php selected($selected_form_id, $item->id ); ?> ><?php echo $item->title; ?></option>
		<?php endforeach; ?>
	</select>

	<?php
	else:

	endif;
	?>
</div>

<div class="mab-option-box mab-used-for-css3-button" >
	<h4><label for="mab-button-select"><?php _e('Choose Button Style',MAB_DOMAIN ); ?></label></h4>
	<p><?php _e( 'Select the button design you would like to use for your sales box. You can set the button text and link below.', MAB_DOMAIN ); ?></p>
	<p>
	<?php
	$configured_buttons = $data['buttons'];
	$optin_button_style = isset($meta['button-key']) ? $meta['button-key'] : 'default';
	?>
	<select id="mab-button-select" class="large-text" name="mab[button-key]">
		<option value="default" <?php selected('default', $optin_button_style); ?>>Use Default Button Style</option>
		<?php foreach( $configured_buttons as $key => $button ): ?>
			<option value="<?php echo $key; ?>" <?php selected( $optin_button_style, $key ); ?> ><?php echo $button['title']; ?></option>
		<?php endforeach; ?>
	</select>
	</p>
	<p>Create and edit buttons in the <a href="<?php echo admin_url('admin.php?page=mab-design'); ?>" title="Design settings">Design Settings</a> page. <strong class="alert">Don't forget to save your Action Box first!</strong></p>
	
	<div id="mab-button-preview">
		<h4><?php _e( 'Button Preview', 'mab' ); ?></h4>
		<a id="mab-example-button" onclick="return false;" href="#" class="mab-example-button mab-button-<?php echo $optin_button_style; ?>"><?php _e('Sample Submit Text', MAB_DOMAIN); ?></a>
	</div>
</div>