<?php
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
	$optinMeta = !empty( $meta['optin'] ) ? $meta['optin'] : array();
?><!-- #WYSIJA --><?php 
/* check if wysija plugin is installed **/
if( !class_exists( 'WYSIJA' ) ):
//Wysija plugin is not installed
?>
	<div id="mab-wysija-settings" class="mab-option-box">
		<?php _e('<p class="mab-notice">You will need to install <a href="http://www.mailpoet.com/?aff=8" title="MailPoet Newsletters" target="_blank">MailPoet Newsletters plugin</a> in order to use this option as a Mailing List Provider (There is a lite version).</p>', 'mab'); ?>
	</div>

<?php else: ?>
<?php
	//wysijs plugin is installed
	$modelList = &WYSIJA::get('list','model');
	$wysijaLists = $modelList->get(array('name','list_id'),array('is_enabled'=>1));
	$wysija = !empty( $optinMeta['wysija'] ) ? $optinMeta['wysija'] : array();
	?>
	<div id="mab-wysija-settings" data-option-box="field-labels">
		<div class="mab-option-box">
			<h4><?php _e('Select Email List:','mab' ); ?></h4>
			<p><?php _e('Select which email lists a user will be subscribed to.','mab' ); ?></p>
			<?php 
			$selectedLists = isset( $wysija['lists'] ) && is_array( $wysija['lists'] ) ? $wysija['lists'] : array(); 
			$lists = $wysijaLists; 
			?>
			<?php foreach( $lists as $list ) : ?>
				<p style="margin: 0 10px 5px 0; float: left;"><label for="mab-wys-list-<?php echo $list['list_id']; ?>"><input type="checkbox" id="mab-wys-list-<?php echo $list['list_id']; ?>" name="mab[optin][wysija][lists][]" value="<?php echo $list['list_id']; ?>" <?php checked( true, in_array( $list['list_id'],$selectedLists) ); ?> /> <?php echo $list['name']; ?></label></p>
			<?php endforeach; ?>
			<div class="clear"></div>
		</div>
		
		<div class="mab-option-box">
			<h4><?php _e('Additional fields to display:','mab' ); ?></h4>
			<?php 
			$fields = isset( $wysija['fields'] ) && is_array( $wysija['fields'] ) ? $wysija['fields'] : array(); 
			?>
			<p style="margin: 0 10px 5px 0; float: left;"><label for="mab-wys-field-fname"><input type="checkbox" id="mab-wys-field-fname" name="mab[optin][wysija][fields][]" value="firstname" <?php checked( true, in_array( 'firstname', $fields ) ); ?> /> <?php _e('First name', 'mab'); ?></label></p>
			
			<p style="margin: 0 10px 5px 0; float: left;"><label for="mab-wys-field-lname"><input type="checkbox" id="mab-wys-field-lname" name="mab[optin][wysija][fields][]" value="lastname" <?php checked( true, in_array( 'lastname', $fields ) ); ?> /> <?php _e('Last name', 'mab'); ?></label></p>
			
			<div class="clear"></div>
		</div>
		
		<div class="mab-option-box">
			<h4><label for="mab-wysija-button-label"><?php _e('Submit Button Text:','mab' ); ?></label></h4>
			<?php 
			$buttonLabel = isset( $wysija['button-label'] ) ? $wysija['button-label'] : 'Subscribe!'; 
			?>
			<input type="text" id="mab-wysija-button-label" name="mab[optin][wysija][button-label]" value="<?php echo $buttonLabel; ?>" />

			<br>
			<br>
			<h4><?php _e('Use image for submit button', 'mab'); ?></h4>
			<?php
			$submit_image = isset( $meta['optin']['wysija']['submit-image'] ) ? $meta['optin']['wysija']['submit-image'] : '';
			?>
			<div class="mab-image-select">
				<input id="mab-optin-wysija-submit-image" class="mab-image-select-target" type="text" name="mab[optin][wysija][submit-image]" value="<?php echo $submit_image; ?>" ><a id="mab-optin-wysija-submit-image-upload" class="button mab-image-select-trigger" href="<?php echo admin_url("media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=1"); ?>">Upload image</a>
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
			<h4><label for="mab-wysija-success-message"><?php _e('Success Message:','mab'); ?></label></h4>
			<?php
			$message = isset( $wysija['success-message'] ) ? wp_kses_post($wysija['success-message']) : 'You\'ve successfully subscribed. Check your inbox now to confirm your subscription.'; 
			?>
			<textarea id="mab-wysija-success-message" class="large-text" name="mab[optin][wysija][success-message]"><?php echo $message; ?></textarea>
		</div>

		<div class="mab-option-box">
			<?php echo mab_option_box('redirect', $data); ?>
		</div>

		<div class="mab-option-box">
			<?php echo mab_option_box('field-labels', $data); ?>
		</div>
	</div>
<?php endif; ?>
