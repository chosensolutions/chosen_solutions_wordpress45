<?php
	$MabAdmin = MAB('admin');
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
	$optinMeta = !empty( $meta['optin'] ) && is_array( $meta['optin'] ) ? $meta['optin'] : array();
	$assets_url = $data['assets-url'];
	$optin_providers = $data['optin-providers'];
?>


<div class="mab-option-box">
	<h4><label for="mab-optin-provider"><?php _e('Select Mailing List Provider','mab' ); ?></label></h4>
	<p><?php _e('Magic Action Box has integrated support for SendReach, Aweber, MailChimp and Wysija Newsletter only as of the moment. But, you may still use other mailing list providers by selecting <em>Others (Copy & Paste)</em> option. <strong>**Note:</strong> You can even use SendReach, Aweber or MailChimp with the <em>Others (Copy & Paste)</em> option.','mab' ); ?></p>
	<select id="mab-optin-provider" class="large-text" name="mab[optin-provider]" >
		<?php
			$selected_provider = isset( $meta['optin-provider'] ) ? $meta['optin-provider'] : 'manual';
			$allowed_providers = array();
		?>
		<?php foreach( $optin_providers as $provider ) : ?>
			<?php $allowed_providers[ $provider['id'] ] = 1; ?>
			<option value="<?php echo $provider['id']; ?>" <?php selected( $selected_provider, $provider['id'] ); ?> ><?php echo $provider['name']; ?></option>
		<?php endforeach; ?>
	</select>
	<img class="ajax-feedback" src="<?php echo admin_url('images/wpspin_light.gif'); ?>" alt="" />
</div>
<div id="provider-box">
	<?php echo $data['optin-provider-html']; ?>
</div>

<div class="mab-option-box">
	<h4>Form Fields Layout</h4>
	<?php $fieldsLayout = isset( $meta['optin']['fields-layout'] ) ? $meta['optin']['fields-layout'] : 'default';?>
	<ul>
		<li><label><input type="radio" value="default" name="mab[optin][fields-layout]" <?php checked( $fieldsLayout, 'default' ); ?>/> Default (auto width)</label></li>
		<li><label><input type="radio" value="stacked" name="mab[optin][fields-layout]" <?php checked( $fieldsLayout, 'stacked' ); ?>/> 1 Field per line (100% width)</label></li>
		<li><label><input type="radio" value="bytwo" name="mab[optin][fields-layout]" <?php checked( $fieldsLayout, 'bytwo' ); ?>/> 2 Fields per line (~50% width)</label></li>
		<li><label><input type="radio" value="bythree" name="mab[optin][fields-layout]" <?php checked( $fieldsLayout, 'bythree' ); ?>/> 3 Fields per line (~30% width)</label></li>
		<li><label><input type="radio" value="byfour" name="mab[optin][fields-layout]" <?php checked( $fieldsLayout, 'byfour' ); ?>/> 4 Fields per line (~25% width)</label></li>
	</ul>
	<p><strong>Note:</strong> Support for <code>field layout</code> will depend if the style selected supports it.</p>
	<p><strong>Note 2:</strong> Set this to <em>Default</em> if you specify <code>input field</code> width setting in custom styles.</p>
	<p><strong>Note 3:</strong> The number of fields include the <em>Submit</em> button.</p>

</div><!-- .mab-option-box -->

<div class="mab-option-box">
	<h4>Field Label Position</h4>
	<?php $fieldsLayout = isset( $meta['optin']['label-position'] ) ? $meta['optin']['label-position'] : 'stacked';?>
	<ul>
		<li><label><input type="radio" value="stacked" name="mab[optin][label-position]" <?php checked( $fieldsLayout, 'stacked' ); ?>/> Stacked on field</label></li>
		<li><label><input type="radio" value="inline" name="mab[optin][label-position]" <?php checked( $fieldsLayout, 'inline' ); ?>/> In-line with field</label></li>
	</ul>
	<p class="description">May not always work depending on the layout and theme's css. Try setting <code>Fields Layout</code> to <em>Default</em> option.</p>
</div>

<div class="mab-option-box">
	<?php $centerFields = !empty($meta['optin']['center-fields']) ? 1 : 0; ?>
	<h4>Center opt in form elements</h4>
	<label><input type="checkbox" value="1" name="mab[optin][center-fields]" <?php checked($centerFields, 1); ?>> Check this box to center the opt in form elements.</label>
	<p class="description">Note: May not always work depending on the css applied to the form elements and the style selected.</p>
</div>
