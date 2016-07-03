<?php
/**
 * Based on http://www.aweber.com/faq/questions/396/Can+I+Use+My+Own+Form%3F
 */
$meta = $data;
$optinMeta = $data['optin'];
$redirectUrl = !empty($meta['optin']['aweber']['thank-you']) ? $meta['optin']['aweber']['thank-you'] : 'http://www.aweber.com/thankyou-coi.htm?m=text';
$trackingCode = !empty( $meta['optin']['aweber']['tracking-code'] ) ? $meta['optin']['aweber']['tracking-code'] : ''; 
$actionUrl = !empty( $meta['optin']['aweber']['form-action-url'] ) ? $meta['optin']['aweber']['form-action-url'] : '';
$submitValue = !empty( $meta['optin']['aweber']['submit-value'] ) ? $meta['optin']['aweber']['submit-value'] : 'Submit';
$submitImage = !empty( $meta['optin']['aweber']['submit-image'] ) ? $meta['optin']['aweber']['submit-image'] : '';

//labels
$fieldlabels = isset($optinMeta['field-labels']) && is_array( $optinMeta['field-labels'] ) ? $optinMeta['field-labels'] : array( 'email' => __('Email', MAB_DOMAIN), 'fname' => __('First Name', MAB_DOMAIN), 'lname' => __('Last Name', MAB_DOMAIN) );

$infieldlabels = isset($optinMeta['infield-labels']) && is_array( $optinMeta['infield-labels'] ) ? $optinMeta['infield-labels'] : array( 'email' => __('Enter your email', MAB_DOMAIN), 'fname' => __('Enter your name', MAB_DOMAIN), 'lname' => __('Enter your last name', MAB_DOMAIN) );

?><form method="POST" action="<?php echo $actionUrl; ?>">
	<div class="mab-field mab-field-name">
		<?php if( !empty( $fieldlabels['fname']) ) : ?>
		<label for="mab-name"><?php echo $fieldlabels['fname']; ?></label>
		<?php endif; ?>
		<input type="text" id="mab-name" placeholder="<?php echo $infieldlabels['fname']; ?>" name="name" />
	</div>
	<div class="mab-field mab-field-email">
		<?php if( !empty( $fieldlabels['email']) ) : ?>
		<label for="mab-email"><?php echo $fieldlabels['email']; ?></label>
		<?php endif; ?>
		<input type="email" id="mab-email" placeholder="<?php echo $infieldlabels['email']; ?>" name="email" />
	</div>
	<div class="mab-field mab-field-submit">
		<?php
		if($submitImage):
		?>
		<input type="image" class="mab-optin-submit mab-submit" src="<?php echo $submitImage; ?>" alt="Submit">
		<?php else: ?>
		<input class="mab-submit" type="submit" value="<?php echo $submitValue; ?>" />
		<?php endif; ?>
	</div>
	
	<div class="clear"></div>
	
	<?php 
	//might be usefule later
	//<input type="hidden" name="meta_split_id" value="" />
	//<input type="hidden" name="meta_redirect_onlist" value="http://pogidude.com" /> //redirect to url if user is already subscribed to the list 
	//<input type="hidden" name="meta_message" value="1" /> //the follow up message subscribers will first receive when signing up to the list. In most cases, this is set to "1".
	//<input type="hidden" name="meta_forward_vars" value="1" /> set to "1" to forward all submitted fields to the redirect/thank you page using GET method. ?>
	
	<input type="hidden" name="listname" value="<?php echo $meta['optin']['aweber']['list']; ?>" />
	<?php if( !empty( $redirectUrl ) ): ?>
	<input type="hidden" name="redirect" value="<?php echo $redirectUrl; ?>" />
	<?php endif; ?>
	<?php if( !empty( $meta['optin']['aweber']['tracking-code'] ) ) : ?>
	<input type="hidden" name="meta_adtracking" value="<?php echo $meta['optin']['aweber']['tracking-code']; ?>" />
	<?php endif; ?>
	<input type="hidden" name="meta_message" value="1" />
	
	<?php //maybe have a way to set which fields are required? ?>
	<input type="hidden" name="meta_required" value="name,email" />

</form>
