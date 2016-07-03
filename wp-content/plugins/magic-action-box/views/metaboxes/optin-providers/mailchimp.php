<?php
	$MabAdmin = MAB('admin');
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
	$mcGroups = !empty($data['mcGroups']) ? $data['mcGroups'] : array();
	if(empty($mcGroups)){
		$mcGroupNotice = 'style="display: block;"';
		$mcGroupSelect = 'style="display: none;"';
	} else {
		$mcGroupNotice = 'style="display: none;"';
		$mcGroupSelect = 'style="display: block;"';
	}
?><!-- #MAILCHIMP -->
<div id="mab-mailchimp-settings">
	
	<div class="mab-option-box">
		<p class="mab-notice"><?php _e('You selected to use an integrated opt-in form. This form displays two input fields to take the visitor\'s name and e-mail address. If you wish to use other input field arrangements, <em>(i.e. use only one field for e-mail address)</em>, then select <em>Other (Copy & Paste)</em> in the <label for="mab-optin-provider"><strong>Mailing List Provider</strong></label> select box.', 'mab'); ?></p>
		<h4><label for="mab-optin-mailchimp-list"><?php _e('List','mab'); ?></label></h4>
		<p><?php _e('Select list to subscribe users to. Click on the Update List button below if you just recently added/removed a list from MailChimp.', 'mab' ); ?></p>
		<select id="mab-optin-mailchimp-list" class="large-text mab-optin-list" name="mab[optin][mailchimp][list]">
		<?php
			//get lists for mailchimp if provider is allowed
			$lists = array();
			$lists = $MabAdmin->getMailChimpLists( );
			$selected_list = !empty($meta['optin']['mailchimp']['list']) ? $meta['optin']['mailchimp']['list'] : '';
			foreach( $lists as $list ):		
		?>
			<option value="<?php echo $list['id']; ?>" <?php selected( $selected_list, $list['id'] ); ?> ><?php echo $list['name']; ?></option>
		<?php endforeach; ?>
		</select>
		<a id="mab-optin-mailchimp-get-list" class="button mab-optin-get-list" href="#"><?php _e('Update List', 'mab'); ?></a>
		<img id="mab-optin-mailchimp-feedback" class="ajax-feedback" src="<?php echo admin_url('images/wpspin_light.gif'); ?>" alt="" />
		<?php 
		//test output of single list
		//$test = $MabAdmin->getMailChimpListSingle( $meta['optin']['mailchimp']['list'] );
		//myprint_r( $test ); ?>
	</div>

	<div id="mab-mc-group" class="mab-option-box">
		<h4><?php _e('MailChimp Group'); ?></h4>
		<p><?php _e('Add subscribers to a <a href="http://mailchimp.com/features/segmentation-and-groups/" target="_blank">MailChimp group</a> when they sign up.', 'mab'); ?></p>

		<p class="mab-notice" <?php echo $mcGroupNotice; ?>><?php _e('No groups have been set up for this list. <a href="http://kb.mailchimp.com/lists/groups-and-segments/add-groups-to-a-list" target="_blank">How to create a group</a>.'); ?></p>

		<?php $selected_mc_group = !empty($meta['optin']['mailchimp']['group']) ? $meta['optin']['mailchimp']['group'] : ''; ?>

		<select class="large-text" name="mab[optin][mailchimp][group]" <?php echo $mcGroupSelect; ?> data-selectedgroup="<?php echo $selected_mc_group; ?>">

			<?php if(empty($mcGroups)): ?>
				<option value=""><?php _e('No groups available for this list'); ?></option>
			<?php else: ?>
				<option value=""><?php _e('None', 'mab'); ?></option>
				<?php foreach($mcGroups as $i => $grouping): ?>
					<optgroup label="<?php echo $grouping['name']; ?>">
					<?php if(!empty($grouping['groups'])): foreach($grouping['groups'] as $j => $group): 
						$groupVal = sprintf('group[%1$s][%2$s]', $grouping['id'], $group['bit']);
					?>
						<option value="<?php echo $groupVal; ?>" <?php selected($selected_mc_group, $groupVal); ?>><?php echo $group['name']; ?></option>
					<?php endforeach; endif; ?>
					</optgroup>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
	</div>

	<div class="mab-option-box">
		<h4><?php _e('Track Signup Location', 'mab'); ?></h4>
		<p><?php _e(sprintf('Track which subscribers signed up through this form by setting a unique identifier for this form. Read our <a href="%s" target="_blank">MailChimp tracking guide</a> to learn how to do it.', 'http://www.magicactionbox.com/how-to-track-subscriber-signup-source-with-mailchimp/')); ?>
		</p>
		<p><label for="mab-optin-mailchimp-tag"><?php _e('Field Tag (Merge Tag)', 'mab'); ?></label></p> <input type="text" name="mab[optin][mailchimp][field-tag]" value="<?php echo empty($meta['optin']['mailchimp']['field-tag']) ? '' : esc_html($meta['optin']['mailchimp']['field-tag']); ?>" id="mab-optin-mailchimp-tag"> <em>example: SIGNUP</em>
		
		<p><label for="mab-optin-mailchimp-tcode"><?php _e('Form Identifier (Tracking Code)', 'mab'); ?></label></p><input type="text" name="mab[optin][mailchimp][tracking-code]" value="<?php echo empty($meta['optin']['mailchimp']['tracking-code']) ? '' : esc_html($meta['optin']['mailchimp']['tracking-code']); ?>" id="mab-optin-mailchimp-tcode"> <em>example: sidebar_form</em> 
	</div>

	<div class="mab-option-box">
		<h4><label for="mab-optin-mailchimp-submit-value"><?php _e( 'Text for submit button','mab' ); ?></label></h4>
		<p><?php _e('You can specify the text for your submit button (ex: "Subscribe" or "Get it now") Leave this blank to use default value. <strong>Default value:</strong> Submit.', 'mab'); ?>
		</p>
		<input id="mab-optin-mailchimp-submit-value" type="text" name="mab[optin][mailchimp][submit-value]" value="<?php echo isset( $meta['optin']['mailchimp']['submit-value'] ) ? $meta['optin']['mailchimp']['submit-value'] : ''; ?>" />
	</div>

	<div class="mab-option-box">
		<h4><?php _e('Use image for submit button', 'mab'); ?></h4>
		<?php
		$submit_image = isset( $meta['optin']['mailchimp']['submit-image'] ) ? $meta['optin']['mailchimp']['submit-image'] : '';
		?>
		<div class="mab-image-select">
			<input id="mab-optin-mailchimp-submit-image" class="mab-image-select-target" type="text" name="mab[optin][mailchimp][submit-image]" value="<?php echo $submit_image; ?>" ><a id="mab-optin-mailchimp-submit-image-upload" class="button mab-image-select-trigger" href="<?php echo admin_url("media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=1"); ?>">Upload image</a>
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
		<?php echo mab_option_box('displayed-fields', $data); ?>
	</div>
	<div class="mab-option-box">
		<?php echo mab_option_box('field-labels', $data); ?>
	</div>
</div><!-- #mab-mailchimp-settings -->