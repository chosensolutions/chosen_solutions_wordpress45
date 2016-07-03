<?php

$meta = $data;
$optinMeta = $data['optin'];

$actionUrl = 'https://register.com';
$submitValue = !empty( $meta['optin']['submit-value'] ) ? $meta['optin']['submit-value'] : '';
$submitImage = !empty( $meta['optin']['submit-image'] ) ? $meta['optin']['submit-image'] : '';
$showUnsubscribe = empty($meta['optin']['unsubscribe']) ? false : true;

//labels
$fieldlabels = isset($optinMeta['field-labels']) && is_array( $optinMeta['field-labels'] ) ? $optinMeta['field-labels'] : array( 'email' => __('Email', 'mab'), 'fname' => __('First Name', 'mab'), 'lname' => __('Last Name', 'mab') );

$infieldlabels = isset($optinMeta['infield-labels']) && is_array( $optinMeta['infield-labels'] ) ? $optinMeta['infield-labels'] : array( 'email' => __('Enter your email', 'mab'), 'fname' => __('Enter your name', 'mab'), 'lname' => __('Enter your last name', 'mab') );

//fields
$fnameOn = false;
if(!empty($optinMeta['enabled-fields'])){
	$fnameOn = in_array('fname',$optinMeta['enabled-fields']) ? true : false;
}

$fnameReq = '';
if(!empty($optinMeta['required-fields'])){
	$fnameReq = in_array('fname',$optinMeta['required-fields']) ? 'required' : '';
}

?>
<form method="POST" action="<?php echo $actionUrl; ?>" class="mab-postmatic">

	<!--extra fields for ajax submit -->
	<input type="hidden" name="mabid" value="<?php echo $meta['ID']; ?>">
	<input type="hidden" name="optin-provider" value="postmatic">
	<input type="hidden" name="postmatic-action" value="subscribe">

	<?php if($fnameOn): ?>
	<div class="mab-field mab-field-name">
		<?php if( !empty( $fieldlabels['fname']) ) : ?>
		<label for="mab-name"><?php echo $fieldlabels['fname']; ?></label>
		<?php endif; ?>
		<input type="text" id="mab-name" placeholder="<?php echo esc_attr($infieldlabels['fname']); ?>" name="fname" <?php echo $fnameReq; ?> />
	</div>
	<?php endif; ?>

	<div class="mab-field mab-field-email">
		<?php if( !empty( $fieldlabels['email']) ) : ?>
		<label for="mab-email"><?php echo $fieldlabels['email']; ?></label>
		<?php endif; ?>
		<input type="email" id="mab-email" placeholder="<?php echo esc_attr($infieldlabels['email']); ?>" name="email" required />
	</div>
	<div class="mab-field mab-field-submit">
		<?php
		if($submitImage):
		?>
		<input type="image" class="mab-optin-submit mab-submit mab-subscribe" src="<?php echo $submitImage; ?>" alt="Submit">
		<?php else: ?>
		<input class="mab-submit mab-subscribe" type="submit" value="<?php echo esc_attr($submitValue); ?>" />
		<?php endif; ?>

		<?php if($showUnsubscribe): ?>
		<input class="mab-submit mab-unsubscribe" type="submit" value="Unsubscribe" style="display: none;">
		<?php endif; ?>
	</div>

	<?php if($showUnsubscribe): ?>
	<div class="mab-small-link"><a href="#unsubscribe"><small><?php _e('Want to unsubscribe?', 'mab'); ?></small></a></div>
	<?php endif; ?>


	<div class="mab-form-msg mab-alert" style="display: none; text-align: center;"></div>
	<?php if(!empty($optinMeta['redirect'])): ?>
		<input type="hidden" name="redirect" value="<?php echo esc_url($optinMeta['redirect']); ?>">
	<?php endif; ?>
	<div class="clear"></div>
</form>