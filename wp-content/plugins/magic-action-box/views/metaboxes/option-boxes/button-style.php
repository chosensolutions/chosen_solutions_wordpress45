<?php
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
?><div class="mab-used-for-css3-button" >
	<h4><label for="mab-button-select"><?php _e('Choose Button Style','mab' ); ?></label></h4>
	<p><?php _e( 'Select the button design you would like to use for your form.', 'mab' ); ?></p>
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
		<a id="mab-example-button" onclick="return false;" href="#" class="mab-example-button mab-button-<?php echo $optin_button_style; ?>"><?php _e('Sample Submit Text', 'mab'); ?></a>
	</div>
</div>