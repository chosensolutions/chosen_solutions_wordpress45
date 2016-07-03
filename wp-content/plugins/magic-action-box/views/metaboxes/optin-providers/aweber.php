<?php
	$MabAdmin = MAB('admin');
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();

?><!-- ## AWEBER -->
<div id="mab-aweber-settings">
	<div class="mab-option-box">
		<p class="mab-notice"><?php _e('You selected to use an integrated opt-in form. This form displays two input fields to take the visitor\'s name and e-mail address. If you wish to use other input field arrangements, <em>(i.e. use only one field for e-mail address)</em>, then select <em>Other (Copy & Paste)</em> in the <label for="mab-optin-provider"><strong>Mailing List Provider</strong></label> select box.', 'mab'); ?></p>
		<h4><label for="mab-optin-aweber-list"><?php _e('List','mab'); ?></label></h4>
		<p><?php _e('Select list to subscribe users to. Click on the Update List button below if you just recently added/removed a list from Aweber.', 'mab' ); ?></p>
		<select id="mab-optin-aweber-list" class="large-text mab-optin-list" name="mab[optin][aweber][list]">
		<?php
			$lists = array();
			$lists = $MabAdmin->getAweberLists();
			$selected_list = !empty($meta['optin']['aweber']['list']) ? $meta['optin']['aweber']['list'] : '';
			foreach( $lists as $list ):
		?>
			<option value="<?php echo $list['id']; ?>" <?php selected( $selected_list, $list['id'] ); ?> ><?php echo $list['name']; ?></option>
		<?php endforeach; ?>
		</select>
		<?php //var_dump( $lists ); ?>
		<a id="mab-optin-aweber-get-list" class="button mab-optin-get-list" href="#">Update List</a>
		<img id="mab-optin-aweber-feedback" class="ajax-feedback" src="<?php echo admin_url('images/wpspin_light.gif'); ?>" alt="" />
	</div>

	<?php /* TODO: Add the block below later
	<h4><?php _e( 'Email Opt In Fields', 'mab' ); ?></h4>
	<p><?php _e('Check the fields that you want to be used on the Opt In form.'); ?></p>
	<p>
		<label for="mab-optin-aweber-enable-field-name">
			<input type="checkbox" id="mab-optin-aweber-enable-field-name" name="mab[optin][aweber][fields][name]" <?php checked( $meta['optin']['aweber']['fields']['name'], 1 ); ?> value="1" />
			Name
		</label>
	</p>
	<br />
	*/ ?>

	<div class="mab-option-box">
		<h4><label for="mab-optin-aweber-submit-value"><?php _e( 'Text for submit button','mab' ); ?></label></h4>
		<p><?php _e('You can specify the text for your submit button (ex: "Subscribe" or "Get it now") Leave this blank to use default value. <strong>Default:</strong> Submit', 'mab'); ?>
		</p>
		<input id="mab-optin-aweber-submit-value" type="text" name="mab[optin][aweber][submit-value]" value="<?php echo isset( $meta['optin']['aweber']['submit-value'] ) ? $meta['optin']['aweber']['submit-value'] : ''; ?>" />
	</div>

	<div class="mab-option-box">
		<h4><?php _e('Use image for submit button', 'mab'); ?></h4>
		<?php
		$submit_image = isset( $meta['optin']['aweber']['submit-image'] ) ? $meta['optin']['aweber']['submit-image'] : '';
		?>
		<div class="mab-image-select">
			<input id="mab-optin-aweber-submit-image" class="mab-image-select-target" type="text" name="mab[optin][aweber][submit-image]" value="<?php echo $submit_image; ?>" ><a id="mab-optin-aweber-submit-image-upload" class="button mab-image-select-trigger" href="<?php echo admin_url("media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=1"); ?>">Upload image</a>
			<br>
			<img class="mab-image-select-preview" src="<?php echo $submit_image; ?>" alt="" />
		</div>
	</div>

	<div class="mab-option-box">
		<?php echo mab_option_box('button-style', $data); ?>
	</div>

	<div class="mab-option-box">
		<?php echo mab_option_box('submit-autowidth', $data); ?>
	</div>

	<div class="mab-option-box">
		<h4><label for="mab-optin-aweber-thankyou"><?php _e('Thank You Page', 'mab' ); ?></label></h4>
		<p><?php _e('Enter URL to thank you page where users will be redirected to after signing up. Leave blank to use default URL used by Aweber.','mab' ); ?></p>
		<input type="text" class="large-text" id="mab-optin-aweber-thankyou" name="mab[optin][aweber][thank-you]" value="<?php echo isset( $meta['optin']['aweber']['thank-you'] ) ? $meta['optin']['aweber']['thank-you'] : ''; ?>" />
	</div>
	
	<div class="mab-option-box">
		<h4><label for="mab-optin-aweber-tracking-code"><?php _e('Aweber Tracking Code', 'mab' ); ?></label></h4>
		<p><?php _e('The ad tracking value you\'d like assigned to subscribers who use this form (Optional).'); ?></p>
		<input type="text" id="mab-optin-aweber-tracking-code" name="mab[optin][aweber][tracking-code]" value="<?php echo isset( $meta['optin']['aweber']['tracking-code'] ) ? $meta['optin']['aweber']['tracking-code'] : ''; ?>" />
	</div>
	
	<div class="mab-option-box">
		<?php echo mab_option_box('field-labels', $data); ?>
	</div>

</div>