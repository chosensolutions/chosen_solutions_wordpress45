<?php
$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
?><h4><label for="mab-success-message"><?php _e('Success Message:','mab'); ?></label></h4>
	<?php
	$message = isset( $meta['optin']['success-message'] ) ? wp_kses_post($meta['optin']['success-message']) : 'You\'ve successfully subscribed. Check your inbox now to confirm your subscription.';
	?>
<textarea id="mab-success-message" class="large-text" name="mab[optin][success-message]"><?php echo $message; ?></textarea>