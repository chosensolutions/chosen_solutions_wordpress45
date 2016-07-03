<?php
	$MabAdmin = MAB('admin');
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
?><div id="mab-sendreach-settings" data-option-box="submit-button,displayed-fields,field-labels,redirect">
	<div class="mab-option-box">
		<h4><label for="mab-optin-sendreach-list"><?php _e('List','mab'); ?></label></h4>
		<p><?php _e('Select list to subscribe users to. Click on the Update List button below if you just recently added/removed a list.', 'mab' ); ?></p>
		<select id="mab-optin-sendreach-list" class="large-text mab-optin-list" name="mab[optin][sendreach][list]">
		<?php
			//get lists for sendreach if provider is allowed
			$lists = array();
			$lists = $MabAdmin->getSendReachLists( );

			if(empty($lists)):
		?>
			<option value="">No email list available</option>
		<?php
			else:
			$selected_list = !empty($meta['optin']['sendreach']['list']) ? $meta['optin']['sendreach']['list'] : '';

			foreach( $lists as $list ):		
		?>
			<option value="<?php echo $list['id']; ?>" <?php selected( $selected_list, $list['id'] ); ?> ><?php echo $list['name']; ?></option>
		<?php endforeach; ?>
		<?php endif; ?>
		</select>
		<a id="mab-optin-sendreach-get-list" class="button mab-optin-get-list" href="#"><?php _e('Update List', 'mab'); ?></a>
		<img id="mab-optin-sendreach-feedback" class="ajax-feedback" src="<?php echo admin_url('images/wpspin_light.gif'); ?>" alt="" />
	</div>
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
		<?php echo mab_option_box('displayed-fields', $data); ?>
	</div>
	<div class="mab-option-box">
		<?php echo mab_option_box('field-labels', $data); ?>
	</div>
	<div class="mab-option-box">
		<?php echo mab_option_box('redirect', $data); ?>
	</div>
</div><!-- #mab-sendreach-settings -->