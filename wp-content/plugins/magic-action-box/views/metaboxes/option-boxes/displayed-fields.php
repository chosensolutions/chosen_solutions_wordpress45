<?php
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
?><h4><?php _e('Additional fields to display:','mab' ); ?></h4>
	<?php 
	$fields = isset( $meta['optin']['enabled-fields'] ) && is_array( $meta['optin']['enabled-fields'] ) ? $meta['optin']['enabled-fields'] : array(); 
	?>
	<label for="mab-displayed-field-fname" style="margin-right: 10px;"><input type="checkbox" id="mab-displayed-field-fname" name="mab[optin][enabled-fields][]" value="firstname" <?php checked( true, in_array( 'firstname', $fields ) ); ?> /><?php _e('First name', 'mab'); ?> </label>
	
	<label for="mab-displayed-field-lname"><input type="checkbox" id="mab-displayed-field-lname" name="mab[optin][enabled-fields][]" value="lastname" <?php checked( true, in_array( 'lastname', $fields ) ); ?> /><?php _e('Last name', 'mab'); ?></label>
	
	<div class="clear"></div>