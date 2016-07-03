<?php
/**
 * Wysija Form
 */

/** TODO: stop if no lists selected? **/
$formIdReal = 'form' . $data['mab-html-id'];
$redirectUrl = !empty($meta['optin']['redirect']) ? $meta['optin']['redirect'] : '';

$meta = $data;
$optinMeta = isset( $data['optin'] ) && is_array( $data['optin'] ) ? $data['optin'] : array();
$wysija = isset( $optinMeta['wysija'] ) && is_array( $optinMeta['wysija'] ) ? $optinMeta['wysija'] : array();

$enabledFields = isset( $wysija['fields'] ) && is_array( $wysija['fields'] ) ? $wysija['fields'] : array();

$fieldlabels = isset($optinMeta['field-labels']) && is_array( $optinMeta['field-labels'] ) ? $optinMeta['field-labels'] : array( 'email' => __('Email', 'mab'), 'fname' => __('First Name', 'mab'), 'lname' => __('Last Name', 'mab') );

$infieldlabels = isset($optinMeta['infield-labels']) && is_array( $optinMeta['infield-labels'] ) ? $optinMeta['infield-labels'] : array( 'email' => __('Enter your email', 'mab'), 'fname' => __('Enter your name', 'mab'), 'lname' => __('Enter your last name', 'mab') );
?>
<form  method="post" action="#submit">

	<?php if( in_array( 'firstname', $enabledFields ) ): ?>
	<div class="mab-field mab-field-firstname">
		<?php if( !empty( $fieldlabels['fname']) ) : ?>
		<label for="<?php echo $formIdReal; ?>-firstname"><?php echo $fieldlabels['fname']; ?></label>
		<?php endif; ?>
		<input id="<?php echo $formIdReal; ?>-firstname"  type="text" name="fname" placeholder="<?php echo esc_attr($infieldlabels['fname']); ?>" />
	</div>
	<?php endif; ?>
	
	<?php if( in_array( 'lastname', $enabledFields ) ): ?>
	<div class="mab-field mab-field-lastname">
		<?php if( !empty( $fieldlabels['lname']) ) : ?>
		<label for="<?php echo $formIdReal; ?>-lastname"><?php echo $fieldlabels['lname']; ?></label>
		<?php endif; ?>
		<input id="<?php echo $formIdReal; ?>-lastname" type="text" name="lname" placeholder="<?php echo esc_attr($infieldlabels['lname']); ?>" />
	</div>
	<?php endif; ?>
	
	<div class="mab-field mab-field-email">
		<?php if( !empty( $fieldlabels['email']) ) : ?>
		<label for="<?php echo $formIdReal; ?>-wysija-to"><?php echo $fieldlabels['email']; ?></label>
		<?php endif; ?>
		<input id="<?php echo $formIdReal; ?>-wysija-to" type="text" name="email" placeholder="<?php echo esc_attr($infieldlabels['email']); ?>" required />

	</div>
	
	<?php 
	$submit = isset( $wysija['button-label'] ) ? $wysija['button-label'] : ''; 
	$submitImage = !empty( $wysija['submit-image'] ) ? $wysija['submit-image'] : '';
	?>
	<div class="mab-field mab-field-submit">
		<?php
		if($submitImage):
		?>
		<input type="image" class="mab-optin-submit mab-submit" src="<?php echo esc_url($submitImage); ?>" alt="Submit">
		<?php else: ?>
		<input class="mab-submit" type="submit" value="<?php echo esc_attr($submit); ?>" />
		<?php endif; ?>
	</div>

	<div class="mab-form-msg mab-alert" style="display: none; text-align: center;"></div>
	
	<?php /** Email Lists field **/
	$lists = isset( $wysija['lists'] ) && is_array( $wysija['lists'] ) ? esc_attr( implode(',', $wysija['lists'] ) ) : '';
	?>
	<input type="hidden" name="lists" value="<?php echo $lists; ?>" />

	<?php if( !empty( $redirectUrl ) ): ?>
		<input type="hidden" name="redirect" value="<?php echo $redirectUrl; ?>" />
	<?php endif; ?>

	<input type="hidden" name="mabid" value="<?php echo $meta['ID']; ?>">
	<input type="hidden" name="optin-provider" value="wysija">

</form>
