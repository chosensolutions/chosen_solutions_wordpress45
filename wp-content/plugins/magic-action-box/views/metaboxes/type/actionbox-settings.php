<?php
	$MabAdmin = MAB('admin');
	$meta = !empty( $data['meta'] ) ? $data['meta'] : array();
	$assets_url = $data['assets-url'];
?>


<?php 
/* Load Style Select Box */
include_once( 'template-style-settings.php' ); ?>

<?php
$width = !empty($meta['width']) ? esc_attr($meta['width']) : '';
?>
<div class="mab-option-box">
	<h4><label for="mab-width"><?php _e('Action Box Width', 'mab'); ?></label></h4>
	<input type="text" class="code" value="<?php echo $width; ?>" name="mab[width]" placeholder="Ex. 400px or 100%">
	<p><?php _e('Specify the width of the action box with the unit i.e. px, em, %. This will be added as inline style to the <code>.magic-action-box</code> div.', 'mab'); ?></p>
</div>

<div class="mab-option-box">
	<?php $responsive = !empty($meta['responsive']) ? 1 : 0; ?>
	<label><input type="checkbox" value="1" name="mab[responsive]" <?php checked($responsive, 1); ?>> <strong><?php _e('Enable responsive form layout', 'mab'); ?></strong></label>
	<p class="description"><?php _e('Check this box to make opt in forms display nicely on mobile devices.', 'mab'); ?></p>
</div>

<div class="mab-option-box">
	<?php $layout = !empty($meta['layout']) ? 'horizontal' : ''; ?>
	<label><input type="checkbox" value="horizontal" name="mab[layout]" <?php checked($layout, 'horizontal'); ?>> <strong><?php _e('Enable horizontal layout', 'mab'); ?></strong></label>
	<p class="description"><?php _e('Enabling this option will display the box in horizontal format. Great for sign-up forms in header or homepage area.', 'mab'); ?></p>
</div>

<div class="mab-option-box">
	<?php $layout = !empty($meta['center-content']) ? 1 : 0; ?>
	<label><input type="checkbox" value="1" name="mab[center-content]" <?php checked($layout, 1); ?>> <strong><?php _e('Center content', 'mab'); ?></strong></label>
	<p class="description"><?php _e('Enable this option to center headings and content text. Form fields can also be centered by enabling the <code>Center opt-in form elements</code> option (if available).', 'mab'); ?></p>
</div>