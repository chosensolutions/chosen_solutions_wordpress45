<?php
/**
 * Based on http://www.aweber.com/faq/questions/396/Can+I+Use+My+Own+Form%3F
 */
$meta = $data;
$optinMeta = $data['optin'];
//$redirectUrl = !empty($meta['optin']['thank-you']) ? $meta['optin']['thank-you'] : 'http://www.aweber.com/thankyou-coi.htm?m=text';
//$trackingCode = !empty( $meta['optin']['mailchimp']['tracking-code'] ) ? $meta['optin']['mailchimp']['tracking-code'] : ''; 

//$actionUrl = !empty( $meta['optin']['mailchimp']['list-data']['subscribe_url_long'] ) ? $meta['optin']['mailchimp']['list-data']['subscribe_url_long'] : '';
$actionUrl = !empty( $meta['optin']['mailchimp']['form-action-url'] ) ? $meta['optin']['mailchimp']['form-action-url'] : '';
$submitValue = !empty( $meta['optin']['mailchimp']['submit-value'] ) ? $meta['optin']['mailchimp']['submit-value'] : 'Submit';
$submitImage = !empty( $meta['optin']['mailchimp']['submit-image'] ) ? $meta['optin']['mailchimp']['submit-image'] : '';

//labels
$fieldlabels = isset($optinMeta['field-labels']) && is_array( $optinMeta['field-labels'] ) ? $optinMeta['field-labels'] : array( 'email' => __('Email', 'mab'), 'fname' => __('First Name', 'mab'), 'lname' => __('Last Name', 'mab') );

$infieldlabels = isset($optinMeta['infield-labels']) && is_array( $optinMeta['infield-labels'] ) ? $optinMeta['infield-labels'] : array( 'email' => __('Enter your email', 'mab'), 'fname' => __('Enter your name', 'mab'), 'lname' => __('Enter your last name', 'mab') );

//fields
$fnameOn = $lnameOn = false;
if(!empty($optinMeta['enabled-fields'])){
	$fnameOn = in_array('firstname',$optinMeta['enabled-fields']) ? true : false;
	$lnameOn = in_array('lastname',$optinMeta['enabled-fields']) ? true : false;
}
?>
<form method="POST" action="<?php echo $actionUrl; ?>">
	<?php if($fnameOn): ?>
	<div class="mab-field mab-field-name mab-field-fname">
		<?php if( !empty( $fieldlabels['fname']) ) : ?>
		<label for="mab-name"><?php echo $fieldlabels['fname']; ?></label>
		<?php endif; ?>
		<input type="text" id="mab-name" placeholder="<?php echo $infieldlabels['fname']; ?>" name="FNAME" />
	</div>
	<?php endif; ?>
	<?php if($lnameOn): ?>
	<div class="mab-field mab-field-name mab-field-lname">
		<?php if( !empty( $fieldlabels['lname']) ) : ?>
		<label for="mab-name"><?php echo $fieldlabels['lname']; ?></label>
		<?php endif; ?>
		<input type="text" id="mab-name" placeholder="<?php echo $infieldlabels['lname']; ?>" name="LNAME" />
	</div>
	<?php endif; ?>
	<div class="mab-field mab-field-email">
		<?php if( !empty( $fieldlabels['email']) ) : ?>
		<label for="mab-email"><?php echo $fieldlabels['email']; ?></label>
		<?php endif; ?>
		<input type="email" id="mab-email" placeholder="<?php echo $infieldlabels['email']; ?>" name="EMAIL" />
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

	<?php if(!empty($optinMeta['mailchimp']['field-tag']) && !empty($optinMeta['mailchimp']['tracking-code'])): ?>
		<input type="hidden" name="<?php esc_html_e($optinMeta['mailchimp']['field-tag']); ?>" value="<?php esc_html_e($optinMeta['mailchimp']['tracking-code']); ?>">
	<?php endif; ?>

	<?php if(!empty($optinMeta['mailchimp']['group'])): ?>
		<input type="hidden" name="<?php echo $optinMeta['mailchimp']['group']; ?>" value="1">
	<?php endif; ?>
	<div class="clear"></div>
</form>
