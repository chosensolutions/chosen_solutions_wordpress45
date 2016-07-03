<?php
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
	$optinMeta = !empty( $meta['optin'] ) ? $meta['optin'] : array();

	/**
	 * NOTE: lname is not used
	 */
	
if(!class_exists('Prompt_Api')):
	// postmatic version does not contain the Prompt_Api class
?><div class="mab-option-box">
	<p class="mab-notice"><?php _e('This version of Postmatic is not supported. Please upgrade to v1.0+ to use Postmatic with Magic Action Box.', 'mab'); ?></p>
</div>
<?php else: ?><div id="mab-postmatic-settings" >
	<div class="mab-option-box">
		<?php echo mab_option_box('submit-button', $data); ?>
	</div>

	<div class="mab-option-box">
		<?php echo mab_option_box('button-style', $data); ?>
	</div>

	<div class="mab-option-box">
		<?php echo mab_option_box('submit-autowidth', $data); ?>
	</div>

	<div class="mab-option-box">
		<h4><?php _e('Unsubscribe Field', 'mab'); ?></h4>
		<?php $enableUnsub = empty($meta['optin']['unsubscribe']) ? 0 : 1; ?>
		<label><input type="checkbox" name="mab[optin][unsubscribe]" value="1" <?php checked( 1, $enableUnsub ); ?> > <?php _e('Enable unsubscribe link', 'mab'); ?></label>
		<p><?php _e('Will display an unsubscribe link that will show unsubscribe form.', 'mab'); ?></p>
	</div>

	<div class="mab-option-box">
		<h4><?php _e('Extra fields', 'mab'); ?></h4>
		<?php 
		$fields = isset( $meta['optin']['enabled-fields'] ) && is_array( $meta['optin']['enabled-fields'] ) ? $meta['optin']['enabled-fields'] : array(); 
		?>
		<strong><label for="mab-displayed-field-fname" style="margin-right: 10px;"><input type="checkbox" id="mab-displayed-field-fname" name="mab[optin][enabled-fields][]" value="fname" <?php checked( true, in_array( 'fname', $fields ) ); ?> /><?php _e('Enable name field', 'mab'); ?> </label></strong>
		<br>
		<?php
		$reqFields = isset( $meta['optin']['required-fields'] ) && is_array( $meta['optin']['required-fields'] ) ? $meta['optin']['required-fields'] : array(); 
		?>
		<label for="mab-required-field-name"><input type="checkbox" id="mab-required-field-name" name="mab[optin][required-fields][]" value="fname" <?php checked( true, in_array( 'fname', $reqFields ) ); ?> ><?php _e('Make this field required', 'mab'); ?></label>
		
		<div class="clear"></div>
	</div>

	<div class="mab-option-box">
		<h4><?php _e('Outside Field Labels', 'mab'); ?></h4>
		<p><?php _e('Specify labels shown above or beside the input fields.', 'mab'); ?></p>
		<?php $fieldLabels = isset( $optinMeta['field-labels'] ) ? $optinMeta['field-labels'] : array( 'email' => __('Email', 'mab'), 'fname' => __('Your Name', 'mab'), 'lname' => __('Last Name', 'mab') ); ?>
		<ul>
			<li><label><input type="text" value="<?php echo $fieldLabels['email']; ?>" name="mab[optin][field-labels][email]" /> <?php _e('Email Address', 'mab'); ?></label></li>
			<li><label><input type="text" value="<?php echo $fieldLabels['fname']; ?>" name="mab[optin][field-labels][fname]" /> <?php _e('Name', 'mab'); ?></label></li>
		</ul>
		<input type="hidden" name="mab[optin][field-labels][lname]" value="<?php echo $fieldLabels['lname']; ?>">

		<h4><?php _e('In-Field Labels', 'mab'); ?></h4>
		<p><?php _e('Specify the description text displayed within the input fields.', 'mab'); ?></p>
		<?php $inFieldLabels = isset( $optinMeta['infield-labels'] ) ? $optinMeta['infield-labels'] : array( 'email' => __('Enter your email', 'mab'), 'fname' => __('Enter your name', 'mab'), 'lname' => __('Last Name', 'mab') ); ?>
		<ul>
			<li><label><input type="text" value="<?php echo $inFieldLabels['email']; ?>" name="mab[optin][infield-labels][email]" /> <?php _e('Email Address', 'mab'); ?></label></li>
			<li><label><input type="text" value="<?php echo $inFieldLabels['fname']; ?>" name="mab[optin][infield-labels][fname]" /> <?php _e('Name', 'mab'); ?></label></li>
		</ul>
		<input type="hidden" name="mab[optin][infield-labels][lname]" value="<?php echo $inFieldLabels['lname']; ?>">
	</div>
</div><!-- #mab-postmatic-settings -->

<?php endif; ?>