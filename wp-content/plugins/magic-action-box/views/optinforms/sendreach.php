<?php

$meta = $data;
$optinMeta = $data['optin'];

$lid = $optinMeta['sendreach']['list'];

$actionUrl = 'https://register.sendreach.com/forms/?listid='.$lid;
$submitValue = !empty( $meta['optin']['submit-value'] ) ? $meta['optin']['submit-value'] : 'Submit';
$submitImage = !empty( $meta['optin']['submit-image'] ) ? $meta['optin']['submit-image'] : '';

//labels
$fieldlabels = isset($optinMeta['field-labels']) && is_array( $optinMeta['field-labels'] ) ? $optinMeta['field-labels'] : array( 'email' => __('Email', 'mab'), 'fname' => __('First Name', 'mab'), 'lname' => __('Last Name', 'mab') );

$infieldlabels = isset($optinMeta['infield-labels']) && is_array( $optinMeta['infield-labels'] ) ? $optinMeta['infield-labels'] : array( 'email' => __('Enter your email', 'mab'), 'fname' => __('Enter your name', 'mab'), 'lname' => __('Enter your last name', 'mab') );

//fields
$fnameOn = $lnameOn = false;
if(!empty($optinMeta['enabled-fields'])){
	$fnameOn = in_array('firstname',$optinMeta['enabled-fields']) ? true : false;
	$lnameOn = in_array('lastname',$optinMeta['enabled-fields']) ? true : false;
}

if($lid):
?>
<form method="POST" action="<?php echo $actionUrl; ?>">
	<?php if($fnameOn): ?>
	<div class="mab-field mab-field-name mab-field-fname">
		<?php if( !empty( $fieldlabels['fname']) ) : ?>
		<label for="mab-name"><?php echo $fieldlabels['fname']; ?></label>
		<?php endif; ?>
		<input type="text" id="mab-name" placeholder="<?php echo $infieldlabels['fname']; ?>" name="first_name" />
	</div>
	<?php endif; ?>
	<?php if($lnameOn): ?>
	<div class="mab-field mab-field-name mab-field-lname">
		<?php if( !empty( $fieldlabels['lname']) ) : ?>
		<label for="mab-name"><?php echo $fieldlabels['lname']; ?></label>
		<?php endif; ?>
		<input type="text" id="mab-name" placeholder="<?php echo $infieldlabels['lname']; ?>" name="last_name" />
	</div>
	<?php endif; ?>
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
	<input type="hidden" name="lid" value="<?php echo $lid; ?>">
	<?php if(!empty($optinMeta['redirect'])): ?>
		<input type="hidden" name="redirect" value="<?php echo esc_url($optinMeta['redirect']); ?>">
	<?php endif; ?>
	<div class="clear"></div>
</form>
<?php endif; //endif($lid) ?>