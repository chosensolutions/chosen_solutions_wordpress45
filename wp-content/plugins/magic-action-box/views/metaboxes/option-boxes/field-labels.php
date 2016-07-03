<?php
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
	$optinMeta = !empty( $meta['optin'] ) ? $meta['optin'] : array();
?><h4><?php _e('Outside Field Labels', 'mab'); ?></h4>
	<p><?php _e('Specify labels shown above or beside the input fields.', 'mab'); ?></p>
	<?php $fieldLabels = isset( $optinMeta['field-labels'] ) ? $optinMeta['field-labels'] : array( 'email' => __('Email', 'mab'), 'fname' => __('First Name', 'mab'), 'lname' => __('Last Name', 'mab') ); 
	?>
	<ul>
		<li><label><input type="text" value="<?php echo $fieldLabels['email']; ?>" name="mab[optin][field-labels][email]" /> <?php _e('Email Address', 'mab'); ?></label></li>
		<li><label><input type="text" value="<?php echo $fieldLabels['fname']; ?>" name="mab[optin][field-labels][fname]" /> <?php _e('First Name', 'mab'); ?></label></li>
		<li><label><input type="text" value="<?php echo $fieldLabels['lname']; ?>" name="mab[optin][field-labels][lname]" /> <?php _e('Last Name', 'mab'); ?></label></li>
	</ul>

	<h4><?php _e('In-Field Labels', 'mab'); ?></h4>
	<p><?php _e('Specify the description text displayed within the input fields.', 'mab'); ?></p>
	<?php $inFieldLabels = isset( $optinMeta['infield-labels'] ) ? $optinMeta['infield-labels'] : array( 'email' => __('Enter your email', 'mab'), 'fname' => __('Enter your name', 'mab'), 'lname' => __('Enter your last name', 'mab') ); ?>
	<ul>
		<li><label><input type="text" value="<?php echo $inFieldLabels['email']; ?>" name="mab[optin][infield-labels][email]" /> <?php _e('Email Address', 'mab'); ?></label></li>
		<li><label><input type="text" value="<?php echo $inFieldLabels['fname']; ?>" name="mab[optin][infield-labels][fname]" /> <?php _e('First Name', 'mab'); ?></label></li>
		<li><label><input type="text" value="<?php echo $inFieldLabels['lname']; ?>" name="mab[optin][infield-labels][lname]" /> <?php _e('Last Name', 'mab'); ?></label></li>
	</ul>