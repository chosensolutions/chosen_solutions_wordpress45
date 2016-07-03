<?php
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
?><h4><?php _e('Redirect URL', 'mab'); ?></h4>
	<p><?php _e('Users will be redirected to this URL after signing up.', 'mab'); ?></p>
	<?php $redirect = !empty($meta['optin']['redirect']) ? esc_url($meta['optin']['redirect']) : ''; ?>
	<input type="text" class="large-text" value="<?php echo $redirect; ?>" name="mab[optin][redirect]">